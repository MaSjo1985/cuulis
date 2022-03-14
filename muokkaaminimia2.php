<?php
session_start(); 


ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    if (isset($_POST["painiket"])) {

        $stmt = $db->prepare("UPDATE itseprojektit_minimi SET minimi=? WHERE itseprojektit_id=?");
        $stmt->bind_param("ii", $minimi, $ipid);

        $minimi = $_POST[minimi];
        $ipid = $_POST[ipid];

        $stmt->execute();

        $stmt->close();
    } else if (isset($_POST["painikep"])) {

        $db->query("delete from itseprojektit_minimi where itseprojektit_id = '" . $_POST[ipid] . "'");
    }


    header('location: itsetyot.php?i=' . $_POST[ipid] . '#takas');
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
</html>	

