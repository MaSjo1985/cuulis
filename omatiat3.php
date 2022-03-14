<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Oma itsearviointilomake </title>';


include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

     if(isset($_GET[kurssi])){
        if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}


    include("kurssisivustonheader.php");

    include "libchart/libchart/classes/libchart.php";

    echo '<div class="cm8-container7" id="paluu" style="margin-top: 0px; padding-top:0px; padding-bottom: 30px; margin-bottom: 0px; ">';

    echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a>
          <a href="ia.php"  class="currentLink" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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


    echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 20px; padding-right: 20px; border: none">';

    }
    else{
          include("header.php");
    include("header2.php");

    echo'<div class="cm8-container7">';
    echo'<nav class="topnavoppilas" id="myTopnav">';
    echo'         <a href="etusivu.php" >Etusivu</a> 
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
<a href="omatkurssit.php" >Omat kurssit/opintojaksot</a>
<a href="kurssit.php" >Kaikki kurssit/opintojaksot</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>

<div class="cm8-margin-bottom" style="padding-left: 20px">';  
    }
    if (!$haekurssi = $db->query("select distinct * from kurssit where id='" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($rowP = $haekurssi->fetch_assoc()) {

        $nimi = $rowP[nimi];
        $koodi = $rowP[koodi];
    }
    echo' <h4 style="color: #48E5DA">Itsearviointilomake kurssilta/opintojaksolta &nbsp ' . $koodi . ' ' . $nimi . '</h4>';

    if(isset($_GET[kurssi])){
          echo'<a href="omatiat.php?kurssi=1" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br><br>';
    }
    else{
          echo'<a href="omatiat.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br><br>';
    }
    echo'<div class="cm8-responsive" style="margin: 0px; padding: 10px 0px 0px 0px; overflow-y: hidden">';

    if (!$onkoprojekti = $db->query("select * from kurssit where id='" . $_GET[id] . "' AND itsearviointi=1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    if ($onkoprojekti->num_rows == 0) {



        echo'<p id="ohje">Ei itsearviointilomaketta</p><br><br>';
    } else {

        if (!$haearvioinnit = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_GET[id] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        if (!$haearvioinnit8 = $db->query("select distinct * from itsearvioinnit_pisteet where kurssi_id='" . $_GET[id] . "' AND kayttaja_id='" . $_SESSION[Id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowkpp = $haearvioinnit8->fetch_assoc()) {

            $pisteet8 = $rowkpp[pisteet];
            $opetallennus2 = $rowkpp[opetallennus2];
        }
        if ($haearvioinnit8->num_rows != 0 && $opetallennus2 != 0) {
            echo'<button type="button" class="btn btn-info btn-lg btn-radius" style="margin-bottom: 20px; padding: 10px 20px; text-transform: none; font-size: 0.9em" >Olet saanut itsearviointilomakkeesta ' . $pisteet8 . ' pistettä </button>';
        }


        echo'<div class="cm8-responsive" style="overflow-y: hidden">';

        echo'<div class="cm8-responsive">';
        echo '<br><table id="mytable2" class="cm8-tableoppilas"><thead>';

        echo '</thead><tbody>';


        while ($rowt = $haearvioinnit->fetch_assoc()) {

            if (!$haekp = $db->query("select distinct * from itsearvioinnitkp where itsearvioinnit_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'"
                    . " AND id IN (select MIN(id) from itsearvioinnitkp where itsearvioinnit_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "')")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($rowt[aihe] == 1)
                echo '<tr class="iaihe2"><td style="padding: 6px 8px;"><b>' . $rowt[otsikko] . '</b></td><td style=" padding: 6px 8px; text-align:center">Opettajan kommentti</td></tr>';
            else if ($rowt[valiaihe] == 1)
                echo '<tr class="ivaliaihe2"><td style="padding: 6px 8px;"><b>' . $rowt[otsikko] . '</b></td><td style="padding: 6px 8px;"></td></tr>';

            else {

                while ($rowkp = $haekp->fetch_assoc()) {




                    echo '<tr id="' . $rowt[id] . '" " class="osisalto"><td>' . $rowkp[teksti] . '</td><td>' . $rowkp[kommentti] . '</td></tr>';
                }
            }
        }

        echo "</tbody></table>";
        ?>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
        <script>
            var $table = $('#mytable2');

            $table.floatThead({zIndex: 1});

        </script>        
        <?php
session_start(); 


        ob_start();
    }

    echo'</div>';
    echo'</div>';
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




