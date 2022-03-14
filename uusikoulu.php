<?php
session_start();
ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>

<title>  Lisää uusi oppilaitos </title>';

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

        echo'<div class="cm8-half" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px">';
        echo '<form action="lisaakoulu.php" class="form-style-k" method="post"  enctype="multipart/form-data"><fieldset>';
        echo'<legend>Lisää uusi oppilaitos oppimisympäristöön</legend>';
        echo '<a href="oppilaitokset.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';




        echo'<p>Oppilaitoksen nimi:&nbsp&nbsp&nbsp </b> <input type="text" name="Nimi" maxlength="50"> </p><br>					

	<p>Oppilaitoksen logo:</b> <br><br><b style="color: #e608b8; font-size: 0.8em">Huom! Kuvan maksimikoko on 5,0 MB.</b><br><br>
	<input type="file" name="kuva"  style="font-size: 0.8em"></p>	
	
	<br><br><input type="submit" value="&#10003 Lisää oppilaitos"></fieldset>
	
	</form>';
        echo'</div>';
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
