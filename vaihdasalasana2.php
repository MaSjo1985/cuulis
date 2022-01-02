<?php
ob_start();

echo'<!DOCTYPE html>
<html>
 
<head>

<title>Salasana vaihdettu </title>';


include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

if (isset($_POST[id])) {
    include("yhteys.php");

    include("header.php");
    echo'<div class="cm8-container7">';
    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
    echo'<div class="cm8-margin-top"></div>';


    $siivottusalasana = mysqli_real_escape_string($db, $_POST[Salasana]);
    $siivottuuusisalasana = mysqli_real_escape_string($db, $_POST[UusiSalasana]);
    $salt = "8CMr85";
    $krypattu = md5($salt . $siivottusalasana);
 
    $stmt = $db->prepare("UPDATE kayttajat SET salasana=?, yritykset = 0, nollattu=0 WHERE id=?");
    $stmt->bind_param("si", $salasana, $id);
// prepare and bind

    $salasana = $krypattu;
    
    $yritykset = 0;
    $id = $_POST["id"];

    $stmt->execute();

    $stmt->close();
            
             if (!empty($_POST[url]))
                header("location: tarkistusuusi.php?url=' . $_POST[url].'&id=". $_POST[id] );
            else
               
            header("location: tarkistusuusi.php?id=". $_POST[id] );
       

    echo "</div>";
    echo "</div>";
    include("footer.php");
} else {

    header("location: kirjautuminenuusi.php");
}
?>

</body>
</html>		
