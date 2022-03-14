<?php
session_start(); 



ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    if (!$result5 = $db->query("select distinct * from itseprojektit where id = '" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row5 = $result5->fetch_assoc()) {
        $ipid = $row5[id];

        if (!$result6 = $db->query("select distinct * from itsetehtavat where itseprojektit_id = '" . $ipid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row6 = $result6->fetch_assoc()) {
            $iptid = $row6[id];
            $db->query("delete from itsetehtavatkp where itsetehtavat_id = '" . $iptid . "'");
            $db->query("delete from itsetehtavat where id = '" . $iptid . "'");
        }

        $db->query("delete from opiskelijankurssit where itseprojekti_id ='" . $ipid . "'");

        $db->query("delete from itseprojektit_tasot where itseprojekti_id = '" . $ipid . "'");
        $db->query("delete from opiskelijankirja where itseprojekti_id = '" . $ipid . "'");
        $db->query("delete from itseprojektit where id = '" . $ipid . "'");
    }


    if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where kurssi_id = '" . $_SESSION[KurssiId] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rivi = $haeopiskelijat->fetch_assoc()) {
        $id = $rivi[opiskelija_id];
        $pienimi = 'images/sektori' . $id . '.png';
        if (file_exists($pienimi)) {
            unlink($pienimi);
        }
        $pienimi = 'images/sektori2' . $id . '.png';
        if (file_exists($pienimi)) {
            unlink($pienimi);
        }
        $pienimi = 'images/sektori3' . $id . '.png';
        if (file_exists($pienimi)) {
            unlink($pienimi);
        }
        $pienimi = 'images/sektori4' . $id . '.png';
        if (file_exists($pienimi)) {
            unlink($pienimi);
        }
    }

    header('location: itsetyot.php');
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>