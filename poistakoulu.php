<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Oppilaitokset poisto</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "admin") {
        include("header.php");
        include("header2.php");
        echo'<div class="cm8-container7">';

        if ($_SESSION["Rooli"] == 'admin')
            include("adminnavi.php");
        else if ($_SESSION["Rooli"] == 'admink')
            include("adminknavi.php");
        else if ($_SESSION["Rooli"] == 'opeadmin')
            include("opeadminnavi.php");

        echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
        echo'<div class="cm8-margin-top"></div>';
        if ($_POST["valinta"] == "ei")
            header("location: oppilaitokset.php");

        else {

            $lista = $_POST["mita"];

            foreach ($lista as $tuote) {
                if (!$result = $db->query("select distinct kuva from koulut where id = '" . $tuote . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($row2 = $result->fetch_assoc()) {
                    $nimi = $row2[kuva];
                }
                if (file_exists($nimi)) {
                    unlink($nimi);
                }

                //poistetaan vain suoraan oppilaitokseen liittyvät tiedot

                $db->query("delete from koulut where id = '" . $tuote . "'");
                $db->query("delete from kayttajankoulut where koulu_id = '" . $tuote . "'");
                $db->query("delete from koulunadminit where koulu_id = '" . $tuote . "'");
            }

            echo'<br><b style="color: #e608b8;">Valitut oppilaitokset on nyt poistettu.</b><br><br><a href="oppilaitokset.php"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin';
        }


        echo'</div>';
        echo'</div>';

        include("footer.php");
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