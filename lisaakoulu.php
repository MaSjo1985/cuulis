<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Oppilaitoksen lisäys</title>';

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

    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
    echo'<div class="cm8-margin-top"></div>';

    if (!$tulos8 = $db->query("select distinct * from koulut where Nimi='" . $_POST[Nimi] . "'")) {
        die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
    }


    if ($tulos8->num_rows != 0)
        header("location: uusikoulu5.php");
    else {

        require_once("kuvaupload.php");

        try {
            $nimi = upload_tarkista("kuva", 5.0 * 1024 * 1024);
        } catch (UploadException $e) {

            die('<b style="font-size: 1em; color: #FF0000">' . $e->getMessage() . '</b><br><br><a href="uusikoulu.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        try {
            list($vanha, $nimi) = upload_tallenna_turvallinen("kuva", "images", array(".jpg", ".gif", ".png", ".jpeg", ".JPG", ".GIF", ".PNG", ".JPEG"));
        } catch (UploadException $e) {

            die('<b style="font-size: 1em; color: #FF0000">' . $e->getMessage() . '</b><br><br><a href="uusikoulu.php"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        $db->query("insert into koulut (Nimi, kuva) values('" . $_POST[Nimi] . "', '" . $nimi . "')");


        header("location: lisaakoulu2.php");
    }


    echo "</div>";
    echo "</div>";

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