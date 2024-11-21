SET autocommit = 0;
start transaction;

INSERT INTO `Settings` (`id`, `Define`, `value`, `Name`, `type`) VALUES (NULL, 'REFLECTOR_SERVER_ADDRESS', '127.0.0.1', 'Server address to svxreflector', '2'); 
INSERT INTO `Settings` (`id`, `Define`, `value`, `Name`, `type`) VALUES (NULL, 'REFLECTOR_SERVER_PORT', '5300', 'SvxReflector server port ', '2'); 
ALTER TABLE `RefletorStations` ADD `Monitor` INT NOT NULL DEFAULT '1' AFTER `Station_Down_timmer_count`; 


    

CREATE TABLE `dtmf_command` (
  `id` int(11) NOT NULL,
  `station_name` varchar(90) NOT NULL,
  `Command` varchar(20) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index för tabell `dtmf_command`
--
ALTER TABLE `dtmf_command`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `dtmf_command`
--
ALTER TABLE `dtmf_command`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;




--
-- Tabellstruktur `Information_page`
--

CREATE TABLE `Information_page` (
  `id` int(11) NOT NULL,
  `station_name` varchar(20) NOT NULL,
  `Html` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `Information_page`
--
ALTER TABLE `Information_page`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT för tabell `Information_page`
--
ALTER TABLE `Information_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;



ALTER TABLE `Information_page` ADD `Image` VARCHAR(90) NOT NULL AFTER `Html`; 

ALTER TABLE `Information_page` ADD `Hardware_page` TEXT NOT NULL AFTER `Html`; 

INSERT INTO `Settings` (`id`, `Define`, `value`, `Name`, `type`) VALUES (NULL, 'API_KEY_TINY_CLOUD', 'no-api', 'TinyMCE Cloud API KEY', '2'); 


ALTER TABLE `dtmf_command` ADD `station_id` INT NOT NULL AFTER `station_name`; 

ALTER TABLE `Information_page` ADD `station_id` INT NOT NULL AFTER `station_name`; 

ALTER TABLE `dtmf_command` ADD `Category` INT NOT NULL AFTER `Description`; 



--
-- Tabellstruktur `Operation_log`
--

CREATE TABLE `Operation_log` (
  `id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `Operation_log`
--
ALTER TABLE `Operation_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `Operation_log`
--
ALTER TABLE `Operation_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



ALTER TABLE `Operation_log` ADD `Type` INT NOT NULL AFTER `station_id`; 

INSERT INTO `Settings` (`id`, `Define`, `value`, `Name`, `type`) VALUES (NULL, 'HIDE_MONITOR_BAR', '0', ' Hide the Monitor bar', '1'); 

INSERT INTO `Settings` (`id`, `Define`, `value`, `Name`, `type`) VALUES (NULL, 'USE_NODE_ADMIN_NOTIFICATION', '0', '\"Beta\" Node admin notfication', '1'); 

UPDATE `Settings` SET `value` = '2.4' WHERE `Settings`.`Define` = 'PORTAL_VERSION'; 


CREATE TABLE `User_Permission` (
  `id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `RW` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



--
-- Index för tabell `User_Permission`
--
ALTER TABLE `User_Permission`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `User_Permission`
--
ALTER TABLE `User_Permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;



ALTER TABLE `users` ADD `email` TEXT NOT NULL AFTER `lastname`; 

ALTER TABLE `Information_page` ADD `Module` VARCHAR(90) NOT NULL AFTER `station_id`;

ALTER TABLE `ReflectorNodeLog` CHANGE `Id` `Id` INT(11) NOT NULL AUTO_INCREMENT; 



COMMIT;



