<?php
session_start();

ob_start();

include("yhteys.php");



$tarkistettusposti = htmlspecialchars($_POST[sposti]);
 $tarkistettusposti = trim($tarkistettusposti);

if (!filter_var($tarkistettusposti, FILTER_VALIDATE_EMAIL) && $_POST[rooli]!='opiskelija') {
    echo json_encode(array('status' => 'error', 'msg' => 'virhe'));
} else {

    $siivottusposti = mysqli_real_escape_string($db, $_POST[sposti]);
  $siivottusposti = trim($siivottusposti);
  if( $_POST[rooli]!='opiskelija'){
    $siivottusposti=strtolower($siivottusposti);  
  }
    
    
    $stmt = $db->prepare("SELECT DISTINCT id FROM kayttajat WHERE BINARY sposti=? AND BINARY id<>?");
    $stmt->bind_param("si", $sposti, $idv);
    // prepare and bind
    $sposti = $siivottusposti;
    
    $idv = $_POST[id];
    $stmt->execute();

    $stmt->store_result();

    $stmt->bind_result($column1);


    if ($stmt->num_rows == 0) {

        echo json_encode(array('status' => 'success', 'msg' => 'vapaa'));
    } else {
        $virhe = 0;

        if ($stmt->num_rows != 0) {
            while ($stmt->fetch()) {
                $id = $column1;
                if ($id != $_POST[id]) {
                    $virhe = 1;
                }
            }

            if ($virhe == 1) {
                echo json_encode(array('status' => 'error', 'msg' => 'Varattu'));
            } else {
                echo json_encode(array('status' => 'success', 'msg' => 'vanha'));
            }
        }
    }
    $stmt->close();
}
?>
