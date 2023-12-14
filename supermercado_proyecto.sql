-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2023 a las 05:36:00
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE   supermercado_proyecto;
use supermercado_proyecto;
--
-- Base de datos: `supermercado_proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `adm_id` int(11) NOT NULL,
  `adm_nombre` varchar(250) NOT NULL,
  `adm_cargo` varchar(200) NOT NULL,
  `adm_usuario` varchar(200) NOT NULL,
  `adm_contraseña` varchar(200) NOT NULL,
  `tie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`adm_id`, `adm_nombre`, `adm_cargo`, `adm_usuario`, `adm_contraseña`, `tie_id`) VALUES
(11232, 'laura garcia', 'administrador', 'laura123', '12345', 1),
(23835650, 'Dacia Camargo', 'administrador', 'Dacia0439', '3094utrijfkdls', 1),
(28173323, 'Miguel Mantilla', 'administrador', 'miguelMan', '93wr98udfj', 1),
(123456790, 'Julian Gomez', 'administrador', 'hpnz22', 'nico1234', 5),
(2147483647, 'valentina urq', 'administrador', 'valurq05', 'ew9r8fudivkj', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cli_id` int(11) NOT NULL,
  `cli_documento` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cli_id`, `cli_documento`) VALUES
(1, '000009777'),
(2, '1029981770'),
(3, '23835650');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `com_id` int(11) NOT NULL,
  `com_cantidad` int(250) NOT NULL,
  `com_pre_provee` varchar(250) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `prov_id` int(11) NOT NULL,
  `tie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`com_id`, `com_cantidad`, `com_pre_provee`, `pro_id`, `prov_id`, `tie_id`) VALUES
(57565, 5, '2000', 345657, 1, 1),
(128937, 5, '1000', 238783, 11, 1),
(1256444, 4, '1000', 987642, 8, 1),
(4938092, 4, '2000', 345657, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `pro_id` int(20) NOT NULL,
  `pro_nombre` varchar(250) NOT NULL,
  `pro_precioVenta` varchar(250) NOT NULL,
  `prov_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`pro_id`, `pro_nombre`, `pro_precioVenta`, `prov_id`) VALUES
(238783, 'Papas Limon Margarita', '2900', 11),
(345657, 'Gaseosa Coca-Cola', '2800', 1),
(438937, 'Papas Pollo Margarita', '1500', 11),
(987642, 'Chocorramo', '2800', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_en_tienda`
--

CREATE TABLE `producto_en_tienda` (
  `pro_tienda_id` int(11) NOT NULL,
  `pro_tienda_cant` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `tie_id` int(11) NOT NULL,
  `nombre_repartidor` varchar(200) NOT NULL,
  `fecha_recibido` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_en_tienda`
--

INSERT INTO `producto_en_tienda` (`pro_tienda_id`, `pro_tienda_cant`, `pro_id`, `tie_id`, `nombre_repartidor`, `fecha_recibido`) VALUES
(17, 5, 238783, 1, 'Laura Garcia', '2023-12-06'),
(18, 15, 987642, 1, 'Dacia Camargo', '2023-12-07'),
(19, 11, 345657, 1, 'Jairo Urquijo', '2023-12-09'),
(20, 10, 987642, 1, 'Dacia Camargo', '2023-11-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `prov_id` int(20) NOT NULL,
  `prov_nombre` varchar(250) NOT NULL,
  `prov_telefono` int(10) NOT NULL,
  `prov_correo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`prov_id`, `prov_nombre`, `prov_telefono`, `prov_correo`) VALUES
(1, 'Coca-Cola', 23131243, 'mmantilla@uni.com'),
(7, 'hola', 232183223, 'mmurquijo@gmail.com'),
(8, 'Ramo', 2147483647, 'hplazas@uni.com'),
(9, 'coca cola', 2147483647, 'valentinaurquijo@gmail.com'),
(10, 'D VSD', 4343, 'F@F'),
(11, 'Margarita', 2147483647, 'lsgarcia@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `tie_id` int(20) NOT NULL,
  `tie_nombre` varchar(200) NOT NULL,
  `tie_direccion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`tie_id`, `tie_nombre`, `tie_direccion`) VALUES
(1, 'supermercado patas', 'cll 48'),
(5, 'supermercado patitas', 'diagonal 54 16-36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `ven_id` int(11) NOT NULL,
  `ven_cant` int(250) NOT NULL,
  `ven_fecha` date NOT NULL,
  `cli_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `tie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`ven_id`, `ven_cant`, `ven_fecha`, `cli_id`, `pro_id`, `tie_id`) VALUES
(17, 5, '2023-12-06', 1, 238783, 1),
(18, 12, '2023-12-02', 2, 345657, 1),
(19, 4, '2023-12-13', 2, 987642, 1),
(20, 2, '2023-12-13', 1, 345657, 1),
(21, 10, '2023-12-01', 3, 238783, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`adm_id`),
  ADD KEY `tie_id` (`tie_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cli_id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `prov_id` (`prov_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `prov_id` (`prov_id`);

--
-- Indices de la tabla `producto_en_tienda`
--
ALTER TABLE `producto_en_tienda`
  ADD PRIMARY KEY (`pro_tienda_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `tie_id` (`tie_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`prov_id`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`tie_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`ven_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `cli_id` (`cli_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12839203;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `pro_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5476659;

--
-- AUTO_INCREMENT de la tabla `producto_en_tienda`
--
ALTER TABLE `producto_en_tienda`
  MODIFY `pro_tienda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `prov_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `tie_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `ven_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`tie_id`) REFERENCES `tienda` (`tie_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`prov_id`) REFERENCES `proveedor` (`prov_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `producto` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`prov_id`) REFERENCES `proveedor` (`prov_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_en_tienda`
--
ALTER TABLE `producto_en_tienda`
  ADD CONSTRAINT `producto_en_tienda_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `producto` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_en_tienda_ibfk_2` FOREIGN KEY (`tie_id`) REFERENCES `tienda` (`tie_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `producto` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
