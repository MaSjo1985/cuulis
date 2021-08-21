<?php

ob_start();

include("yhteys.php");



if ($_POST[salasana] == $_POST[salasana2]) {

    echo json_encode(array('status' => 'success', 'msg' => 'no error'));
} else {
    echo json_encode(array('status' => 'error', 'msg' => 'Salasanat eivät vastaa toisiaan!'));
}
?>
