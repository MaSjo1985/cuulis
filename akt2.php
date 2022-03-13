<?php
session_start(); 



ob_start();




echo'<!DOCTYPE html><html> 
<head>
<title> Kysy/kommentoi </title>';
echo'<script src="https://code.jquery.com/jquery-1.10.2.js"></script><script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script>';
include("yhteys.php");


// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
$kuid = $_SESSION['KurssiId'];

$w1 = $_SESSION['w1'];
$w2 = $_SESSION['w2'];

if (!$haekysakt = $db->query("select distinct * from kurssit where id='" . $kuid . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
while ($rowkys8 = $haekysakt->fetch_assoc()) {
    $kysakt = $rowkys8[kysakt];
}
if ($kysakt == 1) {
    echo'<br><br><em>Toiminto on aktivoitu.</em>';
    echo'<br><br><a href="kysymykset2.php?w1=' . $w1 . '&w2=' . $w2 . '" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 1em" target="_blank"> Avaa kysymykset/kommentit-osio</a>';
} else {

    echo'<br><br><em>Toimintoa ei ole aktivoitu.</em>';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {






        echo'<br><br><br><a href="aktivoikysymykset.php" target="_blank" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 1em"> Aktivoi toiminto</a>';
    }
}
?>

