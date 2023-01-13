-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 12 jan. 2023 à 07:45
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `designation`
--

-- --------------------------------------------------------

--
-- Structure de la table `absences`
--

CREATE TABLE `absences` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `motifs_id` int(11) DEFAULT NULL,
  `personnels_id` int(11) DEFAULT NULL,
  `date_debut_abs` datetime NOT NULL,
  `date_fin_abs` datetime NOT NULL,
  `abs_created` datetime NOT NULL,
  `abs_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `autres`
--

CREATE TABLE `autres` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `personnels_id` int(11) DEFAULT NULL,
  `services_id` int(11) DEFAULT NULL,
  `autre_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `autres`
--

INSERT INTO `autres` (`id`, `user_id`, `personnels_id`, `services_id`, `autre_created`) VALUES
(6, 1, 8, 4, '2023-01-06 06:51:42');

-- --------------------------------------------------------

--
-- Structure de la table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) NOT NULL,
  `personnels_id` int(11) DEFAULT NULL,
  `transports_id` int(11) DEFAULT NULL,
  `munitions_id` int(11) DEFAULT NULL,
  `type_armements_id` int(11) DEFAULT NULL,
  `tenues_id` int(11) DEFAULT NULL,
  `services_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_depart_design` datetime NOT NULL,
  `date_retour_design` datetime NOT NULL,
  `distance` double DEFAULT NULL,
  `itineraire` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desgn_created` datetime NOT NULL,
  `design_updated` datetime DEFAULT NULL,
  `suite_a_donner` longblob,
  `observations` longblob,
  `ordre_speciaux` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `designations`
--

INSERT INTO `designations` (`id`, `personnels_id`, `transports_id`, `munitions_id`, `type_armements_id`, `tenues_id`, `services_id`, `user_id`, `date_depart_design`, `date_retour_design`, `distance`, `itineraire`, `desgn_created`, `design_updated`, `suite_a_donner`, `observations`, `ordre_speciaux`) VALUES
(7, 6, 1, 2, 1, 1, 1, NULL, '2023-01-06 09:51:00', '2023-01-07 09:51:00', 20, NULL, '2023-01-06 06:52:17', '2023-01-06 06:52:17', NULL, NULL, 'CONTROLE VISITE TECHIQUE');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `motifs`
--

CREATE TABLE `motifs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `libelle_mtf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `abreviation_mtf` varchar(124) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mtf_created` datetime NOT NULL,
  `mtf_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `motifs`
--

INSERT INTO `motifs` (`id`, `user_id`, `libelle_mtf`, `abreviation_mtf`, `mtf_created`, `mtf_updated`) VALUES
(3, 1, 'Permission à titre convalescence', 'PATC', '2023-01-06 05:38:12', '2023-01-06 05:38:12'),
(4, 1, 'Permission', 'PERM', '2023-01-06 05:38:22', '2023-01-06 05:38:22'),
(5, 1, 'Permission libérable', 'PERM LIB', '2023-01-06 05:38:59', '2023-01-06 05:38:59'),
(6, 1, 'Cas social', 'CAS SOCIAL', '2023-01-06 05:40:05', '2023-01-06 05:40:05'),
(7, 1, 'Repos sanitaire', 'REPOS SAN', '2023-01-06 05:40:54', '2023-01-06 05:40:54');

-- --------------------------------------------------------

--
-- Structure de la table `munitions`
--

CREATE TABLE `munitions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `mun_created` datetime NOT NULL,
  `mun_updated` datetime DEFAULT NULL,
  `nom_mun` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `lot_mun` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `calibre_mun` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `munitions`
--

INSERT INTO `munitions` (`id`, `user_id`, `mun_created`, `mun_updated`, `nom_mun`, `lot_mun`, `calibre_mun`) VALUES
(2, 1, '2022-12-27 07:28:07', NULL, 'Munitions : 7,62 × 39 mm M43', '1891', 7.62),
(3, 1, '2023-01-06 05:52:16', NULL, 'Calibre 7.5x54 MAS', '2345', 7.5),
(4, 1, '2023-01-06 05:53:02', NULL, 'calibre 9X19mm', '135', 9);

