<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Kurssin/opintojakson kopiointi </title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />

';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opeadmin" || $_SESSION["Rooli"] == "opettaja") {
        include("header.php");
        include("header2.php");



        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';

        if ($_SESSION["Rooli"] == "opeadmin") {

            echo'<nav class="topnavOpe" id="myTopnav">';
            echo'<a href="etusivu.php"  >Etusivu</a>         
<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
    if (x.className === "topnavOpe") {
  
        x.className += " responsive";
        
       
    } else {
  
        x.className = "topnavOpe";
      
    }
     
}
</script>
<a href="omatkurssit.php" class="currentLink">Omat kurssit/opintojaksot</a>
<a href="kurssitkaikki.php" >Kaikki kurssit/opintojaksot</a>
<a href="kayttajatvahvistus.php" >Käyttäjät &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="kurssit.php">Kurssit/Opintojaksot &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" >Oppilaitos &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)">  
    <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        } else {

            echo'<nav class="topnavoppilas" id="myTopnav">';
            echo'         
	<a href="etusivu.php" >Etusivu</a>      
	<a href="omatkurssit.php" class="currentLink">Omat kurssit/opintojaksot</a>
	<a href="kurssit.php" >Kaikki kurssit/opintojaksot</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
            echo'

<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
    if (x.className === "topnavoppilas") {
        x.className += " responsive";
    } else {
        x.className = "topnavoppilas";
    }
}
</script>';
        }


        echo'<div class="cm8-margin-top"></div>';
        echo'<div class="cm8-quarter"><br></div>';


        echo'<div class="cm8-threequarter">';
        if (!$haekurssi = $db->query("select distinct nimi, koodi, id from kurssit where id='" . $_GET["id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowk = $haekurssi->fetch_assoc()) {

            $nimi = $rowk[nimi];
            $koodi = $rowk[koodi];
            $kurssi_id = $rowk[id];
        }
        echo '<p><b>Haluatko siis tehdä kopion kurssista/opintojaksosta/opintojaksosta:<br><br></b>' . $koodi . ' ' . $nimi . '?</p>';

        echo' <form action="tuorakenne.php" method="POST" style="display: inline-block; margin-right: 30px">

            <input type="hidden" name="id" value=' . $_GET[id] . '> 
		<br><input type="submit" name="joo" value="Kyllä" class="myButton9" style="padding: 5px; margin-right: 20px">
                <input type="submit" name="en" value="En" class="myButton9" style="padding: 5px">

	</form>';


        echo'
</div></div></div>';
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