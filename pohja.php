<?php
session_start(); 



ob_start();



if (!$tulosa = $db->query("select distinct sposti from kayttajat where rooli='admin'")) {
    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
}

while ($rowa = $tulosa->fetch_assoc()) {
    $spostia = $rowa["sposti"];
}
$otsikkoa = "Cuulis-oppimisympäristön sisällä on lähetetty viesti.";
$otsikkoa = "=?UTF-8?B?" . base64_encode($otsikkoa) . "?=";
$kyselya = 'Cuulis-oppimisympäristön sisällä lähetetyn viestin tiedot:  Nimi:  ' . $siivottusposti . ',  sähköpostiosoite:  ' . $siivottusposti . ', viesti: ' . $siivottusposti . '.';

$viestia = mail($spostia, $otsikkoa, $kyselya, $headers);
