
<?php
session_start(); 



ob_start();

function tuoDiagrammi2($kayttaja_id, $ipid) {
    include("yhteys.php");
    if (!$haepisteet = $db->query("select paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    $pisteetyht = 0;
    while ($rowpis = $haepisteet->fetch_assoc()) {
        $pisteetyht = $pisteetyht + $rowpis[paino];
    }




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


    if ($pisteet) {
        if (!$haepisteet = $db->query("select  paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $pisteetyht = 0;
        while ($rowpis = $haepisteet->fetch_assoc()) {
            $pisteetyht = $pisteetyht + $rowpis[paino];
        }
        if ($kayttaja_id != 0) {
            if (!$haeomatpisteet = $db->query("select distinct itsetehtavat.id, itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $omatpisteetyht = 0;

            while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
                $omatpisteetyht = $omatpisteetyht + $rowpis2[paino];
            }

            if (!$haeomatpisteet2 = $db->query("select distinct itsetehtavatkp.opiskelijan_pisteet as omat from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $itseannetutyht = 0;
            while ($rowpis22 = $haeomatpisteet2->fetch_assoc()) {

                $itseannetutyht = $itseannetutyht + $rowpis22[omat];
            }
        }
    }

    if ($_SESSION[Rooli] == 'opiskelija') {
        echo'<div class="cm8-responsive" style="width: 75%; margin-bottom: 0px" >';
        echo'<div class="cm8-tavoitedivi" style="margin-top: 10px; font-size: 0.7em; padding: 5px 2px 0px 5px;" >';
    } else {
        echo'<div class="cm8-responsive" style="width: 100%;" >';
        echo'<div class="cm8-tavoitediviope"  style="margin-top: 10px; font-size: 0.7em; padding: 5px 2px 0px 5px; display: inline-block">';
    }


    $opkorkeus = $omatpisteetyht / $pisteetyht * 100;

    echo'<p style="padding-bottom: 0px; font-weight: bold; margin-bottom:0px;">Oman osaamistason arvio, kun tehtävien pistemäärät huomioidaan:</p>';
    echo'<div style="max-width: 50%; height: 100px; text-align:center; margin-left: 10px;  padding-top: 0px; margin-top: 10px;  padding-bottom: 20px; margin-bottom: 0px; ">';


    echo'<b style="font-weight: bold; font-size: 0.7em; padding: 0px 30px">Maksimi: ' . $pisteetyht . ' p</b>';

    echo'<ul class="barGraph" >';
    if (!$onkorivi2 = $db->query("select distinct * from itseprojektit_tasot where itseprojekti_id='" . $ipid . "' ORDER BY osuus DESC")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    echo'<li class="set3" style="height: 100%; left: 0px; border: none"></li>';
    $maara = 0;
    while ($row = $onkorivi2->fetch_assoc()) {
        $maara++;
        $selite = str_replace('<br />', "", $row[selite]);
        $osuus = $row[osuus];

        $korkeus = $pisteetyht * ($osuus / 100);
        $korkeus = round($korkeus, 0);
        echo'<li class="set1" style="height: ' . $osuus . '%; left: 0px; "><em style="font-weight: normal">(' . $selite . ': ' . $korkeus . ' p)</em></li>';
    }
    $maara++;
    if ($kayttaja_id != 0)
        echo'<li class="set2"  style="height: ' . $opkorkeus . '%; left: 0px; "> </li>';
    else {
        echo'<li style="left: 0px;  "> </li>';
    }

    echo'</ul> ';

    echo'</div>';
    echo'<div style="width: 50%; text-align:center">';

    if ($kayttaja_id != 0) {
        if ($itsepisteytys) {
            echo'<p style="color: #2b6777; font-weight: bold; font-size: 0.8em">' . $itseannetutyht . 'p / ' . $pisteetyht . 'p</p>';

            echo'<p style="color: #e608b8; font-weight: bold; font-size: 0.8em">(Oma pisteytys tehtävistä vaikuttaa pylvääseen.)</p>';
        } else {
            echo'<p style="color: #2b6777; font-weight: bold; font-size: 0.8em">' . $omatpisteetyht . 'p / ' . $pisteetyht . 'p</p>';

            echo'<p style="color: #e608b8; font-weight: bold; font-size: 0.8em">(Vain osatut tehtävät vaikuttavat pylvääseen.)</p>';
        }
    } else {
        if ($itsepisteytys) {
            echo'<p style="color: #2b6777; font-weight: bold; font-size: 0.8em">' . $itseannetutyht . 'p / ' . $pisteetyht . 'p</p>';

            echo'<p style="color: #e608b8; font-weight: bold; font-size: 0.8em">Opiskelijoiden itselleen antamat pisteet vaikuttavat edistymispylvääseen</p>';
        } else {
            echo'<p style="color: #2b6777; font-weight: bold; font-size: 0.8em">' . $omatpisteetyht . 'p / ' . $pisteetyht . 'p</p>';

            echo'<p style="color: #e608b8; font-weight: bold; font-size: 0.8em">Vain osattujen tehtävien pisteet vaikuttavat edistymispylvääseen</p>';
        }
    }

    echo'</div>';
    echo'</div>';

    echo'<table  class="tehtavataulu" style="display: inline-block; max-width: 40%; font-size: 0.7em">';
    echo'<tr><th colspan="2"><b>Edistymispylvään tavoitetasojen muodostuminen: </b>';

    if ($_SESSION[Rooli] == 'opettaja' || $_SESSION[Rooli] == 'admink' || $_SESSION[Rooli] == 'admin' || $_SESSION[Rooli] == 'opeadmin') {
        echo' <form action="muokkaatasoja.php" method="get" style="display: inline-block; margin-left: 10px"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa tavoitetasoja" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.7em"></form></th><th></th></tr>';
    }

    if (!$onkorivi2 = $db->query("select distinct * from itseprojektit_tasot where itseprojekti_id='" . $ipid . "' ORDER BY osuus DESC")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($row = $onkorivi2->fetch_assoc()) {
        $row[selite] = str_replace('<br />', "", $row[selite]);
        echo'<tr><td><b>Taso: </b>' . $row[selite] . '</td>';
        echo'<td><b>Osuus maksimipisteistä: </b>' . $row[osuus] . ' %</td></tr>';
    }

    echo'</table>';
    echo'</div>';

    if ($kayttaja_id != 0) {
//        echo'<table  style="border: 1px solid #2b6777; display: inline-block; margin-top: 20px; margin-bottom: 40px; margin-right: 40px; padding: 0px 10px 10px 10px">';
//        echo'<th style="text-align: center; padding-bottom: 10px; font-size: 0.7em" colspan="2"><b>Tavoitetasot: </b></th>';
//        if (!$onkorivi2 = $db->query("select distinct * from itseprojektit_tasot where itseprojekti_id='" . $ipid . "' ORDER BY osuus DESC")) {
//            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//        }
//
//        while ($row = $onkorivi2->fetch_assoc()) {
//            $row[selite] = str_replace('<br />', "", $row[selite]);
//            echo'<tr style="font-size: 0.7em; "><td style="padding-right: 20px"><b>Taso: </b>' . $row[selite] . '</td>';
//            echo'<td><b>Osuus maksimipisteistä: </b>' . $row[osuus] . ' %</td></tr>';
//        }
//
//        echo'</table>';
    }
}
