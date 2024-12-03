-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql-5.7
-- Généré le : mar. 03 déc. 2024 à 15:35
-- Version du serveur : 5.7.28
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ubergos_pro`
--

-- --------------------------------------------------------

--
-- Structure de la table `fitpulse_Coach`
--

CREATE TABLE `fitpulse_Coach` (
  `id` int(10) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `lieuCours` enum('Distanciel','Présentiel','Hybride') NOT NULL,
  `estVerifie` tinyint(1) NOT NULL DEFAULT '0',
  `emailPaypal` varchar(100) DEFAULT NULL,
  `idUtilisateur` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fitpulse_Coach`
--

INSERT INTO `fitpulse_Coach` (`id`, `contact`, `description`, `lieuCours`, `estVerifie`, `emailPaypal`, `idUtilisateur`) VALUES
(1, 'pierre.leblanc@example.com', 'Coach en musculation', 'Présentiel', 1, 'jean.paypal@example.com', 1),
(2, 'sophie.boucher@example.com', 'Coach en yoga', 'Distanciel', 1, 'claire.paypal@example.com', 2),
(3, 'marc.muller@example.com', 'Coach en HIIT et CrossFit', 'Hybride', 1, 'paul.paypal@example.com', 3),
(4, 'elise.vidal@example.com', 'Coach en pilates', 'Présentiel', 1, 'lisa.paypal@example.com', 4),
(5, 'luca.guillaume@example.com', 'Coach en boxe', 'Distanciel', 1, 'sophie.paypal@example.com', 5),
(6, 'alexandre.lemoine@example.com', 'Coach en musculation', 'Présentiel', 1, 'alexandre.paypal@example.com', 13),
(7, 'isabelle.tanguy@example.com', 'Coach en yoga', 'Distanciel', 1, 'isabelle.paypal@example.com', 14),
(8, 'julien.durand@example.com', 'Coach en HIIT et CrossFit', 'Hybride', 1, 'julien.paypal@example.com', 15),
(9, 'francois.lemoine@example.com', 'Coach en pilates', 'Présentiel', 1, 'francois.paypal@example.com', 16),
(10, 'nathalie.chauvet@example.com', 'Coach en boxe', 'Distanciel', 1, 'nathalie.paypal@example.com', 17),
(11, 'michel.delacroix@example.com', 'Coach en fitness', 'Présentiel', 1, 'michel.paypal@example.com', 18),
(12, 'elena.martin@example.com', 'Coach en danse', 'Hybride', 1, 'elena.paypal@example.com', 19),
(13, 'sophie.girard@example.com', 'Coach en bien-être', 'Distanciel', 1, 'sophie.paypal@example.com', 20),
(14, 'antoine.perrin@example.com', 'Coach en musculation', 'Présentiel', 1, 'antoine.paypal@example.com', 21),
(15, 'caroline.benoit@example.com', 'Coach en yoga', 'Distanciel', 1, 'caroline.paypal@example.com', 22);

-- --------------------------------------------------------

--
-- Structure de la table `fitpulse_commenter`
--

