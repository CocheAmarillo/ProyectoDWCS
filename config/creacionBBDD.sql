-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2020 a las 18:40:40
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestionmovilidades`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE DATABASE IF NOT EXISTS GESTIONMOVILIDADES;

USE GESTIONMOVILIDADES;

CREATE TABLE `alumnos` (
  `ID_ALUMNO` int(10) UNSIGNED NOT NULL,
  `VAT` varchar(16) DEFAULT NULL,
  `NOMBRE_COMPLETO` varchar(80) NOT NULL,
  `GENERO` enum('M','F','O') NOT NULL,
  `FECHA_NACIMIENTO` date NOT NULL,
  `FECHA_ALTA` datetime NOT NULL,
  `FECHA_BAJA` datetime DEFAULT NULL,
  `FECHA_MOD` datetime DEFAULT NULL,
  `SOCIO` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`ID_ALUMNO`, `VAT`, `NOMBRE_COMPLETO`, `GENERO`, `FECHA_NACIMIENTO`, `FECHA_ALTA`, `FECHA_BAJA`, `FECHA_MOD`, `SOCIO`) VALUES
(1, '1', 'alumno1', 'F', '2020-03-02', '2020-03-27 18:37:12', NULL, '2020-03-27 18:37:12', 1),
(2, '2', 'alumno2', 'O', '2020-03-03', '2020-03-27 18:37:26', NULL, '2020-03-27 18:37:26', 1),
(3, NULL, 'alumno3', 'M', '2019-09-04', '2020-03-27 18:37:41', NULL, '2020-03-27 18:37:41', 1),
(4, '3', 'alumno4', 'F', '2020-03-11', '2020-03-27 18:37:56', NULL, '2020-03-27 18:37:56', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_especialidades`
--

