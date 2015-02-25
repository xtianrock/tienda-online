-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-02-2015 a las 02:45:10
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_cat`, `nombre_cat`, `descripcion_cat`, `anuncio_cat`, `visible`, `cod_cat`) VALUES
(0, 'Todos', NULL, NULL, 1, 'todos'),
(1, 'Playsets', 'Consigue las tus 4 copias de las cartas mas jugadas!', NULL, 1, 'playset'),
(2, 'Sobres', 'Sobres sueltos de las ultimas ampliaciones.', NULL, 1, 'sobre'),
(3, 'Tapetes', 'Nada mas agradable que jugar sobre un buen tapete. Consigue el tuyo con tu ilustración favorita.', NULL, 1, 'tapete'),
(4, 'Fundas', 'Protege tus cartas con nuestra amplia variedad de fundas.', NULL, 1, 'funda'),
(5, 'Archivadores', 'La mejor manera de organizar y transportar nuestrar cartas.', NULL, 1, 'archivador'),
(6, 'Deckboxes', 'Indispensable para transportar tus barajas!', NULL, 1, 'deckbox');

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
  `precio` decimal(6,2) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `linea_pedido`
--

INSERT INTO `linea_pedido` (`productos_id_producto`, `productos_categoria_id_cat`, `pedido_id_pedido`, `cantidad`, `precio`, `subtotal`) VALUES
(3, 1, 87, '1', '245.00', '245.00'),
(19, 4, 88, '1', '3.40', '3.40'),
(20, 4, 88, '1', '5.20', '5.20'),
(31, 6, 86, '1', '2.50', '2.50'),
(32, 6, 86, '7', '1.50', '10.50'),
(32, 6, 89, '1', '1.50', '1.50'),
(33, 6, 89, '1', '10.00', '10.00'),
(35, 6, 86, '9', '2.50', '22.50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
`id_pedido` int(11) NOT NULL,
  `estado` enum('Procesado','Pendiente','Recibido','Devuelto') DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `importe` decimal(10,2) NOT NULL,
  `fecha_pedido` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `usuario_id_usuario` int(11) NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `apellidos` varchar(80) DEFAULT NULL,
  `mail` varchar(50) NOT NULL,
  `dni` char(9) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `estado`, `cantidad`, `importe`, `fecha_pedido`, `fecha_entrega`, `usuario_id_usuario`, `nombre`, `apellidos`, `mail`, `dni`, `direccion`, `cp`) VALUES
(86, 'Pendiente', 17, '35.50', '2015-02-23', NULL, 44, 'cristian', 'Vizcaino', 'xtianrock89@gmail.com', '49109707s', 'gorrion nº 38', '01110'),
(87, 'Pendiente', 1, '245.00', '2015-02-23', NULL, 44, 'cristian', 'Vizcaino', 'xtianrock89@gmail.com', '49109707s', 'gorrion nº 38', '01110'),
(88, 'Pendiente', 2, '8.60', '2015-02-24', NULL, 44, 'cristian', 'Vizcaino', 'xtianrock89@gmail.com', '49109707s', 'gorrion nº 38', '01110'),
(89, 'Pendiente', 2, '11.50', '2015-02-24', NULL, 44, 'cristian', 'Vizcaino', 'xtianrock89@gmail.com', '49109707s', 'gorrion nº 38', '01110');

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `precio_producto`, `descuento`, `imagen_producto`, `iva_producto`, `descripcion`, `anuncio`, `stock`, `categoria_id_cat`, `visible`, `cod_producto`) VALUES
(1, 'Tarmogoyf x4', '500.00', NULL, 'tarmogoyf.png', NULL, 'Playset de Tarmogoyf NM', NULL, 0, 1, 1, 'tarmogoyf'),
(2, 'Liliana del velo x4', '220.00', NULL, 'liliana_del_velo.png', NULL, 'Playset de Liliana del velo NM', NULL, 1, 1, 1, 'liliana'),
(3, 'Fuerza de voluntad x4', '245.00', NULL, 'fuerza_de_voluntad.png', NULL, 'Playset de fuerza de voluntad Ex+', NULL, 6, 1, 1, 'Fow'),
(4, 'Laguna ardiente x4', '160.00', NULL, 'laguna_ardiente.png', NULL, 'Playset de Laguna ardiente NM', NULL, 24, 1, 1, 'laguna'),
(5, 'Relampago promocional x4', '75.00', NULL, 'relampago_promo.png', NULL, 'Playset de relampago promocional NM', NULL, 0, 1, 1, 'relampago'),
(6, 'Camino al exilio x4', '30.00', NULL, 'camino_al_exilio.png', NULL, 'Playset de camino al exilio NM', NULL, 39, 1, 1, 'camino'),
(7, 'Geist de san traft x4', '65.00', NULL, 'geist_de_san_traft.png', NULL, 'Playset de Geist de san traft NM', NULL, 23, 1, 1, 'geist'),
(10, 'Sobre de Destino reescrito', '3.50', NULL, 'sobre_destino_reescrito.png', NULL, 'Sobre de Destino reescrito en español, cada sobre contiene 12 cartas comunes, 3 cartas infrecuentes y una carta rara o mitica.', NULL, 85, 2, 1, 'fate_booster'),
(11, 'Sobre de khans de Tarkir', '3.50', NULL, 'sobre_khans_de_tarkir.png', NULL, 'Sobre de khans de Tarkir en español, cada sobre contiene 12 cartas comunes, 3 cartas infrecuentes y una carta rara o mitica.', NULL, 120, 2, 1, 'khans_booster'),
(12, 'Sobre de magic 2015', '3.00', NULL, 'sobre_m15.png', NULL, 'Sobre de magic 2015 en español, cada sobre contiene 12 cartas comunes, 3 cartas infrecuentes y una carta rara o mitica.', NULL, 74, 2, 1, 'm15_booster'),
(13, 'Sobre Theros', '2.50', NULL, 'sobre_theros.png', NULL, 'Sobre de Theros en español, cada sobre contiene 12 cartas comunes, 3 cartas infrecuentes y una carta rara o mitica.', NULL, 56, 2, 1, 'booster_theros'),
(14, 'Sobre de Regreso a Ravnica', '2.50', NULL, 'sobre_regreso_a_ravnica.png', NULL, 'Sobre de Regreso a Ravnica en español, cada sobre contiene 12 cartas comunes, 3 cartas infrecuentes y una carta rara o mitica.', NULL, 23, 2, 1, 'booster_ravnica'),
(15, 'Dragon Shield Blue', '6.85', NULL, 'tapete_dragon_shield_blue.png', NULL, 'Tapete Dragon Shield Arcane Dragons: Blue Playmat', NULL, 13, 3, 1, 'playmat_dsblue'),
(16, 'Ultra Pro: Tapete Artist Gallery Negro', '8.00', NULL, 'tapete_artist_gallery.png', NULL, 'Tapete Ultra Pro: Tapete Artist Gallery (Negro)', NULL, 12, 3, 1, 'playmat_artist'),
(17, 'Tapete Magiccardmarket "Wooden Board"', '9.50', NULL, 'tapete_mkm_wooded.png', NULL, 'Tapete Magiccardmarket "Wooden Board"', NULL, 74, 3, 1, 'playmat_wood'),
(18, 'Dragon Shield - Red Zone Playmat', '8.00', NULL, 'tapete_redzone.png', NULL, 'Tapete Dragon Shield modelo Red Zone Playmat', NULL, 41, 3, 1, 'playmat_redzone'),
(19, '100 KMC Perfect Sized Sleeves', '3.40', NULL, 'perfect_size.jpg', NULL, 'Dobla la proteccion de tus cartas con estas fundas ajustadas que puedes usar con tus fundas normales.', NULL, 49, 4, 1, 'kmc_perfect'),
(20, 'KMC Full Sized Sleeves - Matte Black', '5.20', NULL, 'kmc_mat_black.png', NULL, 'Máxima protección y calidad para tus cartas con las nuevas KMC Full Sized Sleeves - Matte Black', NULL, 36, 4, 1, 'kmc_mat_black'),
(21, '100 Dragon Shield Sleeves - Red', '6.50', NULL, 'dragon_shield_red.png', NULL, 'Protege tus cartas con las nuevas fundas dragon shield.', NULL, 80, 4, 1, 'sleeves_ds_red'),
(22, '80 Fundas MTG Cardback', '8.00', NULL, 'fundas_mtg_back.png', NULL, 'Fantasticas fundas con la imagen del reverso de una carta, lo mas parecido a jugar sin fundas pero con toda la protección.', NULL, 20, 4, 1, 'sleeves_mtg'),
(23, 'Ultra-Pro: 25 Toploaders Estándar', '2.50', NULL, 'toploaders.png', NULL, 'Maxima proteccion para trasnportar y realizar envios de cartas', NULL, 63, 4, 1, 'toploaders'),
(24, '50 Fundas Ultra Pro Doge', '3.00', NULL, 'ultra_pro_doge.png', NULL, 'Protege tu baraja con estas divertidas fundas con la calidad de Ultra pro', NULL, 14, 4, 1, 'ultra_pro_doge'),
(25, '100 Dragon Shield Sleeves - Pink', '6.50', NULL, 'dragon_shield_pink.png', NULL, 'Porque ellas también juegan!', NULL, 19, 4, 1, 'sleeves_ds_pink'),
(26, 'Carpeta FOUR Playset', '24.00', NULL, 'carpeta_playset.png', NULL, 'Guarda tus cartas organizandolas por playsets, capacidad para 480 cartas.', NULL, 12, 5, 1, 'playset_binder'),
(27, 'Ultra Pro Collectors Portfolio - 4-Pocket Nav', '2.50', NULL, 'carpeta_ultrapro_4.png', NULL, 'Lo mejor para llevar nuestro cambio sin ocupar demasiado espacio. Capacidad 80 cartas.', NULL, 31, 5, 1, 'carpeta_up_4'),
(28, 'Ultra Pro Collectors Portfolio - 9-Pocket Nav', '5.00', NULL, 'carpeta_ultrapro_9.png', NULL, 'Lleva tus cartas siempre contigo con los archivadores de 9 bolsillos UltraPro.\r\nCapacidad 180 cartas.', NULL, 25, 5, 1, 'carpeta_up_9'),
(29, 'Ultra-Pro: "Pro-Binder" Azul', '15.00', NULL, 'pro_binder_blue.png', NULL, 'Máxima protección y calidad. incluye goma elástica para cerrar.', NULL, 10, 5, 1, 'pro_binder_blue'),
(30, 'Album "Black Lotus"', '13.00', NULL, 'carpeta_black_lotus.png', NULL, 'Álbum con ilustración de unas las cartas mas míticas. Capacidad 80 cartas.', NULL, 5, 5, 1, 'binder_lotus'),
(31, 'Ultra-Pro: Pro-Deck Box Negro', '2.50', NULL, 'deck_box_100+.png', NULL, 'Caja para guardar el mazo con capacidad para mas de 100 cartas.', NULL, 39, 6, 1, 'deckbox_100'),
(32, 'Ultra-Pro Solid Red Deckbox', '1.50', NULL, 'deck_box_red_solid.png', NULL, 'Caja para guardar el mazo con capacidad para 75 cartas', NULL, 62, 6, 1, 'deckbox_red'),
(33, 'Ultra-Pro: Mana Flip Box', '10.00', NULL, 'mana_flip_black.png', NULL, 'Caja para mazos de cuero sintetico y gran capacidad.', NULL, 3, 6, 1, 'flip_box_black'),
(34, 'Ultra-Pro: Matte Dual Flip Box Blanco', '18.00', NULL, 'dual_flip_box_white.png', NULL, 'Fantastica caja de cuero sintetico para dos barajas.', NULL, 4, 6, 1, 'dual_flip_box'),
(35, 'Mana Symbol Deckbox', '2.50', NULL, 'mana_symbol_blue.png', NULL, 'Caja para mazo de 75 cartas ilustrada con símbolo de maná.', NULL, 6, 6, 1, 'island_deckbox');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `id_provincia` int(11) NOT NULL,
  `nombre_provincia` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id_provincia`, `nombre_provincia`) VALUES
