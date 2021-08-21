<?php

include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if ($_POST['arvo'] == 'vaihda') {

    //onko eka kerta?
    if (!$onkojo = $db->query("select distinct * from opiskelijankurssit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND opiskelija_id='" . $_SESSION["Id"] . "'")) {
        die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
    }

    //jos on:
    if ($onkojo->num_rows == 0) {

        $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, koulu_id) values('" . $_SESSION["Id"] . "', '" . $_SESSION["KurssiId"] . "', '" . $_SESSION["kouluId"] . "')");


        if (!$tulosP = $db->query("select distinct * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }
        if ($tulosP->num_rows != 0) {
            while ($rowP = $tulosP->fetch_assoc()) {
                $id = $rowP[id];

                $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, koulu_id, projekti_id) values('" . $_SESSION["Id"] . "', '" . $_SESSION["KurssiId"] . "', '" . $_SESSION["kouluId"] . "', '" . $id . "')");
            }
        }
        if (!$tulosIP = $db->query("select distinct * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }
        if ($tulosIP->num_rows != 0) {

            while ($rowIP = $tulosIP->fetch_assoc()) {
                $id = $rowIP[id];

                $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, koulu_id, itseprojekti_id) values('" . $_SESSION["Id"] . "', '" . $_SESSION["KurssiId"] . "', '" . $_SESSION["kouluId"] . "', '" . $id . "')");

                if (!$tulosIPtehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $id . "'")) {
                    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                }

                if ($tulosIPtehtavat->num_rows != 0) {
                    while ($rowIPt = $tulosIPtehtavat->fetch_assoc()) {

                        $db->query("insert into itsetehtavatkp (kayttaja_id, itsetehtavat_id) values('" . $_SESSION["Id"] . "', '" . $rowIPt[id] . "')");
                    }
                }
            }
        }
        //itsearvioinnit VANHA
        if (!$tulosIA = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }

        //itsearviointi on luotu VANHA
        if ($tulosIA->num_rows != 0) {
            while ($rowIA = $tulosIA->fetch_assoc()) {
                $ida = $rowIA[id];
                $db->query("insert itsearvioinnitkp (kayttaja_id, itsearvioinnit_id) values('" . $_SESSION["Id"] . "', '" . $ida . "')");
            }
        }

        //itsearvioinnit 
        if (!$tulosias = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }


        while ($rowias = $tulosias->fetch_assoc()) {
            $jarjestys = $rowias[jarjestys];

            if (!$tulosia = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $jarjestys . "' AND onvastaus=1")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }
            while ($rowia = $tulosia->fetch_assoc()) {
                $ida = $rowia[id];
                $db->query("insert iakp (kayttaja_id, ia_id) values('" . $_SESSION["Id"] . "', '" . $ida . "')");
            }
        }


        //kyselyt
        if (!$tuloskys = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }

        //kysely on luotu
        if ($tuloskys->num_rows != 0) {
            while ($rowkys = $tuloskys->fetch_assoc()) {
                $idk = $rowkys[id];
                $db->query("insert kyselytkp (kayttaja_id, kyselyt_id) values('" . $_SESSION["Id"] . "', '" . $idk . "')");
            }
        }
    } else {
        if (!$tulosP = $db->query("select distinct * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }
        if ($tulosP->num_rows != 0) {
            while ($rowP = $tulosP->fetch_assoc()) {
                $id = $rowP[id];

                if (!$tulosP2 = $db->query("select distinct * from opiskelijankurssit where projekti_id='" . $id . "' AND opiskelija_id='" . $_SESSION["Id"] . "'")) {
                    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                }
                if ($tulosP2->num_rows == 0) {

                    $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, koulu_id, projekti_id) values('" . $_SESSION["Id"] . "', '" . $_SESSION["KurssiId"] . "', '" . $_SESSION["kouluId"] . "', '" . $id . "')");
                }
            }
        }

        //kurssitehtävät
        if (!$tulosIP = $db->query("select distinct * from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }
        if ($tulosIP->num_rows != 0) {

            while ($rowIP = $tulosIP->fetch_assoc()) {
                $id = $rowIP[id];
                if (!$tulosIP2 = $db->query("select distinct * from opiskelijankurssit where kurssi_id='" . $_SESSION["KurssiId"] . "' AND opiskelija_id='" . $_SESSION["Id"] . "' AND itseprojekti_id='" . $id . "'")) {
                    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                }
                if ($tulosIP2->num_rows == 0) {
                    $db->query("insert into opiskelijankurssit (opiskelija_id, kurssi_id, koulu_id, itseprojekti_id) values('" . $_SESSION["Id"] . "', '" . $_SESSION["KurssiId"] . "', '" . $_SESSION["kouluId"] . "', '" . $id . "')");
                }
                if (!$tulosIPtehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $id . "'")) {
                    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                }

                //katotaan, onko tehtävät jo laitettu
                if ($tulosIPtehtavat->num_rows != 0) {
                    while ($rowIPt = $tulosIPtehtavat->fetch_assoc()) {

                        if (!$tulosIPtehtavatkp = $db->query("select distinct * from itsetehtavatkp where itsetehtavat_id='" . $rowIPt[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
                            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                        }
                        if ($tulosIPtehtavatkp->num_rows == 0) {
                            $db->query("insert into itsetehtavatkp (kayttaja_id, itsetehtavat_id) values('" . $_SESSION["Id"] . "', '" . $rowIPt[id] . "')");
                        }
                    }
                }
            }
        }

        //itsearvioinnit
        if (!$tulosIA = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }

        //itsearviointi on luotu
        if ($tulosIA->num_rows != 0) {
            while ($rowIA = $tulosIA->fetch_assoc()) {
                $ida = $rowIA[id];

                if (!$tulosIAt = $db->query("select distinct * from itsearvioinnitkp where itsearvioinnit_id='" . $ida . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
                    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                }
                //katotaan, onko arviointi jo laitettu
                if ($tulosIAt->num_rows == 0) {


                    if ($rowIA[aihe] == 0)
                        $db->query("insert into itsearvioinnitkp (kayttaja_id, itsearvioinnit_id) values('" . $_SESSION["Id"] . "', '" . $ida . "')");
                }
            }
        }
        //itsearvioinnit 
        if (!$tulosias = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }


        while ($rowias = $tulosias->fetch_assoc()) {
            $jarjestys = $rowias[jarjestys];

            if (!$tulosia = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $jarjestys . "' AND onvastaus=1")) {
                die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
            }
            while ($rowia = $tulosia->fetch_assoc()) {
                $ida = $rowia[id];
                $db->query("insert iakp (kayttaja_id, ia_id) values('" . $_SESSION["Id"] . "', '" . $ida . "')");
            }
        }
        //kyselyt
        if (!$tuloskys = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
        }

        //itsearviointi on luotu
        if ($tuloskys->num_rows != 0) {
            while ($rowkys = $tuloskys->fetch_assoc()) {
                $idk = $rowkys[id];

                if (!$tuloskyst = $db->query("select distinct * from kyselytkp where kyselyt_id='" . $ida . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
                    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
                }
                //katotaan, onko arviointi jo laitettu
                if ($tuloskyst->num_rows == 0) {


                    if ($rowkys[aihe] == 0)
                        $db->query("insert into kyselytkp (kayttaja_id, kyselyt_id) values('" . $_SESSION["Id"] . "', '" . $idk . "')");
                }
            }
        }
    }
    $_SESSION["vaihto"] = 1;
    $_SESSION["Rooli"] = 'opiskelija';
} else if ($_POST['arvo'] == 'pois') {

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
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
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

if ($_POST["mihin"] == 'etu') {

    if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'opeadmin')
        header("location: omatkurssit.php");
    else
        header("location: etusivu.php");
} else {

    header("location: " . $_POST[url]);
}
?>