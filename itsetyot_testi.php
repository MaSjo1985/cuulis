<?php
session_start(); 


ob_start();

// Start counting
// Your code




echo'<!DOCTYPE html><html> 
<head>
<title> Tehtävälista</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
<link rel="shortcut icon" href="favicon.png" type="image/png" />';

include("yhteys.php");
include("tsekkaa_oikeus.php");
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}

if (isset($_SESSION["Kayttajatunnus"])) {
    include("diagrammit.php");
    include("diagrammit3.php");
    include("pie.php");
    if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($hae_eka->num_rows == 1 && !isset($_GET[i])) {

        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
        if (!empty($eka_id))
            header('location: itsetyot_testi.php?i=' . $eka_id);
    }
    if (isset($_GET[i])) {
        if (!$haelinkki = $db->query("select distinct * from opiskelijankirja where itseprojekti_id='" . $_GET[i] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($haelinkki->num_rows != 0) {



            while ($rowt = $haelinkki->fetch_assoc()) {
                echo'<div style="display:none" id="tama1" class="cm8-half"><br></div>';
                echo'<div style="display:none" id="tama" class="cm8-half">';
                echo'<div  style="display:none" id="siirto" title="Voit siirtää aluetta!" style="width: auto; height: auto;z-index: 1001;position: fixed !important">';
                echo'<div  style="display:none" id="siirto2">';


                echo'<p style="display: inline-block; margin: 0px; padding: 0px; font-size: 0.7em; "><b ><em>Huom! Jos istuntosi on vanhentunut, kirjaudu kustantajan sivulle ja PÄIVITÄ SIVU.</em>';

                if ($rowt[kirjautuminen] != '') {
                    echo'<br> <a href="' . $rowt[kirjautuminen] . '" target="_blank" style="color: #2b6777"> Kirjaudu tästä>> </a></b></p>';
                } else {
                    echo'</b></p>';
                }
                echo' <button id="klik" style="display: inline-block; margin-left: 30px" class="myButton8" title="Piilota näkyvistä">- Piilota</button>';
                echo'<form action="poistakirjavarmistus.php" method="post" style="display: inline-block; margin: 0px 0px 0px 20px"> <input type="hidden" name="ipid" id="ipid" value="' . $_GET[i] . '"><button class="roskis" title="Poista digikirja"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i></button></form>';

                echo'<br><iframe id="kirja" title="kirja" src="' . $rowt[linkki] . '" style="width: 100%"  allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';


                echo'</div>';
                echo'</div>';
                echo'</div>';
            }
        } else {

            echo'<p style="z-index: 1001;position: fixed; top:30%; right:10%"><form action="lisaakirja.php" style="z-index: 1001;position: fixed; top:20%; right:2%" method="post" > <input type="hidden" name="ipid" id="ipid" value="' . $_GET[i] . '"> <input type="submit" value="+ Lisää digikirja"  class="myButton8"  role="button" id="maalaa" style="padding:2px 4px; font-size: 1em"></form></p>';
        }
    }
    include("kurssisivustonheader.php");
    include "libchart/libchart/classes/libchart.php";

    echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 0px; border: none">';




    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot_testi.php" onclick="loadProgress()" class="currentLink">Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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
    } else if ($_SESSION["Rooli"] == "opiskelija") {
        echo'<nav class="topnav" id="myTopnav">
		 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a> 
		
		  <a href="itsetyot_testi.php" onclick="loadProgress()" class="currentLink" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
			
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

    echo'<div class="cm8-margin-top"></div>';
    if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka->num_rows != 0) {
        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
    }


    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px; "> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Tehtävälista</h2>';
    echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; padding-left: 0px">
        
';



    if (!$haeprojekti = $db->query("select id, kuvaus from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($haeprojekti->num_rows != 0) {
        echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px;  padding-left: 0px">';
        while ($rowP = $haeprojekti->fetch_assoc()) {
            $kuvaus = $rowP[kuvaus];
            $id = $rowP[id];

            if ($_GET[i] == $id) {

                echo'<a href="itsetyot_testi.php?i=' . $id . '" class="btn-info3"  style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
            } else {

                echo'<a href="itsetyot_testi.php?i=' . $id . '" class="btn-info3"  style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
            }
        }

        echo'<div class="cm8-margin-top"></div>';
        if ($_SESSION["Rooli"] <> 'opiskelija') {
            echo'<form action="uusiitseprojektieka.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää uusi" class="myButton8"  role="button"  style="padding:2px 4px"></form><br><br>';
        }

        echo'</div>';
    }
    if (!$hae_eka2 = $db->query("select MIN(id) as id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
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



    echo'</nav>';






    echo'</div>';


    echo'<div class="cm8-threequarter" style="padding-top: 0px; margin-left: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px; ">';


    if ($haelinkki->num_rows != 0) {
        echo' <p style="z-index: 1001;position: fixed; top:30%; left:2%">';
        echo' <button id="klik2"  class="myButton8" title="Avaa digikirja">+ Avaa digikirja</button></p>';
    }



    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {


        $opekoko = microtime(true);
        if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($onkoprojekti->num_rows == 0) {

            echo'<form action="uusiitseprojektieka.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
            echo'<br><br>Tähän on mahdollista luoda Tehtävälista-projekteja, jotka sisältävät kurssin/opintojakson suorittamiseen liittyvän tehtäväluettelon, johon opiskelijat voivat kirjata suorituksiaan.<br><br>';
        } else if ($onkoprojekti->num_rows > 0 && !isset($_GET[i])) {
            echo'<br>Valitse oheisesta valikosta haluamasi Tehtävälista-osio.<br><br>';
        } else {
            $opeonkoprojekti = microtime(true);
            if (!$onkoprojekti = $db->query("select distinct id, kuvaus from itseprojektit where id='" . $_GET[i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowP = $onkoprojekti->fetch_assoc()) {

                $ipid = $rowP[id];
                $kuvaus = $rowP[kuvaus];

                echo'<h6 id="' . $ipid . '" style="margin-right: 20px; padding-top: 20px; padding-bottom: 20px; font-size: 1.2em; color: #2b6777; display: inline-block">' . $kuvaus . '</h6><form action="muokkaaitseprojektieka.php" method="post" style="display: inline-block; margin-right:10px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa" class="muokkausN"  role="button"  style="padding:2px 4px"></form>';
                echo'<form action="varmistusitseprojekti.php" method="post" style="display: inline-block; margin-top: 20px"><input type="hidden" name="id" value=' . $ipid . '><button class="roskis" title="Poista Kurssitehtävä-projekti"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i></button></form>';

                if (!$haeinfo = $db->query("select distinct info, palautus_sulkeutuu, palautus_suljettu from itseprojektit where id='" . $ipid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowv = $haeinfo->fetch_assoc()) {
                    $viesti = $rowv[info];
                    $sulkeutuu = $rowv[palautus_sulkeutuu];
                    $suljettu = $rowv[palautus_suljettu];
                }

                $estaosio = ($takaraja2 != '' && $nyt > $takaraja2);
                $osiovapaa = ($takaraja2 != '' && $nyt <= $takaraja2);

                echo'<div class="cm8-responsive" id="info_ope">';

                echo'<div class="cm8-responsive" style="padding: 0px; margin: 0px">';

                echo'<form action="ilmoitus.php" method="post" id="infomuokkaus"><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="kuvaus" value=' . $kuvaus . '><input type="submit" name= "painikei" value="&#9998 Muokkaa" title="Muokkaa sisältöä" class="myButton8"  role="button"  style="padding: 2px 4px; font-size: 0.8em; float: left ;"></form></td></tr>';

                echo'</div>';

                echo'<div class="cm8-responsive" style="padding: 20px">';
                echo htmlspecialchars_decode($viesti);
                echo'</div>';


                echo'</div>';





                if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' ORDER BY jarjestys")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if (!$haetehtavat2 = $db->query("select distinct id from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipid . "' AND painotus = 1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($onkopisteet->num_rows != 0) {
                    $pisteet = true;
                }
                if (!$onkopisteytys = $db->query("select distinct itsepisteytys from itseprojektit where id = '" . $ipid . "' AND itsepisteytys = 1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($onkopisteytys->num_rows != 0) {
                    $itsepisteytys = true;
                }

                $yht = $haetehtavat2->num_rows;




                echo'<div class="cm8-responsive" style="margin-bottom: 20px; margin-top: 60px">';
                echo'<table  class="tehtavataulu" style="display: inline-block">';
                echo'<tr><th colspan="2">Lisäpisteiden muodostuminen:ddsaads <form action="muokkaalisapisteita.php" method="get" style="display: inline-block"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa lisäpisterajoja" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.7em"></form></th><th></th></tr>';



                if (!$onkorivi2 = $db->query("select distinct * from itseprojektit_lpisteet where itseprojekti_id='" . $ipid . "' ORDER BY osuus DESC")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($row = $onkorivi2->fetch_assoc()) {

                    echo'<tr><td><b>Pisteitä: </b>' . $row[pisteet] . '</td>';
                    echo'<td><b>Tehtäviä tehty: </b>' . $row[osuus] . ' %</td></tr>';
                }

                echo'</table><br>';


                if ($onkorivi2->num_rows == 0) {
                    echo'<p style="color: #2b6777; font-size: 0.9em"><em>(Tähän voit laittaa halutessasi rajat lisäpisteille, joita opiskelija voi saada tehtävien tekoprosentin mukaan.)</em></p>';
                }



                if (!$onkorivi8 = $db->query("select distinct * from itseprojektit_minimi where itseprojektit_id='" . $ipid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($onkorivi8->num_rows == 0) {
                    echo'<p style="display:inline-block; font-weight: bold">Voit halutessasi asettaa tehtäville minimi%-rajan</p>';
                } else {


                    while ($row8 = $onkorivi8->fetch_assoc()) {
                        echo'<p style="display:inline-block; font-weight: bold">Tehtävien minimi%-raja on: ' . $row8[minimi] . ' %</p>';
                    }
                }

                echo'<form action="muokkaaminimia.php" method="get" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa minimi%-rajaa" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.7em"></form>';


                echo'</div>';

                if (1==1) {
                    if (!$haepisteet = $db->query("select paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    $pisteetyht = 0;
                    while ($rowpis = $haepisteet->fetch_assoc()) {
                        $pisteetyht = $pisteetyht + $rowpis[paino];
                    }


                    echo'<div class="cm8-responsive">';
                    echo'<table  class="tehtavataulu" style="display: inline-block">';
                    echo'<tr><th colspan="2"><b>Edistymispylvään tavoitetasojen muodostuminen: </b><form action="muokkaatasoja.php" method="get" style="display: inline-block"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa tavoitetasoja" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.7em"></form></th><th></th></tr>';

                    if (!$onkorivi2 = $db->query("select distinct * from itseprojektit_tasot where itseprojekti_id='" . $ipid . "' ORDER BY osuus DESC")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($row = $onkorivi2->fetch_assoc()) {
                        $row[selite] = str_replace('<br />', "", $row[selite]);
                        echo'<tr><td><b>Taso: </b>' . $row[selite] . '</td>';
                        echo'<td><b>Osuus maksimipisteistä: </b>' . $row[osuus] . ' %</td></tr>';
                    }

                    echo'</table>';
//                    tuoDiagrammi2(0, $ipid);




                    echo'<br><br><b>Tehtäviä on yhteensä ' . $yht . ' kappaletta.</b><br>';
                }


                if (!$pisteet) {
                    echo'<div class="cm8-responsive">';
                    echo'<b>Tehtäviä on yhteensä ' . $yht . ' kappaletta.</b><br><br>';
                    echo'<em style="font-weight: bold">Tehtävien pisteytys ei ole käytössä.</em>';
                    echo'<form action="aktivoipisteytys.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painikea"  value="+ Ota käyttöön" title="+ Ota käyttöön" class="myButton8"  role="button"  style="padding:2px 4px"></form>';

                    echo'<div class="cm8-margin-top"></div>';
                }
                echo'</div>';
                if ($pisteet) {
                    if (!$haepisteet = $db->query("select paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    $pisteetyht = 0;
                    while ($rowpis = $haepisteet->fetch_assoc()) {
                        $pisteetyht = $pisteetyht + $rowpis[paino];
                    }

                    echo'<p style="display: inline-block; margin-right: 40px"><b>Tehtävien yhteispistemäärä on ' . $pisteetyht . ' pistettä.</b></p>';

                    echo'<form action="aktivoipisteytys.php" style="display: inline-block" method="post"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painikep"  value="X Poista käytöstä" title="X Poista käytöstä" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.8em"></form>';
                }

                // TÄHÄN SAAKO PISTEYTTÄÄ
                if ($itsepisteytys) {
                    echo'<br><p style="margin-top: 10px; display: inline-block" id="takas"><b>Lisäksi opiskelijat saavat pisteyttää tekemänsä tehtävät.</b></p><form action="muokkaaitsepisteytys.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painikep" value="X Poista käytöstä" title="X Poista käytöstä" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                } else if ($pisteet && !$itsepisteytys) {
                    echo'<br><p style="margin-top: 10px; display: inline-block" id="takas"><b>Opiskelijat eivät saa pisteyttää itse tehtäviä.</b></p><form action="muokkaaitsepisteytys.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painikel" value="+ Ota käyttöön" title="+ Ota käyttöön" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                }

                echo'<div class="cm8-margin-top"><br></div>';

                echo'<form action="tarkastele.php" method="get" style="display: inline-block"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" style="font-size: 1em" value="&#9763 Tarkastele opiskelijakohtaisia tilastoja" class="myButton8"  role="button"  style="padding:2px 4px"></form>';

                echo'<br><br>';

                $nyt = date("Y-m-d H:i");

                $takaraja = $sulkeutuu;

                if ($suljettu == 0 && $nyt <= $takaraja) {
                    echo'<p style="display: inline-block; margin-right: 20px">Opiskelijat voivat muokata taulukkoa.</p>';
                    echo'<form action="suljeluettelo.php" method="post" style="display: inline-block; margin-right: 30px"><input type="hidden" name="pid" value=' . $ipid . '><input type="submit" name="painike" value="- Sulje" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                } else if ($suljettu == 1 && $nyt <= $takaraja) {
                    echo'<p style="display: inline-block; margin-right: 20px">Opiskelijoiden mahdollisuus muokata taulukkoa on suljettu.</p>';
                    echo'<form action="avaaluettelo.php" method="post" style="display: inline-block"><input type="hidden" name="pid" value=' . $ipid . '><input type="submit" name="painike" value="+ Avaa" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                }
                $nyt = date("Y-m-d H:i");
                if ($suljettu == 0) {
                    if (!empty($sulkeutuu) && $sulkeutuu != ' ') {
                        $nyt = date("Y-m-d H:i");
                        $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
                        $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
                        $sulkeutumiskello = substr($sulkeutuu, 11, 5);

                        $takaraja = $sulkeutuu;


                        if ($suljettu == 0 && $nyt <= $takaraja) {
                            echo'<br><b>Opiskelijoiden mahdollisuus muokata taulukkoa sulkeutuu ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
                        } else {
                            echo'<br><b style="color: #e608b8"> Opiskelijoiden mahdollisuus muokata taulukkoa on sulkeutunut ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
                        }
                    } else {
                        echo'<br><b>Opiskelijoille ei ole asetettu takarajaa taulukon muokkaukseen.</b>';
                    }


                    echo'<form action="asetatakarajaluettelo.php" method="get" style="display: inline-block; margin-left: 20px"><input type="hidden" name="i" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" value="Muokkaa takarajaa" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                }




                echo'<br><p id="ohje" style="font-size: 0.8em">Klikkaamalla otsikkoa pääset tarkastelemaan sen alla olevien tehtävien tietoja.<br>';
                echo'Klikkaamalla tehtävää pääset tarkastelemaan siihen liittyviä tietoja.</p>';

                echo'<div class="cm8-margin-top"></div>';
                if ($haetehtavat->num_rows != 0) {
                    echo'<form action="testaamuokkaus.php" method="get" id="palaatanne"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa tehtävälistaa" class="myButton8"  role="button"  title="Muokkaa tehtävälistaa"  style="padding:2px 4px; font-size: 1em"></form>';
                }



                echo'<div id="scrollbar"><div id="spacer"></div></div>';
                echo'<div class="cm8-responsive" id="container2" >';
                echo '<table id="mytable" class="cm8-uusitable2ope" style="table-layout:fixed; max-width: 100%">   <thead>';
                if ($pisteet) {
                    echo '<tr style="border: 2px solid #2b6777; background-color: #48E5DA;  font-size: 1em" id="palaa"><th>Tehtävä</th><th>Tehtävän<br>pistemäärä</th><th>Tehdyt yht.</th><th>Tehty<br>ja osattu</th><th style="text-align: center; border: 1px solid #2b6777">Tehty,<br>mutta ei osattu<br>ilman apua</th><th>Toivottu yhdessä<br>läpikäytäväksi</th><th>Kommentoitu'
                    . '</th></tr>  </thead><tbody>';
                } else {
                    echo '<tr style="border: 2px solid #2b6777; background-color: #48E5DA;  font-size: 1em; " id="palaa"><th>Tehtävä</th><th>Tehdyt yht.</th><th>Tehty<br>ja osattu</th><th>Tehty,<br>mutta ei osattu<br>ilman apua</th><th>Toivottu yhdessä<br>läpikäytäväksi</th><th>Kommentoitu'
                    . '</th></tr>  </thead><tbody>';
                }
                $opewhile = microtime(true);
                $maara = 0;
                $maaratehtavat = 0;
                while ($rowt = $haetehtavat->fetch_assoc()) {
                    $maara++;
                    if ($rowt[aihe] != 1) {
                        $maaratehtavat++;
                    }

                    if ($maara == 1) {
                        $opewhilesis01 = microtime(true);
                    } else if ($maara == 2) {
                        $opewhilesis02 = microtime(true);
                    } else if ($maara == 3) {
                        $opewhilesis03 = microtime(true);
                    }

                    if ($rowt[aihe] == 1) {

                        $sulkeutumispaiva2 = '';
                        $automaattinen = 0;
                        $sulkeutumiskello2 = '';

                        $sulkeutuu2 = $rowt[sulkeutuu];
                        $takaraja2 = '';
                        if (!empty($sulkeutuu2) && $sulkeutuu2 != ' ') {
                            $sulkeutumispaiva2 = substr($sulkeutuu2, 0, 10);
                            $sulkeutumispaiva2 = date("d.m.Y", strtotime($sulkeutumispaiva2));
                            $automaattinen = 1;
                            $sulkeutumiskello2 = substr($sulkeutuu2, 11, 5);
                            $takaraja2 = $sulkeutuu2;
                        }
                    } else {
                        if ($maaratehtavat == 1) {
                            $tehtavanmaarat = microtime(true);
                            $toiveetmaarat = microtime(true);
                        }
                        if (!$haetoiveet = $db->query("select distinct id from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND toive=1")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        if ($maaratehtavat == 1) {

                            $toiveetmaarat = microtime(true) - $toiveetmaarat;
                        }
                        if ($maaratehtavat == 1) {

                            $eiosatutmaarat = microtime(true);
                        }
                        if (!$haeeiosatut = $db->query("select distinct id from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND osattu=0 AND tehty=1")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        if ($maaratehtavat == 1) {

                            $eiosatutmaarat = microtime(true) - $eiosatutmaarat;
                        }
                        if ($maaratehtavat == 1) {

                            $osatutmaarat = microtime(true);
                        }
                        if (!$haeosatut = $db->query("select distinct id from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND osattu=1")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        if ($maaratehtavat == 1) {

                            $osatutmaarat = microtime(true) - $osatutmaarat;
                        }
                        if ($maaratehtavat == 1) {

                            $kommentitmaarat = microtime(true);
                        }
                        if (!$haekommentit = $db->query("select distinct id from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND kommentti<>''")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        if ($maaratehtavat == 1) {

                            $kommentitmaarat = microtime(true) - $kommentitmaarat;
                        }
                        $tehdyt = ($haeeiosatut->num_rows) + ($haeosatut->num_rows);
                        if ($maaratehtavat == 1) {
                            $tehtavanmaarat = microtime(true) - $tehtavanmaarat;
                        }
                    }

                    if ($maaratehtavat == 1) {
                        $loppuosa_tehtavat = microtime(true);
                    }


                    if ($pisteet) {
                        $opewhilesis = microtime(true);
                        if ($rowt[aihe] == 1) {
                            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:#d0d0d0;"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="6" style="border-top: 2px solid #2b6777;border-right: 2px solid #2b6777; border-bottom: 2px solid #2b6777; border-left: none"><a  href="ykskohdat2.php?id=' . $ipid . '&tid=' . $rowt[id] . '"><b>' . $rowt[otsikko] . '</b></a>';

                            $seuraava = $rowt[jarjestys] + 1;
                            if (!$haeseuraava = $db->query("select distinct aihe from itsetehtavat where itseprojektit_id='" . $ipid . "' AND jarjestys='" . $seuraava . "'")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }
                            while ($rows = $haeseuraava->fetch_assoc()) {
                                $onkoaihe = $rows[aihe];
                            }
                            if ($onkoaihe != 1 && ($nyt <= $takaraja || $takaraja == '')) {
                                //jos auki
                                if ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == ''))
                                    echo'<form action="suljeaihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="- Sulje" title="Sulje osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                                else if ($rowt[aihekiinni] == 1)
                                //jos kiinni
                                    echo '<br><em style="font-size: 0.8em; color: #e608b8">Tämä osio on suljettu.</em><form action="avaa_aihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="+ Avaa" title="Avaa osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';


                                if ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == '')) {
                                    echo '<form action="asetaosiokiinni.php" style="display: inline-block; margin-left: 20px; font-size: 0.8em" method="post" autocomplete="off">';

                                    if ($automaattinen == 1) {
                                        if ($nyt <= $takaraja2) {
                                            echo'<b style="font-size:0.8em; margin-left: 20px; margin-right: 20px; color: #e608b8">Osio sulkeutuu: </b>';
                                        } else {
                                            echo'<b style="font-size:0.8em; margin-left: 20px; margin-right: 20px; color: #e608b8">Osio on sulkeutunut: </b>';
                                        }

                                        echo'<b style="font-size: 0.8em">Pvm:</b> 
    
            <input type="text" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva" style="margin-right: 20px; width: 60px; font-size: 0.8em" value=' . $sulkeutumispaiva2 . '>';
                                    } else {
                                        echo'<em style="font-size:0.8em; margin-left: 20px; margin-right: 20px"> tai aseta aika: </em>';
                                        echo'<b style="font-size: 0.8em">Pvm:</b>
     
            <input type="text" style="margin-right: 20px; width: 60px; font-size: 0.8em" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva">';
                                    }

                                    echo'<b style="font-size: 0.8em">Klo:</b>
           <input type="hidden" name="id" id="id8" value=' . $rowt[id] . '>	
               <input type="text" class="kello" id="kello' . $rowt[id] . '"  name="kello" style="width: 60px; font-size: 0.8em" class="time" value="' . $sulkeutumiskello2 . '">';
                                    echo'<input type="hidden" name="ipid" value=' . $ipid . '>	
           
	<input type="submit" style="margin-left: 20px" value="Tallenna" class="myButton8">
	</form>';
                                } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                                    echo'<b style="font-size:0.8em; margin-left: 20px; color: #e608b8">Osio on sulkeutunut: ';
                                    echo $sulkeutumispaiva2 . ', klo: ' . $sulkeutumiskello2 . '.</b>';
                                    echo '<form action="avaa_aihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="+ Avaa" title="Avaa osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                                }
                            }

                            echo'</td></tr>';
                        } else {
                            if ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio) || ($nyt > $takaraja && $takaraja != '')) {
                                echo ' <tr style=" font-size: 1em" class="stripe-2"><td style=" border: 1px solid grey; padding-left: 10px;"><a  href="ykskohdat.php?id=' . $ipid . '&tid=' . $rowt[id] . '" style="width:100%; display:block">' . $rowt[sisalto] . '</a></td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $tehdyt . '</td><td style="text-align: center; border: 1px solid grey">' . $haeosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haeeiosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haetoiveet->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haekommentit->num_rows;
                            } else {
                                echo ' <tr style=" font-size: 1em;"><td style=" border: 1px solid grey; padding-left: 10px;"><a  href="ykskohdat.php?id=' . $ipid . '&tid=' . $rowt[id] . '" style="width:100%; display:block">' . $rowt[sisalto] . '</a></td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $tehdyt . '</td><td style="text-align: center; border: 1px solid grey">' . $haeosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haeeiosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haetoiveet->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haekommentit->num_rows;
                            }

                            echo'</td></tr>';
                        }
                    } else {
                        if ($rowt[aihe] == 1) {
                            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:#d0d0d0;" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="5" style="border-top: 2px solid #2b6777;border-right: 2px solid #2b6777; border-bottom: 2px solid #2b6777; border-left: none"><a  href="ykskohdat2.php?id=' . $ipid . '&tid=' . $rowt[id] . '"><b>' . $rowt[otsikko] . '</b></a>';
                            $seuraava = $rowt[jarjestys] + 1;
                            if (!$haeseuraava = $db->query("select distinct aihe from itsetehtavat where itseprojektit_id='" . $ipid . "' AND jarjestys='" . $seuraava . "'")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }
                            while ($rows = $haeseuraava->fetch_assoc()) {
                                $onkoaihe = $rows[aihe];
                            }
                            if ($onkoaihe != 1 && ($nyt <= $takaraja || $takaraja == '')) {
                                //jos auki
                                if ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == ''))
                                    echo'<form action="suljeaihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="- Sulje" title="Sulje osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                                else if ($rowt[aihekiinni] == 1)
                                //jos kiinni
                                    echo '<br><em style="font-size: 0.8em; color: #e608b8">Tämä osio on suljettu.</em><form action="avaa_aihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="+ Avaa" title="Avaa osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';


                                if ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == '')) {
                                    echo '<form action="asetaosiokiinni.php" style="display: inline-block; margin-left: 20px; font-size: 0.8em" method="post" autocomplete="off">';

                                    if ($automaattinen == 1) {
                                        if ($nyt <= $takaraja2) {
                                            echo'<b style="font-size:0.8em; margin-left: 20px; margin-right: 20px; color: #e608b8">Osio sulkeutuu: </b>';
                                        } else {
                                            echo'<b style="font-size:0.8em; margin-left: 20px; margin-right: 20px; color: #e608b8">Osio on sulkeutunut: </b>';
                                        }

                                        echo'<b style="font-size: 0.8em">Pvm:</b> 
    
            <input type="text" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva" style="margin-right: 20px; width: 60px; font-size: 0.8em" value=' . $sulkeutumispaiva2 . '>';
                                    } else {
                                        echo'<em style="font-size:0.8em; margin-left: 20px; margin-right: 20px"> tai aseta aika: </em>';
                                        echo'<b style="font-size: 0.8em">Pvm:</b>
     
            <input type="text" style="margin-right: 20px; width: 60px; font-size: 0.8em" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva">';
                                    }

                                    echo'<b style="font-size: 0.8em">Klo:</b>
           <input type="hidden" name="id" id="id8" value=' . $rowt[id] . '>	
               <input type="text" class="kello" id="kello' . $rowt[id] . '"  name="kello" style="width: 60px; font-size: 0.8em" class="time" value="' . $sulkeutumiskello2 . '">';
                                    echo'<input type="hidden" name="ipid" value=' . $ipid . '>	
           
	<input type="submit" style="margin-left: 20px" value="Tallenna" class="myButton8">
	</form>';
                                } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                                    echo'<b style="font-size:0.8em; margin-left: 20px; color: #e608b8">Osio on sulkeutunut: ';
                                    echo $sulkeutumispaiva2 . ', klo: ' . $sulkeutumiskello2 . '.</b>';
                                    echo '<form action="avaa_aihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="+ Avaa" title="Avaa osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                                }
                            }

                            echo'</td></tr>';
                        } else {

                            if ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio) || ($nyt > $takaraja && $takaraja != '')) {
                                echo ' <tr style=" font-size: 1em" class="stripe-2"><td style=" border: 1px solid grey; padding-left: 10px; "><a  href="ykskohdat.php?id=' . $ipid . '&tid=' . $rowt[id] . '" style="width:100%; display:block">' . $rowt[sisalto] . '</a></td><td style="text-align: center; border: 1px solid grey">' . $tehdyt . '</td><td style="text-align: center; border: 1px solid grey">' . $haeosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haeeiosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haetoiveet->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haekommentit->num_rows;
                            } else {
                                echo ' <tr style=" font-size: 1em"><td style=" border: 1px solid grey; padding-left: 10px; "><a  href="ykskohdat.php?id=' . $ipid . '&tid=' . $rowt[id] . '" style="width:100%; display:block">' . $rowt[sisalto] . '</a></td><td style="text-align: center; border: 1px solid grey">' . $tehdyt . '</td><td style="text-align: center; border: 1px solid grey">' . $haeosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haeeiosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haetoiveet->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haekommentit->num_rows;
                            }

                            echo'</td></tr>';
                        }
                    }
                    if ($maara == 1) {
                        $opewhilesis01 = microtime(true) - $opewhilesis01;
                    } else if ($maara == 2) {
                        $opewhilesis02 = microtime(true) - $opewhilesis02;
                    } else if ($maara == 3) {
                        $opewhilesis03 = microtime(true) - $opewhilesis03;
                    }

                    if ($maaratehtavat == 1) {
                        $loppuosa_tehtavat = microtime(true) - $loppuosa_tehtavat;
                    }
                }

                echo "</tbody></table>";

                echo"</div>";
                if ($haetehtavat->num_rows != 0) {
                    echo'<br><br><form action="testaamuokkaus.php" method="get"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                } else {
                    echo'<br><br><form action="testaamuokkaus.php" method="get"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa itsearviointilomaketta" class="myButton8"  role="button" title="Muokkaa itsearviointilomaketta" style="font-size: 1em; padding:2px 4px"></form>';
                }
            }

            echo'</div>';
        }
    }

    //opiskelija
    else {




        $oppilaskoko = microtime(true);
        if (!isset($_GET[i]) || empty($_GET[i])) {
            if (!$onkoprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($onkoprojekti->num_rows == 0) {

                echo'<br><em>Ei aktiivisia Tehtävälista-projekteja</em><br>';
            } else {
                echo'<br>Valitse oheisesta valikosta haluamasi Tehtävälista-osio.<br><br>';
            }
        } else {

            if (!$onkoprojekti = $db->query("select * from itseprojektit where id='" . $_GET[i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowP = $onkoprojekti->fetch_assoc()) {


                $ipid = $rowP[id];
                $kuvaus = $rowP[kuvaus];

                if (!$onkopisteytys = $db->query("select distinct itsepisteytys from itseprojektit where id = '" . $ipid . "' AND itsepisteytys = 1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($onkopisteytys->num_rows != 0) {
                    $itsepisteytys = true;
                    echo'<input type="hidden" id="itsepisteytys" value="1">';
                } else {
                    echo'<input type="hidden" id="itsepisteytys" value="0">';
                }

                echo'<div class="cm8-tehtavaohje" style="z-index: 1001;position: fixed; top:30%; left:1%">';
                echo'<p style="font-weight: bold; font-size: 1.1em; margin-top: 0px">Ohje tehtävätaulukon merkintöihin:</p>';

                echo'<p>* <b>Taulukko tallentuu automaattisesti</b>, kun merkitset rastin kohtiin<br>"Osasin", "Tein, mutta en osannut ilman apua", "Haluan käydä tunnilla läpi"</p>';

                if ($itsepisteytys) {
                    echo'<p>* <b>Lisää ensin tehtävän pisteet</b> ja vasta sitten merkitse rasti oikeaan kohtaan</p>';
                }
                echo'<p style="margin-bottom: 0px">* <b>Jos haluat lisätä kommentin</b>, niin kirjoita ensin kommentti ja sitten merkitse rasti oikeaan kohtaan</p>';


                echo'</div>';
                echo'<br><h6 style="padding-bottom: 10px; font-size: 1.2em; color: #2b6777; display: inline-block" id="peite3">' . $kuvaus . '</h6><br><br>';
                if (!$haeinfo = $db->query("select * from itseprojektit where id='" . $ipid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowv = $haeinfo->fetch_assoc()) {
                    $viesti = $rowv[info];
                }

                if ($viesti <> "") {

                    echo'<div class="cm8-responsive" id="info">';

                    echo htmlspecialchars_decode($viesti);


                    echo'</div>';
                }



                echo'<div class="cm8-margin-top"></div>';


                if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' ORDER BY jarjestys")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if (!$haetehtavat2 = $db->query("select distinct id from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                $yht = $haetehtavat2->num_rows;

                if ($rowt[aihe] != 1) {
                    
                }
                if (!$haetehdyt = $db->query("select distinct itsetehtavat.id from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $_SESSION["Id"] . "' AND itsetehtavatkp.tehty=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                if (!$haeosatut = $db->query("select distinct itsetehtavat.id  from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $_SESSION["Id"] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if (!$haeeiosatut = $db->query("select distinct itsetehtavat.id  from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $_SESSION["Id"] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipid . "' AND painotus = 1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($onkopisteet->num_rows != 0) {
                    $pisteet = true;
                }


                tuoDiagrammi($_SESSION["Id"], $ipid);



//                echo'<p id="ohje" style="color: #e608b8; font-weight: bold; font-size: 1.1em">Huom! Tehtäväluettelo tallentuu automaattisesti, kun klikkaat joko "Osasin" tai "Tein, mutta en osannut ilman apua"- ruutuja.<br><br>Muut merkinnät on tallennettava painamalla "Tallenna"-nappia.</p>';
//       
                $esta = false;
                if (!$RTsuljettu = $db->query("select distinct palautus_suljettu, palautus_sulkeutuu from itseprojektit where id='" . $ipid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($RTs = $RTsuljettu->fetch_assoc()) {
                    $suljettu = $RTs[palautus_suljettu];
                    $sulkeutuu = $RTs[palautus_sulkeutuu];
                }

                $nyt = date("Y-m-d H:i");
                if (!empty($sulkeutuu) && $sulkeutuu != ' ') {


                    $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
                    $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
                    $sulkeutumiskello = substr($sulkeutuu, 11, 5);

                    $takaraja = $sulkeutuu;


                    $takarajaon = 1;
                }

                if (($suljettu == 0 && $takarajaon == 0) || ($takarajaon == 1 && $nyt < $takaraja && $suljettu == 0)) {



                    if ($takarajaon == 1) {
                        echo'<p style="font-size: 1.1em">Taulukon muokkausmahdollisuus sulkeutuu <b>' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b></p>';
                    }
                } else if ($suljettu == 1 || ($takarajaon == 1 && ($nyt >= $takaraja))) {
                    if ($suljettu == 1) {
                        echo'<p style="color: #e608b8; font-size: 1.1em"><b>Taulukon muokkausmahdollisuus on suljettu.</b></p>';
                        $esta = true;
                    } else if (($takarajaon == 1 && ($nyt >= $takaraja))) {

                        echo'<p style="color: #e608b8; font-size: 1.1em"><b>Taulukon muokkausmahdollisuus on sulkeutunut <b>' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b></b></p>';
                        $esta = true;
                    }
                }




                if (!$esta) {
                    echo'<p id="ohje" style="color: #e608b8; font-weight: bold; font-size: 1.1em">Huom! Muista painaa Tallenna-nappia, kun teet muutoksia <u>kommenttikenttään!</u></p>';


                    echo'<br><form action="tallennatehtavat.php" id="formi" method="post">';
                    echo'<div id="scrollbar"><div id="spacer"></div></div>';
                    echo'<div class="cm8-responsive" id="container2">';
                    echo '<table id="mytable2" class="cm8-uusitable2" style="table-layout:fixed;  max-width: 100%">  ';
                    echo'<thead>';
                    echo '<tr style="border: 2px solid #2b6777; background-color: #48E5DA;  font-size: 1em">';

                    if ($pisteet) {
                        if ($itsepisteytys) {
                            echo'<th>Tehtävä</th><th>Tehtävän<br>pistemäärä</th><th>Oma pisteytys<br>tehtävästä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti &nbsp&nbsp&nbsp</th><th style="border: none"></th></tr></thead><tbody>';
                        } else {
                            echo'<th>Tehtävä<th>Tehtävän<br>pistemäärä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti &nbsp&nbsp&nbsp</th><th style="border: none"></th></tr></thead><tbody>';
                        }
                    } else {

                        if ($itsepisteytys) {

                            echo'<th>Tehtävä</th><th>Oma pisteytys<br>tehtävästä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti&nbsp&nbsp&nbsp </th><th style="border: none"></th></tr></thead><tbody>';
                        } else {

                            echo'<th>Tehtävä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti&nbsp&nbsp&nbsp </th><th style="border: none"></th></tr></thead><tbody>';
                        }
                    }

                    while ($rowt = $haetehtavat->fetch_assoc()) {
                        if ($rowt[aihe] == 1) {

                            $sulkeutumispaiva2 = '';
                            $automaattinen = 0;
                            $sulkeutumiskello2 = '';

                            $sulkeutuu2 = $rowt[sulkeutuu];
                            $takaraja2 = '';
                            if (!empty($sulkeutuu2) && $sulkeutuu2 != ' ') {
                                $sulkeutumispaiva2 = substr($sulkeutuu2, 0, 10);
                                $sulkeutumispaiva2 = date("d.m.Y", strtotime($sulkeutumispaiva2));
                                $automaattinen = 1;
                                $sulkeutumiskello2 = substr($sulkeutuu2, 11, 5);
                                $takaraja2 = $sulkeutuu2;
                            }
                        }


                        if (!$haekp = $db->query("select distinct * from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND id IN (
   SELECT MIN(id) FROM itsetehtavatkp
   WHERE itsetehtavat_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'
) AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        $estaosio = ($takaraja2 != '' && $nyt > $takaraja2);
                        $osiovapaa = ($takaraja2 != '' && $nyt <= $takaraja2);

                        if ($itsepisteytys) {
                            //TÄHÄN MUOKATTU
                            if ($rowt[aihe] == 1 && $pisteet == 1) {
                                if ($rowt[aihekiinni] == 1) {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="5" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on suljettu!</em></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="5" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on sulkeutunut: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $osiovapaa)) {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="5" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio sulkeutuu: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                                } else {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="5" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                                }
                            } else if ($rowt[aihe] == 1 && $pisteet == 0) {
                                if ($rowt[aihekiinni] == 1) {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on suljettu!</em></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on sulkeutunut: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $osiovapaa)) {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio sulkeutuu: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                                } else {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                                }
                            } else {

                                while ($rowkp = $haekp->fetch_assoc()) {


                                    if ($pisteet) {

                                        if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == ''))) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            }
                                        } else if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio))) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            }
                                        } else if ($rowkp[tallennettu] == 0 && $rowt[aihekiinni] == 0) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        } else if ($rowkp[tallennettu] == 0 && ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio))) {



                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            }
                                        }

                                        //TÄÄÄ PITÄÄ TARKISTAA!!
                                        if ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio)) {
                                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            }
                                        } else {
                                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            if ($rowt[aihe] == 1 && $pisteet == 1) {
                                if ($rowt[aihekiinni] == 1) {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on suljettu!</em></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on sulkeutunut: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $osiovapaa)) {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio sulkeutuu: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                                } else {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                                }
                            } else if ($rowt[aihe] == 1 && $pisteet == 0) {
                                if ($rowt[aihekiinni] == 1) {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on suljettu!</em></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on sulkeutunut: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $osiovapaa)) {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio sulkeutuu: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                                } else {
                                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                                }
                            } else {

                                while ($rowkp = $haekp->fetch_assoc()) {


                                    if ($pisteet) {

                                        if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == ''))) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            }
                                        } else if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio))) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            }
                                        } else if ($rowkp[tallennettu] == 0 && $rowt[aihekiinni] == 0) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        } else if ($rowkp[tallennettu] == 0 && ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio))) {



                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            }
                                        }

                                        //TÄÄÄ PITÄÄ TARKISTAA!!
                                        if ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio)) {
                                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            }
                                        } else {
                                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        }
                                    } else {

                                        //EI ESTETTY KOKONAAN, EI PISTEITÄ
                                        if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == ''))) {
                                            //TÄSTÄ ETEENPÄIN ->

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            }
                                        } else if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio))) {
                                            //ESTO

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            }
                                        } else if ($rowkp[tallennettu] == 0 && $rowt[aihekiinni] == 0) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        } else if ($rowkp[tallennettu] == 0 && $rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio)) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey">>' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            }
                                        }

                                        if ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio)) {

                                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em;" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            }
                                        } else {
                                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if ($itsepisteytys) {
                        if ($pisteet) {
                            echo'<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
                        } else {
                            echo'<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
                        }
                    } else {
                        if ($pisteet) {
                            echo'<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
                        } else {
                            echo'<tr><td></td><td></td><td></td><td></td><td></td></tr>';
                        }
                    }


                    echo "</tbody></table>";

                    echo'<input type="hidden" name="ipid" id="ipid" value=' . $ipid . '></div>';

                    echo'</form>';
                } else {
                    echo'<div id="scrollbar"><div id="spacer"></div></div>';
                    echo'<div class="cm8-responsive" id="container2">';
                    echo '<table id="mytable2" class="cm8-uusitable2" style="table-layout:fixed;  max-width: 100%">  ';
                    echo'<thead>';
                    echo '<tr style="border: 2px solid #2b6777; background-color: #48E5DA;  font-size: 1em">';
                    if ($pisteet) {
                        if ($itsepisteytys) {
                            echo'<th>Tehtävä</th><th>Tehtävän<br>pistemäärä</th><th>Oma pisteytys<br>tehtävästä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti &nbsp&nbsp&nbsp</th><th style="border: none"></th></tr></thead><tbody>';
                        } else {
                            echo'<th>Tehtävä</th><th>Tehtävän<br>pistemäärä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti &nbsp&nbsp&nbsp</th><th style="border: none"></th></tr></thead><tbody>';
                        }
                    } else {

                        if ($itsepisteytys) {

                            echo'<th>Tehtävä</th><th>Oma pisteytys<br>tehtävästä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti&nbsp&nbsp&nbsp </th><th style="border: none"></th></tr></thead><tbody>';
                        } else {

                            echo'<th>Tehtävä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti&nbsp&nbsp&nbsp </th><th style="border: none"></th></tr></thead><tbody>';
                        }
                    }

                    while ($rowt = $haetehtavat->fetch_assoc()) {

                        if (!$haekp = $db->query("select distinct * from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND id IN (
   SELECT MIN(id) FROM itsetehtavatkp
   WHERE itsetehtavat_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'
) AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        if ($itsepisteytys) {
                            //TÄHÄN MUOKATTU
                            if ($rowt[aihe] == 1 && $pisteet == 1) {
                                echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                            } else if ($rowt[aihe] == 1 && $pisteet == 0) {
                                echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                            } else {

                                while ($rowkp = $haekp->fetch_assoc()) {

                                    if ($pisteet) {
                                        if ($rowkp[tallennettu] == 1) {


                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            }
                                        } else {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        }



                                        if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                            echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                        }
                                    } else {
                                        if ($rowkp[tallennettu] == 1) {


                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            }
                                        } else {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey">>' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        }



                                        if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                            echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                            echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                        }
                                    }
                                }
                            }
                        } else {
                            
                        }
                    }

                    echo "</tbody></table>";

                    echo'<input type="hidden" name="ipid" id="ipid" value=' . $ipid . '></div>';

                    echo'</form>';


                    //loppu           
                }
            }
        }
        echo'</div>';

        echo'</div>';
    }




    echo"</div>";
    echo"</div>";
    echo"</div>";
    echo'</div>';
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}



