-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 16 nov. 2018 à 12:34
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet3`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'argent'),
(2, 'courage'),
(3, 'sagesse'),
(4, 'amour'),
(5, 'amitié'),
(6, 'chance');

-- --------------------------------------------------------

--
-- Structure de la table `proverb`
--

CREATE TABLE `proverb` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `proverb`
--

INSERT INTO `proverb` (`id`, `body`) VALUES
(1, 'Il ne faut pas vendre la peau de l\'ours avant de l\'avoir tué'),
(2, 'Pierre qui roule n\'amasse pas ours'),
(3, 'Si vous voulez savoir la vérité, écoutez les fous.'),
(4, 'La mort est un vêtement que tout le monde portera.');

-- --------------------------------------------------------

--
-- Structure de la table `proverb_category`
--

CREATE TABLE `proverb_category` (
  `id` int(11) NOT NULL,
  `proverb_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `proverb_category`
--

INSERT INTO `proverb_category` (`id`, `proverb_id`, `category_id`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 2, 1),
(4, 3, 2),
(5, 4, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `proverb`
--
ALTER TABLE `proverb`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `proverb_category`
--
ALTER TABLE `proverb_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `proverb`
--
ALTER TABLE `proverb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `proverb_category`
--
ALTER TABLE `proverb_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
