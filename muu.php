<?php
session_start(); 


ob_start();

echo'
<!DOCTYPE html>
<html>
 
<head>


<title> Etusivu</title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    include("header.php");

    echo '<div class="cm8-container2" style="padding-bottom: 40px; padding-top: 20px; font-size: 1.1em">';




    echo'<br><br><b style="color: #e608b8">Käyttäjäoikeutesi ovat puutteelliset! </b><br><br>Olet kirjautunut roolissa "muu", mutta sinua ei ole lisätty vielä minkään oppilaitoksen ylläpitäjäksi.<br><br><br><u><a href="yhteydenotto.php">Voit ottaa yhteyttä oppimisympäristön ylläpitäjään tästä >> </u> </a>';

    echo"</div>";
    include("footer.php");
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