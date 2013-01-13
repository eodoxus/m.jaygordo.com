ALTER TABLE `user_devices`
	DROP FOREIGN KEY `user_devices_ibfk_2`,
	DROP KEY `user_deviceType`,
	DROP `deviceTypeId`,
	DROP `version`,
	ADD `platform` varchar(64) DEFAULT NULL AFTER `deviceId`,
	ADD `softwareVersion` varchar(64) DEFAULT NULL AFTER `platform`,
	ADD `manufacturer` varchar(64) DEFAULT NULL AFTER `softwareVersion`,
	ADD `model_major` varchar(64) DEFAULT NULL AFTER `manufacturer`,
	ADD `model_minor` varchar(64) DEFAULT NULL AFTER `model_major`,
	ADD `resolution` varchar(64) DEFAULT NULL AFTER `model_minor`,
	ADD `graphicsAPI` varchar(64) DEFAULT NULL AFTER `resolution`,
	ADD `graphicsAPIVersion` varchar(64) DEFAULT NULL AFTER `graphicsAPI`,
	ADD `details` text AFTER `graphicsAPIVersion`;
	
ALTER TABLE `title_skus`
	CHANGE COLUMN `platformId` `platform` varchar(64),
	DROP KEY `title_platform`,
	DROP KEY `platformId`,
	DROP FOREIGN KEY `title_skus_ibfk_2`;

ALTER TABLE `user_titles`
	DROP FOREIGN KEY `user_titles_ibfk_2`;
	
DROP TABLE `device_types`;

DROP TABLE `platforms`;