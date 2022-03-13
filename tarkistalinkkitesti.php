<?php
session_start();

ob_start();

include("yhteys.php");


$pid = $_POST[pid];


if (!$result23 = $db->query("select * from ryhmat2 where projekti_id = '" . $pid . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
if (!$result24 = $db->query("select * from ryhmat2 where projekti_id = '" . $pid . "' AND linkki=0")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
if ($result23->num_rows != 0) {

    if (!$result22 = $db->query("select * from ryhmat2 where projekti_id = '" . $pid . "' AND linkki=1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    $maara = $result22->num_rows;



    if ($result22->num_rows > 0) {

        $opiskelijat = array();
        while ($rowt22 = $result22->fetch_assoc()) {

            $ryhmat2id = $rowt22[id];

            if (!$result1 = $db->query("select etunimi, sukunimi from ryhmat2, opiskelijan_kurssityot, kayttajat where opiskelijan_kurssityot.ryhmat2_id = '" . $ryhmat2id . "' AND opiskelijan_kurssityot.kayttaja_id = kayttajat.id ")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowt1 = $result1->fetch_assoc()) {
                $nimi = $rowt1[etunimi] . ' ' . $rowt1[sukunimi];
            }
            array_push($opiskelijat, $nimi);
        }
        $maara2 = 0;
        foreach ($opiskelijat as $opiskelija) {
            $maara2++;


            if ($maara2 == 1) {
                $opiskelijalista = $opiskelija;
            } else {



                $opiskelijalista = $opiskelijalista . ', ' . $opiskelija;
            }
        }
        if ($maara == 1) {
            $teksti = "Seuraavan opiskelijan tiedosto on laitettu linkkinä: " . $opiskelijalista;
        } else {
            $teksti = "Seuraavien opiskelijoiden tiedosto on laitettu linkkinä: " . $opiskelijalista;
        }

        echo json_encode(array('status' => 'error', 'viesti' => 'linkki', 'teksti' => $teksti));
    } else if ($result23->num_rows != 0 && $result24->num_rows == 0) {

        if (!$result22 = $db->query("select * from ryhmat2 where projekti_id = '" . $pid . "' AND linkki=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $maara = $result22->num_rows;

        $opiskelijat = array();
        while ($rowt22 = $result22->fetch_assoc()) {

            $ryhmat2id = $rowt22[id];

            if (!$result1 = $db->query("select etunimi, sukunimi from ryhmat2, opiskelijan_kurssityot, kayttajat where opiskelijan_kurssityot.ryhmat2_id = '" . $ryhmat2id . "' AND opiskelijan_kurssityot.kayttaja_id = kayttajat.id ")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowt1 = $result1->fetch_assoc()) {
                $nimi = $rowt1[etunimi] . ' ' . $rowt1[sukunimi];
            }
            array_push($opiskelijat, $nimi);
        }
        $maara2 = 0;
        foreach ($opiskelijat as $opiskelija) {
            $maara2++;


            if ($maara2 == 1) {
                $opiskelijalista = $opiskelija;
            } else {



                $opiskelijalista = $opiskelijalista . ', ' . $opiskelija;
            }
        }
        if ($maara == 1) {
            $teksti = "Ladattavia tiedostoja ei ole palautettu mutta seuraavan opiskelijan tiedosto on laitettu linkkinä: " . $opiskelijalista;
        } else {
            $teksti = "Ladattavia tiedostoja ei ole palautettu mutta seuraavien opiskelijoiden tiedosto on laitettu linkkinä: " . $opiskelijalista;
        }

        echo json_encode(array('status' => 'error', 'viesti' => 'linkki', 'teksti' => $teksti));
    } else {
        $teksti = "Kukaan ei ole vielä palauttanut tiedostoa";
        echo json_encode(array('status' => 'error', 'viesti' => 'linkki', 'teksti' => $teksti));
    }
}
?>
