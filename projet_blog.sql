-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 29 Mars 2015 à 15:37
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
  `date_creation` datetime NOT NULL,
  `derniere_modif` datetime NOT NULL,
  PRIMARY KEY (`ID`,`Titre`,`Redacteur`),
  KEY `Titre` (`Titre`),
  KEY `Redacteur` (`Redacteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `billet`
--

INSERT INTO `billet` (`ID`, `Titre`, `Resumer`, `Contenu`, `Redacteur`, `Etat`, `date_creation`, `derniere_modif`) VALUES
(2, 'aaa', 'aaa', 'aaaaa', 'aaa', 'En attente', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'bbb', 'bbb', 'bbb', 'admin', 'Publie', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'ccc', 'ccc', 'ccc', 'admin', 'Publie', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'fff', 'fff', 'fff', 'admin', 'Publie', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'ggg', 'ggg', 'ggg', 'admin', 'Publie', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'sss', 'sss', 'sss', 'admin', 'En attente', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'ttt', 'ttt', 'ttt', 'admin', 'En attente', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'kkk', 'kkk', 'kkk', 'admin', 'Publie', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'date', 'date', 'date', 'aaa', 'Publie', '2015-03-26 15:56:12', '0000-00-00 00:00:00'),
(11, 'data', 'data', 'data', 'aaa', 'En attente', '2015-03-26 17:33:04', '0000-00-00 00:00:00'),
(12, 'ttt', 'ttt', 'tttt', 'aaa', 'En attente', '2015-03-26 17:39:00', '2015-03-26 17:40:12');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Billet` int(11) NOT NULL,
  `Emetteur` varchar(50) NOT NULL,
  `Contenu` longtext NOT NULL,
  `Etat` enum('Publie','En attente','Supprime') NOT NULL DEFAULT 'En attente',
  `date_ajout` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`ID`, `Billet`, `Emetteur`, `Contenu`, `Etat`, `date_ajout`) VALUES
(1, 2, 'aaa', 'Premier commentaire', 'Publie', '0000-00-00 00:00:00'),
(2, 2, 'admin', 'Premier commentaire', 'Publie', '0000-00-00 00:00:00'),
(3, 6, 'aaa', 'ttt', 'Supprime', '2015-03-29 15:36:41');

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
