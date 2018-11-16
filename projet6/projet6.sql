-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 16 nov. 2018 à 12:35
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet6`
--

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `cursus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`id`, `lastname`, `firstname`, `cursus`) VALUES
(4, 'Lerouge', 'Robert', 'POEC Symfony'),
(5, 'Baggio', 'Roberto', 'DNT1'),
(6, 'Lerouge', 'Robert', 'POEC Symfony'),
(7, 'Baggio', 'Roberto', 'DNT1'),
(8, 'Lerouge', 'Robert', 'POEC Symfony'),
(9, 'Gogol', 'Alex', 'DNT2'),
(10, 'El Bakari', 'Jean-Francis', 'POEC Symfony'),
(11, 'El Zonzon', 'Victor', 'DNT1'),
(12, 'Levert', 'Yacine', 'POEC Symfony'),
(13, 'Di Francesco', 'Philippe', 'DNT2'),
(14, 'Lerouge', 'Robert', 'POEC Symfony'),
(15, 'Lenoir', 'Vincent', 'DNT1'),
(16, 'El Karlouch', 'René', 'POEC Symfony'),
(17, 'Baggio', 'Roberto', 'DNT1'),
(18, 'Lerouge', 'Robert', 'POEC Symfony'),
(19, 'Gogol', 'Alex', 'DNT2'),
(20, 'El Bakari', 'Jean-Francis', 'POEC Symfony'),
(21, 'El Zonzon', 'Victor', 'DNT1'),
(22, 'Levert', 'Yacine', 'POEC Symfony'),
(23, 'Di Francesco', 'Philippe', 'DNT2'),
(24, 'Lerouge', 'Robert', 'POEC Symfony'),
(25, 'Lenoir', 'Vincent', 'DNT1'),
(26, 'El Karlouch', 'René', 'POEC Symfony'),
(27, 'Baggio', 'Roberto', 'DNT1'),
(28, 'Lerouge', 'Robert', 'POEC Symfony'),
(29, 'Gogol', 'Alex', 'DNT2'),
(30, 'El Bakari', 'Jean-Francis', 'POEC Symfony'),
(31, 'El Zonzon', 'Victor', 'DNT1'),
(32, 'Levert', 'Yacine', 'POEC Symfony'),
(33, 'Di Francesco', 'Philippe', 'DNT2'),
(34, 'Lerouge', 'Robert', 'POEC Symfony'),
(35, 'Lenoir', 'Vincent', 'DNT1'),
(36, 'El Karlouch', 'René', 'POEC Symfony'),
(37, 'Baggio', 'Roberto', 'DNT1'),
(38, 'Lerouge', 'Robert', 'POEC Symfony'),
(39, 'Gogol', 'Alex', 'DNT2'),
(40, 'El Bakari', 'Jean-Francis', 'POEC Symfony'),
(41, 'El Zonzon', 'Victor', 'DNT1'),
(42, 'Levert', 'Yacine', 'POEC Symfony'),
(43, 'Di Francesco', 'Philippe', 'DNT2'),
(44, 'Lerouge', 'Robert', 'POEC Symfony'),
(45, 'Lenoir', 'Vincent', 'DNT1'),
(46, 'El Karlouch', 'René', 'POEC Symfony'),
(47, 'Baggio', 'Roberto', 'DNT1'),
(48, 'Lerouge', 'Robert', 'POEC Symfony'),
(49, 'Gogol', 'Alex', 'DNT2'),
(50, 'El Bakari', 'Jean-Francis', 'POEC Symfony'),
(51, 'El Zonzon', 'Victor', 'DNT1'),
(52, 'Levert', 'Yacine', 'POEC Symfony'),
(53, 'Di Francesco', 'Philippe', 'DNT2'),
(54, 'Lerouge', 'Robert', 'POEC Symfony'),
(55, 'Lenoir', 'Vincent', 'DNT1'),
(56, 'El Karlouch', 'René', 'POEC Symfony'),
(57, 'Baggio', 'Roberto', 'DNT1'),
(58, 'Lerouge', 'Robert', 'POEC Symfony'),
(59, 'Gogol', 'Alex', 'DNT2'),
(60, 'El Bakari', 'Jean-Francis', 'POEC Symfony'),
(61, 'El Zonzon', 'Victor', 'DNT1'),
(62, 'Levert', 'Yacine', 'POEC Symfony'),
(63, 'Di Francesco', 'Philippe', 'DNT2'),
(64, 'Lerouge', 'Robert', 'POEC Symfony'),
(65, 'Lenoir', 'Vincent', 'DNT1'),
(66, 'El Karlouch', 'René', 'POEC Symfony'),
(67, 'Baggio', 'Roberto', 'DNT1'),
(68, 'Lerouge', 'Robert', 'POEC Symfony'),
(69, 'Gogol', 'Alex', 'DNT2'),
(70, 'El Bakari', 'Jean-Francis', 'POEC Symfony'),
(71, 'El Zonzon', 'Victor', 'DNT1'),
(72, 'Levert', 'Yacine', 'POEC Symfony'),
(73, 'Di Francesco', 'Philippe', 'DNT2'),
(74, 'Lerouge', 'Robert', 'POEC Symfony'),
(75, 'Lenoir', 'Vincent', 'DNT1'),
(76, 'El Karlouch', 'René', 'POEC Symfony'),
(77, 'Baggio', 'Roberto', 'DNT1'),
(78, 'Lerouge', 'Robert', 'POEC Symfony'),
(79, 'Gogol', 'Alex', 'DNT2'),
(80, 'El Bakari', 'Jean-Francis', 'POEC Symfony'),
(81, 'El Zonzon', 'Victor', 'DNT1'),
(82, 'Levert', 'Yacine', 'POEC Symfony'),
(83, 'Di Francesco', 'Philippe', 'DNT2'),
(84, 'Lerouge', 'Robert', 'POEC Symfony'),
(85, 'Lenoir', 'Vincent', 'DNT1'),
(86, 'El Karlouch', 'René', 'POEC Symfony'),
(87, 'Baggio', 'Roberto', 'DNT1'),
(88, 'Lerouge', 'Robert', 'POEC Symfony'),
(89, 'Gogol', 'Alex', 'DNT2'),
(90, 'El Bakari', 'Jean-Francis', 'POEC Symfony'),
(91, 'El Zonzon', 'Victor', 'DNT1'),
(92, 'Levert', 'Yacine', 'POEC Symfony'),
(93, 'Di Francesco', 'Philippe', 'DNT2'),
(94, 'Lerouge', 'Robert', 'POEC Symfony'),
(95, 'Lenoir', 'Vincent', 'DNT1'),
(96, 'El Karlouch', 'René', 'POEC Symfony'),
(97, 'Baggio', 'Roberto', 'DNT1'),
(98, 'Lerouge', 'Robert', 'POEC Symfony'),
(99, 'Gogol', 'Alex', 'DNT2'),
(100, 'El Bakari', 'Jean-Francis', 'POEC Symfony'),
(101, 'El Zonzon', 'Victor', 'DNT1'),
(102, 'Levert', 'Yacine', 'POEC Symfony'),
(103, 'Di Francesco', 'Philippe', 'DNT2'),
(104, 'Lerouge', 'Robert', 'POEC Symfony'),
(105, 'Lenoir', 'Vincent', 'DNT1'),
(106, 'El Karlouch', 'René', 'POEC Symfony'),
(107, 'Baggio', 'Roberto', 'DNT1'),
(108, 'Lerouge', 'Robert', 'POEC Symfony'),
(109, 'Gogol', 'Alex', 'DNT2'),
(110, 'El Bakari', 'Jean-Francis', 'POEC Symfony'),
(111, 'El Zonzon', 'Victor', 'DNT1'),
(112, 'Levert', 'Yacine', 'POEC Symfony'),
(113, 'Di Francesco', 'Philippe', 'DNT2'),
(114, 'Lerouge', 'Robert', 'POEC Symfony'),
(115, 'Lenoir', 'Vincent', 'DNT1'),
(116, 'El Karlouch', 'René', 'POEC Symfony');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
