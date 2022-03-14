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
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {


        if (isset($_POST[tallenna])) {
            $kello = $_POST[kello];

            if (!empty($_POST[paiva])) {
                $originalDate = $_POST[paiva];
                $newDate = date("Y-m-d", strtotime($originalDate));
                $sulkeutuu = $newDate . ' ' . $kello;
            } else {
                $sulkeutuu = '';
            }


            $stmt = $db->prepare("UPDATE projektit SET palautus_avautuu=? WHERE id=?");
            $stmt->bind_param("si", $sulku, $id);
            // prepare and bind

            $sulku = $sulkeutuu;
            $id = $_POST[pid];
            $stmt->execute();
            $stmt->close();
        } else if (isset($_POST[muokkaa])) {

            $sulkeutuu = '';



            $stmt = $db->prepare("UPDATE projektit SET palautus_avautuu=? WHERE id=?");
            $stmt->bind_param("si", $sulku, $id);
            // prepare and bind

            $sulku = $sulkeutuu;
            $id = $_POST[pid];
            $stmt->execute();
            $stmt->close();
        }




        header('location: ryhmatyot.php?r=' . $_POST[pid] . '#alkuraja');
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";
echo "</div>";
include("footer.php");
?>
</body>
</html>			
