<?php
session_start(); 



ob_start();

function tuoDiagrammi($kayttaja_id, $ipid) {

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

    if ((!$pisteetvaikuttaa && $pisteet) || !$pisteet ) {



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
        $tehdytnimi = 'Tehtyjä tehtäviä yhteensä ';
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
        
        if($tehdyt==0){
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
        }
        
        //osatut,eiosatut,tekemattomat
        else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat <= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //vihree
                new Color(127, 216, 88),
                //sininen
                new Color(0, 191, 255),
                //valkonen
                new Color(255, 255, 255),
                //oranssi
                new Color(255, 165, 0),
            ));
        }

        //tekemattomat, osatut, eiosatut
        else if ($osatut >= $eiosatut && $osatut==$tehdyt && $osatut <= $tekemattomat && $tekemattomat >= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //valkonen
                new Color(255, 255, 255),
                //vihree
                new Color(127, 216, 88),
                  //oranssi
                new Color(255, 165, 0),
                //sininen
                new Color(0, 191, 255),
              
            ));
        }
           else if ($osatut >= $eiosatut && $osatut!=$tehdyt && $osatut <= $tekemattomat && $tekemattomat >= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //valkonen
                new Color(255, 255, 255),
                //vihree
                new Color(127, 216, 88),
               
                //sininen
                new Color(0, 191, 255),
                   //oranssi
                new Color(255, 165, 0),
              
            ));
        }
        //tekemattomat, eiosatut, osatut
        else if ($osatut <= $eiosatut && $osatut <= $tekemattomat && $tekemattomat >= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //valkonen
                new Color(255, 255, 255),
//sininen
                new Color(0, 191, 255),
               
                //vihree
                new Color(127, 216, 88),
                  //oranssi
                new Color(255, 165, 0),
               
            ));
        }
        //osatut,tekemattomat, eiosatut
        else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat >= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //vihree
                new Color(127, 216, 88),
                new Color(255, 255, 255),
//sininen
                new Color(0, 191, 255),
                //oranssi
                new Color(255, 165, 0),
            ));
        }

        //eiosatut, osatut, tekemattomat
        else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat >= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //sininen
                new Color(0, 191, 255),
