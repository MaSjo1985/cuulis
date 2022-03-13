<?php
session_start();
ob_start();

echo'
<!DOCTYPE html>
<html>
 
<head>

<title> Rekisteröityminen</title>
<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
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
  <link rel="stylesheet" href="css/trontastic.css" />
  <link rel="stylesheet" href="/resources/demos/style.css">
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

echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 60px; ">';


echo'<div class="cm8-half" style="margin-left: 0px; padding-left: 20px; padding-top: 0px; margin-top: 0px">';

echo '<form name="Form" id="myForm" class="form-style-k" onSubmit="return validateForm4ope();" action="rekisterointitarkistusope.php" method="post"><fieldset>';

echo' <legend>Rekisteröidy opettajana Cuulis-oppimisympäristöön</legend>';

echo '<a href="rekisteroityminenuusi.php" class="palaa">&#8630&nbsp&nbsp&nbsp Palaa takaisin</a>';
echo'<br><br><br><b style="color: #e608b8; font-size: 1em">Kaikki tiedot ovat pakollisia. </b><br>';




echo'<br><br><p>Etunimi: <b style="color: #e608b8">*</b><br><br>
 
<input type="text"   id="etu" name="Etunimi" placeholder="Etunimi"  style="width: 60%"></p>
<div style="color: #e608b8; font-weight: bold; padding: 0px; margin: 0px; display: inline-block" id="divID">
    <p class="eimitaan"></p>
</div>
<br><br><p>Sukunimi: <b style="color: #e608b8">*</b><br><br>

<input type="text" id="suku"    name="Sukunimi" placeholder="Etunimi" style="width: 60%"></p>


<div style="color: #e608b8; font-weight: bold; padding: 0px; margin: 0px; display: inline-block" id="divID2">
 <p class="eimitaan"></p>
</div>
<br><br><p>Käyttäjätunnus eli sähköpostiosoite: <b style="color: #e608b8">*</b><br><br>

<input type="email"  placeholder="Käyttäjätunnus eli sähköpostiosoite"   id="spostir" name="Sposti" style="width: 60%"></p>';

echo'<div style="color: #e608b8; font-weight: bold; padding: 0px; margin: 0px; display: inline-block" id="divID3">
   <p class="eimitaan"></p>
</div>';

if (!$resultkoulut = $db->query("select distinct * from koulut ORDER BY Nimi ASC")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

echo'<br><br><p>Valitse ensisijainen oppilaitos: <b style="color: #e608b8">*</b>
<br>';
echo'<p style="margin-top: 5px; font-size: 0.7em; font-weight:normal">(Voit myöhemmin liittyä myös muihin oppilaitoksiin.)</p><br>';
echo'<select id="koulu" name="koulu"  onchange="changeFunc();">';
echo' <option value="valitsekoulu" selected>Valitse oppilaitos';

while ($rowko = $resultkoulut->fetch_assoc()) {
    if ($rowko[id] != 19) {
        echo '<option value=' . $rowko[id] . '>' . $rowko[Nimi];
    }
}
echo'</select></p>';

echo'<div style="color: #e608b8; font-weight: bold; padding: 0px; margin: 0px; display: inline-block" id="divID4">
     <p class="eimitaan"></p>
</div>';
echo'<br><br><p><label style="margin:0px; padding:0px; font-weight:bold; font-size: 1em" id="kayttoehdotl"><input onchange="isChecked()" type="checkbox" id="kayttoehdot">&nbsp&nbspHyväksyn <a href="kayttoehdot.php" style="border-bottom:1px solid blue; color: blue;" target="_blank"> käyttöehdot </a><b style="color: #e608b8">*</b></label></p>';
echo'<div style="color: #e608b8; font-weight: bold; padding: 0px; margin: 0px; display: inline-block" id="divID5">
     <p class="eimitaan"></p>
</div>';

echo'<div id="username_availability_result"></div>  
<input type="hidden" id="vali" value="99">
<br><input id="button" type="button" onclick="validateForm4ope()" value="&#10003 Rekisteröidy" ><br><br>
	</fieldset></form>';
echo'</div>';


echo '</div>';
echo '</div>';
include("footer.php");
?>
<script type="text/javascript">
function isChecked() {
     var div5 = document.getElementById("divID5");
    document.getElementById("kayttoehdotl").style.backgroundColor = "white";
        div5.style.padding = "10px 60px 10px 0px";

        div5.innerHTML = "";
}
 </script>
<script type="text/javascript">
$('#etu').on('keyup', function() {
      var div1 = document.getElementById("divID");
    document.getElementById("etu").style.backgroundColor = "white";
        div1.style.padding = "10px 60px 10px 0px";

        div1.innerHTML = "";
});
 </script>
 <script type="text/javascript">
$('#suku').on('keyup', function() {
      var div2 = document.getElementById("divID2");
    document.getElementById("suku").style.backgroundColor = "white";
        div2.style.padding = "10px 60px 10px 0px";

        div2.innerHTML = "";
});
 </script>
 <script type="text/javascript">
$('#spostir').on('keyup', function() {
      var div3 = document.getElementById("divID3");
    document.getElementById("spostir").style.backgroundColor = "white";
        div3.style.padding = "10px 60px 10px 0px";

        div3.innerHTML = "";
});
 </script>
<script type="text/javascript">

   function changeFunc() {
        var div4 = document.getElementById("divID4");
    document.getElementById("koulu").style.backgroundColor = "white";
        div4.style.padding = "10px 60px 10px 0px";

        div4.innerHTML = "";
   }

  </script>
<script>
    var input = document.getElementById("etu");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    var input = document.getElementById("suku");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
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