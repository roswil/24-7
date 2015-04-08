-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2015 a las 20:36:44
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `angularcode`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animales`
--

CREATE TABLE IF NOT EXISTS `animales` (
  `ANIMAL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ANIMAL_NOMBRE` varchar(50) NOT NULL,
  `ANIMAL_RAZA` varchar(50) NOT NULL,
  `ANIMAL_COLOR` varchar(50) NOT NULL,
  `ANIMAL_REGISTRO` date NOT NULL,
  `ANIMAL_MODIFICACION` datetime NOT NULL,
  `ANIMAL_USUARIO` varchar(20) NOT NULL,
  `ANIMAL_ESTADO` varchar(20) NOT NULL DEFAULT 'ACTIVO',
  PRIMARY KEY (`ANIMAL_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `animales`
--

INSERT INTO `animales` (`ANIMAL_ID`, `ANIMAL_NOMBRE`, `ANIMAL_RAZA`, `ANIMAL_COLOR`, `ANIMAL_REGISTRO`, `ANIMAL_MODIFICACION`, `ANIMAL_USUARIO`, `ANIMAL_ESTADO`) VALUES
(1, 'TERRY', 'CHAPI', 'GRIS', '2015-04-06', '2015-04-06 00:00:00', 'liliana.ramos', 'ACTIVO'),
(2, '', '', '', '2015-04-07', '2015-04-07 00:00:00', 'admin', 'ACTIVO'),
(3, 'peque', 'gordita', 'Chapi', '2015-04-07', '2015-04-07 00:00:00', 'admin', 'ACTIVO'),
(4, 'oddi', 'bonito', 'Pastor Aleman', '2015-04-07', '2015-04-07 00:00:00', 'admin', 'ACTIVO'),
(5, 'juan', 'negro', 'Chihuahua', '2015-04-07', '2015-04-07 00:00:00', 'admin', 'ACTIVO'),
(6, '', '', '', '2015-04-07', '2015-04-07 00:00:00', 'admin', 'ACTIVO'),
(7, '', '', '', '2015-04-07', '2015-04-07 00:00:00', 'admin', 'ACTIVO'),
(8, 'perla', 'Chapi', 'negro', '2015-04-07', '2015-04-07 00:00:00', 'admin', 'ACTIVO'),
(9, '', '', '', '2015-04-07', '2015-04-07 00:00:00', 'admin', 'ACTIVO');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
