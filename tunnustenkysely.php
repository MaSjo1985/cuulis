<?php
ob_start();
echo'<!DOCTYPE html>
<html>
<head>';

if($_GET[akt] == 1){
  echo'<title>Kayttäjätunnuksen uudelleenaktivointi </title>';
}
else{
 echo'<title>Unohtunut käyttäjätunnus/salasana</title>';
}
echo'<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script><script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js">   </script>
<script src="js/jquery.barrating.min.js"></script>
<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script>
<meta name="description" content="Cuulis on eriasteisille oppilaitoksille suunnattu oppimisympäristö.">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0">

<link rel="stylesheet" href="css/TimeCircles.css" />
<link href="https://fonts.googleapis.com/css?family=Playfair+Display+SC:400,700" rel="stylesheet" type="text/css"> <link href="//fonts.googleapis.com/css?family=Questrial" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Actor" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css"> <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Neucha" /><link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="csscm/jquery-ui.css" rel="stylesheet" />
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="css/trontastic.css" />
<link rel="stylesheet" type="text/css" href="jscm/jquery.timepicker.css" /><link rel="stylesheet" type="text/css" href="jscm/jquery.datepicker.css" />
<link rel="shortcut icon" href="favicon.png" type="image/png">
<link rel="stylesheet" href="css/TimeCircles.css" />
  

<link href="ulkoasu.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

<link rel="stylesheet" href="css/fontawesome-stars-o.css">
<link href="ulkoasu.css" rel="stylesheet" type="text/css">



</head>

  <body onload="lataa2()">';
$browser = $_SERVER['HTTP_USER_AGENT'];





include("yhteys.php");
if (!$resulteka = $db->query("select arvo as keski from kayttajan_arvostelu ")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
if ($resulteka->num_rows == 0) {

    echo'<input type="hidden" id="oma" value="0"></>';
} else {
    if (!$result22 = $db->query("select AVG(arvo) as keski from kayttajan_arvostelu ")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
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
if ((strpos($browser, 'Android'))) {
    echo'<div class="cm8-container" style="padding-top: 10px; padding-bottom: 10px;padding-left: 20px">';

    echo'<a href="lataasovellus.php" class="cm8-linkk4">Lataa uusi Cuulis-sovellus Androidille &nbsp&nbsp&nbsp <i class="fa fa-download" style="font-size:0.9em"></i> </a>';

    echo'</div>';
}

echo '<div class="cm8-container7"  style="padding-left: 20px; padding-top:0px" >';

echo'<div class="cm8-half" style="margin-left: 0px; padding-left: 0px; padding-right: 20px; padding-top: 0px">';

echo'<form name="Form" id="myForm" onSubmit="return validateForm8();" class="form-style-k" action="lahetakysely.php" method="post"><fieldset>';
if($_GET[akt]==1){
    echo'<legend>Käyttäjätunnuksen uudelleenaktivointi</legend>';
}
else{
    echo'<legend>Unohtunut käyttäjätunnus/salasana</legend>';
}
   echo'<a href="etusivu.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa etusivulle</a><br><br>



   <br><p>Anna Cuulis-oppimisympäristöön rekisteröimäsi käyttäjätunnus eli sähköpostiosoite:<br><br>
 
<input type="email" id="spostir" name="sposti"  placeholder="Käyttäjätunnus eli sähköpostiosoite" style="width: 80%"></p>
    
<div style="display: inline-block; color: #e608b8; font-weight: bold; padding: 0px" id="divID">
    <p style="padding: 0px" class="eimitaan" style="display: inline-block"></p>
</div>
<input type="hidden" name="akt" value="'.$_GET[akt].'">
<br><input id="button" type="button" onclick="validateForm8()" value="&#10003 Lähetä">
<br><br><p class="eimitaan" style="color: #e608b8; font-size: 0.9em">Jos et muista antamaasi sähköpostiosoitetta, niin lähetä asiasta sähköpostia Cuulis-oppimisympäristön ylläpitäjälle osoitteeseen <a class="osoite"  href="mailto: marianne.sjoberg@cm8solutions.fi">marianne.sjoberg@cm8solutions.fi</a></p>
<br>
 </fieldset> </form>';




echo "</div></div>";
include("footer.php");
?>
 <script type="text/javascript">
$('#spostir').on('keyup', function() {
      var div3 = document.getElementById("divID");
    document.getElementById("spostir").style.backgroundColor = "white";
        div3.style.padding = "10px 60px 10px 0px";

        div3.innerHTML = "";
});
 </script>
<script>
    var input = document.getElementById("spostir");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
</body>
</html>