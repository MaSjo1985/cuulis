<?php
session_start();

ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Yksityiskohdat tehtävästä </title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />

';

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
        if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka->num_rows != 0) {
            while ($rivieka = $hae_eka->fetch_assoc()) {
                $eka_id = $rivieka[id];
            }
        }
        echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">';


        if (!$haeprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeprojekti->num_rows != 0) {
            echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
            while ($rowP = $haeprojekti->fetch_assoc()) {
                $kuvaus = $rowP[kuvaus];
                $id = $rowP[id];

                if ($_GET[id] == $id) {

                    echo'<a href="itsetyot.php?i=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
                } else {

                    echo'<a href="itsetyot.php?i=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
                }
            }

            echo'<div class="cm8-margin-top"></div>';


            echo'</div>';
        }






        echo'


 
	
</nav>

 </div> 

 
<div class="cm8-threequarter" style="padding-top: 0px; margin-top: 0px">';


        if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $onkoprojekti->fetch_assoc()) {

            $ipid = $rowP[id];
            $kuvaus = $rowP[kuvaus];
        }
        if (!$haetehtava = $db->query("select distinct * from itsetehtavat where id='" . $_GET[tid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowT = $haetehtava->fetch_assoc()) {

            $sisalto = $rowT[sisalto];
        }

        echo'<br><h6 style="padding-top: 0px; padding-bottom: 10px; font-size: 1.2em; color: #2b6777; display: inline-block">' . $kuvaus . '</h6>';
        echo'<br><a href="itsetyot.php?i=' . $_GET[id] . '""><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';
        echo'<br><b style="font-size: 1.2em; color:  #2b6777">Tehtävän ' . $sisalto . ' opiskelijoiden merkinnät</b>';
        echo'<br><br><p id="ohje" style="font-size: 0.9em">Klikkaamalla opiskelijan nimeä pääset tarkastelemaan tarkemmin opiskelijan tehtäviä.</em></p>';

        echo'<p style="font-weight: bold; color: #2b6777; margin-top:30px"><b style="font-size: 1.5em">&#9786</b>&nbsp<b style="font-size: 1.1em;">Opiskelijat, jotka ovat osannut tehtävän: </b></p>';
        if (!$haeosatut = $db->query("select distinct kayttajat.etunimi as etunimi, kayttajat.sukunimi as sukunimi, kayttajat.id as id from itsetehtavatkp, kayttajat where kayttajat.rooli='opiskelija' AND kayttajat.id=itsetehtavatkp.kayttaja_id AND itsetehtavat_id='" . $_GET[tid] . "' AND tehty=1 AND osattu=1 ORDER BY kayttajat.sukunimi ASC")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($haeosatut->num_rows == 0) {
            echo'<br><em>Kukaan ei ole merkinnyt osanneensa tehtävää.</em><br>';
        } else {



            echo '<table class="cm8-tableyks cm8-bordered cm8-striped"><thead><th>Opiskelija</th></thead>';
            echo '<tbody>';

            while ($rowosatut = $haeosatut->fetch_assoc()) {



                echo '<tr><td><a href="tarkasteleopiskelija.php?kaid=' . $rowosatut[id] . '&id=' . $ipid . '&url=ykskohdat.php&tid=' . $_GET[tid] . '">' . $rowosatut[sukunimi] . ' ' . $rowosatut[etunimi] . '</a></td></tr>';
            }

            echo "</tbody></table>";
        }



        echo'<br><br><p style="font-weight: bold; color: #2b6777">&#9785 &nbsp&nbsp<b style="font-size: 1.1em;">Opiskelijat, jotka eivät ole osanneet tehtävää ilman apua:</b> </p>';

        if (!$haeeiosatut = $db->query("select distinct kayttajat.etunimi as etunimi, kayttajat.sukunimi as sukunimi, kayttajat.id as id from itsetehtavatkp, kayttajat where kayttajat.rooli='opiskelija' AND kayttajat.id=itsetehtavatkp.kayttaja_id AND itsetehtavat_id='" . $_GET[tid] . "' AND osattu=0 AND tehty=1 ORDER BY kayttajat.sukunimi ASC")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($haeeiosatut->num_rows == 0) {
            echo'<br><em>Kukaan ei ole merkinnyt yrittäneensä tehdä tehtävää osaamatta sitä.</em><br>';
        } else {
            echo '<table class="cm8-tableyks cm8-bordered cm8-striped"><thead><th>Opiskelija</th></thead>';

            echo '<tbody>';


            while ($roweiosatut = $haeeiosatut->fetch_assoc()) {



                echo '<tr><td><a href="tarkasteleopiskelija.php?kaid=' . $roweiosatut[id] . '&id=' . $ipid . '&url=ykskohdat.php&tid=' . $_GET[tid] . '">' . $roweiosatut[sukunimi] . ' ' . $roweiosatut[etunimi] . '</a></td></tr>';
            }





            echo "</tbody></table>";
        }



        echo'<br><br><p style="font-weight: bold; color: #2b6777"><b style="font-size: 1.1em">&#9757</b>&nbsp&nbsp&nbsp<b style="font-size: 1.1em;">Opiskelijat, jotka ovat toivoneet, että tehtävän läpikäytäväksi:</b> </p>';

        if (!$haetoiveet = $db->query("select distinct kayttajat.etunimi as etunimi, kayttajat.sukunimi as sukunimi, kayttajat.id as id from itsetehtavatkp, kayttajat where kayttajat.rooli='opiskelija' AND kayttajat.id=itsetehtavatkp.kayttaja_id AND itsetehtavat_id='" . $_GET[tid] . "' AND toive=1 ORDER BY kayttajat.sukunimi ASC")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haetoiveet->num_rows == 0) {
            echo'<br><em>Kukaan ei ole toivonut, että tehtävä käytäisiin yhdessä läpi.</em><br>';
        } else {

            echo '<table class="cm8-tableyks cm8-bordered cm8-striped"><thead><th>Opiskelija</th></thead>';

            echo '<tbody>';
            while ($rowtoive = $haetoiveet->fetch_assoc()) {

                echo '<tr><td><a href="tarkasteleopiskelija.php?kaid=' . $rowtoive[id] . '&id=' . $ipid . '&url=ykskohdat.php&tid=' . $_GET[tid] . '">' . $rowtoive[sukunimi] . ' ' . $rowtoive[etunimi] . '</a></td></tr>';
            }





            echo "</tbody></table>";
        }


        echo'<br><br><p style="font-weight: bold; color: #2b6777">&#10000&nbsp&nbsp<b style="font-size: 1.1em;">Opiskelijat, jotka ovat kommentoineet tehtävää:</b> </p>';



        if (!$haekommentit = $db->query("select distinct itsetehtavatkp.kommentti as kommentti, kayttajat.etunimi as etunimi, kayttajat.sukunimi as sukunimi, kayttajat.id as id from itsetehtavatkp, kayttajat where kayttajat.rooli='opiskelija' AND kayttajat.id=itsetehtavatkp.kayttaja_id AND itsetehtavat_id='" . $_GET[tid] . "' AND kommentti<>'' ORDER BY kayttajat.sukunimi ASC")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        if ($haekommentit->num_rows == 0) {
            echo'<br><em>Kukaan ei ole kommentoinut tehtävää.</em><br>';
        } else {
            echo '<table class="cm8-tableyks cm8-bordered cm8-striped"><thead><th>Opiskelija</th></thead>';

            echo '<tbody>';

            while ($rowkommentti = $haekommentit->fetch_assoc()) {


                echo '<tr><td><a href="tarkasteleopiskelija.php?kaid=' . $rowkommentti[id] . '&id=' . $ipid . '&url=ykskohdat.php&tid=' . $_GET[tid] . '">' . $rowkommentti[sukunimi] . ' ' . $rowkommentti[etunimi] . '</a></td><td>' . $rowkommentti[kommentti] . '</td></tr>';
            }





            echo "</tbody></table>";
        }







        echo'</div>';




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