<?php
session_start();
ob_start();
echo'<!DOCTYPE html><html id="kys"> 
<head>
<title> Kysy/kommentoi </title>
<script src="basic-javascript-functions.js" language="javascript" type="text/javascript">
</script>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, minimum-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Playfair+Display+SC:400,700" rel="stylesheet" type="text/css"> <link href="//fonts.googleapis.com/css?family=Questrial" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Actor" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css"> <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css"> <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Neucha" /><link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="ulkoasu.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="favicon.png" type="image/png">

<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
<meta charset="UTF-8">';



        echo'</head>';

        echo'<body>';



        echo'<div class="cm8-container cm8-center" style="margin: 0px 0px 10px 0px; padding-top: 5px; padding-bottom: 20px">';




        echo' 
  <h1 style="margin-bottom: 16px"><a href="etusivu.php" style="font-size: 1em">Cuulis</a>
  <em style="font-size: 0.8em">&nbsp&nbsp&nbsp - &nbsp&nbsp&nbspoppimisympäristö</em></h1>
';

        echo'<div class="cm8-third"><br><br></div>';
        if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[luentoakt];
            $aihe = $rowa[luentoaihe];
            $luentopvm = $rowa[luentopvm];
        }



        echo'<div class="cm8-third" style="font-size: 0.9em">Luennon aihe: &nbsp&nbsp<b>' . $aihe . '</b></div><div class="cm8-third" style="font-size: 0.9em">Päivämäärä: &nbsp&nbsp<b>' . $luentopvm . '</b></div>';



        echo'<div class="cm8-margin-top"></div>';

        echo'<br><br><a href="kysymykset2.php?w1=' . $_GET[w1] . '&w2=' . $_GET[w2] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';

        echo'<h6 style="padding-top:30px">Valitse poistettavat kysymykset/kommentit</h6><br>';


        if ($_GET[kaikki2] == 'joo') {

            if (!$haekysymykset = $db->query("select distinct * from kysymykset where kurssi_id='" . $_SESSION["KurssiId"] . "' order by id desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($haekysymykset->num_rows == 0) {
                echo'<br><em>Ei kysymyksiä</em><br>';
            } else {

                echo'<div class="cm8-responsive cm8-center" style="margin: 0px auto;  max-height: 50%; overflow: auto">';
                echo'<form action="poistakysymyksetvarmistus2.php" method="post">';
                echo'<br><table class="cm8-table4">';



                while ($rowv = $haekysymykset->fetch_assoc()) {

                    echo '<tr><td style="border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowv[id] . ' checked></td><td  style="border: 1px solid grey"><a href="selvitakysyja2.php?kysid=' . $rowv[id] . '&kaid=' . $rowv[kayttaja_id] . '&w1=' . $_GET[w1] . '&w2=' . $_GET[w2] . '">' . $rowv[paiva] . ' ' . $rowv[kello] . ': &nbsp&nbsp&nbsp <b>' . $rowv[sisalto] . '</b></a></td></tr>';
                }

                echo '</table></div>';
                echo'<div class="cm8-responsive cm8-center" style="margin: 0px auto;  max-height: 50%; overflow: auto">';
                echo'<br><table class="cm8-table4">';
                echo '<tr><td><a href="valitsekysymykset.php?w2=' . $_GET[w2] . '&w1=' . $_GET[w1] . '" style="font-weight: normal"> &nbsp&#8679&nbspTyhjennä valinnat</a></td><td></td></tr></table>';
                echo'<br><input type="hidden" name="w2" value=' . $_GET[w2] . '><input type="hidden" name="w1" value=' . $_GET[w1] . '><input type="submit" value="&#10007 Poista valitut kysymykset" class="myButton8"  role="button"  style="padding:2px 4px">
								';
                echo'</form>';
            }
        } else {


            if (!$haekysymykset = $db->query("select distinct * from kysymykset where kurssi_id='" . $_SESSION["KurssiId"] . "' order by id desc")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($haekysymykset->num_rows == 0) {
                echo'<br><em>Ei kysymyksiä</em><br>';
            } else {

                echo'<div class="cm8-responsive cm8-center" style="margin: 0px auto;  max-height: 50%; overflow: auto">';
                echo'<form action="poistakysymyksetvarmistus2.php" method="post">';
                echo'<br><table class="cm8-table4">';



                while ($rowv = $haekysymykset->fetch_assoc()) {

                    echo '<tr><td style="border: 1px solid grey"><input type="checkbox" name="lista[]" value=' . $rowv[id] . '></td><td  style="border: 1px solid grey"><a href="selvitakysyja2.php?kysid=' . $rowv[id] . '&kaid=' . $rowv[kayttaja_id] . '&w1=' . $_GET[w1] . '&w2=' . $_GET[w2] . '">' . $rowv[paiva] . ' ' . $rowv[kello] . ': &nbsp&nbsp&nbsp <b>' . $rowv[sisalto] . '</b></a></td></tr>';
                }

                echo '</table></div>';
                echo'<div class="cm8-responsive cm8-center" style="margin: 0px auto;  max-height: 50%; overflow: auto">';
                echo'<br><table class="cm8-table4">';
                echo '<tr><td><a href="valitsekysymykset.php?kaikki2=joo&w2=' . $_GET[w2] . '&w1=' . $_GET[w1] . '" style="font-weight: normal"> &nbsp&#8679&nbspValitse kaikki</a></td><td></td></tr></table>';
                echo'<br><input type="hidden" name="w2" value=' . $_GET[w2] . '><input type="hidden" name="w1" value=' . $_GET[w1] . '><input type="submit" value="&#10007 Poista valitut kysymykset" class="myButton8"  role="button"  style="padding:2px 4px">
								';
                echo'</form>';
            }
        }


        echo'</div>';
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>

</body>
</html>		