<?php

/**
 * Eintrag in Analysenseite aktualisieren
 *
 * PHP version 8.2.12
 *
 * @category Web-Applikation_Für_Fussballvereine
 *
 * @package Analysen_Aktualisieren
 *
 * @author David Cvetkovic <david.cvetkovic@sluz.ch>
 *
 * @license https://opensource.org/license/bsd-3-clause/ BSD-3-Clause
 *
 * @link http://localhost/Fussball-Webapplikation/src/
 */

require_once "config.php";

if (isset($_POST['updatedata'])) {
    $id = $_POST['update_id'];
    $team = $_POST['team'];
    $strengths = $_POST['strengths'];
    $weaknesses = $_POST['weaknesses'];

    $query = "UPDATE analysen 
    SET mannschaft='$team', stärken='$strengths', schwächen='$weaknesses'
    WHERE id='$id'  ";
    $statement = $link->prepare($query);
    $query_run = mysqli_query($link, $query);
    $statement->execute();
    $statement->close();
    $link->close();

    if ($query_run) {
        echo '<script> alert("Daten aktualisiert"); </script>';
        header("Location:analysen.php");
    } else {
        echo '<script> alert("Daten nicht aktualisiert"); </script>';
    }
}
