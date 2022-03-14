<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Itsearviointilomakkeen muokkaus</title>
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
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a>
          <a href="itsearviointi.php"  class="currentLink" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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








        echo'<div class="cm8-margin-top"></div>';

        if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka->num_rows != 0) {
            while ($rivieka = $hae_eka->fetch_assoc()) {
                $eka_id = $rivieka[id];
            }
        }
        echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px"><br></h2>

      



 </div> 
 
<div class="cm8-twothird" style="padding-top: 0px; margin-top: 0px">';
        if (!$haekurssi = $db->query("select distinct * from kurssit where id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }




        while ($rowk = $haekurssi->fetch_assoc()) {
            $nimi = $rowk[nimi];
            $koodi = $rowk[koodi];
        }

        echo'<br><h6 style="padding-top: 0px; padding-bottom: 20px; font-size: 1.3em; color: #2b6777">Tuo itsearviointilomake</h6>';




        echo'<a href="tuolomake.php?id=' . $_GET[ipid] . '&monesko=' . $_GET[monesko] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';

        echo'<div class="cm8-margin-top"></div>';



        if (!$haeuusiprojekti = $db->query("select * from itsearvioinnit where kurssi_id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeuusiprojekti->num_rows == 0) {

            echo'<br><em>Kurssilla ei ole valmista itsearviointilomaketta.</em><br>';
        } else {




            echo'<form action="tuolomake2.php" method="post">';





            $ipiduusi = $rowP2[id];


            if (!$haetehtavat = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_GET[id] . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            echo'<div class="cm8-responsive">';
            echo'<input type="submit" value="&#10003 Valitse" class="myButton9"  role="button"  style="padding:2px 4px; margin: 4px; font-size: 0.9em"><br><br>';


            echo '<table  class="cm8-uusitableia" style="table-layout:fixed; max-width: 100%;"> ';


            while ($rowt = $haetehtavat->fetch_assoc()) {

                if ($rowt[aihe] == 1) {

                    echo '<tr class="iaihe2"><td>' . $rowt[otsikko] . '</td></tr>';
                } else if ($rowt[valiaihe] == 1) {

                    echo '<tr class="ivaliaihe2"><td>' . $rowt[otsikko] . '</td></tr>';
                } else {
                    echo '<tr class="isisalto2"><td>' . $rowt[sisalto] . '</td></tr>';
                }
            }

            echo "</table></div>";



            echo'<div class="cm8-margin-top"></div>';
            echo'<input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '>';
            echo'<input type="hidden" name="monesko" value=' . $_GET[monesko] . '>';
            echo'<input type="hidden" name="kurssi" value=' . $_GET[id] . '>';
            echo'<input type="submit" value="&#10003 Valitse" class="myButton9"  role="button"  style="padding:2px 4px; font-size: 0.9em">';
            echo'</form>';
        }



        echo'</div>





</div>';
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