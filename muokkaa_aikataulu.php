<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Kurssiaikataulu</title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

$url = $_SERVER[REQUEST_URI];
if( !strpos($url,"?")){
    header('location: muokkaa_aikataulu.php?#tanne');
}
 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

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
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/tekstieditori2.css">

  
<link rel="stylesheet" type="text/css" href="jscm/jquery.timepicker.css" /><link rel="stylesheet" type="text/css" href="jscm/jquery.datepicker.css" />


  <link rel="stylesheet" href="css/trontastic.css" />



<link href="ulkoasu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link rel="stylesheet" href="css/fontawesome-stars.css">
<link rel="stylesheet" href="css/fontawesome-stars-o.css">


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

            echo'<br><form action="vaihda.php" method="post"><input type="hidden" name="url" value="' . $url . '" ><input type="hidden" name="arvo" value="pois"> <input type="submit" value="Poistu opiskelijanäkymästä" class="munNappula4"  role="button"></form>';
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




        echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';


        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '" class="currentLink">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
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


        echo'<div class="cm8-container3" >';




        echo'<br><h7 id="tanne">Muokkaa aikataulua</h7>';
        echo'<br><a href="kurssi.php?id=' . $_SESSION[KurssiId] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br>';

        echo'<div style="text-align: center">';

  echo'<br><form action="tuoaikataulu.php" method="get" style="display: inline-block; font-size: 1.1em "><input type="hidden" name="monesko" value=' . $_GET[monesko] . '><input type="hidden" name="id" value=' . $ipid . '>';

  echo'<button  name="painike" title="Tuo aikataulu" class="myButtonTuo"><i class="fa fa-recycle"></i>&nbsp&nbsp Tuo aiemmin luotu aikataulu </button>';
  echo'</form>';

        echo'</div>';
        if (!$haeaikataulu = $db->query("select distinct * from kurssiaikataulut where kurssi_id='" . $_SESSION[KurssiId] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $onko = $haeaikataulu->num_rows;

        echo'<form action="aikataulumuokkaus.php" method="post">';

        echo'<div class="cm8-responsive" id="content">';
        echo '<br><br><table id="mytable" class="cm8-uusitableaika" style="table-layout:fixed; width: 95%;"> <thead> ';


        if ($_GET[kaikki] == 'joo') {


            if ($onko != 0) {


                echo '<tr style="border: 1px solid grey; background-color: #73b9cc;"><th style="border-right: 1px solid grey;"><button class="roskis" style="font-size: 1em" title="Poista" name="painikep"><i class="fa fa-trash-o" style="margin-right: 5px"></i>Poista</button><br><br><a href="muokkaa_aikataulu.php?id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '#cm"  style="font-size: 0.9em; ">Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th><th style="border-right: 1px solid grey; text-align: center; ">Ajankohta</th><th style="border-right: 1px solid grey; text-align: center; "><input type="submit" name="painiket" value="&#10003 Tallenna" class="myButton9"  role="button"  style="font-size: 1em;padding:4px 6px"><br><br>Aihe</th><th style="border-right: 1px solid grey; text-align: center">Lisätietoja</th><th><input type="hidden" name="ipid" value=' . $ipid . '> <input type="submit" name="painikel" value="+ Lisää rivi yläpuolelle" class="myButton8"  role="button"  ></th></tr></thead><tbody>';
            } else {

                echo '<tr style="border: 1px solid grey; background-color: #73b9cc"><th style="border-right: 1px solid grey; "></th><th style="border-right: 1px solid grey; text-align: center; ">Ajankohta</th><th style="border-right: 1px solid grey; text-align: center">Aihe</th><th style="border-right: 1px solid grey; text-align: center">Lisätietoja</th><th></th></tr></thead><tbody>';
            }

            $maara = 0;
            while ($rowt = $haeaikataulu->fetch_assoc()) {
                $maara = $maara + 1;
                $rowt[aika] = str_replace('<br />', "", $rowt[aika]);


                $paluu = $rowt[jarjestys];

                if (($paluu == ($onko - 1)) && ($rowt[aihe] == "") && ($rowt[aika] == "") && ($rowt[lisa] == "")) {

                    echo '<tr id=' . $paluu . ' ><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="height: 100%; display: table-cell"> <textarea name="aika[]"   style=" font-size: 0.9em" autofocus>' . $rowt[aika] . '</textarea></td><td style="height: 100%; display: table-cell"> <textarea name="aihe[]" class="content' . $maara . '"  style=" font-size: 0.9em">' . $rowt[aihe] . '</textarea></td><td style="height: 100%; display: table-cell"> <textarea name="lisa[]" class="contentl' . $maara . '"  style=" font-size: 0.9em">' . $rowt[lisa] . '</textarea></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                } else {
                    if (($_GET[monesko] == ($paluu - 1)) && ($rowt[aihe] == "") && ($rowt[aika] == "") && ($rowt[lisa] == "")) {
                        echo '<tr id=' . $paluu . ' ><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="height: 100%; display: table-cell"> <textarea name="aika[]"   style=" font-size: 0.9em" autofocus>' . $rowt[aika] . '</textarea></td><td style="height: 100%; display: table-cell"> <textarea name="aihe[]" class="content' . $maara . '"  style=" font-size: 0.9em">' . $rowt[aihe] . '</textarea></td><td style="height: 100%; display: table-cell"> <textarea name="lisa[]" class="contentl' . $maara . '"  style=" font-size: 0.9em">' . $rowt[lisa] . '</textarea></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                    } else {
                        echo '<tr id=' . $paluu . ' ><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' checked></td><td style="height: 100%; display: table-cell"> <textarea name="aika[]"   style=" font-size: 0.9em">' . $rowt[aika] . '</textarea></td><td style="height: 100%; display: table-cell"> <textarea name="aihe[]" class="content' . $maara . '"  style=" font-size: 0.9em">' . $rowt[aihe] . '</textarea></td><td style="height: 100%; display: table-cell"> <textarea name="lisa[]" class="contentl' . $maara . '"  style=" font-size: 0.9em">' . $rowt[lisa] . '</textarea></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                    }
                }


                echo'<input type="hidden" name="id[]" value=' . $rowt[id] . '>';
            }
        } else {


            if ($onko != 0) {
                echo '<tr style="border: 1px solid grey; background-color: #73b9cc;"><th style="border-right: 1px solid grey;"><button style="font-size: 1em" class="roskis" title="Poista" name="painikep"><i class="fa fa-trash-o" style="margin-right: 5px"></i>Poista</button><br><br><a href="muokkaa_aikataulu.php?kaikki=joo&id=' . $_GET[id] . '&monesko=' . $_GET[monesko] . '#cm"  style="font-size: 0.9em; ">Valitse kaikki<br>&nbsp&#9661&nbsp</a></th><th style="border-right: 1px solid grey; text-align: center; ">Ajankohta</th><th style="border-right: 1px solid grey; text-align: center; "><input type="submit" name="painiket" value="&#10003 Tallenna" class="myButton9"  role="button"  style="font-size: 1em;padding:4px 6px"><br><br>Aihe</th><th style="border-right: 1px solid grey; text-align: center">Lisätietoja</th><th><input type="hidden" name="ipid" value=' . $ipid . '> <input type="submit" name="painikel" value="+ Lisää rivi yläpuolelle" class="myButton8"  role="button"  ></th></tr></thead><tbody>';
            } else {

                echo '<tr style="border: 1px solid grey; background-color: #73b9cc"><th style="border-right: 1px solid grey; "></th><th style="border-right: 1px solid grey; text-align: center; ">Ajankohta</th><th style="border-right: 1px solid grey; text-align: center">Aihe</th><th style="border-right: 1px solid grey; text-align: center">Lisätietoja</th><th></th></tr><tbody>';
            }




            $maara = 0;
            while ($rowt = $haeaikataulu->fetch_assoc()) {

                $rowt[aika] = str_replace('<br />', "", $rowt[aika]);
                $paluu = $rowt[jarjestys];

                if (($paluu == ($onko - 1)) && ($rowt[aihe] == "") && ($rowt[aika] == "") && ($rowt[lisa] == "")) {
                    $maara = $maara + 1;
                    echo '<tr id=' . $paluu . ' ><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . ' ></td><td style="height: 100%; display: table-cell"> <textarea name="aika[]"  rows="2" style=" font-size: 0.9em" autofocus>' . $rowt[aika] . '</textarea></td><td style="height: 100%; display: table-cell"> <textarea name="aihe[]" class="content' . $maara . '"  style="font-size: 0.9em">' . $rowt[aihe] . '</textarea></td><td style="height: 100%; display: table-cell"> <textarea name="lisa[]" class="contentl' . $maara . '"  style=" font-size: 0.9em">' . $rowt[lisa] . '</textarea></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                } else {
                    if (($_GET[monesko] == ($paluu - 1)) && ($rowt[aihe] == "") && ($rowt[aika] == "") && ($rowt[lisa] == "")) {
                        $maara = $maara + 1;
                        echo '<tr id=' . $paluu . ' ><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td style="height: 100%; display: table-cell"> <textarea name="aika[]"  rows="2" style=" font-size: 0.9em" autofocus>' . $rowt[aika] . '</textarea></td><td style="height: 100%; display: table-cell"> <textarea name="aihe[]" class="content' . $maara . '"  style="font-size: 0.9em">' . $rowt[aihe] . '</textarea></td><td > <textarea name="lisa[]" class="contentl' . $maara . '"  style=" font-size: 0.9em">' . $rowt[lisa] . '</textarea></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                    } else {
                        $maara = $maara + 1;
                        echo '<tr id=' . $paluu . ' ><td><input type="checkbox" name="lista[]" value=' . $rowt[id] . '></td><td style="height: 100%; display: table-cell"> <textarea name="aika[]"  rows="2" style=" font-size: 0.9em">' . $rowt[aika] . '</textarea></td><td style="height: 100%; display: table-cell"> <textarea name="aihe[]" class="content' . $maara . '"  style="font-size: 0.9em">' . $rowt[aihe] . '</textarea></td><td style="height: 100%; display: table-cell"> <textarea name="lisa[]" class="contentl' . $maara . '"  style=" font-size: 0.9em">' . $rowt[lisa] . '</textarea></td><td style="text-align: center"><input type="radio" name="jarjestys" value="' . $rowt[jarjestys] . '"></td></tr>';
                    }
                }
                echo'<input type="hidden" name="id[]" value=' . $rowt[id] . '>';
            }
        }


        if ($onko != 0) {
            echo '<tr style="border-bottom: none"><td><button class="roskis" style="font-size: 1em" title="Poista" name="painikep"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td><td></td><td></td><td></td><td><input type="submit" name="painikel" value="+ Lisää rivi yläpuolelle" class="myButton8"  role="button"  ></td></tr>';
        } else {
            echo '<tr style="border-bottom: none"><td></td><td></td><td></td><td></td><td><input type="submit" name="painikel" value="+ Lisää rivi" class="myButton8"  role="button"  ></td></tr>';
        }

        echo "</tbody></table></div>";


        echo'<input type="hidden" name="monesko" value=' . $_GET[monesko] . '>';
        echo'<div style="text-align: center">';
        echo'<b style="margin-right: 40px; color:  #e608b8">Voit myös valita, kuinka monta riviä haluat lisätä loppuun </b> <input type="number" name="tehtmaara" style="color: #2b6777; width: 60px" min="0">';

        echo'<input type="submit" value="+ Lisää" class="myButton9" name="lisaa" role="button" style="margin-left: 10px; font-size: 0.8em; padding: 2px 4px">';
        echo'<input type="hidden" name="kurssi" value=' . $_SESSION[KurssiId] . '>';

        echo'<br><br><input type="submit" id="tannepas" name="painiket" value="&#10003 Tallenna" class="myButton9"  role="button"  style="font-size: 0.9em;padding:4px 6px">';

        echo'</div>';
        echo'</form>';
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



        echo' <div class="cm8-margin-top" id="cm"></div>';









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



                    $('.contentl' + i).richText({
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
