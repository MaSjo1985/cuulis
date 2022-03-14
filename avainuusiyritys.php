<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Kirjaudu kurssille/opintojaksolle </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");
    echo'<div class="cm8-container7">';

    include("opnavi.php");

    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';

    if (!$result = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($row = $result->fetch_assoc()) {
        $nimi = $row[nimi];
    }



    echo'<h4>Kirjaudu kurssille/opintojaksolle ' . $nimi . ': </h4>';
    echo '<a href="kurssit.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin <br><br></a>';
    echo '<p style="color:#FF0000; font-size:1.1em">Väärä avain!</p><br>';
    echo'
        <div class="cm8-quarter cm8-margin-bottom">
	<form action="avaintarkistus.php" method="post"> 

	<b>Anna kurssin/opintojakson avain:</b><br><br> <input type="text" name="Avain" > <br><br><br>

	<input type="submit" value="&#10003 Kirjaudu" class="myButton9">
	</form>';
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
echo '</div>';
echo '</div>';
echo '</div>';

include("footer.php");
?>
</body>


</html>