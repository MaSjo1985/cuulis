<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Tuo aikataulu</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("kurssisivustonheader.php");



        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';


        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '" class="currentLink">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
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


        echo'<div class="cm8-container3" style="padding-top: 30px;" >';






        if (!$haekurssi = $db->query("select distinct nimi, koodi from kurssit where id='" . $_GET["id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rivi = $haekurssi->fetch_assoc()) {
            $koodi = $rivi[koodi];
            $nimi = $rivi[nimi];
        }

        echo'<br><h6 style="padding-top: 0px; padding-bottom: 20px; font-size: 1.3em; color: #2b6777; display: inline-block">Tuo aikataulu kurssista/opintojaksosta ' . $koodi . ' ' . $nimi . ' </h6>';

        echo'<br><a href="tuoaikataulu.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';

          if (!$haeaikataulu = $db->query("select distinct * from kurssiaikataulut where kurssi_id='" . $_GET[id] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        
        if($haeaikataulu->num_rows!=0){
                  if (!$haevika = $db->query("select distinct MAX(jarjestys) as jarjestys from kurssiaikataulut where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }




        echo'<br><form action="tuoaikataulu3.php" method="post">';


        echo'<div style="margin: 0px; padding: 0px; ">';
        if ($haevika->num_rows != 0) {
            echo'<p id="ohje">Kurssiaikataulu lisätään olemassa olevan aikataulun loppuun.</p><br>';
        }
        echo'<input type="submit" value="&#10003 Valitse" class="myButton9"  role="button"  style="padding:2px 4px; font-size: 0.9em"><br><br>';
        echo'</div>';
        echo'<div class="cm8-responsive"  >';
        echo '<table id="mytable" class="cm8-uusitable" >  <thead>';

        //Tää pitää piilottaa, jos ei oo
        
        echo '<tr style="border: 1px solid grey; background-color: #48E5DA" id="palaa"><th style="border: 1px solid grey">Ajankohta</th><th style="border: 1px solid grey ">Aihe</th><th style=" border: 1px solid grey">Lisätietoja</th></tr></thead><tbody>';

      

        while ($rowt = $haeaikataulu->fetch_assoc()) {

            echo '<tr style="font-size: 0.9em; border: 1px solid grey"><td style=" border-left: 2px solid grey">' . $rowt[aika] . '</td><td style="border: 1px solid grey">' . $rowt[aihe] . '</td><td style=" border: 1px solid grey">' . $rowt[lisa] . '</td></tr>';
        }

        echo "</tbody></table>";
        ?>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
        <script>
            var $table = $('#mytable');

            $table.floatThead({zIndex: 1});

        </script>        
        <?php
session_start();
        echo"</div>";










        echo'<input type="hidden" name="kurssi_id" value=' . $_GET[id] . '>';
        echo'<br><br><div>';

        echo'<input type="submit" value="&#10003 Valitse" class="myButton9"  role="button"  style="padding:2px 4px; font-size: 0.9em">';
        echo'</div>';

        echo'</form>';
        }
        else{
            echo'<br><br><p style="color: #e608b8; font-weight: bold;">Kurssilla/opintojaksolla ei ole aikataulua.</p>';
        }
  
        echo'</div>';

        echo'</div>';
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