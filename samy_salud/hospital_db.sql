-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-07-2026 a las 05:17:55
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospital_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `fecha_cita` datetime NOT NULL,
  `motivo` varchar(150) DEFAULT NULL,
  `estado` enum('Programada','Atendida','Cancelada') NOT NULL DEFAULT 'Programada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_paciente`, `id_doctor`, `id_habitacion`, `fecha_cita`, `motivo`, `estado`) VALUES
(1, 201, 3, 12, '2026-10-28 13:36:00', 'Dolor abdominal', 'Cancelada'),
(2, 103, 3, 9, '2026-02-02 18:14:00', 'Control de presion', 'Programada'),
(3, 56, 3, 8, '2026-04-28 09:24:00', 'Control de presion', 'Programada'),
(4, 28, 3, 8, '2026-11-27 13:10:00', 'Seguimiento', 'Atendida'),
(5, 192, 3, 19, '2026-04-22 12:44:00', 'Dolor de cabeza', 'Atendida'),
(6, 87, 2, 20, '2026-11-06 16:46:00', 'Dolor abdominal', 'Programada'),
(7, 115, 3, 10, '2026-08-13 12:59:00', 'Dolor de espalda', 'Programada'),
(8, 239, 3, 19, '2026-11-11 08:14:00', 'Consulta general', 'Atendida'),
(9, 102, 1, 14, '2026-07-09 09:13:00', 'Alergia', 'Cancelada'),
(10, 23, 5, 17, '2026-06-07 18:31:00', 'Fiebre', 'Cancelada'),
(11, 181, 4, 9, '2026-08-05 12:08:00', 'Dolor abdominal', 'Cancelada'),
(12, 225, 2, 6, '2026-09-18 12:47:00', 'Alergia', 'Atendida'),
(13, 213, 3, 5, '2026-10-13 13:14:00', 'Revision de rutina', 'Cancelada'),
(14, 6, 5, 11, '2026-08-03 08:55:00', 'Dolor de cabeza', 'Programada'),
(15, 43, 2, 7, '2026-11-06 18:27:00', 'Alergia', 'Programada'),
(16, 157, 5, 14, '2026-07-13 17:29:00', 'Dolor de espalda', 'Cancelada'),
(17, 76, 3, 11, '2026-09-28 08:43:00', 'Dolor de cabeza', 'Cancelada'),
(18, 177, 3, 7, '2026-09-25 12:49:00', 'Seguimiento', 'Programada'),
(19, 222, 1, 2, '2026-05-14 10:29:00', 'Consulta general', 'Cancelada'),
(20, 86, 1, 1, '2026-12-09 16:48:00', 'Revision de rutina', 'Cancelada'),
(21, 103, 4, 8, '2026-02-28 18:19:00', 'Dolor de espalda', 'Programada'),
(22, 227, 3, 20, '2026-04-05 13:48:00', 'Revision de rutina', 'Atendida'),
(23, 101, 1, 19, '2026-09-01 17:20:00', 'Chequeo anual', 'Programada'),
(24, 30, 5, 14, '2026-02-12 12:15:00', 'Consulta general', 'Programada'),
(25, 210, 4, 18, '2026-10-03 09:46:00', 'Chequeo anual', 'Programada'),
(26, 169, 27, 14, '2026-03-14 14:40:00', 'Chequeo de rutina', 'Atendida'),
(27, 128, 27, 11, '2026-04-26 15:51:00', 'Curacion de herida', 'Programada'),
(28, 123, 27, 5, '2026-09-17 11:50:00', 'Consulta general', 'Programada'),
(29, 123, 27, 7, '2026-06-19 14:04:00', 'Valoracion prequirurgica', 'Programada'),
(30, 132, 27, 18, '2026-04-23 08:27:00', 'Control', 'Cancelada'),
(31, 117, 28, 6, '2026-08-02 13:34:00', 'Segunda opinion', 'Cancelada'),
(32, 24, 28, 4, '2026-02-21 13:01:00', 'Valoracion prequirurgica', 'Cancelada'),
(33, 116, 28, 12, '2026-02-04 08:29:00', 'Valoracion prequirurgica', 'Cancelada'),
(34, 49, 28, 9, '2026-12-11 14:31:00', 'Valoracion prequirurgica', 'Programada'),
(35, 164, 28, 10, '2026-11-02 15:55:00', 'Seguimiento de cirugia', 'Programada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `id_doctor` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `especialidad` varchar(60) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `cedula_prof` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`id_doctor`, `nombre`, `apellido`, `especialidad`, `telefono`, `cedula_prof`) VALUES
(1, 'ignaz semmelwers', 'semelwels', 'Obstetricia', '5551001001', '1000001'),
(2, 'Edward jenner', 'jener', 'inmunologia', '5512368952', '1000002'),
(3, 'Rene', 'Favoloro', 'cirugia', '5548798652', '1000003'),
(4, 'Christiaan', 'Barnard', 'Cirugia', '5547821658', '1000004'),
(5, 'paola', 'amaro', 'general', '5584789652', '1000005'),
(7, 'Lucia', 'Rojas', 'Cardiologia', '5572498494', '8580488'),
(8, 'Paula', 'Morales', 'Pediatria', '5535488219', '4098086'),
(9, 'Paula', 'Mendoza', 'Traumatologia', '5594541427', '4123476'),
(10, 'Carlos', 'Castro', 'Ginecologia', '5550721828', '3378927'),
(11, 'Maria', 'Rojas', 'Medicina General', '5595154811', '1702635'),
(12, 'Alejandro', 'Ortiz', 'Dermatologia', '5570799941', '3642312'),
(13, 'Alejandro', 'Garcia', 'Neurologia', '5580918133', '2059731'),
(14, 'Luis', 'Martinez', 'Oncologia', '5535529320', '5059130'),
(15, 'Lucia', 'Gomez', 'Urologia', '5569127085', '4276948'),
(16, 'Paula', 'Sanchez', 'Psiquiatria', '5595938498', '5935044'),
(17, 'Ricardo', 'Garcia', 'Oftalmologia', '5598912471', '2425874'),
(18, 'Lucia', 'Rivera', 'Endocrinologia', '5564596917', '2395922'),
(19, 'Camila', 'Gomez', 'Gastroenterologia', '5540825235', '9604776'),
(20, 'Andres', 'Garcia', 'Reumatologia', '5519425238', '2810713'),
(21, 'Renata', 'Hernandez', 'Neumologia', '5549044325', '7484621'),
(22, 'Maria', 'Garcia', 'Nefrologia', '5510073140', '4581963'),
(23, 'Valentina', 'Martinez', 'Otorrinolaringologia', '5573080624', '7299227'),
(24, 'Renata', 'Vargas', 'Hematologia', '5519803040', '4330111'),
(25, 'Maria', 'Diaz', 'Anestesiologia', '5554638887', '1254166'),
(26, 'Fernando', 'Hernandez', 'Geriatria', '5528065232', '5133703'),
(27, 'Carlos', 'Lizarraga', 'Cirugia General', '5551234567', '7654321'),
(28, 'Escuela', 'de Medicina', 'Medicina General', '5557654321', '1234567');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id_habitacion` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `tipo` enum('General','Privada','Terapia Intensiva','Urgencias') NOT NULL,
  `estado` enum('Disponible','Ocupada','Mantenimiento') NOT NULL DEFAULT 'Disponible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_habitacion`, `numero`, `tipo`, `estado`) VALUES
