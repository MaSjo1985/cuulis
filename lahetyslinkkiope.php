<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {



    if ($_POST[kuvaus] != "") {
        $stmt = $db->prepare("INSERT INTO ryhmatope (linkki, omatallennusnimi, projekti_id, tyonimi, ryhma_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isisi", $linkki, $omatallennusnimi, $projekti, $tyonimi, $ryhma);
        // prepare and bind

        $linkki = 1;
        $omatallennusnimi = $_POST[osoite];
        $projekti = $_POST[pid];
        $tyonimi = $_POST[kuvaus];
        $ryhma = $_POST[ryid];


        $stmt->execute();
        $stmt->close();
        // TÄHÄN LISÄYS Palautukset tauluun!
//                   if (!$haeviimeisin = $db->query("select MAX(id) as ryhmat2 from ryhmat2 where ryhma_id='" . $_POST[ryid] . "'")) {
//            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//        }
//
//    
//       while ($rowa = $haeviimeisin->fetch_assoc()) {
//           $ryhmat2id = $rowa[ryhmat2];
//       }
//       
//      $stmt2 = $db->prepare("INSERT INTO opiskelijan_kurssityot (kayttaja_id, ryhmat2_id, projekti_id) VALUES (?, ?, ?)");
//            $stmt2->bind_param("iii", $kayttaja, $ryhmat2, $projektiid);
//            
//            $kayttaja = $_POST[kaid];
//            $ryhmat2 = $ryhmat2id;       
//            $projektiid = $_POST[pid];
//                    
//                  
//
//                    $stmt2->execute();    
//               $stmt2->close();




        header("location: ryhmatyot.php?r=" . $_POST[pid] . "#" . $ryhma);
    }
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}



include("footer.php");
?>

</body>
</html>	

</body>
</html>	
