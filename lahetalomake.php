<?php
session_start(); 


ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    if (isset($_POST["painiket"])) {


        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];

        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE itsearvioinnit SET otsikko=? WHERE id=?");
        $stmt->bind_param("si", $sisalto, $id);

        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from itsearvioinnit where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
                $valiaihe = $rowP[valiaihe];
            }
            if ($aihe == 1 || $valiaihe == 1) {
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
            }
        }
        $stmt->close();
        header("location: itsearviointi.php");
    }

    if (isset($_POST["painikep"])) {


        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];

        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE itsearvioinnit SET otsikko=? WHERE id=?");
        $stmt->bind_param("si", $sisalto, $id);

        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from itsearvioinnit  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
                $valiaihe = $rowP[valiaihe];
            }
            if ($aihe == 1 || $valiaihe == 1) {
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
            }
        }





        $lista = $_POST["lista"];

        foreach ($lista as $id) {

            $db->query("delete from itsearvioinnit  where id = '" . $id . "'");
            $db->query("delete from itsearvioinnitkp where itsearvioinnit_id = '" . $id . "'");
        }


        //jarjestyksen paivitys!!


        if (!$haevika = $db->query("select distinct * from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
        }


        if (!$paivitajarjestys = $db->query("select distinct * from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "' order by jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $paivitetty = 0;
        while ($rowPJ = $paivitajarjestys->fetch_assoc()) {



            $id = $rowPJ[id];
            $db->query("update itsearvioinnit set jarjestys='" . $paivitetty . "' where id = '" . $id . "'");
            $paivitetty++;
        }

        $stmt->close();
        header("location: uusi_itsearviointi.php?id=" . $_POST[ipid] . "&monesko=" . $_POST[monesko] . "#tanne");
    }




    if (isset($_POST["painikelo"])) {

        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];

        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE itsearvioinnit SET otsikko=? WHERE id=?");
        $stmt->bind_param("si", $sisalto, $id);

        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from itsearvioinnit  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
                $valiaihe = $rowP[valiaihe];
            }
            if ($aihe == 1 || $valiaihe == 1) {
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
            }
        }





        //menee yläpuolelle
        if (isset($_POST["jarjestys"])) {
            $jarjestys = $_POST["jarjestys"];
            $uusijarjestys = $jarjestys;

            if (!$paivitajarjestys = $db->query("select distinct * from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];

                $jarj = $jarj + 1;
                $db->query("update itsearvioinnit  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }
        //menee alapuolelle
        else {
            $vika = 1;
            if (!$resultmax = $db->query("select MAX(jarjestys) as suurin from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($maxrow = $resultmax->fetch_assoc()) {
                $jarjestys = $maxrow[suurin];
            }
            $uusijarjestys = $jarjestys + 1;

            if (!$paivitajarjestys = $db->query("select distinct * from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];
                $jarj = $jarj + 1;
                $db->query("update itsearvioinnit  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }






        $stmt2 = $db->prepare("INSERT INTO itsearvioinnit (kurssi_id, otsikko, aihe, jarjestys) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("isii", $kurssi, $otsikko2, $aihe, $jarjestys);

        $kurssi = $_SESSION["KurssiId"];
        $otsikko2 = "(Pääotsikko)";
        $otsikko2 = nl2br($otsikko2);
        $aihe = 1;
        $jarjestys = $uusijarjestys;

        $stmt2->execute();

        if (!$haevika = $db->query("select distinct * from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
            $mihin = $rowP[jarjestys];
        }

        $stmt->close();
        $stmt2->close();

        if (isset($_POST["jarjestys"])) {

            $paluu = $_POST[jarjestys] - 1;

            header('location: uusi_itsearviointi.php?&monesko=' . $paluu . '#' . $paluu);
        } else {
            header('location: uusi_itsearviointi.php?&vikao=1&monesko=' . $mihin . '#tanne');
        }
    }

    if (isset($_POST["painikelvo"])) {

        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];

        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE itsearvioinnit SET otsikko=? WHERE id=?");
        $stmt->bind_param("si", $sisalto, $id);

        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from itsearvioinnit  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
                $valiaihe = $rowP[valiaihe];
            }
            if ($aihe == 1 || $valiaihe == 1) {
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
            }
        }





        //menee yläpuolelle
        if (isset($_POST["jarjestys"])) {
            $jarjestys = $_POST["jarjestys"];
            $uusijarjestys = $jarjestys;

            if (!$paivitajarjestys = $db->query("select distinct * from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];

                $jarj = $jarj + 1;
                $db->query("update itsearvioinnit  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }
        //menee alapuolelle
        else {
            $vika = 1;
            if (!$resultmax = $db->query("select MAX(jarjestys) as suurin from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($maxrow = $resultmax->fetch_assoc()) {
                $jarjestys = $maxrow[suurin];
            }
            $uusijarjestys = $jarjestys + 1;

            if (!$paivitajarjestys = $db->query("select distinct * from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];
                $jarj = $jarj + 1;
                $db->query("update itsearvioinnit  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }



        $stmt2 = $db->prepare("INSERT INTO itsearvioinnit (kurssi_id, otsikko, valiaihe, jarjestys) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("isii", $kurssi, $otsikko2, $aihe, $jarjestys);

        $kurssi = $_SESSION["KurssiId"];
        $otsikko2 = "(Väliotsikko)";
        $otsikko2 = nl2br($otsikko2);
        $aihe = 1;
        $jarjestys = $uusijarjestys;

        $stmt2->execute();






        if (!$haevika = $db->query("select distinct * from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
            $mihin = $rowP[jarjestys];
        }
        $stmt->close();
        $stmt2->close();
        if (isset($_POST["jarjestys"])) {

            $paluu = $_POST[jarjestys] - 1;

            header('location: uusi_itsearviointi.php?&monesko=' . $paluu . '#' . $paluu);
        } else {
            header('location: uusi_itsearviointi.php?&vikao=1&monesko=' . $mihin . '#tanne');
        }
    }
    if (isset($_POST["painikel"])) {

        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];


        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];
        $stmt = $db->prepare("UPDATE itsearvioinnit SET otsikko=? WHERE id=?");
        $stmt->bind_param("si", $sisalto, $id);
        for ($i = 0; $i < $maara; $i++) {

            if (!$haeaihe = $db->query("select distinct * from itsearvioinnit where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
                $valiaihe = $rowP[valiaihe];
            }
            if ($aihe == 1 || $valiaihe == 1) {
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
            }
        }


        //menee yläpuolelle
        if (isset($_POST["jarjestys"])) {
            $jarjestys = $_POST["jarjestys"];
            $uusijarjestys = $jarjestys;

            if (!$paivitajarjestys = $db->query("select distinct * from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];

                $jarj = $jarj + 1;
                $db->query("update itsearvioinnit  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }
        //menee alapuolelle
        else {

            if (!$resultmax = $db->query("select MAX(jarjestys) as suurin from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($maxrow = $resultmax->fetch_assoc()) {
                $jarjestys = $maxrow[suurin];
            }
            $uusijarjestys = $jarjestys + 1;

            if (!$paivitajarjestys = $db->query("select distinct * from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];

                $jarj = $jarj + 1;
                $db->query("update itsearvioinnit  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }


        $stmt2 = $db->prepare("INSERT INTO itsearvioinnit (kurssi_id, sisalto, aihe, jarjestys) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("isii", $kurssi, $otsikko2, $aihe, $jarjestys);

        $kurssi = $_SESSION["KurssiId"];
        $otsikko2 = "(Opiskelijan tekstikenttä)";
        $otsikko2 = nl2br($otsikko2);
        $aihe = 0;
        $jarjestys = $uusijarjestys;

        $stmt2->execute();


        if (!$haeuusin = $db->query("select distinct * from itsearvioinnit  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND aihe=0 AND (valiaihe=0 OR valiaihe IS NULL)")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowu = $haeuusin->fetch_assoc()) {
            $teid = $rowu[id];
        }

        if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND projekti_id=0 AND itseprojekti_id=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowo = $haeopiskelijat->fetch_assoc()) {
            $db->query("insert into itsearvioinnitkp (itsearvioinnit_id, kayttaja_id) values('" . $teid . "', '" . $rowo[opiskelija_id] . "')");
        }
        if (!$haevika = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
            $mihin = $rowP[jarjestys];
        }
        $stmt->close();
        $stmt2->close();
        if (isset($_POST["jarjestys"])) {

            $paluu = $_POST[jarjestys] - 1;

            header('location: uusi_itsearviointi.php?&monesko=' . $paluu . '#' . $paluu);
        } else {




            header('location: uusi_itsearviointi.php?id=' . $_POST[ipid] . '&vikat=1&monesko=' . $mihin . '#tanne');
        }
    }
    if (isset($_POST["painikeus"])) {




        header('location: uusi_itsearviointi.php?id=' . $_POST[ipid] . '&vikat=1&monesko=' . $mihin . '#tanne');
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

