<?php
session_start();


ob_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Materiaalit </title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />

<meta http-equiv="content-type" content="text/html; charset=UTF-8" >';


include("yhteys.php");
include("tsekkaa_oikeus.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
} 
if (isset($_SESSION["Kayttajatunnus"])) {

    include("kurssisivustonheader.php");



    echo '<div class="cm8-container7" id="paluu" style="margin-top: 0px; padding-top:0px; padding-bottom: 30px; margin-bottom: 0px; ">';

    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav" >
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

    if ($_SESSION["Rooli"] == "opiskelija") {
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



    echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 0px; border: none">';

    if (!$onkokansio = $db->query("select id from kansiot where kurssi_id='" . $_SESSION["KurssiId"] . "'order by nimi desc")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($onkokansio->num_rows == 0) {
        echo'<div class="cm8-third" style="width: 25%"><h2 style="padding-top: 0px; padding-left: 10px; padding-bottom: 0px" id="lisaa">Materiaalit</h2>';
    } else {
        echo'<div class="cm8-third"><h2 style="padding-top: 0px; padding-left: 10px; padding-bottom: 0px" id="lisaa">Materiaalit</h2>';

        echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; width: 70%; padding-left: 10px">';



        if (!$haekansio = $db->query("select * from kansiot where kurssi_id='" . $_SESSION["KurssiId"] . "' order by nimi")) {
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




            echo'<div class="cm8-sidenav" style="padding-left: 2px; margin-left: 0px; padding-top: 20px; margin-top:0px;  margin-left: 0px; height: 100%;">';


            while ($rowK = $haekansio->fetch_assoc()) {
                $nimi = $rowK[nimi];
                $id = $rowK[id];
                echo'<div style="">';
                if ($_GET[k] == $id) {
                    echo'<a id="' . $id . '" href="tiedostot.php?k=' . $id . '" class="btn-info3-valittu"  style="margin-right: 10px; margin-bottom: 5px;  padding: 3px 20px 3px 20px">&#128194 &nbsp <b>' . $nimi . '</b></a>';
                } else {
                    echo'<a id="' . $id . '" href="tiedostot.php?k=' . $id . '" class="btn-info3"  style="margin-right: 10px; margin-bottom: 5px;  padding: 3px 20px 3px 20px">&#128193 &nbsp ' . $nimi . '</a>';
                }
                echo'</div>';
            }


            if ($_SESSION["Rooli"] <> 'opiskelija') {
             
                echo'<br><b style="font-size: 0.7em">Avataanko 1. kansio automaattisesti?</b><br>';
                if (!$result = $db->query("select distinct ekakansio from kurssit where id = '" . $_SESSION[KurssiId] . "' AND ekakansio = 1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                echo'<form id="form2" name="form2" style="font-size: 0.7em" method="post" action="ekakansioauki.php">';
                if ($result->num_rows != 0) {


                    echo'<input type="radio" onchange="this.form.submit();" name="auki" value="1" checked>&nbsp Kyllä<br>';
                    echo'<input type="radio" name="auki" onchange="this.form.submit();" value="0">&nbsp Ei<br>';
                } else {
                    echo'<input type="radio" name="auki" onchange="this.form.submit();" value="1">&nbsp Kyllä<br>';
                    echo'<input type="radio" name="auki" onchange="this.form.submit();" value="0" checked>&nbsp Ei<br>';
                }
                echo'</form>';
                echo'<div class="cm8-margin-top"></div>';

                echo'<form action="uusikansio.php" method="post" style="display: inline-block; margin-right: 20px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää uusi kansio" class="myButton8"  role="button"  style="padding:4px 6px"></form>';

                echo'<form action="tuokansio.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '>';
                   echo'<button  name="painike" title="Tuo kansioita" class="myButton8" style="font-size: 0.8em"><i class="fa fa-recycle"></i>&nbsp&nbsp Tuo kansioita </button>';
  echo'</form><br><br>';
                echo'<form action="poistakaikkikansiot_varmistus.php" method="post" style="margin-top: 20px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><button class="pieniroskis" title="Poista kaikki kansiot" style="font-size: 0.8em"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista kaikki kansiot</button></form><br><br>';
            
                
                }

            echo'</div>';
        }





        echo' </nav> ';
    }


    echo'</div>';

    echo'<div id="content" class="cm8-twothird" >';

    if (!$result = $db->query("select distinct ekakansio from kurssit where id = '" . $_SESSION[KurssiId] . "' AND ekakansio = 1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($result->num_rows != 0) {
        $ekakansio = true;
    } else {
        $ekakansio = false;
    }

    if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {

        if (!isset($_GET[k]) && $ekakansio) {
            echo'<div class="cm8-margin-top"></div>';
            if (!$onkokansio = $db->query("select id from kansiot where kurssi_id='" . $_SESSION["KurssiId"] . "'order by nimi desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($onkokansio->num_rows == 0) {
                echo'<br><p id="ohje">Tähän osioon on mahdollista luoda kansioita, joihin voi koota erilaista kurssiin/opintojaksoon liittyvää materiaalia.</p>';
                echo'<div class="cm8-margin-top"></div>';
                echo'<form action="uusikansio.php" method="post" style="display: inline-block; margin-right: 40px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää kansio" class="myButton8"  role="button"  style="font-size: 1em; padding:4px 6px"></form>';
                echo'<form action="tuokansio.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '>';
            echo'<button  name="painike" title="Tuo kansioita" class="myButton8" style="font-size: 1em"><i class="fa fa-recycle"></i>&nbsp&nbsp Tuo aiemmin luotuja kansioita </button>';
  echo'</form><br><br>';
                } else if ($onkokansio->num_rows == 1) {
                while ($rowK = $onkokansio->fetch_assoc()) {

                    $kid = $rowK[id];
                }
                header('location: tiedostot.php?k=' . $kid);
            } else {
                while ($rowK = $onkokansio->fetch_assoc()) {

                    $kid = $rowK[id];
                }
                header('location: tiedostot.php?k=' . $kid);
            }
        } else if (!isset($_GET[k]) && !$ekakansio) {

            if (!$onkokansio = $db->query("select id from kansiot where kurssi_id='" . $_SESSION["KurssiId"] . "'order by nimi desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($onkokansio->num_rows == 0) {
      echo'<br><p id="ohje">Tähän osioon on mahdollista luoda kansioita, joihin voi koota erilaista kurssiin/opintojaksoon liittyvää materiaalia.</p>';
                echo'<div class="cm8-margin-top"></div>';
                echo'<form action="uusikansio.php" method="post" style="display: inline-block; margin-right: 40px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää kansio" class="myButton8"  role="button"  style="font-size: 1em; padding:4px 6px"></form>';
                echo'<form action="tuokansio.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '>';
           echo'<button  name="painike" title="Tuo kansioita" class="myButton8" style="font-size: 1em"><i class="fa fa-recycle"></i>&nbsp&nbsp Tuo aiemmin luotuja kansioita </button>';
  echo'</form><br><br>';
                } else if ($onkokansio->num_rows > 0) {
                echo'<br><br><b>Valitse haluamasi kansio.</b>';
            }
        } else {
            if (!$onkokansio = $db->query("select distinct * from kansiot where id='" . $_GET[k] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowK = $onkokansio->fetch_assoc()) {

                $kid = $rowK[id];
                $nimi = $rowK[nimi];
                echo'<div id="' . $kid . '"  class="cm8-margin-bottom" style="margin-top: 20px">';
                echo'<div> ';
                echo'<h6tiedosto style="margin-right: 40px; padding: 6px 10px 6px 20px; ">&#128194 &nbsp ' . $nimi;

                echo'<form action="muokkaakansio.php" method="post" style="margin-left: 60px;display: inline-block; "><input type="hidden" name="id" value=' . $kid . '><input type="submit" name="painike" value="&#9998" title="Muokkaa kansion nimeä" class="muokkausN"  role="button" style="font-size: 0.9em;" ></form>';
                echo'<form action="varmistuskansio.php" method="post" style="display: inline-block; "><input type="hidden" name="id" value=' . $kid . '><button class="roskis" title="Poista kansio" style="font-size: 1em"><i class="fa fa-trash-o" ></i></button></form>';

                echo'</h6tiedosto>';

            
                echo'</div>';
        echo'<br><form action="lisaaopetiedosto.php" method="post" style="margin-top: 10px; display: inline-block; margin-right: 20px" ><input type="hidden" name="kid" value=' . $kid . '> <input type="submit" value="+ Lisää uusi tiedosto/linkki" class="myButton8"  role="button"  style="padding:4px 6px"></form>';

                echo'<form action="tuoopetiedosto.php" method="get" style="display: inline-block; margin-top: 10px" ><input type="hidden" name="kid" value=' . $kid . '> <input type="submit" value="+ Tuo tiedosto/linkki toisesta kurssista/opintojaksosta" class="myButton8"  role="button"  style="padding:4px 6px"></form><br>';


                echo'<div class="cm8-margin-top"></div>';
                $jaljella2 = $haetiedostot->num_rows;
                if (!$haetiedostot = $db->query("select distinct * from tiedostot where kansio_id='" . $kid . "' order by omatallennusnimi")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                $numeric1 = 0;
                $numeric3 = 0;
                while ($roweka = $haetiedostot->fetch_assoc()) {
                    $id = $roweka[id];
                    $nimi = $roweka[omatallennusnimi];
                    if (is_numeric($rest = substr($nimi, 0, 1))) {

                        $numeric1 = 1;
                    } else if (is_numeric($rest = substr($nimi, 0, 3))) {

                        $numeric3 = 1;
                    }
                }

                if ($numeric1 == 1) {

                    if ($numeric3 == 1) {

                        if (!$haetiedostot = $db->query("select distinct * from tiedostot where kansio_id='" . $kid . "' order by  SUBSTR(omatallennusnimi FROM 1 FOR 1),
    CAST(SUBSTR(omatallennusnimi FROM 3) AS UNSIGNED)")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                    } else {
                        if (!$haetiedostot = $db->query("select distinct * from tiedostot where kansio_id='" . $kid . "' order by cast(omatallennusnimi as unsigned)")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                    }
                } else {
                    if (!$haetiedostot = $db->query("select distinct * from tiedostot where kansio_id='" . $kid . "' order by omatallennusnimi")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                }

                if ($haetiedostot->num_rows != 0) {

                    while ($rowt = $haetiedostot->fetch_assoc()) {
                        echo'<div class="cm8-margin-top"></div>';
                        if ($rowt[vanhalinkki] == 0) {
                            if ($rowt[linkki] == 1) {
                                $a = $rowt[kuvaus];

                                if (strpos($a, 'http') === false && strpos($a, 'https') === false) {
                                    $str_to_insert = 'http://' . $rowt[kuvaus];
                                    $rowt[kuvaus] = substr_replace($rowt[kuvaus], $str_to_insert, 0);
                                }
                                echo'<a href="' . $rowt[kuvaus] . '" target="_blank" class="cm8-linkki" style="; font-size: 1.1em; font-weight:bold"><b style="font-size: 0.9em">&#128279; &nbsp&nbsp</b>' . $rowt[omatallennusnimi] . '</a>';
                            } else {


                                echo'<a href="avaaopetiedosto.php?id=' . $rowt[id] . '" class="cm8-linkki"  target="_blank" style="; font-size: 1.1em; font-weight:bold"><b style="font-size: 0.9em"><i class="fa fa-file"></i>  &nbsp&nbsp</b>' . $rowt[omatallennusnimi] . '</a>';
                            }


                            if ($rowt[linkki] == 1) {
                                echo'<form action="muokkaatiedosto.php" method="post" style="display: inline-block; margin-left: 20px; margin-bottom: 0px"><input type="hidden" name="id" value=' . $rowt[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="hidden" name="kaid" value=' . $kid . '><input type="submit" name="painike" value="&#9998" title="Muokkaa tiedostoa" class="muokkausN"  role="button" ></form>';
                            }
                             if ($rowt[linkki] == 1) {
                                 echo'<form action="poistaopetiedostovarmistus.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $rowt[id] . '><input type="hidden" name="kaid" value=' . $kid . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><button class="roskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form><br>';
                            
                                
                             }
                            else{
                                   echo'<form action="poistaopetiedostovarmistus.php" method="post" style="margin-left: 20px;display: inline-block"><input type="hidden" name="id" value=' . $rowt[id] . '><input type="hidden" name="kaid" value=' . $kid . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><button class="roskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form><br>';
                            
                            }

                         
                            if ($rowt[linkki] == 0 && $rowt[tuotu] == 1) {
                                if (!$onkotuotu = $db->query("select distinct kurssit.nimi as kurssi, kurssit.koodi as koodi from tiedostot, kansiot, kurssit where tiedostot.kansio_id=kansiot.id AND tiedostot.nimi='" . $rowt[nimi] . "' AND tiedostot.tuotu=0 AND kansiot.kurssi_id=kurssit.id")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }
                                if ($onkotuotu->num_rows == 1) {
                                    while ($rowtuotu = $onkotuotu->fetch_assoc()) {
                                        $kurssi = $rowtuotu[kurssi];
                                        $koodi = $rowtuotu[koodi];
                                    }
//                                    echo'<em style="font-size: 0.8em">(Tuotu kurssista/opintojaksosta ' . $koodi . ' ' . $kurssi . ')</em><br><br>';
//                                
                                    
                                    } else {
                                    $maara = $onkotuotu->num_rows;
//                                    echo'<em style="font-size: 0.8em">(Tuotu muista kursseista)</em><br><br>';
                                }
                            }
//                            } else if ($rowt[linkki] == 1 && $rowt[tuotu] == 1) {
//                                if (!$onkotuotu = $db->query("select distinct kurssit.nimi as kurssi, kurssit.koodi as koodi from tiedostot, kansiot, kurssit where tiedostot.kansio_id=kansiot.id AND tiedostot.kuvaus='" . $rowt[kuvaus] . "' AND tiedostot.tuotu=0 AND kansiot.kurssi_id=kurssit.id")) {
//                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//                                }
//                                if ($onkotuotu->num_rows == 1) {
//                                    while ($rowtuotu = $onkotuotu->fetch_assoc()) {
//                                        $kurssi = $rowtuotu[kurssi];
//                                        $koodi = $rowtuotu[koodi];
//                                    }
//                                    echo'<em style="font-size: 0.8em">(Tuotu kurssista/opintojaksosta ' . $koodi . ' ' . $kurssi . ')</em><br><br>';
//                                } else {
//                                    $maara = $onkotuotu->num_rows;
//                                    echo'<em style="font-size: 0.8em">(Tuotu muista kursseista)</em><br><br>';
//                                  
//                                }
//                            }
                        } else {


                            if ($rowt[upotus] == 0 && $rowt[youtube] == 0) {
                                //onko http
                                $a = $rowt[kuvaus];

                                if (strpos($a, 'http') === false && strpos($a, 'https') === false) {
                                    $str_to_insert = 'http://' . $rowt[kuvaus];
                                    $rowt[kuvaus] = substr_replace($rowt[kuvaus], $str_to_insert, 0);
                                }

                                if ($rowt[omatallennusnimi] == '') {
                                    echo'<a href="' . $rowt[kuvaus] . '" target="_blank" class="cm8-linkki" style="; font-size: 1.1em; font-weight:bold"><b style="font-size: 0.9em">&#128279; &nbsp&nbsp</b>' . $rowt[kuvaus] . '</a>';
                                } else {
                                    echo'<a href="' . $rowt[kuvaus] . '" target="_blank" class="cm8-linkki" style="; font-size: 1.1em; font-weight:bold"><b style="font-size: 0.9em">&#128279; &nbsp&nbsp</b>' . $rowt[omatallennusnimi] . '</a>';
                                }
                            } else if ($rowt[upotus] == 1 && $rowt[youtube] == 0) {

                                echo'<b style="; font-size: 1.1em; font-weight:bold"><b style="font-size: 0.9em"><i class="fa fa-file-code-o" aria-hidden="true"></i></b> &nbsp&nbsp ' . $rowt[omatallennusnimi] . '</b><br><br>';
                                //onko http
                                $a = $rowt[kuvaus];

                                if (strpos($a, 'http') === false && strpos($a, 'https') === false) {
                                    $str_to_insert = 'http://' . $rowt[kuvaus];
                                    $rowt[kuvaus] = substr_replace($rowt[kuvaus], $str_to_insert, 0);
                                }



                                $a = $rowt[kuvaus];

                                if (strpos($a, 'pub?') !== false) {
                                    $rowt[kuvaus] = str_replace("pub?", "embed?", $a);

                                    echo'<iframe src="' . $rowt[kuvaus] . '" frameborder="1" width="480" height="389" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';
                                } else {

                                    echo'<iframe src="' . $rowt[kuvaus] . '" frameborder="1" width="480" height="389" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';
                                }
                            } else {
                                echo'<b style="; font-size: 1.1em; font-weight:bold">&#9658; &nbsp&nbsp' . $rowt[omatallennusnimi] . '</b><br><br>';
                                //etsitään varsinainen osoite
                                echo'<iframe src="' . $rowt[kuvaus] . '" frameborder="1" width="480" height="389" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';
                            }

                            echo'<form action="muokkaatiedosto.php" method="post" style="display: inline-block; margin-left: 20px; margin-bottom: 0px"><input type="hidden" name="id" value=' . $rowt[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="hidden" name="kaid" value=' . $kid . '><input type="submit" name="painike" value="&#9998" title="Muokkaa" class="muokkausN"  role="button"  ></form>';
                            echo'<form action="poistaopetiedostovarmistus.php" method="post" style="display: inline-block; padding-bottom: 0px"><input type="hidden" name="id" value=' . $rowt[id] . '><input type="hidden" name="kaid" value=' . $kid . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><button class="roskis" title="Poista tiedosto"><i class="fa fa-trash-o" ></i></button></form><br>';
                        }

                        //TÄHÄN LOPPUU KOKO WHILE
                    }
                } else {
                    echo'<br><br><em>Tähän kansioon ei ole lisätty materiaalia.</em><br><br>';
                }
                echo'</div>';
            }
      
        }
    } else {

        if (!$onkokansio = $db->query("select id from kansiot where kurssi_id='" . $_SESSION["KurssiId"] . "' order by nimi desc")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($onkokansio->num_rows == 0) {
            echo'<br><p id="ohje">Ei materiaaleja.</p>';
        } else {

            if (!isset($_GET[k]) && $ekakansio) {
                echo'<div class="cm8-margin-top"></div>';

                if ($onkokansio->num_rows == 0) {



                    echo'<br><p id="ohje">Ei materiaaleja.</p>';
                } else if ($onkokansio->num_rows == 1) {
                    while ($rowK = $onkokansio->fetch_assoc()) {

                        $kid = $rowK[id];
                    }
                    header('location: tiedostot.php?k=' . $kid);
                } else {
                    while ($rowK = $onkokansio->fetch_assoc()) {

                        $kid = $rowK[id];
                    }
                    header('location: tiedostot.php?k=' . $kid);
                }
            } else if (!isset($_GET[k]) && !$ekakansio && $onkokansio->num_rows > 0) {


                echo'<br><br><b>Valitse haluamasi kansio.</b>';
            } else {
                if (!$onkokansio = $db->query("select distinct * from kansiot where id='" . $_GET[k] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowK = $onkokansio->fetch_assoc()) {

                    $kid = $rowK[id];
                    $nimi = $rowK[nimi];
                    echo'<div id="' . $kid . '"  class="cm8-margin-bottom" style="margin-top: 20px">';
                    echo'<h6tiedosto style="padding-right: 100px">&#128194 &nbsp' . $nimi . '</h6tiedosto>';




                    echo'<div class="cm8-margin-top"></div>';
                    $jaljella2 = $haetiedostot->num_rows;

                    if (!$haetiedostot = $db->query("select distinct * from tiedostot where kansio_id='" . $kid . "' order by omatallennusnimi")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    $numeric1 = 0;
                    $numeric3 = 0;
                    while ($roweka = $haetiedostot->fetch_assoc()) {
                        $id = $roweka[id];
                        $nimi = $roweka[omatallennusnimi];
                        if (is_numeric($rest = substr($nimi, 0, 1))) {

                            $numeric1 = 1;
                        } else if (is_numeric($rest = substr($nimi, 0, 3))) {

                            $numeric3 = 1;
                        }
                    }

                    if ($numeric1 == 1) {

                        if ($numeric3 == 1) {

                            if (!$haetiedostot = $db->query("select distinct * from tiedostot where kansio_id='" . $kid . "' order by  SUBSTR(omatallennusnimi FROM 1 FOR 1),
    CAST(SUBSTR(omatallennusnimi FROM 3) AS UNSIGNED)")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }
                        } else {
                            if (!$haetiedostot = $db->query("select distinct * from tiedostot where kansio_id='" . $kid . "' order by cast(omatallennusnimi as unsigned)")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }
                        }
                    } else {
                        if (!$haetiedostot = $db->query("select distinct * from tiedostot where kansio_id='" . $kid . "' order by omatallennusnimi")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                    }
                    $jaljella = $haetiedostot->num_rows;
                    $jaljella2 = $haetiedostot->num_rows;
                    if ($haetiedostot->num_rows != 0) {

                        while ($rowt = $haetiedostot->fetch_assoc()) {
                            echo'<div class="cm8-margin-top"></div>';
                            if ($rowt[vanhalinkki] == 0) {
                                if ($rowt[linkki] == 1) {
                                    $a = $rowt[kuvaus];

                                    if (strpos($a, 'http') === false && strpos($a, 'https') === false) {
                                        $str_to_insert = 'http://' . $rowt[kuvaus];
                                        $rowt[kuvaus] = substr_replace($rowt[kuvaus], $str_to_insert, 0);
                                    }
                                    echo'<a href="' . $rowt[kuvaus] . '" target="_blank" class="cm8-linkki" style="; font-size: 1.1em; font-weight:bold"><b style="font-size: 0.9em">&#128279; &nbsp&nbsp</b>' . $rowt[omatallennusnimi] . '</a>';
                                } else {




                                    echo'<a href="avaaopetiedosto.php?id=' . $rowt[id] . '" class="cm8-linkki"  target="_blank" style="; font-size: 1.1em; font-weight:bold"><b style="font-size: 0.9em"><i class="fa fa-file"></i>  &nbsp&nbsp</b>' . $rowt[omatallennusnimi] . '</a>';
                                }
                            } else {


                                if ($rowt[upotus] == 0 && $rowt[youtube] == 0) {
                                    //onko http
                                    $a = $rowt[kuvaus];

                                    if (strpos($a, 'http') === false && strpos($a, 'https') === false) {
                                        $str_to_insert = 'http://' . $rowt[kuvaus];
                                        $rowt[kuvaus] = substr_replace($rowt[kuvaus], $str_to_insert, 0);
                                    }

                                    if ($rowt[omatallennusnimi] == '') {
                                        echo'<a href="' . $rowt[kuvaus] . '" target="_blank" class="cm8-linkki" style="; font-size: 1.1em; font-weight:bold"><b style="font-size: 0.9em">&#128279; &nbsp&nbsp</b>' . $rowt[kuvaus] . '</a>';
                                    } else {
                                        echo'<a href="' . $rowt[kuvaus] . '" target="_blank" class="cm8-linkki" style="; font-size: 1.1em; font-weight:bold"><b style="font-size: 0.9em">&#128279; &nbsp&nbsp</b>' . $rowt[omatallennusnimi] . '</a>';
                                    }
                                } else if ($rowt[upotus] == 1 && $rowt[youtube] == 0) {

                                    echo'<b style="; font-size: 1.1em; font-weight:bold"><b style="font-size: 0.9em"><i class="fa fa-file-code-o" aria-hidden="true"></i></b> &nbsp&nbsp ' . $rowt[omatallennusnimi] . '</b><br><br>';
                                    //onko http
                                    $a = $rowt[kuvaus];

                                    if (strpos($a, 'http') === false && strpos($a, 'https') === false) {
                                        $str_to_insert = 'http://' . $rowt[kuvaus];
                                        $rowt[kuvaus] = substr_replace($rowt[kuvaus], $str_to_insert, 0);
                                    }



                                    $a = $rowt[kuvaus];

                                    if (strpos($a, 'pub?') !== false) {
                                        $rowt[kuvaus] = str_replace("pub?", "embed?", $a);

                                        echo'<iframe src="' . $rowt[kuvaus] . '" frameborder="1" width="480" height="389" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';
                                    } else {

                                        echo'<iframe src="' . $rowt[kuvaus] . '" frameborder="1" width="480" height="389" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';
                                    }
                                } else {
                                    echo'<b style="; font-size: 1.1em; font-weight:bold">&#9658; &nbsp&nbsp' . $rowt[omatallennusnimi] . '</b><br><br>';
                                    //etsitään varsinainen osoite
                                    echo'<iframe src="' . $rowt[kuvaus] . '" frameborder="1" width="480" height="389" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';
                                }
                            }
                        }
                    } else {
                        echo'<em>Tähän kansioon ei ole lisätty materiaalia.</em><br><br>';
                    }

                    echo'</div>';
                }
            }
        }
    }

    if (!$haetiedostot = $db->query("select distinct * from tiedostot where kansio_id='" . $kid . "' order by omatallennusnimi")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }





    if ($haetiedostot->num_rows == 1) {
        while ($rowt = $haetiedostot->fetch_assoc()) {
            $upotus = $rowt[upotus];
            $youtube = $rowt[youtube];
            $linkki = $rowt[linkki];
            $kuvaus = $rowt[kuvaus];
            $tid = $rowt[id];
        }
        if ($_SESSION[Rooli] <> 'opiskelija' && $upotus == 0 && $youtube == 0) {

            echo'<div class="cm8-margin-top"></div>';
            echo'<b style="font-size: 0.8em">Avataanko kansion sisältämä tiedosto automaattisesti?</b><br><br>';
            if (!$result = $db->query("select distinct ekakansio from kansiot where id = '" . $_GET[k] . "' AND ekakansio = 1")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            echo'<form id="form2" name="form2" style="font-size: 0.9em" method="post" action="ekatiedostoauki.php">';
            if ($result->num_rows != 0) {


                echo'<input type="radio" onchange="this.form.submit();" name="auki" value="1" checked>&nbsp Kyllä<br>';
                echo'<input type="radio" name="auki" onchange="this.form.submit();" value="0">&nbsp Ei<br>';
            } else {
                echo'<input type="radio" name="auki" onchange="this.form.submit();" value="1">&nbsp Kyllä<br>';
                echo'<input type="radio" name="auki" onchange="this.form.submit();" value="0" checked>&nbsp Ei<br>';
            }
            echo'<input type="hidden" name="kansio" value=' . $_GET[k] . '>';
            echo'</form>';
        }
        if (!$result2 = $db->query("select distinct ekakansio from kansiot where id = '" . $_GET[k] . "' AND ekakansio = 1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($result2->num_rows != 0) {
            $ekatiedosto = true;
        } else {
            $ekatiedosto = false;
        }

        if ($ekatiedosto) {
            echo'<p style="color: #e608b8; font-weight: bold">Jos tiedosto ei aukea automaattisesti, niin tarkista, että selaimen ponnahdusikkunat on sallittu.</p>';


            if ($linkki == 1 && $upotus == 0 && $youtube == 0) {
                ?>

                <script type="text/javascript" language="Javascript">var myvar = <?php
session_start();
                ob_start();
                echo json_encode($kuvaus);
                ?>; window.open(myvar);</script> 
                <?php
session_start();
                ob_start();
            } else if ($linkki == 0) {

                $ohjaa = "avaaopetiedosto.php?id=" . $tid;
                ?>

                <script type="text/javascript" language="Javascript">var myvar = <?php
session_start();
                ob_start();
                echo json_encode($ohjaa);
                ?>; window.open(myvar);</script> 
                <?php
session_start();
                ob_start();
            }
        }
    }

    echo'</div>';

    echo'</div>';
    echo'</div>

</div>';
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