include("footer.php");



//$koko= microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
//echo'koko: '. $koko;
//$opekoko = microtime(true) - $opekoko;
//echo'<br>opekoko: '. $opekoko;
//
//$opewhile = microtime(true) - $opewhile;
//echo'<br>open while: '. $opewhile;
//
//echo'<br>open while sisällä 1 kerta: '. $opewhilesis01;
//echo'<br>open while sisällä 2 kerta: '. $opewhilesis02;
//echo'<br>open while sisällä 3 kerta: '. $opewhilesis03;
//echo'<br>tehtävämäärät: '. $tehtavanmaarat;
//echo'<br>osatutmäärät: '. $osatutmaarat;
//echo'<br>eiosatutmäärät: '. $eiosatutmaarat;
//echo'<br>kommentitmäärät: '. $kommentitmaarat;
//echo'<br>toiveetmäärät: '. $toiveetmaarat;
//echo'<br>loppuosa tehtävät: '. $loppuosa_tehtavat;
//echo'<br>tehtäviä: '. $maaratehtavat;
//echo'<br>open whileä kierretty: '. $maara;
//
//echo'<br>nyt: '. microtime(true);
?>
<script>
    $("#tama").hide();
    $("#siirto").hide();
    $("#klik2").show();
    $("#klik").hide();
    $("#klik").click(function () {

        $("#tama").hide();
        $("#siirto").hide();
        $("#klik2").show();

    });
    $("#klik2").click(function () {
        $("#tama").show();
        $("#tama1").show();
        $("#tama2").show();
        $("#tama3").show();

        $("#siirto").show();
        $("#siirto2").show();
        $("#klik2").hide();
        $("#klik").show();

    });
