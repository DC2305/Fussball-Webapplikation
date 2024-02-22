<?php

/**
 * Ereignis in DB aktualisieren
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

//update.php

$host     = 'localhost';
$username = 'root';
$password = '';
$dbname   = 'fussball';
 
// Mit Datenbank verbinden
$link = mysqli_connect($host, $username, $password, $dbname);

if (isset($_POST["id"])) {
    $query = "UPDATE kalender SET titel=:titel, 
    beschreibung=:beschreibung, 
    starten=:starten, 
    enden=:enden 
    WHERE id=:id";
    $statement = $link->prepare($query);
    $statement->execute(
        array(
        ':titel'  => $_POST['title'],
        ':beschreibung'  => $_POST['description'],
        ':starten' => $_POST['start'],
        ':enden' => $_POST['end'],
        ':id'   => $_POST['id']
        )
    );
}