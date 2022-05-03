<?php
session_start();
ob_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Opiskelijan itsearviointi</title>
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


        echo'<div class="cm8-container3" style="padding-top: 30px">';


        if (!$haeopiskelija = $db->query("select distinct * from kayttajat where id='" . $_GET[kaid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        while ($rowO = $haeopiskelija->fetch_assoc()) {
            $kaid = $rowO[id];
            $etunimi = $rowO[etunimi];
            $sukunimi = $rowO[sukunimi];
        }


        echo'<p style="font-size: 1.3em; color: #2b6777"><b>Opiskelijan ' . $etunimi . ' ' . $sukunimi . ' itsearviointi</b></p>';
        echo'<a href="tarkastelearvioinnit.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';




        if (!$haearvioinnit = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        echo'<div class="cm8-margin-top"></div>';
        echo'<p id="ohje" style="color: #e608b8; font-weight: bold">Huom! Muista tallentaa lomake muokattuasi sitä.</p>';
        echo'<div class="cm8-margin-top"></div>';
        echo'<form action="tallennaopearvioinnit.php" method="post">';


        echo'<div class="cm8-responsive">';
        echo '<table id="mytable2" class="cm8-tableoppilas" style="table-layout:fixed; max-width: 90%;"> <thead>';

        echo '</thead><tbody>';

        while ($rowt = $haearvioinnit->fetch_assoc()) {

            if (!$haekp = $db->query("select distinct * from itsearvioinnitkp where itsearvioinnit_id='" . $rowt[id] . "' AND kayttaja_id='" . $_GET[kaid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($rowt[aihe] == 1)
                echo '<tr class="iaihe2"><td style="border-left: 1px solid grey; font-size: 1em; font-weight: bold"><b>' . $rowt[otsikko] . '</b></td><td style="border-right: 1px solid grey; font-size: 1.1em; text-align: center">Opettajan kommentti</td></tr>';
            else if ($rowt[valiaihe] == 1)
                echo '<tr class="ivaliaihe2"><td style="border-left: 1px solid grey; font-weight: bold"><b>' . $rowt[otsikko] . '</b></td><td style="border-right: 1px solid grey"></td></tr>';
            else {

                while ($rowkp = $haekp->fetch_assoc()) {

                    if ($rowkp[opetallennus] == 1) {


                        echo '<tr id="' . $rowt[id] . '" class="isisalto2"><td style="border: 1px solid grey">' . $rowkp[teksti] . '</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td class="muokkaus"><a  href="korjaaopearviointi.php?opid=' . $_GET[kaid] . '&teid=' . $rowt[id] . '"  class="myButton9"  role="button"  style="padding:2px 4px; margin: 0px">&#9998 &nbsp Muokkaa</a></td></tr>';
                    } else {
                        if ($rowt[id] == $_GET[minne]) {

                            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);

                            echo '<tr id="' . $rowt[id] . '" class="isisalto2"><td style="word-wrap: break-word;   border: 1px solid grey;    padding: 6px 8px; width: 80%; font-style: normal">' . $rowkp[teksti] . '</td><td style="border: 1px solid grey; padding: 20px;"><textarea name="kommentti[]" cols="40"  rows="3" autofocus>' . $rowkp[kommentti] . '</textarea></td></td></tr>';
                            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                        } else {

                            echo '<tr id="' . $rowt[id] . '" class="isisalto2"><td style="word-wrap: break-word;   border: 1px solid grey;    padding: 6px 8px; width: 80%; font-style: normal">' . $rowkp[teksti] . '</td><td style="border: 1px solid grey; padding: 20px;"><textarea name="kommentti[]" cols="40"  rows="3">' . $rowkp[kommentti] . '</textarea></td></td></tr>';
                            echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                        }
                    }
                }
            }
        }
        echo'<input type="hidden" name="opid" value=' . $_GET[kaid] . '>';
        echo'<tr style="border: none"><td style="border: none"></td><td style="border: none"><input type="submit" name="painiket" value="&#10003 Tallenna kommentit" class="myButton9"  role="button"  style="padding:4px 6px; font-size: 1em"></td></tr>';
        echo'</form>';
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

        if (!$haearvioinnit = $db->query("select distinct * from itsearvioinnit_pisteet where kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttaja_id='" . $_GET[kaid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowkpp = $haearvioinnit->fetch_assoc()) {
            $opetallennus2 = $rowkpp[opetallennus2];
            $pisteet = $rowkpp[pisteet];
        }
        echo'<div id="tuutanne" class="cm8-responsive" style="overflow: hidden">';
        if ($opetallennus2 == 1) {


            echo '<b style="margin-right: 20px; color: #e608b8">Pisteet opiskelijalle lomakkeesta:</b><b style="font-weight: bold; font-size: 1.1em; color: #e608b8">' . $pisteet . ' pistettä</b> <a  href="korjaaopearviointi2.php?opid=' . $_GET[kaid] . '"  class="myButton9" title="Korjaa" role="button"  style="margin-left: 20px; padding: 2px 4px">&#9998 &nbsp Muokkaa</a>';
        } else {

            echo'<form action="tallennaopearvioinnit2.php" method="post">';
            if (empty($pisteet)) {
                echo'<b style="margin-right: 10px; color: #e608b8">Pisteet opiskelijalle lomakkeesta:</b> <input type="number" style="width: 50px; color: #2b6777" name="pisteet">';
            } else {
                echo'<b style="margin-right: 10px;color: #e608b8">Pisteet opiskelijalle lomakkeesta:</b> <input type="number" style="width: 50px; color: #2b6777" name="pisteet" >';
            }


            echo'<input type="hidden" name="opid" value=' . $_GET[kaid] . '>';
            echo'<input type="submit" name="painiket"   value="&#10003 Tallenna" class="myButton9"  role="button"  style="padding:2px 4px; margin: 4px 4px 4px 20px">';

            echo'</form>';
        }
        echo'<br><br><a href="tarkastelearvioinnit.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';

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