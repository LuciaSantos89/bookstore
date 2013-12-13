CREATE TABLE IF NOT EXISTS `book` (
	`idbook` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  	`isbn` bigint(13) NOT NULL,
  	`namebook` VARCHAR(100) NOT NULL,
  	`year` INT(11) NOT NULL,
  	`ideditorial` INT(11) NOT NULL
);