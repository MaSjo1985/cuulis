<?php
ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Muokkaa</title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {

        if (isset($_POST[tallenna])) {
            $sid = $_POST["tallenna"];
            $sid = substr($sid, 9);
            $sid = str_replace('(', '', $sid);
            $sid = str_replace(')', '', $sid);

            $kello = $_POST[kello];

            if (!empty($_POST[paiva])) {
                $originalDate = $_POST[paiva];
                $newDate = date("Y-m-d", strtotime($originalDate));
                $sulkeutuu = $newDate . ' ' . $kello;
            } else {
                $sulkeutuu = NULL;
            }

            $stmt = $db->prepare("UPDATE ia_sarakkeet SET sulkeutuu=? WHERE jarjestys=? AND kurssi_id=?");
            $stmt->bind_param("sii", $sulku, $jarjestys, $kurssi);
            // prepare and bind
            $sulku = $sulkeutuu;
            $jarjestys = $sid;
            $kurssi = $_SESSION[KurssiId];
            $stmt->execute();
            $stmt->close();

//            echo'<br>kello on: '.$_POST[kello];
//            echo'<br>pvm on: '.$_POST[paiva];
//               echo'<br>sulku on: '.$sulku;
//                  echo'<br>otmaara on: '.$_POST[otmaara];
//            die();
        } else if (isset($_POST[muokkaa])) {


            $sid = $_POST["muokkaa"];
            $sid = substr($sid, 8);
            $sid = str_replace('(', '', $sid);
            $sid = str_replace(')', '', $sid);


            $stmt = $db->prepare("UPDATE ia_sarakkeet SET sulkeutuu=NULL WHERE jarjestys=? AND kurssi_id=?");
            $stmt->bind_param("ii", $jarjestys, $kurssi);
            // prepare and bind
            $sulku = $sulkeutuu;
            $jarjestys = $sid;
            $kurssi = $_SESSION[KurssiId];
            $stmt->execute();
            $stmt->close();
        } else {
            header('location: etusivu.php');
        }



        header('location: ia.php#' . $jarjestys);
    } else {
        
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminen.php?url=" . $url);
}

echo "</div>";
echo "</div>";
include("footer.php");
?>
</body>
</html>			
