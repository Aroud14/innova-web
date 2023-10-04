-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2023 a las 19:53:03
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `base`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblc_configuracion`
--

CREATE TABLE `tblc_configuracion` (
  `id_configuracion` int(10) UNSIGNED NOT NULL,
  `nombre_empresa` varchar(45) DEFAULT NULL,
  `logo` varchar(40) DEFAULT '0',
  `correo` varchar(45) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `whatsapp` varchar(15) DEFAULT NULL,
  `aviso_privacidad` text DEFAULT NULL,
  `termino_condicion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblc_estado`
--

CREATE TABLE `tblc_estado` (
  `id_estado` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `abreviacion` varchar(45) DEFAULT NULL,
  `latitud` varchar(25) DEFAULT NULL,
  `longitud` varchar(25) DEFAULT NULL,
  `estatus` int(1) DEFAULT NULL,
  `clave_inegi` varchar(15) DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblc_municipio`
--

CREATE TABLE `tblc_municipio` (
  `id_municipio` int(10) UNSIGNED NOT NULL,
  `id_estado` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `estatus` int(1) DEFAULT NULL,
  `latitud` varchar(25) DEFAULT NULL,
  `longitud` varchar(25) DEFAULT NULL,
  `clave_inegi` varchar(7) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblc_permiso`
--

CREATE TABLE `tblc_permiso` (
  `id_permiso` int(10) UNSIGNED NOT NULL,
  `id_padre` int(11) DEFAULT 0,
  `nombre` varchar(45) NOT NULL,
  `archivo` varchar(45) NOT NULL,
  `ordenamiento` int(3) NOT NULL,
  `icono` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `tipo` int(1) NOT NULL,
  `estatus` int(1) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_eliminado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_log_usuario`
--

CREATE TABLE `tbl_log_usuario` (
  `id_log_usuario` int(11) NOT NULL,
  `fecha_accion` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `script` text DEFAULT NULL,
  `so` varchar(45) DEFAULT NULL,
  `navegador` varchar(45) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(55) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `password` varchar(60) NOT NULL,
  `editar` int(1) NOT NULL DEFAULT 0,
  `eliminar` int(1) NOT NULL DEFAULT 0,
  `cancelar` int(1) NOT NULL DEFAULT 0,
  `editar_validado` int(1) NOT NULL DEFAULT 0,
  `tiene_horario` int(1) NOT NULL DEFAULT 0,
  `tipo` int(1) NOT NULL DEFAULT 1 COMMENT '1.- administrador 2.- Promotor',
  `estatus` int(1) NOT NULL DEFAULT 1 COMMENT '1.- activo',
  `correo` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_eliminado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_horario`
--

CREATE TABLE `tbl_usuario_horario` (
  `id_usuario_horario` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `dia` int(1) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_termino` time DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_eliminado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_permiso`
--

CREATE TABLE `tbl_usuario_permiso` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_permiso` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblc_configuracion`
--
ALTER TABLE `tblc_configuracion`
  ADD PRIMARY KEY (`id_configuracion`);

--
-- Indices de la tabla `tblc_estado`
--
ALTER TABLE `tblc_estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `tblc_municipio`
--
ALTER TABLE `tblc_municipio`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `fk_tblc_municipio_tblc_estado1_idx` (`id_estado`);

--
-- Indices de la tabla `tblc_permiso`
--
ALTER TABLE `tblc_permiso`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `tbl_log_usuario`
--
ALTER TABLE `tbl_log_usuario`
  ADD PRIMARY KEY (`id_log_usuario`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `tbl_usuario_horario`
--
ALTER TABLE `tbl_usuario_horario`
  ADD PRIMARY KEY (`id_usuario_horario`),
  ADD KEY `fk_tbl_usuario_horario_tbl_usuario1_idx` (`id_usuario`);

--
-- Indices de la tabla `tbl_usuario_permiso`
--
ALTER TABLE `tbl_usuario_permiso`
  ADD PRIMARY KEY (`id_usuario`,`id_permiso`),
  ADD KEY `fk_tbl_usuario_has_tblc_permiso_tblc_permiso1_idx` (`id_permiso`),
  ADD KEY `fk_tbl_usuario_has_tblc_permiso_tbl_usuario_idx` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblc_configuracion`
--
ALTER TABLE `tblc_configuracion`
  MODIFY `id_configuracion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblc_estado`
--
ALTER TABLE `tblc_estado`
  MODIFY `id_estado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblc_municipio`
--
ALTER TABLE `tblc_municipio`
  MODIFY `id_municipio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblc_permiso`
--
ALTER TABLE `tblc_permiso`
  MODIFY `id_permiso` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_log_usuario`
--
ALTER TABLE `tbl_log_usuario`
  MODIFY `id_log_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario_horario`
--
ALTER TABLE `tbl_usuario_horario`
  MODIFY `id_usuario_horario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tblc_municipio`
--
ALTER TABLE `tblc_municipio`
  ADD CONSTRAINT `fk_tblc_municipio_tblc_estado1` FOREIGN KEY (`id_estado`) REFERENCES `tblc_estado` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario_horario`
--
ALTER TABLE `tbl_usuario_horario`
  ADD CONSTRAINT `fk_tbl_usuario_horario_tbl_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario_permiso`
--
ALTER TABLE `tbl_usuario_permiso`
  ADD CONSTRAINT `fk_tbl_usuario_has_tblc_permiso_tbl_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_usuario_has_tblc_permiso_tblc_permiso1` FOREIGN KEY (`id_permiso`) REFERENCES `tblc_permiso` (`id_permiso`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
