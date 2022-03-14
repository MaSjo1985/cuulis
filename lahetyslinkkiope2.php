<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {



    if ($_POST[kuvaus] != "") {

        
        $stmt = $db->prepare("INSERT INTO open_palautustiedosto (linkki, kuvaus, tallennettunimi, projekti_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $linkki, $kuvaus, $tallennettunimi, $pid);
     
        $linkki = 1;
        $kuvaus = $_POST[kuvaus];
        $tallennettunimi = $_POST[osoite];
        $pid = $_POST[pid];
     

        $stmt->execute();
        $stmt->close();





        header("location: ryhmatyot.php?r=" . $_POST[pid]);
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
