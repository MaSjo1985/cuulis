<?php
session_start();
ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Projektit </title>';



include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {
    echo'
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0"><link rel="stylesheet" href="css/TimeCircles.css" />
<link href="https://fonts.googleapis.com/css?family=Playfair+Display+SC:400,700" rel="stylesheet" type="text/css"> <link href="//fonts.googleapis.com/css?family=Questrial" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Actor" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css"> <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Neucha" /><link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="ulkoasu.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="favicon.png" type="image/png">
  <link rel="stylesheet" href="css/trontastic.css" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
<meta charset="UTF-8">

</head>';

    echo'<body>';

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
    include("kurssiheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 10px; padding-bottom: 10px">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="projektit.php"   class="currentLink">Projektit</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
	
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
		  
		  <a href="projektit.php"   class="currentLink">Projektit</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
			
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
    echo '<div class="cm8-margin-top"></div>';
    echo' <h2>Projektit</h2></div>';


    echo'<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px">';
    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px">';
    echo '<nav class="cm8-sidenav " style="padding-top: 20px; margin-top:0px; height: 100%">';

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





    echo'</nav>

 <div class="cm8-margin-top"></div></div>

<div class="cm8-half"> <p id="tama">Valitse oheisesta valikosta haluamasi projekti.</p>
 <div class="cm8-margin-top"></div>';

    echo'
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
           <style>
                .ui-widget-header {
            background: #15565f;
      
           
color: #2b6777;
            font-weight: bold;
            width: 20 px;
         }
      </style>
';
    echo'<script src="toinen.js" language="javascript" type="text/javascript">
</script>';
    echo'<div id="myprogress2" style="width: 60%"></div>';
    echo'<div id="myprogress"></div>';



    echo'</div>
    
</div></div>';
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