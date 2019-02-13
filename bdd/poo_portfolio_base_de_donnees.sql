-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 13 fév. 2019 à 15:38
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `portfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `idcompetence` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`idcompetence`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`idcompetence`, `content`) VALUES
(1, 'HTML5'),
(2, 'CSS3'),
(3, 'PHP'),
(4, 'MySql'),
(5, 'Wordpress'),
(6, 'Drupal'),
(7, 'Jquery'),
(8, 'PrestaShop'),
(9, 'Symfony'),
(10, 'Javascript'),
(11, 'PhpStorm'),
(12, 'MySql Workbench'),
(13, 'Bootstrap'),
(14, 'StartUml'),
(15, 'Adobe Photoshop'),
(16, 'Adobe Illustrator');

-- --------------------------------------------------------

--
-- Structure de la table `experience_professionnelle`
--

DROP TABLE IF EXISTS `experience_professionnelle`;
CREATE TABLE IF NOT EXISTS `experience_professionnelle` (
  `idexperience_professionnelle` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `content` longtext,
  PRIMARY KEY (`idexperience_professionnelle`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `experience_professionnelle`
--

INSERT INTO `experience_professionnelle` (`idexperience_professionnelle`, `nom`, `date_debut`, `date_fin`, `titre`, `content`) VALUES
(1, 'ESCG Paris', '2009-06-16', NULL, 'Développeur web', 'Conception, réalisation d\'une application web de ressources documentaires \"Marketdigidoc\" Conception, réalisation et mise à jour du site \"La formation Marketing Digital\" Administration et Maintenance du réseau et du parc informatique Responsable technique de la solution E-LEARNING AURALOG Cloud computing configuration et déploiement du domaine avec Google Déploiement d’un réseau, installation, administration de Windows Server 2008 et configuration du VPN Téléphonie VOIP installation, mise en service du déploiement avec Orange Business Service Assistance aux utilisateurs dans l\'usage quotidien des outils informatiques Conception Réseau, Installation, Configuration '),
(2, 'CEFPA Tillier', '2004-09-01', '2009-05-30', 'Collaborateur Commercial / Gestionnaire du parc informatique', 'Prospection téléphonique Analyse et identification des clients Fidélisation de la clientèle Responsable du Parc Informatique Topologie et mise en place du réseau Conception et Développement du site internet '),
(4, 'Weldom', '2003-09-30', '2004-07-30', 'Assistant Commercial', 'Vente des produits, Préparation des commandes, Mise en rayon ');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `idformation` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text,
  `organisme` text,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`idformation`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`idformation`, `nom`, `organisme`, `date_debut`, `date_fin`) VALUES
(1, 'Certification Développeur d\'application web PHP / Symfony', 'Openclassrooms Paris', '2017-10-30', '2019-08-30'),
(2, 'Licence pro des métiers de l\'internet', 'Université de Limoges', '2016-09-30', '2017-06-30'),
(3, 'DEUST Webmaster et Métiers de L\'Internet\r\n', 'Université de Limoges', '2013-09-30', '2016-06-30'),
(4, 'Formation Administration Windows server 2003', 'Ais Nantes', '2009-07-01', '2009-07-15'),
(5, 'Formation Cisco CCNA\r\n', 'Egilia Paris', '2009-04-15', '2009-04-30'),
(6, 'Baccalauréat STT option Commerce', 'Lycée Privé Saint Jean-Baptiste de la Salle Lille', '2001-09-01', '2002-06-30');

-- --------------------------------------------------------

--
-- Structure de la table `objectif`
--

DROP TABLE IF EXISTS `objectif`;
CREATE TABLE IF NOT EXISTS `objectif` (
  `idobjectif` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  PRIMARY KEY (`idobjectif`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `objectif`
--

INSERT INTO `objectif` (`idobjectif`, `content`) VALUES
(1, 'Passionné d\'informatique et plus particulièrement par le développement web, je souhaite intégrer un service informatique à fort potentiel afin de répondre techniquement aux besoins.');

-- --------------------------------------------------------

--
-- Structure de la table `projets_etudes`
--

DROP TABLE IF EXISTS `projets_etudes`;
CREATE TABLE IF NOT EXISTS `projets_etudes` (
  `idprojets_etudes` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `mission` longtext,
  `Compétences_validees` longtext,
  PRIMARY KEY (`idprojets_etudes`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projets_etudes`
