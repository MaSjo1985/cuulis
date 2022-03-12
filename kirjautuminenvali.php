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

if (isset($_SESSION[Id])) {
    include("yhteys.php");

    include("header.php");
    echo'<div class="cm8-container7">';
    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
    echo'<div class="cm8-margin-top"></div>';


    $stmt = $db->prepare("SELECT DISTINCT kayttoehdot_hyvaksytty, nollattu, uusitunnus FROM kayttajat WHERE BINARY id=?");
    $stmt->bind_param("i", $id);
// prepare and bind
    $id=$_SESSION[Id];
    $rooli=$_SESSION[Rooli];


    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($col1, $col2, $col3);


    if ($stmt->num_rows == 1) {

        while ($stmt->fetch()) {
            $kayttoehdot = $col1;
            $nollattu = $col2;
            $uusitunnus = $col3;
          
        }

        if ($kayttoehdot == 0) {
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
                
                //onko uusitunnus
                if($uusitunnus == 0 && $rooli=='opiskelija'){
                      if (!empty($_GET[url]))
                header("location: vaihdatunnus.php?url=" . $_GET[url]);
                else
                header("location: vaihdatunnus.php");
            
                
                
                }
                else{
                          if (!empty($_GET[url]))
                header("location: kirjautuminen2.php?url=" . $_GET[url]);
            else
                header("location: kirjautuminen2.php"); 
            }
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
