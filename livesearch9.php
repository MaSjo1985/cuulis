<?php
ob_start();

session_start();
//if we got something through $_POST
if (isset($_POST['search'])) {
    // here you would normally include some database connection
    include('yhteys.php');

    // never trust what user wrote! We must ALWAYS sanitize user input


    $hakusanaop = mysqli_real_escape_string($db, $_POST['search']);
    $hakusanaop = trim($hakusanaop);
    $url = "lisaaopettajaeka.php";


    $stmt = $db->prepare("SELECT DISTINCT etunimi, sukunimi, sposti, kayttajat.id as kaid FROM kayttajat, koulut, kayttajankoulut WHERE koulut.id='" . $_SESSION["kouluId"] . "' AND kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id AND kayttajat.tarkistettu=1 AND kayttajat.vahvistettu=1 AND  kayttajat.rooli='opettaja' AND (sposti like ? OR etunimi like ? OR sukunimi like ? OR kokonimi like ?) ORDER BY kayttajat.sukunimi ");
    $stmt->bind_param("ssss", $s1, $s1, $s1, $s1);
    // prepare and bind
    $s1 = "%" . $hakusanaop . "%";
    $stmt->execute();

    $stmt->store_result();

    $stmt->bind_result($c1, $c2, $c3, $c6);

    if (!$result = $db->query("select distinct kayttajat.id as kaid, etunimi, sukunimi, sposti from kayttajat, kayttajankoulut where kayttajat.tarkistettu=1 AND kayttajat.vahvistettu=1 AND kayttajankoulut.kayttaja_id=kayttajat.id AND kayttajankoulut.koulu_id ='" . $_SESSION["kouluId"] . "' AND kayttajankoulut.odottaa=1 AND kayttajat.id<>'" . $_SESSION["Id"] . "' AND kayttajat.rooli='opettaja'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if (!$result2 = $db->query("select distinct kayttajat.id as kaid, etunimi, sukunimi, sposti from kayttajat, kayttajankoulut where kayttajat.tarkistettu=1 AND kayttajat.vahvistettu=1 AND kayttajankoulut.kayttaja_id=kayttajat.id AND kayttajankoulut.koulu_id ='" . $_SESSION["kouluId"] . "' AND kayttajankoulut.odottaa=1 AND kayttajat.id<>'" . $_SESSION["Id"] . "' AND kayttajat.rooli='opettaja'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    $array = array();
    $array2 = array();

    if (!$haekurssinopettajat = $db->query("select distinct kayttajat.id as kaid from kayttajat, opiskelijankurssit where opiskelijankurssit.opiskelija_id=kayttajat.id AND opiskelijankurssit.kurssi_id = '" . $_SESSION["KurssiId"] . "' AND projekti_id=0 AND itseprojekti_id=0 AND kayttajat.rooli='opettaja' AND opiskelijankurssit.ope=1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if (!$haekurssinopettajat2 = $db->query("select distinct kayttajat.id as kaid from kayttajat, opiskelijankurssit where opiskelijankurssit.opiskelija_id=kayttajat.id AND opiskelijankurssit.kurssi_id = '" . $_SESSION["KurssiId"] . "' AND projekti_id=0 AND itseprojekti_id=0 AND kayttajat.rooli='opettaja' AND opiskelijankurssit.ope=1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowkaikki = $haekurssinopettajat->fetch_assoc()) {
        array_push($array, $rowkaikki[kaid]);
    }
    while ($rowkaikki2 = $haekurssinopettajat2->fetch_assoc()) {
        array_push($array2, $rowkaikki2[kaid]);
    }


    $loyty = false;

    while ($row2 = $result->fetch_assoc()) {
        if (!empty($array2)) {
            foreach ($array2 as $onid2) {
                if ($row2[kaid] != $onid2) {
                    $loyty = true;
                }
            }
        } else {
            $loyty = true;
        }
    }
    if (!$loyty)
        echo "<b>Ei hakutuloksia.</b><br>";

    else {


        echo'<div class="cm8-margin-top"></div>';
        echo'<form action="lisaaopettajavarmistus.php" method="post">';

        echo'<div class="cm8-responsive" id="piilota88" style="padding-top: 0px; padding-bottom: 10px; width: 100%" >';
        echo'<b style="font-size: 1.2em; color: #f7f9f7; font-weight: bold;">Hakutulokset:</b><br><br><br>';
        echo'<input type="submit" value="+ Lisää" id="piilota3" class="myButton8" style="padding: 2px 4px"><br>';
        echo '<table id="mytable88"  class="cm8-bordered cm8-uusitable12 cm8-striped"  style="table-layout:fixed; max-width: 100%;"><thead>';
        echo '<tr><th>Valitse<br>&nbsp&#9661&nbsp</th><th>Sukunimi</th><th>Etunimi</th><th>Käyttäjätunnus</th><th></th></tr>';
        echo'</thead><tbody>';


        while ($stmt->fetch()) {
            $row[etunimi] = $c1;
            $row[sukunimi] = $c2;
            $row[sposti] = $c3;
            $row[kaid] = $c6;

            if (!empty($array)) {

                $loyty2 = false;
                foreach ($array as $onid) {
                    if ($row[kaid] == $onid) {
                        $loyty2 = true;
                    }
                }
                if (!$loyty2)
                    echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista10[]" value=' . $row[kaid] . ' ></td><td>' . $row[sukunimi] . '</td><td>' . $row[etunimi] . "</td><td>" . $row[sposti] . '</td><td><a href="viestikayttajalle.php?url=' . $url . '&id=' . $row[kaid] . '&paluu=lisaaopiskelijaeka" style="padding: 0px 4px; margin: 0" title="Lähetä viesti käyttäjälle">📧 &nbsp</a></td></tr>';
            }
            else {
                echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista10[]" value=' . $row[kaid] . ' ></td><td>' . $row[sukunimi] . '</td><td>' . $row[etunimi] . "</td><td>" . $row[sposti] . '</td><td><a href="viestikayttajalle.php?url=' . $url . '&id=' . $row[kaid] . '&paluu=lisaaopiskelijaeka" style="padding: 0px 4px; margin: 0" title="Lähetä viesti käyttäjälle">📧 &nbsp</a></td></tr>';
            }
        }
        echo'<tr><td> <input type="submit" value="+ Lisää" class="myButton8" style="padding: 2px 4px"></td><td></td><td></td><td></td><td></td></tr>';

        echo "</tbody></table>";

        echo'</form></div></div>';
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
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