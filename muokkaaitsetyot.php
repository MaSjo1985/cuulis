<?php
session_start(); 


ob_start();

include("yhteys.php");

// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {


    if (isset($_POST["painiket"])) {

        $lista1 = $_POST["sisalto"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from itsetehtavat where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
            }
            if ($aihe == 0)
                $db->query("update itsetehtavat set sisalto='" . $lista1[$i] . "' where id = '" . $lista2[$i] . "'");
            else
                $db->query("update itsetehtavat set otsikko='" . $lista3[$i] . "' where id = '" . $lista2[$i] . "'");
        }
        header("location: itsetyot.php");
    }

    if (isset($_POST["painikep"])) {

        $lista1 = $_POST["sisalto"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];

        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from itsetehtavat where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
            }
            if ($aihe == 0)
                $db->query("update itsetehtavat set sisalto='" . $lista1[$i] . "' where id = '" . $lista2[$i] . "'");
            else
                $db->query("update itsetehtavat set otsikko='" . $lista3[$i] . "' where id = '" . $lista2[$i] . "'");
        }





        $lista = $_POST["lista"];

        foreach ($lista as $id) {

            $db->query("delete from itsetehtavat where id = '" . $id . "'");
            $db->query("delete from itsetehtavatkp where itsetehtavat_id = '" . $id . "'");
        }





        if (!$haevika = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
        }


        header("location: muokkaaitsetyot1.php?id=" . $_POST[ipid] . "&monesko=" . $_POST[monesko] . "#cm");
    }




    if (isset($_POST["painikelo"])) {

        $lista1 = $_POST["sisalto"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];


        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        for ($i = 0; $i < $maara; $i++) {
            if (!$haeaihe = $db->query("select distinct * from itsetehtavat where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
            }
            if ($aihe == 0)
                $db->query("update itsetehtavat set sisalto='" . $lista1[$i] . "' where id = '" . $lista2[$i] . "'");
            else
                $db->query("update itsetehtavat set otsikko='" . $lista3[$i] . "' where id = '" . $lista2[$i] . "'");
        }



        $db->query("insert into itsetehtavat (itseprojektit_id, aihe) values('" . $_POST[ipid] . "', 1)");

        if (!$haevika = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
        }



        header("location: muokkaaitsetyot1.php?id=" . $_POST[ipid] . "&monesko=" . $_POST[monesko] . "#cm");
    }
    if (isset($_POST["painikel"])) {

        $lista1 = $_POST["sisalto"];
        $lista2 = $_POST["id"];
        $lista3 = $_POST["otsikko"];


        $maara = 0;
        foreach ($lista2 as $id) {
            $maara++;
        }

        $lista2 = $_POST["id"];

        for ($i = 0; $i < $maara; $i++) {

            if (!$haeaihe = $db->query("select distinct * from itsetehtavat where id='" . $lista2[$i] . "'")) {
                die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
            }


            while ($rowP = $haeaihe->fetch_assoc()) {

                $aihe = $rowP[aihe];
            }
            if ($aihe == 0)
                $db->query("update itsetehtavat set sisalto='" . $lista1[$i] . "' where id = '" . $lista2[$i] . "'");
            else
                $db->query("update itsetehtavat set otsikko='" . $lista3[$i] . "' where id = '" . $lista2[$i] . "'");
        }

        $db->query("insert into itsetehtavat (itseprojektit_id) values('" . $_POST[ipid] . "')");

        if (!$haeuusin = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }

        while ($rowu = $haeuusin->fetch_assoc()) {
            $teid = $rowu[id];
        }

        if (!$haeopiskelijat = $db->query("select distinct * from opiskelijankurssit where itseprojekti_id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowo = $haeopiskelijat->fetch_assoc()) {
            $db->query("insert into itsetehtavatkp (itsetehtavat_id, kayttaja_id) values('" . $teid . "', '" . $rowo[opiskelija_id] . "')");
        }
        if (!$haevika = $db->query("select distinct * from itsetehtavat where itseprojektit_id='" . $_POST[ipid] . "'")) {
            die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
        }


        while ($rowP = $haevika->fetch_assoc()) {

            $id = $rowP[id];
        }


        header("location: muokkaaitsetyot1.php?id=" . $_POST[ipid] . "&monesko=" . $_POST[monesko] . "#cm");
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

