<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Tehtävälista</title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("kurssisivustonheader.php");



        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';

        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" class="currentLink">Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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








        echo'<div class="cm8-margin-top"></div>';



        echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Tehtävälista</h2>';
        echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">';

        if (!$hae_eka = $db->query("select id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
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
            echo'';
        } else {
            echo'';
        }

        echo'</nav>

 </div> 
 
<div class="cm8-threequarter" style="padding-top: 0px; margin-top: 0px">';


        if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $onkoprojekti->fetch_assoc()) {

            $ipid = $rowP[id];
            $kuvaus = $rowP[kuvaus];


            echo'<br><h6 style="padding-top: 0px; padding-bottom: 20px; font-size: 1.3em; color: #2b6777; display: inline-block">' . $kuvaus . '</h6>';
            echo'<br><a href="itsetyot.php?i=' . $ipid . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';
            if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if (!$haetehtavat2 = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $yht = $haetehtavat2->num_rows;

            echo'<p style="color: #2b6777">Tehtäviä yhteensä: <b>' . $yht . ' kpl.</b></p>';


            echo'<br><br><form action="tuotehtavat.php" method="get" style="display: inline-block"><input type="hidden" name="monesko" value=' . $_GET[monesko] . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#10000 Tuo tehtävät toisesta kurssista/opintojaksosta" class="myButton8"  role="button"  style="padding:2px 4px"></form>';


            echo'<br><br><br><form action="muokkaaitsetyot.php" method="post">';


            if ($_GET[kaikki] == 'joo') {

                echo'<div class="cm8-responsive">';
                echo '<table class="cm8-table cm8-bordered">';
                echo '<tr style="font-size: 1.1em; border: 1px solid grey"><th style="border-right: 1px solid grey"><a href="muokkaaitsetyot1.php?id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '#cm" >Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th><th style="border-right: 1px solid grey; text-align: center">Tehtävät</th><th style="font-weight: normal">Lisää rivi alapuolelle</th></tr>';

                while ($rowt = $haetehtavat->fetch_assoc()) {
                    $rowt[sisalto] = str_replace('<br />', "", $rowt[sisalto]);
                    if ($rowt[aihe] == 1) {
                        echo '<tr  style="background-color:#f2f2f2"><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td><b>Otsikko:</b> <textarea name="otsikko[]" rows="1" style="width:100%; font-size: 0.9em">' . $rowt[otsikko] . '</textarea>';
                        echo '</td><td style="text-align: center"><input type="radio" name="jarjestys" value=' . $rowt[jarjestys] . '></td></tr>';

                        echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" value=' . $rowt[id] . '>';
                        echo'<input type="hidden" name="sisalto[]" value=' . $rowt[sisalto] . '>';
                    } else {
                        echo '<tr><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td> <textarea name="sisalto[]" rows="1" style="width:100%; font-size: 0.9em">' . $rowt[sisalto] . '</textarea></td><td style="text-align: center"><input type="radio" name="jarjestys" value=' . $rowt[jarjestys] . '></td></tr>';
                        echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" value=' . $rowt[id] . '>';
                        echo'<input type="hidden" name="otsikko[]" value=' . $rowt[otsikko] . '>';
                    }
                }
                echo '<tr style="border-bottom: none"><td><button class="pieniroskis" title="Poista" name="painikep"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td><td><input type="hidden" name="ipid" value=' . $ipid . '> <input type="submit" name="painikel" value="+ Lisää tehtävä" class="myButton8"  role="button"  style="padding:2px 4px; margin-right: 10px; margin-top: 20px"><input type="submit" name="painikelo" value="+ Lisää otsikko" class="myButton8"  role="button"  style="padding:2px 4px"></td><td></td></tr>';
                echo "</table></div>";
                echo'<input type="hidden" name="monesko" value=' . $_GET[monesko] . '>';
                echo'<input type="hidden" name="ipid" value=' . $ipid . '>';
                echo'<br><br><input type="submit" id="tanne" name="painiket" value="&#10003 Tallenna" class="myButton9"  role="button"  style="padding:4px 6px">';
                echo'</form>';
            } else {

                echo'<div class="cm8-responsive">';
                echo '<table class="cm8-table cm8-bordered">';
                echo '<tr style="font-size: 1.1em; border: 1px solid grey"><th style="border-right: 1px solid grey"><a href="muokkaaitsetyot1.php?kaikki=joo&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '#cm"  > Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th style="border-right: 1px solid grey; text-align: center">Tehtävät</th><th style="font-weight: normal">Lisää rivi alapuolelle</th></tr>';

                while ($rowt = $haetehtavat->fetch_assoc()) {
                    $rowt[sisalto] = str_replace('<br />', "", $rowt[sisalto]);

                    if ($rowt[aihe] == 1) {
                        echo '<tr id="' . $rowt[id] . '" style="background-color:#f2f2f2"><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td> <b>Otsikko:</b> <textarea name="otsikko[]" rows="1" style="width:100%; font-size: 0.9em">' . $rowt[otsikko] . '</textarea>';
                        echo '</td><td style="text-align: center"><input type="radio" name="jarjestys" value=' . $rowt[jarjestys] . '></td></tr>';

                        echo'<input type="hidden" name="id[]" value=' . $rowt[id] . '>';
                        echo'<input type="hidden" name="sisalto[]" value=' . $rowt[sisalto] . '>';
                    } else {
                        echo '<tr id="' . $rowt[id] . '"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="sisalto[]" rows="1" style="width:100%;  font-size: 0.9em">' . $rowt[sisalto] . '</textarea></td><td style="text-align: center"><input type="radio" name="jarjestys" value=' . $rowt[jarjestys] . '></td></tr>';
                        echo'<input type="hidden" name="id[]" value=' . $rowt[id] . '>';
                        echo'<input type="hidden" name="otsikko[]" value=' . $rowt[otsikko] . '>';
                    }
                }
                echo '<tr style="border-bottom: none"><td><button class="pieniroskis" title="Poista" name="painikep"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td><td><input type="hidden" name="ipid" value=' . $ipid . '> <input type="submit" name="painikel" value="+ Lisää tehtävä" class="myButton8"  role="button"  style="padding:2px 4px; margin-right: 10px; margin-top: 20px"><input type="submit" name="painikelo" value="+ Lisää otsikko" class="myButton8"  role="button"  style="padding:2px 4px"></td><td></td></tr>';
                echo "</table></div>";
                echo'<input type="hidden" name="monesko" value=' . $_GET[monesko] . '>';
                echo'<input type="hidden" name="ipid" value=' . $ipid . '>';
                echo'<br><br><input type="submit" id="tanne" name="painiket" value="&#10003 Tallenna" class="myButton9"  role="button"  style="padding:4px 6px">';

                echo'</form>';
            }
            echo' <div class="cm8-margin-top" id="cm"></div>';
        }








        echo'</div>





</div>';
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