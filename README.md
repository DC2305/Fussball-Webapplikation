# XAMPP installieren und Repository klonen

1. [XAMPP](https://www.apachefriends.org/) installieren
2. Dieses Repository im htdocs-Ordner klonen:
    - Der htdocs-Ordner befindet sich dort, wo schliesslich XAMPP installiert wurde (meistens C:\xampp\htdocs)

# Datenbank mit MySQL erstellen
1. Nachdem XAMPP installiert wurde, in einem Browser **localhost** eingeben
2. Oben **phpMyAdmin** auswählen
3. Oben **SQL** auswählen und den SQL-Skript dieses Repositories hereinkopieren.

# Webseite korrekt benutzen
Nun kann man in einem Browser **localhost/Fussball-Webapplikation/src/** eingeben.

# Testing
Für das Testing wurde **Jest** und **PHPUnit** verwendet.

**Jest:**
1. [Node.js](https://nodejs.org/en/download) installieren
2. In Kommandozeile folgendes eingeben, um Jest zu installieren:
```console
C:\xampp\htdocs\Fussball-Webapplikation> npm install --save-dev jest
```
3. In Kommandozeile folgendes eingeben, um die Tests auszuführen:
```console
C:\xampp\htdocs\Fussball-Webapplikation> npm test
```

**PHPUnit:**
1. [Composer](https://getcomposer.org/download/) installieren
2. In Kommandozeile folgendes eingeben, um PHPUnit zu installieren:
```console
C:\xampp\htdocs\Fussball-Webapplikation> composer require --dev phpunit/phpunit ^10
```
3. **composer.json** sollte so aussehen:
```json
{
    "autoload": {
        "classmap": [
            "src/"
        ]
    },
    "require-dev": {
        "phpunit/phpunit": "^10"
    }
}
```
4. In Kommandozeile folgendes eingeben, um die Tests auszuführen:
```console
C:\xampp\htdocs\Fussball-Webapplikation> vendor/bin/phpunit tests
```

# Linter lokal verwenden
Für das Linting wurden **ESLint** für JavaScript, **PHP_CodeSniffer** für PHP und **Stylelint** für CSS verwendet.

**ESLint:**
1. [Node.js](https://nodejs.org/en/download) installieren (wenn noch nicht installiert)
2. In Kommandozeile folgendes eingeben, um ESLint zu installieren:
```console
C:\xampp\htdocs\Fussball-Webapplikation> npm init @eslint/config
```
3. In Kommandozeile folgendes eingeben, um mit ESLint zu linten ("yourfile" mit Namen der JS-Datei ersetzen, die man linten möchte):
```console
C:\xampp\htdocs\Fussball-Webapplikation> npx eslint js/yourfile.js
```

**PHP_CodeSniffer**
1. [Composer](https://getcomposer.org/download/) installieren (wenn noch nicht installiert)
2. In Kommandozeile folgendes eingeben, um PHP_CodeSniffer zu installieren:
```console
C:\xampp\htdocs\Fussball-Webapplikation> composer global require "squizlabs/php_codesniffer=*"
```
3. In Kommandozeile folgendes eingeben, um mit PHP_CodeSniffer zu linten ("yourfile" mit Namen der PHP-Datei ersetzen, die man linten möchte):
```console
C:\xampp\htdocs\Fussball-Webapplikation> phpcs C:/xampp/htdocs/Fussball-Webapplikation/src/yourfile.php
```

**Stylelint**
1. [Node.js](https://nodejs.org/en/download) installieren (wenn noch nicht installiert)
2. In Kommandozeile folgendes eingeben, um Stylelint zu installieren:
```console
C:\xampp\htdocs\Fussball-Webapplikation> npm init stylelint
```
3. In Kommandozeile folgendes eingeben, um mit Stylelint zu linten ("yourfile" mit Namen der CSS-Datei ersetzen, die man linten möchte):
```console
C:\xampp\htdocs\Fussball-Webapplikation> npx stylelint "C:/xampp/htdocs/Fussball-Webapplikation/css/yourfile.css"
```