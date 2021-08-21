<?php
ob_start();
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


session_start(); // ready to go!



if (!$haetyo = $db->query("select distinct ryhmat2.projekti_id as pid, ryhmat2.ryhma_id as ryhmaid, ryhmat2.id as rid, opiskelijankurssit.opiskelija_id as opid from ryhmat2, opiskelijankurssit where opiskelijankurssit.ryhma_id = ryhmat2.ryhma_id")) {
    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="bugi.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
}

while ($rowa = $haetyo->fetch_assoc()) {

    $rid = $rowa[rid];
    $pid = $rowa[pid];
    $opid = $rowa[opid];


    $db->query("insert into opiskelijan_kurssityot (kayttaja_id, ryhmat2_id, projekti_id) values('" . $opid . "', '" . $rid . "', '" . $pid . "')");
}
?>
</body>
</html>		
</html>	

