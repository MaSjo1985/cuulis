<?php
session_start();
ob_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Tehtävälista</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
<link rel="shortcut icon" href="favicon.png" type="image/png" />';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
//        if (!$haelinkki = $db->query("select distinct * from opiskelijankirja where itseprojekti_id='" . $_GET[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
//            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//        }
//
//        if ($haelinkki->num_rows != 0) {
//
//
//
//            while ($rowt = $haelinkki->fetch_assoc()) {
//
//                echo'<div style="display:none" id="tama1" class="cm8-half"><br></div>';
//                echo'<div style="display:none" id="tama" class="cm8-half">';
//                echo'<div id="siirto" style="display:none" title="Voit siirtää aluetta!" style="width: auto; height: auto;z-index: 1001;position: fixed !important">';
//                echo'<div style="display:none" id="siirto2">';
//
//
//                echo'<p style="display: inline-block; margin: 0px; padding: 0px; font-size: 0.7em"><b><em>Huom! Jos istuntosi on vanhentunut, kirjaudu kustantajan sivulle ja PÄIVITÄ SIVU.</em>';
//
//                if ($rowt[kirjautuminen] != '') {
//                    echo'<br> <a href="' . $rowt[kirjautuminen] . '" target="_blank" style="color: #2b6777"> Kirjaudu tästä >> </a></b></p>';
//                } else {
//                    echo'</b></p>';
//                }
//                echo' <button id="klik" style="display: inline-block; margin-left: 30px" class="myButton8" title="Piilota näkyvistä">- Piilota</button>';
//                echo'<form action="poistakirjavarmistus.php" method="post" style="display: inline-block; margin: 0px 0px 0px 20px"> <input type="hidden" name="ipid" value="' . $_GET[id] . '"><input type="hidden" name="paluu" value="muokkaus"><button class="roskis" title="Poista digikirja"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i></button></form>';
//
//                echo'<br><iframe id="kirja" title="kirja" src="' . $rowt[linkki] . '" style="width: 100%"  allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>';
//
//
//                echo'</div>';
//                echo'</div>';
//                echo'</div>';
//            }
//        } else {
//
//            echo'<p style="z-index: 1;position: fixed; top:30%; right:10%"><form action="lisaakirja.php" style="z-index: 1;position: fixed; top:20%; left:2%" method="post" > <input type="hidden" name="ipid" value="' . $_GET[id] . '"><input type="hidden" name="paluu" value="muokkaus"> <input type="submit" value="+ Lisää digikirja"  class="myButton8"  role="button"  style="padding:2px 4px"></form></p>';
//        }

        ini_set('display_errors', '0');
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link rel="stylesheet" href="css/fontawesome-stars.css">
<link rel="stylesheet" href="css/fontawesome-stars-o.css">
 <link rel="stylesheet" href="css/tekstieditori_taulukko.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



<script src="funktioita.js" language="javascript" type="text/javascript"></script>

<script src="jquery.ui.touch-punch.min.js"></script>';

        echo'<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
    </script>
   



<script type="text/javascript" src="js/TimeCircles.js"></script>
 <script src="toinen.js" language="javascript" type="text/javascript"></script>





';

        echo'</head>';




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



        $browser = $_SERVER['HTTP_USER_AGENT'];

        if ((strpos($browser, 'Android') && strpos($browser, 'wv')) || (strpos($browser, 'OS') && strpos($browser, 'Safari') === false)) {
            echo'<header class="cm8-container" style="padding-top: 0px; padding-bottom: 20px;">
  <h1 style="padding-bottom: 0px; display: inline-block;"><a href="etusivu.php">Cuulis</a>
  <em style="font-size: 1.1em; display: inline-block">&nbsp&nbsp&nbsp - &nbsp&nbsp&nbspoppimisympäristö</em></h1>';
        } else {
            echo'<header class="cm8-container" style="padding-top: 5px; padding-bottom: 10px;">
  <h1 style="padding-bottom: 0px; display: inline-block; margin-right: 80px"><a href="etusivu.php" style="padding: 0px">Cuulis</a>
  <em style="font-size: 0.8em; display: inline-block;">&nbsp&nbsp&nbsp - &nbsp&nbsp&nbspoppimisympäristö</em></h1><a href="lataasovellus.php" class="cm8-linkk4">Cuulis-sovellus Androidille </a>';
        }

        echo'

