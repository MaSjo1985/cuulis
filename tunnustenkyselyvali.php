<?php
session_start();

ob_start();

include("yhteys.php");


if($_POST[rooli]=='opiskelija'){
    header("location: tunnustenkyselyuusi.php?akt=".$_POST[akt]);
}
else{
     header("location: tunnustenkyselyope.php?akt=".$_POST[akt]);
}

?>