--

INSERT INTO `projets_etudes` (`idprojets_etudes`, `titre`, `description`, `mission`, `Compétences_validees`) VALUES
(1, 'Ilinkedin', 'Projet en équipe Ilinkedin réalisé à l\'université de Limoges', 'Retravailler l\'ensemble du livre blanc \" LinkedIn, nouveau territoire de communication\" dont nous mettons à votre disposition la version minimaliste au format .txt', 'Comprendre comment s\'est mis en place le Web / Etudier la notion de navigation : liens entre les pages et dans les pages (hypertexte) / Réaliser l\'architecture d\'un site web simple / S\'initier au langage HTML de base / Elaborer un site hypertexte à partir d\'une architecture décrite'),
(2, 'Chalets et Caviar', 'Projet individuel réalisé chez OpenClassrooms', 'Votre nouveau client est une agence immobilière d\'une station de montagne. Celle-ci n\'a toujours pas de site web et possède pourtant de nombreux chalets luxueux à vendre ! Cette agence souhaite pouvoir mettre à jour son site régulièrement toute seule sans faire appel à nouveau à vous. Vous décidez donc de leur créer un site sous Wordpress qu\'ils pourront modifier et d\'utiliser un thème adapté à leurs besoins.\r\nDéveloppement : Wordpress', ' Sélectionner un thème Wordpress adapté aux besoins du client / Adapter un thème Wordpress pour respecter les exigences du client / Rédiger une documentation à l\'intention d\'utilisateurs non spécialistes'),
(3, 'Festival de films', 'Projet individuel réalisé chez OpenClassrooms', ' Projet individuel réalisé chez OpenClassrooms\r\nMission : Jennifer Viala est l\'organisatrice du Festival des Films de Plein Air. Elle ambitionne de sélectionner et projeter des films d\'auteur en plein air du 5 au 8 août au parc Monceau à Paris. Son association vient juste d\'être créée et elle dispose d\'un budget limité. Elle a besoin de communiquer en ligne sur son festival, d\'annoncer les films projetés et de recueillir les réservations.\r\nMéthodologie de travail : Analyse des besoins et maquetage\r\nDéveloppement : HTML5/CSS3/JavaScript', 'Analyser un cahier des charges / Choisir une solution technique adaptée parmi les solutions existantes si cela est pertinent / Rédiger les spécifications détaillées du projet / Lister les fonctionnalités demandées par un client'),
(4, 'Express Food', 'Projet individuel réalisé chez OpenClassrooms', 'Vous venez d\'être recruté(e) par la toute jeune startup ExpressFood. Elle ambitionne de livrer des plats de qualité à domicile en moins de 20 minutes grâce à un réseau de livreurs à vélo', ' Réaliser des schémas UML cohérents et en accord avec les besoins énoncés / Implémenter le schéma de données dans la base / Concevoir l’architecture technique d’une application à l’aide de diagrammes UML / Réaliser un schéma de conception de la base de données de l’application'),
(5, 'Mon blog', 'Projet individuel réalisé chez OpenClassrooms ', 'Ça y est vous avez sauté le pas ! Le monde du développement web avec PHP est à portée de main et vous avez besoin de visibilité pour pouvoir convaincre vos futurs employeurs/clients en un seul regard. Vous êtes développeur PHP, il est donc temps de montrer vos talents au travers d’un blog à vos couleurs.\r\nMéthodologie de travail : Analyse des besoins et diagramme UML\r\nDéveloppement : HTML5/CSS3/Bootstrap/PHP/POO/Sql/Composer/PhpMyAdmin', 'Analyser un cahier des charges / Gérer ses données avec une base de données / Rédiger les spécifications détaillées du projet / Proposer un code propre et facilement évolutif / Choisir une solution technique adaptée parmi les solutions existantes si cela est pertinent / Assurer le suivi qualité d’un projet / Créer et maintenir l’architecture technique du site / Conceptualiser l\'ensemble de son application en décrivant sa structure (Entités / Domain Objects) / Créer une page web permettant de recueillir les informations saisies par un internaute / Estimer une tâche et tenir les délais\r\n\r\n'),
(6, 'Snow Tricks', 'Projet individuel réalisé chez OpenClassrooms ', 'Jimmy Sweat est un entrepreneur ambitieux. Son objectif est d\'en faire un outil pour apprendre les figures (tricks) du snowboard, de permettre la vulgarisation du snowboard auprès du plus grand nombre. Il souhaite capitaliser sur du contenu apporté par les internautes afin d’acquérir une base de données riche et suscitant l’intérêt des internautes qui passerait par le site web. Par la suite, Jimmy souhaite développer un business de mise en relation avec les marques de snowboard grâce au trafic que le contenu aura généré. Jimmy vous a contacté pour que vous lui développiez le prochain super site communautaire qui fera fureur\r\nMéthodologie de travail : Analyse des besoins / diagramme UM / suivi du Wireframe\r\nDéveloppement : Symfony/HTML5/CSS3/Bootstrap/PHP/POO/MySql/Composer/Doctrine/Sql', 'Prendre en main le moteur de templating Twig / Respecter les bonnes pratiques de développement en vigueur / Sélectionner les langages de programmation adaptés pour le développement de l’application / Développer une application proposant les fonctionnalités attendues par le client / Gérer une base de données MySQL ou NoSQL avec Doctrine / Organiser son code pour garantir la lisibilité et la maintenabilité / Prendre en main le framework Symfony');

