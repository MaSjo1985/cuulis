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


    if ($_POST[onko] == "ei") {
        $kysymys = nl2br($_POST[kysymys]);

        $stmt = $db->prepare("INSERT INTO aanestykset (kurssi_id, kysymys, aktiivinen, lkm) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isii", $kurssi, $kysymys2, $aktiivinen, $lkm);
        // prepare and bind
        $kurssi = $_POST[id];
        $lkm = $_POST[lkm];
        $kysymys2 = $kysymys;
        $aktiivinen = 1;

        $stmt->execute();
        $stmt->close();


        if (!$haekys = $db->query("select MAX(id) as id from aanestykset where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowk = $haekys->fetch_assoc()) {

            $aanid = $rowk[id];
        }
    } else {

        $kysymys = nl2br($_POST[kysymys]);

        $stmt = $db->prepare("UPDATE aanestykset SET kurssi_id=?, kysymys=?, aktiivinen=?, lkm=? WHERE id=?");

        $stmt->bind_param("isiii", $kurssi, $kysymys2, $aktiivinen, $lkm, $aanid);
        // prepare and bind
        $kurssi = $_POST[id];
        $lkm = $_POST[lkm];
        $kysymys2 = $kysymys;
        $aktiivinen = 1;
        $aanid = $_POST[aanid];
        $stmt->execute();
        $stmt->close();
    }

    header("location: aktivoiaanestys2.php?a=" . $aanid);
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