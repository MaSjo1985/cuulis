<?php
session_start(); 



ob_start();



$ipid = $_POST[ipid];
$kayttaja_id = $_SESSION[Id];
include "libchart/libchart/classes/libchart.php";
include("yhteys.php");
include("pie.php");
if (!$haetehtavat = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $ipid . "' ORDER BY jarjestys")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
if (!$haetehtavat2 = $db->query("select distinct id from itsetehtavat where itseprojektit_id='" . $ipid . "' AND aihe=0")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

$yht = $haetehtavat2->num_rows;


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
$tehdythuijaus = 0;
if (($yht - $tehdyt) >= 0) {
    $tekemattomat = $yht - $tehdyt;
} else {
    $tekemattomat = 0;
}



if ($yht != 0) {
    $osuus = ($tehdyt / $yht) * 100;
    $osuus = round($osuus, 1);
}
if ($tehdyt != 0) {
    $osuusosatut = ($osatut / $tehdyt) * 100;
    $osuusosatut = round($osuusosatut, 1);
}


//                echo'Tehtyjä tehtäviä: <b>' . $tehdyt . ' kpl.</b><br>';
//                if ($yht != 0)
//                    echo'
//                if ($tehdyt != 0)
//                    echo'Osattuja tehtäviä: <b>' . $osatut . ' kpl.</b> (' . $osuusosatut . ' % tehdyistä tehtävistä.)</em></p><br>';
//new pie chart instance

$chart2 = new PieChart(500, 300);
//osatut,eiosatut,tekemattomat
if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat <= $eiosatut) {
    $chart2->getPlot()->getPalette()->setPieColor(array(
        //vihree
        new Color(127, 216, 88),
//punanen
        new Color(0, 191, 255),
        //valkonen
        new Color(255, 255, 255),
        new Color(255, 0, 153),
    ));
}

//tekemattomat, osatut, eiosatut
else if ($osatut >= $eiosatut && $osatut <= $tekemattomat && $tekemattomat >= $eiosatut) {
    $chart2->getPlot()->getPalette()->setPieColor(array(
        //valkonen
        new Color(255, 255, 255),
        //vihree
        new Color(127, 216, 88),
//punanen
        new Color(0, 191, 255),
        new Color(255, 0, 153),
    ));
}
//tekemattomat, eiosatut, osatut
else if ($osatut <= $eiosatut && $osatut <= $tekemattomat && $tekemattomat >= $eiosatut) {
    $chart2->getPlot()->getPalette()->setPieColor(array(
        //valkonen
        new Color(255, 255, 255),
//punanen
        new Color(0, 191, 255),
        //vihree
        new Color(127, 216, 88),
        new Color(255, 0, 153),
    ));
}
//osatut,tekemattomat, eiosatut
else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat >= $eiosatut) {
    $chart2->getPlot()->getPalette()->setPieColor(array(
        //vihree
        new Color(127, 216, 88),
        new Color(255, 255, 255),
//punanen
        new Color(0, 191, 255),
        //valkonen
        new Color(255, 0, 153),
    ));
}

//eiosatut, osatut, tekemattomat
else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat >= $eiosatut) {
    $chart2->getPlot()->getPalette()->setPieColor(array(
        //punanen
        new Color(0, 191, 255),
//vihree
        new Color(127, 216, 88),
        //valkonen
        new Color(255, 255, 255),
        new Color(255, 0, 153),
    ));
}
//eiosatut, tekemattomat, osatut
else if ($osatut >= $eiosatut && $osatut >= $tekemattomat && $tekemattomat >= $eiosatut) {
    $chart2->getPlot()->getPalette()->setPieColor(array(
        //punanen
        new Color(0, 191, 255),
        //valkonen
        new Color(255, 255, 255),
        //
        //vihree
        new Color(127, 216, 88),
        new Color(255, 0, 153),
    ));
}
//data set instance
$dataSet2 = new XYDataSet();

$dataSet2->addPoint(new Point("{$osatutnimi} ({$osatut} kpl)", $osatut));
$dataSet2->addPoint(new Point("{$eiosatutnimi} ({$eiosatut} kpl)", $eiosatut));
$dataSet2->addPoint(new Point("{$tekemattomatnimi} ({$tekemattomat} kpl)", $tekemattomat));
$chart2->getPlot()->getPalette()->setBackgroundColor(array(
    new Color(224, 224, 235),
    new Color(224, 224, 235),
    new Color(224, 224, 235),
    new Color(224, 224, 235),
));
//finalize dataset
$chart2->setDataSet($dataSet2);

//set chart title
$chart2->setTitle("TEHTÄVISSÄ EDISTYMINEN: ");

$pienimi = 'sektori' . $kayttaja_id . '.png';
$chart2->getPlot()->setGraphCaptionRatio(0.4);

//render as an image and store under "generated" folder
$chart2->render("images/" . $pienimi);



