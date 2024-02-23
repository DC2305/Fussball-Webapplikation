<?php

/**
 * DB-Verbindung
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

$conn = new mysqli($host, $username, $password, $dbname);
if (!$conn) {
    die("Cannot connect to the database." . $conn->error);
}
