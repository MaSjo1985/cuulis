<?php
session_start(); 


ob_start();



echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    $start_time = time();
    if (empty($_POST[lista])) {
        header("location: ryhmajakoepaonnistui.php?tyhja=1&r=" . $_POST[pid]);
    } else {
        $lista = $_POST["lista"];
        $lista3 = $_POST["lista"];
        $lista2 = $_POST["lista"];
        $lista4 = $_POST["lista"];
        $lista5 = $_POST["lista"];

        echo'<div class="cm8-threequarter" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px">';
        //tarkastetaan, että minimimäärä ylittyy. Jos ei, niin poistetaan tällaiset ryhmät ja tehdään arvonta niille, jotka jäi ilman ryhmää.
        $vapaatila = 0;

        if (!$maksimir = $db->query("select * from projektit where id='" . $_POST[pid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        //sallittu määrä
        while ($mr = $maksimir->fetch_assoc()) {
            $MR = $mr[opmaksimi];
            $alaraja = $mr[opminimi];
        }

        //selvitetään, onko opiskelijoita edes minimäärän verran

        $opiskelijatmaara2 = count($lista);

        if ($opiskelijatmaara2 < $alaraja) {


            header("location: ryhmajakoepaonnistui.php?minimi=1&r=" . $_POST[pid]);
        } else {
            //selvitetään vapaaa tila aluksi

            if (!$resultmin = $db->query("select MIN(id) as pienin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if (!$resultmax = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($minrow = $resultmin->fetch_assoc()) {
                $min = $minrow[pienin];
            }

            while ($maxrow = $resultmax->fetch_assoc()) {
                $max = $maxrow[suurin];
            }

            for ($j = $min; $j <= $max; $j++) {
                if (!$yht = $db->query("select distinct * from opiskelijankurssit where ryhma_id='" . $j . "' AND projekti_id='" . $_POST[pid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                //selvitetään kuinka paljon opiskelijoita/ryhmä


                $yhtop = $yht->num_rows;


                //vapaatila
                if ($yht->num_rows > 0) {
                    $vapaatila = $vapaatila + ($MR - $yhtop);
                }
            }

            //selvitetään, onko nykyisissä ryhmissä riittävästi vapaata tilaa niille, joilla ei vielä ole ryhmää. Jos ei, täytyy luoda uusia ryhmiä.

            $ok2 = 0;

            while ($ok2 == 0) {
                if (!$resultuusi = $db->query("select distinct * from opiskelijankurssit where ryhma_id=0 AND projekti_id='" . $_POST[pid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                $tarve = 0;

                while ($rowtarve = $resultuusi->fetch_assoc()) {

                    $opid3 = $rowtarve[opiskelija_id];
                    foreach ($lista3 as $tuote) {

                        if ($opid3 == $tuote) {

                            $tarve++;
                        }
                    }
                }

                //Tähän asti homma ok!a
                if ($tarve > $vapaatila) {

                    if (!$maara = $db->query("select distinct * from ryhmat where projekti_id='" . $_POST[pid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    $ryhmanimi = (($maara->num_rows) + 1);

                    $nimi = "Ryhmä " . $ryhmanimi . " ";

                    $db->query("insert into ryhmat (projekti_id, nimi, suljettu) values('" . $_POST[pid] . "', '" . $nimi . "', 0)");

                    $vapaatila = $vapaatila + $MR;
                }
                if ($tarve <= $vapaatila) {
                    $ok2 = 1;
                }

                if ((time() - $start_time) > 3) {

                    header("location: ryhmajakoepaonnistui.php?time=1&r=" . $_POST[pid]);
                }
            }

            //asetetaan arvontaid:t

            $a = 1;
            if (!$resultmina = $db->query("select MIN(id) as pienin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            if (!$resultmaxa = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($minrowa = $resultmina->fetch_assoc()) {
                $mina = $minrowa[pienin];
            }

            while ($maxrowa = $resultmaxa->fetch_assoc()) {
                $maxa = $maxrowa[suurin];
            }

            for ($j = $mina; $j <= $maxa; $j++) {

                if (!$onko = $db->query("select * from ryhmat where projekti_id='" . $_POST[pid] . "' AND id='" . $j . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                if ($onko->num_rows > 0) {
                    $db->query("update ryhmat set arvontaid='" . $a . "' where projekti_id='" . $_POST[pid] . "' AND id='" . $j . "'");
                    $a++;
                }
            }

            //nyt vapaata tilaa on riittävästi, joten arvonta voidaan aloittaa
            //haetaan opiskelijat, joilla ei ole vielä ryhmää
            //tehdään niin kauan, kunnes jokaisella ryhmä
            if (!$resultuusi2 = $db->query("select distinct * from opiskelijankurssit where ryhma_id=0 AND projekti_id='" . $_POST[pid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $vaillaryhmaa = 0;

            while ($opiskelijarow = $resultuusi2->fetch_assoc()) {

                $opid = $opiskelijarow[opiskelija_id];
                foreach ($lista as $tuote) {

                    if ($opid == $tuote) {

                        $vaillaryhmaa++;
                    }
                }
            }

            while ($vaillaryhmaa > 0) {
                if (!$resultuusi2 = $db->query("select distinct * from opiskelijankurssit where ryhma_id=0 AND projekti_id='" . $_POST[pid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($opiskelijarow = $resultuusi2->fetch_assoc()) {
                    $loyty = false;
                    $opid = $opiskelijarow[opiskelija_id];
                    foreach ($lista as $tuote) {

                        if ($opid == $tuote) {

                            $loyty = true;
                        }
                    }
                    if ($loyty) {
                        if (!$resultmin2 = $db->query("select MIN(arvontaid) as pienin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        if (!$resultmax2 = $db->query("select MAX(arvontaid) as suurin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        //pienin arvontaid

                        while ($minrow2 = $resultmin2->fetch_assoc()) {
                            $min2 = $minrow2[pienin];
                        }

                        //suurin arvontaid

                        while ($maxrow2 = $resultmax2->fetch_assoc()) {
                            $max2 = $maxrow2[suurin];
                        }

                        $ryhmaid = mt_rand($min2, $max2);

                        //haetaan opiskelijat, joilla arvottu id

                        if (!$resultaid = $db->query("select distinct * from opiskelijankurssit, ryhmat where ryhmat.projekti_id='" . $_POST[pid] . "' AND opiskelijankurssit.ryhma_id=ryhmat.id AND ryhmat.arvontaid='" . $ryhmaid . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        //haetaan oikea id

                        if (!$resultoik = $db->query("select distinct * from ryhmat where arvontaid='" . $ryhmaid . "' AND projekti_id='" . $_POST[pid] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        $laskuri = $resultaid->num_rows;
                        while ($rowu = $resultoik->fetch_assoc()) {
                            $arvotturyhma = $rowu[id];
                        }

                        //laskuri- muuttuja kertoo niiden opiskelijoiden määrän, jotka arvotussa ryhmässä
                        //jos vapaata tilaa, lisätään opiskelija arvottuun ryhmään

                        if ($laskuri < $MR) {
                            $db->query("update opiskelijankurssit set ryhma_id='" . $arvotturyhma . "' where projekti_id='" . $_POST[pid] . "' AND opiskelija_id='" . $opid . "'");

                            $vaillaryhmaa--;
                        }
                    }

                    if ((time() - $start_time) > 3) {
                        header("location: ryhmajakoepaonnistui.php?time=1&r=" . $_POST[pid]);
                    }
                }
            }

            //  NYT OPISKELIJOILLA ON RYHMÄ, MUTTA JAKO EI VIELÄ TÄYSIN JÄRKEVÄ

            $valmis = false;

            while (!$valmis) {
                if (!$sallittu = $db->query("select distinct * from projektit where id='" . $_POST[pid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($mr = $sallittu->fetch_assoc()) {
                    $MAXR = $mr[opmaksimi];
                    $MINR = $mr[opminimi];
                }

                if (!$kurssinryhmat = $db->query("select distinct * from ryhmat where projekti_id='" . $_POST[pid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                //tarkastetaan, että opiskelijoita on vähintään minimimäärä ryhmissä
                // $valivalmis=false;
                // while(!$valivalmis)
                $poistetut = array();
                while ($rivi = $kurssinryhmat->fetch_assoc()) {
                    if (!$yht = $db->query("select distinct * from opiskelijankurssit where projekti_id='" . $_POST[pid] . "' AND ryhma_id='" . $rivi[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    //jos vähemmän kuin minimi, poistetaan ryhmä ja laitetaan opiskelijan ryhmä_id=0:

                    if ($yht->num_rows < $MINR) {
                        //  PITÄÄ LAITTAA MUISTIIN, KENEN ON POISTETTU

                        while ($rivip = $yht->fetch_assoc()) {
                            array_push($poistetut, $rivip[opiskelija_id]);
                            echo'<br>Poistettu';
                        }

                        $db->query("delete from ryhmat where id='" . $rivi[id] . "'");
                        $db->query("update opiskelijankurssit set ryhma_id=0 where ryhma_id='" . $rivi[id] . "' AND projekti_id='" . $_POST[pid] . "'");

                        //nimetään vanhat uudelleen

                        if (!$resultmina = $db->query("select MIN(id) as pienin from ryhmat where projekti_id='" . $_POST[pid] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        if (!$resultmaxa = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" . $_POST[pid] . "'")) {
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

                            if (!$onko = $db->query("select * from ryhmat where projekti_id='" . $_POST[pid] . "' AND id='" . $j . "'")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }

                            if ($onko->num_rows > 0) {
                                $ryhmanimi = $a;

                                $nimi = "Ryhmä " . $ryhmanimi . " ";

                                $db->query("update ryhmat set nimi='" . $nimi . "' where projekti_id='" . $_POST[pid] . "' AND id='" . $j . "'");


                                $a++;
                            }
                        }
                    }
                    if ((time() - $start_time) > 3) {
                        header("location: ryhmajakoepaonnistui.php?time=1&r=" . $_POST[pid]);
                    }
                }

                //tarkastetaan, jäikö joitain ilman ryhmää. jos ei, ryhmäjako on valmis. jos jäi, tehdään arvonta
                $maarailman = count($poistetut);
                echo'<br>Koko: ' . $maarailman;



                if ($maarailman > 0) {
                    //nyt vaan tehdään arvonta

                    $vapaatila = 0;

                    if (!$maksimir = $db->query("select * from projektit where id='" . $_POST[pid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    //sallittu määrä
                    while ($mr = $maksimir->fetch_assoc()) {
                        $MR = $mr[opmaksimi];
                    }

                    //selvitetään vapaaa tila aluksi

                    if (!$resultmin = $db->query("select MIN(id) as pienin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    if (!$resultmax = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($minrow = $resultmin->fetch_assoc()) {
                        $min = $minrow[pienin];
                    }

                    while ($maxrow = $resultmax->fetch_assoc()) {
                        $max = $maxrow[suurin];
                    }

                    for ($j = $min; $j <= $max; $j++) {
                        if (!$yht = $db->query("select distinct * from opiskelijankurssit where ryhma_id='" . $j . "' AND projekti_id='" . $_POST[pid] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        //selvitetään kuinka paljon opiskelijoita/ryhmä


                        $yhtop = $yht->num_rows;

                        if ($yht->num_rows > 0) {
                            $vapaatila = $vapaatila + ($MR - $yhtop);
                        }
                    }

                    //selvitetään, onko nykyisissä ryhmissä riittävästi vapaata tilaa niille, joilla ei vielä ole ryhmää. Jos ei, täytyy luoda uusia ryhmiä.

                    $ok2 = 0;
                    $tarve2 = $maarailman;
                    while ($ok2 == 0) {


                        if ($tarve2 > $vapaatila) {
                            if (!$maara = $db->query("select distinct * from ryhmat where projekti_id='" . $_POST[pid] . "'")) {
                                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                            }

                            $ryhmanimi = (($maara->num_rows) + 1);

                            $nimi = "Ryhmä " . $ryhmanimi . " ";

                            $db->query("insert into ryhmat (projekti_id, nimi, suljettu) values('" . $_POST[pid] . "', '" . $nimi . "', 0)");

                            $vapaatila = $vapaatila + $MR;
                        }
                        if ($tarve2 <= $vapaatila) {
                            $ok2 = 1;
                        }

                        if ((time() - $start_time) > 3) {
                            header("location: ryhmajakoepaonnistui.php?time=1&r=" . $_POST[pid]);
                        }
                    }


                    //asetetaan arvontaid:t

                    $a = 1;
                    if (!$resultmina = $db->query("select MIN(id) as pienin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    if (!$resultmaxa = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    while ($minrowa = $resultmina->fetch_assoc()) {
                        $mina = $minrowa[pienin];
                    }

                    while ($maxrowa = $resultmaxa->fetch_assoc()) {
                        $maxa = $maxrowa[suurin];
                    }

                    for ($j = $mina; $j <= $maxa; $j++) {

                        if (!$onko = $db->query("select * from ryhmat where projekti_id='" . $_POST[pid] . "' AND id='" . $j . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        if ($onko->num_rows > 0) {
                            $db->query("update ryhmat set arvontaid='" . $a . "' where projekti_id='" . $_POST[pid] . "' AND id='" . $j . "'");
                            $a++;
                        }
                    }

                    //nyt vapaata tilaa on riittävästi, joten arvonta voidaan aloittaa
                    //haetaan opiskelijat, joilla ei ole vielä ryhmää
                    //tehdään niin kauan, kunnes jokaisella ryhmä


                    if (!$resultuusi2 = $db->query("select distinct * from opiskelijankurssit where ryhma_id=0 AND projekti_id='" . $_POST[pid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    $vaillaryhmaa = 0;

                    while ($opiskelijarow = $resultuusi2->fetch_assoc()) {

                        $opid = $opiskelijarow[opiskelija_id];
                        foreach ($poistetut as $tuote) {

                            if ($opid == $tuote) {

                                $vaillaryhmaa++;
                            }
                        }
                    }

                    while ($vaillaryhmaa > 0) {
                        if (!$resultuusi2 = $db->query("select distinct * from opiskelijankurssit where ryhma_id=0 AND projekti_id='" . $_POST[pid] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }


                        $loyty = false;
                        while ($opiskelijarow = $resultuusi2->fetch_assoc()) {
                            $opid = $opiskelijarow[opiskelija_id];
                            foreach ($poistetut as $tuote) {

                                if ($opid == $tuote) {
                                    $loyty = true;
                                }
                            }
                            if ($loyty) {


                                if (!$resultmin2 = $db->query("select MIN(arvontaid) as pienin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                if (!$resultmax2 = $db->query("select MAX(arvontaid) as suurin from ryhmat where projekti_id='" . $_POST[pid] . "' AND suljettu=0")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                //pienin arvontaid

                                while ($minrow2 = $resultmin2->fetch_assoc()) {
                                    $min2 = $minrow2[pienin];
                                }

                                //suurin arvontaid

                                while ($maxrow2 = $resultmax2->fetch_assoc()) {
                                    $max2 = $maxrow2[suurin];
                                }

                                $ryhmaid = mt_rand($min2, $max2);

                                //haetaan opiskelijat, joilla arvottu id

                                if (!$resultaid = $db->query("select distinct * from opiskelijankurssit, ryhmat where ryhmat.projekti_id='" . $_POST[pid] . "' AND opiskelijankurssit.ryhma_id=ryhmat.id AND ryhmat.arvontaid='" . $ryhmaid . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                //haetaan oikea id

                                if (!$resultoik = $db->query("select distinct * from ryhmat where arvontaid='" . $ryhmaid . "' AND projekti_id='" . $_POST[pid] . "'")) {
                                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                }

                                while ($rowu = $resultoik->fetch_assoc()) {
                                    $arvotturyhma = $rowu[id];
                                }

                                //laskuri- muuttuja kertoo niiden opiskelijoiden määrän, jotka arvotussa ryhmässä

                                $laskuri = $resultaid->num_rows;

                                //jos vapaata tilaa, lisätään opiskelija arvottuun ryhmään

                                if ($laskuri < $MR) {

                                    $db->query("update opiskelijankurssit set ryhma_id='" . $arvotturyhma . "' where projekti_id='" . $_POST[pid] . "' AND opiskelija_id='" . $opid . "'");
                                    $vaillaryhmaa--;
                                }
                            }
                            if ((time() - $start_time) > 3) {
                                header("location: ryhmajakoepaonnistui.php?time=1&r=" . $_POST[pid]);
                            }
                            $loyty = false;
                        }
                    }
                } else
                    $valmis = true;
                if ((time() - $start_time) > 3) {

                    header("location: ryhmajakoepaonnistui.php?time=1&r=" . $_POST[pid]);
                }
            }

            header("location: ryhmatyot.php?r=" . $_POST[pid]);
        }
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}


echo "</div>";
echo "</div>";
echo "</div>";
include("footer.php");
?>

</body>
</html>		