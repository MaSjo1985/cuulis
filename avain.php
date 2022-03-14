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

    if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == "opiskelija") {
        echo'<nav class="topnavoppilas" id="myTopnav">';
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
</script><a href="etusivu.php" class="currentLink">Etusivu</a>      
<a href="omatkurssit.php" >Omat kurssit/opintojaksot</a>
<a href="kurssit.php" >Kaikki kurssit/opintojaksot</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>

</nav>';
    } else if ($_SESSION["Rooli"] == 'admink') {
        echo'<nav class="topnavoppilas" id="myTopnav">';
        echo' <a href="etusivu.php" class="currentLink">Etusivu</a>         
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
<a href="kayttajatvahvistus.php" >Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" >Oma oppilaitos</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
    } else if ($_SESSION["Rooli"] == 'opeadmin') {
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
<a href="kurssitkaikki.php" class="currentLink">Kaikki kurssit/opintojaksot</a>
<a href="kayttajatvahvistus.php" >Käyttäjät &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="kurssit.php">Kurssit/Opintojaksot &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" >Oppilaitos &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)">  
    <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
    }




    if (!$result = $db->query("select distinct nimi, koodi from kurssit where id='" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($row = $result->fetch_assoc()) {
        $nimi = $row[nimi];
        $koodi = $row[koodi];
    }



    echo'<div class="cm8-half" style="padding-top:20px; padding-left: 30px">';
    echo'<form name="Form" class="form-style-k" id="myForm" onSubmit="return validateForm12();" action="avaintarkistus.php" method="post"><fieldset>';
    echo'<legend>Kirjaudu kurssille/opintojaksolle ' . $koodi . ' ' . $nimi . '</legend>
   <a href="kurssit.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>


<p><b>Anna kurssin/opintojakson avain:</b><br><br>
 
    <input type="text" id="Avain" name="Avain" > </p>
    <div style="color: #e608b8; font-weight: bold; padding: 0px; margin-bottom: 0px" id="divID">
    <p style="padding: 0px; margin-bottom: 0px" class="eimitaan"></p>
    </div>
<input type="hidden" id="kurssi_id" name="kurssi_id" value=' . $_GET[id] . '>
 <br><br> <input type="button" onclick="validateForm12()" value="&#10003 Kirjaudu" class="myButton9">
 </fieldset> </form>';
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