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
    if (isset($_POST[tallennaA])) {
            $kello = $_POST[kelloA];

            if (!empty($_POST[paivaA])) {
                $originalDate = $_POST[paivaA];
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
                     $kello = $_POST[kelloS];

            if (!empty($_POST[paivaS])) {
                $originalDate = $_POST[paivaS];
                $newDate = date("Y-m-d", strtotime($originalDate));
                $sulkeutuu = $newDate . ' ' . $kello;
            } else {
                $sulkeutuu = '';
            }


            $stmt = $db->prepare("UPDATE projektit SET palautus_sulkeutuu=? WHERE id=?");
            $stmt->bind_param("si", $sulku, $id);
            // prepare and bind

            $sulku = $sulkeutuu;
            $id = $_POST[pid];
            $stmt->execute();
            $stmt->close();
        } else if (isset($_POST[muokkaaA])) {

            $sulkeutuu = '';



            $stmt = $db->prepare("UPDATE projektit SET palautus_avautuu=? WHERE id=?");
            $stmt->bind_param("si", $sulku, $id);
            // prepare and bind

            $sulku = $sulkeutuu;
            $id = $_POST[pid];
            $stmt->execute();
            $stmt->close();
        }

        if (isset($_POST[tallennaS])) {
            
                 $kello = $_POST[kelloA];

            if (!empty($_POST[paivaA])) {
                $originalDate = $_POST[paivaA];
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
            
            $kello = $_POST[kelloS];

            if (!empty($_POST[paivaS])) {
                $originalDate = $_POST[paivaS];
                $newDate = date("Y-m-d", strtotime($originalDate));
                $sulkeutuu = $newDate . ' ' . $kello;
            } else {
                $sulkeutuu = '';
            }


            $stmt = $db->prepare("UPDATE projektit SET palautus_sulkeutuu=? WHERE id=?");
            $stmt->bind_param("si", $sulku, $id);
            // prepare and bind

            $sulku = $sulkeutuu;
            $id = $_POST[pid];
            $stmt->execute();
            $stmt->close();
        } else if (isset($_POST[muokkaaS])) {

            $sulkeutuu = '';



            $stmt = $db->prepare("UPDATE projektit SET palautus_sulkeutuu=? WHERE id=?");
            $stmt->bind_param("si", $sulku, $id);
            // prepare and bind

            $sulku = $sulkeutuu;
            $id = $_POST[pid];
            $stmt->execute();
            $stmt->close();
        }




        header('location: ryhmatyot.php?r=' . $_POST[pid] . '#takaraja');
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
