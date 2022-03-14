<?php
session_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    $stmt = $db->prepare("INSERT INTO itseprojektit (kurssi_id, kuvaus) VALUES (?, ?)");
    $stmt->bind_param("is", $kurssi, $kuvaus);
    // prepare and bind
    $kurssi = $_SESSION["KurssiId"];
    $kuvaus = $_POST[kuvaus];

    $stmt->execute();
    $stmt->close();



    if (!$haeid = $db->query("select distinct * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
//projektin id
    while ($rowid = $haeid->fetch_assoc()) {
        $pid = $rowid[id];
    }

    if (!$haeopiskelijat = $db->query("select distinct opiskelija_id from opiskelijankurssit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
//projektin id
    while ($rowop = $haeopiskelijat->fetch_assoc()) {
        $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, koulu_id, itseprojekti_id) values('" . $rowop[opiskelija_id] . "', '" . $_SESSION["KurssiId"] . "', '" . $_SESSION["kouluId"] . "', '" . $pid . "')");
    }

    header("location: itsetyot.php?i=" . $pid);
} else {

    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>

