-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 10 Avril 2014 à 13:14
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gestioncampus`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` varchar(8) NOT NULL,
  `mot_passe_admin` varchar(20) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `mot_passe_admin`) VALUES
('root', 'root');

-- --------------------------------------------------------

--
-- Structure de la table `campus`
--

CREATE TABLE IF NOT EXISTS `campus` (
  `id_campus` varchar(8) NOT NULL,
  `id_admin` varchar(8) NOT NULL,
  `arrondissement_campus` varchar(25) NOT NULL,
  PRIMARY KEY (`id_campus`),
  KEY `id_admin` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `campus`
--

INSERT INTO `campus` (`id_campus`, `id_admin`, `arrondissement_campus`) VALUES
('C1', 'root', 'Rabat-Agdal'),
('C11', 'root', 'Rabat-Ville'),
('C45', 'root', 'Rabat-Hassan');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE IF NOT EXISTS `etudiant` (
  `id_etudiant` varchar(8) NOT NULL,
  `id_campus` varchar(8) NOT NULL,
  `id_groupe` varchar(8) NOT NULL,
  `nom_etudiant` varchar(30) NOT NULL,
  `prenom_etudiant` varchar(30) NOT NULL,
  `sexe` char(2) NOT NULL,
  `date_naissance` date NOT NULL,
  `mail_etudiant` varchar(80) NOT NULL,
  `mot_passe_etudiant` varchar(20) NOT NULL,
  PRIMARY KEY (`id_etudiant`),
  KEY `id_campus` (`id_campus`),
  KEY `id_groupe` (`id_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `id_campus`, `id_groupe`, `nom_etudiant`, `prenom_etudiant`, `sexe`, `date_naissance`, `mail_etudiant`, `mot_passe_etudiant`) VALUES
('E1', 'C11', 'G111', 'msika', 'Safaa', 'F', '1992-10-14', 'safaa.msika@gmail.com', 'safaa'),
('E2', 'C11', 'G133', 'alaoui', 'Nihel', 'F', '1993-04-04', 'nihel.alaoui@gmail.com', 'nihel'),
('E3', 'C45', 'G211', 'Saidi', 'Abdelah', 'M', '1989-04-20', 'saidi@gmail.com', 'saidi'),
('E4', 'C1', 'G111', 'Rachid', 'Rachidi', 'M', '1990-08-08', 'rachid@gmail.com', 'rachid');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE IF NOT EXISTS `filiere` (
  `id_filiere` varchar(8) NOT NULL,
  `nom_filiere` varchar(20) NOT NULL,
  PRIMARY KEY (`id_filiere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `filiere`
--

INSERT INTO `filiere` (`id_filiere`, `nom_filiere`) VALUES
('F1', 'genie logiciel'),
('F2', 'genie mecanique'),
('F3', 'genie civil'),
('F4', 'genie electrique');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `id_groupe` varchar(8) NOT NULL,
  `id_niveau` varchar(8) NOT NULL,
  `nom_groupe` varchar(20) NOT NULL,
  `effectif` int(3) NOT NULL,
  PRIMARY KEY (`id_groupe`),
  KEY `id_niveau` (`id_niveau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`id_groupe`, `id_niveau`, `nom_groupe`, `effectif`) VALUES
('G111', 'N1AF1', 'Groupe1Niveau1', 35),
('G133', 'N3AF3', 'Groupe1Niveau3', 40),
('G211', 'N1AF1', 'Groupe2Niveau1', 37);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE IF NOT EXISTS `matiere` (
  `id_matiere` varchar(8) NOT NULL,
  `id_module` varchar(8) NOT NULL,
  `id_prof` varchar(8) NOT NULL,
  `nom_matiere` varchar(20) NOT NULL,
  `volume_horaire` int(3) NOT NULL,
  `coefficient` int(1) NOT NULL,
  PRIMARY KEY (`id_matiere`),
  KEY `id_module` (`id_module`),
  KEY `id_prof` (`id_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `matiere`
--

INSERT INTO `matiere` (`id_matiere`, `id_module`, `id_prof`, `nom_matiere`, `volume_horaire`, `coefficient`) VALUES
('M10', 'M59', 'P15', 'windows server 2003', 40, 1),
('M180', 'M145', 'P45', 'Java', 50, 3),
('M19', 'M752', 'P80', 'C++', 80, 2),
('M50', 'M89', 'P5', 'Windows XP', 45, 1);

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id_module` varchar(8) NOT NULL,
  `id_semestre` varchar(8) NOT NULL,
  PRIMARY KEY (`id_module`),
  KEY `id_semestre` (`id_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `module`
--

INSERT INTO `module` (`id_module`, `id_semestre`) VALUES
('M145', 'S1'),
('M59', 'S1'),
('M752', 'S2'),
('M89', 'S2');

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE IF NOT EXISTS `niveau` (
  `id_niveau` varchar(8) NOT NULL,
  `id_filiere` varchar(8) NOT NULL,
  `nom_niveau` varchar(20) NOT NULL,
  PRIMARY KEY (`id_niveau`),
  KEY `id_filiere` (`id_filiere`),
  KEY `id_filiere_2` (`id_filiere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `niveau`
--

INSERT INTO `niveau` (`id_niveau`, `id_filiere`, `nom_niveau`) VALUES
('N1AF1', 'F1', '1 er année'),
('N1AF2', 'F2', '1 er année'),
('N1AF3', 'F3', '1 er année'),
('N1AF4', 'F4', '1 er année'),
('N2AF1', 'F1', '2 eme annee'),
('N2AF4', 'F4', '2 eme annee'),
('N3AF3', 'F3', '3 eme annee'),
('N4AF2', 'F2', '4 eme annee'),
('N5AF3', 'F3', '5 eme annee');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE IF NOT EXISTS `professeur` (
  `id_prof` varchar(8) NOT NULL,
  `nom_prof` varchar(30) NOT NULL,
  `prenom_prof` varchar(30) NOT NULL,
  `mail_prof` varchar(80) NOT NULL,
  `mot_passe_prof` varchar(20) NOT NULL,
  PRIMARY KEY (`id_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `professeur`
--

INSERT INTO `professeur` (`id_prof`, `nom_prof`, `prenom_prof`, `mail_prof`, `mot_passe_prof`) VALUES
('P15', 'Bendriss', 'Elmehdi', 'elmehdi@gmail.com', 'elmehdi'),
('P45', 'Boulchahoub', 'Hassan', 'hassan@gmail.com', 'java'),
('P5', 'Abza', 'Nabil', 'nabil@gmail.com', 'nabil'),
('P80', 'Elmerraki', 'Mohammed', 'mohammed@gmail.com', 'mohammed');

-- --------------------------------------------------------

--
-- Structure de la table `semestre`
--

CREATE TABLE IF NOT EXISTS `semestre` (
  `id_semestre` varchar(8) NOT NULL,
  PRIMARY KEY (`id_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `semestre`
--

INSERT INTO `semestre` (`id_semestre`) VALUES
('S1'),
('S2');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `campus`
--
ALTER TABLE `campus`
  ADD CONSTRAINT `campus_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`id_campus`) REFERENCES `campus` (`id_campus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `etudiant_ibfk_2` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`id_niveau`) REFERENCES `niveau` (`id_niveau`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `matiere_ibfk_1` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matiere_ibfk_2` FOREIGN KEY (`id_prof`) REFERENCES `professeur` (`id_prof`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`id_semestre`) REFERENCES `semestre` (`id_semestre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD CONSTRAINT `niveau_ibfk_1` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
