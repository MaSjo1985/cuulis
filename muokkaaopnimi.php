<?php
ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Muokkaa tietoja </title>';

include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        include("header.php");
        include("header2.php");

        echo'<div class="cm8-container7" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 0px;">';
        if ($_SESSION["Rooli"] == 'admin') {
            include("etuosan_navit.php");
            tuoAdminNavi("Oma oppilaitos");
        } else if ($_SESSION["Rooli"] == 'admink') {
            include("etuosan_navit.php");
            tuoAdminkNavi("Oma oppilaitos");
        } else if ($_SESSION["Rooli"] == 'opeadmin') {
            include("etuosan_navit.php");
            tuoOpeadminNavi("Oma oppilaitos");
        }

        echo'</div>';








        echo'<div class="cm8-container3" style="padding-top: 0px;">';
        echo'<div class="cm8-half" >';


        echo'<form action="muokkaaoppilaitosnimi.php" method="post" class="form-style-k" ><fieldset>';

        if (!$result3 = $db->query("select distinct * from koulut where id = '" . $_POST[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row = $result3->fetch_assoc()) {

            echo '<legend>Muokkaa oppilaitoksen ' . $row[Nimi] . ' nimeä </legend>';
            echo'<a href="muokkaakoulu.php?id=' . $_POST[id] . '" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        }




        if (!$result = $db->query("select * from koulut where id = '" . $_POST[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row2 = $result->fetch_assoc()) {
            $nimi = $row2[Nimi];
            $id = $row2[id];
        }

        echo '
	<p><b>Oppilaitoksen nimi:</b><br><textarea name="uusinimi" rows="1" maxlength="50">' . $nimi . '</textarea></p><br>
	<input type="hidden" name="id" value=' . $id . '>  		
	<br><input type="submit" value="&#10003 Tallenna" >			
		</fieldset></form>';





        echo'</div>';



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
    header("location: kirjautuminenuusi.php?url=" . $url);
}
?>
</body>
</html>			
