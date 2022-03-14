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
    
      if (!$haeinfo = $db->query("select distinct kyselyinfo from kurssit where id='" . $kurssi . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
     while ($rowinfo = $haeinfo->fetch_assoc()) {
            $info = $rowinfo[kyselyinfo];
        }
    if (!$haetehtavat = $db->query("select distinct * from kyselyt where kurssi_id='" . $kurssi . "' ORDER BY jarjestys")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($rowT = $haetehtavat->fetch_assoc()) {
        $db->query("insert into kyselyt (kurssi_id) values('" . $_POST[id] . "')");
        if (!$haeviimeisineka = $db->query("select distinct * from kyselyt where kurssi_id='" . $_POST[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowVeka = $haeviimeisineka->fetch_assoc()) {
            $tehtavaid = $rowVeka[id];
        }
        $db->query("update kyselyt set sisalto='" . $rowT[sisalto] . "' where id = '" . $tehtavaid . "'");
        $db->query("update kyselyt set aihe='" . $rowT[aihe] . "' where id = '" . $tehtavaid . "'");
        $db->query("update kyselyt set valiaihe='" . $rowT[valiaihe] . "' where id = '" . $tehtavaid . "'");
        $db->query("update kyselyt set otsikko='" . $rowT[otsikko] . "' where id = '" . $tehtavaid . "'");
        $db->query("update kyselyt set pakollinen='" . $rowT[pakollinen] . "' where id = '" . $tehtavaid . "'");
        $db->query("update kyselyt set jarjestys='" . $rowT[jarjestys] . "' where id = '" . $tehtavaid . "'");
 $db->query("update kurssit set kyselyinfo='" . $info . "' where id = '" . $_SESSION[KurssiId] . "'");

        //OPISKELIJOIDEN TIETOIHIN

        if (!$haeviimeisin = $db->query("select distinct * from kyselyt where kurssi_id='" . $_POST[id] . "' AND aihe=0 AND (valiaihe=0 OR valiaihe IS NULL)")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowV = $haeviimeisin->fetch_assoc()) {
            $tehtavaid2 = $rowV[id];
        }
        if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit, kayttajat where opiskelijankurssit.kurssi_id='" . $_POST[id] . "' AND kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND opiskelijankurssit.kurssi_id='" . $_SESSION["KurssiId"] . "' AND projekti_id=0 AND itseprojekti_id=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowo = $haeopiskelijat->fetch_assoc()) {
            $db->query("insert into kyselytkp (kyselyt_id, kayttaja_id) values('" . $tehtavaid2 . "', '" . $rowo[opiskelija_id] . "')");
        }
    }

    header("location: kysely.php");
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

