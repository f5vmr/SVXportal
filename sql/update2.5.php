/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `svx`
--

-- --------------------------------------------------------

--
-- Table Structure`ReflectorNodeLOG_History`
--

CREATE TABLE `ReflectorNodeLOG_History` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index f�r dumpade tableer
--

--
-- Index f�r table `ReflectorNodeLOG_History`
--
ALTER TABLE `ReflectorNodeLOG_History`
  ADD PRIMARY KEY (`Id`)

--
-- AUTO_INCREMENT f�r dumpade tableer
--

--
-- AUTO_INCREMENT f�r table `ReflectorNodeLOG_History`
--
ALTER TABLE `ReflectorNodeLOG_History`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


ALTER TABLE `ReflectorNodeLog` ADD INDEX(`Talktime`); 

ALTER TABLE `Information_page` ADD `GrafanaUrl` TEXT NOT NULL AFTER `Image`; 

ALTER TABLE `Information_page` CHANGE `GrafanaUrl` `GrafanaUrl` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 


ALTER TABLE `users` ADD `image_url` VARCHAR(255) NULL DEFAULT NULL AFTER `email`; 

ALTER TABLE `Information_page` ADD `Module` VARCHAR(90) NOT NULL AFTER `station_id`;

ALTER TABLE `ReflectorNodeLog` CHANGE `Id` `Id` INT(11) NOT NULL AUTO_INCREMENT; 


ALTER TABLE `users` ADD `Reset_token` VARCHAR(99) NOT NULL AFTER `image_url`; 



CREATE TABLE `Station_day_statistic` (
  `Id` int NOT NULL,
  `station_id` int NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Active_secunds` int NOT NULL,
  `Max_receiver` text NOT NULL,
  `minsiglev` float NOT NULL,
  `avrige` float NOT NULL,
  `maxsiglev` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Statistcs for receiver day by day';

--
-- Index f�r dumpade tableer
--

--
-- Index f�r table `Station_day_statistic`
--
ALTER TABLE `Station_day_statistic`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT f�r dumpade tableer
--

--
-- AUTO_INCREMENT f�r table `Station_day_statistic`
--
ALTER TABLE `Station_day_statistic`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;


ALTER TABLE `ReflectorStations` CHANGE `ID` `ID` INT NOT NULL AUTO_INCREMENT; 

UPDATE `Settings` SET `value` = '2.5' WHERE `Settings`.`Define` = 'PORTAL_VERSION'; 


