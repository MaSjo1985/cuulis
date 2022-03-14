<?php
session_start();
ob_start();
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    if (isset($_POST["painiket"])) {

        if (!$projekti = $db->query("select * from itseprojektit where id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        if ($projekti->num_rows != 0) {

            $stmt = $db->prepare("UPDATE itseprojektit SET lisa=? WHERE id=?");
            $stmt->bind_param("si", $lisa, $id);
            // prepare and bind

            $lisa = $_POST[lisa];
            $id = $_POST[ipid];
            $stmt->execute();
            $stmt->close();






            $kommentit = $_POST["kommenttiop"];
            $idt = $_POST["id"];
            $maara = 0;
            foreach ($idt as $kpid) {
                $maara++;
            }
            $idt = $_POST["id"];
            $stmt2 = $db->prepare("UPDATE itsetehtavatkp SET lisa=? WHERE kayttaja_id=?");
            $stmt2->bind_param("si", $lisa2, $kayttaja);

            for ($i = 0; $i < $maara; $i++) {

                $kommentti = $kommentit[$i];
                $kommentti = nl2br($kommentti);
                $lisa2 = $kommentti;
                $kayttaja = $idt[$i];
                $stmt2->execute();
            }
            $stmt2->close();
        }
    }

    header('location: ykskohdat2.php?id=' . $_POST[ipid] . '&tid=' . $_POST[tid] . '#palaa');
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

