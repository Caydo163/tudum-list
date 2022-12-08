-- phpMyAdmin SQL Dump
-- version 5.0.4deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 08 déc. 2022 à 15:32
-- Version du serveur :  10.5.15-MariaDB-0+deb11u1
-- Version de PHP : 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbjucarvalhe`
--

-- --------------------------------------------------------

--
-- Structure de la table `List`
--

CREATE TABLE `List` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `owner` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `List`
--

INSERT INTO `List` (`id`, `name`, `owner`) VALUES
(1, 'Chose à faire', NULL),
(2, 'Film à voir', NULL),
(3, 'Best séries', NULL),
(23, 'TODO-List PHP', NULL),
(26, 'Les incontournables', NULL),
(47, 'aadzada', 1),
(50, 'dezd', 1),
(51, 'dzedz', 1),
(52, 'dzedze', 1),
(53, 'dzedz', 1),
(54, 'zedzed', 1),
(55, 'dzedz', 1),
(56, 'Ce que je dois faire', 4),
(77, 'Tésté', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Task`
--

CREATE TABLE `Task` (
  `id` int(11) NOT NULL,
  `list` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `achieve` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Task`
--

INSERT INTO `Task` (`id`, `list`, `name`, `achieve`) VALUES
(1, 1, 'Manger', 1),
(2, 2, 'Ready Player One', 1),
(3, 1, 'Dormir', 1),
(4, 3, 'Dark', 0),
(7, 2, 'Endgame', 1),
(8, 3, 'Dark (evan veut vraiment)', 0),
(29, 1, 'feopzkefo', 0),
(37, 23, 'faire controlleur visiteur', 1),
(38, 23, 'faire controlleur user', 1),
(42, 23, 'pagination', 0),
(44, 1, 'coucou', 1),
(46, 2, 'ferfer', 1),
(47, 2, 'coucou', 1),
(48, 26, 'Breaking bad', 0),
(49, 26, 'The walking dead', 0),
(50, 26, 'La casa de Papel', 0),
(51, 26, 'Squid Game', 0),
(52, 26, 'Stranger things', 0),
(54, 3, 'Dark', 1),
(55, 3, 'Dark', 1),
(65, 3, 'd', 0),
(81, 23, 'connexion user', 1),
(82, 23, 'nettoyer valeur entree', 0),
(86, 47, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1),
(90, 2, 'Le roi des cons', 0),
(94, 56, 'Aller en cours', 0),
(100, 56, 'Minecraft', 0),
(106, 56, 'Faire cadeaux de Noel', 0),
(107, 77, 'ça marche pas :snif;', 0);

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `login` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`id`, `login`, `password`, `admin`) VALUES
(1, 'Caydo', '$2y$10$o89V2OvnDw//RUpCUJ8Wm.g57SU72Z7pFqGXOA4THvFhnkQ7jt9q2', 1),
(4, 'Evan', '$2y$10$gZDKgwZufIJlCkhlXBexdOBIXkxEfejZ6FlcfLELTEXUnRDXBPfGm', 1),
(6, 'Leana', '$2y$10$sHuvEZFbyeN/vFrFZBj4VeWeWxTduHAUqcOMs..JftAprscgCi4qC', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `List`
--
ALTER TABLE `List`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner`);

--
-- Index pour la table `Task`
--
ALTER TABLE `Task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list` (`list`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `List`
--
ALTER TABLE `List`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `Task`
--
ALTER TABLE `Task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `List`
--
ALTER TABLE `List`
  ADD CONSTRAINT `List_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `User` (`id`);

--
-- Contraintes pour la table `Task`
--
ALTER TABLE `Task`
  ADD CONSTRAINT `Task_ibfk_1` FOREIGN KEY (`list`) REFERENCES `List` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
