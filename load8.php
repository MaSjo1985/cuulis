<?php
session_start(); 



ob_start();



include("yhteys.php");


// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!
$kuid = $_SESSION['KurssiId'];
$id = $_REQUEST[id];

if ($_SESSION["Rooli"] == 'opiskelija') {

    if (!$haekeskustelu = $db->query("select distinct * from keskustelut where kurssin_keskustelut_id='" . $id . "' order by id desc")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }


    if ($haekeskustelu->num_rows != 0) {
        echo'<div class="cm8-responsive" >';


        echo'<table class="cm8-table5" style="background-color: white">';

        while ($rowv = $haekeskustelu->fetch_assoc()) {

            if (!$haetykkays = $db->query("select distinct * from kayttajan_tykkaykset where keskustelut_id='" . $rowv[id] . "' AND kayttaja_id='" . $_SESSION[Id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if (!$haetykkaykset = $db->query("select distinct tykkaykset from keskustelut where id='" . $rowv[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $array = array();
            if (!$haekayttaja = $db->query("select distinct etunimi, sukunimi from kayttajat, kayttajan_tykkaykset where keskustelut_id='" . $rowv[id] . "' AND kayttajat.id=kayttajan_tykkaykset.kayttaja_id")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowkuka = $haekayttaja->fetch_assoc()) {
                $etunimi = $rowkuka[etunimi];
                $sukunimi = $rowkuka[sukunimi];
                $nimi = $etunimi . ' ' . $sukunimi;
                array_push($array, $nimi);
            }
            $yht = count($array);


            if ($haetykkays->num_rows == 0) {



                if ($yht == 1) {
                    echo'<tr id="' . $rowv[id] . '"><td style=" width: 85%; background-color: white">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br></td><td id="keskid" value="' . $rowv[id] . '" style="padding-right: 10px; background-color: white"><a onclick="myLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Tykkää"><img src="images/tykkays.jpg" style="height: 25px;"></a><br>';
                    echo'<em title="';
                    $tykmaara = 0;
                    foreach ($array as $nimet) {
                        $tykmaara++;
                        echo $nimet;
                        if ($tykmaara == ($yht - 1)) {
                            echo' ja ';
                        } else if ($tykmaara < $yht) {
                            echo', ';
                        }
                    }
                    echo' tykkää tästä.';
                    echo'" id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäys)</em></td></tr>';
                } else {
                    echo'<tr id="' . $rowv[id] . '"><td style=" width: 85%; background-color: white">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br></td><td id="keskid" value="' . $rowv[id] . '" style="padding-right: 10px; background-color: white"><a onclick="myLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Tykkää"><img src="images/tykkays.jpg" style="height: 25px;"></a><br>';
                    echo'<em title="';
                    $tykmaara = 0;
                    if ($yht != 0) {
                        foreach ($array as $nimet) {
                            $tykmaara++;
                            echo $nimet;
                            if ($tykmaara == ($yht - 1)) {
                                echo' ja ';
                            } else if ($tykmaara < $yht) {
                                echo', ';
                            }
                        }
                        echo' tykkäävät tästä.';

                        echo'"';
                    }
                    echo'" id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäystä)</em></td></tr>';
                }
            } else {
                if ($yht == 1) {
                    echo'<tr id="' . $rowv[id] . '"><td style=" width: 85%; background-color: white">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br></td><td id="keskid" value="' . $rowv[id] . '" style="background-color: white; padding-right: 10px"><a onclick="myNouLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Peru tykkäys"><img src="images/tykatty.jpg" style="height: 30px;"></a><br>';
                    echo'<em title="';
                    $tykmaara = 0;
                    foreach ($array as $nimet) {
                        $tykmaara++;
                        echo $nimet;
                        if ($tykmaara == ($yht - 1)) {
                            echo' ja ';
                        } else if ($tykmaara < $yht) {
                            echo', ';
                        }
                    }
                    echo' tykkää tästä.';
                    echo'" id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäys)</em></td></tr>';
                } else {
                    echo'<tr id="' . $rowv[id] . '" ><td style=" width: 85%; background-color: white">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br></td><td id="keskid" value="' . $rowv[id] . '" style="padding-right: 10px; background-color: white"><a onclick="myNouLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Peru tykkäys"><img src="images/tykatty.jpg" style="height: 30px;"></a><br>';
                    echo'<em title="';
                    $tykmaara = 0;
                    if ($yht != 0) {
                        foreach ($array as $nimet) {
                            $tykmaara++;
                            echo $nimet;
                            if ($tykmaara == ($yht - 1)) {
                                echo' ja ';
                            } else if ($tykmaara < $yht) {
                                echo', ';
                            }
                        }
                        echo' tykkäävät tästä.';

                        echo'"';
                    }
                    echo'" id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäystä)</em></td></tr>';
                }
            }
        }


        echo' </table><br>';


        echo' </div>';
    } else {
        echo'<br><br><em>Ei viestejä</em><br><br>';
    }
} else {

    if (!$haekeskustelu = $db->query("select distinct * from keskustelut where kurssin_keskustelut_id='" . $id . "' order by id asc")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }



    if ($haekeskustelu->num_rows != 0) {
        echo'<div class="cm8-responsive cm8-bordered" style="height: 10vh">';


        echo'<table class="cm8-table5" style="background-color: white">';


        while ($rowv = $haekeskustelu->fetch_assoc()) {
            $rowv[sisalto] = htmlspecialchars_decode($rowv[sisalto]);
            $testi = $rowv[sisalto];
            if (!$haetykkays = $db->query("select distinct * from kayttajan_tykkaykset where keskustelut_id='" . $rowv[id] . "' AND kayttaja_id='" . $_SESSION[Id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            if (!$haetykkaykset = $db->query("select distinct tykkaykset from keskustelut where id='" . $rowv[id] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            $array = array();
            if (!$haekayttaja = $db->query("select distinct etunimi, sukunimi from kayttajat, kayttajan_tykkaykset where keskustelut_id='" . $rowv[id] . "' AND kayttajat.id=kayttajan_tykkaykset.kayttaja_id")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($rowkuka = $haekayttaja->fetch_assoc()) {
                $etunimi = $rowkuka[etunimi];
                $sukunimi = $rowkuka[sukunimi];
                $nimi = $etunimi . ' ' . $sukunimi;
                array_push($array, $nimi);
            }
            $yht = count($array);




            if ($haetykkays->num_rows == 0) {
                if ($yht == 1) {
                    echo'<tr  id="' . $rowv[id] . '" style="border-bottom: 2px solid grey"><td style=" width: 80%; background-color: white"><a href="selvitakeskustelija.php?kesid=' . $rowv[id] . '&kaid=' . $rowv[kayttaja_id] . '">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br> </a></td><td id="keskid" value="' . $rowv[id] . '" style="padding-right: 0px; background-color: white"><a onclick="myLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Tykkää"><img src="images/tykkays.jpg" style="height: 25px;"></a><br>';
                    echo'<em title="';
                    $tykmaara = 0;
                    foreach ($array as $nimet) {
                        $tykmaara++;
                        echo $nimet;
                        if ($tykmaara == ($yht - 1)) {
                            echo' ja ';
                        } else if ($tykmaara < $yht) {
                            echo', ';
                        }
                    }
                    echo'" tykkää tästä9.';
                    echo'" id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäys)</em></td>';
                    echo '<td style="padding-right: 0px; background-color: white"><form action="poistakeskviesti.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $rowv[id] . '><input type="hidden" name="keskid" value=' . $id . '><button name="painikep" class="keskroskis" title="Poista"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i></button></form></td></tr>';
                } else {
                    echo'<tr id="' . $rowv[id] . '"><td style=" width: 80%; background-color: white"><a href="selvitakeskustelija.php?kesid=' . $rowv[id] . '&kaid=' . $rowv[kayttaja_id] . '">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br> </a></td><td id="keskid" value="' . $rowv[id] . '" style="padding-right: 0px; background-color: white"><a onclick="myLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Tykkää"><img src="images/tykkays.jpg" style="height: 25px;"></a><br>';
                    echo'<em title="';
                    $tykmaara = 0;
                    if ($yht != 0) {
                        foreach ($array as $nimet) {
                            $tykmaara++;
                            echo $nimet;
                            if ($tykmaara == ($yht - 1)) {
                                echo' ja ';
                            } else if ($tykmaara < $yht) {
                                echo', ';
                            }
                        }
                        echo' tykkäävät tästä.';

                        echo'"';
                    }
                    echo'" id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäystä)</em></td>'
                    . '<td style="padding-right: 0px; background-color: white"><form action="poistakeskviesti.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $rowv[id] . '><input type="hidden" name="keskid" value=' . $id . '><button name="painikep" class="keskroskis" title="Poista"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i></button></form></td></tr>';
                }
            } else {
                if ($yht == 1) {
                    echo'<tr id="' . $rowv[id] . '"><td style=" width: 80%; background-color: white"><a href="selvitakeskustelija.php?kesid=' . $rowv[id] . '&kaid=' . $rowv[kayttaja_id] . '">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br> </a></td><td id="keskid" value="' . $rowv[id] . '" style="background-color: white; padding-right: 0px"><a onclick="myNouLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Peru tykkäys"><img src="images/tykatty.jpg" style="height: 30px;"></a><br>';
                    echo'<em title="';
                    $tykmaara = 0;
                    foreach ($array as $nimet) {
                        $tykmaara++;
                        echo $nimet;
                        if ($tykmaara == ($yht - 1)) {
                            echo' ja ';
                        } else if ($tykmaara < $yht) {
                            echo', ';
                        }
                    }
                    echo' tykkää tästä8.';
                    echo'" id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäys)</em></td>'
                    . '<td style="padding-right: 0px; background-color: white"><form action="poistakeskviesti.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $rowv[id] . '><input type="hidden" name="keskid" value=' . $id . '><button name="painikep" class="keskroskis" title="Poista"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i></button></form></td></tr>';
                } else {
                    echo'<tr id="' . $rowv[id] . '" ><td style=" width: 80%; background-color: white"><a href="selvitakeskustelija.php?kesid=' . $rowv[id] . '&kaid=' . $rowv[kayttaja_id] . '">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br> </a></td><td id="keskid" value="' . $rowv[id] . '" style="padding-right: 0px; background-color: white"><a onclick="myNouLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Peru tykkäys"><img src="images/tykatty.jpg" style="height: 30px;"></a><br>';
                    echo'<em title="';
                    $tykmaara = 0;
                    if ($yht != 0) {
                        foreach ($array as $nimet) {
                            $tykmaara++;
                            echo $nimet;
                            if ($tykmaara == ($yht - 1)) {
                                echo' ja ';
                            } else if ($tykmaara < $yht) {
                                echo', ';
                            }
                        }
                        echo' tykkäävät tästä.';

                        echo'"';
                    }
                    echo'" id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäystä)</em></td>'
                    . '<td style="padding-right: 0px; background-color: white"><form action="poistakeskviesti.php" method="post" style="display: inline-block; margin-left: 20px"><input type="hidden" name="id" value=' . $rowv[id] . '><input type="hidden" name="keskid" value=' . $id . '><button name="painikep" class="keskroskis" title="Poista"><i class="fa fa-trash-o"><b class="poisto">&nbsp&nbsp Poista</b></i></button></form></td></tr>';
                }
            }
            $vika = $rowv[id];
        }



        echo '<p style="display: hidden" id="bottom">bottom</p>';

        echo'</table>';


        echo' </div>';
    } else {
        echo'<br><br><em>Ei viestejä</em><br><br>';
    }
}
?>