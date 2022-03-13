<?php
session_start();

ob_start();

include("yhteys.php");

$tarkistettusposti = htmlspecialchars($_POST['username']);
$siivottusposti = mysqli_real_escape_string($db, $_POST['username']);
$siivottusposti = trim($siivottusposti);
    $stmt = $db->prepare("SELECT DISTINCT rooli, tarkistettu, koulu_id FROM kayttajat, kayttajankoulut WHERE kayttajat.id=kayttajankoulut.kayttaja_id AND sposti=?");
    $stmt->bind_param("s", $sposti);
    // prepare and bind
    $sposti = $siivottusposti;

    $stmt->execute();
   

$stmt->store_result();

  $stmt->bind_result($column1, $column2, $column3);
  
  while ($stmt->fetch()) {
         
            $rooli=$column1;
            $tarkistettu=$column2;
            $koulu = $column3;
       
        }
        
        if($rooli=='opiskelija'){
            echo json_encode(array('status' => 'erroropiskelija', 'msg' => 'opiskelija'));
        }
        else{
            if (!filter_var($tarkistettusposti, FILTER_VALIDATE_EMAIL))
    echo json_encode(array('status' => 'errors', 'msg' => 'Antamasi käyttäjätunnus on virheellinen!'));

else {
    


    if ($stmt->num_rows == 0) {
        echo json_encode(array('status' => 'error0', 'msg' => 'error'));
    } else if ($tarkistettu == 0) {
                    
                if (!$haesposti =  $db->query("SELECT DISTINCT sposti FROM kayttajat, koulunadminit WHERE koulunadminit.kayttaja_id=kayttajat.id AND koulunadminit.koulu_id='".$koulu."'")){
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

     
        if($haesposti->num_rows!=0){
              while ($rows = $haesposti->fetch_assoc()) {

            $spostia = $rows[sposti];
        }
        }
        else{
            $spostia = 'marianne.sjoberg@cm8solutions.fi';
        }
      
            
             echo json_encode(array('status' => 'errort', 'msg' => $spostia));
            
        
    }else {

        echo json_encode(array('status' => 'success', 'msg' => 'no error'));
    }
   
}
        }

 $stmt->close();
?>
