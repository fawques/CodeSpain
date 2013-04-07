-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-04-2013 a las 13:07:55
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
  `Lugar` varchar(250) NOT NULL,
  `FechaIni` date NOT NULL,
  `FechaFin` date NOT NULL,
  `CoordX` double NOT NULL,
  `CoordY` double NOT NULL,
  `Imagen` varchar(100) NOT NULL,
  `Web` varchar(150) DEFAULT NULL,
  `idUsuarioCrear` int(11) NOT NULL,
  PRIMARY KEY (`idEventos`),
  KEY `fk_Eventos_Usuarios_Crear_idx` (`idUsuarioCrear`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `Eventos`
--

INSERT INTO `Eventos` (`idEventos`, `Nombre`, `Descripcion`, `Lugar`, `FechaIni`, `FechaFin`, `CoordX`, `CoordY`, `Imagen`, `Web`, `idUsuarioCrear`) VALUES
(5, 'ascasc', 'ascsac', 'A-31,Alicante,A', '2013-04-25', '2013-04-27', 38.3355298863129, -0.5071520805358887, 'images/Eventos/13c4c9ead14f0a9adcd838d96bacef4b-codespainLogo-300x238.jpg', 'sacasc', 2),
(6, 'dfvsdv', 'dsvsdvsdv', '55O,Ctra. Oca', '2013-04-06', '2013-04-17', 38.33903069630875, -0.5348110198974609, 'images/Eventos/fa02a5e4c4027ecb41fdb121b14d7894-codespainLogo-300x238.jpg', 'sdvsdvsdv', 2),
(7, 'CodeSpain', 'La web de los desarrolladores', '83,Calle Alicante,San Vicente del Raspeig', '2013-04-14', '2013-04-21', 38.38683011196378, -0.511314868927002, 'images/Eventos/09adea13fd318e745ae5b262c7e8e688-codespainLogo-300x238.jpg', 'www.codespain.es', 2);

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

--
-- Volcado de datos para la tabla `Eventos_has_Tag`
--

INSERT INTO `Eventos_has_Tag` (`Eventos_idEventos`, `Tag_Etiqueta`) VALUES
(5, 'php'),
(6, 'php'),
(7, 'php');

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

--
-- Volcado de datos para la tabla `Tag`
--

INSERT INTO `Tag` (`Etiqueta`) VALUES
('php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE IF NOT EXISTS `Usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Token` varchar(250) DEFAULT NULL,
  `Preferencias_idPreferencias` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuarios`),
  UNIQUE KEY `Nombre_UNIQUE` (`Nombre`),
  KEY `fk_Usuarios_Preferencias1_idx` (`Preferencias_idPreferencias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`idUsuarios`, `Nombre`, `Token`, `Preferencias_idPreferencias`) VALUES
(2, 'bl4ckf4lk0n@gmail.com', '100000709893463', NULL);

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
-- Filtros para la tabla `Eventos`
--
ALTER TABLE `Eventos`
  ADD CONSTRAINT `fk_Eventos_Usuarios_Crear` FOREIGN KEY (`idUsuarioCrear`) REFERENCES `Usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
