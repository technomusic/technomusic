-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 10 Août 2015 à 14:21
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `technomusic`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `Album_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Annee` int(11) DEFAULT NULL,
  `Label` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Label_ID` bigint(20) NOT NULL,
  PRIMARY KEY (`Album_ID`),
  UNIQUE KEY `ID_Album_IND` (`Album_ID`),
  KEY `FKProduit_IND` (`Label_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

CREATE TABLE IF NOT EXISTS `artiste` (
  `Atriste_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Prenom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Surnom` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Date_Naissance` date DEFAULT NULL,
  `Lieu_Naissance` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Bio` varchar(10000) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`Atriste_ID`),
  UNIQUE KEY `ID_Artiste_IND` (`Atriste_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `Categorie_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`Categorie_ID`),
  UNIQUE KEY `ID_Categorie_IND` (`Categorie_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `chanson`
--

CREATE TABLE IF NOT EXISTS `chanson` (
  `Chanson_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Duree` int(11) DEFAULT NULL,
  `Annee` int(11) DEFAULT NULL,
  `Description` varchar(10000) CHARACTER SET utf8 DEFAULT NULL,
  `Categorie_ID` bigint(20) NOT NULL,
  PRIMARY KEY (`Chanson_ID`),
  UNIQUE KEY `ID_Chanson_IND` (`Chanson_ID`),
  KEY `FKappartient_IND` (`Categorie_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `chanson_album`
--

CREATE TABLE IF NOT EXISTS `chanson_album` (
  `Album_ID` bigint(20) NOT NULL,
  `Chanson_ID` bigint(20) NOT NULL,
  `Num_piste` int(11) NOT NULL,
  PRIMARY KEY (`Album_ID`,`Chanson_ID`),
  UNIQUE KEY `ID_fait_partie_IND` (`Album_ID`,`Chanson_ID`),
  KEY `FKfai_Cha_IND` (`Chanson_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compositeur_album`
--

CREATE TABLE IF NOT EXISTS `compositeur_album` (
  `Album_ID` bigint(20) NOT NULL,
  `Atriste_ID` bigint(20) NOT NULL,
  PRIMARY KEY (`Album_ID`,`Atriste_ID`),
  UNIQUE KEY `ID_ComposeAlbum_IND` (`Album_ID`,`Atriste_ID`),
  KEY `FKCom_Art_IND` (`Atriste_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compositeur_chanson`
--

CREATE TABLE IF NOT EXISTS `compositeur_chanson` (
  `Atriste_ID` bigint(20) NOT NULL,
  `Chanson_ID` bigint(20) NOT NULL,
  PRIMARY KEY (`Chanson_ID`,`Atriste_ID`),
  UNIQUE KEY `ID_Compose_IND` (`Chanson_ID`,`Atriste_ID`),
  KEY `FKCom_Art_1_IND` (`Atriste_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `conducteur_album`
--

CREATE TABLE IF NOT EXISTS `conducteur_album` (
  `Album_ID` bigint(20) NOT NULL,
  `Atriste_ID` bigint(20) NOT NULL,
  PRIMARY KEY (`Album_ID`,`Atriste_ID`),
  UNIQUE KEY `ID_Conduit_IND` (`Album_ID`,`Atriste_ID`),
  KEY `FKCon_Art_IND` (`Atriste_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `Image_ID` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(500) CHARACTER SET utf8 NOT NULL,
  `Atriste_ID` bigint(20) DEFAULT NULL,
  `Categorie_ID` bigint(20) DEFAULT NULL,
  `Label_ID` bigint(20) DEFAULT NULL,
  `Chanson_ID` bigint(20) DEFAULT NULL,
  `Album_ID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`Image_ID`),
  UNIQUE KEY `ID_Image_IND` (`Image_ID`),
  KEY `FKimage_artiste_IND` (`Atriste_ID`),
  KEY `FKimage_categorie_IND` (`Categorie_ID`),
  KEY `FKimage_label_IND` (`Label_ID`),
  KEY `FKimage_chanson_IND` (`Chanson_ID`),
  KEY `FKimage_album_IND` (`Album_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `interprete_album`
--

CREATE TABLE IF NOT EXISTS `interprete_album` (
  `Album_ID` bigint(20) NOT NULL,
  `Atriste_ID` bigint(20) NOT NULL,
  PRIMARY KEY (`Album_ID`,`Atriste_ID`),
  UNIQUE KEY `ID_InterpreteAlbum_IND` (`Album_ID`,`Atriste_ID`),
  KEY `FKInt_Art_IND` (`Atriste_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `interprete_chanson`
--

CREATE TABLE IF NOT EXISTS `interprete_chanson` (
  `Atriste_ID` bigint(20) NOT NULL,
  `Chanson_ID` bigint(20) NOT NULL,
  PRIMARY KEY (`Chanson_ID`,`Atriste_ID`),
  UNIQUE KEY `ID_Interprete_IND` (`Chanson_ID`,`Atriste_ID`),
  KEY `FKInt_Art_1_IND` (`Atriste_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `label`
--

CREATE TABLE IF NOT EXISTS `label` (
  `Label_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`Label_ID`),
  UNIQUE KEY `ID_Label_IND` (`Label_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `parolier_chanson`
--

CREATE TABLE IF NOT EXISTS `parolier_chanson` (
  `Atriste_ID` bigint(20) NOT NULL,
  `Chanson_ID` bigint(20) NOT NULL,
  PRIMARY KEY (`Chanson_ID`,`Atriste_ID`),
  UNIQUE KEY `ID_Ecrit_IND` (`Chanson_ID`,`Atriste_ID`),
  KEY `FKEcr_Art_IND` (`Atriste_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `Utilisateur_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Prenom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Pseudo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(500) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`Utilisateur_ID`),
  UNIQUE KEY `ID_Utilisateur_IND` (`Utilisateur_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `FKProduit_FK` FOREIGN KEY (`Label_ID`) REFERENCES `label` (`Label_ID`);

--
-- Contraintes pour la table `chanson`
--
ALTER TABLE `chanson`
  ADD CONSTRAINT `FKappartient_FK` FOREIGN KEY (`Categorie_ID`) REFERENCES `categorie` (`Categorie_ID`);

--
-- Contraintes pour la table `chanson_album`
--
ALTER TABLE `chanson_album`
  ADD CONSTRAINT `FKfai_Alb` FOREIGN KEY (`Album_ID`) REFERENCES `album` (`Album_ID`),
  ADD CONSTRAINT `FKfai_Cha_FK` FOREIGN KEY (`Chanson_ID`) REFERENCES `chanson` (`Chanson_ID`);

--
-- Contraintes pour la table `compositeur_album`
--
ALTER TABLE `compositeur_album`
  ADD CONSTRAINT `FKCom_Alb` FOREIGN KEY (`Album_ID`) REFERENCES `album` (`Album_ID`),
  ADD CONSTRAINT `FKCom_Art_FK` FOREIGN KEY (`Atriste_ID`) REFERENCES `artiste` (`Atriste_ID`);

--
-- Contraintes pour la table `compositeur_chanson`
--
ALTER TABLE `compositeur_chanson`
  ADD CONSTRAINT `FKCom_Art_1_FK` FOREIGN KEY (`Atriste_ID`) REFERENCES `artiste` (`Atriste_ID`),
  ADD CONSTRAINT `FKCom_Cha` FOREIGN KEY (`Chanson_ID`) REFERENCES `chanson` (`Chanson_ID`);

--
-- Contraintes pour la table `conducteur_album`
--
ALTER TABLE `conducteur_album`
  ADD CONSTRAINT `FKCon_Alb` FOREIGN KEY (`Album_ID`) REFERENCES `album` (`Album_ID`),
  ADD CONSTRAINT `FKCon_Art_FK` FOREIGN KEY (`Atriste_ID`) REFERENCES `artiste` (`Atriste_ID`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FKimage_album_FK` FOREIGN KEY (`Album_ID`) REFERENCES `album` (`Album_ID`),
  ADD CONSTRAINT `FKimage_artiste_FK` FOREIGN KEY (`Atriste_ID`) REFERENCES `artiste` (`Atriste_ID`),
  ADD CONSTRAINT `FKimage_categorie_FK` FOREIGN KEY (`Categorie_ID`) REFERENCES `categorie` (`Categorie_ID`),
  ADD CONSTRAINT `FKimage_chanson_FK` FOREIGN KEY (`Chanson_ID`) REFERENCES `chanson` (`Chanson_ID`),
  ADD CONSTRAINT `FKimage_label_FK` FOREIGN KEY (`Label_ID`) REFERENCES `label` (`Label_ID`);

--
-- Contraintes pour la table `interprete_album`
--
ALTER TABLE `interprete_album`
  ADD CONSTRAINT `FKInt_Alb` FOREIGN KEY (`Album_ID`) REFERENCES `album` (`Album_ID`),
  ADD CONSTRAINT `FKInt_Art_FK` FOREIGN KEY (`Atriste_ID`) REFERENCES `artiste` (`Atriste_ID`);

--
-- Contraintes pour la table `interprete_chanson`
--
ALTER TABLE `interprete_chanson`
  ADD CONSTRAINT `FKInt_Art_1_FK` FOREIGN KEY (`Atriste_ID`) REFERENCES `artiste` (`Atriste_ID`),
  ADD CONSTRAINT `FKInt_Cha` FOREIGN KEY (`Chanson_ID`) REFERENCES `chanson` (`Chanson_ID`);

--
-- Contraintes pour la table `parolier_chanson`
--
ALTER TABLE `parolier_chanson`
  ADD CONSTRAINT `FKEcr_Art_FK` FOREIGN KEY (`Atriste_ID`) REFERENCES `artiste` (`Atriste_ID`),
  ADD CONSTRAINT `FKEcr_Cha` FOREIGN KEY (`Chanson_ID`) REFERENCES `chanson` (`Chanson_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