-- --------------------------------------------------------

--
-- Structure de la table `personnels`
--

CREATE TABLE `personnels` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `matricule_pers` int(11) NOT NULL,
  `grade_pers` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `nom_pers` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `prenoms_pers` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fonctions_pers` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `is_out_cr` tinyint(1) NOT NULL,
  `pers_created` datetime NOT NULL,
  `pers_updated` datetime DEFAULT NULL,
  `unites_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `personnels`
--

INSERT INTO `personnels` (`id`, `user_id`, `matricule_pers`, `grade_pers`, `nom_pers`, `prenoms_pers`, `fonctions_pers`, `is_out_cr`, `pers_created`, `pers_updated`, `unites_id`) VALUES
(4, 1, 18448, 'GPCE', 'RAFIDIMANANA', 'Raharison Rivo', 'CHAUFF', 0, '2023-01-06 05:28:23', NULL, 4),
(5, 1, 20195, 'GPHC', 'RAVONIARIJAONA', 'Tinarivo', 'ACB', 0, '2023-01-06 05:29:03', NULL, 4),
(6, 1, 24726, 'GP2C', 'RAKOTONDRAZAKA', 'Anthony Andry', 'ENC', 0, '2023-01-06 05:30:51', NULL, 4),
(7, 1, 22099, 'G1C', 'RANDRIANATOANDRO', 'Santatriniaina Liva', 'SG', 0, '2023-01-06 05:31:44', NULL, 4),
(8, 1, 24786, 'G1C', 'RAMISARIVO', 'Samimila Marie Angelo', 'SG', 0, '2023-01-06 05:32:31', NULL, 4),
(9, 1, 25399, 'G2C', 'MANOARIJAONA', 'Hery William', 'SG', 0, '2023-01-06 05:33:07', NULL, 4),
(10, 1, 25868, 'G2C', 'RA-PHILLIPSON', 'Yves Célestin', 'SG', 0, '2023-01-06 05:33:43', '2023-01-06 05:33:55', 4),
(11, 1, 25954, 'G2C', 'RAVO', 'Ismael', 'SG', 0, '2023-01-06 05:34:40', NULL, 4),
(12, 1, 26246, 'G2C', 'RASOLONALINJATOVO', 'Sahaza', 'SG', 0, '2023-01-06 05:35:45', NULL, 4),
(13, 1, 25568, 'G2C', 'RAKOTO', 'Harimanantsoa Claude Fabien', 'SG', 0, '2023-01-06 05:36:35', NULL, 4),
(14, 1, 1, 'LTN', 'RAKOTONINDRIANA', 'Rijanantenaina', 'CB', 0, '2023-01-06 06:38:45', '2023-01-06 06:48:01', 4);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `types_service_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nom_sce` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `sce_created` datetime NOT NULL,
  `sce_updated` datetime DEFAULT NULL,
  `abreviation_sce` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `types_service_id`, `user_id`, `nom_sce`, `sce_created`, `sce_updated`, `abreviation_sce`) VALUES
(1, 1, 2, 'POLICE DE LA ROUTE', '2022-12-21 06:24:14', NULL, NULL),
(2, 2, 2, 'SERVICE D\'ORDRE', '2022-12-21 06:24:48', NULL, NULL),
(3, 4, 1, 'PATROUILLE', '2022-12-27 07:59:26', '2022-12-30 07:33:50', NULL),
(4, 3, 2, 'PLANTON', '2022-12-27 08:00:35', NULL, 'PL'),
(5, 3, 1, 'PREMIER MARCHE', '2022-12-27 11:25:31', '2023-01-05 17:14:44', 'PAM'),
(6, 1, 1, 'MISSION', '2022-12-27 12:59:17', NULL, 'MS'),
(7, 4, 1, 'SURVEILLANCE DES POINTS SENSIBLES LIEUX PUBLICS', '2023-01-06 06:19:05', NULL, NULL),
(8, 3, 1, 'ENQUETES ET REMISE DES PIECES', '2023-01-06 06:19:26', NULL, NULL),
(10, 3, 1, 'REMPLACENT', '2023-01-06 06:20:58', NULL, 'REMPL'),
(11, 3, 1, 'ENTRETIEN CASERNEMENT', '2023-01-06 06:21:33', NULL, 'EC');

