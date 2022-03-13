<?php
session_start(); 



ob_start();




echo'<!DOCTYPE html><html> 
<head>
<title> Tehtävälista</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />';
include("yhteys.php");
include("header.php");



if (!$haeaktit = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($rowp = $haeaktit->fetch_assoc()) {
    $palaute = $rowp[palauteakt];
    $aikataulu = $rowp[aikatauluakt];
    $tavoite = $rowp[tav_akt];
}
if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

if ($hae_eka->num_rows != 0) {
    while ($rivieka = $hae_eka->fetch_assoc()) {
        $eka_id = $rivieka[id];
    }
}
if (!$hae_eka2 = $db->query("select MIN(id) as id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

if ($hae_eka2->num_rows != 0) {
    while ($rivieka2 = $hae_eka2->fetch_assoc()) {
        $eka_id2 = $rivieka2[id];
    }
}


echo'<div class="cm8-half"><br></div>';
echo'<div class="cm8-half">';
echo'<div id="siirto" title="Siirrä kirjaa" style="width: auto; height: auto;z-index: 1;position: fixed !important">';


echo'<div class="cm8-container" id="siirto" style="z-index: 1;position: fixed; background-color: white; padding: 10px; ">';

echo'<h2  style="color: #2b6777">OIKOPOLUT:</h2>';
echo'<br><a href="tiedostot.php" class="cm8-linkki"><b style="font-size: 1.2em">&#10032&nbsp&nbsp </b> <b>Tiedostot</b></a><br>';
echo'<a href="linkit.php" class="cm8-linkki"><b style="font-size: 1.2em">&#10032&nbsp&nbsp </b>  <b>Linkit</b></a><br>';


if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

if ($hae_eka->num_rows == 1) {
    while ($rivieka = $hae_eka->fetch_assoc()) {
        $eka_id = $rivieka[id];
    }
    echo'';
} else {
    echo'';
}

if (!$hae_eka2 = $db->query("select id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

if ($hae_eka2->num_rows == 1) {
    while ($rivieka2 = $hae_eka2->fetch_assoc()) {
        $eka_id2 = $rivieka2[id];
    }
    echo'<br><br><br>';
} else {
    echo'<br><br><br>';
}


//kurssipalaute
echo'<div class="cm8-margin-top"></div>';

if ($palaute == 0) {

    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

        echo'<h2 style="color: #2b6777; font-size: 1em; display: inline-block">KURSSIPALAUTE:</h2>';

        echo' <form action="aktivoipalaute.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikea" value="+" title="Aktivoi kurssipalaute" class="myButton9"  role="button"  style="padding:2px 4px"></form>';


        echo'<br><em style="font-size: 0.8em">Palautteen antoa ei ole aktivoitu.</em><br><br>';
    }
} else {



    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<h2 style="color: #2b6777; font-size: 1em; display: inline-block">KURSSIPALAUTE:</h2>';
        echo' <form action="aktivoipalaute.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikep" title="Peru kurssipalautteen antamismahdollisuus" value="-" class="myButton9"  role="button"  style="padding:2px 4px"></form>';

        if (!$haepalaute = $db->query("select * from palautteet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haepalaute->num_rows != 0) {
            echo'<br><em style="font-size: 0.9em">Olet saanut palautetta. Katso palautteet <a href="palautteet.php"><b>tästä.</b></em></a><br><br>';
        } else {
            echo'<br><em style="font-size: 0.9em">Ei palautteita.</em><br><br>';
        }
    } else {


        echo'<form id="kirja" action="lahetakurssipalaute.php" method="post">
               <h2 style="color: #2b6777; font-size: 1em">KURSSIPALAUTE:</h2>
		<br><textarea name="viesti" rows="6" placeholder="Tähän voit antaa nimettömästi palautetta kurssista/opintojaksosta." style="font-size: 0.9em"></textarea><br><br> 
            <input type="submit" class="myButton9" value="Lähetä">
            
           </form>';
    }
}




echo'
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      <style>
                .ui-widget-header {
            background: #15565f;
      
           
color: #2b6777;
            font-weight: bold;
            width: 20 px;
         }
      </style>';
echo'<script src="toinen.js" language="javascript" type="text/javascript">
</script>';
echo'<div id="myprogress2"></div>';
echo'<div id="myprogress"></div>';
echo'</div></div>';
echo'</div>';




echo'</div>';
echo'</div>';
echo'</div>';





include("kurssiheader.php");
