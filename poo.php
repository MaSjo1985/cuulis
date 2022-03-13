<?php
session_start();

ob_start();



// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.

$uploaddir = '/var/www/uploads/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}

echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";



if (!$RTsuljettu = $db->query("select distinct sulkeutuu from itsearvioinnit where kurssi_id='" . $_SESSION[KurssiId] . "'")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($RTs = $RTsuljettu->fetch_assoc()) {
    $sulkeutuu = $RTsuljettu[sulkeutuu];
}

if (!empty($sulkeutuu) && $sulkeutuu != ' ') {
    $nyt = date("Y-m-d H:i");
    $sulkeutumispaiva = substr($sulkeutuu, 0, 10);
    $sulkeutumispaiva = date("d.m.Y", strtotime($sulkeutumispaiva));
    $sulkeutumiskello = substr($sulkeutuu, 11, 5);

    $takaraja = $sulkeutuu;


    if ($nyt <= $takaraja) {
        echo'<br>Itsearviointilomakkeen muokkaus sulkeutuu <b>' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
    } else {
        echo'<br><b style="color: #e608b8"> Itsearviointilomakkeen muokkaus on sulkeutunut ' . $sulkeutumispaiva . ' klo ' . $sulkeutumiskello . '</b>';
    }
} else {
    echo'<br>Itsearviointilomakkeen muokkaukselle ei ole asetettu takarajaa.';
}


echo'<form action="asetatakarajaitse.php" method="get" style="display: inline-block; margin-left: 20px"><input type="submit" name="painike" value="&#9998 Muokkaa" class="myButton8"  role="button"  style="padding:2px 4px"></form>';
?>