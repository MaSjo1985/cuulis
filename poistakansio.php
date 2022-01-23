<?php

ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

//poistetaan ensin kaikki kansion tiedostot

    if (!$result6 = $db->query("select distinct * from tiedostot where kansio_id = '" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
 

    while ($rowk = $result6->fetch_assoc()) {

        if (!$result3 = $db->query("select distinct * from tiedostot where kansio_id = '" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
    
        while ($row3 = $result3->fetch_assoc()) {
           
            $nimi3 = $row3[nimi];
            $tuotu = $row3[tuotu];
            $omatallennusnimi = $row3[omatallennusnimi];
            $kuvaus = $row3[kuvaus];
            $linkki = $row3[linkki];
           $tiedostonimi = 'tiedostot/'.$omatallennusnimi;
            if ($tuotu == 0 && $linkki == 0) {
                if (file_exists($tiedostonimi)) {
                    unlink($tiedostonimi);
                }
            }
            if (!$result8 = $db->query("select distinct * from tiedostot where id = '" . $row3[id] . "' AND tuotu=0")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
//jos tiedostoa ei ole tuotu toisesta kurssista/opintojaksosta, niin haetaan onko se viety johonki toiseen, jolloin se pitää poistaa myös siitä kurssista/opintojaksosta JOS SE ON TIEDOSTO EIKÄ LINKKI

            if ($result8->num_rows > 0) {
                if ($linkki == 0) {
                    if (!$result2 = $db->query("select distinct * from tiedostot where nimi = '" . $nimi3 . "' AND tuotu=1 AND linkki=0")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }


                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $db->query("delete from tiedostot where id = '" . $row2[id] . "'");
                        }
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
}
?>