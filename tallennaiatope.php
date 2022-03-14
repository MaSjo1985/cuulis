<?php
session_start();

ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

 // ready to go!
include("yhteys.php");




if (isset($_SESSION["Kayttajatunnus"])) {

    if (isset($_POST["painiket"])) {



        $kommentti = $_POST["kommentti"];
        $kaid = $_POST["kaid"];
        $jarjestys = $_POST["jarjestys"];
        $kurssi = $_SESSION[KurssiId];
        $tallennettu = 1;

        if (!$haekommentti = $db->query("select distinct * from iakommentit where ia_sarakkeet_jarjestys = '" . $jarjestys . "' AND kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttaja_id='" . $kaid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haekommentti->num_rows == 0) {
            $stmt = $db->prepare("insert into iakommentit (kommentti, tallennettu, kurssi_id, kayttaja_id, ia_sarakkeet_jarjestys) values (?,?,?,?,?)");
        } else {
            $stmt = $db->prepare("UPDATE iakommentit SET kommentti = ?, tallennettu = ? WHERE kurssi_id = ? AND kayttaja_id = ? AND ia_sarakkeet_jarjestys = ?");
        }
        $stmt->bind_param("siiii", $kommentti, $tallennettu, $kurssi, $kaid, $jarjestys);


        $kommentti = nl2br($kommentti);


        $stmt->execute();

        $stmt->close();
    } else if (isset($_POST["painikem"])) {
        $kaid = $_POST["kaid"];
        $jarjestys = $_POST["jarjestys"];
        $kurssi = $_SESSION[KurssiId];
        $tallennettu = 0;
        $stmt = $db->prepare("UPDATE iakommentit set tallennettu = ? WHERE kurssi_id = ? AND kayttaja_id = ? AND ia_sarakkeet_jarjestys = ?");
        $stmt->bind_param("iiii", $tallennettu, $kurssi, $kaid, $jarjestys);


        $stmt->execute();

        $stmt->close();
    }


    header('location: tarkasteleopiskelijaia.php?kaid=' . $_POST[kaid] . '#tuutanne');
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>


