<?php
session_start(); 


ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    if (!$haesarakkeet = $db->query("select * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rows = $haesarakkeet->fetch_assoc()) {
        $sid = $rows[id];
        $jarjestys = $rows[jarjestys];

        if (!$haeia = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $jarjestys . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowia = $haeia->fetch_assoc()) {
            $iaid = $rowia[id];

            $db->query("delete from iakp where ia_id = '" . $iaid . "'");
            $db->query("delete from iakp_moni where ia_id = '" . $iaid . "'");

            $db->query("delete from iavaihtoehdot where ia_id = '" . $iaid . "'");

            $db->query("delete from ia where id = '" . $iaid . "'");
        }


        $db->query("delete from ia_sarakkeet where id = '" . $sid . "'");
    }

    $db->query("delete from iakommentit where kurssi_id = '" . $_SESSION[KurssiId] . "'");
    $db->query("update kurssit set infoitsearviointi='' where id = '" . $_SESSION["KurssiId"] . "'");


    header("location: ia.php");
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

