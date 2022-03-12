<?php
session_start();

ob_start();

include("yhteys.php");


if(isset($_POST[admin])){
    if($_POST[rooli]=='opiskelija'){
    header("location: lisaakayttajaopiskelija.php");
}
else{
     header("location: lisaakayttajaopettaja.php");
}
}
else{
   if($_POST[rooli]=='opiskelija'){
    header("location: rekisteroityminenopiskelija.php");
}
else{
     header("location: rekisteroityminenopettaja.php");
} 
}


?>
