<?php
ob_start();
ob_start();
ob_start();
session_start();
echo'
<!DOCTYPE html>
<html>
<head>

<title> Kirjautuminen</title>';

if (isset($_SESSION[Id])) {
    include("yhteys.php");

    include("header.php");
    echo'<div class="cm8-container7">';
    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
    echo'<div class="cm8-margin-top"></div>';


    $stmt = $db->prepare("SELECT DISTINCT kayttoehdot_hyvaksytty, nollattu FROM kayttajat WHERE BINARY id=?");
    $stmt->bind_param("i", $id);
// prepare and bind
    $id=$_SESSION[Id];


    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($col1, $col2);


    if ($stmt->num_rows == 1) {

        while ($stmt->fetch()) {
            $kayttoehdot = $col1;
            $nollattu = $col2;
          
        }

        if ($kayttoehdot ==0) {
             if (!empty($_GET[url]))
                header("location: hyvaksykayttoehdot.php?url=" . $_GET[url]);
            else
               
            header("location: hyvaksykayttoehdot.php");
        }
        else{
            //onko nollattu?!
            
            if($nollattu==1){
                  if (!empty($_GET[url]))
                header("location: vaihdasalasana.php?url=" . $_GET[url]);
            else
                header("location: vaihdasalasana.php");
            }
            else{
                 if (!empty($_GET[url]))
                header("location: kirjautuminen2.php?url=" . $_GET[url]);
            else
                header("location: kirjautuminen2.php"); 
            }
            
            
            
        }


    }
    else{
          header("location: kirjautuminenuusi.php");
    }


    $stmt->close();
    echo "</div>";
    echo "</div>";
    include("footer.php");
} else {

    header("location: kirjautuminenuusi.php");
}
?>

</body>
</html>	
