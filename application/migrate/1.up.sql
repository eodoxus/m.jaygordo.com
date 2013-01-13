# Sequel Pro dump
# Version 2492
# http://code.google.com/p/sequel-pro
#
# Host: 127.0.0.1 (MySQL 5.1.56)
# Database: jujubase_crm
# Generation Time: 2011-04-08 07:57:17 -0700
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table api_keys
# ------------------------------------------------------------

DROP TABLE IF EXISTS `api_keys`;

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(64) NOT NULL,
  `applicationId` varchar(64) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table device_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `device_types`;

CREATE TABLE `device_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `platformId` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `dateModified` datetime NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `platformId` (`platformId`),
  CONSTRAINT `device_types_ibfk_1` FOREIGN KEY (`platformId`) REFERENCES `platforms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;



# Dump of table lookups
# ------------------------------------------------------------


DROP TABLE IF EXISTS `lookups`;

CREATE TABLE `lookups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `key` varchar(64) DEFAULT NULL,
  `value` varchar(128) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=901 DEFAULT CHARSET=utf8;

LOCK TABLES `lookups` WRITE;
/*!40000 ALTER TABLE `lookups` DISABLE KEYS */;
INSERT INTO `lookups` (`type`,`key`,`value`,`description`,`dateModified`,`dateCreated`)
VALUES
	('gender_code','M','Male','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('gender_code','F','Female','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('role','admin','Administrator','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('role','super-admin','Super Administrator','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('language_code','en-us','English',NULL,'2011-02-16 18:30:32','2011-02-16 18:30:21'),
	('state_code','AL','Alabama','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','AK','Alaska','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','AS','American Samoa','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','AZ','Arizona','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','AR','Arkansas','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','CA','California','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','CO','Colorado','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','CT','Conneticut','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','DE','Delaware','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','DC','District of Columbia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','FL','Florida','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','GA','Georgia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','GU','Guam','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','HI','Hawaii','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','ID','Idaho','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','IL','Illinois','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','IN','Indiana','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','IA','Iowa','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','KS','Kansas','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','KY','Kentucky','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','LA','Louisiana','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','ME','Maine','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','MD','Maryland','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','MA','Massachusetts','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','MI','Michigan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','MN','Minnesota','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','MS','Mississippi','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','MO','Missouri','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','MT','Montana','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','NE','Nebraska','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','NV','Nevada','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','NH','New Hampshire','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','NJ','New Jersey','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','NM','New Mexico','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','NY','New York','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','NC','North Carolina','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','ND','North Dakota','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','OH','Ohio','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','OK','Oklahoma','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','OR','Oregon','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','PA','Pennsylvania','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','RI','Rhode Island','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','SC','South Carolina','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','SD','South Dakota','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','TN','Tennessee','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','TX','Texas','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','UT','Utah','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','VT','Vermont','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','VA','Virginia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','WA','Washington','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','WV','West Virginia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','WI','Wisconsin','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('state_code','WY','Wyoming','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AF','Afghanistan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AL','Albania','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','DZ','Algeria','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AS','American Samoa','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AD','Andorra','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AO','Angola','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AI','Anguilla','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AQ','Antarctica','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AG','Antigua & Barbuda','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AR','Argentina','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AM','Armenia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AW','Aruba','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AU','Australia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AT','Austria','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AZ','Azerbaijan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BS','Bahamas','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BH','Bahrain','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BD','Bangladesh','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BB','Barbados','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BY','Belarus','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BE','Belgium','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BZ','Belize','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BJ','Benin','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BM','Bermuda','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BT','Bhutan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BO','Bolivia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BA','Bosnia and Herzegovina','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BW','Botswana','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BV','Bouvet Island','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BR','Brazil','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','IO','British Indian Ocean Territory','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','VG','British Virgin Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BN','Brunei Darussalam','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BG','Bulgaria','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BF','Burkina Faso','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','BI','Burundi','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CI',"Cote D'ivoire (Ivory Coast)",'','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','KH','Cambodia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CM','Cameroon','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CA','Canada','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CV','Cape Verde','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','KY','Cayman Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CF','Central African Republic','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TD','Chad','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CL','Chile','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CN','China','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CX','Christmas Island','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CC','Cocos (Keeling) Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CO','Colombia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','KM','Comoros','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CG','Congo','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CK','Cook Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CR','Costa Rica','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','HR','Croatia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CU','Cuba','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CY','Cyprus','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CZ','Czech Republic','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','DK','Denmark','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','DJ','Djibouti','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','DM','Dominica','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','DO','Dominican Republic','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TP','East Timor','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','EC','Ecuador','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','EG','Egypt','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SV','El Salvador','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GQ','Equatorial Guinea','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','ER','Eritrea','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','EE','Estonia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','ET','Ethiopia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','FK','Falkland Islands (Malvinas)','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','FO','Faroe Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','FJ','Fiji','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','FI','Finland','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','FR','France','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','FX','France  Metropolitan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GF','French Guiana','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','PF','French Polynesia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TF','French Southern Territories','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GA','Gabon','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GM','Gambia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GE','Georgia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','DE','Germany','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GH','Ghana','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GI','Gibraltar','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GR','Greece','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GL','Greenland','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GD','Grenada','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GP','Guadeloupe','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GU','Guam','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GT','Guatemala','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GN','Guinea','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GW','Guinea-Bissau','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GY','Guyana','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','HT','Haiti','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','HM','Heard & McDonald Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','HN','Honduras','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','HK','Hong Kong','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','HU','Hungary','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','IS','Iceland','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','IN','India','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','ID','Indonesia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','IQ','Iraq','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','IE','Ireland','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','IR','Islamic Republic of Iran','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','IL','Israel','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','IT','Italy','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','JM','Jamaica','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','JP','Japan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','JO','Jordan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','KZ','Kazakhstan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','KE','Kenya','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','KI','Kiribati','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','KP',"Korea Democratic People's Republic of",'','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','KR','Korea Republic of','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','KW','Kuwait','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','KG','Kyrgyzstan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','LA',"Lao People's Democratic Republic",'','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','LV','Latvia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','LB','Lebanon','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','LS','Lesotho','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','LR','Liberia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','LY','Libyan Arab Jamahiriya','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','LI','Liechtenstein','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','LT','Lithuania','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','LU','Luxembourg','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MO','Macau','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MG','Madagascar','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MW','Malawi','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MY','Malaysia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MV','Maldives','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','ML','Mali','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MT','Malta','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MH','Marshall Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MQ','Martinique','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MR','Mauritania','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MU','Mauritius','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','YT','Mayotte','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MX','Mexico','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','FM','Micronesia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MD','Moldova  Republic of','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MC','Monaco','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MN','Mongolia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MS','Montserrat','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MA','Morocco','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MZ','Mozambique','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MM','Myanmar','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','NA','Namibia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','NR','Nauru','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','NP','Nepal','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','NL','Netherlands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AN','Netherlands Antilles','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','NC','New Caledonia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','NZ','New Zealand','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','NI','Nicaragua','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','NE','Niger','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','NG','Nigeria','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','NU','Niue','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','NF','Norfolk Island','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','MP','Northern Mariana Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','NO','Norway','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','OM','Oman','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','PK','Pakistan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','PW','Palau','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','PA','Panama','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','PG','Papua New Guinea','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','PY','Paraguay','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','PE','Peru','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','PH','Philippines','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','PN','Pitcairn','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','PL','Poland','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','PT','Portugal','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','PR','Puerto Rico','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','QA','Qatar','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','RE','Reunion','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','RO','Romania','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','RU','Russian Federation','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','RW','Rwanda','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','LC','Saint Lucia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','WS','Samoa','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SM','San Marino','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','ST','Sao Tome & Principe','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SA','Saudi Arabia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SN','Senegal','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SC','Seychelles','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SL','Sierra Leone','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SG','Singapore','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SK','Slovakia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SI','Slovenia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SB','Solomon Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SO','Somalia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','ZA','South Africa','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GS','South Georgia and the South Sandwich Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','ES','Spain','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','LK','Sri Lanka','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SH','St. Helena','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','KN','St. Kitts and Nevis','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','PM','St. Pierre &  Miquelon','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','VC','St. Vincent &  the Grenadines','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SD','Sudan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SR','Suriname','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SJ','Svalbard &  Jan Mayen Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SZ','Swaziland','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SE','Sweden','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','CH','Switzerland','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','SY','Syrian Arab Republic','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TW','Taiwan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TJ','Tajikistan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TZ','Tanzania  United Republic of','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TH','Thailand','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TG','Togo','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TK','Tokelau','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TO','Tonga','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TT','Trinidad &  Tobago','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TN','Tunisia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TR','Turkey','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TM','Turkmenistan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TC','Turks & Caicos Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','TV','Tuvalu','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','UG','Uganda','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','UA','Ukraine','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','AE','United Arab Emirates','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','GB','United Kingdom (Great Britain)','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','UM','United States Minor Outlying Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','US','United States of America','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','VI','United States Virgin Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','UY','Uruguay','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','UZ','Uzbekistan','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','VU','Vanuatu','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','VA','Vatican City State (Holy See)','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','VE','Venezuela','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','VN','Viet Nam','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','WF','Wallis & Futuna Islands','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','EH','Western Sahara','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','YE','Yemen','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','YU','Yugoslavia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','ZR','Zaire','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','ZM','Zambia','','0000-00-00 00:00:00','0000-00-00 00:00:00'),
	('country_code','ZW','Zimbabwe','','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `lookups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migration
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`)
VALUES (1);

/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table platforms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `platforms`;

CREATE TABLE `platforms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `dateModified` datetime NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;



