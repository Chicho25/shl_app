-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2017 a las 23:19:27
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shl`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `master_stat`
--

CREATE TABLE `master_stat` (
  `Id` int(11) NOT NULL,
  `Name_stat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `master_stat`
--

INSERT INTO `master_stat` (`Id`, `Name_stat`) VALUES
(1, 'Inactivo'),
(2, 'Activo'),
(3, 'En Curso'),
(4, 'Terminado'),
(5, 'Cancelado'),
(6, 'Eliminar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messajes`
--

CREATE TABLE `messajes` (
  `Id` int(11) NOT NULL,
  `Id_service` int(11) NOT NULL,
  `Id_user` int(11) NOT NULL,
  `Messaje` text NOT NULL,
  `Date_register` datetime NOT NULL,
  `Id_register` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `messajes`
--

INSERT INTO `messajes` (`Id`, `Id_service`, `Id_user`, `Messaje`, `Date_register`, `Id_register`) VALUES
(1, 1, 7, 'Por favor culminar pronto ', '2017-11-14 20:47:31', 1),
(9, 1, 7, 'mensaje del admin', '2017-11-14 23:48:30', 1),
(10, 1, 4, 'Esto es un mensaje para el operador', '2017-11-14 23:53:42', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Date_service` datetime NOT NULL,
  `Id_customer` int(11) NOT NULL,
  `Id_operator` int(11) NOT NULL,
  `Description` text NOT NULL,
  `addres` text NOT NULL,
  `Stat` int(11) NOT NULL,
  `Date_create` datetime NOT NULL,
  `User_register` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`Id`, `Name`, `Date_service`, `Id_customer`, `Id_operator`, `Description`, `addres`, `Stat`, `Date_create`, `User_register`) VALUES
(1, 'prueba V1', '2017-11-25 00:00:00', 7, 4, 'prueba de servicio', 'direcciÃ³n de servicio', 2, '2017-11-14 15:02:25', 1),
(2, 'servicio prueba', '2017-11-25 00:00:00', 7, 4, 'por ahi ', 'por ahi ', 2, '2017-11-14 15:12:24', 1),
(3, 'servicio prueba 2', '2017-11-18 00:00:00', 8, 9, 'mass', 'mass', 2, '2017-11-14 15:24:39', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_user`
--

CREATE TABLE `type_user` (
  `Id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Stat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `type_user`
--

INSERT INTO `type_user` (`Id`, `Name`, `Stat`) VALUES
(1, 'Admin', 2),
(2, 'Operador', 2),
(3, 'Cliente', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Last_name` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Pass` varchar(20) NOT NULL,
  `Type_user` int(11) NOT NULL,
  `Addres` varchar(500) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Image` varchar(250) NOT NULL,
  `Stat` int(11) NOT NULL,
  `Date_create` datetime NOT NULL,
  `User_register` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`Id`, `Name`, `Last_name`, `Email`, `Pass`, `Type_user`, `Addres`, `Phone`, `Image`, `Stat`, `Date_create`, `User_register`) VALUES
(1, 'tayron', 'perez', 'tayronperez17@gmail.com', '321', 1, 'milla 8', '60026773', 'image/1.jpg', 1, '0000-00-00 00:00:00', 0),
(2, 'Operador', '1', 'operador1@gmail.com', '321', 2, 'milla 8', '565656', '', 1, '0000-00-00 00:00:00', 0),
(3, 'cliente', '1', 'cliente1@gmail.com', '321', 3, 'milla 8', '585858', '', 1, '0000-00-00 00:00:00', 0),
(4, 'jose', 'carrasco', 'josecarrasco@gmail.com', '321', 2, '', '5469875', '', 2, '2017-11-12 04:46:24', 1),
(5, 'Pedro', 'carrasco', 'locatel.pagina@gmail.com', '321', 1, 'por ahi', '231236', '', 2, '2017-11-12 05:02:12', 1),
(7, 'cliente 1', 'cliente 1', 'primer@cliente.com', '321', 3, 'por ahi ', '909090', '', 2, '2017-11-14 15:01:51', 1),
(8, 'cliente 2', 'cliente 2', 'segundo@cliente.com', '321', 3, 'por ahi', '90909012', '', 2, '2017-11-14 15:08:24', 1),
(9, 'operador2', 'operador 2', 'segundo@operador.com', '321', 2, 'por ahi ', '23456', '', 2, '2017-11-14 15:09:24', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `master_stat`
--
ALTER TABLE `master_stat`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `messajes`
--
ALTER TABLE `messajes`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `type_user`
--
ALTER TABLE `type_user`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `master_stat`
--
ALTER TABLE `master_stat`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `messajes`
--
ALTER TABLE `messajes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `type_user`
--
ALTER TABLE `type_user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
