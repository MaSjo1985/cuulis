<?php
session_start(); 


ob_start();


echo'<!DOCTYPE html>
<html>
 
<head>

<title> Muokkaa käyttäjän tietoja </title>';

include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!


if (isset($_SESSION["Kayttajatunnus"])) {

    include("header.php");
    include("header2.php");

    echo'<div class="cm8-container7">';

    include("opnavi.php");

    echo'<div class="cm8-margin-top" style="padding-left: 40px; padding-right: 20px">';
    echo'<div class="cm8-margin-top"></div>';


    if (empty($_POST["lista"])) {
        echo '<p style="font-weight: bold" >Et valinnut yhtään oppilaitosta!</p>';
        echo'<br><br><a href="muokkaakayttaja.php?id=' . $_POST["kaid"] . '" > <p style="font-size: 1em; display: inline-block; padding:0; margin: 0px 20px 0px 0px">&#8630</p> Palaa takaisin</a>';
    } else {

        $lista = $_POST["lista"];

        foreach ($lista as $tuote) {


            $db->query("insert into kayttajankoulut  (kayttaja_id, koulu_id, odottaa) values ('" . $_POST["kaid"] . "', '" . $tuote . "', 1)");

            if (!$result = $db->query("select distinct etunimi, sukunimi, sposti, rooli from kayttajat where id='" . $_POST[kaid] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }

            while ($row = $result->fetch_assoc()) {
                $sposti = $row[sposti];
                $etunimi = $row[etunimi];
                $sukunimi = $row[sukunimi];
                $rooli = $row[rooli];
            }




            if (!$result2 = $db->query("select Nimi from koulut where id='" . $tuote . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }
            while ($row2 = $result2->fetch_assoc()) {
                $koulu = $row2[Nimi];
                $headers .= "Organization: Cuulis-oppimisympäristö\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: Cuulis-oppimisympäristö <no-reply@cuulis.cm8solutions.fi>" . "\r\n";
                $headers .= "X-Priority: 3\r\n";
                $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";



                $otsikko = "Sinut on liitetty uuteen oppilaitokseen Cuulis-oppimisympäristössä";
                $otsikko = "=?UTF-8?B?" . base64_encode($otsikko) . "?=";

                $viesti = 'Sinut on liitetty Cuulis-oppimisympäristössä oppilaitokseen ' . $koulu . '.<br><br>Pääset Cuulis-oppimisympäristöön suoraan <a href="https://cuulis.cm8solutions.fi/">tästä.</a><br><br><em>Tähän viestiin ei voi vastata.</em>';
                $viesti = str_replace("\n.", "\n..", $viesti);

                $body = '<html><body>';


                $body .= '<p>' . $viesti . '</p>';
                $body .= "</body></html>";
                if($rooli=='opettaja'){
                    
                $varmistus = mail($sposti, $otsikko, $body, $headers);
                }
            }


            header('location: muokkaakayttaja.php?id=' . $_POST["kaid"]);
        }
    }

    echo'</div>';
    echo'</div>';

    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header("location: kirjautuminenuusi.php?url=" . $url);
exit();
}
?>
</body>
</html>			
