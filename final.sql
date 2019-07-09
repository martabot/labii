-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-07-2019 a las 04:52:03
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
  `fechaAlta` date NOT NULL,
  `adminUltMod` int(11) DEFAULT NULL,
  `fechaUltMod` date NOT NULL,
  `mail` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 18, 8, 2, '2019-07-09 03:15:10'),
(2, 18, 8, 2, '2019-07-09 03:17:41'),
(3, 18, 16, 1, '2019-07-09 03:17:50'),
(4, 16, 9, 1, '2019-07-09 03:19:09'),
(5, 9, 8, 0, '2019-07-09 04:33:33'),
(6, 21, 8, 0, '2019-07-09 04:36:34'),
(7, 21, 16, 0, '2019-07-09 04:36:39'),
(8, 21, 9, 0, '2019-07-09 04:36:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `post` int(11) NOT NULL,
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
(156, 9, 35, 'hola', '2019-07-08 00:13:58', 0, 1, 1),
(157, 9, 35, 'que tal', '2019-07-08 00:14:01', 0, 1, 1),
(158, 9, 35, 'bien vos?', '2019-07-08 00:14:06', 0, 1, 1),
(159, 9, 35, 'genial', '2019-07-08 00:14:09', 0, 1, 1),
(160, 9, 34, 'nuevo comentario', '2019-07-08 00:41:43', 0, 1, 1),
(161, 9, 34, 'ah mira vos', '2019-07-08 00:41:46', 0, 1, 1),
(162, 9, 37, 'Que rica TECLADISTAAA', '2019-07-08 05:53:48', 0, 1, 1),
(163, 16, 36, 'MUY BUEEEEE', '2019-07-08 05:54:01', 0, 1, 1),
(164, 9, 36, 'holisss', '2019-07-08 05:55:40', 0, 1, 1),
(165, 18, 41, 'nbnknk', '2019-07-08 06:40:00', 0, 1, 1),
(166, 18, 39, 'holiiiisss', '2019-07-08 06:40:14', 0, 1, 1),
(167, 18, 43, 'jhkhk', '2019-07-08 06:46:02', 0, 1, 1),
(168, 18, 39, 'jhhjgh', '2019-07-08 06:46:16', 0, 1, 1),
(169, 19, 42, 'quew ondsaaa', '2019-07-08 06:47:03', 0, 1, 1),
(170, 9, 45, 'Que rico mi amorrrr', '2019-07-08 22:18:43', 0, 1, 1),
(171, 9, 46, 'vos podes lauchi\r\n', '2019-07-08 22:19:42', 0, 1, 1),
(172, 8, 36, 'que onda por acaa', '2019-07-09 00:00:49', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncia_com`
--

CREATE TABLE `denuncia_com` (
  `idCom` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `idModerador` int(11) NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `fechaMod` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `denuncia_post`
--

CREATE TABLE `denuncia_post` (
  `idPost` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idModerador` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `motivo` varchar(50) NOT NULL,
  `fechaMod` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `post` int(11) DEFAULT NULL,
  `comentario` int(11) DEFAULT NULL,
  `amigo` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`id`, `user1`, `user2`, `fecha`, `status`, `descripcion`, `post`, `comentario`, `amigo`) VALUES
(26, 9, 8, '2019-07-09 04:33:33', 0, '@martabot1', NULL, NULL, 1),
(27, 21, 8, '2019-07-09 04:36:34', 0, '@otroGato te ha enviado una solicitud de amistad', NULL, NULL, 1),
(28, 21, 16, '2019-07-09 04:36:39', 0, '@otroGato te ha enviado una solicitud de amistad', NULL, NULL, 1),
(29, 21, 9, '2019-07-09 04:36:47', 0, '@otroGato te ha enviado una solicitud de amistad', NULL, NULL, 1);

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
  `votos` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `user`, `titulo`, `cuerpo`, `fecha`, `img1`, `img2`, `img3`, `adjunto`, `palabra1`, `palabra2`, `palabra3`, `status`, `privacidad`, `votos`) VALUES
