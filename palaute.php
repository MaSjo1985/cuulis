<?php
session_start(); 


ob_start();


echo'
<!DOCTYPE html>
<html>
 <style>
#text {display:none;color:#e608b8}
</style>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9,IE=8,IE=7,IE=Edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
<meta charset="UTF-8">
<title>Anna palautetta</title>
<meta name="description" content="Cuulis on eriasteisille oppilaitoksille suunnattu oppimisympäristö."/>
<meta property="og:description" content="Cuulis on eriasteisille oppilaitoksille suunnattu oppimisympäristö."/>
<meta name="twitter:description" content="Cuulis on eriasteisille oppilaitoksille suunnattu oppimisympäristö."/>

<link rel="stylesheet" href="css/TimeCircles.css" />
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



echo '<div class="cm8-container"  style="padding-top:0px; padding-bottom: 10px" >';

echo'<a href="Tietoa Cuulis-oppimisympäristöstä.pdf" target="_blank" class="cm8-linkk3" title="Tietoa"  style="visibility: hidden; width: 0%; margin-right: 0px">Mikä on Cuulis? 
 </a>';


echo '<div class="cm8-container"  style="padding-top:0px; padding-bottom: 0px" >';

//echo'<a href="Tietoa Cuulis-oppimisympäristöstä.pdf" target="_blank" class="cm8-linkk3" title="Tietoa"  style="visibility: hidden; width: 0%; margin-right: 0px">Mikä on Cuulis? 
// </a>';

echo'<p style="margin-top: 0px;display: inline-block; padding-top: 0px; padding-left: 0px; padding-bottom: 0px; margin-bottom: 0px" id="stars"><select id="example">

<option style="display: inline-block" id="taa" value="1">1</option>
  <option style="display: inline-block" value="2">2</option>
  <option style="display: inline-block" value="3">3</option>
  <option style="display: inline-block" value="4">4</option>
  <option style="display: inline-block" value="5">5</option>
</select></p>';


echo'<div style="display: inline-block; margin-left: 20px; font-size: 0.8em" id="keski" ></div>';
echo'<div id="stars2" style="color: #2b6777; padding: 0px; margin: 0px; display: inline-block; margin-left: 30px; font-size: 0.7em; color: #e608b8; font-style: italic" ></div>';

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

echo '<div class="cm8-container7"  style="padding-left: 20px; padding-top:0px; padding-right: 20px" >';


echo'<div class="cm8-half">';
echo'<form name="Form" id="myForm" onSubmit="return validateForm2()" action="lahetapalaute.php" method="post" class="form-style-k"><fieldset>';
echo' <legend>Lähetä viesti Cuulis-oppimisympäristön ylläpitäjälle</legend>';
echo'<a href="etusivu.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa etusivulle</a><br><br><br>


<input type="text"name="Nimi" style="width: 60%" placeholder="Nimi">

	   
<br><br><input type="email" style="width: 60%"  id="tama" name="sposti" placeholder="Käyttäjätunnus"><b style="color: #e608b8; padding-left:5px"> *</b>

<div style="color: #e608b8; font-weight: bold;" id="divID">
    <p class="eimitaan"></p>
</div>    
<br><br><input type="text" name="Puh" style="width: 60%"  placeholder="Puh"> <br><br>

<textarea name="Viesti" style="width: 60%" rows="10" placeholder="Viesti"></textarea> 


	<br><br><input type="button" onclick="validateForm2()" value="📧 &nbsp Lähetä" style="padding-bottom: 5px" >
    

  </fieldset></form></div></div>';



include("footer.php");
?>
</body>
</html>	
