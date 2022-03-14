<?php
session_start();

ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    //hakee edellisen ryhmän id:n
    if (!$resultp = $db->query("select distinct opmaksimi from projektit where id='" . $_GET[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowp = $resultp->fetch_assoc()) {


        $opmaksimi = $rowp[opmaksimi];
    }

    if ($opmaksimi == 1) {


        if (!$kaikkiryhmat2 = $db->query("select distinct ryhmat.id as id from ryhmat, opiskelijankurssit, kayttajat where ryhmat.id=opiskelijankurssit.ryhma_id AND opiskelijankurssit.opiskelija_id=kayttajat.id AND ryhmat.projekti_id='" . $_GET[pid] . "' AND ryhmat.id<'" . $_GET[id] . "' ORDER BY sukunimi, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowk = $kaikkiryhmat2->fetch_assoc()) {


            $edellinen = $rowk[id];
        }
    } else {

        if (!$resulte = $db->query("select MAX(id) as id from ryhmat where id < '" . $_GET[id] . "' AND projekti_id='" . $_GET[pid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowe = $resulte->fetch_assoc()) {


            $edellinen = $rowe[id];
        }
    }




    // POISTAA OPETTAJAN LISÄÄMÄT TIEDOSTOT

    if (!$resulto = $db->query("select distinct * from ryhmatope where ryhma_id = '" . $_GET[id] . "'")) {
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
                echo'<br>Tiedostoa ei pystytty poistamaan! <br><br><a href="ryhmatyot.php?r=' . $_GET[pid] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>Voit ottaa yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br><br>';
            } else {
                $db->query("delete from ryhmatope where id = '" . $id . "'");
            }
        }
    }

////  
    $db->query("delete from ryhmat where id = '" . $_GET[id] . "'");

    $db->query("update opiskelijankurssit set ryhma_id=0 where ryhma_id = '" . $_GET[id] . "' AND projekti_id='" . $_GET[pid] . "'");

    if (!$haetarkka = $db->query("select distinct tarkkamaara from projektit where id='" . $_GET[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    //sallittu määrä
    while ($rowtarkka = $haetarkka->fetch_assoc()) {
        $tarkkamaara = $rowtarkka[tarkkamaara];
    }

    if ($tarkkamaara != 0) {
        $db->query("insert into ryhmat (projekti_id) values('" . $_GET[pid] . "')");
    }


    //nimetään vanhat uudelleen

    if (!$resultmina = $db->query("select MIN(id) as pienin from ryhmat where projekti_id='" . $_GET[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if (!$resultmaxa = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" . $_GET[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($minrowa = $resultmina->fetch_assoc()) {
        $mina = $minrowa[pienin];
    }

    while ($maxrowa = $resultmaxa->fetch_assoc()) {
        $maxa = $maxrowa[suurin];
    }

    $a = 1;

    for ($j = $mina; $j <= $maxa; $j++) {

        if (!$onko = $db->query("select * from ryhmat where projekti_id='" . $_GET[pid] . "' AND id='" . $j . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($onko->num_rows > 0) {
            $ryhmanimi = $a;

            $nimi = "Ryhmä " . $ryhmanimi . " ";

            $db->query("update ryhmat set nimi='" . $nimi . "' where projekti_id='" . $_GET[pid] . "' AND id='" . $j . "'");


            $a++;
        }
    }




    header("location: ryhmatyot.php?r=" . $_GET[pid] . "#" . $edellinen);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>