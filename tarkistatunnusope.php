<?php
session_start();

ob_start();

include("yhteys.php");

$tarkistettusposti = htmlspecialchars($_POST['username']);
 $tarkistettusposti = trim($tarkistettusposti);
if (!filter_var($tarkistettusposti, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array('status' => 'error', 'msg' => 'virhe'));
} else {

    $siivottusposti = mysqli_real_escape_string($db, $_POST['username']);

    $stmt = $db->prepare("SELECT DISTINCT id FROM kayttajat WHERE BINARY sposti=?");
    $stmt->bind_param("s", $sposti);
    // prepare and bind
  $sposti = trim($siivottusposti);
    $sposti=strtolower($sposti);
    $stmt->execute();

    $stmt->store_result();

  $stmt->bind_result($column1);

    while ($stmt->fetch()) {
        $id = $column1;
    }

//sähköpostiosoite ei rekisteröity
    if ($stmt->num_rows == 0) {

        echo json_encode(array('status' => 'success', 'msg' => 'no error'));
    } else {
        
                     if(isset($_POST[id])){
                if($_POST[id] == $id ){
                   echo json_encode(array('status' => 'success', 'msg' => $sposti)); 
                }
                else{
                     echo json_encode(array('status' => 'error', 'msg' => 'sama'));
                }
            }
            else{
                    echo json_encode(array('status' => 'error', 'msg' => 'sama'));
            }
        
    }
    $stmt->close();
}
?>