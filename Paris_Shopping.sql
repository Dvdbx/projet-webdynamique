-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 05 déc. 2021 à 13:50
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
-- Base de données : `Paris Shopping`
--

-- --------------------------------------------------------

--
-- Structure de la table `Objets`
--

CREATE TABLE `Objets` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Rareté` varchar(255) NOT NULL,
  `Date début enchère` date DEFAULT NULL,
  `Date fin enchère` date DEFAULT NULL,
  `Prix` int(11) NOT NULL,
  `Volume` int(11) NOT NULL,
  `Nombre enchère` int(11) NOT NULL,
  `Nom Vendeur` varchar(255) NOT NULL,
  `Nom Acheteur` varchar(255) NOT NULL,
  `Photo 1` varchar(255) NOT NULL,
  `Photo 2` varchar(255) NOT NULL,
  `Photo 3` varchar(255) NOT NULL,
  `Vidéo` varchar(255) NOT NULL,
  `Achat Immédiat` tinyint(1) NOT NULL,
  `Transaction vendeur-client` tinyint(1) NOT NULL,
  `Achetez maintenant` tinyint(1) NOT NULL,
  `Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Paiement`
--

CREATE TABLE `Paiement` (
  `ID Payement` int(11) NOT NULL,
  `Type de carte` varchar(255) NOT NULL,
  `Numéro` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Date expiration` date NOT NULL,
  `Code sécurité` int(10) NOT NULL,
  `ID utilisateur` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Panier`
--

CREATE TABLE `Panier` (
  `ID panier` int(11) NOT NULL,
  `ID utilisateur` int(11) NOT NULL,
  `ID objet 1` int(11) NOT NULL,
  `ID objet 2` int(11) NOT NULL,
  `ID objet 3` int(11) NOT NULL,
  `ID objet 4` int(11) NOT NULL,
  `ID objet 5` int(11) NOT NULL,
  `Prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `ID utilisateur` int(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `Statut` varchar(255) NOT NULL,
  `Pseudo` varchar(255) DEFAULT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Fond` varchar(255) DEFAULT NULL,
  `Prénom` varchar(255) DEFAULT NULL,
  `Adresse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Objets`
--
ALTER TABLE `Objets`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Paiement`
--
ALTER TABLE `Paiement`
  ADD PRIMARY KEY (`ID Payement`),
  ADD KEY `ID utilisateur` (`ID utilisateur`);

--
-- Index pour la table `Panier`
--
ALTER TABLE `Panier`
  ADD PRIMARY KEY (`ID panier`),
  ADD KEY `ID utilisateur` (`ID utilisateur`),
  ADD KEY `ID objet 1` (`ID objet 1`),
  ADD KEY `ID objet 2` (`ID objet 2`),
  ADD KEY `ID objet 1_2` (`ID objet 1`),
  ADD KEY `ID objet 3` (`ID objet 3`),
  ADD KEY `ID objet 4` (`ID objet 4`),
  ADD KEY `ID objet 5` (`ID objet 5`),
  ADD KEY `ID utilisateur_2` (`ID utilisateur`);

--
-- Index pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`ID utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Objets`
--
ALTER TABLE `Objets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Paiement`
--
ALTER TABLE `Paiement`
  MODIFY `ID Payement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Panier`
--
ALTER TABLE `Panier`
  MODIFY `ID panier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `ID utilisateur` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
