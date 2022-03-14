<?php
session_start(); 


ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    if (isset($_POST["painiket"])) {

        $lista1 = $_POST["selite"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["osuus"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE itseprojektit_lpisteet SET pisteet=? WHERE id=?");
        $stmt->bind_param("ii", $ilmoitus, $id);

        for ($i = 0; $i < $maara; $i++) {

            $selite = $lista1[$i];
            $selite = nl2br($selite);

            $ilmoitus = $selite;
            $id = $lista2[$i];
            $stmt->execute();


            $db->query("update itseprojektit_lpisteet set osuus='" . $lista3[$i] . "' where id = '" . $lista2[$i] . "'");
        }

        $stmt->close();
        header("location: itsetyot.php?i=" . $_POST[ipid] . "#palaa");
    }

    if (isset($_POST["painikep"])) {
        $lista1 = $_POST["selite"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["osuus"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];


        $stmt = $db->prepare("UPDATE itseprojektit_lpisteet SET pisteet=? WHERE id=?");
        $stmt->bind_param("ii", $ilmoitus, $id);

        for ($i = 0; $i < $maara; $i++) {

            $selite = $lista1[$i];
            $selite = nl2br($selite);
            $ilmoitus = $selite;
            $id = $lista2[$i];
            $stmt->execute();


            $db->query("update itseprojektit_lpisteet set osuus='" . $lista3[$i] . "' where id = '" . $lista2[$i] . "'");
        }

        $lista = $_POST["lista"];



        $db->query("delete from itseprojektit_lpisteet where id = '" . $lista . "'");



        $stmt->close();
        header('location: muokkaalisapisteita.php?id=' . $_POST[ipid] . '#tanne');
    }





    if (isset($_POST["painikel"])) {

        $lista1 = $_POST["selite"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["osuus"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE itseprojektit_lpisteet SET pisteet=? WHERE id=?");
        $stmt->bind_param("ii", $ilmoitus, $id);
        for ($i = 0; $i < $maara; $i++) {


            $selite = $lista1[$i];
            $selite = nl2br($selite);
            $ilmoitus = $selite;
            $id = $lista2[$i];
            $stmt->execute();


            $db->query("update itseprojektit_lpisteet set osuus='" . $lista3[$i] . "' where id = '" . $lista2[$i] . "'");
        }



        $db->query("insert into itseprojektit_lpisteet (itseprojekti_id) values('" . $_POST[ipid] . "')");




        $stmt->close();


        header('location: muokkaalisapisteita.php?id=' . $_POST[ipid] . '#tanne');
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

