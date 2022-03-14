<?php
session_start(); 


ob_start();



ini_set('display_errors', '0');
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


    $startkoko = microtime(true);
    include("diagrammit.php");
    include("dmalli.php");
    include("dmalli2.php");
    include("diagrammit3.php");
    include("pie.php");

    if (!$result0 = $db->query("select distinct id from itseprojektit where kurssi_id='" . $_SESSION[KurssiId] . "' AND eka_auki = 1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($result0->num_rows != 0) {
        while ($rowe = $result0->fetch_assoc()) {
            $ekaid = $rowe[id];
        }

        if ($_GET[i] != $ekaid && !isset($_GET[valittu])) {
            header('location: itsetyot.php?i=' . $ekaid);
        }
    } else {

        if (!$haeprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($haeprojekti->num_rows == 1 && !isset($_GET[i])) {

            if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rivieka = $hae_eka->fetch_assoc()) {
                $eka_id = $rivieka[id];
            }

            header('location: itsetyot.php?i=' . $eka_id);
        }
    }


    if (isset($_GET[i])) {
//        if (!$haelinkki = $db->query("select distinct * from opiskelijankirja where itseprojekti_id='" . $_GET[i] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
//            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//        }
//
//        if ($haelinkki->num_rows != 0) {
//
//
//
//            while ($rowt = $haelinkki->fetch_assoc()) {
//                echo'<div style="display:none" id="tama1" class="cm8-half"><br></div>';
//                echo'<div style="display:none" id="tama" class="cm8-half">';
//                echo'<div  style="display:none" id="siirto"  title="Voit siirtää aluetta!" style="width: auto; height: auto;z-index: 1001;position: fixed !important;">';
//                echo'<div  style="display:none" id="siirto2" >';
//
//
//          
//                if ($rowt[kirjautuminen] != '') {
//                          echo'<p style="margin: 0px 0px 0px 5px;  display: inline-block; color:  #e608b8;  font-size: 0.8em; "><b>Huom! Jos istuntosi on vanhentunut, kirjaudu kustantajan sivulle ja päivitä sivu.';
//
//                    echo'&nbsp&nbsp&nbsp<a href="' . $rowt[kirjautuminen] . '" target="_blank"  class="digilinkki"> Kirjaudu tästä  >> </a></b></p>';
//                                    echo' <button id="klik" class="myButton8"  style="display: inline-block; margin-left: 30px; font-size: 0.7em" title="Piilota näkyvistä">- Piilota</button>';
//                echo'<form action="poistakirjavarmistus.php" method="post" style="display: inline-block; margin: 0px 5px 0px 10px"> <input type="hidden" name="ipid" id="ipid" value="' . $_GET[i] . '"><button class="pieniroskis" title="Poista digikirja" style="font-size: 0.7em"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i>&nbsp&nbsp&nbspPoista</button></form>';
//
//                } else {
//                                    echo'<p style="margin: 0px 0px 0px 5px;  display: inline-block; color:  #e608b8;  font-size: 0.8em; "><b>Huom! Jos istuntosi on vanhentunut, kirjaudu kustantajan sivulle ja päivitä sivu.';
//
//                    echo'</b></p>';
//                               echo' <button id="klik" class="myButton8"  style="display: inline-block; margin-left: 30px; font-size: 0.7em" title="Piilota näkyvistä">- Piilota</button>';
//                echo'<form action="poistakirjavarmistus.php" method="post" style="display: inline-block; margin: 0px 5px 0px 10px"> <input type="hidden" name="ipid" id="ipid" value="' . $_GET[i] . '"><button class="pieniroskis" title="Poista digikirja" style="font-size: 0.7em"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i>&nbsp&nbsp&nbspPoista</button></form>';
//
//                }
//                echo'<p style="color: #080708; font-weight: bold; text-align: center; margin-top: 0px; padding-top: 0px;">Voit siirtää ja muuttaa alueen kokoa!</p>';
//                echo'<iframe id="kirja" title="kirja" src="' . $rowt[linkki] . '" style="width: 100%"  allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';
//
//
//                echo'</div>';
//                echo'</div>';
//                echo'</div>';
//            }
//        } else {
//
//            echo'<p style="z-index: 1001;position: fixed; top:30%; right:1%"><form action="lisaakirja.php" style="z-index: 1001;position: fixed; top:60%; right: 1%" method="post" > <input type="hidden" name="ipid" id="ipid" value="' . $_GET[i] . '"> <input type="submit" value="+ Digikirja"  class="myButtonOhjeA"  role="button" title="Lisää digikirja" id="maalaa" style="padding:2px 4px; font-size: 0.9em"></form></p>';
//        }
    }
    echo'
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
<meta charset="UTF-8">
<link rel="shortcut icon" href="favicon.png" type="image/png">
<link rel="stylesheet" href="css/TimeCircles.css" />
<link href="https://fonts.googleapis.com/css?family=Playfair+Display+SC:400,700" rel="stylesheet" type="text/css"> <link href="//fonts.googleapis.com/css?family=Questrial" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Actor" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css"> 
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Neucha" />
<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




  <link rel="stylesheet" href="css/trontastic.css" />




  
<link rel="stylesheet" type="text/css" href="jscm/jquery.timepicker.css" /><link rel="stylesheet" type="text/css" href="jscm/jquery.datepicker.css" />
<link href="ulkoasu.css" rel="stylesheet" type="text/css">


<link href="alertbox.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link rel="stylesheet" href="css/fontawesome-stars.css">
<link rel="stylesheet" href="css/fontawesome-stars-o.css">

 <link rel="stylesheet" href="css/tekstieditori.css">
   <link rel="stylesheet" href="css/buttons.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



<script src="funktioita.js" language="javascript" type="text/javascript"></script>

<script src="jquery.ui.touch-punch.min.js"></script>';

    echo'<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
    </script>
   


<script type="text/javascript" src="js/TimeCircles.js"></script>
 <script src="toinen.js" language="javascript" type="text/javascript"></script>





';

    echo'</head>';
    $url = $_SERVER[REQUEST_URI];
    if (strpos($url, "?")) {
        $url = substr($url, 0, strpos($url, "?"));
    }

    $url = substr($url, 1);
    $url = strtok($url, '?');

    if ($url == 'aanestykset.php') {
        if (isset($_GET[a]))
            echo'<body onload="startLoad6(' . $_GET[a] . ')">';
        else
            echo'<body onload="startLoad6(0)">';
    }
    else if ($url == 'kurssi.php') {
        echo'<body onload="piilota2();siirra();muunna();">';
    } else if ($url == 'itsetyot.php') {
        echo'<body onload="suljeOhje()">';
    } else if ($url == 'muokkaaprojekti2.php') {
        if (!$haeoppilaat = $db->query("select distinct * from opiskelijankurssit where ryhma_id <> 0 AND projekti_id='" . $_SESSION[r] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeoppilaat->num_rows != 0) {
            echo'<body onload="Varoitus(); ">';
        } else {
            echo'<body>';
        }
    } else if ($url == 'keskustelut.php') {

        echo'<body onload="startLoad2()">';
    } else if ($url == 'uusiaanestykset.php') {
        if ($_GET[tall] == 1) {
            echo'<body onload="lataa()">';
        } else {
            echo'<body onload="startLoad6()">';
        }
    } else {
        echo'<body>';
    }







// ready to go!
    $url = $_SERVER[REQUEST_URI];
    if (strpos($url, "?")) {
        $url = substr($url, 0, strpos($url, "?"));
    }

    $url = substr($url, 1);
    $url = strtok($url, '?');

    if ($url == 'aanestykset.php') {
        if (isset($_GET[a]))
            echo'<body onload="startLoad6(' . $_GET[a] . ')">';
        else
            echo'<body onload="startLoad6(0)">';
    }
    else if ($url == 'kurssi.php') {
        echo'<body onload="piilota2();siirra();muunna();">';
    } else if ($url == 'itsetyot.php') {
        echo'<body onload="suljeOhje()">';
    } else if ($url == 'muokkaaprojekti2.php') {
        if (!$haeoppilaat = $db->query("select distinct * from opiskelijankurssit where ryhma_id <> 0 AND projekti_id='" . $_SESSION[r] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haeoppilaat->num_rows != 0) {
            echo'<body onload="Varoitus(); ">';
        } else {
            echo'<body>';
        }
    } else if ($url == 'keskustelut.php') {

        echo'<body onload="startLoad2()">';
    } else if ($url == 'keskustelut8.php') {

        echo'<body onload="startLoad8()">';
    } else if ($url == 'uusiaanestykset.php') {
        if ($_GET[tall] == 1) {
            echo'<body onload="lataa()">';
        } else {
            echo'<body onload="startLoad6()">';
        }
    } else {
        echo'<body>';
    }



// ready to go!

    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);

    echo'<div class="cm8-container7" style="padding-bottom: 0px;">';
    echo'<div class="cm8-container4" style="border: none;margin-left: 0px; padding-left: 10px; padding-top: 10px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px; ;padding-right: 20px; margin-right: 0px; margin-bottom: 0px">';
    if (!$result8 = $db->query("select distinct * from koulut where id='" . $_SESSION["kouluId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row8 = $result8->fetch_assoc()) {
        echo '<div class="cm8-quarter" style="margin-top: 0px; padding-top: 0px;margin-left: 0px"; padding-left: 10px">';
        echo'<h1 style="font-size: 1.2em; padding-top: 0px; padding-bottom: 0px; display: inline-block;"><a href="etusivu.php">Cuulis</h1>
  <b style="font-size: 0.8em; display: inline-block">&nbsp - &nbspoppimisympäristö</b></a><br>';
        echo'<img src="/' . $row8[kuva] . '" style="margin-left: 10px; padding-top: 10px; height: 80px; max-width: 100px; margin-bottom: 1px">';

        echo'</div>';

        if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin' || $_SESSION["Rooli"] == 'opiskelija') {
            $originalDate = $_SESSION["Koepvm"];
            $kello = $_SESSION["Koeaika"];
            $_SESSION["Alkupvm"] = date("d.m.Y", strtotime($_SESSION["Alkupvm"]));
            $_SESSION["Loppupvm"] = date("d.m.Y", strtotime($_SESSION["Loppupvm"]));
            $newDate = date("Y-m-d", strtotime($originalDate));
            $koe = $newDate . ' ' . $kello;
            $nyt = date("Y-m-d H:i");

            if ($_SESSION["Sallicd"] == 1 && date("Y-m-d H:i") <= $koe && $originalDate != '' && $kello != '') {
                echo'<div class="cm8-half" style="text-align: center;">';

                echo'<div style="padding-top: 0px; height: 60px; text-align: center; display: inline-block; ">';

                echo'<H2 style="padding-top: 0px;font-size: 1.4em; color: #2b6777; display: inline-block; margin-right: 80px">' . $_SESSION["Koodi"] . ' ' . $_SESSION["KurssiNimi"] . '<br> <b style="font-size: 0.6em">' . $_SESSION[Alkupvm] . '-' . $_SESSION[Loppupvm] . '</b></H2>';
                echo'<br><br></div>';


                echo'<div class="demo" data-date="' . $newDate . ' ' . $kello . '" style="padding-top: 0px; height: 60px; text-align: center; display: inline-block; ">';

                echo'<script language="javascript" type="text/javascript">
	count();
</script>';
                echo'<p style="font-size: 0.8em; margin-top: 10px"> (Koe on ' . $originalDate . ' klo ' . $kello . ')</p></div>';
                echo'<br>';
                echo'<br>';
            } else if ($_SESSION["Sallicd"] == 1 && date("Y-m-d H:i") > $koe && $originalDate != '' && $kello != '') {
                echo'<div class="cm8-half" style="text-align: center"><H2 style="padding-left: 0px; margin-left: 0px; padding-top: 10px; font-size: 1.4em; color: #2b6777; padding-bottom: 0px; margin-bottom: 0px">' . $_SESSION["Koodi"] . ' ' . $_SESSION["KurssiNimi"] . '<br><b style="font-size: 0.6em">' . $_SESSION[Alkupvm] . '-' . $_SESSION[Loppupvm] . '</b></H2>';

                echo'<p style="font-size: 0.7em; margin-top: 15px"><em>(Koe oli ' . $originalDate . ' klo ' . $kello . ')</em></p>';
            } else {
                echo'<div class="cm8-half" style="text-align: center"><H2 style="padding-left: 0px; margin-left: 0px; padding-top: 10px; font-size: 1.4em; color: #2b6777; padding-bottom: 0px; margin-bottom: 0px">' . $_SESSION["Koodi"] . ' ' . $_SESSION["KurssiNimi"] . '<br><b style="font-size: 0.6em">(' . $_SESSION[Alkupvm] . '-' . $_SESSION[Loppupvm] . ')</b></H2>';
            }
            if (!$tulosP = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "' AND opettaja_id='" . $_SESSION["Id"] . "'")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }
            if (!$onkoadmin = $db->query("select distinct * from kayttajat where id='" . $_SESSION["Id"] . "' AND rooli='admin'")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }

            if ($tulosP->num_rows != 0 || $onkoadmin->num_rows == 1) {

                if (($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') && $_SESSION["vaihto"] == 0) {

                    echo'<form action="muokkaakurssi.php" method="post" ><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '> <input type="submit" value="&#9998 Muokkaa tietoja" title="Muokkaa tietoja" class="munNappula3"  role="button"></form>';
                }
            }
        }

        echo'</div><div class="cm8-quarter" > ';
        echo'<a href="sulje_kurssisivu.php" role="button" > ';
        echo'<div class="close-container" style="float: right">
 
<div class="leftright"></div>
  <div class="rightleft"></div>
  
 <label class="close suljelabel" style="margin-top: 50px">Sulje kurssisivu</label>  

</div>';
        echo'</a>';

        if (!$tulosP = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "' AND opettaja_id='" . $_SESSION["Id"] . "'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }
        if (!$onkoadmin = $db->query("select distinct * from kayttajat where id='" . $_SESSION["Id"] . "' AND rooli='admin'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }


        if (($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin')) {
            echo'<div class="close-container" style="float: right; margin-top: 80px; margin-right: 40px">';
            echo'<form action="vaihda.php" method="post"><input type="hidden" name="url" value="' . $url . '" ><input type="hidden" name="arvo" value="vaihda"> <input type="submit" value="Opiskelijanäkymä" class="munNappula"  role="button"></form>';
            echo'</div>';
        } else if ($_SESSION["Rooli"] == 'opiskelija' && $_SESSION["vaihto"] == 1) {
            echo'<div class="close-container" style="float: right; margin-top: 65px; margin-right: 80px; margin-bottom: 10px">';

            echo'<br><form action="vaihda.php" method="post"><input type="hidden" name="url" value="' . $url . '" ><input type="hidden" name="arvo" value="pois"> <input type="submit" value="Poistu opiskelijanäkymästä" class="munNappula"  role="button"></form>';
            echo'</div>';
        }


        echo'</div>';
        echo'</div>';


        echo'<div class="cm8-container4" id="progdivi" style="padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px; border: none; ">';

        echo'<div id="myprogress2"></div>';
        echo'<div id="myprogress"></div>';
        echo'</div>';
        echo'</div>';
    }

    echo'<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
 <script src="toinen.js" language="javascript" type="text/javascript"></script>';

    include "libchart/libchart/classes/libchart.php";

    echo '<div class="cm8-container7" id="paluu" style="margin-top: 0px; padding-top:0px; padding-bottom: 30px; margin-bottom: 0px; ">';

    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress3()" class="currentLink">Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	 ';


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
		
		  <a href="itsetyot.php" onclick="loadProgress3()" class="currentLink" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
			
		 ';

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

    echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 0px; border: none">';

    if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; 
  color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka->num_rows != 0) {
        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
    }


    echo'<div class="cm8-quarter" style="width: 20%; padding-left: 20px; "> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Tehtävälista</h2>';
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

                echo'<a href="itsetyot.php?i=' . $id . '" class="btn-info3-valittu"  style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
            } else {

                echo'<a href="itsetyot.php?i=' . $id . '&valittu=1" class="btn-info3"  style="font-size: 0.9em; margin-right: 20px; margin-bottom: 5px;  padding: 6px 6px 4px 20px">' . $kuvaus . '</a>';
            }
        }

        echo'<div class="cm8-margin-top"></div>';
        if ($_SESSION["Rooli"] <> 'opiskelija') {
            echo'<form action="uusiitseprojektieka.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää Tehtävälista-osio" class="myButton8"  role="button"  style="padding:2px 4px"></form><br><br>';
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


    echo'<div class="cm8-threequarter" style="width: 65%; padding-top: 0px; margin-left: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px; ">';


//    if ($haelinkki->num_rows != 0) {
//        echo' <p style="z-index: 1001;position: fixed; top:60%; right:1%">';
//        echo' <button id="klik2"  class="myButtonOhjeA" title="Avaa digikirja">+ Avaa digikirja</button></p>';
//    }
    if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($onkoprojekti->num_rows != 0) {
        if (!$haetaulu = $db->query("select distinct taulu from itseprojektit where id='" . $_GET[i] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowt = $haetaulu->fetch_assoc()) {
            $taulu = $rowt[taulu];
        }
        $taulu = htmlspecialchars_decode($taulu);


        if (($taulu == '' || $taulu == '<div><br></div>' || $taulu == '<br>') && $_SESSION[Rooli] == 'opiskelija') {
            
        } else if (($taulu == '' || $taulu == '<div><br></div>' || $taulu == '<br>') && ($_SESSION[Rooli] != 'opiskelija' || $_SESSION[vaihto] != 1)) {
            echo'<div class="cm8-responsive cm8-taulu" style="font-size: 0.6em; height: 80px; width: 15%; z-index: 1001; position: fixed; top: 60%; right: 2%;">';

            echo'<form action="aktivoiaihe.php" method="post" style="display: inline-block; margin-top: 0px; margin-bottom: 5px;  left: 1%"><input type="hidden" name="ipid" value=' . $_GET[i] . '><input type="submit" name="painikem" value="&#9998" title="Muokkaa sisältöä" class="muokkausN"  role="button" style="font-size: 0.8em; padding: 0px 1px 1.5px 1px; margin-left: 0px; margin-bottom: 4px"></form>';

            echo '</form>';


            echo '<br><br><em>Tähän voi lisätä ilmoitusasioita.</em>';

            echo'</div>';
        } else {

            echo'<div class="cm8-responsive cm8-taulu" style="font-size:0.8em;max-width: 15%; z-index: 1001; position: fixed; top: 60%; right: 1%;">';
            if ($_SESSION[Rooli] != 'opiskelija' || ($_SESSION[vaihto] != 1)) {
                echo'<form action="aktivoiaihe.php" method="post" style="display: inline-block; margin-top: 0px; margin-bottom: 5px;  left: 1%"><input type="hidden" name="ipid" value=' . $_GET[i] . '><input type="submit" name="painikem" value="&#9998" title="Muokkaa sisältöä" class="muokkausN"  role="button" style="font-size: 0.8em; padding: 0px 1px 1.5px 1px; margin-left: 0px; margin-bottom: 4px"></form>';

                echo '</form><br>';
            } else {
                echo'<br>';
            }

            echo $taulu;


            echo'<br>';

            echo'</div>';
        }
    }







    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        $startdope = microtime(true);




        if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($onkoprojekti->num_rows == 0) {

            echo'<br><p id="ohje">Tähän on mahdollista luoda osio, jossa opiskelijat voivat kirjata suorituksiaan.</p>';
            echo'<div class="cm8-margin-top"></div>';
            echo'<form action="uusiitseprojektieka.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää Tehtävälista-osio" class="myButton8"  role="button"  style="font-size: 1em; padding:4px 6px"></form>';
        } else if ($onkoprojekti->num_rows > 0 && !isset($_GET[i])) {
            echo'<br>Valitse oheisesta valikosta haluamasi Tehtävälista-osio.<br><br>';
        } else {

            if (!$onkoprojekti = $db->query("select distinct id, kuvaus from itseprojektit where id='" . $_GET[i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowP = $onkoprojekti->fetch_assoc()) {

                $ipid = $rowP[id];
                $kuvaus = $rowP[kuvaus];

                echo'<div class="cm8-half" style="margin: 0px 0px 0px 0px; padding: 0px">';
                echo'<h6tiedosto id="' . $ipid . '" style="width: 100%; margin-right: 40px;padding: 6px 10px 6px 20px; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus;
                echo'<div style=" display: inline-block; float: right">';
                echo'<form action="muokkaaitseprojektieka.php" method="post"  style="margin-right: 0px; display: inline-block; "><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa" class="muokkausN"></form>';
                echo'<form action="varmistusitseprojekti.php" method="post" style="display: inline-block;"><input type="hidden" name="id" value=' . $ipid . '><button class="roskis" title="Poista Kurssitehtävä-projekti"  ><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i></button></form>';
                echo'</div>';

                echo'</h6tiedosto></div>';
                
                
                echo'<div class="cm8-half" style="margin: 0px; padding: 5px 0px 0px 40px; font-size: 0.7em">';
                echo'<p style="padding: 0px; margin: 0px;">Avataanko tämä osio automaattisesti?</p><br>';
                if (!$result = $db->query("select distinct eka_auki from itseprojektit where id = '" . $ipid . "' AND eka_auki = 1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                echo'<form id="form2" name="form2" style="font-size: 0.9em;margin:0px; padding: 0px" method="post" action="ekatehtavaosioauki.php">';
                if ($result->num_rows != 0) {


                    echo'<input type="radio" onchange="this.form.submit();" name="auki" value="1" checked>&nbsp Kyllä &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
                    echo'<input type="radio" name="auki" onchange="this.form.submit();" value="0">&nbsp Ei';
                } else {
                    echo'<input type="radio" name="auki" onchange="this.form.submit();" value="1" >&nbsp Kyllä &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
                    echo'<input type="radio" name="auki" onchange="this.form.submit();" value="0" checked>&nbsp Ei';
                }
                echo'<input type="hidden" name="ipid" value="' . $ipid . '">';
                echo'</form>';

                echo'</div></div>';


                echo'<div class="cm8-threequarter" style="width: 65%; padding-top: 0px; margin-left: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px; ">';

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

                echo'<div class="cm8-responsive" id="info_ope" style="">';

                echo'<div class="cm8-responsive cm8-ilmoitus" style="padding: 0px; margin: 0px">';

                echo'<form action="ilmoitus.php" method="post" id="infomuokkaus"><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="kuvaus" value=' . $kuvaus . '><input type="submit" name= "painikei" value="&#9998" title="Muokkaa sisältöä" class="muokkausinfo"  role="button"  style="padding: 2px 4px; font-size: 0.8em; float: left ;"></form></td></tr>';

                echo'</div>';

                echo'<div class="cm8-responsive cm8-ilmoitus" style="padding: 20px">';
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
                if (!$onkopistevaikutus = $db->query("select distinct pisteetvaikuttaa from itseprojektit where id = '" . $ipid . "' AND pisteetvaikuttaa = 1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($onkopistevaikutus->num_rows != 0) {
                    $pisteetvaikuttaa = true;
                }
                if (!$onkopie = $db->query("select distinct edistymispie from itseprojektit where id = '" . $ipid . "' AND edistymispie = 1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($onkopie->num_rows != 0) {
                    $edistymispie = true;
                }
                if (!$onkopisteytys = $db->query("select distinct itsepisteytys from itseprojektit where id = '" . $ipid . "' AND itsepisteytys = 1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($onkopisteytys->num_rows != 0) {
                    $itsepisteytys = true;
                }

                $yht = $haetehtavat2->num_rows;


                if ($pisteet) {



                    if (!$haepisteet = $db->query("select paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND  aihe=0")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    $pisteetyht = 0;
                    while ($rowpis = $haepisteet->fetch_assoc()) {
                        $pisteetyht = $pisteetyht + $rowpis[paino];
                    }
                }

                echo'<div class="cm8-responsive ohjeboxi" style="padding: 0px 0px 0px 20px; margin-bottom: 0px">';

                echo'<p class="info" id="takas"  >Tehtäviä on yhteensä ' . $yht . ' kappaletta.</p>';

                echo'</div>';
                echo'<div class="cm8-responsive ohjeboxi" style="margin-top: 10px; padding-bottom: 10px">';
                //ympyrädiagrammin näkyvyys

                if (!$onkorivi10 = $db->query("select distinct dnakyy from itseprojektit where id='" . $ipid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowdnakyy = $onkorivi10->fetch_assoc()) {
                    $dnakyy = $rowdnakyy[dnakyy];
                }
                if ($dnakyy == 1) {
                    echo'<p style="font-size:0.9em;font-weight: bold; display: inline-block;color: #e608b8; margin-top: 0px; padding-top: 0px">Opiskelijat näkevät tässä ympyrädiagrammin edistymisestään.</p>';

                    tuoMalli($ipid);
                    echo'<form action="naytad.php" method="post" style="display: inline-block"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="piilota"  value="- Piilota ympyrädiagrammi opiskelijoiden näkyvistä" title="Piilota ympyrädiagrammi" class="myButton8"  role="button"  style="padding:4px 6px; font-size: 0.8em"></form>';
                } else {

                    echo'<b style="font-size: 1em">Näytetäänkö opiskelijoille sektoridiagrammi, joka havainnollistaa tehtävien teossa edistymistä?</b>';
                    echo'<br><br><form action="naytad.php" method="post" style="" ><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="nayta"  value="+ Näytä ympyrädiagrammi opiskelijoille" title="Näytä ympyrädiagrammi" class="myButton8"  role="button"  style="padding:4px 6px; font-size: 0.9em"></form>';
                }
                echo'</div>';

                echo'<div class="cm8-responsive ohjeboxi" style="margin-top: 10px; padding: 0px 0px 10px 20px">';
                if (!$onkorivi8 = $db->query("select distinct * from itseprojektit_minimi where itseprojektit_id='" . $ipid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowmin = $onkorivi8->fetch_assoc()) {
                    $minimi = $rowmin[minimi];
                }

                if ($minimi == '') {
                    echo'<br><b style="font-size: 1em">Asetetaanko tehtäville minimiraja?</b>';


                    echo'<form action="muokkaaminimia.php" method="get" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="+ Aseta tehtäville minimi%-raja" title="Aseta tehtäville minimi%-raja" class="myButton8"  role="button"  style="padding:4px 6px; font-size: 0.9em"></form>';
                } else {

                    echo'<br><p class="info" style="display: inline-block; margin: 0px;color: #e608b8">Tehtävien minimi%-raja on: ' . $minimi . ' %</p>';
                    echo'<form action="muokkaaminimia.php" method="get" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa minimi%-rajaa" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.7em"></form>';
                }
                echo'</div>';
                echo'<div class="cm8-responsive ohjeboxi" style="margin-top: 10px; padding-bottom: 10px">';
                if (!$onkorivi2 = $db->query("select distinct * from itseprojektit_lpisteet where itseprojekti_id='" . $ipid . "' ORDER BY osuus DESC")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                if ((!$pisteetvaikuttaa && $pisteet) || !$pisteet) {
                    if ($onkorivi2->num_rows == 0) {

                        echo'<b style="font-size: 1em">Annetaanko tehtävistä lisäpisteitä?</b>';
                        echo'<form action="muokkaalisapisteita.php" method="get" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="+ Aseta lisäpisterajat" title="Aseta lisäpisterajat" class="myButton8"  role="button"  style="padding:4px 6px; font-size: 0.9em"></form>';
                    } else {
                        echo'<table  class="tehtavatauluope" style="font-size: 0.9em; display: inline-block; ">';
                        echo'<tr ><th colspan="2"  style="border:none; padding: 10px">Lisäpisteiden muodostuminen</th></tr>';

                        while ($row = $onkorivi2->fetch_assoc()) {

                            echo'<tr><td><b>Tehtäviä tehty: </b>' . $row[osuus] . ' %</td>';
                            echo'<td><b>Lisäpisteitä: </b>' . $row[pisteet] . ' pistettä</td></tr>';
                        }

                        echo'</table>';
                        echo'<form action="muokkaalisapisteita.php" method="get" style="display: inline-block; margin-left: 10px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa lisäpisteiden rajoja" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.7em"></form>';
                    }
                } else {
                    if ($onkorivi2->num_rows == 0) {
                        echo'<b style="font-size: 1em">Annetaanko tehtävistä lisäpisteitä?</b>';
                        echo'<form action="muokkaalisapisteita.php" method="get" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="+ Aseta lisäpisterajat" title="Aseta lisäpisterajat" class="myButton8"  role="button"  style="padding:4px 6px; font-size: 0.9em"></form>';
                    } else {
                        echo'<table  class="tehtavatauluope" style="font-size: 0.9em; display: inline-block; width: 80% ">';
                        echo'<tr ><th colspan="2"  style="border:none; padding: 10px">Lisäpisteiden muodostuminen</th></tr>';

                        while ($row = $onkorivi2->fetch_assoc()) {

                            echo'<tr><td style="padding-right: 60px; width: 70%"><b>Tehtyjen tehtävien pistemäärän osuus: </b>' . $row[osuus] . ' %</td>';
                            echo'<td style="width: 30%"><b>Lisäpisteitä: </b>' . $row[pisteet] . ' p</td></tr>';
                        }

                        echo'</table>';
                        echo'<form action="muokkaalisapisteita.php" method="get" style="display: inline-block; margin-left: 10px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa lisäpisteiden rajoja" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.7em"></form>';
                    }
                }


                echo'</div>';





                //pisteytyshässäkkä
                echo'<div class="cm8-responsive ohjeboxi" style="margin-top: 10px; padding-bottom: 10px">';
                if (!$pisteet) {


                    echo'<b style="font-size: 1em">Pisteytetäänkö tehtävät?</b>';
                    echo'<form action="aktivoipisteytys.php" method="post" style="display:inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painikea"  value="+ Ota tehtävien pisteytys käyttöön" title="+ Ota tehtävien pisteytys käyttöön" class="myButton8"  role="button"  style="padding:4px 6px; font-size: 0.9em"></form>';
                } else {

                    echo'<p class="info" style="display: inline-block; margin: 0px;color: #e608b8">Tehtävien pisteytys on käytössä.</p>';
                    echo'<p class="info" style="color: #e608b8"><b>Tehtävien yhteispistemäärä on ' . $pisteetyht . ' pistettä.</b></p>';

                    echo'<p style="font-size: 0.9em; font-weight: bold; color: #e608b8; margin-top: 20px; padding-top: 0px; margin-bottom:0px; padding-bottom: 0px">Opiskelijat näkevät tässä nyt oheisen diagrammin edistymisestään eritasoisissa tehtävissä.</p>';

                    tuoMalli2($ipid);
                    echo'<form action="aktivoipisteytys.php" method="post" style="margin-top: 10px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painikep"  value="x &nbsp Poista pisteytys käytöstä" title="- Poista käytöstä" class="myButton8"  role="button"  style="padding:4px 6px; font-size: 0.7em"></form><br>';









//
//                    if ($edistymispie == 0) {
//                        echo'<form action="naytapie.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="nayta"  value="+ Näytä diagrammit" title="Näytä diagrammit" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.7em"></form>';
//                    } else {
//                        tuoDiagrammi2(0, $ipid);
//                        echo'<br><form action="naytapie.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="piilota"  value="- Piilota diagrammit" title="Piilota diagrammit" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.7em"></form>';
//                        echo'<br>';
//                    }
                }


                echo'</div>';


                if ($pisteet && !$pisteetvaikuttaa) {
                    echo'<div class="cm8-responsive ohjeboxi" style="margin-top: 10px; padding-bottom: 10px">';
                    echo'<b style="font-size: 1em">Painotetaanko yllä olevissa prosenttimäärissä tehtävien pisteitä?</b>';
                    echo'<form action="aktivoipisteytys2.php" method="post" style="margin-left: 20px; display: inline-block" ><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painikea"  value="Painota tehtävien pistemääriä" title="Painota tehtävien pistemääriä" class="myButton8"  role="button"  style="padding:4px 6px; font-size: 0.9em"></form>';

                    echo'</div>';
                } else if ($pisteet && $pisteetvaikuttaa) {
                    echo'<div class="cm8-responsive ohjeboxi" style="margin-top: 10px; padding: 0px 0px 0px 20px">';
                    echo'<p class="info" style="display: inline-block; color: #e608b8">Yllä olevissa prosenttimäärissä painotetaan nyt tehtävien pisteitä.</p>';
                    echo'<form action="aktivoipisteytys2.php" method="post" style="display: inline-block; margin-left: 20px" ><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painikep"  value="x &nbsp Poista tehtävien pistemäärän painotus" title="Poista tehtävien pistemäärän painotus" class="myButton8"  role="button"  style="padding:4px 6px; font-size: 0.7em"></form>';
                    echo'</div>';
                }


              
                if ($itsepisteytys) {
                      // TÄHÄN SAAKO PISTEYTTÄÄ
                echo'<div class="cm8-responsive ohjeboxi" style="margin-top: 10px; padding-bottom: 10px">';
                    echo'<p class="info" style="display: inline-block; margin: 0px;color: #e608b8">Opiskelijat saavat pisteyttää tekemänsä tehtävät.</p><form action="muokkaaitsepisteytys.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painikep" value="x &nbsp Poista käytöstä" title="X Poista käytöstä" class="myButton8"  role="button"  style="padding:4px 6px; font-size: 0.7em"></form>';
                
                    echo'</div>';
                } else if ($pisteet && !$itsepisteytys) {
  // TÄHÄN SAAKO PISTEYTTÄÄ
                echo'<div class="cm8-responsive ohjeboxi" style="margin-top: 10px; padding-bottom: 10px">';
                    echo'<b style="font-size: 1em">Annetaanko opiskelijoille mahdollisuus pisteyttää itse tehtävät?</b>';
                    echo'<form action="muokkaaitsepisteytys.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painikel" value="+ Ota käyttöön" title="+ Ota käyttöön" class="myButton8"  role="button"  style="padding:4px 6px; font-size: 0.9em"></form>';
                echo'</div>';
                    
                }

                


                echo'<div class="cm8-responsive ohjeboxi" style="margin-top: 10px; padding-bottom: 0px; padding-top: 0px">';



                $nyt = date("Y-m-d H:i");

                $takaraja = $sulkeutuu;

                if ($suljettu == 0 && (($nyt <= $takaraja && !empty($takaraja)) || empty($takaraja) )) {

//                    echo'<p style="display: inline-block; margin-right: 20px;" class="info">Opiskelijat voivat muokata taulukkoa.</p>';
//                    echo'<form action="suljeluettelo.php" method="post" style="display: inline-block; margin-right: 30px"><input type="hidden" name="pid" value=' . $ipid . '><input type="submit" name="painike" value="- Sulje" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.7em"></form>';
//              
                } else if ($suljettu == 1) {
                    echo'<p style="display: inline-block; margin-right: 20px; color: #e608b8; font-weight: bold; font-size: 0.9em">Opiskelijoiden mahdollisuus muokata taulukkoa on suljettu.</p>';
                    echo'<form action="avaaluettelo.php" method="post" style="display: inline-block"><input type="hidden" name="pid" value=' . $ipid . '><input type="submit" name="painike" value="+ Avaa" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.7em"></form>';
                }
                $nyt = date("Y-m-d H:i");
                if ($suljettu == 0) {
                    echo '<form id="takaraja" action="asetatakarajaluettelo2.php" style="padding-bottom: 10px; font-size: 0.9em" method="post" autocomplete="off">';
                    echo'<input type="hidden" name="pid" value=' . $ipid . '>';

                    if (!empty($sulkeutuu) && $sulkeutuu != ' ') {
                        $nyt = date("Y-m-d H:i");
                        $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
                        $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
                        $sulkeutumiskello = substr($sulkeutuu, 11, 5);

                        $takaraja = $sulkeutuu;


                        if ($suljettu == 0 && $nyt <= $takaraja) {
                            echo'<br><p class="info" style="display: inline-block; color: #e608b8; font-size: 1.1em">Mahdollisuus merkitä tehtäviä sulkeutuu ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</p>';
                        } else {
                            echo'<p style="color: #e608b8; font-weight: bold; font-size: 1.1em; display: inline-block">Mahdollisuus merkitä tehtäviä  on sulkeutunut ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</p>';
                        }

                        echo'<input type="submit" style="margin-left: 10px; padding: 2px" value="Muokkaa" class="myButton8" name="muokkaa"  title="Muokkaa sulkeutumisaikaa">';
                    } else {


                        echo'<p style="margin-bottom: 10px; font-weight: bold;color: #e608b8;">Aseta tehtävien merkitsemiselle sulkeutumisajankohta: </p>';
                        echo'<b style="font-size: 0.8em; margin-right: 5px; color:  ">Pvm:</b>
     
            <input type="text" class="kdate" style="margin-right: 10px; width: 20%; font-size: 0.8em; color: #080708"  name="paiva">';


                        echo'<b style="font-size: 0.8em; margin-right: 5px; color: ">Klo:</b>
    
               <input type="text" class="kelloE"  id="kelloE" name="kello" style="width: 20%; font-size: 0.8em; color: #080708" >';




                        echo'<input type="submit" style=" margin-left:10px; padding: 4px 6px;" value="Tallenna" class="myButton8" name="tallenna" id="buttonE" title="Tallenna">';
                    }
                    echo'</form>';
                }

                echo'</div>';
                $time_elapsed_secsdope = microtime(true) - $startdope;
//    

                $startlope = microtime(true);

                echo'<div style="text-align: center; padding-top: 40px">';
                echo'<form action="tarkastele.php" method="get" style="display: inline-block"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike"  value="🕵 Tarkastele opiskelijakohtaisia tilastoja" class="myButtonTarkastele"  role="button"></form>';
                echo'</div>';

                echo'<br><br><p style="font-size: 0.8em; " id="ohje">Klikkaamalla otsikkoa pääset tarkastelemaan sen alla olevien tehtävien tietoja.<br>';
                echo'<br>Klikkaamalla tehtävää pääset tarkastelemaan siihen liittyviä tietoja.</p><br>';

                if ($haetehtavat->num_rows != 0) {
                    echo'<form action="testaamuokkaus.php" method="get" id="palaatanne"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa tehtävälistaa" class="myButton8"  role="button"  title="Muokkaa tehtävälistaa"  style="padding:2px 4px;"></form>';
                }



                echo'<div id="scrollbar"><div id="spacer"></div></div>';
                echo'<div class="cm8-responsive" id="container2" >';
                echo '<table id="mytable" class="cm8-uusitable2ope" style=" table-layout:fixed; max-width: 90%; overflow:hidden">   <thead>';
                if ($pisteet) {
                    echo '<tr style="border: 2px solid #080708; background-color: #52ab98;  font-size: 1em" id="palaa"><th>Tehtävä</th><th>Tehtävän<br>pistemäärä</th><th>Tehdyt yht.</th><th>Tehty<br>ja osattu</th><th style="text-align: center; border: 1px solid #080708">Tehty,<br>mutta ei osattu<br>ilman apua</th><th>Toivottu yhdessä<br>läpikäytäväksi</th><th>Kommentoitu'
                    . '</th></tr>  </thead><tbody id="palaa2">';
                } else {
                    echo '<tr style="border: 2px solid #080708; background-color: #52ab98;  font-size: 1em; " id="palaa"><th>Tehtävä</th><th>Tehdyt yht.</th><th>Tehty<br>ja osattu</th><th>Tehty,<br>mutta ei osattu<br>ilman apua</th><th>Toivottu yhdessä<br>läpikäytäväksi</th><th>Kommentoitu'
                    . '</th></tr>  </thead><tbody id="palaa2">';
                }

                $otmaara = 0;
                $maara = 0;
                $maaratehtavat = 0;
                while ($rowt = $haetehtavat->fetch_assoc()) {
                    $maara++;
                    if ($rowt[aihe] != 1) {
                        $maaratehtavat++;
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

                        if (!$haetoiveet = $db->query("select distinct itsetehtavatkp.id as id from itsetehtavatkp, kayttajat where kayttajat.id=itsetehtavatkp.kayttaja_id AND rooli='opiskelija' AND itsetehtavat_id='" . $rowt[id] . "' AND toive=1")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        if (!$haeeiosatut = $db->query("select distinct itsetehtavatkp.id as id from itsetehtavatkp, kayttajat where kayttajat.id=itsetehtavatkp.kayttaja_id AND rooli='opiskelija' AND itsetehtavat_id='" . $rowt[id] . "' AND osattu=0 AND tehty=1")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        if (!$haeosatut = $db->query("select distinct itsetehtavatkp.id as id from itsetehtavatkp, kayttajat where kayttajat.id=itsetehtavatkp.kayttaja_id AND rooli='opiskelija' AND itsetehtavat_id='" . $rowt[id] . "' AND osattu=1")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        if (!$haekommentit = $db->query("select distinct itsetehtavatkp.id as id from itsetehtavatkp, kayttajat where kayttajat.id=itsetehtavatkp.kayttaja_id AND rooli='opiskelija' AND itsetehtavat_id='" . $rowt[id] . "' AND kommentti<>''")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        $tehdyt = ($haeeiosatut->num_rows) + ($haeosatut->num_rows);
                    }




                    if ($pisteet) {

                        if ($rowt[aihe] == 1) {


                            $seuraava = $rowt[jarjestys] + 1;
                            if (!$haeseuraava = $db->query("select distinct aihe from itsetehtavat where itseprojektit_id='" . $ipid . "' AND jarjestys='" . $seuraava . "'")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }
                            while ($rows = $haeseuraava->fetch_assoc()) {
                                $onkoaihe = $rows[aihe];
                            }

                            if ($onkoaihe != 1) {

                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #c8d8e4;"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="6" style="border-top: 2px solid #080708;border-right: 2px solid #080708; border-bottom: 2px solid #080708; border-left: none"><a href="ykskohdat2.php?id=' . $ipid . '&tid=' . $rowt[id] . '"><b>' . $rowt[otsikko] . '</b><br></a>';
                            } else {
                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #c8d8e4;"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="6" style="border-top: 2px solid #080708;border-right: 2px solid #080708; border-bottom: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br>';
                            }


                            if ($onkoaihe != 1 && ($nyt <= $takaraja || $takaraja == '')) {
                                echo'<br>';
                                //jos auki
                                if ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == '')) {

//                                    echo'<form action="suljeaihe.php" method="post" style="display: inline-block;"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="- Sulje" title="Sulje osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
//                                
                                } else if ($rowt[aihekiinni] == 1)
                                //jos kiinni
                                    echo '<em style="font-size: 0.9em; color: #e608b8; font-weight: bold">Tämä osio on suljettu.</em><form action="avaa_aihe.php" method="post" style="display: inline-block; margin-left: 20px; margin-top: 6px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="+ Avaa" title="Avaa osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';


                                if ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == '')) {
                                    $otmaara++;
                                    echo '<form action="asetaosiokiinni.php" id="' . $otmaara . '" style="display: inline-block; font-size: 0.9em" method="post" autocomplete="off">';

                                    if ($automaattinen == 1) {
                                        if ($nyt <= $takaraja2) {
                                            echo'<b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio sulkeutuu: </b>';
                                        } else {
                                            echo'<b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio on sulkeutunut: </b>';
                                        }

                                        echo'<b style="font-size: 0.9em">Pvm:</b> 
    
            <input type="text" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva" style="margin-right: 20px; width: 100px; font-size: 0.9em" value=' . $sulkeutumispaiva2 . '>';
                                    } else {
                                        echo'<p style="display: inline-block; background-color: #c8d8e4"><b style="font-size:0.9em; margin-right: 20px">Aseta osiolle sulkeutumisajankohta: </b></p>';
                                        echo'<b style="font-size: 0.9em">Pvm:</b>
     
            <input type="text" style="margin-right: 20px; width: 100px; font-size: 0.9em" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva">';
                                    }

                                    echo'<b style="font-size: 0.9em">Klo:</b>
           <input type="hidden" name="id" id="id8" value=' . $rowt[id] . '>	
               <input type="text"  id="kello' . $otmaara . '"  name="kello" style="width: 100px; font-size: 0.9em" class="kello" value="' . $sulkeutumiskello2 . '">';
                                    echo'<input type="hidden" name="ipid" value=' . $ipid . '>	
      <input type="hidden" name="otmaara" value=' . $otmaara . '>
            <input type="hidden" name="tallenna2">
	<input type="submit" style="margin-left: 20px; padding: 4px" value="Tallenna" class="myButton8" name="tallenna" id="button' . $otmaara . '" title="Tallenna takaraja">
	</form>';
                                } else if ($takaraja2 != '') {
                                    echo '<form action="asetaosiokiinni.php"  style="display: inline-block; font-size: 0.9em" method="post" autocomplete="off">';

                                    if ($automaattinen == 1) {
                                        if ($nyt <= $takaraja2) {
                                            echo'<b style="font-size:0.9em; margin-right: 10px; color: #e608b8">Tämä osio sulkeutuu </b>';
                                        } else {
                                            echo'<b style="font-size:0.9em; margin-right: 10px; color: #e608b8">Tämä osio on sulkeutunut </b>';
                                        }

                                        echo'<b style="color: #e608b8; font-size: 0.9em">' . $sulkeutumispaiva2 . '</b> ';
                                    } else {
                                        echo'<p style="display: inline-block; background-color: #c8d8e4"><b style="font-size:0.9em; margin-left: 20px; margin-right: 20px">Aseta osiolle sulkeutumisajankohta: </b></p>';
                                        echo'<b style="font-size: 0.9em">Pvm:</b>
     
            <input type="text" style="margin-right: 20px; width: 100px; font-size: 0.9em" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva">';
                                    }

                                    echo'<b style="color: #e608b8; font-size: 0.9em; margin-left: 10px">klo &nbsp&nbsp&nbsp' . $sulkeutumiskello2 . '</b>
          <input type="hidden" name="id" id="id8" value=' . $rowt[id] . '>	
           
                   <input type="hidden" name="ipid" value=' . $ipid . '>
           
           
	<input type="submit" style="margin-left: 20px; padding:4px" value="Muokkaa" class="myButton8" name="muokkaa" title="Muokkaa takarajaa">
  
	</form>';
                                } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                                    echo'<b style="font-size:0.9em; color: #e608b8">Osio on sulkeutunut: ';
                                    echo $sulkeutumispaiva2 . ', klo: ' . $sulkeutumiskello2 . '.</b>';
                                    echo '<form action="avaa_aihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="+ Avaa" title="Avaa osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                                }
                            }

                            echo'</td></tr>';
                        } else {
                            if ($suljettu == 1 || ($nyt > $takaraja && $takaraja != '') || ($automaattinen == 1 && $nyt > $takaraja2 && $takaraja2 != '')) {
                                echo ' <tr style=" font-size: 1em" id="' . $rowt[jarjestys] . '" class="stripe-2"><td style=" border: 1px solid grey; padding-left: 10px;"><a  href="ykskohdat.php?id=' . $ipid . '&tid=' . $rowt[id] . '" style="width:100%; display:block" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</a></td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $tehdyt . '</td><td style="text-align: center; border: 1px solid grey">' . $haeosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haeeiosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haetoiveet->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haekommentit->num_rows;
                            } else {
                                echo ' <tr style=" font-size: 1em;" id="' . $rowt[jarjestys] . '"><td style=" border: 1px solid grey; padding-left: 10px;"><a  href="ykskohdat.php?id=' . $ipid . '&tid=' . $rowt[id] . '" style="width:100%; display:block" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</a></td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $tehdyt . '</td><td style="text-align: center; border: 1px solid grey">' . $haeosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haeeiosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haetoiveet->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haekommentit->num_rows;
                            }

                            echo'</td></tr>';
                        }
                    } else {
                        if ($rowt[aihe] == 1) {

                            $seuraava = $rowt[jarjestys] + 1;
                            if (!$haeseuraava = $db->query("select distinct aihe from itsetehtavat where itseprojektit_id='" . $ipid . "' AND jarjestys='" . $seuraava . "'")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }
                            while ($rows = $haeseuraava->fetch_assoc()) {
                                $onkoaihe = $rows[aihe];
                            }

                            if ($onkoaihe != 1) {
                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #c8d8e4;"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="6" style="border-top: 2px solid #080708;border-right: 2px solid #080708; border-bottom: 2px solid #080708; border-left: none"><a href="ykskohdat2.php?id=' . $ipid . '&tid=' . $rowt[id] . '"><b>' . $rowt[otsikko] . '</b><br></a>';
                            } else {
                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #c8d8e4;"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="6" style="border-top: 2px solid #080708;border-right: 2px solid #080708; border-bottom: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br>';
                            }

                            if ($onkoaihe != 1 && ($nyt <= $takaraja || $takaraja == '')) {
                                //jos auki
                                echo'<br>';
                                if ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == '')) {

//                                       echo'<form action="suljeaihe.php" method="post" style="display: inline-block;"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="- Sulje" title="Sulje osio" class="myButton8"  role="button"  style="padding:2px 4px"></form> ';
//                                
                                } else if ($rowt[aihekiinni] == 1) {
                                    //jos kiinni
                                    echo '<em style="font-weight: bold; font-size: 0.8em; color: #e608b8">Tämä osio on suljettu.</em><form action="avaa_aihe.php" method="post" style="display: inline-block; margin-left: 20px; margin-top: 6px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="+ Avaa" title="Avaa osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                                }


                                if ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == '')) {
                                    $otmaara++;
                                    echo '<form action="asetaosiokiinni.php" id="' . $otmaara . '" style="display: inline-block; font-size: 0.9em" method="post" autocomplete="off">';

                                    if ($automaattinen == 1) {
                                        if ($nyt <= $takaraja2) {
                                            echo'<b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio sulkeutuu: </b>';
                                        } else {
                                            echo'<b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio on sulkeutunut: </b>';
                                        }

                                        echo'<b style="font-size: 0.9em">Pvm:</b> 
    
            <input type="text" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva" style="margin-right: 20px; width: 100px; font-size: 0.9em" value=' . $sulkeutumispaiva2 . '>';
                                    } else {
                                        echo'<p style="display: inline-block; background-color: #c8d8e4" ><b style="font-size:0.9em; margin-right: 20px">Aseta osiolle sulkeutumisajankohta: </b></p>';
                                        echo'<b style="font-size: 0.9em">Pvm:</b>
     
            <input type="text" style="margin-right: 20px; width: 100px; font-size: 0.9em" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva">';
                                    }

                                    echo'<b style="font-size: 0.9em">Klo:</b>
           <input type="hidden" name="id" id="id8" value=' . $rowt[id] . '>	
               <input type="text"  id="kello' . $otmaara . '"  name="kello" style="width: 100px; font-size: 0.9em" class="kello" value="' . $sulkeutumiskello2 . '">';
                                    echo'<input type="hidden" name="ipid" value=' . $ipid . '>	
         <input type="hidden" name="otmaara" value=' . $otmaara . '>  
               <input type="hidden" name="tallenna2">
	<input type="submit" style="margin-left: 20px; padding: 4px" value="Tallenna" class="myButton8" name="tallenna" id="button' . $otmaara . '" title="Tallenna takaraja">
	</form>';
                                } else if ($takaraja2 != '') {
                                    echo '<form action="asetaosiokiinni.php" style="display: inline-block; font-size: 0.9em" method="post" autocomplete="off">';

                                    if ($automaattinen == 1) {
                                        if ($nyt <= $takaraja2) {
                                            echo'<b style="font-size:0.9em; margin-right: 10px; color: #e608b8">Tämä osio sulkeutuu </b>';
                                        } else {
                                            echo'<b style="font-size:0.9em; margin-right: 10px; color: #e608b8">Tämä osio on sulkeutunut </b>';
                                        }

                                        echo'<b style="color: #e608b8; font-size: 0.9em">' . $sulkeutumispaiva2 . '</b> ';
                                    } else {
                                        echo'<p style="display: inline-block; background-color: #c8d8e4"><b style="font-size:0.9em; margin-left: 20px; margin-right: 20px">Aseta osiolle sulkeutumisajankohta: </b></p>';
                                        echo'<b style="font-size: 0.9em">Pvm:</b>
     
            <input type="text" style="margin-right: 20px; width: 100px; font-size: 0.9em" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva">';
                                    }

                                    echo'<b style="color: #e608b8; font-size: 0.9em; margin-left: 10px">klo &nbsp&nbsp&nbsp' . $sulkeutumiskello2 . '</b>
          <input type="hidden" name="id" id="id8" value=' . $rowt[id] . '>	
           
                   <input type="hidden" name="ipid" value=' . $ipid . '>
           
           
	<input type="submit" style="margin-left: 20px; padding:4px" value="Muokkaa" class="myButton8" name="muokkaa" title="Muokkaa takarajaa">
  
	</form>';
                                } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                                    echo'<b style="font-size:0.9em; color: #e608b8">Osio on sulkeutunut: ';
                                    echo $sulkeutumispaiva2 . ', klo: ' . $sulkeutumiskello2 . '.</b>';
                                    echo '<form action="avaa_aihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="+ Avaa" title="Avaa osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                                }
                            }

                            echo'</td></tr>';
                        } else {
//TÄSSÄ!

                            if ($suljettu == 1 || ($nyt > $takaraja && $takaraja != '') || ($automaattinen == 1 && $nyt > $takaraja2 && $takaraja2 != '')) {
                                echo ' <tr style=" font-size: 1em" id="' . $rowt[jarjestys] . '" class="stripe-2"><td style=" border: 1px solid grey; padding-left: 10px; "><a  href="ykskohdat.php?id=' . $ipid . '&tid=' . $rowt[id] . '" style="width:100%; display:block" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</a></td><td style="text-align: center; border: 1px solid grey">' . $tehdyt . '</td><td style="text-align: center; border: 1px solid grey">' . $haeosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haeeiosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haetoiveet->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haekommentit->num_rows;
                            } else {
                                echo ' <tr style=" font-size: 1em" id="' . $rowt[jarjestys] . '"><td style=" border: 1px solid grey; padding-left: 10px; "><a  href="ykskohdat.php?id=' . $ipid . '&tid=' . $rowt[id] . '" style="width:100%; display:block" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</a></td><td style="text-align: center; border: 1px solid grey">' . $tehdyt . '</td><td style="text-align: center; border: 1px solid grey">' . $haeosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haeeiosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haetoiveet->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haekommentit->num_rows;
                            }

                            echo'</td></tr>';
                        }
                    }
                }

                echo "</tbody></table>";

                echo"</div>";

                if ($haetehtavat->num_rows != 0) {
                    echo'<br><br><form action="testaamuokkaus.php" method="get"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa tehtävälistaa" title="Muokkaa tehtävälistaa" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                } else {
                    echo'<br><br><form action="testaamuokkaus.php" method="get"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="+ Lisää tehtäviä" class="myButton8"  role="button" title="Lisää tehtäviä" style=" padding:4px 6px; font-size:1em"></form>';
                }
            }
            echo'<input type="hidden" id="monta" value=' . $otmaara . '>';
            echo'</div>';
        }
        $time_elapsed_secslope = microtime(true) - $startlope;
    }

    //opiskelija
    else {

        $startopiskelijad = microtime(true);

        if (!isset($_GET[i]) || empty($_GET[i])) {
            if (!$onkoprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($onkoprojekti->num_rows == 0) {

                echo'<br><p id="ohje">Ei aktiivisia Tehtävälista-osioita</p><br>';
            } else {
                echo'<br><p id="ohje">Valitse oheisesta valikosta haluamasi Tehtävälista-osio.</p><br><br>';
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
                if (!$onkopie = $db->query("select distinct edistymispie from itseprojektit where id = '" . $ipid . "' AND edistymispie = 1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($onkopie->num_rows != 0) {
                    $edistymispie = true;
                }


//                echo'<div class="cm8-tehtavaohje" id="sulje8" style="z-index: 1001;position: fixed; bottom:30%; left: 20%;">';
//                echo' <button onclick="suljeOhje()" href="javascript:void(0);" style="display: inline-block; margin-left: 2px" class="myButtonOhjeS" title="Sulje">- Sulje</button>';
//                echo'<p style="font-weight: bold; font-size: 1em; margin-top: 0px; display:inline-block">Ohje tehtävätaulukon merkintöihin:</p>';
//
//
//                echo'<p style="margin-top: 0px">* <b>Taulukko tallentuu automaattisesti</b>, kun merkitset rastin kohtiin<br>"Osasin", "Tein, mutta en osannut ilman apua", "Haluan käydä tunnilla läpi"</p>';
//
//                if ($itsepisteytys) {
//                    echo'<p>* <b>Lisää ensin tehtävän pisteet</b> ja vasta sitten merkitse rasti oikeaan kohtaan</p>';
//                }
//                echo'<p style="margin-bottom: 0px">* <b>Muista tallentaa kommentit taulukon yläosasta löytyvällä nappulalla!</b></p>';
//
//
//                echo'</div>';
//
//                echo' <button onclick="avaaOhje()"  id="avaa8" style="z-index: 1001;position: fixed; bottom: 20%; left: 20%" href="javascript:void(0);"  class="myButtonOhjeA" title="Avaa ohje">+ Ohje</button>';



                echo'<h6tiedosto id="peite3" style="padding: 6px 100px 6px 20px;">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . '</h6tiedosto>';
                
                if (!$haeinfo = $db->query("select * from itseprojektit where id='" . $ipid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowv = $haeinfo->fetch_assoc()) {
                    $viesti = $rowv[info];
                }

                if ($viesti <> "") {

                    echo'<div class="cm8-responsive cm8-ilmoitus" id="info" style="">';

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
                if ($pisteet) {
                    echo'<input type="hidden" id="pisteytys" value="1">';
                } else {
                    echo'<input type="hidden" id="pisteytys" value="0">';
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
                        echo'<p style="font-size: 1.1em; font-weight: bold; color: #e608b8">Mahdollisuus merkitä tehtäviä  sulkeutuu <b>' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b></p>';
                    }
                } else if ($suljettu == 1 || ($takarajaon == 1 && ($nyt >= $takaraja))) {
                    if ($suljettu == 1) {
                        echo'<p style="color: #e608b8; font-size: 1.1em"><b>Mahdollisuus merkitä tehtäviä  on suljettu.</b></p>';
                        $esta = true;
                    } else if (($takarajaon == 1 && ($nyt >= $takaraja))) {

                        echo'<p style="color: #e608b8; font-size: 1.1em"><b>Mahdollisuus merkitä tehtäviä on sulkeutunut <b>' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b></b></p>';
                        $esta = true;
                    }
                }
                $time_elapsed_secsopiskelijad = microtime(true) - $startopiskelijad;





                if (!$esta) {


                    echo'<br><form action="tallennatehtavat.php" id="formi" method="post">';
                    echo'<div id="scrollbar"><div id="spacer"></div></div>';
                    echo'<div class="cm8-responsive" id="container2" style="padding-top: 10px">';
                    echo '<table id="mytable" class="cm8-uusitable2" style="table-layout:fixed;  max-width: 99%">  ';
                    echo'<thead>';
                    echo '<tr style="border: 2px solid #080708; background-color: #52ab98;  font-size: 1em">';

                    if ($pisteet) {
                        if ($itsepisteytys) {
                            echo'<th>Tehtävä</th><th>Tehtävän<br>pistemäärä</th><th>Oma pisteytys<br>tehtävästä</th><thf padding:4px 6px; font-size: 1em"></th><th style="border: none"></th></tr></thead><tbody>';
                        } else {
                            echo'<th>Tehtävä<th>Tehtävän<br>pistemäärä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti <br><br><input type="submit" name="painiket" value="&#10003 Tallenna kommentit" class="myButtonKom"  role="button"  style="background-color: yellow; color: black; padding:4px 6px; font-size: 1em"></th><th style="border: none"></th></tr></thead><tbody>';
                        }
                    } else {

                        if ($itsepisteytys) {
                            //TÄMÄKÖ

                            echo'<th>Tehtävä</th><th>Oma pisteytys<br>tehtävästä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti <br><br> <input type="submit" name="painiket" value="&#10003 Tallenna kommentit" class="myButtonKom"  role="button"  style="background-color: yellow; color: black; padding:4px 6px; font-size: 1em"></th><th style="border: none"></th></tr></thead><tbody>';
                        } else {

                            echo'<th>Tehtävä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti <br><br> <input type="submit" name="painiket" value="&#10003 Tallenna kommentit"   role="button" class="myButtonKom" style="background-color: yellow; color: black; padding:4px 6px; font-size: 1em"></th><th style="border: none"></th></tr></thead><tbody>';
                        }
                    }
                    //LÄHTEE HAKEE TEHTÄVIÄ
                    $startopiskelijal1 = microtime(true);
                    $monta = 0;

                    //KUINKA MONTA RIVIÄ haetehtavat?!

                    while ($rowt = $haetehtavat->fetch_assoc()) {
                        $monta = $monta + 1;
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
//                   echo'm: '.$monta;       
                        /// tähän loppuu



                        $estaosio = ($takaraja2 != '' && $nyt > $takaraja2);
                        $osiovapaa = ($takaraja2 != '' && $nyt <= $takaraja2);



                        if ($itsepisteytys) {
                            //TESTAA TÄÄ!!
                            //TÄHÄN MUOKATTU
                            if ($rowt[aihe] == 1 && $pisteet == 1) {
                                if ($rowt[aihekiinni] == 1) {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="5" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br><br><b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio on suljettu</b></td><td style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708"></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="5" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br><br><b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio on sulkeutunut: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</b></td><td style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708"></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $osiovapaa)) {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="5" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br><br><b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio sulkeutuu: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</b></td><td style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708"></td></tr>';
                                } else {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="5" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br></td><td style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708"></td></tr>';
                                }
                            } else if ($rowt[aihe] == 1 && $pisteet == 0) {
                                if ($rowt[aihekiinni] == 1) {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4" ><td style="border: 2px solid #080708; border-right: none"></td><td colspan="4" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br><br><b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio on suljettu</b></td><td style="background-color: #c8d8e4;  border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708 "></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4" ><td style="border: 2px solid #080708; border-right: none"></td><td colspan="4" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br><br><b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio on sulkeutunut: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</b></td><td style="background-color: #c8d8e4;  border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708 "></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $osiovapaa)) {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4" ><td style="border: 2px solid #080708; border-right: none"></td><td colspan="4" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br><br><b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio sulkeutuu: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</b></td><td style="background-color: #c8d8e4;  border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708 "></td></tr>';
                                } else {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4" ><td style="border: 2px solid #080708; border-right: none"></td><td colspan="4" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br></td><td style="background-color: #c8d8e4;  border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708 "></td></tr>';
                                }
                            } else {
                                $aika = microtime(true);
                                if (!$haekp = $db->query("select distinct * from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND id IN (
   SELECT MIN(id) FROM itsetehtavatkp
   WHERE itsetehtavat_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'
) AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }
                                $aika2 = microtime(true) - $aika;
                                while ($rowkp = $haekp->fetch_assoc()) {


                                    if ($pisteet) {

                                        if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == ''))) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            }
                                        } else if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio))) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            }
                                        } else if ($rowkp[tallennettu] == 0 && $rowt[aihekiinni] == 0) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey;  background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey;  background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey;  background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey;  background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey;  background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey;  background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        } else if ($rowkp[tallennettu] == 0 && ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio))) {



                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey;  background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey;  background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            }
                                        }

                                        //TÄÄÄ PITÄÄ TARKISTAA!!
                                        if ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio)) {
                                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            }
                                        } else {
                                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input  type="number" name="omatpisteet[]" id="id' . $rowt[id] . '" class="omat" value="' . $rowkp[opiskelijan_pisteet] . '" min="0" max="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        }
                                    }

                                    //TÄSTÄ PUUTTUU JOS EI PISTEITÄ!!!
                                }
                            }
                        }  //ei itsepisteytystä
                        else {

                            if ($rowt[aihe] == 1 && $pisteet == 1) {
                                if ($rowt[aihekiinni] == 1) {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="4" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br><br><b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio on suljettu</b></td><td style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708"></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="4" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br><br><b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio on sulkeutunut: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</b></td><td style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708"></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $osiovapaa)) {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="4" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br><br><b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio sulkeutuu: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</b></td><td style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708"></td></tr>';
                                } else {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="4" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br></td><td style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708"></td></tr>';
                                }
                            } else if ($rowt[aihe] == 1 && $pisteet == 0) {
                                if ($rowt[aihekiinni] == 1) {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4" ><td style="border: 2px solid #080708; border-right: none"></td><td colspan="3" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br><br><b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio on suljettu</b></td><td style="background-color: #c8d8e4;  border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708 "></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4" ><td style="border: 2px solid #080708; border-right: none"></td><td colspan="3" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br><br><b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio on sulkeutunut: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</b></td><td style="background-color: #c8d8e4;  border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708 "></td></tr>';
                                } else if (($rowt[aihekiinni] == 0 && $osiovapaa)) {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4" ><td style="border: 2px solid #080708; border-right: none"></td><td colspan="3" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br><br><b style="font-size:0.9em; margin-right: 20px; color: #e608b8">Tämä osio sulkeutuu: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</b></td><td style="background-color: #c8d8e4;  border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708 "></td></tr>';
                                } else {
                                    echo '<tr style=" font-size: 1em; background-color: #c8d8e4" ><td style="border: 2px solid #080708; border-right: none"></td><td colspan="3" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br></td><td style="background-color: #c8d8e4;  border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708 "></td></tr>';
                                }
                            } else {
                                $aika = microtime(true);
                                if (!$haekp = $db->query("select distinct * from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND id IN (
   SELECT MIN(id) FROM itsetehtavatkp
   WHERE itsetehtavat_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'
) AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }
                                $aika2 = microtime(true) - $aika;

                                $rivit = microtime(true);
                                while ($rowkp = $haekp->fetch_assoc()) {


                                    if ($pisteet) {

                                        if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == ''))) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            }
                                        } else if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio))) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            }
                                        } else if ($rowkp[tallennettu] == 0 && $rowt[aihekiinni] == 0) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {
                                                //TÄNNE
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        } else if ($rowkp[tallennettu] == 0 && ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio))) {



                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            }
                                        }

                                        //TÄÄÄ PITÄÄ TARKISTAA!!
                                        if ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio)) {
                                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            }
                                        } else {
                                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        }
                                    } else {

                                        //EI ESTETTY KOKONAAN, EI PISTEITÄ
                                        if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == ''))) {
                                            //TÄSTÄ ETEENPÄIN ->

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" "><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                            }
                                        } else if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio))) {
                                            //ESTO

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" "><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            }
                                        } else if ($rowkp[tallennettu] == 0 && $rowt[aihekiinni] == 0) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        } else if ($rowkp[tallennettu] == 0 && $rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio)) {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white">>' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em" class="stripe-2"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            }
                                        }

                                        if ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio)) {

                                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em;" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                                echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kom' . $rowt[id] . '" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                            }
                                        } else {
                                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check( this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2( this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white"><textarea name="kommentti[]" id="kom' . $rowt[id] . '" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        }
                                    }
                                }$rivit2 = microtime(true) - $rivit;
                            }
                        }
                    }
                    $time_elapsed_secsopiskelijal1 = microtime(true) - $startopiskelijal1;
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
                    $time_elapsed_secsopiskelijal = microtime(true) - $startopiskelijal;
                }

                //ESTETTY, PISTEET EI TOIMI, EI-PISTEET TOIMII!
                else {
                    echo'<div id="scrollbar"><div id="spacer"></div></div>';
                    echo'<div class="cm8-responsive" id="container2" style="padding-top: 10px;">';
                    echo '<table id="mytable2" class="cm8-uusitable2" style="table-layout:fixed;  max-width: 99%; overflow: hidden">  ';
                    echo'<thead>';
                    echo '<tr style="border: 2px solid #080708; background-color: #52ab98;  font-size: 1em">';
                    if ($pisteet) {
                        if ($itsepisteytys) {
                            echo'<th>Tehtävä</th><th>Tehtävän<br>pistemäärä</th><th>Oma pisteytys<br>tehtävästä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti</th><th style="border: none"></th></tr></thead><tbody>';
                        } else {
                            echo'<th>Tehtävä</th><th>Tehtävän<br>pistemäärä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti</th><th style="border: none"></th></tr></thead><tbody>';
                        }
                    } else {

                        if ($itsepisteytys) {

                            echo'<th>Tehtävä</th><th>Oma pisteytys<br>tehtävästä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti</th><th style="border: none"></th></tr></thead><tbody>';
                        } else {

                            echo'<th>Tehtävä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti</th><th style="border: none"></th></tr></thead><tbody>';
                        }
                    }

                    while ($rowt = $haetehtavat->fetch_assoc()) {



                        if ($itsepisteytys) {
                            //TÄHÄN MUOKATTU
                            if ($rowt[aihe] == 1 && $pisteet == 1) {
                                echo '<tr style=" font-size: 1em; background-color: #c8d8e4"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="4" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br></td><td style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708"></td></tr>';
                            } else if ($rowt[aihe] == 1 && $pisteet == 0) {
                                echo '<tr style=" font-size: 1em; background-color: #c8d8e4" ><td style="border: 2px solid #080708; border-right: none"></td><td colspan="3" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br></td><td style="background-color: #c8d8e4;  border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708 "></td></tr>';
                            } else {
                                if (!$haekp = $db->query("select distinct * from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND id IN (
   SELECT MIN(id) FROM itsetehtavatkp
   WHERE itsetehtavat_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'
) AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }
                                while ($rowkp = $haekp->fetch_assoc()) {

                                    if ($pisteet) {
                                        if ($rowkp[tallennettu] == 1) {


                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            }
                                        } else {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        }



                                        if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                            echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">' . $rowkp[opiskelijan_pisteet] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                            echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                        }
                                    } else {
                                        if ($rowkp[tallennettu] == 1) {


                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" "><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            }
                                        } else {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white">>' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        }



                                        if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                            echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                            echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                        }
                                    }
                                }
                            }
                        } else {

                            //TÄHÄN MUOKATTU
                            if ($rowt[aihe] == 1 && $pisteet == 1) {
                                echo '<tr style=" font-size: 1em; background-color: #c8d8e4"><td style="border: 2px solid #080708; border-right: none"></td><td colspan="4" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br></td><td style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708"></td></tr>';
                            } else if ($rowt[aihe] == 1 && $pisteet == 0) {
                                echo '<tr style=" font-size: 1em; background-color: #c8d8e4" ><td style="border: 2px solid #080708; border-right: none"></td><td colspan="3" style="background-color: #c8d8e4; border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-left: none"><b>' . $rowt[otsikko] . '</b><br></td><td style="background-color: #c8d8e4;  border-bottom: 2px solid #080708; border-top: 2px solid #080708; border-right: 2px solid #080708 "></td></tr>';
                            } else {
                                if (!$haekp = $db->query("select distinct * from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND id IN (
   SELECT MIN(id) FROM itsetehtavatkp
   WHERE itsetehtavat_id='" . $rowt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'
) AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }
                                while ($rowkp = $haekp->fetch_assoc()) {

                                    if ($pisteet) {
                                        if ($rowkp[tallennettu] == 1) {


                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            }
                                        } else {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        }



                                        if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                            echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '<input type="hidden"  id="paino' . $rowt[id] . '" value="' . $rowt[paino] . '"></td> <td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                            echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                        }
                                    } else {
                                        if ($rowkp[tallennettu] == 1) {


                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color: #7FD858"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em; background-color:  #00bfff"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                                echo '<tr id="' . $rowt[jarjestys] . '" "><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	yellow">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                            }
                                        } else {

                                            if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                                echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em"><td style=" padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                                echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
                                            }
                                        }



                                        if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                            $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                            echo '<tr id="' . $rowt[jarjestys] . '" style=" font-size: 1em" class="stripe-2"><td style="  padding-left: 10px; border: 1px solid grey" id[]=' . $rowt[id] . '>' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey; background-color: white" name="kommentti[]" id="kom' . $rowt[id] . '">' . $rowkp[kommentti] . '</td></tr>';
                                            echo'<input type="hidden"  name="id[]" id="id" value=' . $rowt[id] . '>';
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


                    //loppu           
                }
            }
        }
        echo'</div>';

        echo'</div>';
