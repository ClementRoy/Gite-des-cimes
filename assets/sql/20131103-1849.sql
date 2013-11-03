-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 03 Novembre 2013 à 18:48
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `gites_des_cimes`
--

-- --------------------------------------------------------

--
-- Structure de la table `app`
--

CREATE TABLE `app` (
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `rank` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`identifier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `identifier`, `password`, `firstname`, `lastname`, `rank`) VALUES
(1, 'Marie-Christine', '34926a0e10e2920963e9b3c051ea6aea', 'Marie-Christine', 'Belhouli', 5),
(2, 'Christophe', '817e68fbc85078474a1aeb1fdef17fa0', 'Christophe', 'Béghin', 5),
(3, 'Clement', 'bd6fc002611d6dce05db25dfcd7b566f', 'Clément', 'Roy', 5);
