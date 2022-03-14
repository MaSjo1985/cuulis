<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Muokkaa oppilaitoksen logoa </title>';

include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("header.php");
        include("header2.php");

        echo'<div class="cm8-container7">';
        if ($_SESSION["Rooli"] == 'admin') {
            include("etuosan_navit.php");
            tuoAdminNavi("Oma oppilaitos");
        } else if ($_SESSION["Rooli"] == 'admink') {
            echo'<nav class="topnavoppilas" id="myTopnav">';
            echo'<a href="etusivu.php" >Etusivu</a>          
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
<a href="kayttajatvahvistus.php" >Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" class="currentLink">Oma oppilaitos</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        } else if ($_SESSION["Rooli"] == "opeadmin") {
            echo'<nav class="topnavOpe" id="myTopnav">';
            echo'<a href="etusivu.php"  >Etusivu</a>         
<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
    if (x.className === "topnavOpe") {
  
        x.className += " responsive";
        
       
    } else {
  
        x.className = "topnavOpe";
      
    }
     
}
</script>
<a href="omatkurssit.php" >Omat kurssit/opintojaksot</a>
<a href="kurssitkaikki.php" >Kaikki kurssit/opintojaksot</a>
<a href="kayttajatvahvistus.php" >Käyttäjät &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="kurssit.php">Kurssit/Opintojaksot &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" class="currentLink">Oppilaitos &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)">  
    <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        } else
            include("opnavi.php");
        echo'<div class="cm8-container3" style="padding-top:40px; margin-top: 0px" >';
        echo'<div class="cm8-half" >';

        require_once("kuvaupload.php");




        // Esimerkki: Tarkistetaan, että tiedosto on lähetetty ja että se on kooltaan
        // enintään 5,0 megatavua. Käsitellään myös virheilmoitus.

        try {
            $nimi = upload_tarkista("uusilogo", 5.0 * 1024 * 1024);
        } catch (UploadException $e) {

            die('<b style="font-size: 1em; color: #FF0000">' . $e->getMessage() . '</b><br><br><a href="muokkaaoplogo.php?id=' . $_POST[id] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        // echo("Tarkistus onnistui. Tiedoston nimeksi ilmoitettiin {$nimi}.\n");
        if (!$result = $db->query("select distinct * from koulut where id = '" . $_POST[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row = $result->fetch_assoc()) {
            $nimi = $row[kuva];
        }



        if (file_exists($nimi)) {
            unlink($nimi);
        }



        // Esimerkki: Tarkistetaan tiedoston pääte ja yritetään tallentaa se palvelimelle.
        // Funktion toinen parametri on tallennushakemisto, "." tarkoittaa tätä hakemistoa.
        // HUOMIO! Virhettä ei tässä erikseen käsitellä.

        try {
            list($vanha, $nimi) = upload_tallenna_turvallinen("uusilogo", "images", array(".jpg", ".gif", ".png", ".jpeg", ".JPG", ".GIF", ".PNG", ".JPEG"));
        } catch (UploadException $e) {

            die('<b style="font-size: 1em; color: #FF0000">' . $e->getMessage() . '</b><br><br><a href="muokkaaoplogo.php?id=' . $_POST[id] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        $db->query("update koulut set kuva='" . $nimi . "' where id = '" . $_POST["id"] . "'");

        header("location: muokkaaoppilaitoslogo2.php?id=" . $_POST[id]);


        echo "</div>";
        echo "</div>";
        echo "</div>";

        include("footer.php");
    }
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
