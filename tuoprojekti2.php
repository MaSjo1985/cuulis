<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Tuo Palautus-osio </title>';

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


    echo '<div class="cm8-container7" id="paluu" style="margin-top: 0px; padding-top:0px; padding-bottom: 30px; margin-bottom: 0px; ">';

    if (!$haeprojekti = $db->query("select * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($haeprojekti->num_rows == 1 && !isset($_GET[r])) {
        if (!$hae_eka = $db->query("select MIN(id) as id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
        header('location: ryhmatyot.php?r=' . $eka_id);
    }
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav" >
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" class="currentLink" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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

    if ($_SESSION["Rooli"] == "opiskelija") {
        echo'<nav class="topnav" id="myTopnav">
		 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
		  
		  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" class="currentLink">Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
	
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

    echo'<div class="cm8-margin-top"></div>';

    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Palautukset</h2>';
    echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">';

    if (!$hae_eka = $db->query("select id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka->num_rows == 1) {
        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
    }




    if ($haeprojekti->num_rows != 0) {
        echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
        while ($rowP = $haeprojekti->fetch_assoc()) {
            $kuvaus = $rowP[kuvaus];
            $id = $rowP[id];
            if ($_GET[r] == $id) {

                echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3-valittu" style="font-size: 0.9em; margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
            } else {

                echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3" style="font-size: 0.9em; margin-right: 20px; margin-bottom: 5px;  padding: 6px 6px 6px 20px">' . $kuvaus . '</a>';
            }
        }
        echo'<div class="cm8-margin-top"></div>';

        if ($_SESSION["Rooli"] <> 'opiskelija') {
            
              echo'<form action="uusiprojekti.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää Palautus-osio" class="myButton8"  role="button"  style="padding: 2px 6px"></form>';
        
                echo'<form action="tuoprojekti.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '>';
           
 echo'<button  name="painike" title="Tuo Palautus-osio" class="myButton8" style="font-size: 0.8em"><i class="fa fa-recycle"></i>&nbsp&nbsp Tuo Palautus-osio </button>';
  echo'</form><br><br>';
            
        }
    }
  echo'</nav>
</div>';

    echo'<div class="cm8-threequarter" style="padding-top: 0px; margin-left: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 30px">';
  
        
        echo'<h8>Tuo Palautus-osio toisesta kurssista/opintojaksosta</h8><br><br><a href="tuoprojekti.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';


        if (!$haetiedostot = $db->query("select * from projektit where kurssi_id='" . $_GET[id] . "' order by kuvaus asc")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        if ($haetiedostot->num_rows == 0) {

          echo'<p id="ohje"><b style="font-size: 1.1em">Kurssille ei ole lisätty Palautus-osioita.</b></p>';
        } else {

            echo'<p id="ohje"><b style="font-size: 1.1em">Valitse, mitkä Palautus-osiot haluat tuoda.</b></p>';

            $jaljella = $haetiedostot->num_rows;
            echo'<div class="cm8-margin-top"></div>';
            echo'<form action="tuoprojekti3.php" method="get">';
            echo'<div class="cm8-responsive">';
            echo '<table class="cm8-table cm8-bordered cm8-stripedeivikaa">';

            if ($_GET[kaikki2] == joo) {
                echo '<tr style="font-size: 1.1em; border: 1px solid grey; background-color: #48E5DA"><th><a href="tuoprojekti2.php?id=' . $_GET[id] . '"  style="font-weight: bold; font-size: 0.8em"> Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th><th>Palautus-osio</th></tr>';



                while ($rowP2 = $haetiedostot->fetch_assoc()) {

                    $ipiduusi = $rowP2[id];



                    echo'<tr><td style="padding-left: 10px"><input type="checkbox" name="lista[]" class="pieni" id=' . $ipiduusi . '  value=' . $ipiduusi . ' checked></td>';
                    echo'<td><label for=' . $ipiduusi . '> ' . $rowP2[kuvaus] . '</label></td></tr>';




                    $jaljella--;
                    if ($jaljella == 0) {
                        echo "</table></div>";
                    }
                }
            } else {

                echo '<tr style="font-size: 1.1em; border: 1px solid grey; background-color: #48E5DA"><th><a href="tuoprojekti2.php?id=' . $_GET[id] . '&kaikki2=joo" style="font-weight: bold; font-size: 0.8em"> Valitse<br>kaikki<br>&nbsp&#9661&nbsp</a></th><th>Palautus-osio</th></tr>';



                while ($rowP2 = $haetiedostot->fetch_assoc()) {

                    $ipiduusi = $rowP2[id];

                    echo'<tr><td style="padding-left: 10px"><input type="checkbox" class="pieni" name="lista[]" id=' . $ipiduusi . '  value=' . $ipiduusi . '></td>';
                    echo'<td><label for=' . $ipiduusi . '> ' . $rowP2[kuvaus] . '</label></td></tr>';



                    $jaljella--;
                    if ($jaljella == 0) {
                        echo "</table></div>";
                    }
                }
            }

            echo'<div class="cm8-margin-top"></div>';
            echo'<input type="hidden" name="id" value=' . $_GET[id] . '>';
            echo'<input type="hidden" name="monesko" value=' . $_GET[monesko] . '>';
            ;
            echo'<input type="submit" value="&#10003 Tuo Palautus-osiot" class="myButton9"  role="button"  style="padding:4px 6px">';
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