(1, '101', 'General', 'Disponible'),
(2, '102', 'Terapia Intensiva', 'Disponible'),
(3, '103', 'Privada', 'Ocupada'),
(4, '104', 'General', 'Disponible'),
(5, '105', 'General', 'Disponible'),
(6, '106', 'Privada', 'Disponible'),
(7, '107', 'General', 'Disponible'),
(8, '108', 'Urgencias', 'Disponible'),
(9, '109', 'Terapia Intensiva', 'Ocupada'),
(10, '110', 'General', 'Ocupada'),
(11, '111', 'Privada', 'Ocupada'),
(12, '112', 'Terapia Intensiva', 'Disponible'),
(13, '113', 'Privada', 'Mantenimiento'),
(14, '114', 'Terapia Intensiva', 'Disponible'),
(15, '115', 'Urgencias', 'Disponible'),
(16, '116', 'Terapia Intensiva', 'Ocupada'),
(17, '117', 'General', 'Ocupada'),
(18, '118', 'General', 'Mantenimiento'),
(19, '119', 'Urgencias', 'Disponible'),
(20, '120', 'Terapia Intensiva', 'Ocupada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` enum('M','F','Otro') NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `tipo_sangre` varchar(5) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nombre`, `apellido`, `fecha_nacimiento`, `sexo`, `telefono`, `direccion`, `tipo_sangre`, `fecha_registro`) VALUES
(1, 'Regina', 'Ramirez', '1995-11-02', 'M', '5581924865', 'Calle Juarez #188', 'O+', '2026-07-15 02:25:47'),
(2, 'Veronica', 'Flores', '1949-02-14', 'F', '5519375836', 'Calle Morelos #47', 'AB+', '2026-07-15 02:25:47'),
(3, 'Carlos', 'Contreras', '2017-02-08', 'Otro', '5594212661', 'Calle Allende #32', 'AB+', '2026-07-15 02:25:47'),
(4, 'Carlos', 'Sanchez', '1950-09-28', 'M', '5548870700', 'Calle Madero #74', 'O-', '2026-07-15 02:25:47'),
(5, 'Adriana', 'Diaz', '2016-11-06', 'M', '5588061052', 'Calle Allende #97', 'B-', '2026-07-15 02:25:47'),
(6, 'Valentina', 'Rojas', '1953-10-02', 'Otro', '5537643310', 'Calle Colon #273', 'AB+', '2026-07-15 02:25:47'),
(7, 'Regina', 'Castro', '2019-08-12', 'F', '5543343251', 'Calle Hidalgo #125', 'O-', '2026-07-15 02:25:47'),
(8, 'Adriana', 'Diaz', '2012-08-11', 'Otro', '5570241505', 'Calle Independencia #38', 'O-', '2026-07-15 02:25:47'),
(9, 'Veronica', 'Vargas', '1966-06-05', 'F', '5566599395', 'Calle Reforma #40', 'B-', '2026-07-15 02:25:47'),
(10, 'Sebastian', 'Herrera', '1989-10-16', 'Otro', '5571230843', 'Calle Juarez #48', 'B+', '2026-07-15 02:25:47'),
(11, 'Patricia', 'Herrera', '1953-01-24', 'Otro', '5551554798', 'Calle Allende #229', 'B+', '2026-07-15 02:25:47'),
(12, 'Fernanda', 'Chavez', '1989-01-15', 'F', '5532555071', 'Calle Allende #60', 'AB-', '2026-07-15 02:25:47'),
(13, 'Carlos', 'Flores', '1981-03-24', 'M', '5563404922', 'Calle Madero #255', 'O-', '2026-07-15 02:25:47'),
(14, 'Isabella', 'Castro', '1996-09-09', 'M', '5567783637', 'Calle 5 de Mayo #143', 'AB+', '2026-07-15 02:25:47'),
(15, 'Ximena', 'Romero', '1993-04-05', 'M', '5533651543', 'Calle Hidalgo #119', 'A-', '2026-07-15 02:25:47'),
(16, 'Ana', 'Mendoza', '2020-03-09', 'F', '5510549434', 'Calle Hidalgo #215', 'B-', '2026-07-15 02:25:47'),
(17, 'Hector', 'Morales', '1985-03-23', 'Otro', '5592891895', 'Calle Reforma #234', 'AB+', '2026-07-15 02:25:47'),
(18, 'Roberto', 'Ortiz', '1995-02-16', 'Otro', '5563746500', 'Calle Reforma #98', 'O-', '2026-07-15 02:25:47'),
(19, 'Fernando', 'Castro', '1965-02-11', 'Otro', '5517056578', 'Calle Juarez #1', 'A+', '2026-07-15 02:25:47'),
(20, 'Alejandra', 'Hernandez', '1991-10-01', 'M', '5537910936', 'Calle Allende #193', 'A+', '2026-07-15 02:25:47'),
(21, 'Paula', 'Cruz', '2022-06-16', 'M', '5525482486', 'Calle Colon #239', 'AB-', '2026-07-15 02:25:47'),
(22, 'Patricia', 'Diaz', '1955-03-04', 'Otro', '5555987803', 'Calle Independencia #246', 'A+', '2026-07-15 02:25:47'),
(23, 'Arturo', 'Garcia', '1971-09-12', 'M', '5582903368', 'Calle Reforma #271', 'B+', '2026-07-15 02:25:47'),
(24, 'Jorge', 'Herrera', '1978-09-12', 'M', '5557740731', 'Calle Morelos #273', 'B-', '2026-07-15 02:25:47'),
(25, 'Lucia', 'Reyes', '1969-04-27', 'F', '5540432459', 'Calle Morelos #266', 'AB-', '2026-07-15 02:25:47'),
(26, 'Ximena', 'Medina', '1948-01-26', 'F', '5573382988', 'Calle Independencia #100', 'B-', '2026-07-15 02:25:47'),
(27, 'Monica', 'Vazquez', '1989-06-03', 'M', '5523711300', 'Calle Morelos #241', 'A-', '2026-07-15 02:25:47'),
(28, 'Sebastian', 'Flores', '2006-10-20', 'M', '5574353833', 'Calle Zaragoza #44', 'O-', '2026-07-15 02:25:47'),
(29, 'Fernanda', 'Vazquez', '1970-08-06', 'F', '5595341298', 'Calle Zaragoza #45', 'AB+', '2026-07-15 02:25:47'),
(30, 'Raul', 'Ortiz', '1955-12-06', 'M', '5527050801', 'Calle Reforma #78', 'AB-', '2026-07-15 02:25:47'),
(31, 'Andres', 'Reyes', '2021-08-22', 'F', '5530926211', 'Calle 5 de Mayo #281', 'A+', '2026-07-15 02:25:47'),
(32, 'Luis', 'Garcia', '1958-09-24', 'M', '5568224916', 'Calle Morelos #109', 'O+', '2026-07-15 02:25:47'),
(33, 'Paula', 'Flores', '1982-09-08', 'Otro', '5553753544', 'Calle Independencia #279', 'AB+', '2026-07-15 02:25:47'),
(34, 'Camila', 'Martinez', '1990-08-22', 'Otro', '5579358465', 'Calle Madero #257', 'A+', '2026-07-15 02:25:47'),
(35, 'Alejandra', 'Ramirez', '2012-09-01', 'F', '5534576324', 'Calle Allende #3', 'A+', '2026-07-15 02:25:47'),
(36, 'Miguel', 'Ramirez', '2005-10-24', 'M', '5584688894', 'Calle Reforma #167', 'AB-', '2026-07-15 02:25:47'),
(37, 'Valentina', 'Chavez', '2016-01-08', 'M', '5547167180', 'Calle Reforma #51', 'AB-', '2026-07-15 02:25:47'),
(38, 'Ivan', 'Garcia', '1953-08-11', 'Otro', '5577854192', 'Calle Allende #263', 'A-', '2026-07-15 02:25:47'),
(39, 'Emilio', 'Castro', '2010-09-26', 'F', '5578149300', 'Calle Morelos #268', 'B+', '2026-07-15 02:25:47'),
(40, 'Ivan', 'Chavez', '1970-08-05', 'F', '5526323822', 'Calle Madero #227', 'B-', '2026-07-15 02:25:47'),
(41, 'Sofia', 'Romero', '1975-07-03', 'M', '5599855030', 'Calle Independencia #63', 'A+', '2026-07-15 02:25:47'),
(42, 'Emiliano', 'Ramirez', '1977-03-15', 'M', '5522633303', 'Calle Madero #250', 'A+', '2026-07-15 02:25:47'),
(43, 'Lucia', 'Torres', '2000-09-13', 'F', '5566542771', 'Calle Morelos #183', 'B-', '2026-07-15 02:25:47'),
(44, 'Jorge', 'Medina', '1991-01-11', 'Otro', '5571561748', 'Calle Colon #10', 'AB+', '2026-07-15 02:25:47'),
(45, 'Sebastian', 'Guerrero', '1982-09-03', 'M', '5540675978', 'Calle Juarez #44', 'B+', '2026-07-15 02:25:47'),
(46, 'Emilio', 'Martinez', '1968-05-25', 'M', '5566673996', 'Calle Independencia #208', 'A+', '2026-07-15 02:25:47'),
(47, 'Alejandra', 'Delgado', '2010-10-16', 'Otro', '5553895707', 'Calle Juarez #143', 'O+', '2026-07-15 02:25:47'),
(48, 'Miguel', 'Vargas', '1954-05-01', 'Otro', '5521887116', 'Calle Independencia #43', 'A-', '2026-07-15 02:25:47'),
(49, 'Sofia', 'Rivera', '1960-08-01', 'F', '5584231009', 'Calle Madero #138', 'A+', '2026-07-15 02:25:47'),
(50, 'Maria', 'Guerrero', '1975-02-06', 'F', '5516761851', 'Calle Hidalgo #104', 'B+', '2026-07-15 02:25:47'),
(51, 'Alejandro', 'Guerrero', '1971-05-15', 'Otro', '5533877318', 'Calle Independencia #178', 'O+', '2026-07-15 02:25:47'),
(52, 'Paula', 'Martinez', '1946-01-24', 'Otro', '5583960561', 'Calle Morelos #264', 'AB-', '2026-07-15 02:25:47'),
(53, 'Ricardo', 'Delgado', '2002-02-22', 'Otro', '5568005893', 'Calle Colon #280', 'AB+', '2026-07-15 02:25:47'),
(54, 'Veronica', 'Diaz', '1972-04-11', 'M', '5595359381', 'Calle Hidalgo #208', 'B-', '2026-07-15 02:25:47'),
(55, 'Carlos', 'Contreras', '1961-01-03', 'Otro', '5544305229', 'Calle Madero #84', 'O+', '2026-07-15 02:25:47'),
(56, 'Jorge', 'Romero', '1993-09-22', 'F', '5590366678', 'Calle Morelos #151', 'O+', '2026-07-15 02:25:47'),
(57, 'Raul', 'Torres', '1965-05-15', 'M', '5545331886', 'Calle Zaragoza #169', 'B-', '2026-07-15 02:25:47'),
(58, 'Ricardo', 'Martinez', '1984-04-12', 'M', '5510143467', 'Calle Zaragoza #196', 'O-', '2026-07-15 02:25:47'),
(59, 'Patricia', 'Rivera', '2009-11-07', 'M', '5577744470', 'Calle Reforma #47', 'B+', '2026-07-15 02:25:47'),
(60, 'Jorge', 'Ramirez', '1996-10-02', 'F', '5513019113', 'Calle Independencia #156', 'A-', '2026-07-15 02:25:47'),
(61, 'Jorge', 'Morales', '2012-03-22', 'Otro', '5590068835', 'Calle Madero #167', 'AB-', '2026-07-15 02:25:47'),
(62, 'Andres', 'Diaz', '1963-01-27', 'Otro', '5578851172', 'Calle Madero #259', 'A+', '2026-07-15 02:25:47'),
(63, 'Arturo', 'Aguilar', '2009-10-27', 'M', '5588391409', 'Calle Morelos #44', 'O+', '2026-07-15 02:25:47'),
(64, 'Maria', 'Ramirez', '1991-02-13', 'F', '5584964258', 'Calle Reforma #10', 'A-', '2026-07-15 02:25:47'),
(65, 'Eduardo', 'Rivera', '1945-08-26', 'M', '5577507631', 'Calle 5 de Mayo #48', 'O-', '2026-07-15 02:25:47'),
(66, 'Patricia', 'Rivera', '1954-05-08', 'Otro', '5537543830', 'Calle Morelos #236', 'AB-', '2026-07-15 02:25:47'),
(67, 'Fernanda', 'Lopez', '2006-11-10', 'M', '5592808850', 'Calle Morelos #40', 'A+', '2026-07-15 02:25:47'),
(68, 'Sebastian', 'Rivera', '1983-10-19', 'M', '5511673589', 'Calle Colon #32', 'AB-', '2026-07-15 02:25:47'),
(69, 'Emilio', 'Romero', '1957-12-07', 'Otro', '5575714920', 'Calle Independencia #265', 'B+', '2026-07-15 02:25:47'),
(70, 'Raul', 'Castro', '2004-02-18', 'M', '5551832264', 'Calle Juarez #243', 'O+', '2026-07-15 02:25:47'),
(71, 'Daniela', 'Castro', '1954-09-15', 'F', '5561921906', 'Calle Morelos #108', 'O-', '2026-07-15 02:25:47'),
(72, 'Ruben', 'Lopez', '1963-12-17', 'F', '5558258464', 'Calle Hidalgo #261', 'B+', '2026-07-15 02:25:47'),
(73, 'Diego', 'Herrera', '1991-04-16', 'F', '5562892592', 'Calle Reforma #82', 'O+', '2026-07-15 02:25:47'),
(74, 'Eduardo', 'Romero', '2002-07-10', 'Otro', '5528885403', 'Calle Madero #177', 'AB+', '2026-07-15 02:25:47'),
(75, 'Regina', 'Hernandez', '1987-01-11', 'F', '5563453493', 'Calle Juarez #101', 'O+', '2026-07-15 02:25:47'),
(76, 'Daniela', 'Rivera', '1992-02-13', 'F', '5589077952', 'Calle Juarez #185', 'AB+', '2026-07-15 02:25:47'),
(77, 'Emilio', 'Nunez', '1951-05-04', 'M', '5598849207', 'Calle Independencia #77', 'A-', '2026-07-15 02:25:47'),
(78, 'Emilio', 'Vargas', '2010-06-07', 'F', '5567411315', 'Calle Reforma #205', 'A-', '2026-07-15 02:25:47'),
(79, 'Jorge', 'Martinez', '1997-08-20', 'M', '5596502078', 'Calle Independencia #249', 'O+', '2026-07-15 02:25:47'),
(80, 'Ivan', 'Ramirez', '1966-08-14', 'F', '5547815313', 'Calle Independencia #131', 'B+', '2026-07-15 02:25:47'),
(81, 'Roberto', 'Jimenez', '1975-05-16', 'Otro', '5599775015', 'Calle Madero #62', 'A+', '2026-07-15 02:25:47'),
(82, 'Isabella', 'Lopez', '1971-09-26', 'F', '5583871631', 'Calle Morelos #232', 'B-', '2026-07-15 02:25:47'),
(83, 'Monica', 'Vargas', '1962-09-07', 'M', '5522175495', 'Calle Hidalgo #176', 'O-', '2026-07-15 02:25:47'),
(84, 'Regina', 'Sanchez', '1992-05-26', 'Otro', '5537131018', 'Calle Reforma #212', 'AB+', '2026-07-15 02:25:47'),
(85, 'Gabriela', 'Medina', '2012-04-13', 'F', '5555392851', 'Calle Reforma #256', 'B+', '2026-07-15 02:25:47'),
(86, 'Adriana', 'Cruz', '1961-11-17', 'Otro', '5594507092', 'Calle Morelos #48', 'B+', '2026-07-15 02:25:47'),
(87, 'Ricardo', 'Ortiz', '1996-11-15', 'F', '5551878080', 'Calle Reforma #66', 'O+', '2026-07-15 02:25:47'),
(88, 'Alberto', 'Herrera', '2005-10-16', 'M', '5519816400', 'Calle Madero #271', 'AB-', '2026-07-15 02:25:47'),
(89, 'Monica', 'Sanchez', '1958-04-05', 'M', '5580110724', 'Calle Juarez #235', 'O-', '2026-07-15 02:25:47'),
(90, 'Ivan', 'Aguilar', '1950-01-26', 'M', '5541215933', 'Calle Allende #20', 'B+', '2026-07-15 02:25:47'),
(91, 'Camila', 'Jimenez', '1977-09-21', 'F', '5525050194', 'Calle Juarez #37', 'B+', '2026-07-15 02:25:47'),
(92, 'Arturo', 'Morales', '1969-07-09', 'M', '5590673028', 'Calle Reforma #6', 'B+', '2026-07-15 02:25:47'),
(93, 'Raul', 'Rivera', '1985-11-27', 'M', '5573794252', 'Calle 5 de Mayo #121', 'A-', '2026-07-15 02:25:47'),
(94, 'Luis', 'Vargas', '1984-01-01', 'M', '5576882068', 'Calle Madero #42', 'B+', '2026-07-15 02:25:47'),
(95, 'Lucia', 'Romero', '1999-06-08', 'F', '5514576478', 'Calle Zaragoza #216', 'B-', '2026-07-15 02:25:47'),
(96, 'Roberto', 'Flores', '1945-05-24', 'Otro', '5519050631', 'Calle Morelos #254', 'A-', '2026-07-15 02:25:47'),
(97, 'Alejandro', 'Aguilar', '1969-04-15', 'M', '5545570644', 'Calle Independencia #56', 'AB-', '2026-07-15 02:25:47'),
(98, 'Hector', 'Torres', '1973-08-14', 'Otro', '5517572171', 'Calle Allende #75', 'AB+', '2026-07-15 02:25:47'),
(99, 'Carlos', 'Flores', '1948-10-05', 'F', '5516957919', 'Calle Reforma #95', 'AB+', '2026-07-15 02:25:47'),
(100, 'Monica', 'Chavez', '1985-12-04', 'M', '5532230984', 'Calle Zaragoza #98', 'A+', '2026-07-15 02:25:47'),
(101, 'Arturo', 'Medina', '2004-01-10', 'Otro', '5560817437', 'Calle Zaragoza #170', 'AB-', '2026-07-15 02:25:47'),
(102, 'Isabella', 'Hernandez', '1945-02-09', 'M', '5557173083', 'Calle Madero #64', 'A-', '2026-07-15 02:25:47'),
(103, 'Fernanda', 'Cruz', '1984-07-03', 'M', '5573547269', 'Calle Morelos #191', 'AB-', '2026-07-15 02:25:47'),
(104, 'Renata', 'Gomez', '1991-12-16', 'M', '5594780255', 'Calle Madero #127', 'AB+', '2026-07-15 02:25:47'),
(105, 'Maria', 'Ortiz', '1949-08-03', 'M', '5544496097', 'Calle Morelos #33', 'B-', '2026-07-15 02:25:47'),
(106, 'Emiliano', 'Rivera', '1987-10-02', 'F', '5552477713', 'Calle Independencia #153', 'O+', '2026-07-15 02:25:47'),
(107, 'Claudia', 'Delgado', '1953-01-27', 'M', '5524396377', 'Calle Colon #239', 'AB+', '2026-07-15 02:25:47'),
(108, 'Paula', 'Delgado', '2000-08-05', 'F', '5534553688', 'Calle Reforma #156', 'A+', '2026-07-15 02:25:47'),
(109, 'Claudia', 'Sanchez', '1986-06-15', 'F', '5589955780', 'Calle Juarez #263', 'A-', '2026-07-15 02:25:47'),
(110, 'Roberto', 'Aguilar', '1965-04-14', 'M', '5597180588', 'Calle Reforma #247', 'B-', '2026-07-15 02:25:47'),
(111, 'Isabella', 'Vargas', '1958-02-09', 'Otro', '5521285375', 'Calle Morelos #50', 'AB+', '2026-07-15 02:25:47'),
(112, 'Eduardo', 'Herrera', '2002-03-08', 'M', '5565947402', 'Calle Colon #121', 'O-', '2026-07-15 02:25:47'),
(113, 'Daniela', 'Diaz', '1980-10-09', 'F', '5544098886', 'Calle Independencia #102', 'AB-', '2026-07-15 02:25:47'),
(114, 'Ricardo', 'Torres', '1976-04-05', 'F', '5587615529', 'Calle Morelos #168', 'O-', '2026-07-15 02:25:47'),
(115, 'Roberto', 'Rivera', '1976-09-17', 'M', '5597193292', 'Calle Juarez #238', 'O+', '2026-07-15 02:25:47'),
(116, 'Valentina', 'Garcia', '2005-04-27', 'F', '5560180826', 'Calle Reforma #151', 'A-', '2026-07-15 02:25:47'),
(117, 'Diego', 'Martinez', '1969-10-27', 'Otro', '5536059929', 'Calle Juarez #191', 'A+', '2026-07-15 02:25:47'),
(118, 'Monica', 'Reyes', '1978-11-01', 'M', '5595558069', 'Calle Allende #180', 'A-', '2026-07-15 02:25:47'),
(119, 'Maria', 'Cruz', '1988-03-02', 'M', '5544213934', 'Calle Reforma #105', 'O+', '2026-07-15 02:25:47'),
(120, 'Regina', 'Vargas', '1992-03-20', 'F', '5520460227', 'Calle Morelos #17', 'AB-', '2026-07-15 02:25:47'),
(121, 'Ivan', 'Mendoza', '1953-07-04', 'F', '5599124119', 'Calle 5 de Mayo #80', 'O-', '2026-07-15 02:25:47'),
(122, 'Isabella', 'Ortiz', '1979-07-10', 'Otro', '5551284804', 'Calle Madero #27', 'B+', '2026-07-15 02:25:47'),
(123, 'Adriana', 'Chavez', '1990-07-14', 'M', '5558825909', 'Calle Morelos #201', 'AB+', '2026-07-15 02:25:47'),
(124, 'Fernando', 'Garcia', '2000-03-14', 'M', '5522145096', 'Calle Madero #296', 'B-', '2026-07-15 02:25:47'),
(125, 'Raul', 'Aguilar', '1965-03-01', 'M', '5584027500', 'Calle Hidalgo #204', 'O-', '2026-07-15 02:25:47'),
(126, 'Adriana', 'Reyes', '1992-12-17', 'M', '5529580598', 'Calle Zaragoza #146', 'A+', '2026-07-15 02:25:47'),
(127, 'Arturo', 'Torres', '1953-02-13', 'F', '5536486755', 'Calle Independencia #65', 'O+', '2026-07-15 02:25:47'),
(128, 'Patricia', 'Gomez', '1951-10-21', 'F', '5521582241', 'Calle Allende #83', 'A-', '2026-07-15 02:25:47'),
(129, 'Hector', 'Ortiz', '2023-04-27', 'F', '5534557219', 'Calle Allende #112', 'O+', '2026-07-15 02:25:47'),
(130, 'Roberto', 'Guerrero', '1965-07-12', 'M', '5530061140', 'Calle Morelos #99', 'O+', '2026-07-15 02:25:47'),
(131, 'Ivan', 'Contreras', '1949-11-27', 'F', '5525801589', 'Calle Madero #234', 'B+', '2026-07-15 02:25:47'),
(132, 'Gabriela', 'Diaz', '2019-04-14', 'F', '5598428371', 'Calle Zaragoza #229', 'AB-', '2026-07-15 02:25:47'),
(133, 'Miguel', 'Garcia', '1945-10-16', 'F', '5541574844', 'Calle Colon #235', 'A+', '2026-07-15 02:25:47'),
(134, 'Patricia', 'Ortiz', '1958-02-05', 'F', '5567794020', 'Calle Zaragoza #47', 'AB-', '2026-07-15 02:25:47'),
(135, 'Veronica', 'Guerrero', '1950-01-21', 'M', '5521038203', 'Calle Zaragoza #262', 'O-', '2026-07-15 02:25:47'),
(136, 'Carlos', 'Aguilar', '2009-07-21', 'M', '5513470398', 'Calle Juarez #57', 'A-', '2026-07-15 02:25:47'),
(137, 'Camila', 'Chavez', '2007-05-26', 'M', '5539679134', 'Calle Juarez #180', 'B+', '2026-07-15 02:25:47'),
(138, 'Isabella', 'Gomez', '2023-05-27', 'F', '5529269947', 'Calle Independencia #258', 'AB-', '2026-07-15 02:25:47'),
(139, 'Fernando', 'Morales', '1978-10-17', 'M', '5552825859', 'Calle Zaragoza #19', 'A-', '2026-07-15 02:25:47'),
(140, 'Miguel', 'Ortiz', '1965-11-09', 'Otro', '5553999836', 'Calle Madero #87', 'B+', '2026-07-15 02:25:47'),
(141, 'Diego', 'Aguilar', '2012-01-21', 'F', '5570805810', 'Calle 5 de Mayo #267', 'O-', '2026-07-15 02:25:47'),
(142, 'Paula', 'Rojas', '1995-12-26', 'F', '5545534696', 'Calle Madero #189', 'A+', '2026-07-15 02:25:47'),
(143, 'Emiliano', 'Gomez', '1955-08-08', 'M', '5592594052', 'Calle Reforma #152', 'B+', '2026-07-15 02:25:47'),
(144, 'Alejandro', 'Jimenez', '2019-11-11', 'Otro', '5510240379', 'Calle Reforma #114', 'A+', '2026-07-15 02:25:47'),
(145, 'Daniela', 'Reyes', '2000-07-17', 'F', '5516412435', 'Calle Hidalgo #251', 'A-', '2026-07-15 02:25:47'),
(146, 'Hector', 'Jimenez', '1950-01-02', 'M', '5586117714', 'Calle Zaragoza #156', 'O-', '2026-07-15 02:25:47'),
(147, 'Arturo', 'Cruz', '2013-04-14', 'Otro', '5550420337', 'Calle Allende #69', 'A-', '2026-07-15 02:25:47'),
(148, 'Emiliano', 'Reyes', '2005-03-05', 'M', '5542693863', 'Calle Hidalgo #231', 'O-', '2026-07-15 02:25:47'),
(149, 'Sofia', 'Jimenez', '1963-11-26', 'F', '5563949203', 'Calle Independencia #6', 'O+', '2026-07-15 02:25:47'),
(150, 'Ivan', 'Chavez', '1989-10-21', 'Otro', '5569559685', 'Calle Allende #266', 'AB-', '2026-07-15 02:25:47'),
(151, 'Ricardo', 'Torres', '1945-01-02', 'Otro', '5513385674', 'Calle Madero #96', 'A-', '2026-07-15 02:25:47'),
(152, 'Isabella', 'Martinez', '1958-01-20', 'Otro', '5598154191', 'Calle Morelos #73', 'AB+', '2026-07-15 02:25:47'),
(153, 'Renata', 'Guerrero', '2022-11-17', 'Otro', '5596110063', 'Calle Madero #90', 'B+', '2026-07-15 02:25:47'),
(154, 'Sofia', 'Diaz', '1951-12-26', 'F', '5582263676', 'Calle Reforma #193', 'AB+', '2026-07-15 02:25:47'),
(155, 'Raul', 'Lopez', '2002-03-08', 'M', '5545088103', 'Calle Morelos #20', 'O-', '2026-07-15 02:25:47'),
(156, 'Sebastian', 'Chavez', '1978-12-02', 'F', '5595344481', 'Calle 5 de Mayo #224', 'B+', '2026-07-15 02:25:47'),
(157, 'Daniela', 'Jimenez', '1972-02-17', 'M', '5532786087', 'Calle Independencia #121', 'A-', '2026-07-15 02:25:47'),
(158, 'Isabella', 'Medina', '1986-04-13', 'F', '5590695848', 'Calle Morelos #195', 'AB-', '2026-07-15 02:25:47'),
(159, 'Patricia', 'Contreras', '2012-12-01', 'M', '5568681870', 'Calle Morelos #293', 'B+', '2026-07-15 02:25:47'),
(160, 'Fernando', 'Ortiz', '2019-02-19', 'M', '5529407201', 'Calle Reforma #14', 'O-', '2026-07-15 02:25:47'),
(161, 'Valentina', 'Reyes', '1965-06-05', 'Otro', '5513856428', 'Calle Reforma #22', 'A+', '2026-07-15 02:25:47'),
(162, 'Maria', 'Herrera', '1953-12-02', 'M', '5589251917', 'Calle Zaragoza #103', 'O-', '2026-07-15 02:25:47'),
(163, 'Fernanda', 'Hernandez', '1976-04-07', 'M', '5514544696', 'Calle Reforma #45', 'B+', '2026-07-15 02:25:47'),
(164, 'Patricia', 'Hernandez', '1961-02-26', 'Otro', '5537513753', 'Calle Independencia #164', 'B-', '2026-07-15 02:25:47'),
(165, 'Alberto', 'Rivera', '1947-06-09', 'F', '5516497216', 'Calle Zaragoza #165', 'AB-', '2026-07-15 02:25:47'),
(166, 'Daniela', 'Reyes', '1948-07-01', 'F', '5579608315', 'Calle Juarez #178', 'AB-', '2026-07-15 02:25:47'),
(167, 'Carlos', 'Rojas', '2017-04-23', 'M', '5587113575', 'Calle Independencia #88', 'AB+', '2026-07-15 02:25:47'),
(168, 'Ana', 'Guerrero', '1970-05-25', 'M', '5510585413', 'Calle Zaragoza #252', 'O-', '2026-07-15 02:25:47'),
(169, 'Eduardo', 'Herrera', '1968-08-19', 'F', '5579140956', 'Calle Independencia #296', 'A+', '2026-07-15 02:25:47'),
(170, 'Daniela', 'Contreras', '1972-12-08', 'F', '5532252095', 'Calle Juarez #42', 'AB-', '2026-07-15 02:25:47'),
(171, 'Ivan', 'Vazquez', '1958-11-11', 'F', '5522770611', 'Calle Madero #203', 'O-', '2026-07-15 02:25:47'),
(172, 'Alberto', 'Chavez', '1948-06-07', 'F', '5545325491', 'Calle Madero #280', 'A+', '2026-07-15 02:25:47'),
(173, 'Fernanda', 'Chavez', '1974-08-05', 'Otro', '5589737187', 'Calle Allende #18', 'B-', '2026-07-15 02:25:47'),
(174, 'Ruben', 'Gomez', '2011-03-28', 'F', '5598865581', 'Calle 5 de Mayo #166', 'A+', '2026-07-15 02:25:47'),
(175, 'Raul', 'Castro', '1977-10-08', 'M', '5554835935', 'Calle Colon #122', 'A-', '2026-07-15 02:25:47'),
(176, 'Emilio', 'Diaz', '1964-12-05', 'M', '5553830486', 'Calle Allende #268', 'B-', '2026-07-15 02:25:47'),
(177, 'Isabella', 'Sanchez', '1986-04-09', 'Otro', '5523664246', 'Calle Hidalgo #53', 'A-', '2026-07-15 02:25:47'),
(178, 'Fernanda', 'Ramirez', '1963-05-24', 'F', '5568374377', 'Calle Independencia #101', 'O-', '2026-07-15 02:25:47'),
(179, 'Valentina', 'Rivera', '1971-07-15', 'M', '5511693465', 'Calle Madero #224', 'A-', '2026-07-15 02:25:47'),
(180, 'Veronica', 'Jimenez', '1982-08-01', 'M', '5544522619', 'Calle Allende #208', 'O+', '2026-07-15 02:25:47'),
(181, 'Ricardo', 'Delgado', '2000-12-19', 'Otro', '5596865861', 'Calle Madero #118', 'A-', '2026-07-15 02:25:47'),
(182, 'Miguel', 'Jimenez', '1960-08-14', 'F', '5544870850', 'Calle Juarez #215', 'A-', '2026-07-15 02:25:47'),
(183, 'Roberto', 'Herrera', '1965-05-28', 'F', '5574792748', 'Calle Colon #11', 'AB+', '2026-07-15 02:25:47'),
(184, 'Arturo', 'Romero', '1968-11-11', 'M', '5562171561', 'Calle Colon #55', 'O+', '2026-07-15 02:25:47'),
(185, 'Paula', 'Rojas', '1972-03-23', 'M', '5579688525', 'Calle Zaragoza #52', 'AB-', '2026-07-15 02:25:47'),
(186, 'Alejandra', 'Flores', '2005-09-01', 'Otro', '5559649003', 'Calle 5 de Mayo #176', 'AB+', '2026-07-15 02:25:47'),
(187, 'Raul', 'Flores', '1968-07-17', 'M', '5592409992', 'Calle Zaragoza #29', 'B+', '2026-07-15 02:25:47'),
(188, 'Emilio', 'Ortiz', '1996-01-01', 'M', '5566181191', 'Calle Madero #181', 'B+', '2026-07-15 02:25:47'),
(189, 'Valentina', 'Sanchez', '1983-12-13', 'Otro', '5539382030', 'Calle Madero #237', 'A-', '2026-07-15 02:25:47'),
(190, 'Isabella', 'Ramirez', '1953-11-07', 'F', '5596194528', 'Calle 5 de Mayo #116', 'A+', '2026-07-15 02:25:47'),
(191, 'Ximena', 'Romero', '1997-08-10', 'Otro', '5597188846', 'Calle Hidalgo #241', 'B-', '2026-07-15 02:25:47'),
(192, 'Lucia', 'Rivera', '1993-11-09', 'F', '5534949696', 'Calle Colon #2', 'B+', '2026-07-15 02:25:47'),
(193, 'Ximena', 'Sanchez', '1983-06-16', 'F', '5567511393', 'Calle Allende #44', 'B-', '2026-07-15 02:25:47'),
(194, 'Andres', 'Delgado', '1983-07-02', 'M', '5585777892', 'Calle Zaragoza #72', 'B-', '2026-07-15 02:25:47'),
(195, 'Ruben', 'Garcia', '1946-04-03', 'Otro', '5549324772', 'Calle Independencia #52', 'A+', '2026-07-15 02:25:47'),
(196, 'Lucia', 'Torres', '2002-06-26', 'M', '5537989887', 'Calle Madero #274', 'A+', '2026-07-15 02:25:47'),
(197, 'Hector', 'Chavez', '2022-02-22', 'Otro', '5595442367', 'Calle Independencia #102', 'AB-', '2026-07-15 02:25:47'),
(198, 'Fernando', 'Guerrero', '1955-12-27', 'F', '5525700873', 'Calle 5 de Mayo #61', 'B+', '2026-07-15 02:25:47'),
(199, 'Gabriela', 'Sanchez', '1962-08-16', 'Otro', '5517845626', 'Calle Colon #240', 'A+', '2026-07-15 02:25:47'),
(200, 'Eduardo', 'Sanchez', '2008-03-18', 'Otro', '5510886747', 'Calle Hidalgo #165', 'AB-', '2026-07-15 02:25:47'),
(201, 'Adriana', 'Mendoza', '1982-08-12', 'F', '5566212640', 'Calle Juarez #93', 'B-', '2026-07-15 02:25:47'),
(202, 'Luis', 'Garcia', '2023-01-22', 'Otro', '5554353024', 'Calle Juarez #262', 'AB-', '2026-07-15 02:25:47'),
(203, 'Eduardo', 'Aguilar', '1963-01-07', 'Otro', '5565779753', 'Calle Hidalgo #174', 'O-', '2026-07-15 02:25:47'),
(204, 'Emiliano', 'Gomez', '2005-09-18', 'M', '5548138109', 'Calle Madero #176', 'AB+', '2026-07-15 02:25:47'),
(205, 'Paula', 'Rojas', '1951-05-10', 'F', '5576267357', 'Calle Madero #171', 'B+', '2026-07-15 02:25:47'),
(206, 'Veronica', 'Cruz', '1971-11-16', 'M', '5554412145', 'Calle Morelos #163', 'B+', '2026-07-15 02:25:47'),
(207, 'Camila', 'Morales', '1956-01-13', 'Otro', '5584396090', 'Calle Madero #280', 'O+', '2026-07-15 02:25:47'),
(208, 'Roberto', 'Diaz', '1958-01-02', 'M', '5573760548', 'Calle Allende #31', 'AB+', '2026-07-15 02:25:47'),
(209, 'Hector', 'Ramirez', '2021-11-03', 'M', '5515298135', 'Calle Colon #90', 'O-', '2026-07-15 02:25:47'),
(210, 'Miguel', 'Nunez', '1949-07-25', 'M', '5598008905', 'Calle Reforma #189', 'A+', '2026-07-15 02:25:47'),
(211, 'Alejandro', 'Rojas', '1978-05-06', 'F', '5514595725', 'Calle Zaragoza #11', 'AB+', '2026-07-15 02:25:47'),
(212, 'Adriana', 'Jimenez', '2019-01-16', 'Otro', '5580082327', 'Calle Reforma #61', 'AB+', '2026-07-15 02:25:47'),
(213, 'Adriana', 'Herrera', '1996-08-03', 'M', '5561961432', 'Calle Allende #80', 'AB-', '2026-07-15 02:25:47'),
(214, 'Gabriela', 'Rojas', '1958-02-21', 'F', '5538491325', 'Calle Hidalgo #8', 'AB+', '2026-07-15 02:25:47'),
(215, 'Ana', 'Garcia', '1960-02-07', 'M', '5527309857', 'Calle Colon #10', 'B+', '2026-07-15 02:25:47'),
(216, 'Adriana', 'Sanchez', '2002-12-24', 'M', '5516729503', 'Calle Zaragoza #75', 'O-', '2026-07-15 02:25:47'),
(217, 'Daniela', 'Jimenez', '2016-12-16', 'F', '5599864306', 'Calle Independencia #27', 'O+', '2026-07-15 02:25:47'),
(218, 'Ana', 'Martinez', '1946-11-22', 'Otro', '5520694545', 'Calle Madero #160', 'B+', '2026-07-15 02:25:47'),
(219, 'Claudia', 'Torres', '2007-10-02', 'F', '5559333816', 'Calle Allende #225', 'AB-', '2026-07-15 02:25:47'),
(220, 'Isabella', 'Ramirez', '1959-06-21', 'M', '5594517807', 'Calle Madero #245', 'AB+', '2026-07-15 02:25:47'),
(221, 'Monica', 'Rivera', '2017-06-10', 'F', '5518138668', 'Calle Allende #171', 'O+', '2026-07-15 02:25:47'),
(222, 'Andres', 'Reyes', '1984-10-14', 'M', '5560556711', 'Calle Madero #193', 'A-', '2026-07-15 02:25:47'),
(223, 'Monica', 'Diaz', '1945-06-09', 'F', '5566706992', 'Calle Hidalgo #22', 'B+', '2026-07-15 02:25:47'),
(224, 'Andres', 'Vazquez', '2018-03-09', 'Otro', '5577105635', 'Calle Zaragoza #274', 'O-', '2026-07-15 02:25:47'),
(225, 'Alejandra', 'Rojas', '2007-07-07', 'Otro', '5541411273', 'Calle Independencia #30', 'AB+', '2026-07-15 02:25:47'),
(226, 'Raul', 'Herrera', '1971-05-19', 'M', '5561670345', 'Calle Colon #277', 'O-', '2026-07-15 02:25:47'),
(227, 'Alejandra', 'Vazquez', '1990-02-08', 'F', '5587791310', 'Calle 5 de Mayo #133', 'B-', '2026-07-15 02:25:47'),
(228, 'Patricia', 'Guerrero', '2020-04-07', 'M', '5535811953', 'Calle Juarez #93', 'B+', '2026-07-15 02:25:47'),
(229, 'Emiliano', 'Morales', '2017-06-13', 'Otro', '5529999652', 'Calle Morelos #23', 'AB-', '2026-07-15 02:25:47'),
(230, 'Emiliano', 'Nunez', '1958-06-21', 'F', '5520970882', 'Calle Hidalgo #162', 'O+', '2026-07-15 02:25:47'),
(231, 'Ximena', 'Rivera', '2011-10-01', 'M', '5514506907', 'Calle Morelos #290', 'AB-', '2026-07-15 02:25:47'),
(232, 'Ruben', 'Morales', '1972-05-25', 'F', '5567170039', 'Calle Juarez #229', 'A+', '2026-07-15 02:25:47'),
(233, 'Paula', 'Contreras', '1949-06-07', 'M', '5560761416', 'Calle Juarez #15', 'O+', '2026-07-15 02:25:47'),
(234, 'Maria', 'Rojas', '1992-12-15', 'F', '5518614876', 'Calle Allende #204', 'O-', '2026-07-15 02:25:47'),
(235, 'Jorge', 'Rivera', '1985-10-08', 'Otro', '5522050503', 'Calle 5 de Mayo #202', 'A+', '2026-07-15 02:25:47'),
(236, 'Monica', 'Nunez', '1965-06-08', 'Otro', '5539759004', 'Calle Hidalgo #20', 'B+', '2026-07-15 02:25:47'),
(237, 'Ximena', 'Martinez', '2015-01-27', 'M', '5544615187', 'Calle 5 de Mayo #248', 'O+', '2026-07-15 02:25:47'),
(238, 'Valentina', 'Ramirez', '1985-01-07', 'Otro', '5550103282', 'Calle Allende #226', 'O-', '2026-07-15 02:25:47'),
(239, 'Patricia', 'Gomez', '1992-05-13', 'M', '5560329386', 'Calle Colon #195', 'A+', '2026-07-15 02:25:47'),
(240, 'Monica', 'Sanchez', '1963-11-01', 'F', '5536186382', 'Calle Reforma #81', 'A-', '2026-07-15 02:25:47'),
(241, 'Sofia', 'Delgado', '1992-12-05', 'F', '5523017431', 'Calle Madero #12', 'O-', '2026-07-15 02:25:47'),
(242, 'Monica', 'Gomez', '1986-04-16', 'M', '5594313315', 'Calle Zaragoza #74', 'B-', '2026-07-15 02:25:47'),
(243, 'Lucia', 'Medina', '1952-03-23', 'F', '5584272612', 'Calle Hidalgo #225', 'A+', '2026-07-15 02:25:47'),
(244, 'Emilio', 'Vargas', '1997-04-05', 'M', '5546387383', 'Calle Allende #152', 'B-', '2026-07-15 02:25:47'),
(245, 'Isabella', 'Rivera', '2007-02-11', 'F', '5574751504', 'Calle Juarez #79', 'O+', '2026-07-15 02:25:47'),
(246, 'Fernando', 'Rojas', '2006-05-04', 'F', '5537061223', 'Calle Zaragoza #222', 'B+', '2026-07-15 02:25:47'),
(247, 'Ricardo', 'Delgado', '1975-02-13', 'F', '5565785718', 'Calle Hidalgo #30', 'B+', '2026-07-15 02:25:47'),
(248, 'Andres', 'Jimenez', '1947-08-26', 'Otro', '5555755623', 'Calle 5 de Mayo #72', 'AB-', '2026-07-15 02:25:47'),
(249, 'Ana', 'Vazquez', '2012-05-06', 'F', '5568418183', 'Calle Reforma #210', 'A-', '2026-07-15 02:25:47'),
(250, 'Emilio', 'Morales', '1968-03-27', 'M', '5580015044', 'Calle Morelos #90', 'A-', '2026-07-15 02:25:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id_receta` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `medicamento` varchar(100) NOT NULL,
  `dosis` varchar(60) DEFAULT NULL,
  `indicaciones` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id_receta`, `id_cita`, `medicamento`, `dosis`, `indicaciones`) VALUES
(1, 21, 'Diclofenaco', '1 tableta(s) cada 8 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(2, 1, 'Naproxeno', '1 tableta(s) cada 12 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(3, 12, 'Diclofenaco', '2 tableta(s) cada 8 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(4, 22, 'Diclofenaco', '1 tableta(s) cada 24 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(5, 24, 'Omeprazol', '2 tableta(s) cada 24 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(6, 4, 'Metformina', '2 tableta(s) cada 24 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(7, 23, 'Naproxeno', '1 tableta(s) cada 8 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(8, 22, 'Loratadina', '1 tableta(s) cada 12 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(9, 1, 'Paracetamol', '1 tableta(s) cada 24 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(10, 16, 'Loratadina', '1 tableta(s) cada 8 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(11, 16, 'Paracetamol', '1 tableta(s) cada 8 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(12, 18, 'Paracetamol', '2 tableta(s) cada 8 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(13, 25, 'Diclofenaco', '1 tableta(s) cada 12 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(14, 5, 'Naproxeno', '1 tableta(s) cada 24 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(15, 19, 'Amoxicilina', '2 tableta(s) cada 8 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(16, 21, 'Naproxeno', '2 tableta(s) cada 8 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(17, 21, 'Ibuprofeno', '1 tableta(s) cada 24 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(18, 10, 'Losartan', '2 tableta(s) cada 12 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(19, 20, 'Losartan', '2 tableta(s) cada 24 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(20, 9, 'Paracetamol', '1 tableta(s) cada 8 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(21, 15, 'Losartan', '2 tableta(s) cada 8 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(22, 22, 'Loratadina', '1 tableta(s) cada 8 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(23, 6, 'Diclofenaco', '2 tableta(s) cada 8 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(24, 9, 'Losartan', '1 tableta(s) cada 12 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(25, 16, 'Naproxeno', '1 tableta(s) cada 8 horas', 'Tomar con alimentos. Acudir a revision en 7 dias si persisten los sintomas.'),
(26, 28, 'Ibuprofeno', '300 mg cada hora', 'Tomar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('Administrador','Medico') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `rol`) VALUES
(1, 'Administrador', '$2y$10$q/R7rlm1zncREaXC8zr3CuvdZA0TSmXyZ9wMua/quhxAXKV9NBco6', 'Administrador'),
(2, 'Lizarraga', '$2y$10$0OcDoKBUDHV0ZCwhvgsoj.HFviNZEDF7d1HXiz5vh/HKLZ0l2UZMS', 'Medico'),
(3, 'Christian', '$2y$10$RT/PckXpeQTmvFOkU0yNke0rixa4/UQZJ.jv1G.dTTPSwNfbJCrVm', 'Medico');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_habitacion` (`id_habitacion`);

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`id_doctor`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id_habitacion`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `id_cita` (`id_cita`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `id_doctor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_doctor`) REFERENCES `doctores` (`id_doctor`),
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones` (`id_habitacion`);

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD CONSTRAINT `recetas_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `citas` (`id_cita`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
