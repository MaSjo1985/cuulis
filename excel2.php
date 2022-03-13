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

if (!$onkoprojekti = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}


if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}


$list = array();
$list[0][0] = 'Viimeisin tallennus';
$list[0][1] = 'Opiskelija';
$list[1][0] = '';
$list[1][1] = '';

// TEHDÄÄN EKAN RIVIN SARAKKEISIIN OTSIKOT (eka ilman väliotsikoita)
if (!$onkoprojekti = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_SESSION[KurssiId] . "' AND aihe=1 ORDER BY jarjestys")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

$sarake = 1;
//TEHDÄÄN RIVI 0:

while ($rowo = $onkoprojekti->fetch_assoc()) {

    $sarake++;
    $rowo[otsikko] = str_replace('<br />', "", $rowo[otsikko]);
    $rowo[otsikko] = preg_replace("/\r|\n/", "", $rowo[otsikko]);
    //HAETAAN VÄLIAIHEET:

    $jarjestys = $rowo[jarjestys];

    $uusijarjestys = $jarjestys + 1;
    if (!$haevali = $db->query("select distinct * from itsearvioinnit where kurssi_id='" . $_SESSION[KurssiId] . "' AND valiaihe=1 AND jarjestys='" . $uusijarjestys . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    $list[0][$sarake] = $rowo[otsikko];
    if ($haevali->num_rows == 0) {


        $list[1][$sarake] = '';
    } else {
        while ($rowvali = $haevali->fetch_assoc()) {


            $rowvali[otsikko] = str_replace('<br />', "", $rowvali[otsikko]);
            $rowvali[otsikko] = preg_replace("/\r|\n/", "", $rowvali[otsikko]);



            $valiotsikko = $rowvali[otsikko];
        }

        $list[1][$sarake] = $valiotsikko;
    }
}

//VIKAAN SARAKKEESEEN PISTEET:

$sarake++;
$list[0][$sarake] = 'Pisteet';
$list[1][$sarake] = '';


// LÄHETÄÄN KÄYMÄÄN OPISKELIJAT LÄPI
$rivi = 3;

while ($row = $result->fetch_assoc()) {
    $sarake = 0;

    if (!$resultm = $db->query("select distinct muokattu from itsearvioinnit, itsearvioinnitkp where itsearvioinnit.kurssi_id='" . $_SESSION[KurssiId] . "' AND itsearvioinnit.aihe=0 AND (itsearvioinnit.valiaihe=0 OR itsearvioinnit.valiaihe IS NULL) AND itsearvioinnitkp.itsearvioinnit_id = itsearvioinnit.id AND itsearvioinnitkp.kayttaja_id='" . $row[kaid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowm = $resultm->fetch_assoc()) {

        $muokattu = $rowm[muokattu];
    }
    $list[$rivi][$sarake] = $muokattu;
    $sarake++;

    $list[$rivi][$sarake] = $row[sukunimi] . ' ' . $row[etunimi];

    $sarake++;




    if (!$result3 = $db->query("select distinct teksti from itsearvioinnit, itsearvioinnitkp where itsearvioinnit.kurssi_id='" . $_SESSION[KurssiId] . "' AND itsearvioinnit.aihe=0 AND (itsearvioinnit.valiaihe=0 OR itsearvioinnit.valiaihe IS NULL) AND itsearvioinnitkp.itsearvioinnit_id = itsearvioinnit.id AND itsearvioinnitkp.kayttaja_id='" . $row[kaid] . "' order by itsearvioinnit.jarjestys")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row3 = $result3->fetch_assoc()) {

        $row3[teksti] = str_replace('<br />', "", $row3[teksti]);

        $list[$rivi][$sarake] = $row3[teksti];

        $sarake++;
    }


    if (!$haearvioinnit = $db->query("select distinct * from itsearvioinnit_pisteet where kurssi_id='" . $_SESSION["KurssiId"] . "' AND kayttaja_id='" . $row[kaid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    $pisteet = '-';
    while ($rowkpp = $haearvioinnit->fetch_assoc()) {
        if ($rowkpp[opetallennus2] == 1) {
            $pisteet = $rowkpp[pisteet];
        } else {
            $pisteet = '-';
        }
    }
    $list[$rivi][$sarake] = $pisteet;
    $rivi++;
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
