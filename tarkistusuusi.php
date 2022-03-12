<?php
session_start(); ob_start();
ob_start();
ob_start();
ob_start();
echo'
<!DOCTYPE html>
<html>
<head>

<title> Kirjautuminen</title>';

if (isset($_POST[Sposti]) || isset($_GET[id])) {
 
    include("yhteys.php");

    include("header.php");
    echo'<div class="cm8-container7">';
    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
    echo'<div class="cm8-margin-top"></div>';


    if(isset($_POST[Sposti])){
            $siivottusposti = mysqli_real_escape_string($db, $_POST[Sposti]);
    $siivottusalasana = mysqli_real_escape_string($db, $_POST[Salasana]);
     $siivottusalasana = trim($siivottusalasana);
     $siivottusposti = trim($siivottusposti);
   
    $salt = "8CMr85";
    $krypattu = md5($salt . $siivottusalasana);
     
    //haetaan eka rooli
    
    
    $stmt0 = $db->prepare("SELECT DISTINCT rooli FROM kayttajat WHERE sposti=?");
    
    $stmt0->bind_param("s", $sposti);
    // prepare and bind
    $sposti = $siivottusposti;

    $stmt0->execute();

    $stmt0->store_result();

  $stmt0->bind_result($column1);
  
  while ($stmt0->fetch()) {
            $rooli0 = $column1;
            
        }
        if($rooli0=='opettaja'){
             $stmt = $db->prepare("SELECT DISTINCT rooli, sposti, etunimi, sukunimi, id, paiva, kello, vahvistettu, tarkistettu, yritykset, nollattu, kayttoehdot_hyvaksytty, uusitunnus FROM kayttajat WHERE sposti=? AND BINARY salasana=?");
    
        }
        else{
             $stmt = $db->prepare("SELECT DISTINCT rooli, sposti, etunimi, sukunimi, id, paiva, kello, vahvistettu, tarkistettu, yritykset, nollattu, kayttoehdot_hyvaksytty, uusitunnus FROM kayttajat WHERE BINARY sposti=? AND BINARY salasana=?");
    
        }
   
    $stmt->bind_param("ss", $sposti2, $salasana);
// prepare and bind
    $sposti2 = $siivottusposti;
    $salasana = $krypattu;
    }
    else if(isset($_GET[id])){
   

    $stmt = $db->prepare("SELECT DISTINCT rooli, sposti, etunimi, sukunimi, id, paiva, kello, vahvistettu, tarkistettu, yritykset, nollattu, kayttoehdot_hyvaksytty, uusitunnus FROM kayttajat WHERE BINARY id=?");
    $stmt->bind_param("i", $id);
// prepare and bind
    $id=$_GET[id];
    }



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

       
            // server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

            if ($kayttoehdot == 0) {
                    if (!empty($_POST[url]))
                       header('location: hyvaksykayttoehdot.php?id='.$id.'&url=' . $_POST[url]);
                   else

                   header('location: hyvaksykayttoehdot.php?id='.$id);
             }
             else{
            //onko nollattu?!
            
             if($uusitunnus == 0 && $rooli=='opiskelija'){
                    
                            if (!empty($_POSTI[url]))
                      header('location: vaihdatunnus.php?id='.$id.'&url=' . $_POST[url]);
                      else
                      header('location: vaihdatunnus.php?id='.$id);

                
                
                }
            else{
                
                //onko uusitunnus
               if($nollattu==1 && $vahvistettu==1){
                
                        if (!empty($_POST[url]))
                      header('location: vaihdasalasana.php?id='.$id.'&url=' . $_POST[url]);
                  else
                      header('location: vaihdasalasana.php?id='.$id);
            
                  
                }
                else if($vahvistettu ==0 && $nollattu ==1){
                    
                        if (!empty($_POST[url]))
                      header('location: vahvistus.php?admin=1&rooli='.$rooli.'&id='.$id.'&url=' . $_POST[url]);
                  else
                      header('location: vahvistus.php?admin=1&rooli='.$rooli.'&id='.$id);
            
                }
                else{
           
                    
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
            
            if (!empty($_POST[url]))
                header("location: kirjautuminen2.php?url=" . $_POST[url]);
            else
                header("location: kirjautuminen2.php");
                }
           
            
            }
            
            }

        
      
    }
    else{
 header("location: kirjautuminenuusi.php");
    }

 $stmt0->close();
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
