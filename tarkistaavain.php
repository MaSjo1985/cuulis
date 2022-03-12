<?php
session_start();

ob_start();

include("yhteys.php");

$stmt = $db->prepare("SELECT DISTINCT * FROM kurssit WHERE BINARY id=? AND BINARY avain=?");
$stmt->bind_param("is", $kurssi, $avain);
// prepare and bind
$kurssi = $_POST["kurssi"];
$avain = $_POST["username"];
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    echo json_encode(array('status' => 'error'));
} else {
    $_SESSION[KurssiId] = $kurssi;
    echo json_encode(array('status' => 'success'));
}
$stmt->close();
?>
