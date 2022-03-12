<?php
session_start();
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


    $siivottutunnus = mysqli_real_escape_string($db, $_POST[tunnus]);
    $siivottutunnus = trim($siivottutunnus);
    $tunnus = $siivottutunnus;
    
  
   $paivays = "" . date("h:i:s") . "";
    $uniqid = $paivays.uniqid('', true);
   $krypattu2 = md5($uniqid);

    $id = $_POST["id"];

    $stmt = $db->prepare("UPDATE kayttajat SET sposti=?, uusitunnus = 1, tarkistuskoodi=? WHERE id=?");
    $stmt->bind_param("ssi", $tunnus, $tarkistuskoodi,$id);
// prepare and bind
    $tarkistuskoodi = $krypattu2;

    
    $stmt->execute();

    $stmt->close();

    
            
             if (!empty($_POST[url])){
            
                       header("location: vaihdatunnustodennus.php?url=' . $_POST[url].'&id=". $_POST[id] ); 
             }
             else{
                  header('location: vaihdatunnustodennus.php?id='. $_POST[id] );
             }
           
               
           
       

    echo "</div>";
    echo "</div>";
    include("footer.php");
} else {

    header("location: kirjautuminenuusi.php");
}
?>

</body>
</html>	
