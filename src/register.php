<?php

/**
 * Registrieren
 *
 * PHP version 8.2.12
 *
 * @category Web-Applikation_Für_Fussballvereine
 *
 * @package Registrieren
 *
 * @author David Cvetkovic <david.cvetkovic@sluz.ch>
 *
 * @license https://opensource.org/license/bsd-3-clause/ BSD-3-Clause
 *
 * @link http://localhost/Testkalender/
 */

require_once "config.php";

// Variabeln definieren und mit leeren Werten initialisieren
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Benutzernamen überprüfen
    if (empty(trim($_POST["username"]))) {
        $username_err = "Bitte einen Benutzernamen eingeben.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Der Benutzername kann nur Buchstaben, 
        Zahlen und Unterstriche enthalten.";
    } else {
        $sql = "SELECT id FROM benutzer WHERE benutzername = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Variabeln als Parameter an die vorbereitete Anweisung binden
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Parameter
            $param_username = trim($_POST["username"]);

            // Anweisung ausführen
            if (mysqli_stmt_execute($stmt)) {
                //Ergebnis speichern
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Dieser Benutzername existiert bereits.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Etwas lief falsch. Bitte später erneut versuchen.";
            }

            // Anweisung schliessen
            mysqli_stmt_close($stmt);
        }
    }

    // Passwort validieren
    if (empty(trim($_POST["password"]))) {
        $password_err = "Bitte ein Passwort eingeben.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Das Passwort muss mindestens 8 Zeichen enthalten.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validieren, dass Passwort erneut eingegeben wurde
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Bitte das Passwort bestätigen.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Passwort stimmt nicht überein.";
        }
    }

    // Input-Fehler überprüfen, bevor man in Datenbank hinzufügt
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO benutzer (benutzername, passwort) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Variabeln als Parameter an die vorbereitete Anweisung binden
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Parameter
            $param_username = $username;
            // PAsswort-Hash
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // Anweisung ausführen
            if (mysqli_stmt_execute($stmt)) {
                // Zur Login-Seite weiterleiten
                header("location: login.php");
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
    <title>Registrieren</title>
    <link rel="stylesheet" 
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
        <h2 style="text-align: center">Registrieren</h2>
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
                <span class="invalid-feedback"><?php echo htmlspecialchars(
                    $username_err,
                    ENT_QUOTES,
                    "UTF-8"
                ); ?></span>
            </div>    
            <div class="form-group">
                <label>Passwort:</label>
                <input type="password" name="password" 
                class="form-control 
                <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" 
                value="<?php echo htmlspecialchars(
                    $password,
                    ENT_QUOTES,
                    "UTF-8"
                ); ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Passwort bestätigen:</label>
                <input type="password" name="confirm_password" 
                class="form-control 
                <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" 
                value="<?php echo htmlspecialchars(
                    $confirm_password,
                    ENT_QUOTES,
                    "UTF-8"
                ); ?>">
                <span class="invalid-feedback">
                    <?php echo $confirm_password_err; ?>
                </span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Registrieren" style="color: white; background-color: #2E9DE7; border-radius: 12px;">
                <input type="reset" 
                class="btn btn-secondary ml-2" value="Zurücksetzen" style="color: white; background-color: #2E9DE7; border-radius: 12px;">
            </div>
            <p>Haben Sie bereits ein Account? 
                <a href="login.php">Hier einloggen</a>.
            </p>
        </form>
    </div>    
</body>
</html>