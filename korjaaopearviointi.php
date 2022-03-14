<?php
session_start(); 


ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
include("yhteys.php");



if (isset($_SESSION["Kayttajatunnus"])) {
    if (!$projekti = $db->query("select * from kurssit where id='" . $_SESSION["KurssiId"] . "' and itsearviointi=1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($projekti->num_rows != 0) {



        $db->query("update itsearvioinnitkp set opetallennus=0 where itsearvioinnit_id = '" . $_GET[teid] . "' AND kayttaja_id='" . $_GET[opid] . "'");
    }






    $palaa = $_GET[teid];
    header('location: tarkasteleopiskelija2.php?kaid=' . $_GET[opid] . '&minne=' . $_GET[teid]);
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

