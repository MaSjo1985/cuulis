<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Muokkaa tietoja </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {



    $siivottusposti = mysqli_real_escape_string($db, $_POST[uusisposti]);
  
    $siivottusposti = trim($siivottusposti);
    
 if($_SESSION[Rooli]!='opiskelija'){
     $siivottusposti=strtolower($siivottusposti);
 }

    
    
    $siivottuetu = mysqli_real_escape_string($db, $_POST[uusietu]);
    $siivottusuku = mysqli_real_escape_string($db, $_POST[uusisuku]);

    $stmt = $db->prepare("UPDATE kayttajat SET etunimi=?, sukunimi=?, kokonimi=?, sposti=? WHERE id=?");
    $stmt->bind_param("ssssi", $etu, $suku, $koko, $sposti, $id);
    // prepare and bind
    $etu = $siivottuetu;
    $suku = $siivottusuku;
    $koko = $siivottuetu . ' ' . $siivottusuku;
    $sposti = $siivottusposti;
    $id = $_POST[id];

    $stmt->execute();




    $_SESSION["Sposti"] = $siivottusposti;
    $_SESSION["Etunimi"] = $siivottuetu;
    $_SESSION["Sukunimi"] = $siivottusuku;

    $stmt->close();
    header('location: omattiedot.php');
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