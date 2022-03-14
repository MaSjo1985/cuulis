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

            $opid = $_POST[opid];
            echo'ipid:' . $_POST[ipid];
            echo'opid:' . $_POST[opid];
            $lista = $_POST["lista"];
            $lista2 = $_POST["lista2"];
            $lista3 = $_POST["lista3"];
            if (empty($lista)) {
                echo'lista1 tyhjä';
            }
            if (empty($lista2)) {
                echo'lista2 tyhjä';
            }
            if (empty($lista3)) {
                echo'lista3 tyhjä';
            }


            if (!empty($lista3)) {
                foreach ($lista3 as $id3 => $value3) {

//            $db->query("update itsetehtavatkp set tehty=1 where itsetehtavat_id = '" . $id3 . "' AND kayttaja_id='" . $opid . "'");
//            $db->query("update itsetehtavatkp set osattu=0 where itsetehtavat_id = '" . $id3 . "' AND kayttaja_id='" . $opid . "'");
                    $db->query("update itsetehtavatkp set tehty=0 where itsetehtavat_id = '" . $value3 . "' AND kayttaja_id='" . $opid . "'");
                    $db->query("update itsetehtavatkp set toive=1 where itsetehtavat_id = '" . $value3 . "' AND kayttaja_id='" . $opid . "'");
                    $db->query("update itsetehtavatkp set tallennettu=1 where itsetehtavat_id = '" . $value3 . "' AND kayttaja_id='" . $opid . "'");

                    $minne = $value3;
                }
            }


            if (!empty($lista)) {
                foreach ($lista as $id => $value) {


                    $db->query("update itsetehtavatkp set tehty=1 where itsetehtavat_id = '" . $value . "' AND kayttaja_id='" . $opid . "'");
                    $db->query("update itsetehtavatkp set osattu=1 where itsetehtavat_id = '" . $value . "' AND kayttaja_id='" . $opid . "'");
                    $db->query("update itsetehtavatkp set tallennettu=1 where itsetehtavat_id = '" . $value . "' AND kayttaja_id='" . $opid . "'");
                    $minne = $value;
                }
            }

            if (!empty($lista2)) {
                foreach ($lista2 as $id2 => $value2) {


                    $db->query("update itsetehtavatkp set tehty=1 where itsetehtavat_id = '" . $value2 . "' AND kayttaja_id='" . $opid . "'");
                    $db->query("update itsetehtavatkp set osattu=0 where itsetehtavat_id = '" . $value2 . "' AND kayttaja_id='" . $opid . "'");
                    $db->query("update itsetehtavatkp set tallennettu=1 where itsetehtavat_id = '" . $value2 . "' AND kayttaja_id='" . $opid . "'");

                    $minne = $value2;
                }
            }

            $omatpisteet = $_POST["omatpisteet"];
            $kommentit = $_POST["kommentti"];
            $idt = $_POST["id"];
            $maara = 0;
            foreach ($idt as $kpid) {
                $maara++;
            }
            $idt = $_POST["id"];
            if (empty($idt)) {
                echo'idt tyhjä';
            } else {
                echo'id:n koko' . count($idt);
            }
            if (empty($kommentit)) {
                echo'kommnentit tyhjä';
            } else {
                echo'kommentin koko' . count($kommentit);
            }
            $stmt = $db->prepare("UPDATE itsetehtavatkp SET kommentti = ? WHERE id = ? AND kayttaja_id = ?");
            $stmt->bind_param("sii", $kommentti2, $id4, $kayttaja);
            for ($i = 0; $i < $maara; $i++) {

                $kommentti = $kommentit[$i];
                $kommentti = nl2br($kommentti);



                // prepare and bind
                $kommentti2 = $kommentti;
                $id4 = $idt[$i];

                $kayttaja = $opid;


                $stmt->execute();

                $db->query("update itsetehtavatkp set opiskelijan_pisteet='" . $omatpisteet[$i] . "' where id = '" . $idt[$i] . "' AND kayttaja_id='" . $opid . "'");
                $db->query("update itsetehtavatkp set tallennettu=1 where id = '" . $idt[$i] . "' AND kayttaja_id='" . $opid . "'");
            }
            $stmt->close();
            $lista = $_POST["lista"];
            $lista2 = $_POST["lista2"];
            $lista3 = $_POST["lista3"];
            $idt = $_POST["id"];

//        for ($i = 0; $i < $maara; $i++) {
//        
//                if(empty($lista[$i]) && empty($lista2[$i])){
//                    
//                         $db->query("update itsetehtavatkp set tehty=0 where id = '" . $idt[$i] . "' AND kayttaja_id='" . $opid . "'");
//                }
//                if(empty($lista3[$i])){
//                   
//                                 $db->query("update itsetehtavatkp set toive=0 where id = '" . $idt[$i] . "' AND kayttaja_id='" . $opid . "'"); 
//                    
//                    
//                }
//
//        }
            //  header('location: tarkasteleopiskelija.php?id=' . $_POST[ipid] . '&kaid=' . $_POST[opid]);
        }
    } else if ($_POST["painikek"] == "&#9998") {


        $db->query("update itsetehtavatkp set tehty=0 where itsetehtavat_id = '" . $_POST[teid] . "' AND kayttaja_id='" . $opid . "'");

        $db->query("update itsetehtavatkp osattu tehty=0 where itsetehtavat_id = '" . $_POST[teid] . "' AND kayttaja_id='" . $opid . "'");
    }

    if (!$haejarjestys = $db->query("select distinct jarjestys from itsetehtavat where id='" . $minne . "' AND itseprojektit_id='" . $_POST[ipid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowj = $haejarjestys->fetch_assoc()) {

        $jarjestys = $rowj[jarjestys];
    }
    if (!$haeseuraava = $db->query("select distinct id as tid from itsetehtavat where jarjestys=('" . $jarjestys . "' - 3) AND itseprojektit_id='" . $_POST[ipid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowm = $haeseuraava->fetch_assoc()) {

        $minne2 = $rowm[tid];
    }

    header('location: tarkasteleopiskelija.php?id=' . $_POST[ipid] . '&kaid=' . $_POST[opid] . '#palaatanne');
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>


