<?php
session_start(); 


ob_start();

echo'<!DOCTYPE html>
<html>
 
<head>

<title>Viesti lähetetty </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

  
        if ($_GET[url]=='osallistujat.php' || $_GET[url]=='lisaaopettajaeka.php') {
            include("kurssisivustonheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; padding-bottom: 30px">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">';

        echo'<a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	   
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a>';


        if ($_GET[url] == "ryhmatyot.php") {
            echo' <a href="ryhmatyot.php"  class="currentLink">Palautukset</a>';
        } else {
            echo' <a href="ryhmatyot.php">Palautukset</a>';
        }

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

        if ($_GET[url] == "osallistujat.php") {
            echo' <a href="osallistujat.php"  class="currentLink">Osallistujat</a>';
        } else {
            echo' <a href="osallistujat.php"  class="currentLink">Osallistujat</a>  ';
        }



        echo'   <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
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
    }

    if ($_SESSION["Rooli"] == "opiskelija") {
        echo'<nav class="topnav" id="myTopnav">';

        echo'<a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	   
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a>';


        if ($_GET[url] == "ryhmatyot.php") {
            echo' <a href="ryhmatyot.php"  class="currentLink">Palautukset</a>';
        } else {
            echo' <a href="ryhmatyot.php">Palautukset</a>';
        }

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

        if ($_GET[url] == "osallistujat.php") {
            echo' <a href="osallistujat.php"  class="currentLink">Osallistujat</a>';
        } else {
            echo' <a href="osallistujat.php"  class="currentLink">Osallistujat</a>  ';
        }


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
    }
    }
    else{
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

    echo '<div class="cm8-container7"  style="padding-left: 40px; padding-top:20px; border: none" >';
    echo'<div class="cm8-margin-top"></div>';




    echo '<p style="font-weight: bold; color: #e608b8;">Viestisi on lähetetty!</p>';

    if ($_GET[url]=='osallistujat.php' || $_GET[url]=='lisaaopettajaeka.php') {
        echo'<a href="osallistujat.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
   }
   else if ($_GET[url]=='kurssit.php') {
        echo'<a href="kurssit.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
       
   }
     else if ($_GET[url]=='omatkurssit.php') {
        echo'<a href="omatkurssit.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
       
   }
   else if ($_GET[url]=='kurssitkaikki.php') {
        echo'<a href="kurssitkaikki.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
       
   }
      else if ($_GET[url]=='kayttajatkaikki.php') {
        echo'<a href="kayttajatkaikki.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
       
   }
    else if ($_GET[url]=='kayttajatvahvistus.php') {
        echo'<a href="kayttajatvahvistus.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
       
   }
     else if ($_GET[url]=='kayttajatopettajat.php') {
        echo'<a href="kayttajatopettajat.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
       
   }
           
   


    echo'</div>';
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
</html>	