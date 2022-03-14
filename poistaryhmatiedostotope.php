<?php
session_start();
ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Palvelimella olevat tiedostot </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    include("header.php");
    include("header2.php");


    echo'<div class="cm8-container7" style="padding-top: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 60px">';
    if ($_SESSION["Rooli"] == "admin") {
        echo'<nav class="topnavoppilas" id="myTopnav">';
        echo'<a href="etusivu.php">Etusivu</a>          
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
<a href="oppilaitokset.php" >Oppilaitokset</a>
<a href="kayttajatvahvistus.php" >Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="kaikkitiedostot.php style="margin-bottom: 5px"  class="currentLink">Palvelimella olevat tiedostot</a><a href="arvostelut.php">Arvostelut</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
    }

    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';

    echo'<div class="cm8-margin-top"></div>';
    if ($_POST["valinta"] == "ei") {

        header("location: kaikkitiedostot.php");
    } else {

        $lista = $_POST["mita"];

        foreach ($lista as $tuote) {

            if (!$result = $db->query("select distinct * from ryhmatope where id = '" . $tuote . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row = $result->fetch_assoc()) {
                $nimi = $row[tallennettunimi];
                $linkki = $row[linkki];
            }
            if ($linkki == 1) {
                $db->query("delete from ryhmatope where id = '" . $tuote . "'");
            } else {
                if (file_exists($nimi)) {
                    unlink($nimi);
                }

                $db->query("delete from ryhmatope where id = '" . $tuote . "'");
            }
        }

       echo'<br><b style="color: #e608b8;">Valitut tiedostot on nyt poistettu.</b><br><br>';


        echo' <a href="kaikkitiedostot.php style="margin-bottom: 5px"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
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
</html>	