CREATE TABLE `fitpulse_commenter` (
  `idPratiquant` int(10) NOT NULL,
  `idCoach` int(10) NOT NULL,
  `note` decimal(2,1) NOT NULL,
  `titre` varchar(40) NOT NULL,
  `contenu` varchar(500) NOT NULL,
  `DatePost` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fitpulse_commenter`
--

INSERT INTO `fitpulse_commenter` (`idPratiquant`, `idCoach`, `note`, `titre`, `contenu`, `DatePost`) VALUES
(1, 1, '4.5', 'Super coach', 'Pierre a une approche très motivante.', '2024-11-28 10:00:00'),
(2, 2, '5.0', 'Yoga au top', 'Sophie a un excellent savoir-faire en yoga.', '2024-11-28 10:30:00'),
(3, 3, '4.0', 'Entraînement intense', 'Marc est super, mais les séances sont trop difficiles pour moi.', '2024-11-28 11:00:00'),
(4, 4, '3.5', 'Séances intéressantes', 'Elise propose des exercices intéressants, mais j\'aurais aimé plus de variété.', '2024-11-28 11:30:00'),
(5, 5, '4.8', 'Boxe top niveau', 'Luca est un coach incroyable, ses séances de boxe sont parfaites.', '2024-11-28 12:00:00'),
(6, 6, '4.2', 'Excellente méthode', 'Alexandre est très méthodique, mais les séances manquent un peu de dynamisme.', '2024-11-28 12:30:00'),
(7, 7, '4.9', 'Yoga et relaxation', 'Isabelle a une approche douce et relaxante, j\'adore ses cours de yoga.', '2024-11-28 13:00:00'),
(8, 8, '3.7', 'Pas assez de suivi', 'Julien est un bon coach, mais il manque de suivi personnalisé.', '2024-11-28 13:30:00'),
(9, 9, '4.3', 'Cardio efficace', 'Luc m\'a bien motivé à augmenter mon niveau d\'endurance. Les cours sont bien structurés.', '2024-11-28 14:00:00'),
(10, 10, '4.6', 'CrossFit de qualité', 'Camille est un coach dynamique et passionné par le CrossFit.', '2024-11-28 14:30:00'),
(11, 11, '4.0', 'Coaching en musculation', 'Marie est bonne, mais je trouve que ses exercices manquent parfois de difficulté.', '2024-11-28 15:00:00'),
(12, 12, '4.7', 'Séances de yoga relaxantes', 'Pierre a une approche zen et relaxante, idéale pour se détendre.', '2024-11-28 15:30:00'),
(13, 13, '4.5', 'Fitness complet', 'Marc est motivant et ses exercices sont complets, je me sens beaucoup plus en forme.', '2024-11-28 16:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `fitpulse_Creneau`
--

CREATE TABLE `fitpulse_Creneau` (
  `id` int(10) NOT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `capacite` int(3) NOT NULL,
  `tarif` decimal(6,2) NOT NULL,
  `idDiscipline` int(10) DEFAULT NULL,
  `idCoach` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fitpulse_Creneau`
--

INSERT INTO `fitpulse_Creneau` (`id`, `dateDebut`, `dateFin`, `capacite`, `tarif`, `idDiscipline`, `idCoach`) VALUES
(1, '2024-12-01 10:00:00', '2024-12-01 11:00:00', 10, '15.00', 1, 1),
(2, '2024-12-02 15:00:00', '2024-12-02 16:00:00', 8, '20.00', 2, 2),
(3, '2024-12-03 18:00:00', '2024-12-03 19:30:00', 12, '25.00', 3, 3),
(4, '2024-12-04 09:00:00', '2024-12-04 10:30:00', 6, '18.00', 4, 4),
(5, '2024-12-05 14:00:00', '2024-12-05 15:30:00', 10, '22.00', 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `fitpulse_Discipline`
--

CREATE TABLE `fitpulse_Discipline` (
  `id` int(10) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fitpulse_Discipline`
--

INSERT INTO `fitpulse_Discipline` (`id`, `nom`) VALUES
(1, 'Musculation'),
(2, 'Cardio'),
(3, 'Yoga'),
(4, 'CrossFit'),
(5, 'Pilates'),
(6, 'Cyclisme'),
(7, 'Boxe'),
(8, 'Danse'),
(9, 'HIIT'),
(10, 'Natation');

-- --------------------------------------------------------

--
-- Structure de la table `fitpulse_Dossier`
--

CREATE TABLE `fitpulse_Dossier` (
  `id` int(10) NOT NULL,
  `identiteRecto` varchar(255) NOT NULL,
  `identiteVerso` varchar(255) NOT NULL,
  `certificat` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `idCoach` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fitpulse_Dossier`
--

INSERT INTO `fitpulse_Dossier` (`id`, `identiteRecto`, `identiteVerso`, `certificat`, `cv`, `idCoach`) VALUES
(1, 'idRecto1.png', 'idVerso1.png', 'certificat1.pdf', 'cv1.pdf', 4),
(2, 'idRecto2.png', 'idVerso2.png', 'certificat2.pdf', 'cv2.pdf', 5);

-- --------------------------------------------------------

--
-- Structure de la table `fitpulse_Pratiquant`
--

CREATE TABLE `fitpulse_Pratiquant` (
  `id` int(10) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `idUtilisateur` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fitpulse_Pratiquant`
--

INSERT INTO `fitpulse_Pratiquant` (`id`, `contact`, `description`, `idUtilisateur`) VALUES
(1, 'jean.dupont@example.com', 'Passionné de musculation', 6),
(2, 'claire.martin@example.com', 'Amoureuse du yoga et de la danse', 7),
(3, 'paul.durand@example.com', 'Débutant en fitness', 8),
(4, 'luc.morel@example.com', 'Entraînement régulier en cardio', 9),
(5, 'camille.bernard@example.com', 'Fan de CrossFit', 10),
(6, 'marc.girard@example.com', 'Fan de fitness et de musculation', 23),
(7, 'julien.lemoine@example.com', 'Amateur de sport en extérieur', 24),
(8, 'sophie.martin@example.com', 'Pratique le yoga et la méditation', 25),
(9, 'luc.durand@example.com', 'Débutant en musculation', 26),
(10, 'isabelle.chauvet@example.com', 'Passionnée de danse', 27),
(11, 'caroline.benoit@example.com', 'Pratique le yoga et la course à pied', 28),
(12, 'alexandre.girard@example.com', 'Pratique le CrossFit', 29),
(13, 'louis.morel@example.com', 'Entraînement en force et résistance', 30);

-- --------------------------------------------------------

--
-- Structure de la table `fitpulse_pratiquer`
--

CREATE TABLE `fitpulse_pratiquer` (
  `idCoach` int(10) NOT NULL,
  `idDiscipline` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fitpulse_pratiquer`
--

INSERT INTO `fitpulse_pratiquer` (`idCoach`, `idDiscipline`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `fitpulse_proposer_dans`
--

CREATE TABLE `fitpulse_proposer_dans` (
  `idCreneau` int(10) NOT NULL,
  `idSalleDeSport` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fitpulse_proposer_dans`
--

INSERT INTO `fitpulse_proposer_dans` (`idCreneau`, `idSalleDeSport`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `fitpulse_Salle_de_sport`
--

CREATE TABLE `fitpulse_Salle_de_sport` (
  `id` int(10) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `accesPMR` tinyint(1) DEFAULT NULL,
  `enLigne` tinyint(1) NOT NULL DEFAULT '0',
  `adresse` varchar(150) DEFAULT NULL,
  `codePostal` varchar(10) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `pays` varchar(100) DEFAULT NULL,
  `lienGoogleMaps` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fitpulse_Salle_de_sport`
--

INSERT INTO `fitpulse_Salle_de_sport` (`id`, `nom`, `photo`, `description`, `accesPMR`, `enLigne`, `adresse`, `codePostal`, `ville`, `pays`, `lienGoogleMaps`) VALUES
(1, 'Fitness Park', 'fitness_park.jpg', 'Salle moderne avec équipements haut de gamme, idéale pour le cardio et la musculation', 1, 0, '10 Rue de la République', '75001', 'Paris', 'France', NULL),
(2, 'Club Med Gym', 'club_med_gym.jpg', 'Espace sportif avec des cours collectifs et des services de bien-être', 1, 0, '20 Avenue des Champs-Élysées', '75008', 'Paris', 'France', NULL),
(3, 'L\'Usine', 'lusine.jpg', 'Salle haut de gamme avec équipements dernière génération et coaching personnalisé', 1, 0, '33 Boulevard Saint-Germain', '75005', 'Paris', 'France', NULL),
(4, 'David Lloyd Club', 'david_lloyd.jpg', 'Salle avec des installations sportives complètes et une ambiance conviviale', 1, 0, '65 Avenue George V', '75008', 'Paris', 'France', NULL),
(5, 'Fitness First', 'fitness_first.jpg', 'Salle de sport internationale avec un large choix de cours collectifs et de services', 1, 0, '4 Rue du Faubourg Saint-Antoine', '75011', 'Paris', 'France', NULL),
(6, 'Keep Cool', 'keep_cool.jpg', 'Salle accessible à tous, avec un concept de sport à son rythme', 1, 0, '12 Rue de la Paix', '75002', 'Paris', 'France', NULL),
(7, 'CMG Sports Club', 'cmg_sports_club.jpg', 'Salle premium avec des équipements de qualité et une offre diversifiée de sports', 1, 0, '40 Rue de la Pomme', '75013', 'Paris', 'France', NULL),
(8, 'Bodysport', 'bodysport.jpg', 'Salle de sport avec une large gamme d\'équipements pour tous types d\'entrainements', 1, 0, '15 Rue des Acacias', '75017', 'Paris', 'France', NULL),
(9, 'Neoness', 'neoness.jpg', 'Salle moderne avec des zones dédiées au fitness, musculation et cours collectifs', 1, 0, '24 Boulevard de la Villette', '75019', 'Paris', 'France', NULL),
(10, 'Mon Coach Fitness', 'mon_coach_fitness.jpg', 'Salle de sport avec coaching personnalisé et une offre variée de cours collectifs', 1, 0, '15 Rue de la Montagne Sainte-Geneviève', '75005', 'Paris', 'France', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fitpulse_Seance`
--

CREATE TABLE `fitpulse_Seance` (
  `id` int(10) NOT NULL,
  `estPaye` tinyint(1) NOT NULL DEFAULT '0',
  `estAnnule` tinyint(1) NOT NULL DEFAULT '0',
  `idSalleDeSport` int(10) DEFAULT NULL,
  `idPratiquant` int(10) DEFAULT NULL,
  `idCreneau` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fitpulse_Seance`
--

INSERT INTO `fitpulse_Seance` (`id`, `estPaye`, `estAnnule`, `idSalleDeSport`, `idPratiquant`, `idCreneau`) VALUES
(1, 1, 0, 1, 1, 1),
(2, 0, 0, 2, 2, 2),
(3, 1, 1, 3, 3, 3),
(4, 1, 0, 4, 4, 4),
(5, 1, 0, 5, 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `fitpulse_Utilisateur`
--

CREATE TABLE `fitpulse_Utilisateur` (
  `id` int(10) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `dateInscription` date NOT NULL,
  `estActif` tinyint(1) NOT NULL DEFAULT '1',
  `estAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fitpulse_Utilisateur`
--

INSERT INTO `fitpulse_Utilisateur` (`id`, `motDePasse`, `nom`, `prenom`, `mail`, `photo`, `dateInscription`, `estActif`, `estAdmin`) VALUES
(1, 'password123', 'Leblanc', 'Pierre', 'pierre.leblanc@example.com', NULL, '2024-01-15', 1, 0),
(2, 'securepass', 'Boucher', 'Sophie', 'sophie.boucher@example.com', NULL, '2023-12-10', 1, 0),
(3, 'mypassword', 'Muller', 'Marc', 'marc.muller@example.com', NULL, '2023-11-05', 1, 0),
(4, 'password456', 'Vidal', 'Elise', 'elise.vidal@example.com', NULL, '2024-02-01', 1, 0),
(5, 'password789', 'Guillaume', 'Luca', 'luca.guillaume@example.com', NULL, '2024-02-05', 1, 0),
(6, 'password123', 'Leclerc', 'Anne', 'anne.leclerc@example.com', NULL, '2024-01-15', 1, 0),
(7, 'securepass', 'Lemoine', 'Pauline', 'pauline.lemoine@example.com', 'pauline.jpg', '2023-12-10', 1, 0),
(8, 'mypassword', 'Morel', 'Louis', 'louis.morel@example.com', NULL, '2023-11-05', 1, 0),
(9, 'password123', 'Morel', 'Luc', 'luc.morel@example.com', NULL, '2024-02-01', 1, 0),
(10, 'password123', 'Bernard', 'Camille', 'camille.bernard@example.com', NULL, '2024-02-05', 1, 0),
(11, 'superpassword!12', 'Dupuis', 'Marc', 'marc.dupuis@example.com', NULL, '2023-01-01', 1, 1),
(12, 'mdpsuper!34', 'Dupont', 'Julie', 'julie.dupont@example.com', NULL, '2023-01-01', 1, 1),
(13, 'newpassword123', 'Lemoine', 'Alexandre', 'alexandre.lemoine@example.com', NULL, '2024-12-03', 1, 0),
(14, 'strongpass456', 'Tanguy', 'Isabelle', 'isabelle.tanguy@example.com', NULL, '2024-12-03', 1, 0),
(15, 'passwordxyz', 'Durand', 'Julien', 'julien.durand@example.com', NULL, '2024-12-03', 1, 0),
(16, 'mypassword!7', 'Lemoine', 'François', 'francois.lemoine@example.com', NULL, '2024-12-03', 1, 0),
(17, 'newsecurepass', 'Chauvet', 'Nathalie', 'nathalie.chauvet@example.com', NULL, '2024-12-03', 1, 0),
(18, 'coachpass123', 'Delacroix', 'Michel', 'michel.delacroix@example.com', NULL, '2024-12-03', 1, 0),
(19, 'qwerty2024', 'Martin', 'Elena', 'elena.martin@example.com', NULL, '2024-12-03', 1, 0),
(20, 'securepassword01', 'Girard', 'Sophie', 'sophie.girard@example.com', NULL, '2024-12-03', 1, 0),
(21, 'coachpassword44', 'Perrin', 'Antoine', 'antoine.perrin@example.com', NULL, '2024-12-03', 1, 0),
(22, 'trainingpass2024', 'Benoit', 'Caroline', 'caroline.benoit@example.com', NULL, '2024-12-03', 1, 0),
(23, 'password456', 'Girard', 'Marc', 'marc.girard@example.com', NULL, '2024-12-03', 1, 0),
(24, 'mypassword456', 'Lemoine', 'Julien', 'julien.lemoine@example.com', NULL, '2024-12-03', 1, 0),
(25, 'mypassword!23', 'Martin', 'Sophie', 'sophie.martin@example.com', NULL, '2024-12-03', 1, 0),
(26, 'password789456', 'Durand', 'Luc', 'luc.durand@example.com', NULL, '2024-12-03', 1, 0),
(27, 'newpassword!23', 'Chauvet', 'Isabelle', 'isabelle.chauvet@example.com', NULL, '2024-12-03', 1, 0),
(28, 'securepass789', 'Benoit', 'Caroline', 'caroline.benoit@example.com', NULL, '2024-12-03', 1, 0),
(29, 'qwerty1234', 'Girard', 'Alexandre', 'alexandre.girard@example.com', NULL, '2024-12-03', 1, 0),
(30, 'password5678', 'Morel', 'Louis', 'louis.morel@example.com', NULL, '2024-12-03', 1, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `fitpulse_Coach`
--
ALTER TABLE `fitpulse_Coach`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `fitpulse_commenter`
--
ALTER TABLE `fitpulse_commenter`
  ADD PRIMARY KEY (`idPratiquant`,`idCoach`),
  ADD KEY `idCoach` (`idCoach`);

--
-- Index pour la table `fitpulse_Creneau`
--
ALTER TABLE `fitpulse_Creneau`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDiscipline` (`idDiscipline`),
  ADD KEY `idCoach` (`idCoach`);

--
-- Index pour la table `fitpulse_Discipline`
--
ALTER TABLE `fitpulse_Discipline`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fitpulse_Dossier`
--
ALTER TABLE `fitpulse_Dossier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCoach` (`idCoach`);

--
-- Index pour la table `fitpulse_Pratiquant`
--
ALTER TABLE `fitpulse_Pratiquant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `fitpulse_pratiquer`
--
ALTER TABLE `fitpulse_pratiquer`
  ADD PRIMARY KEY (`idCoach`,`idDiscipline`),
  ADD KEY `idDiscipline` (`idDiscipline`);

--
-- Index pour la table `fitpulse_proposer_dans`
--
ALTER TABLE `fitpulse_proposer_dans`
  ADD PRIMARY KEY (`idCreneau`,`idSalleDeSport`),
  ADD KEY `idSalleDeSport` (`idSalleDeSport`);

--
-- Index pour la table `fitpulse_Salle_de_sport`
--
ALTER TABLE `fitpulse_Salle_de_sport`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fitpulse_Seance`
--
ALTER TABLE `fitpulse_Seance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSalleDeSport` (`idSalleDeSport`),
  ADD KEY `idPratiquant` (`idPratiquant`),
  ADD KEY `idCreneau` (`idCreneau`);

--
-- Index pour la table `fitpulse_Utilisateur`
--
ALTER TABLE `fitpulse_Utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `fitpulse_Coach`
--
ALTER TABLE `fitpulse_Coach`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `fitpulse_Creneau`
--
ALTER TABLE `fitpulse_Creneau`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `fitpulse_Discipline`
--
ALTER TABLE `fitpulse_Discipline`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `fitpulse_Dossier`
--
ALTER TABLE `fitpulse_Dossier`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `fitpulse_Pratiquant`
--
ALTER TABLE `fitpulse_Pratiquant`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `fitpulse_Salle_de_sport`
--
ALTER TABLE `fitpulse_Salle_de_sport`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `fitpulse_Seance`
--
ALTER TABLE `fitpulse_Seance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `fitpulse_Utilisateur`
--
ALTER TABLE `fitpulse_Utilisateur`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fitpulse_Coach`
--
ALTER TABLE `fitpulse_Coach`
  ADD CONSTRAINT `fitpulse_Coach_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `fitpulse_Utilisateur` (`id`);

--
-- Contraintes pour la table `fitpulse_commenter`
--
ALTER TABLE `fitpulse_commenter`
  ADD CONSTRAINT `fitpulse_commenter_ibfk_1` FOREIGN KEY (`idPratiquant`) REFERENCES `fitpulse_Pratiquant` (`id`),
  ADD CONSTRAINT `fitpulse_commenter_ibfk_2` FOREIGN KEY (`idCoach`) REFERENCES `fitpulse_Coach` (`id`);

--
-- Contraintes pour la table `fitpulse_Creneau`
--
ALTER TABLE `fitpulse_Creneau`
  ADD CONSTRAINT `fitpulse_Creneau_ibfk_1` FOREIGN KEY (`idDiscipline`) REFERENCES `fitpulse_Discipline` (`id`),
  ADD CONSTRAINT `fitpulse_Creneau_ibfk_2` FOREIGN KEY (`idCoach`) REFERENCES `fitpulse_Coach` (`id`);

--
-- Contraintes pour la table `fitpulse_Dossier`
--
ALTER TABLE `fitpulse_Dossier`
  ADD CONSTRAINT `fitpulse_Dossier_ibfk_1` FOREIGN KEY (`idCoach`) REFERENCES `fitpulse_Coach` (`id`);

--
-- Contraintes pour la table `fitpulse_Pratiquant`
--
ALTER TABLE `fitpulse_Pratiquant`
  ADD CONSTRAINT `fitpulse_Pratiquant_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `fitpulse_Utilisateur` (`id`);

--
-- Contraintes pour la table `fitpulse_pratiquer`
--
ALTER TABLE `fitpulse_pratiquer`
  ADD CONSTRAINT `fitpulse_pratiquer_ibfk_1` FOREIGN KEY (`idCoach`) REFERENCES `fitpulse_Coach` (`id`),
  ADD CONSTRAINT `fitpulse_pratiquer_ibfk_2` FOREIGN KEY (`idDiscipline`) REFERENCES `fitpulse_Discipline` (`id`);

--
-- Contraintes pour la table `fitpulse_proposer_dans`
--
ALTER TABLE `fitpulse_proposer_dans`
  ADD CONSTRAINT `fitpulse_proposer_dans_ibfk_1` FOREIGN KEY (`idCreneau`) REFERENCES `fitpulse_Creneau` (`id`),
  ADD CONSTRAINT `fitpulse_proposer_dans_ibfk_2` FOREIGN KEY (`idSalleDeSport`) REFERENCES `fitpulse_Salle_de_sport` (`id`);

--
-- Contraintes pour la table `fitpulse_Seance`
--
ALTER TABLE `fitpulse_Seance`
  ADD CONSTRAINT `fitpulse_Seance_ibfk_1` FOREIGN KEY (`idSalleDeSport`) REFERENCES `fitpulse_Salle_de_sport` (`id`),
  ADD CONSTRAINT `fitpulse_Seance_ibfk_2` FOREIGN KEY (`idPratiquant`) REFERENCES `fitpulse_Pratiquant` (`id`),
  ADD CONSTRAINT `fitpulse_Seance_ibfk_3` FOREIGN KEY (`idCreneau`) REFERENCES `fitpulse_Creneau` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
