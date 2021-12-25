<?php

ob_start();

include("yhteys.php");


if($_POST[rooli]=='opiskelija'){
    header("location: rekisteroityminenopiskelija.php");
}
else{
     header("location: rekisteroityminenopettaja.php");
}

?>
