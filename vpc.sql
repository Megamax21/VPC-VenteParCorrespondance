-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 02, 2024 at 06:40 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vpc`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_article`
--

DROP TABLE IF EXISTS `t_article`;
CREATE TABLE IF NOT EXISTS `t_article` (
  `Id_Article` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `genre` int NOT NULL,
  `reference` varchar(50) NOT NULL,
  `prix` float NOT NULL,
  `type` int NOT NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`Id_Article`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_article`
--

INSERT INTO `t_article` (`Id_Article`, `libelle`, `genre`, `reference`, `prix`, `type`, `stock`) VALUES
(1, 'T-shirt JAPAN', 0, '65833254', 22.99, 0, 68),
(2, 'Veste en cuir noir', 2, '72541836', 79.99, 6, 86),
(3, 'Pull en cachemire violet', 1, '63254718', 89.99, 9, 56),
(4, 'Chemise à carreaux', 0, '74102683', 59.99, 1, 79),
(5, 'Short en jean délavé', 0, '89531462', 39.99, 8, 46),
(6, 'Robe d\'été à fleurs', 1, '45872031', 69.99, 3, 82),
(7, 'Robe d\'été à motifs géométriques', 1, '92730584', 74.99, 3, 69),
(8, 'Veste en jean délavé', 0, '80461325', 49.99, 6, 61),
(9, 'T-shirt rayé à col rond', 2, '15684027', 25.99, 0, 54),
(10, 'Short cargo décontracté', 0, '76532189', 35.99, 8, 47),
(11, 'Sweat à capuche oversize', 2, '63120947', 45.99, 5, 59),
(12, 'Chemise en lin à motifs', 1, '87450321', 39.99, 1, 87),
(13, 'Pantalon de jogging décontract', 0, '51879642', 29.99, 2, 89),
(14, 'Veste en cuir brun', 2, '36925814', 59.99, 6, 80),
(15, 'T-shirt à manches longues à rayures verticales', 2, '90241735', 25.99, 0, 84),
(16, 'Robe chemise à rayures', 1, '63154820', 49.99, 1, 86),
(17, 'Short en denim déchiré', 2, '48573091', 35.99, 8, 84),
(18, 'Veste légère à capuche', 0, '72469031', 39.99, 6, 46),
(19, 'T-shirt basique à col en V', 1, '60841329', 25.99, 0, 30),
(20, 'Robe d\'été à motifs floraux', 1, '50398725', 45.99, 3, 51),
(21, 'Pull en laine côtelée', 2, '78961245', 55.99, 9, 86),
(22, 'Chemise en denim délavé', 0, '63258410', 29.99, 1, 51),
(23, 'Short en lin à taille élastique', 2, '72536981', 22.99, 8, 87),
(24, 'T-shirt à rayures horizontales', 1, '48721593', 35.99, 0, 35),
(25, 'Pull en laine à motif animal', 3, '72849561', 29.99, 9, 50),
(26, 'T-shirt à imprimé de dessin animé', 3, '61520743', 19.99, 0, 50),
(27, 'Robe à pois colorés', 3, '84361290', 24.99, 3, 80),
(28, 'Pantalon en coton à taille élastique', 3, '50783694', 20.99, 2, 89),
(29, 'Sweat à capuche à motif de super-héros', 3, '96234810', 34.99, 5, 82);

-- --------------------------------------------------------

--
-- Table structure for table `t_articles_commandes`
--

DROP TABLE IF EXISTS `t_articles_commandes`;
CREATE TABLE IF NOT EXISTS `t_articles_commandes` (
  `id_article` int NOT NULL,
  `id_commande` int NOT NULL,
  `nb_articles` int NOT NULL,
  `prix` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_articles_commandes`
--

INSERT INTO `t_articles_commandes` (`id_article`, `id_commande`, `nb_articles`, `prix`) VALUES
(27, 7, 4, 99.96),
(9, 7, 1, 25.99),
(11, 7, 5, 229.95),
(27, 7, 5, 124.95),
(10, 8, 2, 71.98),
(19, 7, 4, 103.96),
(14, 7, 4, 239.96),
(1, 7, 2, 45.98),
(3, 8, 3, 269.97),
(24, 8, 1, 35.99),
(2, 8, 2, 159.98),
(17, 8, 5, 179.95),
(10, 8, 4, 143.96),
(18, 7, 3, 119.97),
(20, 7, 1, 45.99);

-- --------------------------------------------------------

--
-- Table structure for table `t_clients`
--

DROP TABLE IF EXISTS `t_clients`;
CREATE TABLE IF NOT EXISTS `t_clients` (
  `Id_Client` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `adresse` text NOT NULL,
  `numero` varchar(10) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_Client`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_clients`
--

INSERT INTO `t_clients` (`Id_Client`, `nom`, `prenom`, `adresse`, `numero`, `mail`, `mdp`) VALUES
(1, 'Dubois', 'Camille', '12 Rue des Lilas\r\n75000, Villebourg', '0678123456', 'camille.dubois@gmail.com', 'Gf4#2Lq9!'),
(2, 'Lambert', 'Julien', '8 Avenue de la Liberté\r\n69001, Lyon', '0679456123', 'julien.lambert@example.com', 'Wp@7rE&5'),
(3, 'Dupont', 'Sophie', '25 Rue du Château\r\n75015, Paris', '0678234567', 'sophie.dupont@example.com', 'Kd#9xYp2!'),
(4, 'Martinette', 'Antoine', '42 Rue de la Paix\r\n31000, Toulouse', '0678012345', 'antoine.martin@example.com', 'Tq@6fZs3*'),
(0, 'nomtest', 'prenomtest', 'adresse test', '012345678', 'test@test.test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `t_commandes`
--

DROP TABLE IF EXISTS `t_commandes`;
CREATE TABLE IF NOT EXISTS `t_commandes` (
  `id_commande` int NOT NULL AUTO_INCREMENT,
  `date_commande` date NOT NULL,
  `id_client` int NOT NULL,
  `prix_commande` float NOT NULL,
  `validation` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_commande`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_commandes`
--

INSERT INTO `t_commandes` (`id_commande`, `date_commande`, `id_client`, `prix_commande`, `validation`) VALUES
(7, '2024-03-29', 1, 1036.71, 1),
(8, '2024-03-30', 3, 861.83, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_genre`
--

DROP TABLE IF EXISTS `t_genre`;
CREATE TABLE IF NOT EXISTS `t_genre` (
  `Id_Genre` int NOT NULL,
  `libelle_Genre` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_Genre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_genre`
--

INSERT INTO `t_genre` (`Id_Genre`, `libelle_Genre`) VALUES
(0, 'Homme'),
(1, 'Femme'),
(2, 'Unisexe'),
(3, 'Enfant');

-- --------------------------------------------------------

--
-- Table structure for table `t_types_vetements`
--

DROP TABLE IF EXISTS `t_types_vetements`;
CREATE TABLE IF NOT EXISTS `t_types_vetements` (
  `Id_Type` int NOT NULL,
  `libelle_type` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_Type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_types_vetements`
--

INSERT INTO `t_types_vetements` (`Id_Type`, `libelle_type`) VALUES
(0, 'T-shirt'),
(1, 'Chemise'),
(2, 'Pantalon'),
(3, 'Robe'),
(4, 'Jupe'),
(5, 'Sweat à capuche'),
(6, 'Veste'),
(7, 'Manteau'),
(8, 'Short'),
(9, 'Pull');

-- --------------------------------------------------------

--
-- Table structure for table `t_variables`
--

DROP TABLE IF EXISTS `t_variables`;
CREATE TABLE IF NOT EXISTS `t_variables` (
  `idVariable` char(1) NOT NULL,
  `libelleVariable` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `t_variables`
--

INSERT INTO `t_variables` (`idVariable`, `libelleVariable`) VALUES
('0', 'Bleu'),
('1', 'Rouge'),
('2', 'Jaune'),
('3', 'Vert'),
('4', 'Noir'),
('5', 'Blanc'),
('6', 'Gris'),
('7', 'Marron'),
('8', 'Violet'),
('9', 'Rose'),
('a', 'À carreaux'),
('b', 'Léopard'),
('c', 'Paisley'),
('d', 'Zèbre'),
('e', 'Cachemire'),
('f', 'Tartan'),
('g', 'Chevron'),
('h', 'Rayures'),
('i', 'Floral'),
('j', 'Camouflage'),
('k', 'Zigzag'),
('l', 'Géométrique'),
('m', 'Pied-de-poule'),
('n', 'Animal'),
('o', 'Pois'),
('p', 'Vichy'),
('q', 'Batik'),
('r', 'Plaid'),
('s', 'Broderie anglaise'),
('t', 'Chevron'),
('u', 'Tressé'),
('v', 'Paisley'),
('w', 'Géométrique'),
('x', 'Floral'),
('y', 'À carreaux'),
('z', 'Chevron'),
('A', 'Cuir'),
('B', 'Denim'),
('C', 'Satin'),
('D', 'Velours'),
('E', 'Lin'),
('F', 'Laine'),
('G', 'Soie'),
('H', 'Polyester'),
('I', 'Tweed'),
('J', 'Jersey'),
('K', 'Dentelle'),
('L', 'Nylon'),
('M', 'Fourrure'),
('N', 'Toile'),
('O', 'Daim'),
('P', 'Flanelle'),
('Q', 'Similicuir'),
('R', 'Brocart'),
('S', 'Tricot'),
('T', 'Tulle'),
('U', 'Velours'),
('V', 'Soie'),
('W', 'Coton'),
('X', 'Fibre de carbone'),
('Y', 'Polyester'),
('Z', 'Cuir verni');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
