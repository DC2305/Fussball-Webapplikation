<?php

/**
 * Eintrag auf Dashbaord aktualisieren
 *
 * PHP version 8.2.12
 *
 * @category Web-Applikation_Für_Fussballvereine
 *
 * @package Dashboard_Aktualisieren
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
        $hometeam = $_POST['hometeam'];
        $awayteam = $_POST['awayteam'];
        $homegoals = $_POST['homegoals'];
        $awaygoals = $_POST['awaygoals'];
        $notes = $_POST['notes'];

        $query = "UPDATE dashboard 
        SET heimmannschaft='$hometeam', gastmannschaft='$awayteam', heimtore='$homegoals', 
        gasttore='$awaygoals', notizen = '$notes'
        WHERE id='$id'  ";
        $statement = $link->prepare($query);
        $query_run = mysqli_query($link, $query);
        $statement->execute();
        $statement->close();
        $link->close();

    if ($query_run) {
        echo '<script> alert("Daten aktualisiert"); </script>';
        header("Location:dashboard.php");
    } else {
        echo '<script> alert("Daten nicht aktualisiert"); </script>';
    }
}
