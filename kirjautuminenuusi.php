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
<title>Kirjautuminen</title>
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

  <body onload="lataa()">';
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
echo'<div class="cm8-container" style="padding-top: 5px; padding-bottom: 5px;padding-left: 20px;">';
echo'<div class="cm8-half" style="padding: 0px; margin:0px">';
echo'<h1 style="padding-bottom: 0px; display: inline-block;" ><a href="etusivu.php">Cuulis</h1>
  <b style="font-size: 0.8em; display: inline-block">&nbsp - &nbspoppimisympäristö</b></a>';

echo'</div>';


//echo'<a href="Tietoa Cuulis-oppimisympäristöstä.pdf" target="_blank" class="cm8-linkk3" title="Tietoa"  style="visibility: hidden; width: 0%; margin-right: 0px">Mikä on Cuulis? 
// </a>';
echo'<div class="cm8-half" style="padding: 5px 0px 0px 0px; margin:0px;">';
echo'<p style="margin-top: 0px;display: inline-block; padding-top: 0px; padding-left: 0px; padding-bottom: 0px; margin-bottom: 0px" id="stars"><select id="example">

<option style="display: inline-block" id="taa" value="1">1</option>
  <option style="display: inline-block" value="2">2</option>
  <option style="display: inline-block" value="3">3</option>
  <option style="display: inline-block" value="4">4</option>
  <option style="display: inline-block" value="5">5</option>
</select></p>';


echo'<div style="display: inline-block; margin-left: 20px; font-size: 0.7em" id="keski" ></div>';
echo'<div id="stars2" style="padding: 0px; margin: 0px; display: inline-block; margin-left: 30px; font-size: 0.7em;  font-style: italic" ></div>';

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

echo '<div class="cm8-container7"  style="padding-left: 20px; padding-top:40px; padding-right: 20px" >';



echo
'<form name="Form" id="myForm" id="Form" onSubmit="return validateForm5uusi()" action="tarkistusuusi.php" method="post" class="form-style-p" style="max-width: 500px" ><fieldset>
<legend>Kirjaudu sisään:</legend>   

<br><input type="text"  id="sposti" placeholder="Käyttäjätunnus" name="Sposti" autofocus>
<div style="color: #e608b8; font-weight: bold; padding: 0px" id="divID">
    <p class="eimitaan"></p>
</div>

<br><br><input type="password"  id="salasana" name="Salasana" placeholder="Salasana">

  
  <span id="show" class="fa fa-eye-slash" title="Näytä salasana"> </span>
<p id="text" class="eimitaan">Caps lock on päällä!</p>
<div style="color: #e608b8; font-weight: bold; padding: 0px" id="divID2">
    <p class="eimitaan"></p>
</div>';

if (isset($_GET[url])) {
    echo'<input type="hidden" value=' . $_GET[url] . ' name="url">';
}
echo'<br><br><input id="button" type="button" onclick="validateForm5uusi()" value="&#10003 &nbsp Kirjaudu" ><br>


<br><a href="tunnustenkyselyuusieka.php" style="font-weight: bold" >Onko käyttäjätunnus tai salasana unohtunut?</a>

<br><a href="rekisteroityminenuusi.php" style="font-weight: bold" >Uusi käyttäjä? &nbsp&nbsp Rekisteröidy tästä &nbsp &#8618;</a>
</fieldset>
</form>';


echo'<div class="cm8-margin-top"></div>';
echo '
</div></div>';


include("footer.php");
?>
<script type="text/javascript">
$('#sposti').on('keyup', function() {
      var div1 = document.getElementById("divID");
    document.getElementById("sposti").style.backgroundColor = "white";
        div1.style.padding = "10px 60px 10px 0px";

        div1.innerHTML = "";
});
 </script>
 <script type="text/javascript">
$('#salasana').on('keyup', function() {
      var div1 = document.getElementById("divID2");
    document.getElementById("salasana").style.backgroundColor = "white";
        div1.style.padding = "10px 60px 10px 0px";

        div1.innerHTML = "";
});
 </script>
<script>
    var input = document.getElementById("salasana");
    var text = document.getElementById("text");
    input.addEventListener("keyup", function (event) {

        if (event.getModifierState("CapsLock")) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    });
</script>
<script>
    $(function () {

        $("#show").on("click", function () {
            var x = $("#salasana");
            if (x.attr('type') === "password") {
                x.attr('type', 'text');
                $(this).removeClass('fa fa-eye-slash');
                document.getElementById('show').setAttribute('title', 'Piilota salasana');
                $(this).addClass('fa fa-eye');
            } else {
                x.attr('type', 'password');
                $(this).removeClass('fa fa-eye');
                $(this).addClass('fa fa-eye-slash');
                document.getElementById('show').setAttribute('title', 'Näytä salasana');
            } // End of if
        })// End of click event

    });
</script>
<script>
    var input = document.getElementById("sposti");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
<script>
    var input = document.getElementById("salasana");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button").click();
        }
    });
</script>
</body>


</html>
