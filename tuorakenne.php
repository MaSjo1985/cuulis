<?php
session_start();
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    if (isset($_POST['en'])) {
        header("location: omatkurssit.php");
    } else {
        if (!$haekurssi = $db->query("select distinct * from kurssit where id='" . $_POST["id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowk = $haekurssi->fetch_assoc()) {
            $kopioitu = $rowk[kopioitu];
            $mones = $kopioitu + 1;
            $nimi = $rowk[nimi] . ' (kopio ' . $mones . ')';
            $koodi = $rowk[koodi];
            $ilmoitus2 = $rowk[ilmoitus2];
            $avain = $rowk[avain];
            $koulu_id = $rowk[koulu_id];
            $opettaja_id = $_SESSION[Id];
            $tav_akt = $rowk[tav_akt];
            $kysely = $rowk[kysely];

            if (empty($kysely)) {
                $kysely = 0;
            }
            $alkupvm = date('Y-m-d', strtotime("+2 days"));

            $loppupvm = date('Y-m-d', strtotime("+60 days"));

            $lukuvuosialku0 = substr($alkupvm, 5, 5);
            $lukuvuosiloppu0 = substr($loppupvm, 5, 5);


//            if($lukuvuosialku0 <= "12-31" && $lukuvuosialku0 >= "06-05"){
//                $lukuvuosialku = substr($alkupvm,0,4);
//            }
//            else{ 
//                $lukuvuosialku = substr($alkupvm,0,4)-1;
//   
//            }
            $lukuvuosialku = substr($alkupvm, 0, 4);

            if ($lukuvuosiloppu0 >= "01-01" && $lukuvuosiloppu0 <= "06-04") {
                $lukuvuosiloppu = substr($loppupvm, 0, 4);
            } else {
                $lukuvuosiloppu = substr($loppupvm, 0, 4) + 1;
            }
//          die('alkupvm: '.$alkupvm. '<br> lukuvuosialku: '.$lukuvuosialku);
            if ($lukuvuosialku == $lukuvuosiloppu) {
                $lukuvuosialku = $lukuvuosialku - 1;
            }
            $lukuvuosi = $lukuvuosialku . '-' . $lukuvuosiloppu;
            $aikatauluakt = $rowk[aikatauluakt];
            $itsearviointi = $rowk[itsearviointi];
            $infoitsearviointi = $rowk[infoitsearviointi];
            $kyselyinfo = $rowk[kyselyinfo];
            $keskusteluaihe = $rowk[keskusteluaihe];
            $keskakt = 0;
        }

        $db->query("UPDATE kurssit SET kopioitu = kopioitu + 1 WHERE id = '" . $_POST["id"] . "'");

        $toimiiko = $db->query("insert into kurssit (nimi, koodi, ilmoitus2, avain, koulu_id, opettaja_id, lukuvuosi, alkupvm, loppupvm, aikatauluakt, itsearviointi, infoitsearviointi, kyselyinfo, keskusteluaihe, keskakt, tav_akt, kysely)"
                . " values('" . $nimi . "', '" . $koodi . "', '" . $ilmoitus2 . "', '" . $avain . "', '" . $koulu_id . "', '" . $opettaja_id . "', '" . $lukuvuosi . "',"
                . " '" . $alkupvm . "', '" . $loppupvm . "', '" . $aikatauluakt . "', '" . $itsearviointi . "', '" . $infoitsearviointi . "', '" . $kyselyinfo . "', '" . $keskusteluaihe . "', '" . $keskakt . "', '" . $tav_akt . "', '" . $kysely . "')");
        if (!$toimiiko) {
            echo("Error description: " . $db->error);
        }
        $db->query($query);

        $id = $db->insert_id;



        // itsearviointi, VANHA
//        if (!$haearviointi = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_POST["id"] . "' ORDER BY jarjestys")) {
//            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//        }
//
//
//        while ($rowA = $haearviointi->fetch_assoc()) {
//            $db->query("insert into itsearvioinnit (kurssi_id, otsikko, sisalto, jarjestys, aihe, valiaihe) values('" . $id . "', '" . $rowA[otsikko] . "', '" . $rowA[sisalto] . "'"
//                    . ", '" . $rowA[jarjestys] . "', '" . $rowA[aihe] . "', '" . $rowA[valiaihe] . "' )");
//        }
        //itsearviointi, UUSI
        $kidmista = $_POST["id"];
        $kidmihin = $id;


        if (!$haesarakkeet = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $kidmista . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rows = $haesarakkeet->fetch_assoc()) {

            $db->query("insert into ia_sarakkeet (kurssi_id, jarjestys) values('" . $kidmihin . "', '" . $rows[jarjestys] . "')");


            //haetaan arvioinnit
            if (!$haeia = $db->query("select distinct * from ia where kurssi_id='" . $kidmista . "' AND ia_sarakkeet_jarjestys='" . $rows[jarjestys] . "' order by jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowia = $haeia->fetch_assoc()) {
                $iaidvanha = $rowia[id];
                $db->query("insert into ia (kurssi_id) values('" . $kidmihin . "')");

                if (!$haeviimeisin2 = $db->query("select distinct id from ia where kurssi_id='" . $kidmihin . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowv2 = $haeviimeisin2->fetch_assoc()) {
                    $iaiduusi = $rowv2[id];
                }

                $db->query("update ia set otsikko='" . $rowia[otsikko] . "' where id = '" . $iaiduusi . "'");
                $db->query("update ia set jarjestys='" . $rowia[jarjestys] . "' where id = '" . $iaiduusi . "'");
                $db->query("update ia set vastaus='" . $rowia[vastaus] . "' where id = '" . $iaiduusi . "'");
                $db->query("update ia set onvastaus='" . $rowia[onvastaus] . "' where id = '" . $iaiduusi . "'");
                $db->query("update ia set onotsikko='" . $rowia[onotsikko] . "' where id = '" . $iaiduusi . "'");
                $db->query("update ia set onradio='" . $rowia[onradio] . "' where id = '" . $iaiduusi . "'");
                $db->query("update ia set oncheckbox='" . $rowia[oncheckbox] . "' where id = '" . $iaiduusi . "'");
                $db->query("update ia set onteksti='" . $rowia[onteksti] . "' where id = '" . $iaiduusi . "'");
                $db->query("update ia set ia_sarakkeet_jarjestys='" . $rowia[ia_sarakkeet_jarjestys] . "' where id = '" . $iaiduusi . "'");

                if ($rowia[onradio] == 1 || $rowia[oncheckbox]) {

                    if (!$haevaihtoehto = $db->query("select distinct * from iavaihtoehdot where ia_id='" . $iaidvanha . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    while ($rowv = $haevaihtoehto->fetch_assoc()) {
                        $db->query("INSERT INTO iavaihtoehdot (ia_id, vaihtoehto) VALUES ('" . $iaiduusi . "', '" . $rowv[vaihtoehto] . "')");
                    }
                }
            }
        }

        // tiedostot

        if (!$haekansiot = $db->query("select distinct * from kansiot where kurssi_id='" . $_POST["id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowka = $haekansiot->fetch_assoc()) {

            //lisää kansio ja sen tiedostot
            $kansionimi = $rowka[nimi];
            $vanhakansio_id = $rowka[id];
            $ekakansio = $rowka[ekakansio];


            $db->query("insert into kansiot (kurssi_id, nimi, ekakansio) values('" . $id . "', '" . $kansionimi . "', '" . $ekakansio . "')");
            $uusikansio_id = $db->insert_id;
            if (!$haetiedostot = $db->query("select distinct * from tiedostot where kansio_id='" . $vanhakansio_id . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowti = $haetiedostot->fetch_assoc()) {

                //lisää kansio ja sen tiedostot
                $tiedostonimi = $rowti[nimi];
                $kuvaus = $rowti[kuvaus];
                $omatallennusnimi = $rowti[omatallennusnimi];
                $linkki = $rowti[linkki];
                $vanhalinkki = $rowti[vanhalinkki];
                $upotus = $rowti[upotus];
                $youtube = $rowti[youtube];

                $db->query("insert into tiedostot (kansio_id, nimi, kuvaus, omatallennusnimi, linkki, tuotu, vanhalinkki, upotus, youtube) values('" . $uusikansio_id . "', '" . $tiedostonimi . "', '" . $kuvaus . "'"
                        . ", '" . $omatallennusnimi . "', '" . $linkki . "', 1, '" . $vanhalinkki . "', '" . $upotus . "', '" . $youtube . "')");
            }
        }



        // linkit

        if (!$haelinkit = $db->query("select distinct * from linkit where kurssi_id='" . $_POST["id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowl = $haelinkit->fetch_assoc()) {

            $kuvaus = $rowl[kuvaus];
            $osoite = $rowl[osoite];
            $upotus = $rowl[upotus];
            $youtube = $rowl[youtube];

            $db->query("insert into linkit (kurssi_id, kuvaus, osoite, upotus, youtube) values('" . $id . "', '" . $kuvaus . "', '" . $osoite . "', '" . $upotus . "', '" . $youtube . "')");
        }




        // aikataulu
        if (!$haeaikataulu = $db->query("select distinct * from kurssiaikataulut where kurssi_id='" . $_POST["id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowai = $haeaikataulu->fetch_assoc()) {

            $jarjestys = $rowai[jarjestys];
            $aihe = $rowai[aihe];
            $lisa = $rowai[lisa];



            $db->query("insert into kurssiaikataulut (kurssi_id, jarjestys, aihe, lisa) values('" . $id . "', '" . $jarjestys . "', '" . $aihe . "', '" . $lisa . "')");
        }
        // tehtäväluettelo

        if (!$haeuusiprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $_POST["id"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowP2 = $haeuusiprojekti->fetch_assoc()) {

            $ipidvanha = $rowP2[id];
            $info = $rowP2[info];
            $kuvaus = $rowP2[kuvaus];
            $lisa = $rowP2[lisa];
            $painotus = $rowP2[painotus];
            $itsepisteytys = $rowP2[itsepisteytys];
            $taulu = $rowP2[taulu];
            $db->query("insert into itseprojektit (kurssi_id, info, kuvaus, lisa, painotus, itsepisteytys, taulu) values('" . $id . "', '" . $info . "', '" . $kuvaus . "', '" . $lisa . "', '" . $painotus . "', '" . $itsepisteytys . "', '" . $taulu . "')");
            $uusiprojekti_id = $db->insert_id;

            if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipidvanha . "' ORDER BY jarjestys")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowT = $haetehtavat->fetch_assoc()) {
                $db->query("insert into itsetehtavat (itseprojektit_id) values('" . $uusiprojekti_id . "')");


                if (!$haeviimeisin = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $uusiprojekti_id . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($rowV = $haeviimeisin->fetch_assoc()) {
                    $tehtavaid = $rowV[id];
                }



                $db->query("update itsetehtavat set sisalto='" . $rowT[sisalto] . "' where id = '" . $tehtavaid . "'");
                $db->query("update itsetehtavat set aihe='" . $rowT[aihe] . "' where id = '" . $tehtavaid . "'");
                $db->query("update itsetehtavat set otsikko='" . $rowT[otsikko] . "' where id = '" . $tehtavaid . "'");
                $db->query("update itsetehtavat set jarjestys='" . $rowT[jarjestys] . "' where id = '" . $tehtavaid . "'");
                $db->query("update itsetehtavat set paino='" . $rowT[paino] . "' where id = '" . $tehtavaid . "'");
            }

            //tasot kohdilleen
            // tehtäväluettelo

            if (!$haetasot = $db->query("select * from itseprojektit_tasot where itseprojekti_id='" . $ipidvanha . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowP3 = $haetasot->fetch_assoc()) {
                $db->query("insert into itseprojektit_tasot (itseprojekti_id, selite, osuus) values('" . $uusiprojekti_id . "', '" . $rowP3[selite] . "', '" . $rowP3[osuus] . "')");
            }
            //lisäpisteet

            if (!$haelisat = $db->query("select * from itseprojektit_lpisteet where itseprojekti_id='" . $ipidvanha . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowP4 = $haelisat->fetch_assoc()) {
                $db->query("insert into itseprojektit_lpisteet (itseprojekti_id, pisteet, osuus) values('" . $uusiprojekti_id . "', '" . $rowP4[pisteet] . "', '" . $rowP4[osuus] . "')");
            }

            //dnakyy
            if (!$onkorivi10 = $db->query("select distinct dnakyy from itseprojektit where id='" . $ipidvanha . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowdnakyy = $onkorivi10->fetch_assoc()) {
                $dnakyy = $rowdnakyy[dnakyy];

                $db->query("update itseprojektit set dmax='" . $dnakyy . "' where id = '" . $uusiprojekti_id . "'");
            }
            //dmax
            if (!$onkorivi9 = $db->query("select distinct dmax from itseprojektit where id='" . $ipidvanha . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowdmax = $onkorivi9->fetch_assoc()) {
                $dmax = $rowdmax[dmax];

                $db->query("update itseprojektit set dmax='" . $dmax . "' where id = '" . $uusiprojekti_id . "'");
            }

            //pisteiden vaikutus
            if (!$onkorivi17 = $db->query("select distinct pisteetvaikuttaa from itseprojektit where id='" . $ipidvanha . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowpv = $onkorivi17->fetch_assoc()) {
                $pisteetvaikuttaa = $rowpv[pisteetvaikuttaa];

                $db->query("update itseprojektit set pisteetvaikuttaa='" . $pisteetvaikuttaa . "' where id = '" . $uusiprojekti_id . "'");
            }

            // minimit

            if (!$haeminimi = $db->query("select * from itseprojektit_minimi where itseprojektit_id='" . $ipidvanha . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowminimi = $haeminimi->fetch_assoc()) {
                $db->query("insert into itseprojektit_minimi (itseprojektit_id, minimi) values('" . $uusiprojekti_id . "', '" . $rowminimi[minimi] . "')");
            }
        }


        //kyselylomake

        $kurssi = $_POST["id"];
        if (!$haetehtavat = $db->query("select distinct * from kyselyt where kurssi_id='" . $kurssi . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowT = $haetehtavat->fetch_assoc()) {
            $db->query("insert into kyselyt (kurssi_id) values('" . $id . "')");


            if (!$haeviimeisin = $db->query("select distinct * from kyselyt where kurssi_id='" . $id . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowV = $haeviimeisin->fetch_assoc()) {
                $tehtavaid = $rowV[id];
            }



            $db->query("update kyselyt set sisalto='" . $rowT[sisalto] . "' where id = '" . $tehtavaid . "'");
            $db->query("update kyselyt set aihe='" . $rowT[aihe] . "' where id = '" . $tehtavaid . "'");
            $db->query("update kyselyt set valiaihe='" . $rowT[valiaihe] . "' where id = '" . $tehtavaid . "'");
            $db->query("update kyselyt set otsikko='" . $rowT[otsikko] . "' where id = '" . $tehtavaid . "'");

            $db->query("update kyselyt set jarjestys='" . $rowT[jarjestys] . "' where id = '" . $tehtavaid . "'");
        }



        // Palautukset 

        $kurssi = $_POST["id"];
        
        if (!$haetehtavat = $db->query("select distinct * from projektit where kurssi_id='" . $kurssi . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowT = $haetehtavat->fetch_assoc()) {
            $kuvaus = $rowT[kuvaus];
            $ryhmienmaksimi = $rowT[ryhmienmaksimi];
            $opmaksimi = $rowT[opmaksimi];
            $opminimi = $rowT[opminimi];
            $palautus = $rowT[palautus];
            $info = $rowT[info];
            $tarkkamaara = $rowT[tarkkamaara];
            $pid = $rowT[id];



            $db->query("insert into projektit (kurssi_id, kuvaus, ryhmienmaksimi, opmaksimi, opminimi, palautus, info, tarkkamaara) values('" . $id . "', '" . $kuvaus . "', '" . $ryhmienmaksimi . "','" . $opmaksimi . "', '" . $opminimi . "', '" . $palautus . "', '" . $info . "', '" . $tarkkamaara . "')");
            $lisattypid = $db->insert_id;
            //open automaattisesti ryhmiin lisätyt tiedostot
            if (!$haeoa = $db->query("select distinct * from open_palautustiedosto where projekti_id='" . $pid . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowoa = $haeoa->fetch_assoc()) {
                $kuvaus = $rowoa[kuvaus];
                $tallennettunimi = $rowoa[tallennettunimi];
                $linkki = $rowoa[linkki];
                $omatallennusnimi = $rowoa[omatallennusnimi];
                $tuotu = 1;
                $db->query("insert into open_palautustiedosto (projekti_id, kuvaus, tallennettunimi, linkki, omatallennusnimi, tuotu) values('" . $lisattypid . "', '" . $kuvaus . "', '" . $tallennettunimi . "','" . $linkki . "', '" . $omatallennusnimi . "', '" . $tuotu . "')");
            }
  

                    if (!$haetarkka = $db->query("select distinct tarkkamaara from projektit where id='" . $lisattypid . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    //sallittu määrä
                    while ($rowtarkka = $haetarkka->fetch_assoc()) {
                        $tarkkamaara = $rowtarkka[tarkkamaara];
                    }

                    if ($tarkkamaara != 0) {
                        for ($i = 1; $i <= $tarkkamaara; $i++) {
                            if (!$maara = $db->query("select distinct * from ryhmat where projekti_id='" . $lisattypid . "'")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }

                            $ryhmanimi = (($maara->num_rows) + 1);

                            $nimi = "Ryhmä " . $ryhmanimi . " ";
                            $db->query("insert into ryhmat (projekti_id, nimi, suljettu) values('" . $lisattypid . "', '" . $nimi . "', 0)");
                        }
                    } else {
                        if (!$resultmina = $db->query("select MIN(id) as pienin from ryhmat where projekti_id='" . $lisattypid . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        if (!$resultmaxa = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" . $lisattypid . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        while ($minrowa = $resultmina->fetch_assoc()) {
                            $mina = $minrowa[pienin];
                        }

                        while ($maxrowa = $resultmaxa->fetch_assoc()) {
                            $maxa = $maxrowa[suurin];
                        }
                        $a = 0;
                        for ($j = $mina; $j <= $maxa; $j++) {
                            $a++;
                        }


                        $ryhmanimi = $a;

                        $nimi = "Ryhmä " . $ryhmanimi . " ";

                        $db->query("insert into ryhmat (projekti_id, nimi, suljettu) values('" . $lisattypid . "', '" . $nimi . "', 0)");
                    }
        }




        header("location: omatkurssit.php");
    }
    // perustiedot HUOM! Muu ope?!?!
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

