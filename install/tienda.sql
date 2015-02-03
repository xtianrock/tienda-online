-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-02-2015 a las 02:34:43
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_cat`, `nombre_cat`, `descripcion_cat`, `anuncio_cat`, `visible`, `cod_cat`) VALUES
(1, 'Playsets', 'Consigue las tus 4 copias de las cartas mas jugadas!', NULL, 1, 'playset'),
(2, 'Sobres', 'Sobres sueltos de las ultimas ampliaciones.', NULL, 1, 'sobre'),
(3, 'Tapetes', 'Nada mas agradable que jugar sobre un buen tapete. Consigue el tuyo con tu ilustración favorita.', NULL, 1, 'tapete'),
(4, 'Fundas', 'Protege tus cartas con nuestra amplia variedad de fundas.', NULL, 1, 'funda'),
(5, 'Archivadores', 'La mejor manera de organizar y transportar nuestrar cartas.', NULL, 1, 'archivador'),
(6, 'Deck boxes', 'Indispensable para transportar tus barajas!', NULL, 1, 'deckbox');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `precio_producto`, `descuento`, `imagen_producto`, `iva_producto`, `descripcion`, `anuncio`, `stock`, `categoria_id_cat`, `visible`, `cod_producto`) VALUES
(1, 'Tarmogoyf x4', '500.00', NULL, 'tarmogoyf.jpg', NULL, 'Playset de Tarmogoyf NM', NULL, 6, 1, 1, 'tarmogoyf'),
(2, 'Liliana del velo x4', '220.00', NULL, 'liliana_del_velo.jpg', NULL, 'Playset de Liliana del velo NM', NULL, 13, 1, 1, 'liliana'),
(3, 'Fuerza de voluntad x4', '245.00', NULL, 'fuerza_de_voluntad.jpg', NULL, 'Playset de fuerza de voluntad Ex+', NULL, 10, 1, 1, 'Fow'),
(4, 'Laguna ardiente x4', '160.00', NULL, 'laguna_ardiente.jpg', NULL, 'Playset de Laguna ardiente NM', NULL, 25, 1, 1, 'laguna'),
(5, 'Relampago (player rewards promo) x4', '75.00', NULL, 'relampago_promo.jpg', NULL, 'Playset de relampago promocional NM', NULL, 8, 1, 1, 'relampago'),
(6, 'Camino al exilio x4', '30.00', NULL, 'camino_al_exilio.jpg', NULL, 'Playset de camino al exilio NM', NULL, 41, 1, 1, 'camino'),
(7, 'Geist de san traft x4', '65.00', NULL, 'geist_de_san_traft.jpg', NULL, 'Playset de Geist de san traft NM', NULL, 23, 1, 1, 'geist'),
(10, 'Sobre de Destino reescrito', '3.50', NULL, 'sobre_destino_reescrito.jpg', NULL, 'Sobre de Destino reescrito en español, cada sobre contiene 12 cartas comunes, 3 cartas infrecuentes y una carta rara o mitica.', NULL, 85, 2, 1, 'fate_booster'),
(11, 'Sobre de khans de Tarkir', '3.50', NULL, 'sobre_khans_de_tarkir.jpg', NULL, 'Sobre de khans de Tarkir en español, cada sobre contiene 12 cartas comunes, 3 cartas infrecuentes y una carta rara o mitica.', NULL, 120, 2, 1, 'khans_booster'),
(12, 'Sobre de magic 2015', '3.00', NULL, 'sobre_m15.jpg', NULL, 'Sobre de magic 2015 en español, cada sobre contiene 12 cartas comunes, 3 cartas infrecuentes y una carta rara o mitica.', NULL, 74, 2, 1, 'm15_booster'),
(13, 'Sobre Theros', '2.50', NULL, 'sobre_theros.jpg', NULL, 'Sobre de Theros en español, cada sobre contiene 12 cartas comunes, 3 cartas infrecuentes y una carta rara o mitica.', NULL, 56, 2, 1, 'booster_theros'),
(14, 'Sobre de Regreso a Ravnica', '2.50', NULL, 'sobre_regreso_a_ravnica.jpg', NULL, 'Sobre de Regreso a Ravnica en español, cada sobre contiene 12 cartas comunes, 3 cartas infrecuentes y una carta rara o mitica.', NULL, 23, 2, 1, 'booster_ravnica'),
(15, 'Dragon Shield Blue', '6.85', NULL, 'tapete_dragon_shield_blue.jpg', NULL, 'Tapete Dragon Shield Arcane Dragons: Blue Playmat', NULL, 15, 3, 1, 'playmat_dsblue'),
(16, 'Ultra Pro: Tapete Artist Gallery (Negro)', '8.00', NULL, 'tapete_artist_gallery.jpg', NULL, 'Tapete Ultra Pro: Tapete Artist Gallery (Negro)', NULL, 12, 3, 1, 'playmat_artist'),
(17, 'Tapete Magiccardmarket "Wooden Board"', '9.50', NULL, 'tapete_mkm_wooded.jpg', NULL, 'Tapete Magiccardmarket "Wooden Board"', NULL, 74, 3, 1, 'playmat_wood'),
(18, 'Dragon Shield - Red Zone Playmat', '8.00', NULL, 'tapete_redzone.jpg', NULL, 'Tapete Dragon Shield modelo Red Zone Playmat', NULL, 41, 3, 1, 'playmat_redzone');

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
MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
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
