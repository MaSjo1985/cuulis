<?php
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Viesti ylläpitäjälle </title>';
include("yhteys.php");

echo'
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0"><link rel="stylesheet" href="css/TimeCircles.css" />
<link href="https://fonts.googleapis.com/css?family=Playfair+Display+SC:400,700" rel="stylesheet" type="text/css"> <link href="//fonts.googleapis.com/css?family=Questrial" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Actor" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css"> <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Neucha" /><link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="ulkoasu.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="favicon.png" type="image/png">

<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
<meta charset="UTF-8">

</head>

<body>';

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

echo'<div class="cm8-container7">';
echo'<div class="cm8-margin-bottom" style="margin-top: 40px; padding-left: 20px">';

if (empty($_POST[viesti])) {
    echo'<p style="color: red">Et voi lähettää tyhjää viestiä!</p>';

    echo'<a href="palaute.php"><p style="font-size: 1em; display: inline-block;">&#8630 &nbsp&nbsp&nbsp</p> Palaa takaisin</a>';
} else {
    if (filter_var($_POST[sposti], FILTER_VALIDATE_EMAIL)) {

        $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

        function poista_rivinvaihdot($teksti) {
            return str_replace(array("\r", "\n"), "", $teksti);
        }

        $nimi = poista_rivinvaihdot($_POST[Nimi]);
        $email = poista_rivinvaihdot($_POST[sposti]);

        $headers .= "From: " . $nimi . " <" . $email . ">\r\n";


        $otsikko = "Viesti Cuulis-oppimisympäristöstä";
        $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";



        foreach ($_POST as $nimi => $arvo) {
            $palaute .= $nimi . ": " . $arvo . "\n\n";
        }

        if (!$result = $db->query('select sposti from kayttajat where rooli="admin"')) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row = $result->fetch_assoc()) {
            $sposti = $row[sposti];
        }

        $palaute = str_replace("\n.", "\n..", $palaute);

        $palaute = nl2br($palaute);




        $viesti = mail($sposti, $otsikko, $palaute, $headers);










        if ($viesti) {
            header("location: lahetapalaute2.php");
        } else {
            echo "<br>Viestin lähettäminen ei onnistunut. Yritä uudelleen!";
            echo '<br><br><a href="palaute.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin viestin lähettämiseen</a>';
        }
    } else {
        echo'<p style="color: red">Sähköpostiosoite ei ole kelvollinen!</p>';

        echo'<a href="palaute.php"><p style="font-size: 1em; display: inline-block;">&#8630 &nbsp&nbsp&nbsp</p> Palaa takaisin</a>';
    }
}


echo "</div>";
echo "</div>";

include("footer.php");
?>
</body>
