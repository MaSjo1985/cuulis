<?php
session_start();

ob_start();

include("yhteys.php");

$tarkistettusposti = htmlspecialchars($_POST['username']);

if (!filter_var($tarkistettusposti, FILTER_VALIDATE_EMAIL))
    echo json_encode(array('status' => 'error', 'msg' => 'Antamasi käyttäjätunnus on virheellinen!'));

else {
    $siivottusposti = mysqli_real_escape_string($db, $_POST['username']);
    $stmt = $db->prepare("SELECT DISTINCT * FROM kayttajat WHERE BINARY sposti=?");
    $stmt->bind_param("s", $sposti);
    // prepare and bind
    $sposti = $siivottusposti;

    $stmt->execute();

    $stmt->store_result();


    if ($stmt->num_rows == 0) {
        echo json_encode(array('status' => 'error', 'msg' => 'error'));
    } else {

        echo json_encode(array('status' => 'success', 'msg' => 'no error'));
    }
    $stmt->close();
}
?>
