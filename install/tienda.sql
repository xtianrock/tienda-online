-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2015 a las 03:13:45
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
`id_cat` int(11) NOT NULL,
  `nombre_cat` varchar(45) DEFAULT NULL,
  `descripcion_cat` text,
  `anuncio_cat` text,
  `visible` tinyint(1) DEFAULT NULL,
  `cod_cat` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_cat`, `nombre_cat`, `descripcion_cat`, `anuncio_cat`, `visible`, `cod_cat`) VALUES
(1, 'categoria 1', 'desc', NULL, 1, 'cat1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destacado`
--

CREATE TABLE IF NOT EXISTS `destacado` (
  `productos_id_producto` int(11) NOT NULL,
  `productos_categoria_id_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `destacado`
--

INSERT INTO `destacado` (`productos_id_producto`, `productos_categoria_id_cat`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_pedido`
--

CREATE TABLE IF NOT EXISTS `linea_pedido` (
  `productos_id_producto` int(11) NOT NULL,
  `productos_categoria_id_cat` int(11) NOT NULL,
  `pedido_id_pedido` int(11) NOT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `precio` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
`id_pedido` int(11) NOT NULL,
  `estado` enum('Procesado','Pendiente','Recibido','Devuelto') DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha_pedido` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `usuario_id_usuario` int(11) NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `apellidos` varchar(80) DEFAULT NULL,
  `dni` char(9) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
`id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(45) DEFAULT NULL,
  `precio_producto` decimal(6,2) DEFAULT NULL,
  `descuento` decimal(5,2) DEFAULT NULL,
  `imagen_producto` varchar(256) DEFAULT NULL,
  `iva_producto` decimal(5,2) DEFAULT NULL,
  `descripcion` text,
  `anuncio` text,
  `stock` int(11) DEFAULT NULL,
  `categoria_id_cat` int(11) NOT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `cod_producto` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `precio_producto`, `descuento`, `imagen_producto`, `iva_producto`, `descripcion`, `anuncio`, `stock`, `categoria_id_cat`, `visible`, `cod_producto`) VALUES
(1, 'producto1', '42.00', NULL, 'Byron', NULL, 'desc', NULL, 10, 1, 1, 'pro1'),
(2, 'producto2', '74.00', NULL, NULL, NULL, 'desc', NULL, 41, 1, 1, 'pro2'),
(3, 'producto3', '85.00', NULL, NULL, NULL, 'desc', NULL, 41, 1, 1, 'pro3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `id_provincia` int(11) NOT NULL,
  `nombre_provincia` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(80) NOT NULL,
  `contrasenia` char(40) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `apellidos` varchar(80) DEFAULT NULL,
  `dni` char(9) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL,
  `provincias_id_provincia` int(11) NOT NULL,
  `rol` enum('Administrador','Usuario') DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`id_cat`), ADD UNIQUE KEY `cod_cat_UNIQUE` (`cod_cat`);

--
-- Indices de la tabla `destacado`
--
ALTER TABLE `destacado`
 ADD PRIMARY KEY (`productos_id_producto`,`productos_categoria_id_cat`), ADD KEY `fk_destacado_productos1_idx` (`productos_id_producto`,`productos_categoria_id_cat`);

--
-- Indices de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
 ADD PRIMARY KEY (`productos_id_producto`,`productos_categoria_id_cat`,`pedido_id_pedido`), ADD KEY `fk_productos_has_pedido_pedido1_idx` (`pedido_id_pedido`), ADD KEY `fk_productos_has_pedido_productos1_idx` (`productos_id_producto`,`productos_categoria_id_cat`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
 ADD PRIMARY KEY (`id_pedido`,`usuario_id_usuario`), ADD KEY `fk_pedido_usuario1_idx` (`usuario_id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
 ADD PRIMARY KEY (`id_producto`,`categoria_id_cat`), ADD UNIQUE KEY `cod_producto_UNIQUE` (`cod_producto`), ADD KEY `fk_productos_categoria_idx` (`categoria_id_cat`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
 ADD PRIMARY KEY (`id_provincia`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `nombre_usuario_UNIQUE` (`nombre_usuario`), ADD KEY `fk_usuario_provincias1_idx` (`provincias_id_provincia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `destacado`
--
ALTER TABLE `destacado`
ADD CONSTRAINT `fk_destacado_productos1` FOREIGN KEY (`productos_id_producto`, `productos_categoria_id_cat`) REFERENCES `productos` (`id_producto`, `categoria_id_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
ADD CONSTRAINT `fk_productos_has_pedido_pedido1` FOREIGN KEY (`pedido_id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_productos_has_pedido_productos1` FOREIGN KEY (`productos_id_producto`, `productos_categoria_id_cat`) REFERENCES `productos` (`id_producto`, `categoria_id_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
ADD CONSTRAINT `fk_pedido_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
ADD CONSTRAINT `fk_productos_categoria` FOREIGN KEY (`categoria_id_cat`) REFERENCES `categoria` (`id_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `fk_usuario_provincias1` FOREIGN KEY (`provincias_id_provincia`) REFERENCES `provincias` (`id_provincia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
