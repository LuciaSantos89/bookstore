CREATE TABLE IF NOT EXISTS `bookauthors` (
  `idbook` int(11) NOT NULL,
  `idauthor` int(11) NOT NULL,
  PRIMARY KEY (`idbook`,`idauthor`)
);