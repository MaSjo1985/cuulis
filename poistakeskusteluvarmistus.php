<?php
ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Poista keskustelu </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("kurssisivustonheader.php");



        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';

        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	 ';


        echo'
	  <a href="keskustelut.php" class="currentLink">Keskustele</a> 
	<a href="osallistujat.php"   >Osallistujat</a>  	  
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





        echo '<div class="cm8-margin-top"></div>';
        echo'<div class="cm8-third" style="width: 300px; padding-left: 20px"><h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Keskustele</h2></div>';








        echo'<div class="cm8-threequarter cm8-margin-left" style="padding-top: 30px">';




        echo '<p style="font-weight: bold" >Haluatko todella poistaa koko keskustelun?</p>';


        echo '<br><a href="poistakeskustelu.php?r=' . $_GET[r] . '"  class="myButton9"  role="button"  style="margin-right: 30px">Kyllä</a>';
        echo '<a href="keskustelut.php"  class="myButton9"  role="button"  style="margin-right: 30px">En</a><br>';


        echo'
</div></div></div>';
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}



include("footer.php");
?>

</body>
</html>	
