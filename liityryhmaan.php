<?php
session_start(); 



ob_start();



echo'
<html>
 
<head>

<title> Palautukset </title>';

include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!


echo "<div id='teksti'>";

if (isset($_SESSION["Kayttajatunnus"])) {

    if (!$onkoprojekti = $db->query("select * from projektit where id='" . $_GET[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($onkoprojekti->num_rows != 0) {


        if (!$onkosuljettu = $db->query("select distinct lopullinen from ryhmat where id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($row = $onkosuljettu->fetch_assoc()) {
            if ($row[lopullinen] == 0) {

                $db->query("update opiskelijankurssit set ryhma_id='" . $_GET[id] . "' where opiskelija_id = '" . $_SESSION["Id"] . "' AND projekti_id='" . $_GET[pid] . "'");


                //päivitä ryhmäid

                if (!$onkotyo = $db->query("select distinct * from opiskelijan_kurssityot where projekti_id='" . $_GET[pid] . "' AND kayttaja_id='" . $_SESSION[Id] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowtyo = $onkotyo->fetch_assoc()) {

                    $tyoid = $rowtyo[id];
                    $ryhmat2id = $rowtyo[ryhmat2_id];


                    $db->query("update ryhmat2 set ryhma_id='" . $_GET[id] . "' where id = '" . $ryhmat2id . "' AND projekti_id='" . $_GET[pid] . "'");
                }
            }
        }
    }
    header("location: ryhmatyot.php?r=" . $_GET[pid] . '#' . $_GET[id]);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";

include("footer.php");
?>	

