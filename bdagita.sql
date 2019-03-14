-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2019 a las 06:27:46
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdagita`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcategoriaempresa`
--

CREATE TABLE `tcategoriaempresa` (
  `pkidcategoriaemoresa` int(11) NOT NULL,
  `fkidcategoria` int(11) NOT NULL,
  `fkidempresa` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tciudad`
--

CREATE TABLE `tciudad` (
  `pkidciudad` int(11) NOT NULL,
  `fkiddepartamento` int(11) NOT NULL,
  `nombreciudad` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tciudad`
--

INSERT INTO `tciudad` (`pkidciudad`, `fkiddepartamento`, `nombreciudad`) VALUES
(1, 1, 'Pasto'),
(2, 1, 'Ipiales'),
(3, 1, 'Alban'),
(4, 1, 'Aldana'),
(5, 1, 'Ancuya'),
(6, 1, 'Arboleda'),
(7, 1, 'Barbacoas'),
(8, 1, 'Belen'),
(9, 1, 'Buesaco'),
(10, 1, 'Colon'),
(11, 1, 'Consaca'),
(12, 1, 'Contadero'),
(13, 1, 'Cordoba'),
(14, 1, 'Cuaspud'),
(15, 1, 'Cumbal'),
(16, 1, 'Cumbitara'),
(17, 1, 'Chachagsi'),
(18, 1, 'El charco'),
(19, 1, 'El peñol'),
(20, 1, 'El rosario'),
(21, 1, 'El Tablon de Gomez'),
(22, 1, 'El tambo'),
(23, 1, 'Funes'),
(24, 1, 'Guachucal'),
(25, 1, 'Guaitarilla'),
(26, 1, 'Gualmatan'),
(27, 1, 'Iles'),
(28, 1, 'Imues'),
(29, 1, 'La cruz'),
(30, 1, 'La florida'),
(31, 1, 'La llanada'),
(32, 1, 'La tola'),
(33, 1, 'La union'),
(34, 1, 'Leiva'),
(35, 1, 'Linares'),
(36, 1, 'Los andes'),
(37, 1, 'Magsi'),
(38, 1, 'Mallama'),
(39, 1, 'Mosquera'),
(40, 1, 'Nariño'),
(41, 1, 'Olaya herrera'),
(42, 1, 'Ospina'),
(43, 1, 'Francisco pizarro'),
(44, 1, 'Policarpa'),
(45, 1, 'Potosi'),
(46, 1, 'Providencia'),
(47, 1, 'Puerres'),
(48, 1, 'Pupiales'),
(49, 1, 'Ricaurte'),
(50, 1, 'Roberto payan'),
(51, 1, 'Samaniego'),
(52, 1, 'Sandona'),
(53, 1, 'San bernardo'),
(54, 1, 'San lorenzo'),
(55, 1, 'San pablo'),
(56, 1, 'San pedro de cartago'),
(57, 1, 'Santa barbara'),
(58, 1, 'Santacruz'),
(59, 1, 'Sapuyes'),
(60, 1, 'Taminango'),
(61, 1, 'Tangua'),
(62, 1, 'San andres de tumaco'),
(63, 1, 'Tuquerres'),
(64, 1, 'Yacuanquer'),
(66, 2, 'La hormiga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tconfiguracion`
--

CREATE TABLE `tconfiguracion` (
  `clave` varchar(50) NOT NULL,
  `valor` varchar(300) NOT NULL,
  `fechacambio` datetime NOT NULL,
  `valoranterior` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdepartamento`
--

CREATE TABLE `tdepartamento` (
  `pkiddepartamento` int(11) NOT NULL,
  `nombredepartamento` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tdepartamento`
--

INSERT INTO `tdepartamento` (`pkiddepartamento`, `nombredepartamento`) VALUES
(1, 'Nariño'),
(2, 'Putumayo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tempresa`
--

CREATE TABLE `tempresa` (
  `pkidempresa` int(11) NOT NULL,
  `fkiddepartamento` int(11) DEFAULT NULL,
  `fkidciudad` int(11) DEFAULT NULL,
  `usuario` varchar(200) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `nit` varchar(50) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `direccion` varchar(120) DEFAULT NULL,
  `telefonos` varchar(60) DEFAULT NULL,
  `descripcion` varchar(110) DEFAULT NULL,
  `activoempresa` tinyint(1) NOT NULL DEFAULT '1',
  `cuentaconfirmada` tinyint(1) NOT NULL DEFAULT '0',
  `createdat` datetime DEFAULT NULL,
  `cuponespermitidos` int(11) NOT NULL DEFAULT '1',
  `logo` tinyint(1) DEFAULT NULL,
  `tienecupones` tinyint(1) NOT NULL DEFAULT '0',
  `catsalud` tinyint(1) NOT NULL DEFAULT '0',
  `catmascotas` tinyint(1) NOT NULL DEFAULT '0',
  `catropa` tinyint(1) NOT NULL DEFAULT '0',
  `cathogar` tinyint(1) NOT NULL DEFAULT '0',
  `cattecnologia` tinyint(1) NOT NULL DEFAULT '0',
  `catvehiculos` tinyint(1) NOT NULL DEFAULT '0',
  `cattiendas` tinyint(1) NOT NULL DEFAULT '0',
  `catrestaurantes` tinyint(1) NOT NULL DEFAULT '0',
  `shakes` int(11) NOT NULL DEFAULT '0',
  `saldototal` tinyint(1) NOT NULL DEFAULT '0',
  `updatedat` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tempresa`
--

INSERT INTO `tempresa` (`pkidempresa`, `fkiddepartamento`, `fkidciudad`, `usuario`, `clave`, `nit`, `nombre`, `direccion`, `telefonos`, `descripcion`, `activoempresa`, `cuentaconfirmada`, `createdat`, `cuponespermitidos`, `logo`, `tienecupones`, `catsalud`, `catmascotas`, `catropa`, `cathogar`, `cattecnologia`, `catvehiculos`, `cattiendas`, `catrestaurantes`, `shakes`, `saldototal`, `updatedat`) VALUES
(5, NULL, 1, 'correo1@correo.com', 'a4e7c6ae4013276deabc1be4f9c65a6dc382f317e0cb81497aba26915cde5b66', '129', 'La empresa 1', NULL, NULL, NULL, 0, 0, '2019-03-05 08:02:57', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-03-05 00:00:00'),
(3, NULL, 1, 'correo2@correo.com', 'a4e7c6ae4013276deabc1be4f9c65a6dc382f317e0cb81497aba26915cde5b66', '126', 'La empresa 2', NULL, NULL, NULL, 1, 0, '2019-03-04 16:52:00', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(7, NULL, 1, 'correo3@correo.com', 'a4e7c6ae4013276deabc1be4f9c65a6dc382f317e0cb81497aba26915cde5b66', '123456', 'La empresa 3', NULL, NULL, NULL, 1, 0, '2019-03-05 08:45:43', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-03-06 00:00:00'),
(12, 2, 66, 'k@mail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '12312312', NULL, 'asdf', '1111', 'asdfa', 1, 0, '2019-03-11 14:54:09', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(11, NULL, 1, 'prueba1@prueba.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', NULL, 'Mister Pollo', NULL, NULL, NULL, 1, 0, '2019-03-11 11:15:37', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(14, 1, 1, 'aux3@aux.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '123', 'aux', 'cll 11-11', '722000', 'empresa aux', 1, 0, '2019-03-12 03:49:45', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, '2019-03-12 06:19:00'),
(15, NULL, NULL, 'aux1@aux.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, 'aux', NULL, NULL, NULL, 1, 0, '2019-03-12 04:02:35', 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(17, NULL, NULL, 'aux2@aux.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, 'aux', NULL, NULL, NULL, 1, 0, '2019-03-12 04:25:04', 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL),
(18, NULL, NULL, 'aux3@aux.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL, 'aux', NULL, NULL, NULL, 1, 0, '2019-03-12 04:27:25', 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tempresacupon`
--

CREATE TABLE `tempresacupon` (
  `pkidempresacupon` bigint(20) NOT NULL,
  `fkidempresa` int(11) NOT NULL,
  `fkidtipocupon` varchar(1) NOT NULL,
  `imagenpremio` varchar(500) DEFAULT NULL,
  `existencias` int(11) NOT NULL,
  `sobran` int(11) NOT NULL,
  `tiempo` int(11) NOT NULL,
  `premio` varchar(100) NOT NULL,
  `condicioncupon` varchar(100) NOT NULL,
  `activocupon` tinyint(1) NOT NULL,
  `createdat` datetime DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `thistorialjugadas`
--

CREATE TABLE `thistorialjugadas` (
  `pkidhistorial` bigint(20) NOT NULL,
  `fkidusuario` int(11) NOT NULL,
  `fkidempresa` int(11) NOT NULL,
  `premio` varchar(100) NOT NULL,
  `condicion` varchar(100) NOT NULL,
  `createdat` datetime NOT NULL,
  `vence` datetime DEFAULT NULL,
  `tipo` char(1) NOT NULL,
  `fkidcupon` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpublicacion`
--

CREATE TABLE `tpublicacion` (
  `pkidpublicacion` bigint(20) NOT NULL,
  `fkidusuario` int(11) NOT NULL,
  `cobrado` tinyint(1) NOT NULL,
  `cancelado` tinyint(1) NOT NULL,
  `postid` varchar(20) DEFAULT NULL,
  `alazar` tinyint(1) NOT NULL,
  `createdat` datetime DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttipocategoria`
--

CREATE TABLE `ttipocategoria` (
  `pkidtipocategoria` int(11) NOT NULL,
  `Nombretipocategoria` varchar(100) NOT NULL,
  `Activotipocategoria` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttipocupon`
--

CREATE TABLE `ttipocupon` (
  `pkidTipocupon` int(11) NOT NULL,
  `NombreTipocupon` varchar(100) NOT NULL,
  `IconoTipocupon` varchar(255) DEFAULT NULL,
  `ActivoTipocupon` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttransaccion`
--

CREATE TABLE `ttransaccion` (
  `pkidtransaccion` bigint(20) NOT NULL,
  `fkidempresa` int(11) DEFAULT NULL,
  `fkidusuario` int(11) DEFAULT NULL,
  `createdat` datetime NOT NULL,
  `fecharta` datetime DEFAULT NULL,
  `transaccionid` varchar(50) DEFAULT NULL,
  `referencia1` varchar(50) DEFAULT NULL,
  `referencia2` varchar(50) DEFAULT NULL,
  `detalle` varchar(100) DEFAULT NULL,
  `franquicia` varchar(20) DEFAULT NULL,
  `valor` varchar(10) DEFAULT NULL,
  `respuesta` varchar(15) DEFAULT NULL,
  `codrespuesta` varchar(10) DEFAULT NULL,
  `codaprobacion` varchar(20) DEFAULT NULL,
  `tipodoc` varchar(4) DEFAULT NULL,
  `doc` varchar(20) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `razonrespuesta` varchar(500) DEFAULT NULL,
  `fechatransac` varchar(20) DEFAULT NULL,
  `codigoerror` varchar(10) DEFAULT NULL,
  `extra1` varchar(10) DEFAULT NULL,
  `extra2` varchar(10) DEFAULT NULL,
  `origen` varchar(200) DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ttransaccion`
--

INSERT INTO `ttransaccion` (`pkidtransaccion`, `fkidempresa`, `fkidusuario`, `createdat`, `fecharta`, `transaccionid`, `referencia1`, `referencia2`, `detalle`, `franquicia`, `valor`, `respuesta`, `codrespuesta`, `codaprobacion`, `tipodoc`, `doc`, `nombre`, `apellido`, `telefono`, `direccion`, `razonrespuesta`, `fechatransac`, `codigoerror`, `extra1`, `extra2`, `origen`, `updatedat`) VALUES
(1, NULL, 2, '2019-03-06 15:41:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, 2, '2019-03-06 15:42:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttransaccionerror`
--

CREATE TABLE `ttransaccionerror` (
  `pkiderror` bigint(20) NOT NULL,
  `idtransaccion` bigint(20) DEFAULT NULL,
  `error` varchar(500) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ttransaccionerror`
--

INSERT INTO `ttransaccionerror` (`pkiderror`, `idtransaccion`, `error`, `createdat`) VALUES
(1, 2, 'prueba error', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuario`
--

CREATE TABLE `tusuario` (
  `pkidusuario` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `activousuario` tinyint(1) NOT NULL,
  `vidas` int(11) DEFAULT NULL,
  `ultimapublicacion` timestamp NULL DEFAULT NULL,
  `edad` int(11) NOT NULL,
  `updatedat` datetime DEFAULT NULL,
  `imei` varchar(50) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tusuario`
--

INSERT INTO `tusuario` (`pkidusuario`, `nombre`, `telefono`, `activousuario`, `vidas`, `ultimapublicacion`, `edad`, `updatedat`, `imei`, `createdat`) VALUES
(2, 'daniel jojoa', '3157119750', 0, 1, '2019-03-05 02:24:13', 21, NULL, NULL, NULL),
(3, 'daniel jojoa', '3157119751', 0, 1, NULL, 21, NULL, NULL, NULL),
(4, 'prueba 1', '3207459659', 0, 1, NULL, 32, NULL, NULL, NULL),
(7, 'prueba 1', '32074596545454', 0, 1, NULL, 32, NULL, NULL, NULL),
(8, 'daniel jojoa', '3157119752', 0, 1, NULL, 21, NULL, NULL, NULL),
(9, 'Carlos', '3151231234', 1, 1, NULL, 20, NULL, '1234', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuarioempresa`
--

CREATE TABLE `tusuarioempresa` (
  `fkidusuario` int(11) NOT NULL,
  `fkidempresa` int(11) NOT NULL,
  `control` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tcategoriaempresa`
--
ALTER TABLE `tcategoriaempresa`
  ADD PRIMARY KEY (`pkidcategoriaemoresa`),
  ADD KEY `fkidempresa` (`fkidempresa`),
  ADD KEY `fkidcategoria` (`fkidcategoria`);

--
-- Indices de la tabla `tciudad`
--
ALTER TABLE `tciudad`
  ADD PRIMARY KEY (`pkidciudad`),
  ADD KEY `fkiddepartamento` (`fkiddepartamento`);

--
-- Indices de la tabla `tconfiguracion`
--
ALTER TABLE `tconfiguracion`
  ADD PRIMARY KEY (`clave`);

--
-- Indices de la tabla `tdepartamento`
--
ALTER TABLE `tdepartamento`
  ADD PRIMARY KEY (`pkiddepartamento`);

--
-- Indices de la tabla `tempresa`
--
ALTER TABLE `tempresa`
  ADD PRIMARY KEY (`pkidempresa`),
  ADD KEY `fkiddepartamento` (`fkiddepartamento`),
  ADD KEY `fkidciudad` (`fkidciudad`);

--
-- Indices de la tabla `tempresacupon`
--
ALTER TABLE `tempresacupon`
  ADD PRIMARY KEY (`pkidempresacupon`),
  ADD KEY `fkidempresa` (`fkidempresa`),
  ADD KEY `fkidtipocupon` (`fkidtipocupon`);

--
-- Indices de la tabla `thistorialjugadas`
--
ALTER TABLE `thistorialjugadas`
  ADD PRIMARY KEY (`pkidhistorial`),
  ADD KEY `fkidempresa` (`fkidempresa`),
  ADD KEY `fkiduduario` (`fkidusuario`);

--
-- Indices de la tabla `tpublicacion`
--
ALTER TABLE `tpublicacion`
  ADD PRIMARY KEY (`pkidpublicacion`),
  ADD KEY `fkidusuario` (`fkidusuario`);

--
-- Indices de la tabla `ttipocategoria`
--
ALTER TABLE `ttipocategoria`
  ADD PRIMARY KEY (`pkidtipocategoria`);

--
-- Indices de la tabla `ttipocupon`
--
ALTER TABLE `ttipocupon`
  ADD PRIMARY KEY (`pkidTipocupon`);

--
-- Indices de la tabla `ttransaccion`
--
ALTER TABLE `ttransaccion`
  ADD PRIMARY KEY (`pkidtransaccion`),
  ADD KEY `fkidempresa` (`fkidempresa`),
  ADD KEY `fkidusuario` (`fkidusuario`);

--
-- Indices de la tabla `ttransaccionerror`
--
ALTER TABLE `ttransaccionerror`
  ADD PRIMARY KEY (`pkiderror`);

--
-- Indices de la tabla `tusuario`
--
ALTER TABLE `tusuario`
  ADD PRIMARY KEY (`pkidusuario`);

--
-- Indices de la tabla `tusuarioempresa`
--
ALTER TABLE `tusuarioempresa`
  ADD PRIMARY KEY (`fkidusuario`,`fkidempresa`),
  ADD KEY `fkidusuario` (`fkidusuario`),
  ADD KEY `fkidempresa` (`fkidempresa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tcategoriaempresa`
--
ALTER TABLE `tcategoriaempresa`
  MODIFY `pkidcategoriaemoresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tciudad`
--
ALTER TABLE `tciudad`
  MODIFY `pkidciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `tdepartamento`
--
ALTER TABLE `tdepartamento`
  MODIFY `pkiddepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tempresa`
--
ALTER TABLE `tempresa`
  MODIFY `pkidempresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tempresacupon`
--
ALTER TABLE `tempresacupon`
  MODIFY `pkidempresacupon` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `thistorialjugadas`
--
ALTER TABLE `thistorialjugadas`
  MODIFY `pkidhistorial` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tpublicacion`
--
ALTER TABLE `tpublicacion`
  MODIFY `pkidpublicacion` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ttipocategoria`
--
ALTER TABLE `ttipocategoria`
  MODIFY `pkidtipocategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ttipocupon`
--
ALTER TABLE `ttipocupon`
  MODIFY `pkidTipocupon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ttransaccion`
--
ALTER TABLE `ttransaccion`
  MODIFY `pkidtransaccion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ttransaccionerror`
--
ALTER TABLE `ttransaccionerror`
  MODIFY `pkiderror` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tusuario`
--
ALTER TABLE `tusuario`
  MODIFY `pkidusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
