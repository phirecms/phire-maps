--
-- Maps Module MySQL Database for Phire CMS 2.0
--

-- --------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

--
-- Table structure for table `maps`
--

CREATE TABLE IF NOT EXISTS `[{prefix}]maps` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `locations` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15001 ;

-- --------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 1;