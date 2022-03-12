<?php
session_start();
ob_start();
$siivottusalasana='ma';
    
    $maara=100;
    
    while($maara>0){
       $salt = "8CMr85";
    $krypattu = md5($salt . $siivottusalasana);
        
         echo'<br>KryPTATTU: ',$krypattu;
         $maara--;
    }
   
?>
</body>
</html>	