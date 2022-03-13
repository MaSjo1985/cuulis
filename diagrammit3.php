
<?php
session_start(); 



ob_start();

function tuoDiagrammi3($kayttaja_id, $ipid) {
    include("yhteys.php");


    if (!$onkoprojekti = $db->query("select distinct * from itseprojektit where id='" . $ipid . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowP = $onkoprojekti->fetch_assoc()) {

        $ipid = $rowP[id];
        $kuvaus = $rowP[kuvaus];
    }
    //haetaan opiskelijan pisteet
    if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipid . "' AND painotus = 1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($onkopisteet->num_rows != 0) {
        $pisteet = true;
    }

    if (!$onkopisteytys = $db->query("select distinct itsepisteytys from itseprojektit where id = '" . $ipid . "' AND itsepisteytys =1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($onkopisteytys->num_rows != 0) {
        $itsepisteytys = true;
    }



    if ($pisteet && $kayttaja_id != 0) {
        echo'<div class="cm8-responsive" style="width: 75%; font-size: 0.8em; padding:0px;" >';

        echo'<div class="cm8-tavoitedivi2" style="width: 100%; padding: 0px 0px 10px 0px">';

        $painot = array();
        if (!$haepainot = $db->query("select distinct paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0 ORDER BY paino")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowpaino = $haepainot->fetch_assoc()) {

            array_push($painot, $rowpaino[paino]);
        }

        if (!$haekaikki = $db->query("select distinct id from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $tehtavia = $haekaikki->num_rows;
        $painoja = count($painot);
        $leveys = 100 / $painoja;
        if (!empty($painot)) {

            foreach ($painot as $painot2) {


                // kunkin paino-tehtävän määrä
                if (!$haetehdyt = $db->query("select distinct itsetehtavat_id as tid FROM itsetehtavatkp, itsetehtavat WHERE itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavat.aihe=0 AND itsetehtavat.paino='" . $painot2 . "' AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                $tehdyt = $haetehdyt->num_rows;
                if (!$haeosatut = $db->query("select distinct itsetehtavat_id as tid FROM itsetehtavatkp, itsetehtavat WHERE itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavat.aihe=0 AND itsetehtavat.paino='" . $painot2 . "' AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                if (!$haeosatutei = $db->query("select distinct itsetehtavat_id as tid FROM itsetehtavatkp, itsetehtavat WHERE itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavat.aihe=0 AND itsetehtavat.paino='" . $painot2 . "' AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=0")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                $omatpisteetyht = 0;
                $omatpisteetyht2 = 0;
                while ($rowpis2 = $haeosatut->fetch_assoc()) {
                    $omatpisteetyht = $omatpisteetyht + 1;
                }
                while ($rowpis3 = $haeosatutei->fetch_assoc()) {
                    $omatpisteetyht2 = $omatpisteetyht2 + 1;
                }

                if (!$haetehtavat = $db->query("select distinct paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0 AND paino='" . $painot2 . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if (!$haetehtavatkaikki = $db->query("select id from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0 AND paino='" . $painot2 . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowpis = $haetehtavat->fetch_assoc()) {
                    $paino = $rowpis[paino];
                }


                // 

                $opkorkeus = $omatpisteetyht;
                $opkorkeus2 = $omatpisteetyht2;
                $kaikki = $haetehtavatkaikki->num_rows;
                $opkorkeuspylväs = $opkorkeus / $kaikki * 100;
                $opkorkeuspylväs2 = $opkorkeus2 / $kaikki * 100;
                $opkorkeuspylväsoikea = $tehdyt / $kaikki * 100;

                $kokopylvas = $kaikki / $tehtavia * 100 * 2;


                echo'<div class="tasot" style="margin-left: 0px; margin-right: 0px; width: ' . $leveys . '%; height: 100px;padding: 10px; margin-bottom: 30px">';

                echo'<p style="padding-bottom: 5px; font-weight: bold; ">Tehtyjä ' . $paino . ' pisteen tehtäviä:<br>(' . $tehdyt . ' kpl / ' . $kaikki . ' kpl)</p>';

                echo'<ul class="barGraph"  style="height: ' . $kokopylvas . '%;" >';

                echo'<li class="set3"  style="height: 100%;  left: 0px; "></li>';

                if ($tehdyt != 0) {
                    echo'<li class="set5"  style="height: ' . $opkorkeuspylväsoikea . '%; left: 0px;" > </li>';
                }


                echo'</ul> ';
                echo'<p style="color: #7FD858; font-weight: bold; font-size: 0.9em; padding-bottom: 0px; margin-bottom: 0px">Osattuja ' . $opkorkeus . ' kpl</p>';
                echo'<p style="color: #0066ff; font-weight: bold; font-size: 0.9em">Tehtyjä, mutta ei osattu ilman apua ' . $opkorkeus2 . ' kpl </p>';
                echo'</div>';
            }
        }
        echo'</div>';
        echo'</div>';
    }
}
