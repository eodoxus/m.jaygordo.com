CREATE TABLE `platforms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `dateModified` datetime NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `device_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `platformId` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `dateModified` datetime NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `platformId` (`platformId`),
  CONSTRAINT `device_types_ibfk_1` FOREIGN KEY (`platformId`) REFERENCES `platforms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `user_devices`;
CREATE TABLE `user_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `deviceId` varchar(128) DEFAULT NULL,
  `deviceTypeId` int(11) NOT NULL,
  `version` varchar(16) DEFAULT NULL,
  `dateModified` datetime NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_deviceId` (`userId`,`deviceId`),
  KEY `deviceTypeId` (`deviceTypeId`),
  KEY `user_deviceType` (`userId`,`deviceTypeId`),
  CONSTRAINT `user_devices_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_devices_ibfk_2` FOREIGN KEY (`deviceTypeId`) REFERENCES `device_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `title_skus`;
CREATE TABLE `title_skus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titleId` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `platformId` int(11) NOT NULL,
  `dateModified` datetime NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_platform` (`titleId`,`platformId`),
  KEY `platformId` (`platformId`),
  KEY `titleId` (`titleId`),
  KEY `name` (`name`),
  CONSTRAINT `title_skus_ibfk_2` FOREIGN KEY (`platformId`) REFERENCES `platforms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `title_skus_ibfk_3` FOREIGN KEY (`titleId`) REFERENCES `titles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;