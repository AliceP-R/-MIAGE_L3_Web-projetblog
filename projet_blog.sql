-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 16 Mars 2015 à 14:37
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projet_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `billet`
--

CREATE TABLE IF NOT EXISTS `billet` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(50) NOT NULL,
  `Resumer` varchar(100) NOT NULL,
  `Contenu` longtext NOT NULL,
  `Redacteur` varchar(50) NOT NULL,
  `Etat` enum('Publie','En attente') NOT NULL DEFAULT 'En attente',
  PRIMARY KEY (`ID`,`Titre`,`Redacteur`),
  KEY `Titre` (`Titre`),
  KEY `Redacteur` (`Redacteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `billet`
--

INSERT INTO `billet` (`ID`, `Titre`, `Resumer`, `Contenu`, `Redacteur`, `Etat`) VALUES
(2, 'aaa', 'aaa', 'aaa', 'aaa', 'Publie'),
(3, 'bbb', 'bbb', 'bbb', 'admin', 'Publie'),
(4, 'ccc', 'ccc', 'ccc', 'admin', 'Publie');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Billet` int(11) NOT NULL,
  `Emetteur` varchar(50) NOT NULL,
  `Contenu` longtext NOT NULL,
  `Etat` enum('Publie','En attente') NOT NULL DEFAULT 'En attente',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`ID`, `Billet`, `Emetteur`, `Contenu`, `Etat`) VALUES
(1, 2, 'aaa', 'Premier commentaire', 'Publie'),
(2, 2, 'admin', 'Premier commentaire', 'Publie');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `Login` varchar(50) NOT NULL,
  `Mdp` varchar(50) NOT NULL,
  `Droit` enum('Admin','Lambda') NOT NULL,
  PRIMARY KEY (`Login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Login`, `Mdp`, `Droit`) VALUES
('aaa', '7e240de74fb1ed08fa08d38063f6a6a91462a815', 'Lambda'),
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
