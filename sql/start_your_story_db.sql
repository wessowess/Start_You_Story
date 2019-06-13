-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  ven. 07 juin 2019 à 10:27
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `start_your_story_db`
--
CREATE DATABASE IF NOT EXISTS `start_your_story_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `start_your_story_db`;

-- --------------------------------------------------------

--
-- Structure de la table `sys_datas_form`
--

CREATE TABLE `sys_datas_form` (
  `sys_df_id` int(11) NOT NULL,
  `sys_df_ref` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_create_date` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_how_you_know_us` varchar(21) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_hyku_precision` varchar(130) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_df_civility` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_birthday` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_email` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_driving_license` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_means_of_transport` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_accompaniment` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_accompaniment_precision` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sys_df_step_text` text COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_qualifications` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_training_project` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_business_project` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_cfa_project` varchar(130) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_geographical_area` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_steps` text COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_accompaniment_step_choice` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `sys_df_difficulties_encountered` text COLLATE utf8_unicode_ci,
  `sys_df_other_info` text COLLATE utf8_unicode_ci,
  `sys_df_treat` int(11) NOT NULL,
  `sys_df_treat_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `sys_datas_form`
--
ALTER TABLE `sys_datas_form`
  ADD PRIMARY KEY (`sys_df_id`),
  ADD UNIQUE KEY `sys_df_ref` (`sys_df_ref`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `sys_datas_form`
--
ALTER TABLE `sys_datas_form`
  MODIFY `sys_df_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
