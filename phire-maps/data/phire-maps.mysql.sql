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
  `latitude` varchar(255),
  `longitude` varchar(255),
  `pin_icon` varchar(255),
  `styles` text,
  `zoom` int(16),
  `map_type` varchar(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15001 ;

-- --------------------------------------------------------

--
-- Table structure for table `map_locations`
--

CREATE TABLE IF NOT EXISTS `[{prefix}]map_locations` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `map_id` int(16),
  `title` varchar(255) NOT NULL,
  `uri` varchar(255),
  `info` text,
  `latitude` varchar(255),
  `longitude` varchar(255),
  `new_window` int(1),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_map_location` FOREIGN KEY (`map_id`) REFERENCES `[{prefix}]maps` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16001 ;

-- --------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 1;