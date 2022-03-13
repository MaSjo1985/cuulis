<?php
session_start(); 



ob_start();




include("yhteys.php");

if (!$haenimi = $db->query("select distinct nimi, koodi from kurssit where id='" . $_GET[kurssi] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$nyt = date("d.m.Y H.i");
while ($rowN = $haenimi->fetch_assoc()) {

    $nimi = $rowN[koodi] . " " . $rowN[nimi] . ': Opiskelijalista  (' . $nyt . ')';
}



if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_GET[kurssi] . "' ORDER BY sukunimi asc, etunimi")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}


$list = array();

$list[0] = array();


$list[0]['sukunimi'] = 'Sukunimi';
$list[0]['etunimi'] = 'Etunimi';


$rivi = array();

while ($row = $result->fetch_assoc()) {
    $rivi['sukunimi'] = $row[sukunimi];
    $rivi['etunimi'] = $row[etunimi];
    $list[] = $rivi;
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
