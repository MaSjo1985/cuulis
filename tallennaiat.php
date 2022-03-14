<?php
session_start();

ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

 // ready to go!
include("yhteys.php");




if (isset($_SESSION["Kayttajatunnus"])) {

    if (isset($_POST["painiket"])) {


        $sid = $_POST["painiket"];
        $sid = substr($sid, 13);
        $sid = str_replace('(', '', $sid);
        $sid = str_replace(')', '', $sid);


        if (!$haeiat = $db->query("select distinct id from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $sid . "' AND onvastaus=1 AND onteksti=1 ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        $tekstit = $_POST["teksti"];
        $idt = $_POST["idt"];
        $valinnat = $_POST["valinta"];
        $valinnat2 = $_POST["valinta2"];



        $yhteensa = count($idt);

        $maara = 0;
        for ($i = 0; $i < $yhteensa; $i++) {

            if (!$haetid = $db->query("select distinct * from ia where id = '" . $idt[$i] . "' AND ia_sarakkeet_jarjestys='" . $sid . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if ($haetid->num_rows != 0) {

                $stmt = $db->prepare("UPDATE iakp SET teksti = ? WHERE ia_id = ? AND kayttaja_id = ?");
                $stmt->bind_param("sii", $teksti2, $id4, $kayttaja);
                $teksti = $tekstit[$i];
                $teksti = nl2br($teksti);

                $teksti2 = $teksti;
                $id4 = $idt[$i];
                $kayttaja = $_SESSION["Id"];


                $stmt->execute();

                $valinta = $_POST[valinta . $id4];

                $db->query("update iakp set iavaihtoehdot_id='" . $valinta . "' where ia_id = '" . $idt[$i] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");


                if (isset($_POST[valinta2 . $id4])) {
                    $valintalista = $_POST[valinta2 . $id4];

                    foreach ($valintalista as $valinta2) {


                        if (!$haekp = $db->query("select distinct * from iakp_moni where iavaihtoehdot_id='" . $valinta2 . "' AND ia_id = '" . $idt[$i] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        if ($haekp->num_rows == 0) {


                            $on = $db->query("insert into iakp_moni (iavaihtoehdot_id, ia_id, kayttaja_id) values('" . $valinta2 . "', '" . $idt[$i] . "', '" . $_SESSION[Id] . "')");

                            if (!$on) {
                                $db->error;
                            } else {
                                echo'<br> LISÄTTY SEURAAVAT';
                                echo'<br>valinta: ' . $valinta2;
                                echo'<br>ia_id: ' . $idt[$i];
                            }
                        } else {
                            echo'<br>POISTETTU SEURAAVAT: ';
                            echo'<br>valinta: ' . $valinta2;
                            echo'<br>ia_id: ' . $idt[$i];
                            //poista
                            $db->query("delete from iakp_moni  where ia_id = '" . $idt[$i] . "' AND iavaihtoehdot_id<>'" . $valinta2 . "' AND kayttaja_id='" . $_SESSION[Id] . "'");
                        }
                    }
                }
                $db->query("update iakp set tallennettu=1 where ia_id = '" . $idt[$i] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");

                $db->query("update iakp set muokattu='" . date("j.n.Y H:i") . "' where ia_id = '" . $idt[$i] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
            }
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
    if (isset($_POST["muokkaa"])) {

        $sid = $_POST["muokkaa"];
        $sid = substr($sid, 11);
        $sid = str_replace('(', '', $sid);
        $sid = str_replace(')', '', $sid);


        if (!$haearvioinnit2 = $db->query("select distinct * from ia where kurssi_id='" . $_SESSION["KurssiId"] . "' AND ia_sarakkeet_jarjestys='" . $sid . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowt2 = $haearvioinnit2->fetch_assoc()) {


            $db->query("update iakp set tallennettu=0 where ia_id = '" . $rowt2[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
            $db->query("update iakp set muokattu=NULL where ia_id = '" . $rowt2[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");

//            if ($rowt2[onradio] == 1) {
//                $db->query("update iakp set iavaihtoehdot_id=0 where ia_id = '" . $rowt2[id] . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//            }
//            if ($rowt2[oncheckbox] == 1) {
//                $db->query("delete from iakp_moni where ia_id = '" . $rowt2[id] . "' AND kayttaja_id='" . $_SESSION[Id] . "'");
//            }
        }
    }
    header("location: ia.php#palaa");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>


