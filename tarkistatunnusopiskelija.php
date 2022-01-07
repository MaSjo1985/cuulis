<?php

ob_start();

include("yhteys.php");


$siivottusposti = mysqli_real_escape_string($db, $_POST['username']);
$sposti = trim($siivottusposti);
$onkovalilyonti = strrpos($sposti," ");


 $siivottusalasana = mysqli_real_escape_string($db, $_POST[uusi]);
    $siivottuuusisalasana = mysqli_real_escape_string($db, $_POST[uusi2]);
    $siivottusalasana = trim($siivottusalasana);
$siivottuuusisalasana = trim($siivottuuusisalasana);
// prepare and bind




if($onkovalilyonti){
     echo json_encode(array('status' => 'lyonti', 'msg' => 'error'));
}
else{
    $stmt = $db->prepare("SELECT DISTINCT * FROM kayttajat WHERE BINARY sposti=?");
$stmt->bind_param("s", $sposti);
$stmt->execute();

$stmt->store_result();

if ($_POST[admin] == 'admin') {
    if ( $siivottusalasana != $siivottuuusisalasana) {
        echo json_encode(array('status' => 'errors', 'msg' => 'error'));
    } else {
        // ei rekisteröity
        if ($stmt->num_rows == 0) {

            echo json_encode(array('status' => 'success', 'msg' => 'no error'));
        } else {


            echo json_encode(array('status' => 'errork', 'msg' => 'error'));
        }
    }
} else {
    // ei rekisteröity
    if ($stmt->num_rows == 0) {

        echo json_encode(array('status' => 'success', 'msg' => $sposti));
    } else {


        echo json_encode(array('status' => 'errork', 'msg' => 'error'));
    }
}


$stmt->close();



}

?>