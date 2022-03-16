<?php
session_start();

ob_start();
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    if (isset($_POST["painiket"])) {

        $lista1 = $_POST["sisalto"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["paino"];
        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        if ($_POST[painotus] == 1) {
            $db->query("update itseprojektit set painotus = 1 where id = '" . $_POST[ipid] . "'");

            if ($_POST[omapisteytys] == 1) {
                $db->query("update itseprojektit set itsepisteytys = 1 where id = '" . $_POST[ipid] . "'");
            } else if ($_POST[omapisteytys] == 0) {
                $db->query("update itseprojektit set itsepisteytys = 0 where id = '" . $_POST[ipid] . "'");
            }
        } else if ($_POST[painotus] == 0) {
            $db->query("update itseprojektit set painotus = 0 where id = '" . $_POST[ipid] . "'");
            $db->query("update itseprojektit set itsepisteytys = 0 where id = '" . $_POST[ipid] . "'");
        }





        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE itsetehtavat SET sisalto=? WHERE id=?");
        $stmt->bind_param("si", $sisalto, $id);

        $stmt2 = $db->prepare("UPDATE itsetehtavat SET otsikko=? WHERE id=?");
        $stmt2->bind_param("si", $sisalto, $id);


        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from itsetehtavat where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
            }
            if ($aihe == 0) {
                $sisalto = $lista1[$i];
                $sisalto = nl2br($sisalto);

                $id = $lista2[$i];
                $stmt->execute();
            } else {
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);

                $id = $lista2[$i];
                $stmt2->execute();
            }
            $paino = $lista4[$i];
            if ($paino != -1) {

                $db->query("update itsetehtavat set paino='" . $paino . "' where id = '" . $lista2[$i] . "'");
            }
        }
        $stmt->close();
        $stmt2->close();
        header("location: itsetyot.php?i=" . $_POST[ipid] . "#palaa");
    }

    if (isset($_POST["painikep"])) {

        $lista1 = $_POST["sisalto"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["paino"];

        if ($_POST[painotus] == 1) {
            $db->query("update itseprojektit set painotus = 1 where id = '" . $_POST[ipid] . "'");

            if ($_POST[omapisteytys] == 1) {
                $db->query("update itseprojektit set itsepisteytys = 1 where id = '" . $_POST[ipid] . "'");
            } else if ($_POST[omapisteytys] == 0) {
                $db->query("update itseprojektit set itsepisteytys = 0 where id = '" . $_POST[ipid] . "'");
            }
        } else if ($_POST[painotus] == 0) {
            $db->query("update itseprojektit set painotus = 0 where id = '" . $_POST[ipid] . "'");
            $db->query("update itseprojektit set itsepisteytys = 0 where id = '" . $_POST[ipid] . "'");
        }



        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE itsetehtavat SET sisalto=? WHERE id=?");
        $stmt->bind_param("si", $sisalto, $id);

        $stmt2 = $db->prepare("UPDATE itsetehtavat SET otsikko=? WHERE id=?");
        $stmt2->bind_param("si", $sisalto, $id);


        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from itsetehtavat where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
            }
            if ($aihe == 0) {
                $sisalto = $lista1[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
            } else {
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt2->execute();
            }
            $paino = $lista4[$i];
            if ($paino != -1) {

                $db->query("update itsetehtavat set paino='" . $paino . "' where id = '" . $lista2[$i] . "'");
            }
        }

        $lista2 = $_POST["lista"];

        foreach ($lista2 as $vika) {
            if (!$haevika = $db->query("select distinct * from itsetehtavat where id='" . $vika . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowP = $haevika->fetch_assoc()) {

                $id = $rowP[id];
                $mihin = $rowP[jarjestys];
            }
        }


        $mihin = $mihin - 5;

        $lista = $_POST["lista"];

        foreach ($lista as $id) {

            $db->query("delete from itsetehtavat where id = '" . $id . "'");
            $db->query("delete from itsetehtavatkp where itsetehtavat_id = '" . $id . "'");
        }


        //jarjestyksen paivitys!!


        if (!$haevika = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
        }


        if (!$paivitajarjestys = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "' order by jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $paivitetty = 0;
        while ($rowPJ = $paivitajarjestys->fetch_assoc()) {



            $id = $rowPJ[id];
            $db->query("update itsetehtavat set jarjestys='" . $paivitetty . "' where id = '" . $id . "'");
            $paivitetty++;
        }
        $stmt->close();
        $stmt2->close();










        header('location: testaamuokkaus.php?id=' . $_POST[ipid] . '&monesko=' . $mihin . '#' . $mihin);
    }




    if (isset($_POST["painikelo"])) {

        $lista1 = $_POST["sisalto"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["paino"];


        if ($_POST[painotus] == 1) {
            $db->query("update itseprojektit set painotus = 1 where id = '" . $_POST[ipid] . "'");

            if ($_POST[omapisteytys] == 1) {
                $db->query("update itseprojektit set itsepisteytys = 1 where id = '" . $_POST[ipid] . "'");
            } else if ($_POST[omapisteytys] == 0) {
                $db->query("update itseprojektit set itsepisteytys = 0 where id = '" . $_POST[ipid] . "'");
            }
        } else if ($_POST[painotus] == 0) {
            $db->query("update itseprojektit set painotus = 0 where id = '" . $_POST[ipid] . "'");
            $db->query("update itseprojektit set itsepisteytys = 0 where id = '" . $_POST[ipid] . "'");
        }



        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE itsetehtavat SET sisalto=? WHERE id=?");
        $stmt->bind_param("si", $sisalto, $id);

        $stmt2 = $db->prepare("UPDATE itsetehtavat SET otsikko=? WHERE id=?");
        $stmt2->bind_param("si", $sisalto, $id);

        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from itsetehtavat where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
            }
            if ($aihe == 0) {
                $sisalto = $lista1[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
            } else {
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt2->execute();
            }
            $paino = $lista4[$i];
            if ($paino != -1) {

                $db->query("update itsetehtavat set paino='" . $paino . "' where id = '" . $lista2[$i] . "'");
            }
        }





        //menee yläpuolelle
        if (isset($_POST["jarjestys"])) {
            $jarjestys = $_POST["jarjestys"];
            $uusijarjestys = $jarjestys;

            if (!$paivitajarjestys = $db->query("select distinct * from itsetehtavat where itseprojektit_id = '" . $_POST[ipid] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];

                $jarj = $jarj + 1;
                $db->query("update itsetehtavat set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }
        //menee alapuolelle
        else {
            $vika = 1;
            if (!$resultmax = $db->query("select MAX(jarjestys) as suurin from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($maxrow = $resultmax->fetch_assoc()) {
                $jarjestys = $maxrow[suurin];
            }
            $uusijarjestys = $jarjestys + 1;

            if (!$paivitajarjestys = $db->query("select distinct * from itsetehtavat where itseprojektit_id = '" . $_POST[ipid] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];
                $jarj = $jarj + 1;
                $db->query("update itsetehtavat set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }









        $db->query("insert into itsetehtavat (itseprojektit_id, aihe, jarjestys) values('" . $_POST[ipid] . "', 1, '" . $uusijarjestys . "')");

        if (!$haevika = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
            $mihin = $rowP[jarjestys];
        }
        $stmt->close();
        $stmt2->close();

        if (isset($_POST["jarjestys"])) {

            $paluu = $_POST[jarjestys] - 5;

            header('location: testaamuokkaus.php?id=' . $_POST[ipid] . '&monesko=' . $paluu . '#' . $paluu);
        } else {
            header('location: testaamuokkaus.php?id=' . $_POST[ipid] . '&vikao=1&monesko=' . $mihin . '#tannetakas');
        }
    }
    if (isset($_POST["painikel"])) {

        $lista1 = $_POST["sisalto"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["paino"];


        if ($_POST[painotus] == 1) {
            $db->query("update itseprojektit set painotus = 1 where id = '" . $_POST[ipid] . "'");

            if ($_POST[omapisteytys] == 1) {
                $db->query("update itseprojektit set itsepisteytys = 1 where id = '" . $_POST[ipid] . "'");
            } else if ($_POST[omapisteytys] == 0) {
                $db->query("update itseprojektit set itsepisteytys = 0 where id = '" . $_POST[ipid] . "'");
            }
        } else if ($_POST[painotus] == 0) {
            $db->query("update itseprojektit set painotus = 0 where id = '" . $_POST[ipid] . "'");
            $db->query("update itseprojektit set itsepisteytys = 0 where id = '" . $_POST[ipid] . "'");
        }

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE itsetehtavat SET sisalto=? WHERE id=?");
        $stmt->bind_param("si", $sisalto, $id);

        $stmt2 = $db->prepare("UPDATE itsetehtavat SET otsikko=? WHERE id=?");
        $stmt2->bind_param("si", $sisalto, $id);

        for ($i = 0; $i < $maara; $i++) {

            if (!$haeaihe = $db->query("select distinct * from itsetehtavat where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
            }
            if ($aihe == 0) {
                $sisalto = $lista1[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
            } else {
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt2->execute();
            }
            $paino = $lista4[$i];
            if ($paino != -1) {

                $db->query("update itsetehtavat set paino='" . $paino . "' where id = '" . $lista2[$i] . "'");
            }
        }


        //menee yläpuolelle
        if (isset($_POST["jarjestys"])) {
            $jarjestys = $_POST["jarjestys"];
            $uusijarjestys = $jarjestys;

            if (!$paivitajarjestys = $db->query("select distinct * from itsetehtavat where itseprojektit_id = '" . $_POST[ipid] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];

                $jarj = $jarj + 1;
                $db->query("update itsetehtavat set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }
        //menee alapuolelle
        else {

            if (!$resultmax = $db->query("select MAX(jarjestys) as suurin from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($maxrow = $resultmax->fetch_assoc()) {
                $jarjestys = $maxrow[suurin];
            }
            $uusijarjestys = $jarjestys + 1;

            if (!$paivitajarjestys = $db->query("select distinct * from itsetehtavat where itseprojektit_id = '" . $_POST[ipid] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];

                $jarj = $jarj + 1;
                $db->query("update itsetehtavat set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }







        $db->query("insert into itsetehtavat (itseprojektit_id, jarjestys) values('" . $_POST[ipid] . "', '" . $uusijarjestys . "')");


        if (!$haeuusin = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowu = $haeuusin->fetch_assoc()) {
            $teid = $rowu[id];
        }

        if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where itseprojekti_id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowo = $haeopiskelijat->fetch_assoc()) {
            $db->query("insert into itsetehtavatkp (itsetehtavat_id, kayttaja_id) values('" . $teid . "', '" . $rowo[opiskelija_id] . "')");
        }
        if (!$haevika = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
            $mihin = $rowP[jarjestys];
        }
        $stmt->close();
        $stmt2->close();
        if (isset($_POST["jarjestys"])) {

            $paluu = $_POST[jarjestys] - 5;

            header('location: testaamuokkaus.php?id=' . $_POST[ipid] . '&monesko=' . $paluu . '#' . $paluu);
        } else {




            header('location: testaamuokkaus.php?id=' . $_POST[ipid] . '&vikat=1&monesko=' . $mihin . '#tannetakas');
        }
    }
    if (isset($_POST["painikek"])) {

        $lista1 = $_POST["sisalto"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["paino"];
        $lista5 = $_POST["kopid"];


        if ($_POST[painotus] == 1) {
            $db->query("update itseprojektit set painotus = 1 where id = '" . $_POST[ipid] . "'");

            if ($_POST[omapisteytys] == 1) {
                $db->query("update itseprojektit set itsepisteytys = 1 where id = '" . $_POST[ipid] . "'");
            } else if ($_POST[omapisteytys] == 0) {
                $db->query("update itseprojektit set itsepisteytys = 0 where id = '" . $_POST[ipid] . "'");
            }
        } else if ($_POST[painotus] == 0) {
            $db->query("update itseprojektit set painotus = 0 where id = '" . $_POST[ipid] . "'");
            $db->query("update itseprojektit set itsepisteytys = 0 where id = '" . $_POST[ipid] . "'");
        }

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE itsetehtavat SET sisalto=? WHERE id=?");
        $stmt->bind_param("si", $sisalto, $id);

        $stmt2 = $db->prepare("UPDATE itsetehtavat SET otsikko=? WHERE id=?");
        $stmt2->bind_param("si", $sisalto, $id);

        for ($i = 0; $i < $maara; $i++) {

            if (!$haeaihe = $db->query("select distinct * from itsetehtavat where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
            }
            if ($aihe == 0) {
                $sisalto = $lista1[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
            } else {
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt2->execute();
            }
            $paino = $lista4[$i];
            if ($paino != -1) {

                $db->query("update itsetehtavat set paino='" . $paino . "' where id = '" . $lista2[$i] . "'");
            }
        }


        //menee yläpuolelle
        if (isset($_POST["jarjestys"])) {
            $jarjestys = $_POST["jarjestys"];
            $uusijarjestys = $jarjestys;

            if (!$paivitajarjestys = $db->query("select distinct * from itsetehtavat where itseprojektit_id = '" . $_POST[ipid] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];

                $jarj = $jarj + 1;
                $db->query("update itsetehtavat set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }
        //menee alapuolelle
        else {

            if (!$resultmax = $db->query("select MAX(jarjestys) as suurin from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($maxrow = $resultmax->fetch_assoc()) {
                $jarjestys = $maxrow[suurin];
            }
            $uusijarjestys = $jarjestys + 1;

            if (!$paivitajarjestys = $db->query("select distinct * from itsetehtavat where itseprojektit_id = '" . $_POST[ipid] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];

                $jarj = $jarj + 1;
                $db->query("update itsetehtavat set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }

        if (!empty($lista5)) {
            foreach ($lista5 as $kopid) {

                if (!$haetiedot = $db->query("select distinct * from itsetehtavat where id='" . $kopid . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowtiedot = $haetiedot->fetch_assoc()) {
                    $sisalto = $rowtiedot[sisalto];

                    $ipid = $rowtiedot[itseprojektit_id];
                }

                $db->query("insert into itsetehtavat (itseprojektit_id, sisalto, jarjestys) values('" . $ipid . "', '" . $sisalto . "', '" . $uusijarjestys . "')");

                $uusijarjestys = $uusijarjestys + 1;
            }
        }








        if (!$haeuusin = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowu = $haeuusin->fetch_assoc()) {
            $teid = $rowu[id];
        }

        if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where itseprojekti_id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowo = $haeopiskelijat->fetch_assoc()) {
            $db->query("insert into itsetehtavatkp (itsetehtavat_id, kayttaja_id) values('" . $teid . "', '" . $rowo[opiskelija_id] . "')");
        }
        if (!$haevika = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
            $mihin = $rowP[jarjestys];
        }
        $stmt->close();
        $stmt2->close();
        if (isset($_POST["jarjestys"])) {

            $paluu = $_POST[jarjestys] - 5;

            header('location: testaamuokkaus.php?id=' . $_POST[ipid] . '&monesko=' . $paluu . '#' . $paluu);
        } else {




            header('location: testaamuokkaus.php?id=' . $_POST[ipid] . '&vikat=1&monesko=' . $mihin . '#tanne');
        }
    }
    if (isset($_POST["lisaa"])) {

        if (!empty($_POST[tehtmaara])) {

            $lista1 = $_POST["sisalto"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["paino"];


        if ($_POST[painotus] == 1) {
            $db->query("update itseprojektit set painotus = 1 where id = '" . $_POST[ipid] . "'");

            if ($_POST[omapisteytys] == 1) {
                $db->query("update itseprojektit set itsepisteytys = 1 where id = '" . $_POST[ipid] . "'");
            } else if ($_POST[omapisteytys] == 0) {
                $db->query("update itseprojektit set itsepisteytys = 0 where id = '" . $_POST[ipid] . "'");
            }
        } else if ($_POST[painotus] == 0) {
            $db->query("update itseprojektit set painotus = 0 where id = '" . $_POST[ipid] . "'");
            $db->query("update itseprojektit set itsepisteytys = 0 where id = '" . $_POST[ipid] . "'");
        }

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        $stmt = $db->prepare("UPDATE itsetehtavat SET sisalto=? WHERE id=?");
        $stmt->bind_param("si", $sisalto, $id);

        $stmt2 = $db->prepare("UPDATE itsetehtavat SET otsikko=? WHERE id=?");
        $stmt2->bind_param("si", $sisalto, $id);

        for ($i = 0; $i < $maara; $i++) {

            if (!$haeaihe = $db->query("select distinct * from itsetehtavat where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
            }
            if ($aihe == 0) {
                $sisalto = $lista1[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
            } else {
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt2->execute();
            }
            $paino = $lista4[$i];
            if ($paino != -1) {

                $db->query("update itsetehtavat set paino='" . $paino . "' where id = '" . $lista2[$i] . "'");
            }
        }


        //menee yläpuolelle
        if (isset($_POST["jarjestys"])) {
            $jarjestys = $_POST["jarjestys"];
            $uusijarjestys = $jarjestys;

            if (!$paivitajarjestys = $db->query("select distinct * from itsetehtavat where itseprojektit_id = '" . $_POST[ipid] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];

                $jarj = $jarj + 1;
                $db->query("update itsetehtavat set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }
        //menee alapuolelle
        else {

            if (!$resultmax = $db->query("select MAX(jarjestys) as suurin from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($maxrow = $resultmax->fetch_assoc()) {
                $jarjestys = $maxrow[suurin];
            }
            $uusijarjestys = $jarjestys + 1;

            if (!$paivitajarjestys = $db->query("select distinct * from itsetehtavat where itseprojektit_id = '" . $_POST[ipid] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];

                $jarj = $jarj + 1;
                $db->query("update itsetehtavat set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }


            
            
            $maara = $_POST[tehtmaara];


            if (!$haevika0 = $db->query("select distinct MAX(jarjestys) as jarjestys from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowP0 = $haevika0->fetch_assoc()) {

                $paluu = $rowP0[jarjestys] + 1;
            }


            while ($maara > 0) {
                if (!$haevika = $db->query("select distinct MAX(jarjestys) as jarjestys from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                while ($rowP = $haevika->fetch_assoc()) {

                    $uusijarjestys = $rowP[jarjestys] + 1;
                }



                $db->query("insert into itsetehtavat (itseprojektit_id, jarjestys, aihe) values('" . $_POST[ipid] . "', '" . $uusijarjestys . "', 0)");

                if (!$haeuusin = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowu = $haeuusin->fetch_assoc()) {
                    $teid = $rowu[id];
                }

                if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where itseprojekti_id='" . $_POST[ipid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                while ($rowo = $haeopiskelijat->fetch_assoc()) {
                    $db->query("insert into itsetehtavatkp (itsetehtavat_id, kayttaja_id) values('" . $teid . "', '" . $rowo[opiskelija_id] . "')");
                }





                $maara--;
            }
        }

        header('location: testaamuokkaus.php?id=' . $_POST[ipid] . '&monesko=' . $paluu . '#' . $paluu);
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

