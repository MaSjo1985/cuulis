<?php
session_start(); 


ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    if (!$result = $db->query("select distinct id from kyselyt where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row = $result->fetch_assoc()) {
        $id = $row[id];


        $db->query("delete from kyselytkp where kyselyt_id ='" . $id . "'");
    }

    $db->query("delete from kyselyt where kurssi_id ='" . $_SESSION["KurssiId"] . "'");
    $db->query("update kurssit set kysely=0 where id = '" . $_SESSION["KurssiId"] . "'");
    $db->query("update kurssit set kyselyinfo='' where id = '" . $_SESSION["KurssiId"] . "'");


    header("location: kysely.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
}
?>
</body>
</html>		
</html>	

