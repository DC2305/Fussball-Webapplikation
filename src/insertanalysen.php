<?php

/**
 * Eintrag in Analysenseite einfügen
 *
 * PHP version 8.2.12
 *
 * @category Web-Applikation_Für_Fussballvereine
 *
 * @package Analysen_Eintrag_Hinzufügen
 *
 * @author David Cvetkovic <david.cvetkovic@sluz.ch>
 *
 * @license https://opensource.org/license/bsd-3-clause/ BSD-3-Clause
 *
 * @link http://localhost/Fussball-Webapplikation/src/
 */

require_once "config.php";

if (isset($_POST['insertdata'])) {
    $team = $_POST['team'];
    $strengths = $_POST['strengths'];
    $weaknesses = $_POST['weaknesses'];

    $statement = $link->prepare(
        "INSERT INTO analysen (`mannschaft`,`stärken`,`schwächen`) 
        VALUES (?, ?, ?)"
    );
    $statement->bind_param("sss", $team, $strengths, $weaknesses);
    $statement->execute();
    $statement->close();
    $link->close();
    header('Location: analysen.php');

    if ($query_run) {
        echo '<script> alert("Daten gespeichert"); </script>';
        header('Location: analysen.php');
    } else {
        echo '<script> alert("Daten nicht gespeichert"); </script>';
    }
}
