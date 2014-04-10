-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 05 Avril 2014 à 12:12
-- Version du serveur: 5.0.85-community-nt
-- Version de PHP: 5.4.3

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
  PRIMARY KEY  (`id_admin`)
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
  `id_admin` varchar(8) default NULL,
  `arrondissement_campus` varchar(25) NOT NULL,
  PRIMARY KEY  (`id_campus`),
  KEY `id_admin` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `campus`
--

INSERT INTO `campus` (`id_campus`, `id_admin`, `arrondissement_campus`) VALUES
('C12', 'root', 'Rabat-Ville');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE IF NOT EXISTS `etudiant` (
  `id_etudiant` varchar(8) NOT NULL,
  `id_campus` varchar(8) default NULL,
  `id_groupe` varchar(8) default NULL,
  `nom_etudiant` varchar(30) NOT NULL,
  `prenom_etudiant` varchar(30) NOT NULL,
  `sexe` char(2) NOT NULL,
  `date_naissance` date NOT NULL,
  `mail_etudiant` varchar(80) NOT NULL,
  `mot_passe_etudiant` varchar(20) default NULL,
  UNIQUE KEY `id_campus` (`id_campus`,`id_groupe`),
  UNIQUE KEY `id_typecompte` (`id_groupe`),
  UNIQUE KEY `id_groupe` (`id_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `id_campus`, `id_groupe`, `nom_etudiant`, `prenom_etudiant`, `sexe`, `date_naissance`, `mail_etudiant`, `mot_passe_etudiant`) VALUES
('E1', 'C12', 'G1', 'msika', 'safaa', 'F', '1992-10-14', 'safaa.msika@gmail.com', 'sss');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE IF NOT EXISTS `filiere` (
  `id_filiere` varchar(8) NOT NULL,
  `nom_filiere` varchar(20) NOT NULL,
  PRIMARY KEY  (`id_filiere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `filiere`
--

INSERT INTO `filiere` (`id_filiere`, `nom_filiere`) VALUES
('F1', 'IT');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
  `id_groupe` varchar(8) NOT NULL,
  `id_niveau` varchar(8) NOT NULL,
  `nom_groupe` varchar(20) NOT NULL,
  `effectif` int(3) NOT NULL,
  PRIMARY KEY  (`id_groupe`),
  UNIQUE KEY `id_niveau` (`id_niveau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`id_groupe`, `id_niveau`, `nom_groupe`, `effectif`) VALUES
('G1', 'N3A', 'groupe1', 30);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE IF NOT EXISTS `matiere` (
  `id_matiere` varchar(8) NOT NULL,
  `id_module` varchar(8) default NULL,
  `id_prof` varchar(8) NOT NULL,
  `nom_matiere` varchar(20) NOT NULL,
  `volume_horaire` int(3) NOT NULL,
  `coefficient` int(1) NOT NULL,
  PRIMARY KEY  (`id_matiere`),
  UNIQUE KEY `id_prof` (`id_prof`),
  UNIQUE KEY `id_module` (`id_module`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id_module` varchar(8) NOT NULL,
  `id_semestre` varchar(8) default NULL,
  PRIMARY KEY  (`id_module`),
  UNIQUE KEY `id_semestre` (`id_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE IF NOT EXISTS `niveau` (
  `id_niveau` varchar(8) NOT NULL,
  `id_filiere` varchar(8) NOT NULL,
  `nom_niveau` varchar(20) NOT NULL,
  PRIMARY KEY  (`id_niveau`),
  UNIQUE KEY `id_niveau` (`id_niveau`),
  UNIQUE KEY `id_filiere` (`id_filiere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `niveau`
--

INSERT INTO `niveau` (`id_niveau`, `id_filiere`, `nom_niveau`) VALUES
('N3A', 'F1', '3eme annee');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE IF NOT EXISTS `professeur` (
  `id_prof` varchar(8) NOT NULL,
  `nom_prof` varchar(30) NOT NULL,
  `prenom_prof` varchar(30) NOT NULL,
  `mail_prof` varchar(30) NOT NULL,
  `mot_passe_prof` varchar(20) default NULL,
  PRIMARY KEY  (`id_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `professeur`
--

INSERT INTO `professeur` (`id_prof`, `nom_prof`, `prenom_prof`, `mail_prof`, `mot_passe_prof`) VALUES
('P1', 'Bendriss', 'Elmehdi', 'Bendriss@gmail.com', 'mmm');

-- --------------------------------------------------------

--
-- Structure de la table `semestre`
--

CREATE TABLE IF NOT EXISTS `semestre` (
  `id_semestre` varchar(8) NOT NULL,
  PRIMARY KEY  (`id_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD CONSTRAINT `matiere_ibfk_2` FOREIGN KEY (`id_prof`) REFERENCES `professeur` (`id_prof`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matiere_ibfk_1` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`) ON DELETE CASCADE ON UPDATE CASCADE;

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
