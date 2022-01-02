<?php ob_start();
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
    $salt = "8CMr85";
    $krypattu = md5($salt . $siivottusalasana);

    $stmt = $db->prepare("SELECT DISTINCT rooli, sposti, etunimi, sukunimi, id, paiva, kello, vahvistettu, tarkistettu, yritykset, nollattu, kayttoehdot_hyvaksytty, uusitunnus FROM kayttajat WHERE BINARY sposti=? AND BINARY salasana=?");
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

        if ($vahvistettu == 1 && $tarkistettu == 1) {
            // server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

            if ($kayttoehdot == 0) {
                    if (!empty($_POST[url]))
                       header("location: hyvaksykayttoehdot.php?id='.$id.'&url=" . $_POST[url]);
                   else

                   header("location: hyvaksykayttoehdot.php?id=".$id);
             }
             else{
            //onko nollattu?!
            
            if($nollattu==1){
                
                        if (!empty($_POST[url]))
                      header("location: vaihdasalasana.php?id='.$id.'&url=" . $_POST[url]);
                  else
                      header("location: vaihdasalasana.php?id=".$id);
            
                  
            }
            else{
                
                //onko uusitunnus
                if($uusitunnus == 0 && $rooli=='opiskelija'){
                    
                            if (!empty($_POSTI[url]))
                      header("location: vaihdatunnus.php?id='.$id.'&url=" . $_POST[url]);
                      else
                      header("location: vaihdatunnus.php?id=".$id);

                
                
                }
                else{
           
                    
            session_start(); // ready to go!
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
                header("location: kirjautuminenvali.php?url=" . $_POST[url]);
            else
                header("location: kirjautuminenvali.php");
                }
           
            
            }
            
            }

        
        } else if ($vahvistettu == 0) {
            echo"<br><b>Et ole vahvistanut käyttäjätunnustasi! Vahvistuslinkki on lähetetty rekisteröinnin yhteydessä antamaasi sähköpostiosoitteeseen!</b>";
            echo'<br><br><a href="palaute.php">Voit ottaa yhteyttä Cuulis-oppimisympäristön ylläpitäjään tästä <p style="font-size: 1.5em; display: inline-block; padding:0; margin: 0">&#8631</p></a>';
        } else if ($tarkistettu == 0) {
            echo"<br><b>Cuulis-oppimisympäristön ylläpitäjä ei ole vielä hyväksynyt rekisteröitymistäsi!</b><br><br>Kun hyväksyntä on suoritettu, saat erillisen vahvistuslinkin rekisteröinnin yhteydessä antamaasi sähköpostiosoitteeseen.";
            echo'<br><br><a href="palaute.php">Voit ottaa yhteyttä Cuulis-oppimisympäristön ylläpitäjään tästä <p style="font-size: 1.5em; display: inline-block; padding:0; margin: 0">&#8631</p></a>';
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