CREATE TABLE `alumnos_especialidades` (
  `ALUMNO` int(10) UNSIGNED NOT NULL,
  `ESPECIALIDAD` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos_especialidades`
--

INSERT INTO `alumnos_especialidades` (`ALUMNO`, `ESPECIALIDAD`) VALUES
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `ID_EMPRESA` int(10) UNSIGNED NOT NULL,
  `CARGO_RESPONSABLE` varchar(45) NOT NULL,
  `VAT` varchar(45) DEFAULT NULL,
  `NOMBRE` varchar(45) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `TELEFONO` varchar(45) NOT NULL,
  `CODIGO_POSTAL` varchar(45) NOT NULL,
  `DIRECCION` varchar(255) NOT NULL,
  `WEB` varchar(255) DEFAULT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL,
  `FECHA_ALTA` date NOT NULL,
  `FECHA_BAJA` date DEFAULT NULL,
  `FECHA_MOD` datetime DEFAULT NULL,
  `PAIS` int(10) UNSIGNED NOT NULL,
  `SOCIO` int(10) UNSIGNED NOT NULL,
  `RESPONSABLE` int(10) UNSIGNED NOT NULL,
  `TIPO` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`ID_EMPRESA`, `CARGO_RESPONSABLE`, `VAT`, `NOMBRE`, `EMAIL`, `TELEFONO`, `CODIGO_POSTAL`, `DIRECCION`, `WEB`, `DESCRIPCION`, `FECHA_ALTA`, `FECHA_BAJA`, `FECHA_MOD`, `PAIS`, `SOCIO`, `RESPONSABLE`, `TIPO`) VALUES
(1, 'Responsable practicas', '1', 'empresa1', 'empresa1@gmail.com', '1234556789', '36883', 'vigo', '', 'empresa de prueba 1', '2020-03-27', NULL, '2020-03-27 18:34:51', 14, 1, 1, 2),
(2, 'Responsable practicas', '2', 'empresa2', 'empresa2@gmail.com', '1234556789', '36883', 'vigo', 'https://www.empresa2.com', 'empresa de prueba 2', '2020-03-27', NULL, '2020-03-27 18:35:32', 7, 1, 2, 3),
(3, 'Responsable practicas', '3', 'empresa3', 'empresa3@gmail.com', '1234556789', '36883', 'vigo', 'https://www.empresa3.com', 'empresa de prueba 3', '2020-03-27', NULL, '2020-03-27 18:36:21', 7, 1, 3, 3),
(4, 'Responsable ', NULL, 'empresa4', 'empresa4@gmail.com', '1234556789', '36883', 'vigo', '', '', '2020-03-27', NULL, '2020-03-27 18:36:55', 2, 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas_especialidades`
--

CREATE TABLE `empresas_especialidades` (
  `ESPECIALIDAD` int(10) UNSIGNED NOT NULL,
  `EMPRESA` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresas_especialidades`
--

INSERT INTO `empresas_especialidades` (`ESPECIALIDAD`, `EMPRESA`) VALUES
(1, 1),
(1, 4),
(2, 1),
(2, 4),
(3, 1),
(3, 2),
(3, 4),
(4, 4),
(5, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `ID_ESTADO` int(10) UNSIGNED NOT NULL,
  `ESTADO` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`ID_ESTADO`, `ESTADO`, `DESCRIPCION`) VALUES
(1, 'REQUESTED', 'Request send but it hasnt been revised by the partner in question.'),
(2, 'IN PROCCESS', 'Accepted request and been processed.'),
(3, 'SOLVED', 'Request checked and solved by the partner in question.'),
(4, 'CANCELED', 'Request canceled by the partner in question.'),
(5, 'DECLINED', 'Request declined by the partner in question.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_peticiones`
--

CREATE TABLE `historico_peticiones` (
  `ID_PETICION` int(11) NOT NULL,
  `ASUNTO` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL,
  `FECHA` datetime NOT NULL,
  `ESTADO` int(10) UNSIGNED NOT NULL,
  `SOCIO_EMISOR` int(10) UNSIGNED NOT NULL,
  `SOCIO_RECEPTOR` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_puntuaciones`
--

CREATE TABLE `historico_puntuaciones` (
  `ID_PUNTUACION` int(10) UNSIGNED NOT NULL,
  `FECHA` datetime NOT NULL,
  `TIPO_PUNTUACION` int(10) UNSIGNED NOT NULL,
  `SOCIO` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historico_puntuaciones`
--

INSERT INTO `historico_puntuaciones` (`ID_PUNTUACION`, `FECHA`, `TIPO_PUNTUACION`, `SOCIO`) VALUES
(1, '2020-03-27 18:34:51', 3, 1),
(2, '2020-03-27 18:35:32', 3, 1),
(3, '2020-03-27 18:36:21', 3, 1),
(4, '2020-03-27 18:36:55', 3, 1),
(5, '2020-03-27 18:37:12', 3, 1),
(6, '2020-03-27 18:37:26', 3, 1),
(7, '2020-03-27 18:37:41', 3, 1),
(8, '2020-03-27 18:37:56', 3, 1),
(9, '2020-03-27 18:38:13', 5, 1),
(10, '2020-03-27 18:38:13', 4, 1),
(11, '2020-03-27 18:38:22', 5, 1),
(12, '2020-03-27 18:38:38', 5, 1),
(13, '2020-03-27 18:38:38', 4, 1),
(14, '2020-03-27 18:38:47', 5, 1),
(15, '2020-03-27 18:38:53', 5, 1),
(16, '2020-03-27 18:39:02', 5, 1),
(17, '2020-03-27 18:39:13', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones`
--

CREATE TABLE `instituciones` (
  `ID_INSTITUCION` int(10) UNSIGNED NOT NULL,
  `VAT` varchar(45) DEFAULT NULL,
  `NOMBRE` varchar(45) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `TELEFONO` varchar(45) NOT NULL,
  `CODIGO_POSTAL` char(45) NOT NULL,
  `DIRECCION` varchar(255) NOT NULL,
  `WEB` varchar(255) DEFAULT NULL,
  `FECHA_ALTA` date NOT NULL,
  `FECHA_BAJA` date DEFAULT NULL,
  `FECHA_MOD` datetime DEFAULT NULL,
  `PAIS` int(10) UNSIGNED NOT NULL,
  `SOCIO` int(10) UNSIGNED NOT NULL,
  `TIPO` int(10) UNSIGNED NOT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `instituciones`
--

INSERT INTO `instituciones` (`ID_INSTITUCION`, `VAT`, `NOMBRE`, `EMAIL`, `TELEFONO`, `CODIGO_POSTAL`, `DIRECCION`, `WEB`, `FECHA_ALTA`, `FECHA_BAJA`, `FECHA_MOD`, `PAIS`, `SOCIO`, `TIPO`, `DESCRIPCION`) VALUES
(1, NULL, 'institucion1', 'institucion1@gmail.com', '111111111', '36883', 'Vigo', 'institucion1.com', '2020-03-27', NULL, '2020-03-27 16:32:12', 1, 1, 1, 'institucion numero 1'),
(2, NULL, 'institucion2', 'institucion2@gmail.com', '111111111', '36883', 'Vigo', 'institucion2.com', '2020-03-27', NULL, '2020-03-27 16:32:12', 1, 2, 1, 'institucion numero 2'),
(3, NULL, 'institucion3', 'institucion3@gmail.com', '111111111', '36883', 'Vigo', 'institucion3.com', '2020-03-27', NULL, '2020-03-27 16:32:12', 1, 3, 1, 'institucion numero 3'),
(4, NULL, 'institucion_admin', 'institucion_admin@gmail.com', '111111111', '36883', 'Vigo', 'institucion_admin.com', '2020-03-27', NULL, '2020-03-27 16:32:12', 1, 4, 1, 'institucion del admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones_especialidades`
--

CREATE TABLE `instituciones_especialidades` (
  `ESPECIALIDAD` int(10) UNSIGNED NOT NULL,
  `INSTITUCION` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movilidades_empresas`
--

CREATE TABLE `movilidades_empresas` (
  `ID_MOVILIDAD` int(10) UNSIGNED NOT NULL,
  `FECHA_INICIO` date NOT NULL,
  `FECHA_FIN_ESTIMADO` date NOT NULL,
  `FECHA_FIN` date DEFAULT NULL,
  `FECHA_ALTA` datetime NOT NULL,
  `EMPRESA` int(10) UNSIGNED NOT NULL,
  `ALUMNO` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movilidades_empresas`
--

INSERT INTO `movilidades_empresas` (`ID_MOVILIDAD`, `FECHA_INICIO`, `FECHA_FIN_ESTIMADO`, `FECHA_FIN`, `FECHA_ALTA`, `EMPRESA`, `ALUMNO`) VALUES
(1, '2020-03-09', '2020-03-04', NULL, '2020-03-27 18:38:12', 1, 1),
(2, '2020-03-13', '2020-03-12', NULL, '2020-03-27 18:38:22', 2, 1),
(3, '2020-03-05', '2020-03-21', NULL, '2020-03-27 18:39:01', 1, 2),
(4, '2020-03-06', '2020-03-12', NULL, '2020-03-27 18:39:13', 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movilidades_instituciones`
--

CREATE TABLE `movilidades_instituciones` (
  `ID_MOVILIDAD` int(10) UNSIGNED NOT NULL,
  `FECHA_INICIO` date NOT NULL,
  `FECHA_FIN_ESTIMADO` date NOT NULL,
  `FECHA_FIN` date DEFAULT NULL,
  `FECHA_ALTA` datetime NOT NULL,
  `ALUMNO` int(10) UNSIGNED NOT NULL,
  `INSTITUCION` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movilidades_instituciones`
--

INSERT INTO `movilidades_instituciones` (`ID_MOVILIDAD`, `FECHA_INICIO`, `FECHA_FIN_ESTIMADO`, `FECHA_FIN`, `FECHA_ALTA`, `ALUMNO`, `INSTITUCION`) VALUES
(1, '2020-03-12', '2020-03-11', NULL, '2020-03-27 18:38:38', 1, 1),
(2, '2020-03-15', '2020-03-11', NULL, '2020-03-27 18:38:47', 2, 4),
(3, '2020-03-20', '2020-02-24', NULL, '2020-03-27 18:38:53', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `ID_PAIS` int(10) UNSIGNED NOT NULL,
  `CODIGO_PAIS` char(2) NOT NULL,
  `NOMBRE` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`ID_PAIS`, `CODIGO_PAIS`, `NOMBRE`) VALUES
(1, 'AT', 'Austria'),
(2, 'BE', 'Belgium'),
(3, 'BG', 'Bulgaria'),
(4, 'HR', 'Croatia'),
(5, 'CY', 'Cyprus'),
(6, 'CZ', 'Czech Republic'),
(7, 'DK', 'Denmark'),
(8, 'EE', 'Estonia'),
(9, 'FI', 'Finland'),
(10, 'FR', 'France'),
(11, 'DE', 'Germany'),
(12, 'GR', 'Greece'),
(13, 'HU', 'Hungary'),
(14, 'IE', 'Ireland'),
(15, 'IT', 'Italy'),
(16, 'LV', 'Latvia'),
(17, 'LT', 'Lithuania'),
(18, 'LU', 'Luxembourg'),
(19, 'MT', 'Malta'),
(20, 'NL', 'Netherlands'),
(21, 'PL', 'Poland'),
(22, 'PT', 'Portugal'),
(23, 'RO', 'Romania'),
(24, 'SK', 'Slovakia'),
(25, 'SI', 'Slovenia'),
(26, 'ES', 'Spain'),
(27, 'SE', 'Sweden');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsables`
--

CREATE TABLE `responsables` (
  `ID_RESPONSABLE` int(10) UNSIGNED NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `NOMBRE_COMPLETO` varchar(80) NOT NULL,
  `TELEFONO` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `responsables`
--

INSERT INTO `responsables` (`ID_RESPONSABLE`, `EMAIL`, `NOMBRE_COMPLETO`, `TELEFONO`) VALUES
(1, 'responsable1@gmail.com', 'Responsable', '123456789'),
(2, 'responsable2@gmail.com', 'Responsable_2', '123456789'),
(3, 'responsable3@gmail.com', 'Responsable_3', '123561789'),
(4, 'responsable4@gmail.com', 'Responsable_4', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuarios`
--

CREATE TABLE `rol_usuarios` (
  `ID_ROL` int(10) UNSIGNED NOT NULL,
  `TIPO` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol_usuarios`
--

INSERT INTO `rol_usuarios` (`ID_ROL`, `TIPO`, `DESCRIPCION`) VALUES
(1, 'ADMIN', 'User with administration permissions, user changing roles, register specialties and institution or companies types.'),
(2, 'REGISTERED', 'User who can register students, companies, institutions and generate mobilities.'),
(3, 'ANONYMOUS', 'Not registered user that can only look for simple searches.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `ID_SOCIO` int(10) UNSIGNED NOT NULL,
  `VAT` varchar(16) DEFAULT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `USUARIO` varchar(45) NOT NULL,
  `NOMBRE_COMPLETO` varchar(100) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `TELEFONO` varchar(20) NOT NULL,
  `FECHA_ALTA` datetime NOT NULL,
  `FECHA_BAJA` datetime DEFAULT NULL,
  `FECHA_MOD` datetime DEFAULT NULL,
  `CARGO` varchar(45) NOT NULL,
  `DEPARTAMENTO` varchar(45) NOT NULL,
  `R_ALOJAMIENTO` bit(1) DEFAULT NULL,
  `PUNTUACION` int(4) DEFAULT NULL,
  `ROL` int(10) UNSIGNED NOT NULL,
  `INSTITUCION` int(10) UNSIGNED DEFAULT NULL,
  `PAIS` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`ID_SOCIO`, `VAT`, `PASSWORD`, `USUARIO`, `NOMBRE_COMPLETO`, `EMAIL`, `TELEFONO`, `FECHA_ALTA`, `FECHA_BAJA`, `FECHA_MOD`, `CARGO`, `DEPARTAMENTO`, `R_ALOJAMIENTO`, `PUNTUACION`, `ROL`, `INSTITUCION`, `PAIS`) VALUES
(1, NULL, '$2y$10$..s5jkdivf15k4t9a0NMiOKjuj0hIKetrRJ3jY66BCN5686wH.6UG', 'socio1', 'socio numero 1', 'socio1@gmail.com', '11111111', '2020-03-27 16:32:12', NULL, '2020-03-27 16:32:12', 'socio', 'web', b'1', 60, 2, 1, 1),
(2, NULL, '$2y$10$..s5jkdivf15k4t9a0NMiOKjuj0hIKetrRJ3jY66BCN5686wH.6UG', 'socio2', 'socio numero 2', 'socio2@gmail.com', '11111111', '2020-03-27 16:32:12', NULL, '2020-03-27 16:32:12', 'socio', 'web', b'1', 10, 2, 2, 1),
(3, NULL, '$2y$10$..s5jkdivf15k4t9a0NMiOKjuj0hIKetrRJ3jY66BCN5686wH.6UG', 'socio3', 'socio numero 3', 'socio3@gmail.com', '11111111', '2020-03-27 16:32:12', NULL, '2020-03-27 16:32:12', 'socio', 'web', b'1', 10, 2, 3, 1),
(4, NULL, '$2y$10$..s5jkdivf15k4t9a0NMiOKjuj0hIKetrRJ3jY66BCN5686wH.6UG', 'admin', 'administrador', 'admin@gmail.com', '11111111', '2020-03-27 16:32:12', NULL, '2020-03-27 16:32:12', 'admin', 'web', b'1', 10, 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_empresa`
--

CREATE TABLE `tipos_empresa` (
  `ID_TIPO_EMPRESA` int(10) UNSIGNED NOT NULL,
  `TIPO` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_empresa`
--

INSERT INTO `tipos_empresa` (`ID_TIPO_EMPRESA`, `TIPO`, `DESCRIPCION`) VALUES
(1, 'PLC', 'Public Limited Company'),
(2, 'LTD', 'Private Limited Company'),
(3, 'ST', 'Solid Trader');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_especialidad`
--

CREATE TABLE `tipos_especialidad` (
  `ID_ESPECIALIDAD` int(10) UNSIGNED NOT NULL,
  `TIPO` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_especialidad`
--

INSERT INTO `tipos_especialidad` (`ID_ESPECIALIDAD`, `TIPO`, `DESCRIPCION`) VALUES
(1, 'Web Development', NULL),
(2, 'App Development', NULL),
(3, 'IT Administration', NULL),
(4, 'SMR Administration', NULL),
(5, 'Stylist and Beauty', NULL),
(6, 'Big Data', NULL),
(7, 'Hairdresser\'s', NULL),
(8, 'Lawyer', NULL),
(9, 'History', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_institucion`
--

CREATE TABLE `tipos_institucion` (
  `ID_TIPO_INSTITUCION` int(10) UNSIGNED NOT NULL,
  `TIPO` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_institucion`
--

INSERT INTO `tipos_institucion` (`ID_TIPO_INSTITUCION`, `TIPO`, `DESCRIPCION`) VALUES
(1, 'VS', 'Vocational Studies Center'),
(2, 'Higher Education', 'Institute of Higher Education'),
(3, 'University', 'University');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_puntuacion`
--

CREATE TABLE `tipos_puntuacion` (
  `ID_TIPO_PUNTUACION` int(10) UNSIGNED NOT NULL,
  `TIPO` varchar(45) NOT NULL,
  `DESCRIPCION` varchar(255) DEFAULT NULL,
  `VALOR` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_puntuacion`
--

INSERT INTO `tipos_puntuacion` (`ID_TIPO_PUNTUACION`, `TIPO`, `DESCRIPCION`, `VALOR`) VALUES
(1, 'DEFICIT', 'Minimun score a partner can have on his own.', -30),
(2, 'REGISTER', 'Default score when an account is registered.', 10),
(3, 'COMPANY REGISTER', 'Score given to a partner when register a company.', 20),
(4, 'STUDENT ACCOMMODATION', 'Score given to a partner when he manages the student accommodation.', 15),
(5, 'MOBILITY', 'Score removed from a partner when a mobility its done.', -20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`ID_ALUMNO`),
  ADD UNIQUE KEY `VAT_UNIQUE` (`VAT`),
  ADD KEY `FK6_SOCIO` (`SOCIO`);

--
-- Indices de la tabla `alumnos_especialidades`
--
ALTER TABLE `alumnos_especialidades`
  ADD PRIMARY KEY (`ALUMNO`,`ESPECIALIDAD`),
  ADD KEY `FK3_ALUMNO` (`ALUMNO`),
  ADD KEY `FK2_ESPECIALIDAD` (`ESPECIALIDAD`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`ID_EMPRESA`),
  ADD UNIQUE KEY `VAT_UNIQUE` (`VAT`),
  ADD KEY `FK3_PAIS` (`PAIS`),
  ADD KEY `FK2_SOCIO` (`SOCIO`),
  ADD KEY `FK1_RESPONSABLE` (`RESPONSABLE`),
  ADD KEY `FK1_TIPO_EMPRESA` (`TIPO`);

--
-- Indices de la tabla `empresas_especialidades`
--
ALTER TABLE `empresas_especialidades`
  ADD PRIMARY KEY (`ESPECIALIDAD`,`EMPRESA`),
  ADD KEY `FK3_ESPECIALIDAD` (`ESPECIALIDAD`),
  ADD KEY `FK2_EMPRESA` (`EMPRESA`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`ID_ESTADO`);

--
-- Indices de la tabla `historico_peticiones`
--
ALTER TABLE `historico_peticiones`
  ADD PRIMARY KEY (`ID_PETICION`),
  ADD KEY `FK4_SOCIO` (`SOCIO_EMISOR`),
  ADD KEY `FK5_SOCIO` (`SOCIO_RECEPTOR`),
  ADD KEY `FK1_ESTADO` (`ESTADO`);

--
-- Indices de la tabla `historico_puntuaciones`
--
ALTER TABLE `historico_puntuaciones`
  ADD PRIMARY KEY (`ID_PUNTUACION`),
  ADD KEY `FK1_TIPO_PUNTUACION` (`TIPO_PUNTUACION`),
  ADD KEY `FK3_SOCIO` (`SOCIO`);

--
-- Indices de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD PRIMARY KEY (`ID_INSTITUCION`),
  ADD KEY `FK2_PAIS` (`PAIS`),
  ADD KEY `FK1_SOCIO` (`SOCIO`),
  ADD KEY `FK1_TIPO_INSTITUCION` (`TIPO`);

--
-- Indices de la tabla `instituciones_especialidades`
--
ALTER TABLE `instituciones_especialidades`
  ADD PRIMARY KEY (`ESPECIALIDAD`,`INSTITUCION`),
  ADD KEY `FK1_ESPECIALIDAD` (`ESPECIALIDAD`),
  ADD KEY `FK2_INSTITUCION` (`INSTITUCION`);

--
-- Indices de la tabla `movilidades_empresas`
--
ALTER TABLE `movilidades_empresas`
  ADD PRIMARY KEY (`ID_MOVILIDAD`),
  ADD KEY `FK1_EMPRESA` (`EMPRESA`),
  ADD KEY `FK1_ALUMNO` (`ALUMNO`);

--
-- Indices de la tabla `movilidades_instituciones`
--
ALTER TABLE `movilidades_instituciones`
  ADD PRIMARY KEY (`ID_MOVILIDAD`),
  ADD KEY `FK1_INSTITUCION` (`INSTITUCION`),
  ADD KEY `FK2_ALUMNO` (`ALUMNO`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`ID_PAIS`),
  ADD UNIQUE KEY `NOMBRE_UNIQUE` (`NOMBRE`);

--
-- Indices de la tabla `responsables`
--
ALTER TABLE `responsables`
  ADD PRIMARY KEY (`ID_RESPONSABLE`,`EMAIL`),
  ADD UNIQUE KEY `EMAIL_UNIQUE` (`EMAIL`);

--
-- Indices de la tabla `rol_usuarios`
--
ALTER TABLE `rol_usuarios`
  ADD PRIMARY KEY (`ID_ROL`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`ID_SOCIO`),
  ADD UNIQUE KEY `EMAIL_UNIQUE` (`EMAIL`),
  ADD UNIQUE KEY `USUARIO_UNIQUE` (`USUARIO`),
  ADD UNIQUE KEY `VAT_UNIQUE` (`VAT`),
  ADD KEY `FK1_ROL` (`ROL`),
  ADD KEY `FK1_PAIS` (`PAIS`),
  ADD KEY `FK3_INSTITUCION` (`INSTITUCION`);

--
-- Indices de la tabla `tipos_empresa`
--
ALTER TABLE `tipos_empresa`
  ADD PRIMARY KEY (`ID_TIPO_EMPRESA`);

--
-- Indices de la tabla `tipos_especialidad`
--
ALTER TABLE `tipos_especialidad`
  ADD PRIMARY KEY (`ID_ESPECIALIDAD`);

--
-- Indices de la tabla `tipos_institucion`
--
ALTER TABLE `tipos_institucion`
  ADD PRIMARY KEY (`ID_TIPO_INSTITUCION`);

--
-- Indices de la tabla `tipos_puntuacion`
--
ALTER TABLE `tipos_puntuacion`
  ADD PRIMARY KEY (`ID_TIPO_PUNTUACION`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `ID_ALUMNO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `ID_EMPRESA` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `ID_ESTADO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `historico_peticiones`
--
ALTER TABLE `historico_peticiones`
  MODIFY `ID_PETICION` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historico_puntuaciones`
--
ALTER TABLE `historico_puntuaciones`
  MODIFY `ID_PUNTUACION` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  MODIFY `ID_INSTITUCION` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `movilidades_empresas`
--
ALTER TABLE `movilidades_empresas`
  MODIFY `ID_MOVILIDAD` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `movilidades_instituciones`
--
ALTER TABLE `movilidades_instituciones`
  MODIFY `ID_MOVILIDAD` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `ID_PAIS` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `responsables`
--
ALTER TABLE `responsables`
  MODIFY `ID_RESPONSABLE` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol_usuarios`
--
ALTER TABLE `rol_usuarios`
  MODIFY `ID_ROL` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `ID_SOCIO` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipos_empresa`
--
ALTER TABLE `tipos_empresa`
  MODIFY `ID_TIPO_EMPRESA` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_especialidad`
--
ALTER TABLE `tipos_especialidad`
  MODIFY `ID_ESPECIALIDAD` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipos_institucion`
--
ALTER TABLE `tipos_institucion`
  MODIFY `ID_TIPO_INSTITUCION` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_puntuacion`
--
ALTER TABLE `tipos_puntuacion`
  MODIFY `ID_TIPO_PUNTUACION` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `FK6_SOCIO` FOREIGN KEY (`SOCIO`) REFERENCES `socios` (`ID_SOCIO`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `alumnos_especialidades`
--
ALTER TABLE `alumnos_especialidades`
  ADD CONSTRAINT `FK2_ESPECIALIDAD` FOREIGN KEY (`ESPECIALIDAD`) REFERENCES `tipos_especialidad` (`ID_ESPECIALIDAD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK3_ALUMNO` FOREIGN KEY (`ALUMNO`) REFERENCES `alumnos` (`ID_ALUMNO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `FK1_RESPOSABLE` FOREIGN KEY (`RESPONSABLE`) REFERENCES `responsables` (`ID_RESPONSABLE`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK1_TIPO_EMPRESA` FOREIGN KEY (`TIPO`) REFERENCES `tipos_empresa` (`ID_TIPO_EMPRESA`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK2_SOCIO` FOREIGN KEY (`SOCIO`) REFERENCES `socios` (`ID_SOCIO`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK3_PAIS` FOREIGN KEY (`PAIS`) REFERENCES `paises` (`ID_PAIS`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `empresas_especialidades`
--
ALTER TABLE `empresas_especialidades`
  ADD CONSTRAINT `FK2_EMPRESA` FOREIGN KEY (`EMPRESA`) REFERENCES `empresas` (`ID_EMPRESA`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK3_ESPECIALIDAD` FOREIGN KEY (`ESPECIALIDAD`) REFERENCES `tipos_especialidad` (`ID_ESPECIALIDAD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historico_peticiones`
--
ALTER TABLE `historico_peticiones`
  ADD CONSTRAINT `FK1_ESTADO` FOREIGN KEY (`ESTADO`) REFERENCES `estados` (`ID_ESTADO`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK4_SOCIO` FOREIGN KEY (`SOCIO_EMISOR`) REFERENCES `socios` (`ID_SOCIO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK5_SOCIO` FOREIGN KEY (`SOCIO_RECEPTOR`) REFERENCES `socios` (`ID_SOCIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historico_puntuaciones`
--
ALTER TABLE `historico_puntuaciones`
  ADD CONSTRAINT `FK1_TIPO_PUNTUACION` FOREIGN KEY (`TIPO_PUNTUACION`) REFERENCES `tipos_puntuacion` (`ID_TIPO_PUNTUACION`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK3_SOCIO` FOREIGN KEY (`SOCIO`) REFERENCES `socios` (`ID_SOCIO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD CONSTRAINT `FK1_SOCIO` FOREIGN KEY (`SOCIO`) REFERENCES `socios` (`ID_SOCIO`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK1_TIPO_INSTITUCION` FOREIGN KEY (`TIPO`) REFERENCES `tipos_institucion` (`ID_TIPO_INSTITUCION`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK2_PAIS` FOREIGN KEY (`PAIS`) REFERENCES `paises` (`ID_PAIS`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `instituciones_especialidades`
--
ALTER TABLE `instituciones_especialidades`
  ADD CONSTRAINT `FK1_ESPECIALIDAD` FOREIGN KEY (`ESPECIALIDAD`) REFERENCES `tipos_especialidad` (`ID_ESPECIALIDAD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK2_INSTITUCION` FOREIGN KEY (`INSTITUCION`) REFERENCES `instituciones` (`ID_INSTITUCION`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movilidades_empresas`
--
ALTER TABLE `movilidades_empresas`
  ADD CONSTRAINT `FK1_ALUMNO` FOREIGN KEY (`ALUMNO`) REFERENCES `alumnos` (`ID_ALUMNO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK1_EMPRESA` FOREIGN KEY (`EMPRESA`) REFERENCES `empresas` (`ID_EMPRESA`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movilidades_instituciones`
--
ALTER TABLE `movilidades_instituciones`
  ADD CONSTRAINT `FK1_INSTITUCION` FOREIGN KEY (`INSTITUCION`) REFERENCES `instituciones` (`ID_INSTITUCION`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK2_ALUMNO` FOREIGN KEY (`ALUMNO`) REFERENCES `alumnos` (`ID_ALUMNO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `socios`
--
ALTER TABLE `socios`
  ADD CONSTRAINT `FK1_PAIS` FOREIGN KEY (`PAIS`) REFERENCES `paises` (`ID_PAIS`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK1_ROL` FOREIGN KEY (`ROL`) REFERENCES `rol_usuarios` (`ID_ROL`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK3_INSTITUCION` FOREIGN KEY (`INSTITUCION`) REFERENCES `instituciones` (`ID_INSTITUCION`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



    
# Privilegios para `admin`@`localhost`

GRANT USAGE ON *.* TO 'admin'@'localhost' IDENTIFIED BY PASSWORD '*A4B6157319038724E3560894F7F932C8886EBFCF';

GRANT ALL PRIVILEGES ON `gestionmovilidades`.* TO 'admin'@'localhost';


# Privilegios para `conexion`@`localhost`

GRANT USAGE ON *.* TO 'conexion'@'localhost' IDENTIFIED BY PASSWORD '*A4B6157319038724E3560894F7F932C8886EBFCF';

GRANT SELECT, INSERT, UPDATE, DELETE ON `gestionmovilidades`.* TO 'conexion'@'localhost';


# Privilegios para `estandar`@`localhost`

GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'estandar'@'localhost' IDENTIFIED BY PASSWORD '*A4B6157319038724E3560894F7F932C8886EBFCF';

GRANT SELECT, INSERT, UPDATE, DELETE ON `gestionmovilidades`.* TO 'estandar'@'localhost';
    
    

  
  
  
  
  
  
  
