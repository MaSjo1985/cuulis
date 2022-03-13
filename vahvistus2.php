<?php
session_start();
ob_start();

echo'
<!DOCTYPE html>
<html>
 
<head>';

if($_GET[admin]==1){
    echo'<title> Salasana on vaihdettu </title>';
}
else{
    echo'<title> Rekisteröityminen on  vahvistettu</title>';
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

echo'<div class="cm8-container7" style="padding-top: 30px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 60px; ">';


echo'<div class="cm8-half" style="margin-left: 0px; padding-left: 20px; padding-top: 20px; margin-top: 0px">';

       // ready to go!
      
          if(isset($_POST[Sposti])){
            $siivottusposti = mysqli_real_escape_string($db, $_POST[Sposti]);
    $siivottusalasana = mysqli_real_escape_string($db, $_POST[Salasana]);
    $salt = "8CMr85";
    $krypattu = md5($salt . $siivottusalasana);

    $stmt = $db->prepare("SELECT DISTINCT rooli, sposti, etunimi, sukunimi, id, paiva, kello, vahvistettu, tarkistettu, yritykset, nollattu, kayttoehdot_hyvaksytty, uusitunnus FROM kayttajat WHERE BINARY sposti=? AND BINARY salasana=?");
    $stmt->bind_param("ss", $sposti2, $salasana);
// prepare and bind
    $sposti2 = $siivottusposti;
    $salasana = $krypattu;
    }
    else if(isset($_GET[id])){
   

    $stmt = $db->prepare("SELECT DISTINCT rooli, sposti, etunimi, sukunimi, id, paiva, kello, vahvistettu, tarkistettu, yritykset, nollattu, kayttoehdot_hyvaksytty, uusitunnus FROM kayttajat WHERE BINARY id=?");
    $stmt->bind_param("i", $id);
// prepare and bind
    $id=$_GET[id];
    }



    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($col1, $col2, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14);



        while ($stmt->fetch()) {
            $rooli = $col1;
            $sposti = $col2;

            $etunimi = $col4;
            $sukunimi = $col5;
            $id = $col6;
            $paiva = $col7;
            $kello = $col8;
            $vahvistettu = $col9;
            $tarkistettu = $col10;
            $yritykset = $col11;
             $nollattu = $col12; 
             $kayttoehdot = $col13;
              $uusitunnus = $col14;
             
             
        }
         $stmt->close();
            if ($paiva != "0000-00-00" || $paiva != null) {
                $paiva = date("d.m.Y", strtotime($paiva));
                $_SESSION["Viimepaiva"] = $paiva;
            } else {
                $_SESSION["Viimepaiva"] = "";
            }

            $_SESSION["Viimekello"] = $kello;

            $db->query("update kayttajat set paiva='" . date("Y-m-d") . "' where id='" . $id . "'");
            $db->query("update kayttajat set yritykset=0 where id='" . $id . "'");
            $db->query("update kayttajat set kello='" . date("H:i:s") . "' where id='" . $id . "'");

            $_SESSION["Sposti"] = $sposti;

            $_SESSION["Rooli"] = $rooli;
            $_SESSION["Ekakerta"] = $ekakerta;
            $_SESSION["Etunimi"] = $etunimi;
            $_SESSION["Sukunimi"] = $sukunimi;
            $_SESSION["Id"] = $id;
            $_SESSION["Kayttajatunnus"] = $sposti;
            $_SESSION["Salasana"] = $krypattu;


            if($_GET[admin]==1){
               if (!$result = $db->query("select distinct koulut.Nimi as koulu from kayttajat, kayttajankoulut, koulut where koulut.id=kayttajankoulut.koulu_id AND kayttajat.id=kayttajankoulut.kayttaja_id AND kayttajat.id='" . $_SESSION[Id] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
while ($row = $result->fetch_assoc()) {
 
     $koulu = $row[koulu];
}


echo '<p style="font-size:1.2em;  color: #e608b8; font-weight: bold">Sinut on nyt lisätty Cuulis-oppimisympäristöön seuraavilla tiedoilla: </p>';
                echo '<br><b>Etunimi:  &nbsp&nbsp&nbsp</b>'.$etunimi;
                echo '<br><br><b>Sukunimi: &nbsp&nbsp&nbsp</b>'.$sukunimi;
                echo '<br><br><b>Käyttäjätunnus:&nbsp&nbsp&nbsp </b>'.$sposti;
                echo '<br><br><b>Ensisijainen oppilaitos: &nbsp&nbsp&nbsp</b>'.$koulu;
                echo '<br><br><b>Rooli:&nbsp&nbsp&nbsp </b> Opiskelija';
                
               echo '<br><br><br><b><a href="etusivu.php">Jatka Cuulis-oppimisympäristöön  tästä &nbsp&nbsp<p style="font-size: 1.2em; display: inline-block; padding:0; margin: 0">&#8631</p></b> </a></b>';
 
            }
            else{
                if (!$result = $db->query("select distinct koulut.Nimi as koulu from kayttajat, kayttajankoulut, koulut where koulut.id=kayttajankoulut.koulu_id AND kayttajat.id=kayttajankoulut.kayttaja_id AND kayttajat.id='" . $_SESSION[Id] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
while ($row = $result->fetch_assoc()) {
 
     $koulu = $row[koulu];
}
echo '<p style="font-size:1.2em;  color: #e608b8; font-weight: bold">Olet nyt rekisteröitynyt Cuulis-oppimisympäristöön seuraavilla tiedoilla: </p>';
                echo '<br><b>Etunimi:  &nbsp&nbsp&nbsp</b>'.$etunimi;
                echo '<br><br><b>Sukunimi: &nbsp&nbsp&nbsp</b>'.$sukunimi;
                echo '<br><br><b>Käyttäjätunnus:&nbsp&nbsp&nbsp </b>'.$sposti;
                echo '<br><br><b>Ensisijainen oppilaitos: &nbsp&nbsp&nbsp</b>'.$koulu;
                echo '<br><br><b>Rooli:&nbsp&nbsp&nbsp </b> Opiskelija';
                
               echo '<br><br><br><b><a href="etusivu.php">Jatka Cuulis-oppimisympäristöön  tästä &nbsp&nbsp<p style="font-size: 1.2em; display: inline-block; padding:0; margin: 0">&#8631</p></b> </a></b>';
 
            

            }



echo '</div>';
echo '</div>';


echo '</div>';

include("footer.php");
?>	

</body>
</html>	