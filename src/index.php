<?php

/**
 * Testkalender
 *
 * PHP version 8.2.12
 *
 * @category Web-Applikation_Für_Fussballvereine
 *
 * @package Startseite
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
    <title>Kalender</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
</head>
<body>
    <div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
            <a href="index.php">Kalender</a>
            <hr>
            <a href="#">Dashboard</a>
            <hr>
            <a href="#">Analysen</a>
            <hr>
        </div>
    </div>
    <span style="font-size: 30px; cursor: pointer" onclick="openNav()">&#9776;</span>

    <script>
        // Menü öffnen
        function openNav() {
        document.getElementById("myNav").style.width = "100%";
        }

        // Menü schliessen
        function closeNav() {
        document.getElementById("myNav").style.width = "0%";
        }
    </script>

    <form action="logout.php" method="post">
        <input type="submit" value="Logout" class="topright"
        style="color: white; background-color: #2E9DE7; border-radius: 12px;">
    </form>
    <h2 style="text-align: center;">Testkalender</h2>
    <br />
    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h4 class="card-title">Planungs&shy;formular</h4>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_schedule.php" 
                            method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" 
                                    class="control-label">Titel</label>
                                    <input type="text" 
                                    class="form-control form-control-sm rounded-0" 
                                    name="title"
                                        id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" 
                                    class="control-label">Beschreibung</label>
                                    <textarea rows="3" 
                                    class="form-control form-control-sm rounded-0" 
                                    name="description"
                                        id="description" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" 
                                    class="control-label">Start</label>
                                    <input type="datetime-local" 
                                    class="form-control form-control-sm rounded-0"
                                        name="start_datetime" 
                                        id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" 
                                    class="control-label">Ende</label>
                                    <input type="datetime-local" 
                                    class="form-control form-control-sm rounded-0"
                                        name="end_datetime" 
                                        id="end_datetime" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" 
                            type="submit" form="schedule-form"><i
                                    class="fa fa-save"></i> Speichern</button>
                            <button class="btn btn-default border btn-sm rounded-0" 
                            type="reset" form="schedule-form"><i
                                    class="fa fa-reset"></i> Abbrechen</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" 
    data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h4 class="modal-title">Details</h4>
                    <button type="button" class="btn-close" 
                    onclick="$('#event-details-modal').modal('hide');"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <label for="title">Titel:</label>
                        <br>
                        <input type="text" id="title"></input>
                        <br>
                        <br>
                        <label for="description">Beschreibung:</label>
                        <br>
                        <input type="text" id="description"></input />
                        <br>
                        <br>
                        <label for="start">Start:</label>
                        <br>
                        <input type="text" id="start"></input />
                        <br>
                        <br>
                        <label for="end">Ende:</label>
                        <br>
                        <input type="text" id="end"></input />
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" 
                        class="btn btn-primary btn-sm rounded-0" id="edit"
                            data-id="">Bearbeiten
                        </button>
                        <button type="button" 
                        class="btn btn-danger btn-sm rounded-0" id="delete"
                            data-id="">Löschen
                        </button>
                        <button type="button" 
                        class="btn btn-secondary btn-sm rounded-0"
                            onclick="$('#event-details-modal').modal('hide');">
                            Schliessen
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>