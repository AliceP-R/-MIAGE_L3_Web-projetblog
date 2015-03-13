-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le : Ven 13 Mars 2015 à 09:49
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `projet_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `billet`
--

CREATE TABLE IF NOT EXISTS `billet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` text NOT NULL,
  `Contenu` longtext NOT NULL,
  `Redacteur` int(11) NOT NULL,
  `Etat` enum('Publie','En attente') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Billet` int(11) NOT NULL,
  `Emetteur` int(11) NOT NULL,
  `Contenu` longtext NOT NULL,
  `Etat` enum('Publie','En attente') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(50) NOT NULL,
  `Mdp` varchar(50) NOT NULL,
  `Droit` enum('Admin','Lambda') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
