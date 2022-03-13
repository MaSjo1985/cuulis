<?php
session_start(); 



ob_start();




echo'<script src="basic-javascript-functions.js" language="javascript" type="text/javascript"></script><script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script src="js/jquery-2.1.3.js"></script>
<script src="js/tableHeadFixer.js"></script>
<script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="https://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>


<script type="text/javascript" src="js/TimeCircles.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
<script src="jquery.ui.touch-punch.min.js"></script>';



$url = $_SERVER[REQUEST_URI];
$url = substr($url, 1);
echo'<div class="cm8-container" style="margin-top: 10px; margin-bottom: 0px; padding-top: 20px; padding-bottom: 0px">';
if (!$tulosP = $db->query("select distinct * from kurssit where id='" . $_SESSION["KurssiId"] . "' AND opettaja_id='" . $_SESSION["Id"] . "'")) {
    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
}
if (!$onkoadmin = $db->query("select distinct * from kayttajat where id='" . $_SESSION["Id"] . "' AND rooli='admin'")) {
    die('Tietokantahaussa ilmeni ongelmia [' . $db->error . ']');
}

if ($tulosP->num_rows != 0 || $onkoadmin->num_rows == 1) {

    if (($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') && $_SESSION["vaihto"] == 0) {

        echo'<div class="cm8-quarter"><br></div><div class="cm8-quarter">';
        echo'<form action="vaihda.php" method="post" style="display: inline-block"><input type="hidden" name="url" value="' . $url . '" ><input type="hidden" name="arvo" value="vaihda"> <input type="submit" value="Opiskelijanäkymä" class="munNappula2"  role="button"></form>';
        echo'</div><div class="cm8-quarter"><br></div><div class="cm8-quarter">';
    } else if ($_SESSION["Rooli"] == 'opiskelija' && $_SESSION["vaihto"] == 1) {
        echo'<div class="cm8-quarter"><br></div><div class="cm8-quarter">';
        echo'<form action="vaihda.php" method="post" style="display: inline-block"><input type="hidden" name="url" value="' . $url . '" ><input type="hidden" name="arvo" value="pois"> <input type="submit" value="Poistu opiskelijanäkymästä" class="munNappula2"  role="button"></form>';
        echo'</div><div class="cm8-quarter"><br></div><div class="cm8-quarter">';
    }
} else {

    echo'<div class="cm8-quarter"><br></div><div class="cm8-quarter"><br></div><div class="cm8-quarter"><br></div><div class="cm8-quarter">';
}

echo'<a href="sulje_kurssisivu.php"  class="munNappula" role="button"  title="Sulje kurssisivu">&#10005 &nbsp Sulje kurssisivu </a>';

echo'</div></div>';

echo'<div class="cm8-container4" style="padding-top: 0px; margin-top: 0px; padding-bottom: 10px; margin-bottom: 0px"><br>';
if (!$result8 = $db->query("select distinct * from koulut where id='" . $_SESSION["kouluId"] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($row8 = $result8->fetch_assoc()) {
    echo '<div class="cm8-quarter"><img src="/' . $row8[kuva] . '" style="max-height: 30%; max-width: 30% "></div>';


    if ($_SESSION["Rooli"] == 'opettaja' || $_SESSION["Rooli"] == 'admin' || $_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin' || $_SESSION["Rooli"] == 'opiskelija') {

        if ($_SESSION["Sallicd"] == 1) {
            echo'<div class="cm8-quarter" style="text-align: center;"><H2 style="padding-top: 10px; font-size: 1.4em; color: #2b6777;">' . $_SESSION["Koodi"] . ' ' . $_SESSION["KurssiNimi"] . '<br> <b style="font-size: 0.8em">(lv ' . $_SESSION["Lukuvuosi"] . ')</b></H2><br>';
            $originalDate = $_SESSION["Koepvm"];
            $kello = $_SESSION["Koeaika"];

            $newDate = date("Y-m-d", strtotime($originalDate));
            $koe = $newDate . ' ' . $kello;
            $nyt = date("Y-m-d H:i");

            if (date("Y-m-d H:i") > $koe) {

                echo' <em style="font-size: 0.8em"> (Kurssikoe on pidetty.)</em>';
            } else {
                echo'<div class="demo" data-date="' . $newDate . ' ' . $kello . '" style="height: 10%; text-align: center; display: inline-block "> </div>';
                echo'<script language="javascript" type="text/javascript">
	count();
</script>';
                echo' <br><em style="font-size: 0.8em"> (aikaa jäljellä kokeeseen)</em>';
            }
        } else {
            echo'<div class="cm8-quarter" style="text-align: center;"><H2 style="padding-top: 60px; font-size: 1.4em; color: #2b6777;">' . $_SESSION["Koodi"] . ' ' . $_SESSION["KurssiNimi"] . '<br> <b style="font-size: 0.8em">(lv ' . $_SESSION["Lukuvuosi"] . ')</b></H2><br>';
        }
    }

    echo'</div><div class="cm8-quarter" style="width: 5%; padding-right: 80px"><br></div><div class="cm8-quarter" style=" max-width: 60%;"><br><a href="https://koulusafka.fi" target="_blank" onclick="koulusafka()"> <img src="/images/koulusafka.jpg" style=" max-width: 80%;"></a><br></div></div>';
}
