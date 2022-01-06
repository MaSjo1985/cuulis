<?php

ob_start();

include("yhteys.php");



$siivottusposti = mysqli_real_escape_string($db, $_POST['Sposti']);
echo'<br>sposti eka: '.$siivottusposti;
$stmt = $db->prepare("SELECT DISTINCT * FROM kayttajat WHERE BINARY sposti=?");
$stmt->bind_param("s", $sposti);
// prepare and bind
$siivottusposti = preg_replace('/\s+/', '', $siivottusposti);
echo'<br>sposti toka: '.$siivottusposti;

$sposti = trim($siivottusposti);
echo'<br>sposti kolmas: '.$sposti;

$stmt->execute();

$stmt->store_result();
echo'<br>määrä on: '.$stmt -> num_rows;
//if ($_POST[admin] == 'admin') {
//    if ($_POST[uusi] != $_POST[uusi2]) {
//        echo json_encode(array('status' => 'errors', 'msg' => 'error'));
//    } else {
//        // ei rekisteröity
//        if ($stmt->num_rows == 0) {
//
//            echo json_encode(array('status' => 'success', 'msg' => 'no error'));
//        } else {
//
//
//            echo json_encode(array('status' => 'error', 'msg' => 'error'));
//        }
//    }
//} else {
//    // ei rekisteröity
//    if ($stmt->num_rows == 0) {
//
//        echo json_encode(array('status' => 'success', 'msg' => 'no error'));
//    } else {
//
//
//        echo json_encode(array('status' => 'error', 'msg' => 'error'));
//    }
//}


$stmt->close();
?>