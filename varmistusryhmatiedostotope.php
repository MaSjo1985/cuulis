<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Palvelimella olevat tiedostot </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "admin") {
        include("header.php");
        include("header2.php");


        echo'<div class="cm8-container7" style="padding-top: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 60px">';

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
<a href="kayttajatvahvistus.php" >Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="kaikkitiedostot.php style="margin-bottom: 5px" class="currentLink">Palvelimella olevat tiedostot</a><a href="arvostelut.php">Arvostelut</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';

        echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
        echo'<div class="cm8-margin-top"></div>';
        echo'<h6 style="text-decoration: underline">Opettajan ryhmiin lisäämät tiedostot:</h6>';
        echo'<div class="cm8-margin-top"></div>';
        if (empty($_POST["lista"])) {
            echo '<p style="font-weight: bold" >Et valinnut yhtään tiedostoa!</p>';
            echo'<br><br><a href="kaikkitiedostot.php style="margin-bottom: 5px"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin';
        } else {
            $lista = $_POST["lista"];
            $idt = $_POST["lista"];
            echo '<p style="font-weight: bold" >Haluatko todella poistaa seuraavat tiedostot?</p>';

            foreach ($lista as $tuote) {

                if (!$result2 = $db->query("select distinct omatallennusnimi, lisayspvm, kurssit.nimi as nimi, ryhmatope.id as tid from kurssit, ryhmatope, projektit where kurssit.id=projektit.kurssi_id AND ryhmatope.projekti_id=projektit.id AND ryhmatope.id = '" . $tuote . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($row2 = $result2->fetch_assoc()) {
                    $nimi = $row2[omatallennusnimi];
                    $id = $row2[tid];
                }
                echo "<br>" . $nimi;
            }
            echo "<br>";
            echo "<br>";


            echo'<form action="poistaryhmatiedostotope.php" method="post">
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
