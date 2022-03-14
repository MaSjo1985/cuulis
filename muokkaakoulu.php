<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Oppilaitos </title>';

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
        echo'<div class="cm8-container3" >';


        if (isset($_GET[id])) {

            $kouluid = $_GET[id];
        } else {

            $kouluid = $_SESSION[kouluId];
        }



        if (!$result = $db->query("select distinct * from koulut where id = '" . $kouluid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row2 = $result->fetch_assoc()) {


            echo '<div class="cm8-half" style="padding-left: 0px"><p style="margin-top: 0px;font-size: 1.2em; font-weight: bold; padding-top: 10px; display: inline-block" >' . $row2[Nimi] . '</p>';





            if ($_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {
                echo'<form action="muokkaaopnimi.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $kouluid . '> <input type="submit" value="&#9998 Muokkaa nimeä" title="Muokkaa nimeä" class="myButton9"  role="button"  style="padding:2px 4px"></form>';
                if ($_SESSION[Rooli] == 'admin') {
                    echo'<br><a href="oppilaitokset.php" style="font-size: 0.9em"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 10px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';
                }
                echo'<div class="cm8-margin-top"></div>';
                echo'<p style="font-weight: bold; display: inline-block">Ylläpitäjät:</p>';
                echo'<form action="uusikouluadmineka.php" method="post" style="display: inline-block; margin-left: 30px"><input type="hidden" name="koid" value=' . $kouluid . '><input type="submit" value="+ Lisää ylläpitäjä" title="+ Lisää ylläpitäjä" class="myButton9"  role="button"  style="padding:4px 6px; font-size: 0.7em"></form>';
                echo'<br>';
                if (!$result2 = $db->query("select distinct koulunadminit.koulu_id as kid, kayttajat.id as kaid, etunimi,sukunimi from kayttajat, koulunadminit where koulunadminit.koulu_id='" . $row2[id] . "' AND koulunadminit.kayttaja_id=kayttajat.id")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($result2->num_rows == 0)
                    echo'<p>Ei merkittyjä ylläpitäjiä</p>';
                else {

                    echo'<div class="cm8-responsive" style="padding-top: 10px">';
                    echo '<table class="cm8-table6">';


                    if ($_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {
                        while ($row8 = $result2->fetch_assoc()) {

                            if ($row8[kaid] == $_SESSION[Id]) {
                                echo'<tr><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row8[kaid] . '">' . $row8[etunimi] . ' ' . $row8[sukunimi] . '</a></td><td></td></tr>';
                            } else {
                                echo'<tr><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row8[kaid] . '">' . $row8[etunimi] . ' ' . $row8[sukunimi] . '</a></td><td><a href="poistakouluadmin.php?kaid=' . $row8[kaid] . '&koid=' . $kouluid . '"  class="myButton9"  role="button"  title="Poista ylläpitäjän roolista" style="margin-bottom: 0px; padding: 0px 2px; font-size: 0.8em">&#10007 Poista</a></td></tr>';
                            }
                        }
                    } else {
                        while ($row8 = $result2->fetch_assoc()) {
                            echo'<tr><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row8[kaid] . '"> ' . $row8[etunimi] . ' ' . $row8[sukunimi] . '</a></td></tr>';
                        }
                    }




                    echo "</table>";
                    echo'</div>';
                }
            }
            echo'</div>';
            echo'<div class="cm8-half" style="padding-left: 0px; display: inline-block"><img src="/' . $row2[kuva] . '" style="max-width: 25%; max-height: 25%; padding-top: 10px">';
            if ($_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {

                echo'<br><form action="muokkaaoplogo.php" method="post" style="display: inline-block; margin-top: 10px"><input type="hidden" name="id" value=' . $kouluid . '> <input type="submit" value="&#9998 Muokkaa logoa" title="Muokkaa logoa" class="myButton9"  role="button"  style="padding:2px 4px"></form>';
            }
            echo'</div>';

            echo'</div>';
        }



        echo'</div>';
        echo'</div>';

        include("footer.php");
    } else {
        header("location: etusivu.php");
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
