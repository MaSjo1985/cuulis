<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Käyttäjät </title>
<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

<link rel="stylesheet" href="css/fontawesome-stars.css">
<link rel="stylesheet" href="css/fontawesome-stars-o.css">

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

        echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px">';
        if ($_SESSION["Rooli"] == "admin") {
            echo'<nav class="topnavoppilas" id="myTopnav">';
            echo'<a href="etusivu.php" >Etusivu</a>          
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
</script>     
<a href="oppilaitokset.php" >Oppilaitokset</a>
<a href="kayttajatvahvistus.php" class="currentLink">Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="kaikkitiedostot.php style="margin-bottom: 5px" >Palvelimella olevat tiedostot</a><a href="arvostelut.php">Arvostelut</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        } else if ($_SESSION["Rooli"] == "admink") {
            echo'<nav class="topnavoppilas" id="myTopnav">';
            echo'  <a href="etusivu.php" >Etusivu</a>        
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
</script>   
<a href="kayttajatvahvistus.php" class="currentLink">Käyttäjät</a>
<a href="kurssit.php" >Kurssit/Opintojaksot</a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" >Oma oppilaitos</a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        } else if ($_SESSION["Rooli"] == "opeadmin") {
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
<a href="omatkurssit.php" >Omat kurssit/opintojaksot</a>
<a href="kurssitkaikki.php" >Kaikki kurssit/opintojaksot</a>
<a href="kayttajatvahvistus.php" class="currentLink">Käyttäjät &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="kurssit.php">Kurssit/Opintojaksot &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a>
<a href="muokkaakoulu.php?id=' . $_SESSION["kouluId"] . '" >Oppilaitos &nbsp<em style="font-size: 0.6em">(ylläpito)</em></a><a href="javascript:void(0);" class="icon" onclick="myFunction(this)">  
    <div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
</nav>';
        }


        echo'<nav id="myTopnav2" class="topnav2">
 <a href="kayttajatvahvistus.php" >Vahvistusta odottavat</a> 
  <a href="kayttajatkaikki.php"  class="currentLink3">Kaikki käyttäjät</a> 
  <a href="kayttajatopettajat.php" >Opettajat</a>
  <a href="kayttajatopiskelijat.php">Opiskelijat</a> 
  
 <a href="lisaakayttajaeka.php">+ Lisää uusi käyttäjä</a><a href="javascript:void(0);" class="icon" onclick="myFunction2(y)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>';
        echo'

<script>
function myFunction2(y) {
 y.classList.toggle("change");
    var x = document.getElementById("myTopnav2");
    if (x.className === "topnav2") {
        x.className += " responsive";
    } else {
        x.className = "topnav2";
    }
}
</script>';
//   if($_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin" )
//    {
//        echo' <a href="kayttajateivahvistetut.php">Vahvistamattomat käyttäjät</a>';
//    }

        echo'</nav>';

        echo'<div class="cm8-container3" style="padding-top: 0px">';

        if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$results_per_page = 100;
