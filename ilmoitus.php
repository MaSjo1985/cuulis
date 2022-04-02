<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Muokkaa ilmoitustaulua </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

 // ready to go!

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
        <link rel="stylesheet" href="css/tekstieditori.css">

  
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






        if (isset($_POST['painikek'])) {


            echo '<div class="cm8-container7" id="paluu" style="margin-top: 0px; padding-top:0px; padding-bottom: 30px; margin-bottom: 0px; ">';

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


            if (!$haeilmoitus = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowv = $haeilmoitus->fetch_assoc()) {
                $viesti = $rowv[ilmoitus2];
            }


            echo '<div class="cm8-container7" style="border: none; margin-left: 0px;margin-top: 0px; padding-top:10px; padding-bottom: 0px; margin-bottom: 0px; padding-left: 0px;">';
            echo'<div class="cm8-container3" style="padding-top: 0px; margin-top: 0px">';

            echo'	  <form action="lahetailmoitus.php" class="form-style-k" style="width: 80%" method="post"><fieldset>
                  <legend>Muokkaa ilmoitustaulua</legend>
                  
           <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>
		<br><br><textarea class="content" name="viesti" rows="30" style="width: 90%">' . $viesti . '</textarea><br>
		<br><input type="submit" value="&#10003 Tallenna" class="myButton9">
			<input type="hidden" name="kumpi" value="ilmoitus">
	  </fieldset></form></div>';
        }
        //Palautukset
        else if (isset($_POST['painiker'])) {

            echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';
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

            echo'<div class="cm8-margin-top"></div>';



            echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Palautukset</h2>';
            echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">';

            if (!$hae_eka = $db->query("select id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($hae_eka->num_rows == 1) {
                while ($rivieka = $hae_eka->fetch_assoc()) {
                    $eka_id = $rivieka[id];
                }
                echo'';
            } else {
                echo'';
            }

            if (!$hae_eka2 = $db->query("select id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
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






            if (!$haeprojekti = $db->query("select * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($haeprojekti->num_rows != 0) {
                echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
                while ($rowP = $haeprojekti->fetch_assoc()) {
                    $kuvaus = $rowP[kuvaus];
                    $id = $rowP[id];
                    if ($_POST[id] == $id) {
                        $kuvausoikea = $kuvaus;
                        echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
                    } else {

                        echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
                    }
                }
                echo'<div class="cm8-margin-top"></div>';
            }


            echo'</nav>
 </div> 

 
<div class="cm8-threequarter">';


            echo'	  <form action="lahetailmoitus.php" method="post" class="form-style-k" style="margin-top: 0px"><fieldset>';
            echo '<legend >Muokkaa palautuksen "' . $kuvausoikea . '" ilmoitustaulua</legend>';
            echo '<a href="ryhmatyot.php?r=' . $_POST[id] . '" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';

            if (!$haeilmoitus = $db->query("select * from projektit where id='" . $_POST[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowv = $haeilmoitus->fetch_assoc()) {
                $viesti = $rowv[info];
            }


            echo'<br><textarea class="content" name="viesti" rows="12" >' . $viesti . '</textarea><br>
		<br><input type="submit" value="&#10003 Tallenna" class="myButton9">
		<input type="hidden" name="id" value=' . $_POST[id] . '>
		<input type="hidden" name="kumpi" value="inforyhma">
	  </fieldset></form>';
            echo "</div>";
        } else if (isset($_POST['painikei'])) {
            echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';
            if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
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
            }

            echo'<div class="cm8-margin-top"></div>';



            echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Tehtävälista</h2>';
            echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">';

            if (!$hae_eka = $db->query("select id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if ($hae_eka->num_rows == 1) {
                while ($rivieka = $hae_eka->fetch_assoc()) {
                    $eka_id = $rivieka[id];
                }
                echo'';
            } else {
                echo'';
            }

            if (!$haeprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($haeprojekti->num_rows != 0) {
                echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
                while ($rowP = $haeprojekti->fetch_assoc()) {
                    $kuvaus = $rowP[kuvaus];
                    $id = $rowP[id];

                    if ($_POST[id] == $id) {

                        echo'<a href="itsetyot.php?i=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
                    } else {

                        echo'<a href="itsetyot.php?i=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
                    }
                }

                echo'<div class="cm8-margin-top"></div>';


                echo'</div>';
            }


            if (!$hae_eka2 = $db->query("select id from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
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





            echo'


 
	
</nav>

 </div> 
 
<div class="cm8-threequarter"> ';


            if (!$haeprojekti2 = $db->query("select * from itseprojektit where id='" . $_POST[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP2 = $haeprojekti2->fetch_assoc()) {

                $ipid = $rowP2[id];
                $kuvaus2 = $rowP2[kuvaus];
                $kuvaus2 = str_replace('<br />', "", $kuvaus2);
            }

            echo'	  <form action="lahetailmoitus.php" method="post" class="form-style-k" style="margin-top: 0px"><fieldset>';
            echo '<legend>Muokkaa Tehtävälista-osion "' . $kuvaus2 . '" ilmoitustaulua</legend>';
            echo '<a href="itsetyot.php?i=' . $_POST[id] . '" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';

            if (!$haeilmoitus = $db->query("select * from itseprojektit where id='" . $_POST[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowv = $haeilmoitus->fetch_assoc()) {
                $viesti = $rowv[info];
            }






            echo'<br><textarea class="content" name="viesti" rows="12" >' . $viesti . '</textarea><br>
		<br><input type="submit" value="&#10003 Tallenna" class="myButton9">
			<input type="hidden" name="id" value=' . $_POST[id] . '>
		<input type="hidden" name="kumpi" value="infoitse">
	  </fieldset></form>';
            echo "</div>";
        } else if (isset($_POST['painikeia'])) {



            echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';

            echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a>
            <a href="projektit.php"  class="currentLink" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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


            echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px"><br></h2>

      



 </div> ';
            echo'<div class="cm8-threequarter" >';

            echo'	  <form action="lahetailmoitus.php" method="post" class="form-style-k" style="margin-top: 0px"><fieldset>';

            echo '<legend>Muokkaa Itsearviointi-sivuston ilmoitustaulua</legend>';
            echo '<a href="itsearviointi.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';

            if (!$haeilmoitusa = $db->query("select distinct infoitsearviointi from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowva = $haeilmoitusa->fetch_assoc()) {
                $viesti = $rowva[infoitsearviointi];
            }






            echo'<br><textarea class="content" name="viesti"  >' . $viesti . '</textarea><br>
		<br><input type="submit" value="&#10003 Tallenna" class="myButton9">
			<input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '>
		<input type="hidden" name="kumpi" value="infoitsea">
	  </fieldset></form>';
            echo "</div>";
        } else if (isset($_POST['painikekysely'])) {


            echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';

            echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a>
         <a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  class="currentLink" >Kyselylomake</a>
		
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


            echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px"><br></h2>

      



 </div> ';
            echo'<div class="cm8-threequarter" >';

            echo'	  <form action="lahetailmoitus.php" method="post" class="form-style-k" style="margin-top: 0px"><fieldset>';

            echo '<legend>Muokkaa Kyselylomake-sivuston ilmoitustaulua</legend>';
            echo '<a href="kysely.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';

            if (!$haeilmoitusa = $db->query("select distinct kyselyinfo from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowva = $haeilmoitusa->fetch_assoc()) {
                $viesti = $rowva[kyselyinfo];
            }






            echo'<br><textarea class="content" name="viesti" rows="12" >' . $viesti . '</textarea><br>
		<br><input type="submit" value="&#10003 Tallenna" class="myButton9">
			<input type="hidden" name="id" value=' . $_POST[id] . '>
		<input type="hidden" name="kumpi" value="infokysely">
	  </fieldset></form>';
            echo "</div>";
        }
        echo'</div>';
        echo'</div>';
    }
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

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="js/tekstieditori.js"></script>

<script>
    $(document).ready(function () {
        $('.content').richText({

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
    });
</script>



</body>
</html>			
