<?php
session_start();
echo'
<html>
<head>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
include("header.php");
echo "<div id='teksti'>";

if (isset($_SESSION["Kayttajatunnus"])) {
    if (!$result = $db->query("select nimi from ryhmat where id = '" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row2 = $result->fetch_assoc()) {
        $nimi = $row2[nimi];
        $id = $row2[id];
    }
    echo("Olet aikeissa sulkea ryhmän " . $nimi . ". Oletko varma?");

    echo '<br><br><a href="suljeryhma.php?id=' . $_GET[id] . '">Kyllä</a><br>';
    echo '<br><a href="kurssi.php">Ei</a><br>';
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