//           $pienimi = 'sektori' . $_SESSION[Id] . '.png';
//    $file='images/'.$pienimi;
//if (file_exists($file)) {
//
//            unlink( $file );
//        }
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

//    echo'<div class="cm8-container4" style="padding-top: 10px; margin-top: 0px; padding-bottom: 10px; margin-bottom: 0px"><br>';
//    echo'<div id="myprogress4"></div>';
//        echo'<div id="myprogress3"></div>';
//        echo'</div>';
$time_elapsed_secsk = microtime(true) - $startkoko;
//     
//echo'<br>dopisk: '.$time_elapsed_secsopiskelijad;
//echo'<br>lopisk1: '.$time_elapsed_secsopiskelijal1;
//echo'<br>lopisk2: '.$time_elapsed_secsopiskelijal2;
//echo'<br>haku: '.$aika2;
//echo'<br>määrä: '.$monta;
//echo'<br>rivit: '.$rivit2;
//echo'<br>dope: '.$time_elapsed_secsdope;
//  echo'<br>lope: '.$time_elapsed_secslope;
//
//echo'<br>kokos: '.$time_elapsed_secsk;

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
            minTime: new Date(0, 0, 0, 1, 0, 0),
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
  $('.kelloE').timepicker({
            timeFormat: 'HH:mm',
            // year, month, day and seconds are not important
            minTime: new Date(0, 0, 0, 1, 0, 0),
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
<script>
    let buttons = document.querySelectorAll('.kello');
    buttons.forEach((btn) => {

        btn.addEventListener("keyup", function (event) {

            if (event.keyCode === 13) {
                event.preventDefault();
                var ancestor = this.parentNode;
                ancestor.submit();
//   document.getElementById("button").click();

            }
        });



    });


</script>
<script>
    var input = document.getElementById("kelloE");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("buttonE").click();
        }
    });
</script>

</body>
</html>	