# Dump of table subscriptions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subscriptions`;

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titleId` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `dateModified` datetime NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `titleId` (`titleId`),
  CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`titleId`) REFERENCES `titles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table title_skus
# ------------------------------------------------------------

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



# Dump of table titles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `titles`;

CREATE TABLE `titles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `dateModified` datetime NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table user_accounts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_accounts`;

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `remoteId` varchar(128) NOT NULL,
  `secret` varchar(128) DEFAULT NULL,
  `data` text,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_type_id` (`userId`,`type`,`remoteId`),
  CONSTRAINT `user_accounts_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table user_devices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_devices`;

CREATE TABLE `user_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `deviceId` varchar(128) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


# Dump of table user_subscriptions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_subscriptions`;

CREATE TABLE `user_subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `subscriptionId` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_subscription` (`userId`,`subscriptionId`),
  KEY `subscriptionId` (`subscriptionId`),
  CONSTRAINT `user_subscriptions_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_subscriptions_ibfk_2` FOREIGN KEY (`subscriptionId`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table user_titles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_titles`;

CREATE TABLE `user_titles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `titleId` int(11) NOT NULL,
  `titleSKUId` int(11) NOT NULL,
  `userDeviceId` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_title_device` (`userId`,`titleId`,`userDeviceId`),
  KEY `titleSKUId` (`titleSKUId`),
  KEY `titleId` (`titleId`),
  CONSTRAINT `user_titles_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_titles_ibfk_2` FOREIGN KEY (`titleSKUId`) REFERENCES `title_skus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_titles_ibfk_3` FOREIGN KEY (`titleId`) REFERENCES `titles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('anonymous','authenticated','admin','super-admin') NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `firstName` varchar(64) DEFAULT NULL,
  `lastName` varchar(64) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `birthDate` datetime DEFAULT NULL,
  `addressLine1` varchar(64) DEFAULT NULL,
  `addressLine2` varchar(64) DEFAULT NULL,
  `addressLine3` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `stateCode` varchar(64) DEFAULT NULL,
  `regionCode` varchar(15) DEFAULT NULL,
  `countryCode` varchar(64) DEFAULT NULL,
  `postalCode` varchar(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `timeZone` varchar(15) DEFAULT NULL,
  `preferredLanguage` varchar(64) DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `dateModified` datetime NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;






/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
