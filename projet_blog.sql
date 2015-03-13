-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le : Ven 13 Mars 2015 à 18:29
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
  `Titre` varchar(50) NOT NULL,
  `Resumer` varchar(100) NOT NULL,
  `Contenu` longtext NOT NULL,
  `Redacteur` varchar(50) NOT NULL,
  `Etat` enum('Publie','En attente') NOT NULL DEFAULT 'En attente',
  PRIMARY KEY (`Titre`,`Redacteur`),
  KEY `Titre` (`Titre`),
  KEY `Redacteur` (`Redacteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `billet`
--

INSERT INTO `billet` (`Titre`, `Resumer`, `Contenu`, `Redacteur`, `Etat`) VALUES
('Alice', 'Resume', 'Contenu', 'aaa', 'En attente'),
('dfdsf', 'sdfsdfsdfs', 'fsdfsdfsdfs', 'aaa', 'En attente'),
('titre', 'reumser', 'contenu', 'aaa', 'En attente');

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
('aaaaaa', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Lambda'),
('ccc', 'f36b4825e5db2cf7dd2d2593b3f5c24c0311d8b2', 'Lambda'),
('eee', '637a81ed8e8217bb01c15c67c39b43b0ab4e20f1', 'Lambda'),
('jjj', 'c84c766f873ecedf75aa6cf35f1e305e095fec83', 'Lambda'),
('nnn', '7f88bb68e14d386d89af3cf317f6f7af1d39246c', 'Lambda'),
('qqq', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Lambda'),
('ss', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'Lambda');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
