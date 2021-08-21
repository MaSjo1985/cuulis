<?php
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Kuvan poisto</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("header.php");
        include("header2.php");
        echo'<div class="cm8-container7">';

        if ($_SESSION["Rooli"] == 'admin')
            include("adminnavi.php");
        else if ($_SESSION["Rooli"] == 'admink')
            include("adminknavi.php");
        else if ($_SESSION["Rooli"] == 'opeadmin')
            include("opeadminnavi.php");
        else
            include ("opnavi.php");
        echo'<div class="cm8-margin-top"><br></div>';

        echo'<div class="cm8-margin-left" style="padding-left: 20px">';

        if (!$result = $db->query("select * from kayttajat where id = '" . $_GET[kaid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row2 = $result->fetch_assoc()) {
            $etunimi = $row2[etunimi];
            $sukunimi = $row2[sukunimi];
            $sposti = $row2[sposti];
            $rooli = $row2[rooli];
            $id = $row2[id];
        }


        echo '<p style="font-weight: bold" >Haluatko todella poistaa käyttäjän ' . $etunimi . ' ' . $sukunimi . ' profiilikuvan?</p>';


        echo '<br><a href="poistaomakuvak.php?id=' . $_GET[kaid] . '" class="myButton9"  role="button"  style="margin-right: 30px">Kyllä</a>';
        echo '<a href="muokkaakayttaja.php?url=' . $url . '&id=' . $_GET[kaid] . '" class="myButton9"  role="button" >En</a><br>';
        echo'</div>';
        echo'</div>';

        include("footer.php");
    } else {
        header("location: etusivu.php");
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}
?>
</body>
</html>			
