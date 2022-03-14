<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html id="kys"> 
<head>
<title> Kysy/kommentoi </title>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
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

    echo'<body onload="startLoad()">';

    if (isset($_GET["w1"]) && isset($_GET["w2"])) {

        $hello = $_GET["w1"];
        $world = $_GET["w2"];
    }

    echo'<div class="cm8-container cm8-center" style="margin: 0px 0px 10px 0px; padding-top: 5px; padding-bottom: 20px; height: ' . $hello . 'px">';


    $_SESSION[w1] = $_GET["w1"];
    $_SESSION[w2] = $_GET["w2"];

    echo'<div class="cm8-third"><br></div>';

    echo'<div class="cm8-third">';
    echo'<h1 style="margin-bottom: 16px"><a href="etusivu.php" style="font-size: 1em">Cuulis</a>
  <em style="font-size: 0.8em">&nbsp&nbsp&nbsp - &nbsp&nbsp&nbspoppimisympäristö</em></h1></div>';

    echo'<div class="cm8-third"><a class="myButton9" style="font-size: 1.1em; text-align: center;color: #2b6777; border-radius: 25px; padding: 2px 6px"  onclick="closeWin()" title="Sulje kysymyssivu">&#10005</a><br><br></div>';
    ?>




    <script language="javascript">



        function closeWin() {
            window.close();
        }
    </script>





    <?php
session_start(); 


    ob_start();

    echo'<div class="cm8-margin-top"></div>';
    echo'<div class="cm8-third"><br></div>';
    if (!$haeakt = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowa = $haeakt->fetch_assoc()) {
        $akt = $rowa[luentoakt];
        $aihe = $rowa[luentoaihe];
        $luentopvm = $rowa[luentopvm];
    }



    echo'<div class="cm8-third" style="font-size: 0.9em">&nbsp&nbsp</div><div class="cm8-third" style="font-size: 0.9em"> &nbsp&nbsp</div>';





    if ($_SESSION["Rooli"] == 'opiskelija') {
        echo'<div class="cm8-margin-top"></div>';
        echo'<h6 style="padding-top: 20px">Kysymykset/kommentit</h6>';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[kysakt];
        }



        if ($akt == 0) {

            echo'<br><br><em>Toimintoa ei ole aktivoitu.</em><br>';
        } else {
//            if (!$haekysymykset = $db->query("select distinct * from kysymykset where kurssi_id='" . $_SESSION["KurssiId"] . "' order by id desc")) {
//                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//            }
//
//
//            if ($haekysymykset->num_rows == 0) {
//                echo'<br><br><em>Ei kysymyksiä</em><br><br>';
//            } else {
            echo'<br><em style="font-size: 0.8em; float: center">Kaikki kysymykset/kommentit lähetetään anonyymisti. Vain opettaja saa halutessaan tiedon lähettäjästä.';
            echo'<br></em>';

            echo'<div id="chatlogs">';

            echo'</div>';


            $paiva = date("j.n.Y");
            $kello = date("H:i:s");

            echo'<div style="width: 50%; margin: 0 auto">';
            echo'<form name="form1" style="text-align: center">';
            echo'<br><b>Kysy/kommentoi:</b><br><textarea id="sendie" name="uusi" rows="4" cols="5" maxlength="255" style="overflow: auto"></textarea>';
            echo'<input type="hidden" name="paiva" value=' . $paiva . '>
					<input type="hidden" name="kello" value=' . $kello . '>
										<input type="hidden" name="kuid" value=' . $_SESSION["KurssiId"] . '>
															<input type="hidden" name="kaid" value=' . $_SESSION["Id"] . '>';





            echo'<div id="akt"></div>';
        }
    } else {

        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {
            $akt = $rowa[kysakt];
        }
        if ($akt == 0) {
            echo'<div class="cm8-margin-top"></div>';
            echo'<h6 style="padding-top: 20px">Kysymykset/kommentit</h6>';
            echo'<br><br><em>Toimintoa ei ole aktivoitu.</em><br><form action="aktivoikysymykset.php" method="post"><br><br><input type="hidden" name="w2" value=' . $_GET[w2] . '><input type="hidden" name="w1" value=' . $_GET[w1] . '><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikea" value="Aktivoi toiminto" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 1.1em"></form>';
        } else {

            echo'<div class="cm8-margin-top"></div>';
            echo'<h6 style="padding-top: 10px; display: inline-block">Kysymykset/kommentit</h6>';
            echo'<form action="piilotakysymykset.php" method="post" style="display: inline-block; margin-left: 20px"><br><br><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" value="Piilota toiminto" onClick="haeAkt2()" class="myButton8"  role="button"  style="padding:2px 4px"></form>';




//            if ($haekysymykset->num_rows == 0) {
//                echo'<br><br><em>Ei kysymyksiä</em><br><br>';
//            } else {









            echo'<div id="chatlogs"></div>';
//            }

            $paiva = date("j.n.Y");
            $kello = date("H:i:s");

            echo'<div style="width: 50%; margin: 0 auto">';
            echo'<form name="form1" style="text-align: center">';
            echo'<br><b>Kysy/kommentoi:</b><br><textarea id="sendie" name="uusi" rows="4" cols="5" maxlength="255" style="overflow: auto"></textarea>';
            echo'<input type="hidden" name="paiva" value=' . $paiva . '>
					<input type="hidden" name="kello" value=' . $kello . '>
										<input type="hidden" name="kuid" value=' . $_SESSION["KurssiId"] . '>
															<input type="hidden" name="kaid" value=' . $_SESSION["Id"] . '>';



            echo'<div id="akt"></div>';
        }
    }

    echo'</div>';
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