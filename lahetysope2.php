<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html><html> 
<head>
<title> Palautukset </title>';

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {
    include("kurssisivustonheader.php");



    echo '<div class="cm8-container7" style="margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 60px">';
    if ($_SESSION["Rooli"] == "opettaja" || $_SESSION["Rooli"] == "admin" || $_SESSION["Rooli"] == "admink" || $_SESSION["Rooli"] == "opeadmin") {
        echo'<nav class="topnav" id="myTopnav">
	 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
	  
	  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" class="currentLink" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
		
	 ';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {

            $kysakt = $rowa[kysakt];
        }
        if ($kysakt == 1) {
            
        } else {
            // echo'<a  href="kysymyksetkommentit.php">Kysy/kommentoi</a>';
        }


        echo'
	  <a href="keskustelut.php" >Keskustele</a> 
	  <a href="osallistujat.php"   >Osallistujat</a>  	  
	   <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
	</nav>';




        echo'

<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>';
    }

    if ($_SESSION["Rooli"] == "opiskelija") {
        echo'<nav class="topnav" id="myTopnav">
		 <a href="kurssi.php?id=' . $_SESSION["KurssiId"] . '">Etusivu</a><a href="tiedostot.php"  >Materiaalit</a>  
		  
		  <a href="itsetyot.php" onclick="loadProgress()" >Tehtävälista</a><a href="ryhmatyot.php" class="currentLink" >Palautukset</a><a href="itsearviointi.php" >Itsearviointi</a><a href="kysely.php"  >Kyselylomake</a>
			
		 ';
        if (!$haeakt = $db->query("select distinct kysakt from kurssit where id='" . $_SESSION["KurssiId"] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeakt->fetch_assoc()) {

            $kysakt = $rowa[kysakt];
        }
        if ($kysakt == 1) {
            
        } else {
            // echo'<a  href="kysymyksetkommentit.php">Kysy/kommentoi</a>';
        }


        echo'
	  <a href="keskustelut.php" >Keskustele</a> 
	  <a href="osallistujat.php"   >Osallistujat</a>  	  
	   <a href="javascript:void(0);" class="icon" onclick="myFunction(this)"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></a>
	</nav>';




        echo'

<script>
function myFunction(y) {
  y.classList.toggle("change");
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>';
    }

    echo'<div class="cm8-margin-top"></div>';

    if (!$hae_eka = $db->query("select MIN(id) as id from itseprojektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if ($hae_eka->num_rows != 0) {
        while ($rivieka = $hae_eka->fetch_assoc()) {
            $eka_id = $rivieka[id];
        }
    }


    echo'<div class="cm8-quarter" style="width: 300px; padding-left: 20px"> <h2 style="padding-top: 0px; padding-left: 0px; padding-bottom: 0px">Palautukset</h2>';
    echo '<nav class="cm8-sidenav " style="padding-top: 0px; margin-top:0px; height: 100%; padding-left: 0px">


';
    if (!$haeprojekti = $db->query("select * from projektit where kurssi_id='" . $_SESSION["KurssiId"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    if ($haeprojekti->num_rows != 0) {
        echo'<div class="cm8-sidenav" style="padding-top: 20px; margin-top:0px; height: 100%; padding-left: 0px">';
        while ($rowP = $haeprojekti->fetch_assoc()) {
            $kuvaus = $rowP[kuvaus];
            $id = $rowP[id];
            if ($_POST[pid] == $id) {

                echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3-valittu" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px"><b style="font-size: 1.1em; ">&#9997 &nbsp&nbsp&nbsp' . $kuvaus . ' </b></a>';
            } else {

                echo'<a href="ryhmatyot.php?r=' . $id . '" class="btn-info3" style="margin-right: 20px; margin-bottom: 5px;  padding: 3px 6px 3px 20px">' . $kuvaus . '</a>';
            }
        }
        echo'<div class="cm8-margin-top"></div>';

        if ($_SESSION["Rooli"] <> 'opiskelija') {
            echo'<form action="uusiprojekti.php" method="post"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painike" value="+ Lisää Palautus-osio" class="myButton8"  role="button"  style="padding: 2px 6px"></form>';
        
                echo'<form action="tuoprojekti.php" method="post" style="display: inline-block"><input type="hidden" name="id" value=' . $_SESSION["KurssiId"] . '>';
           
 echo'<button  name="painike" title="Tuo Palautus-osio" class="myButton8" style="font-size: 0.8em"><i class="fa fa-recycle"></i>&nbsp&nbsp Tuo Palautus-osio </button>';
  echo'</form><br><br>';
            
        }
    }
    echo'</nav>
 <div class="cm8-margin-top"></div></div>';



    echo'<div class="cm8-threequarter" style="padding-top: 30px">';
    require_once("upload_uusi.php");

    // Esimerkki: Tarkistetaan, että tiedosto on lähetetty ja että se on kooltaan
    // enintään 10,0 megatavua. Käsitellään myös virheilmoitus.

    
    $projekti = $_POST[pid];
    $tyonimi = $_POST[tyonimi];

    if (isset($_FILES['my_file'])) {
        $myFile = $_FILES['my_file'];

//tulee array!!


        try {

            $nimi = upload_tarkista('my_file', 10.0 * 1024 * 1024);

            $fileCount = count($nimi);

          $stmt = $db->prepare("INSERT INTO open_palautustiedosto (linkki, kuvaus, tallennettunimi, projekti_id, omatallennusnimi) VALUES (?, ?, ?, ?,?)");
         $stmt->bind_param("issis", $linkki, $kuvaus, $tallennettunimi, $pid, $omatallennusnimi);
     
          
            
            $paateloyty = false;
            for ($j = 0; $j < $fileCount; $j++) {

                $paatteet = array(".txt", ".pdf", ".rar", ".zip", ".csv", ".odt", ".ods", ".odg", "odp", ".tnsp", ".tns", ".doc", ".docx", ".rtf", ".dat", ".pptx", ".ppt", ".xls", ".xlsx", ".TXT", ".PDF", ".DOC", ".DOCX", ".RTF", ".DAT", ".PPTX", ".PPT", ".XLS", ".XLSX");

// Katsotaan, onko annetussa taulukossa tiedoston pääte.
                // Jos ei ole, käytetään annettua päätettä ($turvapaate).
                if (is_array($paatteet))
                    foreach ($paatteet as $paate) {

                        if (substr($nimi[$j], -strlen($paate)) == $paate) {
                            $turvapaate = $paate;
                            $paateloyty = true;
                            break;
                        }
                    }

                // Jos $turvapaate puuttuu (eikä muuta löytynyt taulukosta), hylätään tiedosto.
                if (!$paateloyty) {
                    throw new UploadException("Tiedostomuoto ei kelpaa! <br><br>Sallittuja tiedostopäätteitä ovat .txt, .pdf, .rar, .zip, .tnsp, .tns, .csv, .odt, .ods, .odp., .odg, .doc, .docx, .rtf, .dat, .pptx, .ppt, .xls, .xlsx");
                }

                // Luodaan tiedostolle turvallinen nimi ja tallennetaan tiedosto.
//    $nimi2 = preg_replace("/[^A-Z0-9._-]/i", "_",  $nimi[$j]);
                $nimi2 = $nimi[$j];
                if (strlen($turvapaate) && substr($nimi2, -strlen($turvapaate)) !== $paate) {
                    $nimi2 .= $paate;
                }
                // don't overwrite an existing file
                $i = 0;
                $parts = pathinfo($nimi2);
                $kohde = "tiedostot/" . $nimi2;
                while (file_exists($kohde)) {

                    $i++;
                    $nimi2 = $parts["filename"] . "(" . $i . ")." . $parts["extension"];
                    $kohde = "tiedostot/" . $nimi2;
                }

                $kohde = "tiedostot/" . $nimi2;
                if (!file_exists($kohde)) {
                    // Tarkistetaan kirjoitusoikeus.
                    if (!is_writeable(dirname($kohde)) || (file_exists($kohde) && !is_writeable($kohde))) {
                        throw new UploadException("Virhe tiedoston kopioinnissa, ei kirjoitusoikeutta!" . $kohde);
                    }

                    // Yritetään kopioida tiedosto paikalleen.
                    if (!@move_uploaded_file($myFile["tmp_name"][$j], $kohde)) {
                        $virhe = error_get_last();
                        throw new UploadException("Virhe tiedoston kopioinnissa: {$virhe["message"]}!");
                    }


                    // prepare and bind
                 $linkki = 0;
                $kuvaus = $_POST[tyonimi];
         
             $pid = $_POST[pid];
                
                    $tyonimi = $_POST[tyonimi];
                    $tallennettunimi = $kohde;
                    $omatallennusnimi = $nimi[$j];

                    $stmt->execute();
                  
                }


                //kaikki tiedostot kiinni
            }

            $stmt->close();

            // TÄHÄN LISÄYS Palautukset tauluun!
//              
//                   if (!$haeviimeisin = $db->query("select MAX(id) as ryhmatope from ryhmatope where ryhma_id='" . $_POST[ryid] . "'")) {
//            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
//        }
//
//    
//       while ($rowa = $haeviimeisin->fetch_assoc()) {
//           $ryhmat2id = $rowa[ryhmat2];
//       }
//       
//      $stmt2 = $db->prepare("INSERT INTO opiskelijan_kurssityotopelta (kayttaja_id, ryhmatope_id, projekti_id) VALUES (?, ?, ?)");
//            $stmt2->bind_param("iii", $kayttaja, $ryhmat2, $projektiid);
//            
//            $kayttaja = $_POST[kaid];
//            $ryhmat2 = $ryhmat2id;       
//            $projektiid = $_POST[pid];
//                    
//                  
//
//                    $stmt2->execute();    
//               $stmt2->close();
        } catch (UploadException $e) {

            die('<b style="font-size: 1em; color: #FF0000">' . $e->getMessage() . '</b><br><br><a href="tiedosto_ope_automaattinen.php?ryid=' . $_POST[ryid] . '&pid=' . $_POST[pid] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
    }




    header("location: ryhmatyot.php?r=" . $_POST[pid]);
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}

echo "</div>";
echo "</div>";

include("footer.php");
?>

</body>
</html>