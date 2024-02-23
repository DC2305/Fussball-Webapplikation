<?php

/**
 * Ereignis in DB hinzufügen
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

$connect = new PDO('mysql:host=localhost;dbname=fussball', 'root', '');

if (isset($_POST["title"])) {
    $query = "INSERT INTO kalender (titel, starten, enden) 
    VALUES (:titel, :starten, :enden)";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
        ':titel'  => $_POST['title'],
        ':starten' => $_POST['start'],
        ':enden' => $_POST['end']
        )
    );
}
