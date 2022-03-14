<?php
session_start(); 


ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
//if($_SESSION["Id"]==280){
//    $start = microtime(true);
//
//
//}

echo'<!DOCTYPE html><html> 
<head>
<title> Tehtävälista</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />';



include("yhteys.php");
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}


if (isset($_SESSION["Kayttajatunnus"])) {
    include("kurssisivustonheader.php");
    if ($_SESSION["Rooli"] == 'opiskelija') {
        include "libchart/libchart/classes/libchart.php";
    }
    echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 0px; border: none">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">
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
		
		  <a href="itsetyot.php" onclick="loadProgress()" class="currentLink" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
			
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

    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> ';

    echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">
';

    if (!isset($_GET[i])) {
        if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($hae_eka->num_rows != 0) {
            while ($rivieka = $hae_eka->fetch_assoc()) {
                $eka_id = $rivieka[id];
            }
            header('location: itsetyot.php?i=' . $eka_id);
        }
    }

    if (!$haeprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($haeprojekti->num_rows != 0) {
        echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
        while ($rowP = $haeprojekti->fetch_assoc()) {
            $kuvaus = $rowP[kuvaus];
            $id = $rowP[id];

            if ($_GET[i] == $id) {

                echo'<a href="itsetyot.php?i=' . $id . '"  style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
            } else {

                echo'<a href="itsetyot.php?i=' . $id . '"  style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
            }
        }

        echo'<div class="cm8-margin-top"></div>';
        if ($_SESSION["Rooli"] <> 'opiskelija') {
            echo'<form action="uusiitseprojektieka.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää uusi" class="myButton8"  role="button"  style="padding:2px 4px"></form><br><br>';
        }

        echo'</div>';
    }

    echo'

 
	
</nav>

 <div class="cm8-margin-top"></div>';

    if ($_SESSION["Id"] == 280) {
        if (!$haelinkki = $db->query("select distinct * from opiskelijankirja where kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($haelinkki->num_rows != 0) {



            while ($rowt = $haelinkit->fetch_assoc()) {

                echo'<p style="z-index: 1;position: fixed; top:2%; right:2%"> <iframe src="' . $rowt[linkki] . '" frameborder="0" width="680" height="389" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe><form action="poistakirja.php" method="post" > <input type="hidden" name="ipid" value="' . $_GET[i] . '"><input type="submit" value="X" title="Poista" class="myButton8"  role="button"  style="padding:2px 4px"></form></p>';
            }
        } else {
            echo'<p style="z-index: 1;position: fixed; top:2%; right:2%"><form action="lisaakirja.php" style="z-index: 1;position: fixed; top:2%; right:2%" method="post" > <input type="hidden" name="ipid" value="' . $_GET[i] . '"> <input type="submit" value="+ Lisää digikirja"  class="myButton8"  role="button"  style="padding:2px 4px"></form></p>';
        }
    }
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'</div>';
//                 if (!$haelista = $db->query("select distinct lista from itseprojektit where id='" . $ipid . "'")) {
//                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//                }
//
//                while ($rowl = $haelista->fetch_assoc()) {
//                    $lista = $rowl[lista];
//                }
    } else {
        echo'</div>';
    }

    echo'<div class="cm8-twothird" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px">';






    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {


        if ($_GET[i] == '') {
            if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            echo'<h6 style="padding-top: 20px; padding-bottom: 20px; font-size: 1.3em; color: #2b6777">Tehtävälista</h6>';
            if ($onkoprojekti->num_rows == 0) {

                echo'<form action="uusiitseprojektieka.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                echo'<br><br>Sivustolle on mahdollista luoda Tehtävälista-projekteja, jotka sisältävät kurssin/opintojakson suorittamiseen liittyvän tehtäväluettelon, johon opiskelijat voivat kirjata suorituksiaan.<br><br>';
            } else {
                echo'<br>Valitse oheisesta valikosta haluamasi Tehtävälista-osio.<br><br>';
            }
        } else {
            if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where id='" . $_GET[i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowP = $onkoprojekti->fetch_assoc()) {

                $ipid = $rowP[id];
                $kuvaus = $rowP[kuvaus];
                echo'<div class="cm8-margin-top"></div>';
                echo'<h6 id="' . $ipid . '" style="margin-right: 20px; padding-top: 0px; padding-bottom: 20px; font-size: 1.3em; color: #2b6777; display: inline-block">' . $kuvaus . '</h6><form action="muokkaaitseprojektieka.php" method="post" style="display: inline-block; margin-right:20px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa" class="muokkausN"  role="button"  style="padding:2px 4px"></form>';
                echo'<form action="varmistusitseprojekti.php" method="post" style="display: inline-block; margin-top: 20px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#10007" title="Poista projekti" class="myButton8"  role="button"  style="padding:2px 4px"></form>';

                if (!$haeinfo = $db->query("select distinct info from itseprojektit where id='" . $ipid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowv = $haeinfo->fetch_assoc()) {
                    $viesti = $rowv[info];
                }



                echo'<div class="cm8-responsive" style="margin-top:20px; width: 100%">';




                echo'<table class="cm8-table cm8-rounded cm8-fontti" style="margin-left: 0px; padding-left: 0px; padding-bottom: 20px; box-shadow: 2px 2px 2px #888888; width: 50%">';

                echo '<tr style="margin-bottom: 0px"><td></td><td style="text-align: right; width: 100% "><form action="ilmoitus.php" method="post" style="width: 100%; float: right; padding-bottom: 0px"><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="kuvaus" value=' . $kuvaus . '><input type="submit" name= "painikei" value="&#9998 Muokkaa" title="Muokkaa" class="muokkausN"  role="button"  style="padding: 2px 4px; font-size: 0.8em; float: right; margin-bottom: 0px"></form></td></tr>';


                echo'<tr><td style="text-align: left; padding-top: 0px; padding-bottom: 20px; width: 100%">';


                echo $viesti;

                echo '</td>';


                echo '<td></td>';
                echo'</tr> </table></div>';


                echo'<div class="cm8-margin-top"></div>';



                echo'<br><br><form action="tarkastele.php" method="get" style="display: inline-block"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" style="font-size: 1em" value="&#9763 Tarkastele opiskelijakohtaisia tilastoja" class="myButton8"  role="button"  style="padding:2px 4px"></form>';

                if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' ORDER BY jarjestys")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if (!$haetehtavat2 = $db->query("select distinct id from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                $yht = $haetehtavat2->num_rows;


                echo'<br><br><p style="color: #2b6777"><em>Tehtäviä on yhteensä: <b>' . $yht . ' kpl.</b></em></p>';
                echo'<p id="ohje">Klikkaamalla otsikkoa pääset tarkastelemaan, ketkä opiskelijat ovat yrittäneet tehdä siihen liittyviä tehtäviä.</em></p>';
                echo'<p id="ohje">Klikkaamalla tehtävää pääset tarkastelemaan siihen liittyviä tietoja.</p>';
                echo'<div class="cm8-margin-top"></div>';
                echo'<br><br><form action="testaamuokkaus.php" method="get"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa tehtäväluetteloa" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                echo'<div class="cm8-responsive">';
                echo '<table id="mytable" class="cm8-table cm8-bordered">  <thead>';

                echo '<tr style="border: 1px solid grey; background-color: #ffcceb" id="palaa"><th style="border: 1px solid grey">Tehtävä</th><th style="text-align: center; border: 1px solid grey ">Tehdyt yht.</th><th style="text-align: center; border: 1px solid grey ">Tehty<br>ja osattu</th><th style="text-align: center; border: 1px solid grey">Tehty,<br> mutta ei osattu ilman apua</th><th style="text-align: center; border: 1px solid grey">Toivottu yhdessä<br>läpikäytäväksi</th><th style="text-align: center; border: 1px solid grey">Kommentoitu'
                . '</th><th style="border: 1px solid transparent; background-color: white"></th></tr>  </thead><tbody>';

                while ($rowt = $haetehtavat->fetch_assoc()) {

                    if (!$haetoiveet = $db->query("select distinct id from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND toive=1")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    if (!$haeeiosatut = $db->query("select distinct id from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND osattu=0 AND tehty=1")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    if (!$haeosatut = $db->query("select distinct id from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND osattu=1")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    if (!$haekommentit = $db->query("select distinct id from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND kommentti<>''")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    $tehdyt = ($haeeiosatut->num_rows) + ($haeosatut->num_rows);
                    if ($rowt[aihe] == 1)
                        echo '<tr style="font-size: 0.9em; background-color:#d0d0d0; border-left: 1px solid; border-right: 1px solid"><td colspan="6" style="border-right: 1px solid"><a  href="ykskohdat2.php?id=' . $ipid . '&tid=' . $rowt[id] . '"><b>' . $rowt[otsikko] . '</b></a></td></tr>';
                    else {





                        echo ' <tr style="font-size: 0.9em"><td style="text-align: center; border: 1px solid grey; padding: 0"><a  href="ykskohdat.php?id=' . $ipid . '&tid=' . $rowt[id] . '" style="width:100%; display:block">' . $rowt[sisalto] . '</a></td><td style="text-align: center; border: 1px solid grey">' . $tehdyt . '</td><td style="text-align: center; border: 1px solid grey">' . $haeosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haeeiosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haetoiveet->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haekommentit->num_rows;




                        echo'</td><td style="border: 1px solid transparent"></td></tr>';
                    }
                }

                echo "</tbody></table>";
                ?>



                <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
                <script>
                    var $table = $('#mytable');

                    $table.floatThead({zIndex: 1});

                </script>        
                <?php
session_start(); 


                ob_start();

                echo"</div>";

                echo'<br><br><form action="testaamuokkaus.php" method="get"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa tehtäväluetteloa" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
            }
        }
        echo'</div>';
    }

    //opiskelija
    else {

        if (!isset($_GET[i]) || $_GET[i] == '') {
            if (!$onkoprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            echo'<h6 style="padding-top: 20px; padding-bottom: 20px; font-size: 1.3em; color: #2b6777">Tehtävälista</h6>';
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


                echo'<br><h6 style="padding-bottom: 20px; font-size: 1.3em; color: #2b6777; display: inline-block">' . $kuvaus . '</h6><br><br>';
                if (!$haeinfo = $db->query("select * from itseprojektit where id='" . $ipid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowv = $haeinfo->fetch_assoc()) {
                    $viesti = $rowv[info];
                }

                if ($viesti <> "") {

                    echo'<div class="cm8-responsive" style="margin-top:20px; width: 100%">';

                    echo'<table class="cm8-table cm8-rounded cm8-fontti" style="margin-left: 0px; padding-left: 0px; padding-bottom: 1'
                    . '0px; box-shadow: 2px 2px 2px #888888; width: 50%">';


                    echo'<tr><td style="text-align: left; padding-top: 20px; padding-bottom: 20px; width: 100%">';


                    echo $viesti;

                    echo '</td>';


                    echo'</tr> </table></div>';
                }



                echo'<div class="cm8-margin-top"></div>';


                if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' ORDER BY jarjestys")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if (!$haetehtavat2 = $db->query("select distinct id from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                $yht = $haetehtavat2->num_rows;


                if (!$haetehdyt = $db->query("select distinct itsetehtavatkp.id from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $_SESSION["Id"] . "' AND itsetehtavatkp.tehty=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                if (!$haeosatut = $db->query("select distinct itsetehtavatkp.id  from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $_SESSION["Id"] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if (!$haeeiosatut = $db->query("select distinct itsetehtavatkp.id  from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $_SESSION["Id"] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                $tehdyt = $haetehdyt->num_rows;
                $osatut = $haeosatut->num_rows;
                $eiosatut = $haeeiosatut->num_rows;
                $osatutnimi = 'Tehty ja osattu';
                $eiosatutnimi = 'Tehty, mutta ei osattu';
                $tekemattomatnimi = 'Tekemättä';
                $tehdythuijaus = 0;
                if (($yht - $tehdyt) >= 0) {
                    $tekemattomat = $yht - $tehdyt;
                } else {
                    $tekemattomat = 0;
                }



                if ($yht != 0) {
                    $osuus = ($tehdyt / $yht) * 100;
                    $osuus = round($osuus, 1);
                }
                if ($tehdyt != 0) {
                    $osuusosatut = ($osatut / $tehdyt) * 100;
                    $osuusosatut = round($osuusosatut, 1);
                }


//                echo'Tehtyjä tehtäviä: <b>' . $tehdyt . ' kpl.</b><br>';
//                if ($yht != 0)
//                    echo'
//                if ($tehdyt != 0)
//                    echo'Osattuja tehtäviä: <b>' . $osatut . ' kpl.</b> (' . $osuusosatut . ' % tehdyistä tehtävistä.)</em></p><br>';
                //new pie chart instance

                $chart2 = new PieChart(500, 300);
                //osatut,eiosatut,tekemattomat
                if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat <= $eiosatut) {
                    $chart2->getPlot()->getPalette()->setPieColor(array(
                        //vihree
                        new Color(127, 216, 88),
//punanen
                        new Color(0, 0, 255),
                        //valkonen
                        new Color(255, 255, 255),
                        new Color(255, 0, 153),
                    ));
                }

                //tekemattomat, osatut, eiosatut
                else if ($osatut >= $eiosatut && $osatut <= $tekemattomat && $tekemattomat >= $eiosatut) {
                    $chart2->getPlot()->getPalette()->setPieColor(array(
                        //valkonen
                        new Color(255, 255, 255),
                        //vihree
                        new Color(127, 216, 88),
//punanen
                        new Color(0, 0, 255),
                        new Color(255, 0, 153),
                    ));
                }
                //tekemattomat, eiosatut, osatut
                else if ($osatut <= $eiosatut && $osatut <= $tekemattomat && $tekemattomat >= $eiosatut) {
                    $chart2->getPlot()->getPalette()->setPieColor(array(
                        //valkonen
                        new Color(255, 255, 255),
//punanen
                        new Color(0, 0, 255),
                        //vihree
                        new Color(127, 216, 88),
                        new Color(255, 0, 153),
                    ));
                }
                //osatut,tekemattomat, eiosatut
                else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat >= $eiosatut) {
                    $chart2->getPlot()->getPalette()->setPieColor(array(
                        //vihree
                        new Color(127, 216, 88),
                        new Color(255, 255, 255),
//punanen
                        new Color(0, 0, 255),
                        //valkonen
                        new Color(255, 0, 153),
                    ));
                }

                //eiosatut, osatut, tekemattomat
                else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat >= $eiosatut) {
                    $chart2->getPlot()->getPalette()->setPieColor(array(
                        //punanen
                        new Color(0, 0, 255),
//vihree
                        new Color(127, 216, 88),
                        //valkonen
                        new Color(255, 255, 255),
                        new Color(255, 0, 153),
                    ));
                }
                //eiosatut, tekemattomat, osatut
                else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat >= $eiosatut) {
                    $chart2->getPlot()->getPalette()->setPieColor(array(
                        //punanen
                        new Color(0, 0, 255),
                        //valkonen
                        new Color(255, 255, 255),
                        //
                        //vihree
                        new Color(127, 216, 88),
                        new Color(255, 0, 153),
                    ));
                }
                //data set instance
                $dataSet2 = new XYDataSet();

                $dataSet2->addPoint(new Point("{$osatutnimi} ({$osatut} kpl)", $osatut));
                $dataSet2->addPoint(new Point("{$eiosatutnimi} ({$eiosatut} kpl)", $eiosatut));
                $dataSet2->addPoint(new Point("{$tekemattomatnimi} ({$tekemattomat} kpl)", $tekemattomat));

                //finalize dataset
                $chart2->setDataSet($dataSet2);

                //set chart title
                $chart2->setTitle("" . $_SESSION[Etunimi] . " " . $_SESSION[Sukunimi] . " ");

                $pienimi = 'sektori' . $_SESSION[Id] . '.png';

                //render as an image and store under "generated" folder
                $chart2->render("images/" . $pienimi);
                echo'<div class="cm8-responsive" style="overflow-y: hidden">';
                //pull the generated chart where it was stored
                echo "<img id='palaa' alt='Pie chart' src='images/" . $pienimi . "'/>";
                echo'</div>';

                echo'<ul style="color: #2b6777; font-weight: bold"><li>Tehtäviä yhteensä: ' . $yht . ' kpl.</li><li style="margin-left: 30px">Tehtyjä tehtäviä: ' . $osuus . ' %.</li></ul>';
                echo'<b style="color: #e608b8">Huom! Muista tallentaa tehtäväluettelo muokattuasi sitä!</b>';
                echo'<form action="tallennatehtavat.php" method="post">';
                echo'<br><br><input type="submit" name="painiket" value="&#10003 Tallenna" class="myButton9"  role="button"  style="padding:4px 6px">';

                echo'<div class="cm8-responsive">';
                echo '<table id="mytable2" class="cm8-table" style="text-align: center"><thead>';

                echo '<tr style="background-color: #ffcceb" ><th style="border: 1px solid grey">Tehtävä</th><th style="text-align: center; border: 1px solid grey">Osasin</th><th style="text-align: center; border: 1px solid grey">Tein,<br>mutta en osannut<br>ilman apua</th><th style="text-align: center; border: 1px solid grey">Haluan käydä<br>tunnilla läpi</th><th style="text-align: center; border: 1px solid grey">Kommentti</th><th style="border: none; background-color: white"></th></tr></thead><tbody>';

                while ($rowt = $haetehtavat->fetch_assoc()) {

                    if (!$haekp = $db->query("select distinct * from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    if ($rowt[aihe] == 1)
                        echo '<tr style="font-size: 0.9em; background-color:#d0d0d0; border-left: 1px solid; border-right: 1px solid"><td colspan="6" style="border-right: 1px solid"><a  href="ykskohdat2.php?id=' . $ipid . '&tid=' . $rowt[id] . '"><b>' . $rowt[otsikko] . '</b></a></td></tr>';
                    else {

                        while ($rowkp = $haekp->fetch_assoc()) {

//                                    if (!$onkotallennettu = $db->query("select distinct * from itsetehtavatkp where id='" . $rowkp[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
//                                       die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//                                   }
//                            
//                                    while ($rowtal = $onkotallennettu->fetch_assoc()) {
//                                        if ($rowtal[tehty] == 0 || $rowtal[toive] == 0 || $rowtal[kommentti] == '') {
//                                           $db->query("update itsetehtavatkp set tallennettu=0 where id='" . $rowkp[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                                        }                                     
//                                     }
//                                   





                            if ($rowkp[tallennettu] == 1) {


                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                    echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em; background-color: #7FD858"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a href="korjaatehtava.php?id=' . $ipid . '&teid=' . $rowt[id] . '" class="myButton8"  role="button"  style="padding:2px 4px; margin: 0px">&#9998</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em; background-color: white0ff"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a  href="korjaatehtava.php?id=' . $ipid . '&teid=' . $rowt[id] . '"  class="myButton8"  role="button"  style="padding:2px 4px; margin: 0px">&#9998</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em; background-color: #7FD858"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a  href="korjaatehtava.php?id=' . $ipid . '&teid=' . $rowt[id] . '"  class="myButton8"  role="button"  style="padding:2px 4px; margin: 0px">&#9998</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em; background-color: white0ff"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a  href="korjaatehtava.php?id=' . $ipid . '&teid=' . $rowt[id] . '"  class="myButton8"  role="button"  style="padding:2px 4px; margin: 0px">&#9998</a></td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] <> '') {

                                    echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a  href="korjaatehtava.php?id=' . $ipid . '&teid=' . $rowt[id] . '"  class="myButton8"  role="button"  style="padding:2px 4px; margin: 0px">&#9998</a></td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" "><td style="font-size: 0.9em; text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td style="background-color: white"><a  href="korjaatehtava.php?id=' . $ipid . '&teid=' . $rowt[id] . '"  class="myButton8"  role="button"  style="padding:2px 4px; margin: 0px">&#9998</a></td></tr>';
                                }
                            } else {
                                if ($rowt[id] == $_GET[minne]) {
                                    if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                        $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                        echo '<tr id="' . $rowt[id] . '"><td style="font-size: 0.9em; text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" rows="1" style="font-size: 0.9em" autofocus>' . $rowkp[kommentti] . '</textarea></td></tr>';
                                        echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                    } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                        $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                        echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista2[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" rows="1" style="font-size: 0.9em" autofocus>' . $rowkp[kommentti] . '</textarea></td></tr>';
                                        echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                    } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                        $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                        echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" rows="1" style="font-size: 0.9em" autofocus>' . $rowkp[kommentti] . '</textarea></td></tr>';
                                        echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                    } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                        $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                        echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista2[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" rows="1" style="font-size: 0.9em" autofocus>' . $rowkp[kommentti] . '</textarea></td></tr>';
                                        echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                    } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                        $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                        echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" rows="1" style="font-size: 0.9em" autofocus>' . $rowkp[kommentti] . '</textarea></td></tr>';
                                        echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                    } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0) {
                                        $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                        echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" rows="1" style="font-size: 0.9em" autofocus>' . $rowkp[kommentti] . '</textarea></td></tr>';
                                        echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                    }
                                } else {
                                    if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                        $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                        echo '<tr id="' . $rowt[id] . '"><td style="font-size: 0.9em; text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" rows="1" style="font-size: 0.9em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                        echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                    } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                        $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                        echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista2[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" rows="1" style="font-size: 0.9em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                        echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                    } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                        $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                        echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" rows="1" style="font-size: 0.9em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                        echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                    } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                        $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                        echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista2[]" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" rows="1" style="font-size: 0.9em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                        echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                    } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                        $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                        echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista3[]" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" rows="1" style="font-size: 0.9em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                        echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                    } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0) {
                                        $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                        echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" rows="1" style="font-size: 0.9em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                        echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
                                    }
                                }
                            }



                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style="font-size: 0.9em"><td style="text-align: center; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista2[]" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" name="lista3[]" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" rows="1" style="font-size: 0.9em">' . $rowkp[kommentti] . '</textarea></td></tr>';
                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="id[]" value=' . $rowkp[id] . '>';
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

                echo'</div><input type="hidden" name="ipid" value=' . $ipid . '>';
                echo'<br><br><input type="submit" name="painiket" value="&#10003 Tallenna" class="myButton9"  role="button"  style="padding:4px 6px">';
                echo'</form>';
            }
        }


        echo'</div>';
    }



//
//    
//        if($_SESSION["Id"]==280){
//    
//
//$time_elapsed_secs = microtime(true) - $start;
//echo'kokonaisaika: '.$time_elapsed_secs;
//
//
//        }




    echo'</div>';
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