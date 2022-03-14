<?php
session_start(); 


ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
include("yhteys.php");



if (isset($_SESSION["Kayttajatunnus"])) {


    if (!$haearvioinnit2 = $db->query("select distinct id from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY jarjestys")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowt2 = $haearvioinnit2->fetch_assoc()) {

        $db->query("update kyselytkp set muokattu='' where kyselyt_id = '" . $rowt2[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");

        $db->query("update kyselytkp set tallennettu=0 where kyselyt_id = '" . $rowt2[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
    }









    $palaa = $_GET[teid];
    header('location: kysely.php');
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

