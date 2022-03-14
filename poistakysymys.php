<?php
session_start(); 

ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Kysymyksen poisto</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("header.php");
    include("header2.php");

    if ($_POST["valinta"] == "ei")
        header("location: valitsekysymykset.php?w1=" . $_POST[w1] . "&w2=" . $_POST[w2]);

    else {



        if (!$haekyslkm = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row = $haekyslkm->fetch_assoc()) {
            $kyslkm = $row[kyslkm];
            $kyslkmvanha = $row[kyslkmvanha];
        }



        $lista = $_POST["mita"];

        foreach ($lista as $tuote) {

            $db->query("delete from kysymykset where id = '" . $tuote . "'");
            $kyslkm = $kyslkm - 1;
            $kyslkmvanha = $kyslkmvanha - 1;

            $db->query("update kurssit set kyslkm='" . $kyslkm . "' where id = '" . $_SESSION["KurssiId"] . "'");
            $db->query("update kurssit set kyslkmvanha='" . $kyslkmvanha . "' where id = '" . $_SESSION["KurssiId"] . "'");
        }

        header("location: kysymykset2.php?w1=" . $_POST[w1] . "&w2=" . $_POST[w2]);
    }
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