</script>


<script>


    $("#siirto").draggable();

</script>

<script>

    $("#siirto2").resizable({
        alsoResize: "#kirja"
    });
    $("#kirja").resizable();
</script>
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
    $("#mytable2").tableHeadFixer({"head": false, "left": 1});
</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
<script>


    var $table = $('#mytable');
    $table.floatThead({zIndex: 1});
    var $table2 = $('#mytable2');
    $table2.floatThead({zIndex: 1});

</script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script type="text/javascript" src="jscm/jquery.timepicker.js"></script>
<script src="jscm/jquery-ui.js"></script>
<script type="text/javascript" src="/js/fi.js"></script>
<script>

    (function () {
        $.datepicker.setDefaults($.datepicker.regional['fi']);
        var elem = document.createElement('input');
        elem.setAttribute('type', 'text');

        if (elem.type === 'text') {
            $('.kdate').datepicker({
                dateFormat: 'dd.mm.yy',
            });


        }
        $('.kello').timepicker({
            timeFormat: 'HH:mm',
            // year, month, day and seconds are not important
            minTime: new Date(0, 0, 0, 8, 0, 0),
            maxTime: new Date(0, 0, 0, 23, 55, 0),
            // time entries start being generated at 6AM but the plugin 
            // shows only those within the [minTime, maxTime] interval
            startHour: 6,
            // the value of the first item in the dropdown, when the input
            // field is empty. This overrides the startHour and startMinute 
            // options
            startTime: new Date(0, 0, 0, 8, 0, 0),
            maxTime: new Date(0, 0, 0, 23, 55, 0),
            // items in the dropdown are separated by at interval minutes
            interval: 15
        });


    })();


</script>




</body>
</html>		
