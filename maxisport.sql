-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 05 oct. 2022 à 16:49
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `maxisport`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `adminName` varchar(128) NOT NULL,
  `adminPswd` varchar(128) NOT NULL,
  `adminIsset` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `establish`
--

CREATE TABLE `establish` (
  `establishId` int(10) NOT NULL,
  `establishEnabled` tinyint(1) NOT NULL,
  `establishName` varchar(128) NOT NULL,
  `establishLogin` varchar(128) NOT NULL,
  `establishPswd` varchar(128) NOT NULL,
  `establishWebsite` varchar(128) NOT NULL,
  `establishphone` varchar(255) DEFAULT NULL,
  `franchiseid` int(11) DEFAULT NULL,
  `imgurl` varchar(255) DEFAULT NULL,
  `firstlogin` tinyint(1) NOT NULL,
  `ownerphone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `changedPswd` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `franchise`
--

CREATE TABLE `franchise` (
  `franchiseId` int(10) NOT NULL,
  `franchiseName` varchar(128) NOT NULL,
  `franchiseLogin` varchar(128) NOT NULL,
  `franchisePswd` varchar(128) NOT NULL,
  `franchiseEnabled` tinyint(1) NOT NULL,
  `franchiseWebsite` varchar(128) NOT NULL,
  `franchisetechphone` varchar(255) DEFAULT NULL,
  `franchisecomphone` varchar(255) DEFAULT NULL,
  `permAddestablish` tinyint(1) NOT NULL,
  `permAccesspanel` tinyint(1) NOT NULL,
  `permNewsletter` tinyint(1) NOT NULL,
  `permDrink` tinyint(1) NOT NULL,
  `permProm` tinyint(1) NOT NULL,
  `permAutorenewal` tinyint(1) NOT NULL,
  `permWebintegration` tinyint(1) NOT NULL,
  `imgurl` varchar(255) DEFAULT NULL,
  `firstlogin` tinyint(1) NOT NULL,
  `changedPswd` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `establish`
--
ALTER TABLE `establish`
  ADD PRIMARY KEY (`establishId`);

--
-- Index pour la table `franchise`
--
ALTER TABLE `franchise`
  ADD PRIMARY KEY (`franchiseId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `establish`
--
ALTER TABLE `establish`
  MODIFY `establishId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `franchise`
--
ALTER TABLE `franchise`
  MODIFY `franchiseId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
