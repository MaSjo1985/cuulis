<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Lisää profiiilikuva</title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
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
    echo'<form action="lisaaomakuva2.php" method="post" class="form-style-k" enctype="multipart/form-data"><fieldset>';
    echo"<legend>Lisää profiilikuva </legend>";
    echo'<a href="muokkaaomat.php" class="palaa">&#8630 &nbsp&nbsp&nbspPalaa takaisin</a><br><br>';
    echo '
	<p style="color: #e608b8" class="eimitaan"><b>Huom! </b><br>Sallitun kuvatiedoston maksimikoko on 5,0 MB.<br>Sallittuja tiedostomuotoja ovat .jpg, .gif., .png ja .jpeg</p><br>
	<input type="file" name="uusikuva" />
	<input type="hidden" name="id" value=' . $_SESSION["Id"] . '>  	
	<br><br><input type="submit" value="&#10003 Tallenna" class="myButton9">		
		</fieldset></form>';

    echo'</div>';
    echo'</div>';

    include("footer.php");
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
