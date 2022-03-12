<?php
session_start();

ob_start();

include("yhteys.php");


$siivottuvanhasalasana = mysqli_real_escape_string($db, $_POST[vanha]);
    $siivottuvanhasalasana = trim($siivottuvanhasalasana);
 $siivottusalasana = mysqli_real_escape_string($db, $_POST[uusi]);
    $siivottuuusisalasana = mysqli_real_escape_string($db, $_POST[uusi2]);
    $siivottusalasana = trim($siivottusalasana);
$siivottuuusisalasana = trim($siivottuuusisalasana);
$salt = "8CMr85";
$kryptattu3 = md5($salt . $siivottuvanhasalasana);

$stmt2 = $db->prepare("SELECT DISTINCT * FROM kayttajat WHERE BINARY id=? AND BINARY salasana=?");
$stmt2->bind_param("is", $id, $salasana);
// prepare and bind
$id = $_SESSION["Id"];
$salasana = $kryptattu3;
$stmt2->execute();

$stmt2->store_result();

if ($stmt2->num_rows != 1) {
    echo json_encode(array('status' => 'error', 'msg' => 'Vanha salasana väärin'));
} else {

    if ( $siivottusalasana == $siivottuuusisalasana) {

        echo json_encode(array('status' => 'success', 'msg' => 'no error'));
    } else {
        echo json_encode(array('status' => 'error', 'msg' => 'Salasanat eivät vastaa toisiaan!'));
    }
}
$stmt2->close();
?>
