<?php
session_start();

ob_start();

include("yhteys.php");


$tarkistettusposti = htmlspecialchars($_POST['tunnus']);

$siivottusposti = mysqli_real_escape_string($db, $_POST['tunnus']);
$siivottusposti = trim($siivottusposti);

$stmt = $db->prepare("SELECT DISTINCT id FROM kayttajat WHERE BINARY sposti=?");
$stmt->bind_param("s", $sposti);
// prepare and bind
$sposti = $siivottusposti;

$stmt->execute();

$stmt->store_result();
        $stmt->bind_result($col1);

        while ($stmt->fetch()) {
            $id = $col1;
        }



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
        if($id == $_POST[id]){
             echo json_encode(array('status' => 'error1', 'msg' => 'pelkka rek'));
        }
        else{
             echo json_encode(array('status' => 'error2', 'msg' => 'pelkka rek'));
        }
          
    }

    
    
    
 
    
}
$stmt->close();
?>