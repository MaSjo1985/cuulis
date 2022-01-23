<?php

ob_start();

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour

session_start(); // ready to go!
include("yhteys.php");




if (isset($_SESSION["Kayttajatunnus"])) {

    if (isset($_POST["painiket"])) {




        if (!$projekti = $db->query("select * from itseprojektit where id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($projekti->num_rows != 0) {


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

//
//            if (!empty($lista3)) {
//                foreach ($lista3 as $id3 => $value3) {
//
//                    $db->query("update itsetehtavatkp set tehty=0 where itsetehtavat_id = '" . $value3 . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                    $db->query("update itsetehtavatkp set toive=1 where itsetehtavat_id = '" . $value3 . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                    $db->query("update itsetehtavatkp set tallennettu=1 where itsetehtavat_id = '" . $value3 . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//
//                    $minne = $value3;
//                }
//            }
//
//
//            if (!empty($lista)) {
//                foreach ($lista as $id => $value) {
//
//
//                    $db->query("update itsetehtavatkp set tehty=1 where itsetehtavat_id = '" . $value . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                    $db->query("update itsetehtavatkp set osattu=1 where itsetehtavat_id = '" . $value . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                    $db->query("update itsetehtavatkp set tallennettu=1 where itsetehtavat_id = '" . $value . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                    $minne = $value;
//                }
//            }
//
//            if (!empty($lista2)) {
//                foreach ($lista2 as $id2 => $value2) {
//
//
//                    $db->query("update itsetehtavatkp set tehty=1 where itsetehtavat_id = '" . $value2 . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                    $db->query("update itsetehtavatkp set osattu=0 where itsetehtavat_id = '" . $value2 . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                    $db->query("update itsetehtavatkp set tallennettu=1 where itsetehtavat_id = '" . $value2 . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//
//                    $minne = $value2;
//                }
//            }


            $kommentit = $_POST["kommentti"];
            $omatpisteet = $_POST["omatpisteet"];
            $tehtid = $_POST["id"];
            $maara = 0;
            foreach ($tehtid as $tehtid) {
                $maara++;
            }
            $tehtid = $_POST["id"];
            echo'<br>Tehtidkkoko: ' . count($tehtid);
            echo'<br>Kommenttikoko: ' . count($kommentit);

            $stmt = $db->prepare("UPDATE itsetehtavatkp SET kommentti = ? WHERE id = ? AND kayttaja_id = ?");
            $stmt->bind_param("sii", $kommentti2, $id4, $kayttaja);
            for ($i = 0; $i < $maara; $i++) {
                $kayttaja = $_SESSION["Id"];
                $kommentti = $kommentit[$i];
                $kommentti = nl2br($kommentti);

                $kommentti2 = $kommentti;

                if (!$haeoikeakp = $db->query("select distinct itsetehtavatkp.id as oikeaid from itsetehtavat, itsetehtavatkp where itsetehtavatkp.kayttaja_id='" . $kayttaja . "' AND itsetehtavat.id='" . $tehtid[$i] . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowm = $haeoikeakp->fetch_assoc()) {

                    $id4 = $rowm[oikeaid];
                }
                if ($kommentti != '') {
                    echo'<br>Kommentti: ' . $kommentti;
                    echo'<br>Kpid: ' . $id4;
                    echo'<br>Tehtid: ' . $tehtid[$i];
                }


                if ($kommentti2 != '') {
                    $stmt->execute();
                }

//                $db->query("update itsetehtavatkp set opiskelijan_pisteet='" . $omatpisteet[$i] . "' where id = '" . $id4 . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                $db->query("update itsetehtavatkp set tallennettu=1 where id = '" . $id4 . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");
//                $db->query("update itsetehtavatkp set tallennettu=1 where id = '" . $id4 . "' AND kayttaja_id='" . $_SESSION["Id"] . "'");


                if ($kommentti != '') {
                    if (!$haeoikeetehtava = $db->query("select distinct itsetehtavat.id as tehtavaid from itsetehtavat, itsetehtavatkp where itsetehtavatkp.id='" . $id4 . "' AND itsetehtavatkp.kayttaja_id='" . $kayttaja . "' AND itsetehtavat.id = itsetehtavatkp.itsetehtavat_id")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    while ($rowoikee = $haeoikeetehtava->fetch_assoc()) {
                        $minne = $rowoikee[tehtavaid];
                    }

                    if (!$haejarjestys = $db->query("select distinct jarjestys from itsetehtavat where id='" . $minne . "' AND itseprojektit_id='" . $_POST[ipid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    while ($rowj = $haejarjestys->fetch_assoc()) {

                        $jarjestys = $rowj[jarjestys];
                    }
                    if (!$haeseuraava = $db->query("select distinct id as tid from itsetehtavat where jarjestys=('" . $jarjestys . "' - 3) AND itseprojektit_id='" . $_POST[ipid] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    while ($rowm = $haeseuraava->fetch_assoc()) {

                        $minne = $rowm[tid];
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
//
    header('location: itsetyot.php?i=' . $_POST[ipid] . '#mytable2');
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
}
?>
