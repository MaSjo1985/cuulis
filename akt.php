<?php
session_start(); 



ob_start();



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

    echo'<br><br><a href="" onClick="submitChat()"  class="myButton9" style="color: #2b6777" role="button" > Lähetä</a></form></div>';
} else {

    echo'<br><br><a href="" onClick="submitChat()" class="mybutton8Disabled" role="button"> Lähetä</a></form></div>';
}
?>

