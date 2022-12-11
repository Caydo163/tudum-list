-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 11 déc. 2022 à 15:24
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tudum-list`
--

-- --------------------------------------------------------

--
-- Structure de la table `list`
--

DROP TABLE IF EXISTS `list`;
CREATE TABLE IF NOT EXISTS `list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `owner` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `list`
--

INSERT INTO `list` (`id`, `name`, `owner`) VALUES
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
(77, 'Tésté', NULL),
(78, 'dazdaz', NULL),
(79, 'liste 1', 7),
(81, 'liste 3', 7),
(82, 'Allocine', 7),
(89, 'Ma premiere liste', 17),
(95, 'ééé', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `achieve` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `list` (`list`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id`, `list`, `name`, `achieve`) VALUES
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
(82, 23, 'nettoyer valeur entrée', 0),
(86, 47, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1),
(90, 2, 'Le roi des cons', 0),
(94, 56, 'Aller en cours', 0),
(100, 56, 'Minecraft', 0),
(106, 56, 'Faire cadeaux de Noel', 0),
(107, 77, 'ça marche pas :snif;', 0),
(108, 78, 'ddzedzd', 0),
(113, 55, 'k', 1),
(114, 78, 'dezdze', 0),
(116, 82, 'michel', 1),
(117, 79, 'tache 1', 0),
(119, 81, 'tache 1', 1),
(123, 82, 'dzedzedz', 0),
(128, 89, 'azdazda', 0),
(129, 89, 'blazor', 0),
(131, 95, 'éé', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `admin`) VALUES
(1, 'Caydo', '$2y$10$o89V2OvnDw//RUpCUJ8Wm.g57SU72Z7pFqGXOA4THvFhnkQ7jt9q2', 1),
(4, 'Evan', '$2y$10$gZDKgwZufIJlCkhlXBexdOBIXkxEfejZ6FlcfLELTEXUnRDXBPfGm', 1),
(6, 'Leana', '$2y$10$sHuvEZFbyeN/vFrFZBj4VeWeWxTduHAUqcOMs..JftAprscgCi4qC', 1),
(7, 'michel', '$2y$10$UkesCctCWa0JziVjQ3gvWeLch6zjpTzMycNnqIqEWNatT/WqXxbDu', 0),
(13, 'login1', '$2y$10$ae4/9V3prjlD3I6YzPrJ9.vjEuCMUin/STU4gimlvSjPcgOu85uOi', 0),
(14, 'login2', '$2y$10$MNsnyYe0lGRagoIBE57qKeLgfGLxAi1qZg3MTCUu5RoV1hZPDcDcW', 0),
(15, 'login3', '$2y$10$7RoEyzcDi79ru/7Drm6NXO9de7hHNfZAPs3Ajb/jJZVpMmtqvvI/.', 0),
(17, 'toto', '$2y$10$z1WfTYiVetGxj06qDMFl3.EtMuueAN6eanB0IiL1Qaj5UHJMi/Y6W', 0),
(18, 'titi', '$2y$10$ypQWS5IURltfUXmNdyrADOUwtIFOnlYSkpbY3bw6l5seGlc0EBHqC', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `list`
--
ALTER TABLE `list`
  ADD CONSTRAINT `list_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `Task_ibfk_1` FOREIGN KEY (`list`) REFERENCES `list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
