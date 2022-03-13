<?php
session_start();
ob_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include("yhteys.php");
if ($_SESSION[vaihto] == 1) {
    if (!$tulos = $db->query("select * from kayttajat where id='" . $_SESSION["Id"] . "'")) {
        die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
    }

    if ($tulos->num_rows == 1) {

        while ($rivi = $tulos->fetch_assoc()) {
            $rooli = $rivi[rooli];
            $sposti = $rivi[sposti];
            $ekakerta = $rivi[ekakerta];
            $etunimi = $rivi[etunimi];
            $sukunimi = $rivi[sukunimi];
            $id = $rivi[id];
            $paiva = $rivi[paiva];
            $kello = $rivi[kello];
            $vahvistettu = $rivi[vahvistettu];
            $tarkistettu = $rivi[tarkistettu];
        }

        if ($vahvistettu == 1 && $tarkistettu == 1) {



            $_SESSION["Sposti"] = $sposti;

            $_SESSION["Rooli"] = $rooli;
            $_SESSION["Ekakerta"] = $ekakerta;
            $_SESSION["Etunimi"] = $etunimi;
            $_SESSION["Sukunimi"] = $sukunimi;
            $_SESSION["Id"] = $id;
            $_SESSION["Kayttajatunnus"] = $sposti;
            $_SESSION["Salasana"] = $krypattu;
        }
        $_SESSION["vaihto"] = 0;
    }
    if (!$result = $db->query("select distinct * from koulunadminit where kayttaja_id='" . $_SESSION["Id"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    //ei merkitty ylläpitäjäksi mihinkään oppilaitokseen
    if ($result->num_rows == 0) {
        
    } else {

        // vain yhden koulun ylläpitäjä

        if ($result->num_rows == 1 && ($_SESSION["Rooli"] <> 'admin')) {

            while ($row = $result->fetch_assoc()) {
                $kouluid = $row[koulu_id];
            }

            if ($_SESSION["Rooli"] == 'opettaja') {

                $_SESSION["Rooli"] = 'opeadmin';
            } else if ($_SESSION["Rooli"] == 'muu') {
                //merkitään muu-käyttäjä pelkäksi ylläpitäjäksi

                $_SESSION["Rooli"] = 'admink';
            }
        }
    }
}
if ($_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink') {

    header('location: kurssit.php');
} else {

    header('location: omatkurssit.php');
}