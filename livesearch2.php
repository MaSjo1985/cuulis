<?php
session_start(); 


ob_start();



//if we got something through $_POST
if (isset($_POST['search'])) {
    // here you would normally include some database connection
    include('yhteys.php');

    // never trust what user wrote! We must ALWAYS sanitize user input
    $hakusana = mysqli_real_escape_string($db, $_POST['search']);
    $hakusana = trim($hakusana);
    // build your search query to the database
    $url = "omatkurssit.php";

    $field2 = 'alkupvm';
    $sort2 = 'DESC';
    $nuoli2 = "&#8661";


    if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'opeadmin') {
        $stmt = $db->prepare("SELECT DISTINCT lukuvuosi, kurssit.opettaja_id as oid, alkupvm, loppupvm, kurssit.id as kid, kayttajat.id as kaid, koulut.id as koid, kurssit.nimi as nimi, luomispvm, koulut.Nimi as Nimi, koodi, etunimi, sukunimi FROM kurssit, koulut, kayttajat, kayttajankoulut, opiskelijankurssit WHERE ((opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id AND opiskelijankurssit.ope=1) OR (kurssit.opettaja_id='" . $_SESSION["Id"] . "')) AND (kayttajat.id='" . $_SESSION["Id"] . "' AND kayttajankoulut.odottaa=1 AND kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.kayttaja_id=kayttajat.id AND kurssit.koulu_id=koulut.id) AND (kurssit.nimi like ? OR koulut.Nimi like ? OR kurssit.koodi like ? OR etunimi like ? OR sukunimi like ? OR kokonimi like ?) ORDER BY $field2 $sort2");
        $stmt->bind_param("ssssss", $s1, $s1, $s1, $s1, $s1, $s1);
        // prepare and bind
        $s1 = "%" . $hakusana . "%";


        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8, $c9, $c10, $c11, $c12, $c13);
    } else if ($_SESSION["Rooli"] == 'opiskelija') {
        $stmt = $db->prepare("SELECT DISTINCT lukuvuosi, alkupvm, loppupvm, kurssit.id as kid, kayttajat.id as kaid, koulut.id as koid, kurssit.nimi as nimi, luomispvm, koulut.Nimi as Nimi, koodi, etunimi, sukunimi FROM kurssit, koulut, kayttajat, opiskelijankurssit WHERE opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id AND kurssit.opettaja_id=kayttajat.id AND (kurssit.koulu_id=koulut.id) AND (kurssit.nimi like ? OR koulut.Nimi like ? OR kurssit.koodi like ? OR etunimi like ? OR sukunimi like ? OR kokonimi like ?) ORDER BY $field2 $sort2");
        $stmt->bind_param("ssssss", $s1, $s1, $s1, $s1, $s1, $s1);
        // prepare and bind
        $s1 = "%" . $hakusana . "%";


        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($c1, $c3, $c4, $c5, $c6, $c7, $c8, $c9, $c10, $c11, $c12, $c13);
    }


    if ($stmt->num_rows == 0)
        echo "<br><b>Ei hakutuloksia.</b><br>";

    else {

        if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'opeadmin') {

            echo'<form action="varmistuskurssit.php" method="post">';

            echo'<div class="cm8-responsive" id="piilota88" style="padding-top: 20px; padding-bottom: 10px; width: 100%" >';
            echo'<b style="font-size: 1.2em; color: #2b6777; font-weight: bold;">Hakutulokset:</b><br><br>';
            echo '<table id="mytable88"  class="cm8-bordered cm8-uusitable12 cm8-striped"  style="table-layout:fixed; max-width: 100%; overflow: hidden"><thead>';
            echo '<tr id="tanne"><th>Kurssi/Opintojakso</th><th>Koodi</th><th>Vastuuopettaja</th><th>Oppilaitos</th><th>Lukuvuosi</th><th>Alkaa</th><th>Päättyy</th><th>Valitse<br>&nbsp&#9661&nbsp</th><th>Kopioi</th></tr>';
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

                if ($rowh[oid] == $_SESSION["Id"]) {
                    $oma = 1;
                }
                $rowh[alkupvm] = date("d.m.Y", strtotime($rowh[alkupvm]));
                $rowh[loppupvm] = date("d.m.Y", strtotime($rowh[loppupvm]));
                if (!$resulthope = $db->query("select distinct etunimi, sukunimi, id from kayttajat where kayttajat.id='" . $rowh[oid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowope = $resulthope->fetch_assoc()) {




                    echo '<tr><td><a href="kurssi.php?id=' . $rowh[kid] . '">' . $rowh[nimi] . '</a></td><td><a href="kurssi.php?id=' . $rowh[kid] . '">' . $rowh[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $rowope[id] . '">' . $rowope[etunimi] . ' ' . $rowope[sukunimi] . '</a></td><td>' . $rowh[Nimi] . '</td><td>' . $rowh[lukuvuosi] . '</td><td>' . $rowh[alkupvm] . '</td><td>' . $rowh[loppupvm] . '</td>';
                    echo'<td ><input type="checkbox" name="lista[]" value=' . $rowh[kid] . '></td>';
                    if ($oma == 1) {
                        echo'<td style=";   padding-bottom: 0px"><a href="kopiointivarmistus.php?id=' . $rowh[kid] . '" class="myButton8"  role="button" >Kopioi</a></td>';
                    } else {
                        echo'<td></td>';
                    }
                    echo'</tr>';
                }
            }

            echo'<tr style="border-bottom: 3px solid transparent; "><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 15px"><button class="pieniroskis" title="Poista"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td></tr>';
            echo "</tbody></table>";
            echo'</form></div></div>';
        } else if ($_SESSION["Rooli"] == 'opiskelija') {

            echo'<form action="varmistuskurssit3.php" method="post">';

            echo'<div class="cm8-responsive" id="piilota88" style="padding-top: 20px; padding-bottom: 10px; width: 100%" >';
            echo'<b style="font-size: 1.2em; color: #2b6777; font-weight: bold;">Hakutulokset:</b><br><br>';
            echo '<table id="mytable88" class="cm8-bordered cm8-uusitable12 cm8-striped"  style="table-layout:fixed; max-width: 100%;"><thead>';
            echo '<tr id="tanne"><th>Kurssi/Opintojakso</th><th>Koodi</th><th>Vastuuopettaja</th><th>Oppilaitos</th><th>Lukuvuosi</th><th>Alkaa</th><th>Päättyy</th><th>Valitse<br>&nbsp&#9661&nbsp</th></tr>';
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
                echo '<tr><td><a href="kurssi.php?id=' . $rowh[kid] . '">' . $rowh[nimi] . '</a></td><td><a href="kurssi.php?id=' . $rowh[kid] . '">' . $rowh[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $rowh[kaid] . '">' . $rowh[etunimi] . ' ' . $rowh[sukunimi] . '</a></td><td>' . $rowh[Nimi] . '</td><td>' . $rowh[lukuvuosi] . '</td><td>' . $rowh[alkupvm] . '</td><td>' . $rowh[loppupvm] . '</td><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $rowh[kid] . ' ></td></tr>';
            }

            echo'<tr style="border-bottom: 3px solid transparent; "><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 15px; "><button class="pieniroskis" title="Poistu"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poistu</button></td></tr>';
            echo "</tbody></table>";
            echo'</form></div></div>';
        }
    }
    $stmt->close();
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