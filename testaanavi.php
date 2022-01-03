<?php
ob_start();
$siivottusalasana='cuulis';
    
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