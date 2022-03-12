<?php
session_start(); 



ob_start();



// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!



echo json_encode(array("location" => "kurssi.php?suloik=0&id=$_SESSION[KurssiId]#paluu"));
?>

