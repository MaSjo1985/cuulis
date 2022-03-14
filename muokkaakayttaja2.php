<?php
session_start(); 


ob_start();

echo'<html> 
<head>
<title> Käyttäjän tietojen muokkaus </title>';

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

        echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
        echo'<div class="cm8-margin-top"></div>';




        $siivottusposti = mysqli_real_escape_string($db, $_POST[uusisposti]);

    $siivottusposti = trim($siivottusposti);
    
 if($_POST[rooli]!='opiskelija'){
     $siivottusposti=strtolower($siivottusposti);
 }
        
        
        $siivottuetu = mysqli_real_escape_string($db, $_POST[uusietu]);
        $siivottusuku = mysqli_real_escape_string($db, $_POST[uusisuku]);


        $stmt = $db->prepare("UPDATE kayttajat SET etunimi=?, sukunimi=?, kokonimi=?, sposti=? WHERE id=?");
        $stmt->bind_param("ssssi", $etu, $suku, $koko, $sposti, $id);
        // prepare and bind
        $etu = $siivottuetu;
        $suku = $siivottusuku;
        $koko = $siivottuetu . ' ' . $siivottusuku;
        $sposti = $siivottusposti;
        $id = $_POST[id];

        $stmt->execute();


        $stmt->close();
        header('location: kayttaja.php?url='.$url.'&ka='.$_POST[id]);
        echo "Muutokset tehty onnistuneesti!";

        echo '<br><br><a href="kayttaja.php?url=' . $url . '&ka=' . $_POST[id] . '"> <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin käyttäjäprofiiliin</a>';





        echo'</div>';
        echo'</div>';

        include("footer.php");
    }
    else {
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