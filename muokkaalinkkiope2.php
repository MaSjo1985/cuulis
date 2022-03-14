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




        $stmt = $db->prepare("UPDATE open_palautustiedosto SET kuvaus=?, tallennettunimi=? WHERE id=?");
        $stmt->bind_param("ssi", $nimi, $tallennettunimi, $id);

        $tallennettunimi = $_POST[osoite];
        
        $nimi = $_POST[kuvaus];
        
        $id = $_POST[id];

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
