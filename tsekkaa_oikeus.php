<?php
session_start();

function tsekkaa_oikeus($sessiokurssi) {

    include("yhteys.php");
    

    if (isset($_GET[r])) {
        if (!$haeprojekti = $db->query("select distinct kurssi_id from projektit where id='" . $_GET[r] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rivi = $haeprojekti->fetch_assoc()) {
            $kurssi = $rivi[kurssi_id];
        }

        if ($kurssi != $sessiokurssi) {
            header('location: kurssi.php?id=' . $sessiokurssi);
        }
    } else if (isset($_GET[i])) {
        if (!$haeprojekti = $db->query("select distinct kurssi_id from itseprojektit where id='" . $_GET[i] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rivi = $haeprojekti->fetch_assoc()) {
            $kurssi = $rivi[kurssi_id];
        }

        if ($kurssi != $sessiokurssi) {
            header('location: kurssi.php?id=' . $sessiokurssi);
        }
    } else if (isset($_GET[a])) {
        if (!$haeprojekti = $db->query("select distinct kurssi_id from aanestykset where id='" . $_GET[a] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rivi = $haeprojekti->fetch_assoc()) {
            $kurssi = $rivi[kurssi_id];
        }

        if ($kurssi != $sessiokurssi) {
            header('location: kurssi.php?id=' . $sessiokurssi);
        }
    } else if (isset($_GET[k])) {
        if (!$haeprojekti = $db->query("select distinct kurssi_id from kansiot where id='" . $_GET[k] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rivi = $haeprojekti->fetch_assoc()) {
            $kurssi = $rivi[kurssi_id];
        }

        if ($kurssi != $sessiokurssi) {
            header('location: kurssi.php?id=' . $sessiokurssi);
        }
    }
}

?>