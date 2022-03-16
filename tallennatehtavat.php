<?php
session_start();

ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

 // ready to go!
include("yhteys.php");




if (isset($_SESSION["Kayttajatunnus"])) {

    if (isset($_POST["painiket"])) {


        if (!$projekti = $db->query("select * from itseprojektit where id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($projekti->num_rows != 0) {


            $lista = $_POST["lista"];
            $lista2 = $_POST["lista2"];
            $lista3 = $_POST["lista3"];
  
            $tehtid = $_POST["id"];
            
            $kommentit = $_POST["kommentti"];
            $omatpisteet = $_POST["omatpisteet"];
            
            $tehtid = $_POST["id"];
            
            $maara = 0;
            foreach ($tehtid as $tehtid) {
                $maara++;
                echo'<br>tehtävä id: '.$tehtid;
                echo'<br>määrä on: '.$määrä;
           
            }
            echo'<br><br>SITTEN KOMMENTIT LÄPI<br>';
            $tehtid = $_POST["id"];
            
            $stmt = $db->prepare("UPDATE itsetehtavatkp SET kommentti = ? WHERE itsetehtavat_id = ? AND kayttaja_id = ?");
            $stmt->bind_param("sii", $kommentti2, $id4, $kayttaja);
            for ($i = 0; $i < $maara; $i++) {
                $kayttaja = $_SESSION["Id"];
                $kommentti = $kommentit[$i];
                $kommentti = nl2br($kommentti);
                $kommentti2 = $kommentti;

                 $id4 = $tehtid[$i];
                 
                           
                if ($kommentti != '') {
                echo'<br>TEhtid: ' . $id4;   
                              echo'<br>Kommentti: ' . $kommentti;
                }


                    $stmt->execute();
                

//                $db->query("update itsetehtavatkp set opiskelijan_pisteet='" . $omatpisteet[$i] . "' where id = '" . $id4 . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                $db->query("update itsetehtavatkp set tallennettu=1 where id = '" . $id4 . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                $db->query("update itsetehtavatkp set tallennettu=1 where id = '" . $id4 . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");


                if ($kommentti != '') {
                 
                          if (!$haeminne = $db->query("select distinct jarjestys from itsetehtavat where id='" . $tehtid[$i] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                      while ($rowminne = $haeminne->fetch_assoc()) {

                        $minne = $rowminne[jarjestys];
                   
                    }
                }
            }
          
            $stmt->close();
        }
    } else if ($_POST["painikek"] == "&#9998") {


        $db->query("update itsetehtavatkp set tehty=0 where itsetehtavat_id = '" . $_POST[teid] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");

        $db->query("update itsetehtavatkp osattu tehty=0 where itsetehtavat_id = '" . $_POST[teid] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
    }
//                 
    header('location: itsetyot.php?i=' . $_POST[ipid] . '#'.$minne);
    
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>
