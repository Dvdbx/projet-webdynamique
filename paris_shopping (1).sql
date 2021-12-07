-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 07 déc. 2021 à 15:54
-- Version du serveur : 5.7.34
-- Version de PHP : 7.4.21

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

CREATE TABLE `acheteur` (
  `idAcheteur` int(11) NOT NULL,
  `idPanier` int(11) DEFAULT NULL,
  `nomAcheteur` varchar(255) NOT NULL,
  `prenomAcheteur` varchar(255) NOT NULL,
  `adresseAcheteur` varchar(255) NOT NULL,
  `emailAcheteur` varchar(255) NOT NULL,
  `connexion` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`idAcheteur`, `idPanier`, `nomAcheteur`, `prenomAcheteur`, `adresseAcheteur`, `emailAcheteur`, `connexion`) VALUES
(1, 1, 'ad', '', '', 'ad', 1);

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `pseudoAdmin` varchar(255) NOT NULL,
  `mdpAdmin` varchar(255) NOT NULL,
  `connexion` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`idAdmin`, `pseudoAdmin`, `mdpAdmin`, `connexion`) VALUES
(1, 'admin', 'alcool', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ajoutpanier`
--

CREATE TABLE `ajoutpanier` (
  `idObjet` int(11) NOT NULL,
  `idPanier` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `nombreEnchere` int(11) NOT NULL,
  `prixEnchere` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

CREATE TABLE `objet` (
  `idObjet` int(11) NOT NULL,
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
  `categorie` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(12, 10, 'Plantation', '2021-12-08', '2021-12-15', 80, 60, 'prod-12.webp', '', '', '', 'meilleurOffre', 'hautDeGamme', 'Whiskey');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `idPaiement` int(11) NOT NULL,
  `typeCarte` varchar(255) NOT NULL,
  `numPaiement` int(11) NOT NULL,
  `nomPaiement` varchar(255) NOT NULL,
  `dateExpiration` date NOT NULL,
  `codeSecurite` int(11) NOT NULL,
  `idAcheteur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `idPanier` int(11) NOT NULL,
  `idAcheteur` int(11) NOT NULL,
  `prixPanier` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`idPanier`, `idAcheteur`, `prixPanier`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

CREATE TABLE `vendeur` (
  `idVendeur` int(11) NOT NULL,
  `pseudoVendeur` varchar(255) NOT NULL,
  `emailVendeur` varchar(255) NOT NULL,
  `nomVendeur` varchar(255) NOT NULL,
  `photoVendeur` varchar(255) NOT NULL,
  `fondVendeur` varchar(255) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  `connexion` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`idVendeur`, `pseudoVendeur`, `emailVendeur`, `nomVendeur`, `photoVendeur`, `fondVendeur`, `idAdmin`, `connexion`) VALUES
(1, 'producteur1', 'producteur@gmail.com', 'Producteur', 'person_1.webp', 'image_3.webp', 1, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acheteur`
--
ALTER TABLE `acheteur`
  ADD PRIMARY KEY (`idAcheteur`),
  ADD KEY `idPanier` (`idPanier`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Index pour la table `ajoutpanier`
--
ALTER TABLE `ajoutpanier`
  ADD KEY `idObjet` (`idObjet`),
  ADD KEY `idPanier` (`idPanier`);

--
-- Index pour la table `objet`
--
ALTER TABLE `objet`
  ADD PRIMARY KEY (`idObjet`),
  ADD KEY `idVendeur` (`idVendeur`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`idPaiement`),
  ADD KEY `idAcheteur` (`idAcheteur`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`idPanier`),
  ADD KEY `idAcheteur` (`idAcheteur`);

--
-- Index pour la table `vendeur`
--
ALTER TABLE `vendeur`
  ADD PRIMARY KEY (`idVendeur`),
  ADD KEY `idAdmin` (`idAdmin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acheteur`
--
ALTER TABLE `acheteur`
  MODIFY `idAcheteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `objet`
--
ALTER TABLE `objet`
  MODIFY `idObjet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `idPaiement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `idPanier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `vendeur`
--
ALTER TABLE `vendeur`
  MODIFY `idVendeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
