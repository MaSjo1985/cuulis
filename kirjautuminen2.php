<?php
session_start(); 



ob_start();
echo'
<!DOCTYPE html>

<html>
 
<head>


<title>Cuulis - Kirjautuminen</title>';

include("yhteys.php");
// server should keep session data for AT LEAST 1 hour
// each client should remember their session id for EXACTLY 1 hour


 // ready to go!

if (isset($_SESSION["Kayttajatunnus"])) {

    //tarkistetaan roolit. opiskelija ei voi olla muussa roolissa!!

    include("header.php");

    echo '<div class="cm8-container2" style="padding-bottom: 40px; padding-top: 20px; font-size: 1.1em">';

    if (!$result = $db->query("select distinct * from koulunadminit where kayttaja_id='" . $_SESSION["Id"] . "'")) {
        die('<br><br><b style="font-size: 1em; color: #FF0000">Tietokantayhteydessä ongelmia!<br><br> Ota yhteyttä oppimisympäristön ylläpitäjään <a href="yhteydenotto.php" style="text-decoration: underline"><u>tästä.</b></u><br><br></div></div></div></div><footer class="cm8-containerFooter" style="padding: 20px 0px 20px 0px"><b>Copyright &copy;  <br><a href="admininfo.php">Marianne Sjöberg</b></a></footer>');
    }

    //ei merkitty ylläpitäjäksi mihinkään oppilaitokseen
    if ($result->num_rows == 0) {

        if (isset($_GET[url])) {

            if ($_GET[url] == 'etusivu.php' || $_GET[url] == 'kirjautuminenuusi.php') {
                if ($_SESSION["Rooli"] == "admin")
                    header('location: admin.php');

                else if ($_SESSION["Rooli"] == 'opettaja')
                    header('location: omatkurssit.php');

                else if ($_SESSION["Rooli"] == 'opiskelija')
                    header('location: omatkurssit.php');

                else if ($_SESSION["Rooli"] == 'muu')
                    header("location: muu.php");
            }
            else {
                header('location: ' . $_GET[url]);
            }
        } else {
            if ($_SESSION["Rooli"] == "admin")
                header('location: admin.php');

            else if ($_SESSION["Rooli"] == 'opettaja')
                header('location: omatkurssit.php');

            else if ($_SESSION["Rooli"] == 'opiskelija')
                header('location: omatkurssit.php');

            else if ($_SESSION["Rooli"] == 'muu')
                header('location: muu.php');
        }
    }

    else {

        // vain yhden koulun ylläpitäjä

        if ($result->num_rows == 1 && ($_SESSION["Rooli"] <> 'admin')) {

            while ($row = $result->fetch_assoc()) {
                $kouluid = $row[koulu_id];
            }

            if (isset($_GET[url])) {

                if ($_SESSION["Rooli"] == 'opettaja') {
                    //merkitään opettaja yhteisrooliin
                    $_SESSION["Rooli"] = 'opeadmin';
                    $_SESSION["kouluId"] = $kouluid;
                    if ($_GET[url] == 'etusivu.php' || $_GET[url] == 'kirjautuminenuusi.php') {

                        header('location: omatkurssit.php');
                    } else
                        header("location: " . $_GET[url]);
                } else if ($_SESSION["Rooli"] == 'muu') {
                    //merkitään muu-käyttäjä pelkäksi ylläpitäjäksi
                    $_SESSION["kouluId"] = $kouluid;
                    $_SESSION["Rooli"] = 'admink';
                    header('location: ' . $_GET[url]);
                }
                else{
                     header('location: omatkurssit.php');
                }
            } else {
                if ($_SESSION["Rooli"] == 'opettaja') {
                   
                    //merkitään opettaja yhteisrooliin
                    $_SESSION["Rooli"] = 'opeadmin';
                    $_SESSION["kouluId"] = $kouluid;
                  
                    header('location: omatkurssit.php');
                } else if ($_SESSION["Rooli"] == 'muu') {
                    //merkitään muu-käyttäjä pelkäksi ylläpitäjäksi
                    $_SESSION["kouluId"] = $kouluid;
                    $_SESSION["Rooli"] = 'admink';
                    header('location: admink.php');
                }
                else{
                     header('location: omatkurssit.php');
                }
            }
        }
        //useamman koulun ylläpitäjä		
        else if ($result->num_rows > 1) {

//                    if($_SESSION["Rooli"]=='opettaja')
//                    {
//                           $_SESSION["Rooli"]='opeadmin';
//                    }	
//                    else if($_SESSION["Rooli"]=='muu')
//                    {
//                          $_SESSION["Rooli"]='admink';
//                    }    
            if (isset($_GET[url])) {
                header('location: kirjautuminen3.php?url=' . $_GET[url]);
            } else {
                header('location: kirjautuminen3.php');
            }

//			if($_SESSION["Rooli"]=='opettaja' || $_SESSION["Rooli"]=='opiskelija')
//			{
//				echo'<br>Sinut on kirjattu oppimisympäristöön useassa eri roolissa.<br><br><b>Valitse, miten haluat kirjautua oppimisympäristöön:</b><br><br><br>';
//				
//				echo'<a href="kirjautuminen3.php" class="myButton8"  role="button"  style="margin-right: 30px">Ylläpitäjä</a>';
//
//				if($_SESSION["Rooli"]=='opettaja')
//					echo'<a href="opettaja.php" class="myButton8"  role="button" >Opettaja</a>';
//
//				else if ($_SESSION["Rooli"]=='opiskelija')
//					echo'<a href="opiskelija.php" class="myButton8"  role="button" >Opiskelija</a>';
//			}
//			else
        }
    }

    echo"</div>";
    include("footer.php");
} else {
    $url = $_SERVER[REQUEST_URI];
    $url = substr($url, 1);
    $url = strtok($url, '?');
    header('location: kirjautuminenuusi.php?url=' . $url);
}
?>

</body>
</html>	