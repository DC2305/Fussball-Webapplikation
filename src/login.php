<?php

/**
 * Login
 *
 * PHP version 8.2.12
 *
 * @category Webapplikation_Für_Fussballvereine
 *
 * @package Login
 *
 * @author David Cvetkovic <david.cvetkovic@sluz.ch>
 *
 * @license https://opensource.org/license/bsd-3-clause/ BSD-3-Clause
 *
 * @link http://localhost/Testkalender/
 */

// Session initialisieren
session_start();

// Überprüfen, ob der Benutzer angemeldet ist, wenn ja, dann zur index-Seite weiterleiten
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

require_once "config.php";

// Variabeln definieren und mit leeren Werten initialisieren
$username = $password = "";
$username_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Überprüfen, ob Benutzername leer ist
    if (empty(trim($_POST["username"]))) {
        $username_err = "Bitte Benutzernamen eingeben.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Überprüfen, ob Passwort leer ist
    if (empty(trim($_POST["password"]))) {
        $password_err = "Bitte Passwort eingeben.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Anmeldeinformationen validieren
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, benutzername, passwort FROM benutzer 
        WHERE benutzername = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Variabeln als Parameter an die vorbereitete Anweisung binden
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Parameter
            $param_username = $username;

            // Anweisung ausführen
            if (mysqli_stmt_execute($stmt)) {
                // Ergebnis speichern
                mysqli_stmt_store_result($stmt);

                // Überprüfen, ob Benutzername existiert, wenn ja, Passwort bestätigen
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Ergebnisvariabeln binden
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Passwort ist korrekt, neue Sessions starten
                            session_start();

                            // Daten in Session-Variabeln speichern
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Benutzer an index-Seite weiterleiten
                            header("location: index.php");
                        } else {
                            // Passwort ist nicht korrekt, Fehlermeldung anzeigen
                            $login_err = "Ungültiger Benutzername 
                            oder ungültiges Passwort.";
                        }
                    }
                } else {
                    // Benutzername exisitert nicht, Fehlermeldung anzeigen
                    $login_err = "Ungültiger Benutzername oder ungültiges Passwort.";
                }
            } else {
                echo "Etwas lief falsch. Bitte später erneut versuchen.";
            }

            // Anweisung schliessen
            mysqli_stmt_close($stmt);
        }
    }

    // Verbindung schliessen
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        .wrapper {
            background-color: #bee6fa;
            width: 450px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
        }
    </style>

</head>
<body style="background-color: #dfeff7">
    <div class="wrapper">
        <h2 style="text-align: center">Login</h2>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars(
            $_SERVER["PHP_SELF"],
            ENT_QUOTES,
            "UTF-8"
        ); ?>" 
        method="post">
            <div class="form-group">
                <label>Benutzername:</label>
                <input type="text" name="username" 
                class="form-control 
                <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" 
                value="<?php echo htmlspecialchars(
                    $username,
                    ENT_QUOTES,
                    "UTF-8"
                ); ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Passwort:</label>
                <input type="password" name="password" 
                class="form-control 
                <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo htmlspecialchars(
                    $password_err,
                    ENT_QUOTES,
                    "UTF-8"
                ); ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login" 
                style="color: white; background-color: #2E9DE7; border-radius: 12px;">
            </div>
            <p>Haben Sie kein Account? 
                <a href="register.php">Hier registrieren</a>.
            </p>
        </form>
    </div>
</body>
</html>