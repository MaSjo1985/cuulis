<?php
session_start(); 



ob_start();



include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if ($_SESSION["Rooli"] == 'opiskelija') {

    if ($_GET[a] == 0) {
        
    } else {



        if (!$haeakt = $db->query("select distinct * from aanestykset where id='" . $_GET[a] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }
        while ($rowa = $haeakt->fetch_assoc()) {

            if ($rowa[aktiivinen] == 1 && $rowa[nakyvissa] == 1) {
                echo '<form name="form1">';
                echo'<h5  id="' . $rowa[id] . '"  style="display: inline-block; padding-top:0px; font-size:1.1em">' . $rowa[kysymys] . '</h5>';
                echo'<br>Vain viimeisin annettu vastaus rekisteröidään.<br>';
                if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                while ($rowb = $haevaihtoehdot->fetch_assoc()) {

                    echo'<br><br><input type="radio" name="vastaus" value=' . $rowb[id] . '> ' . $rowb[nimi];
                }
                echo'<input type="hidden" name="vastaus2" value="2">';
                echo'<br><br>';

                echo'<input type="hidden" name="id" value=' . $rowa[id] . '> <br> 						
										<input type="submit" onClick="submitAani()" name="painike" value="&#10003 Lähetä vastaus" class="myButton9"  role="button"  style="padding:2px 4px"></form>';


                echo'<div class="cm8-margin-top"><br></div>';
                echo'<b style="color: #2b6777;">Tämänhetkiset tulokset: </b><br><br>';

                if (!$haeakt = $db->query("select distinct * from aanestykset where id='" . $_SESSION[aid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowa = $haeakt->fetch_assoc()) {
                    if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    // kaikki vaihtoehdot läpi

                    while ($rowv = $haevaihtoehdot->fetch_assoc()) {

                        if (!$haevastaukset = $db->query("select distinct * from aanestysvastaukset where aanestysvaihtoehdot_id='" . $rowv[id] . "' AND aanestys_id='" . $rowa[id] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        //kunkin vaihtoehdon vastaukset läpi

                        $maara = $haevastaukset->num_rows;

                        echo$rowv[nimi] . ': ' . $maara . ' kpl <br><br>';
                    }
                }

                echo'<div class="cm8-margin-bottom"></div>';
            } else if ($rowa[aktiivinen] == 1 && $rowa[nakyvissa] == 0) {
                echo '<form name="form1">';
                echo'<h5  id="' . $rowa[id] . '"  style="display: inline-block; padding-top:0px; font-size:1.1em">' . $rowa[kysymys] . '</h5>';
                echo'<br>Vain viimeisin annettu vastaus rekisteröidään.<br>';
                if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                while ($rowb = $haevaihtoehdot->fetch_assoc()) {

                    echo'<br><br><input type="radio" name="vastaus" value=' . $rowb[id] . '> ' . $rowb[nimi];
                }
                echo'<input type="hidden" name="vastaus2" value="2">';
                echo'<br><br>';

                echo'<input type="hidden" name="id" value=' . $rowa[id] . '> <br> 						
										<input type="submit" onClick="submitAani()" name="painike" value="&#10003 Lähetä vastaus" class="myButton9"  role="button"  style="padding:2px 4px"></form>';

                echo'<div class="cm8-margin-bottom"></div>';
                echo'<div class="cm8-margin-bottom"></div>';
            } else if ($rowa[nakyvissa] == 1 && $rowa[aktiivinen] == 0) {


                echo'<h5 id="' . $rowa[id] . '"  style="display: inline-block; padding-top:0px; font-size:1.1em">' . $rowa[kysymys] . '</h5>';
                echo'<br><br><b style="color: #e608b8">Äänestys on suljettu.</b>';
                //tähän opiskelijan tulokset
                echo'<div class="cm8-margin-top"></div>';
                echo'<b style="color: #2b6777;">Tulokset: </b><br><br>';

                if (!$haeakt = $db->query("select distinct * from aanestykset where id='" . $_SESSION[aid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowa = $haeakt->fetch_assoc()) {
                    if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    // kaikki vaihtoehdot läpi

                    while ($rowv = $haevaihtoehdot->fetch_assoc()) {

                        if (!$haevastaukset = $db->query("select distinct * from aanestysvastaukset where aanestysvaihtoehdot_id='" . $rowv[id] . "' AND aanestys_id='" . $rowa[id] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        //kunkin vaihtoehdon vastaukset läpi

                        $maara = $haevastaukset->num_rows;

                        echo$rowv[nimi] . ': ' . $maara . ' kpl <br><br>';
                    }
                }


                echo'<div class="cm8-margin-bottom"></div>';
            } else if ($rowa[aktiivinen] == 0 && $rowa[nakyvissa] == 0) {
                echo'<h5 id="' . $rowa[id] . '"  style="display: inline-block; padding-top:0px; font-size:1.1em">' . $rowa[kysymys] . '</h5>';
                echo'<br><br><em>Äänestys on suljettu.</em>';
            }
        }
    }
} else {
    if ($_GET[a] == 0) {
        
    } else {

        if (!$haeaanestys = $db->query("select distinct * from aanestykset where id='" . $_GET[a] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowa = $haeaanestys->fetch_assoc()) {

            if ($rowa[aktiivinen] == 0) {
                echo'<div class="cm8-margin-top"></div>';

                echo'<b  style="color: #2b6777">Tulokset: </b><br><br>';

                if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }

                // kaikki vaihtoehdot läpi

                while ($rowv = $haevaihtoehdot->fetch_assoc()) {

                    if (!$haevastaukset = $db->query("select distinct * from aanestysvastaukset where aanestysvaihtoehdot_id='" . $rowv[id] . "' AND aanestys_id='" . $rowa[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    //kunkin vaihtoehdon vastaukset läpi

                    $maara = $haevastaukset->num_rows;

                    echo$rowv[nimi] . ': ' . $maara . ' kpl <br><br>';
                }

                if ($rowa[nakyvissa] == 0) {
                    echo'<br><b style="color: #e608b8">Äänestys on suljettu.';
                    echo'<form action="aktivoiaanestys.php" style="display: inline-block; margin-left: 20px" method="post"><input type="hidden" name="id" value=' . $rowa[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikeaktivoi" value="+ Avaa" title="Avaa äänestys" class="myButton8" role="button" style="padding:2px 4px"></form>';
                    echo'<br><br>Äänestystulos on piilotettu opiskelijoilta.</b>';
                    echo'<form action="aktivoiaanestys.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $rowa[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikenayta" value="+ Näytä" title="Näytä äänestystilanne opiskelijoille" class="myButton8" role="button" style="padding:2px 4px;"></form>';
                } else if ($rowa[nakyvissa] == 1) {
                    echo'<br><b style="color: #e608b8;">Äänestys on suljettu.';
                    echo'<form action="aktivoiaanestys.php" style="display: inline-block; margin-left: 20px" method="post"><input type="hidden" name="id" value=' . $rowa[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikeaktivoi" value="+ Avaa" class="myButton8" title="Avaa äänestys" role="button" style="padding:2px 4px"></form>';
                    echo'<br><br>Opiskelijatkin näkevät äänestystulokset.</b>';
                    echo'<form action="aktivoiaanestys.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $rowa[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikepiilota" value="- Piilota" title="Piilota äänestystilanne opiskelijoilta" class="myButton8" role="button" style="padding:2px 4px" ></form>';
                }
            } else if ($rowa[aktiivinen] == 1) {




//                    echo'<form action="aktivoiaanestys.php" method="post" style="display: inline-block; margin-left: 30px"><input type="hidden" name="id" value=' . $rowa[id] . '><input type="hidden" name="kid" value=' . $_SESSION["KurssiId"] . '><input type="submit" name="painikepiilota" value="&#9759 Piilota" title="Piilota opiskelijoilta" class="myButton8" role="button" style="padding:2px 4px"></form>';

                echo'<div class="cm8-margin-top"><br></div>';

                echo'<b style="color: #2b6777;">Tämänhetkiset tulokset: </b><br><br>';

                if (!$haeakt = $db->query("select distinct * from aanestykset where id='" . $_SESSION[aid] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowa = $haeakt->fetch_assoc()) {
                    if (!$haevaihtoehdot = $db->query("select distinct * from aanestysvaihtoehdot where aanestys_id='" . $rowa[id] . "'")) {
                        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                    }

                    // kaikki vaihtoehdot läpi

                    while ($rowv = $haevaihtoehdot->fetch_assoc()) {

                        if (!$haevastaukset = $db->query("select distinct * from aanestysvastaukset where aanestysvaihtoehdot_id='" . $rowv[id] . "' AND aanestys_id='" . $rowa[id] . "'")) {
                            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                        }

                        //kunkin vaihtoehdon vastaukset läpi

                        $maara = $haevastaukset->num_rows;

                        echo$rowv[nimi] . ': ' . $maara . ' kpl <br><br>';
                    }


                    if ($rowa[nakyvissa] == 1) {
                        echo'<br><b style="color: #e608b8;">Äänestystilanne on näkyvissä opiskelijoille.</b>';
                        echo'<form action="aktivoiaanestys.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $_GET[a] . '>  <input type="submit" name="painikepiilota"  value="- Piilota" title="Piilota äänestystilanne opiskelijoilta" class="myButton8" role="button" style="padding:2px 4px"></form>';
                    } else {
                        echo'<br><b style="color: #e608b8;">Opiskelijat eivät näe äänestystilannetta.</b>';
                        echo'<form action="aktivoiaanestys.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $_GET[a] . '>  <input type="submit" name="painikenayta" value="+ Näytä" title="Näytä äänestystilanne opiskelijoille" class="myButton8" role="button" style="padding:2px 4px"></form>';
                    }
                }
            }
        }
    }
}






























// VANHA SETTI


