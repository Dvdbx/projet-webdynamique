-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 05 déc. 2021 à 18:10
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `paris shopping`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

DROP TABLE IF EXISTS `acheteur`;
CREATE TABLE IF NOT EXISTS `acheteur` (
  `idAcheteur` int(11) NOT NULL AUTO_INCREMENT,
  `idPanier` int(11) NOT NULL,
  `nomAcheteur` varchar(255) NOT NULL,
  `prenomAcheteur` varchar(255) NOT NULL,
  `adresseAcheteur` varchar(255) NOT NULL,
  `emailAcheteur` varchar(255) NOT NULL,
  PRIMARY KEY (`idAcheteur`),
  KEY `idPanier` (`idPanier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `pseudoAdmin` varchar(255) NOT NULL,
  `mdpAdmin` varchar(255) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ajoutpanier`
--

DROP TABLE IF EXISTS `ajoutpanier`;
CREATE TABLE IF NOT EXISTS `ajoutpanier` (
  `idObjet` int(11) NOT NULL,
  `idPanier` int(11) NOT NULL,
  `nombreEnchere` int(11) NOT NULL,
  `prixEnchere` int(11) NOT NULL,
  KEY `idObjet` (`idObjet`),
  KEY `idPanier` (`idPanier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

DROP TABLE IF EXISTS `objet`;
CREATE TABLE IF NOT EXISTS `objet` (
  `idObjet` int(11) NOT NULL AUTO_INCREMENT,
  `idVendeur` int(11) NOT NULL,
  `debutEnchere` date NOT NULL,
  `finEnchere` date NOT NULL,
  `prixObjet` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  `photo1` varchar(255) NOT NULL,
  `photo2` varchar(255) NOT NULL,
  `photo3` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `typeAchat` enum('immediat','transaction','meilleurOffre') NOT NULL,
  `rarete` enum('regulier','hautDeGamme','rare') NOT NULL,
  PRIMARY KEY (`idObjet`),
  KEY `idVendeur` (`idVendeur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `idPaiement` int(11) NOT NULL AUTO_INCREMENT,
  `typeCarte` varchar(255) NOT NULL,
  `numPaiement` int(11) NOT NULL,
  `nomPaiement` varchar(255) NOT NULL,
  `dateExpiration` date NOT NULL,
  `codeSecurite` int(11) NOT NULL,
  `idAcheteur` int(11) NOT NULL,
  PRIMARY KEY (`idPaiement`),
  KEY `idAcheteur` (`idAcheteur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `idPanier` int(11) NOT NULL AUTO_INCREMENT,
  `idAcheteur` int(11) NOT NULL,
  `prixPanier` int(11) NOT NULL,
  PRIMARY KEY (`idPanier`),
  KEY `idAcheteur` (`idAcheteur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `idVendeur` int(11) NOT NULL AUTO_INCREMENT,
  `pseudoVendeur` varchar(255) NOT NULL,
  `emailVendeur` varchar(255) NOT NULL,
  `nomVendeur` varchar(255) NOT NULL,
  `photoVendeur` varchar(255) NOT NULL,
  `fondVendeur` varchar(255) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  PRIMARY KEY (`idVendeur`),
  KEY `idAdmin` (`idAdmin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
