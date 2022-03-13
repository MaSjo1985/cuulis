<?php
session_start(); 



ob_start();

function tuoMalli($ipid) {

    include "libchart/libchart/classes/libchart.php";
    include("yhteys.php");

    if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipid . "' AND painotus = 1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    if ($onkopisteet->num_rows != 0) {
        $pisteet = true;
    }

    //haedmax

    if (!$onkorivi9 = $db->query("select distinct dmax from itseprojektit where id='" . $ipid . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowdmax = $onkorivi9->fetch_assoc()) {
        $dmax = $rowdmax[dmax];
    }

    $dmaxmaara = $dmax / 100;

    if (!$onkopistevaikutus = $db->query("select distinct pisteetvaikuttaa from itseprojektit where id = '" . $ipid . "' AND pisteetvaikuttaa = 1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($onkopistevaikutus->num_rows != 0) {
        $pisteetvaikuttaa = true;
    }

    //PISTEET EI VAIKUTA

    if (!$pisteetvaikuttaa) {



        if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' ORDER BY jarjestys")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$haetehtavat2 = $db->query("select distinct id from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        $yht = $haetehtavat2->num_rows;
//        $yht = $dmaxmaara * $yht;
//    


        if (!$haetehdyt = $db->query("select distinct itsetehtavat.id from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if (!$haeosatut = $db->query("select distinct itsetehtavat.id  from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if (!$haeeiosatut = $db->query("select distinct itsetehtavat.id  from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }



        $tehdyt = $haetehdyt->num_rows;
        $osatut = $haeosatut->num_rows;
        $eiosatut = $haeeiosatut->num_rows;
        $osatutnimi = 'Tehty ja osattu';
        $eiosatutnimi = 'Tehty, mutta ei osattu ilman apua';
        $tekemattomatnimi = 'Tekemättä';
        $tehdytnimi = 'Tehtyjä tehtäviä';
        $tehdythuijaus = 0;
        if (($yht - $tehdyt) >= 0) {
            $tekemattomat = $yht - $tehdyt;
        } else {
            $tekemattomat = 0;
        }



        if ($yht != 0) {
            $osuus = ($tehdyt / $yht) * 100;
            $osuus = round($osuus, 0);
        }
        if ($tehdyt != 0) {
            $osuusosatut = ($osatut / $tehdyt) * 100;
            $osuusosatut = round($osuusosatut, 0);
        }


        $chart2 = new PieChart(900, 300);
           $chart2->getPlot()->getPalette()->setPieColor(array(
                          //valkonen
                new Color(255, 255, 255),
                          //oranssi
                new Color(255, 165, 0),
                //vihree
                new Color(127, 216, 88),
                //sininen
                new Color(0, 191, 255),
             
             
            ));

        $chart2->getPlot()->getPalette()->setBackgroundColor(array(
            new Color(230, 230, 255),
            new Color(230, 230, 255),
            new Color(230, 230, 255),
            new Color(230, 230, 255),
        ));
        //data set instance
        $dataSet2 = new XYDataSet();

       $dataSet2->addPoint(new Point("{$eiosatutnimi} ({$eiosatut} kpl)", $eiosatut));
           $dataSet2->addPoint(new Point("{$tehdytnimi} ({$tehdyt} kpl)", 0));         
               $dataSet2->addPoint(new Point("{$osatutnimi} ({$osatut} kpl)", $osatut));            
                $dataSet2->addPoint(new Point("{$tekemattomatnimi} ({$tekemattomat} kpl)", $tekemattomat));


        //finalize dataset
        $chart2->setDataSet($dataSet2);

        //set chart title
        $chart2->setTitle("TEHTYJEN TEHTÄVIEN JAKAUTUMINEN (PISTEMÄÄRIÄ EI PAINOTETA): ");

        $pienimi = 'malli' . $ipid . '.png';


        //render as an image and store under "generated" folder
        $chart2->render("images/" . $pienimi);
    }
    // PISTEET VAIKUTTAA
    else {

        if (!$haepisteet = $db->query("select  paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $yht = 0;
        while ($rowpis = $haepisteet->fetch_assoc()) {
            $yht = $yht + $rowpis[paino];
        }

        //TEHDYT YHTEENSÄ
        if (!$haeomatpisteet = $db->query("select distinct itsetehtavat.id, itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $tehdyt = 0;

        while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
            $tehdyt = $tehdyt + $rowpis2[paino];
        }

        //TEHDYT JA OSATUT 
        if (!$haeomatpisteet = $db->query("select distinct itsetehtavat.id, itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $osatut = 0;

        while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
            $osatut = $osatut + $rowpis2[paino];
        }

        //TEHDYT EI-OSATUT
        if (!$haeomatpisteet = $db->query("select distinct itsetehtavat.id, itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $eiosatut = 0;

        while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
            $eiosatut = $eiosatut + $rowpis2[paino];
        }


        $osatutnimi = 'Tehty ja osattu';
        $eiosatutnimi = 'Tehty, mutta ei osattu ilman apua';
        $tekemattomatnimi = 'Tekemättä';
        $tehdytnimi = 'Tehtyjä tehtäviä';
        $tehdythuijaus = 0;

        if (($yht - $tehdyt) >= 0) {
            $tekemattomat = $yht - $tehdyt;
        } else {
            $tekemattomat = 0;
        }



        if ($yht != 0) {
            $osuus = ($tehdyt / $yht) * 100;
            $osuus = round($osuus, 0);
        }
        if ($tehdyt != 0) {
            $osuusosatut = ($osatut / $tehdyt) * 100;
            $osuusosatut = round($osuusosatut, 0);
        }


        $chart2 = new PieChart(900, 300);
        
           $chart2->getPlot()->getPalette()->setPieColor(array(
                          //valkonen
                new Color(255, 255, 255),
                          //oranssi
                new Color(255, 165, 0),
                //vihree
                new Color(127, 216, 88),
                //sininen
                new Color(0, 191, 255),
             
             
            ));

        $chart2->getPlot()->getPalette()->setBackgroundColor(array(
            new Color(230, 230, 255),
            new Color(230, 230, 255),
            new Color(230, 230, 255),
            new Color(230, 230, 255),
        ));
        //data set instance
        $dataSet2 = new XYDataSet();

         $dataSet2->addPoint(new Point("{$eiosatutnimi} ({$eiosatut} p)", $eiosatut));
           $dataSet2->addPoint(new Point("{$tehdytnimi} ({$tehdyt} p)", 0));         
               $dataSet2->addPoint(new Point("{$osatutnimi} ({$osatut} p)", $osatut));            
                $dataSet2->addPoint(new Point("{$tekemattomatnimi} ({$tekemattomat} p)", $tekemattomat));


        //finalize dataset
        $chart2->setDataSet($dataSet2);

        //set chart title
        $chart2->setTitle("TEHTYJEN TEHTÄVIEN JAKAUTUMINEN, KUN PISTEMÄÄRIÄ PAINOTETAAN: ");

        $pienimi = 'malli' . $ipid . '.png';


        //render as an image and store under "generated" folder

        $chart2->render("images/" . $pienimi);
    }




    if (!$haetehtavat2 = $db->query("select distinct id from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    $yht = $haetehtavat2->num_rows;




    if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipid . "' AND painotus = 1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($onkopisteet->num_rows != 0) {
        $pisteet = true;
    }
    if (!$onkopistevaikutus = $db->query("select distinct pisteetvaikuttaa from itseprojektit where id = '" . $ipid . "' AND pisteetvaikuttaa = 1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($onkopistevaikutus->num_rows != 0) {
        $pisteetvaikuttaa = true;
    }

    if ($pisteet) {
        if (!$haepisteet = $db->query("select paino from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $pisteetyht = 0;
        while ($rowpis = $haepisteet->fetch_assoc()) {
            $pisteetyht = $pisteetyht + $rowpis[paino];
        }

        if (!$haeomatpisteet = $db->query("select itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $omatpisteetyht = 0;
        while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
            $omatpisteetyht = $omatpisteetyht + $rowpis2[paino];
        }
        if (!$haeomatpisteet2 = $db->query("select itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=0")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        $omatpisteetyht2 = 0;
        while ($rowpis3 = $haeomatpisteet2->fetch_assoc()) {
            $omatpisteetyht2 = $omatpisteetyht2 + $rowpis3[paino];
        }
    }

    echo'<div class="cm8-responsive" id="peite"  style="overflow: hidden; padding: 0; max-width: 99%;">';

    $moi = 1;

    if (!$onkorivi10 = $db->query("select distinct dnakyy from itseprojektit where id='" . $ipid . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowdnakyy = $onkorivi10->fetch_assoc()) {
        $dnakyy = $rowdnakyy[dnakyy];
    }
    if ($dnakyy == 1) {
        echo "<img id='palaa'  alt='Tehtävädiagrammi' style='display: inline-block; border: 1px solid gray;   border-radius: 0.5em; width: 75%' onload='poista(\"" . str_replace('"', '\"', $pienimi) . "\")' src='images/" . $pienimi . "?t=" . time() . "'/>";
    }







    echo'<br><br>';

    echo'</div>';
}
