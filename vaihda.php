<?php
session_start();

include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

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
    

    
    //haetaan projekti
    
     //poista opiskelijankurssit + tiedostot
     if (!$haeprojekti = $db->query("select distinct * from opiskelijankurssit where ryhma_id != 0  AND opiskelija_id='" . $_SESSION["Id"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowp = $haeprojekti->fetch_assoc()) {
        
    $pid = $rowp[projekti_id];
        //poista opiskelijankurssit + tiedostot
     if (!$haetyot = $db->query("select ryhmat2.tallennettunimi as tallennettunimi, ryhmat2.linkki as linkki, ryhmat2.id as ryid, opiskelijan_kurssityot.id as okid from opiskelijan_kurssityot, ryhmat2, projektit where opiskelijan_kurssityot.kayttaja_id = '" . $_SESSION["Id"] . "' AND ryhmat2.projekti_id=projektit.id AND projektit.id='".$pid."' AND opiskelijan_kurssityot.ryhmat2_id=ryhmat2.id")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowr = $haetyot->fetch_assoc()) {

        $nimi = $rowr[tallennettunimi];
        $linkki = $rowr[linkki];
        $ryid = $rowr[ryid];
        $okid = $rowr[okid];

        if ($linkki == 1) {
            $db->query("delete from ryhmat2 where id = '" . $ryid . "'");
            $db->query("delete from opiskelijan_kurssityot where ryhmat2_id = '" . $ryid . "'");
        } else {
            if (file_exists($nimi)) {
                unlink($nimi);
            }


            $db->query("delete from ryhmat2 where id = '" . $ryid . "'");
            $db->query("delete from opiskelijan_kurssityot where ryhmat2_id = '" . $ryid . "'");
        }
    }
          if (!$onkomuita = $db->query("select distinct * from opiskelijankurssit where projekti_id='" . $pid. "' AND opiskelija_id='".$_SESSION[Id]."' AND ryhma_id<>0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if($onkomuita -> num_rows == 1){
                 while ($rowm = $onkomuita->fetch_assoc()) {
        
            $db->query("delete from ryhmat where id = '" . $rowm[ryhma_id] . "'");

        }
        
        }
     
      $db->query("update opiskelijankurssit set ryhma_id=0 where opiskelija_id = '" . $_SESSION["Id"] . "' AND projekti_id='".$pid."'");
      
  
         if (!$haetarkka = $db->query("select distinct tarkkamaara from projektit where id='" .$pid. "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    //sallittu määrä
    while ($rowtarkka = $haetarkka->fetch_assoc()) {
        $tarkkamaara = $rowtarkka[tarkkamaara];
    }

    if ($tarkkamaara != 0) {
        $db->query("insert into ryhmat (projekti_id) values('" .$pid. "')");
    }


    //nimetään vanhat uudelleen

    if (!$resultmina = $db->query("select MIN(id) as pienin from ryhmat where projekti_id='" .$pid. "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if (!$resultmaxa = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" .$pid. "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($minrowa = $resultmina->fetch_assoc()) {
        $mina = $minrowa[pienin];
    }

    while ($maxrowa = $resultmaxa->fetch_assoc()) {
        $maxa = $maxrowa[suurin];
    }

    $a = 1;

    for ($j = $mina; $j <= $maxa; $j++) {

        if (!$onko = $db->query("select * from ryhmat where projekti_id='" .$pid. "' AND id='" . $j . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($onko->num_rows > 0) {
            $ryhmanimi = $a;

            $nimi = "Ryhmä " . $ryhmanimi . " ";

            $db->query("update ryhmat set nimi='" . $nimi . "' where projekti_id='" .$pid. "' AND id='" . $j . "'");


            $a++;
        }
    }
        
   
     
        }

 $db->query("delete from kyselytkp where kayttaja_id = '" . $_SESSION["Id"] . "'");
    $db->query("delete from itsearvioinnitkp where kayttaja_id = '" . $_SESSION["Id"] . "'");
    //itsearvioinnit, UUSI
    $db->query("delete from iakp where kayttaja_id = '" . $_SESSION["Id"] . "'");
    $db->query("delete from iakp_moni where kayttaja_id = '" . $_SESSION["Id"] . "'");
    $db->query("delete from iakommentit where kayttaja_id = '" . $_SESSION["Id"] . "'");



    //itsenäisten töiden kirjanpito


        $db->query("delete from itsetehtavatkp where kayttaja_id = '" . $_SESSION["Id"] . "'");
   

    //sektoridiagrammit
    $pienimi = 'images/sektori' . $_SESSION["Id"] . '.png';
    if (file_exists($pienimi)) {
        unlink($pienimi);
    }
    $pienimi = 'images/sektori2' . $_SESSION["Id"] . '.png';
    if (file_exists($pienimi)) {
        unlink($pienimi);
    }
    $pienimi = 'images/sektori3' . $_SESSION["Id"] . '.png';
    if (file_exists($pienimi)) {
        unlink($pienimi);
    }
    $pienimi = 'images/sektori4' . $_SESSION["Id"] . '.png';
    if (file_exists($pienimi)) {
        unlink($pienimi);
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