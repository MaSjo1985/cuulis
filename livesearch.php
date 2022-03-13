<?php
session_start(); 


ob_start();



//if we got something through $_POST
if (isset($_POST['search'])) {
    // here you would normally include some database connection
    include('yhteys.php');
    if ($_POST['search'] == '') {
        echo'tyhjä';
    } else {
        // never trust what user wrote! We must ALWAYS sanitize user input
        $hakusana = mysqli_real_escape_string($db, $_POST['search']);
        $hakusana = trim($hakusana);
        // build your search query to the database

        $url = "kurssit.php";
        $field2 = 'alkupvm';
        $sort = 'DESC';
        $nuoli2 = "&#8661";


        if (isset($_POST['sorting2'])) {

            if ($_POST['sorting2'] == 'ASC') {
                $sort = 'DESC';
            } else {
                $sort = 'ASC';
            }
        }
        if ($_POST['field2'] == 'kurssit.nimi') {
            $field2 = "kurssit.nimi";
        } elseif ($_POST['field2'] == 'koodi') {
            $field2 = "koodi";
        } elseif ($_POST['field2'] == 'koulut.Nimi') {
            $field2 = "koulut.Nimi";
        } elseif ($_POST['field2'] == 'sukunimi') {
            $field2 = "sukunimi";
        } elseif ($_POST['field2'] == 'luomispvm') {
            $field2 = "luomispvm";
        } elseif ($_POST['field2'] == 'lukuvuosi') {
            $field2 = "lukuvuosi";
        } elseif ($_POST['field2'] == 'alkupvm') {
            $field2 = "alkupvm";
        } elseif ($_POST['field2'] == 'loppupvm') {
            $field2 = "loppupvm";
        } elseif ($_POST['field2'] == 'sukunimi') {
            $field2 = "sukunimi";
        }


        if ($_SESSION["Rooli"] == 'admin') {
            $stmt = $db->prepare("SELECT DISTINCT lukuvuosi, alkupvm, loppupvm, kurssit.id as kid, kayttajat.id as kaid, koulut.id as koid, kurssit.nimi as nimi, luomispvm, koulut.Nimi as Nimi, koodi, etunimi, sukunimi FROM kurssit, koulut, kayttajat WHERE (kayttajat.id=kurssit.opettaja_id) AND (kurssit.koulu_id=koulut.id) AND (kurssit.nimi like ? OR koulut.Nimi like ? OR kurssit.koodi like ? OR etunimi like ? OR sukunimi like ? OR kokonimi like ?) ORDER BY $field2 $sort2");
            $stmt->bind_param("ssssss", $s1, $s1, $s1, $s1, $s1, $s1);
            // prepare and bind
            $s1 = "%" . $hakusana . "%";


            $stmt->execute();

            $stmt->store_result();

            $stmt->bind_result($c1, $c3, $c4, $c5, $c6, $c7, $c8, $c9, $c10, $c11, $c12, $c13);
        } else if ($_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {

            $stmt = $db->prepare("SELECT DISTINCT lukuvuosi, alkupvm, loppupvm, kurssit.id as kid, kayttajat.id as kaid, koulut.id as koid, kurssit.nimi as nimi, luomispvm, koulut.Nimi as Nimi, koodi, etunimi, sukunimi FROM kurssit, koulut, kayttajat WHERE koulut.id='" . $_SESSION["kouluId"] . "' AND (kayttajat.id=kurssit.opettaja_id) AND (kurssit.koulu_id=koulut.id) AND (kurssit.nimi like ? OR koulut.Nimi like ? OR kurssit.koodi like ? OR etunimi like ? OR sukunimi like ? OR kokonimi like ?) ORDER BY $field2 $sort2");
            $stmt->bind_param("ssssss", $s1, $s1, $s1, $s1, $s1, $s1);
            // prepare and bind
            $s1 = "%" . $hakusana . "%";


            $stmt->execute();

            $stmt->store_result();

            $stmt->bind_result($c1, $c3, $c4, $c5, $c6, $c7, $c8, $c9, $c10, $c11, $c12, $c13);
        } else if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'opiskelija') {

            $stmt = $db->prepare("SELECT DISTINCT lukuvuosi, kurssit.opettaja_id as oid, alkupvm, loppupvm, kurssit.id as kid, kayttajat.id as kaid, koulut.id as koid, kurssit.nimi as nimi, luomispvm, koulut.Nimi as Nimi, koodi, etunimi, sukunimi FROM kurssit, koulut, kayttajat, kayttajankoulut WHERE kayttajankoulut.odottaa=1 AND kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.kayttaja_id=kayttajat.id AND kayttajat.id='" . $_SESSION["Id"] . "' AND (kurssit.koulu_id=koulut.id) AND (kurssit.nimi like ? OR koulut.Nimi like ? OR kurssit.koodi like ? OR etunimi like ? OR sukunimi like ? OR kokonimi like ?) ORDER BY $field2 $sort2");
            $stmt->bind_param("ssssss", $s1, $s1, $s1, $s1, $s1, $s1);
            // prepare and bind
            $s1 = "%" . $hakusana . "%";


            $stmt->execute();

            $stmt->store_result();

            $stmt->bind_result($c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8, $c9, $c10, $c11, $c12, $c13);
        }


        if ($stmt->num_rows == 0) {
            echo "<br><b>Ei hakutuloksia.</b><br>";
        } else {

            if ($_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {



                echo'<form action="varmistuskurssit.php" method="post">';
                echo'<div class="cm8-responsive" id="piilota88" style="padding-top: 20px; padding-bottom: 10px; width: 100%" >';
                echo'<b style="font-size: 1.2em; color: #2b6777; font-weight: bold;">Hakutulokset:</b><br><br>';
                echo '<table id="mytable88" class="cm8-bordered cm8-uusitable12 cm8-striped"  style="table-layout:fixed; max-width: 100%;"><thead>';
                echo '<tr id="tanne"><th>Kurssi/Opintojakso</th><th>Koodi</th><th>Vastuuopettaja</th><th>Oppilaitos</th><th>Lukuvuosi</th><th>Alkaa</th><th>Päättyy</th><th>Lisätty</th><th>Valitse<br>&nbsp&#9661&nbsp</th></tr>';
                echo'</thead><tbody>';

                while ($stmt->fetch()) {
                    $rowh[lukuvuosi] = $c1;

                    $rowh[alkupvm] = $c3;
                    $rowh[loppupvm] = $c4;
                    $rowh[kid] = $c5;
                    $rowh[kaid] = $c6;
                    $rowh[koid] = $c7;
                    $rowh[nimi] = $c8;
                    $rowh[luomispvm] = $c9;
                    $rowh[Nimi] = $c10;
                    $rowh[koodi] = $c11;
                    $rowh[etunimi] = $c12;
                    $rowh[sukunimi] = $c13;
                    $rowh[alkupvm] = date("d.m.Y", strtotime($rowh[alkupvm]));
                    $rowh[loppupvm] = date("d.m.Y", strtotime($rowh[loppupvm]));
                    $rowh[luomispvm] = date("d.m.Y H:i", strtotime($rowh[luomispvm]));
                    echo '<tr><td><a href="kurssi.php?id=' . $rowh[kid] . '">' . $rowh[nimi] . '</a></td><td><a href="kurssi.php?id=' . $rowh[kid] . '">' . $rowh[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $rowh[kaid] . '">' . $rowh[etunimi] . ' ' . $rowh[sukunimi] . '</a></td><td><a href="muokkaakoulu.php?id=' . $rowh[koid] . '">' . $rowh[Nimi] . '</a></td><td>' . $rowh[lukuvuosi] . '</td><td>' . $rowh[alkupvm] . '</td><td>' . $rowh[loppupvm] . '</td><td>' . $rowh[luomispvm] . '</td><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $rowh[kid] . ' ></td></tr>';
                }


                echo'<tr style="border-bottom: 3px solid transparent; "><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 15px"><button class="pieniroskis" title="Poista"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td></tr>';
                echo "</tbody></table>";
                echo'</form></div></div>';
            } else if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'opiskelija') {
                echo'<div class="cm8-responsive" id="piilota88" style="padding-top: 20px; padding-bottom: 10px; width: 100%" >';
                echo'<b style="font-size: 1.2em; color: #2b6777; font-weight: bold;">Hakutulokset:</b><br><br>';
                echo '<table id="mytable88" class="cm8-bordered cm8-uusitable12 cm8-stripedeivikaa"  style="table-layout:fixed; max-width: 100%;"><thead>';
                echo '<tr id="tanne" ><th>Kurssi/Opintojakso</th><th>Koodi</th><th>Vastuuopettaja</th><th>Oppilaitos</th><th>Lukuvuosi</th><th>Alkaa</th><th>Päättyy</th><th></th></tr>';
                echo'</thead><tbody>';

                while ($stmt->fetch()) {
                    $rowh[lukuvuosi] = $c1;
                    $rowh[oid] = $c2;
                    $rowh[alkupvm] = $c3;
                    $rowh[loppupvm] = $c4;
                    $rowh[kid] = $c5;
                    $rowh[kaid] = $c6;
                    $rowh[koid] = $c7;
                    $rowh[nimi] = $c8;
                    $rowh[luomispvm] = $c9;
                    $rowh[Nimi] = $c10;
                    $rowh[koodi] = $c11;
                    $rowh[etunimi] = $c12;
                    $rowh[sukunimi] = $c13;
                    $rowh[alkupvm] = date("d.m.Y", strtotime($rowh[alkupvm]));
                    $rowh[loppupvm] = date("d.m.Y", strtotime($rowh[loppupvm]));

                    if (!$resulthope = $db->query("select distinct etunimi, sukunimi, id from kayttajat where kayttajat.id='" . $rowh[oid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    while ($rowhope = $resulthope->fetch_assoc()) {

                        echo '<tr><td><a href="kurssi.php?id=' . $rowh[kid] . '">' . $rowh[nimi] . '</a></td><td><a href="kurssi.php?id=' . $rowh[kid] . '">' . $rowh[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $rowhope[id] . '">' . $rowhope[etunimi] . ' ' . $rowhope[sukunimi] . '</a></td><td>' . $rowh[Nimi] . '</td><td>' . $rowh[lukuvuosi] . '</td><td>' . $rowh[alkupvm] . '</td><td>' . $rowh[loppupvm] . '</td><td><a href="viestikayttajalle.php?url=' . $url . '&id=' . $rowhope[id] . '">&nbsp&nbsp&nbsp📧 &nbsp Viesti opettajalle</a></td></tr>';
                    }
                }

                echo "</tbody></table>";
                echo'</div>';
            }
        }
        $stmt->close();
    }
} else {
    
}
?>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/tableHeadFixer.js"></script>
<script>
    //ilman tätä mikään muu ei toimi kuin scrolli


    $("#mytable88").tableHeadFixer({"head": false, "left": 1});

</script> 

<script>

    var $table88 = j('#mytable88');
    $table88.floatThead({zIndex: 1});
</script> 
<script>


    $("#scrollbar").on("scroll", function () {


        var container88 = $("#piilota88");
        var scrollbar = $("#scrollbar");


        ScrollUpdate(container88, scrollbar);
    });


    function ScrollUpdate(content, scrollbar) {

        $("#spacer").css({"width": "1000px"}); // set the spacer width'
        // set the spacer width
        scrollbar.width = content.width() + "px";
        content.scrollLeft(scrollbar.scrollLeft());
    }

    ScrollUpdate($("#piilota88"), $("#scrollbar"));
</script>