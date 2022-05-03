<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Etusivu </title>';

echo'<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />';

include("yhteys.php");

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

<link rel="stylesheet" type="text/css" href="jscm/jquery.timepicker.css" /><link rel="stylesheet" type="text/css" href="jscm/jquery.datepicker.css" />
<link rel="shortcut icon" href="favicon.png" type="image/png">
<link rel="stylesheet" href="css/TimeCircles.css" />
  <link rel="stylesheet" href="css/trontastic.css" />

<link href="ulkoasu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

<link rel="stylesheet" href="css/fontawesome-stars.css">
<link rel="stylesheet" href="css/fontawesome-stars-o.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

 <script src="funktioita.js" language="javascript" type="text/javascript"></script>
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="basic-javascript-functions.js" language="javascript" type="text/javascript"></script>

<script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="https://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>


<script type="text/javascript" src="js/TimeCircles.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
<script src="jquery.ui.touch-punch.min.js"></script>


</head>

  <body onload="piilota2();siirra();muunna();taulukko3()">';


$browser = $_SERVER['HTTP_USER_AGENT'];

if ((strpos($browser, 'Android') && strpos($browser, 'wv')) || (strpos($browser, 'OS') && strpos($browser, 'Safari') === false)) {
    echo'<header class="cm8-container" style="padding-top: 0px; padding-bottom: 20px;">
  <h1 style="padding-bottom: 0px; display: inline-block;"><a href="etusivu.php">Cuulis</a>
  <em style="font-size: 1.1em; display: inline-block">&nbsp&nbsp&nbsp - &nbsp&nbsp&nbspoppimisympäristö</em></h1>';
} else {
    echo'<header class="cm8-container" style="padding-top: 0px; padding-bottom: 0px;">
  <h1 style="padding-bottom: 0px; display: inline-block; margin-right: 80px"><a href="etusivu.php">Cuulis</a>
  <em style="font-size: 1.1em; display: inline-block">&nbsp&nbsp&nbsp - &nbsp&nbsp&nbspoppimisympäristö</em></h1><p style="padding-top: 0px; font-size: 1.1em; font-family: Neucha;display: inline-block;"><a href="lataasovellus.php" class="cm8-linkk4">Cuulis-sovellus Androidille </a></p>';
}

echo'

