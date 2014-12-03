-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 03 Décembre 2014 à 17:01
-- Version du serveur :  5.6.16
-- Version de PHP :  5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bdloc`
--

-- --------------------------------------------------------

--
-- Structure de la table `deliverypoints`
--

CREATE TABLE IF NOT EXISTS `deliverypoints` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postalCode` smallint(6) NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=289 ;

--
-- Contenu de la table `deliverypoints`
--

INSERT INTO `deliverypoints` (`id`, `name`, `address`, `postalCode`, `city`, `dateCreated`, `dateModified`) VALUES
(241, 'Libria', '82 Passage Choiseul', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(242, 'Telecom Star', '15 Bd de Bonne Nouvelle', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(243, 'Hypso Reprographie', '53 rue de Montmorency', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(244, 'BM Pressing', '4 Bis Bd Morland', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(245, 'Game Cash / CG Paris 5', '21 rue Monge', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(246, 'Chez Florence', '11 rue Dauphine', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(247, 'Aux Fleurs du Bac', '69 rue du Bac', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(248, 'Cordonnerie Serrurerie Grenell', '165 rue de Grenelle', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(249, 'Clean Pressing', '15 rue Manuel', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(250, 'Luffy', '35 rue de Clichy', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(251, 'Les Coteaux de Saumur', '10 rue Bichat', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(252, 'Magenta Art Deco', '34 Ter rue du Dunkerque', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(253, 'Baticlean 75', '191 rue de Charonne', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(254, 'Cala Thé A', '133 rue de Montreuil', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(255, 'A Livr'' Ouvert', '171 Bis Bd Voltaire', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(256, 'Pressing Boulle', '13 rue Boulle', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(257, 'B.C.B.G / SARL Fleuve Bleu', '18 rue Jules Valles', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(258, 'L''Atelier du Trèfles Cadeaux', '13 Bis Avenue Philippe Auguste', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(259, 'Lio Optic', '44 Bd Diderot', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(260, 'A.M Presse Bizot', '116 Av Général Michel Bizot', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(261, 'Alanpark', '105 rue de Charenton', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(262, 'Okbi Presse', '91 rue de Barrault', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(263, 'Encherexpert', '51 rue de Clisson', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(264, 'Maison de la Presse', '137 Bd Auguste Blanqui', 32767, 'Paris', '2014-12-03 16:59:40', '2014-12-03 16:59:40'),
(265, 'Ideal Optic', '101 Av de France', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(266, 'Chryzalys', '206 Bd Raspail', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(267, 'Agip Papeterie Côté Sud', '133 Av du Maine', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(268, 'Animalerie Little Zoo', '40 Bd Brune', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(269, 'Cordonnerie B.V.F', '22 rue des Volontaires', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(270, 'Moveux', '14 rue Dupleix', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(271, 'Saveurs du Sud', '14 Av Félix Faure', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(272, 'Anwa', '105 Bis rue des Entrepreneurs', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(273, 'Mercerie Poncet', '15 rue Daumier', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(274, 'Vu du XII', '96 Av de Mozart', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(275, 'Centre Literie', '2 Bd Bessières', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(276, 'Salon Marylène', '45 rue Brochant', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(277, 'Allo Micro', '117 rue Legendre', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(278, 'Encherexpert', '61 rue Guy Moquet', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(279, 'Au Rocher de Joie', '12 rue Lamarck', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(280, 'Consoplus Informatique', '8 Bd Ney', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(281, 'Unity Génération', '17 rue Simart', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(282, 'Isabelle Cherchevsky Atelier', '15 rue Lagouat', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(283, 'Labelencre', '10 Av de La porte Brunet', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(284, 'Prim Plus', '9 rue du Cher', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(285, 'Cadeaux Chics', '27 rue Saint Fargeau', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(286, 'Optic 62', '62 rue de Belleville', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(287, 'Pressing 113', '113 Bd Davout', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41'),
(288, 'Copy Conforme', '25 rue Gatinée', 32767, 'Paris', '2014-12-03 16:59:41', '2014-12-03 16:59:41');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
