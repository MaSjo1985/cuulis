<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Materiaalit </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    if ($_POST[kuvaus] != "" && $_POST[upotus] != 1 && $_POST[youtube] != 1) {

        $stmt = $db->prepare("INSERT INTO tiedostot (linkki, omatallennusnimi, kuvaus, kansio_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issi", $linkki, $omatallennusnimi, $kuvaus, $kansio);
        // prepare and bind
        $linkki = 1;
        $omatallennusnimi = $_POST[kuvaus];
        $kuvaus = $_POST[osoite];
        $kansio = $_POST[kid];
        $stmt->execute();
        $stmt->close();

        header("location: tiedostot.php?k=" . $_POST[kid]);
    }

    if ($_POST[upotus] == 1) {
        $stmt = $db->prepare("INSERT INTO tiedostot (linkki, omatallennusnimi, kuvaus, kansio_id, upotus, vanhalinkki)  VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issiii", $linkki, $omatallennusnimi, $kuvaus, $kansio, $upotus, $vanhalinkki);
        // prepare and bind
        $linkki = 1;
        $omatallennusnimi = $_POST[kuvaus];
        $kuvaus = $_POST[osoite];
        $kansio = $_POST[kid];
        $upotus = 1;
        $vanhalinkki = 1;
        $stmt->execute();
        $stmt->close();




        header("location: tiedostot.php?k=" . $_POST[kid]);
    }

    if ($_POST[youtube] == 1) {
        $mystring = $_POST[osoite];
        $findme = 'src="';

        $pos = strpos($mystring, $findme);
        echo'eka:' . $pos;

        $pos2 = strpos($mystring, '"', $pos + 5);
        echo'toka:' . $pos2;
        $length = ($pos2) - ($pos + 5);
        echo'pituus:' . $length;
        $hae = substr($mystring, $pos + 5, $length);

        $stmt = $db->prepare("INSERT INTO tiedostot (linkki, omatallennusnimi, kuvaus, kansio_id, youtube, vanhalinkki)  VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issiii", $linkki, $omatallennusnimi, $kuvaus, $kansio, $youtube, $vanhalinkki);
        // prepare and bind
        $linkki = 1;
        $omatallennusnimi = $_POST[kuvaus];
        $kuvaus = $hae;
        $kansio = $_POST[kid];
        $youtube = 1;
        $vanhalinkki = 1;
        $stmt->execute();
        $stmt->close();




        header("location: tiedostot.php?k=" . $_POST[kid]);
    }



    echo'</div>';
    echo'</div>';
    echo'</div>';
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}



include("footer.php");
?>

</body>
</html>	

</body>
</html>	