-- --------------------------------------------------------

--
-- Structure de la table `tenues`
--

CREATE TABLE `tenues` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nom_tn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numero_tn` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `tn_created` datetime NOT NULL,
  `tn_updated` datetime DEFAULT NULL,
  `abreviation_tn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `tenues`
--

INSERT INTO `tenues` (`id`, `user_id`, `nom_tn`, `numero_tn`, `tn_created`, `tn_updated`, `abreviation_tn`) VALUES
(1, 1, 'TENUE DE CEREMONIE D\'ETE', '1', '2022-12-21 06:25:54', '2023-01-06 06:01:03', 'NR 1'),
(2, 1, 'TENUE DE TRAVAIL', '42', '2022-12-26 08:31:02', '2023-01-06 06:06:48', 'NR 42'),
(3, 1, 'TENUE DE CEREMONIE D\'ETE', '1 BIS', '2022-12-26 09:01:00', '2023-01-06 06:00:48', 'NR 1 BIS'),
(4, 1, 'TENUE DE CEREMONIE D\'ETE', '1 C', '2023-01-06 06:01:27', NULL, 'NR 1 C'),
(5, 1, 'TENUE DE TRAVAIL', '31', '2023-01-06 06:04:22', NULL, 'NR 31'),
(6, 1, 'TENUE DE TRAVAIL', '32', '2023-01-06 06:04:46', NULL, 'NR 32'),
(7, 1, 'TENUE DE TRAVAIL', '33', '2023-01-06 06:05:13', NULL, 'NR 33'),
(8, 1, 'TENUE DE TRAVAIL', '34', '2023-01-06 06:05:33', NULL, 'NR 34'),
(9, 1, 'TENUE DE TRAVAIL', '41', '2023-01-06 06:06:00', NULL, 'NR 41'),
(10, 1, 'TENUE DE TRAVAIL', '41 BIS', '2023-01-06 06:06:28', NULL, 'NR 41 BIS'),
(11, 1, 'TENUE DE TRAVAIL', '42 BIS', '2023-01-06 06:07:15', NULL, 'NR 42 BIS');

-- --------------------------------------------------------

--
-- Structure de la table `transports`
--

CREATE TABLE `transports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nom_transp` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `abreviation_transp` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transp_created` datetime NOT NULL,
  `transp_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `transports`
--

