-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 18 juin 2022 à 18:48
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chenil`
--
CREATE DATABASE IF NOT EXISTS `chenil` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chenil`;

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `pass` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `username`, `pass`) VALUES
(1, 'MyTL', '$2y$10$OOQM/YetkBzaq1T6PtAJq.GTOcbWNmeAd6VLSzhZ1JYySI75m8R9u');

-- --------------------------------------------------------

--
-- Structure de la table `animals`
--

DROP TABLE IF EXISTS `animals`;
CREATE TABLE IF NOT EXISTS `animals` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `sterilized` tinyint(1) NOT NULL,
  `chip_id` int(10) NOT NULL,
  `id_owner` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chip_id` (`chip_id`),
  KEY `id_owner` (`id_owner`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `animals`
--

INSERT INTO `animals` (`id`, `name`, `gender`, `birthdate`, `sterilized`, `chip_id`, `id_owner`) VALUES
(1, 'Le chat', 'F', '2021-06-17', 1, 1234567890, 2),
(3, 'Le iench', 'F', '2022-06-02', 1, 10234, 1),
(4, 'test2', 'F', '2022-06-02', 1, 1029384756, 1),
(33, 'yolo', 'M', '2022-06-03', 1, 5678765, 1),
(34, 'sgdf', 'M', '2022-06-17', 0, 56776546, 1);

-- --------------------------------------------------------

--
-- Structure de la table `owners`
--

DROP TABLE IF EXISTS `owners`;
CREATE TABLE IF NOT EXISTS `owners` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `mail` varchar(100) NOT NULL,
  `phone` int(20) NOT NULL,
  `pass` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `owners`
--

INSERT INTO `owners` (`id`, `name`, `firstname`, `birthdate`, `mail`, `phone`, `pass`) VALUES
(1, 'Lambert', 'Thomas', '1998-05-15', 'tlambert385@gmail.com', 3827624, '$2y$10$OOQM/YetkBzaq1T6PtAJq.GTOcbWNmeAd6VLSzhZ1JYySI75m8R9u'),
(2, 'Pauwels', 'Donatian', '1994-09-15', 'pauwelsdonatian@gmail.com', 968745678, '$2y$10$P9/L5s/3cDeYu07y2GY4Iexb8ACKoqLCcY5Jtfhn8oxKRDQ3dPada'),
(3, 'Grauwmans', 'Jordan', '1996-01-11', 'grauwmansjordan@outlook.com', 8745567, '$2y$10$34mbPe1LdQ9.7gnIha8jEu3B5dr.WXEfQx9xctUaYq.mxHG7i/7FW'),
(4, 'test', 'test', '2022-06-10', 'test@test.com', 9857, '$2y$10$RrnmpbWdRE18/rN2/zZN7.VEVY01.mg4vmW9qjsLym1KB6fZGJmru'),
(5, 'dsf', 'sdf', '2022-06-30', 't@t.t', 76543, '$2y$10$BUovGygadVSB9dynFSQ66eWhhA6J3i2jUWQ54QYC4RxYIZjLXKcCe');

-- --------------------------------------------------------

--
-- Structure de la table `visits`
--

DROP TABLE IF EXISTS `visits`;
CREATE TABLE IF NOT EXISTS `visits` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `visit_date` date NOT NULL,
  `id_animal` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_animal` (`id_animal`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `visits`
--

INSERT INTO `visits` (`id`, `visit_date`, `id_animal`) VALUES
(5, '2022-06-17', 3),
(16, '2022-05-29', 4),
(20, '2022-06-04', 4),
(26, '2022-05-29', 3),
(27, '2022-06-01', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`id_owner`) REFERENCES `owners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_ibfk_1` FOREIGN KEY (`id_animal`) REFERENCES `animals` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
