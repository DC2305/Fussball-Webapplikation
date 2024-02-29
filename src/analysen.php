<?php

/**
 * Analysen
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

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analysen</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <script src="../js/menu.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
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
     <!--Eintrag hinzufügen Modal-->
     <div class="modal fade" id="analysisaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eintrag hinzufügen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="insertanalysen.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Mannschaft:</label>
                            <input type="text" name="team" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Stärken:</label>
                            <textarea type="text" name="strengths" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Schwächen:</label>
                            <textarea type="text" name="weaknesses" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schliessen</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!--Bearbeiten Modal-->
     <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bearbeiten</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="updateanalysen.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="update_id" id="update_id">
                        <div class="form-group">
                            <label>Mannschaft:</label>
                            <input type="text" name="team" id="team" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Stärken:</label>
                            <textarea type="text" name="strengths" id="strengths" class="form-control" 
                            required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Schwächen:</label>
                            <textarea type="text" name="weaknesses" id="weaknesses" class="form-control" 
                            required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schliessen</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Löschen Modal-->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Löschen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="deleteanalysen.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="delete_id" id="delete_id">
                        <h4>Möchten Sie diesen Eintrag löschen?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nein</button>
                        <button type="submit" name="deletedata" class="btn btn-primary">Ja</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="jumbotron">
            <div class="card">
                <h2>Stärken und Schwächen</h2>
            </div>
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#analysisaddmodal">
                        Eintrag hinzufügen
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <?php
                    $query = "SELECT * FROM analysen";
                    $statement = $link->prepare($query);
                    $query_run = mysqli_query($link, $query);
                    $statement->execute();
                    $statement->close();
                    $link->close();
                    ?>
                    <table id="datatableid" class="table table-bordered table-light">
                        <thead>
                            <tr>
                                <th hidden scope="col">ID</th>
                                <th scope="col">Mannschaft</th>
                                <th hidden scope="col">Stärken</th>
                                <th hidden scope="col">Schwächen</th>
                                <th scope="col">Bearbeiten</th>
                                <th scope="col">Löschen</th>
                            </tr>
                        </thead>
                        <?php
                        if ($query_run) {
                            foreach ($query_run as $row) {
                                ?>
                        <tbody>
                            <tr>
                                <td hidden> <?php echo htmlspecialchars($row['id'], ENT_QUOTES, "UTF-8"); ?> </td>
                                <td> <?php echo htmlspecialchars($row['mannschaft'], ENT_QUOTES, "UTF-8"); ?> </td>
                                <td hidden> <?php echo htmlspecialchars($row['stärken'], ENT_QUOTES, "UTF-8"); ?> </td>
                                <td hidden> <?php echo htmlspecialchars($row['schwächen'], ENT_QUOTES, "UTF-8"); ?> 
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success editbtn">Bearbeiten</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger deletebtn">Löschen</button>
                                </td>
                            </tr>
                        </tbody>
                                <?php
                            }
                        } else {
                            echo "Kein Eintrag gefunden";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>
    <script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id').val(data[0]);
                $('#team').val(data[1]);
                $('#strengths').val(data[2]);
                $('#weaknesses').val(data[3]);
            });
        });
    </script>
</body>
</html>