(32, 9, 'Hollis', 'Primer post de mi', '2019-07-07 20:23:17', 'http://localhost/LABII/public/img/post/9e63e4f136aea83c.png', '', '', '', 'palabra1 ', 'palabra2 ', 'palabra3', 1, 1, 0),
(33, 9, 'Otro post', 'cuerpo del otro post', '2019-07-07 20:51:11', '', '', '', '', 'palabra1 ', 'palabra2 ', 'palabra3', 1, 1, 0),
(34, 9, 'el diaaa esta lindo para salir a pasear a tu puta mascota', 'huihiuhiuh', '2019-07-07 21:57:24', '', '', '', '', 'palabra1 ', 'palabra2 ', 'palabra3', 1, 1, 0),
(35, 9, 'sdtsdf', 'ghghghjhj', '2019-07-08 00:09:12', '', '', '', '', 'hh', '', '', 1, 1, 0),
(36, 16, 'Nuevo Post', 'Este post va para vos mi amor', '2019-07-08 02:20:08', '', '', '', '', 'palabra1 ', 'palabra2 ', 'palabra3', 1, 1, 0),
(37, 9, 'Hollis', 'kljlkjl', '2019-07-08 05:53:32', 'http://localhost/LABII/public/img/post/dff0f72a800df351.png', '', '', '', 'mentira', '', '', 1, 1, 0),
(38, 17, 'post usuario 1', 'kasjdlkaskdl', '2019-07-08 06:30:38', '', '', '', '', 'mentira', '', '', 1, 1, 0),
(39, 17, 'Hollis', 'otro gatooo', '2019-07-08 06:30:54', '', '', '', '', 'gatito', 'perrito', 'tuquita', 1, 1, 0),
(40, 18, 'Mi primer post', 'usuario 2', '2019-07-08 06:31:28', '', '', '', '', 'usuario', '', '', 1, 1, 0),
(41, 18, 'Hollis', 'nhnnnn', '2019-07-08 06:39:53', '', '', '', '', 'mentira', '', '', 1, 1, 0),
(42, 18, 'sdtsdf', 'jhhguykytry', '2019-07-08 06:40:51', '', '', '', '', 'sdfs', '', '', 1, 1, 0),
(43, 18, 'Hollis', 'jjjj', '2019-07-08 06:45:58', '', '', '', '', 'palabra1 ', 'palabra2 ', 'palabra3', 1, 1, 0),
(44, 9, 'Hoy es un buen dia para adelantar con el TP', 'Este es mi bomboncito ????', '2019-07-08 19:54:48', 'http://localhost/LABII/public/img/post/51b43a1960abc4c5.jpeg', '', '', '', '', '', '', 1, 1, 0),
(45, 9, 'Hoy es un buen dia para adelantar con el TP', 'Este es mi bomboncito ????', '2019-07-08 19:55:11', 'http://localhost/LABII/public/img/post/d34ea3cd15d8aff5.jpeg', '', '', '', '', '', '', 1, 1, 0),
(46, 9, 'Hollis', 'Aca terminando el inicio', '2019-07-08 22:19:23', 'http://localhost/LABII/public/img/post/452b498a1f908e62.png', '', '', '', 'terminando', '', '', 1, 1, 0),
(47, 16, 'el diaaa esta lindo para salir a pasear a tu puta mascota', 'para mi novia Laura que la amo mucho', '2019-07-09 00:26:41', 'http://localhost/LABII/public/img/post/e750bd777c83d670.png', '', '', '', 'reconcha ', 'de la lora', 'conchinchilla', 1, 1, 0),
(48, 8, 'PAra probar', 'Este post publico de c', '2019-07-09 02:43:20', '', '', '', '', '', 'guardando', 'notificaciones', 1, 1, 0);

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
  `fechaAlta` date NOT NULL,
  `adminUltMod` int(11) DEFAULT NULL,
  `fechaUltMod` date NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `bday` datetime NOT NULL,
  `mail` varchar(500) NOT NULL,
  `profilePic` varchar(500) NOT NULL,
  `pais` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `pass`, `salt`, `status`, `fechaAlta`, `adminUltMod`, `fechaUltMod`, `nombre`, `apellido`, `bday`, `mail`, `profilePic`, `pais`) VALUES
