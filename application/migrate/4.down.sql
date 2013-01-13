DROP TABLE IF EXISTS `user_devices`;
DROP TABLE IF EXISTS `devices`;
CREATE TABLE `user_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `deviceId` varchar(128) NOT NULL,
  `platform` varchar(64) DEFAULT NULL,
  `softwareVersion` varchar(64) DEFAULT NULL,
  `manufacturer` varchar(64) DEFAULT NULL,
  `model_major` varchar(64) DEFAULT NULL,
  `model_minor` varchar(64) DEFAULT NULL,
  `resolution` varchar(64) DEFAULT NULL,
  `graphicsAPI` varchar(64) DEFAULT NULL,
  `graphicsAPIVersion` varchar(64) DEFAULT NULL,
  `details` text,
  `dateModified` datetime NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_deviceId` (`userId`,`deviceId`),
  CONSTRAINT `user_devices_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;