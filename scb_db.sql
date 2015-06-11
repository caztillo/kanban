-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2015 a las 02:14:01
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `scb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ano`
--

CREATE TABLE IF NOT EXISTS `ano` (
  `id_ano` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_termino` date NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `creacion` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ano`
--

INSERT INTO `ano` (`id_ano`, `descripcion`, `fecha_inicio`, `fecha_termino`, `estado`, `creacion`) VALUES
(1, '01/ENE/2015 al 31/DIC/2015', '2015-01-01', '2015-12-31', 'Activo', '2015-06-09 23:09:43'),
(2, '01/ENE/2014 al 31/DIC/2014', '2014-01-01', '2014-12-31', 'Activo', '2015-06-09 23:31:16'),
(3, '01/ENE/2016 al 31/DIC/2016', '2016-01-01', '2016-12-31', 'Activo', '2015-06-10 11:58:23'),
(4, '01/ENE/2013 al 31/DIC/2013', '2013-01-01', '2013-12-31', 'Activo', '2015-06-10 16:09:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiario`
--

CREATE TABLE IF NOT EXISTS `beneficiario` (
  `id_beneficiario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `pais_nacionalidad` varchar(100) DEFAULT NULL,
  `RFC` varchar(15) NOT NULL,
  `CURP` varchar(18) NOT NULL,
  `estado` enum('Activo','Vetado') NOT NULL DEFAULT 'Activo',
  `creacion` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beneficiario`
--

INSERT INTO `beneficiario` (`id_beneficiario`, `nombre`, `direccion`, `codigo_postal`, `telefono`, `correo`, `fecha_nacimiento`, `pais_nacionalidad`, `RFC`, `CURP`, `estado`, `creacion`) VALUES
(1, 'Javier Alonso Juárez Rodríguez', 'Tres cruces No 6, Colinas del Padre, Zacatecas, Zac.', '99440', '4921026565', 'javro21@gmail.com', '1985-02-24', 'Mexico', 'AARO830621CN8', 'AARO830621HZSMMD04', 'Activo', '2015-06-09 21:25:19'),
(2, 'Miguel Angel López Guerrero', 'Calle central #7 Colonia Guadalupe, Jerez, Zacatecas.', '99315', '4941018752', 'm.angel23@hotmail.com', '1986-06-09', 'Mexico', 'LOGM860609VB5', 'LOGM860609HZSMMF05', 'Vetado', '2015-06-09 21:33:35'),
(3, 'Carlos Alberto Duarte Ávila', 'Matias Ramos No. 6 Colonia Cedros, Jerez, Zacatecas', '99300', '4942003654', 'duavila6@hotmail.com', '1980-07-19', 'Armenia', 'DUAA800719MB7', 'DUAA800719GSFDDT87', 'Vetado', '2015-06-09 21:41:17'),
(4, 'Maria Laura Treviño Casas', 'Calle Alvaro Obregon No. 12, Colonia Las Huertas, Fresnillo, Zacatecas', '99170', '4931210268', 'malau.casas@hotmail.com', '1981-11-24', 'Guatemala', 'TECA811124FR4', 'TECA811124FSDRRI54', 'Activo', '2015-06-09 21:58:53'),
(5, 'Carolina Salcedo Avila', 'Calle Guanajuato No. 127, Colonia Centro Jalpa, Zacatecas', '85200', '4915004585', 'caro_avila8@gmail.com', '1990-10-12', 'Argentina', 'SAAC901012HG5', 'SAAC901012HZSMMY98', 'Activo', '2015-06-09 22:10:13'),
(6, 'Javier Ignacio Molina Cano', 'Asteroides 308, Las Palmas, Zacatecas,  Zac.', '98056', '4921122121', 'nacho45@hotmail.com', '1982-06-11', 'Mexico', 'ALSO061117NU6', 'ALSO061117HZSUIY87', 'Activo', '2015-06-10 15:37:58'),
(7, 'Lillian Eugenia Gómez Álvarez', 'San Juan Bautista 16, San Francisco de Herrera, Zacatecas', '98000', '4925557414', 'lilygom3@gmail.com', '1984-06-12', 'Mexico', 'FUNI050302J84', 'FUNI050302HZSOIU95', 'Activo', '2015-06-10 15:39:07'),
(8, 'Sixto Naranjo Marín', 'Av. Revolución Mexicana 108 22, Ejidal, Guadalupe, Zacatecas', '98300', '4921132222', 'nar.sixto@hotmail.com', '1977-05-12', 'Mexico', 'GIDW040308KU5', 'GIDW040308HZSHUI85', 'Vetado', '2015-06-10 15:42:39'),
(9, 'Gerardo Emilio Duque Gutiérrez', 'Av Colegio Militar 151, Centro, Guadalupe, Zacatecas', '98300', '4924568787', 'duqge12@hotmail.com', '1971-07-20', 'Costa Rica', 'TAAR890811IC1', 'TAAR890811HZSVBN21', 'Activo', '2015-06-10 15:45:40'),
(10, 'Jhony Alberto Sáenz Hurtado', 'Calle Ignacio López Rayón 3, Centro, Jerez de García Salinas', '99440', '4946548998', 'hbeto23@gmail.com', '1982-06-15', 'Guinea', 'MCCD8610194V2', 'MCCD861019HZSRTY45', 'Vetado', '2015-06-10 15:46:37'),
(11, 'Germán Antonio Lotero Upegui', 'Ave Universidad 107, Hidráulica, Zacatecas, Zac.', '98000', '4927895412', 'tonylot@hotmail.com', '1977-06-20', 'Mexico', 'MLAR930219ED7', 'MLAR930219HZSERT59', 'Vetado', '2015-06-10 15:48:29'),
(12, 'Oscar Darío Murillo González', 'Ave Miguel Hgo 239, Trojes, Trojes,  Zac.', '99200', '4921285487', 'o.dario98@gmail.com', '1982-06-17', 'Mexico', 'NATY091111HD4', 'NATY091111HZSGDF74', 'Activo', '2015-06-10 15:51:20'),
(13, 'César Oswaldo Palacio Martínez', 'Ave Hidalgo 444 4, Centro, Sombrerete, Zac.', '99100', '4335284578', 'ces1palacio@hotmail.com', '1987-06-15', 'Mexico', 'WAPU040623SH5', 'WAPU040623HZSUYT32', 'Activo', '2015-06-10 15:52:37'),
(14, 'Gloria Amparo Alzate Agudelo', 'Calle Mercado Hgo 83, Centro, Fresnillo, Zac.', '99000', '4936396521', 'amparogl2@hotmail.com', '1982-04-19', 'Mexico', 'CBPO980430PG9', 'CBPO980430HZSYTR12', 'Activo', '2015-06-10 15:54:19'),
(15, 'Héctor Iván González Castaño', 'Calle Guadalupe 44, Centro, Zacatecas.', '98600', '4925287878', 'ivanchivas12@gmail.com', '1977-06-20', 'Mexico', 'IHBU051005H93', 'IHBU051005HZSBNM85', 'Vetado', '2015-06-10 20:39:25'),
(16, 'Beatriz Elena Osorio Laverde', 'Calle Rio Támesis 23, Ejidal, Fresnillo, Zac.', '99050', '4938972233', 'lenatriz@gmail.com', '1982-01-21', 'Mexico', 'TTME1009248U7', 'TTME100924HZSREQ58', 'Activo', '2015-06-10 20:40:44'),
(17, 'Carlos Mario Montoya Serna', 'Av México Q 15 101, Fovissste, Zacatecas, Zac.', '98064', '4925118569', 'carcor6@gmail.com', '1980-08-21', 'Mexico', 'PROR0603158Y4', 'PROR060315HZSTRE54', 'Activo', '2015-06-10 20:41:53'),
(18, 'Carlos Augusto Giraldo', 'Las Huertas 34, Centro, Guadalupe, Zac.', '98600', '4924120287', 'augustcv9@hotmail.com', '1982-06-17', 'Mexico', 'EACE9804131Y6', 'EACE980413HZSNJG72', 'Vetado', '2015-06-10 20:52:23'),
(19, 'Arturo Tabares Mora', 'Panfilo Avila 503, Panfilo Natera, Zacatecas, Zac.', '98070', '4925128541', 'moratab@yahoo.com', '1977-06-21', 'Mexico', 'TFMI011030DE8', 'TFMI011030HZSHGF21', 'Vetado', '2015-06-10 20:54:44'),
(20, 'Maria Victoria Arias Gómez', 'AV GARCIA SALINAS 503, CENTRO, FRESNILLO, ZAC', '98900', '4951025412', 'vmariaz4@gmail.com', '1982-06-11', 'Mexico', 'AGOM850611CN6', 'AGOM850611HZSMMR05', 'Activo', '2015-06-10 22:21:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiario_organizacion`
--

CREATE TABLE IF NOT EXISTS `beneficiario_organizacion` (
  `id_beneficiario_organizacion` int(11) NOT NULL,
  `id_beneficiario` int(11) NOT NULL,
  `id_organizacion` int(11) NOT NULL,
  `comentarios` text,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `inscripcion` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beneficiario_organizacion`
--

INSERT INTO `beneficiario_organizacion` (`id_beneficiario_organizacion`, `id_beneficiario`, `id_organizacion`, `comentarios`, `estado`, `inscripcion`) VALUES
(1, 5, 5, '', 'Activo', '2015-06-10 19:46:34'),
(2, 12, 11, '', 'Activo', '2015-06-10 21:32:01'),
(4, 4, 4, '', 'Activo', '2015-06-10 21:32:24'),
(5, 17, 6, '', 'Inactivo', '2015-06-10 21:32:52'),
(6, 7, 3, '', 'Activo', '2015-06-10 21:33:39'),
(7, 16, 10, '', 'Activo', '2015-06-10 21:33:55'),
(8, 6, 2, '', 'Activo', '2015-06-10 21:34:11'),
(10, 6, 11, '', 'Activo', '2015-06-10 21:35:23'),
(11, 9, 11, '', 'Activo', '2015-06-10 21:35:43'),
(12, 12, 13, '', 'Activo', '2015-06-10 22:35:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiario_programa`
--

CREATE TABLE IF NOT EXISTS `beneficiario_programa` (
  `id_beneficiario_programa` int(11) NOT NULL,
  `id_beneficiario` int(11) NOT NULL,
  `id_programa` int(11) NOT NULL,
  `id_direccion` int(11) NOT NULL,
  `finalidad` enum('Cumplida','En Proceso') NOT NULL DEFAULT 'En Proceso',
  `comentarios` text,
  `inscripcion` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `beneficiario_programa`
--

INSERT INTO `beneficiario_programa` (`id_beneficiario_programa`, `id_beneficiario`, `id_programa`, `id_direccion`, `finalidad`, `comentarios`, `inscripcion`) VALUES
(1, 16, 1, 1, 'Cumplida', 'Comentarios', '2015-06-09 23:56:58'),
(2, 9, 4, 3, 'Cumplida', 'Comentarios', '2015-06-10 16:48:33'),
(3, 5, 4, 2, 'En Proceso', '', '2015-06-10 16:51:03'),
(4, 4, 5, 4, 'En Proceso', '', '2015-06-10 20:01:22'),
(5, 5, 2, 1, 'Cumplida', '', '2015-06-10 20:43:59'),
(6, 16, 5, 4, 'En Proceso', '', '2015-06-10 21:30:05'),
(7, 1, 1, 1, 'Cumplida', '', '2015-06-10 21:58:33'),
(8, 7, 5, 4, 'Cumplida', '', '2015-06-10 21:59:26'),
(9, 6, 4, 2, 'Cumplida', '', '2015-06-10 22:00:08'),
(10, 20, 2, 4, 'Cumplida', '', '2015-06-10 22:24:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencia`
--

CREATE TABLE IF NOT EXISTS `dependencia` (
  `id_dependencia` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `creacion` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dependencia`
--

INSERT INTO `dependencia` (`id_dependencia`, `nombre`, `clave`, `direccion`, `estado`, `creacion`) VALUES
(1, 'Secretaría de Economía', 'SEZAC', 'Circuito Cerro del Gato, Edificio B, Primer Piso, Complejo Ciudad Administrativa', 'Activo', '2015-06-09 23:41:47'),
(2, 'Secretaría de Educación', 'SEDUZAC', 'BlvrJosé López Portillo, De Las Dependencias Federales, 98618 Guadalupe, Zac.', 'Activo', '2015-06-09 23:49:32'),
(3, 'Secretaría de Desarrollo Social', 'SEDESOL', 'Blvd. Héroes de Chapultepec No. 1902 Complejo Ciudad Administrativa Edificio "B" C.P. 98160 Zacatecas, Zac.', 'Activo', '2015-06-10 12:26:08'),
(4, 'Secretaría de Finanzas', 'SEFINZAC', 'Calle Hidalgo 403, 98000 Zacatecas, Zac.', 'Activo', '2015-06-10 16:15:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE IF NOT EXISTS `direccion` (
  `id_direccion` int(11) NOT NULL,
  `id_dependencia` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `creacion` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`id_direccion`, `id_dependencia`, `nombre`, `clave`, `estado`, `creacion`) VALUES
(1, 1, 'Tecnologías de la Información', 'TECINFO', 'Activo', '2015-06-09 23:55:50'),
(2, 1, 'Desarrollo de las Pymes', 'DESPYM', 'Activo', '2015-06-10 12:09:53'),
(3, 1, 'Comercio Interior', 'COMINTE', 'Activo', '2015-06-10 12:14:21'),
(4, 2, 'Gestión Compensatoria', 'GESCOMP', 'Activo', '2015-06-10 18:08:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '{"usuarios.create":1,"usuarios.delete":1,"usuarios.view":1,"usuarios.update":1,"direcciones.create":1,"direcciones.delete":1,"direcciones.view":1,"direcciones.update":1,"dependencias.create":1,"dependencias.delete":1,"dependencias.view":1,"dependencias.update":1,"beneficiarios.create":1,"beneficiarios.delete":1,"beneficiarios.view":1,"beneficiarios.update":1,"organizaciones.create":1,"organizaciones.delete":1,"organizaciones.view":1,"organizaciones.update":1,"anos_fiscales.create":1,"anos_fiscales.delete":1,"anos_fiscales.view":1,"anos_fiscales.update":1,"beneficiarios_organizaciones.create":1,"beneficiarios_organizaciones.delete":1,"beneficiarios_organizaciones.view":1,"beneficiarios_organizaciones.update":1,"programas.create":1,"programas.delete":1,"programas.view":1,"programas.update":1,"inscripciones.create":1,"inscripciones.delete":1,"inscripciones.view":1,"inscripciones.update":1}', '2015-06-10 12:53:35', '2015-06-10 12:53:35'),
(2, 'Encargado de Dirección', '{"beneficiarios.create": 1,"beneficiarios.delete": 1,"beneficiarios.view": 1,"beneficiarios.update": 1,"organizaciones.create": 1,"organizaciones.delete": 1,"organizaciones.view": 1,"organizaciones.update": 1,"anos_fiscales.view": 1,"beneficiarios_organizaciones.create": 1,"beneficiarios_organizaciones.delete": 1,"beneficiarios_organizaciones.view": 1,"beneficiarios_organizaciones.update": 1,"programas.create": 1,"programas.delete": 1,"programas.view": 1,"programas.update": 1,"inscripciones.create": 1,"inscripciones.delete": 1,"inscripciones.view": 1,"inscripciones.update": 1}', '2015-06-10 10:00:00', '2015-06-10 10:00:00'),
(3, 'Encargado de Dependencia', '{"usuarios.create":1,"usuarios.view":1,"usuarios.update":1,"direcciones.create":1,"direcciones.delete":1,"direcciones.view":1,"direcciones.update":1,"beneficiarios.create":1,"beneficiarios.delete":1,"beneficiarios.view":1,"beneficiarios.update":1,"organizaciones.create":1,"organizaciones.delete":1,"organizaciones.view":1,"organizaciones.update":1,"anos_fiscales.view":1,"beneficiarios_organizaciones.create":1,"beneficiarios_organizaciones.delete":1,"beneficiarios_organizaciones.view":1,"beneficiarios_organizaciones.update":1,"programas.create":1,"programas.delete":1,"programas.view":1,"programas.update":1,"inscripciones.create":1,"inscripciones.delete":1,"inscripciones.view":1,"inscripciones.update":1}\n', '2015-06-10 10:00:00', '2015-06-10 10:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2012_12_06_225921_migration_cartalyst_sentry_install_users', 1),
('2012_12_06_225929_migration_cartalyst_sentry_install_groups', 1),
('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot', 1),
('2012_12_06_225988_migration_cartalyst_sentry_install_throttle', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizacion`
--

CREATE TABLE IF NOT EXISTS `organizacion` (
  `id_organizacion` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `contacto` varchar(255) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `correo` varchar(255) NOT NULL,
  `estado` enum('Activo','Vetado') NOT NULL DEFAULT 'Activo',
  `creacion` datetime NOT NULL,
  `RFC` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `organizacion`
--

INSERT INTO `organizacion` (`id_organizacion`, `nombre`, `razon_social`, `direccion`, `codigo_postal`, `contacto`, `telefono`, `correo`, `estado`, `creacion`, `RFC`) VALUES
(1, 'Tecnicomp', 'Soporte Zacatecas S.A.', 'Privada del Cipres No. 5, Colonia Alamo, Zacatecas, Zac.', '99400', 'Eduardo Silva Gómez', '4921004747', 'ed.silva5@sopzac.com', 'Vetado', '2015-06-09 22:21:22', 'ACA845612JT9'),
(2, 'COMTEK', 'Comercial Tecnológica S.A. de C.V.', 'Calle Moras No.56 Colonia Huertas, Jiménez del Téul, Zacatecas', '84500', 'Paula Andrea De la Torre Contreras', '4981236598', 'pau4torre@comtek.com', 'Activo', '2015-06-09 22:27:02', 'COT951212CB5'),
(3, 'EducarTI', 'Asesores Jimgo', 'Calle puebla No. 6, Col. San Pedro, Río Grande, Zacatecas.', '56894', 'Carlos Del Río Campa', '4991235487', 'educarti@yahoo.com', 'Activo', '2015-06-09 22:36:11', 'AGO920212BV2'),
(4, 'Arroba Café', 'Servicios de TI S.A.', 'Calle America, Col. Deportiva, Huanusco, Zacatecas', '98400', 'Juan Ignacio Cortéz Ruvalcaba', '4904562121', 'j.cortez4@arroba.com', 'Activo', '2015-06-09 22:48:22', 'JEF930612NM2'),
(5, 'Enerteka', 'Energías Alternas Rodríguez', 'Calle Reforma No. 222 Colonia Centro, Juan Aldama, Zacatecas', '56800', 'Sebastian Gurrola Pérez', '4975037841', 'enerteka@etek.com', 'Activo', '2015-06-09 22:53:19', 'JIO951212NM1'),
(6, 'ConoNet', 'Soporte a Redes Fuma S.A. de C.V', 'Calle Moctezuma No. 32, Colonia Alamos, Concepción del Oro, Zacatecas', '96200', 'Juan Francisco Ávila Saldivar', '4961022541', 'admin.info@cononet.com', 'Activo', '2015-06-09 23:01:28', 'ASD565478'),
(7, 'PLATE ZONE', 'PLATING TECH ZONE S. DE R. L. MI.', 'LAS AGUILAS 10, LA FE, GUADALUPE, ZAC.', '99800', 'Carlos Alberto Zárate Yépez', '4921205621', 'adminplate@tchzone.com', 'Activo', '2015-06-10 20:11:54', 'PTZ071210Q65'),
(8, 'EPIC TECHNO', 'EPIC TECHNOLOGIES ASOCIADOS', 'CAMPO 15, LA HONDA, MIGUEL AUZA, ZAC.', '98336', 'Fabio Alexander Florez García', '4972154568', 'admin@epictech.com', 'Vetado', '2015-06-10 21:06:24', 'ETC124587OI4'),
(9, 'VENUS KEY', 'VENUS KEY PROJECTS S.A.', 'Panamericana km 725.5 1 6, Lindavista, Fresnillo, Zac.', '98620', 'Álvaro de Jesús Bocanumenth Puerta', '4935208741', 'bocanum@gmail.com', 'Vetado', '2015-06-10 21:10:15', 'VKP140612DF7'),
(10, 'SUNPRINT', 'SUN PRINTING SOLUTIONS', 'Las Águilas 10, La Fe, Guadalupe, Zac.', '98652', 'Ángel Gabriel Arrubla Ortiz', '4921052014', 'gabarub@hotmail.com', 'Activo', '2015-06-10 21:18:00', 'SPR211612HY7'),
(11, 'BURNSYS', 'BURNER SYSTEMS S. A.', 'Morelos 15, Centro, Concepción del Oro, Zac.', '98200', 'Beatriz Elena Puerta Bolívar', '4982006385', 'info.burner4@gmail.com', 'Activo', '2015-06-10 21:26:49', 'BSI920218E33'),
(12, 'CAMPO Y VALLE', 'CAMPO Y VALLE, S.A. DE C.V.', 'CLL JUAN ALDAMA 313, CENTRO, SOMBRERETE, ZAC.', '99100', 'Lida Patricia Giraldo Morales', '4991201474', 'giraldomor@hotmail.com', 'Activo', '2015-06-10 22:16:02', 'CVE061241HG7'),
(13, 'CUANDA', 'CUANDA, S.A. DE C.V.', 'AMERICAS 4, TEPECHITLAN, ZACATECAS', '99750', 'Gonzalo López Gaviria', '4915847733', 'admin@cuanda.com', 'Activo', '2015-06-10 22:34:13', 'CDA830615IU8'),
(14, 'INVENSYS', 'INVENSYS MC CONTROLES', 'EMILIO CARRANZA 20, VALLE VERDE, TLALTENANGO DE SANCHEZ ROMAN', '99970', 'Julio Cesar Rodríguez Monsalve', '4962585444', 'monsalv23@gmail.com', 'Activo', '2015-06-10 22:43:16', 'INV451278FG4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizacion_programa`
--

CREATE TABLE IF NOT EXISTS `organizacion_programa` (
  `id_organizacion_programa` int(11) NOT NULL,
  `id_organizacion` int(11) NOT NULL,
  `id_programa` int(11) NOT NULL,
  `id_direccion` int(11) NOT NULL,
  `finalidad` enum('Cumplida','En Proceso') NOT NULL DEFAULT 'En Proceso',
  `comentarios` text,
  `inscripcion` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `organizacion_programa`
--

INSERT INTO `organizacion_programa` (`id_organizacion_programa`, `id_organizacion`, `id_programa`, `id_direccion`, `finalidad`, `comentarios`, `inscripcion`) VALUES
(1, 4, 3, 3, 'Cumplida', 'Comentarios', '2015-06-10 16:46:35'),
(2, 4, 4, 2, 'Cumplida', 'Comentarios', '2015-06-10 18:00:10'),
(3, 1, 4, 2, 'Cumplida', '', '2015-06-10 20:02:18'),
(4, 7, 4, 2, 'En Proceso', '', '2015-06-10 20:45:15'),
(5, 6, 1, 1, 'En Proceso', '', '2015-06-10 20:45:41'),
(6, 3, 2, 1, 'Cumplida', '', '2015-06-10 20:47:07'),
(7, 2, 6, 2, 'En Proceso', '', '2015-06-10 20:49:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE IF NOT EXISTS `programa` (
  `id_programa` int(11) NOT NULL,
  `id_ano` int(11) NOT NULL,
  `id_dependencia` int(11) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `convocatoria` varchar(1000) DEFAULT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `creacion` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id_programa`, `id_ano`, `id_dependencia`, `clave`, `descripcion`, `convocatoria`, `estado`, `creacion`) VALUES
(1, 1, 1, 'PROSOFT2015', 'Programa para el Desarrollo de la Industria del Software', 'Convocatoria2015.pdf', 'Activo', '2015-06-09 23:54:01'),
(2, 2, 2, 'PROEDUIT2015', 'Programa Educativo TI', 'ConvocatoriaProeduit2015.pdf', 'Activo', '2015-06-10 00:01:46'),
(3, 1, 3, 'TSUMAR2015', 'Apoyo para las micro empresas a través de la mejora en su infraestructura', 'CONVTSUMAR2015.pdf', 'Activo', '2015-06-10 12:17:10'),
(4, 1, 3, 'MICROE2015', 'Programa de Apoyo para pequeñas y medianas empresas', 'MICROE2015.pdf', 'Activo', '2015-06-10 16:30:49'),
(5, 1, 2, 'PROMAJOVEN', 'Beca', 'Convocatoria2015.pdf', 'Activo', '2015-06-10 18:08:56'),
(6, 4, 1, 'MiPYMEs', 'Otorgamiento De Apoyos Para El Desarrollo Y Adquisición De Franquicias', 'CONV_MiPYMEs2013.pdf', 'Activo', '2015-06-10 20:32:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 1, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(2, 4, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `num_empleado` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`, `num_empleado`) VALUES
(1, 'admin@sezac.org.mx', '$2y$10$96awm.updSg6pOYHHz6fjO5Yat2f7jxXEhCCyhA7uuDhgMlgjvnBW', NULL, 1, NULL, '2015-06-10 12:54:52', '2015-06-11 08:11:37', '$2y$10$uKVaXiExJuSiyfaSjjxgA.lJHTfg9AB5yOZw/hqliCM8Jskux2xBu', NULL, 'José Arturo', 'Mora Soto', '2015-06-10 12:54:52', '2015-06-11 08:11:37', '1'),
(2, 'juan@gmail.com', '$2y$10$aAonovYdFfCy1BrqOIe8J.zpC1Dac2fv2Syu0zCaIkOUQ0hhHhGIa', NULL, 0, NULL, '2015-06-11 01:55:12', NULL, NULL, NULL, 'Juan', 'Pérez', '2015-06-09 01:55:12', '2015-06-11 08:42:10', '2'),
(4, 'martha@gmail.com', '$2y$10$0JgT5he2XUButJRK39Jh6eKmVwTHWrRFaaqCN0PYv8tl28lgiQm5G', NULL, 1, NULL, '2015-06-11 07:10:45', '2015-06-11 07:46:30', '$2y$10$kHpTNbO0KOZ7rMAQ2gaxAepYjpSe5v2Xp/IvMxq1nO.haYYYL9WAy', NULL, 'Martha Jesus', 'Lopez', '2015-06-11 07:10:45', '2015-06-11 07:46:39', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` (`user_id`, `group_id`) VALUES
(1, 1),
(2, 1),
(4, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ano`
--
ALTER TABLE `ano`
  ADD PRIMARY KEY (`id_ano`);

--
-- Indices de la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  ADD PRIMARY KEY (`id_beneficiario`);

--
-- Indices de la tabla `beneficiario_organizacion`
--
ALTER TABLE `beneficiario_organizacion`
  ADD PRIMARY KEY (`id_beneficiario_organizacion`), ADD KEY `FK_beneficiario3` (`id_beneficiario`), ADD KEY `FK_organizacion` (`id_organizacion`);

--
-- Indices de la tabla `beneficiario_programa`
--
ALTER TABLE `beneficiario_programa`
  ADD PRIMARY KEY (`id_beneficiario_programa`), ADD KEY `FK_beneficiario` (`id_beneficiario`), ADD KEY `FK_programa` (`id_programa`), ADD KEY `FK_direccion` (`id_direccion`);

--
-- Indices de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  ADD PRIMARY KEY (`id_dependencia`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`id_direccion`), ADD KEY `FK_dependencia` (`id_dependencia`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Indices de la tabla `organizacion`
--
ALTER TABLE `organizacion`
  ADD PRIMARY KEY (`id_organizacion`);

--
-- Indices de la tabla `organizacion_programa`
--
ALTER TABLE `organizacion_programa`
  ADD PRIMARY KEY (`id_organizacion_programa`), ADD KEY `FK_organizacion2` (`id_organizacion`), ADD KEY `FK_programa2` (`id_programa`), ADD KEY `FK_direccion2` (`id_direccion`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`id_programa`), ADD KEY `FK_dependencia3` (`id_dependencia`), ADD KEY `FK_ano3` (`id_ano`);

--
-- Indices de la tabla `throttle`
--
ALTER TABLE `throttle`
  ADD PRIMARY KEY (`id`), ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD KEY `users_activation_code_index` (`activation_code`), ADD KEY `users_reset_password_code_index` (`reset_password_code`);

--
-- Indices de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ano`
--
ALTER TABLE `ano`
  MODIFY `id_ano` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  MODIFY `id_beneficiario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `beneficiario_organizacion`
--
ALTER TABLE `beneficiario_organizacion`
  MODIFY `id_beneficiario_organizacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `beneficiario_programa`
--
ALTER TABLE `beneficiario_programa`
  MODIFY `id_beneficiario_programa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `dependencia`
--
ALTER TABLE `dependencia`
  MODIFY `id_dependencia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `organizacion`
--
ALTER TABLE `organizacion`
  MODIFY `id_organizacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `organizacion_programa`
--
ALTER TABLE `organizacion_programa`
  MODIFY `id_organizacion_programa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `throttle`
--
ALTER TABLE `throttle`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `beneficiario_organizacion`
--
ALTER TABLE `beneficiario_organizacion`
ADD CONSTRAINT `FK_beneficiario3` FOREIGN KEY (`id_beneficiario`) REFERENCES `beneficiario` (`id_beneficiario`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_organizacion` FOREIGN KEY (`id_organizacion`) REFERENCES `organizacion` (`id_organizacion`) ON DELETE CASCADE;

--
-- Filtros para la tabla `beneficiario_programa`
--
ALTER TABLE `beneficiario_programa`
ADD CONSTRAINT `FK_beneficiario` FOREIGN KEY (`id_beneficiario`) REFERENCES `beneficiario` (`id_beneficiario`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_direccion` FOREIGN KEY (`id_direccion`) REFERENCES `direccion` (`id_direccion`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_programa` FOREIGN KEY (`id_programa`) REFERENCES `programa` (`id_programa`) ON DELETE CASCADE;

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
ADD CONSTRAINT `FK_dependencia` FOREIGN KEY (`id_dependencia`) REFERENCES `dependencia` (`id_dependencia`) ON DELETE CASCADE;

--
-- Filtros para la tabla `organizacion_programa`
--
ALTER TABLE `organizacion_programa`
ADD CONSTRAINT `FK_direccion2` FOREIGN KEY (`id_direccion`) REFERENCES `direccion` (`id_direccion`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_organizacion2` FOREIGN KEY (`id_organizacion`) REFERENCES `organizacion` (`id_organizacion`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_programa2` FOREIGN KEY (`id_programa`) REFERENCES `programa` (`id_programa`) ON DELETE CASCADE;

--
-- Filtros para la tabla `programa`
--
ALTER TABLE `programa`
ADD CONSTRAINT `FK_ano3` FOREIGN KEY (`id_ano`) REFERENCES `ano` (`id_ano`) ON DELETE CASCADE,
ADD CONSTRAINT `FK_dependencia3` FOREIGN KEY (`id_dependencia`) REFERENCES `dependencia` (`id_dependencia`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
