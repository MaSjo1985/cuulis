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


echo'<div class="cm8-margin-top"></div></div>';

$tiedostot = array();


echo'<div class="cm8-half" style="padding-top: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 10px">';


if (!$haeryhmat = $db->query("select distinct * from ryhmat where projekti_id='" . $_GET[id] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($row1 = $haeryhmat->fetch_assoc()) {

    $ryhmanimi = $row1[nimi];
    $ryhmaid = $row1[id];


    if (!$haetiedostoteka = $db->query("select distinct ryhmat2.omatallennusnimi as omatallennusnimi, ryhmat2.id as ryid, ryhmat2.linkki as linkki, ryhmat2.muutettu as muutettu, ryhmat2.tallennettunimi as tallennettunimi, kayttajat.etunimi as etunimi, kayttajat.sukunimi as sukunimi from opiskelijan_kurssityot, ryhmat2, kayttajat where ryhmat2.ryhma_id='" . $ryhmaid . "' AND opiskelijan_kurssityot.ryhmat2_id=ryhmat2.id AND opiskelijan_kurssityot.kayttaja_id=kayttajat.id")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    $maara = $haetiedostoteka->num_rows;

    while ($row2 = $haetiedostoteka->fetch_assoc()) {

        $muutettu = $row2[muutettu];
        $linkki = $row2[linkki];
        $ryhmat2id = $row2[ryid];


        if ($muutettu == 0 && $linkki == 0) {

            $vanhanimi = $row2[omatallennusnimi];
            $tallennettunimivanha = $row2[tallennettunimi];


            if ($haetiedostoteka->num_rows == 1) {
                $opiskelija = $row2[sukunimi] . ' ' . $row2[etunimi];
            } else {
                if ($maara == $haetiedostoteka->num_rows) {
                    $opiskelija = $row2[sukunimi] . ' ' . $row2[etunimi];
                } else {
                    $opiskelija = $row2[sukunimi] . ' ' . $row2[etunimi] . ', ' . $opiskelija;
                }
                $maara--;
            }

            $uusinimi = '(' . $opiskelija . ') ' . $vanhanimi;
            $tallennettunimiuusi = 'tiedostot/' . $uusinimi;

            $db->query("update ryhmat2 set omatallennusnimi='" . $uusinimi . "' where id = '" . $ryhmat2id . "'");
            $db->query("update ryhmat2 set tallennettunimi='" . $tallennettunimiuusi . "' where id = '" . $ryhmat2id . "'");
            $db->query("update ryhmat2 set muutettu=1 where id = '" . $ryhmat2id . "'");


            rename($tallennettunimivanha, $tallennettunimiuusi);
        }
    }
}
if (!$haetiedostot = $db->query("select * from ryhmat2 where projekti_id='" . $_GET[id] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
if (!$kurssi = $db->query("select distinct kuvaus from projektit where id='" . $_GET[id] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
while ($rowP = $kurssi->fetch_assoc()) {

    $kuvaus = $rowP[kuvaus];
}
while ($rowT = $haetiedostot->fetch_assoc()) {

    $id = $rowT[id];

    if (!$result = $db->query("select distinct * from ryhmat2 where id = '" . $id . "' AND linkki=0")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row = $result->fetch_assoc()) {
        $nimi = 'tiedostot/' . $row[omatallennusnimi];

        if (file_exists($nimi)) {
            array_push($tiedostot, $nimi);
        } else {
            
        }
    }
}

$zipname = $kuvaus . ' (' . $_SESSION[Koodi] . ' ' . $_SESSION[KurssiNimi] . ').zip';
$zip = new ZipArchive;
$res = $zip->open($zipname, ZipArchive::CREATE);


$maara8 = 0;
foreach ($tiedostot as $file) {
    # download file
    $download_file = file_get_contents($file);

    #add it to the zip
    $zip->addFromString(basename($file), $download_file);
    $maara8++;
    $fileuusi = substr($file, 10);
    $fileuusi = "/" . $kuvaus . ' (' . $_SESSION[Koodi] . ' ' . $_SESSION[KurssiNimi] . ')/' . $fileuusi;
    $zip->renameName($file, $fileuusi);
}


$maara = $zip->numFiles;

$zip->close();
while (ob_get_level()) {
    ob_end_clean();
}
flush();
header('Content-disposition: attachment; filename=' . $zipname);
header('Content-type: application/zip');
readfile($zipname);

unlink($zipname);


echo "</div>";
echo "</div>";

include("footer.php");
?>

</body>
</html>