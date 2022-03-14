<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Materiaalit </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


  $db->query("update itseprojektit set eka_auki=0 where kurssi_id='" . $_SESSION[KurssiId] . "'");
  
    if ($_POST[auki] == 1) {
         $db->query("update itseprojektit set eka_auki=1 where id='" . $_POST[ipid] . "'");
    } 


    header('location: itsetyot.php?i='.$_POST[ipid]);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";
echo "</div>";

include("footer.php");
?>

</body>
</html>	