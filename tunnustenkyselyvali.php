<?php

ob_start();

include("yhteys.php");


if($_POST[rooli]=='opiskelija'){
    header("location: tunnustenkyselyuusi.php");
}
else{
     header("location: tunnustenkysely.php");
}

?>
