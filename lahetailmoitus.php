<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Muokkaa</title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("kurssisivustonheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; padding-top: 0px; padding-bottom: 30px">';





    if ($_POST["kumpi"] == 'ilmoitus') {
        $sisalto = $_POST[viesti];

        $sisalto = nl2br($sisalto);
        $stmt = $db->prepare("UPDATE kurssit SET ilmoitus2=? WHERE id=?");
        $stmt->bind_param("si", $ilmoitus, $id);
        $ilmoitus = $sisalto;
        $id = $_SESSION["KurssiId"];
        $stmt->execute();
        $stmt->close();

        header("location: kurssi.php?id=$_SESSION[KurssiId]");
    }

    if ($_POST["kumpi"] == 'inforyhma') {
        $sisalto = $_POST[viesti];


        $stmt = $db->prepare("UPDATE projektit SET info=? WHERE id=?");
        $stmt->bind_param("si", $ilmoitus, $id);
        $ilmoitus = $sisalto;
        $id = $_POST[id];
        $stmt->execute();
        $stmt->close();


        header("location: ryhmatyot.php?r=" . $_POST[id]);
    }
    if ($_POST["kumpi"] == 'infoitse') {
        $sisalto = $_POST[viesti];


        $stmt = $db->prepare("UPDATE itseprojektit SET info=? WHERE id=?");
        $stmt->bind_param("si", $ilmoitus, $id);
        $ilmoitus = $sisalto;
        $id = $_POST[id];
        $stmt->execute();
        $stmt->close();


        header("location: itsetyot.php?i=" . $_POST[id]);
    }
    if ($_POST["kumpi"] == 'infoitsea') {
        $sisalto = $_POST[viesti];


        $stmt = $db->prepare("UPDATE kurssit SET infoitsearviointi=? WHERE id=?");
        $stmt->bind_param("si", $ilmoitus, $id);
        $ilmoitus = $sisalto;
        $id = $_POST[id];
        $stmt->execute();
        $stmt->close();


        header("location: itsearviointi.php");
    }
    if ($_POST["kumpi"] == 'infokysely') {
        $sisalto = $_POST[viesti];

        $stmt = $db->prepare("UPDATE kurssit SET kyselyinfo=? WHERE id=?");
        $stmt->bind_param("si", $ilmoitus, $id);
        $ilmoitus = $sisalto;
        $id = $_SESSION["KurssiId"];
        $stmt->execute();
        $stmt->close();


        header("location: kysely.php");
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo '</div>';

include("footer.php");
?>

</body>
</html>