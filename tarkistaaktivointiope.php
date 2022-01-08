<?php

ob_start();

include("yhteys.php");

$tarkistettusposti = htmlspecialchars($_POST['username']);
$siivottusposti = mysqli_real_escape_string($db, $_POST['username']);
$siivottusposti = trim($siivottusposti);
    $stmt = $db->prepare("SELECT DISTINCT rooli FROM kayttajat WHERE sposti=?");
    $stmt->bind_param("s", $sposti);
    // prepare and bind
    $sposti = $siivottusposti;

    $stmt->execute();
   

$stmt->store_result();

  $stmt->bind_result($column1);
  
  while ($stmt->fetch()) {
         
            $rooli=$column1;
       
        }
        
        if($rooli=='opiskelija'){
            echo json_encode(array('status' => 'erroropiskelija', 'msg' => 'opiskelija'));
        }
        else{
            if (!filter_var($tarkistettusposti, FILTER_VALIDATE_EMAIL))
    echo json_encode(array('status' => 'error', 'msg' => 'Antamasi käyttäjätunnus on virheellinen!'));

else {
    


    if ($stmt->num_rows == 0) {
        echo json_encode(array('status' => 'error', 'msg' => 'error'));
    } else {

        echo json_encode(array('status' => 'success', 'msg' => 'no error'));
    }
   
}
        }

 $stmt->close();
?>
