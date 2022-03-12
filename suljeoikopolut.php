<?php
session_start();




echo json_encode(array("location" => "kurssi.php?suloik=1&id=$_SESSION[KurssiId]#paluu"));
?>
