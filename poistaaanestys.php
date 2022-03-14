<?php
session_start(); 


ob_start();

echo'<html> 
<head>';


include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

include("header.php");
echo "<div id='teksti'>";

if (isset($_SESSION["Kayttajatunnus"])) {

    if (!$result4 = $db->query("select distinct * from aanestykset where id = '" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row4 = $result4->fetch_assoc()) {
        $aanestysid = $row4[id];
        $db->query("delete from aanestysvaihtoehdot where aanestys_id = '" . $aanestysid . "'");
        $db->query("delete from aanestysvastaukset where aanestys_id = '" . $aanestysid . "'");
    }

    $db->query("delete from aanestykset where id = '" . $aanestysid . "'");




    header("location: aanestykset.php");
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