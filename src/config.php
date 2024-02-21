<?php

/**
 * DB-Konfiguration
 *
 * PHP version 8.2.12
 *
 * @category Web-Applikation_Für_Fussballvereine
 *
 * @package Datenbank
 *
 * @author David Cvetkovic <david.cvetkovic@sluz.ch>
 *
 * @license https://opensource.org/license/bsd-3-clause/ BSD-3-Clause
 *
 * @link http://localhost/Testkalender/
 */

$host     = 'localhost';
$username = 'root';
$password = '';
$dbname   = 'fussball';

// Mit Datenbank verbinden
$link = mysqli_connect($host, $username, $password, $dbname);

// Verbindung überprüfen
if ($link === false) {
    die("ERROR: Konnte nicht verbinden. " . mysqli_connect_error());
}