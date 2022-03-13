<?php
session_start(); 



ob_start();



include("yhteys.php");


// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
$kuid = $_SESSION['KurssiId'];
$w1 = $_SESSION['w1'];
$w2 = $_SESSION['w2'];



if ($_SESSION["Rooli"] == 'opiskelija') {

    if (!$haekysakt = $db->query("select distinct * from kurssit where id='" . $kuid . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    while ($rowkys8 = $haekysakt->fetch_assoc()) {
        $kysakt = $rowkys8[kysakt];
    }

    if ($kysakt == 0) {
        echo('<br><p style="font-weight: bold; color: #e608b8">Toiminto ei ole aktiivinen, uusia kysymyksiä/kommentteja ei voi enää lähettää! </p><p>Voit sulkea näkymän oikean yläkulman painikkella.<br><br>');
    } else {

        if (!$haekysymykset = $db->query("select distinct * from kysymykset where kurssi_id='" . $kuid . "' order by id desc")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        if ($haekysymykset->num_rows != 0) {

            if (!$haeid = $db->query("select distinct kayttaja_id from kysymykset where kurssi_id='" . $kuid . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowi = $haeid->fetch_assoc()) {
                $id = $rowi[kayttaja_id];
            }
            if (!$haerooli = $db->query("select distinct rooli from kayttajat where id='" . $id . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($rowr = $haerooli->fetch_assoc()) {
                $rooli = $rowr[rooli];
            }


            //jos open kysymys:
            if ($rooli != 'opiskelija') {




                echo'<div class="cm8-responsive cm8-center" style="margin: 0px auto;  max-height: 50%; overflow: auto">';

                echo'<br><br><table class="cm8-table4" >';

                while ($rowv = $haekysymykset->fetch_assoc()) {
                    echo '<tr><td  style="width: 80%"><em><b style="font-size: 1.1em">Opettaja </b></em>(' . $rowv[paiva] . ' ' . $rowv[kello] . '):&nbsp&nbsp&nbsp<b>' . $rowv[sisalto] . '</b></td></tr>';
                }
                echo' </table><br><br>';
            }


            //muuten:
            else {
                echo'<div class="cm8-responsive cm8-center" style="margin: 0px auto;  max-height: 50%; overflow: auto">';

                echo'<br><br><table class="cm8-table4" >';

                while ($rowv = $haekysymykset->fetch_assoc()) {
                    echo '<tr><td  style="width: 80%">' . $rowv[paiva] . ' ' . $rowv[kello] . ':&nbsp&nbsp&nbsp<b>' . $rowv[sisalto] . '</b></td></tr>';
                }
                echo' </table><br><br>';
            }
        } else {
            echo'<br><br><em>Ei kysymyksiä</em><br><br>';
        }
    }
} else {

    if (!$haekysymykset = $db->query("select distinct * from kysymykset where kurssi_id='" . $kuid . "' order by id desc")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }
    if ($haekysymykset->num_rows != 0) {

        echo'<p id="ohje">Yksittäisen kysymyksen/kommentin saat poistettua klikkaamalla sitä. Samalla saat selville sen lähettäneen opiskelijan.<br>';
        echo'</p>';

        echo'<form action="poistakysymyksetvarmistus.php" method="post" style="display: inline-block; margin-right: 30px">';
        echo'<br><input type="hidden" name="w2" value=' . $_GET[w2] . '><input type="hidden" name="w1" value=' . $_GET[w1] . '><input type="submit" value="&#10007 Poista kaikki kysymykset" class="myButton8"  role="button"  style="padding:2px 4px">';
        echo'</form>';

        echo'<a href="valitsekysymykset.php?w2=' . $_GET[w2] . '&w1=' . $_GET[w1] . '" class="myButton8"  role="button"  style="padding: 2px 4px">&#10007 Valitse poistettavat kysymykset</a>';

        echo'<div class="cm8-responsive cm8-center" style="margin: 0px auto;  max-height: 50%; overflow: auto">';

        echo'<br><br><table class="cm8-table4" >';

        if (!$haeid = $db->query("select distinct kayttaja_id from kysymykset where kurssi_id='" . $kuid . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowi = $haeid->fetch_assoc()) {
            $id = $rowi[kayttaja_id];
        }
        if (!$haerooli = $db->query("select distinct rooli from kayttajat where id='" . $id . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowr = $haerooli->fetch_assoc()) {
            $rooli = $rowr[rooli];
        }





        if ($rooli != 'opiskelija') {
            while ($rowv = $haekysymykset->fetch_assoc()) {
                echo '<tr><td><a href="selvitakysyja.php?kaid=' . $rowv[kayttaja_id] . '&kysid=' . $rowv[id] . '&w1=' . $w1 . '&w2=' . $w2 . '"><em><b style="font-size: 1.1em">Opettaja </b></em>(' . $rowv[paiva] . ' ' . $rowv[kello] . '): &nbsp&nbsp&nbsp <b>' . $rowv[sisalto] . '</b></a></td></tr>';
            }
        } else {
            while ($rowv = $haekysymykset->fetch_assoc()) {
                echo '<tr><td><a href="selvitakysyja.php?kaid=' . $rowv[kayttaja_id] . '&kysid=' . $rowv[id] . '&w1=' . $w1 . '&w2=' . $w2 . '">' . $rowv[paiva] . ' ' . $rowv[kello] . ': &nbsp&nbsp&nbsp <b>' . $rowv[sisalto] . '</b></a></td></tr>';
            }
        }




        echo' </table><br><br>';
    } else {
        echo'<br><br><em>Ei kysymyksiä</em><br><br>';
    }
}

echo '</div>';
?>