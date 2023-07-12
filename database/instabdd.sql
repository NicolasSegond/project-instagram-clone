-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 12 juil. 2023 à 09:21
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
-- Base de données : `instabdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUSER` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `lieu` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `idUSER`, `description`, `lieu`, `date`, `image`) VALUES
(1, 1, 'Voici ma photo\r\n', '', '2023-07-11', '1105464006540.jpg'),
(2, 1, 'ma nouvelle photo de profil !! #profil', '', '2023-07-11', '4028287589268.jpg'),
(6, 1, 'un autre test', '', '2023-07-12', '3697025699828.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `nomUtilisateur` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `motdepasse` varchar(100) NOT NULL,
  `Biographie` varchar(100) DEFAULT NULL,
  `siteWeb` varchar(100) DEFAULT NULL,
  `telephone` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT 'noPP.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `nomUtilisateur`, `nom`, `motdepasse`, `Biographie`, `siteWeb`, `telephone`, `avatar`) VALUES
(1, 'nicolassegond0@gmail.com', 'Nicolas', 'Nicolas Segond', '877b8112b5defb67e7abc7f121943e40015cf747', '', '', '', '1.jpg'),
(2, 'test@test.fr', 'test', 'test', 'be308523aeebbeaf7fea2f4fe6a9c9db7a5b7df0', NULL, NULL, NULL, 'noPP.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
