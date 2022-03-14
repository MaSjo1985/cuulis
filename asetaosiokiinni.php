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

        if (isset($_POST[tallenna]) || isset($_POST[tallenna2])) {

            $kello = $_POST[kello];

            if (!empty($_POST[paiva])) {
                $originalDate = $_POST[paiva];
                $newDate = date("Y-m-d", strtotime($originalDate));
                $sulkeutuu = $newDate . ' ' . $kello;
            } else {
                $sulkeutuu = '';
            }


            $stmt = $db->prepare("UPDATE itsetehtavat SET sulkeutuu=? WHERE id=?");
            $stmt->bind_param("si", $sulku, $id);
            // prepare and bind
            $sulku = $sulkeutuu;
            $id = $_POST[id];

            $stmt->execute();
            $stmt->close();
//            echo'<br>kello on: '.$_POST[kello];
//            echo'<br>pvm on: '.$_POST[paiva];
//               echo'<br>sulku on: '.$sulku;
//                  echo'<br>otmaara on: '.$_POST[otmaara];
//            die();
        } else if (isset($_POST[muokkaa])) {


            $sulkeutuu = '';



            $stmt = $db->prepare("UPDATE itsetehtavat SET sulkeutuu=? WHERE id=?");
            $stmt->bind_param("si", $sulku, $id);
            // prepare and bind
            $sulku = $sulkeutuu;
            $id = $_POST[id];
            $stmt->execute();
            $stmt->close();
        } else {
            header('location: etusivu.php');
        }

        if (!$haeminne = $db->query("select distinct jarjestys from itsetehtavat where id='" . $_POST[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($row = $haeminne->fetch_assoc()) {
            $jarjestys = $row[jarjestys];
        }

        $minne = $jarjestys - 3;
        if ($minne <= -1) {
            $minne = 'palaa2';
        }


        header('location: itsetyot.php?i=' . $_POST[ipid] . '#' . $minne);
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
