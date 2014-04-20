-- phpMyAdmin SQL Dump
-- version 4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2014 at 11:25 AM
-- Server version: 5.6.14
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cargafinal`
--

--
-- Dumping data for table `profiles`
--

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
