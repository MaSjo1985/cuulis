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
        $lista4 = $_POST["kysymys"];
        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];



        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from ia  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[onotsikko];
                $valiaihe = $rowP[onkysymys];
            }
            if ($aihe == 1) {
                $stmt = $db->prepare("UPDATE ia SET otsikko=? WHERE id=?");
                $stmt->bind_param("si", $sisalto, $id);
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                echo'<br>Otsikko: ' . $sisalto;
                $id = $lista2[$i];
                $onnistuuko = $stmt->execute();

                if (!$onnistuuko) {
                    
                } else {
                    
                }

                $stmt->close();
            }
        }
        $lista1 = $_POST["vaihtoehto"];
        $lista2 = $_POST["id2"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id2"];

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
        $lista1 = $_POST["vaihtoehtoc"];
        $lista2 = $_POST["idc"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["idc"];

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

    if (isset($_POST["painikep"])) {


        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["kysymys"];
        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];



        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from ia  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[onotsikko];
                $valiaihe = $rowP[onkysymys];
            }
            if ($aihe == 1) {
                $stmt = $db->prepare("UPDATE ia SET otsikko=? WHERE id=?");
                $stmt->bind_param("si", $sisalto, $id);
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
                $stmt->close();
            }
        }

        $lista1 = $_POST["vaihtoehto"];
        $lista2 = $_POST["id2"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id2"];

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
        $lista1 = $_POST["vaihtoehtoc"];
        $lista2 = $_POST["idc"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["idc"];

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





        $lista = $_POST["lista"];

        foreach ($lista as $id) {
            $db->query("delete from iavaihtoehdot  where ia_id = '" . $id . "'");
            $db->query("delete from ia  where id = '" . $id . "'");
            $db->query("delete from iakp where ia_id = '" . $id . "'");
            $db->query("delete from iakp_moni where ia_id = '" . $id . "'");
        }


        //jarjestyksen paivitys!!


        if (!$haevika = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
        }


        if (!$paivitajarjestys = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' order by jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $paivitetty = 0;
        while ($rowPJ = $paivitajarjestys->fetch_assoc()) {



            $id = $rowPJ[id];
            $db->query("update ia set jarjestys='" . $paivitetty . "' where id = '" . $id . "'");
            $paivitetty++;
        }

        $stmt->close();
$sid=$_POST["painikep"];
        header("location: uusi_ia.php?#poistopaluu".$sid);
    }




    if (isset($_POST["painikelt"]) || isset($_POST["painikelty"])) {


        if (isset($_POST["painikelt"])) {
            $sid = $_POST["painikelt"];
            $sid = substr($sid, 25);
            $sid = str_replace('(', '', $sid);
            $sid = str_replace(')', '', $sid);
        } else {
            $sid = $_POST["painikelty"];
            $sid = substr($sid, 37);
            $sid = str_replace('(', '', $sid);
            $sid = str_replace(')', '', $sid);
        }


        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["kysymys"];
        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];



        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from ia  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[onotsikko];
                $valiaihe = $rowP[onkysymys];
            }
            if ($aihe == 1) {
                $stmt = $db->prepare("UPDATE ia SET otsikko=? WHERE id=?");
                $stmt->bind_param("si", $sisalto, $id);
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
                $stmt->close();
            }
        }

        $lista1 = $_POST["vaihtoehto"];
        $lista2 = $_POST["id2"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id2"];

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
        $lista1 = $_POST["vaihtoehtoc"];
        $lista2 = $_POST["idc"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["idc"];

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




        //menee yläpuolelle
        if (isset($_POST["jarjestys"])) {
            $jarjestys = $_POST["jarjestys"];
            $uusijarjestys = $jarjestys;

            if (!$paivitajarjestys = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];

                $jarj = $jarj + 1;
                $db->query("update ia  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }
        //menee alapuolelle
        else {
            $vika = 1;
            if (!$resultmax = $db->query("select MAX(jarjestys) as suurin from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($maxrow = $resultmax->fetch_assoc()) {
                $jarjestys = $maxrow[suurin];
            }
            $uusijarjestys = $jarjestys + 1;

            if (!$paivitajarjestys = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];
                $jarj = $jarj + 1;
                $db->query("update ia  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }






        $stmt2 = $db->prepare("INSERT INTO ia (kurssi_id, vastaus, onvastaus, jarjestys, ia_sarakkeet_jarjestys, onteksti) VALUES (?, ?, ?, ?,?,?)");
        $stmt2->bind_param("isiiii", $kurssi, $otsikko2, $aihe, $jarjestys, $sid, $teksti);
        $sid = $sid;
        $kurssi = $_SESSION["KurssiId"];
        $otsikko2 = "(Tekstivastauskenttä)";
        $otsikko2 = nl2br($otsikko2);
        $teksti = 1;
        $aihe = 1;
        $jarjestys = $uusijarjestys;

        $stmt2->execute();

        //PITÄÄ LAITTAA iakp
        if (!$haeuusin = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND onvastaus=1")) {

            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowu = $haeuusin->fetch_assoc()) {
            $teid = $rowu[id];
        }

        if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND projekti_id=0 AND itseprojekti_id=0")) {

            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowo = $haeopiskelijat->fetch_assoc()) {
            $db->query("insert into iakp (ia_id, kayttaja_id) values('" . $teid . "', '" . $rowo[opiskelija_id] . "')");
        }

        if (!$haevika = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
            $mihin = $rowP[jarjestys];
        }

        $stmt2->close();
       if (!$monta = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='".$sid."'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        

        if($monta -> num_rows ==1){
                   
 $jarjestys=$jarjestys - 1;
        header('location: uusi_ia.php'); 
        }
        else{
                 
 $jarjestys=$jarjestys - 1;
        header('location: uusi_ia.php?#pj' . $jarjestys);   
        }
    }
    if (isset($_POST["painikelr"])) {


        $sid = $_POST["painikelr"];
        $sid = substr($sid, 23);
        $sid = str_replace('(', '', $sid);
        $sid = str_replace(')', '', $sid);

        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["kysymys"];
        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];



        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from ia  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[onotsikko];
                $valiaihe = $rowP[onkysymys];
            }
            if ($aihe == 1) {
                $stmt = $db->prepare("UPDATE ia SET otsikko=? WHERE id=?");
                $stmt->bind_param("si", $sisalto, $id);
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
                $stmt->close();
            }
        }

        $lista1 = $_POST["vaihtoehto"];
        $lista2 = $_POST["id2"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id2"];

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
        $lista1 = $_POST["vaihtoehtoc"];
        $lista2 = $_POST["idc"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["idc"];

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


        //menee yläpuolelle
        if (isset($_POST["jarjestys"])) {
            $jarjestys = $_POST["jarjestys"];
            $uusijarjestys = $jarjestys;

            if (!$paivitajarjestys = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];

                $jarj = $jarj + 1;
                $db->query("update ia  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }
        //menee alapuolelle
        else {
            $vika = 1;
            if (!$resultmax = $db->query("select MAX(jarjestys) as suurin from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($maxrow = $resultmax->fetch_assoc()) {
                $jarjestys = $maxrow[suurin];
            }
            $uusijarjestys = $jarjestys + 1;

            if (!$paivitajarjestys = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];
                $jarj = $jarj + 1;
                $db->query("update ia  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }






        $stmt2 = $db->prepare("INSERT INTO ia (kurssi_id, onradio, onvastaus, jarjestys, ia_sarakkeet_jarjestys) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("iiiii", $kurssi, $radio, $aihe, $jarjestys, $sid);
        $sid = $sid;
        $kurssi = $_SESSION["KurssiId"];

        $radio = 1;
        $aihe = 1;

        $jarjestys = $uusijarjestys;

        $stmt2->execute();



        if (!$haevika = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
            $mihin = $rowP[jarjestys];
        }

        $stmt2->close();
       if (!$monta = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='".$sid."'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        

        if($monta -> num_rows ==1){
                   
 $jarjestys=$jarjestys - 1;
        header('location: uusi_ia.php'); 
        }
        else{
                 
 $jarjestys=$jarjestys - 1;
        header('location: uusi_ia.php?#pj' . $jarjestys);   
        }
    }
    if (isset($_POST["painikelc"])) {


        $sid = $_POST["painikelc"];
        $sid = substr($sid, 24);
        $sid = str_replace('(', '', $sid);
        $sid = str_replace(')', '', $sid);

        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["kysymys"];
        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];



        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from ia  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[onotsikko];
                $valiaihe = $rowP[onkysymys];
            }
            if ($aihe == 1) {
                $stmt = $db->prepare("UPDATE ia SET otsikko=? WHERE id=?");
                $stmt->bind_param("si", $sisalto, $id);
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
                $stmt->close();
            }
        }

        $lista1 = $_POST["vaihtoehto"];
        $lista2 = $_POST["id2"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id2"];

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
        $lista1 = $_POST["vaihtoehtoc"];
        $lista2 = $_POST["idc"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["idc"];

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





        //menee yläpuolelle
        if (isset($_POST["jarjestys"])) {
            $jarjestys = $_POST["jarjestys"];
            $uusijarjestys = $jarjestys;

            if (!$paivitajarjestys = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];

                $jarj = $jarj + 1;
                $db->query("update ia  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }
        //menee alapuolelle
        else {
            $vika = 1;
            if (!$resultmax = $db->query("select MAX(jarjestys) as suurin from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($maxrow = $resultmax->fetch_assoc()) {
                $jarjestys = $maxrow[suurin];
            }
            $uusijarjestys = $jarjestys + 1;

            if (!$paivitajarjestys = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];
                $jarj = $jarj + 1;
                $db->query("update ia  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }






        $stmt2 = $db->prepare("INSERT INTO ia (kurssi_id, oncheckbox, onvastaus, jarjestys, ia_sarakkeet_jarjestys) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("iiiii", $kurssi, $checkbox, $aihe, $jarjestys, $sid);
        $sid = $sid;
        $kurssi = $_SESSION["KurssiId"];

        $checkbox = 1;
        $aihe = 1;

        $jarjestys = $uusijarjestys;

        $stmt2->execute();

        //PITÄÄ LAITTAA iakp


        if (!$haevika = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
            $mihin = $rowP[jarjestys];
        }

        $stmt2->close();
               if (!$monta = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='".$sid."'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        

        if($monta -> num_rows ==1){
                   
 $jarjestys=$jarjestys - 1;
        header('location: uusi_ia.php'); 
        }
        else{
                 
 $jarjestys=$jarjestys - 1;
        header('location: uusi_ia.php?#pj' . $jarjestys);   
        }
    }
    if (isset($_POST["painikelo"]) || isset($_POST["painikeloy"])) {

  
        if (isset($_POST["painikelo"])) {
            $sid = $_POST["painikelo"];
            $sid = substr($sid, 27);
            $sid = str_replace('(', '', $sid);
            $sid = str_replace(')', '', $sid);
        } else {
            $sid = $_POST["painikeloy"];
            $sid = substr($sid, 39);
            $sid = str_replace('(', '', $sid);
            $sid = str_replace(')', '', $sid);
        }
        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["kysymys"];
        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];

        if (!$haemax = $db->query("select distinct MAX(jarjestys) as jarjestys from ia  where ia_sarakkeet_jarjestys='".$sid."' AND kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowmax = $haemax->fetch_assoc()) {

            $vanhamax = $rowmax[jarjestys];
            
        }

        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from ia  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[onotsikko];
                $valiaihe = $rowP[onkysymys];
            }
            if ($aihe == 1) {
                $stmt = $db->prepare("UPDATE ia SET otsikko=? WHERE id=?");
                $stmt->bind_param("si", $sisalto, $id);
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);

                $id = $lista2[$i];
                $stmt->execute();
                $stmt->close();
            }
        }

        $lista1 = $_POST["vaihtoehto"];
        $lista2 = $_POST["id2"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id2"];

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
        $lista1 = $_POST["vaihtoehtoc"];
        $lista2 = $_POST["idc"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["idc"];

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


        //menee yläpuolelle
        if (isset($_POST["jarjestys"])) {

            $jarjestys = $_POST["jarjestys"];
            $uusijarjestys = $jarjestys;

            if (!$paivitajarjestys = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];

                $jarj = $jarj + 1;
                $db->query("update ia  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }

        //menee alapuolelle
        else {
            $vika = 1;
            if (!$resultmax = $db->query("select MAX(jarjestys) as suurin from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($maxrow = $resultmax->fetch_assoc()) {
                $jarjestys = $maxrow[suurin];
            }
            $uusijarjestys = $jarjestys + 1;

            if (!$paivitajarjestys = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >= '" . $uusijarjestys . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowPJ = $paivitajarjestys->fetch_assoc()) {

                $jarj = $rowPJ[jarjestys];
                $teid = $rowPJ[id];
                $jarj = $jarj + 1;
                $db->query("update ia  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            }
        }



        $stmt2 = $db->prepare("INSERT INTO ia (kurssi_id, otsikko, onotsikko, jarjestys, ia_sarakkeet_jarjestys) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("isiii", $kurssi, $otsikko2, $aihe, $jarjestys, $sid);
        $sid = $sid;

        $kurssi = $_SESSION["KurssiId"];
        $otsikko2 = "";
        $otsikko2 = nl2br($otsikko2);
        $aihe = 1;
        $jarjestys = $uusijarjestys;

        $stmt2->execute();
        $stmt2->close();
        
        if (!$haemax2 = $db->query("select distinct MAX(jarjestys) as jarjestys from ia  where ia_sarakkeet_jarjestys='".$sid."' AND kurssi_id = '" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowmax2 = $haemax2->fetch_assoc()) {

            $uusinmax = $rowmax2[jarjestys];
        }
   
       
        
        if (!$monta = $db->query("select distinct * from ia  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='".$sid."'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        

        if($monta -> num_rows ==1){
                   
 $jarjestys=$jarjestys - 1;
        header('location: uusi_ia.php'); 
        }
        else if($uusinmax-1 != $vanhamax){
             header('location: uusi_ia.php?#pj' . $vanhamax); 
        }
        else{
                 
 $jarjestys=$jarjestys - 1;
        header('location: uusi_ia.php?#pj' . $jarjestys);   
        }

    }

    if (isset($_POST["painikeus"])) {

        if (!$haejarjestys = $db->query("select distinct MAX(jarjestys) as maxj from ia_sarakkeet where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowj = $haejarjestys->fetch_assoc()) {

            $jarjestys = $rowj[maxj];
        }
        $jarjestys++;
        $db->query("insert into ia_sarakkeet (kurssi_id, jarjestys) values('" . $_SESSION["KurssiId"] . "', '" . $jarjestys . "')");


        header('location: uusi_ia.php');
    }
    if (isset($_POST["painikeps"])) {
        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["kysymys"];
        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];



        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from ia  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[onotsikko];
                $valiaihe = $rowP[onkysymys];
            }
            if ($aihe == 1) {
                $stmt = $db->prepare("UPDATE ia SET otsikko=? WHERE id=?");
                $stmt->bind_param("si", $sisalto, $id);
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
                $stmt->close();
            }
        }

        $lista1 = $_POST["vaihtoehto"];
        $lista2 = $_POST["id2"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id2"];

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
        $lista1 = $_POST["vaihtoehtoc"];
        $lista2 = $_POST["idc"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["idc"];

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
        //iakp + iakommentit pitää myös poistaa
        $jarjestys = $_POST["painikeps"];

        $jarjestys = substr($jarjestys, 14);

        if (!$haesid = $db->query("select distinct id from ia_sarakkeet where jarjestys='" . $jarjestys . "' AND kurssi_id='" . $_SESSION[KurssiId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowsid = $haesid->fetch_assoc()) {
            $sid = $rowsid[id];
        }

        if (!$haeia = $db->query("select distinct id from ia where ia_sarakkeet_jarjestys='" . $jarjestys . "' AND kurssi_id='" . $_SESSION[KurssiId] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowia = $haeia->fetch_assoc()) {

            $iaid = $rowia[id];


            $db->query("delete from iakp where ia_id = '" . $iaid . "'");
            $db->query("delete from iakp_moni where ia_id = '" . $iaid . "'");

            $db->query("delete from iavaihtoehdot where ia_id = '" . $iaid . "'");
            $db->query("delete from ia where id = '" . $iaid . "'");
        }


        $db->query("delete from ia_sarakkeet where id = '" . $sid . "'");

        echo'<br>JARJESTYS: ' . $jarjestys;
        if (!$paivitajarjestys = $db->query("select distinct * from ia_sarakkeet  where kurssi_id = '" . $_SESSION["KurssiId"] . "' AND jarjestys >'" . $jarjestys . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $monta = 0;
        while ($rowPJ = $paivitajarjestys->fetch_assoc()) {
            $monta++;
            $jarj = $rowPJ[jarjestys];
            echo'<br>jarjestys alussa ' . $jarj;
            $teid = $rowPJ[id];

            $jarj = $jarj - 1;
            $db->query("update ia_sarakkeet  set jarjestys='" . $jarj . "' where id = '" . $rowPJ[id] . "'");
            echo'<br>jarjestys lopussa ' . $jarj;
            $monta--;
        }
        header('location: uusi_ia.php');
    }

    if (isset($_POST["painikeprv"])) {


        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["kysymys"];
        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];



        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from ia  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[onotsikko];
                $valiaihe = $rowP[onkysymys];
            }
            if ($aihe == 1) {
                $stmt = $db->prepare("UPDATE ia SET otsikko=? WHERE id=?");
                $stmt->bind_param("si", $sisalto, $id);
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
                $stmt->close();
            }
        }

        $lista1 = $_POST["vaihtoehto"];
        $lista2 = $_POST["id2"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id2"];

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
        $lista1 = $_POST["vaihtoehtoc"];
        $lista2 = $_POST["idc"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["idc"];

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

        $lista = $_POST["listar"];

        foreach ($lista as $id) {
            if (!$haeia = $db->query("select distinct * from iavaihtoehdot  where id='" . $id . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeia->fetch_assoc()) {
                $iaid=$rowP[ia_id];
                if (!$haejarj = $db->query("select distinct * from ia  where id='" . $rowP[ia_id] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowj = $haejarj->fetch_assoc()) {
                    $sid = $rowj[jarjestys];
                }
                $db->query("delete from iakp where ia_id = '" . $rowP[ia_id] . "'");
                $db->query("delete from iakp_moni where ia_id = '" . $rowP[ia_id] . "'");
            }

            $db->query("delete from iavaihtoehdot where id = '" . $id . "'");
        }



        $stmt->close();
        
           if (!$haejarj = $db->query("select distinct * from ia  where id='" . $iaid . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
             while ($rowJ = $haejarj->fetch_assoc()) {
                 $jarjestys=$rowJ[jarjestys];
             }
            
       $jarjestys=$jarjestys - 1;
        header('location: uusi_ia.php?#pj' . $jarjestys);
     
       
    }
    if (isset($_POST["painikepcv"])) {

        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["kysymys"];
        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];



        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from ia  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[onotsikko];
                $valiaihe = $rowP[onkysymys];
            }
            if ($aihe == 1) {
                $stmt = $db->prepare("UPDATE ia SET otsikko=? WHERE id=?");
                $stmt->bind_param("si", $sisalto, $id);
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
                $stmt->close();
            }
        }

        $lista1 = $_POST["vaihtoehto"];
        $lista2 = $_POST["id2"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id2"];

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
        $lista1 = $_POST["vaihtoehtoc"];
        $lista2 = $_POST["idc"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["idc"];

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

        $lista = $_POST["listac"];

        foreach ($lista as $id) {
            if (!$haeia = $db->query("select distinct * from iavaihtoehdot  where id='" . $id . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeia->fetch_assoc()) {
                $iaid=$rowP[ia_id];
                if (!$haejarj = $db->query("select distinct * from ia  where id='" . $rowP[ia_id] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowj = $haejarj->fetch_assoc()) {
                    $sid = $rowj[jarjestys];
                }
                $db->query("delete from iakp where ia_id = '" . $rowP[ia_id] . "'");
                $db->query("delete from iakp_moni where ia_id = '" . $rowP[ia_id] . "'");
            }
            $db->query("delete from iavaihtoehdot where id = '" . $id . "'");
        }
 $stmt->close();
           if (!$haejarj = $db->query("select distinct * from ia  where id='" . $iaid . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
             while ($rowJ = $haejarj->fetch_assoc()) {
                 $jarjestys=$rowJ[jarjestys];
             }
            
        $jarjestys=$jarjestys - 1;
        header('location: uusi_ia.php?#pj' . $jarjestys);
    }




    if (isset($_POST["painikelrv"])) {

        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["kysymys"];
        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];



        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from ia  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[onotsikko];
                $valiaihe = $rowP[onkysymys];
            }
            if ($aihe == 1) {
                $stmt = $db->prepare("UPDATE ia SET otsikko=? WHERE id=?");
                $stmt->bind_param("si", $sisalto, $id);
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
                $stmt->close();
            }
        }

        $lista1 = $_POST["vaihtoehto"];
        $lista2 = $_POST["id2"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id2"];

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
        $lista1 = $_POST["vaihtoehtoc"];
        $lista2 = $_POST["idc"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["idc"];

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


        $sid = $_POST["painikelrv"];
        $sid = substr($sid, 21);
        $sid = str_replace('(', '', $sid);
        $sid = str_replace(')', '', $sid);

        $db->query("insert into iavaihtoehdot (ia_id) values('" . $sid . "')");

        //PITÄÄ LAITTAA iakp
        if (!$haeuusin = $db->query("select distinct * from iavaihtoehdot  where ia_id = '" . $sid . "'")) {

            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowu = $haeuusin->fetch_assoc()) {
            $teid = $rowu[id];
        }

        if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND projekti_id=0 AND itseprojekti_id=0")) {

            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowo = $haeopiskelijat->fetch_assoc()) {

            $db->query("insert into iakp (ia_id, kayttaja_id) values('" . $sid . "', '" . $rowo[opiskelija_id] . "')");
        }

        $stmt->close();


        if (!$haejarj = $db->query("select distinct * from ia  where id='" . $sid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowj = $haejarj->fetch_assoc()) {
            $jarjestys = $rowj[jarjestys];
        }


            
       $jarjestys=$jarjestys - 1;
        header('location: uusi_ia.php?focus='.$teid.'#pj' . $jarjestys);
    }
    if (isset($_POST["painikelcv"])) {

        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];
        $lista4 = $_POST["kysymys"];
        $maara = 0;
        if (!empty($lista2)) {
            foreach ($lista2 as $id) {
                $maara++;
            }
        }

        $lista2 = $_POST["id"];



        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from ia  where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[onotsikko];
                $valiaihe = $rowP[onkysymys];
            }
            if ($aihe == 1) {
                $stmt = $db->prepare("UPDATE ia SET otsikko=? WHERE id=?");
                $stmt->bind_param("si", $sisalto, $id);
                $sisalto = $lista3[$i];
                $sisalto = nl2br($sisalto);
                $id = $lista2[$i];
                $stmt->execute();
                $stmt->close();
            }
        }

        $lista1 = $_POST["vaihtoehto"];
        $lista2 = $_POST["id2"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id2"];

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
        $lista1 = $_POST["vaihtoehtoc"];
        $lista2 = $_POST["idc"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["idc"];

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

        $sid = $_POST["painikelcv"];
        $sid = substr($sid, 21);
        $sid = str_replace('(', '', $sid);
        $sid = str_replace(')', '', $sid);

        $db->query("insert into iavaihtoehdot (ia_id) values('" . $sid . "')");



        //PITÄÄ LAITTAA iakp
        if (!$haeuusin = $db->query("select distinct * from iavaihtoehdot  where ia_id = '" . $sid . "'")) {

            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowu = $haeuusin->fetch_assoc()) {
            $teid = $rowu[id];
        }

        if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND projekti_id=0 AND itseprojekti_id=0")) {

            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowo = $haeopiskelijat->fetch_assoc()) {

            $db->query("insert into iakp (ia_id, kayttaja_id) values('" . $sid . "', '" . $rowo[opiskelija_id] . "')");
        }


        $stmt->close();


        if (!$haejarj = $db->query("select distinct * from ia  where id='" . $sid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowj = $haejarj->fetch_assoc()) {
            $sid = $rowj[jarjestys];
        }
        $sid = $sid - 1;

         if (!$haejarj = $db->query("select distinct * from ia  where id='" . $sid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowj = $haejarj->fetch_assoc()) {
            $jarjestys = $rowj[jarjestys];
        }


            
       $jarjestys=$jarjestys - 1;
        header('location: uusi_ia.php?focus='.$teid.'#pj' . $jarjestys);
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

