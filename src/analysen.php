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

require_once "config.php";

if (isset($_POST['submit'])) {
    $name = $_POST["opponentanalysis"];
    $mannschaft = $_POST['mannschaft'];
    $stmt = $link->prepare("INSERT INTO analysen (analyse, mannschaftid) VALUES (?, ?)");
    $stmt->bind_param("si", $name, $mannschaft);
    $stmt->execute();
    $stmt->close();
    $link->close();
    header('Location: analysen.php');
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analysen</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
    <span style="font-size: 30px; cursor: pointer; color: #2E9DE7;" onclick="openNav()">&#9776;</span>

    <form action="logout.php" method="post">
        <input type="submit" value="Logout" class="topright"
        style="color: white; background-color: #2E9DE7; border-radius: 12px;">
    </form>
    <h1 style="text-align: center;">Analysen</h1>
    <div class="w3-container">
        <button onclick="document.getElementById('id01').style.display='block'" 
        class="w3-button w3-blue">Unsere Mannschaft</button>
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('id01').style.display='none'" 
                    class="w3-button w3-display-topright">&times;</span>
                    <br>
                    <form>
                        <center>Unsere Mannschaft</center>
                        <br>
                        <label>Analysen:</label>
                        <input type="text" name="weanalysis" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    &nbsp;
    <div class="w3-container">
        <button onclick="document.getElementById('id02').style.display='block'" 
        class="w3-button w3-blue">Gegnerische Mannschaften</button>
        <div id="id02" class="w3-modal">
            <div class="w3-modal-content">
                <div class="w3-container">
                    <span onclick="document.getElementById('id02').style.display='none'" 
                    class="w3-button w3-display-topright">&times;</span>
                    <br>
                    <form method="POST">
                        <center>Gegnerische Mannschaften</center>
                        <br>
                        <select name="mannschaft">
                            <?php
                            $team = mysqli_query($link, "SELECT * FROM mannschaften");
                            while ($c = mysqli_fetch_array($team)) {
                                ?>
                            <option value="<?php echo $c['id'] ?>"><?php echo $c['mannschaft'] ?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <br>
                        <label>Analysen:</label>
                        <br>
                        <textarea name="opponentanalysis" required></textarea>
                        <br>
                        <br>
                        <button type="submit" name="submit">Speichern</button>
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>