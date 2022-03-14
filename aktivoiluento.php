<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Kysy/kommentoi </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("header.php");
        include("kurssiheader.php");



        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 20px">';

        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	  <a href="luento.php"  class="currentLink">Kysy/kommentoi</a>
	  <a href="keskustelut.php" >Keskustele</a> 
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



        echo'</div>';


        echo'<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; margin-bottom:0px">
                        <h2 style="padding-top: 10px">Kysy/kommentoi</h2>';
        echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px">';
        echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">
<a href="luento.php" class="btn-info2"  style="box-shadow: 2px 2px 2px #888888">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a> 
<a href="luento.php" class="btn-info2"  onClick="sayHelloWorld()"  style="box-shadow: 2px 2px 2px #888888">Kysymykset/kommentit</a>';


        echo'</nav>

			 </div>';


        echo'<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px">';


        echo'<div class="cm8-quarter" style="padding-top: 0px; margin-top: 0px">';
        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $aihe = $rowa[luentoaihe];
            $pvm = $rowa[luentopvm];
        }
        echo'<h6>Muokkaa luentotietoja</h6><br><a href="luento.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br><br>';

        echo '<form action="aktivoiluento2.php" method="post">
	Luennon aihe: <br><br>
	<textarea name="aihe" rows="2" maxlength="60">' . $aihe . '</textarea><br><br>
	<br>Päivämäärä: <br><br>	
		<input type="text" name="luentopvm" value=' . $pvm . '><br><br>
	<input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '>

	<br><input type="submit" value="&#10003 Tallenna" class="myButton9">			
		</form>';



        echo'</div><div class="cm8-third"></div></div></div>';
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