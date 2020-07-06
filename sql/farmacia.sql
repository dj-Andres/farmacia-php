-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-06-2020 a las 14:46:02
-- Versión del servidor: 5.6.13
-- Versión de PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `farmacia`
--
CREATE DATABASE IF NOT EXISTS `farmacia` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `farmacia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE IF NOT EXISTS `laboratorio` (
  `Id_laboratorio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_laboratorio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE IF NOT EXISTS `lote` (
  `Id_lote` int(11) NOT NULL AUTO_INCREMENT,
  `stock` int(11) NOT NULL,
  `vencimiento` date NOT NULL,
  `lote_Id_prod` int(11) NOT NULL,
  `lote_Id_prov` int(11) NOT NULL,
  PRIMARY KEY (`Id_lote`),
  KEY `lote_Id_prod` (`lote_Id_prod`),
  KEY `lote_Id_prov` (`lote_Id_prov`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE IF NOT EXISTS `presentacion` (
  `Id_presentacion` int(11) NOT NULL AUTO_INCREMENT,
  `presentacion` varchar(60) NOT NULL,
  PRIMARY KEY (`Id_presentacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `Id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `concentracion` varchar(255) NOT NULL,
  `adicional` varchar(60) NOT NULL,
  `precio` float NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `prod_lab` int(11) NOT NULL,
  `prod_tip_prod` int(11) NOT NULL,
  `prod_present` int(11) NOT NULL,
  PRIMARY KEY (`Id_producto`),
  KEY `IId_laboratorio` (`prod_lab`),
  KEY `Id_tipo_producto` (`prod_tip_prod`),
  KEY `Id_presentacion` (`prod_present`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `Id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE IF NOT EXISTS `tipo_producto` (
  `Id_tipo_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(60) NOT NULL,
  PRIMARY KEY (`Id_tipo_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_us`
--

CREATE TABLE IF NOT EXISTS `tipo_us` (
  `Id_tipo_us` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(30) NOT NULL,
  PRIMARY KEY (`Id_tipo_us`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipo_us`
--

INSERT INTO `tipo_us` (`Id_tipo_us`, `nombre_tipo`) VALUES
(1, 'admin'),
(2, 'tecnico'),
(3, 'root');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `Id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `edad` date NOT NULL,
  `clave` varchar(50) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `residencia` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `sexo` varchar(30) DEFAULT NULL,
  `adicional` varchar(200) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `us_tipo` int(11) NOT NULL,
  PRIMARY KEY (`Id_usuario`),
  KEY `us_tipo` (`us_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_usuario`, `cedula`, `nombre`, `apellido`, `edad`, `clave`, `telefono`, `residencia`, `correo`, `sexo`, `adicional`, `avatar`, `us_tipo`) VALUES
(1, '0707012605', 'diego', 'jimenez', '1996-10-20', '12345', NULL, NULL, NULL, NULL, NULL, '', 3),
(2, '0707012600', 'mariel', 'lopez', '1995-12-12', '12345', NULL, NULL, NULL, NULL, NULL, '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `Id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `cliente` varchar(50) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `total` float NOT NULL,
  `vendedor` int(11) NOT NULL,
  PRIMARY KEY (`Id_venta`),
  KEY `vendedor` (`vendedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_mensual`
--

CREATE TABLE IF NOT EXISTS `venta_mensual` (
  `mensual` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE IF NOT EXISTS `venta_producto` (
  `Id_venta_producto` int(11) NOT NULL DEFAULT '0',
  `cantidad` int(11) NOT NULL,
  `subtotal` float NOT NULL,
  `producto_Id_producto` int(11) NOT NULL,
  `venta_Id_venta` int(11) NOT NULL,
  PRIMARY KEY (`Id_venta_producto`),
  KEY `producto_Id_producto` (`producto_Id_producto`),
  KEY `venta_Id_venta` (`venta_Id_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `lote_ibfk_1` FOREIGN KEY (`lote_Id_prod`) REFERENCES `productos` (`Id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lote_ibfk_2` FOREIGN KEY (`lote_Id_prov`) REFERENCES `proveedor` (`Id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_Id_laboratorio` FOREIGN KEY (`prod_lab`) REFERENCES `laboratorio` (`Id_laboratorio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Id_presentacion` FOREIGN KEY (`prod_present`) REFERENCES `presentacion` (`Id_presentacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipo_presentacion` FOREIGN KEY (`prod_tip_prod`) REFERENCES `tipo_producto` (`Id_tipo_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_tipo_usuario` FOREIGN KEY (`us_tipo`) REFERENCES `tipo_us` (`Id_tipo_us`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`vendedor`) REFERENCES `usuario` (`Id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD CONSTRAINT `venta_producto_ibfk_1` FOREIGN KEY (`producto_Id_producto`) REFERENCES `productos` (`Id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_producto_ibfk_2` FOREIGN KEY (`venta_Id_venta`) REFERENCES `venta` (`Id_venta`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
