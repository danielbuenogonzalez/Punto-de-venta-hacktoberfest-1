phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-11-2022 a las 00:52:05
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `punto_venta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bajas_inventario`
--

CREATE TABLE `bajas_inventario` (
  `rowid` int(11) NOT NULL,
  `codigo_producto` text NOT NULL,
  `nombre_producto` text NOT NULL,
  `numero_piezas` decimal(11,2) NOT NULL,
  `razon_baja` text NOT NULL,
  `usuario` tinytext NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `rowid` int(11) NOT NULL,
  `caja_chica` decimal(11,2) UNSIGNED NOT NULL,
  `ventas` decimal(11,2) NOT NULL,
  `gastos` decimal(11,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `no_venta` text NOT NULL,
  `id_usuario` tinytext NOT NULL,
  `nombre_usuario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`rowid`, `caja_chica`, `ventas`, `gastos`, `fecha`, `no_venta`, `id_usuario`, `nombre_usuario`) VALUES
(1, '0.00', '600.00', '0.00', '2022-11-17 15:29:43', '1', '6', 'tolk'),
(2, '0.00', '0.00', '400.00', '2022-11-17 15:30:23', 'null', '6', 'tolk'),
(3, '0.00', '1200.00', '0.00', '2022-11-17 15:32:11', '2', '2', 'javier'),
(4, '600.00', '0.00', '0.00', '2022-11-17 16:13:07', 'null', '1', 'admin'),
(5, '0.00', '600.00', '0.00', '2022-11-22 09:55:40', '3', '2', 'javier'),
(6, '0.00', '1200.00', '0.00', '2022-11-22 10:36:13', '4', '6', 'tolk'),
(7, '500.00', '0.00', '0.00', '2022-11-22 22:04:45', 'null', '6', 'tolk'),
(8, '0.00', '0.00', '600.00', '2022-11-22 22:05:14', 'null', '6', 'tolk');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_empresa`
--

CREATE TABLE `datos_empresa` (
  `rowid` int(11) NOT NULL,
  `nombre` tinytext NOT NULL,
  `telefono` tinytext NOT NULL,
  `rfc` text,
  `direccion` text,
  `colonia` text,
  `codigo_postal` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencias`
--

CREATE TABLE `dependencias` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dependencias`
--

INSERT INTO `dependencias` (`id`, `nombre`) VALUES
(1, 'deo 1'),
(2, 'dep 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `rowid` int(11) NOT NULL,
  `importe` decimal(11,2) UNSIGNED NOT NULL,
  `concepto` text NOT NULL,
  `descripcion` text NOT NULL,
  `numero_remision` text,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`rowid`, `importe`, `concepto`, `descripcion`, `numero_remision`, `fecha`, `id_usuario`, `nombre_usuario`) VALUES
(1, '400.00', 'retiro', 'es una prueba ', '013', '2022-11-17 15:30:23', 6, 'tolk'),
(2, '600.00', 'retiro', 'es una prueba ', '014', '2022-11-22 22:05:14', 6, 'tolk');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `rowid` int(11) NOT NULL,
  `codigo` text NOT NULL,
  `nombre` text NOT NULL,
  `precio_compra` decimal(11,2) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `utilidad` decimal(11,2) NOT NULL,
  `existencia` decimal(11,2) NOT NULL,
  `stock` decimal(11,2) NOT NULL,
  `familia` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`rowid`, `codigo`, `nombre`, `precio_compra`, `precio_venta`, `utilidad`, `existencia`, `stock`, `familia`) VALUES
(1, '01', 'TOLK1', '100.00', '300.00', '200.00', '16.00', '30.00', 'proveedor'),
(2, '02', 'TOLK2', '200.00', '400.00', '200.00', '26.00', '30.00', 'Familia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `rowid` int(11) NOT NULL,
  `nombre` tinytext NOT NULL,
  `palabra_secreta` tinytext NOT NULL,
  `administrador` bit(1) NOT NULL,
  `dependencia` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`rowid`, `nombre`, `palabra_secreta`, `administrador`, `dependencia`) VALUES
(1, 'admin', '$2y$10$DRJMxK7rSJP7e4AGWsGrFeoGJswt2D5adNJ2IMMT3WGMEXaoWUphW', b'1', ''),
(2, 'javier', '$2y$10$IMBdSaRDiqT.E2DpUNPQ2usy1AU4i8hnxfvralxnfuPmCunqQ2BLm', b'0', '1'),
(6, 'tolk', '$2y$10$2uUxdNlAcgf048385L1VbeZsjOHK4impxxLU6FlQgieG4Ht2bJPqe', b'0', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `numero_venta` int(11) NOT NULL,
  `codigo_producto` text NOT NULL,
  `nombre_producto` text NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `numero_productos` decimal(11,2) NOT NULL,
  `usuario` tinytext NOT NULL,
  `Id_usuario` int(11) NOT NULL,
  `familia` tinytext NOT NULL,
  `utilidad` decimal(8,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`numero_venta`, `codigo_producto`, `nombre_producto`, `total`, `fecha`, `numero_productos`, `usuario`, `Id_usuario`, `familia`, `utilidad`) VALUES
(1, '01', 'TOLK1', '600.00', '2022-11-17 15:29:43', '2.00', 'tolk', 6, 'proveedor', '400.00'),
(2, '01', 'TOLK1', '1200.00', '2022-11-17 15:32:11', '4.00', 'javier', 2, 'proveedor', '800.00'),
(3, '01', 'TOLK1', '600.00', '2022-11-22 09:55:40', '2.00', 'javier', 2, 'proveedor', '400.00'),
(4, '02', 'TOLK2', '1200.00', '2022-11-22 10:36:13', '3.00', 'tolk', 6, 'Familia', '600.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bajas_inventario`
--
ALTER TABLE `bajas_inventario`
  ADD PRIMARY KEY (`rowid`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`rowid`);

--
-- Indices de la tabla `datos_empresa`
--
ALTER TABLE `datos_empresa`
  ADD PRIMARY KEY (`rowid`);

--
-- Indices de la tabla `dependencias`
--
ALTER TABLE `dependencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`rowid`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`rowid`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`rowid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bajas_inventario`
--
ALTER TABLE `bajas_inventario`
  MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `datos_empresa`
--
ALTER TABLE `datos_empresa`
  MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dependencias`
--
ALTER TABLE `dependencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;