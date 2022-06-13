-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Temps de generació: 13-06-2022 a les 21:21:11
-- Versió del servidor: 10.4.24-MariaDB
-- Versió de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `php_report_manager`
--
CREATE DATABASE IF NOT EXISTS `php_report_manager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `php_report_manager`;

-- --------------------------------------------------------

--
-- Estructura de la taula `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `clients_id` int(9) NOT NULL,
  `clients_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clients_id_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clients_email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clients_type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `clients_type`
--

DROP TABLE IF EXISTS `clients_type`;
CREATE TABLE `clients_type` (
  `clients_type_id` int(2) NOT NULL,
  `clients_type_description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `reports_id` int(9) NOT NULL,
  `reports_client_id` int(9) NOT NULL,
  `reports_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reports_state` int(2) NOT NULL,
  `reports_date` date NOT NULL,
  `reports_invoice` int(1) NOT NULL,
  `reports_photos` int(1) NOT NULL,
  `reports_authorisation` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `reports_state`
--

DROP TABLE IF EXISTS `reports_state`;
CREATE TABLE `reports_state` (
  `reports_state_id` int(2) NOT NULL,
  `reports_state_description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clients_id`),
  ADD KEY `clients_type` (`clients_type`);

--
-- Índexs per a la taula `clients_type`
--
ALTER TABLE `clients_type`
  ADD PRIMARY KEY (`clients_type_id`);

--
-- Índexs per a la taula `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`reports_id`),
  ADD KEY `reports_client_id` (`reports_client_id`),
  ADD KEY `reports_state` (`reports_state`);

--
-- Índexs per a la taula `reports_state`
--
ALTER TABLE `reports_state`
  ADD PRIMARY KEY (`reports_state_id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `clients`
--
ALTER TABLE `clients`
  MODIFY `clients_id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `clients_type`
--
ALTER TABLE `clients_type`
  MODIFY `clients_type_id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `reports`
--
ALTER TABLE `reports`
  MODIFY `reports_id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `reports_state`
--
ALTER TABLE `reports_state`
  MODIFY `reports_state_id` int(2) NOT NULL AUTO_INCREMENT;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `fk_clients_type` FOREIGN KEY (`clients_type`) REFERENCES `clients_type` (`clients_type_id`);

--
-- Restriccions per a la taula `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_reports_client_id` FOREIGN KEY (`reports_client_id`) REFERENCES `clients` (`clients_id`),
  ADD CONSTRAINT `fk_reports_state` FOREIGN KEY (`reports_state`) REFERENCES `reports_state` (`reports_state_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
