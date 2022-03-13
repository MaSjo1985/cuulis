<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>

<head>
<meta http-equiv="X-UA-Compatible" content="IE=9,IE=8,IE=7,IE=Edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
<meta charset="UTF-8">
<title> oppimisympäristön ylläpitäjä</title>
<meta name="description" content="Cuulis on eriasteisille oppilaitoksille suunnattu oppimisympäristö."/>
<meta property="og:description" content="Cuulis on eriasteisille oppilaitoksille suunnattu oppimisympäristö."/>
<meta name="twitter:description" content="Cuulis on eriasteisille oppilaitoksille suunnattu oppimisympäristö."/>';
echo '<link rel="shortcut icon" href="favicon.png" type="image/png">';
include("yhteys.php");


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

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour
// ready to go!

$url = $_SERVER[REQUEST_URI];
$url = substr($url, 1);
$url = strtok($url, '?');

if (isset($_SESSION["Kayttajatunnus"])) {





    if (isset($_SESSION[KurssiId])) {

        include('kurssisivustonheader.php');
        echo '<div class="cm8-container7" id="paluu" style="margin-top: 0px; padding-top:0px; padding-bottom: 30px; margin-bottom: 0px;">';

        if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
            echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()"  >Tehtävälista</a><a href="ryhmatyot.php" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
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
		 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '"  >Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
		
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



        echo '<div class="cm8-container7" style="border: none; margin-left: 0px;margin-top: 0px; padding-top:10px; padding-bottom: 0px; margin-bottom: 0px; padding-left: 0px;">';
    } else {


        include("header.php");
        include("header2.php");

        echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px;">';
        if ($_SESSION["Rooli"] == 'admin')
            include("adminnavi.php");
        else if ($_SESSION["Rooli"] == 'admink')
            include("adminknavi.php");
        else if ($_SESSION["Rooli"] == 'opeadmin')
            include("opeadminnavi.php");
        else if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "opiskelija" || $_SESSION["Rooli"] == "muu")
            include ("opnavi.php");
    }


    echo'<div class="cm8-container3">';
}
else {

    echo'<link rel="stylesheet" href="css/TimeCircles.css" />
<link href="https://fonts.googleapis.com/css?family=Playfair+Display+SC:400,700" rel="stylesheet" type="text/css"> <link href="//fonts.googleapis.com/css?family=Questrial" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Actor" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css"> <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Neucha" /><link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="csscm/jquery-ui.css" rel="stylesheet" />
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="css/trontastic.css" />
  <link rel="stylesheet" href="/resources/demos/style.css">
<link rel="stylesheet" type="text/css" href="jscm/jquery.timepicker.css" /><link rel="stylesheet" type="text/css" href="jscm/jquery.datepicker.css" />
<link rel="shortcut icon" href="favicon.png" type="image/png">
<link rel="stylesheet" href="css/TimeCircles.css" />

  
<link href="ulkoasu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

<link rel="stylesheet" href="css/fontawesome-stars-o.css">

<script src="basic-javascript-functions.js" charset="utf-8">
</script><script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js">   </script>
<script src="js/jquery.barrating.min.js"></script>

</script>

</head>

  <body onload="lataa2()">';

    $browser = $_SERVER['HTTP_USER_AGENT'];




    include("yhteys.php");
    if (!$resulteka = $db->query("select arvo as keski from kayttajan_arvostelu ")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($resulteka->num_rows == 0) {

        echo'<input type="hidden" id="oma" value="0"></>';
    } else {
        if (!$result22 = $db->query("select AVG(arvo) as keski from kayttajan_arvostelu ")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($row = $result22->fetch_assoc()) {
            $keski = round($row[keski], 1);
            echo'<input type="hidden" id="oma" value=' . $keski . '></>';
        }
    }
    echo'<div class="cm8-container" style="padding-top: 5px; padding-bottom: 5px;padding-left: 20px">';
    echo'<div class="cm8-half" style="padding: 0px; margin:0px">';
    echo'<h1 style="padding-bottom: 0px; display: inline-block;"><a href="etusivu.php">Cuulis</h1>
  <b style="font-size: 0.8em; display: inline-block">&nbsp - &nbspoppimisympäristö</b></a>';

    echo'</div>';


//echo'<a href="Tietoa Cuulis-oppimisympäristöstä.pdf" target="_blank" class="cm8-linkk3" title="Tietoa"  style="visibility: hidden; width: 0%; margin-right: 0px">Mikä on Cuulis? 
// </a>';
    echo'<div class="cm8-half" style="padding: 5px 0px 0px 0px; margin:0px">';
    echo'<p style="margin-top: 0px;display: inline-block; padding-top: 0px; padding-left: 0px; padding-bottom: 0px; margin-bottom: 0px" id="stars"><select id="example">

<option style="display: inline-block" id="taa" value="1">1</option>
  <option style="display: inline-block" value="2">2</option>
  <option style="display: inline-block" value="3">3</option>
  <option style="display: inline-block" value="4">4</option>
  <option style="display: inline-block" value="5">5</option>
</select></p>';


    echo'<div style="display: inline-block; margin-left: 20px; font-size: 0.7em" id="keski" ></div>';
    echo'<div id="stars2" style="color: #2b6777; padding: 0px; margin: 0px; display: inline-block; margin-left: 30px; font-size: 0.7em; color: #e608b8; font-style: italic" ></div>';

    echo'</div>';
    echo'</div>';
    ?>

    <script type="text/javascript">
        $(function () {
            var value = document.getElementById('oma').value;


            $('#example').barrating({
                theme: 'fontawesome-stars-o',
                initialRating: document.getElementById('oma').value,
                readOnly: true


            });

            $('#example').barrating('set', value);
            $('#example').barrating('readonly', true);


        });
        $('#stars').click(function () {
            var mydiv = document.getElementById("stars2");

            mydiv.innerHTML = "Kirjautumalla sisään voit arvostella sivuston.";
            setTimeout(function () {
                $('#stars2').empty();
            }, 3000);



        });



    </script>


    <?php
session_start(); 


    ob_start();
    if ((strpos($browser, 'Android'))) {
        echo'<div class="cm8-container" style="padding-top: 10px; padding-bottom: 10px;padding-left: 20px">';

        echo'<a href="lataasovellus.php" class="cm8-linkk4">Lataa uusi Cuulis-sovellus Androidille &nbsp&nbsp&nbsp <i class="fa fa-download" style="font-size:0.9em"></i> </a>';

        echo'</div>';
    }

    echo'<div class="cm8-container7" style="padding-top: 40px; padding-left: 40px">';
}



echo"<h7>Cuulis-oppimisympäristön kehittäjä </h7>";
if (isset($_SESSION[KurssiId])) {

    echo'<br><a href="kurssi.php?id=' . $_SESSION[KurssiId] . '"><b><p style="font-size: 0.8em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa kurssin/opintojakson etusivulle</a></b>';
} else {

    echo'<br><a href="etusivu.php"><b><p style="font-size: 0.8em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa etusivulle</a></b>';
}
echo'<br>';
if (!$result = $db->query("select distinct * from kayttajat where rooli='admin'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}




echo'<div class="cm8-responsive" style="margin-top: 40px">';
echo '<table class="cm8-table2 cm8-bordered2">';
echo"<tr><td>";

while ($row = $result->fetch_assoc()) {
    $id = $row[id];

    echo'<img src="/' . $row[omakuva] . '" style="width: 90px"><br><br><br>';

    echo "<b>Etunimi: </b> " . $row[etunimi] . '<br><br>';
    echo "<b>Sukunimi: </b>" . $row[sukunimi] . '<br><br>';

    echo '<b>Rooli: </b>Yleinen ylläpitäjä<br><br>';


    echo '<b>Sähköpostiosoite:</b> &nbsp&nbsp<a href="mailto: ' . $row[sposti] . '">' . $row[sposti] . '</a><br><br>';






    echo "</td>" . "</tr>" . "</table>" . "</div>";
}






echo "</td>" . "</tr>" . "</table>";




//
//echo'<form action="palaute.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $id . '> <input type="submit" value="📧 &nbsp Lähetä viesti" class="myButton9"  role="button" ></form>';

echo'</div>';
echo'</div>';
echo'</div>';

include("footer.php");
?>
</body>
</html>			
