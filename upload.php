<?php
session_start();

// Paikkaillaan PHP:n vanhempien versioiden puutteita; nykyversioilla nämä eivät ole tarpeen.
defined("UPLOAD_ERR_OK") || define("UPLOAD_ERR_OK", 0);
defined("UPLOAD_ERR_INI_SIZE") || define("UPLOAD_ERR_INI_SIZE", 1);
defined("UPLOAD_ERR_FORM_SIZE") || define("UPLOAD_ERR_FORM_SIZE", 2);
defined("UPLOAD_ERR_PARTIAL") || define("UPLOAD_ERR_PARTIAL", 3);
defined("UPLOAD_ERR_NO_FILE") || define("UPLOAD_ERR_NO_FILE", 4);
defined("UPLOAD_ERR_NO_TMP_DIR") || define("UPLOAD_ERR_NO_TMP_DIR", 5);
defined("UPLOAD_ERR_CANT_WRITE") || define("UPLOAD_ERR_CANT_WRITE", 6);
defined("UPLOAD_ERR_EXTENSION") || define("UPLOAD_ERR_EXTENSION", 7);
if (!isset($_FILES) && isset($HTTP_POST_FILES)) {
    $_FILES = & $HTTP_POST_FILES;
}

// Tehdään vielä oma poikkeustyyppi virheitä varten.
class UploadException extends Exception {
    // Luokan vanha sisältö kelpaa meille.
}

/**
 * Tarkistaa, että tiedosto on edes yritetty lähettää.
 *
 * @param $input    input-tagin nimi
 * @return boolean  kertoo, onko tiedostoa lähetetty
 */
function upload_lahetetty($input) {
    if (empty($_FILES[$input]) || $_FILES[$input]["error"] == UPLOAD_ERR_NO_FILE) {
        return false;
    }
    return true;
}

/**
 * Tarkistaa, että tiedosto on lähetetty onnistuneesti.
 * Virhetilanteissa heitetään poikkeus (UploadException).
 *
 * @param $input        input-tagin nimi
 * @param $maksimikoko  suurin sallittu koko tavuina
 * @return string       palauttaa tiedoston alkuperäisen nimen
 */
function upload_tarkista($input, $maksimikoko = null) {

    // Tarkistetaan, että tiedosto on edes yritetty lähettää.
    if (empty($_FILES[$input])) {
        throw new UploadException("Tiedosto ei täytä ehtoja!");
    }

    // Tarkistetaan tiedoston koko.
    if ($maksimikoko !== null) {
        if ($_FILES[$input]["size"] > $maksimikoko) {
            $_FILES[$input]["error"] = UPLOAD_ERR_FORM_SIZE;
        }
    }

    // Tarkistetaan lähetyksen virhetilanteet.
    // HUOMIO: oikeassa käytössä erilaiset ilmoitukset kannattaisi välittää
    // eri luokissa, jotta esim. käyttäjän virhe (liian suuri tiedosto)
    // olisi mahdollista erottaa palvelimen virheestä (tila lopussa).
    switch ($_FILES[$input]["error"]) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new UploadException("Tiedosto on sallittua suurempi!");
        case UPLOAD_ERR_PARTIAL:
            throw new UploadException("Tiedoston 'lataus keskeytyi!");
        case UPLOAD_ERR_NO_FILE:
            throw new UploadException("Tiedosto puuttuu!");
        case UPLOAD_ERR_NO_TMP_DIR:
            throw new UploadException("Palvelimella ei ole paikkaa tiedostoille!");
        case UPLOAD_ERR_CANT_WRITE:
            throw new UploadException("Tiedoston tallentaminen palvelimelle ei onnistunut!");
        case UPLOAD_ERR_EXTENSION:
            throw new UploadException("Jokin PHP:n laajennos esti tiedoston latauksen!");
        default:
            throw new UploadException("Tuntematon virhe tiedoston latauksessa!");
    }
    if (!is_uploaded_file($_FILES[$input]["tmp_name"])) {
        throw new UploadException("PHP:n mukaan tiedoston tmp_name on viallinen!");
    }
    return basename($_FILES[$input]["name"]);
}

/**
 * Hakee lähetetyn tiedoston muistiin.
 *
 * @param $input  input-tagin nimi
 * @return array  palauttaa taulukossa tiedoston nimen ja sisällön
 */
function upload_hae($input) {
    $nimi = upload_tarkista($input);

    $data = @file_get_contents($_FILES[$input]["tmp_name"]);
    if ($data === false) {
        $virhe = error_get_last();
        throw new UploadException("Virhe tiedoston lukemisessa: {$virhe["message"]}!");
    }
    return array($nimi, $data);
}

/**
 * Tallentaa lähetetyn tiedoston haluttuun paikkaan.
 *
 * @param $input   input-tagin nimi
 * @param $kohde   uusi tiedostonimi
 * @return string  palauttaa tiedoston alkuperäisen nimen
 */
