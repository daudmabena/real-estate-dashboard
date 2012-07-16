-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2012 at 07:29 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `tab_median_1price_2years`
--

CREATE TABLE IF NOT EXISTS `tab_median_1price_2years` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `month_year` date NOT NULL,
  `zip_code` int(10) NOT NULL,
  `sold` int(10) NOT NULL,
  `avg_sp_op` int(10) NOT NULL,
  `avg_dom` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tab_median_1price_2years`
--

INSERT INTO `tab_median_1price_2years` (`id`, `month_year`, `zip_code`, `sold`, `avg_sp_op`, `avg_dom`) VALUES
(1, '2012-05-12', 78253, 27, 93, 157),
(2, '2012-04-12', 78253, 22, 92, 155),
(3, '2012-03-12', 78253, 36, 93, 160),
(4, '2012-02-12', 78253, 26, 96, 142),
(5, '2012-01-12', 78253, 17, 92, 144),
(6, '2011-12-11', 78253, 23, 93, 194),
(7, '2011-11-11', 78253, 18, 91, 98),
(8, '2011-10-11', 78253, 27, 92, 120),
(9, '2011-09-11', 78253, 28, 92, 162),
(10, '2011-08-11', 78253, 44, 90, 152),
(11, '2011-07-11', 78253, 45, 91, 151),
(12, '2011-06-11', 78253, 37, 89, 135),
(13, '2011-05-11', 78253, 33, 91, 162),
(14, '2011-04-11', 78253, 28, 94, 131),
(15, '2011-03-11', 78253, 40, 94, 132),
(16, '2011-02-11', 78253, 27, 93, 110),
(17, '2011-01-11', 78253, 19, 89, 131),
(18, '2010-12-10', 78253, 22, 91, 112),
(19, '2010-11-10', 78253, 31, 89, 154),
(20, '2010-10-10', 78253, 23, 92, 104),
(21, '2010-09-10', 78253, 27, 91, 102),
(22, '2010-08-10', 78253, 31, 92, 122),
(23, '2010-07-10', 78253, 28, 92, 104),
(24, '2010-06-10', 78253, 25, 95, 108);

-- --------------------------------------------------------

--
-- Table structure for table `tab_median_noprice_2years`
--

CREATE TABLE IF NOT EXISTS `tab_median_noprice_2years` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `month_year` date NOT NULL,
  `zip_code` int(10) NOT NULL,
  `sold` int(10) NOT NULL,
  `avg_sp_op` int(10) NOT NULL,
  `avg_dom` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tab_median_noprice_2years`
--

INSERT INTO `tab_median_noprice_2years` (`id`, `month_year`, `zip_code`, `sold`, `avg_sp_op`, `avg_dom`) VALUES
(1, '2012-05-12', 78253, 28, 96, 47),
(2, '2012-04-12', 78253, 14, 97, 56),
(3, '2012-03-12', 78253, 25, 98, 50),
(4, '2012-02-12', 78253, 18, 94, 59),
(5, '2012-01-12', 78253, 8, 95, 76),
(6, '2011-12-11', 78253, 24, 96, 63),
(7, '2011-11-11', 78253, 29, 98, 52),
(8, '2011-10-11', 78253, 16, 94, 49),
(9, '2011-09-11', 78253, 27, 96, 52),
(10, '2011-08-11', 78253, 21, 97, 63),
(11, '2011-07-11', 78253, 24, 96, 62),
(12, '2011-06-11', 78253, 25, 99, 36),
(13, '2011-05-11', 78253, 23, 97, 69),
(14, '2011-04-11', 78253, 14, 95, 45),
(15, '2011-03-11', 78253, 23, 96, 43),
(16, '2011-02-11', 78253, 14, 97, 55),
(17, '2011-01-11', 78253, 8, 96, 21),
(18, '2010-12-10', 78253, 16, 95, 37),
(19, '2010-11-10', 78253, 13, 97, 82),
(20, '2010-10-10', 78253, 10, 97, 49),
(21, '2010-09-10', 78253, 16, 97, 48),
(22, '2010-08-10', 78253, 20, 96, 41),
(23, '2010-07-10', 78253, 14, 96, 28),
(24, '2010-06-10', 78253, 23, 96, 26);

-- --------------------------------------------------------

--
-- Table structure for table `tab_median_price_2years`
--

