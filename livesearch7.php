<?php
session_start(); 


ob_start();



//if we got something through $_POST
if (isset($_POST['search'])) {
    // here you would normally include some database connection
    include('yhteys.php');

    // never trust what user wrote! We must ALWAYS sanitize user input
    $url = "kayttajatmuut.php";
    $hakusanamuu = mysqli_real_escape_string($db, $_POST['search']);
    $hakusanamuu = trim($hakusanamuu);

    $field40 = 'sukunimi';
    $sort40 = 'DESC';
    $nuoli40 = "&#8661";
    if (isset($_POST['sorting40'])) {

        if ($_POST['sorting40'] == 'ASC') {
            $sort40 = 'DESC';
        } else {
            $sort40 = 'ASC';
        }
    }
    if ($_POST['field40'] == 'sukunimi') {
        $field40 = "sukunimi";
    } elseif ($_POST['field40'] == 'etunimi') {
        $field40 = "etunimi";
    } elseif ($_POST['field40'] == 'sposti') {
        $field40 = "sposti";
    } elseif ($_POST['field40'] == 'Nimi') {
        $field40 = "Nimi";
    }





    if ($_SESSION["Rooli"] == 'admin') {
        $stmt = $db->prepare("SELECT DISTINCT etunimi, sukunimi, sposti, Nimi, kayttajat.id as kaid, paiva, kello FROM kayttajat, kayttajankoulut, koulut WHERE kayttajankoulut.odottaa=1 AND  kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id AND rooli='muu' AND kayttajat.tarkistettu=1 AND kayttajat.vahvistettu=1 AND (sposti like ? OR etunimi like ? OR sukunimi like ? OR Nimi like ? OR kokonimi like ?) ORDER BY $field40 $sort40");
        $stmt->bind_param("sssss", $s1, $s1, $s1, $s1, $s1);
        // prepare and bind
        $s1 = "%" . $hakusanamuu . "%";
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($c1, $c2, $c3, $c5, $c6, $c7, $c8);
    } else if ($_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {
        $stmt = $db->prepare("SELECT DISTINCT etunimi, sukunimi, sposti, Nimi, kayttajat.id as kaid, paiva, kello FROM kayttajat, kayttajankoulut, koulut WHERE koulut.id='" . $_SESSION["kouluId"] . "' AND kayttajankoulut.odottaa=1 AND  kayttajat.id=kayttajankoulut.kayttaja_id AND koulut.id=kayttajankoulut.koulu_id AND rooli='muu' AND kayttajat.tarkistettu=1 AND kayttajat.vahvistettu=1 AND (sposti like ? OR etunimi like ? OR sukunimi like ? OR Nimi like ? OR kokonimi like ?) ORDER BY $field40 $sort40");
        $stmt->bind_param("sssss", $s1, $s1, $s1, $s1, $s1);
        // prepare and bind
        $s1 = "%" . $hakusanamuu . "%";
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($c1, $c2, $c3, $c5, $c6, $c7, $c8);
    }


    if ($stmt->num_rows == 0)
        echo "<br><b>Ei hakutuloksia.</b><br>";

    else {

        if ($_SESSION["Rooli"] == 'admin') {




            echo'<form action="varmistuskayttajat10.php" method="post">';

            echo'<div class="cm8-responsive" id="piilota88" style="padding-top: 20px; padding-bottom: 0px; width: 100%">';
            echo'<b style="font-size: 1.2em; color: #2b6777; font-weight: bold;">Hakutulokset:</b><br><br>';

            echo '<table id="mytable88" class="cm8-striped cm8-uusitablekayttajat" style="table-layout:fixed; max-width: 100%; ">  <thead>';
            echo '<tr><th>Sukunimi</th><th>Etunimi</th><th>Käyttäjätunnus</th><th>Oppilaitos</th><th>Kirjautunut viimeksi</th><th>Valitse<br>&nbsp&#9661&nbsp</th><th>Lähetä viesti</th></tr></thead><tbody>';

            while ($stmt->fetch()) {
                $row10[etunimi] = $c1;
                $row10[sukunimi] = $c2;
                $row10[sposti] = $c3;

                $row10[Nimi] = $c5;
                $row10[kaid] = $c6;
                $row10[paiva] = $c7;
                $row10[kello] = $c8;
                if ($row10[paiva] != "0000-00-00" && $row10[paiva] !== null) {
                    $row10[paiva] = date("d.m.Y", strtotime($row10[paiva]));

                    $kirjautunut = $row10[paiva] . ' ' . $row10[kello];
                } else {
                    $kirjautunut = '';
                }
                echo '<tr><td><a href=kayttaja.php?url=' . $url . '&ka=' . $row10[kaid] . '>' . $row10[sukunimi] . '</a></td><td><a href=kayttaja.php?url=' . $url . '&ka=' . $row10[kaid] . '>' . $row10[etunimi] . "</a></td><td>" . $row10[sposti] . '</td><td>' . $row10[Nimi] . '</td><td>' . $kirjautunut . '</td><td style="padding-left: 10px"><input type="checkbox" name="lista10[]" value=' . $row10[kaid] . ' ></td><td><a href="viestikayttajalle.php?url=' . $url . '&id=' . $row10[kaid] . '" style="padding: 0px 4px; margin: 0" title="Lähetä viesti käyttäjälle">📧 &nbsp</a></td></tr>';
            }
            echo'<tr style="border-bottom: 3px solid transparent; "><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 15px"><button class="pieniroskis" title="Poista"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td></tr>';
            echo "</tbody></table>";
            echo'</form></div></div>';
        } else if ($_SESSION["Rooli"] == 'admink' || $_SESSION["Rooli"] == 'opeadmin') {




            echo'<form action="varmistuskayttajat10.php" method="post">';

            echo'<div class="cm8-responsive" id="piilota88" style="padding-top: 20px; padding-bottom: 0px; width: 100%">';
            echo'<b style="font-size: 1.2em; color: #2b6777; font-weight: bold;">Hakutulokset:</b><br><br>';
            echo '<table id="mytable88" class="cm8-striped cm8-uusitablekayttajat" style="table-layout:fixed; max-width: 100%; ">  <thead>';

            echo '<tr><th>Sukunimi</th><th>Etunimi</th><th>Käyttäjätunnus</th><th>Oppilaitos</th><th>Kirjautunut viimeksi</th><th>Valitse<br>&nbsp&#9661&nbsp</th><th>Lähetä viesti</th></tr></thead><tbody>';

            while ($stmt->fetch()) {
                $row10[etunimi] = $c1;
                $row10[sukunimi] = $c2;
                $row10[sposti] = $c3;

                $row10[Nimi] = $c5;
                $row10[kaid] = $c6;
                $row10[paiva] = $c7;
                $row10[kello] = $c8;
                if ($row10[paiva] != "0000-00-00" && $row10[paiva] !== null) {
                    $row10[paiva] = date("d.m.Y", strtotime($row10[paiva]));

                    $kirjautunut = $row10[paiva] . ' ' . $row10[kello];
                } else {
                    $kirjautunut = '';
                }
                echo '<tr><td><a href=kayttaja.php?url=' . $url . '&ka=' . $row10[kaid] . '>' . $row10[sukunimi] . '</a></td><td><a href=kayttaja.php?url=' . $url . '&ka=' . $row10[kaid] . '>' . $row10[etunimi] . "</a></td><td>" . $row10[sposti] . '</td><td>' . $row10[Nimi] . '</td><td>' . $kirjautunut . '</td><td style="padding-left: 10px"><input type="checkbox" name="lista10[]" value=' . $row10[kaid] . ' ></td><td><a href="viestikayttajalle.php?url=' . $url . '&id=' . $row10[kaid] . '" style="padding: 0px 4px; margin: 0" title="Lähetä viesti käyttäjälle">📧 &nbsp</a></td></tr>';
            }
            echo'<tr style="border-bottom: 3px solid transparent; "><td></td><td></td><td></td><td></td><td></td><td style="padding-top: 15px"><button class="pieniroskis" title="Poista"><i class="fa fa-trash-o" style="margin-right: 10px;"></i>Poista</button></td></tr>';
            echo "</tbody></table>";
            echo'</form></div></div>';
        }
    }
    $stmt->close();
}
?>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/tableHeadFixer.js"></script>
<script>
    //ilman tätä mikään muu ei toimi kuin scrolli


    $("#mytable88").tableHeadFixer({"head": false, "left": 1});

</script> 

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