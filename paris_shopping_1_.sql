-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 10 déc. 2021 à 21:03
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
  `idPanier` int(11) DEFAULT NULL,
  `nomAcheteur` varchar(255) NOT NULL,
  `prenomAcheteur` varchar(255) NOT NULL,
  `adresseAcheteur` varchar(255) NOT NULL,
  `emailAcheteur` varchar(255) NOT NULL,
  `connexion` tinyint(1) DEFAULT NULL,
  `CritPrixInferieur` int(200) DEFAULT NULL,
  `CritPrixSuperieur` int(200) DEFAULT NULL,
  `typeAchat` enum('immediat','transaction','meilleurOffre') DEFAULT NULL,
  `rarete` enum('hautDeGamme','rare','regulier') DEFAULT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idAcheteur`),
  KEY `idPanier` (`idPanier`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`idAcheteur`, `idPanier`, `nomAcheteur`, `prenomAcheteur`, `adresseAcheteur`, `emailAcheteur`, `connexion`, `CritPrixInferieur`, `CritPrixSuperieur`, `typeAchat`, `rarete`, `categorie`) VALUES
(1, 1, 'ad', 'ad prenom', '37 quai de grenelle 75015 Paris France', 'ad', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `pseudoAdmin` varchar(255) NOT NULL,
  `mdpAdmin` varchar(255) NOT NULL,
  `connexion` tinyint(1) DEFAULT NULL,
  `reduc` float DEFAULT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`idAdmin`, `pseudoAdmin`, `mdpAdmin`, `connexion`, `reduc`) VALUES
(1, 'admin', 'alcool', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ajoutpanier`
--

DROP TABLE IF EXISTS `ajoutpanier`;
CREATE TABLE IF NOT EXISTS `ajoutpanier` (
  `idObjet` int(11) NOT NULL,
  `idPanier` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `nombreEnchere` int(11) NOT NULL,
  `prixEnchere` int(11) NOT NULL,
  KEY `idObjet` (`idObjet`),
  KEY `idPanier` (`idPanier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ajoutpanier`
--

INSERT INTO `ajoutpanier` (`idObjet`, `idPanier`, `quantite`, `nombreEnchere`, `prixEnchere`) VALUES
(1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `meilleuroffre`
--

DROP TABLE IF EXISTS `meilleuroffre`;
CREATE TABLE IF NOT EXISTS `meilleuroffre` (
  `idMeilleurOffre` int(11) NOT NULL AUTO_INCREMENT,
  `dateExpEnchere` date NOT NULL,
  `prix1` int(11) NOT NULL,
  `prix2` int(11) NOT NULL,
  `idObjet` int(11) NOT NULL,
  `idAcheteur` int(11) NOT NULL,
  PRIMARY KEY (`idMeilleurOffre`),
  KEY `idObjet` (`idObjet`),
  KEY `idAcheteur` (`idAcheteur`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `meilleuroffre`
--

INSERT INTO `meilleuroffre` (`idMeilleurOffre`, `dateExpEnchere`, `prix1`, `prix2`, `idObjet`, `idAcheteur`) VALUES
(8, '2021-12-08', 60, 40, 12, 1);

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

DROP TABLE IF EXISTS `objet`;
CREATE TABLE IF NOT EXISTS `objet` (
  `idObjet` int(11) NOT NULL AUTO_INCREMENT,
  `idVendeur` int(11) NOT NULL,
  `nomObjet` varchar(255) NOT NULL,
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
  `categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`idObjet`),
  KEY `idVendeur` (`idVendeur`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `objet`
--

INSERT INTO `objet` (`idObjet`, `idVendeur`, `nomObjet`, `debutEnchere`, `finEnchere`, `prixObjet`, `volume`, `photo1`, `photo2`, `photo3`, `video`, `typeAchat`, `rarete`, `categorie`) VALUES
(2, 1, 'Jim Beam Kentucky', '2021-12-06', '2021-12-08', 80, 15, 'prod-2.webp', '', '', '', 'transaction', 'hautDeGamme', 'Whisky'),
(1, 1, 'Bacardi 151', '2021-12-06', '2021-12-08', 60, 10, 'prod-1.webp', '', '', '', 'immediat', 'rare', 'Brandy'),
(4, 1, 'The Glenlivet', '2021-12-06', '2021-12-08', 69, 80, 'prod-4.webp', '', '', '', 'immediat', 'regulier', 'Rhum'),
(5, 2, 'Black Label', '2021-12-06', '2021-12-08', 45, 75, 'prod-5.webp', '', '', '', 'meilleurOffre', 'regulier', 'Whiskey'),
(6, 2, 'Macallan', '2021-12-06', '2021-12-08', 115, 100, 'prod-6.webp', '', '', '', 'meilleurOffre', 'rare', 'Tequila'),
(7, 3, 'Old Monk', '2021-12-16', '2021-12-23', 60, 50, 'prod-7.webp', '', '', '', 'meilleurOffre', 'hautDeGamme', 'Vodka'),
(8, 5, 'Jameson Irish Whiskey', '2021-12-16', '2021-12-23', 68, 95, 'prod-8.webp', '', '', '', 'immediat', 'regulier', 'Whiskey'),
(9, 6, 'Screwball', '2021-12-08', '2021-12-23', 90, 55, 'prod-9.webp', '', '', '', 'immediat', 'hautDeGamme', 'Whiskey'),
(10, 7, 'Jack Daniel\'s', '2021-12-08', '2021-12-10', 40, 30, 'prod-10.webp', '', '', '', 'immediat', 'regulier', 'Whiskey'),
(11, 8, 'McClelland\'s', '2021-12-08', '2021-12-16', 78, 60, 'prod-11.webp', '', '', '', 'transaction', 'hautDeGamme', 'Whiskey'),
(12, 10, 'Plantation', '2021-12-08', '2021-12-01', 80, 60, 'prod-12.webp', '', '', '', 'meilleurOffre', 'hautDeGamme', 'Whiskey');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `idPaiement` int(11) NOT NULL AUTO_INCREMENT,
  `typeCarte` varchar(255) NOT NULL,
  `nomPaiement` varchar(255) NOT NULL,
  `dateExpiration` date NOT NULL,
  `codeSecurite` int(11) NOT NULL,
  `idAcheteur` int(11) NOT NULL,
  `numPaiement` int(100) NOT NULL,
  PRIMARY KEY (`idPaiement`),
  KEY `idAcheteur` (`idAcheteur`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`idPaiement`, `typeCarte`, `nomPaiement`, `dateExpiration`, `codeSecurite`, `idAcheteur`, `numPaiement`) VALUES
(2, 'MasterCard', 'moi', '2021-12-09', 123, 1, 1234567891);

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`idPanier`, `idAcheteur`, `prixPanier`) VALUES
(1, 1, 60);

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
  `connexion` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idVendeur`),
  KEY `idAdmin` (`idAdmin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`idVendeur`, `pseudoVendeur`, `emailVendeur`, `nomVendeur`, `photoVendeur`, `fondVendeur`, `idAdmin`, `connexion`) VALUES
(1, 'producteur1', 'producteur@gmail.com', 'Producteur', 'person_1.webp', 'image_3.webp', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
