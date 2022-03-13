<?php
session_start(); 



ob_start();




include("yhteys.php");

if (!$haenimi = $db->query("select distinct nimi, koodi from kurssit where id='" . $_SESSION[KurssiId] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}




if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where id='" . $_GET[id] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}



$nyt = date("d.m.Y H.i");

while ($rowP = $onkoprojekti->fetch_assoc()) {

    $ipid = $rowP[id];
    $kuvaus = $rowP[kuvaus];
}
while ($rowN = $haenimi->fetch_assoc()) {

    $nimi = $rowN[koodi] . ' ' . $rowN[nimi] . ': ' . $kuvaus . ' (' . $nyt . ')';
}

if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' ORDER BY jarjestys")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

if (!$haetehtavat2 = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$yht = $haetehtavat2->num_rows;
if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipid . "' AND painotus = 1")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
if ($onkopisteet->num_rows != 0) {
    $pisteet = true;
}
if (!$onkopistevaikutus = $db->query("select distinct pisteetvaikuttaa from itseprojektit where id = '" . $ipid . "' AND pisteetvaikuttaa = 1")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
if ($onkopistevaikutus->num_rows != 0) {
    $pisteetvaikuttaa = true;
}
if (!$haepisteet = $db->query("select paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$pisteetyht = 0;
while ($rowpis = $haepisteet->fetch_assoc()) {
    $pisteetyht = $pisteetyht + $rowpis[paino];
}

if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, kayttajat.id as kaid from kayttajat, opiskelijankurssit where kayttajat.rooli='opiskelija' AND kayttajat.id=opiskelijankurssit.opiskelija_id AND kurssi_id='" . $_SESSION["KurssiId"] . "' ORDER BY sukunimi asc, etunimi")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

if (!$onkorivi3 = $db->query("select * from itseprojektit_lpisteet where itseprojekti_id='" . $ipid . "' ORDER BY osuus ASC")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}



$list = array();

$list[0] = array();

if (!$lpmax = $db->query("select MAX(pisteet) as lpmax from itseprojektit_lpisteet where itseprojekti_id = '" . $ipid . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($rowmax = $lpmax->fetch_assoc()) {

    $lpmax2 = $rowmax[lpmax];
}

if ($pisteet) {

    if (!$pisteetvaikuttaa) {
        $list[0]['nimi'] = 'Opiskelija';
        $list[0]['tehdytpros'] = "Tehdyt tehtävät (%)";
        $list[0]['tehdytkpl'] = "Tehdyt tehtävät  (/' . $yht . ' kpl)";
        $list[0]['osatut'] = "Osatut (%)";
        $list[0]['eiosatut'] = "Tehdyt, mutta ei osatut ilman apua (%)";
      
        if ($onkorivi3->num_rows != 0) {
            $list[0]['lpisteet'] = "Lisäpisteet (/" . $lpmax2 . "p)";
        }
    } else {
        $list[0]['nimi'] = 'Opiskelija';
         $list[0]['tehdytkpleka'] = "Tehtyjä tehtäviä  (/" . $yht . " kpl)";
        $list[0]['tehdytpros'] = "Tehtyjen tehtävien pisteiden osuus (%)";
        $list[0]['tehdytkpl'] = "Pisteitä kerätty (/" . $pisteetyht . "p)";
        $list[0]['osatut'] = "Osattujen tehtävien pisteiden osuus (%)";
        $list[0]['eiosatut'] = "Tehtyjen, mutta joita ei ole osattu ilman apua, pisteiden osuus(%)";

        if ($onkorivi3->num_rows != 0) {
            $list[0]['lpisteet'] = "Lisäpisteet (/" . $lpmax2 . "p)";
        }
    }
} else {
    $list[0]['nimi'] = 'Opiskelija';
      $list[0]['tehdytkpl'] = "Tehtyjä tehtäviä  (/" . $yht . " kpl)";
    $list[0]['tehdytpros'] = "Tehdyt tehtävät (%)";
    $list[0]['osatut'] = "Osattujen tehtävien osuus (%)";
    $list[0]['eiosatut'] = "Tehtyjen, mutta joita ei ole osattu ilman apua, osuus (%)";
    if ($onkorivi3->num_rows != 0) {
        $list[0]['lpisteet'] = "Lisäpisteet";
    }
}

while ($row = $result->fetch_assoc()) {

    if ((!$pisteetvaikuttaa && $pisteet) || !$pisteet ) {
        if (!$haetehdyt = $db->query("select distinct itsetehtavat.id as kid from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$haeosatut = $db->query("select distinct itsetehtavat.id as kid from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$haeeiosatut = $db->query("select distinct itsetehtavat.id as kid from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $tehdyt = $haetehdyt->num_rows;
        $osatut = $haeosatut->num_rows;
        $eiosatut = $haeeiosatut->num_rows;
    } else {
        
        if (!$haetehdytkpl = $db->query("select distinct itsetehtavat.id as kid from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        
        $tehdytkpl = $haetehdytkpl->num_rows;
        
        if (!$haepisteet = $db->query("select  paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $yht = 0;
        while ($rowpis = $haepisteet->fetch_assoc()) {
            $yht = $yht + $rowpis[paino];
        }

        //TEHDYT YHTEENSÄ
        if (!$haeomatpisteet = $db->query("select distinct itsetehtavat.id, itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $tehdyt = 0;

        while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
            $tehdyt = $tehdyt + $rowpis2[paino];
        }

        //TEHDYT JA OSATUT 
        if (!$haeomatpisteet = $db->query("select distinct itsetehtavat.id, itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $osatut = 0;

        while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
            $osatut = $osatut + $rowpis2[paino];
        }

        //TEHDYT EI-OSATUT
        if (!$haeomatpisteet = $db->query("select distinct itsetehtavat.id, itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $eiosatut = 0;

        while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
            $eiosatut = $eiosatut + $rowpis2[paino];
        }
    }


    if ($yht != 0) {
        $osatutosuus = ($osatut / $yht) * 100;
        $osatutosuus = round($osatutosuus, 0);
    } else {
        $osatutosuus = 0;
    }

    if ($yht != 0) {
        $eiosatutosuus = ($eiosatut / $yht) * 100;
        $eiosatutosuus = round($eiosatutosuus, 0);
    } else {
        $eiosatutosuus = 0;
    }

    if ($yht != 0) {
        $osuus = ($tehdyt / $yht) * 100;
        $osuus = round($osuus, 0);
    } else {
        $osuus = 0;
    }

    //haetaan lisäpisteet

    if (!$onkorivi3 = $db->query("select * from itseprojektit_lpisteet where itseprojekti_id='" . $ipid . "' ORDER BY osuus ASC")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    $opkorkeus = $osuus;
    $lpisteet = 0;
    while ($rowr = $onkorivi3->fetch_assoc()) {
        $seliter = $rowr[pisteet];

        $osuusr = $rowr[osuus];

        if ($opkorkeus >= $osuusr) {
            $lpisteet = $seliter;
        } else {
            
        }
    }




    if ($pisteet) {
        if (!$haeomatpisteet = $db->query("select distinct itsetehtavat.id, itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $row[kaid] . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $omatpisteetyht = 0;
        while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
            $omatpisteetyht = $omatpisteetyht + $rowpis2[paino];
        }





        $opkorkeus = $omatpisteetyht / $pisteetyht * 100;
        //haetaan tasot
        if (!$onkorivi2 = $db->query("select * from itseprojektit_tasot where itseprojekti_id='" . $ipid . "' ORDER BY osuus ASC")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $taso = "";
        while ($rowr = $onkorivi2->fetch_assoc()) {
            $seliter = str_replace('<br />', "", $rowr[selite]);

            $osuusr = $rowr[osuus];

            if ($opkorkeus >= $osuusr) {
                $taso = $seliter;
            } else {
                
            }
        }

        if ($taso == "") {
            $taso = '(ei ylitettyä tasoa)';
        }
    }
//                 die('opkorkeus: '.$opkorkeus .'<br>osuuser: '.$osuusr); 



    $rivi = array();


    
    $rivi['nimi'] = $row[sukunimi] . " " . $row[etunimi];
    if($pisteetvaikuttaa){
         $rivi['tehdytkpleka'] = $tehdytkpl;
          $rivi['tehdytpros'] = $osuus;
    $rivi['tehdytkpl'] = $tehdyt;
    }
    else{
        
    $rivi['tehdytkpl'] = $tehdyt;
     $rivi['tehdytpros'] = $osuus;
    }
   
   
    $rivi['osatut'] = $osatutosuus;
    $rivi['eiosatut'] = $eiosatutosuus;

  
    if ($onkorivi3->num_rows != 0) {
        $rivi['lpisteet'] = $lpisteet;
    }

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
