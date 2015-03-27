-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le : Ven 27 Mars 2015 à 09:43
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
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`Titre`,`Redacteur`),
  KEY `Titre` (`Titre`),
  KEY `Redacteur` (`Redacteur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `billet`
--

INSERT INTO `billet` (`Titre`, `Resumer`, `Contenu`, `Redacteur`, `Etat`, `date_creation`) VALUES
('Ã©', 'Ã©Ã©', 'Ã©', 'aaa', 'En attente', '0000-00-00 00:00:00'),
('bbb', 'bbb', 'bbb\r\n', 'bbb', 'Publie', '0000-00-00 00:00:00'),
('bggfbgr;nhtn', 'bgtdt;:nhtdn', 'nhndht!:;"', 'aaa', 'En attente', '0000-00-00 00:00:00'),
('Billet admin', 'Resum admin', 'contenu modif', 'admin', 'Publie', '0000-00-00 00:00:00'),
('ccc', 'nnn', 'nnn', 'bbb', 'En attente', '0000-00-00 00:00:00'),
('jrjeljrezlkj', 'ljrldksjfdlskj', 'fdlskjfldksjfljk', 'aaa', 'Publie', '0000-00-00 00:00:00'),
('kfsdljflskj', 'fldsjfdlskjfdslkj', 'dslkjfdlskjfsdlkjf', 'banane', 'En attente', '0000-00-00 00:00:00'),
('modif 2 gnangna', 'modif 2 gnangang', 'modif 2 gngndngdfg', 'aaa', 'En attente', '0000-00-00 00:00:00'),
('modifvxcvcx', 'modifjlkjlj', 'modiflkjlkj', 'aaa', 'En attente', '0000-00-00 00:00:00'),
('Premier article EEE', 'RÃ©sumer EEE', 'Contenu EEE', 'eee', 'En attente', '0000-00-00 00:00:00'),
('sfdskfjdlskjf', 'xkjcxnvcxnvx', 'xkv;cxnv;,xcnv;,cxnv', 'aaa', 'En attente', '0000-00-00 00:00:00');

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
  `date_ajout` datetime NOT NULL,
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
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin'),
('banane', '93ef5dde44b5cb1d8f3795982ee918c64b7114f6', 'Lambda'),
('bbb', '5cb138284d431abd6a053a56625ec088bfb88912', 'Lambda'),
('ccc', 'f36b4825e5db2cf7dd2d2593b3f5c24c0311d8b2', 'Lambda'),
('eee', '637a81ed8e8217bb01c15c67c39b43b0ab4e20f1', 'Lambda'),
('jjj', 'c84c766f873ecedf75aa6cf35f1e305e095fec83', 'Lambda'),
('ppp', 'b3054ff0797ff0b2bbce03ec897fe63e0b6490e0', 'Lambda');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
