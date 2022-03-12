<?php
session_start(); 



ob_start();





include("yhteys.php");
$db->query("INSERT INTO koulusafkaklikkaukset (id) VALUES (NULL)");

