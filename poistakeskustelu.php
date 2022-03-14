<?php
session_start(); 


ob_start();

echo'<html> 
<head>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    $db->query("delete from kurssin_keskustelut where id ='" . $_GET[r] . "'");

    if (!$haekesk = $db->query("select distinct id from keskustelut where kurssin_keskustelut_id = '" . $_GET[r] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowkesk = $haekesk->fetch_assoc()) {
        $id = $rowkesk[id];
        $db->query("delete from kayttajan_tykkaykset where keskustelut_id ='" . $id . "'");
        $db->query("delete from keskustelut where id = '" . $id . "'");
    }


    if (!$haeonko = $db->query("select distinct id from kurssin_keskustelut where kurssi_id = '" . $_SESSION[KurssiId] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($haeonko->num_rows == 0) {
        $db->query("update kurssit set keskakt=0 where id = '" . $_SESSION[KurssiId] . "'");
    }

    header("location: keskustelut.php");
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

</body>
</html>