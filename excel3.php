<?php
session_start(); 

 
ob_start();




include("yhteys.php");
if (!$haenimi = $db->query("select distinct nimi, koodi from kurssit where id='" . $_SESSION[KurssiId] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$nyt = date("d.m.Y H.i");
while ($rowN = $haenimi->fetch_assoc()) {

    $nimi = $rowN[koodi] . ' ' . $rowN[nimi] . ': Kyselylomakkeen vastaukset (' . $nyt . ')';
}
if (!$resultn = $db->query("select distinct nimella from kyselyt where kurssi_id='".$_SESSION[KurssiId]."'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                } 
                
                 while ($rown = $resultn->fetch_assoc()) {
                     $nimella = $rown[nimella];
                 }

if (!$onkoprojekti = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION[KurssiId] . "' AND aihe=1 ORDER BY jarjestys")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$list = array();


$list[0][0] = 'Vastaus lähetetty';
if($nimella==1){
    $list[0][1] = 'Sukunimi';
    $list[0][2] = 'Etunimi';
}
if($nimella==1){
    $sarake = 2;
}
else{
    $sarake = 0;
}

//TEHDÄÄN RIVI 0:

while ($rowo = $onkoprojekti->fetch_assoc()) {

    $sarake++;
    $rowo[otsikko] = str_replace('<br />', "", $rowo[otsikko]);
    $rowo[otsikko] = preg_replace("/\r|\n/", "", $rowo[otsikko]);
    $list[0][$sarake] = $rowo[otsikko];
}

//TEHDÄÄN SARAKE 0:

if (!$onkoprojekti = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION[KurssiId] . "' ORDER by jarjestys")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($rowo = $onkoprojekti->fetch_assoc()) {
    $kyselyid = $rowo[id];
    if (!$haevastaukset = $db->query("select distinct muokattu from kyselytkp where kyselyt_id='" . $kyselyid . "' AND teksti <> ''")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }




    $vastauksia = 0;
    $rivinro = 0;
    while ($rowv = $haevastaukset->fetch_assoc()) {

        $rivinro++;
//        $list[$rivinro][0] = $rowv[muokattu];
    }
}





if (!$onkoprojekti = $db->query("select distinct * from kyselyt where kurssi_id='" . $_SESSION[KurssiId] . "' order by jarjestys")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}


if($nimella==1){
    $sarake = 2;
}
else{
    $sarake = 0;
}


//TEHDÄÄN VASTAUS SARAKKEET!!

while ($rowo = $onkoprojekti->fetch_assoc()) {
    $sarake++;

    $kyselyid = $rowo[id];
    //yks sarake kerrallaan

    if (!$haevastaukset = $db->query("select distinct * from kyselytkp where kyselyt_id='" . $kyselyid . "' AND teksti <> '' order by muokattu")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    $rivinro = 0;
    while ($rowv = $haevastaukset->fetch_assoc()) {

        $rivinro++;
    
        $list[$rivinro][0] = $rowv[muokattu];
        
        if($nimella==1){
             if (!$haeop = $db->query("select distinct * from kayttajat where id='" . $rowv[kayttaja_id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
     while ($rowop = $haeop->fetch_assoc()) {
         $etunimi = $rowop[etunimi];
         $sukunimi = $rowop[sukunimi];
          $list[$rivinro][1] = $sukunimi;
           $list[$rivinro][2] = $etunimi;
     }
     
        }
        $rowv[teksti] = str_replace('<br />', " ", $rowv[teksti]);
        $rowv[teksti] = preg_replace("/\r|\n/", "", $rowv[teksti]);
        $list[$rivinro][$sarake] = $rowv[teksti];
    }
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
