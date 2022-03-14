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



    if ($_POST[kuvaus] != "") {


        $stmt = $db->prepare("UPDATE ryhmat2 SET tyonimi=?, omatallennusnimi=? WHERE id=?");
        $stmt->bind_param("ssi", $tyonimi, $omatallennusnimi, $id);

        $omatallennusnimi = $_POST[osoite];
        $projekti = $_POST[pid];
        $tyonimi = $_POST[kuvaus];
        $ryhma = $_POST[ryid];
        $id = $_POST[id];

        $stmt->execute();
        $stmt->close();


        header("location: ryhmatyot.php?r=" . $_POST[pid] . "#" . $ryhma);
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}



include("footer.php");
?>

</body>
</html>	

</body>
</html>	
