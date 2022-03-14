<?php
session_start();
ob_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Materiaalit</title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("kurssisivustonheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  class="currentLink">Materiaalit</a>  
	  
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
    }

    if ($_SESSION["Rooli"] == "opiskelija") {
        echo'<nav class="topnav" id="myTopnav">
		 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  class="currentLink">Materiaalit</a>  
		
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
    }

    echo'<div class="cm8-margin-top"></div>';



    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Materiaalit</h2>';

    echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">


 ';

    if (!$haekansio = $db->query("select * from kansiot where kurssi_id='" . $_SESSION["KurssiId"] . "' order by nimi asc")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($haekansio->num_rows != 0) {
        echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
        while ($rowK = $haekansio->fetch_assoc()) {
            $nimi = $rowP[nimi];
            $id = $rowK[id];

            echo'<a href="#' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $nimi . '</a>';
        }

        echo'<div class="cm8-margin-top"></div>';
        if ($_SESSION["Rooli"] <> 'opiskelija') {

            echo'<form action="uusikansio.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää uusi kansio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';

            echo'<form action="tuokansio.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Tuo kansio" class="myButton8"  role="button"  style="padding:2px 4px"></form><br><br>';
        }

        echo'</div>';
    }





    echo' 
 
	
</nav>

 </div>';

    echo'<div class="cm8-quarter" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px">';



    if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {




        if (!$haekansiot = $db->query("select distinct * from kansiot where kurssi_id='" . $_SESSION["KurssiId"] . "' order by id desc")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $jaljella = $haekansiot->num_rows;
        if ($haetiedostot->num_rows != 0) {
            echo'<br><br><form action="lisaaopetiedosto.php" method="post" > <input type="submit" value="&#10000 Lisää tiedosto" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
            while ($rowt = $haetiedostot->fetch_assoc()) {
                echo'<div class="cm8-margin-top"></div>';
                echo'<b>' . $rowt[kuvaus] . '</b><br><br>';
                echo'<a href="avaaopetiedosto.php?id=' . $rowt[id] . '">' . $rowt[omatallennusnimi] . '</a>';

                echo'<form action="poistaopetiedostovarmistus.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $rowt[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="&#10007" title="Poista tiedosto" class="myButton9"  role="button"  style="padding:2px 4px"></form><br><br>';

                $jaljella--;
                if ($jaljella > 0) {


                    echo'<div class="cm8-border-bottom"></div>';
                }
            }
        } else {
            echo'<br><em>Ei lisättyjä tiedostoja.</em><br><br>';
            echo'<br><form action="lisaaopetiedosto.php" method="post" > <input type="submit" value="&#10000 Lisää tiedosto" class="myButton8"  role="button"  style="padding:2px 4px"></form><br><br>';
        }
    } else {

        if (!$haetiedostot = $db->query("select distinct * from tiedostot where kurssi_id='" . $_SESSION["KurssiId"] . "' order by id desc")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $jaljella = $haetiedostot->num_rows;

        if ($haetiedostot->num_rows != 0) {

            while ($rowt = $haetiedostot->fetch_assoc()) {

                echo'<div class="cm8-margin-top"></div>';
                echo'<b>' . $rowt[kuvaus] . '</b><br><br>';
                echo'<a href="avaaopetiedosto.php?id=' . $rowt[id] . '">' . $rowt[omatallennusnimi] . '</a>';
                $jaljella--;
                if ($jaljella > 0) {
                    echo'<div class="cm8-margin-top"></div>';

                    echo'<div class="cm8-border-bottom"></div>';
                }
            }
        } else {
            echo'<br><em>Ei lisättyjä tiedostoja.</em><br>';
        }
    }
    echo'</div>



</div>

</div>';
    echo'</div>';
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

