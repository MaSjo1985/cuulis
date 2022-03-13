<?php
session_start(); 



ob_start();




include("yhteys.php");

if (!$haenimi = $db->query("select distinct nimi, koodi from kurssit where id='" . $_SESSION[KurssiId] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$nyt = date("d.m.Y H.i");
while ($rowN = $haenimi->fetch_assoc()) {

    $nimi = $rowN[koodi] . ' ' . $rowN[nimi] . ': Itsearviointilomakkeen vastaukset (' . $nyt . ')';
}




$list = array();


// TEHDÄÄN EKAN RIVIN SARAKKEISIIN OTSIKOT (eka ilman väliotsikoita)
if (!$haesarakkeet = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $_SESSION[KurssiId] . "' ORDER BY jarjestys")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}



$smaara = $haesarakkeet->num_rows;
//SARAKKEET
$sarake = 0;
$rivi = 0;
while ($rows = $haesarakkeet->fetch_assoc()) {

    $list[0][$sarake] = 'Viimeisin tallennus';
    $sarake++;
    $list[0][$sarake] = 'Sukunimi';
    $sarake++;
    $list[0][$sarake] = 'Etunimi';
    $sarake++;

    //OTSIKOT
    if (!$haesisalto = $db->query("select distinct * from ia WHERE kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys ='" . $rows[jarjestys] . "' AND onotsikko=1 ORDER BY jarjestys")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowo = $haesisalto->fetch_assoc()) {

        $rowo[otsikko] = str_replace('<br />', "", $rowo[otsikko]);
        $rowo[otsikko] = preg_replace("/\r|\n/", "", $rowo[otsikko]);
        $list[0][$sarake] = $rowo[otsikko];
        $sarake++;
    }

    $list[0][$sarake] = ' ';
    $sarake++;
}

// VASTAUKSET
if (!$haesarakkeet = $db->query("select distinct * from ia_sarakkeet where kurssi_id='" . $_SESSION[KurssiId] . "' ORDER BY jarjestys")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

$sarake = 0;



while ($rows = $haesarakkeet->fetch_assoc()) {
    $rivi = 1;
    //OPISKELIJAT

    if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row = $result->fetch_assoc()) {


        if (!$haeitse = $db->query("select distinct  id from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $rows[jarjestys] . "' order by jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowitse = $haeitse->fetch_assoc()) {
            $itseid = $rowitse[id];

            if (!$haemuokattu = $db->query("select distinct  muokattu from iakp where ia_id='" . $itseid . "' AND kayttaja_id='" . $row[kaid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowm = $haemuokattu->fetch_assoc()) {


                $muokattu = $rowm[muokattu];
            }
        }
        if ($muokattu != NULL) {
            $list[$rivi][$sarake] = $muokattu;
        } else {
            $list[$rivi][$sarake] = '-';
        }

        $sarake++;



        $list[$rivi][$sarake] = $row[sukunimi];

        $sarake++;

        $list[$rivi][$sarake] = $row[etunimi];

        $sarake++;


        // HAKEE TEKSTIKENTÄT
        if (!$haevastaus = $db->query("select distinct * from ia where kurssi_id = '" . $_SESSION[KurssiId] . "' AND  ia_sarakkeet_jarjestys='" . $rows[jarjestys] . "' AND onvastaus=1 order by jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowvast = $haevastaus->fetch_assoc()) {

            if ($rowvast[onteksti] == 1) {

                if (!$result3 = $db->query("select distinct teksti from iakp where ia_id = '" . $rowvast[id] . "' AND kayttaja_id='" . $row[kaid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                while ($row3 = $result3->fetch_assoc()) {
                    $teksti = $row3[teksti];
                    $teksti = str_replace('<br />', " ", $teksti);
                    $teksti = preg_replace("/\r|\n/", "", $teksti);
                }

                $list[$rivi][$sarake] = $teksti;
                $sarake++;
            } else if ($rowvast[onradio] == 1) {
                if (!$result3 = $db->query("select distinct iavaihtoehdot.vaihtoehto as vaihtoehto from iakp, iavaihtoehdot where iakp.iavaihtoehdot_id=iavaihtoehdot.id AND iavaihtoehdot.ia_id = '" . $rowvast[id] . "' AND iakp.kayttaja_id='" . $row[kaid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                while ($row3 = $result3->fetch_assoc()) {
                    if ($radio != '') {
                        $radio = $radio . ', ' . $row3[vaihtoehto];
                    } else {
                        $radio = $row3[vaihtoehto];
                    }
                }
                $list[$rivi][$sarake] = $radio;


                $sarake++;
            } else if ($rowvast[oncheckbox] == 1) {

                if (!$result3 = $db->query("select distinct iavaihtoehdot.vaihtoehto as vaihtoehto from iakp_moni, iavaihtoehdot where iakp_moni.iavaihtoehdot_id=iavaihtoehdot.id AND iavaihtoehdot.ia_id = '" . $rowvast[id] . "' AND iakp_moni.kayttaja_id='" . $row[kaid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($row3 = $result3->fetch_assoc()) {

                    if ($checkbox != '') {
                        $checkbox = $checkbox . ', ' . $row3[vaihtoehto];
                    } else {
                        $checkbox = $row3[vaihtoehto];
                    }
                }
                $list[$rivi][$sarake] = $checkbox;

                $sarake++;
            }
        }
        $list[$rivi][$sarake] = ' ';
        $sarake++;
        $rivi++;
    }

//SARAKE MENEE KIINNI
}





$fp = fopen('tiedostot/excel/' . $nimi . '.csv', "w");


foreach ($list as $field) {
    fprintf($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
    vujo_fputcsv($fp, $field, ';');
}
$file = 'tiedostot/excel/' . $nimi . '.csv';


if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
}

if (file_exists($file)) {

    unlink($file);
}

function vujo_fputcsv($handle, $fields, $delimiter = ',') {
    if (!is_resource($handle)) {
        user_error('fputcsv() první parametr musí být data, ale tys mě dal' . gettype($handle) . '!', E_USER_WARNING);
        return false;
    }
    $str = '';
    foreach ($fields as $cell) {




        $str .= $cell . $delimiter;
    }
    fputs($handle, substr($str, 0, -1) . "\n");
    return strlen($str);
}
