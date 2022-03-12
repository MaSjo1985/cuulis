<?php
session_start();

ob_start();

include("yhteys.php");

   $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

    $otsikko = "Rekisteröityminen Cuulis-oppimisympäristöön";
    $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

$siivottusposti = "sjoberg.marianne@gmail.com";
    $viesti = 'Olet rekisteröitynyt Cuulis-oppimisympäristöön seuraavilla tiedoilla:';

$viesti = str_replace("\n.", "\n..", $viesti);

    $body = '<html><body>';


    $body .= '<p>' . $viesti . '</p>';
    $body .= "</body></html>";


    $varmistus = mail($siivottusposti, $otsikko, $body, $headers);
    
    if($varmistus){
        echo'meni';
    }else{
        echo'ei menny';
    }
