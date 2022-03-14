<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Omat kurssit/opintojaksot </title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />

';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
unset($_SESSION['KurssiId']);
if (isset($_SESSION["Kayttajatunnus"])) {

    ini_set('display_errors', '0');
    echo'
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
<meta charset="UTF-8">
<link rel="stylesheet" href="css/TimeCircles.css" />
<link href="https://fonts.googleapis.com/css?family=Playfair+Display+SC:400,700" rel="stylesheet" type="text/css"> <link href="//fonts.googleapis.com/css?family=Questrial" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Actor" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css"> <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Neucha" /><link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="csscm/jquery-ui.css" rel="stylesheet" />
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="css/trontastic.css" />
<link rel="stylesheet" type="text/css" href="jscm/jquery.timepicker.css" /><link rel="stylesheet" type="text/css" href="jscm/jquery.datepicker.css" />
<link rel="shortcut icon" href="favicon.png" type="image/png">
<link rel="stylesheet" href="css/TimeCircles.css" />
  

<link href="ulkoasu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/fontawesome-stars.css">

<script src="funktioita.js" language="javascript" type="text/javascript"></script>
<script src="basic-javascript-functions.js" language="javascript" type="text/javascript"></script>


<script src="js/jquery-2.1.3.js"></script>
<script src="js/tableHeadFixer.js"></script>
<script src="js/jquery.barrating.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>



</head>

  <body onload="lataa()">';

    echo'<div class="cm8-container" style="padding-top: 5px; padding-bottom: 5px;padding-left: 20px">';
    echo'<div class="cm8-quarter" style="padding: 0px; margin:0px">';
    echo'<h1 style="padding-bottom: 0px; display: inline-block;"><a href="etusivu.php">Cuulis</h1>
  <b style="font-size: 0.8em; display: inline-block">&nbsp - &nbspoppimisympäristö</b></a>';

    echo'</div>';



    //floatHead ei tartte tätä: <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    if (!$resultoma = $db->query("select * from kayttajan_arvostelu where kayttaja_id = '" . $_SESSION["Id"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></figure></a></p></footer>');
    }
    if ($resultoma->num_rows == 0) {
        echo'<input type="hidden" id="oma" value="0"></>';
    } else {
        while ($row = $resultoma->fetch_assoc()) {
            $oma = $row[arvo];
        }
        echo'<input type="hidden" id="oma" value=' . $oma . '></>';
    }






    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');

    $url2 = $_SERVER[REQUEST_URI];

    $url2 = substr($url2, 1);


    echo'<div class="cm8-half" style="padding-bottom: 0px;padding-top: 0px; padding-left: 0px; margin-left: 0px">';
    if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'opiskelija') {


        if ($_SESSION["Rooli"] == 'opiskelija' && $_SESSION["vaihto"] == 1) {


            echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';


            echo'<form action="vaihda.php" method="post" style="display: inline-block; margin-left: 40px"><input type="hidden" name="url" value="' . $url . '" ><input type="hidden" name="mihin" value="etu"><input type="hidden" name="'
            . '" value="pois"> <input type="submit" value="Poistu opiskelijanäkymästä" class="munNappula2"  role="button"></form>';
        } else {

            echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';
        }
    } else if ($_SESSION["Rooli"] == 'opeadmin' || $_SESSION["Rooli"] == 'admink') {
        echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a><a href="yhteydenotto.php" class="cm8-linkk3" title="Ota yhteyttä"> 📧 &nbsp Ota yhteyttä
</a><a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i>
</a></p>';
    } else {
        echo'<p style="padding-top: 10px; margin-top: 0px; margin-bottom: 0px"><a href="omattiedot.php" class="cm8-linkk3" title="Omat tiedot"><b style="font-size: 0.9em">&#9881;</b> &nbsp Omat tiedot </a>
  	
 <a href="ulos.php" class="cm8-linkk3" title="Kirjaudu ulos">Kirjaudu ulos &nbsp&nbsp <i class="fa fa-sign-out" style="font-size: 1.2em"></i></a></p>';
    }


    echo'</div>';
    echo'<div class="cm8-quarter" style="padding-top: 0px;padding-left: 0px; margin-left: 0px">';
    echo'<p style="display: inline-block; margin-right: 20px; padding-top: 10px; margin-top: 0px; margin-bottom: 0px" ><select id="example">
  <option style="display: inline-block" value="1">1</option>
  <option style="display: inline-block" value="2">2</option>
  <option style="display: inline-block" value="3">3</option>
  <option style="display: inline-block" value="4">4</option>
  <option style="display: inline-block" value="5">5</option>
