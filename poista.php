<?php
session_start(); 



ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {



    
    
    $db->query("update opiskelijankurssit set ryhma_id=0 where opiskelija_id = '" . $_GET["oid"] . "' AND projekti_id='" . $_GET[pid] . "'");
   
      if (!$result2 = $db->query("select * from opiskelijankurssit where ryhma_id='".$_GET[ryid]."'")) {
                                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                                        }
                                        //jos ei muita
                                        if ($result2->num_rows == 0) {
                                          header("location: poistaryhma.php?pid=" . $_GET[pid] . '&id=' . $_GET[ryid]);       
                                        }
    else{
        header("location: ryhmatyot.php?r=" . $_GET[pid] . '#' . $_GET[ryid]); 
    }
    
    
   
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>	

