<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Viesti opiskelijoille </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("kurssisivustonheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; padding-bottom: 60px">';

    echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	 ';
    if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowa = $haeakt->fetch_assoc()) {

        $kysakt = $rowa[kysakt];
    }
    if ($kysakt == 1) {
        
    } else {
        // echo'<a  href="kysymyksetkommentit.php">Kysy/kommentoi</a>';
    }


    echo'
	  <a href="keskustelut.php" >Keskustele</a> 
	  <a href="osallistujat.php"  class="currentLink" >Osallistujat</a>  	  
	   <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
	</nav>';




    echo'

<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>';




    echo '<div class="cm8-container3" style="padding-top: 0px; margin-left: 0px">';
    echo'<div class="cm8-half" style="margin-left: 0px">';







    echo'<form action="lahetaviestiopiskelijoille.php" class="form-style-k" method="post"><fieldset>
        <legend>Lähetä viesti kurssin/opintojakson osallistujille</legend>
		  <a href="osallistujat.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>

	  <br> <p style="font-weight: normal"><b>Lähettäjän nimi:</b>&nbsp&nbsp&nbsp <input type="hidden" name="nimi" value="' . $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"] . '"> ' . $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"] . ' </p>
	<br><p style="font-weight: normal"><b>Lähettäjän käyttäjätunnus:</b> &nbsp&nbsp&nbsp<input type="hidden" size="30" name="sposti" value=' . $_SESSION["Sposti"] . '> ' . $_SESSION["Sposti"] . ' </p>';


    echo'<br><p><b> Viesti: </b><br><textarea name="viesti" rows="8"></textarea></p> <br><br> 
	<input type="submit" value="📧 &nbsp Lähetä" style="padding-bottom: 5px"  >
	  </fieldset></form></div></div>';
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo '</div>';
echo '</div>';
include("footer.php");
?>

</body>
</html>