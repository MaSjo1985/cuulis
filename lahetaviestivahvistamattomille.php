<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Viestin lähetys </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {

    echo'<div class="cm8-container7">';
    if ($_SESSION["Rooli"] == 'admin')
        include("adminnavi.php");
    else if ($_SESSION["Rooli"] == 'admink')
        include("adminknavi.php");
    else if ($_SESSION["Rooli"] == 'opeadmin')
        include("opeadminnavi.php");
    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
    echo'<div class="cm8-margin-top"></div>';

    $nimi = strip_tags($_POST[nimi]);
    $email = strip_tags($_POST[sposti]);


    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
    $headers .= "From: " . $nimi . " <" . $email . ">\r\n";

    $otsikko = "Viesti Cuulis-oppimisympäristöstä";
    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

    if ($_SESSION["Rooli"] == "admin") {
        if (!$result = $db->query("select distinct kayttajat.id as kaid, etunimi, sukunimi,Nimi,rooli, sposti from kayttajat, kayttajankoulut, koulut where (kayttajat.vahvistettu=0 AND kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id) OR (kayttajat.id='" . $_SESSION["Id"] . "')")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
    }
    if ($_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        if (!$result = $db->query("select distinct kayttajat.id as kaid, etunimi, sukunimi,Nimi,rooli, sposti from kayttajat, kayttajankoulut, koulut where (kayttajankoulut.koulu_id='" . $_SESSION["kouluId"] . "' AND kayttajat.vahvistettu=0 AND kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id) OR (kayttajat.id='" . $_SESSION["Id"] . "')")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
    }

    while ($row = $result->fetch_assoc()) {
        $sposti = $row[sposti];


        if ($sposti != null) {
            $viesti = $_POST[viesti];
            $viesti = str_replace("\n.", "\n..", $viesti);

            $viesti = nl2br($viesti);
            $viesti = mail($sposti, $otsikko, $viesti, $headers);
        }
    }

    if ($viesti) {
        header("location: lahetaviestivahvistamattomille2.php");
    } else {
        echo "<br>Viestin lähettäminen ei onnistunut. Yritä uudelleen!";
        echo '<br><br><a href="kayttajatviesti.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
    }


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