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
 `ort` varchar(255) NOT NULL,
 `beteiligung` text NOT NULL,
 `starten` datetime NOT NULL,
 `enden` datetime NOT NULL,
 `abfahrt` datetime NOT NULL,
 PRIMARY KEY (`id`)
);