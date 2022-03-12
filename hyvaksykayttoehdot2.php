<?php
session_start(); 


ob_start();
ob_start();
ob_start();
echo'
<!DOCTYPE html>
<html>
<head>

<title> Kirjautuminen</title>';

if (isset($_POST[id])) {
    include("yhteys.php");

    include("header.php");
    echo'<div class="cm8-container7">';
    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
    echo'<div class="cm8-margin-top"></div>';
  $paivays = "" . date("h:i:s") . "";
    $uniqid = $paivays.uniqid('', true);
   $krypattu2 = md5($uniqid);

    $id = $_POST["id"];

    $stmt = $db->prepare("UPDATE kayttajat SET kayttoehdot_hyvaksytty = 1, tarkistuskoodi=? WHERE id=?");
    $stmt->bind_param("si", $tarkistuskoodi,$id);
// prepare and bind
    $tarkistuskoodi = $krypattu2;

    
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
