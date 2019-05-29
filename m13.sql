-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2019 a las 19:18:54
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `m12`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carro`
--

CREATE TABLE `carro` (
  `comanda_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `unidades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `carro`
--

INSERT INTO `carro` (`comanda_id`, `producto_id`, `unidades`) VALUES
(1, 1, 1),
(1, 3, 1),
(1, 5, 1),
(1, 7, 1),
(2, 1, 1),
(2, 3, 1),
(2, 4, 1),
(2, 5, 1),
(2, 6, 1),
(2, 9, 1),
(3, 1, 1),
(3, 6, 1),
(3, 8, 1),
(4, 1, 1),
(4, 5, 1),
(4, 9, 1),
(5, 4, 1),
(5, 5, 1),
(5, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `user` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `email` varchar(95) COLLATE latin1_spanish_ci DEFAULT NULL,
  `telf` int(12) DEFAULT NULL,
  `type` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
  `password` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `city` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `adress` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `cp` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='	\n';

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `user`, `email`, `telf`, `type`, `password`, `city`, `adress`, `cp`) VALUES
(1, 'david', 'kobas', 'david@gmail.com', 456123789, 'particular', '55555555', 'barcelona', 'calle false', 1234),
(2, 'albert', 'lokillo', 'alb@gmail.com', 666123789, 'particular', '88888888', 'barcelona', 'calle prim', 55234),
(3, 'bart', 'bartolo', 'bart@gmail.com', 776123789, 'empresa', '77777777', 'springfienld', 'calle boulevard', 99234);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda`
--

CREATE TABLE `comanda` (
  `id` int(11) NOT NULL,
  `dia` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `franja` int(1) DEFAULT NULL,
  `status` varchar(15) COLLATE latin1_spanish_ci DEFAULT NULL,
  `comanda_cliente` int(10) NOT NULL,
  `cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `comanda`
--

INSERT INTO `comanda` (`id`, `dia`, `franja`, `status`, `comanda_cliente`, `cliente_id`) VALUES
(1, '2019-01-10', 3, 'pendiente', 1, 1),
(2, '2019-11-05', 2, 'pendiente', 2, 1),
(3, '2019-07-09', 3, 'entregado', 3, 1),
(4, '2019-11-11', 3, 'pendiente', 1, 2),
(5, '2019-01-10', 3, 'pendiente', 1, 3),
(6, '2019-06-06', 1, 'pendiente', 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `precio` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `tipo` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `precio`, `tipo`) VALUES
(1, 'camiseta', '3', '1'),
(2, 'pantalon', '5', '2'),
(3, 'jersey', '10', '2'),
(4, 'tejano', '2', '1'),
(5, 'chaleko', '5', '2'),
(6, 'bambas', '10', '2'),
(7, 'zapato', '3', '3'),
(8, 'moasin', '5', '3'),
(9, 'chandal', '10', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `user` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `telf` int(12) NOT NULL,
  `dni` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `ss` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`id`, `nombre`, `user`, `password`, `telf`, `dni`, `ss`) VALUES
(1, 'David', 'kobas', '12345678', 666555999, '56237845T', 2147483647),
(2, 'zatu', 'boss', '12345678', 777888999, '48592623L', 2147483647),
(3, 'Javier', 'javato', '12345678', 999555333, '74859623R', 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `washapp`
--

CREATE TABLE `washapp` (
  `id` int(11) NOT NULL,
  `user` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `washapp`
--

INSERT INTO `washapp` (`id`, `user`, `password`) VALUES
(1, 'admin@washapp.com', '12345678');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`comanda_id`,`producto_id`),
  ADD KEY `fk_comanda_has_producto_producto1_idx` (`producto_id`),
  ADD KEY `fk_comanda_has_producto_comanda1_idx` (`comanda_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comanda_cliente_idx` (`cliente_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `washapp`
--
ALTER TABLE `washapp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comanda`
--
ALTER TABLE `comanda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `washapp`
--
ALTER TABLE `washapp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carro`
--
ALTER TABLE `carro`
  ADD CONSTRAINT `fk_comanda_has_producto_comanda1` FOREIGN KEY (`comanda_id`) REFERENCES `comanda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comanda_has_producto_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD CONSTRAINT `fk_comanda_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
