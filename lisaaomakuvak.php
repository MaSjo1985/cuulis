<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Profiilikuvan lisäys</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

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
        echo'<div class="cm8-half">';

        if (!$result = $db->query("select * from kayttajat where id = '" . $_GET[kaid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($row2 = $result->fetch_assoc()) {
            $etunimi = $row2[etunimi];
            $sukunimi = $row2[sukunimi];
            $sposti = $row2[sposti];
            $rooli = $row2[rooli];
            $id = $row2[id];
        }
        echo'<form action="lisaaomakuva2k.php" method="post" class="form-style-k" enctype="multipart/form-data"><fieldset>';
        echo"<legend>Lisää profiilikuva käyttäjälle " . $etunimi . " " . $sukunimi . "</legend>";
        echo'<a href="muokkaakayttaja.php?url=' . $url . '&id=' . $_GET[kaid] . '" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
        echo '
	<p style="color: #e608b8" class="eimitaan"><b>Huom! </b><br>Sallitun kuvatiedoston maksimikoko on 5,0 MB.<br>Sallittuja tiedostomuotoja ovat .jpg, .gif., .png ja .jpeg</p><br>
	<input type="file" name="uusikuva" style="font-size: 0.8em">
	<input type="hidden" name="id" value=' . $_GET[kaid] . '>  	
	<br><br><input type="submit" value="&#10003 Tallenna" class="myButton9"><br>		
		</fieldset></form>';

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
exit();
}
?>
</body>
</html>			
