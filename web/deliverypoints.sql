-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 05 Décembre 2014 à 17:08
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
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postalCode` varchar(6) NOT NULL,
  `city` varchar(255) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Contenu de la table `deliverypoints`
--

INSERT INTO `deliverypoints` (`id`, `name`, `address`, `postalCode`, `city`, `dateCreated`, `dateModified`, `longitude`, `latitude`) VALUES
(1, 'Libria ', ' 82 Passage Choiseul ', '75002', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3356084', '48.8685692'),
(2, 'Telecom Star ', ' 15 Bd de Bonne Nouvelle ', '75002', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3502658', '48.8698981'),
(3, 'Hypso Reprographie ', ' 53 rue de Montmorency ', '75003', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3527359', '48.8636854'),
(4, 'BM Pressing ', ' 4 Bis Bd Morland ', '75004', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3652867', '48.8479797'),
(5, 'Game Cash / CG Paris 5 ', ' 21 rue Monge ', '75005', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3511386', '48.8475683'),
(6, 'Chez Florence ', ' 11 rue Dauphine ', '75006', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3402219', '48.8556721'),
(7, 'Aux Fleurs du Bac ', ' 69 rue du Bac ', '75007', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3249554', '48.8550888'),
(8, 'Cordonnerie Serrurerie Grenell ', ' 165 rue de Grenelle ', '75007', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3057313', '48.8575684'),
(9, 'Clean Pressing ', ' 15 rue Manuel ', '75009', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3400134', '48.8783011'),
(10, 'Luffy ', ' 35 rue de Clichy ', '75009', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3289415', '48.879328'),
(11, 'Les Coteaux de Saumur ', ' 10 rue Bichat ', '75010', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3692741', '48.8700211'),
(12, 'Magenta Art Deco ', ' 34 Ter rue du Dunkerque ', '75010', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3505072', '48.8809733'),
(13, 'Baticlean 75 ', ' 191 rue de Charonne ', '75011', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.393119', '48.856377'),
(14, 'Cala Thé A ', ' 133 rue de Montreuil ', '75011', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.397644', '48.8514472'),
(15, 'A Livr'' Ouvert ', ' 171 Bis Bd Voltaire ', '75011', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3860138', '48.8545703'),
(16, 'Pressing Boulle ', ' 13 rue Boulle ', '75011', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3728342', '48.8569115'),
(17, 'B.C.B.G / SARL Fleuve Bleu ', ' 18 rue Jules Valles ', '75011', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3851335', '48.8540711'),
(18, 'L''Atelier du Trèfles Cadeaux ', ' 13 Bis Avenue Philippe Auguste ', '75011', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3942686', '48.8501871'),
(19, 'Lio Optic ', ' 44 Bd Diderot ', '75012', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3784861', '48.8462622'),
(20, 'A.M Presse Bizot ', ' 116 Av Général Michel Bizot ', '75012', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.4044927', '48.8396579'),
(21, 'Alanpark ', ' 105 rue de Charenton ', '75013', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3782127', '48.8472906'),
(22, 'Okbi Presse ', ' 91 rue de Barrault ', '75013', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3469358', '48.823017'),
(23, 'Encherexpert ', ' 51 rue de Clisson ', '75013', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3663574', '48.8309766'),
(24, 'Maison de la Presse ', ' 137 Bd Auguste Blanqui ', '75013', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3431247', '48.8308794'),
(25, 'Ideal Optic ', ' 101 Av de France ', '75013', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3772068', '48.8296561'),
(26, 'Chryzalys ', ' 206 Bd Raspail ', '75014', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3293231', '48.8414463'),
(27, 'Agip Papeterie Côté Sud ', ' 133 Av du Maine ', '75014', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3241331', '48.8345688'),
(28, 'Animalerie Little Zoo ', ' 40 Bd Brune ', '75014', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.309583', '48.8264003'),
(29, 'Cordonnerie B.V.F ', ' 22 rue des Volontaires ', '75015', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3071987', '48.842023'),
(30, 'Moveux ', ' 14 rue Dupleix ', '75015', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.2977362', '48.8517255'),
(31, 'Saveurs du Sud ', ' 14 Av Félix Faure ', '75015', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.2909755', '48.8424645'),
(32, 'Anwa ', ' 105 Bis rue des Entrepreneurs ', '75015', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.2935086', '48.8436838'),
(33, 'Mercerie Poncet ', ' 15 rue Daumier ', '75016', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.2634743', '48.8394792'),
(34, 'Vu du XII ', ' 96 Av de Mozart ', '75016', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.2670679', '48.851054'),
(35, 'Centre Literie ', ' 2 Bd Bessières ', '75017', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3290144', '48.8977414'),
(36, 'Salon Marylène ', ' 45 rue Brochant ', '75017', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.319679', '48.8904377'),
(37, 'Allo Micro ', ' 117 rue Legendre ', '75017', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.322383', '48.8890866'),
(38, 'Encherexpert ', ' 61 rue Guy Moquet ', '75017', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.325704', '48.8929067'),
(39, 'Au Rocher de Joie ', ' 12 rue Lamarck ', '75018', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3445903', '48.8870679'),
(40, 'Consoplus Informatique ', ' 8 Bd Ney ', '75018', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3695656', '48.8986866'),
(41, 'Unity Génération ', ' 17 rue Simart ', '75018', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3480412', '48.8906673'),
(42, 'Isabelle Cherchevsky Atelier ', ' 15 rue Lagouat ', '75018', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3547963', '48.887779'),
(43, 'Labelencre ', ' 10 Av de La porte Brunet ', '75019', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3964376', '48.8834056'),
(44, 'Prim Plus ', ' 9 rue du Cher ', '75020', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3997485', '48.8644824'),
(45, 'Cadeaux Chics ', ' 27 rue Saint Fargeau ', '75020', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.4006581', '48.8721121'),
(46, 'Optic 62 ', ' 62 rue de Belleville ', '75020', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3828303', '48.8733272'),
(47, 'Pressing 113 ', ' 113 Bd Davout ', '75020', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.4099964', '48.8562597'),
(48, 'Copy Conforme ', ' 25 rue Gatinée ', '75020', 'Paris', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2.3522219', '48.856614');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
