<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Ylläpitäjän poisto</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");
    echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px;">';
    if ($_SESSION["Rooli"] == 'admin') {
        include("adminnavi.php");
    } else if ($_SESSION["Rooli"] == 'admink') {
        include("etuosan_navit.php");
        tuoAdminkNavi("Oma oppilaitos");
    } else if ($_SESSION["Rooli"] == 'opeadmin') {
        include("etuosan_navit.php");
        tuoOpeadminNavi("Oma oppilaitos");
    }



    echo'</div>';








    echo'<div class="cm8-container3" style="padding-top: 30px;">';



    if (!$result31 = $db->query("select distinct * from koulut where id = '" . $_GET[koid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row31 = $result31->fetch_assoc()) {
        $nimi = $row31[Nimi];
        echo '<header><div class="cm8-quarter"><p style="font-size: 1.2em; font-weight: bold; padding-top: 20px" >' . $row31[Nimi] . '</p></div><div class="cm8-quarter"><img src="/' . $row31[kuva] . '" style="height: 60px; weight:30px"></div> <div class="cm8-quarter"><br></div><div class="cm8-quarter"><br></div></h4></header></div>';
    }

    echo'<div class="cm8-margin-left cm8-margin-bottom" style="margin-top: 10px">';



    if (!$tulos4 = $db->query("select distinct * from kayttajat where id='" . $_GET[kaid] . "'")) {
        die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
    }

    while ($rivi2 = $tulos4->fetch_assoc()) {
        $sposti = $rivi2[sposti];
    }

    $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

    $otsikko = "Sinut on poistettu ylläpitäjän roolista";
    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

    $viesti = 'Sinut on poistettu oppilaitoksen ' . $nimi . ' ylläpitäjän roolista Cuulis-oppimisympäristössä.<br><br>Pääset Cuulis-oppimisympäristöön suoraan <a href="https://cuulis.cm8solutions.fi/">tästä.</a><br><br><em>Tähän viestiin ei voi vastata.</em>';
    $viesti = str_replace("\n.", "\n..", $viesti);

    $body = '<html><body>';


    $body .= '<p>' . $viesti . '</p>';
    $body .= "</body></html>";


    $varmistus = mail($sposti, $otsikko, $body, $headers);





    $db->query("delete from koulunadminit where kayttaja_id = '" . $_GET[kaid] . "' AND koulu_id='" . $_GET[koid] . "'");




    header("location: muokkaakoulu.php?id=" . $_GET[koid]);
    echo'</div>';
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
