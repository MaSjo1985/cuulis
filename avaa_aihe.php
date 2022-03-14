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

    $db->query("update itsetehtavat set aihekiinni=0, sulkeutuu='' where id='" . $_POST[tid] . "'");
    if (!$haejarjestys = $db->query("select distinct jarjestys from itsetehtavat where id='" . $_POST[tid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowj = $haejarjestys->fetch_assoc()) {
        $jarjestys = $rowj[jarjestys];
    }
    $valmis = 0;
    $seuraava = $jarjestys + 1;
    while ($valmis == 0) {
        if (!$haeseuraava = $db->query("select distinct aihe, id from itsetehtavat where itseprojektit_id='" . $_POST[id] . "' AND jarjestys='" . $seuraava . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rows = $haeseuraava->fetch_assoc()) {
            $onkoaihe = $rows[aihe];
            $id = $rows[id];
        }
        if ($onkoaihe != 1) {
            $db->query("update itsetehtavat set aihekiinni=0 where id='" . $id . "'");
            $seuraava++;
        } else {
            $valmis = 1;
        }
    }
    if (!$haejarjestys = $db->query("select distinct jarjestys from itsetehtavat where id='" . $_POST[tid] . "' AND itseprojektit_id='" . $_POST[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowj = $haejarjestys->fetch_assoc()) {

        $jarjestys = $rowj[jarjestys];
    }
    if (!$haeseuraava = $db->query("select distinct id as tid from itsetehtavat where jarjestys=('" . $jarjestys . "' - 3) AND itseprojektit_id='" . $_POST[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowm = $haeseuraava->fetch_assoc()) {

        $minne2 = $rowm[tid];
    }


    header('location: itsetyot.php?i=' . $_POST[id] . '#' . $_POST[tid]);
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