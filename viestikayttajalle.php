<?php
session_start();
ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>

<title>Lähetä viesti</title>';

include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
//TULEE SEKÄ GET ja POST

if (isset($_SESSION["Kayttajatunnus"])) {

    if ($_GET[url] == "osallistujat.php" || $_GET[url] == "lisaaopiskelijaeka.php" || $_GET[url] == "lisaaopettajaeka.php" || strpos($_POST[url], "osallistujat.php") !== false || strpos($_POST[url], "lisaaopiskelijaeka.php") !== false || strpos($_POST[url], "lisaaopettajaeka.php") !== false) {
        include("kurssisivustonheader.php");
        echo'<div class="cm8-container7">';
        echo'<nav class="topnav" id="myTopnav">';

        echo'<a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	   
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a>';


        echo' <a href="ryhmatyot.php">Palautukset</a>';


        echo'<a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>';

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
	  ';

        echo' <a href="osallistujat.php"  class="currentLink">Osallistujat</a>';



        echo' <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
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
    } else if ($_GET[url] == "ryhmatyot.php" || strpos($_POST[url], "ryhmatyot.php") !== false) {
        include("kurssisivustonheader.php");
        echo'<div class="cm8-container7">';
        echo'<nav class="topnav" id="myTopnav">';

        echo'<a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	   
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a>';


        echo' <a href="ryhmatyot.php"  class="currentLink">Palautukset</a>';


        echo'<a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>';

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
	  ';

        echo' <a href="osallistujat.php" >Osallistujat</a>';



        echo' <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
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
    } else {

        include("header.php");
        include("header2.php");
        echo'<div class="cm8-container7">';
        if ($_SESSION["Rooli"] == 'admin')
            include("adminnavi.php");
        else if ($_SESSION["Rooli"] == 'admink')
            include("adminknavi.php");
        else if ($_SESSION["Rooli"] == 'opeadmin')
            include("opeadminnavi.php");
        else
            include ("opnavi.php");
    }





    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';

    echo'<div class="cm8-half" style="padding-top: 10px; padding-left: 20px">';
if (isset($_GET["id"])) {

        if (!$result = $db->query("select * from kayttajat where id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($row = $result->fetch_assoc()) {
            $nimi = $row[etunimi] . " " . $row[sukunimi];
            $spostiv = $row[sposti];
        }

        echo'<form action="lahetaviestiyksilollinen.php" class="form-style-k" method="post"><fieldset>';
        echo' <legend>Lähetä viesti käyttäjälle ' . $nimi . '</legend>';
        

        if ($_GET[url] == "kayttaja.php") {
            echo'<a href="kayttaja.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        } else if ($_GET[url] == "kayttajateivahvistetut.php") {
            echo'<a href="kayttajateivahvistetut.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        } else if ($_GET[url] == "kayttajatkaikki.php") {
            echo'<a href="kayttajatkaikki.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        } else if ($_GET[url] == "kayttajatmuut.php") {
            echo'<a href="kayttajatmuut.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        } else if ($_GET[url] == "kayttajatopettajat.php") {
            echo'<a href="kayttajatopettajat.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        } else if ($_GET[url] == "kayttajatopiskelijat.php") {
            echo'<a href="kayttajatopiskelijat.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        } else if ($_GET[url] == "kayttajatvahvistus.php") {
            echo'<a href="kayttajatvahvistus.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        } else if ($_GET[url] == "kurssit.php") {
            echo'<a href="kurssit.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        } else if ($_GET[url] == "kurssitkaikki.php") {
            echo'<a href="kurssitkaikki.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        } else if ($_GET[url] == "lisaaopiskelijaeka.php") {
            echo'<a href="lisaaopiskelijaeka.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        } else if ($_GET[url] == "lisaaopettajaeka.php") {
            echo'<a href="lisaaopettajaeka.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        } else {
            echo'<br>';
        }
        if (isset($_GET[url])) {
            $mihin = $_GET[url];
        } else if (isset($_POST[url])) {
            $mihin = $_POST[url];
        }


        echo'<br><p style="font-weight: normal"><b>Lähettäjän nimi:</b>&nbsp&nbsp&nbsp <input type="hidden" name="nimi" value="' . $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"] . '"> ' . $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"] . ' </p>
				<br><p style="font-weight: normal"><b>Lähettäjän käyttäjätunnus:</b> &nbsp&nbsp&nbsp<input type="hidden" size="30" name="sposti" value=' . $_SESSION["Sposti"] . '> ' . $_SESSION["Sposti"] . ' </p> 	
	<br><p style="font-weight: normal"><b>Vastaanottajan nimi:</b> &nbsp&nbsp&nbsp ' . $nimi . ' </p>';

        if ($_SESSION[Rooli] == 'admin' || $_SESSION[Rooli] == 'admink' || $_SESSION[Rooli] == 'opeadmin') {
            echo'<br><p style="font-weight: normal"><b>Vastaanottajan sähköpostiosoite:</b> &nbsp&nbsp&nbsp ' . $spostiv . ' </p>';
        }
echo'<br><p style="font-weight: bold; color: #e608b8">Huom! Laita viestiin sähköpostiosoitteesi, jos haluat siihen vastauksen.</p>';
        echo'<br><p><b> Viesti: </b><br><textarea name="viesti" rows="8" style="width: 80%"></textarea></p> <br><br> 
                                  <input type="hidden" name="id" value=' . $_GET[id] . '>
                                         <input type="hidden" name="url" value=' . $_GET[url] . '> 
	<input type="submit" value="📧 &nbsp Lähetä" style="padding-bottom: 5px" >';
        echo '</fieldset></form></div></div>';
    }
    else{
      header("location: etusivu.php");  
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
<