-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-03-2013 a las 11:31:39
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `codespain`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Asistir`
--

CREATE TABLE IF NOT EXISTS `Asistir` (
  `Usuarios_idUsuarios` int(11) NOT NULL,
  `Eventos_idEventos` int(11) NOT NULL,
  PRIMARY KEY (`Usuarios_idUsuarios`,`Eventos_idEventos`),
  KEY `fk_Usuarios_has_Eventos_Eventos1_idx` (`Eventos_idEventos`),
  KEY `fk_Usuarios_has_Eventos_Usuarios1_idx` (`Usuarios_idUsuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Eventos`
--

CREATE TABLE IF NOT EXISTS `Eventos` (
  `idEventos` int(10) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(250) NOT NULL,
  `Lugar` varchar(50) NOT NULL,
  `FechaIni` date NOT NULL,
  `FechaFin` date NOT NULL,
  `CoordX` double NOT NULL,
  `CoordY` double NOT NULL,
  `Imagen` varchar(100) NOT NULL,
  PRIMARY KEY (`idEventos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `Eventos`
--

INSERT INTO `Eventos` (`idEventos`, `Nombre`, `Descripcion`, `Lugar`, `FechaIni`, `FechaFin`, `CoordX`, `CoordY`, `Imagen`) VALUES
(1, 'CodeSpain', 'Web de eventos de desarrollo', 'Universidad de Alicante', '2013-03-06', '0000-00-00', 38.387024, -0.511551000000054, 'images/Eventos/codespain.jpg'),
(4, 'Nuevo evento', 'kvadmaklmvklamvdlkam', 'Madrid', '2013-03-16', '0000-00-00', 40.416632788688474, -3.695526123046875, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Eventos_has_Tag`
--

CREATE TABLE IF NOT EXISTS `Eventos_has_Tag` (
  `Eventos_idEventos` int(11) NOT NULL,
  `Tag_Etiqueta` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Eventos_idEventos`,`Tag_Etiqueta`),
  KEY `fk_Eventos_has_Tag_Tag1_idx` (`Tag_Etiqueta`),
  KEY `fk_Eventos_has_Tag_Eventos1_idx` (`Eventos_idEventos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Oficiales`
--

CREATE TABLE IF NOT EXISTS `Oficiales` (
  `Eventos_idEventos` int(11) NOT NULL,
  PRIMARY KEY (`Eventos_idEventos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Preferencias`
--

CREATE TABLE IF NOT EXISTS `Preferencias` (
  `idPreferencias` int(11) NOT NULL,
  `Zona` varchar(45) DEFAULT NULL,
  `Usuarios_idUsuarios` int(11) NOT NULL,
  PRIMARY KEY (`idPreferencias`,`Usuarios_idUsuarios`),
  KEY `fk_Preferencias_Usuarios1_idx` (`Usuarios_idUsuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reportar`
--

CREATE TABLE IF NOT EXISTS `Reportar` (
  `Usuarios_idUsuarios` int(11) NOT NULL,
  `Eventos_idEventos` int(11) NOT NULL,
  PRIMARY KEY (`Usuarios_idUsuarios`,`Eventos_idEventos`),
  KEY `fk_Usuarios_has_Eventos1_Eventos1_idx` (`Eventos_idEventos`),
  KEY `fk_Usuarios_has_Eventos1_Usuarios1_idx` (`Usuarios_idUsuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tag`
--

CREATE TABLE IF NOT EXISTS `Tag` (
  `Etiqueta` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Etiqueta',
  PRIMARY KEY (`Etiqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE IF NOT EXISTS `Usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Token` varchar(250) DEFAULT NULL,
  `Preferencias_idPreferencias` int(11) DEFAULT NULL,
  `Eventos_idEventos` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuarios`),
  UNIQUE KEY `Nombre_UNIQUE` (`Nombre`),
  KEY `fk_Usuarios_Preferencias1_idx` (`Preferencias_idPreferencias`),
  KEY `fk_Usuarios_Eventos1_idx` (`Eventos_idEventos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`idUsuarios`, `Nombre`, `Token`, `Preferencias_idPreferencias`, `Eventos_idEventos`) VALUES
(1, 'Adrian Escolano', 'ya29.AHES6ZSOQSDRHj_Ho0RR0xpW2VBsNNiDgZXELUCBZ5hb497bbAX-8g', NULL, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Asistir`
--
ALTER TABLE `Asistir`
  ADD CONSTRAINT `fk_Usuarios_has_Eventos_Eventos1` FOREIGN KEY (`Eventos_idEventos`) REFERENCES `Eventos` (`idEventos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuarios_has_Eventos_Usuarios1` FOREIGN KEY (`Usuarios_idUsuarios`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Eventos_has_Tag`
--
ALTER TABLE `Eventos_has_Tag`
  ADD CONSTRAINT `fk_Eventos_has_Tag_Eventos1` FOREIGN KEY (`Eventos_idEventos`) REFERENCES `Eventos` (`idEventos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Eventos_has_Tag_Tag1` FOREIGN KEY (`Tag_Etiqueta`) REFERENCES `Tag` (`Etiqueta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Oficiales`
--
ALTER TABLE `Oficiales`
  ADD CONSTRAINT `fk_Oficiales_Eventos1` FOREIGN KEY (`Eventos_idEventos`) REFERENCES `Eventos` (`idEventos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Preferencias`
--
ALTER TABLE `Preferencias`
  ADD CONSTRAINT `fk_Preferencias_Usuarios1` FOREIGN KEY (`Usuarios_idUsuarios`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Reportar`
--
ALTER TABLE `Reportar`
  ADD CONSTRAINT `fk_Usuarios_has_Eventos1_Eventos1` FOREIGN KEY (`Eventos_idEventos`) REFERENCES `Eventos` (`idEventos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuarios_has_Eventos1_Usuarios1` FOREIGN KEY (`Usuarios_idUsuarios`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
