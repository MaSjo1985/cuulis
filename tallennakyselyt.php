<?php
session_start();

ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

 // ready to go!

include("yhteys.php");




if (isset($_SESSION["Kayttajatunnus"])) {

    if (isset($_POST["painiket"])) {

 

            $kommentit = $_POST["kommentti"];
            $idt = $_POST["id"];
            $maara = 0;
            foreach ($idt as $kpid) {
                $maara++;
            }
            $idt = $_POST["id"];
            $stmt = $db->prepare("UPDATE kyselytkp SET teksti = ? WHERE id = ? AND kayttaja_id = ?");
            $stmt->bind_param("sii", $kommentti2, $id4, $kayttaja);
            for ($i = 0; $i < $maara; $i++) {

                $kommentti = $kommentit[$i];
                $kommentti = nl2br($kommentti);

                $kommentti2 = $kommentti;
                $id4 = $idt[$i];
                $kayttaja = $_SESSION["Id"];
                if ($kommentti2 == '') {
                    $kommentti2 = '-';
                }

                $stmt->execute();


                if ($kommentti2 != '') {
                    $db->query("update kyselytkp set tallennettu=1 where id = '" . $idt[$i] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
                }
                $db->query("update kyselytkp set muokattu='" . date("j.n.Y H:i") . "' where id = '" . $idt[$i] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
            }
            $stmt->close();
//            $lista = $_POST["lista"];
//            $lista2 = $_POST["lista2"];
//            $lista3 = $_POST["lista3"];
//            $idt = $_POST["id"];
//        for ($i = 0; $i < $maara; $i++) {
//        
//                if(empty($lista[$i]) && empty($lista2[$i])){
//                    
//                         $db->query("update itsetehtavatkp set tehty=0 where id = '" . $idt[$i] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                }
//                if(empty($lista3[$i])){
//                   
//                                 $db->query("update itsetehtavatkp set toive=0 where id = '" . $idt[$i] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'"); 
//                    
//                    
//                }
//
//        }
        
//    } else if ($_POST["painikek"] == "&#9998") {
//
//
//        $db->query("update itsetehtavatkp set tehty=0 where itsetehtavat_id = '" . $_POST[teid] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//
//        $db->query("update itsetehtavatkp osattu tehty=0 where itsetehtavat_id = '" . $_POST[teid] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//    }
    }
    if (isset($_POST["poista"])) {

        if (!$projekti = $db->query("select distinct id from kyselyt  where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowp = $projekti->fetch_assoc()) {

            $kysid = $rowp[id];

            $db->query("update kyselytkp set tallennettu=0 where kyselyt_id='" . $kysid . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
            $db->query("update kyselytkp set teksti='' where kyselyt_id='" . $kysid . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
            $db->query("update kyselytkp set muokattu='' where kyselyt_id='" . $kysid . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
        }
    }
    header("location: kysely.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>


