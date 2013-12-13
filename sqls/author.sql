CREATE TABLE IF NOT EXISTS `author` (
  	`idauthor` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  	`nameauthor` varchar(100) NOT NULL,
  	`nationality` varchar(100) DEFAULT 'UNKNOWN'
);