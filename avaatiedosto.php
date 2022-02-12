<?php
ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("kurssisivustonheader.php");


    echo'<div class="cm8-half" style="text-align: center; padding-top: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: 60px">';

    if (!$projekti = $db->query("select * from projektit where id='" . $_GET[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    while ($rowP = $projekti->fetch_assoc()) {
        $kuvaus = $rowP[kuvaus];
        $pid = $rowP[id];
    }


    if (!$result = $db->query("select distinct * from ryhmat2 where id = '" . $_GET[id] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row = $result->fetch_assoc()) {
        $nimi = $row[tallennettunimi];
        $vanhanimi = $row[omatallennusnimi];
        $ryhmaid=$row[ryhma_id];
        $ryhma2id = $row[id];
    }
    if($ryhmaid!=0){
          if (!$onkooikeus = $db->query("select distinct * from opiskelijankurssit where opiskelija_id = '" . $_SESSION[Id] . "' AND ryhma_id='".$ryhmaid."'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    }
    else{
             if (!$onkooikeus = $db->query("select distinct * from opiskelijan_kurssityot where kayttaja_id = '" . $_SESSION[Id] . "' AND ryhmat2_id='".$ryhmaid."'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    } 
    }


if($onkooikeus -> num_rows ==0 && $_SESSION[Rooli] =='opiskelija'){
         echo'<br><br><b style="font-size: 1em; color: #FF0000">Sinulla ei ole oikeutta tähän resurssiin!</b><br><br></div></div>';
    
}
else{
  
      if (file_exists($nimi)) {

        header('location: /' . $nimi);
    } else
        echo'<br><br><b style="font-size: 1em; color: #FF0000">Tiedostoa ei löytynyt!<br><br>Voit ottaa yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div>';
    
}


//     $vanhanimi="tiedostot/".$vanhanimi;
//    
//    if (file_exists($nimi)) {
//            
//        rename($nimi, $vanhanimi);
//    } 




    
    } else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
}

echo "</div>";
echo "</div>";
?>

</body>
</html>