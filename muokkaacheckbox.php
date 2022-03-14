<?php
session_start(); 


ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    if (isset($_POST["painiketcv"])) {

        $lista1 = $_POST["vaihtoehto"];
        $lista2 = $_POST["id"];


        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE iavaihtoehdot SET vaihtoehto=? WHERE id=?");
        $stmt->bind_param("si", $ilmoitus, $id);

        for ($i = 0; $i < $maara; $i++) {

            $selite = $lista1[$i];
            $selite = nl2br($selite);

            $ilmoitus = $selite;
            $id = $lista2[$i];
            $stmt->execute();
        }

        $stmt->close();
        header("location: ia.php");
    }

    if (isset($_POST["painikepcv"])) {
        
    }





    if (isset($_POST["painikelcv"])) {

        $lista1 = $_POST["vaihtoehto"];
        $lista2 = $_POST["id"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE iavaihtoehdot SET vaihtoehto=? WHERE id=?");
        $stmt->bind_param("si", $ilmoitus, $id);
        for ($i = 0; $i < $maara; $i++) {


            $selite = $lista1[$i];
            $selite = nl2br($selite);
            $ilmoitus = $selite;
            $id = $lista2[$i];
            $stmt->execute();
        }



        $db->query("insert into iavaihtoehdot (ia_id) values('" . $_POST[iaid] . "')");




        $stmt->close();


        header('location: uusi_ia.php');
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
</html>	

