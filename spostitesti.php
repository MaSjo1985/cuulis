<?php

ob_start();

include("yhteys.php");

$sposti= 'ä ö';

$onkovalilyonti = strrpos($sposti," ");



// prepare and bind


echo'<br>välilyönti: '.$onkovalilyonti;

if($onkovalilyonti){
     echo '<br>VÄLILYÖNTI';
}
else{
    echo'<br>Ei välilyöntiä';
}


