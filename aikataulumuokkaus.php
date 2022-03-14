<?php
session_start(); 


ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
if (!isset($_SESSION["KurssiId"])) {
    header('location: omatkurssit.php');
}
if (isset($_SESSION["Kayttajatunnus"])) {

//tallennus
    if (isset($_POST["painiket"])) {

        $lista1 = $_POST["aika"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["aihe"];
        $lista4 = $_POST["lisa"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE kurssiaikataulut SET aika=?, aihe=?, lisa=? WHERE id=?");
        $stmt->bind_param("sssi", $aika, $aihe, $lisa, $id);

        for ($i = 0; $i < $maara; $i++) {


            $aika = $lista1[$i];

            $aika = nl2br($aika);
            $aihe = $lista3[$i];


            $lisa = $lista4[$i];

            $id = $lista2[$i];
            $stmt->execute();
        }
        $stmt->close();
        header("location: kurssi.php?id=" . $_SESSION[KurssiId] . "#palaa");
    }

    //poista
    if (isset($_POST["painikep"])) {
        $lista1 = $_POST["aika"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["aihe"];
        $lista4 = $_POST["lisa"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];
        $stmt = $db->prepare("UPDATE kurssiaikataulut SET aika=?, aihe=?, lisa=? WHERE id=?");
        $stmt->bind_param("sssi", $aika, $aihe, $lisa, $id);

        for ($i = 0; $i < $maara; $i++) {

            $aika = $lista1[$i];

            $aika = nl2br($aika);
            $aihe = $lista3[$i];

            $lisa = $lista4[$i];

            $id = $lista2[$i];
            $stmt->execute();
        }





        $lista = $_POST["lista"];

        foreach ($lista as $id) {

            $db->query("delete from kurssiaikataulut where id = '" . $id . "'");
        }


        //jarjestyksen paivitys!!


        if (!$haevika = $db->query("select distinct * from kurssiaikataulut where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
        }


        if (!$paivitajarjestys = $db->query("select distinct * from kurssiaikataulut where kurssi_id='" . $_SESSION[KurssiId] . "' order by jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $paivitetty = 0;
        while ($rowPJ = $paivitajarjestys->fetch_assoc()) {



            $id = $rowPJ[id];
            $db->query("update kurssiaikataulut set jarjestys='" . $paivitetty . "' where id = '" . $id . "'");
            $paivitetty++;
        }
        $stmt->close();

        header("location: muokkaa_aikataulu.php?monesko=" . $_POST[monesko] . "#tanne");
    }

//rivin lisäys
    if (isset($_POST["painikel"])) {


        $lista1 = $_POST["aika"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["aihe"];
        $lista4 = $_POST["lisa"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE kurssiaikataulut SET aika=?, aihe=?, lisa=? WHERE id=?");
        $stmt->bind_param("sssi", $aika, $aihe, $lisa, $id);

        for ($i = 0; $i < $maara; $i++) {


            $aika = $lista1[$i];
            $aika = nl2br($aika);

            $aihe = $lista3[$i];

            $lisa = $lista4[$i];


            $id = $lista2[$i];
            $stmt->execute();
        }


        //menee yläpuolelle
        if (isset($_POST["jarjestys"])) {

            $jarjestys = $_POST["jarjestys"];
            $uusijarjestys = $jarjestys;

            if (!$paivitajarjestys = $db->query("select distinct * from kurssiaikataulut where kurssi_id = '" . $_SESSION[KurssiId] . "' AND jarjestys >= '" . $_POST["jarjestys"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];

                $jarj = $jarj + 1;
                $db->query("update kurssiaikataulut set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }
        //menee alapuolelle
        else {

            if (!$resultmax = $db->query("select MAX(jarjestys) as suurin from kurssiaikataulut where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($maxrow = $resultmax->fetch_assoc()) {
                $jarjestys = $maxrow[suurin];
            }
            $uusijarjestys = $jarjestys + 1;

            if (!$paivitajarjestys = $db->query("select distinct * from kurssiaikataulut where kurssi_id = '" . $_SESSION[KurssiId] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];

                $jarj = $jarj + 1;
                $db->query("update kurssiaikataulut set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }







        $db->query("insert into kurssiaikataulut (kurssi_id, jarjestys) values('" . $_SESSION[KurssiId] . "', '" . $uusijarjestys . "')");


        if (!$haeuusin = $db->query("select distinct * from kurssiaikataulut where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowu = $haeuusin->fetch_assoc()) {
            $jarjestys = $rowu[jarjestys];
        }


        if (!$haevika = $db->query("select distinct * from kurssiaikataulut where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
        }
        $stmt->close();

            $jarjestys = $jarjestys - 1;

            header('location: muokkaa_aikataulu.php?#' . $jarjestys);
        
    }
    if (isset($_POST["lisaa"])) {

        $lista1 = $_POST["aika"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["aihe"];
        $lista4 = $_POST["lisa"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE kurssiaikataulut SET aika=?, aihe=?, lisa=? WHERE id=?");
        $stmt->bind_param("sssi", $aika, $aihe, $lisa, $id);

        for ($i = 0; $i < $maara; $i++) {


            $aika = $lista1[$i];
            $aika = nl2br($aika);

            $aihe = $lista3[$i];

            $lisa = $lista4[$i];


            $id = $lista2[$i];
            $stmt->execute();
        }


        //menee yläpuolelle
        if (isset($_POST["jarjestys"])) {

            $jarjestys = $_POST["jarjestys"];
            $uusijarjestys = $jarjestys;

            if (!$paivitajarjestys = $db->query("select distinct * from kurssiaikataulut where kurssi_id = '" . $_SESSION[KurssiId] . "' AND jarjestys >= '" . $_POST["jarjestys"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];

                $jarj = $jarj + 1;
                $db->query("update kurssiaikataulut set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }
        //menee alapuolelle
        else {

            if (!$resultmax = $db->query("select MAX(jarjestys) as suurin from kurssiaikataulut where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($maxrow = $resultmax->fetch_assoc()) {
                $jarjestys = $maxrow[suurin];
            }
            $uusijarjestys = $jarjestys + 1;

            if (!$paivitajarjestys = $db->query("select distinct * from kurssiaikataulut where kurssi_id = '" . $_SESSION[KurssiId] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];

                $jarj = $jarj + 1;
                $db->query("update kurssiaikataulut set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }
        if (!empty($_POST[tehtmaara])) {

            $maara = $_POST[tehtmaara];

            if (!$haevika0 = $db->query("select distinct MAX(jarjestys) as jarjestys from kurssiaikataulut where kurssi_id='" . $_POST[kurssi] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP0 = $haevika0->fetch_assoc()) {

                $paluu = $rowP0[jarjestys] + 1;
            }



            while ($maara > 0) {

                if (!$haevika = $db->query("select distinct MAX(jarjestys) as jarjestys from kurssiaikataulut where kurssi_id='" . $_POST[kurssi] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                while ($rowP = $haevika->fetch_assoc()) {

                    $uusijarjestys = $rowP[jarjestys] + 1;
                }





                $db->query("insert into kurssiaikataulut (kurssi_id, jarjestys) values('" . $_POST[kurssi] . "', '" . $uusijarjestys . "')");






                $maara--;
            }
        }


        header('location: muokkaa_aikataulu.php?#' . $paluu);
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

