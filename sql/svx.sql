-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 07 nov 2020 kl 17:41
-- Serverversion: 5.7.32-0ubuntu0.18.04.1
-- PHP-version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `svxinstall`
--

-- --------------------------------------------------------

--
-- Table Structure`Coverage`
--

CREATE TABLE `Coverage` (
  `Id` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Radiomobilestring` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table Structure`Daylog`
--

CREATE TABLE `Daylog` (
  `ID` int(11) NOT NULL,
  `Repeater` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table Structure`dtmf_command`
--

CREATE TABLE `dtmf_command` (
  `id` int(11) NOT NULL,
  `station_name` varchar(90) NOT NULL,
  `station_id` int(11) NOT NULL,
  `Command` varchar(20) NOT NULL,
  `Description` text NOT NULL,
  `Category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table Structure`filter`
--

CREATE TABLE `filter` (
  `id` int(11) NOT NULL,
  `JSON` text NOT NULL,
  `filter` text NOT NULL,
  `Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table Structure`Information_page`
--

CREATE TABLE `Information_page` (
  `id` int(11) NOT NULL,
  `station_name` varchar(20) NOT NULL,
  `station_id` int(11) NOT NULL,
  `Html` text NOT NULL,
  `Hardware_page` text NOT NULL,
  `Image` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table Structure`Operation_log`
--

CREATE TABLE `Operation_log` (
  `id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table Structure`ReflectorNodeLog`
--

CREATE TABLE `ReflectorNodeLog` (
  `Id` int(11) NOT NULL,
  `Callsign` varchar(40) NOT NULL,
  `Type` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  `Talkgroup` bigint(20) NOT NULL,
  `NODE` varchar(11) NOT NULL,
  `Siglev` int(11) NOT NULL,
  `Duration` int(11) NOT NULL,
  `Nodename` varchar(80) NOT NULL,
  `IsTalker` int(20) NOT NULL,
  `Time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Talktime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table Structure`ReflectorStations`
--

CREATE TABLE `ReflectorStations` (
  `ID` int(11) NOT NULL,
  `Callsign` varchar(40) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `Location` text NOT NULL,
  `Colour` text,
  `Last_Seen` datetime DEFAULT NULL,
  `Station_Down` int(11) NOT NULL,
  `Station_Down_timmer_count` int(11) NOT NULL,
  `Monitor` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table Structure`repeater`
--

CREATE TABLE `repeater` (
  `id` int(11) NOT NULL,
  `Openings` int(11) NOT NULL,
  `Nag` int(11) NOT NULL,
  `Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table Structure`Settings`
--

CREATE TABLE `Settings` (
  `id` int(11) NOT NULL,
  `Define` varchar(80) NOT NULL,
  `value` text NOT NULL,
  `Name` text NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping all Data in table `Settings`
--

INSERT INTO `Settings` (`id`, `Define`, `value`, `Name`, `type`) VALUES
(1, 'PORTAL_VERSION', '2.4', 'protal version number ', 1),
(2, 'HIDE_LANGUAGE_BAR', '0', 'Hide the language bar', 1),
(3, 'USE_CUSTOM_SIDEBAR_HEADER', '0', 'Use Custom header in sidebar', 1),
(4, 'iframe_documentation_url', 'http://sk3w.se/dokuwiki/doku.php?id=svxreflector&do=export_xhtml', 'External documentation page', 2),
(5, 'USE_LOGIN', '0', 'Use login for player', 1),
(6, 'USE_EXTERNAL_URL', '1', 'Use external dokumentation page', 1),
(7, 'PLAYER_TALKGROUP_DEFAULT', '240', 'The default talkgroup for Recording statistic', 2),
(8, 'SEND_MAIL_TO_SYSOP', '0', 'Send an email to sysop when the node goes down', 1),
(9, 'SYSMASTER_MAIL', 'info@a.se', 'Mail to system administrator', 2),
(10, 'SYSTEM_MAIL', 'info@a.se', 'E-mail address for the system', 2),
(11, 'REFLECTOR_SERVER_ADDRESS', '127.0.0.1', 'Server address to svxreflector', 2),
(12, 'REFLECTOR_SERVER_PORT', '5300', 'SvxReflector server port ', 2),
(13, 'API_KEY_TINY_CLOUD', 'no-api', 'TinyMCE Cloud API KEY', 2),
(14, 'HIDE_MONITOR_BAR', '0', ' Hide the Monitor bar', 1),
(15, 'USE_NODE_ADMIN_NOTIFICATION', '0', '\"Beta\" Node admin notfication', 1);

-- --------------------------------------------------------

--
-- Table Structure`Talkgroup`
--

CREATE TABLE `Talkgroup` (
  `ID` int(11) NOT NULL,
  `TG` int(11) NOT NULL,
  `TXT` text NOT NULL,
  `Colour` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table Structure`users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Username` varchar(40) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `level` int(11) NOT NULL,
  `Is_admin` int(11) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `image_url` varchar(100),
  `Reset_token` varchar(100)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping all Data in table `users`
--

INSERT INTO `users` (`id`, `Username`, `Password`, `level`, `Is_admin`, `Firstname`, `lastname`) VALUES
(1, 'svxportal', 'cd4d75d7a6c085717688aab7c626847e', 3, 1, 'svxportal', 'install');

-- --------------------------------------------------------

--
-- Table Structure`User_Permission`
--

CREATE TABLE `User_Permission` (
  `id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `RW` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index för dumpade tableer
--

--
-- Index för table `Coverage`
--
ALTER TABLE `Coverage`
  ADD PRIMARY KEY (`Id`);

--
-- Index för table `Daylog`
--
ALTER TABLE `Daylog`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Index för table `dtmf_command`
--
ALTER TABLE `dtmf_command`
  ADD PRIMARY KEY (`id`);

--
-- Index för table `filter`
--
ALTER TABLE `filter`
  ADD PRIMARY KEY (`id`);

--
-- Index för table `Information_page`
--
ALTER TABLE `Information_page`
  ADD PRIMARY KEY (`id`);

--
-- Index för table `Operation_log`
--
ALTER TABLE `Operation_log`
  ADD PRIMARY KEY (`id`);

--
-- Index för table `ReflectorNodeLog`
--
ALTER TABLE `ReflectorNodeLog`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Callsign` (`Callsign`),
  ADD KEY `NODE` (`NODE`),
  ADD KEY `Nodename` (`Nodename`),
  ADD KEY `Talkgroup` (`Talkgroup`),
  ADD KEY `Callsign_2` (`Callsign`),
  ADD KEY `Type` (`Type`),
  ADD KEY `Nodename_2` (`Nodename`),
  ADD KEY `Time` (`Time`),
  ADD KEY `Id` (`Id`);

--
-- Index för table `ReflectorStations`
--
ALTER TABLE `ReflectorStations`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Callsign` (`Callsign`),
  ADD KEY `Callsign_2` (`Callsign`);

--
-- Index för table `repeater`
--
ALTER TABLE `repeater`
  ADD PRIMARY KEY (`id`);

--
-- Index för table `Settings`
--
ALTER TABLE `Settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Define` (`Define`);

--
-- Index för table `Talkgroup`
--
ALTER TABLE `Talkgroup`
  ADD PRIMARY KEY (`ID`);

--
-- Index för table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index för table `User_Permission`
--
ALTER TABLE `User_Permission`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tableer
--

--
-- AUTO_INCREMENT för table `Coverage`
--
ALTER TABLE `Coverage`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för table `Daylog`
--
ALTER TABLE `Daylog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för table `dtmf_command`
--
ALTER TABLE `dtmf_command`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för table `filter`
--
ALTER TABLE `filter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för table `Information_page`
--
ALTER TABLE `Information_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för table `Operation_log`
--
ALTER TABLE `Operation_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för table `Settings`
--
ALTER TABLE `Settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT för table `Talkgroup`
--
ALTER TABLE `Talkgroup`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT för table `User_Permission`
--
ALTER TABLE `User_Permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



ALTER TABLE `users` ADD `email` TEXT NOT NULL AFTER `lastname`; 

ALTER TABLE `Information_page` ADD `Module` VARCHAR(90) NOT NULL AFTER `station_id`;

ALTER TABLE `ReflectorNodeLog` CHANGE `Id` `Id` INT(11) NOT NULL AUTO_INCREMENT; 

ALTER TABLE ReflectorNodeLog AUTO_INCREMENT = 1;



-- --------------------------------------------------------

--
-- Table Structure`Reflector_station_state`
--

CREATE TABLE `Reflector_station_state` (
  `ID` int NOT NULL,
  `Callsign` varchar(50) NOT NULL,
  `Current_start` timestamp NOT NULL,
  `Current_stop` timestamp NOT NULL,
  `action` int NOT NULL,
  `tg` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table Structure`Station_day_statistic`
--

CREATE TABLE `Station_day_statistic` (
  `Id` int NOT NULL,
  `station_id` int NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Active_secunds` int NOT NULL,
  `Max_receiver` text NOT NULL,
  `minsiglev` float NOT NULL,
  `avrige` float NOT NULL,
  `maxsiglev` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Statistcs for receiver day by day';

-- --------------------------------------------------------

--
-- Table Structure`traffic_day_statistics`
--

CREATE TABLE `traffic_day_statistics` (
  `id` int NOT NULL,
  `Node` varchar(50) CHARACTER SET utf8 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TG` varchar(20) NOT NULL,
  `Year` varchar(12) NOT NULL,
  `Month` varchar(12) NOT NULL,
  `Day` varchar(12) NOT NULL,
  `Timestamp` timestamp NOT NULL,
  `00_N` float NOT NULL,
  `00_X2` float NOT NULL,
  `00_T` float NOT NULL,
  `01_N` float NOT NULL,
  `01_X2` float NOT NULL,
  `01_T` float NOT NULL,
  `02_N` float NOT NULL,
  `02_X2` float NOT NULL,
  `02_T` float NOT NULL,
  `03_N` float NOT NULL,
  `03_X2` float NOT NULL,
  `03_T` float NOT NULL,
  `04_N` float NOT NULL,
  `04_X2` float NOT NULL,
  `04_T` float NOT NULL,
  `05_N` float NOT NULL,
  `05_X2` float NOT NULL,
  `05_T` float NOT NULL,
  `06_N` float NOT NULL,
  `06_X2` float NOT NULL,
  `06_T` float NOT NULL,
  `07_N` float NOT NULL,
  `07_X2` float NOT NULL,
  `07_T` float NOT NULL,
  `08_N` float NOT NULL,
  `08_X2` float NOT NULL,
  `08_T` float NOT NULL,
  `09_N` float NOT NULL,
  `09_X2` float NOT NULL,
  `09_T` float NOT NULL,
  `10_N` float NOT NULL,
  `10_X2` float NOT NULL,
  `10_T` float NOT NULL,
  `11_N` float NOT NULL,
  `11_X2` float NOT NULL,
  `11_T` float NOT NULL,
  `12_N` float NOT NULL,
  `12_X2` float NOT NULL,
  `12_T` float NOT NULL,
  `13_N` float NOT NULL,
  `13_X2` float NOT NULL,
  `13_T` float NOT NULL,
  `14_N` float NOT NULL,
  `14_X2` float NOT NULL,
  `14_T` float NOT NULL,
  `15_N` float NOT NULL,
  `15_X2` float NOT NULL,
  `15_T` float NOT NULL,
  `16_N` float NOT NULL,
  `16_X2` float NOT NULL,
  `16_T` float NOT NULL,
  `17_N` float NOT NULL,
  `17_X2` float NOT NULL,
  `17_T` float NOT NULL,
  `18_N` float NOT NULL,
  `18_X2` float NOT NULL,
  `18_T` float NOT NULL,
  `19_N` float NOT NULL,
  `19_X2` float NOT NULL,
  `19_T` float NOT NULL,
  `20_N` float NOT NULL,
  `20_X2` float NOT NULL,
  `20_T` float NOT NULL,
  `21_N` float NOT NULL,
  `21_X2` float NOT NULL,
  `21_T` float NOT NULL,
  `22_N` float NOT NULL,
  `22_X2` float NOT NULL,
  `22_T` float NOT NULL,
  `23_N` float NOT NULL,
  `23_X2` float NOT NULL,
  `23_T` float NOT NULL,
  `Total_N` float NOT NULL,
  `Total_X2` float NOT NULL,
  `Total_T` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table Structure`traffic_month_statistics`
--

CREATE TABLE `traffic_month_statistics` (
  `id` int NOT NULL,
  `Node` varchar(50) NOT NULL,
  `TG` varchar(20) NOT NULL,
  `Year` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TOT_N` float NOT NULL,
  `TOT_X2` float NOT NULL,
  `TOT_T` float NOT NULL,
  `12_N` float NOT NULL,
  `12_X2` float NOT NULL,
  `12_T` float NOT NULL,
  `11_N` float NOT NULL,
  `11_X2` float NOT NULL,
  `11_T` float NOT NULL,
  `10_N` float NOT NULL,
  `10_X2` float NOT NULL,
  `10_T` float NOT NULL,
  `9_N` float NOT NULL,
  `9_X2` float NOT NULL,
  `9_T` float NOT NULL,
  `8_N` float NOT NULL,
  `8_X2` float NOT NULL,
  `8_T` float NOT NULL,
  `7_N` float NOT NULL,
  `7_X2` float NOT NULL,
  `7_T` float NOT NULL,
  `6_N` float NOT NULL,
  `6_X2` float NOT NULL,
  `6_T` float NOT NULL,
  `5_N` float NOT NULL,
  `5_X2` float NOT NULL,
  `5_T` float NOT NULL,
  `4_N` float NOT NULL,
  `4_X2` float NOT NULL,
  `4_T` float NOT NULL,
  `3_N` float NOT NULL,
  `3_X2` float NOT NULL,
  `3_T` float NOT NULL,
  `2_N` float NOT NULL,
  `2_X2` float NOT NULL,
  `2_T` float NOT NULL,
  `1_N` float NOT NULL,
  `1_X2` float NOT NULL,
  `1_T` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_unicode_ci;

--
-- Index f�r dumpade tableer
--

--
-- Index f�r table `Reflector_station_state`
--
ALTER TABLE `Reflector_station_state`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Callsign` (`Callsign`);

--
-- Index f�r table `Station_day_statistic`
--
ALTER TABLE `Station_day_statistic`
  ADD PRIMARY KEY (`Id`);

--
-- Index f�r table `traffic_day_statistics`
--
ALTER TABLE `traffic_day_statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Node` (`Node`),
  ADD KEY `TG` (`TG`),
  ADD KEY `Year` (`Year`),
  ADD KEY `Month` (`Month`),
  ADD KEY `Day` (`Day`);

--
-- Index f�r table `traffic_month_statistics`
--
ALTER TABLE `traffic_month_statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Node` (`Node`),
  ADD KEY `TG` (`TG`),
  ADD KEY `Year` (`Year`);

--
-- AUTO_INCREMENT f�r dumpade tableer
--

--
-- AUTO_INCREMENT f�r table `Reflector_station_state`
--
ALTER TABLE `Reflector_station_state`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT f�r table `Station_day_statistic`
--
ALTER TABLE `Station_day_statistic`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT f�r table `traffic_day_statistics`
--
ALTER TABLE `traffic_day_statistics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT f�r table `traffic_month_statistics`
--
ALTER TABLE `traffic_month_statistics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;




UPDATE `Settings` SET `type` = '3' WHERE `Settings`.`id` = 1; 
UPDATE `Settings` SET `value` = '2.6' WHERE `Settings`.`id` = 1; 

ALTER TABLE `ReflectorStations` DROP INDEX `Callsign_2`;

TRUNCATE `ReflectorStations`;
ALTER TABLE `ReflectorStations` CHANGE `ID` `ID` INT NOT NULL AUTO_INCREMENT; 

ALTER TABLE `ReflectorStations` ADD `Version` VARCHAR(200) NOT NULL AFTER `Last_Seen`; 
ALTER TABLE `ReflectorStations` ADD `Sysop` VARCHAR(200) NOT NULL AFTER `Colour`; 
