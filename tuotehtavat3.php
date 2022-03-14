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
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
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

        if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka->num_rows != 0) {
            while ($rivieka = $hae_eka->fetch_assoc()) {
                $eka_id = $rivieka[id];
            }
        }
        echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Tehtävälista</h2>';
        echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">

<a href="itsetyot.php?i=' . $eka_id . '"';

        if (!$haeprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeprojekti->num_rows != 0) {
            echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
            while ($rowP = $haeprojekti->fetch_assoc()) {
                $kuvaus = $rowP[kuvaus];
                $id = $rowP[id];

                if ($_GET[ipid] == $id) {

                    echo'<a href="itsetyot.php?i=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
                } else {

                    echo'<a href="itsetyot.php?i=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
                }
            }



            echo'</div>';
        }

        echo'


 
	
</nav>



 
<div class="cm8-threequarter" style="padding-top: 20px; margin-top: 0px">';


        if (!$omaprojekti = $db->query("select distinct * from itseprojektit where id='" . $_GET[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $omaprojekti->fetch_assoc()) {

            $ipid = $rowP[id];
            $kuvaus = $rowP[kuvaus];
        }


        echo'<h6 style="padding-top: 0px; padding-bottom: 20px; font-size: 1.2em;  color: #2b6777; display: inline-block">Valitse, mitkä tehtävät haluat lisätä.</h6>';
        echo'<br><a href="tuotehtavat.php?id=' . $_GET[ipid] . '&monesko=' . $_GET[monesko] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';





        if (!$haeuusiprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeuusiprojekti->num_rows == 0) {

            echo'<br><em>Kurssilla ei ole Tehtävälista-projekteja.</em><br>';
        } else {


            $jaljella = $haeuusiprojekti->num_rows;
            echo'<div style="margin: 0px; padding:0px">';



            $maara = 0;
            while ($rowP2 = $haeuusiprojekti->fetch_assoc()) {
                $maara++;
                echo'<form action="tuotehtavatvarmistus.php" method="post">';
                $ipiduusi = $rowP2[id];
                if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipiduusi . "' AND painotus = 1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($onkopisteet->num_rows != 0) {
                    $pisteet = true;
                } else {
                    $pisteet = false;
                }

                if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipiduusi . "' ORDER BY jarjestys")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                
               echo'<div style="text-align: center">';

                echo '<h2 style="margin-top: 20px; margin-bottom: 10px; color: #48E5DA">' . $rowP2[kuvaus] . '</h2>';
                
                echo'</div>';
                
                 echo'<p style="color: #e608b8; font-weight: bold">Valitse ensin ne tehtävät, jotka haluat tuoda.</p>';
                echo'<input type="submit" value="&#10003 Lisää nämä tehtävät"  id="tanne' . $maara . '" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.9em"><br>';
                echo'<div class="cm8-responsive">';
                echo '<table id="mytable" class="cm8-uusitableitse" style="font-size: 0.9em; width: 99%"><thead>';
                if ($_GET['kaikki'] == $rowP2[id]) {
                    if ($pisteet) {
                        echo '<tr style="border: 1px solid; background-color: #48E5DA"><th style="text-aling: left"><a href="tuotehtavat3.php?ipid=' . $_GET[ipid] . '&id=' . $_GET[id] . '#tanne' . $maara . '" style="font-size: 0.9em"> Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th><th style="border: 1px solid; ">Sisältö</th><th>Pisteet</th></tr>';
                    } else {
                        echo '<tr style="border: 1px solid; background-color: #48E5DA"><th style="text-align: left; width: 20%"><a href="tuotehtavat3.php?ipid=' . $_GET[ipid] . '&id=' . $_GET[id] . '#tanne' . $maara . '" style="font-size: 0.9em"> Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th><th style="border: 1px solid; width: 80%">Sisältö</th></tr>';
                    }
                } else {
                    if ($pisteet) {
                        echo '<tr style="border: 1px solid; background-color: #48E5DA"><th style="text-align: left"><a href="tuotehtavat3.php?kaikki=' . $rowP2[id] . '&ipid=' . $_GET[ipid] . '&id=' . $_GET[id] . '#tanne' . $maara . '" style="font-size: 0.9em"> Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th style="border: 1px solid; ">Sisältö</th><th>Pisteet</th></tr>';
                    } else {
                        echo '<tr style="border: 1px solid; background-color: #48E5DA"><th style="text-align: left; width: 20%"><a href="tuotehtavat3.php?kaikki=' . $rowP2[id] . '&ipid=' . $_GET[ipid] . '&id=' . $_GET[id] . '#tanne' . $maara . '" style="font-size: 0.9em">Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th style="border: 1px solid; width: 80%">Sisältö</th></tr>';
                    }
                }



                while ($rowt = $haetehtavat->fetch_assoc()) {
                    if ($_GET['kaikki'] == $rowP2[id]) {
                        if ($pisteet) {
                            if ($rowt[aihe] == 1)
                                echo '<tr style="background-color:#d0d0d0; border: 1px solid"><td style="padding-top: 10px; padding-bottom: 10px; text-align:left; padding-left: 20px"><input type="checkbox" name="lista10[]" value=' . $rowt[id] . ' checked></td><td colspan="2"><b>' . $rowt[otsikko] . '</b></td></tr>';
                            else
                                echo '<tr style="border: 1px solid"><td style="padding-top: 10px; padding-bottom: 10px; text-align:left; padding-left: 20px"><input type="checkbox" name="lista10[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid">' . $rowt[sisalto] . '</td><td>' . $rowt[paino] . '</td></tr>';
                        }
                        else {
                            if ($rowt[aihe] == 1)
                                echo '<tr style="background-color:#d0d0d0; border: 1px solid"><td style="padding-top: 10px; padding-bottom: 10px; text-align:left; padding-left: 20px"><input type="checkbox" name="lista10[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid"><b>' . $rowt[otsikko] . '</b></td></tr>';
                            else
                                echo '<tr style="border: 1px solid"><td style="padding-top: 10px; padding-bottom: 10px; text-align:left; padding-left: 20px"><input type="checkbox" name="lista10[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid">' . $rowt[sisalto] . '</td></tr>';
                        }
                    }
                    else {
                        if ($pisteet) {
                            if ($rowt[aihe] == 1)
                                echo '<tr style="background-color:#d0d0d0; border: 1px solid"><td style="padding-top: 10px; padding-bottom: 10px; text-align:left; padding-left: 20px"><input type="checkbox" name="lista10[]" value=' . $rowt[id] . '></td><td colspan="2"><b>' . $rowt[otsikko] . '</b></td></tr>';
                            else
                                echo '<tr style="border: 1px solid"><td style="padding-top: 10px; padding-bottom: 10px; text-align:left; padding-left: 20px"><input type="checkbox" name="lista10[]" value=' . $rowt[id] . ' ></td><td style="border: 1px solid">' . $rowt[sisalto] . '</td><td>' . $rowt[paino] . '</td></tr>';
                        }
                        else {
                            if ($rowt[aihe] == 1)
                                echo '<tr style="background-color:#d0d0d0; border: 1px solid"><td style="padding-top: 10px; padding-bottom: 10px; text-align:left; padding-left: 20px"><input type="checkbox" name="lista10[]" value=' . $rowt[id] . '></td><td style="border: 1px solid"><b>' . $rowt[otsikko] . '</b></td></tr>';
                            else
                                echo '<tr style=" border: 1px solid"><td style="padding-top: 10px; padding-bottom: 10px; text-align:left; padding-left: 20px"><input type="checkbox" name="lista10[]" value=' . $rowt[id] . ' ></td><td style="border: 1px solid;">' . $rowt[sisalto] . '</td></tr>';
                        }
                    }
                }

                echo "</table></div>";

                echo'<div class="cm8-margin-top"></div>';
                echo'<input type="hidden" name="id" value=' . $ipid . '>';
                echo'<input type="hidden" name="monesko" value=' . $_GET[monesko] . '>';

                echo'<input type="submit" value="&#10003 Lisää nämä tehtävät" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.9em">';
                echo'</form>';

                $jaljella--;
                if ($jaljella > 0) {
                    echo'<div class="cm8-margin-bottom"></div>';
                    echo'<div class="cm8-margin-top"><br></div>';
                }
            }
            echo'</div>';
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
