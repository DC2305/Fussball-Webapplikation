CREATE DATABASE fussball;

CREATE TABLE `benutzer` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `benutzername` varchar(50) NOT NULL,
 `passwort` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci