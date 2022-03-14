<?php
session_start();
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {


    $kurssi = $_POST[kurssi];

    if (!$haetehtavat = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $kurssi . "' ORDER BY jarjestys")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($rowT = $haetehtavat->fetch_assoc()) {
        $db->query("insert into itsearvioinnit (kurssi_id) values('" . $_POST[id] . "')");


        if (!$haeviimeisin = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_POST[id] . "' AND aihe=0 AND (valiaihe=0 OR valiaihe IS NULL)")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowV = $haeviimeisin->fetch_assoc()) {
            $tehtavaid = $rowV[id];
        }
        if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit, kayttajat where opiskelijankurssit.kurssi_id='" . $_POST[id] . "' AND kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.kurssi_id='" . $_SESSION["KurssiId"] . "' AND projekti_id=0 AND itseprojekti_id=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowo = $haeopiskelijat->fetch_assoc()) {
            $db->query("insert into itsearvioinnitkp (itsearvioinnit_id, kayttaja_id) values('" . $tehtavaid . "', '" . $rowo[opiskelija_id] . "')");
        }


        $db->query("update itsearvioinnit set sisalto='" . $rowT[sisalto] . "' where id = '" . $tehtavaid . "'");
        $db->query("update itsearvioinnit set aihe='" . $rowT[aihe] . "' where id = '" . $tehtavaid . "'");
        $db->query("update itsearvioinnit set valiaihe='" . $rowT[valiaihe] . "' where id = '" . $tehtavaid . "'");
        $db->query("update itsearvioinnit set otsikko='" . $rowT[otsikko] . "' where id = '" . $tehtavaid . "'");
        $db->query("update itsearvioinnit set jarjestys='" . $rowT[jarjestys] . "' where id = '" . $tehtavaid . "'");
    }







    header("location: itsearviointi.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>
</body>
</html>		
</html>	