//vihree
                new Color(127, 216, 88),
                //valkonen
                new Color(255, 255, 255),
                //oranssi
                new Color(255, 165, 0),
            ));
        }
        //eiosatut, tekemattomat, osatut
        else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat >= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //sininen
                new Color(0, 191, 255),
                //valkonen
                new Color(255, 255, 255),
                //
                //vihree
                new Color(127, 216, 88),
                //oranssi
                new Color(255, 165, 0),
            ));
        }
        
         else if ($osatut < $eiosatut && $tekemattomat <= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //sininen
                new Color(0, 191, 255),
                 //vihree
                new Color(127, 216, 88),
                //valkonen
                new Color(255, 255, 255),
                //
               
                //oranssi
                new Color(255, 165, 0),
            ));
        }

        $chart2->getPlot()->getPalette()->setBackgroundColor(array(
            new Color(230, 230, 255),
            new Color(230, 230, 255),
            new Color(230, 230, 255),
            new Color(230, 230, 255),
        ));
        //data set instance
        $dataSet2 = new XYDataSet();

    
           
            
               
              
               
      
            
            if($tehdyt < $tekemattomat){
                  $dataSet2->addPoint(new Point("{$eiosatutnimi} ({$eiosatut} kpl)", $eiosatut));
                $dataSet2->addPoint(new Point("{$tehdytnimi} ({$tehdyt} kpl)", 0));           
               $dataSet2->addPoint(new Point("{$osatutnimi} ({$osatut} kpl)", $osatut));            
                $dataSet2->addPoint(new Point("{$tekemattomatnimi} ({$tekemattomat} kpl)", $tekemattomat));
            }
            else{
                  $dataSet2->addPoint(new Point("{$eiosatutnimi} ({$eiosatut} kpl)", $eiosatut));
                $dataSet2->addPoint(new Point("{$tehdytnimi} ({$tehdyt} kpl)", 0));           
               $dataSet2->addPoint(new Point("{$osatutnimi} ({$osatut} kpl)", $osatut));            
                $dataSet2->addPoint(new Point("{$tekemattomatnimi} ({$tekemattomat} kpl)", $tekemattomat));
            }
      
        
      


        //finalize dataset
        $chart2->setDataSet($dataSet2);

        //set chart title
        $chart2->setTitle("TEHTYJEN TEHTÄVIEN JAKAUTUMINEN (PISTEMÄÄRIÄ EI PAINOTETA): ");

        $pienimi = 'sektori' . $kayttaja_id . '.png';


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

        //tehdyt kpl
        
               if (!$haetehdytkpl = $db->query("select distinct itsetehtavat.id from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        
        $tehdytkpl = $haetehdytkpl->num_rows;
        
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

        $tekemattomat = $yht - $tehdyt;
        $osatutnimi = 'Tehty ja osattu';
        $eiosatutnimi = 'Tehty, mutta ei osattu ilman apua';
        $tekemattomatnimi = 'Tekemättä';
        $tehdytkplnimi = 'Tehtyjä tehtäviä';
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
        
         if($tehdyt==0){
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
        }
        
        //osatut,eiosatut,tekemattomat
        else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat <= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //vihree
                new Color(127, 216, 88),
                //sininen
                new Color(0, 191, 255),
                //valkonen
                new Color(255, 255, 255),
                //oranssi
                new Color(255, 165, 0),
            ));
        }

        //tekemattomat, osatut, eiosatut
        else if ($osatut >= $eiosatut && $osatut==$tehdyt && $osatut <= $tekemattomat && $tekemattomat >= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //valkonen
                new Color(255, 255, 255),
                //vihree
                new Color(127, 216, 88),
                  //oranssi
                new Color(255, 165, 0),
                //sininen
                new Color(0, 191, 255),
              
            ));
        }
           else if ($osatut >= $eiosatut && $osatut!=$tehdyt && $osatut <= $tekemattomat && $tekemattomat >= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //valkonen
                new Color(255, 255, 255),
                //vihree
                new Color(127, 216, 88),
               
                //sininen
                new Color(0, 191, 255),
                   //oranssi
                new Color(255, 165, 0),
              
            ));
        }
        //tekemattomat, eiosatut, osatut
        else if ($osatut <= $eiosatut && $osatut <= $tekemattomat && $tekemattomat >= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //valkonen
                new Color(255, 255, 255),
//sininen
                new Color(0, 191, 255),
               
                //vihree
                new Color(127, 216, 88),
                  //oranssi
                new Color(255, 165, 0),
               
            ));
        }
        //osatut,tekemattomat, eiosatut
        else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat >= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //vihree
                new Color(127, 216, 88),
                new Color(255, 255, 255),
//sininen
                new Color(0, 191, 255),
                //oranssi
                new Color(255, 165, 0),
            ));
        }

        //eiosatut, osatut, tekemattomat
        else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat >= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //sininen
                new Color(0, 191, 255),