CREATE TABLE IF NOT EXISTS `tab_median_price_2years` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `zip_code` int(10) NOT NULL,
  `for_sale_median` int(10) NOT NULL,
  `for_sale` int(10) NOT NULL,
  `sold_median` int(10) NOT NULL,
  `sold` int(10) NOT NULL,
  `average_dom` int(10) NOT NULL,
  `month_year` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tab_median_price_2years`
--

INSERT INTO `tab_median_price_2years` (`id`, `zip_code`, `for_sale_median`, `for_sale`, `sold_median`, `sold`, `average_dom`, `month_year`) VALUES
(1, 78253, 217090, 444, 190000, 55, 67, '2012-05-12'),
(2, 78253, 219800, 425, 196250, 36, 68, '2012-04-12'),
(3, 78253, 217204, 400, 199900, 61, 69, '2012-03-12'),
(4, 78253, 218594, 394, 214278, 44, 70, '2012-02-12'),
(5, 78253, 219850, 398, 178845, 25, 71, '2012-01-12'),
(6, 78253, 215820, 377, 215390, 47, 72, '2011-12-11'),
(7, 78253, 217180, 401, 190090, 47, 73, '2011-11-11'),
(8, 78253, 214995, 392, 226500, 43, 74, '2011-10-11'),
(9, 78253, 211887, 406, 180000, 55, 75, '2011-09-11'),
(10, 78253, 209900, 401, 193890, 65, 76, '2011-08-11'),
(11, 78253, 199900, 425, 210695, 69, 77, '2011-07-11'),
(12, 78253, 204900, 451, 182660, 62, 78, '2011-06-11'),
(13, 78253, 199900, 458, 208250, 56, 79, '2011-05-11'),
(14, 78253, 199900, 448, 204745, 42, 80, '2011-04-11'),
(15, 78253, 199950, 448, 181600, 63, 81, '2011-03-11'),
(16, 78253, 199500, 411, 203290, 41, 82, '2011-02-11'),
(17, 78253, 199873, 432, 205500, 27, 83, '2011-01-11'),
(18, 78253, 199900, 419, 210000, 38, 84, '2010-12-10'),
(19, 78253, 205500, 392, 191400, 44, 85, '2010-11-10'),
(20, 78253, 203234, 410, 193800, 33, 86, '2010-10-10'),
(21, 78253, 199900, 399, 198629, 43, 87, '2010-09-10'),
(22, 78253, 199900, 404, 195290, 51, 88, '2010-08-10'),
(23, 78253, 199450, 408, 225970, 42, 89, '2010-07-10'),
(24, 78253, 195469, 402, 185893, 48, 90, '2010-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `tab_media_forsale_sqft`
--

CREATE TABLE IF NOT EXISTS `tab_media_forsale_sqft` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `month_year` date NOT NULL,
  `for_sale` int(10) NOT NULL,
  `for_sale_avg` int(10) NOT NULL,
  `for_sale_avg_sqft` int(10) NOT NULL,
  `for_sale_sqft` int(10) NOT NULL,
  `zip_code` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tab_media_forsale_sqft`
--

INSERT INTO `tab_media_forsale_sqft` (`id`, `month_year`, `for_sale`, `for_sale_avg`, `for_sale_avg_sqft`, `for_sale_sqft`, `zip_code`) VALUES
(1, '2012-05-12', 444, 231514, 2639, 88, 78253),
(2, '2012-04-12', 425, 231906, 2640, 88, 78253),
(3, '2012-03-12', 400, 231385, 2655, 87, 78253),
(4, '2012-02-12', 394, 229381, 2655, 86, 78253),
(5, '2012-01-12', 398, 231267, 2649, 87, 78253),
(6, '2011-12-11', 377, 230870, 2645, 87, 78253),
(7, '2011-11-11', 401, 231106, 2649, 87, 78253),
(8, '2011-10-11', 392, 228701, 2634, 87, 78253),
(9, '2011-09-11', 406, 226615, 2606, 87, 78253),
(10, '2011-08-11', 401, 223582, 2582, 86, 78253),
(11, '2011-07-11', 425, 218751, 2542, 86, 78253),
(12, '2011-06-11', 451, 219737, 2557, 86, 78253),
(13, '2011-05-11', 458, 213878, 2520, 85, 78253),
(14, '2011-04-11', 448, 214955, 2517, 85, 78253),
(15, '2011-03-11', 448, 215913, 2488, 86, 78253),
(16, '2011-02-11', 411, 215411, 2471, 87, 78253),
(17, '2010-01-10', 432, 215160, 2464, 87, 78253),
(18, '2010-12-10', 419, 217567, 2450, 89, 78253),
(19, '2010-11-10', 392, 741806, 2468, 301, 78253),
(20, '2010-10-10', 410, 219938, 2487, 88, 78253),
(21, '2010-09-10', 399, 218934, 2469, 89, 78253),
(22, '2010-08-10', 404, 220327, 2511, 88, 78253),
(23, '2010-07-10', 408, 217695, 2520, 86, 78253),
(24, '2010-06-10', 402, 218347, 2513, 87, 78253);

-- --------------------------------------------------------

--
-- Table structure for table `tab_media_sold_sqft`
--

CREATE TABLE IF NOT EXISTS `tab_media_sold_sqft` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `for_sold` int(10) NOT NULL,
  `for_avg_sold` int(10) NOT NULL,
  `for_sold_avg_sqft` int(10) NOT NULL,
  `for_sold_sqft` int(10) NOT NULL,
  `month_year` int(10) NOT NULL,
  `zip_code` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
