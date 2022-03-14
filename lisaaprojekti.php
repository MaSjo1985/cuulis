<?php
session_start(); 



ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    $stmt = $db->prepare("INSERT INTO projektit (kurssi_id, kuvaus, ryhmienmaksimi, tarkkamaara, opmaksimi, opminimi, palautus) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isiiiii", $kurssi, $kuvaus, $maks, $tarkka, $opmaks, $opmin, $pal);
    // prepare and bind
    $kurssi = $_POST["kurssiId"];
    $kuvaus = $_POST["kuvaus"];
    if (!empty($_POST[lkm])) {
        $maks = $_POST["lkm"];
    } else {
        $maks = 0;
    }
    if (!empty($_POST[tarkka])) {
        $tarkka = $_POST["tarkka"];
    } else {
        $tarkka = 0;
    }

    $opmaks = $_POST["maksimi"];
    $opmin = $_POST["minimi"];
    $pal = $_POST[palautus];
    $stmt->execute();
    $stmt->close();


    if (!$haeid = $db->query("select id from projektit where kurssi_id='" . $_POST["kurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowid = $haeid->fetch_assoc()) {
        $pid = $rowid[id];
    }


    if (!$haetarkka = $db->query("select distinct tarkkamaara from projektit where id='" . $pid . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($rowtarkka = $haetarkka->fetch_assoc()) {
        $tarkkamaara = $rowtarkka[tarkkamaara];
    }

    if ($tarkkamaara != 0) {
        for ($i = 1; $i <= $tarkkamaara; $i++) {
            if (!$maara = $db->query("select distinct * from ryhmat where projekti_id='" . $pid . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $ryhmanimi = (($maara->num_rows) + 1);

            $nimi = "Ryhmä " . $ryhmanimi . " ";
            $db->query("insert into ryhmat (projekti_id, nimi, suljettu) values('" . $pid . "', '" . $nimi . "', 0)");
        }
    } else {
        if (!$resultmina = $db->query("select MIN(id) as pienin from ryhmat where projekti_id='" . $pid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!$resultmaxa = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" . $pid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($minrowa = $resultmina->fetch_assoc()) {
            $mina = $minrowa[pienin];
        }

        while ($maxrowa = $resultmaxa->fetch_assoc()) {
            $maxa = $maxrowa[suurin];
        }
        $a = 0;
        for ($j = $mina; $j <= $maxa; $j++) {
            $a++;
        }


        $ryhmanimi = $a;

        $nimi = "Ryhmä " . $ryhmanimi . " ";

        $db->query("insert into ryhmat (projekti_id, nimi, suljettu) values('" . $pid . "', '" . $nimi . "', 0)");
    }



    if (!$haeopiskelijat = $db->query("select distinct opiskelija_id from opiskelijankurssit, kayttajat where opiskelijankurssit.kurssi_id='" . $_POST["kurssiId"] . "' AND opiskelijankurssit.opiskelija_id=kayttajat.id AND kayttajat.rooli='opiskelija'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowop = $haeopiskelijat->fetch_assoc()) {
        $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, koulu_id, projekti_id) values('" . $rowop[opiskelija_id] . "', '" . $_SESSION["KurssiId"] . "', '" . $_SESSION["kouluId"] . "', '" . $pid . "')");
    }

    header("location: ryhmatyot.php?r=" . $pid);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>