//vihree
                new Color(127, 216, 88),
                //valkonen
                new Color(255, 255, 255),
                //oranssi
                new Color(255, 165, 0),
            ));
        }
        //eiosatut, tekemattomat, osatut
        else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat >= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //sininen
                new Color(0, 191, 255),
                //valkonen
                new Color(255, 255, 255),
                //
                //vihree
                new Color(127, 216, 88),
                //oranssi
                new Color(255, 165, 0),
            ));
        }
        
         else if ($osatut < $eiosatut && $tekemattomat <= $eiosatut) {
            $chart2->getPlot()->getPalette()->setPieColor(array(
                //sininen
                new Color(0, 191, 255),
                 //vihree
                new Color(127, 216, 88),
                //valkonen
                new Color(255, 255, 255),
                //
               
                //oranssi
                new Color(255, 165, 0),
            ));
        }

        $chart2->getPlot()->getPalette()->setBackgroundColor(array(
            new Color(230, 230, 255),
            new Color(230, 230, 255),
            new Color(230, 230, 255),
            new Color(230, 230, 255),
        ));
        //data set instance
        $dataSet2 = new XYDataSet();
     if($tehdytkpl < $tekemattomat){
                  $dataSet2->addPoint(new Point("{$eiosatutnimi} ({$eiosatut} p)", $eiosatut));
           $dataSet2->addPoint(new Point("{$tehdytkplnimi} ({$tehdytkpl} p)", 0));         
               $dataSet2->addPoint(new Point("{$osatutnimi} ({$osatut} p)", $osatut));            
                $dataSet2->addPoint(new Point("{$tekemattomatnimi} ({$tekemattomat} p)", $tekemattomat));
            }
            else{
                  $dataSet2->addPoint(new Point("{$eiosatutnimi} ({$eiosatut} p)", $eiosatut));
             $dataSet2->addPoint(new Point("{$tehdytkplnimi} ({$tehdytkpl} p)", 0));           
               $dataSet2->addPoint(new Point("{$osatutnimi} ({$osatut} p)", $osatut));            
                $dataSet2->addPoint(new Point("{$tekemattomatnimi} ({$tekemattomat} p)", $tekemattomat));
            }


        //finalize dataset
        $chart2->setDataSet($dataSet2);

        //set chart title
        $chart2->setTitle("TEHTYJEN TEHTÄVIEN JAKAUTUMINEN, KUN PISTEMÄÄRIÄ PAINOTETAAN: ");

        $pienimi = 'sektori' . $kayttaja_id . '.png';


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

    echo'<div class="cm8-responsive" id="peite"  style="overflow: hidden; padding: 0px; max-width: 99%;">';

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


    if (!$onkopie = $db->query("select distinct edistymispie from itseprojektit where id = '" . $ipid . "' AND edistymispie = 1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($onkopie->num_rows != 0) {
        $edistymispie = true;
    }


    if ($pisteet) {
        //oma edistymistaso
//        if ($edistymispie) {
//            tuoDiagrammi2($kayttaja_id, $ipid);
//        }
        //pistepalkit
        tuoDiagrammi3($kayttaja_id, $ipid);
    }
//
//    echo'<br><br><p style="font-weight: bold; color:  #e608b8">Tehtävädiagrammin maksimiprosenttimäärä on '.$dmax.' %</p>';
    if (!$haeomatpisteet = $db->query("select itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    $omatpisteetyht = 0;
    while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
        $omatpisteetyht = $omatpisteetyht + $rowpis2[paino];
    }

    if ($pisteet && $pisteetvaikuttaa) {

        echo'<ul style="max-width: 99%; color:  #e608b8"><li><b>Tehtäviä on yhteensä: </b>' . $yht . ' kpl</li><li style="margin-left: 30px"><b>Tehtyjä tehtäviä: </b>' . $tehdytkpl. ' kpl</li><br><br><li><b>Tehtävien yhteispistemäärä: </b>' . $pisteetyht . ' p</li><br><br><li style=""><b>Pisteitä kerätty: </b>' . $tehdyt . ' p</li><li style="margin-left: 30px"><b>Tehtyjen tehtävien pisteiden osuus on: </b>' . $osuus . ' %</li></ul>';
    } else if ($pisteet && !$pisteetvaikuttaa) {

        echo'<ul style="max-width: 99%; color:  #e608b8"><li><b>Tehtäviä on yhteensä: </b>' . $yht . ' kpl</li><li style="margin-left: 30px"><b>Tehtyjä tehtäviä: </b>' . $tehdyt . ' kpl</li><li style="margin-left: 30px"><b>Tehtyjä tehtäviä: </b>' . $osuus . '%</li></ul>';
    } else {

        echo'<ul style="max-width: 99%; color:  #e608b8"><li><b>Tehtäviä on yhteensä:</b> ' . $yht . ' kpl</li><li style="margin-left: 30px"><b>Tehtyjä tehtäviä: </b>' . $tehdyt . ' kpl</li><li style="margin-left: 30px"><b>Tehtyjä tehtäviä: </b>' . $osuus . '%</li></ul>';
    }

    echo'<div vertical-align="top" style="position: relative; height: 50px;width: 75%;border: 4px solid #8fc8d7; margin-right: 40px; margin-top: 30px; margin-bottom: 20px; padding:0px ">
 <div class="cm8-pinkki" style="display: inline-block;min-width:' . $osuus . '%; overflow: hidden; height: 100%; text-align: center"><b style="padding-top: 10px;display: inline-block;margin-left: 5px; color:#e608b8; font-size: 1.2em; ">' . $osuus . '%</b></div>';

    echo'</div>';


    if (!$onkorivi8 = $db->query("select distinct * from itseprojektit_minimi where itseprojektit_id='" . $ipid . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowmin = $onkorivi8->fetch_assoc()) {
        $minimi = $rowmin[minimi];
    }

    if ($minimi != '') {

        if ($osuus >= $minimi) {
            echo'<br><button type="button" class="btn btn-warning btn-lg btn-radius" style="margin-bottom: 20px; padding: 10px 20px; text-transform: none; font-size: 0.9em">Olet saavuttanut tehtävien minimirajan ' . $minimi . ' %</button>';
        } else {

            echo'<br><button type="button" class="btn btn-warning btn-lg btn-radius" style="margin-bottom: 20px; padding: 10px 20px; text-transform: none; font-size: 0.9em">Et ole vielä saavuttanut tehtävien minimirajaa ' . $minimi . ' %</button>';
        }
    }


    //haetaan lisäpisteet
    if (!$onkorivi2 = $db->query("select * from itseprojektit_lpisteet where itseprojekti_id='" . $ipid . "' ORDER BY osuus ASC")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    $opkorkeus = $osuus;
    $lpisteet = 0;
    while ($rowr = $onkorivi2->fetch_assoc()) {
        $seliter = $rowr[pisteet];

        $osuusr = $rowr[osuus];

        if ($opkorkeus >= $osuusr) {
            $lpisteet = $seliter;
        } else {
            
        }
    }

    if (!$onkorivi2 = $db->query("select distinct * from itseprojektit_lpisteet where itseprojekti_id='" . $ipid . "' ORDER BY osuus DESC")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($onkorivi2->num_rows != 0) {

        echo'<div style="margin: 0px; padding: 0px;">';
        echo'<div style="display: inline-block; vertical-align: center; margin: 0px; padding: 0px; width: 100%">';
        echo'<div style="padding: 0px; vertical-align: top;margin-right: 20px; display: inline-block; width: 50%; ">';
        echo'<button type="button" class="btn btn-info btn-lg btn-radius" style="margin-left: 0px; margin-bottom: 20px; padding: 10px 20px; text-transform: none; font-size: 0.9em" >Olet saavuttanut ' . $lpisteet . ' lisäpistettä </button>';
        echo'</div>';


        echo'<div style="padding: 0px; margin: 0px; vertical-align: top;display: inline-block; ;width: 45%">';
        echo'<table  class="tehtavatauluope" style="display: inline-block; font-size: 0.9em; " >';

        echo'<th style="border: none;font-size: 0.9em; text-align: center; padding:15px" colspan="2">Lisäpisteiden muodostuminen: </th>';

        if((!$pisteetvaikuttaa && $pisteet) || !$pisteet){
             while ($row = $onkorivi2->fetch_assoc()) {

            echo'<tr style="font-size: 0.9em;"><td style="padding-left: 20px; padding-right: 20px"><b>Tehtyjä tehtäviä: </b>' . $row[osuus] . ' %</td>';
            echo'<td  style=""><b>Lisäpisteitä: </b>' . $row[pisteet] . ' pistettä</td></tr>';
        }
        }
        else{
             while ($row = $onkorivi2->fetch_assoc()) {

            echo'<tr style="font-size: 0.9em;"><td style="padding-left: 10px; padding-right: 20px; width: 70%"><b>Tehtyjen tehtävien pistemäärän osuus </b>' . $row[osuus] . ' %</td>';
            echo'<td  style="padding: 0px; margin: 0px; width: 30%"><b>Lisäpisteitä: </b>' . $row[pisteet] . ' p</td></tr>';
        }
        }
       
        echo'<tr><td></td><td></td></tr>';
        echo'</table>';

        echo'</div>';

        echo'</div>';
        echo'</div>';
//        echo'<br>';
//        if ($pisteet && !$pisteetvaikuttaa) {
//            echo'<p class="info" style="font-size: 1.1em; margin-top: 20px;display: inline-block;color: #e608b8">Tehtävien pisteet ei vaikuta yllä oleviin prosenttimääriin.</p>';
//        } else if ($pisteet && $pisteetvaikuttaa) {
//            echo'<p class="info" style="font-size: 1.1em; display: inline-block; margin-top: 20px;color: #e608b8">Yllä olevissa prosenttimäärissä painotetaan tehtävien pisteitä.</p>';
//        }
    }



    echo'<br><br>';

    echo'</div>';
}
