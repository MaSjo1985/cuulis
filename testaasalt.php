<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

  $salt2 = "CR74eve";
    $paivays = "" . date("h:i:s") . "";
    $krypattu2 = md5($salt2 . $paivays);

    $maara=5;
    
    while($maara>0){
          $salt2 = "CR74eve";
  $uniqid = uniqid('', true);
    $krypattu2 = md5($uniqid);
     $uniqid2 = uniqid('pöö', true);
    $krypattu3 = md5($uniqid2);
  $uniqid3 = uniqid(true);
    echo'<br>Uniqid1 on: '.$uniqid;
    echo'<br>Uniqid2 on: '.$uniqid2;
    echo'<br>Uniqid3 on: '.$uniqid3; 
        $maara--;
        
    }

