<?php
session_start();
include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {




    $db->query("update itsetehtavat set otsikko='" . $_POST[otsikko] . "' where id = '" . $_POST[id] . "'");






    header("location: muokkaaitsetyot1.php?id=" . $_POST[ipid] . "&monesko=" . $_POST[monesko]);
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

