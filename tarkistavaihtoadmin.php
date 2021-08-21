<?php

ob_start();

include("yhteys.php");
session_start();



if ($_POST[uusi] == $_POST[uusi2]) {

    echo json_encode(array('status' => 'success', 'msg' => 'no error'));
} else {
    echo json_encode(array('status' => 'error', 'msg' => 'Salasanat eivät vastaa toisiaan!'));
}
?>
