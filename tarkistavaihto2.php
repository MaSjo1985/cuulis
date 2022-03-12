<?php
session_start();

ob_start();

include("yhteys.php");



$tarkistettusposti = htmlspecialchars($_POST[sposti]);

if (!filter_var($tarkistettusposti, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array('status' => 'error', 'msg' => 'Virheellinen'));
} else {

    $siivottusposti = mysqli_real_escape_string($db, $_POST[sposti]);

    $stmt = $db->prepare("SELECT DISTINCT id FROM kayttajat WHERE BINARY sposti=?");
    $stmt->bind_param("s", $sposti);
    // prepare and bind
    $sposti = $siivottusposti;

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
                if ($id != $_SESSION["Id"]) {
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
