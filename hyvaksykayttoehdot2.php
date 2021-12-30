<?php
ob_start();
ob_start();
ob_start();
session_start();
echo'
<!DOCTYPE html>
<html>
<head>

<title> Kirjautuminen</title>';
if (isset($_SESSION[Id])) {
    include("yhteys.php");

    include("header.php");
    echo'<div class="cm8-container7">';
    echo'<div class="cm8-margin-bottom" style="padding-left: 20px">';
    echo'<div class="cm8-margin-top"></div>';


   $db->query("update kayttajat set kayttoehdot_hyvaksytty=1 where id='" . $_SESSION[Id] . "'");

             if (!empty($_GET[url]))
                header("location: kirjautuminenvali.php?url=" . $_POST[url]);
            else
               
            header("location: kirjautuminenvali.php");
       

    echo "</div>";
    echo "</div>";
    include("footer.php");
} else {

    header("location: kirjautuminenuusi.php");
}
?>

</body>
</html>	
