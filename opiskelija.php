<?php
session_start(); 


ob_start();

echo'<!DOCTYPE html><html> 
<head>
<title> Etusivu </title>
<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    include("header.php");
    include("header2.php");

    echo'<div class="cm8-container7">';
    echo'<nav class="topnavoppilas" id="myTopnav">';
    echo'         <a href="etusivu.php" class="currentLink">Etusivu</a> 
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


    echo' <h4>Cuulis - oppimisympäristö</h4><br>';
    if ($_SESSION[Viimepaiva] != 0) {
        echo'Kirjautunut: &nbsp' . $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"] . '&nbsp | &nbsp Kirjauduit sisään viimeksi: ' . $_SESSION["Viimepaiva"] . ' ' . $_SESSION["Viimekello"] . '&nbsp';
    } else {
        echo'Kirjautunut: &nbsp' . $_SESSION["Etunimi"] . ' ' . $_SESSION["Sukunimi"];
    }
    $paiva_nimi = array(
        "Mon" => "maanantai",
        "Tue" => "tiistai",
        "Wed" => "keskiviikkko",
        "Thu" => "torstai",
        "Fri" => "perjantai",
        "Sat" => "lauantai",
        "Sun" => "sunnuntai"
    );

    $paiva = $paiva_nimi[date("D", time())];
    echo '<br><br>Tänään on ' . $paiva . ' ' . date("j.n.Y") . '. Kello on <div id="timeDiv" style="display:inline-block"></div><script language="javascript" type="text/javascript">
	startclock();
</script>.';
    echo'</div></div>';

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




