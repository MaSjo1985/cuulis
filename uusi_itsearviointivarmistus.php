<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Itsearviointilomakkeen muokkaus </title>';

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


        echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px"><br></h2>

      



 </div> ';
        echo'<div class="cm8-twothird" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px">';

        if (!$haeid = $db->query("select distinct id from itsearvioinnit where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $onko = 0;
        while ($rowt = $haeid->fetch_assoc()) {
            $id = $rowt[id];

            if (!$haeonko = $db->query("select distinct id from itsearvioinnitkp where itsearvioinnit_id='" . $id . "' AND teksti<>''")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($haeonko->num_rows != 0) {
                $loyty = 1;
            }
        }


        if ($loyty == 1) {
            echo '<p style="font-weight: bold; color: #e608b8" >Lomakkeeseen on tullut jo vastauksia.</p>';
            echo '<p style="font-weight: bold; color: #e608b8" >Annettuja vastauksia ei poisteta, kun muokkaat lomaketta, mikä voi vääristää vastausten tarkastelua.</p>';

            echo'<div class="cm8-responsive" style="display: inline-block; margin-right: 100px; margin-top: 0px; padding:0px">';
            echo '<p style="margin-top: 0px; padding-top: 0px;font-weight: bold;" >Haluatko silti muokata lomaketta?</p>';



            echo '<a href="uusi_itsearviointi.php" class="myButton9"  role="button"  style="margin-right: 30px">Kyllä</a>';
            echo '<a href="itsearviointi.php" class="myButton9"  role="button"  style="margin-right: 30px">En</a><br>';

            echo'</div>';
            echo'<div class="cm8-responsive" style="display: inline-block; margin: 0px; padding: 0px">';
            echo '<p style="font-weight: bold;" >Tai voit ensin tarkastella annettuja vastauksia: </p>';

            echo'<form action="tarkastelearvioinnit.php" method="get" style="display: inline-block"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" style="font-size: 0.8em; padding: 4px 6px" title="Tarkastele opiskelijoiden lomakkeita" value="🕵 Tarkastele opiskelijoiden lomakkeita" class="myButton8"  role="button" ></form>';

            echo'</div>';
        } else {
            header("location: uusi_itsearviointi");
        }







        echo'</div>
    
</div></div>';
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";

include("footer.php");
?>

</body>
</html>			