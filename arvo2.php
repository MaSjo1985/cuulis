<?php
session_start(); 


ob_start();



echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    $start_time = time();
    $valmislista = array();
    $arvontalista = array();
    if (!$resultuusi = $db->query("select distinct opiskelija_id as oid from kayttajat, opiskelijankurssit where kayttajat.id=opiskelijankurssit.opiskelija_id AND ryhma_id=0 AND projekti_id='" . $_POST[pid] . "' AND kayttajat.rooli <> 'admin' AND kayttajat.rooli <> 'opettaja' ORDER BY kayttajat.sukunimi")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($opiskelijarow = $resultuusi->fetch_assoc()) {
        $oid = $opiskelijarow[oid];
        array_push($arvontalista, $oid);
    }

    echo'<div class="cm8-threequarter" style="padding-top: 0px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px">';


    if (!$yht = $db->query("select distinct opiskelija_id as oid from opiskelijankurssit where ryhma_id <> 0 AND projekti_id='" . $_POST[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($ri = $yht->fetch_assoc()) {
        $oid = $ri[oid];
        array_push($valmislista, $oid);
    }

    if (!$maksimir = $db->query("select * from projektit where id='" . $_POST[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    //sallittu määrä
    while ($mr = $maksimir->fetch_assoc()) {
        $MR = $mr[opmaksimi];
        $alaraja = $mr[opminimi];
    }


    if (!$haetarkka = $db->query("select distinct tarkkamaara from projektit where id='" . $_POST[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    //sallittu määrä
    while ($rowtarkka = $haetarkka->fetch_assoc()) {
        $tarkkamaara = $rowtarkka[tarkkamaara];
    }


    //selvitetään, onko opiskelijoita edes minimäärän verran

    $opiskelijatmaara2 = count($arvontalista) + count($valmislista);

    if ($opiskelijatmaara2 < $alaraja) {


        header("location: ryhmajakoepaonnistui.php?minimi=1&r=" . $_POST[pid]);
    } else {

        //selvitetään, onko vapaata tilaa riittävästi arvotuille:
        //asetetaan arvontaid:t

        if (!$maara = $db->query("select distinct * from ryhmat where projekti_id='" . $_POST[pid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        $tarve = count($arvontalista);

        if ((time() - $start_time) > 3) {

            header("location: ryhmajakoepaonnistui.php?time=1&r=" . $_POST[pid]);
        }
        //Tähän asti homma ok!a
        $vapaatila = ($maara->num_rows) * $MR;
        $vapaatila = $vapaatila - count($valmislista);
        if ($tarve > $vapaatila) {
            header("location: ryhmajakoepaonnistui.php?vapaa=0&r=" . $_POST[pid]);
        } else {
            shuffle($arvontalista);



            // TÄHÄN ASTI KAIKKI OK eli ryhmille on laitettu arvontaid
            //haetaan opiskelijat, joilla ei ole vielä ryhmää
            //tehdään niin kauan, kunnes jokaisella ryhmä            

            $vaillaryhmaa = count($arvontalista);
            $kohta = 0;
            $ryhmassa = 0;

            if (!$kurssinryhmat = $db->query("select distinct * from ryhmat where projekti_id='" . $_POST[pid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            //TÄYTETÄÄN JOKAINEN RYHMÄ ALARAJAAN ASTI
            while ($rivi = $kurssinryhmat->fetch_assoc()) {
                if (!$yht = $db->query("select distinct opiskelija_id as oid from opiskelijankurssit where ryhma_id = '" . $rivi[id] . "' AND projekti_id='" . $_POST[pid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if (!$maksimir = $db->query("select * from projektit where id='" . $_POST[pid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                //sallittu määrä
                while ($mr = $maksimir->fetch_assoc()) {

                    $alaraja = $mr[opminimi];
                }
                $alaraja = $alaraja - $yht->num_rows;
                for ($k = 1; $k <= $alaraja; $k++) {
                    $opid = $arvontalista[$kohta];


                    $db->query("update opiskelijankurssit set ryhma_id='" . $rivi[id] . "' where projekti_id='" . $_POST[pid] . "' AND opiskelija_id='" . $opid . "'");

                    $kohta++;
                    $ryhmassa++;
                    $vaillaryhmaa--;
                    if ($vaillaryhmaa == 0)
                        break;
                }
                if ($vaillaryhmaa == 0)
                    break;
            }




            if ((time() - $start_time) > 3) {
                header("location: ryhmajakoepaonnistui.php?time=1&r=" . $_POST[pid]);
            }


            if ($vaillaryhmaa > 0) {
                while ($vaillaryhmaa > 0) {
                    if (!$kurssinryhmat = $db->query("select distinct * from ryhmat where projekti_id='" . $_POST[pid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    //TÄYTETÄÄN JOKAINEN RYHMÄ ALARAJAAN ASTI
                    while ($rivi = $kurssinryhmat->fetch_assoc()) {
                        if (!$yht = $db->query("select distinct opiskelija_id as oid from opiskelijankurssit where ryhma_id = '" . $rivi[id] . "' AND projekti_id='" . $_POST[pid] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }
                        if (!$maksimir = $db->query("select * from projektit where id='" . $_POST[pid] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        //sallittu määrä
                        while ($mr = $maksimir->fetch_assoc()) {

                            $alaraja = $mr[opminimi];
                        }
                        $alaraja = $alaraja - $yht->num_rows;
                        for ($k = $alaraja + 1; $k <= $MR; $k++) {
                            $opid = $arvontalista[$kohta];
                            $db->query("update opiskelijankurssit set ryhma_id='" . $rivi[id] . "' where projekti_id='" . $_POST[pid] . "' AND opiskelija_id='" . $opid . "'");
                            $kohta++;
                            $ryhmassa++;
                            $vaillaryhmaa--;
                            if ($vaillaryhmaa == 0)
                                break;
                        }
                        if ($vaillaryhmaa == 0)
                            break;
                    }
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