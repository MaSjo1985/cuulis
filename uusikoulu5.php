<?php
session_start();
ob_start();
echo'<!DOCTYPE html>
<html>
 
<head>

<title> Uusi oppilaitos </title>';

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

        echo'<div class=cm8-margin-top cm8-margin-left"><br>';

        echo'<h4>Lisää uusi oppilaitos oppimisympäristöön</h4>';
        echo '<a href="oppilaitokset.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>';
        echo '<br><p style="color:#FF0000; font-size:1.1em">Tämänniminen oppilaitos on jo olemassa!</p>';



        echo'<div class="cm8-quarter style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px">';
        echo '<br><form action="lisaakoulu.php" method="post"  enctype="multipart/form-data">

	<br><b>Oppilaitoksen nimi:&nbsp&nbsp&nbsp </b> <input type="text" name="Nimi" maxlength="50"> <br>	<br><br>					

	<b>Oppilaitoksen logo:</b> <br><b style="color: #e608b8">Huom! Kuvan maksimikoko on 5,0 MB.</b><br>
	<p><input type="file" name="kuva"  style="font-size: 0.8em"></p>	
	
	<br><input type="submit" value="&#10003 Lisää oppilaitos">
	
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
