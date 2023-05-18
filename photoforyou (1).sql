-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 18 mai 2023 à 15:12
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `photoforyou`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertOrder` (IN `IdUser` INT, IN `Date` DATETIME)  MODIFIES SQL DATA BEGIN
  SET @idPanier = (SELECT Id FROM panier where panier.IdUser = IdUser);

  -- Insérer une nouvelle commande dans la table `orders`
  INSERT INTO orders (orders.IdUser, orders.date) VALUES (IdUSer, Date);
  
  -- Récupérer l'ID de la commande récemment insérée
  SET @last_order_id = LAST_INSERT_ID();

  -- On concatènes les ids des photos du panier actuel de l'utilisateur
  SET @idPhotos = (SELECT GROUP_CONCAT(IdPhoto SEPARATOR ', ') FROM panierphoto WHERE IdPanier = @idPanier GROUP BY IdPanier);
  SET @log = (SELECT CONCAT('Achats des photos : ', @idPhotos, ' Par l\'utilisateur : ' , IdUser));

  -- Enregistrer l'action dans la table `transaction_log`
  INSERT INTO transaction_log (OrderId, Transaction)
  VALUES (@last_order_id, @log);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`Id`, `Nom`, `Description`) VALUES
(1, 'Paysage', 'Montagne , mer'),
(2, 'Art Martiaux', 'Art Japonais'),
(3, 'Portrait', 'Visage Adulte , Enfant , ados');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `id_customers` int(11) NOT NULL,
  `credit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `idMenu` int(3) NOT NULL,
  `nomMenu` varchar(45) NOT NULL,
  `Lien` varchar(45) DEFAULT NULL,
  `Habilitation` char(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orderphoto`
--

CREATE TABLE `orderphoto` (
  `Id` int(11) NOT NULL,
  `IdOrder` int(11) NOT NULL,
  `IdPhoto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `Id` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`Id`, `IdUser`, `date`) VALUES
(3, 185, '0000-00-00 00:00:00'),
(4, 185, '0000-00-00 00:00:00'),
(5, 185, '0000-00-00 00:00:00'),
(6, 185, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `Id` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`Id`, `IdUser`) VALUES
(1, 184),
(23, 185),
(24, 265),
(25, 287),
(26, 288),
(27, 289),
(28, 290),
(29, 291);

-- --------------------------------------------------------

--
-- Structure de la table `panierphoto`
--

CREATE TABLE `panierphoto` (
  `Id` int(11) NOT NULL,
  `IdPanier` int(11) NOT NULL,
  `IdPhoto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panierphoto`
--

INSERT INTO `panierphoto` (`Id`, `IdPanier`, `IdPhoto`) VALUES
(90, 23, 21370),
(91, 23, 21371),
(93, 23, 21372),
(92, 23, 21373),
(94, 24, 21371),
(106, 29, 21370);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `TailleX` int(11) NOT NULL,
  `TailleY` int(11) NOT NULL,
  `Poids` int(11) NOT NULL,
  `IdProprietaire` int(11) NOT NULL,
  `IdCategory` int(11) NOT NULL,
  `Chemin` varchar(255) NOT NULL,
  `Prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`Id`, `Nom`, `TailleX`, `TailleY`, `Poids`, `IdProprietaire`, `IdCategory`, `Chemin`, `Prix`) VALUES
(21370, 'Madelyn', 1200, 1198, 0, 288, 3, 'uploads/PDP.jpg', 0),
(21371, 'as', 1200, 1198, 0, 288, 1, 'uploads/PDP.jpg', 0),
(21372, 'sa', 1080, 728, 0, 288, 1, 'uploads/2.png', 0),
(21373, 'Art Martiaux', 2048, 1386, 0, 288, 2, 'uploads/art martiaux.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `transaction_log`
--

CREATE TABLE `transaction_log` (
  `Id` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `Transaction` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `transaction_log`
--

INSERT INTO `transaction_log` (`Id`, `OrderId`, `Transaction`) VALUES
(1, 4, '21370, 21371, 21372, 21373'),
(2, 5, 'Achats des photos : 21370, 21371, 21372, 21373'),
(3, 6, 'Achats des photos : 21370, 21371, 21372, 21373 Par l\'utilisateur : 185');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Mail` varchar(300) NOT NULL,
  `Mdp` varchar(320) NOT NULL,
  `Credit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Id`, `Nom`, `Prenom`, `Type`, `Mail`, `Mdp`, `Credit`) VALUES
(287, 'moha', 'Moha', 'Admin', 'moha@gmail.com', '$2y$10$nv7Qq9BwARYwegY4sK.1xuWYaAmtAGFaV4QThINNChNa.wdrv.FSW', 1200),
(288, 'sa', 'Thomas', 'Photographe', 'tanti@gmail.com', '$2y$10$941rnHtX83jFYTSQoc6scup7zKr2rv03.FBC8zbE5rs3TIf9K3Bju', 0),
(289, 'enzo', 'enzo', 'client', 'enzo@gmail.com', '$2y$10$3grwzge6Jle7o4U7.IhyC.oaAdV.SMt20Dflz30W3I72KOA3blNiy', 0),
(290, 'as', 'as', 'client', 'tata@gmail.com', '$2y$10$sNCbQMNC6iYpzHpljyP4we5jwmhStcwqFPdf/6pDGS0lxAytvlYrK', 456465),
(291, 'salut', 'salut', 'Photographe', 'salut@gmail.com', '$2y$10$71JPkLnyvxCqckNQrfEGRes64IOqawCVWspxPVtWKI06pHdIOZJy6', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customers`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idMenu`),
  ADD UNIQUE KEY `nomMenu_UNIQUE` (`nomMenu`),
  ADD UNIQUE KEY `Lien_UNIQUE` (`Lien`);

--
-- Index pour la table `orderphoto`
--
ALTER TABLE `orderphoto`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `id_user_unique` (`IdUser`);

--
-- Index pour la table `panierphoto`
--
ALTER TABLE `panierphoto`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `id_photo_panier_unique` (`IdPanier`,`IdPhoto`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `category_fk` (`IdCategory`);

--
-- Index pour la table `transaction_log`
--
ALTER TABLE `transaction_log`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `mail_UNIQUE` (`Mail`),
  ADD KEY `Type` (`Type`,`Credit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customers` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orderphoto`
--
ALTER TABLE `orderphoto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `panierphoto`
--
ALTER TABLE `panierphoto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21374;

--
-- AUTO_INCREMENT pour la table `transaction_log`
--
ALTER TABLE `transaction_log`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
