<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Lisää linkki </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");
    echo'<div class="cm8-container7">';

    include("opnavi.php");

    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
    echo'<div class="cm8-margin-top"></div>';

    if (isset($_POST[mika]) && $_POST[mika] == 'upotus') {
        $db->query("insert into linkit (kuvaus, osoite, kurssi_id, upotus) values('" . $_POST[kuvaus] . "', '" . $_POST[osoite] . "','" . $_SESSION[KurssiId] . "', 1)");
    } else if (isset($_POST[mika]) && $_POST[mika] == 'youtube') {

        //etsitään varsinainen osoite
        $mystring = $_POST[osoite];
        $findme = 'src="';

        $pos = strpos($mystring, $findme);
        echo'eka:' . $pos;

        $pos2 = strpos($mystring, '"', $pos + 5);
        echo'toka:' . $pos2;
        $length = ($pos2) - ($pos + 5);
        echo'pituus:' . $length;
        $hae = substr($mystring, $pos + 5, $length);



        $db->query("insert into linkit (kuvaus, osoite, kurssi_id, youtube) values('" . $_POST[kuvaus] . "', '" . $hae . "','" . $_SESSION[KurssiId] . "', 1)");
    } else {
        $db->query("insert into linkit (kuvaus, osoite, kurssi_id) values('" . $_POST[kuvaus] . "', '" . $_POST[osoite] . "','" . $_SESSION[KurssiId] . "')");
    }

    header("location: linkit.php");


    echo'</div>';
    echo'</div>';

    include("footer.php");
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
</html>	

