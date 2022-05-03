<?php
session_start(); 



ob_start();


// Start counting
// Your code





include("yhteys.php");

$kurssi = $_SESSION["KurssiId"];
$rooli = $_SESSION["Rooli"];

$id = $_SESSION["Id"];
include("diagrammit.php");
include("pie.php");

include "libchart/libchart/classes/libchart.php";


if ($rooli == "opettaja" || $rooli == "admin" || $rooli == "admink" || $rooli == "opeadmin") {


    if (!$onkoprojekti = $db->query("select distinct id, kuvaus from itseprojektit where kurssi_id='" . $kurssi . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowP = $onkoprojekti->fetch_assoc()) {

        $ipid = $rowP[id];
        $kuvaus = $rowP[kuvaus];



        if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$haetehtavat2 = $db->query("select distinct id from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipid . "' AND painotus = 1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($onkopisteet->num_rows != 0) {
            $pisteet = true;
        }


        $yht = $haetehtavat2->num_rows;


        if ($pisteet) {
            if (!$haepisteet = $db->query("select paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $pisteetyht = 0;
            while ($rowpis = $haepisteet->fetch_assoc()) {
                $pisteetyht = $pisteetyht + $rowpis[paino];
            }


            echo'<br><b  style="color: #e608b8">Huom! Vain osattujen tehtävien pisteet vaikuttavat edistymispylvääseen.</b><br><br>';
            echo'<div class="cm8-responsive">';
            echo'<table  style="border: 1px solid #2b6777; display: inline-block; margin-bottom: 40px; margin-right: 60px; padding: 0px 10px 0px 10px">';
            echo'<th style="font-size: 0.7em; text-align: center; padding-bottom: 10px" colspan="2"><b>Edistymispylvään tavoitetasojen muodostuminen: </b></th>';
            if (!$onkorivi2 = $db->query("select distinct * from itseprojektit_tasot where itseprojekti_id='" . $ipid . "' ORDER BY osuus DESC")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row = $onkorivi2->fetch_assoc()) {
                $row[selite] = str_replace('<br />', "", $row[selite]);
                echo'<tr style="font-size: 0.7em; "><td style="padding-right: 20px"><b>Taso: </b>' . $row[selite] . '</td>';
                echo'<td><b>Osuus maksimipisteistä: </b>' . $row[osuus] . ' %</td></tr>';
            }
            echo'<tr><td style="padding-top: 10px" colspan="2"><form action="muokkaatasoja.php" method="get" style="display: inline-block"><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" title="Muokkaa tavoitetasoja" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.7em"></form></td></tr>';

            echo'</table>';
//            tuoDiagrammi2(0, $ipid);
            echo'</div>';
        } else {
            echo'<em style="font-weight: bold">Tehtävien pisteytys ei ole käytössä.</em>';
            echo'<form action="aktivoipisteytys.php" method="post" style="display: inline-block; margin-left: 10px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painikea"  value="+ Käytä pisteytystä" title="Käytä pisteytystä" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
            echo'<br>';
        }
        echo'<br><br><b>Tehtäviä on yhteensä ' . $yht . ' kappaletta.</b><br>';
        if ($pisteet) {
            if (!$haepisteet = $db->query("select paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            $pisteetyht = 0;
            while ($rowpis = $haepisteet->fetch_assoc()) {
                $pisteetyht = $pisteetyht + $rowpis[paino];
            }

            echo'<p style="display: inline-block"><b>Tehtävien yhteispistemäärä on ' . $pisteetyht . ' pistettä.</b></p>';

            echo'<form action="aktivoipisteytys.php" method="post"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painikep"  value="Poista pisteytys käytöstä" title="Poista pisteytys käytöstä" class="myButton8"  role="button"  style="padding:2px 4px; font-size: 0.7em"></form>';
        }
        echo'<br><form action="tarkastele.php" method="get" style="display: inline-block"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" style="font-size: 1em" value="&#9763 Tarkastele opiskelijakohtaisia tilastoja" class="myButton8"  role="button"  style="padding:2px 4px"></form>';

        echo'<br><br>';

        $nyt = date("Y-m-d H:i");

        $takaraja = $sulkeutuu;

        if ($suljettu == 0 && $nyt <= $takaraja) {
            echo'<p style="display: inline-block; margin-right: 20px">Opiskelijat voivat muokata taulukkoa.</p>';
            echo'<form action="suljeluettelo.php" method="post" style="display: inline-block; margin-right: 30px"><input type="hidden" name="pid" value=' . $ipid . '><input type="submit" name="painike" value="- Sulje" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
        } else if ($suljettu == 1 && $nyt <= $takaraja) {
            echo'<p style="display: inline-block; margin-right: 20px">Opiskelijoiden mahdollisuus muokata taulukkoa on suljettu.</p>';
            echo'<form action="avaaluettelo.php" method="post" style="display: inline-block"><input type="hidden" name="pid" value=' . $ipid . '><input type="submit" name="painike" value="+ Avaa" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
        }
        $nyt = date("Y-m-d H:i");
        if ($suljettu == 0) {
            if (!empty($sulkeutuu) && $sulkeutuu != ' ') {
                $nyt = date("Y-m-d H:i");
                $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
                $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
                $sulkeutumiskello = substr($sulkeutuu, 11, 5);

                $takaraja = $sulkeutuu;


                if ($suljettu == 0 && $nyt <= $takaraja) {
                    echo'<br>Opiskelijoiden mahdollisuus muokata taulukkoa sulkeutuu <b>' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
                } else {
                    echo'<br><b style="color: #e608b8"> Opiskelijoiden mahdollisuus muokata taulukkoa on sulkeutunut ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
                }
            } else {
                echo'<br>Opiskelijoille ei ole asetettu takarajaa taulukon muokkaukseen.';
            }


            echo'<form action="asetatakarajaluettelo.php" method="get" style="display: inline-block; margin-left: 20px"><input type="hidden" name="i" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
        }




        echo'<br><p id="ohje" style="font-size: 0.8em">Klikkaamalla otsikkoa pääset tarkastelemaan sen alla olevien tehtävien tietoja.<br>';
        echo'Klikkaamalla tehtävää pääset tarkastelemaan siihen liittyviä tietoja.</p>';
        echo'<div class="cm8-margin-top"></div>';
        echo'<form action="testaamuokkaus.php" method="get"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
        echo'<div id="scrollbar"><div id="spacer"></div></div>';
        echo'<div class="cm8-responsive" id="container2" >';
        echo '<table id="mytable" class="cm8-uusitable2ope" style="table-layout:fixed; max-width: 100%">   <thead>';
        if ($pisteet) {
            echo '<tr style="border: 2px solid #2b6777; background-color: #48E5DA;  font-size: 1em" id="palaa"><th>Tehtävä</th><th>Tehtävän<br>pistemäärä</th><th>Tehdyt yht.</th><th>Tehty<br>ja osattu</th><th style="text-align: center; border: 1px solid #2b6777">Tehty,<br>mutta ei osattu<br>ilman apua</th><th>Toivottu yhdessä<br>läpikäytäväksi</th><th>Kommentoitu'
            . '</th></tr>  </thead><tbody>';
        } else {
            echo '<tr style="border: 2px solid #2b6777; background-color: #48E5DA;  font-size: 1em; " id="palaa"><th>Tehtävä</th><th>Tehdyt yht.</th><th>Tehty<br>ja osattu</th><th>Tehty,<br>mutta ei osattu<br>ilman apua</th><th>Toivottu yhdessä<br>läpikäytäväksi</th><th>Kommentoitu'
            . '</th></tr>  </thead><tbody>';
        }
        $opewhile = microtime(true);
        $maara = 0;
        $maaratehtavat = 0;
        while ($rowt = $haetehtavat->fetch_assoc()) {
            $maara++;
            if ($rowt[aihe] != 1) {
                $maaratehtavat++;
            }

            if ($maara == 1) {
                $opewhilesis01 = microtime(true);
            } else if ($maara == 2) {
                $opewhilesis02 = microtime(true);
            } else if ($maara == 3) {
                $opewhilesis03 = microtime(true);
            }

            if ($rowt[aihe] == 1) {

                $sulkeutumispaiva2 = '';
                $automaattinen = 0;
                $sulkeutumiskello2 = '';

                $sulkeutuu2 = $rowt[sulkeutuu];
                $takaraja2 = '';
                if (!empty($sulkeutuu2) && $sulkeutuu2 != ' ') {
                    $sulkeutumispaiva2 = substr($sulkeutuu2, 0, 10);
                    $sulkeutumispaiva2 = date("d.m.Y", strtotime($sulkeutumispaiva2));
                    $automaattinen = 1;
                    $sulkeutumiskello2 = substr($sulkeutuu2, 11, 5);
                    $takaraja2 = $sulkeutuu2;
                }
            } else {
                if ($maaratehtavat == 1) {
                    $tehtavanmaarat = microtime(true);
                    $toiveetmaarat = microtime(true);
                }
                if (!$haetoiveet = $db->query("select distinct id from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND toive=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($maaratehtavat == 1) {

                    $toiveetmaarat = microtime(true) - $toiveetmaarat;
                }
                if ($maaratehtavat == 1) {

                    $eiosatutmaarat = microtime(true);
                }
                if (!$haeeiosatut = $db->query("select distinct id from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND osattu=0 AND tehty=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($maaratehtavat == 1) {

                    $eiosatutmaarat = microtime(true) - $eiosatutmaarat;
                }
                if ($maaratehtavat == 1) {

                    $osatutmaarat = microtime(true);
                }
                if (!$haeosatut = $db->query("select distinct id from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND osattu=1")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($maaratehtavat == 1) {

                    $osatutmaarat = microtime(true) - $osatutmaarat;
                }
                if ($maaratehtavat == 1) {

                    $kommentitmaarat = microtime(true);
                }
                if (!$haekommentit = $db->query("select distinct id from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND kommentti<>''")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                if ($maaratehtavat == 1) {

                    $kommentitmaarat = microtime(true) - $kommentitmaarat;
                }
                $tehdyt = ($haeeiosatut->num_rows) + ($haeosatut->num_rows);
                if ($maaratehtavat == 1) {
                    $tehtavanmaarat = microtime(true) - $tehtavanmaarat;
                }
            }

            if ($maaratehtavat == 1) {
                $loppuosa_tehtavat = microtime(true);
            }

            $estaosio = ($takaraja2 != '' && $nyt > $takaraja2);
            $osiovapaa = ($takaraja2 != '' && $nyt <= $takaraja2);


            if ($pisteet) {
                $opewhilesis = microtime(true);
                if ($rowt[aihe] == 1) {
                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:#d0d0d0;"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="6" style="border-top: 2px solid #2b6777;border-right: 2px solid #2b6777; border-bottom: 2px solid #2b6777; border-left: none"><a  href="ykskohdat2.php?id=' . $ipid . '&tid=' . $rowt[id] . '"><b>' . $rowt[otsikko] . '</b></a>';

                    $seuraava = $rowt[jarjestys] + 1;
                    if (!$haeseuraava = $db->query("select distinct aihe from itsetehtavat where itseprojektit_id='" . $ipid . "' AND jarjestys='" . $seuraava . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    while ($rows = $haeseuraava->fetch_assoc()) {
                        $onkoaihe = $rows[aihe];
                    }
                    if ($onkoaihe != 1 && ($nyt <= $takaraja || $takaraja == '')) {
                        //jos auki
                        if ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == ''))
                            echo'<form action="suljeaihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="- Sulje" title="Sulje osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                        else if ($rowt[aihekiinni] == 1)
                        //jos kiinni
                            echo '<br><em style="font-size: 0.8em; color: #e608b8">Tämä osio on suljettu.</em><form action="avaa_aihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="+ Avaa" title="Avaa osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';


                        if ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == '')) {
                            echo '<form action="asetaosiokiinni.php" style="display: inline-block; margin-left: 20px; font-size: 0.8em" method="post" autocomplete="off">';

                            if ($automaattinen == 1) {
                                if ($nyt <= $takaraja2) {
                                    echo'<b style="font-size:0.8em; margin-left: 20px; margin-right: 20px; color: #e608b8">Osio sulkeutuu: </b>';
                                } else {
                                    echo'<b style="font-size:0.8em; margin-left: 20px; margin-right: 20px; color: #e608b8">Osio on sulkeutunut: </b>';
                                }

                                echo'<b style="font-size: 0.8em">Pvm:</b> 
    
            <input type="text" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva" style="margin-right: 20px; width: 60px; font-size: 0.8em" value=' . $sulkeutumispaiva2 . '>';
                            } else {
                                echo'<em style="font-size:0.8em; margin-left: 20px; margin-right: 20px"> tai aseta aika: </em>';
                                echo'<b style="font-size: 0.8em">Pvm:</b>
     
            <input type="text" style="margin-right: 20px; width: 60px; font-size: 0.8em" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva">';
                            }

                            echo'<b style="font-size: 0.8em">Klo:</b>
           <input type="hidden" name="id" id="id8" value=' . $rowt[id] . '>	
               <input type="text" class="kello" id="kello' . $rowt[id] . '"  name="kello" style="width: 60px; font-size: 0.8em" class="time" value="' . $sulkeutumiskello2 . '">';
                            echo'<input type="hidden" name="ipid" value=' . $ipid . '>	
           
	<input type="submit" style="margin-left: 20px" value="Tallenna" class="myButton8">
	</form>';
                        } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                            echo'<b style="font-size:0.8em; margin-left: 20px; color: #e608b8">Osio on sulkeutunut: ';
                            echo $sulkeutumispaiva2 . ', klo: ' . $sulkeutumiskello2 . '.</b>';
                            echo '<form action="avaa_aihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="+ Avaa" title="Avaa osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                        }
                    }

                    echo'</td></tr>';
                } else {
                    if ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio) || ($nyt > $takaraja && $takaraja != '')) {
                        echo ' <tr style=" font-size: 1em" class="stripe-2"><td style="text-align: left; border: 1px solid grey; padding-left: 10px;"><a  href="ykskohdat.php?id=' . $ipid . '&tid=' . $rowt[id] . '" style="width:100%; display:block">' . $rowt[sisalto] . '</a></td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey">' . $tehdyt . '</td><td style="text-align: center; border: 1px solid grey">' . $haeosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haeeiosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haetoiveet->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haekommentit->num_rows;
                    } else {
                        echo ' <tr style=" font-size: 1em;"><td style="text-align: left; border: 1px solid grey; padding-left: 10px;"><a  href="ykskohdat.php?id=' . $ipid . '&tid=' . $rowt[id] . '" style="width:100%; display:block">' . $rowt[sisalto] . '</a></td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey">' . $tehdyt . '</td><td style="text-align: center; border: 1px solid grey">' . $haeosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haeeiosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haetoiveet->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haekommentit->num_rows;
                    }

                    echo'</td></tr>';
                }
            } else {
                if ($rowt[aihe] == 1) {
                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:#d0d0d0;" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="5" style="border-top: 2px solid #2b6777;border-right: 2px solid #2b6777; border-bottom: 2px solid #2b6777; border-left: none"><a  href="ykskohdat2.php?id=' . $ipid . '&tid=' . $rowt[id] . '"><b>' . $rowt[otsikko] . '</b></a>';
                    $seuraava = $rowt[jarjestys] + 1;
                    if (!$haeseuraava = $db->query("select distinct aihe from itsetehtavat where itseprojektit_id='" . $ipid . "' AND jarjestys='" . $seuraava . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }
                    while ($rows = $haeseuraava->fetch_assoc()) {
                        $onkoaihe = $rows[aihe];
                    }
                    if ($onkoaihe != 1 && ($nyt <= $takaraja || $takaraja == '')) {
                        //jos auki
                        if ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == ''))
                            echo'<form action="suljeaihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="- Sulje" title="Sulje osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                        else if ($rowt[aihekiinni] == 1)
                        //jos kiinni
                            echo '<br><em style="font-size: 0.8em; color: #e608b8">Tämä osio on suljettu.</em><form action="avaa_aihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="+ Avaa" title="Avaa osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';


                        if ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == '')) {
                            echo '<form action="asetaosiokiinni.php" style="display: inline-block; margin-left: 20px; font-size: 0.8em" method="post" autocomplete="off">';

                            if ($automaattinen == 1) {
                                if ($nyt <= $takaraja2) {
                                    echo'<b style="font-size:0.8em; margin-left: 20px; margin-right: 20px; color: #e608b8">Osio sulkeutuu: </b>';
                                } else {
                                    echo'<b style="font-size:0.8em; margin-left: 20px; margin-right: 20px; color: #e608b8">Osio on sulkeutunut: </b>';
                                }

                                echo'<b style="font-size: 0.8em">Pvm:</b> 
    
            <input type="text" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva" style="margin-right: 20px; width: 60px; font-size: 0.8em" value=' . $sulkeutumispaiva2 . '>';
                            } else {
                                echo'<em style="font-size:0.8em; margin-left: 20px; margin-right: 20px"> tai aseta aika: </em>';
                                echo'<b style="font-size: 0.8em">Pvm:</b>
     
            <input type="text" style="margin-right: 20px; width: 60px; font-size: 0.8em" class="kdate" id="kdate' . $rowt[id] . '"  name="paiva">';
                            }

                            echo'<b style="font-size: 0.8em">Klo:</b>
           <input type="hidden" name="id" id="id8" value=' . $rowt[id] . '>	
               <input type="text" class="kello" id="kello' . $rowt[id] . '"  name="kello" style="width: 60px; font-size: 0.8em" class="time" value="' . $sulkeutumiskello2 . '">';
                            echo'<input type="hidden" name="ipid" value=' . $ipid . '>	
           
	<input type="submit" style="margin-left: 20px" value="Tallenna" class="myButton8">
	</form>';
                        } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                            echo'<b style="font-size:0.8em; margin-left: 20px; color: #e608b8">Osio on sulkeutunut: ';
                            echo $sulkeutumispaiva2 . ', klo: ' . $sulkeutumiskello2 . '.</b>';
                            echo '<form action="avaa_aihe.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="hidden" name="tid" value=' . $rowt[id] . '><input type="submit" name="painikep"  value="+ Avaa" title="Avaa osio" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
                        }
                    }

                    echo'</td></tr>';
                } else {

                    if ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio) || ($nyt > $takaraja && $takaraja != '')) {
                        echo ' <tr style=" font-size: 1em" class="stripe-2"><td style="text-align: left; border: 1px solid grey; padding-left: 10px; "><a  href="ykskohdat.php?id=' . $ipid . '&tid=' . $rowt[id] . '" style="width:100%; display:block">' . $rowt[sisalto] . '</a></td><td style="text-align: center; border: 1px solid grey">' . $tehdyt . '</td><td style="text-align: center; border: 1px solid grey">' . $haeosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haeeiosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haetoiveet->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haekommentit->num_rows;
                    } else {
                        echo ' <tr style=" font-size: 1em"><td style="text-align: left; border: 1px solid grey; padding-left: 10px; "><a  href="ykskohdat.php?id=' . $ipid . '&tid=' . $rowt[id] . '" style="width:100%; display:block">' . $rowt[sisalto] . '</a></td><td style="text-align: center; border: 1px solid grey">' . $tehdyt . '</td><td style="text-align: center; border: 1px solid grey">' . $haeosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haeeiosatut->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haetoiveet->num_rows . '</td><td style="text-align: center; border: 1px solid grey">' . $haekommentit->num_rows;
                    }

                    echo'</td></tr>';
                }
            }
            if ($maara == 1) {
                $opewhilesis01 = microtime(true) - $opewhilesis01;
            } else if ($maara == 2) {
                $opewhilesis02 = microtime(true) - $opewhilesis02;
            } else if ($maara == 3) {
                $opewhilesis03 = microtime(true) - $opewhilesis03;
            }

            if ($maaratehtavat == 1) {
                $loppuosa_tehtavat = microtime(true) - $loppuosa_tehtavat;
            }
        }

        echo "</tbody></table>";

        echo"</div>";

        echo'<br><br><form action="testaamuokkaus.php" method="get"><input type="hidden" name="monesko" value=' . $monesko . '><input type="hidden" name="id" value=' . $ipid . '><input type="submit" name="painike" value="&#9998 Muokkaa" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
    }

    echo'</div>';
}