</header>';

// ready to go!

        $url = $_SERVER[REQUEST_URI];
        $url = substr($url, 1);

        echo'<div class="cm8-container7">';
        echo'<div class="cm8-container4" style="margin-left: 0px; padding-left: 10px; padding-top: 10px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px; border: none;padding-right: 20px; margin-right: 0px">';
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


 
<div class="cm8-threequarter" style="padding-top: 0px; margin-top: 0px">';
        if ($haelinkki->num_rows != 0) {
            echo' <p style="z-index: 1001;position: fixed; top:30%; left:2%">';
            echo' <button id="klik2"  class="myButton8" title="Avaa digikirja">+ Avaa digikirja</button></p>';
        }


        if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $onkoprojekti->fetch_assoc()) {

            $ipid = $rowP[id];
            $kuvaus = $rowP[kuvaus];


            echo'<br><h6 style="padding-top: 0px; padding-bottom: 20px; font-size: 1.3em; display: inline-block">' . $kuvaus . '</h6>';
            echo'<br><a href="itsetyot.php?i=' . $ipid . '#palaatanne"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';
            if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $onko = $haetehtavat->num_rows;


            echo'<br><form action="tuotehtavat.php" method="get" style="display: inline-block"><input type="hidden" name="monesko" value=' . $_GET[monesko] . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#10000 Tuo aiemmin valittuja tehtäviä" class="myButton9"  role="button"  style="padding:4px 6px"></form>';

            echo'<form name="myForm" action="testi.php" method="post">';
            if (!$haetehtavat2 = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $yht = $haetehtavat2->num_rows;


            echo'<br><p id="ohje"><b>Tehtäviä yhteensä: </b>' . $yht . ' kpl.</p>';

            echo'<div  style="display: inline-block; width: 50%; margin-bottom: 40px; margin-left: 0px; padding-left: 0px">';


            echo'<br><b>Pisteytetäänkö tehtävät?</b><br><br>';




            if (!$result = $db->query("select distinct painotus from itseprojektit where id = '" . $ipid . "' AND painotus = 1")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($result->num_rows != 0) {


                echo'<input type="radio" name="painotus" id="painotusok" value="1" checked> Kyllä<br>';
                echo'<input type="radio" name="painotus" id="idpainotusei" value="0"> Ei<br>';
            } else {
                echo'<input type="radio" name="painotus" id="painotusok" value="1"> Kyllä<br>';
                echo'<input type="radio" name="painotus" id="idpainotusei" value="0" checked> Ei<br>';
            }
            ?>

            <script>
                var rad = document.myForm.painotus;
                var prev = null;
                for (var i = 0; i < rad.length; i++) {
                    rad[i].onclick = function () {
                        (prev) ? console.log(prev.value) : null;
                        if (this !== prev) {
                            prev = this;
                        }
                        console.log(this.value);

                        if (this.value == 0) {
                            document.getElementById('omapainotusok').checked = false;
                            document.getElementById('omapainotusei').checked = true;
                            document.getElementById('omapainotusok').disabled = true;
                            document.getElementById('omapainotusei').disabled = true;
                            document.getElementById('annaomat').style.color = "grey";

                        } else {

                            document.getElementById('omapainotusok').disabled = false;
                            document.getElementById('omapainotusei').disabled = false;
                            document.getElementById('annaomat').style.color = "#2b6777";

                        }
                    };
                }

                if (document.getElementById('painotusok').value == 0) {
                    document.getElementById('omapainotusok').checked = false;
                    document.getElementById('omapainotusei').checked = true;
                    document.getElementById('omapainotusok').disabled = true;
                    document.getElementById('omapainotusei').disabled = true;
                    document.getElementById('annaomat').style.color = "grey";

                } else {

                    document.getElementById('omapainotusok').disabled = false;
                    document.getElementById('omapainotusei').disabled = false;
                    document.getElementById('annaomat').style.color = "#2b6777";


                }

            </script>
            <?php
session_start();
            ob_start();

            echo'</div>';
            echo'<div id="annaomat" style="display: inline-block; width: 50%; margin-bottom: 40px; margin-left: 0px; padding-left: 0px">';
            echo'<p style="font-weight: bold">Annetaanko opiskelijoiden itse pisteyttää tekemänsä tehtävät?</p>';




            if (!$resulto = $db->query("select distinct itsepisteytys from itseprojektit where id = '" . $ipid . "' AND itsepisteytys = 1")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($resulto->num_rows != 0) {


                echo'<input type="radio" name="omapisteytys" id="omapainotusok" value="1" checked> Kyllä<br>';
                echo'<input type="radio" name="omapisteytys" id="omapainotusei" value="0"> Ei<br>';
            } else {
                echo'<input type="radio" name="omapisteytys" id="omapainotusok" value="1"> Kyllä<br>';
                echo'<input type="radio" name="omapisteytys" id="omapainotusei" value="0" checked> Ei<br>';
            }
            ?>

            <script>
                var rad = document.myForm.omapisteytys;
                var prev = null;
                for (var i = 0; i < rad.length; i++) {
                    rad[i].onclick = function () {
                        (prev) ? console.log(prev.value) : null;
                        if (this !== prev) {
                            prev = this;
                        }
                        console.log(this.value);
                    };
                }
            </script>
            <?php
session_start();
            ob_start();

            echo'</div>';

            echo'<div class="cm8-responsive">';
            echo'<br><input type="submit" name="painiket" value="&#10003 Tallenna" class="myButton9"  role="button"  style="padding:4px 6px; margin-left: 10px"><br><br>';
            echo '<table id="mytable" class="cm8-uusitableteht2" style="table-layout:fixed; width: 100%;">  <thead>';
            if ($_GET[kaikki] == 'joo') {

                if ($onko != 0) {

                    echo '<tr style="border: 1px solid grey; background-color: #73b9cc;"><th style="border-right: 1px solid grey;"><button class="pieniroskis" title="Poista" name="painikep" ><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button><br><br><a href="testaamuokkaus.php?id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '#cm"  style="font-size: 0.9em; ">Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th><th style="border-right: 1px solid grey; text-align: center; "><input type="submit" id="tanne" name="painiket" value="&#10003 Tallenna" class="myButton8"  role="button"  style="padding:4px 6px"><br><br>Sisältö</th><th style="border-right: 1px solid grey; text-align: center; ">Pisteet</th><th ><input type="hidden" name="ipid" value=' . $ipid . '> <input type="submit" name="painikel" value="+ Lisää tehtävä yläpuolelle" class="myButton8"  role="button"  style="padding:2px 4px; "><br><br><input type="submit" name="painikelo" value="+ Lisää otsikko yläpuolelle" class="myButton8"  role="button"  style="padding:2px 4px"></th></tr></thead><tbody>';
                } else {
                    echo '<tr style="border: 1px solid grey; background-color: #73b9cc"><th style="border-right: 1px solid grey; "></th><th style="border-right: 1px solid grey; text-align: center; ">Sisältö</th><th style="border-right: 1px solid grey; text-align: center; ">Pisteet</th><th style="text-align: center; "></th></tr></thead><tbody>';
                }



                $maara = 0;
                while ($rowt = $haetehtavat->fetch_assoc()) {
                    $maara = $maara + 1;
                    $rowt[sisalto] = str_replace('<br />', "", $rowt[sisalto]);
                    $rowt[otsikko] = str_replace('<br />', "", $rowt[otsikko]);
                    if ($rowt[aihe] == 1) {
                        $paluu = $rowt[jarjestys];

                        if ($_GET[vikao] == 1) {
                            if (($_GET[monesko] == ($paluu)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                                echo '<tr  class="aihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td><textarea name="otsikko[]" class="content' . $maara . '" rows="4" style="height: 10px" autofocus>' . $rowt[otsikko] . '</textarea>';
                            } else {
                                echo '<tr  class="aihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td><textarea name="otsikko[]" class="content' . $maara . '" rows="4" style="height: 10px">' . $rowt[otsikko] . '</textarea>';
                            }
                        } else {
                            if (($_GET[monesko] == ($paluu - 1)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                                echo '<tr  class="aihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td><textarea name="otsikko[]" class="content' . $maara . '" rows="4" style="height: 10px" autofocus>' . $rowt[otsikko] . '</textarea>';
                            } else {
                                echo '<tr  class="aihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td><textarea name="otsikko[]" class="content' . $maara . '" rows="4" style="height: 10px">' . $rowt[otsikko] . '</textarea>';
                            }
                        }





                        echo '</td><td style="text-align: center"></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';

                        echo'<input type="hidden" id="' . $paluu . '" name="id[]" value=' . $rowt[id] . '>';
                        echo'<input type="hidden" name="sisalto[]" value=' . $rowt[sisalto] . '>';
                    } else {
                        $paluu = $rowt[jarjestys];
                        if ($_GET[vikao] == 1) {
                            if (($_GET[monesko] == ($paluu)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                                echo '<tr class="sisalto"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td> <textarea name="sisalto[]" rows="3"  autofocus>' . $rowt[sisalto] . '</textarea></td><td style="text-align: center; "><input type="number" name="paino[]" min="0" max="100"  value="' . $rowt[paino] . '"></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            } else {
                                echo '<tr class="sisalto"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td> <textarea name="sisalto[]" rows="3" >' . $rowt[sisalto] . '</textarea></td><td style="text-align: center; "><input type="number" min="0" name="paino[]" max="100"  value="' . $rowt[paino] . '"></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            }
                        } else {
                            if (($_GET[monesko] == ($paluu - 1)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                                echo '<tr class="sisalto"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td> <textarea name="sisalto[]" rows="3"  autofocus>' . $rowt[sisalto] . '</textarea></td><td style="text-align: center; "><input type="number" name="paino[]" min="0" max="100"  value="' . $rowt[paino] . '"></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            } else {
                                echo '<tr class="sisalto"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td> <textarea name="sisalto[]" rows="3" >' . $rowt[sisalto] . '</textarea></td><td style="text-align: center; "><input type="number" min="0" name="paino[]" max="100"  value="' . $rowt[paino] . '"></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                            }
                        }


                        echo'<input type="hidden" name="paino[]" value="-1">';
                        echo'<input type="hidden" id="' . $paluu . '" name="id[]" value=' . $rowt[id] . '>';
                        echo'<input type="hidden" name="otsikko[]" value=' . $rowt[otsikko] . '>';
                    }
                }
            } else {


                if ($onko != 0) {

                    echo '<tr style="border: 1px solid grey; background-color: #73b9cc; "><th style="border-right: 1px solid grey; "><button class="pieniroskis" title="Poista" name="painikep" ><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button><br><br><a href="testaamuokkaus.php?kaikki=joo&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '#cm"  style="font-size: 0.9em; ">Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th style="border-right: 1px solid grey; text-align: center; "><input type="submit" id="tanne" name="painiket" value="&#10003 Tallenna" class="myButton8"  role="button"  style="padding:4px 6px"><br><br>Sisältö</th><th style="border-right: 2px solid grey; text-align: center; ">Pisteet</th><th style="border-right: 1px solid grey"><input type="hidden" name="ipid" value=' . $ipid . '> <input type="submit" name="painikel" value="+ Lisää tehtävä yläpuolelle" class="myButton8"  role="button"  style="padding:2px 4px; "><br><br><input type="submit" name="painikelo" value="+ Lisää otsikko yläpuolelle" class="myButton8"  role="button"  style="padding:2px 4px"></th><th><button class="pieniroskis" name="painikek">Kopioi</button><br><br>&nbsp&#9661&nbsp</th></tr></thead><tbody>';
                } else {

                    echo '<tr style="border: 1px solid grey; background-color: #73b9cc; "><th style="border-right: 1px solid grey; "></th><th style="border-right: 1px solid grey; text-align: center; ">Sisältö</th><th style="border-right: 1px solid grey; text-align: center; ">Pisteet</th><th style="padding-right: 0px; "></th></tr></thead><tbody>';
                }





                $maara = 0;
                while ($rowt = $haetehtavat->fetch_assoc()) {
                    $maara = $maara + 1;
                    $rowt[sisalto] = str_replace('<br />', "", $rowt[sisalto]);
                    $rowt[otsikko] = str_replace('<br />', "", $rowt[otsikko]);

                    if ($rowt[aihe] == 1) {
                        $paluu = $rowt[jarjestys];

                        if ($_GET[vikao] == 1) {
                            if (($_GET[monesko] == ($paluu)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                                echo '<tr id="' . $paluu . '" class="taihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td ><textarea name="otsikko[]" class="content' . $maara . '" rows="4" style="height: 10px" autofocus>' . $rowt[otsikko] . '</textarea>';
                            } else {
                                echo '<tr id="' . $paluu . '" class="taihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="otsikko[]" class="content' . $maara . '" rows="4" style="height: 10px">' . $rowt[otsikko] . '</textarea>';
                            }
                        } else {
                            if (($_GET[monesko] == ($paluu - 1)) && ($rowt[sisalto] == "") && ($rowt[otsikko] == "")) {
                                echo '<tr id="' . $paluu . '" class="taihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="otsikko[]" class="content' . $maara . '" rows="4" style="height: 10px" autofocus>' . $rowt[otsikko] . '</textarea>';
                            } else {
                                echo '<tr id="' . $paluu . '"  class="taihe"><td ><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="otsikko[]" class="content' . $maara . '" rows="4" style="height: 10px">' . $rowt[otsikko] . '</textarea>';
                            }
                        }


                        echo '</td><td style="text-align: center"></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td><td></td></tr>';

                        echo'<input type="hidden" name="id[]" value=' . $rowt[id] . '>';
                        echo'<input type="hidden" name="sisalto[]" value=' . $rowt[sisalto] . '>';
                        echo'<input type="hidden" name="paino[]" value="-1">';
                    } else {
                        $paluu = $rowt[jarjestys];

                        if ($_GET[vikat] == 1) {
                            if (($_GET[monesko] == ($paluu)) && ($rowt[sisalto] == "")) {
                                echo '<tr id="' . $paluu . '" class="tsisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="sisalto[]" rows="3"  autofocus>' . $rowt[sisalto] . '</textarea></td><td style="text-align: center"><input type="number" name="paino[]" min="0"  max="100" value="' . $rowt[paino] . '"></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td><td><input type="checkbox" name="kopid[]" value="' . $rowt[id] . '"></td></tr>';
                            } else {
                                echo '<tr id="' . $paluu . '" class="tsisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="sisalto[]" rows="3" >' . $rowt[sisalto] . '</textarea></td><td style="text-align: center"><input type="number" name="paino[]" min="0" max="100"  value="' . $rowt[paino] . '"></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td><td><input type="checkbox" name="kopid[]" value="' . $rowt[id] . '"></td></tr>';
                            }
                        } else {
                            if (($_GET[monesko] == ($paluu - 1)) && ($rowt[sisalto] == "")) {
                                echo '<tr id="' . $paluu . '" class="tsisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="sisalto[]" rows="3"  autofocus>' . $rowt[sisalto] . '</textarea></td><td style="text-align: center"><input type="number"  name="paino[]" min="0" max="100" value="' . $rowt[paino] . '"></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td><td><input type="checkbox" name="kopid[]" value="' . $rowt[id] . '"></td></tr>';
                            } else {
                                echo '<tr id="' . $paluu . '" class="tsisalto"><td> <input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td><textarea name="sisalto[]" rows="3" >' . $rowt[sisalto] . '</textarea></td><td style="text-align: center"><input type="number" name="paino[]" min="0" max="100"  value="' . $rowt[paino] . '"></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td><td><input type="checkbox" name="kopid[]" value="' . $rowt[id] . '"></td></tr>';
                            }
                        }



                        echo'<input type="hidden" name="id[]" value=' . $rowt[id] . '>';
                        echo'<input type="hidden" name="otsikko[]" value=' . $rowt[otsikko] . '>';
                    }
                }
            }

            if ($onko != 0) {
                echo '<tr style="border:none;  background-color: transparent"><td style="border: 1.1px solid transparent"><button class="pieniroskis" title="Poista" name="painikep"><i class="fa fa-trash-o" style="display: inline-block; margin-right: 10px"></i>Poista</button></td><td style="border: 1.1px solid transparent"></td><td style="border: 1.1px solid transparent"></td><td style="border: 1.1px solid transparent"><input type="hidden" name="ipid" value=' . $ipid . '> <input type="submit" name="painikel" value="+ Lisää tehtävä yläpuolelle" class="myButton8"  role="button"  style="padding:2px 4px;"><br><br><input type="submit" name="painikelo" value="+ Lisää otsikko yläpuolelle" class="myButton8"  role="button"  style="padding:2px 4px"></td></tr>';
            } else {
                echo '<tr style="border: none;  background-color: transparent"><td></td><td></td><td></td><td><input type="hidden" name="ipid" value=' . $ipid . '><br> <input type="submit" name="painikel" value="+ Lisää tehtävä" class="myButton8"  role="button"  style="padding:2px 4px;"><br><br><input type="submit" name="painikelo" value="+ Lisää otsikko" class="myButton8"  role="button"  style="padding:2px 4px"></td></tr>';
            }
            echo "</tbody></table></div>";
            echo'<input type="hidden" name="monesko" value=' . $_GET[monesko] . '>';
            echo'<input type="hidden" name="ipid" value=' . $ipid . '>';
            echo'<br><input type="submit" id="tanne" name="painiket" value="&#10003 Tallenna" class="myButton9"  role="button"  style="padding:4px 6px">';
            echo'</form>';

            echo' <div class="cm8-margin-top" id="cm"></div>';
        }
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







        echo'</div></div>





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

<script type="text/javascript">

    $('.cm8-responsive').on('change keyup keydown paste cut', 'textarea', function () {
        $(this).height(0).height(this.scrollHeight);
    }).find('textarea').change();
</script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="js/tekstieditori.js"></script>
<script>
    $(document).ready(function () {
        var table = document.getElementById("mytable");
        var rowCount = table.rows.length - 2;
        for (var i = 1; i <= rowCount; i++) {

            $('.content' + i).richText({
                translations: {
                    'title': 'Otsikko',
                    'white': 'Valkoinen',
                    'black': 'Musta',
                    'brown': 'Ruskea',
                    'beige': 'Beige',
                    'darkBlue': 'Tummansininen',
                    'blue': 'Sininen',
                    'lightBlue': 'Vaaleansininen',
                    'darkRed': 'Tummanpunainen',
                    'red': 'Punainen',
                    'darkGreen': 'Tummanvihreä',
                    'green': 'Vihreä',
                    'purple': 'Purppura',
                    'darkTurquois': 'Tekstin oletusväri',
                    'turquois': 'Turkoosi',
                     'darkOrange': 'Tummanoranssi',
                            'orange': 'Oranssi',
                    'yellow': 'Keltainen',
                    'imageURL': 'Kuvan URL-osoite',
                    'fileURL': 'Tiedoston URL-osoite',
                    'linkText': 'Linkin teksti',
                    'url': 'URL-osoite',
                    'size': 'Koko',
                    'responsive': '<a href="https://www.jqueryscript.net/tags.php?/Responsive/">Responsiivinen</a>',
                    'text': 'Teksti',
                    'openIn': 'Avaa..',
                    'sameTab': 'Samassa välilehdessä',
                    'newTab': 'Uudessa välilehdessä',
                    'align': 'Kohdistus',
                    'left': 'Vasemmalle',
                    'center': 'Keskelle',
                    'right': 'Oikealle',
                    'rows': 'Rivit',
                    'columns': 'Sarakkeet',
                    'add': 'Lisää',
                    'pleaseEnterURL': 'Anna URL-osoite',
                    'videoURLnotSupported': 'Videon URL-osoitetta ei ole tuettu',
                    'pleaseSelectImage': 'Valitse kuva',
                    'pleaseSelectFile': 'Valitse tiedosto',
                    'bold': 'Bold',
                    'italic': 'Italic',
                    'underline': 'Underline',
                    'alignLeft': 'Kohdistus vasemmalle',
                    'alignCenter': 'Kohdistus keskelle',
                    'alignRight': 'Kohdistus oikealle',
                    'addOrderedList': 'Lisää järjestetty lista',
                    'addUnorderedList': 'Lisää järjestämätön lista',
                    'addHeading': 'Lisää otsikko',
                    'addFont': 'Fontti',
                    'addFontColor': 'Fontin väri',
                    'addFontSize': 'Fontin koko',
                    'addImage': 'Lisää kuva',
                    'addVideo': 'Lisää video',
                    'addFile': 'Lisää tiedosto',
                    'addURL': 'Lisää URL-osoite',
                    'addTable': 'Lisää taulukko',
                    'removeStyles': 'Poista muotoilut',
                    'code': 'Näytä HTML-koodi',
                    'undo': 'Kumoa',
                    'redo': 'Tee uudelleen',
                    'close': 'Sulje'
                },
            });





        }

    });
</script>
</body>
</html>							