-- --------------------------------------------------------

--
-- Structure de la table `projets_professionnels`
--

DROP TABLE IF EXISTS `projets_professionnels`;
CREATE TABLE IF NOT EXISTS `projets_professionnels` (
  `idprojets_professionnels` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `description` longtext,
  `mission` longtext,
  PRIMARY KEY (`idprojets_professionnels`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projets_professionnels`
--

INSERT INTO `projets_professionnels` (`idprojets_professionnels`, `titre`, `description`, `mission`) VALUES
(1, 'La Formation Marketing Digitale', 'Participation à la création de la nouvelle filière cinquième année Marketing Digitale de l\'ESCG Paris', 'Communiquer sur le nouveau cycle Marketing Digital avant la rentrée de septembre 2016 avec la création d\'un site dédiée à la nouvelle spécialisation\r\nDéveloppement : HTML5/CSS3/Bootstrap/JavaScript'),
(2, 'Marketing Digitale', 'Participation à l\'amélioration de la nouvelle filière cinquième année Marketing Digitale de l\'ESCG Paris', 'Après le lancement du nouveau cycle Marketing Digital il m\'a été confiée de créer un site dont l\'objectif est de remplacer le premier et d\'être mise à jour par les étudiants de Marketing Digital.\r\nDéveloppement : Wordpress'),
(3, 'Le Souvenir Franco Polonais', 'Participation à la communication web de l\'association Le Souvenir Franco-Polonais', 'Communiquer sur l\'association Le Souvenir Franco Polonais, inciter à devenir membre et mise en place d\'un système de paiement avec paypal.\r\nDéveloppement : WORDPRESS'),
(4, 'Marketdigidoc', 'Proposition et participation à la création d\'une application de ressources documentaires destinée aux étudiants de l\'ESCG Paris dont la nécessité est croissante.', 'Avec le démarrage de la nouvelle filière cinquième année Marketing Digital l\'ESCG Paris a besoin d\'une base de ressources documentaires commune à tous les étudiants et accessible à tout moment.\r\nDéveloppement : HTML5/CSS3/Bootstrap/PHP/Symfony/MySql/SSL');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
