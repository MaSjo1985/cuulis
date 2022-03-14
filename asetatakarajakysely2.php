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

        if (isset($_POST[tallennaS])) {
            $kello = $_POST[kelloA];

            if (!empty($_POST[paivaA])) {
                $originalDate = $_POST[paivaA];
                $newDate = date("Y-m-d", strtotime($originalDate));
                $avautuu = $newDate . ' ' . $kello;
            } else {
                $avautuu = NULL;
            }


            $stmt = $db->prepare("UPDATE kyselyt SET aukeaa=? WHERE kurssi_id=?");
            $stmt->bind_param("si", $auki, $id);
            // prepare and bind

            $auki = $avautuu;
            $id = $_SESSION["KurssiId"];
            $stmt->execute();
            $stmt->close();
            
            $kello = $_POST[kelloS];

            if (!empty($_POST[paivaS])) {
                $originalDate = $_POST[paivaS];
                $newDate = date("Y-m-d", strtotime($originalDate));
                $sulkeutuu = $newDate . ' ' . $kello;
            } else {
                $sulkeutuu = NULL;
            }


            $stmt = $db->prepare("UPDATE kyselyt SET sulkeutuu=? WHERE kurssi_id=?");
            $stmt->bind_param("si", $sulku, $id);
            // prepare and bind

            $sulku = $sulkeutuu;
            $id = $_SESSION["KurssiId"];
            $stmt->execute();
            $stmt->close();
        } else if (isset($_POST[muokkaaS])) {

            $sulkeutuu = NULL;



            $stmt = $db->prepare("UPDATE kyselyt SET sulkeutuu=NULL WHERE kurssi_id=?");
            $stmt->bind_param("i", $id);
            // prepare and bind

            $sulku = $sulkeutuu;
            $id = $_SESSION["KurssiId"];
            $stmt->execute();
            $stmt->close();
        }

        if (isset($_POST[tallennaA])) {
            $kello = $_POST[kelloA];

            if (!empty($_POST[paivaA])) {
                $originalDate = $_POST[paivaA];
                $newDate = date("Y-m-d", strtotime($originalDate));
                $avautuu = $newDate . ' ' . $kello;
            } else {
                $avautuu = NULL;
            }


            $stmt = $db->prepare("UPDATE kyselyt SET aukeaa=? WHERE kurssi_id=?");
            $stmt->bind_param("si", $auki, $id);
            // prepare and bind

            $auki = $avautuu;
            $id = $_SESSION["KurssiId"];
            $stmt->execute();
            $stmt->close();
            
             $kello = $_POST[kelloS];

            if (!empty($_POST[paivaS])) {
                $originalDate = $_POST[paivaS];
                $newDate = date("Y-m-d", strtotime($originalDate));
                $sulkeutuu = $newDate . ' ' . $kello;
            } else {
                $sulkeutuu = NULL;
            }


            $stmt = $db->prepare("UPDATE kyselyt SET sulkeutuu=? WHERE kurssi_id=?");
            $stmt->bind_param("si", $sulku, $id);
            // prepare and bind

            $sulku = $sulkeutuu;
            $id = $_SESSION["KurssiId"];
            $stmt->execute();
            $stmt->close();
        } else if (isset($_POST[muokkaaA])) {

            $avautuu = NULL;



            $stmt = $db->prepare("UPDATE kyselyt SET aukeaa=NULL WHERE kurssi_id=?");
            $stmt->bind_param("i", $id);
            // prepare and bind

            $sulku = $sulkeutuu;
            $id = $_SESSION["KurssiId"];
            $stmt->execute();
            $stmt->close();
        }


        header('location: kysely.php');
    } else {
        
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