</select></p>';


    echo'<div style="display: inline-block; font-size: 0.8em; padding: 0px; margin: 0px" id="keski" ></div>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
    echo'</div>';




    echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px;">';

    if ($_SESSION["Rooli"] == "opeadmin") {

        echo'<nav class="topnavOpe" id="myTopnav">';
        echo'<a href="etusivu.php"  >Etusivu</a>         
<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
    if (x.className === "topnavOpe") {
  
        x.className += " responsive";
        
       
    } else {
  
        x.className = "topnavOpe";
      
    }
     
}
</script>
<a href="omatkurssit.php" class="currentLink" >Omat kurssit/opintojaksot</a>
<a href="kurssitkaikki.php" >Kaikki kurssit/opintojaksot</a>
<a href="kayttajatvahvistus.php" >Käyttäjät &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="kurssit.php">Kurssit/Opintojaksot &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" >Oppilaitos &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)">  
    <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
    } else {

        echo'<nav class="topnavoppilas" id="myTopnav">';
        echo'         
	<a href="etusivu.php" >Etusivu</a>      
	<a href="omatkurssit.php" class="currentLink">Omat kurssit/opintojaksot</a>
	<a href="kurssit.php" >Kaikki kurssit/opintojaksot</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        echo'

<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
    if (x.className === "topnavoppilas") {

        x.className += " responsive";
    } else {
        x.className = "topnavoppilas";
    }
}
</script>';
    }


    echo'<div class="cm8-container3" style="padding-top: 0px; ">';



    $nyt = date("Y-m-d");

    if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == "opeadmin") {
        echo'<h4 style="display: inline-block; margin-right: 200px; font">Omat kurssit/opintojaksot/opintojaksot:</h4>';
        echo '<a href="uusikurssi.php" class="myButton9" " role="button"  >+  Lisää uusi kurssi/opintojakso</a>';



        $field = 'alkupvm';
        $sort = 'DESC';
        $field2 = 'koodi';

        $sort2 = 'ASC';

        $nuoli2 = '<div class="cm8-nuoliylos"> </div>';
        $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        if (isset($_GET['sorting0'])) {

            if ($_GET['sorting0'] == 'ASC') {
                $sort = 'DESC';
                $nuoli0 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli0 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        }
        if (isset($_GET['sorting1'])) {

            if ($_GET['sorting1'] == 'ASC') {
                $sort = 'DESC';
                $nuoli1 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli1 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        }
        if (isset($_GET['sorting2'])) {

            if ($_GET['sorting2'] == 'ASC') {
                $sort = 'DESC';
                $nuoli2 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli2 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        }
        if (isset($_GET['sorting3'])) {

            if ($_GET['sorting3'] == 'ASC') {
                $sort = 'DESC';
                $nuoli3 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli3 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        }
        if (isset($_GET['sorting4'])) {

            if ($_GET['sorting4'] == 'ASC') {
                $sort = 'DESC';
                $nuoli4 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli4 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        }


        if (isset($_GET['field'])) {
            if ($_GET['field'] == 'alkupvm') {
                $field = "alkupvm";
                $field2 = "koodi";
                $sort2 = "ASC";
            } elseif ($_GET['field'] == 'koodi') {
                $field = "koodi";
                $field2 = "alkupvm";
                $sort2 = "DESC";
            } elseif ($_GET['field'] == 'koulut.Nimi') {
                $field = "koulut.Nimi";
            } elseif ($_GET['field'] == 'luomispvm') {
                $field = "luomispvm";
            } elseif ($_GET['field'] == 'lukuvuosi') {
                $field = "lukuvuosi";
            } elseif ($_GET['field'] == 'kurssit.nimi') {
                $field = "kurssit.nimi";
            } elseif ($_GET['field'] == 'loppupvm') {
                $field = "loppupvm";
            }
        }



        if (!$result = $db->query("select distinct lukuvuosi, kurssit.opettaja_id as oid, alkupvm, loppupvm, kurssit.id as kid, kayttajat.id as kaid, koulut.id as koid, kurssit.nimi as nimi, luomispvm, koulut.Nimi as Nimi, koodi, etunimi, sukunimi from kurssit, koulut, kayttajat, kayttajankoulut, opiskelijankurssit WHERE alkupvm <= '" . $nyt . "' AND loppupvm >= '" . $nyt . "' AND ((opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id AND opiskelijankurssit.ope=1) OR (kurssit.opettaja_id='" . $_SESSION["Id"] . "')) AND (kayttajat.id='" . $_SESSION["Id"] . "' AND kayttajankoulut.odottaa=1 AND kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.kayttaja_id=kayttajat.id AND kurssit.koulu_id=koulut.id) ORDER BY $field $sort, $field2 $sort22")) {

            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$result2 = $db->query("select distinct lukuvuosi, kurssit.opettaja_id as oid, alkupvm, loppupvm, kurssit.id as kid, kayttajat.id as kaid, koulut.id as koid, kurssit.nimi as nimi, luomispvm, koulut.Nimi as Nimi, koodi, etunimi, sukunimi from kurssit, koulut, kayttajat, kayttajankoulut, opiskelijankurssit WHERE alkupvm < '" . $nyt . "' AND loppupvm < '" . $nyt . "' AND ((opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id AND opiskelijankurssit.ope=1) OR (kurssit.opettaja_id='" . $_SESSION["Id"] . "')) AND (kayttajat.id='" . $_SESSION["Id"] . "' AND kayttajankoulut.odottaa=1 AND kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.kayttaja_id=kayttajat.id AND kurssit.koulu_id=koulut.id) ORDER BY $field $sort, $field2 $sort22")) {

            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$result3 = $db->query("select distinct lukuvuosi, kurssit.opettaja_id as oid, alkupvm, loppupvm, kurssit.id as kid, kayttajat.id as kaid, koulut.id as koid, kurssit.nimi as nimi, luomispvm, koulut.Nimi as Nimi, koodi, etunimi, sukunimi from kurssit, koulut, kayttajat, kayttajankoulut, opiskelijankurssit WHERE alkupvm > '" . $nyt . "' AND ((opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id AND opiskelijankurssit.ope=1) OR (kurssit.opettaja_id='" . $_SESSION["Id"] . "')) AND (kayttajat.id='" . $_SESSION["Id"] . "' AND kayttajankoulut.odottaa=1 AND kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.kayttaja_id=kayttajat.id AND kurssit.koulu_id=koulut.id) ORDER BY $field $sort, $field2 $sort22")) {

            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!($result->num_rows == 0 && $result2->num_rows == 0 && $result3->num_rows == 0))
            echo'<p style="padding-top: 10px" id="ohje">Klikkaamalla kurssin/opintojakson nimeä tai koodia pääset kyseisen kurssin/opintojakson sivulle.</p>';
        else {
            echo"<br><br>Ei kursseja/opintojaksoja.<br>";
              echo'<div class="cm8-margin-top"><br></div>';
        }

        if (!($result->num_rows == 0 && $result2->num_rows == 0 && $result3->num_rows == 0)) {
            echo '<form action="omatkurssit.php" method="get">

			<br>&#128270 <input type="search"  onkeyup="showResult2(this.value)" name="search"  id="search_box" class="haku" style="width: 50%"> 
		
			</form>';

            echo'<div style="margin-top: 0px; margin-bottom: 0px" id="searchresults">
<ul id="results" class="update">
</ul></div>';
            echo'<div id="scrollbar"><div id="spacer"></div></div>';
        }


        if ($result->num_rows != 0) {
            echo'<div id="scrollbar"><div id="spacer"></div></div>';
            echo'<form action="varmistuskurssit.php" method="post" style=" padding-bottom: 0px; padding-top: 0px">';
            echo'<div class="cm8-responsive" id="piilota"  style="padding-bottom: 0px; width: 100%">';
            echo'<br><b style="font-size: 1.2em; color: #2b6777; font-weight: bold;">Käynnissä olevat kurssit/opintojaksot:</b><br><br>';
            echo '<table id="mytable88" class="cm8-uusitable12 cm8-striped"  style="overflow: hidden; table-layout:fixed; max-width: 100%;"><thead>';
            if ($_GET[kaikkiK] == 'joo') {
                $urlK = $_SERVER[REQUEST_URI];


                if (strpos($urlK, '&kaikkiK=joo')) {
                    $urlK = str_replace("&kaikkiK=joo", "", $urlK);
                } else if (strpos($urlK, '?kaikkiK=joo')) {
                    $urlK = str_replace("kaikkiK=joo", "", $urlK);
                }

                echo '<tr id="kayn"><th><a href="omatkurssit.php?kaikkiK=joo&sorting1=' . $sort . '&field=kurssit.nimi#kayn">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli1 . '</a></th><th><a href="omatkurssit.php?kaikkiK=joo&sorting2=' . $sort . '&field=koodi#kayn">Koodi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="omatkurssit.php?kaikkiK=joo&sorting3=' . $sort . '&field=lukuvuosi#kayn">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="omatkurssit.php?kaikkiK=joo&sorting0=' . $sort . '&field=alkupvm#kayn">Alkaa &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th><th><a href="omatkurssit.php?kaikkiK=joo&sorting4=' . $sort . '&field=loppupvm#kayn">Päättyy &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th style="text-align: left; padding-left: 5px"><a href="' . $urlK . '#kayn" > &#9661&nbsp&nbsp Tyhjennä valinnat</a></th><th>Kopioi kurssi/opintojakso</th></tr>';
                echo'</thead><tbody>';

                while ($row = $result->fetch_assoc()) {
                    if ($row[oid] == $_SESSION["Id"]) {
                        $oma = 1;
                    }
                    $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
                    $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));

                    if (!$resultope = $db->query("select distinct etunimi, sukunimi, id from kayttajat where kayttajat.id='" . $row[oid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($rowope = $resultope->fetch_assoc()) {


                        echo '<tr><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[nimi] . ' &nbsp&nbsp&nbsp</a></td><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $rowope[id] . '">' . $rowope[etunimi] . ' ' . $rowope[sukunimi] . '</a></td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td>';

                        echo'<td ><input type="checkbox" name="lista[]" value=' . $row[kid] . ' checked></td>';
                        
                            echo'<td style="padding-bottom: 0px"><a href="kopiointivarmistus.php?id=' . $row[kid] . '" class="myButton8"  role="button" >Kopioi</a></td>';
                      
                        echo'</tr>';
                    }
                }
            } else {

                $urlK = $_SERVER[REQUEST_URI];


                if (strpos($urlK, '?')) {

                    $urlK = $urlK . '&kaikkiK=joo';
                } else {

                    $urlK = $urlK . '?kaikkiK=joo';
                }

                echo '<tr id="kayn"><th><a href="omatkurssit.php?sorting1=' . $sort . '&field=kurssit.nimi#kayn">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli1 . '</a><th><a href="omatkurssit.php?sorting2=' . $sort . '&field=koodi#kayn">Koodi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="omatkurssit.php?sorting3=' . $sort . '&field=lukuvuosi#kayn">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="omatkurssit.php?sorting0=' . $sort . '&field=alkupvm#kayn">Alkaa &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th><th><a href="omatkurssit.php?sorting4=' . $sort . '&field=loppupvm#kayn">Päättyy &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th style="text-align: left; padding-left: 5px"><a href="' . $urlK . '#kayn" >&#9661&nbsp&nbsp Valitse kaikki</a></th><th>Kopioi kurssi/opintojakso</th></tr>';
                echo'</thead><tbody>';
                while ($row = $result->fetch_assoc()) {
                    if ($row[oid] == $_SESSION["Id"]) {
                        $oma = 1;
                    }
                    $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
                    $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));
                    if (!$resultope = $db->query("select distinct etunimi, sukunimi, id from kayttajat where kayttajat.id='" . $row[oid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($rowope = $resultope->fetch_assoc()) {

                        echo '<tr><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[nimi] . ' &nbsp&nbsp&nbsp</a></td><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $rowope[id] . '">' . $rowope[etunimi] . ' ' . $rowope[sukunimi] . '</a></td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td>';
                        echo'<td ><input type="checkbox" name="lista[]" value=' . $row[kid] . '></td>';
                        
                            echo'<td style="padding-bottom: 0px"><a href="kopiointivarmistus.php?id=' . $row[kid] . '" class="myButton8"  role="button" >Kopioi</a></td>';
                        
                        echo'</tr>';
                    }
                }
            }
            echo'<tr style=";"><td style="background-color: #e5e5e5"><td></td><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 15px"><button class="pieniroskis" title="Poista"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td></tr>';
            echo "</tbody></table>";
            echo'</form></div>';
        }
        if ($result3->num_rows != 0) {
            echo'<form action="varmistuskurssit.php" method="post"  style=" padding-bottom: 0px; padding-top: 0px">';
            echo'<div id="scrollbar8"><div id="spacer8"></div></div>';

            echo'<div class="cm8-responsive" id="piilota8"  style=" padding-bottom: 0px; padding-top: 10px; width: 100%; margin-top: 0px">';
            echo'<br><b style="font-size: 1.2em; color: #2b6777; font-weight: bold;">Alkamassa olevat kurssit/opintojaksot:</b><br><br>';

            echo '<table id="mytable3" class="cm8-uusitable12 cm8-striped"  style="overflow: hidden; table-layout:fixed; max-width: 100%;"><thead>';
            if ($_GET[kaikkiA] == 'joo') {



                $urlA = $_SERVER[REQUEST_URI];
                if (strpos($urlA, '&kaikkiA=joo')) {
                    $urlA = str_replace("&kaikkiA=joo", "", $urlA);
                } else if (strpos($urlA, '?kaikkiA=joo')) {
                    $urlA = str_replace("kaikkiA=joo", "", $urlA);
                }


                echo '<tr id="alk"><th><a href="omatkurssit.php?kaikkiA=joo&sorting1=' . $sort . '&field=kurssit.nimi#alk">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli1 . '</a></th><th><a href="omatkurssit.php?kaikkiA=joo&sorting2=' . $sort . '&field=koodi#alk">Koodi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="omatkurssit.php?kaikkiA=joo&sorting3=' . $sort . '&field=lukuvuosi#alk">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="omatkurssit.php?kaikkiA=joo&sorting0=' . $sort . '&field=alkupvm#alk">Alkaa &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th><th><a href="omatkurssit.php?kaikkiA=joo&sorting4=' . $sort . '&field=loppupvm#alk">Päättyy &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th style="text-align: left; padding-left: 5px"><a href="' . $urlA . '#alk" > &#9661&nbsp&nbsp Tyhjennä valinnat</a></th><th>Kopioi kurssi/opintojakso</th></tr>';
                echo'</thead><tbody>';

                while ($row = $result3->fetch_assoc()) {
                    if ($row[oid] == $_SESSION["Id"]) {
                        $oma = 1;
                    }
                    $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
                    $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));

                    if (!$resultope = $db->query("select distinct etunimi, sukunimi, id from kayttajat where kayttajat.id='" . $row[oid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($rowope = $resultope->fetch_assoc()) {


                        echo '<tr><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[nimi] . ' &nbsp&nbsp&nbsp</a></td><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $rowope[id] . '">' . $rowope[etunimi] . ' ' . $rowope[sukunimi] . '</a></td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td>';

                        echo'<td ><input type="checkbox" name="lista[]" value=' . $row[kid] . ' checked></td>';
                       
                            echo'<td style="padding-bottom: 0px"><a href="kopiointivarmistus.php?id=' . $row[kid] . '" class="myButton8"  role="button" >Kopioi</a></td>';
                      
                        echo'</tr>';
                    }
                }
            } else {




                $urlA = $_SERVER[REQUEST_URI];
                if (strpos($urlA, '?')) {

                    $urlA = $urlA . '&kaikkiA=joo';
                } else {

                    $urlA = $urlA . '?kaikkiA=joo';
                }






                echo '<tr id="alk"><th><a href="omatkurssit.php?sorting1=' . $sort . '&field=kurssit.nimi#alka">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli1 . '</a><th><a href="omatkurssit.php?sorting2=' . $sort . '&field=koodi#alk">Koodi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="omatkurssit.php?sorting3=' . $sort . '&field=lukuvuosi#alk">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="omatkurssit.php?sorting0=' . $sort . '&field=alkupvm#alk">Alkaa &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th><th><a href="omatkurssit.php?sorting4=' . $sort . '&field=loppupvm#alk">Päättyy &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th style="text-align: left; padding-left: 5px"><a href="' . $urlA . '#alk" style="padding-left: 5px; text-align: left">&#9661&nbsp&nbsp Valitse kaikki</a></th><th>Kopioi kurssi/opintojakso</th></tr>';
                echo'</thead><tbody>';
                while ($row = $result3->fetch_assoc()) {
                    if ($row[oid] == $_SESSION["Id"]) {
                        $oma = 1;
                    }
                    $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
                    $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));
                    if (!$resultope = $db->query("select distinct etunimi, sukunimi, id from kayttajat where kayttajat.id='" . $row[oid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($rowope = $resultope->fetch_assoc()) {

                        echo '<tr><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[nimi] . ' &nbsp&nbsp&nbsp</a></td><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $rowope[id] . '">' . $rowope[etunimi] . ' ' . $rowope[sukunimi] . '</a></td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td>';
                        echo'<td ><input type="checkbox" name="lista[]" value=' . $row[kid] . '></td>';
                        
                            echo'<td style="padding-bottom: 0px"><a href="kopiointivarmistus.php?id=' . $row[kid] . '" class="myButton8"  role="button" >Kopioi</a></td>';
                      
                        echo'</tr>';
                    }
                }
            }
            echo'<tr style="; background-color: #e5e5e5"><td style="background-color: #e5e5e5"><td></td><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 15px"><button class="pieniroskis" title="Poista"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td></tr>';
            echo "</tbody></table>";
            echo'</form></div>';
        }



        if ($result2->num_rows != 0) {



            echo'<form action="varmistuskurssit.php" method="post"  style=" padding-bottom: 0px; padding-top: 0px">';
            echo'<div class="cm8-responsive" id="piilota3"  style="padding-top: 20px; padding-bottom: 0px; width: 100%">';
            echo'<br><b style="font-size: 1.2em; color: #2b6777; font-weight: bold;">Päättyneet kurssit/opintojaksot:</b><br><br>';
            echo '<table id="mytable2" class="cm8-uusitable12 cm8-striped"  style="overflow: hidden; table-layout:fixed; max-width: 100%;"><thead>';
            if ($_GET[kaikkiP] == 'joo') {
                $urlP = $_SERVER[REQUEST_URI];

                if (strpos($urlP, '&kaikkiP=joo')) {
                    $urlP = str_replace("&kaikkiP=joo", "", $urlP);
                } else if (strpos($urlP, '?kaikkiP=joo')) {
                    $urlP = str_replace("kaikkiP=joo", "", $urlP);
                }
                echo '<tr id="paat"><th><a href="omatkurssit.php?kaikkiP=joo&sorting1=' . $sort . '&field=kurssit.nimi#paat">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli1 . '</a></th><th><a href="omatkurssit.php?kaikkiP=joo&sorting2=' . $sort . '&field=koodi#paat">Koodi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="omatkurssit.php?kaikkiP=joo&sorting3=' . $sort . '&field=lukuvuosi#paat">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="omatkurssit.php?kaikkiP=joo&sorting0=' . $sort . '&field=alkupvm#paat">Alkaa &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th><th><a href="omatkurssit.php?kaikkiP=joo&sorting4=' . $sort . '&field=loppupvm#paat">Päättyy &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th style="text-align: left; padding-left: 5px"><a href="' . $urlP . '#paat" > &#9661&nbsp&nbsp Tyhjennä valinnat</a></th><th>Kopioi kurssi/opintojakso</th></tr>';
                echo'</thead><tbody>';

                while ($row = $result2->fetch_assoc()) {
                    if ($row[oid] == $_SESSION["Id"]) {
                        $oma = 1;
                    }
                    $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
                    $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));

                    if (!$resultope = $db->query("select distinct etunimi, sukunimi, id from kayttajat where kayttajat.id='" . $row[oid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($rowope = $resultope->fetch_assoc()) {


                        echo '<tr><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[nimi] . ' &nbsp&nbsp&nbsp</a></td><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $rowope[id] . '">' . $rowope[etunimi] . ' ' . $rowope[sukunimi] . '</a></td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td>';

                        echo'<td ><input type="checkbox" name="lista[]" value=' . $row[kid] . ' checked></td>';
                       
                            echo'<td style="padding-bottom: 0px"><a href="kopiointivarmistus.php?id=' . $row[kid] . '" class="myButton8"  role="button" >Kopioi</a></td>';
                      
                        echo'</tr>';
                    }
                }
            } else {

                $urlP = $_SERVER[REQUEST_URI];



                if (strpos($urlP, '?')) {

                    $urlP = $urlP . '&kaikkiP=joo';
                } else {

                    $urlP = $urlP . '?kaikkiP=joo';
                }

                echo '<tr id="paat"><th><a href="omatkurssit.php?sorting1=' . $sort . '&field=kurssit.nimi#paat">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli1 . '</a><th><a href="omatkurssit.php?sorting2=' . $sort . '&field=koodi#paat">Koodi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="omatkurssit.php?sorting3=' . $sort . '&field=lukuvuosi#paat">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="omatkurssit.php?sorting0=' . $sort . '&field=alkupvm#paat">Alkaa &nbsp&nbsp' . $nuoli0 . '</a></th><th><a href="omatkurssit.php?sorting4=' . $sort . '&field=loppupvm#paat">Päättyy &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th style="text-align: left; padding-left: 5px"><a href="' . $urlP . '#paat" >&#9661&nbsp&nbsp Valitse kaikki</a></th><th>Kopioi kurssi/opintojakso</th></tr>';
                echo'</thead><tbody>';
                while ($row = $result2->fetch_assoc()) {
                    if ($row[oid] == $_SESSION["Id"]) {
                        $oma = 1;
                    }
                    $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
                    $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));
                    if (!$resultope = $db->query("select distinct etunimi, sukunimi, id from kayttajat where kayttajat.id='" . $row[oid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($rowope = $resultope->fetch_assoc()) {

                        echo '<tr><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[nimi] . ' &nbsp&nbsp&nbsp</a></td><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $rowope[id] . '">' . $rowope[etunimi] . ' ' . $rowope[sukunimi] . '</a></td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td>';
                        echo'<td ><input type="checkbox" name="lista[]" value=' . $row[kid] . '></td>';
                        
                            echo'<td style="padding-bottom: 0px"><a href="kopiointivarmistus.php?id=' . $row[kid] . '" class="myButton8"  role="button" >Kopioi</a></td>';
                      
                        echo'</tr>';
                    }
                }
            }
            echo'<tr style="; background-color: #e5e5e5"><td style="background-color: #e5e5e5"><td></td><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 15px"><button class="pieniroskis" title="Poista"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td></tr>';
            echo "</tbody></table>";
            echo'</form></div>';
            echo'<div class="cm8-margin-top"></div>';
        }
    } else if ($_SESSION["Rooli"] == 'opiskelija') {

        echo'<div class="cm8-half" style="padding: 0px; margin: 0px">';
        echo'<h4>Omat kurssit/opintojaksot/opintojaksot:</h4>';
        echo'</div>';
        
         if (!$result = $db->query("select distinct kurssit.id as kuid from ia, itsearvioinnit, kurssit, koulut, opiskelijankurssit, kayttajat WHERE opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id AND kurssit.koulu_id=koulut.id AND kurssit.opettaja_id=kayttajat.id AND (ia.kurssi_id=kurssit.id OR itsearvioinnit.kurssi_id=kurssit.id)")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
  echo'<div class="cm8-half" style="text-align: center; "><br>';
    if ($result->num_rows != 0){
       
        echo'<h4><a href="omatiat.php" class="ia">Omat itsearviointilomakkeet</a></h4>';
       
    }
    else{
        echo'<h4></h4>';
    }
        
        echo'</div>';
        echo'<div class="cm8-margin-top"><br></div>';
        $field = 'alkupvm';
        $sort = 'DESC';
        $field2 = 'koodi';

        $sort2 = 'ASC';

        $nuoli2 = '<div class="cm8-nuoliylos"> </div>';
        $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';

        if (isset($_GET['sorting0'])) {

            if ($_GET['sorting0'] == 'ASC') {
                $sort = 'DESC';
                $nuoli0 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli0 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        }
        if (isset($_GET['sorting1'])) {

            if ($_GET['sorting1'] == 'ASC') {
                $sort = 'DESC';
                $nuoli1 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli1 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        }
        if (isset($_GET['sorting2'])) {

            if ($_GET['sorting2'] == 'ASC') {
                $sort = 'DESC';
                $nuoli2 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli2 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        }
        if (isset($_GET['sorting3'])) {

            if ($_GET['sorting3'] == 'ASC') {
                $sort = 'DESC';
                $nuoli3 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli3 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        }
        if (isset($_GET['sorting4'])) {

            if ($_GET['sorting4'] == 'ASC') {
                $sort = 'DESC';
                $nuoli4 = '<div class="cm8-nuolialas"> </div>';
            } else {
                $sort = 'ASC';
                $nuoli4 = '<div class="cm8-nuoliylos"> </div>';
            }
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
        }
        if (isset($_GET['field'])) {
            if ($_GET['field'] == 'kurssit.nimi') {
                $field = "kurssit.nimi";
            } elseif ($_GET['field'] == 'koodi') {
                $field = "koodi";
                $field2 = "alkupvm";
                $sort2 = "DESC";
            } elseif ($_GET['field'] == 'koulut.Nimi') {
                $field = "koulut.Nimi";
            } elseif ($_GET['field'] == 'lukuvuosi') {
                $field = "lukuvuosi";
            } elseif ($_GET['field'] == 'alkupvm') {
                $field = "alkupvm";
                $field2 = "koodi";
                $sort2 = "ASC";
            } elseif ($_GET['field'] == 'loppupvm') {
                $field = "loppupvm";
            }
        }



        if ($_SESSION[vaihto] == 1) {
            if (!$result = $db->query("select distinct lukuvuosi, kurssit.opettaja_id as oid, alkupvm, loppupvm, kurssit.id as kid, kayttajat.id as kaid, koulut.id as koid, kurssit.nimi as nimi, luomispvm, koulut.Nimi as Nimi, koodi, etunimi, sukunimi from kurssit, koulut, kayttajat, kayttajankoulut, opiskelijankurssit WHERE alkupvm <= '" . $nyt . "' AND loppupvm >= '" . $nyt . "' AND ((opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id AND opiskelijankurssit.ope=1) OR (kurssit.opettaja_id='" . $_SESSION["Id"] . "')) AND (kayttajat.id='" . $_SESSION["Id"] . "' AND kayttajankoulut.odottaa=1 AND kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.kayttaja_id=kayttajat.id AND kurssit.koulu_id=koulut.id) ORDER BY $field $sort, $field2 $sort2")) {

                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if (!$result2 = $db->query("select distinct lukuvuosi, kurssit.opettaja_id as oid, alkupvm, loppupvm, kurssit.id as kid, kayttajat.id as kaid, koulut.id as koid, kurssit.nimi as nimi, luomispvm, koulut.Nimi as Nimi, koodi, etunimi, sukunimi from kurssit, koulut, kayttajat, kayttajankoulut, opiskelijankurssit WHERE alkupvm < '" . $nyt . "' AND loppupvm < '" . $nyt . "' AND ((opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id AND opiskelijankurssit.ope=1) OR (kurssit.opettaja_id='" . $_SESSION["Id"] . "')) AND (kayttajat.id='" . $_SESSION["Id"] . "' AND kayttajankoulut.odottaa=1 AND kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.kayttaja_id=kayttajat.id AND kurssit.koulu_id=koulut.id) ORDER BY $field $sort, $field2 $sort2")) {

                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if (!$result3 = $db->query("select distinct lukuvuosi, kurssit.opettaja_id as oid, alkupvm, loppupvm, kurssit.id as kid, kayttajat.id as kaid, koulut.id as koid, kurssit.nimi as nimi, luomispvm, koulut.Nimi as Nimi, koodi, etunimi, sukunimi from kurssit, koulut, kayttajat, kayttajankoulut, opiskelijankurssit WHERE alkupvm > '" . $nyt . "' AND ((opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id AND opiskelijankurssit.ope=1) OR (kurssit.opettaja_id='" . $_SESSION["Id"] . "')) AND (kayttajat.id='" . $_SESSION["Id"] . "' AND kayttajankoulut.odottaa=1 AND kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.kayttaja_id=kayttajat.id AND kurssit.koulu_id=koulut.id) ORDER BY $field $sort, $field2 $sort2")) {

                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
        } else {
            if (!$result = $db->query("select distinct alkupvm, loppupvm, lukuvuosi, etunimi, sukunimi, luomispvm, kurssit.nimi as nimi, koodi, koulut.Nimi as Nimi, kayttajat.id as kaid, koulut.id as koid, kurssit.id as kid from kurssit, koulut, opiskelijankurssit, kayttajat WHERE alkupvm <= '" . $nyt . "' AND loppupvm >= '" . $nyt . "' AND opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id AND kurssit.koulu_id=koulut.id AND kurssit.opettaja_id=kayttajat.id ORDER BY $field $sort, $field2 $sort2")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if (!$result2 = $db->query("select distinct alkupvm, loppupvm, lukuvuosi, etunimi, sukunimi, luomispvm, kurssit.nimi as nimi, koodi, koulut.Nimi as Nimi, kayttajat.id as kaid, koulut.id as koid, kurssit.id as kid from kurssit, koulut, opiskelijankurssit, kayttajat WHERE alkupvm < '" . $nyt . "' AND loppupvm < '" . $nyt . "' AND opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id AND kurssit.koulu_id=koulut.id AND kurssit.opettaja_id=kayttajat.id ORDER BY $field $sort, $field2 $sort2")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if (!$result3 = $db->query("select distinct alkupvm, loppupvm, lukuvuosi, etunimi, sukunimi, luomispvm, kurssit.nimi as nimi, koodi, koulut.Nimi as Nimi, kayttajat.id as kaid, koulut.id as koid, kurssit.id as kid from kurssit, koulut, opiskelijankurssit, kayttajat WHERE alkupvm > '" . $nyt . "' AND opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id AND kurssit.koulu_id=koulut.id AND kurssit.opettaja_id=kayttajat.id ORDER BY $field $sort, $field2 $sort2")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
        }


        if (!($result->num_rows == 0 && $result2->num_rows == 0 && $result3->num_rows == 0))
            echo'<p style="padding-top: 10px" id="ohje">Klikkaamalla kurssin/opintojakson nimeä tai koodia pääset kyseisen kurssin/opintojakson sivulle.</p>';
        else {
            echo"<br><br>Ei kursseja/opintojaksoja.<br>";
             echo'<div class="cm8-margin-top"><br></div>';
        }

        if (!($result->num_rows == 0 && $result2->num_rows == 0 && $result3->num_rows == 0)) {


            echo '<form action="omatkurssit.php" method="get">

			<br>&#128270 <input type="search"  onkeyup="showResult2(this.value)" name="search"  id="search_box" class="haku" style="width: 50%"> 
		
			</form>';
            echo'<div style="margin-top: 0px; margin-bottom: 0px" id="searchresults">
<ul id="results" class="update">
</ul></div>';
            echo'<div id="scrollbar"><div id="spacer"></div></div>';
        }

        if ($result->num_rows != 0) {
            echo'<form action="varmistuskurssit3.php" method="post"  style=" padding-bottom: 0px; padding-top: 0px">';

            echo'<div class="cm8-responsive" id="piilota"  style="padding-bottom: 0px; width: 100%">';
            echo'<b style="font-size: 1.2em; color: #2b6777; font-weight: bold;">Käynnissä olevat kurssit/opintojaksot:</b><br><br>';
            echo '<table id="mytable88" class="cm8-uusitable12 cm8-striped"  style="table-layout:fixed; max-width: 100%;"><thead>';
            if ($_GET[kaikkiK] == 'joo') {


                $urlK = $_SERVER[REQUEST_URI];

                if (strpos($urlK, '&kaikkiK=joo')) {
                    $urlK = str_replace("&kaikkiK=joo", "", $urlK);
                } else if (strpos($urlK, '?kaikkiK=joo')) {
                    $urlK = str_replace("kaikkiK=joo", "", $urlK);
                }





                echo '<tr id="kayn"><th><a href="omatkurssit.php?kaikkiK=joo&sorting1=' . $sort . '&field=kurssit.nimi#kayn">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli1 . '</a></th><th><a href="omatkurssit.php?kaikkiK=joo&sorting2=' . $sort . '&field=koodi#kayn">Koodi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="omatkurssit.php?kaikkiK=joo&sorting3=' . $sort . '&field=lukuvuosi#kayn">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="omatkurssit.php?kaikkiK=joo&sorting0=' . $sort . '&field=alkupvm#kayn">Alkaa &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th><th><a href="omatkurssit.php?kaikkiK=joo&sorting4=' . $sort . '&field=loppupvm#kayn">Päättyy &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th style="text-align: left; padding-left: 5px"><a href="' . $urlK . '#kayn" >&#9661&nbsp&nbsp Tyhjennä valinnat</a></th></tr>';
                echo'</thead><tbody>';

                while ($row = $result->fetch_assoc()) {
                    $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
                    $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));
                    echo '<tr><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[nimi] . ' &nbsp&nbsp&nbsp</a></td><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[etunimi] . ' ' . $row[sukunimi] . '</a></td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $row[kid] . ' checked></td></tr>';
                }
            } else {


                $urlK = $_SERVER[REQUEST_URI];



                if (strpos($urlK, '?')) {

                    $urlK = $urlK . '&kaikkiK=joo';
                } else {

                    $urlK = $urlK . '?kaikkiK=joo';
                }





                echo '<tr id="kayn"><th><a href="omatkurssit.php?sorting1=' . $sort . '&field=kurssit.nimi#kayn">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli1 . '</a></th><th><a href="omatkurssit.php?sorting2=' . $sort . '&field=koodi#kayn">Koodi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="omatkurssit.php?sorting3=' . $sort . '&field=lukuvuosi#kayn">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="omatkurssit.php?sorting0=' . $sort . '&field=alkupvm#kayn">Alkaa &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th><th><a href="omatkurssit.php?sorting4=' . $sort . '&field=loppupvm#kayn">Päättyy &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th style="text-align: left; padding-left: 5px"><a href="' . $urlK . '#kayn" style="padding-left: 5px; text-align: left">&#9661&nbsp&nbsp Valitse kaikki</a></th></tr>';
                echo'</thead><tbody>';
                while ($row = $result->fetch_assoc()) {
                    $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
                    $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));
                    echo '<tr><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[nimi] . ' &nbsp&nbsp&nbsp</a></td><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[etunimi] . ' ' . $row[sukunimi] . '</a></td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $row[kid] . ' ></td></tr>';
                }
            }
            echo'<tr style="; background-color: #e5e5e5"><td style="background-color: #e5e5e5"><td></td><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 15px; "><button class="pieniroskis" title="Poistu"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poistu</button></td></tr>';


            echo "</tbody></table>";
            echo'</form></div>';
        }

        if ($result3->num_rows != 0) {
            echo'<form action="varmistuskurssit3.php" method="post"  style=" padding-bottom: 0px; padding-top: 0px">';

            echo'<div class="cm8-responsive" id="piilota8"  style="padding-top: 10px; padding-bottom: 0px; width: 100%">';
            echo'<br><b style="font-size: 1.2em; color: #2b6777; font-weight: bold;">Alkamassa olevat kurssit/opintojaksot:</b><br><br>';
            echo '<table id="mytable3" class="cm8-uusitable12 cm8-striped"  style="overflow: hidden; table-layout:fixed; max-width: 100%;"><thead>';
            if ($_GET[kaikkiA] == 'joo') {




                $urlA = $_SERVER[REQUEST_URI];
                if (strpos($urlA, '&kaikkiA=joo')) {
                    $urlA = str_replace("&kaikkiA=joo", "", $urlA);
                } else if (strpos($urlA, '?kaikkiA=joo')) {
                    $urlA = str_replace("kaikkiA=joo", "", $urlA);
                }


                echo '<tr id="alk"><th><a href="omatkurssit.php?kaikkiA=joo&sorting1=' . $sort . '&field=kurssit.nimi#alk">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli1 . '</a></th><th><a href="omatkurssit.php?kaikkiA=joo&sorting2=' . $sort . '&field=koodi#alk">Koodi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="omatkurssit.php?kaikkiA=joo&sorting3=' . $sort . '&field=lukuvuosi#alk">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="omatkurssit.php?kaikkiA=joo&sorting0=' . $sort . '&field=alkupvm#alk">Alkaa &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th><th><a href="omatkurssit.php?kaikkiA=joo&sorting4=' . $sort . '&field=loppupvm#alk">Päättyy &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th style="text-align: left; padding-left: 5px"><a href="' . $urlA . '#alk" > &#9661&nbsp&nbsp Tyhjennä valinnat</a></th></tr>';
                echo'</thead><tbody>';

                while ($row = $result3->fetch_assoc()) {
                    $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
                    $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));
                    echo '<tr><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[nimi] . ' &nbsp&nbsp&nbsp</a></td><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[etunimi] . ' ' . $row[sukunimi] . '</a></td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $row[kid] . ' checked></td></tr>';
                }
            } else {




                $urlA = $_SERVER[REQUEST_URI];



                if (strpos($urlA, '?')) {

                    $urlA = $urlA . '&kaikkiA=joo';
                } else {

                    $urlA = $urlA . '?kaikkiA=joo';
                }




                echo '<tr id="alk"><th><a href="omatkurssit.php?sorting1=' . $sort . '&field=kurssit.nimi#alk">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli1 . '</a></th><th><a href="omatkurssit.php?sorting2=' . $sort . '&field=koodi#alk">Koodi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="omatkurssit.php?sorting3=' . $sort . '&field=lukuvuosi#alk">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="omatkurssit.php?sorting0=' . $sort . '&field=alkupvm#alk">Alkaa &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th><th><a href="omatkurssit.php?sorting4=' . $sort . '&field=loppupvm#alk">Päättyy &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th style="padding-left: 5px; text-align: left"><a href="' . $urlA . '#alk" style="padding-left: 5px; text-align: left" >&#9661&nbsp&nbsp Valitse kaikki</a></th></tr>';
                echo'</thead><tbody>';
                while ($row = $result3->fetch_assoc()) {
                    $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
                    $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));
                    echo '<tr><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[nimi] . ' &nbsp&nbsp&nbsp</a></td><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[etunimi] . ' ' . $row[sukunimi] . '</a></td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $row[kid] . ' ></td></tr>';
                }
            }
            echo'<tr style="; background-color: #e5e5e5"><td style="background-color: #e5e5e5"><td></td><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 15px; "><button class="pieniroskis" title="Poistu"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poistu</button></td></tr>';
            echo "</tbody></table>";
            echo'</form></div>';
        }

        if ($result2->num_rows != 0) {
            echo'<form action="varmistuskurssit3.php" method="post"  style=" padding-bottom: 0px; padding-top: 0px">';
            echo'<div class="cm8-responsive" id="piilota3"  style="padding-top: 20px; padding-bottom: 0px; width: 100%">';
            echo'<br><b style="font-size: 1.2em; color: #2b6777; font-weight: bold;">Päättyneet kurssit/opintojaksot:</b><br><br>';
            echo '<table id="mytable2" class="cm8-uusitable12 cm8-striped"  style="overflow: hidden; table-layout:fixed; max-width: 100%;"><thead>';
            if ($_GET[kaikkiP] == 'joo') {


                $urlP = $_SERVER[REQUEST_URI];

                if (strpos($urlP, '&kaikkiP=joo')) {
                    $urlP = str_replace("&kaikkiP=joo", "", $urlP);
                } else if (strpos($urlP, '?kaikkiP=joo')) {
                    $urlP = str_replace("kaikkiP=joo", "", $urlP);
                }


                echo '<tr id="paat"><th><a href="omatkurssit.php?kaikkiP=joo&sorting1=' . $sort . '&field=kurssit.nimi#paat">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli1 . '</a></th><th><a href="omatkurssit.php?kaikkiP=joo&sorting2=' . $sort . '&field=koodi#paat">Koodi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="omatkurssit.php?kaikkiP=joo&sorting3=' . $sort . '&field=lukuvuosi#paat">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="omatkurssit.php?kaikkiP=joo&sorting0=' . $sort . '&field=alkupvm#paat">Alkaa &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th><th><a href="omatkurssit.php?kaikkiP=joo&sorting4=' . $sort . '&field=loppupvm#paat">Päättyy &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th style="text-align: left; padding-left: 5px"><a href="' . $urlP . '#paat" > &#9661&nbsp&nbsp Tyhjennä valinnat</a></th></tr>';
                echo'</thead><tbody>';

                while ($row = $result2->fetch_assoc()) {
                    $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
                    $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));
                    echo '<tr><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[nimi] . ' &nbsp&nbsp&nbsp</a></td><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[etunimi] . ' ' . $row[sukunimi] . '</a></td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $row[kid] . ' checked></td></tr>';
                }
            } else {





                $urlP = $_SERVER[REQUEST_URI];



                if (strpos($urlP, '?')) {

                    $urlP = $urlP . '&kaikkiP=joo';
                } else {

                    $urlP = $urlP . '?kaikkiP=joo';
                }

                echo '<tr id="paat"><th><a href="omatkurssit.php?sorting1=' . $sort . '&field=kurssit.nimi#paat">Kurssi/Opintojakso &nbsp&nbsp&nbsp' . $nuoli1 . '</a></th><th><a href="omatkurssit.php?sorting2=' . $sort . '&field=koodi#paat">Koodi &nbsp&nbsp&nbsp' . $nuoli2 . '</a></th><th>Vastuuopettaja</th><th>Oppilaitos</th><th><a href="omatkurssit.php?sorting3=' . $sort . '&field=lukuvuosi#paat">Lukuvuosi &nbsp&nbsp&nbsp' . $nuoli3 . '</a></th><th><a href="omatkurssit.php?sorting0=' . $sort . '&field=alkupvm#paat">Alkaa &nbsp&nbsp&nbsp' . $nuoli0 . '</a></th><th><a href="omatkurssit.php?sorting4=' . $sort . '&field=loppupvm#paat">Päättyy &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th style="text-align: left; padding-left: 5px"><a href="' . $urlP . '#paat" style="padding-left: 5px; text-align: left">&#9661&nbsp&nbsp Valitse kaikki</a></th></tr>';
                echo'</thead><tbody>';
                while ($row = $result2->fetch_assoc()) {
                    $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
                    $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));
                    echo '<tr><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[nimi] . ' &nbsp&nbsp&nbsp</a></td><td><a href="kurssivali.php?id=' . $row[kid] . '">' . $row[koodi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row[kaid] . '">' . $row[etunimi] . ' ' . $row[sukunimi] . '</a></td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td><td style="padding-left: 10px"><input type="checkbox" name="lista[]" value=' . $row[kid] . ' ></td></tr>';
                }
            }
            echo'<tr style="; background-color: #e5e5e5"><td style="background-color: #e5e5e5"></td><td></td><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 15px; "><button class="pieniroskis" title="Poistu"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poistu</button></td></tr>';
            echo "</tbody></table>";
            echo'</form></div>';
        }





        echo'</div>';
    }

    echo' </div></div>';

    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>
<script type="text/javascript">
    $(function () {

        var value = document.getElementById('oma').value;
        $('#example').barrating({
            theme: 'fontawesome-stars',
            deselectable: true,
            initialRating: document.getElementById('oma').value,
            allowEmpty: true,
            onSelect: function (value, text, event) {

                // rating was selected by a user
                var arvo = text;

                $.ajax({
                    type: 'post',
                    url: 'kirjaa.php',
                    data: {arvo: arvo},
                    dataType: 'json',
                    success: function (data) {


                    }
                });
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById('keski').innerHTML = xmlhttp.responseText;
                    }
                }

                xmlhttp.open('GET', 'haekeski.php', true);
                xmlhttp.send();

            }

        });

        $('#example').barrating('set', value);

    });

</script>
<script>
    //ilman tätä mikään muu ei toimi kuin scrolli
    var j = jQuery.noConflict();
    $("#mytable88").tableHeadFixer({"head": false, "left": 1});
    $("#mytable2").tableHeadFixer({"head": false, "left": 1});
    $("#mytable3").tableHeadFixer({"head": false, "left": 1});
</script> 
<script>

    var j = jQuery.noConflict();



    var $table2 = j('#mytable2');
    $table2.floatThead({zIndex: 1});
    var $table3 = j('#mytable3');
    $table3.floatThead({zIndex: 1});
    var $table88 = j('#mytable88');
    $table88.floatThead({zIndex: 1});
</script> 

<script>


    $("#scrollbar").on("scroll", function () {

        var container3 = $("#piilota3");
        var container = $("#piilota");
        var container8 = $("#piilota8");
        var scrollbar = $("#scrollbar");

        ScrollUpdate(container, scrollbar);
        ScrollUpdate(container3, scrollbar);
        ScrollUpdate(container8, scrollbar);
    });


    function ScrollUpdate(content, scrollbar) {

        $("#spacer").css({"width": "1000px"}); // set the spacer width'
        // set the spacer width
        scrollbar.width = content.width() + "px";
        content.scrollLeft(scrollbar.scrollLeft());
    }

    ScrollUpdate($("#piilota3"), $("#scrollbar"));
    ScrollUpdate($("#piilota"), $("#scrollbar"));
    ScrollUpdate($("#piilota8"), $("#scrollbar"));
</script>


</body>
</html>	




