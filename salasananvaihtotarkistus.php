<?php
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Salasana vaihdettu </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");
    echo'<div class="cm8-container7">';
    if ($_SESSION["Rooli"] == 'admin')
        include("adminnavi.php");
    else if ($_SESSION["Rooli"] == 'admink')
        include("adminknavi.php");
    else if ($_SESSION["Rooli"] == 'opeadmin')
        include("opeadminnavi.php");
    else
        include ("opnavi.php");
    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
    echo'<div class="cm8-margin-top"></div>';




    $siivottusalasana = mysqli_real_escape_string($db, $_POST[Salasana]);
    $siivottuuusisalasana = mysqli_real_escape_string($db, $_POST[UusiSalasana]);
    $salt = "8CMr85";
    $krypattu = md5($salt . $siivottusalasana);
      $paivays = "" . date("h:i:s") . "";
$uniqid = $paivays.uniqid('', true);
    $krypattu = md5($uniqid . $siivottusalasana);
   $paivays = "" . date("h:i:s") . "";
$uniqid = $paivays.uniqid('', true);
   $krypattu2 = md5($uniqid);
    
    $stmt = $db->prepare("UPDATE kayttajat SET salasana=?, tarkistuskoodi=? WHERE id=?");
    $stmt->bind_param("ssi", $salasana, $koodi, $id);
// prepare and bind

    $salasana = $krypattu;
    $koodi = $krypattu2;

    $id = $_SESSION["Id"];

    $stmt->execute();

    $stmt->close();

    echo('<br>Salasanasi on vaihdettu. <br><br><a href="omattiedot.php?id=' . $_SESSION["Id"] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>');


    echo'</div>';

    echo'</div>';
    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}
?>
</body>
</html>		
