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




ALTER TABLE `ReflectorNodeLog` ADD INDEX(`Talktime`); 

ALTER TABLE `Information_page` ADD `GrafanaUrl` TEXT NOT NULL AFTER `Image`; 

ALTER TABLE `Information_page` CHANGE `GrafanaUrl` `GrafanaUrl` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 


ALTER TABLE `users` ADD `image_url` VARCHAR(255) NULL DEFAULT NULL AFTER `email`; 

ALTER TABLE `Information_page` ADD `Module` VARCHAR(90) NOT NULL AFTER `station_id`;

ALTER TABLE `ReflectorNodeLog` CHANGE `Id` `Id` INT(11) NOT NULL AUTO_INCREMENT; 


ALTER TABLE `users` ADD `Reset_token` VARCHAR(99) NOT NULL AFTER `image_url`; 

UPDATE `Settings` SET `value` = '2.5' WHERE `Settings`.`Define` = 'PORTAL_VERSION'; 


ALTER TABLE `users` CHANGE `Reset_token` `Reset_token` VARCHAR(99) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL; 

ALTER TABLE `ReflectorStations` CHANGE `ID` `ID` INT NOT NULL AUTO_INCREMENT; 