if (!$onkopisteet = $db->query("select distinct painotus from itseprojektit where id = '" . $ipid . "' AND painotus = 1")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
if ($onkopisteet->num_rows != 0) {
    $pisteet = true;
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

//                         $chart3 = new PieChart(500, 300);
//                      
//                         $chart3->getPlot()->getPalette()->setPieColor(array(
//
//                        new Color(255, 255, 255),                        
//
//                        new Color(0, 128, 0),
//
//                       
// 
//                    ));
//                 $dataSet3 = new XYDataSet();
//$omatnimi = "Kerätyt pisteet: ";
//$kaikkinimi = "Pisteitä keräämättä: ";
//                $dataSet3->addPoint(new Point("{$omatnimi} ({$omatpisteetyht} pistettä)", $omatpisteetyht));
//                 $dataSet3->addPoint(new Point("{$kaikkinimi} ({$pisteetyht} pistettä)", $pisteetyht));
//                  $chart3->setDataSet($dataSet3);
//                } 
//                    
//                                   $chart3 = new VerticalBarChart(500,300);
//   $chart3->setTitle("Tehtäväpisteet: ");
//	$serie1 = new XYDataSet();
//	$serie1->addPoint(new Point("", $omatpisteetyht));
//
//
//	$chart3->getPlot()->getPalette()->setBarColor(array(
//		 new Color(127, 216, 88),
//		 new Color(0, 191, 255),
//            new Color(0, 102, 0),
//            new Color(255, 0, 0),
//	));
//        $chart3 ->getPlot()->getPalette()->setBackgroundColor(array(
//		 new Color(163, 163, 194),
//            new Color(163, 163, 194),
//            new Color(163, 163, 194),
//            new Color(163, 163, 194),
//		
//	));
//	$serie2 = new XYDataSet();
//	$serie2->addPoint(new Point("", $omatpisteetyht2));
//	
//$serie3 = new XYDataSet();
//$serie3->addPoint(new Point("", ($omatpisteetyht+$omatpisteetyht2)));
//$serie4 = new XYDataSet();
//$serie4->addPoint(new Point("1", $pisteetyht));
//
//	$dataSet3 = new XYSeriesDataSet();
//	$dataSet3->addSerie("Tehdyt ja osatut", $serie1);
//	$dataSet3->addSerie("Tehdyt, mutta ei osattu ilman apua", $serie2);
//        $dataSet3->addSerie("Pisteet yhteensä", $serie3);
//         $dataSet3->addSerie("Maksimipisteet", $serie4);
//	$chart3->setDataSet($dataSet3);
//	$chart3->getPlot()->setGraphCaptionRatio(0.3);
//                                     $pienimi2 = 'sektori2' . $kayttaja_id . '.png';
//                  $chart3->render("images/" . $pienimi2);
}

echo'<div class="cm8-responsive" id="peite"  style="overflow-y: hidden; padding: 0">';

echo "<img id='palaa'  alt='Pie chart' style='display: inline-block; max-width: 99%' src='images/" . $pienimi . "'/>";
if ($pisteet) {
//    tuoDiagrammi2($kayttaja_id, $ipid);
}

echo'<div class="cm8-margin-top"></div>';
//         if (!$onkoprojekti = $db->query("select distinct * from opiskelijantavoite where itseprojektit_id='" . $ipid . "' AND kayttajat_id='".$kayttaja_id."'")) {
//            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//        }
//
//      while ($rowP = $onkoprojekti->fetch_assoc()) {
//
//           
//            $prostavoite = $rowP[prostavoite];
//        }
//        
//      
//     if($onkoprojekti -> num_rows!=0){
//          echo'<p style="font-weight: bold; font-size: 1.5em; display: inline-block; margin-right: 40px"> Tavoitteesi on: '. $prostavoite. ' %</p>';
//           echo'<p style="font-weight: bold; font-size: 1.3em; display: inline-block; margin-right: 40px"> -></p>';
//         if($osuus >= $prostavoite){
//              echo'<p style="font-weight: bold; color:#2b6777; font-size: 1.5em; display: inline-block"> Hienoa, olet saavuttanut tavoitteesi!</p>';
//         }
//         else{
//             $ero = $prostavoite - $osuus;
//              echo'<p  style="font-weight: bold; color: brown; font-size: 1.5em; display: inline-block">Olet tavoitettasi jäljessä vielä: '. $ero. ' %</p>';
//             
//         }
//              
//       }
//       else{
//             echo'<p style="font-weight: bold; font-size: 1.5em">Et ole vielä asettanut tavoitettasi tehtävien teon suhteen.</p>';
//       }
//    
//    
//echo'<form action="muokkaaopiskelijantavoite.php" method="post" ><input type="hidden" name="ipid" value=' . $ipid . '><input type="hidden" name="kaid" value='.$kayttaja_id.'><input type="submit" name="painike" value="Muokkaa tavoitettasi" class="myButton8" title="Muokkaa tavoitettasi"  role="button" style="font-size:1em"></form>';

if (!$haeomatpisteet = $db->query("select itsetehtavat.paino as paino from itsetehtavat, itsetehtavatkp where itsetehtavat.itseprojektit_id='" . $ipid . "' AND itsetehtavatkp.itsetehtavat_id=itsetehtavat.id AND itsetehtavatkp.kayttaja_id='" . $kayttaja_id . "' AND itsetehtavatkp.tehty=1 AND itsetehtavatkp.osattu=1")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}
$omatpisteetyht = 0;
while ($rowpis2 = $haeomatpisteet->fetch_assoc()) {
    $omatpisteetyht = $omatpisteetyht + $rowpis2[paino];
}
echo'<br>';

if ($pisteet) {

    echo'<ul style="max-width: 99%; color:  #e608b8"><li><b>Tehtäviä on yhteensä: </b>' . $yht . ' kpl.</li><li style="margin-left: 30px"><b>Tehtyjä tehtäviä: </b>' . $osuus . ' %.</li><li style="margin-left: 30px"><b>Kertoimet yhteensä: </b>' . $pisteetyht . ' p.</li></ul>';
} else {

    echo'<ul style="max-width: 99%; color:  #e608b8"><li><b>Tehtäviä on yhteensä:</b> ' . $yht . ' kpl.</li><li style="margin-left: 30px"><b>Tehtyjä tehtäviä: </b>' . $osuus . ' %</li></ul>';
}

echo'</div>';