INSERT INTO `transports` (`id`, `user_id`, `nom_transp`, `abreviation_transp`, `transp_created`, `transp_updated`) VALUES
(1, 2, 'VOITURE', 'VT', '2022-12-21 06:21:36', NULL),
(2, 1, 'A PIEDS', 'A PIEDS', '2022-12-27 07:53:45', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `types_services`
--

CREATE TABLE `types_services` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nom_type_sce` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `abreviation_type_sce` varchar(124) COLLATE utf8_unicode_ci DEFAULT NULL,
  `typesce_created` datetime NOT NULL,
  `typesce_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `types_services`
--

INSERT INTO `types_services` (`id`, `user_id`, `nom_type_sce`, `abreviation_type_sce`, `typesce_created`, `typesce_updated`) VALUES
(1, 2, 'EXTERNE', 'EXT', '2022-12-21 06:22:08', NULL),
(2, 2, 'DIVERS', 'DVR', '2022-12-21 06:22:18', NULL),
(3, 2, 'AU BUREAU', 'BUR', '2022-12-21 06:22:26', NULL),
(4, 2, 'A RESIDENCE', 'RESID', '2022-12-21 06:23:40', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_armements`
--

CREATE TABLE `type_armements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nom_arm` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `abreviation_arm` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arm_created` datetime NOT NULL,
  `arm_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `type_armements`
--

INSERT INTO `type_armements` (`id`, `user_id`, `nom_arm`, `abreviation_arm`, `arm_created`, `arm_updated`) VALUES
(1, 1, 'Fusil d\'assaut', 'FA', '2022-12-21 06:18:02', '2023-01-06 05:51:04'),
(2, 1, 'PISTOLET AUTOMATIQUE', 'PA', '2022-12-27 07:55:01', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `unites`
--

CREATE TABLE `unites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nom_ute` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `localite_ute` varchar(124) COLLATE utf8_unicode_ci NOT NULL,
  `abreviation_ute` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `contact_ute` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ute_created` datetime NOT NULL,
  `ute_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `unites`
--

INSERT INTO `unites` (`id`, `user_id`, `nom_ute`, `localite_ute`, `abreviation_ute`, `contact_ute`, `ute_created`, `ute_updated`) VALUES
(1, 1, 'CIRCONSCRIPTION', 'ANTANANARIVO', 'CIRGN', '0341245879', '2022-12-21 07:06:31', '2022-12-26 04:28:24'),
(2, 2, 'GROUPEMENT', 'ANALAMANGA', 'GPT', '0347777603', '2022-12-21 07:07:21', NULL),
(3, 1, 'COMPAGNIE', 'IMERINA CENTRALE', 'CIE', '0341245879', '2022-12-26 04:28:09', NULL),
(4, 1, 'BRIGADE', 'ANTANANARIVO VILLE', 'BDE', '0341245879', '2022-12-27 09:54:57', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `is_active`) VALUES
(1, 'root', '[\"ROLE_ADMIN\"]', '$2y$13$hlXlgYPlkD3ALHOW9Fkbf.cSIJS8FzwgylNSJP.Be2mfMYj1XgGjW', 0),
(2, 'Tantely', '[\"ROLE_ADMIN\", \"ROLE_USER\", \"ROLE_STAFF\"]', '$2y$13$LTXi0mwLUpa/HOC3w56fFeaqdnZKfyKUCn273CDUnjSCqBV/3ctZK', 1),
(3, 'Tanteliniaina', '[]', '$2y$13$uTdbex9OG9YHh3EvDD5paOsINQqE5HkAhn3SUsXsyWPSM/bRGmYTe', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F9C0EFFFA76ED395` (`user_id`),
  ADD KEY `IDX_F9C0EFFF83CAFB5D` (`motifs_id`),
  ADD KEY `IDX_F9C0EFFFC7022806` (`personnels_id`);

--
-- Index pour la table `autres`
--
ALTER TABLE `autres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_21F62672A76ED395` (`user_id`),
  ADD KEY `IDX_21F62672C7022806` (`personnels_id`),
  ADD KEY `IDX_21F62672AEF5A6C1` (`services_id`);

--
-- Index pour la table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6536F4D7C7022806` (`personnels_id`),
  ADD KEY `IDX_6536F4D7518E99D9` (`transports_id`),
  ADD KEY `IDX_6536F4D774ADA7AB` (`munitions_id`),
  ADD KEY `IDX_6536F4D797841149` (`type_armements_id`),
  ADD KEY `IDX_6536F4D7E273680F` (`tenues_id`),
  ADD KEY `IDX_6536F4D7AEF5A6C1` (`services_id`),
  ADD KEY `IDX_6536F4D7A76ED395` (`user_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `motifs`
--
ALTER TABLE `motifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_473A7678A76ED395` (`user_id`);

--
-- Index pour la table `munitions`
--
ALTER TABLE `munitions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_606290B7F5C660DE` (`nom_mun`),
  ADD KEY `IDX_606290B7A76ED395` (`user_id`);

--
-- Index pour la table `personnels`
--
ALTER TABLE `personnels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7AC38C2B4B1DAB3F` (`matricule_pers`),
  ADD KEY `IDX_7AC38C2BA76ED395` (`user_id`),
  ADD KEY `IDX_7AC38C2BA6998D31` (`unites_id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7332E169D8351876` (`types_service_id`),
  ADD KEY `IDX_7332E169A76ED395` (`user_id`);

--
-- Index pour la table `tenues`
--
ALTER TABLE `tenues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_28E683A6A76ED395` (`user_id`);

--
-- Index pour la table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C7BE69E5B768EFC9` (`nom_transp`),
  ADD KEY `IDX_C7BE69E5A76ED395` (`user_id`);

--
-- Index pour la table `types_services`
--
ALTER TABLE `types_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BC5506474DA381C0` (`nom_type_sce`),
  ADD KEY `IDX_BC550647A76ED395` (`user_id`);

--
-- Index pour la table `type_armements`
--
ALTER TABLE `type_armements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E8B62BEB2A945EC7` (`nom_arm`),
  ADD KEY `IDX_E8B62BEBA76ED395` (`user_id`);

--
-- Index pour la table `unites`
--
ALTER TABLE `unites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_87F339CA76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absences`
--
ALTER TABLE `absences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `autres`
--
ALTER TABLE `autres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `motifs`
--
ALTER TABLE `motifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `munitions`
--
ALTER TABLE `munitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `personnels`
--
ALTER TABLE `personnels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `tenues`
--
ALTER TABLE `tenues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `transports`
--
ALTER TABLE `transports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `types_services`
--
ALTER TABLE `types_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_armements`
--
ALTER TABLE `type_armements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `unites`
--
ALTER TABLE `unites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `FK_F9C0EFFF83CAFB5D` FOREIGN KEY (`motifs_id`) REFERENCES `motifs` (`id`),
  ADD CONSTRAINT `FK_F9C0EFFFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_F9C0EFFFC7022806` FOREIGN KEY (`personnels_id`) REFERENCES `personnels` (`id`);

--
-- Contraintes pour la table `autres`
--
ALTER TABLE `autres`
  ADD CONSTRAINT `FK_21F62672A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_21F62672AEF5A6C1` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `FK_21F62672C7022806` FOREIGN KEY (`personnels_id`) REFERENCES `personnels` (`id`);

--
-- Contraintes pour la table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `FK_6536F4D7518E99D9` FOREIGN KEY (`transports_id`) REFERENCES `transports` (`id`),
  ADD CONSTRAINT `FK_6536F4D774ADA7AB` FOREIGN KEY (`munitions_id`) REFERENCES `munitions` (`id`),
  ADD CONSTRAINT `FK_6536F4D797841149` FOREIGN KEY (`type_armements_id`) REFERENCES `type_armements` (`id`),
  ADD CONSTRAINT `FK_6536F4D7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_6536F4D7AEF5A6C1` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `FK_6536F4D7C7022806` FOREIGN KEY (`personnels_id`) REFERENCES `personnels` (`id`),
  ADD CONSTRAINT `FK_6536F4D7E273680F` FOREIGN KEY (`tenues_id`) REFERENCES `tenues` (`id`);

--
-- Contraintes pour la table `motifs`
--
ALTER TABLE `motifs`
  ADD CONSTRAINT `FK_473A7678A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `munitions`
--
ALTER TABLE `munitions`
  ADD CONSTRAINT `FK_606290B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `personnels`
--
ALTER TABLE `personnels`
  ADD CONSTRAINT `FK_7AC38C2BA6998D31` FOREIGN KEY (`unites_id`) REFERENCES `unites` (`id`),
  ADD CONSTRAINT `FK_7AC38C2BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `FK_7332E169A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_7332E169D8351876` FOREIGN KEY (`types_service_id`) REFERENCES `types_services` (`id`);

--
-- Contraintes pour la table `tenues`
--
ALTER TABLE `tenues`
  ADD CONSTRAINT `FK_28E683A6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `transports`
--
ALTER TABLE `transports`
  ADD CONSTRAINT `FK_C7BE69E5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `types_services`
--
ALTER TABLE `types_services`
  ADD CONSTRAINT `FK_BC550647A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `type_armements`
--
ALTER TABLE `type_armements`
  ADD CONSTRAINT `FK_E8B62BEBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `unites`
--
ALTER TABLE `unites`
  ADD CONSTRAINT `FK_87F339CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
