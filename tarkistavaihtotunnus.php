<?php

ob_start();

include("yhteys.php");




$tarkistettusposti = htmlspecialchars($_POST['username']);



$siivottusposti = mysqli_real_escape_string($db, $_POST['username']);

$stmt = $db->prepare("SELECT DISTINCT * FROM kayttajat WHERE BINARY sposti=?");
$stmt->bind_param("s", $sposti);
// prepare and bind
$sposti = $siivottusposti;

$stmt->execute();

$stmt->store_result();



// ei rekisteröity
if ($stmt->num_rows == 0) {

    if ($_POST[admin] == 'admin') {
        if ($_POST[uusi] != $_POST[uusi2]) {

             echo json_encode(array('status' => 'error', 'msg' => 'pelkka salasana'));
        }
        else{
              echo json_encode(array('status' => 'success', 'msg' => 'no error'));
        }
    }
    else{
          echo json_encode(array('status' => 'success', 'msg' => 'no error'));
    }


  
} else {
    
    
    if ($_POST[admin] == 'admin') {
        if ($_POST[uusi] != $_POST[uusi2]) {

            echo json_encode(array('status' => 'error', 'msg' => 'salasana ja rek'));
        }
        else{
              echo json_encode(array('status' => 'error', 'msg' => 'pelkka rek'));
        }
    }
    else{
           echo json_encode(array('status' => 'error', 'msg' => 'pelkka rek'));
    }

    
    
    
    
   

    
    
}
$stmt->close();
?>