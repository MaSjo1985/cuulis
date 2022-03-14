<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");


    echo'<div class="cm8-half" style="text-align: center; padding-top: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 60px">';



    if (!$projekti = $db->query("select * from projektit where id='" . $_GET[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($rowP = $projekti->fetch_assoc()) {
        $kuvaus = $rowP[kuvaus];
        $pid = $rowP[id];
    }

    if (!$resultonko = $db->query("select distinct * from ryhmatope where projekti_id = '" . $_GET[pid] . "' AND id='" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
     if (!$resultonko2 = $db->query("select distinct * from open_palautustiedosto where projekti_id = '" . $_GET[pid] . "' AND id='" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($resultonko->num_rows == 0 && $resultonko2 -> num_rows==0) {
        echo'<br><br><b style="font-size: 1em; color: #FF0000">Tällaista tiedostoa ei ole olemassa!<br><br>Voit ottaa yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div>';
    } else {

        if (!$result = $db->query("select distinct * from open_palautustiedosto where id = '" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($result->num_rows == 0) {
            if (!$result = $db->query("select distinct * from ryhmatope where id = '" . $_GET[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $automaattinen = 0;
            while ($row = $result->fetch_assoc()) {
                $nimi = $row[tallennettunimi];
                $vanhanimi = $row[omatallennusnimi];
                $ryhmaid = $row[ryhma_id];
            }
        } else {
            $automaattinen = 1;
            while ($row = $result->fetch_assoc()) {
                $nimi = $row[tallennettunimi];
                $vanhanimi = $row[omatallennusnimi];
            }
        }




        $oikeus = 0;

        if ($_SESSION[Rooli] == 'admin') {
            $oikeus = 1;
        } else {

            if (!$haekurssi = $db->query("select distinct kurssit.id as kuid, koulut.id as koid from koulut, kurssit, opiskelijankurssit where koulut.id=kurssit.koulu_id AND opiskelijankurssit.projekti_id='" . $pid . "' AND opiskelijankurssit.kurssi_id=kurssit.id")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($row = $haekurssi->fetch_assoc()) {
                $kurssi = $row[kuid];
                 $koulu = $row[koid];
            }
            if ($_SESSION[Rooli] == 'opeadmin') {
                if (!$onkooikeus2 = $db->query("select distinct * from koulunadminit where koulu_id='" . $koulu . "' AND kayttaja_id = '" . $_SESSION[Id] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                if ($onkooikeus2->num_rows != 0) {

                    $oikeus = 1;
                }
            } else {

                if ($automaattinen == 0 && $_SESSION[Rooli] == 'opiskelija') {
                    if (!$onkooikeus = $db->query("select distinct * from opiskelijankurssit where opiskelija_id = '" . $_SESSION[Id] . "' AND ryhma_id='" . $ryhmaid . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                } else {
                    if (!$onkooikeus = $db->query("select distinct * from kurssit, opiskelijankurssit where kurssit.id=opiskelijankurssit.kurssi_id AND kurssit.id = '" . $kurssi . "' AND (kurssit.opettaja_id='" . $_SESSION[Id] . "' OR opiskelijankurssit.opiskelija_id='" . $_SESSION[Id] . "')")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                }
                if ($onkooikeus->num_rows != 0) {

                    $oikeus = 1;
                }
            }
        }


        if ($oikeus == 0) {
            echo'<br><br><b style="font-size: 1em; color: #FF0000">Sinulla ei ole oikeutta tähän resurssiin!</b><br><br></div></div>';
        } else {
            if (file_exists($nimi)) {

                header('location: /' . $nimi);
            } else {
                echo'<br><br><b style="font-size: 1em; color: #FF0000">Tiedostoa ei löytynyt!<br><br>Voit ottaa yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div>';
            }
        }
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";
echo "</div>";

include("footer.php");
?>

</body>
</html>