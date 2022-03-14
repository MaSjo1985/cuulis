<?php
session_start(); 


ob_start();


echo'
<!DOCTYPE html>
<html>
 
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9,IE=8,IE=7,IE=Edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
<meta charset="UTF-8">
<title>Cuulis - oppimisympäristö</title>
<meta name="description" content="Cuulis on eriasteisille oppilaitoksille suunnattu oppimisympäristö."/>
<meta property="og:description" content="Cuulis on eriasteisille oppilaitoksille suunnattu oppimisympäristö."/>
<meta name="twitter:description" content="Cuulis on eriasteisille oppilaitoksille suunnattu oppimisympäristö."/>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    include("header.php");
    include("header2.php");
    echo '<div class="cm8-container2">';



    if ($_SESSION["Rooli"] == "admin")
        header("location: admin.php");

    else if ($_SESSION["Rooli"] == "admink")
        header("location: admink.php");

    else if ($_SESSION["Rooli"] == 'opettaja')
        header("location: opettaja.php");
    else if ($_SESSION["Rooli"] == 'opeadmin')
        header("location: opeadmin.php");

    else if ($_SESSION["Rooli"] == 'opiskelija')
        header("location: opiskelija.php");
    else if ($_SESSION["Rooli"] == 'muu')
        header("location: muu.php");

    echo"</div>";
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