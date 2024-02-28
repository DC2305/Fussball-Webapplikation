<?php

/**
 * Eintrag aus Analysenseite löschen
 *
 * PHP version 8.2.12
 *
 * @category Web-Applikation_Für_Fussballvereine
 *
 * @package Analysen_Eintrag_Löschen
 *
 * @author David Cvetkovic <david.cvetkovic@sluz.ch>
 *
 * @license https://opensource.org/license/bsd-3-clause/ BSD-3-Clause
 *
 * @link http://localhost/Fussball-Webapplikation/src/
 */

require_once "config.php";

if (isset($_POST['deletedata'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM analysen WHERE id='$id'";
    $statement = $link->prepare($query);
    $query_run = mysqli_query($link, $query);
    $statement->execute();
    $statement->close();
    $link->close();

    if ($query_run) {
        echo '<script> alert("Daten gelöscht"); </script>';
        header("Location:analysen.php");
    } else {
        echo '<script> alert("Daten nicht gelöscht"); </script>';
    }
}
