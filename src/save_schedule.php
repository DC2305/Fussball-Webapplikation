<?php

/**
 * Ereignis in DB speichern mithilfe vom Planungsformular
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

$host     = 'localhost';
$username = 'root';
$password = '';
$dbname   = 'fussball';
   
// Mit Datenbank verbinden
$link = mysqli_connect($host, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script>
                alert('Error: Keine Daten zum Speichern.'); location.replace('./')
          </script>";
    $link->close();
    exit;
}
extract($_POST);
$allday = isset($allday);
 
if (empty($id)) {
    $sql = "INSERT INTO `kalender` (`titel`,`beschreibung`,`starten`,`enden`) 
    VALUES ('$title','$description','$start_datetime', '$end_datetime')";
} else {
    $sql = "UPDATE `kalender` 
    set `titel` = '{$title}', 
    `beschreibung` = '{$description}', 
    `starten` = '{$start_datetime}', 
    `enden` = '{$end_datetime}' 
    where `id` = '{$id}'";
}
$save = $link->query($sql);
if ($save) {
    echo "<script>
                alert('Ereignis erfolgreich gespeichert.'); location.replace('./')
           </script>";
} else {
     echo "<pre>";
     echo "Ein Fehler ist aufgetreten.<br>";
     echo "Error: " . $link->error . "<br>";
     echo "SQL: " . $sql . "<br>";
     echo "</pre>";
}
$link->close();