</header>';


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    //tarkistetaan avaimet
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "opeadmin" || $_SESSION["Rooli"] == "admink" || ($_SESSION[Rooli] == "opiskelija" && $_SESSION[vaihto] == 1)) {

        if (!$tulosAvain = $db->query("select * from kurssit where id='" . $_GET[id] . "' AND opettaja_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$tulosAvain2 = $db->query("select * from opiskelijankurssit where kurssi_id='" . $_GET[id] . "' AND opiskelija_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($tulosAvain->num_rows == 0 && $tulosAvain2->num_rows == 0) {
            header("location: avain.php?id=" . $_GET[id]);
        } else {
            if (!$tulos2 = $db->query("select * from kurssit where id='" . $_GET["id"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($tulos2->num_rows == 1) {
                while ($rivi2 = $tulos2->fetch_assoc()) {
                    $nimi = $rivi2[nimi];
                    $kouluid = $rivi2[koulu_id];
                    $koodi = $rivi2[koodi];
                    $avain = $rivi2[avain];
                    $id = $rivi2[id];
                    $ope = $rivi2[opettaja_id];
                    $lukuvuosi = $rivi2[lukuvuosi];
                    $alkupvm = $rivi2[alkupvm];
                    $loppupvm = $rivi2[loppupvm];
                    $sallicd = $rivi2[sallicd];
                    $koepvm = $rivi2[koepvm];
                    $koeaika = $rivi2[koeaika];
                    $muutopet = $rivi2[muutopet];
                }
                $_SESSION["KurssiNimi"] = $nimi;
                $_SESSION["kouluId"] = $kouluid;
                $_SESSION["Koodi"] = $koodi;
                $_SESSION["OpeId"] = $ope;
                $_SESSION["Avain"] = $avain;
                $_SESSION["Lukuvuosi"] = $lukuvuosi;
                $_SESSION["Alkupvm"] = $alkupvm;
                $_SESSION["Loppupvm"] = $loppupvm;
                if ($koepvm != '') {
                    $_SESSION["Koepvm"] = $koepvm;
                }


                $_SESSION["Koeaika"] = $koeaika;
                if ($_SESSION["Koeaika"] == '') {
                    $_SESSION["Koeaika"] = "09:00";
                }

                $_SESSION["Sallicd"] = $sallicd;
                $_SESSION["Muutopet"] = $muutopet;
                $_SESSION["KurssiId"] = $id;
            }
        }
    } else if ($_SESSION["Rooli"] == "opiskelija") {

        if (!$tulosAvain = $db->query("select * from opiskelijankurssit where kurssi_id='" . $_GET[id] . "' AND opiskelija_id='" . $_SESSION["Id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($tulosAvain->num_rows == 0) {
            header("location: avain.php?id=" . $_GET[id]);
        } else {
            if (!$tulos2 = $db->query("select * from kurssit where id='" . $_GET["id"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($tulos2->num_rows == 1) {
                while ($rivi2 = $tulos2->fetch_assoc()) {
                    $nimi = $rivi2[nimi];
                    $kouluid = $rivi2[koulu_id];
                    $koodi = $rivi2[koodi];
                    $avain = $rivi2[avain];
                    $id = $rivi2[id];
                    $ope = $rivi2[opettaja_id];
                    $lukuvuosi = $rivi2[lukuvuosi];
                    $alkupvm = $rivi2[alkupvm];
                    $loppupvm = $rivi2[loppupvm];
                    $sallicd = $rivi2[sallicd];
                    $koepvm = $rivi2[koepvm];
                    $koeaika = $rivi2[koeaika];
                    $muutopet = $rivi2[muutopet];
                }
                $_SESSION["OpeId"] = $ope;
                $_SESSION["KurssiNimi"] = $nimi;
                $_SESSION["kouluId"] = $kouluid;
                $_SESSION["Koodi"] = $koodi;
                $_SESSION["Avain"] = $avain;
                $_SESSION["Lukuvuosi"] = $lukuvuosi;
                $_SESSION["Alkupvm"] = $alkupvm;
                $_SESSION["Loppupvm"] = $loppupvm;
                if ($koepvm != '') {
                    $_SESSION["Koepvm"] = $koepvm;
                }


                $_SESSION["Koeaika"] = $koeaika;
                if ($_SESSION["Koeaika"] == '') {
                    $_SESSION["Koeaika"] = "09:00";
                }

                $_SESSION["Sallicd"] = $sallicd;
                $_SESSION["Muutopet"] = $muutopet;
                $_SESSION["KurssiId"] = $id;
            }
        }
    } else if ($_SESSION[Rooli] == admin) {
        if (!$tulos2 = $db->query("select * from kurssit where id='" . $_GET["id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($tulos2->num_rows == 1) {
            while ($rivi2 = $tulos2->fetch_assoc()) {
                $nimi = $rivi2[nimi];
                $kouluid = $rivi2[koulu_id];
                $koodi = $rivi2[koodi];
                $avain = $rivi2[avain];
                $id = $rivi2[id];

                $lukuvuosi = $rivi2[lukuvuosi];
                $alkupvm = $rivi2[alkupvm];
                $loppupvm = $rivi2[loppupvm];
                $sallicd = $rivi2[sallicd];
                $koepvm = $rivi2[koepvm];
                $koeaika = $rivi2[koeaika];
                $muutopet = $rivi2[muutopet];
            }
            $_SESSION["KurssiNimi"] = $nimi;
            $_SESSION["kouluId"] = $kouluid;
            $_SESSION["Koodi"] = $koodi;
            $_SESSION["Avain"] = $avain;
            $_SESSION["Lukuvuosi"] = $lukuvuosi;
            $_SESSION["Alkupvm"] = $alkupvm;
            $_SESSION["Loppupvm"] = $loppupvm;
            if ($koepvm != '') {
                $_SESSION["Koepvm"] = $koepvm;
            }


            $_SESSION["Koeaika"] = $koeaika;
            if ($_SESSION["Koeaika"] == '') {
                $_SESSION["Koeaika"] = "09:00";
            }

            $_SESSION["Sallicd"] = $sallicd;
            $_SESSION["Muutopet"] = $muutopet;
            $_SESSION["KurssiId"] = $id;
        }
        $_SESSION["vaihto"] = 0;
    }

    if (!$haeaktit = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowp = $haeaktit->fetch_assoc()) {
        $palaute = $rowp[palauteakt];
        $aikataulu = $rowp[aikatauluakt];
        $tavoite = $rowp[tav_akt];
    }
    if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka->num_rows != 0) {
        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
    }
    if (!$hae_eka2 = $db->query("select MIN(id) as id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka2->num_rows != 0) {
        while ($rivieka2 = $hae_eka2->fetch_assoc()) {
            $eka_id2 = $rivieka2[id];
        }
    }
    if (!$haeoik = $db->query("select distinct *  from kayttajan_oikopolut where kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttaja_id='" . $_SESSION[Id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }







    if ($palaute == 1 && $_SESSION["Rooli"] == "opiskelija") {
        echo'<div style="display:none" id="tama1" class="cm8-quarter"><br></div>';
        echo'<div style="display:none" id="tama2" class="cm8-quarter"><br></div>';
        echo'<div style="display:none" id="tama3" class="cm8-quarter"><br></div>';
        echo'<div style="display:none" class="cm8-quarter" id="tama">';
        echo'<div style="display:none" class="cm8-container" id="siirto" title="Voit siirtää aluetta!" style="width: auto; height: auto;z-index: 1;position: fixed !important">';
    } else if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<div style="display:none" id="tama1" class="cm8-quarter"><br></div>';
        echo'<div style="display:none" id="tama2" class="cm8-quarter"><br></div>';
        echo'<div style="display:none" id="tama3" class="cm8-quarter"><br></div>';
        echo'<div style="display:none" class="cm8-quarter" id="tama">';
        echo'<div style="display:none" class="cm8-container" id="siirto" title="Voit siirtää aluetta!" style="width: auto; height: auto;z-index: 1;position: fixed !important">';
    }



    //kurssipalaute


    if ($palaute == 0) {

        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

            echo'<h2 style="color: #2b6777; font-size: 1em; display: inline-block">KURSSIPALAUTE:</h2>    <button id="klik" style="display: inline-block; margin-left: 20px" class="myButton8" title="Piilota näkyvistä">- Piilota</button>';




            echo'<br><em style="font-size: 0.8em">Palautteen antoa ei ole aktivoitu.</em>';
            echo' <form action="aktivoipalaute.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikea" value="+" title="Aktivoi kurssipalaute" class="myButton9"  role="button"  style="padding:2px 4px"></form>';
        }
    } else {



        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
            echo'<h2 style="color: #2b6777; font-size: 1em; display: inline-block">KURSSIPALAUTE:</h2>    <button id="klik" style="display: inline-block; margin-left: 20px" class="myButton8" title="Piilota näkyvistä">- Piilota</button>';

            if (!$haepalaute = $db->query("select * from palautteet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($haepalaute->num_rows != 0) {
                echo'<br><em style="font-size: 0.9em">Olet saanut ' . $haepalaute->num_rows . ' kpl palautetta.<br>Katso palautteet <a href="palautteet.php"><b>tästä.</b></em></a>';
            } else {
                echo'<br><em style="font-size: 0.9em">Ei palautteita.</em>';
            }
            echo' <form action="aktivoipalaute.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikep" title="Peru kurssipalautteen antamismahdollisuus" value="-" class="myButton9"  role="button"  style="padding:2px 4px"></form>';
        } else {

            echo' ';

            echo'<h2 style="color: #2b6777; font-size: 1em; display: inline-block">KURSSIPALAUTE:</h2>
                   <button id="klik" style="display: inline-block; margin-left: 20px" class="myButton8" title="Piilota näkyvistä">- Piilota</button>
                    <form id="kirja" action="lahetakurssipalaute.php" method="post">
		<br><textarea name="viesti" rows="6" placeholder="Tähän voit antaa nimettömästi palautetta kurssista/opintojaksosta." style="font-size: 0.9em"></textarea><br><br> 
            <input type="submit" class="myButton9" value="Lähetä">
            
           </form>';
        }
    }
    echo'</div>';
    echo'</div>';
    echo'</div>';







    include("kurssiheader2.php");



    echo'
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  
    <script src="toinen.js" language="javascript" type="text/javascript">
    
</script>
    <style>
                .ui-widget-header {
            background: #15565f;
      
           
color: #2b6777;
            font-weight: bold;
            width: 20 px;
         }
      </style>';
    echo '<div class="cm8-container7" id="paluu" style="margin-top: 0px; padding-top:0px; padding-bottom: 30px; margin-bottom: 0px">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
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
//        if ($kysakt == 1) {
//
//
//            echo'<a href="kysymykset2.php" target="_blank">Kysy/kommentoi</a>';
//        } else {
        // // echo'<a  href="kysymyksetkommentit.php">Kysy/kommentoi</a>';
//        }


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
		 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '" class="currentLink" >Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
		
		  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
			
	';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {

            $kysakt = $rowa[kysakt];
        }
        if ($kysakt == 1) {


//            echo'<a href="kysymykset2.php" target="_blank">Kysy/kommentoi</a>';
        } else {
            // // echo'<a  href="kysymyksetkommentit.php">Kysy/kommentoi</a>';
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



    echo '<div class="cm8-container7" style="margin-top: 20px; padding-top:10px; padding-bottom: 0px; margin-bottom: 0px; padding-left: 0px">';







    echo' <p style="z-index: 1;position: fixed; top:30%; right:10%">';
    echo' <button id="klik2"  class="myButton8" title="Avaa kurssipalaute">+ Kurssipalaute</button></p>';


    if (($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') && $_SESSION["vaihto"] == 0) {

        echo'<form action="muokkaakurssi.php" method="post" style="padding-top: 0px; margin-top: 0px; text-align: top"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '> <input type="submit" value="&#9998 Muokkaa tietoja" title="Muokkaa tietoja" class="myButton8"  role="button"  style="padding:2px 2px"></form>';
    }
    if (!$haeaktit = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowp = $haeaktit->fetch_assoc()) {
        $palaute = $rowp[palauteakt];
        $aikataulu = $rowp[aikatauluakt];
        $tavoite = $rowp[tav_akt];
    }
    echo '<div  class="cm8-third">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {





        if ($tavoite == 0) {

            echo'<p style="font-size: 0.9em; display: inline-block"><em>Opiskelijoille voidaan antaa mahdollisuus asettaa kurssille/opintojaksolle tavoite (näkyy myöhemmin osallistujaluettelossa).</em></p>';

            echo'<form action="aktivoitavoite.php" method="post" style="margin-left: 20px; display: inline-block"><input type="hidden" name="arvo" value="joo"> <input type="submit" value="Salli" class="myButton8"  role="button"  style="padding:0px 2px"></form>';

            //salli tavoitteen anto
        } else {
            echo'<p style="font-size: 0.9em; display: inline-block"><em>Tavoitteen asettaminen sallittu.</em></p>';
            echo'<form action="aktivoitavoite.php" method="post" style="display: inline-block; padding-top: 0px; margin-top: 0px; text-align: top; margin-left: 20px"><input type="hidden" name="arvo" value="ei"> <input type="submit" value="Peru" class="myButton8"  role="button"  style="padding:0px 2px"></form>';

            //peru tavoitteen anto
        }
    } else {

        if (!$haeakt = $db->query("select tav_akt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowakt = $haeakt->fetch_assoc()) {
            $akt = $rowakt[tav_akt];
        }

        if ($akt != 0) {

            if (!$haetavoite = $db->query("select distinct tavoite from opiskelijankurssit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND opiskelija_id='" . $_SESSION["Id"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowtav = $haetavoite->fetch_assoc()) {

                $tavoitteeni = $rowtav[tavoite];

                echo '<br><br><b style="margin-right: 10px">Tavoitteeni kurssille/opintojaksolle: </b>' . $tavoitteeni . '';

                echo'<form action="muokkaatavoite.php" method="post" style="display: inline-block; padding-top: 0px; margin-top: 0px; text-align: top; margin-left: 20px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '> <input type="submit" value="&#9998 Muokkaa" title="Muokkaa tavoitetta" class="myButton9"  role="button"  style="padding:0px 2px"></form>';
            }
        }
    }


    echo'</div>';
    if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka->num_rows != 0) {
        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
    }
    if (!$hae_eka2 = $db->query("select MIN(id) as id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka2->num_rows != 0) {
        while ($rivieka2 = $hae_eka2->fetch_assoc()) {
            $eka_id2 = $rivieka2[id];
        }
    }







    echo'</div></div>';


    echo '<div class="cm8-container7" style="margin-top: 0px; padding-top:0px; padding-bottom: 60px; margin-bottom: 0px; padding-left: 40px">';



    echo '<h2 style="color: #2b6777; display: inline-block; padding-top: 10px">ILMOITUSTAULU</h2>';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo' <form action="ilmoitus.php" method="post" style="margin-left: 20px; display: inline-block"><input type="submit" name= "painikek" value="&#9998 Muokkaa" title="Muokkaa ilmoitustaulua" class="myButton9"  role="button"  style="padding:2px 4px; display: inline-block"></form>';
    }
    if (!$haeilmoitus = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowv = $haeilmoitus->fetch_assoc()) {
        $viesti = $rowv[ilmoitus2];
    }

    echo'<div class="cm8-responsive" style="padding-top:0px; width:80% ; max-height: 600px">';



//    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin")
//        echo '<tr style="margin-bottom: 0px"><td style="border:1px solid #2b6777;  border-bottom:0px solid #2b6777;  border-right:0px solid #2b6777;"></td><td style="text-align: right;  width:1%; #f7f9f7-space:nowrap; border:1px solid #2b6777;  border-bottom:0px solid #2b6777;  border-left:0px solid #2b6777; "><form action="ilmoitus.php" method="post" style="width: 100%; float: right; padding-bottom: 0px"><input type="submit" name= "painikek" value="&#9998 Muokkaa" title="Muokkaa ilmoitustaulua" class="myButton9"  role="button"  style="font-size: 0.8em; float: right; margin-bottom: 0px; padding: 0px"></form></td><td></td></tr>';
//
//    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin")
//        echo'<tr><td style="text-align: left; padding-top: 0px; border:1px solid #2b6777;  border-right:0px solid #2b6777; border-top:0px solid #2b6777; padding-bottom: 20px; width:1%; #f7f9f7-space:nowrap">';
//    else
//        echo'<tr><td style="text-align: left; padding-top: 20px;  border:1px solid #2b6777; padding-bottom: 20px; width:1%;box-shadow: 2px 2px 2px #888888;   overflow-wrap: break-word; margin: 0 auto;
//  max-width: 300px;
//  border: solid 2px #ccc;
//  padding: 12px;">';
//
//
//
//    echo $viesti;
//
//    echo '</td>';
//
//    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
//        echo '<td style="border:1px solid #2b6777; border-left:0px solid #2b6777; border-top:0px solid #2b6777  ; box-shadow: 2px 2px 2px #888888"></td>';
//    }



    echo'<p id="ilmoitus" >' . $viesti . '</p>';



    echo'</div>';

    if ($aikataulu == 0) {

        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

            echo '<br><h2 style="color: #2b6777; padding-top: 20px; display: inline-block">KURSSIAIKATAULU</h2>';
            echo'<br><br><em style="font-size: 0.8em">Halutettasi voit lisätä tähän kurssin/opintojakson aikataulun.</em>';
            echo' <form action="aktivoiaikataulu.php" method="post"><br><br><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikea" value="+ Lisää aikataulu" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
        }
    } else {

        echo '<br><h2 style="color: #2b6777; padding-top: 20px; display: inline-block; margin-right: 20px">KURSSIAIKATAULU</h2>';
        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

            echo' <form action="aikatauluvarmistus.php" method="post" style="display: inline-block; margin-right: 10px"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikep" value="&#10007" title="Poista aikataulu" class="myButton9"  role="button"  style="padding:2px 4px"></form>';
            echo' <form action="muokkaa_aikataulu.php#tanne" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa aikataulua" class="myButton9"  role="button"  style="padding:2px 4px; display: inline-block"></form>';
        }

        echo'<div class="cm8-responsive" style="padding-top: 10px; padding-right: 10px">';
        echo '<table id="mytable" class="cm8-uusitable" style="table-layout:fixed; max-width: 100%;">  <thead>';

        echo '<tr style="border: 1px solid grey; background-color: #48E5DA" id="palaa"><th style="border: 1px solid grey; width: 10%">Ajankohta</th><th style="border: 1px solid grey ">Aihe</th><th style="border: 1px solid grey">Lisätietoja</th></tr></thead><tbody>';

        if (!$haeaikataulu = $db->query("select distinct * from kurssiaikataulut where kurssi_id='" . $_SESSION[KurssiId] . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowt = $haeaikataulu->fetch_assoc()) {







            echo '<tr style="font-size: 0.9em;"><td style="border: 1px solid grey;    padding:6px 8px">' . $rowt[aika] . '</td><td style="border: 1px solid grey;    padding:6px 8px">' . $rowt[aihe] . '</td><td style="word-wrap: break-word;   border: 1px solid grey;    padding:6px 8px">' . $rowt[lisa] . '</td></tr>';
        }

        echo "</tbody></table>";
    }

    echo'</div>';
    echo'</div>';
    echo'</div>';
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');

    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}


echo "</div>";

include("footer.php");
?>

</body>
</html>	