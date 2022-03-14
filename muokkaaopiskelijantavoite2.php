<?php
session_start(); 


ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    if (isset($_POST["painiket"])) {

        $ipid = $_POST["ipid"];
        $kaid = $_POST["kaid"];
        $prostavoite = $_POST["prostavoite"];
        if (!$onkoprojekti = $db->query("select distinct * from opiskelijantavoite where itseprojektit_id='" . $_POST[ipid] . "' AND kayttajat_id='" . $_POST[kaid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        if ($onkoprojekti->num_rows != 0) {
            $stmt = $db->prepare("UPDATE opiskelijantavoite SET prostavoite=? WHERE itseprojektit_id=? AND kayttajat_id=?");
        } else {
            $stmt = $db->prepare("INSERT INTO opiskelijantavoite (prostavoite, itseprojektit_id, kayttajat_id) VALUES (?, ?, ?)");
        }



        $stmt->bind_param("iii", $pros, $ipid2, $kaid2);

        $pros = $prostavoite;
        $ipid2 = $ipid;
        $kaid2 = $kaid;

        $stmt->execute();


        $stmt->close();
    } else if (isset($_POST["painikep"])) {

        $db->query("delete from opiskelijantavoite where itseprojektit_id = '" . $_POST[ipid] . "' AND kayttajat_id='" . $_SESSION[Id] . "'");
    }


    header("location: itsetyot.php?i=" . $_POST[ipid] . "#palaa");
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

