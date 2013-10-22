-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 21 Octobre 2013 à 12:07
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `resultsam`
--

-- --------------------------------------------------------

--
-- Structure de la table `arc_archer`
--

CREATE TABLE IF NOT EXISTS `arc_archer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `club` text NOT NULL,
  `categorie` int(11) NOT NULL DEFAULT '0',
  `type_compet` int(11) NOT NULL DEFAULT '0',
  `depart` int(11) NOT NULL DEFAULT '0',
  `cible` text NOT NULL,
  `lettre` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `arc_archer`
--

INSERT INTO `arc_archer` (`id`, `nom`, `prenom`, `club`, `categorie`, `type_compet`, `depart`, `cible`, `lettre`) VALUES
(1, 'DUPIN', 'CHRISTOPHE', 'MÃ©rignac', 10, 1, 3, '1', 'A');

-- --------------------------------------------------------

--
-- Structure de la table `arc_categories`
--

CREATE TABLE IF NOT EXISTS `arc_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Contenu de la table `arc_categories`
--

INSERT INTO `arc_categories` (`id`, `categorie`) VALUES
(1, 'BFCL'),
(2, 'BHCL'),
(3, 'MFCL'),
(4, 'MHCL'),
(5, 'CFCL'),
(6, 'CHCL'),
(7, 'JFCL'),
(8, 'JHCL'),
(9, 'SFCL'),
(10, 'SHCL'),
(11, 'VFCL'),
(12, 'VHCL'),
(13, 'SVFCL'),
(14, 'SVHCL'),
(15, 'BFCO'),
(16, 'BHCO'),
(17, 'MFCO'),
(18, 'MHCO'),
(19, 'CFCO'),
(20, 'CHCO'),
(21, 'JFCO'),
(22, 'JHCO'),
(23, 'SFCO'),
(24, 'SHCO'),
(25, 'VFCO'),
(26, 'VHCO'),
(27, 'SVFCO'),
(28, 'SVHCO');

-- --------------------------------------------------------

--
-- Structure de la table `arc_competition`
--

CREATE TABLE IF NOT EXISTS `arc_competition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `lieu` text NOT NULL,
  `date` text NOT NULL,
  `nbre_cibles` int(11) NOT NULL DEFAULT '0',
  `jours` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `arc_competition`
--

INSERT INTO `arc_competition` (`id`, `nom`, `lieu`, `date`, `nbre_cibles`, `jours`) VALUES
(3, 'Concours Fita-FÃ©dÃ©ral', 'MÃ©rignac', '27/04/2013', 24, 2);

-- --------------------------------------------------------

--
-- Structure de la table `arc_scores`
--

CREATE TABLE IF NOT EXISTS `arc_scores` (
  `id_archer` int(11) NOT NULL DEFAULT '0',
  `id_compet` int(11) NOT NULL DEFAULT '0',
  `volee` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `id_categorie` int(11) NOT NULL DEFAULT '0',
  `type_compet` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client_adesign`
--

CREATE TABLE IF NOT EXISTS `client_adesign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `wraps_alu` int(11) NOT NULL,
  `wraps_carbone` int(11) NOT NULL,
  `wraps_stab` int(11) NOT NULL,
  `wraps_branche` int(11) NOT NULL,
  `wraps_viseur` int(11) NOT NULL,
  `frais_port` int(11) NOT NULL,
  `step_1` tinyint(1) NOT NULL,
  `step_2` tinyint(1) NOT NULL,
  `step_3` tinyint(1) NOT NULL,
  `step_4` tinyint(1) NOT NULL,
  `step_5` tinyint(1) NOT NULL,
  `step_6` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `client_adesign`
--

INSERT INTO `client_adesign` (`id`, `nom`, `prenom`, `email`, `wraps_alu`, `wraps_carbone`, `wraps_stab`, `wraps_branche`, `wraps_viseur`, `frais_port`, `step_1`, `step_2`, `step_3`, `step_4`, `step_5`, `step_6`) VALUES
(3, 'Dupin', 'Christophe', 'christophe.dupin.matmeca@gmail.com', 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(5, 'Maurice', 'Belay', 'maurice.belay@gmail.com', 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
