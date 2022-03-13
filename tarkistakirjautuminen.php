<?php
session_start();

ob_start();

include("yhteys.php");

$tarkistettusposti = htmlspecialchars($_POST['username']);


    $siivottusposti = mysqli_real_escape_string($db, $_POST['username']);
    $siivottusalasana = mysqli_real_escape_string($db, $_POST['password']);
    $salt = "8CMr85";
    $krypattu = md5($salt . $siivottusalasana);
    $stmt = $db->prepare("SELECT DISTINCT vahvistettu, koulu_id, rooli, tarkistuskoodi, tarkistettu FROM kayttajat, kayttajankoulut WHERE kayttajankoulut.kayttaja_id=kayttajat.id AND BINARY kayttajat.sposti=?");
    $stmt->bind_param("s", $sposti);
    // prepare and bind
    $sposti = $siivottusposti;

    $stmt->execute();

    $stmt->store_result();

  $stmt->bind_result($column1, $column2, $column3, $column4, $column5);
  
  while ($stmt->fetch()) {
            $vahvistettu = $column1;
            $koulu = $column2;
            $rooli=$column3;
            $tk = $column4;
            $tarkistettu = $column5;
        }

if ($rooli=='opettaja' AND !filter_var($tarkistettusposti, FILTER_VALIDATE_EMAIL))
    echo json_encode(array('status' => 'error1', 'msg' => 'Antamasi käyttäjätunnus on virheellinen!'));

else {
    //TÄHÄN TUTKITAAN, ONKO YRITYKSIÄ MAKSIMI

    if ($stmt->num_rows == 0) {
        echo json_encode(array('status' => 'error8', 'msg' => 'Antamaasi käyttäjätunnusta ei ole rekisteröity oppimisympäristöön!'));
    } else {
        

        if($tarkistettu==0){
            
            
                     if (!$haesposti =  $db->query("SELECT DISTINCT sposti FROM kayttajat, koulunadminit WHERE koulunadminit.kayttaja_id=kayttajat.id AND koulunadminit.koulu_id='".$koulu."'")){
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

     
        while ($rows = $haesposti->fetch_assoc()) {

            $spostia = $rows[sposti];
        }
            
             echo json_encode(array('status' => 'errort', 'msg' => $spostia));
            
     
           
                 
        }
        else if($vahvistettu==0){
            
          
                 echo json_encode(array('status' => 'errorv', 'msg' => $tk));
            
           
             
             
        }
        else{
               $stmt3 = $db->prepare("SELECT DISTINCT yritykset FROM kayttajat WHERE BINARY sposti=?");
        $stmt3->bind_param("s", $sposti2);
        // prepare and bind
        $sposti2 = $siivottusposti;
        $stmt3->execute();
        $stmt3->store_result();
        $stmt3->bind_result($col1);

        while ($stmt3->fetch()) {
            $yritykset = $col1;
        }


        if ($yritykset > 3) {
            echo json_encode(array('status' => 'error9', 'msg' => 'Liikaa yrityksiä!'));
        } else {

            $stmt2 = $db->prepare("SELECT DISTINCT * FROM kayttajat WHERE BINARY sposti=? AND BINARY salasana=?");
            $stmt2->bind_param("ss", $sposti2, $salasana);
            // prepare and bind
            $sposti2 = $siivottusposti;
            $salasana = $krypattu;
            $stmt2->execute();

            $stmt2->store_result();

            if ($stmt2->num_rows == 1) {




                echo json_encode(array('status' => 'success', 'msg' => 'no error'));
            } else {
                $stmt4 = $db->prepare("UPDATE kayttajat SET yritykset=? WHERE sposti=?");
                $stmt4->bind_param("is", $yritykset2, $sposti8);
                // prepare and bind
                $yritykset2 = $yritykset + 1;
                $sposti8 = $siivottusposti;



                $stmt4->execute();


                $stmt4->close();

                echo json_encode(array('status' => 'error', 'msg' => 'Antamasi salasana on virheellinen!'));
            }
            $stmt2->close();
            $stmt3->close();
        }
        }
     
    }


    $stmt->close();
}
?>
