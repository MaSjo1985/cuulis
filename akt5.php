<?php
session_start(); 



ob_start();



include("yhteys.php");


// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
$kuid = $_SESSION['KurssiId'];




if ($_SESSION["Rooli"] == 'opiskelija') {


    if (!$haekysakt = $db->query("select distinct * from kurssit where id='" . $kuid . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowkys8 = $haekysakt->fetch_assoc()) {
        $keskakt = $rowkys8[keskakt];
    }
    if ($keskakt == 1) {
        
    }
}
?>

