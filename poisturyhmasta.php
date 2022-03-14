<?php
session_start();

ob_start();



include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    if (!$onkoprojekti = $db->query("select * from projektit where id='" . $_GET[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($onkoprojekti->num_rows != 0) {


        if (!$onkosuljettu = $db->query("select distinct lopullinen from ryhmat where id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($row = $onkosuljettu->fetch_assoc()) {
            if ($row[lopullinen] == 0) {
                $db->query("update opiskelijankurssit set ryhma_id=0 where opiskelija_id = '" . $_SESSION["Id"] . "' AND projekti_id='" . $_GET[pid] . "'");
           
                }
        }
        
        if (!$onkomuita = $db->query("select distinct * from opiskelijankurssit where ryhma_id='" . $_GET[id] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
         
        if($onkomuita->num_rows==0){
            
            //poistetaan open erikseen lisäämät tiedostot
              

            if (!$haetyot = $db->query("select distinct * from ryhmatope where ryhma_id='" . $_GET[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

                while ($row = $haetyot->fetch_assoc()) {
   
                            $nimi = $row[tallennettunimi];
                            echo'<br>Nimi: '.$nimi;
                            $linkki = $row[linkki];
                            $ryhmaid = $row[ryhma_id];

                        if ($linkki == 1) {
                            $db->query("delete from ryhmatope where ryhma_id = '" . $_GET[id] . "'");

                        } else {
                            if (file_exists($nimi)) {
                                unlink($nimi);
                                echo'<br>POISTETTU: '.$nimi;
                            }

                            if (file_exists($nimi)) {
                                echo'<br>Tiedostoa ei pystytty poistamaan! <br><br><a href="ryhmatyot.php?r=' . $_GET[pid] . '"><p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a><br><br>Voit ottaa yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br><br>';
                            } else {
                                $db->query("delete from ryhmatope where ryhma_id = '" . $_GET[id] . "'");

                            }
                        }
                }
            
            
            
             $db->query("delete from ryhmat where id = '" . $_GET[id] . "'");

        }
         if (!$haetarkka = $db->query("select distinct tarkkamaara from projektit where id='" . $_GET[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    //sallittu määrä
    while ($rowtarkka = $haetarkka->fetch_assoc()) {
        $tarkkamaara = $rowtarkka[tarkkamaara];
    }

    if ($tarkkamaara != 0) {
        $db->query("insert into ryhmat (projekti_id) values('" . $_GET[pid] . "')");
    }


    //nimetään vanhat uudelleen

    if (!$resultmina = $db->query("select MIN(id) as pienin from ryhmat where projekti_id='" . $_GET[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    if (!$resultmaxa = $db->query("select MAX(id) as suurin from ryhmat where projekti_id='" . $_GET[pid] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    while ($minrowa = $resultmina->fetch_assoc()) {
        $mina = $minrowa[pienin];
    }

    while ($maxrowa = $resultmaxa->fetch_assoc()) {
        $maxa = $maxrowa[suurin];
    }

    $a = 1;

    for ($j = $mina; $j <= $maxa; $j++) {

        if (!$onko = $db->query("select * from ryhmat where projekti_id='" . $_GET[pid] . "' AND id='" . $j . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        if ($onko->num_rows > 0) {
            $ryhmanimi = $a;

            $nimi = "Ryhmä " . $ryhmanimi . " ";

            $db->query("update ryhmat set nimi='" . $nimi . "' where projekti_id='" . $_GET[pid] . "' AND id='" . $j . "'");


            $a++;
        }
    }
        
        
        
        
    }
    
    header("location: ryhmatyot.php?r=" . $_GET[pid] . '#lisaa');

    
        } else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>	  