function upload_tallenna($input, $kohde) {
    $nimi = upload_tarkista($input);

    // Tarkistetaan kirjoitusoikeus.
    if (!is_writeable(dirname($kohde)) || (file_exists($kohde) && !is_writeable($kohde))) {
        throw new UploadException("Virhe tiedoston kopioinnissa, ei kirjoitusoikeutta!");
    }

    // Yritetään kopioida tiedosto paikalleen.
    if (!@move_uploaded_file($_FILES[$input]["tmp_name"], $kohde)) {
        $virhe = error_get_last();
        throw new UploadException("Virhe tiedoston kopioinnissa: {$virhe["message"]}!");
    }
    return $nimi;
}

/**
 * Tämä funktio tallentaa lähetetyn tiedoston sillä nimellä, jolla se lähetettiin.
 * TÄMÄ ON VAARALLISTA, koska tiedosto voi sisältää vaikka haitallista PHP-koodia.
 * ÄLÄ KOSKAAN käytä tätä toimintoa muualla kuin ehkä ylläpitäjän työkaluissa!
 *
 * @param $input      input-tagin nimi
 * @param $hakemisto  hakemisto, joka merkitään uuden nimen alkuun
 * @return string     palauttaa tiedoston alkuperäisen nimen
 */
function upload_tallenna_suoraan($input, $hakemisto = ".") {
    $nimi = upload_tarkista($input);
    return upload_tallenna($input, $hakemisto . "/" . $nimi);
}

/**
 * Tallentaa lähetetyn tiedoston hallitusti uudella nimellä,
 * joka muodostetaan alkuperäisestä nimestä ja satunnaisosasta.
 * Myös tiedostonimen pääte tarkistetaan.
 *
 * @param $input       input-tagin nimi
 * @param $hakemisto   hakemisto, joka merkitään uuden nimen alkuun
 * @param $paatteet    tiedoston sallitut päätteet
 * @param $turvapaate  tiedostolle laitettava pääte, jos vanha pääte ei ole sallittu
 * @return array       palauttaa taulukossa tiedoston vanhan ja uuden nimen
 */
function upload_tallenna_turvallinen($input, $hakemisto = ".", $paatteet = array(".txt", ".pdf", ".rar", ".zip", ".csv", ".odt", ".ods", ".odg", "odp", ".tnsp", ".tns", ".doc", ".docx", ".rtf", ".dat", ".pptx", ".ppt", ".xls", ".xlsx", ".TXT", ".PDF", ".DOC", ".DOCX", ".RTF", ".DAT", ".PPTX", ".PPT", ".XLS", ".XLSX")
, $turvapaate = false) {

    $nimi = upload_tarkista($input);

    // Katsotaan, onko annetussa taulukossa tiedoston pääte.
    // Jos ei ole, käytetään annettua päätettä ($turvapaate).
    if (is_array($paatteet))
        foreach ($paatteet as $paate) {
            if (substr($nimi, -strlen($paate)) == $paate) {
                $turvapaate = $paate;
                break;
            }
        }

    // Jos $turvapaate puuttuu (eikä muuta löytynyt taulukosta), hylätään tiedosto.

    if ($turvapaate === false) {
        throw new UploadException("Tiedostomuoto ei kelpaa! <br><br>Sallittuja tiedostopäätteitä ovat .txt, .pdf, .rar, .zip, .tnsp, .tns, .csv, .odt, .ods, .odp., .odg, .doc, .docx, .rtf, .dat, .pptx, .ppt, .xls, .xlsx");
    }

    // preserve file from temporary directory
//    $success = move_uploaded_file($myFile["tmp_name"],
//        UPLOAD_DIR . $name);
//    if (!$success) { 
//        echo "<p>Unable to save file.</p>";
//        exit;
//    }
    // set proper permissions on the new file
//    chmod(UPLOAD_DIR . $name, 0644);
//    
    // Luodaan tiedostolle turvallinen nimi ja tallennetaan tiedosto.
    $nimi2 = preg_replace("/[^A-Z0-9._-]/i", "_", $nimi);



    if (strlen($turvapaate) && substr($nimi2, -strlen($turvapaate)) !== $paate) {
        $nimi2 .= $paate;
    }

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($nimi2);
    $kohde = $hakemisto . "/" . $nimi2;
    while (file_exists($kohde)) {
        $i++;
        $nimi2 = $parts["filename"] . "(" . $i . ")." . $parts["extension"];
        $kohde = $hakemisto . "/" . $nimi2;
    }


    while (true) {
        $kohde = $hakemisto . "/" . $nimi2;
        if (!file_exists($kohde)) {
            upload_tallenna($input, $kohde);
            return array($nimi, $kohde);
        }
    }
}

?>