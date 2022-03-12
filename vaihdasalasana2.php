<?php
session_start();
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
      $siivottusalasana = trim($siivottusalasana);
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
    if(isset($_POST[id])){
   

    $stmt = $db->prepare("SELECT DISTINCT rooli, sposti, etunimi, sukunimi, id, paiva, kello, vahvistettu, tarkistettu, yritykset, nollattu, kayttoehdot_hyvaksytty, uusitunnus FROM kayttajat WHERE BINARY id=?");
    $stmt->bind_param("i", $id);
// prepare and bind
    $id=$_POST[id];
  $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($col1, $col2, $col4, $col5, $col6, $col7, $col8, $col9, $col10, $col11, $col12, $col13, $col14);
   if ($stmt->num_rows == 1) {

        while ($stmt->fetch()) {
            $rooli = $col1;
            $sposti = $col2;

            $etunimi = $col4;
            $sukunimi = $col5;
            $id = $col6;
            $paiva = $col7;
            $kello = $col8;
            $vahvistettu = $col9;
            $tarkistettu = $col10;
            $yritykset = $col11;
             $nollattu = $col12; 
             $kayttoehdot = $col13;
              $uusitunnus = $col14;
             
             
        }
   }
    
             // ready to go!
            if ($paiva != "0000-00-00" || $paiva != null) {
                $paiva = date("d.m.Y", strtotime($paiva));
                $_SESSION["Viimepaiva"] = $paiva;
            } else {
                $_SESSION["Viimepaiva"] = "";
            }

            $_SESSION["Viimekello"] = $kello;

            $db->query("update kayttajat set paiva='" . date("Y-m-d") . "' where id='" . $id . "'");
            $db->query("update kayttajat set yritykset=0 where id='" . $id . "'");
            $db->query("update kayttajat set kello='" . date("H:i:s") . "' where id='" . $id . "'");

            $_SESSION["Sposti"] = $sposti;

            $_SESSION["Rooli"] = $rooli;
            $_SESSION["Ekakerta"] = $ekakerta;
            $_SESSION["Etunimi"] = $etunimi;
            $_SESSION["Sukunimi"] = $sukunimi;
            $_SESSION["Id"] = $id;
            $_SESSION["Kayttajatunnus"] = $sposti;
            $_SESSION["Salasana"] = $krypattu;    
    
    
    
    }



  
    
    
             if (empty($_POST[url])){
                    
                    header('location: salasanavaihdettu.php?url=etusivu.php&id='. $_POST[id] );
             }
             else{
                 
                    header('location: salasanavaihdettu.php?url=' . $_POST[url].'&id='. $_POST[id] );
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
