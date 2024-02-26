<?php

/**
 * Testkalender
 *
 * PHP version 8.2.12
 *
 * @category Web-Applikation_Für_Fussballvereine
 *
 * @package Analysen
 *
 * @author David Cvetkovic <david.cvetkovic@sluz.ch>
 *
 * @license https://opensource.org/license/bsd-3-clause/ BSD-3-Clause
 *
 * @link http://localhost/Fussball-Webapplikation/src/
 */

// Session initialisieren
session_start();

// Überprüfen, ob der Benutzer angemldet ist, wenn nicht, zur Login-Seite weiterleiten
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/menu.js"></script>
</head>
<body>
    <div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
            <a href="index.php">Kalender</a>
            <hr>
            <a href="dashboard.php">Dashboard</a>
            <hr>
            <a href="analysen.php">Analysen</a>
            <hr>
        </div>
    </div>
    <span style="font-size: 30px; cursor: pointer" onclick="openNav()">&#9776;</span>

    <form action="logout.php" method="post">
        <input type="submit" value="Logout" class="topright"
        style="color: white; background-color: #2E9DE7; border-radius: 12px;">
    </form>
    <h1 style="text-align: center;">Analysen</h1>
</body>
</html>