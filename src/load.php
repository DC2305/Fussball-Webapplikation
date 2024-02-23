<?php

/**
 * Ereignis aus DB laden
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

$data = array();

$query = "SELECT * FROM kalender ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach ($result as $row) {
    $data[] = array(
        'id' => $row["id"],
        'title' => $row["titel"],
        'description' => $row['beschreibung'],
        'start' => $row["starten"],
        'end' => $row["enden"]
    );
}

echo json_encode($data);
