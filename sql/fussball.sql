CREATE DATABASE fussball;

USE fussball;

CREATE TABLE `benutzer` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `benutzername` varchar(50) NOT NULL,
 `passwort` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE `kalender` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `titel` varchar(255) NOT NULL,
 `beschreibung` text NOT NULL,
 `starten` datetime NOT NULL,
 `enden` datetime NOT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE `dashboard` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `heimmannschaft` varchar(50) NOT NULL,
 `gastmannschaft` varchar(50) NOT NULL,
 `heimtore` int(2) NOT NULL,
 `gasttore` int(2) NOT NULL,
 `notizen` text NOT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE `analysen` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `mannschaft` varchar(50) NOT NULL,
 `stärken` text NOT NULL,
 `schwächen` text NOT NULL,
 PRIMARY KEY (`id`)
);