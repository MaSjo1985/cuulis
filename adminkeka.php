<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Etusivu </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {



    if (!$result31 = $db->query("select distinct * from koulut where id = '" . $_GET[koid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row31 = $result31->fetch_assoc()) {
        $kouluid = $row31[id];
    }

    $_SESSION["kouluId"] = $kouluid;


    if (isset($_GET[url])) {
        //JOS MUU-KÄYTTÄJÄ
        if ($_SESSION["Rooli"] == 'muu') {


            $_SESSION["Rooli"] = 'admink';
            header("location: " . $_GET[url]);
        }

        //JOS OPETTAJA
        else if ($_SESSION["Rooli"] == 'opettaja') {


            $_SESSION["Rooli"] = 'opeadmin';
            if ($_GET[url] == 'etusivu.php') {
                header("location: omatkurssit.php");
            } else
                header("location: " . $_GET[url]);
        }
    } else {

        //JOS MUU-KÄYTTÄJÄ
        if ($_SESSION["Rooli"] == 'muu') {

            $_SESSION["Rooli"] = 'admink';
            header("location: admink.php");
        }

        //JOS OPETTAJA
        else if ($_SESSION["Rooli"] == 'opettaja') {


            $_SESSION["Rooli"] = 'opeadmin';
            header("location: omatkurssit.php");
        }
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