<?php
session_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_destroy();
header("location: kirjautuminenuusi.php");
?>