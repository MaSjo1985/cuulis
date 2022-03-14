<?php
session_start();
ob_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Opiskelijan kyselylomake</title>
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
        include "libchart/libchart/classes/libchart.php";



        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';


        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a>
          <a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  class="currentLink" >Kyselylomake</a>
		
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


        echo'<div class="cm8-container3" style="padding-top: 30px">';


        if (!$haeopiskelija = $db->query("select distinct * from kayttajat where id='" . $_GET[kaid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        while ($rowO = $haeopiskelija->fetch_assoc()) {
            $kaid = $rowO[id];
            $etunimi = $rowO[etunimi];
            $sukunimi = $rowO[sukunimi];
        }


        echo'<p style="font-size: 1.3em; color: #2b6777"><b>Vastaus nro ' . $_GET[nro] . ':</b></p>';
        echo'<a href="tarkastelekyselyt.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';




        if (!$haearvioinnit = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        echo'<div class="cm8-margin-top"></div>';



        echo'<div class="cm8-responsive">';
        echo '<table id="mytable2" class="cm8-uusitableia" style="width: 90%"> <tbody>';

        while ($rowt = $haearvioinnit->fetch_assoc()) {

            if (!$haekp = $db->query("select distinct * from kyselytkp where kyselyt_id='" . $rowt[id] . "' AND kayttaja_id='" . $_GET[kaid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($rowt[aihe] == 1)
                echo '<tr class="iaihe2"><td style="border-left: 1px solid grey; font-size: 1em; font-weight: bold"><b>' . $rowt[otsikko] . '</b></td></tr>';
            else if ($rowt[valiaihe] == 1)
                echo '<tr class="ivaliaihe2"><td style="border-left: 1px solid grey; font-weight: bold"><b>' . $rowt[otsikko] . '</b></td></tr>';
            else {

                while ($rowkp = $haekp->fetch_assoc()) {

                    if ($rowkp[opetallennus] == 1) {


                        echo '<tr id="' . $rowt[id] . '" class="isisalto2"><td style="border: 1px solid grey">' . $rowkp[teksti] . '</td></tr>';
                    } else {
                        if ($rowt[id] == $_GET[minne]) {



                            echo '<tr id="' . $rowt[id] . '" class="isisalto2"><td style="word-wrap: break-word;   border: 1px solid grey;    padding: 6px 8px; width: 80%">' . $rowkp[teksti] . '</td></tr>';
                        } else {

                            echo '<tr id="' . $rowt[id] . '" class="isisalto2"><td style="word-wrap: break-word;   border: 1px solid grey;    padding: 6px 8px; width: 80%">' . $rowkp[teksti] . '</td></tr>';
                        }
                    }
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

        echo'<div id="tuutanne" class="cm8-responsive">';

        echo"</div>";

        echo"</div>";




        echo'</div>





</div>';
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



include("footer.php");
?>

</body>
</html>										