$start_from = ($page-1) * $results_per_page;
        
        
        
        if ($_SESSION["Rooli"] == 'admin') {

            echo '<h3>Kaikki käyttäjät:</h3>';
            echo'<p id="ohje">Klikkaamalla käyttäjän suku- tai etunimeä pääset tarkastelemaan käyttäjän profiilia ja muokkaamaan tietoja.</p>';

            $field10 = 'sukunimi';
            $sort = 'ASC';
            $nuoli0 = '<div class="cm8-nuoliylos"></div>';
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';

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
                $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
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
                $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
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
                $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
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
                $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
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
                $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }
            if (isset($_GET['sorting5'])) {

                if ($_GET['sorting5'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli5 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli5 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }

            if ($_GET['field10'] == 'sukunimi') {
                $field10 = "sukunimi";
            } elseif ($_GET['field10'] == 'etunimi') {
                $field10 = "etunimi";
            } elseif ($_GET['field10'] == 'rooli') {
                $field10 = "rooli";
            } elseif ($_GET['field10'] == 'sposti') {
                $field10 = "sposti";
            } elseif ($_GET['field10'] == 'Nimi') {
                $field10 = "Nimi";
            } elseif ($_GET['field10'] == 'kirjautunut') {
                $field10 = "paiva";
                $field11 = "kello";
            }
            if ($_GET['field10'] == 'kirjautunut') {

                if (!$result10 = $db->query("select distinct paiva, kello, kayttajat.id as kaid, etunimi, sukunimi, rooli, sposti, Nimi from kayttajat, kayttajankoulut, koulut where kayttajankoulut.odottaa=1 AND  kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id AND kayttajat.tarkistettu=1 ORDER BY paiva $sort, kello LIMIT $start_from, $results_per_page")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
            } else {
                if (!$result10 = $db->query("select distinct kayttajat.paiva as paiva, kayttajat.kello as kello, kayttajat.id as kaid, etunimi, sukunimi, rooli, sposti, Nimi from kayttajat, kayttajankoulut, koulut where kayttajankoulut.odottaa=1 AND  kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id AND kayttajat.tarkistettu=1 ORDER BY $field10 $sort LIMIT $start_from, $results_per_page")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
            }

            if ($result10->num_rows == 0)
                echo"<br><br>Ei käyttäjiä.<br>";
            else {
                echo '<form action="kayttajatkaikki.php" method="get">

<br>&#128270 <input type="search"  onkeyup="showResult4(this.value)" name="search"  id="search_box" class="haku" style="width: 50%"> 
		
			</form>';
                echo'';

                echo'<div style="margin-top: 0px; margin-bottom: 0px" id="searchresults">
<ul id="results" class="update">
</ul></div>';
                echo'<div id="scrollbar"><div id="spacer"></div></div>';
                echo'<form action="varmistuskayttajat10.php" method="post">';
                echo'<div class="cm8-responsive" id="piilota"  style="padding-top: 20px; padding-bottom: 0px; width: 100%">';
                if ($_GET[kaikki12] == 'joo') {



                    echo '<table id="mytable" class="cm8-striped cm8-uusitablekayttajat" style="table-layout:fixed; max-width: 100%; ">  <thead>';
                    echo '<tr><th><a href="kayttajatkaikki.php?sorting0=' . $sort . '&kaikki12=joo&field10=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli0 . ' </a></th><th><a href="kayttajatkaikki.php?sorting1=' . $sort . '&kaikki12=joo&field10=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="kayttajatkaikki.php?sorting2=' . $sort . '&kaikki12=joo&field10=rooli">Rooli &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th><a href="kayttajatkaikki.php?sorting3=' . $sort . '&kaikki12=joo&field10=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli3 . ' </a></th><th><a href="kayttajatkaikki.php?sorting4=' . $sort . '&kaikki12=joo&field10=Nimi">Oppilaitos &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th><a href="kayttajatkaikki.php?sorting5=' . $sort . '&kaikki12=joo&field10=kirjautunut">Kirjautunut viimeksi &nbsp&nbsp&nbsp' . $nuoli5 . ' </a></th><th><a href="kayttajatkaikki.php?kaikki12=ei" > Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th></tr></thead><tbody>';

                    while ($row10 = $result10->fetch_assoc()) {

                        if ($row10[paiva] != "0000-00-00" && $row10[paiva] !== null) {
                            $row10[paiva] = date("d.m.Y", strtotime($row10[paiva]));

                            $kirjautunut = $row10[paiva] . ' ' . $row10[kello];
                        } else {
                            $kirjautunut = '';
                        }


                        echo '<tr><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row10[kaid] . '">' . $row10[sukunimi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row10[kaid] . '">' . $row10[etunimi] . "</a></td><td>" . $row10[rooli] . '</td><td>' . $row10[sposti] . '</td><td>' . $row10[Nimi] . '</td><td>' . $kirjautunut . '</td><td style="padding-left: 10px"><input type="checkbox" name="lista10[]" value=' . $row10[kaid] . ' checked></td></tr>';
                    }
                } else {

                    echo '<table id="mytable" class="cm8-striped cm8-uusitablekayttajat" style="table-layout:fixed; max-width: 100%; ">  <thead>';
                    echo '<tr><th><a href="kayttajatkaikki.php?sorting0=' . $sort . '&field10=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli0 . ' </a></th><th><a href="kayttajatkaikki.php?sorting1=' . $sort . '&field10=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="kayttajatkaikki.php?sorting2=' . $sort . '&field10=rooli">Rooli &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th><a href="kayttajatkaikki.php?sorting3=' . $sort . '&field10=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli3 . ' </a></th><th><a href="kayttajatkaikki.php?sorting4=' . $sort . '&field10=Nimi">Oppilaitos &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th><a href="kayttajatkaikki.php?sorting5=' . $sort . '&field10=kirjautunut">Kirjautunut viimeksi &nbsp&nbsp&nbsp' . $nuoli5 . ' </a></th><th><a href="kayttajatkaikki.php?kaikki12=joo" > Valitse kaikki<br>&nbsp&#9661&nbsp</a></th></tr></thead><tbody>';

                    while ($row10 = $result10->fetch_assoc()) {
                        if ($row10[paiva] != "0000-00-00" && $row10[paiva] !== null) {
                            $row10[paiva] = date("d.m.Y", strtotime($row10[paiva]));

                            $kirjautunut = $row10[paiva] . ' ' . $row10[kello];
                        } else {
                            $kirjautunut = '';
                        }

                        echo '<tr><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row10[kaid] . '">' . $row10[sukunimi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row10[kaid] . '">' . $row10[etunimi] . "</a></td><td>" . $row10[rooli] . '</td><td>' . $row10[sposti] . '</td><td>' . $row10[Nimi] . '</td><td>' . $kirjautunut . '<td style="padding-left: 10px"><input type="checkbox" name="lista10[]" value=' . $row10[kaid] . '></td></tr>';
                    }
                }
                echo'<tr style="border-bottom: 3px solid transparent; "><td></td><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 15px"><button class="pieniroskis" title="Poista"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td></tr>';
                echo "</tbody></table>";
                echo'</form></div>';
                  echo'<div class="cm8-responsive" id="piilota2"  style="margin: 0px; padding: 0px; overflow: hidden">';
                    echo'<p style="font-weight: bold">Siirry muille sivuille: </p>';
 if (!$result = $db->query("select distinct paiva, kello, kayttajat.id as kaid, etunimi, sukunimi, rooli, sposti, Nimi from kayttajat, kayttajankoulut, koulut where kayttajankoulut.odottaa=1 AND  kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id AND kayttajat.tarkistettu=1 ORDER BY paiva $sort, kello")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
$yht = $result->num_rows;
$total_pages = ceil($yht / $results_per_page); // calculate total pages with results
  
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
              if($i==$page) {
        echo '<a style="margin-right: 10px" href="kayttajatkaikki.php?page='.$i.'"><u>'.$i.'</u> </a>';
    }
    else{
        echo '<a  style="margin-right: 10px" href="kayttajatkaikki.php?page='.$i.'">'.$i.' </a>';
    } 
}; 
  echo'</div>';
                
                echo'</div>';
            }
        }

        if ($_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {


            if (!$haekoulu = $db->query("select distinct koulu_id from koulunadminit where kayttaja_id='" . $_SESSION["Id"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }



            if ($haekoulu->num_rows == 1) {
                while ($rowkoulu = $haekoulu->fetch_assoc()) {
                    $kouluid = $rowkoulu[koulu_id];
                }
                $_SESSION[kouluId] = $kouluid;
            }

            if (!$haekoulu = $db->query("select distinct * from koulut where id = '" . $_SESSION[kouluId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($row2 = $haekoulu->fetch_assoc()) {
                $koulu = $row2[Nimi];
            }
            echo '<h3>Ylläpitämäsi oppilaitoksen ' . $koulu . ' kaikki käyttäjät:</h3>';
            echo'<p id="ohje">Klikkaamalla käyttäjän suku- tai etunimeä pääset tarkastelemaan käyttäjän profiilia ja muokkaamaan tietoja.</p>';

            $field10 = 'sukunimi';
            $sort = 'ASC';
            $nuoli0 = '<div class="cm8-nuoliylos"> </div>';
            $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';

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
                $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
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
                $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
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
                $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
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
                $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
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
                $nuoli5 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }
            if (isset($_GET['sorting5'])) {

                if ($_GET['sorting5'] == 'ASC') {
                    $sort = 'DESC';
                    $nuoli5 = '<div class="cm8-nuolialas"> </div>';
                } else {
                    $sort = 'ASC';
                    $nuoli5 = '<div class="cm8-nuoliylos"> </div>';
                }
                $nuoli1 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli2 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli3 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli0 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
                $nuoli4 = '<div class="cm8-nuolitasa"> </div><div class="cm8-nuolitasa2"> </div>';
            }

            if ($_GET['field10'] == 'sukunimi') {
                $field10 = "sukunimi";
            } elseif ($_GET['field10'] == 'etunimi') {
                $field10 = "etunimi";
            } elseif ($_GET['field10'] == 'rooli') {
                $field10 = "rooli";
            } elseif ($_GET['field10'] == 'sposti') {
                $field10 = "sposti";
            } elseif ($_GET['field10'] == 'Nimi') {
                $field10 = "Nimi";
            } elseif ($_GET['field10'] == 'kirjautunut') {
                $field10 = "paiva";
                $field11 = "kello";
            }
            if ($_GET['field10'] == 'kirjautunut') {

                if (!$result10 = $db->query("select distinct paiva, kello, kayttajat.id as kaid, etunimi, sukunimi, rooli, sposti, Nimi from kayttajat, kayttajankoulut, koulut where koulut.id='" . $_SESSION[kouluId] . "' AND kayttajankoulut.odottaa=1 AND  kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id AND kayttajat.tarkistettu=1 ORDER BY paiva $sort, kello  LIMIT $start_from, $results_per_page")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
            } else {
                if (!$result10 = $db->query("select distinct kayttajat.paiva as paiva, kayttajat.kello as kello, kayttajat.id as kaid, etunimi, sukunimi, rooli, sposti, Nimi from kayttajat, kayttajankoulut, koulut where koulut.id='" . $_SESSION[kouluId] . "' AND kayttajankoulut.odottaa=1 AND  kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id AND kayttajat.tarkistettu=1 ORDER BY $field10 $sort LIMIT $start_from, $results_per_page")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
            }
            if ($result10->num_rows == 0)
                echo"<br><br>Ei käyttäjiä.<br>";
            else {
                echo '<form action="kayttajatkaikki.php" method="get">

<br>&#128270 <input type="search"  onkeyup="showResult4(this.value)" name="search"  id="search_box" class="haku" style="width: 50%"> 
		
			</form>';
                echo'';

                echo'<div style="margin-top: 0px; margin-bottom: 0px" id="searchresults">
<ul id="results" class="update">
</ul></div>';
                echo'<div id="scrollbar"><div id="spacer"></div></div>';
                echo'<form action="varmistuskayttajat10.php" method="post">';
                echo'<div class="cm8-responsive" id="piilota"  style="padding-top: 20px; padding-bottom: 0px; width: 100%">';
                if ($_GET[kaikki12] == 'joo') {

                    echo '<table id="mytable" class="cm8-striped cm8-uusitablekayttajat" style="table-layout:fixed; max-width: 100%; ">  <thead>';
                    echo '<tr><th><a href="kayttajatkaikki.php?sorting0=' . $sort . '&kaikki12=joo&field10=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli0 . ' </a></th><th><a href="kayttajatkaikki.php?sorting1=' . $sort . '&kaikki12=joo&field10=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="kayttajatkaikki.php?sorting2=' . $sort . '&kaikki12=joo&field10=rooli">Rooli &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th><a href="kayttajatkaikki.php?sorting3=' . $sort . '&kaikki12=joo&field10=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli3 . ' </a></th><th><a href="kayttajatkaikki.php?sorting4=' . $sort . '&kaikki12=joo&field10=Nimi">Oppilaitos &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th><a href="kayttajatkaikki.php?sorting5=' . $sort . '&kaikki12=joo&field10=kirjautunut">Kirjautunut viimeksi &nbsp&nbsp&nbsp' . $nuoli5 . ' </a></th><th><a href="kayttajatkaikki.php?kaikki12=ei" > Tyhjennä valinnat<br>&nbsp&#9661&nbsp</a></th></tr></thead><tbody>';

                    while ($row10 = $result10->fetch_assoc()) {

                        if ($row10[paiva] != "0000-00-00" && $row10[paiva] !== null) {
                            $row10[paiva] = date("d.m.Y", strtotime($row10[paiva]));

                            $kirjautunut = $row10[paiva] . ' ' . $row10[kello];
                        } else {
                            $kirjautunut = '';
                        }

                        echo '<tr><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row10[kaid] . '">' . $row10[sukunimi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row10[kaid] . '">' . $row10[etunimi] . "</a></td><td>" . $row10[rooli] . '</td><td>' . $row10[sposti] . '</td><td>' . $row10[Nimi] . '</td><td>' . $kirjautunut . '</td><td style="padding-left: 10px"><input type="checkbox" name="lista10[]" value=' . $row10[kaid] . ' checked></td></tr>';
                    }
                } else {


                    echo '<table id="mytable" class="cm8-striped cm8-uusitablekayttajat" style="table-layout:fixed; max-width: 100%; ">  <thead>';
                    echo '<tr><th><a href="kayttajatkaikki.php?sorting0=' . $sort . '&field10=sukunimi">Sukunimi &nbsp&nbsp&nbsp' . $nuoli0 . ' </a></th><th><a href="kayttajatkaikki.php?sorting1=' . $sort . '&field10=etunimi">Etunimi &nbsp&nbsp&nbsp' . $nuoli1 . ' </a></th><th><a href="kayttajatkaikki.php?sorting2=' . $sort . '&field10=rooli">Rooli &nbsp&nbsp&nbsp' . $nuoli2 . ' </a></th><th><a href="kayttajatkaikki.php?sorting3=' . $sort . '&field10=sposti">Käyttäjätunnus &nbsp&nbsp&nbsp' . $nuoli3 . ' </a></th><th><a href="kayttajatkaikki.php?sorting4=' . $sort . '&field10=Nimi">Oppilaitos &nbsp&nbsp&nbsp' . $nuoli4 . ' </a></th><th><a href="kayttajatkaikki.php?sorting5=' . $sort . '&field10=kirjautunut">Kirjautunut viimeksi &nbsp&nbsp&nbsp' . $nuoli5 . ' </a></th><th><a href="kayttajatkaikki.php?kaikki12=joo" > Valitse kaikki<br>&nbsp&#9661&nbsp</a></th></tr></thead><tbody>';

                    while ($row10 = $result10->fetch_assoc()) {
                        if ($row10[paiva] != "0000-00-00" && $row10[paiva] !== null) {
                            $row10[paiva] = date("d.m.Y", strtotime($row10[paiva]));

                            $kirjautunut = $row10[paiva] . ' ' . $row10[kello];
                        } else {
                            $kirjautunut = '';
                        }
                        echo '<tr><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row10[kaid] . '">' . $row10[sukunimi] . '</a></td><td><a href="kayttaja.php?url=' . $url . '&ka=' . $row10[kaid] . '">' . $row10[etunimi] . "</a></td><td>" . $row10[rooli] . '</td><td>' . $row10[sposti] . '</td><td>' . $row10[Nimi] . '</td><td>' . $kirjautunut . '<td style="padding-left: 10px"><input type="checkbox" name="lista10[]" value=' . $row10[kaid] . '></td></tr>';
                    }
                }
                echo'<tr style="border-bottom: 3px solid transparent; "><td></td><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 15px"><button class="pieniroskis" title="Poista"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td></tr>';
                echo "</tbody></table>";
                echo'</form>';
                echo'</div>';
                  echo'<div class="cm8-responsive" id="piilota2"  style="margin: 0px; padding: 0px; overflow: hidden">';
                    echo'<p style="font-weight: bold">Siirry muille sivuille: </p>';
                  if (!$result = $db->query("select distinct kayttajat.paiva as paiva, kayttajat.kello as kello, kayttajat.id as kaid, etunimi, sukunimi, rooli, sposti, Nimi from kayttajat, kayttajankoulut, koulut where koulut.id='" . $_SESSION[kouluId] . "' AND kayttajankoulut.odottaa=1 AND  kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id AND kayttajat.tarkistettu=1 ORDER BY $field10 $sort")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
$yht = $result->num_rows;
$total_pages = ceil($yht / $results_per_page); // calculate total pages with results
  
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
              if($i==$page) {
        echo '<a style="margin-right: 10px" href="kayttajatkaikki.php?page='.$i.'"><u>'.$i.'</u> </a>';
    }
    else{
        echo '<a  style="margin-right: 10px" href="kayttajatkaikki.php?page='.$i.'">'.$i.' </a>';
    } 
}; 
  echo'</div>';
                echo'</div>';
                

                echo'</div>';
            }
        }
        


        echo'</div>';
        echo'</div>';

        echo'</div>';
        include("footer.php");
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
    $("#mytable").tableHeadFixer({"head": false, "left": 1});

</script> 
<script>

    var j = jQuery.noConflict();


    var $table = j('#mytable');
    $table.floatThead({zIndex: 1});

</script> 

<script>


    $("#scrollbar").on("scroll", function () {

        var container = $("#piilota");
        var scrollbar = $("#scrollbar");

        ScrollUpdate(container, scrollbar);
    });

    function ScrollUpdate(content, scrollbar) {
        $("#spacer").css({"width": "1000px"}); // set the spacer width
        scrollbar.width = content.width() + "px";
        content.scrollLeft(scrollbar.scrollLeft());
    }

    ScrollUpdate($("#piilota"), $("#scrollbar"));

</script>


</body>
</html>	




