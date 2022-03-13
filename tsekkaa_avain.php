<?php
session_start();

function tsekkaa($kurssi) {
    include("yhteys.php");
    
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "opeadmin" || $_SESSION["Rooli"] == "admink") {
        $_SESSION["vaihto"] = 0;
        if (!$tulosAvain = $db->query("select * from kurssit where id='" . $kurssi . "' AND opettaja_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$tulosAvain2 = $db->query("select * from opiskelijankurssit where kurssi_id='" . $kurssi . "' AND opiskelija_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($tulosAvain->num_rows == 0 && $tulosAvain2->num_rows == 0) {
            header("location: avain.php");
        }
    } else if ($_SESSION["Rooli"] == "opiskelija") {

        if (!$tulosAvain = $db->query("select * from opiskelijankurssit where kurssi_id='" . $kurssi . "' AND opiskelija_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($tulosAvain->num_rows == 0) {
            header("location: avain.php");
        }
    } else if ($_SESSION[Rooli] == admin) {
        $_SESSION["vaihto"] = 0;
    }
}
