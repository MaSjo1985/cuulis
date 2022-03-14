<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Äänestä </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {



    $lista = $_POST["nimi"];


    if (!$haeakt = $db->query("select distinct * from aanestykset where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowa = $haeakt->fetch_assoc()) {
        $aanid = $rowa[id];
    }

    $stmt = $db->prepare("INSERT INTO aanestysvaihtoehdot (aanestys_id, nimi) VALUES (?, ?)");
    $stmt->bind_param("is", $aanestys, $nimi);
    // prepare and bind





    foreach ($lista as $tuote) {
        echo '<br>' . $tuote;
        $nimi = $tuote;
        $aanestys = $aanid;
        $stmt->execute();
    }
    $stmt->close();
    header("location: aanestykset.php?a=" . $aanid);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}



include("footer.php");
?>

</body>
</html>			