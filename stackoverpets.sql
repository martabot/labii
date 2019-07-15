-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-07-2019 a las 15:45:39
-- Versión del servidor: 10.1.26-MariaDB-0+deb9u1
-- Versión de PHP: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `final`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `acomodarTablaPais` ()  BEGIN
UPDATE pais SET id=id-3;
SELECT COUNT(*) FROM pais;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `salt` varchar(500) DEFAULT NULL,
  `fechaAlta` datetime NOT NULL,
  `adminUltMod` int(11) DEFAULT NULL,
  `fechaUltMod` datetime NOT NULL,
  `mail` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `username`, `pass`, `salt`, `fechaAlta`, `adminUltMod`, `fechaUltMod`, `mail`, `status`) VALUES
(1, 'admin', 'admin', NULL, '2019-07-10 00:00:00', NULL, '2019-07-10 00:00:00', 'this@mail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigo`
--

CREATE TABLE `amigo` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `amigo`
--

INSERT INTO `amigo` (`id`, `user1`, `user2`, `status`, `fecha`) VALUES
(1, 4, 2, 1, '2019-07-12 01:38:29'),
(2, 4, 3, 1, '2019-07-12 01:39:36'),
(3, 1, 2, 1, '2019-07-12 01:40:23'),
(4, 1, 8, 0, '2019-07-12 21:54:17'),
(5, 9, 8, 0, '2019-07-12 22:35:22'),
(6, 1, 9, 2, '2019-07-12 22:55:51'),
(7, 1, 9, 2, '2019-07-12 22:56:46'),
(8, 1, 8, 0, '2019-07-13 01:37:54'),
(9, 3, 9, 2, '2019-07-13 06:38:15'),
(10, 9, 1, 1, '2019-07-13 06:45:15'),
(11, 7, 1, 1, '2019-07-13 08:25:09'),
(12, 3, 7, 2, '2019-07-13 11:02:44'),
(13, 3, 9, 0, '2019-07-13 11:03:45'),
(14, 3, 7, 1, '2019-07-13 11:04:09'),
(15, 10, 3, 1, '2019-07-14 00:17:04'),
(16, 10, 1, 2, '2019-07-14 00:35:57'),
(17, 1, 10, 1, '2019-07-14 00:45:55'),
(18, 10, 7, 2, '2019-07-14 01:03:52'),
(19, 10, 7, 1, '2019-07-14 01:53:57'),
(20, 1, 3, 2, '2019-07-14 06:58:35'),
(21, 1, 3, 2, '2019-07-14 06:58:39'),
(22, 2, 9, 1, '2019-07-14 07:22:52'),
(23, 1, 3, 2, '2019-07-14 10:24:38'),
(24, 1, 3, 2, '2019-07-14 10:24:43'),
(25, 3, 1, 2, '2019-07-14 10:25:06'),
(26, 1, 6, 0, '2019-07-15 02:33:59'),
(27, 13, 1, 2, '2019-07-15 15:32:19'),
(28, 13, 1, 1, '2019-07-15 15:32:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `post` int(11) DEFAULT NULL,
  `cuerpo` varchar(5000) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `votos` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `privacidad` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `user`, `post`, `cuerpo`, `fecha`, `votos`, `status`, `privacidad`) VALUES
(1, 3, 1, 'Que parece si dejo un comentarijillo por aqui wapa', '2019-07-12 01:35:05', 0, 1, 1),
(2, 1, 9, 'no', '2019-07-12 14:59:18', 0, 0, 1),
(3, 1, 9, 'no', '2019-07-12 15:00:12', 0, 0, 1),
(4, 1, 9, 'si', '2019-07-12 15:00:16', 0, 1, 1),
(5, 1, 9, 'nono', '2019-07-12 15:05:26', 0, 0, 1),
(6, 1, 9, 'no', '2019-07-12 15:05:29', 0, 0, 1),
(7, 1, 9, 'si', '2019-07-12 15:05:32', 0, 1, 1),
(8, 1, 9, 'si', '2019-07-12 15:05:34', 0, 1, 1),
(9, 1, 9, 'si', '2019-07-12 15:05:37', 0, 1, 1),
(10, 1, 9, 'no', '2019-07-12 15:05:39', 0, 0, 1),
(11, 1, 9, 'no', '2019-07-12 15:05:42', 0, 0, 1),
(12, 1, 9, 'si', '2019-07-12 15:05:44', 0, 1, 1),
(13, 1, 9, 'no', '2019-07-12 15:05:47', 0, 0, 1),
(14, 1, 9, 'si, por las dudas', '2019-07-12 15:05:52', 0, 1, 1),
(15, 1, 2, 'bueeenaa', '2019-07-12 17:53:22', 0, 1, 1),
(16, 1, 2, 'que increeibleee', '2019-07-12 17:53:42', 0, 1, 1),
(17, 1, 10, 'bueno', '2019-07-13 01:57:51', 0, 0, 1),
(18, 1, 10, 'juat?\r\n', '2019-07-13 01:58:14', 0, 1, 1),
(19, 1, 10, 'de que', '2019-07-13 01:58:59', 0, 1, 1),
(20, 3, 14, 'dejo mi comentario', '2019-07-13 06:18:19', 0, 0, 1),
(21, 1, 20, '', '2019-07-13 09:08:24', 0, 0, 1),
(22, 1, 20, 'hola', '2019-07-13 09:28:17', 0, 1, 1),
(23, 3, 20, 'hola', '2019-07-13 09:29:40', 0, 1, 1),
(24, 3, 18, 'hola', '2019-07-13 09:35:17', 0, 1, 1),
(25, 3, 18, 'sddd', '2019-07-13 09:38:06', 0, 1, 1),
(26, 3, 18, 'klasjdla', '2019-07-13 09:42:31', 0, 1, 1),
(27, 3, 19, 'estas ahi?', '2019-07-13 09:44:52', 0, 0, 1),
(28, 3, 19, 'holis', '2019-07-13 09:46:53', 0, 0, 1),
(29, 3, 20, 'holi', '2019-07-13 09:49:40', 0, 1, 1),
(30, 3, 20, 'kjhkj', '2019-07-13 09:50:35', 0, 1, 1),
(31, 3, 19, 'lkjlk', '2019-07-13 09:57:33', 0, 0, 1),
(32, 3, 20, 'jjjj', '2019-07-13 09:58:07', 0, 1, 1),
(33, 3, 20, 'kjhkjhk', '2019-07-13 09:58:53', 0, 1, 1),
(34, 3, 19, 'giuik', '2019-07-13 10:03:54', 0, 0, 1),
(35, 3, 19, 'holiisss', '2019-07-13 10:04:37', 0, 0, 1),
(36, 3, 19, 'kjasldjalsk', '2019-07-13 10:08:40', 0, 0, 1),
(37, 3, 19, 'kjlkjlk', '2019-07-13 10:10:07', 0, 0, 1),
(38, 3, 12, 'hola', '2019-07-13 10:13:50', 0, 1, 1),
(39, 3, 19, 'kllklñ', '2019-07-13 10:14:00', 0, 0, 1),
(40, 3, 10, 'jkhjk', '2019-07-13 10:14:12', 0, 0, 1),
(41, 3, 10, 'kjlkll', '2019-07-13 10:18:57', 0, 1, 1),
(42, 3, 19, 'lkjlkjl', '2019-07-13 10:19:08', 0, 0, 1),
(43, 3, 10, 'que pasa con esas comillas', '2019-07-13 10:20:50', 0, 1, 1),
(44, 3, 19, 'yeah', '2019-07-13 10:23:51', 0, 0, 1),
(45, 3, 19, 'kkk', '2019-07-13 10:24:24', 0, 0, 1),
(46, 3, 19, 'ñlñl', '2019-07-13 10:26:23', 0, 0, 1),
(47, 3, 19, 'lkjlk', '2019-07-13 10:29:49', 0, 0, 1),
(48, 3, 19, 'kjkjhkhkj', '2019-07-13 10:33:00', 0, 0, 1),
(49, 3, 10, 'kjhkjh', '2019-07-13 10:33:54', 0, 1, 1),
(50, 3, 10, 're', '2019-07-13 10:35:58', 0, 1, 1),
(51, 3, 10, 'lkkljjl', '2019-07-13 10:37:19', 0, 1, 1),
(52, 3, 10, 'kkk', '2019-07-13 10:41:56', 0, 1, 1),
(53, 3, 19, 'lñsdkañl', '2019-07-13 10:47:19', 0, 0, 1),
(54, 3, 19, 'lklk', '2019-07-13 10:48:16', 0, 0, 1),
(55, 3, 19, 'mhlgkl', '2019-07-13 10:49:41', 0, 0, 1),
(56, 3, 19, 'lkjñljlñ', '2019-07-13 10:52:42', 0, 0, 1),
(57, 3, 19, 'klllk', '2019-07-13 10:54:18', 0, 0, 1),
(58, 3, 19, 'jhk', '2019-07-13 10:56:05', 0, 0, 1),
(59, 3, 19, 'klajsdl', '2019-07-13 10:57:47', 0, 0, 1),
(60, 3, 19, 'kjkjhk', '2019-07-13 11:04:15', 0, 0, 1),
(61, 3, 19, 'kjjkkjkj', '2019-07-13 11:05:52', 0, 0, 1),
(62, 3, 19, 'kjlkj', '2019-07-13 11:15:47', 0, 0, 1),
(63, 3, 19, 'jhhkjkhj', '2019-07-13 11:16:24', 0, 0, 1),
(64, 3, 19, 'jknnjkj', '2019-07-13 11:16:49', 0, 0, 1),
(65, 3, 19, 'kjjk', '2019-07-13 11:17:18', 0, 0, 1),
(66, 3, 19, 'lkjlkk', '2019-07-13 11:18:02', 0, 0, 1),
(67, 3, 19, 'jhkjgkjg', '2019-07-13 11:23:14', 0, 0, 1),
(68, 3, 19, 'jhkjjhkjj', '2019-07-13 11:25:38', 0, 0, 1),
(69, 3, 19, 'hjkjghk', '2019-07-13 11:29:11', 0, 0, 1),
(70, 3, 19, 'jhgjgjh', '2019-07-13 11:29:49', 0, 0, 1),
(71, 3, 19, 'hjgkyhg', '2019-07-13 11:31:14', 0, 0, 1),
(72, 3, 19, 'jkasjh', '2019-07-13 11:32:35', 0, 0, 1),
(73, 3, 19, 'jksad', '2019-07-13 11:35:49', 0, 0, 1),
(74, 3, 19, 'klzslk', '2019-07-13 11:37:13', 0, 0, 1),
(75, 3, 19, 'jkashdk', '2019-07-13 11:38:04', 0, 0, 1),
(76, 1, 20, 'hola', '2019-07-13 11:45:06', 0, 1, 1),
(77, 1, 20, 'kkl', '2019-07-13 12:15:48', 0, 1, 1),
(78, 1, 20, 'que??', '2019-07-13 12:16:21', 0, 1, 1),
(79, 1, 20, 'si? *-*', '2019-07-13 12:17:03', 0, 1, 1),
(80, 1, 20, 'te amooooo', '2019-07-13 12:17:17', 0, 1, 1),
(81, 3, 20, 'te comento', '2019-07-13 12:51:17', 0, 1, 1),
(82, 3, 20, 'porque puedo', '2019-07-13 12:51:21', 0, 1, 1),
(83, 3, 8, 'Practica', '2019-07-13 13:00:30', 0, 1, 1),
(84, 1, 20, 'bahamas', '2019-07-13 13:10:28', 0, 1, 1),
(85, 3, 1, 'marta... sos la numero unooo', '2019-07-13 13:30:41', 0, 1, 1),
(86, 7, 2, 'holis', '2019-07-13 13:55:02', 0, 1, 1),
(87, 1, 1, 'Gracias... saluditos', '2019-07-13 14:18:58', 0, 1, 1),
(88, 1, 2, 'y ahora?', '2019-07-13 15:22:47', 0, 1, 1),
(89, 1, 21, 'de una wacho', '2019-07-14 00:44:27', 0, 1, 1),
(90, 1, 21, 'muchas', '2019-07-14 00:44:33', 0, 0, 1),
(91, 1, 21, 'notifiscassdhaksj', '2019-07-14 00:44:38', 0, 0, 1),
(92, 1, 21, 'que ondaaa', '2019-07-14 00:58:40', 0, 0, 1),
(93, 1, 22, 'de una wacho', '2019-07-14 01:00:41', 0, 1, 1),
(94, 10, 19, 'deberia volver a este post si esta bien seteado visitante', '2019-07-14 01:03:32', 0, 0, 1),
(95, 7, 19, 'ah si=', '2019-07-14 01:09:00', 0, 0, 1),
(96, 7, 22, 'hola', '2019-07-14 01:16:43', 0, 1, 1),
(97, 7, 22, 'kjjjk', '2019-07-14 01:18:43', 0, 1, 1),
(98, 7, 22, 'kasjdlkas', '2019-07-14 01:19:55', 0, 1, 1),
(99, 1, 22, 'hola', '2019-07-14 01:35:31', 0, 1, 1),
(100, 10, 8, 'hola dos', '2019-07-14 01:42:46', 0, 1, 1),
(101, 2, 8, 'hollaaaaaaaaa davidddddddd tanto tiempo', '2019-07-14 01:46:11', 0, 1, 1),
(102, 2, 8, 'vistes', '2019-07-14 01:49:17', 0, 1, 1),
(103, 10, 2, 'tiutiutuitit', '2019-07-14 02:41:07', 0, 1, 1),
(104, 10, 17, 'este es un comentario del insoportable david que viene a tirar asi tipo un comentario re largo porque largo largo largo largo larog muuuuuuuuuuuuy larrrrrrrrgoooooooo', '2019-07-14 03:22:47', 0, 1, 1),
(105, 10, 19, 'comentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomentocomento', '2019-07-14 03:46:36', 0, 0, 1),
(106, 10, 19, 'comento esto porque tiene que ser algo largo pero no tan largo para comentar en un comentario largo gracias', '2019-07-14 03:47:03', 0, 1, 1),
(107, 1, 22, 'te voy a dejar un comentario porque la diseñadora re ortiba no me deja publicarte', '2019-07-14 03:56:41', 0, 1, 1),
(108, 3, 17, 'gracias\r\nvuelvan prontos', '2019-07-14 06:59:53', 0, 1, 1),
(109, 3, 20, 'diga', '2019-07-14 07:05:17', 0, 1, 1),
(110, 3, 20, 'a la orden', '2019-07-14 07:05:25', 0, 1, 1),
(111, 3, 27, 'te tiro todo el codigo', '2019-07-14 07:05:45', 0, 1, 1),
(112, 3, 27, 'se me va la paginaaaa', '2019-07-14 07:05:53', 0, 1, 1),
(113, 3, 27, 'reloadddddddddddddddd', '2019-07-14 07:06:00', 0, 1, 1),
(114, 3, 27, 'servidooorrr', '2019-07-14 07:06:14', 0, 1, 1),
(115, 1, 17, 'notis', '2019-07-14 12:40:43', 0, 1, 1),
(116, 3, 17, 'copiado', '2019-07-14 12:44:40', 0, 0, 1),
(117, 1, 17, 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', '2019-07-14 18:58:58', 0, 0, 1),
(118, 13, 54, 'hola lauchiiii tanto tiempo amiga... cuando puedas nos tomamos unos mates', '2019-07-15 15:33:14', 0, 1, 1),
(119, 7, 27, 'vamos linux!!! nada como un buen software libre', '2019-07-15 15:36:27', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denunciaCom`
--

CREATE TABLE `denunciaCom` (
  `idCom` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `dFecha` datetime NOT NULL,
  `idModerador` int(11) DEFAULT NULL,
  `motivo` varchar(100) NOT NULL,
  `fechaMod` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `denunciaCom`
--

INSERT INTO `denunciaCom` (`idCom`, `idUsuario`, `dFecha`, `idModerador`, `motivo`, `fechaMod`) VALUES
(2, 1, '2019-07-12 16:58:00', 1, 'Hay un motivo para todo', '2019-07-12 16:59:00'),
(3, 1, '2019-07-12 16:57:59', 1, 'Hay un motivo para todo', '2019-07-12 16:59:02'),
(4, 1, '2019-07-12 16:57:58', 1, 'Hay un motivo para todo', '2019-07-12 16:59:05'),
(5, 1, '2019-07-12 16:57:58', 1, 'Hay un motivo para todo', '2019-07-12 16:59:07'),
(6, 1, '2019-07-12 16:57:58', 1, 'Hay un motivo para todo', '2019-07-12 16:59:09'),
(7, 1, '2019-07-12 16:57:57', 1, 'Hay un motivo para todo', '2019-07-12 16:59:11'),
(8, 1, '2019-07-12 16:57:57', 1, 'Hay un motivo para todo', '2019-07-12 16:59:14'),
(9, 1, '2019-07-12 16:57:56', 1, 'Hay un motivo para todo', '2019-07-12 16:59:16'),
(10, 1, '2019-07-12 16:57:56', 1, 'Hay un motivo para todo', '2019-07-12 16:59:18'),
(11, 1, '2019-07-12 16:57:56', 1, 'Hay un motivo para todo', '2019-07-12 16:59:20'),
(12, 1, '2019-07-12 16:57:55', 1, 'Hay un motivo para todo', '2019-07-12 16:59:22'),
(13, 1, '2019-07-12 16:57:55', 1, 'Hay un motivo para todo', '2019-07-12 16:59:24'),
(14, 1, '2019-07-12 16:57:54', 1, 'Hay un motivo para todo', '2019-07-12 16:59:26'),
(15, 1, '2019-07-12 18:48:16', 2, 'Hay un motivo para todo', '2019-07-13 01:35:41'),
(16, 1, '2019-07-12 18:48:15', 2, 'Hay un motivo para todo', '2019-07-13 01:35:36'),
(17, 1, '2019-07-13 01:57:54', 2, 'Hay un motivo para todo', '2019-07-13 14:41:33'),
(18, 1, '2019-07-13 01:59:06', 2, 'Hay un motivo para todo', '2019-07-13 14:41:29'),
(19, 1, '2019-07-13 01:59:03', 2, 'Hay un motivo para todo', '2019-07-13 14:41:31'),
(20, 3, '2019-07-13 06:18:21', 2, 'Hay un motivo para todo', '2019-07-13 14:41:27'),
(21, 1, '2019-07-13 09:08:29', 2, 'Hay un motivo para todo', '2019-07-13 14:40:26'),
(27, 1, '2019-07-14 17:58:05', 2, 'Hay un motivo para todo', '2019-07-14 18:55:15'),
(28, 10, '2019-07-14 00:22:15', 2, 'Hay un motivo para todo', '2019-07-14 07:44:54'),
(31, 1, '2019-07-14 17:58:03', 2, 'Hay un motivo para todo', '2019-07-14 18:55:16'),
(34, 1, '2019-07-14 17:57:56', 2, 'Hay un motivo para todo', '2019-07-14 18:55:18'),
(35, 1, '2019-07-14 17:57:31', 2, 'Hay un motivo para todo', '2019-07-14 18:55:26'),
(35, 10, '2019-07-14 00:22:10', 2, 'Hay un motivo para todo', '2019-07-14 07:44:57'),
(36, 1, '2019-07-14 17:57:58', 2, 'Hay un motivo para todo', '2019-07-14 18:55:17'),
(37, 1, '2019-07-14 17:57:54', 2, 'Hay un motivo para todo', '2019-07-14 18:55:19'),
(39, 1, '2019-07-14 17:58:01', 2, 'Hay un motivo para todo', '2019-07-14 18:55:16'),
(40, 3, '2019-07-13 10:14:16', 2, 'Hay un motivo para todo', '2019-07-13 14:40:25'),
(42, 1, '2019-07-14 17:57:42', 2, 'Hay un motivo para todo', '2019-07-14 18:55:24'),
(44, 1, '2019-07-14 17:57:52', 2, 'Hay un motivo para todo', '2019-07-14 18:55:20'),
(45, 1, '2019-07-14 17:57:03', 2, 'Hay un motivo para todo', '2019-07-14 18:55:33'),
(46, 10, '2019-07-14 00:22:22', 2, 'Hay un motivo para todo', '2019-07-14 07:44:52'),
(47, 1, '2019-07-14 17:56:59', 2, 'Hay un motivo para todo', '2019-07-14 18:55:35'),
(48, 1, '2019-07-14 17:57:48', 2, 'Hay un motivo para todo', '2019-07-14 18:55:22'),
(53, 2, '2019-07-14 07:34:26', 2, 'Hay un motivo para todo', '2019-07-14 07:44:49'),
(54, 1, '2019-07-14 17:57:24', 2, 'Hay un motivo para todo', '2019-07-14 18:55:28'),
(55, 1, '2019-07-14 17:57:27', 2, 'Hay un motivo para todo', '2019-07-14 18:55:27'),
(56, 1, '2019-07-14 17:57:50', 2, 'Hay un motivo para todo', '2019-07-14 18:55:21'),
(57, 1, '2019-07-14 17:57:41', 2, 'Hay un motivo para todo', '2019-07-14 18:55:24'),
(58, 1, '2019-07-14 17:57:45', 2, 'Hay un motivo para todo', '2019-07-14 18:55:23'),
(59, 1, '2019-07-14 17:57:34', 2, 'Hay un motivo para todo', '2019-07-14 18:55:25'),
(60, 1, '2019-07-14 17:57:29', 2, 'Hay un motivo para todo', '2019-07-14 18:55:26'),
(61, 1, '2019-07-14 17:57:13', 2, 'Hay un motivo para todo', '2019-07-14 18:55:30'),
(62, 1, '2019-07-14 17:57:15', 2, 'Hay un motivo para todo', '2019-07-14 18:55:30'),
(63, 1, '2019-07-14 17:58:08', 2, 'Hay un motivo para todo', '2019-07-14 18:55:15'),
(64, 1, '2019-07-14 17:57:17', 2, 'Hay un motivo para todo', '2019-07-14 18:55:29'),
(65, 1, '2019-07-14 17:57:20', 2, 'Hay un motivo para todo', '2019-07-14 18:55:28'),
(66, 1, '2019-07-14 17:56:56', 2, 'Hay un motivo para todo', '2019-07-14 18:55:36'),
(67, 1, '2019-07-14 17:56:52', 2, 'Hay un motivo para todo', '2019-07-14 18:55:37'),
(68, 1, '2019-07-14 17:57:01', 2, 'Hay un motivo para todo', '2019-07-14 18:55:34'),
(69, 1, '2019-07-14 17:57:07', 2, 'Hay un motivo para todo', '2019-07-14 18:55:33'),
(70, 1, '2019-07-14 17:57:09', 2, 'Hay un motivo para todo', '2019-07-14 18:55:32'),
(71, 1, '2019-07-14 17:56:54', 2, 'Hay un motivo para todo', '2019-07-14 18:55:36'),
(71, 10, '2019-07-14 00:22:02', 2, 'Hay un motivo para todo', '2019-07-14 07:44:55'),
(72, 1, '2019-07-14 17:56:49', 2, 'Hay un motivo para todo', '2019-07-14 18:55:38'),
(73, 3, '2019-07-13 12:42:14', 2, 'Hay un motivo para todo', '2019-07-13 14:40:21'),
(74, 10, '2019-07-14 00:21:06', 2, 'Hay un motivo para todo', '2019-07-14 07:44:56'),
(75, 3, '2019-07-13 12:41:57', 2, 'Hay un motivo para todo', '2019-07-13 14:40:23'),
(78, 2, '2019-07-14 11:30:25', NULL, 'Hay un motivo para todo', NULL),
(84, 2, '2019-07-14 11:30:32', 2, 'Hay un motivo para todo', '2019-07-15 12:06:36'),
(90, 1, '2019-07-14 12:39:03', 2, 'Hay un motivo para todo', '2019-07-14 18:55:39'),
(91, 1, '2019-07-14 12:38:59', 2, 'Hay un motivo para todo', '2019-07-14 18:55:39'),
(92, 1, '2019-07-14 12:39:05', 2, 'Hay un motivo para todo', '2019-07-14 18:55:38'),
(94, 1, '2019-07-14 17:57:11', 2, 'Hay un motivo para todo', '2019-07-14 18:55:31'),
(95, 1, '2019-07-14 17:58:11', 2, 'Hay un motivo para todo', '2019-07-14 18:55:14'),
(104, 10, '2019-07-14 03:22:49', 2, 'Hay un motivo para todo', '2019-07-14 03:34:40'),
(105, 1, '2019-07-14 17:57:37', 2, 'Hay un motivo para todo', '2019-07-14 18:54:02'),
(106, 2, '2019-07-14 07:34:23', 2, 'Hay un motivo para todo', '2019-07-14 07:44:51'),
(109, 2, '2019-07-14 11:30:30', NULL, 'Hay un motivo para todo', NULL),
(110, 2, '2019-07-14 11:30:27', NULL, 'Hay un motivo para todo', NULL),
(116, 1, '2019-07-14 18:08:02', 2, 'Hay un motivo para todo', '2019-07-14 18:55:13'),
(117, 1, '2019-07-14 18:59:00', 2, 'Hay un motivo para todo', '2019-07-14 19:06:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denunciaPost`
--

CREATE TABLE `denunciaPost` (
  `idPost` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idModerador` int(11) DEFAULT NULL,
  `dFecha` datetime NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `fechaMod` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `denunciaPost`
--

INSERT INTO `denunciaPost` (`idPost`, `idUsuario`, `idModerador`, `dFecha`, `motivo`, `fechaMod`) VALUES
(3, 3, 1, '2019-07-12 01:35:39', 'Me resulta poco probable', '2019-07-12 17:07:55'),
(4, 1, 2, '2019-07-13 14:36:08', 'te voy a extrañar', '2019-07-13 14:36:40'),
(7, 8, 2, '2019-07-12 21:12:41', 'putos todos\r\n', '2019-07-13 01:35:28'),
(9, 1, 1, '2019-07-12 17:00:07', 'insoportable', '2019-07-12 17:07:52'),
(12, 1, 2, '2019-07-12 23:45:05', 'Porque puedo', '2019-07-13 01:35:22'),
(12, 3, 2, '2019-07-13 13:00:04', 'n', '2019-07-14 02:06:00'),
(12, 7, 2, '2019-07-14 02:18:05', 'feo', '2019-07-14 03:23:42'),
(12, 8, 2, '2019-07-13 01:36:08', 'estaba reportado?', '2019-07-13 01:36:32'),
(12, 10, 2, '2019-07-14 02:04:07', 'rata de mierda', '2019-07-14 02:05:59'),
(13, 1, 2, '2019-07-14 05:51:11', 'maldito', '2019-07-14 07:34:03'),
(14, 1, 2, '2019-07-13 06:33:46', 'deberia estar eliminado, no?', '2019-07-14 00:26:04'),
(20, 1, NULL, '2019-07-14 10:30:37', 'que se cree', NULL),
(20, 10, 2, '2019-07-14 00:18:15', 'muy corto', '2019-07-14 00:27:39'),
(23, 3, 2, '2019-07-14 03:24:26', 'c', '2019-07-14 07:34:11'),
(29, 1, 2, '2019-07-14 11:36:47', 'kkkk', '2019-07-14 11:37:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interes`
--

CREATE TABLE `interes` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moderador`
--

CREATE TABLE `moderador` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `salt` varchar(500) DEFAULT NULL,
  `mail` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `fechaAlta` date NOT NULL,
  `adminUltMod` int(11) NOT NULL,
  `fechaUltMod` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `moderador`
--

INSERT INTO `moderador` (`id`, `username`, `pass`, `salt`, `mail`, `status`, `fechaAlta`, `adminUltMod`, `fechaUltMod`) VALUES
(1, 'u@dos.com', '12345', '', 'u@dos.com', 0, '2019-07-12', 1, '2019-07-14'),
(2, 'laubabosamail@gmail.com', '12345', '', 'laubabosamail@gmail.com', 1, '2019-07-13', 1, '2019-07-13'),
(3, 'david-9@outlook.com', '12345', '', 'david-9@outlook.com', 0, '2019-07-14', 1, '2019-07-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(500) NOT NULL,
  `post` int(11) DEFAULT NULL,
  `comentario` int(11) DEFAULT NULL,
  `amigo` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`id`, `user1`, `user2`, `fecha`, `status`, `descripcion`, `post`, `comentario`, `amigo`) VALUES
(50, 7, 10, '2019-07-14 01:57:38', 1, '@cuentaLoca aceptó tu solicitud de amistad', NULL, NULL, 1),
(51, 7, 3, '2019-07-14 02:17:09', 1, '@cuentaLoca aceptó tu solicitud de amistad', NULL, NULL, 1),
(52, 10, 1, '2019-07-14 02:41:08', 1, '@david.9 ha comentado tu post', 2, 103, 0),
(53, 10, 3, '2019-07-14 03:22:47', 1, '@david.9 ha comentado tu post', 17, 104, 0),
(54, 10, 7, '2019-07-14 03:46:36', 0, '@david.9 ha comentado tu post', 19, 105, 0),
(55, 10, 7, '2019-07-14 03:47:03', 0, '@david.9 ha comentado tu post', 19, 106, 0),
(56, 1, 10, '2019-07-14 03:56:41', 0, '@martabot ha comentado tu post', 22, 107, 0),
(57, 1, 3, '2019-07-14 06:58:35', 1, '@martabot te ha enviado una solicitud de amistad', NULL, NULL, 1),
(58, 1, 3, '2019-07-14 06:58:37', 1, '@martabot rechazó tu solicitud de amistad', NULL, NULL, 1),
(59, 1, 3, '2019-07-14 06:58:39', 1, '@martabot te ha enviado una solicitud de amistad', NULL, NULL, 1),
(60, 3, 1, '2019-07-14 07:05:46', 1, '@usuario1 ha comentado tu post', 27, 111, 0),
(61, 3, 1, '2019-07-14 07:05:53', 1, '@usuario1 ha comentado tu post', 27, 112, 0),
(62, 3, 1, '2019-07-14 07:06:00', 1, '@usuario1 ha comentado tu post', 27, 113, 0),
(63, 3, 1, '2019-07-14 07:06:14', 1, '@usuario1 ha comentado tu post', 27, 114, 0),
(64, 2, 9, '2019-07-14 07:22:52', 1, '@laubabosamail@gmail.com te ha enviado una solicitud de amistad', NULL, NULL, 1),
(65, 9, 2, '2019-07-14 07:23:11', 1, '@FUEGUINO aceptó tu solicitud de amistad', NULL, NULL, 1),
(66, 1, 3, '2019-07-14 10:24:38', 1, '@martabot te ha enviado una solicitud de amistad', NULL, NULL, 1),
(67, 1, 3, '2019-07-14 10:24:40', 1, '@martabot rechazó tu solicitud de amistad', NULL, NULL, 1),
(68, 1, 3, '2019-07-14 10:24:43', 1, '@martabot te ha enviado una solicitud de amistad', NULL, NULL, 1),
(69, 3, 1, '2019-07-14 10:24:57', 1, '@usuario1 rechazó tu solicitud de amistad', NULL, NULL, 1),
(70, 3, 1, '2019-07-14 10:25:06', 1, '@usuario1 te ha enviado una solicitud de amistad', NULL, NULL, 1),
(71, 1, 3, '2019-07-14 10:25:22', 1, '@martabot aceptó tu solicitud de amistad', NULL, NULL, 1),
(72, 1, 3, '2019-07-14 10:30:17', 1, '@martabot te elimino como amigo', NULL, NULL, 1),
(73, 1, 3, '2019-07-14 12:40:44', 1, '@martabot ha comentado tu post', 17, 115, 0),
(74, 1, 3, '2019-07-14 18:58:58', 1, '@martabot ha comentado tu post', 17, 117, 0),
(75, 1, 6, '2019-07-15 02:33:59', 0, '@martabot te ha enviado una solicitud de amistad', NULL, NULL, 1),
(76, 13, 1, '2019-07-15 15:32:19', 1, '@la_pame te ha enviado una solicitud de amistad', NULL, NULL, 1),
(77, 13, 1, '2019-07-15 15:32:47', 1, '@la_pame rechazó tu solicitud de amistad', NULL, NULL, 1),
(78, 13, 1, '2019-07-15 15:32:49', 1, '@la_pame te ha enviado una solicitud de amistad', NULL, NULL, 1),
(79, 13, 1, '2019-07-15 15:33:15', 0, '@la_pame ha comentado tu post', 54, 118, 0),
(80, 1, 13, '2019-07-15 15:33:54', 0, '@martabot aceptó tu solicitud de amistad', NULL, NULL, 1),
(81, 7, 1, '2019-07-15 15:36:27', 0, '@cuentaLoca ha comentado tu post', 27, 119, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `isoCode` varchar(5) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `isoCode`, `nombre`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'North Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'SS', 'South Sudan'),
(203, 'ES', 'Spain'),
(204, 'LK', 'Sri Lanka'),
(205, 'SH', 'St. Helena'),
(206, 'PM', 'St. Pierre and Miquelon'),
(207, 'SD', 'Sudan'),
(208, 'SR', 'Suriname'),
(209, 'SJ', 'Svalbard and Jan Mayen Islands'),
(210, 'SZ', 'Swaziland'),
(211, 'SE', 'Sweden'),
(212, 'CH', 'Switzerland'),
(213, 'SY', 'Syrian Arab Republic'),
(214, 'TW', 'Taiwan'),
(215, 'TJ', 'Tajikistan'),
(216, 'TZ', 'Tanzania, United Republic of'),
(217, 'TH', 'Thailand'),
(218, 'TG', 'Togo'),
(219, 'TK', 'Tokelau'),
(220, 'TO', 'Tonga'),
(221, 'TT', 'Trinidad and Tobago'),
(222, 'TN', 'Tunisia'),
(223, 'TR', 'Turkey'),
(224, 'TM', 'Turkmenistan'),
(225, 'TC', 'Turks and Caicos Islands'),
(226, 'TV', 'Tuvalu'),
(227, 'UG', 'Uganda'),
(228, 'UA', 'Ukraine'),
(229, 'AE', 'United Arab Emirates'),
(230, 'GB', 'United Kingdom'),
(231, 'US', 'United States'),
(232, 'UM', 'United States minor outlying islands'),
(233, 'UY', 'Uruguay'),
(234, 'UZ', 'Uzbekistan'),
(235, 'VU', 'Vanuatu'),
(236, 'VA', 'Vatican City State'),
(237, 'VE', 'Venezuela'),
(238, 'VN', 'Vietnam'),
(239, 'VG', 'Virgin Islands (British)'),
(240, 'VI', 'Virgin Islands (U.S.)'),
(241, 'WF', 'Wallis and Futuna Islands'),
(242, 'EH', 'Western Sahara'),
(243, 'YE', 'Yemen'),
(244, 'ZR', 'Zaire'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `titulo` varchar(500) NOT NULL,
  `cuerpo` varchar(5000) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `img1` varchar(500) DEFAULT NULL,
  `img2` varchar(500) DEFAULT NULL,
  `img3` varchar(500) DEFAULT NULL,
  `adjunto` varchar(500) DEFAULT NULL,
  `palabra1` varchar(50) DEFAULT NULL,
  `palabra2` varchar(50) DEFAULT NULL,
  `palabra3` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `privacidad` tinyint(1) NOT NULL DEFAULT '1',
  `votos` int(11) NOT NULL DEFAULT '0',
  `porMi` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `user`, `titulo`, `cuerpo`, `fecha`, `img1`, `img2`, `img3`, `adjunto`, `palabra1`, `palabra2`, `palabra3`, `status`, `privacidad`, `votos`, `porMi`) VALUES
(1, 1, 'Mi primer post publico', 'Esta es la primera vez que tengo la posibilidad de decir algo que sera escuchado', '2019-07-12 01:30:08', '', '', '', '', 'que', 'emocion', '', 1, 1, 0, 0),
(2, 1, 'Mi primer post privado', '      un show muy educado de gente muy docente', '2019-07-13 06:34:42', '', '', '', '', 'es', 'como un ', 'show', 1, 0, 0, 0),
(3, 2, 'Post publico de dos beibi', 'trece que te parecee', '2019-07-12 01:33:00', '', '', '', '', 'aca', 'al', 'rescate', 1, 1, 0, 0),
(4, 2, 'Aca me pongo more timido', '  yo no me atreveria a comparar', '2019-07-15 02:24:25', '', '', '', '', 'o me diste', 'mas', 'plata', 1, 1, 0, 0),
(5, 3, 'Esto es lo que la gente dice en publico', 'Post no ofensivo', '2019-07-12 01:36:09', '', '', '', '', 'todas', 'esas', 'webadas', 1, 1, 0, 0),
(6, 3, 'Y esto es lo que te hago en privado', 'no me pases por alto', '2019-07-12 01:36:34', '', '', '', '', '', '', '', 1, 0, 0, 0),
(7, 3, 'un poco de color al inicio muchachos que les parece', 'aca shre laaaakkkk', '2019-07-12 01:37:21', 'http://localhost/LABII/public/img/post/10a2f33935bde6ab.jpeg', '', '', '', 'jenniffer', 'anniston', '', 1, 1, 0, 0),
(8, 2, 'siempre hay un precio en sangre', 'Se puede pagar con dinero', '2019-07-12 01:41:15', '', '', '', '', '', '', '', 1, 1, 0, 0),
(9, 2, 'privado de luz', 'y de bus', '2019-07-12 01:41:30', '', '', '', '', '', '', '', 1, 0, 0, 0),
(10, 8, 'Fotografia', 'Registro fotografico personal en San Luis,Argentina', '2019-07-12 21:23:26', 'http://localhost/LABII/public/img/post/a8d309bdea725491.jpeg', '', '', '', 'originalcontent', 'photo', 'landscape', 1, 1, 0, 0),
(11, 1, 'Together we stand, divided we fall....', ' ', '2019-07-13 06:01:56', '', '', '', '', 'pink floyd ', 'musica ', 'paz mundial', 1, 1, 0, 0),
(12, 9, 'Ataque de ratas', 'El día viernes 23 de Octubre,  Sidney, una familia se enfrentó a una enorme cantidad de roedores infectados.', '2019-07-12 22:30:59', 'http://localhost/LABII/public/img/post/0a4ba83848473f20.jpeg', '', '', '', 'ratas ', 'ataque ', 'Infección', 0, 1, 0, 0),
(13, 9, 'Ataque de ratas 2', 'Las primeras ratas incubaron engendros dentro de los humanos y ahora son zombies.', '2019-07-12 22:33:42', 'http://localhost/LABII/public/img/post/f4cff2a2689d5a85.jpeg', '', '', '', 'ratas ', 'zombies \"apocalipsis', '', 0, 0, 0, 0),
(14, 3, 'para ', 'eliminar', '2019-07-13 06:08:53', '', '', '', '', '', '', '', 1, 1, 0, 0),
(15, 3, 'para ', 'eliminar', '2019-07-13 06:09:00', '', '', '', '', '', '', '', 1, 1, 0, 0),
(16, 3, 'para', 'eliminar', '2019-07-13 06:09:08', '', '', '', '', '', '', '', 1, 1, 0, 0),
(17, 3, 'no tengo', 'amigops', '2019-07-13 06:29:10', '', '', '', '', '', '', '', 1, 1, 0, 1),
(18, 7, 'Hola', 'publico', '2019-07-13 08:25:37', '', '', '', '', '', '', '', 1, 1, 0, 0),
(19, 7, 'Este hermoso lugar del mundo', 'Que bueno para tomarse unos mates', '2019-07-13 09:04:02', 'http://localhost/LABII/public/img/post/043cfad4555d9bec.jpeg', '', '', '', 'hermoso ', 'lugar ', 'mundo', 1, 1, 0, 0),
(20, 3, 'che, y...', 'Aca no va a pasar nada?', '2019-07-13 09:07:27', '', '', '', '', '', '', '', 1, 1, 0, 0),
(21, 10, 'mojito ', 'mojito se la banca', '2019-07-14 00:15:23', '', '', '', '', 'lauri ', 'mojito', '', 1, 1, 0, 0),
(22, 10, 'holis', '  soy david aguanten los numerostytuytu', '2019-07-14 02:41:23', '', '', '', '', '', '', '', 1, 1, 0, 0),
(23, 1, 'Hollis', ' ', '2019-07-14 03:24:11', '', '', '', '', '', '', '', 0, 1, 0, 1),
(24, 1, 'h', 'l', '2019-07-14 05:16:28', '', '', '', '', '', '', '', 0, 1, 0, 1),
(25, 1, 'j', 'j', '2019-07-14 05:17:51', '', '', '', '', '', '', '', 0, 1, 0, 1),
(26, 1, 'tirando codigo', '   ', '2019-07-14 05:49:56', '', '', '', '', 'aca ', 'en ', 'linus', 0, 1, 0, 1),
(27, 1, 'tirando codigo', ' ', '2019-07-14 18:52:27', 'http://localhost/LABII/public/img/post/bdd7f83f41830cc0.jpeg', '', '', '', 'aca ', 'en ', 'linus', 1, 1, 0, 0),
(28, 1, 'ldshflsh', 'ñdjfñsdjf', '2019-07-14 07:11:38', '', '', '', '', '', '', '', 0, 1, 0, 1),
(29, 3, 'uhiyuyiiu', 'oiyouo', '2019-07-14 11:36:18', 'http://localhost/LABII/public/img/post/1c2fa804d9d1b7b6.png', '', '', '', '', '', '', 0, 1, 0, 0),
(30, 1, 'fotis', '  zckl', '2019-07-14 15:42:26', '', '', '', '', 's', '', '', 0, 1, 0, 1),
(31, 1, 'lñksasldñ', 'kljl', '2019-07-14 15:43:10', '', '', '', '', 'lj', '', '', 0, 1, 0, 1),
(32, 1, 'asdlkj', '  lkjlkjlk', '2019-07-14 15:43:37', '', '', '', '', 'ljklj', '', '', 0, 1, 0, 1),
(33, 1, 'asdsad', '  asdas', '2019-07-14 15:52:15', '', '', '', '', '', '', '', 0, 1, 0, 1),
(34, 1, 'h', '  h', '2019-07-14 15:53:18', '', '', '', '', '', '', '', 0, 1, 0, 1),
(35, 1, 'j', '  j', '2019-07-14 15:54:48', '', '', '', '', '', '', '', 0, 1, 0, 1),
(36, 1, 'b', '  b', '2019-07-14 15:55:44', '', '', '', '', '', '', '', 0, 1, 0, 1),
(37, 1, 'h', '  h', '2019-07-14 15:58:25', '', '', '', '', '', '', '', 0, 1, 0, 1),
(38, 1, 'h', 'h', '2019-07-14 15:58:45', '', '', '', '', '', '', '', 0, 1, 0, 1),
(39, 1, 'j', '  j', '2019-07-14 15:59:03', '', '', '', '', '', '', '', 0, 1, 0, 1),
(40, 1, 'h', '  h', '2019-07-14 16:00:25', '', '', '', '', '', '', '', 0, 1, 0, 1),
(41, 1, 'j', '    j', '2019-07-14 16:07:08', '', '', '', '', '', '', '', 0, 1, 0, 1),
(42, 1, 'h', '  h', '2019-07-14 16:07:44', '', '', '', '', '', '', '', 0, 1, 0, 1),
(43, 1, 'kh', '  kjhkj', '2019-07-14 16:31:36', '', '', '', '', 'jhk', '', '', 0, 1, 0, 1),
(44, 1, 'jkjkhkjhkjh', 'kj', '2019-07-14 16:38:10', '', 'http://localhost/LABII/public/img/post/7f3f9da71baa1d2b.jpeg', 'http://localhost/LABII/public/img/post/9c8095317b6e61fc.jpeg', '', 'jhkjh', '', '', 0, 1, 0, 1),
(45, 1, 'h', 'h', '2019-07-14 16:39:41', '', 'http://localhost/LABII/public/img/post/2bc1731a253c814c.png', 'http://localhost/LABII/public/img/post/e38ddbd52a4eb1cf.jpeg', '', '', '', '', 0, 1, 0, 1),
(46, 1, 'll', '  lllllll', '2019-07-14 16:44:34', '', '', '', '', 'll', '', '', 0, 1, 0, 1),
(47, 1, 'kll', '  llklk', '2019-07-14 16:46:28', '', '', '', '', 'kl', '', '', 0, 1, 0, 1),
(48, 1, 'j', '                  j', '2019-07-14 16:54:09', NULL, NULL, NULL, '', '', '', '', 0, 1, 0, 1),
(49, 1, 'g', '      ksadjlkasjdlk', '2019-07-14 17:24:14', NULL, NULL, NULL, '', '', '', '', 0, 1, 0, 1),
(50, 1, 'h', '                      h', '2019-07-14 17:28:08', NULL, NULL, NULL, '', '', '', '', 0, 1, 0, 1),
(51, 1, 'g', '                          g', '2019-07-14 17:42:23', ' ', 'http://localhost/LABII/public/img/post/3453e9f2cd6a3015.jpeg', 'http://localhost/LABII/public/img/post/e61ff9177b79c789.jpeg', '', '', '', '', 0, 1, 0, 1),
(52, 1, 'h', '        h', '2019-07-14 17:43:53', ' ', 'http://localhost/LABII/public/img/post/fce71f769f346d77.jpeg', 'http://localhost/LABII/public/img/post/fbe0132b42019f36.jpeg', '', '', '', '', 0, 1, 0, 1),
(53, 1, 'h', '  h', '2019-07-14 17:47:44', ' ', 'http://localhost/LABII/public/img/post/ea3fee2e9f9eaec7.jpeg', 'http://localhost/LABII/public/img/post/75f01fa1263b6873.jpeg', '', '', '', '', 0, 1, 0, 1),
(54, 1, 'lau', 'lau', '2019-07-14 22:32:46', '', '', '', '', '', '', '', 1, 1, 0, 0),
(55, 3, 'perros', 'perros', '2019-07-15 12:21:06', '', '', '', '', 'perros', '', '', 1, 1, 0, 0),
(56, 11, 'Diagnóstico de la ehrlichiosis del perro', 'El organismo causante de este trastorno es una bacteria del género Ehrlichia, concretamente la Ehrlichia canis. Este organismo intracelular fue descubierto por primera vez en 1935, y desde entonces se ha detectado su presencia en perros, felinos y humanos, por lo que es considerada como una zoonosis.\r\n\r\nEsta bacteria es un parásito obligado, por lo que necesita un huésped para sobrevivir. De esta manera, se aloja en un vector biológico, en este caso la garrapata marrón del perro (Rhipicephalus sanguineus). La bacteria se almacena en el intestino y la saliva de la garrapata, y la transmisión se produce cuando otro perro es mordido por la garrapata.', '2019-07-15 15:24:56', 'http://localhost/LABII/public/img/post/cf15325bacf616e0.jpeg', '', '', '', 'perros ', 'salud ', 'medicina', 1, 1, 0, 0),
(57, 11, '“Los perros nunca mueren, duermen junto a tu corazón”', 'Para todos aquellos que consideran al perro como un miembro más de la familia, la muerte de un can se vive como una experiencia traumática y dolorosa.\r\n\r\nSolo quienes nunca compartieron parte de su vida con mascotas, o teniendo animales no saben o no quieren amarlos, pueden mostrarse indiferentes o incrédulos al dolor que provoca en mucha gente la pérdida de estos seres tan queridos.', '2019-07-15 15:26:00', 'http://localhost/LABII/public/img/post/8b639a36534c4470.jpeg', '', '', '', 'perro ', 'mejor amigo ', 'vida', 1, 1, 0, 0),
(58, 12, 'La alimentación de la tortuga de tierra', 'Es prácticamente imposible ofrecer en casa a una tortuga lo que comería en la naturaleza (gramíneas, dientes de león, juncos, plantas leguminosas…). Por eso, podemos optar por otras alternativas, pero siempre prestando atención a ciertas condiciones:\r\n\r\n    Que los alimentos que coma tengan una proporción 2:1 de calcio y fósforo.\r\n    Intentar que la gama vegetal de alimentos sea lo más variada posible.\r\n    No le ofrezcas proteína animal con asiduidad. Basta con hacerlo de forma ocasional y SÓLO si sabes seguro que la especie de tortuga que tienes no es exclusivamente vegetariana.\r\n', '2019-07-15 15:27:36', 'http://localhost/LABII/public/img/post/b13b13fdd5598719.jpeg', '', '', '', 'tortuga ', 'nutricion ', 'alimentacion', 1, 1, 0, 0),
(59, 12, 'Coprofagia en perros: ¿por qué mi perro se come las heces?', 'La coprofagia en perros puede aparecer en cachorros y adultos.\r\n\r\nCuando los perritos pequeños hacen sus necesidades y son reprendidos por sus dueños (porque aún están aprendiendo dónde deben hacer caca) pueden coger miedo a esa situación por las represalias y comenzar a comerse sus propias heces para evitar el castigo.', '2019-07-15 15:28:36', 'http://localhost/LABII/public/img/post/88e40f63f6b981a7.jpeg', '', '', '', 'perros ', 'salud ', 'caca', 1, 1, 0, 0),
(60, 12, 'Tarde de sol con Hipolito', 'Salimos a dar una vuelta al perro, cuando vuelva subo fotos', '2019-07-15 15:29:09', '', '', '', '', 'sol ', 'mates ', 'paseo', 1, 1, 0, 0),
(61, 13, '¡Combate la caspa en gatos!', 'No te lances a lavar a tu gato con geles o jabones específicos para la caspa, no antes de saber por qué la tiene. Es necesario conocer el origen de un problema para encontrar la solución más adecuada.', '2019-07-15 15:30:35', 'http://localhost/LABII/public/img/post/62169039364ebb12.jpeg', '', '', '', 'salud ', 'consejos ', 'gatos', 1, 1, 0, 0),
(62, 13, 'Caminante Oscuro', '  En este post quiero recordar a mi querdio compañero Caminante Oscuro, que en paz descances mi fiel amigo', '2019-07-15 15:32:10', 'http://localhost/LABII/public/img/post/e1804a5cc6f245d0.jpeg', 'http://localhost/LABII/public/img/post/397ab698389d6682.jpeg', '', '', 'triste ', 'recuerdos ', 'saludo', 1, 0, 0, 0),
(63, 7, 'Cómo hacer un baño de avena para perros', 'Echa los polvos de avena en la bañera y repártelos bien, removiendo con tu mano para que se disuelvan. Mete a tu perro y báñalo con ese agua, que está llena de las excelentes propiedades calmantes de la avena. Lávalo insistiendo bien en las zonas más afectadas. ¡Que esté un buen rato en remojo!\r\n\r\nDespués de este baño de avena para perros, ¡no lo enjuagues! Así la avena podrá seguir haciendo efecto. Sólo sácalo de la bañera y sécalo como harías normalmente. Hidratará su piel y calmará todas las molestias.', '2019-07-15 15:35:48', 'http://localhost/LABII/public/img/post/0eaf849c70adb256.jpeg', '', '', '', 'baño ', 'perro ', 'consejos', 1, 1, 0, 0),
(64, 8, 'Por qué a mi perro se le cae el pelo?', 'Tengo problemas con mi perrito... se le cae todo el pelo se esta quedando mas pelado que mi marido... ayudaaa!!!!', '2019-07-15 15:45:20', '', '', '', '', 'perro ', 'consulta', '', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `salt` varchar(500) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `fechaAlta` datetime NOT NULL,
  `adminUltMod` int(11) DEFAULT NULL,
  `fechaUltMod` datetime NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `bday` date NOT NULL,
  `mail` varchar(500) NOT NULL,
  `profilePic` varchar(500) NOT NULL,
  `pais` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `pass`, `salt`, `status`, `fechaAlta`, `adminUltMod`, `fechaUltMod`, `nombre`, `apellido`, `bday`, `mail`, `profilePic`, `pais`) VALUES
(1, 'martabot', '4cb883d80bce15689d207338bbb2a0de38b3973e29c72dc3643bbfcfa0c501a9', '828be8cd4e0a92e65abb95d64fc7dad284e361486e95cc5e491aec538c9363b8', 1, '2019-07-12 01:27:52', NULL, '2019-07-12 18:47:22', 'Laura', 'Galeano', '2019-07-12', 'laubabosamail@gmail.com', 'http://localhost/LABII/public/img/profile/martabot.jpeg', 109),
(2, 'usuario2', 'b429d52dea0420bdc03239d36ca4c8211171dba3b6664a208728d3e19b9f7642', '302e5dc8eb5032cfa22643408e3760d65f19c3a68cb638defb33ede001fafce9', 1, '2019-07-12 01:31:51', NULL, '2019-07-13 08:56:59', 'Usuario', 'Dos', '2019-07-13', 'u@dos.com', 'http://localhost/LABII/public/img/profile/usuario2.jpeg', 195),
(3, 'Usuario1', '37ef24e53d0e310f07f73bb544de9dd8e192fc153dd687badef0b47bec295ade', 'fb9d4fe269ecf6972e08f8f8ef92d01e46c18d00bf93eeede6585222d13d9072', 1, '2019-07-12 01:34:19', NULL, '2019-07-12 01:34:19', 'Usuario', 'Uno', '1986-03-31', 'elmaspio@mail.com', 'https://data.whicdn.com/images/325337009/large.jpg', 16),
(4, 'usuario3', '7c58bdf3a98ae38db349e846f4837e92d871ddf1a3eb250222be7d3bda74aa96', 'f932f0cd6ff59ec3030ae85a8f65eebc6d4a6a4c31c0d0a7459925ee451324c3', 0, '2019-07-12 01:37:57', NULL, '2019-07-12 01:37:57', 'Usuario', 'Tres', '1312-03-12', 'mail@mail.com', 'https://data.whicdn.com/images/325337009/large.jpg', 12),
(5, 'Azul_SS', 'ededc61e29656312a3e3575bcab9011e54721b17d8103af11b80ab0144ff5550', 'd38bbda52514adf8dc808e401e832555eaa830aa5befb77082a41a1ee41d624b', 1, '2019-07-12 20:05:58', NULL, '2019-07-12 20:05:58', 'Azul', 'Niebas', '1995-10-19', 'azuldul@gmail.com', 'https://data.whicdn.com/images/325337009/large.jpg', 10),
(6, 'laulau', 'd1cf8b3ce2b02f330d0c7c1cb850c0b7d9d6dd265dd47bb5c3c61f93999e5205', '27040f832e618e3c919ff5c3014131f8b2e834d80b8ebabbcbe714ccdd19a5e5', 1, '2019-07-12 20:09:21', NULL, '2019-07-12 20:09:21', 'l', 'l', '3288-04-08', 'l@l.com', 'https://data.whicdn.com/images/325337009/large.jpg', 23),
(7, 'cuentaLoca', '76e693b558e396c638b5a7a4ee87a1c54c0f468ca110332dd64033071eb601a3', '1e4c70b71dea9b55e6bb0466665f561c38e73abb2bb09c851720b7273e93e8d4', 1, '2019-07-12 20:57:30', NULL, '2019-07-12 20:57:30', 'Lau', 'LAu', '2131-03-12', 'lau@lau.com', 'https://data.whicdn.com/images/325337009/large.jpg', 13),
(8, 'Miss_Blue', '560e614dbef5ade5eb9528fa5d4896a60daf6fbccce4ee416a416846aa83e09a', '01d6dabab2c99e864901d28bf4b2b0c71f9335f25b2bf3ffd20d7442fc4abc72', 1, '2019-07-12 21:09:58', NULL, '2019-07-12 21:27:05', 'Azul', 'Niebas', '2019-07-12', 'azuldul@hotmail.com', 'http://localhost/LABII/public/img/profile/Miss_Blue.jpeg', 10),
(9, 'FUEGUINO', '3504ca241c51e6453bcb42064e3f4fc21176ffe2c65e64798807c0ba0ff63124', 'd2bc8e6e63f7662604ccdc55756149ca66395d4c42a40d88e56eab5c428aeb2d', 1, '2019-07-12 22:12:59', NULL, '2019-07-12 22:19:17', 'Luis', 'Torres', '2019-07-12', 'r.a@hotmail.com', 'http://localhost/LABII/public/img/profile/FUEGUINO.jpeg', 8),
(10, 'david.9', '40ee3474e0eb7da05d956132e0c09c5a9394a77b4f8e39a29a7003428c2921eb', '3c3aa94c012a2f6e2a8a7a19392b9ecc23ae1594c1a7f77168b5599f5a9c701d', 1, '2019-07-14 00:11:23', NULL, '2019-07-15 15:39:38', 'david', 'ponce', '2019-07-15', 'david-9@outlook.com', 'http://localhost/LABII/public/img/profile/david.9.gif', 117),
(11, 'usuario6', '8db1343468629f857cc616a66a15a6f4507a215523e7b139dc53476e22df828b', 'a2416ee48b7455d34a4de06517b0c346485138dad65e7fae04f2e9713156936a', 1, '2019-07-15 15:21:26', NULL, '2019-07-15 15:21:26', 'Maria', 'Bordagorry', '2024-09-18', 'm@b.com', 'https://data.whicdn.com/images/325337009/large.jpg', 19),
(12, 'usuario7', 'e01e06149e80a399e17a613bcfe260df638893123480756b22f3a40ce3c4c5a7', 'a2583cf401196c90d8754ce8dc577e4e7a5b5f07f5cde768e2216611abc76e61', 1, '2019-07-15 15:21:57', NULL, '2019-07-15 15:21:57', 'Nicolas', 'Avellaneda', '1979-05-23', 'n@a.c', 'https://data.whicdn.com/images/325337009/large.jpg', 52),
(13, 'la_pame', '4138aa874555a928f2e48261753753ab87afbd594bab95b30bf38bc7ff5ba3e8', '8314f935cb5f2dacec0541862e44b028ee9c92ead0b42fd9b0017a8335261e04', 1, '2019-07-15 15:22:33', NULL, '2019-07-15 15:22:33', 'Pamela', 'Tavarez', '2012-03-31', 'p@t.c', 'https://data.whicdn.com/images/325337009/large.jpg', 34),
(14, 'bot1', '64a67556007cd340780020aa8663193525286bee5292c7475ce537b0b981f108', '7a3e1d053f0083dda2d12a3ab9dee64bc6ba0d1b1b62ec7d5ee8175e22e2af8f', 1, '2019-07-15 15:23:02', NULL, '2019-07-15 15:23:02', 'Cristiano', 'Bot', '1983-04-15', 'c@b.c', 'https://data.whicdn.com/images/325337009/large.jpg', 19);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `amigo`
--
ALTER TABLE `amigo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user1` (`user1`),
  ADD KEY `user2` (`user2`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `post` (`post`);

--
-- Indices de la tabla `denunciaCom`
--
ALTER TABLE `denunciaCom`
  ADD PRIMARY KEY (`idCom`,`idUsuario`,`dFecha`),
  ADD KEY `idModerador` (`idModerador`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `denunciaPost`
--
ALTER TABLE `denunciaPost`
  ADD PRIMARY KEY (`idPost`,`idUsuario`,`dFecha`),
  ADD KEY `idModerador` (`idModerador`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `interes`
--
ALTER TABLE `interes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indices de la tabla `moderador`
--
ALTER TABLE `moderador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modifica` (`adminUltMod`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user1` (`user1`),
  ADD KEY `user2` (`user2`),
  ADD KEY `comentario` (`comentario`),
  ADD KEY `post` (`post`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publica` (`user`);
ALTER TABLE `post` ADD FULLTEXT KEY `clave` (`palabra1`,`palabra2`,`palabra3`);
ALTER TABLE `post` ADD FULLTEXT KEY `descripcion` (`titulo`,`cuerpo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`adminUltMod`),
  ADD KEY `pais` (`pais`);
ALTER TABLE `usuario` ADD FULLTEXT KEY `personas` (`username`,`nombre`,`apellido`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `amigo`
--
ALTER TABLE `amigo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT de la tabla `interes`
--
ALTER TABLE `interes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `moderador`
--
ALTER TABLE `moderador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigo`
--
ALTER TABLE `amigo`
  ADD CONSTRAINT `amigo_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `amigo_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `post` FOREIGN KEY (`post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario` FOREIGN KEY (`user`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `denunciaCom`
--
ALTER TABLE `denunciaCom`
  ADD CONSTRAINT `denunciaCom_ibfk_1` FOREIGN KEY (`idCom`) REFERENCES `comentario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `denunciaCom_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `denunciaCom_ibfk_3` FOREIGN KEY (`idModerador`) REFERENCES `moderador` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `denunciaPost`
--
ALTER TABLE `denunciaPost`
  ADD CONSTRAINT `denunciaPost_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `denunciaPost_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `denunciaPost_ibfk_3` FOREIGN KEY (`idModerador`) REFERENCES `moderador` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `interes`
--
ALTER TABLE `interes`
  ADD CONSTRAINT `interes_ibfk_1` FOREIGN KEY (`user`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `moderador`
--
ALTER TABLE `moderador`
  ADD CONSTRAINT `crea-modifica` FOREIGN KEY (`adminUltMod`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notificacion_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notificacion_ibfk_3` FOREIGN KEY (`post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notificacion_ibfk_4` FOREIGN KEY (`comentario`) REFERENCES `comentario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `padre` FOREIGN KEY (`user`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `modifica` FOREIGN KEY (`adminUltMod`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`pais`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
