<?php
session_start(); 



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$pienimi = $_POST[src];
$file = 'images/' . $pienimi;
if (file_exists($file)) {

    unlink($file);
}