<?php
session_start();
ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Tarkastele opiskelijoiden tehtävätilastoja</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />';

include("yhteys.php");

if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}

if (isset($_SESSION["Kayttajatunnus"])) {


    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("kurssisivustonheader.php");

        include "libchart/libchart/classes/libchart.php";

        echo '<div class="cm8-container7" id="paluu" style="margin-top: 0px; padding-top:0px; padding-bottom: 30px; margin-bottom: 0px; ">';


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

 
<div class="cm8-threequarter" style="margin-left: 20px; padding-top: 10px; margin-top: 0px">';


        if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $onkoprojekti->fetch_assoc()) {

            $ipid = $rowP[id];
            $kuvaus = $rowP[kuvaus];
        }



        echo'<h6tiedosto id="' . $ipid . '" style="margin-top: 0px;padding: 6px 40px 6px 20px; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus;

        echo'</h6tiedosto>';


        echo'<br><br><a href="itsetyot.php?i=' . $_GET[id] . '" ><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';

        if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!$haetehtavat2 = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $yht = $haetehtavat2->num_rows;

        if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipid . "' AND painotus = 1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($onkopisteet->num_rows != 0) {
            $pisteet = true;
        }

        if (!$onkopistevaikutus = $db->query("select distinct pisteetvaikuttaa from itseprojektit where id = '" . $ipid . "' AND pisteetvaikuttaa = 1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($onkopistevaikutus->num_rows != 0) {
            $pisteetvaikuttaa = true;
        }

        echo'<div style="text-align: center">';
        echo'<br><a href="excel.php?id=' . $ipid . '" class="myButtonLataa"  role="button"  ><i class="fa fa-download" style="font-size:18px"></i> &nbsp&nbsp Lataa tiedot Excel-tiedostona </a>';
        echo'</div><br>';



        if (!$haepisteet = $db->query("select paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $pisteetyht = 0;



        while ($rowpis = $haepisteet->fetch_assoc()) {
            $pisteetyht = $pisteetyht + $rowpis[paino];
        }

        echo'<p style="display: inline-block; margin-right: 40px;"><b> Tehtäviä on yhteensä ' . $yht . ' kappaletta.</b></p>';
        if ($pisteet) {
            echo'<p style="display: inline-block"><b> Tehtävien yhteispistemäärä on ' . $pisteetyht . ' pistettä.</b></p>';
        }

        if (!$lpmax = $db->query("select MAX(pisteet) as lpmax from itseprojektit_lpisteet where itseprojekti_id = '" . $ipid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowmax = $lpmax->fetch_assoc()) {

            $lpmax2 = $rowmax[lpmax];
        }
        if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!$onkorivi8 = $db->query("select distinct * from itseprojektit_minimi where itseprojektit_id='" . $ipid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($onkorivi8->num_rows != 0) {



            while ($row8 = $onkorivi8->fetch_assoc()) {
                $minimi = $row8[minimi];
                $minimion = true;
            }
        } else {
            $minimi = 0;
        }


     
        if ($pisteet && !$pisteetvaikuttaa) {
            echo'<p class="info" style="color: #e608b8; font-size: 1em">Tehtävien pisteet ei vaikuta prosenttimääriin.</p>';
        } else if ($pisteet && $pisteetvaikuttaa) {
            echo'<p class="info" style="color: #e608b8; font-size: 1em">Prosenttimäärissä painotetaan tehtävien pisteitä.</p>';
        }
               if ($minimi!=0) {
            echo'<br><p style="color:#2b6777; margin-bottom:0px; padding-bottom: 0px"><b style="background-color: yellow;  padding: 6px; font-size: 1em">Keltaisella värillä on merkitty ne opiskelijat, jotka eivät ole tehneet tehtäviä yli minimi%-rajan.</b></p><br>';
        }
        echo'<br><p id="ohje" style="font-weight: bold">Klikkaamalla opiskelijan nimeä pääset tarkastelemaan tarkemmin opiskelijan tehtäviä.</em></p><br>';
 
        echo'<div id="scrollbar"><div id="spacer"></div></div>';
        echo'<div class="cm8-responsive" id="container2" >';
        echo '<table id="mytable" class="cm8-uusitable10uusi" style="background-color: white; max-width: 100%">   <thead>';
        if (!$onkorivi2 = $db->query("select * from itseprojektit_lpisteet where itseprojekti_id='" . $ipid . "' ORDER BY osuus ASC")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($pisteet) {

            if ($onkorivi2->num_rows != 0) {

                if (!$pisteetvaikuttaa) {
    
                    echo '<tr style="background-color: #48E5DA"><th>Opiskelija</th><th style="text-align: center">Tehdyt tehtävät (/' . $yht . 'kpl)</th><th style="text-align: center">Tehtyjen tehtävien osuus(%)</th><th style="text-align: center">Osattujen tehtävien osuus (%)</th><th style="text-align: center">Tehtyjen, mutta jotka ei ole osattu ilman apua, osuus (%)</th><th style="text-align: center">Lisäpisteet (/' . $lpmax2 . 'p)</th></tr></thead><tbody>';
                    
                    
                } else {
                    
                    echo '<tr style="background-color: #48E5DA"><th>Opiskelija</th><th style="text-align: center">Tehdyt tehtävät (/' . $yht . 'kpl)</th><th style="text-align: center">Tehtyjen tehtävien pisteiden osuus (%)</th><th style="text-align: center">Pisteitä kerätty (/' . $pisteetyht . 'p)</th><th style="text-align: center">Osattujen tehtävien pisteiden osuus (%)</th><th style="text-align: center">Tehtyjen, mutta jotka ei ole osattu ilman apua, pisteiden osuus (%)</th><th style="text-align: center">Lisäpisteet (/' . $lpmax2 . 'p)</th></tr></thead><tbody>';
                
                    
                }
            } else {
                if (!$pisteetvaikuttaa) {
                    echo '<tr style="background-color: #48E5DA"><th>Opiskelija</th><th style="text-align: center">Tehdyt tehtävät (/' . $yht . 'kpl)</th><th style="text-align: center">Tehtyjen tehtävien osuus(%)</th><th style="text-align: center">Osattujen tehtävien osuus (%)</th><th style="text-align: center">Tehtyjen, mutta jotka ei ole osattu ilman apua, osuus (%)</th></tr></thead><tbody>';
                
                    
                } else {
                    
                       echo '<tr style="background-color: #48E5DA"><th>Opiskelija</th><th style="text-align: center">Tehdyt tehtävät (/' . $yht . 'kpl)</th><th style="text-align: center">Tehtyjen tehtävien pisteiden osuus (%)</th><th style="text-align: center">Pisteitä kerätty (/' . $pisteetyht . ' p)</th><th style="text-align: center">Osattujen tehtävien pisteiden osuus (%)</th><th style="text-align: center">Tehtyjen, mutta jotka ei ole osattu ilman apua, pisteiden osuus (%)</th></tr></thead><tbody>';
                
                    
                }
            }
        } else {
            if ($onkorivi2->num_rows != 0) {

               echo '<tr style="background-color: #48E5DA"><th>Opiskelija</th><th style="text-align: center">Tehdyt tehtävät (/' . $yht . 'kpl)</th><th style="text-align: center">Tehtyjen tehtävien osuus(%)</th><th style="text-align: center">Osattujen tehtävien osuus (%)</th><th style="text-align: center">Tehtyjen, mutta jotka ei ole osattu ilman apua, osuus (%)</th><th style="text-align: center">Lisäpisteet (/' . $lpmax2 . 'p)</th></tr></thead><tbody>';
                    
            } else {

                echo '<tr style="background-color: #48E5DA"><th>Opiskelija</th><th style="text-align: center">Tehdyt tehtävät (/' . $yht . 'kpl)</th><th style="text-align: center">Tehtyjen tehtävien osuus(%)</th><th style="text-align: center">Osattujen tehtävien osuus (%)</th><th style="text-align: center">Tehtyjen, mutta jotka ei ole osattu ilman apua, osuus (%)</th></tr></thead><tbody>';
                
                
            }
        }

        while ($row = $result->fetch_assoc()) {

            if ((!$pisteetvaikuttaa && $pisteet) || !$pisteet) {
                if (!$haetehdyt = $db->query("select distinct itsetehtavat.id as kid from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if (!$haeosatut = $db->query("select distinct itsetehtavat.id as kid from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if (!$haeeiosatut = $db->query("select distinct itsetehtavat.id as kid from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                $tehdyt = $haetehdyt->num_rows;
                $osatut = $haeosatut->num_rows;
                $eiosatut = $haeeiosatut->num_rows;
            } else {
                 if (!$haetehdytkpl = $db->query("select distinct itsetehtavat.id as kid from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                
                $tehdytkpl = $haetehdytkpl -> num_rows;
                if (!$haepisteet = $db->query("select  paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                $yht = 0;
                while ($rowpis = $haepisteet->fetch_assoc()) {
                    $yht = $yht + $rowpis[paino];
                }

                //TEHDYT YHTEENSÄ
                if (!$haeomatpisteet = $db->query("select distinct itsetehtavat.id, itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                $tehdyt = 0;

                while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
                    $tehdyt = $tehdyt + $rowpis2[paino];
                }

                //TEHDYT JA OSATUT 
                if (!$haeomatpisteet = $db->query("select distinct itsetehtavat.id, itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                $osatut = 0;

                while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
                    $osatut = $osatut + $rowpis2[paino];
                }

                //TEHDYT EI-OSATUT
                if (!$haeomatpisteet = $db->query("select distinct itsetehtavat.id, itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                $eiosatut = 0;

                while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
                    $eiosatut = $eiosatut + $rowpis2[paino];
                }
            }


            if ($yht != 0) {
                $osatutosuus = ($osatut / $yht) * 100;
                $osatutosuus = round($osatutosuus, 0);
            } else {
                $osatutosuus = 0;
            }



            if ($yht != 0) {
                $eiosatutosuus = ($eiosatut / $yht) * 100;
                $eiosatutosuus = round($eiosatutosuus, 0);
            } else {
                $eiosatutosuus = 0;
            }

            if ($yht != 0) {
                $osuus = ($tehdyt / $yht) * 100;
                $osuus = round($osuus, 0);
            } else {
                $osuus = 0;
            }

            //haetaan lisäpisteet
            if (!$onkorivi3 = $db->query("select * from itseprojektit_lpisteet where itseprojekti_id='" . $ipid . "' ORDER BY osuus ASC")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $opkorkeus = $osuus;
            $lpisteet = 0;
            while ($rowr = $onkorivi3->fetch_assoc()) {
                $seliter = $rowr[pisteet];

                $osuusr = $rowr[osuus];

                if ($opkorkeus >= $osuusr) {
                    $lpisteet = $seliter;
                } else {
                    
                }
            }




            if ($pisteet) {
                if (!$haeomatpisteet = $db->query("select distinct itsetehtavat.id, itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                $omatpisteetyht = 0;
                while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
                    $omatpisteetyht = $omatpisteetyht + $rowpis2[paino];
                }

                $opkorkeus = $omatpisteetyht / $pisteetyht * 100;
                //haetaan tasot
//                if (!$onkorivi2 = $db->query("select * from itseprojektit_tasot where itseprojekti_id='" . $ipid . "' ORDER BY osuus ASC")) {
//                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//                }
//                $taso = "";
//                while ($rowr = $onkorivi2->fetch_assoc()) {
//                    $seliter = str_replace('<br />', "", $rowr[selite]);
//
//                    $osuusr = $rowr[osuus];
//
//                    if ($opkorkeus >= $osuusr) {
//                        $taso = $seliter;
//                    } else {
//                        
//                    }
//                }
//
//                if ($taso == "") {
//                    $taso = '<em style="font-size: 0.9em">(ei ylitettyä tasoa)</em>';
//                }

                
                
                    if($pisteetvaikuttaa && $pisteet){
                                   
                if ($osuus >= $minimi) {

                
                    if ($onkorivi3->num_rows != 0) {
                        echo '<tr><td><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '">' . $row[sukunimi] . " " . $row[etunimi] . '</a></td><td style="text-align: center">' . $tehdytkpl . '</td><td style="text-align: center">' . $osuus . '</td><td style="text-align: center">' . $tehdyt . '</td><td style="text-align: center">' . $osatutosuus . '</td><td style="text-align: center">' . $eiosatutosuus . '</td><td style="text-align: center">' . $lpisteet . '</td></tr>';
                    } else {
                        echo '<tr><td><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '">' . $row[sukunimi] . " " . $row[etunimi] . '</a></td><td style="text-align: center">' . $tehdytkpl . '</td><td style="text-align: center">' . $osuus . '</td><td style="text-align: center">' . $tehdyt . '</td><td style="text-align: center">' . $osatutosuus . '</td><td style="text-align: center">' . $eiosatutosuus . '</td></tr>';
                    }
                } else {
                    if ($onkorivi3->num_rows != 0) {
                        echo '<tr style="background-color: yellow"><td><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '">' . $row[sukunimi] . " " . $row[etunimi] . '</a></td><td style="text-align: center">' . $tehdytkpl . '</td><td style="text-align: center">' . $osuus . '</td><td style="text-align: center">' . $tehdyt . '</td><td style="text-align: center">' . $osatutosuus . '</td><td style="text-align: center">' . $eiosatutosuus . '</td><td style="text-align: center">' . $lpisteet . '</td></tr>';
                    } else {
                        echo '<tr style="background-color: yellow"><td><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '">' . $row[sukunimi] . " " . $row[etunimi] . '</a><td style="text-align: center">' . $tehdytkpl . '</td></td><td style="text-align: center">' . $osuus . '</td><td style="text-align: center">' . $tehdyt . '</td><td style="text-align: center">' . $osatutosuus . '</td><td style="text-align: center">' . $eiosatutosuus . '</td></tr>';
                    }
                }
                    }
                    else{
                                   
                if ($osuus >= $minimi) {

                
                    if ($onkorivi3->num_rows != 0) {
                        echo '<tr><td><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '">' . $row[sukunimi] . " " . $row[etunimi] . '</a></td><td style="text-align: center">' . $tehdyt . '</td><td style="text-align: center">' . $osuus . '</td><td style="text-align: center">' . $osatutosuus . '</td><td style="text-align: center">' . $eiosatutosuus . '</td><td style="text-align: center">' . $lpisteet . '</td></tr>';
                    } else {
                        echo '<tr><td><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '">' . $row[sukunimi] . " " . $row[etunimi] . '</a></td><td style="text-align: center">' . $tehdyt . '</td><td style="text-align: center">' . $osuus . '</td><td style="text-align: center">' . $osatutosuus . '</td><td style="text-align: center">' . $eiosatutosuus . '</td></tr>';
                    }
                } else {
                    if ($onkorivi3->num_rows != 0) {
                        echo '<tr style="background-color: yellow"><td><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '">' . $row[sukunimi] . " " . $row[etunimi] . '</a></td><td style="text-align: center">' . $tehdyt . '</td><td style="text-align: center">' . $osuus . '</td><td style="text-align: center">' . $osatutosuus . '</td><td style="text-align: center">' . $eiosatutosuus . '</td><td style="text-align: center">' . $lpisteet . '</td></tr>';
                    } else {
                        echo '<tr style="background-color: yellow"><td><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '">' . $row[sukunimi] . " " . $row[etunimi] . '</a></td><td style="text-align: center">' . $tehdyt . '</td><td style="text-align: center">' . $osuus . '</td><td style="text-align: center">' . $osatutosuus . '</td><td style="text-align: center">' . $eiosatutosuus . '</td></tr>';
                    }
                }
                    }
                
     
            
                
                    }
            
            else {

                if ($osuus >= $minimi) {
                    if ($onkorivi3->num_rows != 0) {
                        echo '<tr><td><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '">' . $row[sukunimi] . " " . $row[etunimi] . '</a></td><td style="text-align: center">' . $tehdyt . '</td><td style="text-align: center">' . $osuus . '</td><td style="text-align: center">' . $osatutosuus . '</td><td style="text-align: center">' . $eiosatutosuus . '</td><td style="text-align: center">' . $lpisteet . '</td></tr>';
                    } else {
                        echo '<tr><td><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '">' . $row[sukunimi] . " " . $row[etunimi] . '</a></td><td style="text-align: center">' . $tehdyt . '</td><td style="text-align: center">' . $osuus . '</td><td style="text-align: center">' . $osatutosuus . '</td><td style="text-align: center">' . $eiosatutosuus . '</td></tr>';
                    }
                } else {
                    if ($onkorivi3->num_rows != 0) {
                        echo '<tr style="background-color: yellow"><td><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '">' . $row[sukunimi] . " " . $row[etunimi] . '</a></td><td style="text-align: center">' . $tehdyt . '</td><td style="text-align: center">' . $osuus . '</td><td style="text-align: center">' . $osatutosuus . '</td><td style="text-align: center">' . $eiosatutosuus . '</td><td style="text-align: center">' . $lpisteet . '</td></tr>';
                    } else {
                        echo '<tr style="background-color: yellow"><td><a href="tarkasteleopiskelija.php?kaid=' . $row[kaid] . '&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '">' . $row[sukunimi] . " " . $row[etunimi] . '</a></td><td style="text-align: center">' . $tehdyt . '</td><td style="text-align: center">' . $osuu . '</td><td style="text-align: center">' . $osatutosuus . '</td><td style="text-align: center">' . $eiosatutosuus . '</td></tr>';
                    }
                }
            }
//                 die('opkorkeus: '.$opkorkeus .'<br>osuuser: '.$osuusr); 
        }

        echo "</tbody></table>";
        echo"</div>";
        echo'</div>';
        echo "<br>";










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
<script>


    $("#scrollbar").on("scroll", function () {

        var container = $("#container2");
        var scrollbar = $("#scrollbar");

        ScrollUpdate(container, scrollbar);
    });

    function ScrollUpdate(content, scrollbar) {
        $("#spacer").css({"width": "500px"}); // set the spacer width
        scrollbar.width = content.width() + "px";
        content.scrollLeft(scrollbar.scrollLeft());
    }

    ScrollUpdate($("#container2"), $("#scrollbar"));

</script>
<script>

    count();
</script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/tableHeadFixer.js"></script>
<script>


    //ilman tätä mikään muu ei toimi kuin scrolli

    $("#mytable").tableHeadFixer({"head": false, "left": 1});

</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
<script>


    var $table = $('#mytable');
    $table.floatThead({zIndex: 1});


</script> 
</body>
</html>								