-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 09 fév. 2022 à 11:21
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
-- Base de données : `examen`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

DROP TABLE IF EXISTS `activite`;
CREATE TABLE IF NOT EXISTS `activite` (
  `pk_activite` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `nbmax` int(11) DEFAULT NULL,
  PRIMARY KEY (`pk_activite`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`pk_activite`, `nom`, `nbmax`) VALUES
(1, 'Atelier Cuisine', 15),
(2, 'Simulation de courses', 10),
(3, 'Course de karting', 12),
(4, 'Escape Game', 16),
(5, 'Aucune activitée', NULL),
(6, 'Activité sans place (test)', 0);

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `pk_admin` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`pk_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`pk_admin`, `login`, `password`) VALUES
(4, 'MyTL', '$2y$10$ttJBHst9O/6PwircGiWv.O3DOtu1wQlCIw9P8VyTguAxCKOjNN99y'),
(3, 'test', '$2y$10$i3u3Q9bzgCdoXJbEvXMmGuT1D0F/uhyEpe/xaMc.Hr8cng1CLHY3i'),
(5, 'Thomas', '$2y$10$KHvwWTe.hCiUNIA3hjs15.hxdlaJ4dsmuaiV7nHbF0gEXIHr0Yr8e');

-- --------------------------------------------------------

--
-- Structure de la table `cp`
--

DROP TABLE IF EXISTS `cp`;
CREATE TABLE IF NOT EXISTS `cp` (
  `pk_cp` int(11) NOT NULL AUTO_INCREMENT,
  `cp` smallint(4) NOT NULL,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_cp`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cp`
--

INSERT INTO `cp` (`pk_cp`, `cp`, `nom`) VALUES
(1, 6987, 'Rendeux'),
(2, 6900, 'Marche-En-Famenne'),
(3, 1348, 'Louvain-La-Neuve'),
(4, 4000, 'Liège'),
(5, 1000, 'Bruxelles');

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `pk_departement` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_departement`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`pk_departement`, `nom`) VALUES
(1, 'Urbanisme'),
(2, 'Administration'),
(3, 'IT'),
(4, 'Marketing'),
(5, 'Recherche et Développement');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `pk_employe` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `mail` varchar(150) DEFAULT NULL,
  `fk_cp` int(11) NOT NULL,
  `fk_locomotion` int(11) NOT NULL,
  `fk_departement` int(11) NOT NULL,
  `souper` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_employe`),
  KEY `fk_cp` (`fk_cp`),
  KEY `fk_departement` (`fk_departement`),
  KEY `fk_locomotion` (`fk_locomotion`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`pk_employe`, `nom`, `prenom`, `mail`, `fk_cp`, `fk_locomotion`, `fk_departement`, `souper`) VALUES
(2, 'Pauwels2', 'Donatian2', 'donatian2@gmail.com', 3, 4, 1, 'Non'),
(3, 'test', 'test', 'test@test.test', 1, 1, 1, 'Non'),
(4, 'sdef', 'sdf', 'sdf@sdf.com', 1, 1, 1, 'Non'),
(5, 'yolo', 'yo', 'yo@to.do', 3, 3, 4, 'Oui'),
(6, 'qsd', 'sdf', 'fzf@sdf.czefs', 1, 1, 1, 'Non'),
(7, 'lol2', 'jsp', 'jdp@jd.c', 4, 3, 1, 'Non');

-- --------------------------------------------------------

--
-- Structure de la table `employe_activite`
--

DROP TABLE IF EXISTS `employe_activite`;
CREATE TABLE IF NOT EXISTS `employe_activite` (
  `pk_employe_activite` int(11) NOT NULL AUTO_INCREMENT,
  `fk_activite` int(11) NOT NULL,
  `fk_employe` int(11) NOT NULL,
  PRIMARY KEY (`pk_employe_activite`),
  KEY `fk_activite` (`fk_activite`),
  KEY `fk_employe` (`fk_employe`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employe_activite`
--

INSERT INTO `employe_activite` (`pk_employe_activite`, `fk_activite`, `fk_employe`) VALUES
(3, 1, 2),
(6, 5, 4),
(7, 5, 5),
(8, 5, 3),
(10, 4, 6),
(12, 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `locomotion`
--

DROP TABLE IF EXISTS `locomotion`;
CREATE TABLE IF NOT EXISTS `locomotion` (
  `pk_locomotion` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_locomotion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `locomotion`
--

INSERT INTO `locomotion` (`pk_locomotion`, `nom`) VALUES
(1, 'Voiture'),
(2, 'Bus'),
(3, 'Pieds'),
(4, 'Vélo');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`fk_cp`) REFERENCES `cp` (`pk_cp`),
  ADD CONSTRAINT `employe_ibfk_2` FOREIGN KEY (`fk_departement`) REFERENCES `departement` (`pk_departement`),
  ADD CONSTRAINT `employe_ibfk_3` FOREIGN KEY (`fk_locomotion`) REFERENCES `locomotion` (`pk_locomotion`);

--
-- Contraintes pour la table `employe_activite`
--
ALTER TABLE `employe_activite`
  ADD CONSTRAINT `employe_activite_ibfk_1` FOREIGN KEY (`fk_activite`) REFERENCES `activite` (`pk_activite`),
  ADD CONSTRAINT `employe_activite_ibfk_2` FOREIGN KEY (`fk_employe`) REFERENCES `employe` (`pk_employe`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
