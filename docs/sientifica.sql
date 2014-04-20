-- phpMyAdmin SQL Dump
-- version 4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2014 at 11:26 AM
-- Server version: 5.6.14
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sientificaBase`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE IF NOT EXISTS `actions` (
  `action_id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(45) NOT NULL,
  `id_controller` varchar(45) NOT NULL,
  `action_name` varchar(128) DEFAULT NULL,
  `action_desc` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`action_id`),
  KEY `fk_actions_controllers1` (`id_controller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `actions_profiles`
--

CREATE TABLE IF NOT EXISTS `actions_profiles` (
  `action_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `allow` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`action_id`,`profile_id`),
  KEY `fk_actions_has_profiles_profiles1` (`profile_id`),
  KEY `fk_actions_has_profiles_actions1` (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `controllers`
--

CREATE TABLE IF NOT EXISTS `controllers` (
  `id_controller` varchar(45) NOT NULL,
  `controller_name` varchar(128) DEFAULT NULL,
  `controller_desc` varchar(255) DEFAULT NULL,
  `module` varchar(80) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_controller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `action_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `allow` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`action_id`,`user_id`),
  KEY `fk_actions_has_users_users1` (`user_id`),
  KEY `fk_actions_has_users_actions1` (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `profile` varchar(45) NOT NULL,
  `super` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`profile_id`),
  KEY `fk_profiles_profiles1` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profiles_controllers`
--

CREATE TABLE IF NOT EXISTS `profiles_controllers` (
  `profile_id` int(11) NOT NULL,
  `id_controller` varchar(45) NOT NULL,
  PRIMARY KEY (`id_controller`,`profile_id`),
  KEY `fk_profiles_has_controllers_controllers1` (`id_controller`),
  KEY `fk_profiles_has_controllers_profiles1` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `nickname` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(160) NOT NULL,
  `updated` tinyint(1) DEFAULT '0',
  `position` varchar(80) DEFAULT NULL,
  `phone1` varchar(45) DEFAULT NULL,
  `phone2` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_users_profiles1` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vuelos`
--

CREATE TABLE IF NOT EXISTS `vuelos` (
  `idvuelo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `vuelo` varchar(10) DEFAULT NULL,
  `aerolinea` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idvuelo`),
  UNIQUE KEY `unicovuelo` (`fecha`,`vuelo`,`aerolinea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `fk_actions_controllers1` FOREIGN KEY (`id_controller`) REFERENCES `controllers` (`id_controller`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `actions_profiles`
--
ALTER TABLE `actions_profiles`
  ADD CONSTRAINT `fk_actions_has_profiles_actions1` FOREIGN KEY (`action_id`) REFERENCES `actions` (`action_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_actions_has_profiles_profiles1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`profile_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `fk_actions_has_users_actions1` FOREIGN KEY (`action_id`) REFERENCES `actions` (`action_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_actions_has_users_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `fk_profiles_profiles1` FOREIGN KEY (`parent_id`) REFERENCES `profiles` (`profile_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `profiles_controllers`
--
ALTER TABLE `profiles_controllers`
  ADD CONSTRAINT `fk_profiles_has_controllers_controllers1` FOREIGN KEY (`id_controller`) REFERENCES `controllers` (`id_controller`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_profiles_has_controllers_profiles1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`profile_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_profiles1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`profile_id`) ON DELETE CASCADE ON UPDATE NO ACTION;



/* Adding Default User */

INSERT INTO `profiles` (`profile_id`, `parent_id`, `profile`, `super`) VALUES
(1, NULL, 'SUPER', 1),
(2, 1, 'Administrador', 1);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `profile_id`, `parent_id`, `nickname`, `password`, `name`, `updated`, `position`, `phone1`, `phone2`, `mobile`) VALUES
(1, 1, NULL, 'super', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin', 1, NULL, NULL, NULL, NULL),
(2, 2, NULL, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrador', 1, NULL, NULL, NULL, NULL);
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
