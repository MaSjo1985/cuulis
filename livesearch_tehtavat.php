<?php
session_start(); 


ob_start();


//if we got something through $_POST

if (isset($_POST['search'])) {
    // here you would normally include some database connection
    include('yhteys.php');

    // never trust what user wrote! We must ALWAYS sanitize user input


    $hakusanaop = mysqli_real_escape_string($db, $_POST['search']);
    $hakusanaop = trim($hakusanaop);

    $ipid = $_POST['ipid'];



    $stmt = $db->prepare("SELECT DISTINCT lukuvuosi, alkupvm, loppupvm, kurssit.id as kid, kayttajat.id as kaid, koulut.id as koid, kurssit.nimi as nimi, luomispvm, koulut.Nimi as Nimi, koodi, etunimi, sukunimi from kurssit, koulut, kayttajat, kayttajankoulut, opiskelijankurssit WHERE ((opiskelijankurssit.opiskelija_id='" . $_SESSION["Id"] . "' AND opiskelijankurssit.kurssi_id=kurssit.id) OR (kurssit.opettaja_id='" . $_SESSION["Id"] . "')) AND (kayttajat.id='" . $_SESSION["Id"] . "' AND kayttajankoulut.odottaa=1 AND kayttajankoulut.koulu_id=koulut.id AND kayttajankoulut.kayttaja_id=kayttajat.id AND kurssit.koulu_id=koulut.id)  AND (kurssit.nimi like ? OR koodi like ?) ORDER BY alkupvm DESC ");


    $stmt->bind_param("ss", $s1, $s1);

    // prepare and bind
    $s1 = "%" . $hakusanaop . "%";
    $stmt->execute();

    $stmt->store_result();

    $stmt->bind_result($c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8, $c9, $c10, $c11, $c12);


    if ($stmt->num_rows == 0)
        echo "<br><b>Ei hakutuloksia.</b><br>";

    else {

    echo'<br><b style="color: #e608b8" >Klikkaa sen kurssin/opintojakson nimeä, jonka tehtäviä haluat tuoda.</b><br><br>';

        echo'<div class="cm8-responsive" id="piilota88" style="padding-top: 20px; padding-bottom: 10px; width: 100%" >';

        echo '<table id="mytable88" class="cm8-table cm8-bordered cm8-stripedeivikaa" style="width: 99%"><thead>';

        echo '<tr><th>Koodi</th><th>Kurssi/Opintojakso</th><th>Vastuuopettaja</th><th>Oppilaitos</th><th>Lukuvuosi</th><th>Alkaa</th><th>Päättyy</th></tr>';
        echo '</thead>';


        while ($stmt->fetch()) {
            $row[lukuvuosi] = $c1;
            $row[alkupvm] = $c2;
            $row[loppupvm] = $c3;
            $row[kid] = $c4;
            $row[kaid] = $c5;
            $row[koid] = $c6;
            $row[nimi] = $c7;
            $row[luomispvm] = $c8;
            $row[Nimi] = $c9;
            $row[koodi] = $c10;
            $row[etunimi] = $c11;
            $row[sukunimi] = $c12;
            $row[alkupvm] = date("d.m.Y", strtotime($row[alkupvm]));
            $row[loppupvm] = date("d.m.Y", strtotime($row[loppupvm]));
      if (!$resulthaeope = $db->query("select distinct etunimi, sukunimi from kayttajat, kurssit where kurssit.id='" . $row[kid] . "' AND kayttajat.id=kurssit.opettaja_id")) {
                    die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
                }
                while ($rowope = $resulthaeope->fetch_assoc()) {
                    $etunimi = $rowope[etunimi];
                    $sukunimi = $rowope[sukunimi];
                }
            echo '<tr><td><a href="tuotehtavat3.php?id=' . $row[kid] . '&ipid=' . $ipid . '&monesko=' . $_GET[monesko] . '">' . $row[koodi] . '</a></td><td><a href="tuotehtavat3.php?id=' . $row[kid] . '&ipid=' . $ipid . '&monesko=' . $_GET[monesko] . '">' . $row[nimi] . '</a></td><td>' . $etunimi . ' ' . $sukunimi . '</td><td>' . $row[Nimi] . '</td><td>' . $row[lukuvuosi] . '</td><td>' . $row[alkupvm] . '</td><td>' . $row[loppupvm] . '</td></tr>';
        }
        echo "</table>";
        echo "</div>";
        echo "<br>";
        echo "<br>";
    }



    $stmt->close();
} else {
    
}
?>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/tableHeadFixer.js"></script>
<script>
    //ilman tätä mikään muu ei toimi kuin scrolli


    $("#mytable88").tableHeadFixer({"head": false, "left": 1});

</script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/floatthead/1.2.10/jquery.floatThead-slim.min.js"></script>
<script>

    var $table88 = j('#mytable88');
    $table88.floatThead({zIndex: 1});

</script> 
<script>


    $("#scrollbar").on("scroll", function () {


        var container88 = $("#piilota88");
        var scrollbar = $("#scrollbar");


        ScrollUpdate(container88, scrollbar);
    });


    function ScrollUpdate(content, scrollbar) {

        $("#spacer").css({"width": "1000px"}); // set the spacer width'
        // set the spacer width
        scrollbar.width = content.width() + "px";
        content.scrollLeft(scrollbar.scrollLeft());
    }

    ScrollUpdate($("#piilota88"), $("#scrollbar"));
</script>