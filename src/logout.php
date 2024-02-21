<?php

/**
 * Logout
 *
 * PHP version 8.2.12
 *
 * @category Web-Applikation_Für_Fussballvereine
 *
 * @package Logout
 *
 * @author David Cvetkovic <david.cvetkovic@sluz.ch>
 *
 * @license https://opensource.org/license/bsd-3-clause/ BSD-3-Clause
 *
 * @link http://localhost/Testkalender/
 */

// Session initialisieren
session_start();

// Session-Variabeln ausschalten
$_SESSION = array();

// Session zerstören
session_destroy();

// Zur Login-Seite weiterleiten
header("location: login.php");
exit;