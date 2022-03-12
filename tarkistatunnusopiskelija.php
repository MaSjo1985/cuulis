<?php
session_start();

ob_start();

include("yhteys.php");


$siivottusposti = mysqli_real_escape_string($db, $_POST['username']);
$sposti = trim($siivottusposti);
$onkovalilyonti = strrpos($sposti, " ");


$siivottusalasana = mysqli_real_escape_string($db, $_POST[uusi]);
$siivottuuusisalasana = mysqli_real_escape_string($db, $_POST[uusi2]);
$siivottusalasana = trim($siivottusalasana);
$siivottuuusisalasana = trim($siivottuuusisalasana);
// prepare and bind




if ($onkovalilyonti) {
    echo json_encode(array('status' => 'lyonti', 'msg' => 'error'));
} else {
    $stmt = $db->prepare("SELECT DISTINCT id FROM kayttajat WHERE BINARY sposti=?");
    $stmt->bind_param("s", $sposti);
    $stmt->execute();

    $stmt->store_result();
    $stmt->bind_result($column1);

    while ($stmt->fetch()) {
        $id = $column1;
    }

    if ($_POST[admin] == 'admin') {
        if ($siivottusalasana != $siivottuuusisalasana) {
            echo json_encode(array('status' => 'errors', 'msg' => 'error'));
        } else {
            // ei rekisteröity
            if ($stmt->num_rows == 0) {

                echo json_encode(array('status' => 'success', 'msg' => 'no error'));
            } else {
     if(isset($_POST[id])){
                if($_POST[id] == $id ){
                   echo json_encode(array('status' => 'success', 'msg' => $sposti)); 
                }
                else{
                     echo json_encode(array('status' => 'errork', 'msg' => 'sama'));
                }
            }
            else{
                    echo json_encode(array('status' => 'errork', 'msg' => 'sama'));
            }
                
            }
        }
    } else {
        // ei rekisteröity
        if ($stmt->num_rows == 0) {

            echo json_encode(array('status' => 'success', 'msg' => $sposti));
        } else {
            
            if(isset($_POST[id])){
                if($_POST[id] == $id ){
                   echo json_encode(array('status' => 'success', 'msg' => $sposti)); 
                }
                else{
                     echo json_encode(array('status' => 'errork', 'msg' => 'sama'));
                }
            }
            else{
                    echo json_encode(array('status' => 'errork', 'msg' => 'sama'));
            }

        
        
            
            }
    }


    $stmt->close();
}
?>