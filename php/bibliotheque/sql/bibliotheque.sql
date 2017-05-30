-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 27 Avril 2014 à 23:34
-- Version du serveur: 5.5.35
-- Version de PHP: 5.4.4-14+deb7u8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `ADHERENT`
--

CREATE TABLE IF NOT EXISTS `ADHERENT` (
  `Numero_ADHERENT` varchar(25) NOT NULL,
  `NOM` varchar(25) NOT NULL,
  `PRENOM` varchar(25) NOT NULL,
  `VILLE` varchar(25) NOT NULL,
  `DATE_NAISSANCE` date NOT NULL,
  `SEXE` varchar(25) NOT NULL,
  `ADRESSE` varchar(350) NOT NULL,
  `COURRIEL` varchar(50) NOT NULL,
  `TELEPHONE` varchar(25) NOT NULL,
  `DATE_ADHESION` date NOT NULL,
  `DD_PAIEMENT` date NOT NULL,
  PRIMARY KEY (`Numero_ADHERENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ADHERENT`
--

INSERT INTO `ADHERENT` (`Numero_ADHERENT`, `NOM`, `PRENOM`, `VILLE`, `DATE_NAISSANCE`, `SEXE`, `ADRESSE`, `COURRIEL`, `TELEPHONE`, `DATE_ADHESION`, `DD_PAIEMENT`) VALUES
('81858', 'MDJASSIRI', 'AMIRDINE', 'Toulon', '1990-08-25', 'Masculin', '1 rue de la busserine', 'mdjassiri.amridine@yahoo.fr', '33659353445', '2014-04-21', '2014-08-15'),
('85213', 'RAMBO', 'JOHN', 'Angers', '1990-08-25', 'Masculin', '21 ST WALL STREET', 'jhon.rambo@us-army.fr', '33759353445', '2014-04-21', '2014-08-15');

-- --------------------------------------------------------

--
-- Structure de la table `AUTEUR`
--

CREATE TABLE IF NOT EXISTS `AUTEUR` (
  `ID_AUTEUR` varchar(25) NOT NULL,
  `NOM_AUTEUR` varchar(25) NOT NULL,
  `PRENOM_AUTEUR` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_AUTEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `AUTEUR`
--

INSERT INTO `AUTEUR` (`ID_AUTEUR`, `NOM_AUTEUR`, `PRENOM_AUTEUR`) VALUES
('01', 'VICTOR', 'HUGO'),
('63155', 'Maurice', 'De Bever'),
('86574', 'Lucas', 'Georges');

-- --------------------------------------------------------

--
-- Structure de la table `CARACTERISE`
--

CREATE TABLE IF NOT EXISTS `CARACTERISE` (
  `NUM_MOTCLE` varchar(25) NOT NULL,
  `COTE` varchar(25) NOT NULL,
  PRIMARY KEY (`NUM_MOTCLE`,`COTE`),
  KEY `COTE` (`COTE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `CARACTERISE`
--

INSERT INTO `CARACTERISE` (`NUM_MOTCLE`, `COTE`) VALUES
('10000', 'BD100'),
('98541', 'R100'),
('21478', 'R200'),
('65747', 'R300'),
('65747', 'R400');

-- --------------------------------------------------------

--
-- Structure de la table `EDITEUR`
--

CREATE TABLE IF NOT EXISTS `EDITEUR` (
  `ID_Editeur` varchar(25) NOT NULL,
  `NOM_EDI` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_Editeur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `EDITEUR`
--

INSERT INTO `EDITEUR` (`ID_Editeur`, `NOM_EDI`) VALUES
('01', 'LIVRE DE POCHES'),
('02', 'Hachette'),
('2982', 'Dupuis');

-- --------------------------------------------------------

--
-- Structure de la table `LIVRE`
--

CREATE TABLE IF NOT EXISTS `LIVRE` (
  `CODE_BARRE` varchar(25) NOT NULL,
  `ISBN` varchar(25) NOT NULL,
  `DISPONIBILITE` tinyint(1) DEFAULT NULL,
  `NUMERO_EXEMPLAIRE` int(30) NOT NULL,
  `DATE_ACHAT` date NOT NULL,
  `ID_EDITEUR` varchar(25) NOT NULL,
  `COTE` varchar(25) NOT NULL,
  PRIMARY KEY (`CODE_BARRE`),
  KEY `ID_EDITEUR` (`ID_EDITEUR`),
  KEY `COTE` (`COTE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `LIVRE`
--

INSERT INTO `LIVRE` (`CODE_BARRE`, `ISBN`, `DISPONIBILITE`, `NUMERO_EXEMPLAIRE`, `DATE_ACHAT`, `ID_EDITEUR`, `COTE`) VALUES
('00002', '00002', 0, 2, '2014-04-02', '02', 'R200'),
('0001', '00017', 0, 0, '2014-04-08', '01', 'R100'),
('0003', '00003', 0, 1, '2014-04-02', '01', 'R300'),
('11111111147', '000031', 1, 1763, '2005-08-10', '02', 'R400'),
('4120950518305', '800114428', 1, 2755, '2014-08-15', '2982', 'BD100'),
('78541585221', '00003', 1, 8124, '2014-08-15', '01', 'R300 ');

-- --------------------------------------------------------

--
-- Structure de la table `MOT_CLE`
--

CREATE TABLE IF NOT EXISTS `MOT_CLE` (
  `NUM_MOTCLE` varchar(25) NOT NULL,
  `MOT_CLES` varchar(25) NOT NULL,
  PRIMARY KEY (`NUM_MOTCLE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `MOT_CLE`
--

INSERT INTO `MOT_CLE` (`NUM_MOTCLE`, `MOT_CLES`) VALUES
('10000', 'Lucky Luke cow-boy wester'),
('14754', 'pauvre'),
('21478', 'utopie'),
('65747', 'sabre-laser'),
('87478', 'étoile de la mort '),
('98541', 'pauvre');

-- --------------------------------------------------------

--
-- Structure de la table `OEUVRE`
--

CREATE TABLE IF NOT EXISTS `OEUVRE` (
  `COTE` varchar(25) NOT NULL,
  `TITRE` varchar(25) NOT NULL,
  `DATE_PARUTION` date NOT NULL,
  PRIMARY KEY (`COTE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `OEUVRE`
--

INSERT INTO `OEUVRE` (`COTE`, `TITRE`, `DATE_PARUTION`) VALUES
('BD100', 'Lucky Luke contre Pat Pok', '1953-01-01'),
('R100', 'Les Miserables', '1862-01-01'),
('R200', 'Un Mondes Parfait', '1990-04-07'),
('R300', 'Stars Wars', '2014-04-14'),
('R400', 'Stars Wars II', '1785-05-12');

-- --------------------------------------------------------

--
-- Structure de la table `PRET`
--

CREATE TABLE IF NOT EXISTS `PRET` (
  `Numero_ADHERENT` varchar(25) NOT NULL,
  `CODE_BARRE` varchar(25) NOT NULL,
  `DATE_EMP` date NOT NULL,
  `DATE_RETOUR` date NOT NULL,
  `Prolongation` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CODE_BARRE`,`DATE_EMP`,`Numero_ADHERENT`),
  KEY `Numero_ADHERENT` (`Numero_ADHERENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `PRET`
--

INSERT INTO `PRET` (`Numero_ADHERENT`, `CODE_BARRE`, `DATE_EMP`, `DATE_RETOUR`, `Prolongation`) VALUES
('85213', '00002', '2014-04-02', '2014-04-10', 0),
('81858', '0001', '2014-04-16', '2014-04-10', 0),
('81858', '0003', '2014-03-07', '2014-04-07', 0),
('81858', '11111111147', '2014-04-25', '2014-05-10', 0),
('81858', '11111111147', '2014-04-26', '2014-05-11', 0);

-- --------------------------------------------------------

--
-- Structure de la table `REDIGER`
--

CREATE TABLE IF NOT EXISTS `REDIGER` (
  `ID_AUTEUR` varchar(25) NOT NULL,
  `COTE` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_AUTEUR`,`COTE`),
  KEY `COTE` (`COTE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `REDIGER`
--

INSERT INTO `REDIGER` (`ID_AUTEUR`, `COTE`) VALUES
('63155', 'BD100'),
('01', 'R100'),
('01', 'R200'),
('01', 'R300'),
('86574', 'R400');

-- --------------------------------------------------------

--
-- Structure de la table `RESERVE`
--

CREATE TABLE IF NOT EXISTS `RESERVE` (
  `Numero_ADHERENT` varchar(25) NOT NULL,
  `COTE` varchar(25) NOT NULL,
  `DATE_RESERVATION` datetime NOT NULL,
  `DATE_LIM` date NOT NULL,
  PRIMARY KEY (`Numero_ADHERENT`,`COTE`,`DATE_RESERVATION`),
  KEY `COTE` (`COTE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `CARACTERISE`
--
ALTER TABLE `CARACTERISE`
  ADD CONSTRAINT `CARACTERISE_ibfk_1` FOREIGN KEY (`NUM_MOTCLE`) REFERENCES `MOT_CLE` (`NUM_MOTCLE`),
  ADD CONSTRAINT `CARACTERISE_ibfk_2` FOREIGN KEY (`COTE`) REFERENCES `OEUVRE` (`COTE`);

--
-- Contraintes pour la table `LIVRE`
--
ALTER TABLE `LIVRE`
  ADD CONSTRAINT `LIVRE_ibfk_1` FOREIGN KEY (`ID_EDITEUR`) REFERENCES `EDITEUR` (`ID_Editeur`),
  ADD CONSTRAINT `LIVRE_ibfk_2` FOREIGN KEY (`COTE`) REFERENCES `OEUVRE` (`COTE`);

--
-- Contraintes pour la table `PRET`
--
ALTER TABLE `PRET`
  ADD CONSTRAINT `PRET_ibfk_1` FOREIGN KEY (`Numero_ADHERENT`) REFERENCES `ADHERENT` (`Numero_ADHERENT`),
  ADD CONSTRAINT `PRET_ibfk_2` FOREIGN KEY (`CODE_BARRE`) REFERENCES `LIVRE` (`CODE_BARRE`);

--
-- Contraintes pour la table `REDIGER`
--
ALTER TABLE `REDIGER`
  ADD CONSTRAINT `REDIGER_ibfk_1` FOREIGN KEY (`ID_AUTEUR`) REFERENCES `AUTEUR` (`ID_AUTEUR`),
  ADD CONSTRAINT `REDIGER_ibfk_2` FOREIGN KEY (`COTE`) REFERENCES `OEUVRE` (`COTE`);

--
-- Contraintes pour la table `RESERVE`
--
ALTER TABLE `RESERVE`
  ADD CONSTRAINT `RESERVE_ibfk_1` FOREIGN KEY (`Numero_ADHERENT`) REFERENCES `ADHERENT` (`Numero_ADHERENT`),
  ADD CONSTRAINT `RESERVE_ibfk_2` FOREIGN KEY (`COTE`) REFERENCES `OEUVRE` (`COTE`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
