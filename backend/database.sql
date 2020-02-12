CREATE DATABASE IF NOT EXISTS `plana`;

CREATE TABLE `apis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `url` text NOT NULL,
  `response_results_accessor` text NOT NULL,
  `response_row_lat_accessor` text NOT NULL,
  `response_row_lng_accessor` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Sample data
INSERT INTO `apis` (`id`, `name`, `title`, `url`, `response_results_accessor`, `response_row_lat_accessor`, `response_row_lng_accessor`) VALUES
(1, 'googlemaps', 'Google Maps', 'https://maps.google.com/maps/api/geocode/json?key=AIzaSyBgGVB2IlnmBFE-5FiURLbH7coBTgXmlgI&address=%s', 'results', 'geometry.location.lat', 'geometry.location.lng'),
(2, 'openstreetmap', 'Open Street Map', 'https://nominatim.openstreetmap.org/search?q=%s&format=json', '', 'lat', 'lon');
