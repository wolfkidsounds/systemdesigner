-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Sep 2023 um 22:30
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db96278`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `amplifier`
--

CREATE TABLE `amplifier` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `brand_id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rack_units` varchar(255) NOT NULL,
  `ch_outputs` varchar(255) NOT NULL,
  `amp_power_16` varchar(255) NOT NULL,
  `amp_vpeak_16` varchar(255) NOT NULL,
  `amp_vgain_16` varchar(255) NOT NULL,
  `amp_power_8` varchar(255) NOT NULL,
  `amp_vpeak_8` varchar(255) NOT NULL,
  `amp_vgain_8` varchar(255) NOT NULL,
  `amp_power_4` varchar(255) NOT NULL,
  `amp_vpeak_4` varchar(255) NOT NULL,
  `amp_vgain_4` varchar(255) NOT NULL,
  `amp_power_2` varchar(255) NOT NULL,
  `amp_vpeak_2` varchar(255) NOT NULL,
  `amp_vgain_2` varchar(255) NOT NULL,
  `amp_power_bridge_8` varchar(255) NOT NULL,
  `amp_vpeak_bridge_8` varchar(255) NOT NULL,
  `amp_vgain_bridge_8` varchar(255) NOT NULL,
  `amp_power_bridge_4` varchar(255) NOT NULL,
  `amp_vpeak_bridge_4` varchar(255) NOT NULL,
  `amp_vgain_bridge_4` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `file_attachment` varchar(255) NOT NULL COMMENT 'File Name of the Manual',
  `date_edited` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `amplifier`
--

INSERT INTO `amplifier` (`id`, `user_id`, `brand_id`, `name`, `rack_units`, `ch_outputs`, `amp_power_16`, `amp_vpeak_16`, `amp_vgain_16`, `amp_power_8`, `amp_vpeak_8`, `amp_vgain_8`, `amp_power_4`, `amp_vpeak_4`, `amp_vgain_4`, `amp_power_2`, `amp_vpeak_2`, `amp_vgain_2`, `amp_power_bridge_8`, `amp_vpeak_bridge_8`, `amp_vgain_bridge_8`, `amp_power_bridge_4`, `amp_vpeak_bridge_4`, `amp_vgain_bridge_4`, `date_created`, `file_attachment`, `date_edited`) VALUES
(6, 1, 5, 'Quadro 500 DSP', '1', '4', '0', '0', '0', '250', '44.72', '33.01', '500', '44.72', '33.01', '0', '0', '0', '500', '63.25', '36.02', '1000', '63.25', '36.02', '2023-09-16 20:15:39', 'the t.amp_-_Quadro 500 DSP.pdf', '2023-09-21 16:04:35'),
(7, 1, 1, 'MS 5004', '2', '4', '0', '0', '0', '350', '52.92', '34.47', '520', '45.61', '33.18', '0', '0', '0', '1040', '91.21', '39.20', '0', '0', '0', '2023-09-16 20:23:05', '', '0000-00-00 00:00:00'),
(8, 1, 1, 'MS 8004', '2', '4', '0', '0', '0', '550', '66.33', '36.43', '820', '57.27', '35.16', '0', '0', '0', '1640', '114.54', '41.18', '0', '0', '0', '2023-09-17 20:04:42', '', '0000-00-00 00:00:00'),
(9, 1, 3, 'DXA 900', '1', '2', '0', '0', '0', '450', '60.00', '35.56', '800', '56.57', '35.05', '1400', '52.92', '34.47', '0', '0', '0', '0', '0', '0', '2023-09-17 20:08:55', '', '0000-00-00 00:00:00'),
(10, 1, 3, 'DXA 1300', '1', '2', '0', '0', '0', '650', '72.11', '37.16', '1400', '74.83', '37.48', '2300', '67.82', '36.63', '0', '0', '0', '0', '0', '0', '2023-09-17 20:11:13', '', '0000-00-00 00:00:00'),
(11, 1, 3, 'DXA 2000', '1', '2', '0', '0', '0', '1000', '89.44', '39.03', '1700', '82.46', '38.33', '3000', '77.46', '37.78', '0', '0', '0', '0', '0', '0', '2023-09-17 20:13:35', '', '0000-00-00 00:00:00'),
(12, 1, 3, 'PXA 2000', '2', '2', '0', '0', '0', '300', '48.99', '33.80', '400', '40.00', '32.04', '550', '33.17', '30.41', '800', '80.00', '38.06', '1020', '63.87', '36.11', '2023-09-17 20:17:05', '', '0000-00-00 00:00:00'),
(13, 1, 3, 'PXA 3000', '2', '2', '0', '0', '0', '330', '51.38', '34.22', '545', '46.69', '33.38', '900', '42.43', '32.55', '1090', '93.38', '39.41', '1360', '73.76', '37.36', '2023-09-17 20:20:06', '', '0000-00-00 00:00:00'),
(14, 1, 3, 'PXA 4000', '2', '2', '0', '0', '0', '800', '80.00', '38.06', '1200', '69.28', '36.81', '1450', '53.85', '34.62', '1600', '113.14', '41.07', '2100', '91.65', '39.24', '2023-09-17 20:23:09', '', '0000-00-00 00:00:00'),
(15, 1, 3, 'PXA 5000', '3', '2', '0', '0', '0', '1050', '91.65', '39.24', '1400', '74.83', '37.48', '2000', '63.25', '36.02', '2400', '138.56', '42.83', '3200', '113.14', '41.07', '2023-09-17 20:26:35', '', '0000-00-00 00:00:00'),
(16, 1, 4, 'APS 8000', '2', '2', '0', '0', '0', '1300', '101.98', '40.17', '2000', '89.44', '39.03', '3000', '77.46', '37.78', '4000', '178.89', '45.05', '5500', '148.32', '43.42', '2023-09-17 20:32:48', '', '0000-00-00 00:00:00'),
(17, 1, 5, 'TA 2400 MK-X', '2', '2', '0', '0', '0', '760', '77.97', '37.84', '1200', '69.28', '36.81', '0', '0', '0', '2300', '135.65', '42.65', '0', '0', '0', '2023-09-21 16:06:26', 'the t.amp_-_TA 2400-MKX.pdf', '2023-09-21 16:08:07'),
(18, 1, 5, 'TA 1400 MK-X', '2', '2', '0', '0', '0', '570', '67.53', '36.59', '850', '58.31', '35.31', '0', '0', '0', '1600', '113.14', '41.07', '0', '0', '0', '2023-09-21 16:07:39', 'the t.amp_-_TA 1400 MK-X.pdf', '2023-09-21 16:07:39'),
(19, 1, 5, 'TA 1050 MK-X', '2', '2', '0', '0', '0', '380', '55.14', '34.83', '520', '45.61', '33.18', '0', '0', '0', '1050', '91.65', '39.24', '0', '0', '0', '2023-09-21 16:08:47', 'the t.amp_-_TA 1050 MK-X.pdf', '2023-09-21 16:08:47'),
(20, 1, 5, 'TA 600 MK-X', '2', '2', '0', '0', '0', '220', '41.95', '32.46', '330', '36.33', '31.21', '0', '0', '0', '640', '71.55', '37.09', '0', '0', '0', '2023-09-21 16:09:24', 'the t.amp_-_TA 600 MK-X.pdf', '2023-09-21 16:09:24'),
(21, 1, 5, 'TA 450 MK-X', '2', '2', '0', '0', '0', '160', '35.78', '31.07', '250', '31.62', '30.00', '0', '0', '0', '490', '62.61', '35.93', '0', '0', '0', '2023-09-21 16:10:02', 'the t.amp_-_TA 450 MK-X.pdf', '2023-09-21 16:10:02'),
(22, 1, 35, 'P-400', '2', '2', '0', '0', '0', '100', '28.28', '29.03', '200', '28.28', '29.03', '0', '0', '0', '400', '56.57', '35.05', '0', '0', '0', '2023-09-21 16:15:40', 'DAP Audio_-_P-400.pdf', '2023-09-21 16:15:40'),
(23, 1, 35, 'P-1200', '2', '2', '0', '0', '0', '160', '35.78', '31.07', '250', '31.62', '30.00', '0', '0', '0', '500', '63.25', '36.02', '0', '0', '0', '2023-09-21 16:16:10', 'DAP Audio_-_P-1200.pdf', '2023-09-21 16:19:23'),
(24, 1, 35, 'P-700', '2', '2', '0', '0', '0', '250', '44.72', '33.01', '350', '37.42', '31.46', '0', '0', '0', '700', '74.83', '37.48', '0', '0', '0', '2023-09-21 16:16:49', 'DAP Audio_-_P-700.pdf', '2023-09-21 16:16:49'),
(25, 1, 35, 'P-900', '2', '2', '0', '0', '0', '300', '48.99', '33.80', '450', '42.43', '32.55', '0', '0', '0', '900', '84.85', '38.57', '0', '0', '0', '2023-09-21 16:17:27', 'DAP Audio_-_P-900.pdf', '2023-09-21 16:17:27'),
(26, 1, 35, 'P-1200', '2', '2', '0', '0', '0', '400', '56.57', '35.05', '600', '48.99', '33.80', '0', '0', '0', '1200', '97.98', '39.82', '0', '0', '0', '2023-09-21 16:17:56', 'DAP Audio_-_P-1200.pdf', '2023-09-21 16:17:56'),
(27, 1, 35, 'P-1600', '2', '2', '0', '0', '0', '525', '64.81', '36.23', '800', '56.57', '35.05', '0', '0', '0', '1600', '113.14', '41.07', '0', '0', '0', '2023-09-21 16:18:27', 'DAP Audio_-_P-1600.pdf', '2023-09-21 16:18:27'),
(28, 1, 35, 'P-2000', '2', '2', '0', '0', '0', '750', '77.46', '37.78', '1025', '64.03', '36.13', '0', '0', '0', '2000', '126.49', '42.04', '0', '0', '0', '2023-09-21 16:18:59', 'DAP Audio_-_P-2000.pdf', '2023-09-21 16:18:59');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `brand`
--

CREATE TABLE `brand` (
  `id` int(20) UNSIGNED NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT 'Brand Name',
  `date_created` datetime DEFAULT NULL COMMENT 'Date Created'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `brand`
--

INSERT INTO `brand` (`id`, `user_id`, `name`, `date_created`) VALUES
(1, 1, 'Fame Audio', NULL),
(4, 1, 'Solution²', NULL),
(3, 1, 'Sirus', NULL),
(5, 1, 'the t.amp', NULL),
(6, 1, 'Palladium', NULL),
(7, 1, 'EE Systems', NULL),
(8, 1, 'Behringer', NULL),
(9, 1, 'Pronomic', NULL),
(11, 1, 'Synq Audio', NULL),
(12, 1, 'PL-Audio', NULL),
(13, 1, 'PROKUSTK', NULL),
(14, 1, 'Carvin', NULL),
(15, 1, 'ElectroVoice', NULL),
(16, 1, 'Coda Audio', NULL),
(17, 1, 'Eminence', NULL),
(18, 1, 'the box', NULL),
(19, 1, 'Fane', NULL),
(20, 1, 'JBL', NULL),
(21, 1, 'AW Audio', NULL),
(22, 1, 'RCF', NULL),
(35, 1, 'DAP Audio', NULL),
(24, 1, 'BMS', NULL),
(25, 1, 'American Audio', NULL),
(26, 1, 'Pulsation Audio', NULL),
(34, 1, 'Xilica', NULL),
(33, 1, 'dbx', NULL),
(32, 1, 'Omnitronic', NULL),
(31, 1, 'the t.racks', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `chassis`
--

CREATE TABLE `chassis` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `created_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `user_id` int(20) DEFAULT NULL,
  `brand_id` int(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `files`
--

CREATE TABLE `files` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `file_name` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `processor`
--

CREATE TABLE `processor` (
  `id` int(20) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `brand_id` int(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ch_inputs` varchar(255) DEFAULT NULL,
  `ch_outputs` varchar(255) DEFAULT NULL,
  `proc_offset` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_edited` datetime DEFAULT NULL,
  `file_attachment` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `processor`
--

INSERT INTO `processor` (`id`, `user_id`, `brand_id`, `name`, `ch_inputs`, `ch_outputs`, `proc_offset`, `date_created`, `date_edited`, `file_attachment`) VALUES
(2, 1, 8, 'DCX 2496 LE', '2', '6', '22', NULL, NULL, NULL),
(11, 1, 31, 'DS 2/4', '2', '4', '0', NULL, NULL, NULL),
(12, 1, 31, 'DSP 206', '2', '6', '0', NULL, NULL, NULL),
(13, 1, 5, 'Quadro 500 DSP', '4', '4', '0', NULL, NULL, NULL),
(17, 1, 34, 'XP 4080', '4', '8', '20', NULL, NULL, 'the t.amp_-_TA 2400-MKX.pdf');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `remember_me_tokens`
--

CREATE TABLE `remember_me_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `speaker`
--

CREATE TABLE `speaker` (
  `id` int(20) UNSIGNED NOT NULL COMMENT 'Primary Key',
  `user_id` int(20) UNSIGNED DEFAULT NULL,
  `brand_id` int(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `power_rms` varchar(255) DEFAULT NULL,
  `power_program` varchar(255) DEFAULT NULL,
  `power_peak` varchar(255) DEFAULT NULL,
  `impedance` varchar(255) DEFAULT NULL,
  `vpeak` varchar(255) DEFAULT NULL,
  `vrms` varchar(255) DEFAULT NULL,
  `sensitivity` varchar(255) DEFAULT NULL,
  `max_spl` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_edited` datetime DEFAULT NULL,
  `sp_type` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `speaker`
--

INSERT INTO `speaker` (`id`, `user_id`, `brand_id`, `name`, `power_rms`, `power_program`, `power_peak`, `impedance`, `vpeak`, `vrms`, `sensitivity`, `max_spl`, `date_created`, `date_edited`, `sp_type`) VALUES
(5, 1, 14, '2470-R520', '90', '180', '360', '8', '37.95', '26.83', '105', '124.54', NULL, NULL, 'HF'),
(4, 1, 14, '1331', '500', '1000', '2000', '8', '89.44', '63.25', '105', '131.99', NULL, NULL, 'FR');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(20) UNSIGNED NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `user_mail`, `user_name`, `user_pass`) VALUES
(1, 'eric@pulsationaudio.com', 'Pulsation Audio', '$2y$10$XLaaJd9aofvLEI8j9Xald.P0CGxsOlDmODRqt.zFvnwCCgbDGKJoS');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_settings`
--

CREATE TABLE `user_settings` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'Primary Key',
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `setting_key` varchar(255) DEFAULT NULL,
  `setting_value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `user_settings`
--

INSERT INTO `user_settings` (`id`, `user_id`, `setting_key`, `setting_value`) VALUES
(1, 1, 'show_registered_amplifiers', 'true'),
(2, 1, 'show_registered_speakers', 'true'),
(3, 1, 'show_registered_chassis', 'true'),
(4, 1, 'show_registered_brands', 'true'),
(5, 1, 'show_registered_processors', 'true');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `amplifier`
--
ALTER TABLE `amplifier`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `chassis`
--
ALTER TABLE `chassis`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `processor`
--
ALTER TABLE `processor`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `remember_me_tokens`
--
ALTER TABLE `remember_me_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `speaker`
--
ALTER TABLE `speaker`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `amplifier`
--
ALTER TABLE `amplifier`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT für Tabelle `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT für Tabelle `chassis`
--
ALTER TABLE `chassis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT für Tabelle `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';

--
-- AUTO_INCREMENT für Tabelle `processor`
--
ALTER TABLE `processor`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `remember_me_tokens`
--
ALTER TABLE `remember_me_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `speaker`
--
ALTER TABLE `speaker`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
