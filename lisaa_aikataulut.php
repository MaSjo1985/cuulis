<?php
session_start(); 


ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    if (isset($_POST["lisaa"])) {

        if (!empty($_POST[tehtmaara])) {

            $maara = $_POST[tehtmaara];

            while ($maara > 0) {

                if (!$haevika = $db->query("select distinct jarjestys from kurssiaikataulut where kurssi_id='" . $_POST[kurssi] . "'")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }


                while ($rowP = $haevika->fetch_assoc()) {

                    $uusijarjestys = $rowP[jarjestys] + 1;
                }



                $db->query("insert into kurssiaikataulut (kurssi_id, jarjestys) values('" . $_POST[kurssi] . "', '" . $uusijarjestys . "')");






                $maara--;
            }
        }



        header('location: muokkaa_aikataulu.php#tanne');
    }
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
</html>	