(1, 'Alava'),
(2, 'Albacete'),
(3, 'Alicante'),
(4, 'Almera'),
(5, 'Avila'),
(6, 'Badajoz'),
(7, 'Balears (Illes)'),
(8, 'Barcelona'),
(9, 'Burgos'),
(10, 'Cáceres'),
(11, 'Cádiz'),
(12, 'Castellón'),
(13, 'Ciudad Real'),
(14, 'Córdoba'),
(15, 'Coruña (A)'),
(16, 'Cuenca'),
(17, 'Girona'),
(18, 'Granada'),
(19, 'Guadalajara'),
(20, 'Guipzcoa'),
(21, 'Huelva'),
(22, 'Huesca'),
(23, 'Jaén'),
(24, 'León'),
(25, 'Lleida'),
(26, 'Rioja (La)'),
(27, 'Lugo'),
(28, 'Madrid'),
(29, 'Málaga'),
(30, 'Murcia'),
(31, 'Navarra'),
(32, 'Ourense'),
(33, 'Asturias'),
(34, 'Palencia'),
(35, 'Palmas (Las)'),
(36, 'Pontevedra'),
(37, 'Salamanca'),
(38, 'Santa Cruz de Tenerife'),
(39, 'Cantabria'),
(40, 'Segovia'),
(41, 'Sevilla'),
(42, 'Soria'),
(43, 'Tarragona'),
(44, 'Teruel'),
(45, 'Toledo'),
(46, 'Valencia'),
(47, 'Valladolid'),
(48, 'Vizcaya'),
(49, 'Zamora'),
(50, 'Zaragoza'),
(51, 'Ceuta'),
(52, 'Melilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reset_password`
--

CREATE TABLE IF NOT EXISTS `reset_password` (
`id` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `token` varchar(64) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reset_password`
--

INSERT INTO `reset_password` (`id`, `id_usuario`, `usuario`, `token`, `fecha`) VALUES
(10, 44, 'xtianrock89', '937ecf7c33eea81b3a3911d2d61c63ac85358f4d', '2015-02-24 23:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`id_usuario` int(11) NOT NULL,
  `usuario` varchar(80) NOT NULL,
  `password` char(255) DEFAULT NULL,
  `mail` varchar(128) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `apellidos` varchar(80) DEFAULT NULL,
  `dni` char(9) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL,
  `provincias_id_provincia` int(11) NOT NULL,
  `rol` enum('Administrador','Usuario') DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `password`, `mail`, `nombre`, `apellidos`, `dni`, `direccion`, `cp`, `provincias_id_provincia`, `rol`, `activo`) VALUES
(44, 'xtianrock89', '$2y$10$yYm9yQBY.gns1eYK215nU.bKy6RI5GrqTUVLl/xXZNJoluV2dAfo6', 'xtianrock89@gmail.com', 'cristian', 'Vizcaino', '49109707s', 'gorrion nº 38', '01110', 1, 'Usuario', 1);

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
-- Indices de la tabla `reset_password`
--
ALTER TABLE `reset_password`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `idusuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `nombre_usuario_UNIQUE` (`usuario`), ADD UNIQUE KEY `mail` (`mail`), ADD KEY `fk_usuario_provincias1_idx` (`provincias_id_provincia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `reset_password`
--
ALTER TABLE `reset_password`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
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

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `eliminaLinks` ON SCHEDULE EVERY 12 HOUR STARTS '2015-02-25 02:39:59' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM reset_password WHERE fecha <= DATE_SUB(CURTIME(), INTERVAL 1 DAY)$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
