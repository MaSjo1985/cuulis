<?php
session_start();

ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
//poistetaan tiedostot!
    // POISTAA OPETTAJAN LISÄÄMÄT TIEDOSTOT

    if (!$resulto = $db->query("select distinct * from ryhmatope where projekti_id = '" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowo = $resulto->fetch_assoc()) {
        $nimi = $rowo[tallennettunimi];
        $linkki = $rowo[linkki];
        $id = $rowo[id];

        if ($linkki == 1) {
            $db->query("delete from ryhmatope where id = '" . $id . "'");
        } else {
            if (file_exists($nimi)) {
                unlink($nimi);
            }

            if (file_exists($nimi)) {
                echo'<br>Tiedostoa ei pystytty poistamaan! <br><br><a href="ryhmatyot.php?r=' . $_GET[id] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>Voit ottaa yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br><br>';
            } else {
                $db->query("delete from ryhmatope where id = '" . $id . "'");
            }
        }
    }

    if (!$resultope = $db->query("select distinct * from open_palautustiedosto where projekti_id = '" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowope = $resultope->fetch_assoc()) {
        $nimi = $rowope[tallennettunimi];
        $linkki = $rowope[linkki];
        $id2 = $rowope[id];


        if ($linkki == 1) {
            $db->query("delete from open_palautustiedosto where id = '" . $id2 . "'");
        } else {

            if (!$resultmuut = $db->query("select distinct * from open_palautustiedosto where id <> '" . $id2 . "' AND tallennettunimi='" . $nimi . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($resultmuut->num_rows == 0) {

                if (file_exists($nimi)) {
                    unlink($nimi);
                }
            }

            $db->query("delete from open_palautustiedosto where id = '" . $id2 . "'");
        }
    }

    if (!$result = $db->query("select distinct * from ryhmat2 where projekti_id = '" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row = $result->fetch_assoc()) {
        $nimi = $row[tallennettunimi];
        $linkki = $row[linkki];
        if ($linkki != 1) {
            if (file_exists($nimi)) {
                unlink($nimi);
            }
        }
    }

    $db->query("delete from ryhmat where projekti_id ='" . $_GET[id] . "'");
    $db->query("delete from opiskelijankurssit where projekti_id ='" . $_GET[id] . "'");
    $db->query("delete from ryhmat2 where projekti_id ='" . $_GET[id] . "'");
    $db->query("delete from opiskelijan_kurssityot where projekti_id = '" . $_GET[id] . "'");
    $db->query("delete from projektit where id ='" . $_GET[id] . "'");

    header('location: ryhmatyot.php');
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>