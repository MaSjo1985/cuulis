<?php
session_start();
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Muokkaa oppilaitosta </title>';


include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");

    echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px;">';
    if ($_SESSION["Rooli"] == 'admin') {
        include("etuosan_navit.php");
        tuoAdminNavi("Oma oppilaitos");
    } else if ($_SESSION["Rooli"] == 'admink') {
        include("etuosan_navit.php");
        tuoAdminkNavi("Oma oppilaitos");
    } else if ($_SESSION["Rooli"] == 'opeadmin') {
        include("etuosan_navit.php");
        tuoOpeadminNavi("Oma oppilaitos");
    }

    echo'</div>';








    echo'<div class="cm8-container3" style="padding-top: 30px;">';

    $required = array('uusinimi');

    $error = false;

    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $error = true;
        }
    }

    if ($error) {
        echo "<br>Et voi antaa tyhjää kenttää!";

        echo '<br><br><a href="muokkaakoulu.php?id=' . $_POST[id] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
    } else {
        echo "<br>Oppilaitoksen nimi muutettu onnistuneesti!<br><br>";
        $db->query("update koulut set Nimi='" . $_POST[uusinimi] . "' where id = '" . $_POST[id] . "'");

        echo '<a href="muokkaakoulu.php?id=' . $_POST[id] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
    }
    echo "</div>";
    echo "</div>";
    echo "</div>";
    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
}
?>
</body>
</html>	