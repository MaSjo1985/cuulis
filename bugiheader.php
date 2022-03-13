 
<?php
session_start(); 



ob_start();



if (isset($_SESSION["Kayttajatunnus"])) {

    echo'<div class="cm8-container4" margin-top: 0px; margin-bottom: 0px">';
} else {
    echo'<div class="cm8-container" style="padding-top: 1px; padding-bottom: 0px">';
}

//echo'<p>Tämä on oppimisympäristön beta-versio, eli se on vielä kehitysvaiheessa.  Voit ilmoittaa esiintyneistä virheistä/ongelmista ja antaa kehitysideoita <a href="yhteydenotto.php"><b> tästä. </b></a></p></div>';
?>	