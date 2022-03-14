<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Materiaalit </title>';

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
        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
            echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  class="currentLink">Materiaalit</a>  
	  
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
        }



        echo'<div <div class="cm8-third" style="padding-left: 20px;width: 25%; margin-right: 40px; margin-top: 40px; padding-top: 0px "> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Materiaalit</h2>';

        echo '<nav class="cm8-sidenav " style="margin-left: 0px;padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">';


        if (!$haekansio = $db->query("select * from kansiot where kurssi_id='" . $_SESSION["KurssiId"] . "' order by nimi asc")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haekansio->num_rows != 0) {

            $numeric1 = 0;
            $numeric3 = 0;
            while ($rowekak = $haekansio->fetch_assoc()) {
                $id = $rowekak[id];
                $nimi = $rowekak[nimi];
                if (is_numeric($rest = substr($nimi, 0, 1))) {

                    $numeric1 = 1;
                } else if (is_numeric($rest = substr($nimi, 0, 3))) {

                    $numeric3 = 1;
                }
            }

            if ($numeric1 == 1) {

                if ($numeric3 == 1) {

                    if (!$haekansio = $db->query("select distinct * from kansiot where kurssi_id='" . $_SESSION[KurssiId] . "' order by  SUBSTR(nimi FROM 1 FOR 1),
    CAST(SUBSTR(nimi FROM 3) AS UNSIGNED)")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                } else {
                    if (!$haekansio = $db->query("select distinct * from kansiot where kurssi_id='" . $_SESSION[KurssiId] . "' order by cast(nimi as unsigned) asc")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                }
            } else {
                if (!$haekansio = $db->query("select distinct * from kansiot where kurssi_id='" . $_SESSION[KurssiId] . "' order by nimi")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
            }
            echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
            while ($rowK = $haekansio->fetch_assoc()) {
                $nimi = $rowK[nimi];
                $id = $rowK[id];

                if ($id == $_GET[kid]) {
                    echo'<a href="tiedostot.php?k=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">&#128194 &nbsp ' . $nimi . '</a>';
                } else {

                    echo'<a href="tiedostot.php?k=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">&#128193 &nbsp ' . $nimi . '</a>';
                }
            }

            echo'<div class="cm8-margin-top"></div>';


            echo'</div>';
        }




        echo' 
 
	
</nav>

 </div>

     <div id="content" class="cm8-twothird" style="padding-left: 20px; margin-right: 0px; margin-top: 40px; margin-bottom: 0px; padding-bottom: 10px">';
        
        echo'<h8>Tuo tiedostoja/linkkejä toisesta kurssista/opintojaksosta</h8><br><br><a href="tuoopetiedosto.php?kid=' . $_GET[kid] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';

        if (!$haetiedostot = $db->query("select tiedostot.omatallennusnimi as omatallennusnimi,tiedostot.linkki as linkki, tiedostot.kuvaus as kuvaus, tiedostot.id as id from kansiot, tiedostot where kansiot.kurssi_id='" . $_GET[id] . "' AND tiedostot.kansio_id=kansiot.id order by omatallennusnimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haetiedostot->num_rows == 0) {

            echo'<p id="ohje"><b style="font-size: 1.1em">Kurssille ei ole lisätty tiedostoja</b></p>';

        } else {
            echo'<p id="ohje"><b style="font-size: 1.1em">Valitse, mitkä tiedostot/linkit haluat tuoda.</b></p>';

            $jaljella = $haetiedostot->num_rows;
            echo'<div class="cm8-margin-top"></div>';
            echo'<form action="tuoopetiedosto3.php" method="get">';
            echo'<div class="cm8-responsive">';
            echo '<table class="cm8-table cm8-bordered cm8-stripedeivikaa">';

            if ($_GET[kaikki2] == joo) {
                echo '<tr style="font-size: 1.1em; border: 1px solid grey; background-color: #48E5DA"><th><a href="tuoopetiedosto2.php?id=' . $_GET[id] . '&kid=' . $_GET[kid] . '"  style="font-size: 0.9em"> Tyhjennä<br>valinnat<br>&nbsp&#9661&nbsp</a></th><th>Tiedosto</th></tr>';



                while ($rowP2 = $haetiedostot->fetch_assoc()) {

                    $ipiduusi = $rowP2[id];





                    if ($rowP2[linkki] == 1) {
                        echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $ipiduusi . ' checked></td><td><a href="' . $rowP2[kuvaus] . '" target="_blank">' . $rowP2[omatallennusnimi] . '</a></td></tr>';
                    } else {
                        echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $ipiduusi . ' checked></td><td><a href="avaaopetiedosto.php?id=' . $rowP2[id] . '"  target="_blank">' . $rowP2[omatallennusnimi] . '</a></td></tr>';
                    }





                    $jaljella--;
                    if ($jaljella == 0) {
                        echo "</table></div>";
                    }
                }
            } else {

                echo '<tr style="font-size: 1.1em; border: 1px solid grey; background-color: #48E5DA"><th><a href="tuoopetiedosto2.php?id=' . $_GET[id] . '&kid=' . $_GET[kid] . '&kaikki2=joo" style="font-size: 0.9em"> Valitse<br>kaikki<br>&nbsp&#9661&nbsp</a></th><th>Tiedosto</th></tr>';



                while ($rowP2 = $haetiedostot->fetch_assoc()) {

                    $ipiduusi = $rowP2[id];




                    if ($rowP2[linkki] == 1) {
                        if ($rowP2[kuvaus] != '') {
                            echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $ipiduusi . '></td><td><a href="' . $rowP2[kuvaus] . '" target="_blank">' . $rowP2[omatallennusnimi] . '</a></td></tr>';
                        } else {
                            echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $ipiduusi . '></td><td><a href="' . $rowP2[kuvaus] . '" target="_blank">' . $rowP2[kuvaus] . '</a></td></tr>';
                        }
                    } else {
                        echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $ipiduusi . '></td><td><a href="avaaopetiedosto.php?id=' . $rowP2[id] . '"  target="_blank">' . $rowP2[omatallennusnimi] . '</a></td></tr>';
                    }






                    $jaljella--;
                    if ($jaljella == 0) {
                        echo "</table></div>";
                    }
                }
            }

            echo'<div class="cm8-margin-top"></div>';
            echo'<input type="hidden" name="id" value=' . $_GET[id] . '>';
            echo'<input type="hidden" name="kid" value=' . $_GET[kid] . '>';
            echo'<input type="hidden" name="monesko" value=' . $_GET[monesko] . '>';
            ;
            echo'<input type="submit" value="&#10003 Tuo nämä tiedostot" class="myButton9"  role="button"  style="padding:4px 6px">';
            echo'</form>';
        }


        echo'</div>';
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