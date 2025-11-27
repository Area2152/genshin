-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 27 nov. 2025 à 02:15
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mihoyo_tp`
--

-- --------------------------------------------------------

--
-- Structure de la table `element`
--

DROP TABLE IF EXISTS `element`;
CREATE TABLE IF NOT EXISTS `element` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url_img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `element`
--

INSERT INTO `element` (`id`, `name`, `url_img`) VALUES
(1, 'Pyro', 'https://upload-os-bbs.mihoyo.com/game_record/genshin/element_icon/UI_Element_Pyro.png'),
(2, 'Hydro', 'https://upload-os-bbs.mihoyo.com/game_record/genshin/element_icon/UI_Element_Hydro.png'),
(3, 'Electro', 'https://upload-os-bbs.mihoyo.com/game_record/genshin/element_icon/UI_Element_Electro.png'),
(4, 'Cryo', 'https://upload-os-bbs.mihoyo.com/game_record/genshin/element_icon/UI_Element_Cryo.png'),
(5, 'Anemo', 'https://upload-os-bbs.mihoyo.com/game_record/genshin/element_icon/UI_Element_Anemo.png'),
(6, 'Geo', 'https://upload-os-bbs.mihoyo.com/game_record/genshin/element_icon/UI_Element_Geo.png'),
(7, 'Dendro', 'https://upload-os-bbs.mihoyo.com/game_record/genshin/element_icon/UI_Element_Dendro.png');

-- --------------------------------------------------------

--
-- Structure de la table `origin`
--

DROP TABLE IF EXISTS `origin`;
CREATE TABLE IF NOT EXISTS `origin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url_img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `origin`
--

INSERT INTO `origin` (`id`, `name`, `url_img`) VALUES
(1, 'Mondstadt', 'https://static.wikia.nocookie.net/gensin-impact/images/0/0c/Region_Mondstadt_Icon.png'),
(2, 'Liyue', 'https://static.wikia.nocookie.net/gensin-impact/images/5/5b/Region_Liyue_Icon.png'),
(3, 'Inazuma', 'https://static.wikia.nocookie.net/gensin-impact/images/5/5a/Region_Inazuma_Icon.png'),
(4, 'Sumeru', 'https://static.wikia.nocookie.net/gensin-impact/images/3/34/Region_Sumeru_Icon.png');

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

DROP TABLE IF EXISTS `personnage`;
CREATE TABLE IF NOT EXISTS `personnage` (
  `id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `element` int NOT NULL,
  `unitclass` int NOT NULL,
  `origin` int DEFAULT NULL,
  `rarity` int NOT NULL,
  `url_img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_personnage_element` (`element`),
  KEY `fk_personnage_origin` (`origin`),
  KEY `fk_personnage_unitclass` (`unitclass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `personnage`
--

INSERT INTO `personnage` (`id`, `name`, `element`, `unitclass`, `origin`, `rarity`, `url_img`) VALUES
('perso_ayaka', 'Kamisato Ayaka', 4, 1, 3, 5, 'https://upload-os-bbs.mihoyo.com/game_record/genshin/character_icon/UI_AvatarIcon_Ayaka.png'),
('perso_diluc', 'Diluc', 1, 2, 1, 5, 'https://upload-os-bbs.mihoyo.com/game_record/genshin/character_icon/UI_AvatarIcon_Diluc.png'),
('perso_ganyu', 'Ganyu', 4, 4, 2, 5, 'https://upload-os-bbs.mihoyo.com/game_record/genshin/character_icon/UI_AvatarIcon_Ganyu.png'),
('perso_hutao', 'Hu Tao', 1, 3, 2, 5, 'https://upload-os-bbs.mihoyo.com/game_record/genshin/character_icon/UI_AvatarIcon_Hutao.png'),
('perso_keqing', 'Keqing', 3, 1, 3, 5, 'https://upload-os-bbs.mihoyo.com/game_record/genshin/character_icon/UI_AvatarIcon_Keqing.png'),
('perso_nahida', 'Nahida', 7, 5, 4, 5, 'https://upload-os-bbs.mihoyo.com/game_record/genshin/character_icon/UI_AvatarIcon_Nahida.png'),
('perso_raiden', 'Raiden Shogun', 3, 3, 3, 5, 'https://upload-os-bbs.mihoyo.com/game_record/genshin/character_icon/UI_AvatarIcon_Shougun.png'),
('perso_venti', 'Venti', 5, 4, 1, 5, 'https://upload-os-bbs.mihoyo.com/game_record/genshin/character_icon/UI_AvatarIcon_Venti.png'),
('perso_xiao', 'Xiao', 5, 3, 2, 5, 'https://upload-os-bbs.mihoyo.com/game_record/genshin/character_icon/UI_AvatarIcon_Xiao.png'),
('perso_zhongli', 'Zhongli', 6, 3, 2, 5, 'https://upload-os-bbs.mihoyo.com/game_record/genshin/character_icon/UI_AvatarIcon_Zhongli.png');

-- --------------------------------------------------------

--
-- Structure de la table `unitclass`
--

DROP TABLE IF EXISTS `unitclass`;
CREATE TABLE IF NOT EXISTS `unitclass` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url_img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `unitclass`
--

INSERT INTO `unitclass` (`id`, `name`, `url_img`) VALUES
(1, 'Sword', 'https://upload-os-bbs.mihoyo.com/game_record/genshin/weapon_icon/UI_EquipIcon_Sword.png'),
(2, 'Claymore', 'https://upload-os-bbs.mihoyo.com/game_record/genshin/weapon_icon/UI_EquipIcon_Claymore.png'),
(3, 'Polearm', 'https://upload-os-bbs.mihoyo.com/game_record/genshin/weapon_icon/UI_EquipIcon_Pole.png'),
(4, 'Bow', 'https://upload-os-bbs.mihoyo.com/game_record/genshin/weapon_icon/UI_EquipIcon_Bow.png'),
(5, 'Catalyst', 'https://upload-os-bbs.mihoyo.com/game_record/genshin/weapon_icon/UI_EquipIcon_Catalyst.png'),
(6, 'Ak 47', 'https://nextgun.ch/wp-content/uploads/2024/11/ak-47-scaled.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `hash_pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `hash_pwd`) VALUES
('user_admin_1', 'admin', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD CONSTRAINT `fk_personnage_element` FOREIGN KEY (`element`) REFERENCES `element` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_personnage_origin` FOREIGN KEY (`origin`) REFERENCES `origin` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_personnage_unitclass` FOREIGN KEY (`unitclass`) REFERENCES `unitclass` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
