<?php
session_start(); 



ob_start();



include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

$uusi = $_GET['uusi'];
$nimi = $_REQUEST['nimi'];
$id = $_REQUEST['id'];
$kuid = $_SESSION["KurssiId"];
$kaid = $_SESSION['Id'];
$uusi = nl2br($uusi);
$paiva = date("j.n.Y");
$kello = date("H:i");
$stmt = $db->prepare("INSERT INTO keskustelut (sisalto, kayttaja_id, kurssi_id, paiva, kello, nimi, kurssin_keskustelut_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siisssi", $sisalto, $kayttaja, $kurssi, $paiva2, $kello2, $nimi2, $id2);
// prepare and bind
$sisalto = $uusi;
$kayttaja = $kaid;
$kurssi = $kuid;
$paiva2 = $paiva;
$kello2 = $kello;
$nimi2 = $nimi;
$id2 = $id;
$stmt->execute();
$stmt->close();

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
            //ei itse tykkää
            if ($haetykkays->num_rows == 0) {

                // 1 tykkäys
                if ($yht == 1) {
                    echo'<tr id="' . $rowv[id] . '"><td style=" width: 85%; background-color: white">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br></td><td id="keskid" value="' . $rowv[id] . '" style="padding-right: 10px; background-color: white"><a onclick="myLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Tykkää"><img src="images/tykkays.jpg" style="height: 25px;"></a><br>';
                    foreach ($array as $nimet) {

                        echo'<em title="' . $nimet . ' tykkää tästä." id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäys)</em></td></tr>';
                    }
                }
                //monta tykkäystä
                else {
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
            }

            //tykkää itse
            else {

                // 1 tykkäys
                if ($yht == 1) {
                    echo'<tr id="' . $rowv[id] . '"><td style=" width: 85%; background-color: white">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br></td><td id="keskid" value="' . $rowv[id] . '" style="background-color: white; padding-right: 10px"><a onclick="myNouLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Peru tykkäys"><img src="images/tykatty.jpg" style="height: 30px;"></a><br>';

                    echo'<em title="Sinä tykkäät tästä" id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäys)</em></td></tr>';
                }
                //monta tykkäystä
                else {
                    echo'<tr id="' . $rowv[id] . '" ><td style=" width: 85%; background-color: white">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br></td><td id="keskid" value="' . $rowv[id] . '" style="padding-right: 10px; background-color: white"><a onclick="myNouLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Peru tykkäys"><img src="images/tykatty.jpg" style="height: 30px;"></a><br>';
                    echo'<em title="';
                    $tykmaara = 0;
                    $jaljella = $yht;
                    if ($yht != 0) {
                        foreach ($array as $nimet) {
                            $tykmaara++;
                            if ($jaljella == $yht && $nimet == $_SESSION[Etunimi] . ' ' . $_SESSION[Sukunimi]) {
                                echo'Sinä';
                            } else if ($jaljella != $yht && $nimet == $_SESSION[Etunimi] . ' ' . $_SESSION[Sukunimi]) {
                                echo'sinä';
                            } else {

                                echo $nimet;
                            }
                            if ($tykmaara == ($yht - 1)) {
                                echo' ja ';
                            } else if ($tykmaara < $yht) {
                                echo', ';
                            }

                            $jaljella--;
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
        echo'<br><br><p>Ei viestejä</p><br><br>';
    }
} else {

    if (!$haekeskustelu = $db->query("select distinct * from keskustelut where kurssin_keskustelut_id='" . $id . "' order by id desc")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }



    if ($haekeskustelu->num_rows != 0) {
        echo'<div class="cm8-responsive" >';

        echo'<form action="poistakeskustelutvarmistus.php" method="post"  style="margin-bottom: 0px;margin-right: 60px; display: inline-block">';
        echo'<button style="font-size: 0.7em" class="pieniroskis" title="Poista kaikki viestit"><i class="fa fa-trash-o" style="margin-right: 10px" ></i>Poista kaikki viestit</button>';
        echo'<input type="hidden" name="id" value=' . $id . '>';
        echo'</form>';
        
        echo'<br><br><table class="cm8-table5ope" style="background-color: white">';



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

            //ei itse tykkää
            if ($haetykkays->num_rows == 0) {

                // 1 tykkäys
                if ($yht == 1) {
                    echo'<tr id="' . $rowv[id] . '"><td style=" width: 85%; background-color: white"><a href="selvitakeskustelija.php?id=' . $id . '&kesid=' . $rowv[id] . '&kaid=' . $rowv[kayttaja_id] . '">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br></a></td><td id="keskid" value="' . $rowv[id] . '" style="padding-right: 10px; background-color: white"><a onclick="myLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Tykkää"><img src="images/tykkays.jpg" style="height: 25px;"></a><br>';
                    foreach ($array as $nimet) {

                        echo'<em title="' . $nimet . ' tykkää tästä." id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäys)</em></td></tr>';
                    
                         echo'<td><form action="poistakeskusteluviestiyksilollinen.php" method="get"  style="margin-bottom: 0px; display: inline-block">';
        echo'<button style="font-size: 0.9em" class="roskis" title="Poista viesti"><i class="fa fa-trash-o"></i></button>';
        echo'<input type="hidden" name="kesid" value=' . $rowv[id] . '>';
            echo'<input type="hidden" name="id" value=' . $id . '>';
        echo'</form></td><tr>';
                    }
                }
                //monta tykkäystä
                else {
                    echo'<tr id="' . $rowv[id] . '"><td style=" width: 85%; background-color: white"><a href="selvitakeskustelija.php?id=' . $id . '&kesid=' . $rowv[id] . '&kaid=' . $rowv[kayttaja_id] . '">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br></a></td><td id="keskid" value="' . $rowv[id] . '" style="padding-right: 10px; background-color: white"><a onclick="myLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Tykkää"><img src="images/tykkays.jpg" style="height: 25px;"></a><br>';
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
                    echo'" id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäystä)</em></td>';
                     echo'<td><form action="poistakeskusteluviestiyksilollinen.php" method="get"  style="margin-bottom: 0px; display: inline-block">';
        echo'<button style="font-size: 0.9em" class="roskis" title="Poista viesti"><i class="fa fa-trash-o"></i></button>';
        echo'<input type="hidden" name="kesid" value=' . $rowv[id] . '>';
            echo'<input type="hidden" name="id" value=' . $id . '>';
        echo'</form></td><tr>';
                }
            }

            //tykkää itse
            else {

                // 1 tykkäys
                if ($yht == 1) {
                    echo'<tr id="' . $rowv[id] . '"><td style=" width: 85%; background-color: white"><a href="selvitakeskustelija.php?id=' . $id . '&kesid=' . $rowv[id] . '&kaid=' . $rowv[kayttaja_id] . '">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br></a></td><td id="keskid" value="' . $rowv[id] . '" style="background-color: white; padding-right: 10px"><a onclick="myNouLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Peru tykkäys"><img src="images/tykatty.jpg" style="height: 30px;"></a><br>';

                    echo'<em title="Sinä tykkäät tästä" id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäys)</em></td>';
                     echo'<td><form action="poistakeskusteluviestiyksilollinen.php" method="get"  style="margin-bottom: 0px; display: inline-block">';
        echo'<button style="font-size: 0.9em" class="roskis" title="Poista viesti"><i class="fa fa-trash-o"></i></button>';
        echo'<input type="hidden" name="kesid" value=' . $rowv[id] . '>';
            echo'<input type="hidden" name="id" value=' . $id . '>';
        echo'</form></td><tr>';
                }
                //monta tykkäystä
                else {
                    echo'<tr id="' . $rowv[id] . '" ><td style=" width: 85%; background-color: white"><a href="selvitakeskustelija.php?id=' . $id . '&kesid=' . $rowv[id] . '&kaid=' . $rowv[kayttaja_id] . '">(' . $rowv[paiva] . ' ' . $rowv[kello] . ') ' . $rowv[nimi] . '  : <br><br> <b style="font-size: 1em">' . $rowv[sisalto] . '</b><br><br></a></td><td id="keskid" value="' . $rowv[id] . '" style="padding-right: 10px; background-color: white"><a onclick="myNouLikes(' . $rowv[id] . ')" href="javascript:void(0);" class="cm8-linkki" title="Peru tykkäys"><img src="images/tykatty.jpg" style="height: 30px;"></a><br>';
                    echo'<em title="';
                    $tykmaara = 0;
                    $jaljella = $yht;
                    if ($yht != 0) {
                        foreach ($array as $nimet) {
                            $tykmaara++;
                            if ($jaljella == $yht && $nimet == $_SESSION[Etunimi] . ' ' . $_SESSION[Sukunimi]) {
                                echo'Sinä';
                            } else if ($jaljella != $yht && $nimet == $_SESSION[Etunimi] . ' ' . $_SESSION[Sukunimi]) {
                                echo'sinä';
                            } else {

                                echo $nimet;
                            }
                            if ($tykmaara == ($yht - 1)) {
                                echo' ja ';
                            } else if ($tykmaara < $yht) {
                                echo', ';
                            }

                            $jaljella--;
                        }
                        echo' tykkäävät tästä.';

                        echo'"';
                    }
                    echo'" id="tykkays" style="font-size: 0.8em">(' . $yht . '&nbsptykkäystä)</em></td>';
                     echo'<td><form action="poistakeskusteluviestiyksilollinen.php" method="get"  style="margin-bottom: 0px; display: inline-block">';
        echo'<button style="font-size: 0.9em" class="roskis" title="Poista viesti"><i class="fa fa-trash-o"></i></button>';
        echo'<input type="hidden" name="kesid" value=' . $rowv[id] . '>';
            echo'<input type="hidden" name="id" value=' . $id . '>';
        echo'</form></td><tr>';
                }
            }
        }


        echo' </table>';
        echo'<br>';
        echo'<form action="poistakeskustelutvarmistus.php" method="post"  style="margin-bottom: 0px;margin-right: 60px; display: inline-block">';
        echo'<button style="font-size: 0.7em" class="pieniroskis" title="Poista kaikki viestit"><i class="fa fa-trash-o" style="margin-right: 10px" ></i>Poista kaikki viestit</button>';
        echo'<input type="hidden" name="id" value=' . $id . '>';
        echo'</form>';
       

        echo' </div>';
    } else {
        echo'<br><br><p>Ei viestejä</p><br><br>';
    }
}
//header("location: keskustelut.php?r=".$id);
?>