(8, 'c', '06302ff28b93e362f6f361c93ebd32c9920a836ebd9d0c6eeb688d38ad9849c9', '4f65e95589c8f979ae57bc59335cea7dbae6bb493496502cf14b61f7a45f6061', 1, '2019-07-06', NULL, '2019-07-08', 'Perfil ', 'de C', '2019-07-08 00:00:00', 'ccc@gm.c', 'https://data.whicdn.com/images/332357097/large.jpg', 1),
(9, 'martabot', '4f25993856e8965102571b8da78b605f4d0121ce9f623a021f6c9a4432e3eb7f', '6cb696b5d27478aad344fdda943e734244cc858e8aa43fbe18fae4c30bda7d9c', 1, '2019-07-06', NULL, '2019-07-08', 'Laura', 'Galeano', '2019-07-08 00:00:00', 'laubabosamail@gmail.com', 'http://localhost/LABII/public/img/profile/martabot.png', 10),
(10, 'Blue.sn', '775a06b680d60abc05dda6e45a55dfcc91c8abf4f646fe201723b15a063dc995', '96ebe4eb0927998cd3cb5919c4f4efe2367c1582e0d696d8519d826b9bff554c', 1, '2019-07-06', NULL, '2019-07-06', 'Azul', 'Niebas', '1995-10-19 00:00:00', 'azuldul@gmail.com', 'https://data.whicdn.com/images/332357097/large.jpg', 10),
(12, 'lauris', '6e2ffa9a2f0895600eb459130b21f531be82813afcf748711d1dca821c9df6c7', '095bc500fc2c571435a18ae65c48c08a8a652ea423492480f8e4f86b63d40ff2', 1, '2019-07-06', NULL, '2019-07-06', 'Laura', 'Galeano', '2019-07-06 00:00:00', 'laubabosamail@gmail.com', 'http://localhost/LABII/public/img/profile/lauris.png', 10),
(13, '', '', '', 1, '0000-00-00', NULL, '2019-07-06', ' Laura', ' Galeano', '2019-07-06 00:00:00', ' laubabosamail@gmail.com', '/var/www/html/LABII/public/img/profile/lauris.png', 10),
(14, 'elbigbangbang', 'dbbc6468bc25a2a642cf5ebe03fbc7524b4797d4825776d975a98aceeb2c039b', 'db434cd65b15670da4873dfb871cd40d187c2f97a82bf336ba00d578fb2f9c85', 1, '2019-07-06', NULL, '2019-07-06', 'Florencia', 'Bordagorry', '2019-07-06 00:00:00', 'flor@mail.com', 'http://localhost/LABII/public/img/profile/elbigbangbang.png', 10),
(15, 'martabote', 'cbc0b36436fb43ab39dcde89cbf253231ec45f881cf058215957f638baacb488', '8ccb1b07c09dc4492090d983d9e4454e15042884192e4e6bcb0765599dad6d7d', 1, '2019-07-06', NULL, '2019-07-06', 'Laura', 'Galeano', '2019-07-06 00:00:00', 'laubabosamail@gmail.com', 'http://localhost/LABII/public/img/profile/martabote.gif', 112),
(16, 'sr tomphson', 'cfa4270d696756a1c2ef67e5ec0c4d0dc0110843d0075fb052220caf70038ac8', 'ee5b8a8936752e839a869daf6e58d20fe61f220dbfa839e92f807887e56323ad', 1, '2019-07-07', NULL, '2019-07-07', 'claudio', 'Suarez', '2019-07-07 00:00:00', 'friki@hotmail.com', 'http://localhost/LABII/public/img/profile/sr tomphson.jpeg', 148),
(17, 'usuario1', 'd8362259cf7ee9d391bb7077670da1d0a1b4456b8d3870393ed49ecdc161d694', '0e69aadb4d6e4dcf415b89ae5f97de1acd4f7bed321a24b0e5e0a900ec517ff9', 1, '2019-07-08', NULL, '2019-07-08', 'usuario', 'uno', '2019-07-01 00:00:00', 'usuario@uno.com', 'https://data.whicdn.com/images/332357097/large.jpg', 19),
(18, 'usuario2', '1e72e56a63262cc36c259c620b57847b97a1b44d921697ecd513d464886b6a48', 'df32a20f895d591a0852cbdb189fe4c005c39334065f3a76d87b0564a3047e01', 1, '2019-07-08', NULL, '2019-07-08', 'usuario', 'dos', '2019-07-02 00:00:00', 'usuario@dos.com', 'https://data.whicdn.com/images/332357097/large.jpg', 167),
(19, 'usuario3', '98838bb62f8ce4200f6f390702499801f5f41d79277e7c7d7e06003137a2874b', 'a44b6dd2f9d1aecd1671d837a6fbcfaca3b2ea558e4e6d1214dc9d903e5a21e4', 1, '2019-07-08', NULL, '2019-07-08', 'usuario', 'tres', '2019-07-08 00:00:00', 'usuario@tres.com', 'https://data.whicdn.com/images/332357097/large.jpg', 218),
(20, 'personaNueva', '1217db7a8c915f6808e4ee19509a3f326099995689eec0a114d8bcde57bc2d4f', '83b0f903f381a1adc772025ea2d0938ef42625192de9d9b92c0d7c6b210fe29f', 1, '2019-07-08', NULL, '2019-07-08', 'Laura', 'Galeano', '2542-04-23 00:00:00', 'laubabosamail@gmail.com', 'https://data.whicdn.com/images/332357097/large.jpg', 1),
(21, 'otroGato', '38f0375418f2e3dbc6bcdb08e4867bac0e05eff2acd6cb776496ef09820da479', 'd1e86d10320f44eb7cd6cfdbbb08182d05c68338ebb27ed1b1c880a7d92a1ab0', 1, '2019-07-09', NULL, '2019-07-09', 'L', 'g', '7280-04-28 00:00:00', 'laubabosamail@gmail.com', 'https://data.whicdn.com/images/332357097/large.jpg', 1);

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
-- Indices de la tabla `denuncia_com`
--
ALTER TABLE `denuncia_com`
  ADD PRIMARY KEY (`idCom`,`idUsuario`,`fecha`),
  ADD KEY `idModerador` (`idModerador`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `denuncia_post`
--
ALTER TABLE `denuncia_post`
  ADD PRIMARY KEY (`idPost`,`idUsuario`,`fecha`),
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

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`adminUltMod`),
  ADD KEY `pais` (`pais`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `amigo`
--
ALTER TABLE `amigo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;
--
-- AUTO_INCREMENT de la tabla `interes`
--
ALTER TABLE `interes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `moderador`
--
ALTER TABLE `moderador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
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
-- Filtros para la tabla `denuncia_com`
--
ALTER TABLE `denuncia_com`
  ADD CONSTRAINT `denuncia_com_ibfk_1` FOREIGN KEY (`idCom`) REFERENCES `comentario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `denuncia_com_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `denuncia_com_ibfk_3` FOREIGN KEY (`idModerador`) REFERENCES `moderador` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `denuncia_post`
--
ALTER TABLE `denuncia_post`
  ADD CONSTRAINT `denuncia_post_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `denuncia_post_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `denuncia_post_ibfk_3` FOREIGN KEY (`idModerador`) REFERENCES `moderador` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
