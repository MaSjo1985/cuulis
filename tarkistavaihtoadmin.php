<?php

ob_start();

include("yhteys.php");
session_start();

 $siivottusalasana = mysqli_real_escape_string($db, $_POST[uusi]);
    $siivottuuusisalasana = mysqli_real_escape_string($db, $_POST[uusi2]);
    $siivottusalasana = trim($siivottusalasana);
$siivottuuusisalasana = trim($siivottuuusisalasana);
    if ( $siivottusalasana == $siivottuuusisalasana) {

    echo json_encode(array('status' => 'success', 'msg' => 'no error'));
} else {
    echo json_encode(array('status' => 'error', 'msg' => 'Salasanat eivät vastaa toisiaan!'));
}
?>
