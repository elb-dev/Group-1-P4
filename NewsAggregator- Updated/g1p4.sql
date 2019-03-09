SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `g1p4_categories`;
CREATE TABLE `g1p4_categories` (
  `CategoryID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(100) DEFAULT NULL,
  `CategoryDescription` text,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `g1p4_categories` (`CategoryID`, `CategoryName`, `CategoryDescription`) VALUES
(1,	'Engineer',	'Topics one progressive thinking and science'),
(2,	'Entertainment',	'Movies, Music, TV, Art, Celebrities, and more'),
(3,	'Sports',	'Lastest news on scores, stats, standings and rumors');

DROP TABLE IF EXISTS `g1p4_feed`;
CREATE TABLE `g1p4_feed` (
  `FeedID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FeedName` varchar(25) DEFAULT NULL,
  `FeedURL` text,
  `FeedDescription` text,
  `CategoryID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`FeedID`),
  KEY `CategoryID` (`CategoryID`),
  CONSTRAINT `g1p4_feed_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `g1p4_categories` (`CategoryID`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `g1p4_feed` (`FeedID`, `FeedName`, `FeedURL`, `FeedDescription`, `CategoryID`) VALUES
(1,	'Civil Engineering',	'https://www.realwire.com/rss/?id=621&row=&view=Synopsis',	'Housing, Roadwork, and Services',	1),
(2,	'Nanotechnology',	'https://www.realwire.com/rss/?id=683&row=&view=Synopsis',	'Really really reeeaaalllyyy tiny technology',	1),
(3,	'Microwaves/Radiowaves',	'https://www.realwire.com/rss/?id=576&row=&view=Synopsis',	'The deepest mystery is in the invisible',	1),
(4,	'Music',	'https://www.realwire.com/rss/?id=509&row=&view=Synopsis',	'Lastest in Realwire Music',	2),
(5,	'DVD/Music',	'https://www.realwire.com/rss/?id=649&row=&view=Synopsis',	'DVD/Film Lastest Feeds',	2),
(6,	'Art',	'https://www.realwire.com/rss/?id=628&row=&view=Synopsis',	'Most recent entertainment-art articles',	2),
(7,	'MLB',	'https://api.foxsports.com/v1/rss?partnerKey=zBaFxRyGKCfxBagJG9b8pqLyndmvo7UU&tag=mlb',	'Major League Baseball',	3),
(8,	'NFL',	'https://api.foxsports.com/v1/rss?partnerKey=zBaFxRyGKCfxBagJG9b8pqLyndmvo7UU&tag=nfl',	'National Football League',	3),
(9,	'NBA',	'https://api.foxsports.com/v1/rss?partnerKey=zBaFxRyGKCfxBagJG9b8pqLyndmvo7UU&tag=nba',	'National Basketball Association',	3);
