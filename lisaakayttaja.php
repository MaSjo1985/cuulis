<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Lisää käyttäjä </title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("header.php");
        include("header2.php");

        echo'<div class="cm8-container7">';
        if ($_SESSION["Rooli"] == "admin") {
            echo'<nav class="topnav" id="myTopnav">';
            echo'<a href="etusivu.php" >Etusivu</a>          
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
</script>     
<a href="oppilaitokset.php" >Oppilaitokset</a>
<a href="kayttajatvahvistus.php" class="currentLink">Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="kaikkitiedostot.php style="margin-bottom: 5px" >Palvelimella olevat tiedostot</a><a href="arvostelut.php">Arvostelut</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        } else if ($_SESSION["Rooli"] == "admink") {
            echo'<nav class="topnavoppilas" id="myTopnav">';
            echo'   <a href="etusivu.php" >Etusivu</a>       
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
</script>   
<a href="kayttajatvahvistus.php" class="currentLink">Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" >Oma oppilaitos</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        } else if ($_SESSION["Rooli"] == "opeadmin") {
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
<a href="omatkurssit.php" >Omat kurssit/opintojaksot</a>
<a href="kurssitkaikki.php" >Kaikki kurssit/opintojaksot</a>
<a href="kayttajatvahvistus.php" class="currentLink">Käyttäjät &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="kurssit.php">Kurssit/Opintojaksot &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" >Oppilaitos &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)">  
    <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        }
        echo'<nav id="myTopnav2" class="topnav2">
  <a href="kayttajatvahvistus.php" >Vahvistusta odottavat käyttäjät</a> 
   

  <a href="kayttajatopettajat.php" >Opettajat</a>
  <a href="kayttajatopiskelijat.php">Opiskelijat</a> 
  
 <a href="lisaakayttajaeka.php" class="currentLink3">+ Lisää uusi käyttäjä</a><a href="javascript:void(0);" class="icon" onclick="myFunction2(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>';
        echo'

<script>
function myFunction2(y) {
 y.classList.toggle("change");
    var x = document.getElementById("myTopnav2");
    if (x.className === "topnav2") {
        x.className += " responsive";
    } else {
        x.className = "topnav2";
    }
}
</script>';
//    if($_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin" )
//    {
//        echo' <a href="kayttajateivahvistetut.php">Vahvistamattomat käyttäjät</a>';
//    }

        echo'</nav>';
        echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 60px; ">';


        echo'<div class="cm8-half">';

        echo '<form name="Form" id="myForm" class="form-style-k onSubmit="return validateFormUusiKayttaja();" action="uusikayttajatarkistus.php" method="post"><fieldset>';

        echo' <legend>Lisää uusi käyttäjä</legend>';

        echo'<b style="color: #e608b8">Kaikki tiedot ovat pakollisia.</b> <br>';

        echo'<br><p>Etunimi: <b style="color: #e608b8">*</b><br><br>

<input type="text" id="etu" name="Etunimi"></p>
<div style="color: #e608b8; font-weight: bold; padding-top: 0px" id="divID">
    <p class="eimitaan" style="padding:0px; margin: 0px"></p>
</div>
<p>Sukunimi: <b style="color: #e608b8">*</b><br><br>
<input type="text" id="suku" name="Sukunimi" ></p>
<div style="color: #e608b8; font-weight: bold; padding-top: 0px" id="divID2">
    <p class="eimitaan"></p>
</div>
<p>Käyttäjätunnus: <b style="color: #e608b8">*</b><br><br>

<input type="email" id="sposti" name="Sposti"></p>

<div style="color: #e608b8; font-weight: bold; padding-top: 0px" id="divID3">
    <p class="eimitaan"></p>
</div>';

        if (!$resultkoulut = $db->query("select distinct * from koulut where id = '" . $_SESSION[kouluId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        echo'<br><p>Ensisijainen oppilaitos:<br>';


        while ($rowko = $resultkoulut->fetch_assoc()) {

            echo '<br>' . $rowko[Nimi];
        }
        echo'<br></p>';

        echo'
<br><p>Rooli: <b style="color: #e608b8">*</b><br>
      <br><b style="color: #e608b8; font-size: 0.9em">Huom! Roolia ei voi enää myöhemmin muuttaa!</b><br><br>

<select id="rooli" name="Rooli">
<option value="valitser" selected> Valitse
		<option value="opettaja"> Opettaja
		<option value="opiskelija"> Opiskelija
	<option value="muu"> Muu		
		</select><br></p><br>

<div style="color: #e608b8; font-weight: bold; padding-top: 0px" id="divID5">
    <p class="eimitaan" ></p>
</div>
<div id="username_availability_result"></div>  

<input type="hidden" id="vali" value="99">

<br><input type="button" onclick="validateFormUusiKayttaja()" value="&#10003 Lisää käyttäjä" class="myButton9">
	</fieldset></form>';
        echo'</div>';


        echo '</div>';
        echo '</div>';
        include("footer.php");
    }
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