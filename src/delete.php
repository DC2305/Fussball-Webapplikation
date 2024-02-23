<?php

/**
 * Ereignis aus DB löschen
 *
 * PHP version 8.2.12
 *
 * @category Web-Applikation_Für_Fussballvereine
 *
 * @package FullCalendar
 *
 * @author David Cvetkovic <david.cvetkovic@sluz.ch>
 *
 * @license https://opensource.org/license/bsd-3-clause/ BSD-3-Clause
 *
 * @link http://localhost/Fussball-Webapplikation/src/
 */

if (isset($_POST["id"])) {
    $connect = new PDO('mysql:host=localhost;dbname=fussball', 'root', '');
    $query = "DELETE from kalender WHERE id=:id";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
        ':id' => $_POST['id']
        )
    );
}