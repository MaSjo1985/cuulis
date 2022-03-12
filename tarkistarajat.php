<?php
session_start();

ob_start();

$paiva = $_POST[paiva];
$kello = $_POST[kello];

$paiva_ok = true;
$kello_ok = true;
$regexP = '^[0-9]{2}.[0-9]{2}.[0-9]{4}$';
$regexK = '^[0-9]{2}:[0-9]{2}$';



if (preg_match($regexP, $paiva)) {
    $paiva_ok = true;
} else {
    $paiva_ok = false;
}

if (preg_match($regexK, $kello)) {
    $kello_ok = true;
} else {
    $kello_ok = false;
}

//PÄIVÄ OK:
//tsekkaa onko eka ja toka numeroita
//tsekkaa onko kolmas .
//tsekkaa onko neljäs ja viides numeroita
//tsekkaa onko kuudes .
//tsekkaa onko seiska, kasi, ysi ja kybä numeroita
//tsekkaa onko pituus 10
//KELLO OK:
//tsekkaa onko eka ja toka numeroita
//tsekkaa onko kolmas :
//tsekkaa onko neljäs ja viides numeroita
//tsekkaa onko pituus 5

if (!$paiva_ok && $kello_ok) {

    echo json_encode(array('status' => 'error', 'msg' => 'paivaerror'));
} else if (!$kello_ok && $paiva_ok) {
    echo json_encode(array('status' => 'error', 'msg' => 'kelloerror'));
} else if (!$kello_ok && !$paiva_ok) {
    echo json_encode(array('status' => 'error', 'msg' => 'error'));
} else {
    echo json_encode(array('status' => 'success', 'msg' => 'ok'));
}