<?php
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Materiaalit </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (!isset($_SESSION["KurssiId"])) {

    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {




    echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 0px; border: none">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  class="currentLink">Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	 ';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
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
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
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
    echo' <h2>Materiaalit</h2></div>';

    echo'<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px">';
    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px">';
    echo '<nav class="cm8-sidenav " style="padding-top: 20px; margin-top:0px; height: 100%">


  
  
 
	
</nav>

 </div> 
 
<div class="cm8-threequarter" style="padding-top: 0px">';
    if (empty($_GET["lista"])) {
        echo '<p style="font-weight: bold" >Et valinnut kansiota!</p>';
        echo'<br><br><a href="tuokansio2.php?id=' . $_GET[id] . '&kid=' . $_GET[kid] . '"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin';
    } else {
        $lista = $_GET["lista"];



        foreach ($lista as $tuote) {
            if (!$haekansio = $db->query("select distinct * from kansiot where id='" . $tuote . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowk = $haekansio->fetch_assoc()) {

                $db->query("insert into kansiot (kurssi_id, nimi) values('" . $_SESSION[KurssiId] . "', '" . $rowk[nimi] . "')");


                if (!$haeuusin = $db->query("select distinct * from kansiot where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowu = $haeuusin->fetch_assoc()) {
                    $uusinid = $rowu[id];
                }


                if (!$haetiedosto = $db->query("select distinct tiedostot.vanhalinkki as vanhalinkki, tiedostot.upotus as upotus, tiedostot.youtube as youtube, tiedostot.linkki as linkki, tiedostot.nimi as nimi, tiedostot.omatallennusnimi as omatallennusnimi, tiedostot.kuvaus as kuvaus from tiedostot where kansio_id='" . $tuote . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                echo'<br>' . $rowk[nimi] . '  =nimi';
                echo'<br>' . $haetiedosto->num_rows . '  =määrä';

                $maara = 0;
                while ($rowt = $haetiedosto->fetch_assoc()) {
                    $maara++;

                    if ($rowt[linkki] == 0) {

                        $db->query("insert into tiedostot (kansio_id, kuvaus, omatallennusnimi, nimi, tuotu, linkki, vanhalinkki, upotus, youtube) values('" . $uusinid . "', '" . $rowt[kuvaus] . "', '" . $rowt[omatallennusnimi] . "', '" . $rowt[nimi] . "', 1, 0, '" . $rowt[vanhalinkki] . "', '" . $rowt[upotus] . "', '" . $rowt[youtube] . "')");
                    } else {

                        $db->query("insert into tiedostot (kansio_id, kuvaus, omatallennusnimi, nimi, tuotu, linkki, vanhalinkki, upotus, youtube) values('" . $uusinid . "', '" . $rowt[kuvaus] . "', '" . $rowt[omatallennusnimi] . "', '" . $rowt[nimi] . "', 1, 1, '" . $rowt[vanhalinkki] . "', '" . $rowt[upotus] . "', '" . $rowt[youtube] . "')");
                    }
                }
            }
        }

        header("location: tiedostot.php?k=" . $uusinid);
    }




    echo'</div>';
    echo'</div>';
    echo'</div>';
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

</body>
</html>	