//opiskelija
else {


    if (!$onkoprojekti = $db->query("select * from itseprojektit where kurssi_id='" . $kurssi . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($rowP = $onkoprojekti->fetch_assoc()) {


        $ipid = $rowP[id];
        $kuvaus = $rowP[kuvaus];


        echo'<br><h6 style="padding-bottom: 10px; font-size: 1.2em; color: #2b6777; display: inline-block" id="peite3">' . $kuvaus . '</h6><br><br>';
        if (!$haeinfo = $db->query("select * from itseprojektit where id='" . $ipid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowv = $haeinfo->fetch_assoc()) {
            $viesti = $rowv[info];
        }

        if ($viesti <> "") {

            echo'<div class="cm8-responsive" id="info">';

            echo htmlspecialchars_decode($viesti);


            echo'</div>';
        }



        echo'<div class="cm8-margin-top"></div>';


        if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$haetehtavat2 = $db->query("select distinct id from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $yht = $haetehtavat2->num_rows;

        if ($rowt[aihe] != 1) {
            
        }
        if (!$haetehdyt = $db->query("select distinct itsetehtavat.id from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $id . "' AND itsetehtavatkp.tehty=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!$haeosatut = $db->query("select distinct itsetehtavat.id  from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $id . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$haeeiosatut = $db->query("select distinct itsetehtavat.id  from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $id . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipid . "' AND painotus = 1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($onkopisteet->num_rows != 0) {
            $pisteet = true;
        }

        tuoDiagrammi($id, $ipid);



//                echo'<p id="ohje" style="color: #e608b8; font-weight: bold; font-size: 1.1em">Huom! Tehtäväluettelo tallentuu automaattisesti, kun klikkaat joko "Osasin" tai "Tein, mutta en osannut ilman apua"- ruutuja.<br><br>Muut merkinnät on tallennettava painamalla "Tallenna"-nappia.</p>';
//       
        $esta = false;
        if (!$RTsuljettu = $db->query("select distinct palautus_suljettu, palautus_sulkeutuu from itseprojektit where id='" . $ipid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($RTs = $RTsuljettu->fetch_assoc()) {
            $suljettu = $RTs[palautus_suljettu];
            $sulkeutuu = $RTs[palautus_sulkeutuu];
        }

        $nyt = date("Y-m-d H:i");
        if (!empty($sulkeutuu) && $sulkeutuu != ' ') {


            $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
            $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
            $sulkeutumiskello = substr($sulkeutuu, 11, 5);

            $takaraja = $sulkeutuu;


            $takarajaon = 1;
        }

        if (($suljettu == 0 && $takarajaon == 0) || ($takarajaon == 1 && $nyt < $takaraja && $suljettu == 0)) {



            if ($takarajaon == 1) {
                echo'<p style="font-size: 1.1em">Taulukon muokkausmahdollisuus sulkeutuu <b>' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b></p>';
            }
        } else if ($suljettu == 1 || ($takarajaon == 1 && ($nyt >= $takaraja))) {
            if ($suljettu == 1) {
                echo'<p style="color: #e608b8; font-size: 1.1em"><b>Taulukon muokkausmahdollisuus on suljettu.</b></p>';
                $esta = true;
            } else if (($takarajaon == 1 && ($nyt >= $takaraja))) {

                echo'<p style="color: #e608b8; font-size: 1.1em"><b>Taulukon muokkausmahdollisuus on sulkeutunut <b>' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b></b></p>';
                $esta = true;
            }
        }




        if (!$esta) {
            echo'<p id="ohje" style="color: #e608b8; font-weight: bold; font-size: 1.1em">Huom! Muista painaa Tallenna-nappia, kun teet muutoksia <u>kommenttikenttään!</u></p>';


            echo'<br><form action="tallennatehtavat.php" id="formi" method="post">';
            echo'<div id="scrollbar"><div id="spacer"></div></div>';
            echo'<div class="cm8-responsive" id="container2">';
            echo '<table id="mytable2" class="cm8-uusitable2" style="table-layout:fixed;  max-width: 100%">  ';
            echo'<thead>';
            echo '<tr style="border: 2px solid #2b6777; background-color: #48E5DA;  font-size: 1em">';

            if ($pisteet) {
                echo'<th>Tehtävä</th><th>Tehtävän<br>pistemäärä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti &nbsp&nbsp&nbsp<input type="submit" name="painiket" value="&#10003 Tallenna kommentit" class="myButton11"  role="button"  style="padding:4px 6px; background-color: white"></th><th style="border: none"></th></tr></thead><tbody>';
            } else {
                echo'<th>Tehtävä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti&nbsp&nbsp&nbsp <input type="submit" name="painiket" value="&#10003 Tallenna kommentit" class="myButton11"  role="button"  style="padding:4px 6px; background-color: white"></th><th style="border: none"></th></tr></thead><tbody>';
            }

            while ($rowt = $haetehtavat->fetch_assoc()) {
                if ($rowt[aihe] == 1) {

                    $sulkeutumispaiva2 = '';
                    $automaattinen = 0;
                    $sulkeutumiskello2 = '';

                    $sulkeutuu2 = $rowt[sulkeutuu];
                    $takaraja2 = '';
                    if (!empty($sulkeutuu2) && $sulkeutuu2 != ' ') {
                        $sulkeutumispaiva2 = substr($sulkeutuu2, 0, 10);
                        $sulkeutumispaiva2 = date("d.m.Y", strtotime($sulkeutumispaiva2));
                        $automaattinen = 1;
                        $sulkeutumiskello2 = substr($sulkeutuu2, 11, 5);
                        $takaraja2 = $sulkeutuu2;
                    }
                }


                if (!$haekp = $db->query("select distinct * from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND id IN (
   SELECT MIN(id) FROM itsetehtavatkp
   WHERE itsetehtavat_id='" . $rowt[id] . "' AND kayttaja_id='" . $id . "'
) AND kayttaja_id='" . $id . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                $estaosio = ($takaraja2 != '' && $nyt > $takaraja2);
                $osiovapaa = ($takaraja2 != '' && $nyt <= $takaraja2);

                if ($rowt[aihe] == 1 && $pisteet == 1) {
                    if ($rowt[aihekiinni] == 1) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on suljettu!</em></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                    } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on sulkeutunut: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                    } else if (($rowt[aihekiinni] == 0 && $osiovapaa)) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio sulkeutuu: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                    } else {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                    }
                } else if ($rowt[aihe] == 1 && $pisteet == 0) {
                    if ($rowt[aihekiinni] == 1) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on suljettu!</em></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                    } else if (($rowt[aihekiinni] == 0 && $estaosio)) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio on sulkeutunut: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                    } else if (($rowt[aihekiinni] == 0 && $osiovapaa)) {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b><br><em style="color: #e608b8; font-weight: bold">Tämä osio sulkeutuu: ' . $sulkeutumispaiva2 . ', klo ' . $sulkeutumiskello2 . '</em></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                    } else {
                        echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                    }
                } else {

                    while ($rowkp = $haekp->fetch_assoc()) {

//                                    if (!$onkotallennettu = $db->query("select distinct * from itsetehtavatkp where id='" . $rowkp[id] . "' AND kayttaja_id='" . $id . "'")) {
//                                       die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//                                   }
//                            
//                                    while ($rowtal = $onkotallennettu->fetch_assoc()) {
//                                        if ($rowtal[tehty] == 0 || $rowtal[toive] == 0 || $rowtal[kommentti] == '') {
//                                           $db->query("update itsetehtavatkp set tallennettu=0 where id='" . $rowkp[id] . "' AND kayttaja_id='" . $id . "'");
//                                        }                                     
//                                     }
//                                   


                        if ($pisteet) {

                            if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == ''))) {

                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                }
                            } else if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio))) {

                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                }
                            } else if ($rowkp[tallennettu] == 0 && $rowt[aihekiinni] == 0) {

                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                }
                            } else if ($rowkp[tallennettu] == 0 && ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio))) {



                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                }
                            }

                            //TÄÄÄ PITÄÄ TARKISTAA!!
                            if ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio)) {
                                if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                }
                            } else {
                                if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                }
                            }
                        } else {

                            //EI ESTETTY KOKONAAN, EI PISTEITÄ
                            if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 0 && ($osiovapaa || $takaraja2 == ''))) {
                                //TÄSTÄ ETEENPÄIN ->

                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td><td><a  onclick="korjaa(this, ' . $rowt[id] . ')" title="Korjaa"   role="button"   style="padding:2px 4px; margin: 0px;">Korjaa</a></td></tr>';
                                }
                            } else if ($rowkp[tallennettu] == 1 && ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio))) {
                                //ESTO

                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                }
                            } else if ($rowkp[tallennettu] == 0 && $rowt[aihekiinni] == 0) {

                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                }
                            } else if ($rowkp[tallennettu] == 0 && $rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio)) {

                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey">>' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] != '') {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                }
                            }

                            if ($rowt[aihekiinni] == 1 || ($rowt[aihekiinni] == 0 && $estaosio)) {

                                if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em;" class="stripe-2"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                    echo'<input type="hidden" id="' . $rowkp[id] . '" name="kommentti[]" id="kommentti" value=' . $rowkp[kommentti] . '>';
                                }
                            } else {
                                if ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] == '') {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check(this, ' . $rowt[id] . ')" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check2(this, ' . $rowt[id] . ')" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="check3(this, ' . $rowt[id] . ')" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey"><textarea name="kommentti[]" class="kommentti" rows="1" style=" font-size: 1em">' . $rowkp[kommentti] . '</textarea></td><td style="border: 1px solid transparent"><input type="hidden" name="oikee[]" value="' . $rowt[id] . '"></td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                }
                            }
                        }





                        //tä
                    }
                }
            }
            if ($pisteet) {
                echo'<tr><td style="border-left: 2px solid #f7f9f7"></td><td></td><td></td><td></td><td></td><td><input type="submit" name="painiket" value="&#10003 Tallenna kommentit" class="myButton8"  role="button"  style="padding:4px 6px"></td></tr>';
            } else {
                echo'<tr><td style="border-left: 2px solid #f7f9f7"></td><td></td><td></td><td></td><td><input type="submit" name="painiket" value="&#10003 Tallenna kommentit" class="myButton8"  role="button"  style="padding:4px 6px"></td></tr>';
            }

            echo "</tbody></table>";

            echo'<input type="hidden" name="ipid" id="ipid" value=' . $ipid . '></div>';

            echo'</form>';
        } else {
            echo'<div id="scrollbar"><div id="spacer"></div></div>';
            echo'<div class="cm8-responsive" id="container2">';
            echo '<table id="mytable2" class="cm8-uusitable2" style="table-layout:fixed;  max-width: 100%">  ';
            echo'<thead>';
            echo '<tr style="border: 2px solid #2b6777; background-color: #48E5DA;  font-size: 1em">';
            if ($pisteet) {
                echo'<th>Tehtävä</th><th>Tehtävän<br>pistemäärä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti</th><th style="border: none"></th></tr></thead><tbody>';
            } else {
                echo'<th>Tehtävä</th><th>Osasin</th><th>Tein,<br>mutta en osannut<br>ilman apua</th><th>Haluan käydä<br>tunnilla läpi</th><th style="padding-top: 10px">Kommentti</th><th style="border: none"></th></tr></thead><tbody>';
            }

            while ($rowt = $haetehtavat->fetch_assoc()) {

                if (!$haekp = $db->query("select distinct * from itsetehtavatkp where itsetehtavat_id='" . $rowt[id] . "' AND id IN (
   SELECT MIN(id) FROM itsetehtavatkp
   WHERE itsetehtavat_id='" . $rowt[id] . "' AND kayttaja_id='" . $id . "'
) AND kayttaja_id='" . $id . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                if ($rowt[aihe] == 1 && $pisteet == 1) {
                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0"><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="4" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b></td><td style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777"></td></tr>';
                } else if ($rowt[aihe] == 1 && $pisteet == 0) {
                    echo '<tr style=" font-size: 1em; background-color:#d0d0d0" ><td style="border: 2px solid #2b6777; border-right: none"></td><td colspan="3" style="background-color:#d0d0d0; border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-left: none"><b>' . $rowt[otsikko] . '</b></td><td style="background-color:#d0d0d0;  border-bottom: 2px solid #2b6777; border-top: 2px solid #2b6777; border-right: 2px solid #2b6777 "></td></tr>';
                } else {

                    while ($rowkp = $haekp->fetch_assoc()) {

                        if ($pisteet) {
                            if ($rowkp[tallennettu] == 1) {


                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] <> '') {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                }
                            } else {

                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti]) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                }
                            }



                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0) {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">' . $rowt[paino] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                            }
                        } else {
                            if ($rowkp[tallennettu] == 1) {


                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color: #7FD858"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey">&#10004</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em; background-color:  #00bfff"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"></td><td style="text-align: center; border: 1px solid grey">&#10006</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0 && $rowkp[kommentti] <> '') {

                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey"></td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {

                                    echo '<tr id="' . $rowt[id] . '" "><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; background-color: 	#f7f9f7f4d">!</td><td style="text-align: center; border: 1px solid grey; font-size: 1.5em">&#9757</td><td style="border: 1px solid grey; background-color: white">' . $rowkp[kommentti] . '</td></tr>';
                                }
                            } else {

                                if ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '"><td style=" font-size: 1em; text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 0) {

                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' ></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 1 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey">>' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 1 && $rowkp[osattu] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . ' checked></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 1) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . ' checked></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                } elseif ($rowkp[tehty] == 0 && $rowkp[toive] == 0) {
                                    $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                    echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em"><td style="text-align: left; padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                    echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                                }
                            }



                            if ($rowkp[tehty] == 0 && $rowkp[toive] == 0) {
                                $rowkp[kommentti] = str_replace('<br />', "", $rowkp[kommentti]);
                                echo '<tr id="' . $rowt[id] . '" style=" font-size: 1em" class="stripe-2"><td style="text-align: left;  padding-left: 10px; border: 1px solid grey">' . $rowt[sisalto] . '</td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista[]" id="lista1" class="lista1" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista2[]" id="lista2" class="lista2" value=' . $rowt[id] . '></td><td style="text-align: center; border: 1px solid grey"><input type="checkbox" onclick="return false;" name="lista3[]" class="lista3" value=' . $rowt[id] . '></td><td style="border: 1px solid grey" name="kommentti[]">' . $rowkp[kommentti] . '</td></tr>';
                                echo'<input type="hidden" id="' . $rowt[id] . '" name="id[]" id="id" value=' . $rowt[id] . '>';
                            }
                        }
                    }
                }
            }

            echo "</tbody></table>";

            echo'<input type="hidden" name="ipid" id="ipid" value=' . $ipid . '></div>';

            echo'</form>';
        }
    }

    echo'</div>';

    echo'</div>';
}




echo"</div>";
?>

