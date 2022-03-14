<?php
session_start(); 



ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

//poistetaan ensin kaikki kansion tiedostot

    if (!$result6 = $db->query("select distinct * from tiedostot where kansio_id = '" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
 

    while ($rowk = $result6->fetch_assoc()) {

        if (!$result3 = $db->query("select distinct * from tiedostot where kansio_id = '" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
    
        while ($row3 = $result3->fetch_assoc()) {
           
            $nimi = $row3[nimi];
            $tuotu = $row3[tuotu];
            $omatallennusnimi = $row3[omatallennusnimi];
            $kuvaus = $row3[kuvaus];
            $linkki = $row3[linkki];
             if ($linkki == 0) {
        if (!$resultmuut = $db->query("select distinct * from tiedostot where kansio_id <> '" . $_GET[id] . "' AND nimi='" . $nimi . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($resultmuut->num_rows == 0) {

            if (file_exists($nimi)) {
                unlink($nimi);
            }
        }
    }
 


            $db->query("delete from tiedostot where id = '" . $row3[id] . "'");
        }
    }
//sitten poistetaan kansio
 $db->query("delete from kansiot where id = '" . $_GET[id] . "'");


    header('location: tiedostot.php');
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>