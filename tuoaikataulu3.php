<?php
session_start();
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {


    if (!$haeaikataulu = $db->query("select distinct * from kurssiaikataulut where kurssi_id='" . $_POST[kurssi_id] . "' order by jarjestys")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowa = $haeaikataulu->fetch_assoc()) {

        if (!$haevika = $db->query("select distinct MAX(jarjestys) as jarjestys from kurssiaikataulut where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($haevika->num_rows != 0) {
            while ($rowP = $haevika->fetch_assoc()) {

                $jarjestys = $rowP[jarjestys] + 1;
            }
        } else {
            $jarjestys = $rowa[jarjestys];
        }


        $aihe = $rowa[aihe];
        $lisa = $rowa[lisa];



        $db->query("insert into kurssiaikataulut (kurssi_id, jarjestys, aihe, lisa) values('" . $_SESSION["KurssiId"] . "', '" . $jarjestys . "', '" . $aihe . "', '" . $lisa . "')");
    }
    header("location: muokkaa_aikataulu.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>
</body>
</html>		
</html>	

