<?php
session_start(); 



ob_start();



include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

$aid = $_REQUEST['id'];
$vastaus = $_REQUEST['vastaus'];



//oletetaan nyt, että voi olla enemmän äänestyksiä

if (!$haevastaus = $db->query("select distinct * from aanestysvastaukset where aanestys_id='" . $aid . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

if ($haevastaus->num_rows == 0) {
    $db->query("insert into aanestysvastaukset (aanestys_id, kayttaja_id, aanestysvaihtoehdot_id) values('" . $aid . "', '" . $_SESSION["Id"] . "', '" . $vastaus . "')");
}

//pitkä looppI!
else {
    while ($rowa = $haevastaus->fetch_assoc()) {
        $id = $rowa[id];
    }



    $db->query("update aanestysvastaukset set aanestys_id='" . $aid . "' where id = '" . $id . "'");
    $db->query("update aanestysvastaukset set aanestysvaihtoehdot_id='" . $vastaus . "' where id = '" . $id . "'");
}

    