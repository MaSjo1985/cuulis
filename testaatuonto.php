<?php
session_start();
ob_start();
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!



if (!$haetyo = $db->query("select distinct sposti, id from kayttajat")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($rowa = $haetyo->fetch_assoc()) {

    $sposti = $rowa[sposti];
 $id = $rowa[id];


        $db->query("update kayttajat set spostiuusi='" . $sposti . "' where id = '" . $id . "'");
        
    
}
?>
</body>
</html>		
</html>	

