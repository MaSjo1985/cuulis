<?php
session_start();
ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>

<title> Kurssin poisto</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");
    echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px;">';

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


    echo'<div class="cm8-container3" style="padding-top: 30px; ">';


    if (empty($_POST["lista"])) {
        echo '<p style="font-weight: bold" >Et valinnut yhtään kurssia/opintojaksoa!</p>';
        echo'<a href="omatkurssit.php"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin';
    } else {
        $lista = $_POST["lista"];
        $idt = $_POST["lista"];
        echo '<p style="font-weight: bold" >Haluatko todella poistua seuraavilta kursseilta/opintojaksoilta?</p>';


        foreach ($lista as $tuote) {

            if (!$result = $db->query("select nimi, id, koodi from kurssit where id = '" . $tuote . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($row2 = $result->fetch_assoc()) {
                $nimi = $row2[nimi];
                $id = $row2[id];
                $koodi = $row2[koodi];
            }

            echo "<br>" . $koodi . ' ' . $nimi;
        }
        echo "<br>";
        echo "<br>";


        echo'<form action="poistukurssilta.php" method="post">
			 <input type="radio" name = "valinta" value="joo"> Kyllä <br>
		   <input type="radio" name = "valinta" value="ei" selected> En <br>';

        for ($i = 0; $i < count($idt); $i++) {
            echo'<input type="hidden" name="mita[]" value=' . $idt[$i] . '>';
        }

        echo'<br><br><input type="submit" class="myButton9"  role="button"  value="&#10003 Valitse">
			</form>';
    }
    echo'</div>';
    echo'</div>';

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