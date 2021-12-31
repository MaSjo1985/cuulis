<?php

ob_start();

include("yhteys.php");


if($_POST[rooli]=='opiskelija'){
    header("location: tunnustenkyselyuusi.php?akt=".$_POST[akt]);
}
else{
     header("location: tunnustenkysely.php?akt=".$_POST[akt]);
}

?>
