<?php
session_start();
ob_start();
ob_start();
echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!$result = $db->query("select distinct ryhma_id as ryid from ryhmat2 where id='" . $_POST[tyoid] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}


while ($row = $result->fetch_assoc()) {


    $ryid = $row[ryid];
}
if (isset($_SESSION["Kayttajatunnus"])) {
    if (!empty($_POST[palaute])) {


        $stmt = $db->prepare("UPDATE ryhmat2 SET palaute = ?, palaute_tallennettu = ? WHERE id = ?");
        $stmt->bind_param("sii", $kommentti2, $tall, $id4);

        $tall = 1;
        $kommentti = $_POST[palaute];
        $kommentti = nl2br($kommentti);

        $kommentti2 = $kommentti;
        $id4 = $_POST[tyoid];

        $stmt->execute();


        $stmt->close();
    }



    header("location: ryhmatyot.php?r=" . $_POST[pid] . "#" . $ryid);
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