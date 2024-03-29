<?php

/**
 * Eintrag in Dashboard einfügen
 *
 * PHP version 8.2.12
 *
 * @category Web-Applikation_Für_Fussballvereine
 *
 * @package Dashboard_Eintrag_Hinzufügen
 *
 * @author David Cvetkovic <david.cvetkovic@sluz.ch>
 *
 * @license https://opensource.org/license/bsd-3-clause/ BSD-3-Clause
 *
 * @link http://localhost/Fussball-Webapplikation/src/
 */

require_once "config.php";

if (isset($_POST['insertdata'])) {
    $hometeam = $_POST['hometeam'];
    $awayteam = $_POST['awayteam'];
    $homegoals = $_POST['homegoals'];
    $awaygoals = $_POST['awaygoals'];
    $notes = $_POST['notes'];

    $statement = $link->prepare(
        "INSERT INTO dashboard (`heimmannschaft`,`gastmannschaft`,`heimtore`,`gasttore`,`notizen`) 
        VALUES (?, ?, ?, ?, ?)"
    );
    $statement->bind_param("ssiis", $hometeam, $awayteam, $homegoals, $awaygoals, $notes);
    $statement->execute();
    $statement->close();
    $link->close();
    header('Location: dashboard.php');

    if ($query_run) {
        echo '<script> alert("Daten gespeichert"); </script>';
        header('Location: dashboard.php');
    } else {
        echo '<script> alert("Daten nicht gespeichert"); </script>';
    }
}
