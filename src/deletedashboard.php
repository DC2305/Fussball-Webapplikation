<?php

/**
 * Testkalender
 *
 * PHP version 8.2.12
 *
 * @category Web-Applikation_Für_Fussballvereine
 *
 * @package Dashboard_Eintrag_Löschen
 *
 * @author David Cvetkovic <david.cvetkovic@sluz.ch>
 *
 * @license https://opensource.org/license/bsd-3-clause/ BSD-3-Clause
 *
 * @link http://localhost/Fussball-Webapplikation/src/
 */

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, 'fussball');

if (isset($_POST['deletedata'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM dashboard WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo '<script> alert("Daten gelöscht"); </script>';
        header("Location:dashboard.php");
    } else {
        echo '<script> alert("Daten nicht gelöscht"); </script>';
    }
}
