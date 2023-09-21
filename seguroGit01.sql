-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.24-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para seguro
CREATE DATABASE IF NOT EXISTS `seguro` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `seguro`;

-- Volcando estructura para tabla seguro.automovil
CREATE TABLE IF NOT EXISTS `automovil` (
  `id_automovil` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `patente` varchar(20) NOT NULL,
  `modelo` year(4) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_tipo_automovil` int(11) NOT NULL,
  `activo` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_automovil`),
  UNIQUE KEY `Patente` (`patente`) USING BTREE,
  KEY `id_cliente` (`id_cliente`),
  KEY `id_marca` (`id_marca`),
  KEY `id_tipo_automovil` (`id_tipo_automovil`),
  CONSTRAINT `FK_automovil_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_automovil_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_automovil_tipo_automovil` FOREIGN KEY (`id_tipo_automovil`) REFERENCES `tipo_automovil` (`id_tipo_automovil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.automovil: ~18 rows (aproximadamente)
INSERT INTO `automovil` (`id_automovil`, `id_cliente`, `patente`, `modelo`, `id_marca`, `id_tipo_automovil`, `activo`) VALUES
	(109, 147, 'QWE-UPD2', '2000', 177, 3, b'1'),
	(110, 145, 'QWE-002', '2023', 16, 3, b'1'),
	(111, 51, 'QWE-003', '1999', 90, 2, b'1'),
	(113, 22, 'EDT-001-test2', '2019', 177, 3, b'1'),
	(114, 147, 'qwe-005', '2023', 343, 1, b'1'),
	(115, 51, 'PRU-001', '1999', 90, 2, b'1'),
	(118, 147, 'qwe-006', '2021', 343, 2, b'0'),
	(119, 145, 'PRU002', '1999', 18, 2, b'1'),
	(120, 145, 'PRU-002', '1999', 18, 2, b'1'),
	(121, 145, 'PRU-007', '1999', 18, 2, b'1'),
	(123, 115, 'PRU-008', '1999', 18, 2, b'1'),
	(129, 115, 'PRU-009', '1999', 18, 2, b'1'),
	(130, 51, 'PRU-005', '1919', 177, 3, b'1'),
	(131, 51, 'zzzzzz', '1995', 177, 3, b'1'),
	(132, 115, 'PRU1-001', '0000', 177, 3, b'1'),
	(133, 22, 'EDT-001-test3', '1995', 177, 3, b'0'),
	(135, 22, 'USR2-001', '0000', 177, 2, b'1'),
	(137, 145, 'TEST-001', '2023', 23, 1, b'1'),
	(138, 7, 'Uperfil-001', '1995', 4, 1, b'1');

-- Volcando estructura para tabla seguro.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `apellido` varchar(50) NOT NULL DEFAULT '',
  `dni` varchar(50) DEFAULT NULL,
  `calle` varchar(50) DEFAULT '',
  `numero_calle` varchar(50) DEFAULT '',
  `localidad` varchar(50) DEFAULT '',
  `email` varchar(150) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT 'No informa',
  `activo` bit(1) NOT NULL DEFAULT b'1',
  `cod_provincia` char(10) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_empleado`),
  UNIQUE KEY `dni` (`dni`),
  KEY `cod_provincia` (`cod_provincia`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `FK_cliente_provincia` FOREIGN KEY (`cod_provincia`) REFERENCES `provincia` (`cod_provincia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_cliente_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8 COMMENT='Es la tabla CLIENTE, no le cambio los datos para no modificar todo el programa.';

-- Volcando datos para la tabla seguro.cliente: ~150 rows (aproximadamente)
INSERT INTO `cliente` (`id_empleado`, `nombre`, `apellido`, `dni`, `calle`, `numero_calle`, `localidad`, `email`, `telefono`, `activo`, `cod_provincia`, `id_usuario`) VALUES
	(1, 'Melina', 'Jerisch', '70-016-2392', 'Vidon', '006', 'San Cristóbal', 'mjerisch0@dropbox.com', '452-716-6382', b'1', NULL, NULL),
	(2, 'Ursala', 'Dumbarton', '51-035-2373', 'Holy Cross', '1', 'Alcácer do Sal', 'udumbarton1@alibaba.com', '962-841-7564', b'1', NULL, NULL),
	(3, 'Eyde', 'Heasley', '62-448-0546', 'Vernon', '03097', 'Trzcińsko Zdrój', 'eheasley2@macromedia.com', '943-566-3689', b'1', NULL, NULL),
	(4, 'Rubia', 'Portman', '63-350-4443', 'Grayhawk', '2', 'Dayeuhluhur', 'rportman3@google.co.uk', '753-706-1917', b'1', NULL, NULL),
	(5, 'Ilyse', 'Gheorghe', '47-383-3293', 'Eagan', '50', 'Cigaleuh Kulon', 'igheorghe4@imgur.com', '288-824-3535', b'1', NULL, NULL),
	(6, 'Beatrix', 'Hentzeler', '63-581-9190', 'Pine View', '250', 'Bebedouro', 'bhentzeler5@mlb.com', '561-757-4296', b'1', NULL, NULL),
	(7, 'Anderea', 'Bowmer', '97-925-9162', 'Dapin', '776', 'Magsalangi', 'abowmer6@dedecms.com', '515-635-1243', b'1', NULL, 10),
	(8, 'Stephi', 'Toner', '60-937-2241', 'Algoma', '2', 'Fenghuangdong', 'stoner7@pbs.org', '738-830-0918', b'1', NULL, NULL),
	(9, 'Brena', 'Dacre', '24-612-8174', 'Scott', '5', 'Niebylec', 'bdacre8@walmart.com', '364-929-4101', b'1', NULL, NULL),
	(10, 'Gwendolin', 'Treffrey', '85-486-4430', 'Hazelcrest', '7', 'Socorro', 'gtreffrey9@time.com', '123-983-2573', b'1', NULL, NULL),
	(11, 'Lilly', 'Gracey', '04-159-4726', 'Almo', '09', 'Mae Lao', 'lgraceya@chron.com', '708-888-8945', b'1', NULL, NULL),
	(12, 'Randy', 'Guilder', '06-364-6721', 'Morrow', '657', 'Korsun’-Shevchenkivs’kyy', 'rguilderb@miitbeian.gov.cn', '258-788-7606', b'1', NULL, NULL),
	(13, 'Christiane', 'Stancliffe', '70-076-1391', 'Elgar', '9', 'Bla', 'cstancliffec@nyu.edu', '761-395-2666', b'1', NULL, NULL),
	(14, 'Maurizia', 'Hassett', '37-386-4846', 'Maryland', '59770', 'Kauman', 'mhassettd@dedecms.com', '352-150-1763', b'1', NULL, NULL),
	(15, 'Catherine', 'Brookwell', '70-136-4858', 'Clyde Gallagher', '925', 'Dlemer', 'cbrookwelle@wikispaces.com', '254-176-0362', b'1', NULL, NULL),
	(16, 'Maure', 'McAllan', '87-945-6340', 'Farragut', '08222', 'Agua Blanca', 'mmcallanf@1und1.de', '854-482-6042', b'1', NULL, NULL),
	(17, 'Reine', 'Pease', '87-539-8069', 'Pleasure', '03855', 'Zhamao', 'rpeaseg@linkedin.com', '187-563-0463', b'1', NULL, NULL),
	(18, 'Pearl', 'Ofield', '61-241-4408', 'Pierstorff', '5925', 'Rayevskiy', 'pofieldh@moonfruit.com', '452-265-5057', b'1', NULL, NULL),
	(19, 'Helsa', 'Phin', '66-777-2280', 'Blackbird', '0', 'Xikou', 'hphini@fema.gov', '422-557-6157', b'1', NULL, NULL),
	(20, 'Bobbette', 'Heath', '30-194-0965', 'Carioca', '7', 'Радовиш', 'bheathj@addtoany.com', '603-660-9120', b'1', NULL, NULL),
	(21, 'Pamella', 'Delion', '47-221-1427', 'Parkside', '0', 'Baikouquan', 'pdelionk@nationalgeographic.com', '874-310-8132', b'1', NULL, NULL),
	(22, 'Ainslee', 'MacRory', '20-508-3327', 'Hollow Ridge', '34', 'Maoming', 'amacroryl@deviantart.com', '858-341-1358', b'1', NULL, 1),
	(23, 'Cissy', 'Pavy', '07-531-1869', 'Fordem', '6', 'Jaguimitan', 'cpavym@army.mil', '607-421-6669', b'1', NULL, NULL),
	(24, 'Lil', 'Hodgon', '25-590-2681', 'Straubel', '7', 'Bihoro', 'lhodgonn@nationalgeographic.com', '680-927-8184', b'1', NULL, NULL),
	(25, 'Loella', 'Langston', '55-551-0345', 'Mendota', '80', 'Tanahmerah', 'llangstono@nifty.com', '294-685-7720', b'1', NULL, NULL),
	(26, 'Stace', 'Massinger', '93-300-2531', 'Derek', '6927', 'Libertad', 'smassingerp@salon.com', '847-231-6017', b'1', NULL, NULL),
	(27, 'Mireielle', 'Truse', '02-732-8651', 'Manufacturers', '34505', 'Guariba', 'mtruseq@toplist.cz', '636-265-8249', b'1', NULL, NULL),
	(28, 'Veriee', 'Welbourn', '68-676-1050', 'Bashford', '36269', 'Luis Donaldo Colosio', 'vwelbournr@hibu.com', '271-441-1297', b'1', NULL, NULL),
	(29, 'Garland', 'Tudhope', '27-812-5029', 'Vernon', '2147', 'Wolongquan', 'gtudhopes@earthlink.net', '782-986-6762', b'1', NULL, NULL),
	(30, 'Georgette', 'Phillpotts', '73-692-0295', 'Susan', '5504', 'Tondabayashichō', 'gphillpottst@un.org', '176-654-7266', b'1', NULL, NULL),
	(31, 'Louisa', 'Bomfield', '85-810-1608', 'Linden', '8', 'Peoria', 'lbomfieldu@wikispaces.com', '309-155-0608', b'1', NULL, NULL),
	(32, 'Edythe', 'Brasseur', '30-178-0749', 'Eagan', '4', 'Zhagang', 'ebrasseurv@pagesperso-orange.fr', '963-114-1317', b'1', NULL, NULL),
	(33, 'Fanni', 'Mollatt', '64-863-1413', 'Dovetail', '0', 'Aquidauana', 'fmollattw@huffingtonpost.com', '609-446-0213', b'1', NULL, NULL),
	(34, 'Starlene', 'Rodliff', '17-163-0223', 'Dottie', '134', '‘Ayn al Bayḑā', 'srodliffx@sourceforge.net', '728-138-2518', b'1', NULL, NULL),
	(35, 'Harmony', 'Trotton', '84-646-1305', 'Swallow', '6877', 'Burgos', 'htrottony@mapquest.com', '258-165-4766', b'1', NULL, NULL),
	(36, 'Charlot', 'Oherlihy', '70-890-5694', 'Ramsey', '68', 'Buk', 'coherlihyz@gravatar.com', '860-475-4712', b'1', NULL, NULL),
	(37, 'Inga', 'Burtwell', '36-029-1711', 'Wayridge', '00', 'Asamankese', 'iburtwell10@archive.org', '487-991-4408', b'1', NULL, NULL),
	(38, 'Lexy', 'Oakenfield', '83-975-4005', 'Porter', '2', 'Graksop', 'loakenfield11@rediff.com', '215-131-1631', b'1', NULL, NULL),
	(39, 'Paulie', 'Saurat', '19-357-9692', 'Dryden', '0', 'Arzakan', 'psaurat12@globo.com', '229-209-6916', b'1', NULL, NULL),
	(40, 'Bobbe', 'Crewther', '45-340-3002', 'Helena', '42947', 'Beoga', 'bcrewther13@abc.net.au', '759-746-0305', b'1', NULL, NULL),
	(41, 'Mureil', 'Konzel', '53-421-3910', 'Anderson', '53684', 'Darungan Lor', 'mkonzel14@vinaora.com', '560-487-8356', b'1', NULL, NULL),
	(42, 'Kamila', 'Eudall', '71-205-5822', 'Loftsgordon', '219', 'Sinŭiju', 'keudall15@cbslocal.com', '268-498-2336', b'1', NULL, NULL),
	(43, 'Sibilla', 'Pandya', '26-405-9184', '8th', '3648', 'Anicuns', 'spandya16@discovery.com', '828-872-9244', b'1', NULL, NULL),
	(44, 'Sheri', 'McCluskey', '27-238-5413', 'Crescent Oaks', '191', 'Tandil', 'smccluskey17@miibeian.gov.cn', '611-273-6962', b'1', NULL, NULL),
	(45, 'Eba', 'Chaters', '50-122-0236', 'Warbler', '9', 'Albert Town', 'echaters18@so-net.ne.jp', '639-812-1167', b'1', NULL, NULL),
	(46, 'Brandie', 'Blanchard', '93-454-1946', 'Chive', '7073', 'Nihaona', 'bblanchard19@howstuffworks.com', '177-808-4008', b'1', NULL, NULL),
	(47, 'Angele', 'Gartan', '47-735-9278', 'Armistice', '19', 'Gewanē', 'agartan1a@printfriendly.com', '522-172-2251', b'1', NULL, NULL),
	(48, 'Mozelle', 'Silverwood', '52-087-6126', 'Stoughton', '56568', 'Baleagung', 'msilverwood1b@google.nl', '963-503-2136', b'1', NULL, NULL),
	(49, 'Reggie', 'Latch', '45-728-0562', 'Namekagon', '87', 'Pupiales', 'rlatch1c@seesaa.net', '901-965-6257', b'1', NULL, NULL),
	(50, 'Danyelle', 'Greetham', '86-951-3162', 'Amoth', '84972', 'Usab', 'dgreetham1d@g.co', '569-612-2568', b'1', NULL, NULL),
	(51, 'Allegra', 'Bilston', '80-830-0284', 'Kropf', '7224', 'Llacanora', 'abilston1e@example.com', '861-510-9778', b'1', NULL, 1),
	(52, 'Samara', 'Prisley', '10-752-5162', 'Nobel', '31703', 'Calheta de Nesquim', 'sprisley1f@nhs.uk', '552-349-9689', b'1', NULL, NULL),
	(53, 'Deirdre', 'Gauntlett', '70-794-0037', 'Elmside', '5645', 'Bobigny', 'dgauntlett1g@joomla.org', '469-871-8122', b'1', NULL, NULL),
	(54, 'Delila', 'Campey', '66-224-9244', 'Mesta', '2924', 'Riachão das Neves', 'dcampey1h@shareasale.com', '143-441-2303', b'1', NULL, NULL),
	(55, 'Bari', 'Brimmell', '76-509-7529', 'Morning', '0', 'Matina', 'bbrimmell1i@ebay.com', '110-121-0034', b'1', NULL, NULL),
	(56, 'Nora', 'Bernardelli', '34-222-5882', 'Monument', '4330', 'Banjar Pangkungtibah Selatan', 'nbernardelli1j@reddit.com', '430-990-3217', b'1', NULL, NULL),
	(57, 'Waly', 'Hamilton', '77-913-6100', 'Rusk', '9', 'Timbaúba', 'whamilton1k@quantcast.com', '774-389-5709', b'1', NULL, NULL),
	(58, 'Josee', 'Toleman', '67-431-3975', 'Talisman', '232', 'Cinunjang', 'jtoleman1l@marriott.com', '381-833-1467', b'1', NULL, NULL),
	(59, 'Rona', 'Leverette', '86-835-1627', 'Grayhawk', '5392', 'Sam Khok', 'rleverette1m@freewebs.com', '523-163-0564', b'1', NULL, NULL),
	(60, 'Bebe', 'Goaks', '79-115-4148', 'Eastwood', '5', 'Greensboro', 'bgoaks1n@360.cn', '336-286-9251', b'1', NULL, NULL),
	(61, 'Isabel', 'Aslam', '38-357-4803', 'Fordem', '001', 'Ust’-Ilimsk', 'iaslam1o@cyberchimps.com', '664-102-2231', b'1', NULL, NULL),
	(62, 'Goldina', 'Willett', '36-747-5330', 'Logan', '4', 'Andrézieux-Bouthéon', 'gwillett1p@blog.com', '354-166-8233', b'1', NULL, NULL),
	(63, 'Kirstyn', 'Copestake', '52-172-2217', 'Muir', '43', 'La Paz de Oriente', 'kcopestake1q@plala.or.jp', '781-335-4846', b'1', NULL, NULL),
	(64, 'Annissa', 'Kemmish', '33-229-1437', 'Anthes', '9854', 'Toguchin', 'akemmish1r@dailymotion.com', '625-139-4054', b'1', NULL, NULL),
	(65, 'Tildie', 'Iacovaccio', '91-299-6889', 'Ronald Regan', '32', 'Liucheng', 'tiacovaccio1s@pbs.org', '530-143-9041', b'1', NULL, NULL),
	(66, 'Hally', 'Brister', '83-663-3189', 'Carey', '1244', 'Taivalkoski', 'hbrister1t@dot.gov', '507-555-5409', b'1', NULL, NULL),
	(67, 'Barbee', 'Tice', '93-281-1883', 'Bluestem', '90', 'Dupnitsa', 'btice1u@mozilla.org', '118-267-2751', b'1', NULL, NULL),
	(68, 'Tedda', 'Maxwale', '82-132-9270', 'Anthes', '1709', 'Australia Square', 'tmaxwale1v@t-online.de', '330-671-8829', b'1', NULL, NULL),
	(69, 'Noemi', 'Vockings', '54-000-7002', 'Blaine', '4505', 'Korçë', 'nvockings1w@va.gov', '898-840-0289', b'1', NULL, NULL),
	(70, 'Isobel', 'Hackinge', '48-953-9303', 'Chinook', '74', 'Buštěhrad', 'ihackinge1x@ucoz.com', '640-721-8373', b'1', NULL, NULL),
	(71, 'Hildegaard', 'Grewe', '38-388-0421', 'Golf View', '3059', 'Erpeldange', 'hgrewe1y@sitemeter.com', '858-738-1264', b'1', NULL, NULL),
	(72, 'Angeline', 'Oates', '52-379-3067', 'Norway Maple', '63', 'Dihtyari', 'aoates1z@walmart.com', '199-809-2471', b'1', NULL, NULL),
	(73, 'Lilith', 'Moberley', '71-644-9432', 'Badeau', '420', 'Rennes', 'lmoberley20@zdnet.com', '815-404-1521', b'1', NULL, NULL),
	(74, 'Ines', 'Fairfoot', '78-396-1538', 'Service', '79860', 'Dayton', 'ifairfoot21@51.la', '937-357-6418', b'1', NULL, NULL),
	(75, 'Glyn', 'Khidr', '80-336-8036', 'Carey', '55', 'Bafilo', 'gkhidr22@multiply.com', '464-776-4726', b'1', NULL, NULL),
	(76, 'Terrye', 'Ferrario', '26-776-3427', 'Garrison', '204', 'Calvário', 'tferrario23@plala.or.jp', '223-314-9865', b'1', NULL, NULL),
	(77, 'Selestina', 'Maypes', '79-112-2819', 'Mayer', '958', 'Lubao', 'smaypes24@businesswire.com', '111-196-4191', b'1', NULL, NULL),
	(78, 'Flor', 'Buzzing', '46-745-1906', 'Sage', '39', 'Ińsko', 'fbuzzing25@miitbeian.gov.cn', '497-888-2757', b'1', NULL, NULL),
	(79, 'Miranda', 'Laycock', '26-330-9575', 'Talmadge', '0495', 'Lisiy Nos', 'mlaycock26@mapquest.com', '232-362-8951', b'1', NULL, NULL),
	(80, 'Mela', 'Iscowitz', '48-150-5094', 'Manley', '35', 'Linhares', 'miscowitz27@sun.com', '882-337-5653', b'1', NULL, NULL),
	(81, 'Bertie', 'Cashin', '09-757-3272', 'Blaine', '41189', 'Savitaipale', 'bcashin28@disqus.com', '422-819-4177', b'1', NULL, NULL),
	(82, 'Raye', 'Diano', '75-740-6473', 'Morrow', '24', 'Bilo', 'rdiano29@google.com.au', '585-428-3488', b'1', NULL, NULL),
	(83, 'Myrtie', 'Ducker', '89-972-9897', 'Everett', '95665', 'Berovo', 'mducker2a@jalbum.net', '227-998-1186', b'1', NULL, NULL),
	(84, 'Helaine', 'Waterland', '37-815-0558', 'Calypso', '0', 'Kaiaf', 'hwaterland2b@hp.com', '977-431-3415', b'1', NULL, NULL),
	(85, 'Noni', 'Hanselmann', '19-446-9028', 'Lake View', '11368', 'Karlskoga', 'nhanselmann2c@merriam-webster.com', '328-473-9443', b'1', NULL, NULL),
	(86, 'Kiah', 'Tanzig', '63-312-1669', 'Westridge', '7', 'Ocoruro', 'ktanzig2d@yandex.ru', '442-190-9403', b'1', NULL, NULL),
	(87, 'Ivett', 'De Biasi', '56-455-0274', 'Bonner', '798', 'Zouérat', 'idebiasi2e@washington.edu', '122-549-3102', b'1', NULL, NULL),
	(88, 'Lydie', 'Farrell', '71-575-4743', 'Mallory', '628', 'Yangqiao', 'lfarrell2f@facebook.com', '285-368-6926', b'1', NULL, NULL),
	(89, 'Katha', 'Swatton', '49-377-0315', 'Vernon', '57', 'Ganxi', 'kswatton2g@apple.com', '653-598-0552', b'1', NULL, NULL),
	(90, 'Colline', 'Baxster', '98-702-3656', 'Sunfield', '23417', 'Sanlian', 'cbaxster2h@themeforest.net', '478-160-5578', b'1', NULL, NULL),
	(91, 'Gretta', 'Rosini', '22-491-1473', 'Troy', '48', 'Tulsa', 'grosini2i@msn.com', '918-294-5907', b'1', NULL, NULL),
	(92, 'Devonna', 'Scanes', '33-768-3436', 'Village', '08796', 'Nangen', 'dscanes2j@nytimes.com', '395-645-9687', b'1', NULL, NULL),
	(93, 'Florette', 'Nowakowska', '61-090-0265', 'Sachtjen', '5', 'João Câmara', 'fnowakowska2k@dailymail.co.uk', '119-276-1305', b'1', NULL, NULL),
	(94, 'Bessie', 'Barabich', '66-088-7868', 'Division', '563', 'Banī Ḩassān', 'bbarabich2l@amazon.co.jp', '278-188-0011', b'1', NULL, NULL),
	(95, 'Tabitha', 'Parmeter', '39-923-7694', 'Roth', '65', 'Nanxi', 'tparmeter2m@youtube.com', '371-796-2003', b'1', NULL, NULL),
	(96, 'Lori', 'Wheeliker', '75-237-8004', 'Messerschmidt', '56', 'Svay Rieng', 'lwheeliker2n@webnode.com', '207-897-2464', b'1', NULL, NULL),
	(97, 'Calypso', 'Drissell', '17-889-4114', 'Buena Vista', '681', 'Gesikan', 'cdrissell2o@homestead.com', '717-691-2615', b'1', NULL, NULL),
	(98, 'Mechelle', 'Amis', '19-005-0332', 'Gulseth', '26', 'La Francia', 'mamis2p@sogou.com', '256-377-9560', b'1', NULL, NULL),
	(99, 'Ethel', 'Compford', '82-145-8386', 'Caliangt', '29', 'Novopskov', 'ecompford2q@loc.gov', '901-878-4829', b'1', NULL, NULL),
	(100, 'Jaclyn', 'Bispo', '66-682-8292', 'Glacier Hill', '955', 'Chengdong', 'jbispo2r@xing.com', '471-407-3867', b'1', NULL, NULL),
	(101, 'Merna', 'Whale', '39-888-2006', 'Brentwood', '135', 'Rzeczenica', 'mwhale2s@mapy.cz', '107-278-3369', b'1', NULL, NULL),
	(102, 'Dulciana', 'Gallimore', '50-639-9844', 'Lake View', '311', 'Port-aux-Français', 'dgallimore2t@wix.com', '317-983-0632', b'1', NULL, NULL),
	(103, 'Rhonda', 'Kiefer', '06-975-3684', 'Old Shore', '88', 'Guantou', 'rkiefer2u@cnbc.com', '115-883-2766', b'1', NULL, NULL),
	(104, 'Lily', 'Corsor', '17-280-3181', 'Bartelt', '84932', 'Zhongfang', 'lcorsor2v@technorati.com', '771-504-7859', b'1', NULL, NULL),
	(105, 'Clementina', 'Mollin', '91-492-7824', 'Oneill', '0083', 'Guangfu', 'cmollin2w@ifeng.com', '605-384-4624', b'1', NULL, NULL),
	(106, 'Christan', 'Barney', '62-917-6750', 'Melvin', '4', 'Klenje', 'cbarney2x@storify.com', '875-745-5324', b'1', NULL, NULL),
	(107, 'Legra', 'Attryde', '50-507-5527', 'Katie', '24696', 'Delães', 'lattryde2y@wisc.edu', '938-848-6229', b'1', NULL, NULL),
	(108, 'Tandi', 'Brayne', '46-313-1665', 'Carpenter', '7599', 'Cibulakan', 'tbrayne2z@tinypic.com', '163-631-3614', b'1', NULL, NULL),
	(109, 'Siobhan', 'Maysor', '71-946-8964', 'Melrose', '2', 'Krynki', 'smaysor30@princeton.edu', '455-390-1936', b'1', NULL, NULL),
	(110, 'Noella', 'Sutherel', '42-931-3148', 'Reindahl', '75', 'Thị Trấn Thuận Châu', 'nsutherel31@slate.com', '641-438-5360', b'1', NULL, NULL),
	(111, 'Genna', 'Brothwell', '13-731-7879', 'Scott', '927', 'Katumba', 'gbrothwell32@skyrock.com', '787-729-1484', b'1', NULL, NULL),
	(112, 'Bill', 'Boarleyson', '81-771-9936', 'Mcbride', '2800', 'Domampot', 'bboarleyson33@comsenz.com', '703-202-5878', b'1', NULL, NULL),
	(113, 'Gaynor', 'Ceillier', '72-574-7944', 'Golden Leaf', '29', 'Doksy', 'gceillier34@patch.com', '960-832-3590', b'1', NULL, NULL),
	(114, 'Anstice', 'Scotson', '28-301-8932', 'Oak Valley', '56', 'Sezemice', 'ascotson35@lulu.com', '704-685-3457', b'1', NULL, NULL),
	(115, 'Anastassia', 'Mulcock', '71-822-5966', 'Glacier Hill', '282', 'Stockholm', 'amulcock36@umich.edu', '215-461-3599', b'1', NULL, 1),
	(116, 'Collie', 'Cooney', '49-080-1219', 'Cherokee', '1530', 'Francos', 'ccooney37@amazonaws.com', '149-695-2882', b'1', NULL, NULL),
	(117, 'Brit', 'Haill', '77-524-2555', 'Rieder', '50567', 'Huoche Xizhan', 'bhaill38@gizmodo.com', '769-198-2856', b'1', NULL, NULL),
	(118, 'Joletta', 'Brabben', '98-012-0015', 'David', '507', 'Ingarö', 'jbrabben39@delicious.com', '758-979-7630', b'1', NULL, NULL),
	(119, 'Dacia', 'Deeth', '41-832-3557', 'Weeping Birch', '73626', 'Hamilton', 'ddeeth3a@stanford.edu', '419-940-3799', b'1', NULL, NULL),
	(120, 'Robina', 'Belcham', '02-206-6706', 'Graceland', '37384', 'Bergen', 'rbelcham3b@mozilla.org', '878-882-7841', b'1', NULL, NULL),
	(121, 'Blancha', 'Birkenhead', '09-099-1575', 'Chive', '75', 'Sandayong Sur', 'bbirkenhead3c@github.io', '283-664-9714', b'1', NULL, NULL),
	(122, 'Cami', 'Tevlin', '46-139-5895', 'Lerdahl', '88', 'Ke’erlun', 'ctevlin3d@i2i.jp', '292-700-9219', b'1', NULL, NULL),
	(123, 'Celeste', 'Wrout', '35-639-8911', 'Myrtle', '57', 'Ndofane', 'cwrout3e@columbia.edu', '332-964-9742', b'1', NULL, NULL),
	(124, 'Leda', 'Boxhall', '16-432-0351', 'Erie', '18881', 'Janakkala', 'lboxhall3f@google.ru', '961-129-2523', b'1', NULL, NULL),
	(125, 'Conni', 'Skilton', '02-125-9692', 'Sugar', '0347', 'Terrugem', 'cskilton3g@arizona.edu', '808-269-2023', b'1', NULL, NULL),
	(126, 'Janella', 'Kneaphsey', '68-519-5231', 'Continental', '7', 'Kampong Chhnang', 'jkneaphsey3h@uiuc.edu', '953-940-5507', b'1', NULL, NULL),
	(127, 'Jenelle', 'Smail', '49-841-3026', 'School', '27185', 'Vanves', 'jsmail3i@marketwatch.com', '505-732-4254', b'1', NULL, NULL),
	(128, 'Elsi', 'Seakings', '98-201-5905', 'Graceland', '89', 'Maicao', 'eseakings3j@yahoo.co.jp', '244-402-4860', b'1', NULL, NULL),
	(129, 'Benita', 'Studde', '57-769-0209', 'Jay', '6134', 'Houston', 'bstudde3k@hc360.com', '713-104-1916', b'1', NULL, NULL),
	(130, 'Christine', 'Moses', '69-161-5666', 'Anzinger', '387', 'Zekou', 'cmoses3l@ed.gov', '934-874-2496', b'1', NULL, NULL),
	(131, 'Aubrey', 'Froggatt', '54-849-4893', 'Springview', '04', 'El Corozo', 'afroggatt3m@yahoo.co.jp', '788-283-2487', b'1', NULL, NULL),
	(132, 'Maurizia', 'Viant', '38-786-0786', 'Veith', '4', 'Dolavón', 'mviant3n@livejournal.com', '978-771-0292', b'1', NULL, NULL),
	(133, 'Rosabelle', 'Simmill', '60-334-5584', 'Amoth', '0624', 'Katabu', 'rsimmill3o@cpanel.net', '738-187-0915', b'1', NULL, NULL),
	(134, 'Mathilda', 'Walker', '41-402-1821', 'Troy', '195', 'Nahiyat Ghammas', 'mwalker3p@disqus.com', '810-172-5702', b'1', NULL, NULL),
	(135, 'Lorette', 'Whitchurch', '82-001-7999', 'Green', '49', 'Xifengshan', 'lwhitchurch3q@patch.com', '776-210-0161', b'1', NULL, NULL),
	(136, 'Ardath', 'Staddom', '71-937-3330', 'Monterey', '28', 'Saue', 'astaddom3r@blogtalkradio.com', '479-147-9361', b'1', NULL, NULL),
	(137, 'Cheri', 'Willstrop', '52-040-4950', 'Ohio', '68', 'Navais', 'cwillstrop3s@amazon.de', '910-900-0365', b'1', NULL, NULL),
	(138, 'Carley', 'Blinde', '13-066-5686', 'Ryan', '648', 'Vanino', 'cblinde3t@springer.com', '848-500-8063', b'1', NULL, NULL),
	(139, 'Kitti', 'Mossom', '58-792-6933', 'Cordelia', '36236', 'Eksjö', 'kmossom3u@cisco.com', '930-246-9004', b'1', NULL, NULL),
	(140, 'Keslie', 'Love', '28-116-3538', 'Reinke', '2', 'Seogeom-ri', 'klove3v@bluehost.com', '718-932-5507', b'1', NULL, NULL),
	(141, 'Kelcy', 'Hewins', '59-642-0115', 'Forest Run', '4', 'Kadurahayu', 'khewins3w@narod.ru', '313-448-8426', b'1', NULL, NULL),
	(142, 'Catina', 'Brimley', '80-777-8981', 'Mallory', '67', 'Milwaukee', 'cbrimley3x@dell.com', '414-273-7564', b'1', NULL, NULL),
	(143, 'Loni', 'Arnaud', '06-887-2422', 'Pepper Wood', '7', 'Iballë', 'larnaud3y@sciencedirect.com', '232-934-4724', b'1', NULL, NULL),
	(144, 'Letitia', 'Duran', '70-336-0801', 'Holmberg', '42', 'Kanbe', 'lduran3z@sun.com', '325-892-2456', b'1', NULL, NULL),
	(145, 'Amelita', 'Bredgeland', '20-835-0462', 'Prentice', '469', 'Zhongtong', 'abredgeland40@webmd.com', '889-343-9383', b'1', NULL, 1),
	(146, 'Cristina', 'Darwood', '88-164-7311', 'Red Cloud', '40827', 'Amnat Charoen', 'cdarwood41@sohu.com', '708-592-6971', b'1', NULL, NULL),
	(147, 'Alexia', 'Abley', '26-203-4780', 'Eggendart', '94044', 'Haugesund', 'aabley42@wiley.com', '269-664-9906', b'1', NULL, 1),
	(148, 'Oneida', 'Kirsche', '40-530-0921', 'Helena', '36', 'Xiaoshanzi', 'okirsche43@nyu.edu', '486-413-6307', b'1', NULL, NULL),
	(149, 'Vivianna', 'Jarry', '79-722-8055', 'Bluejay', '9', 'Kotaagung', 'vjarry44@sciencedaily.com', '481-251-5922', b'1', NULL, NULL),
	(150, 'Andriana', 'Piotrowski', '34-994-6730', 'Alpine', '7', 'Kramsk', 'apiotrowski45@flavors.me', '567-713-1063', b'1', NULL, NULL);

-- Volcando estructura para tabla seguro.inmueble
CREATE TABLE IF NOT EXISTS `inmueble` (
  `id_inmueble` int(11) NOT NULL AUTO_INCREMENT,
  `calle` varchar(50) NOT NULL,
  `numero_calle` smallint(6) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `provincia` char(50) NOT NULL,
  `inmueble_tipo` char(50) NOT NULL DEFAULT '',
  `abona` float DEFAULT NULL,
  PRIMARY KEY (`id_inmueble`),
  KEY `id_cliente` (`id_cliente`),
  KEY `provincia` (`provincia`),
  KEY `id_inmueble_tipo` (`inmueble_tipo`) USING BTREE,
  CONSTRAINT `FK_inmueble_provincia` FOREIGN KEY (`provincia`) REFERENCES `provincia` (`provincia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_inmueble_tipo_inmueble` FOREIGN KEY (`inmueble_tipo`) REFERENCES `tipo_inmueble` (`tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.inmueble: ~3 rows (aproximadamente)
INSERT INTO `inmueble` (`id_inmueble`, `calle`, `numero_calle`, `localidad`, `id_cliente`, `provincia`, `inmueble_tipo`, `abona`) VALUES
	(2, 'Taborda', 3823, 'Rde', 18, 'BUENOS AIRES', 'Vivienda', NULL),
	(3, 'Iberlucea', 111, 'Lanús', 45, 'BUENOS AIRES', 'Local', NULL),
	(5, '25 de mayo', 2321, 'Lanús', 9, 'BUENOS AIRES', 'Edificio', NULL);

-- Volcando estructura para tabla seguro.marca
CREATE TABLE IF NOT EXISTS `marca` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) NOT NULL,
  PRIMARY KEY (`id_marca`),
  UNIQUE KEY `marca` (`marca`)
) ENGINE=InnoDB AUTO_INCREMENT=344 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.marca: ~50 rows (aproximadamente)
INSERT INTO `marca` (`id_marca`, `marca`) VALUES
	(177, 'Acura'),
	(240, 'Alfa Romeo'),
	(343, 'Aston Martin'),
	(16, 'Audi'),
	(118, 'Bentley'),
	(7, 'BMW'),
	(37, 'Buick'),
	(50, 'Cadillac'),
	(12, 'Chevrolet'),
	(56, 'Chrysler'),
	(23, 'Daewoo'),
	(27, 'Dodge'),
	(80, 'Eagle'),
	(53, 'Ferrari'),
	(10, 'Ford'),
	(58, 'GMC'),
	(90, 'Honda'),
	(154, 'Hummer'),
	(207, 'Hyundai'),
	(9, 'Infiniti'),
	(39, 'Isuzu'),
	(119, 'Jaguar'),
	(103, 'Jeep'),
	(183, 'Kia'),
	(8, 'Lamborghini'),
	(112, 'Land Rover'),
	(45, 'Lexus'),
	(152, 'Lincoln'),
	(21, 'Lotus'),
	(48, 'Maserati'),
	(97, 'Maybach'),
	(18, 'Mazda'),
	(25, 'Mercedes-Benz'),
	(19, 'Mercury'),
	(3, 'Mitsubishi'),
	(1, 'Nissan'),
	(5, 'Oldsmobile'),
	(43, 'Plymouth'),
	(14, 'Pontiac'),
	(6, 'Porsche'),
	(2, 'Saab'),
	(86, 'Saturn'),
	(102, 'Scion'),
	(213, 'Smart'),
	(195, 'Spyker'),
	(17, 'Subaru'),
	(120, 'Suzuki'),
	(20, 'Toyota'),
	(4, 'Volkswagen'),
	(26, 'Volvo');

-- Volcando estructura para tabla seguro.medios_de_pago
CREATE TABLE IF NOT EXISTS `medios_de_pago` (
  `id_medios_pago` int(11) NOT NULL AUTO_INCREMENT,
  `medio_pago` char(50) NOT NULL,
  `estado` bigint(20) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_medios_pago`),
  UNIQUE KEY `tipo_pago` (`medio_pago`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.medios_de_pago: ~5 rows (aproximadamente)
INSERT INTO `medios_de_pago` (`id_medios_pago`, `medio_pago`, `estado`) VALUES
	(1, 'Efectivo', 1),
	(2, 'Crédito', 1),
	(3, 'Débito', 1),
	(5, 'Mercado Pago', 1),
	(6, '123123', 0);

-- Volcando estructura para tabla seguro.pais
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iso` (`iso`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.pais: ~240 rows (aproximadamente)
INSERT INTO `pais` (`id`, `iso`, `nombre`) VALUES
	(1, 'AF', 'Afganistán'),
	(2, 'AX', 'Islas Gland'),
	(3, 'AL', 'Albania'),
	(4, 'DE', 'Alemania'),
	(5, 'AD', 'Andorra'),
	(6, 'AO', 'Angola'),
	(7, 'AI', 'Anguilla'),
	(8, 'AQ', 'Antártida'),
	(9, 'AG', 'Antigua y Barbuda'),
	(10, 'AN', 'Antillas Holandesas'),
	(11, 'SA', 'Arabia Saudí'),
	(12, 'DZ', 'Argelia'),
	(13, 'AR', 'Argentina'),
	(14, 'AM', 'Armenia'),
	(15, 'AW', 'Aruba'),
	(16, 'AU', 'Australia'),
	(17, 'AT', 'Austria'),
	(18, 'AZ', 'Azerbaiyán'),
	(19, 'BS', 'Bahamas'),
	(20, 'BH', 'Bahréin'),
	(21, 'BD', 'Bangladesh'),
	(22, 'BB', 'Barbados'),
	(23, 'BY', 'Bielorrusia'),
	(24, 'BE', 'Bélgica'),
	(25, 'BZ', 'Belice'),
	(26, 'BJ', 'Benin'),
	(27, 'BM', 'Bermudas'),
	(28, 'BT', 'Bhután'),
	(29, 'BO', 'Bolivia'),
	(30, 'BA', 'Bosnia y Herzegovina'),
	(31, 'BW', 'Botsuana'),
	(32, 'BV', 'Isla Bouvet'),
	(33, 'BR', 'Brasil'),
	(34, 'BN', 'Brunéi'),
	(35, 'BG', 'Bulgaria'),
	(36, 'BF', 'Burkina Faso'),
	(37, 'BI', 'Burundi'),
	(38, 'CV', 'Cabo Verde'),
	(39, 'KY', 'Islas Caimán'),
	(40, 'KH', 'Camboya'),
	(41, 'CM', 'Camerún'),
	(42, 'CA', 'Canadá'),
	(43, 'CF', 'República Centroafricana'),
	(44, 'TD', 'Chad'),
	(45, 'CZ', 'República Checa'),
	(46, 'CL', 'Chile'),
	(47, 'CN', 'China'),
	(48, 'CY', 'Chipre'),
	(49, 'CX', 'Isla de Navidad'),
	(50, 'VA', 'Ciudad del Vaticano'),
	(51, 'CC', 'Islas Cocos'),
	(52, 'CO', 'Colombia'),
	(53, 'KM', 'Comoras'),
	(54, 'CD', 'República Democrática del Congo'),
	(55, 'CG', 'Congo'),
	(56, 'CK', 'Islas Cook'),
	(57, 'KP', 'Corea del Norte'),
	(58, 'KR', 'Corea del Sur'),
	(59, 'CI', 'Costa de Marfil'),
	(60, 'CR', 'Costa Rica'),
	(61, 'HR', 'Croacia'),
	(62, 'CU', 'Cuba'),
	(63, 'DK', 'Dinamarca'),
	(64, 'DM', 'Dominica'),
	(65, 'DO', 'República Dominicana'),
	(66, 'EC', 'Ecuador'),
	(67, 'EG', 'Egipto'),
	(68, 'SV', 'El Salvador'),
	(69, 'AE', 'Emiratos Árabes Unidos'),
	(70, 'ER', 'Eritrea'),
	(71, 'SK', 'Eslovaquia'),
	(72, 'SI', 'Eslovenia'),
	(73, 'ES', 'España'),
	(74, 'UM', 'Islas ultramarinas de Estados Unidos'),
	(75, 'US', 'Estados Unidos'),
	(76, 'EE', 'Estonia'),
	(77, 'ET', 'Etiopía'),
	(78, 'FO', 'Islas Feroe'),
	(79, 'PH', 'Filipinas'),
	(80, 'FI', 'Finlandia'),
	(81, 'FJ', 'Fiyi'),
	(82, 'FR', 'Francia'),
	(83, 'GA', 'Gabón'),
	(84, 'GM', 'Gambia'),
	(85, 'GE', 'Georgia'),
	(86, 'GS', 'Islas Georgias del Sur y Sandwich del Sur'),
	(87, 'GH', 'Ghana'),
	(88, 'GI', 'Gibraltar'),
	(89, 'GD', 'Granada'),
	(90, 'GR', 'Grecia'),
	(91, 'GL', 'Groenlandia'),
	(92, 'GP', 'Guadalupe'),
	(93, 'GU', 'Guam'),
	(94, 'GT', 'Guatemala'),
	(95, 'GF', 'Guayana Francesa'),
	(96, 'GN', 'Guinea'),
	(97, 'GQ', 'Guinea Ecuatorial'),
	(98, 'GW', 'Guinea-Bissau'),
	(99, 'GY', 'Guyana'),
	(100, 'HT', 'Haití'),
	(101, 'HM', 'Islas Heard y McDonald'),
	(102, 'HN', 'Honduras'),
	(103, 'HK', 'Hong Kong'),
	(104, 'HU', 'Hungría'),
	(105, 'IN', 'India'),
	(106, 'ID', 'Indonesia'),
	(107, 'IR', 'Irán'),
	(108, 'IQ', 'Iraq'),
	(109, 'IE', 'Irlanda'),
	(110, 'IS', 'Islandia'),
	(111, 'IL', 'Israel'),
	(112, 'IT', 'Italia'),
	(113, 'JM', 'Jamaica'),
	(114, 'JP', 'Japón'),
	(115, 'JO', 'Jordania'),
	(116, 'KZ', 'Kazajstán'),
	(117, 'KE', 'Kenia'),
	(118, 'KG', 'Kirguistán'),
	(119, 'KI', 'Kiribati'),
	(120, 'KW', 'Kuwait'),
	(121, 'LA', 'Laos'),
	(122, 'LS', 'Lesotho'),
	(123, 'LV', 'Letonia'),
	(124, 'LB', 'Líbano'),
	(125, 'LR', 'Liberia'),
	(126, 'LY', 'Libia'),
	(127, 'LI', 'Liechtenstein'),
	(128, 'LT', 'Lituania'),
	(129, 'LU', 'Luxemburgo'),
	(130, 'MO', 'Macao'),
	(131, 'MK', 'ARY Macedonia'),
	(132, 'MG', 'Madagascar'),
	(133, 'MY', 'Malasia'),
	(134, 'MW', 'Malawi'),
	(135, 'MV', 'Maldivas'),
	(136, 'ML', 'Malí'),
	(137, 'MT', 'Malta'),
	(138, 'FK', 'Islas Malvinas'),
	(139, 'MP', 'Islas Marianas del Norte'),
	(140, 'MA', 'Marruecos'),
	(141, 'MH', 'Islas Marshall'),
	(142, 'MQ', 'Martinica'),
	(143, 'MU', 'Mauricio'),
	(144, 'MR', 'Mauritania'),
	(145, 'YT', 'Mayotte'),
	(146, 'MX', 'México'),
	(147, 'FM', 'Micronesia'),
	(148, 'MD', 'Moldavia'),
	(149, 'MC', 'Mónaco'),
	(150, 'MN', 'Mongolia'),
	(151, 'MS', 'Montserrat'),
	(152, 'MZ', 'Mozambique'),
	(153, 'MM', 'Myanmar'),
	(154, 'NA', 'Namibia'),
	(155, 'NR', 'Nauru'),
	(156, 'NP', 'Nepal'),
	(157, 'NI', 'Nicaragua'),
	(158, 'NE', 'Níger'),
	(159, 'NG', 'Nigeria'),
	(160, 'NU', 'Niue'),
	(161, 'NF', 'Isla Norfolk'),
	(162, 'NO', 'Noruega'),
	(163, 'NC', 'Nueva Caledonia'),
	(164, 'NZ', 'Nueva Zelanda'),
	(165, 'OM', 'Omán'),
	(166, 'NL', 'Países Bajos'),
	(167, 'PK', 'Pakistán'),
	(168, 'PW', 'Palau'),
	(169, 'PS', 'Palestina'),
	(170, 'PA', 'Panamá'),
	(171, 'PG', 'Papúa Nueva Guinea'),
	(172, 'PY', 'Paraguay'),
	(173, 'PE', 'Perú'),
	(174, 'PN', 'Islas Pitcairn'),
	(175, 'PF', 'Polinesia Francesa'),
	(176, 'PL', 'Polonia'),
	(177, 'PT', 'Portugal'),
	(178, 'PR', 'Puerto Rico'),
	(179, 'QA', 'Qatar'),
	(180, 'GB', 'Reino Unido'),
	(181, 'RE', 'Reunión'),
	(182, 'RW', 'Ruanda'),
	(183, 'RO', 'Rumania'),
	(184, 'RU', 'Rusia'),
	(185, 'EH', 'Sahara Occidental'),
	(186, 'SB', 'Islas Salomón'),
	(187, 'WS', 'Samoa'),
	(188, 'AS', 'Samoa Americana'),
	(189, 'KN', 'San Cristóbal y Nevis'),
	(190, 'SM', 'San Marino'),
	(191, 'PM', 'San Pedro y Miquelón'),
	(192, 'VC', 'San Vicente y las Granadinas'),
	(193, 'SH', 'Santa Helena'),
	(194, 'LC', 'Santa Lucía'),
	(195, 'ST', 'Santo Tomé y Príncipe'),
	(196, 'SN', 'Senegal'),
	(197, 'CS', 'Serbia y Montenegro'),
	(198, 'SC', 'Seychelles'),
	(199, 'SL', 'Sierra Leona'),
	(200, 'SG', 'Singapur'),
	(201, 'SY', 'Siria'),
	(202, 'SO', 'Somalia'),
	(203, 'LK', 'Sri Lanka'),
	(204, 'SZ', 'Suazilandia'),
	(205, 'ZA', 'Sudáfrica'),
	(206, 'SD', 'Sudán'),
	(207, 'SE', 'Suecia'),
	(208, 'CH', 'Suiza'),
	(209, 'SR', 'Surinam'),
	(210, 'SJ', 'Svalbard y Jan Mayen'),
	(211, 'TH', 'Tailandia'),
	(212, 'TW', 'Taiwán'),
	(213, 'TZ', 'Tanzania'),
	(214, 'TJ', 'Tayikistán'),
	(215, 'IO', 'Territorio Británico del Océano Índico'),
	(216, 'TF', 'Territorios Australes Franceses'),
	(217, 'TL', 'Timor Oriental'),
	(218, 'TG', 'Togo'),
	(219, 'TK', 'Tokelau'),
	(220, 'TO', 'Tonga'),
	(221, 'TT', 'Trinidad y Tobago'),
	(222, 'TN', 'Túnez'),
	(223, 'TC', 'Islas Turcas y Caicos'),
	(224, 'TM', 'Turkmenistán'),
	(225, 'TR', 'Turquía'),
	(226, 'TV', 'Tuvalu'),
	(227, 'UA', 'Ucrania'),
	(228, 'UG', 'Uganda'),
	(229, 'UY', 'Uruguay'),
	(230, 'UZ', 'Uzbekistán'),
	(231, 'VU', 'Vanuatu'),
	(232, 'VE', 'Venezuela'),
	(233, 'VN', 'Vietnam'),
	(234, 'VG', 'Islas Vírgenes Británicas'),
	(235, 'VI', 'Islas Vírgenes de los Estados Unidos'),
	(236, 'WF', 'Wallis y Futuna'),
	(237, 'YE', 'Yemen'),
	(238, 'DJ', 'Yibuti'),
	(239, 'ZM', 'Zambia'),
	(240, 'ZW', 'Zimbabue');

-- Volcando estructura para tabla seguro.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` char(30) NOT NULL DEFAULT '0',
  `esdefault` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.perfil: ~3 rows (aproximadamente)
INSERT INTO `perfil` (`id_perfil`, `perfil`, `esdefault`) VALUES
	(1, 'ADMINISTRADOR', 0),
	(2, 'INVITADO', 1),
	(3, 'EMPLEADO', 2);

-- Volcando estructura para tabla seguro.perfil_acceso
CREATE TABLE IF NOT EXISTS `perfil_acceso` (
  `id_perfil` int(11) NOT NULL,
  `id_ruta` int(11) NOT NULL,
  PRIMARY KEY (`id_perfil`,`id_ruta`),
  KEY `fk_perf_rtas_ruta` (`id_ruta`),
  CONSTRAINT `fk_perf_rtas_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`),
  CONSTRAINT `fk_perf_rtas_ruta` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id_ruta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.perfil_acceso: ~3 rows (aproximadamente)
INSERT INTO `perfil_acceso` (`id_perfil`, `id_ruta`) VALUES
	(1, 1),
	(2, 2),
	(3, 1);

-- Volcando estructura para tabla seguro.plan_pago
CREATE TABLE IF NOT EXISTS `plan_pago` (
  `id_plan_pago` int(11) NOT NULL AUTO_INCREMENT,
  `id_automovil` int(11) NOT NULL,
  `id_tipo_plan` int(11) NOT NULL,
  `id_medios_pago` int(11) NOT NULL,
  `abonó` float NOT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_plan_pago`),
  KEY `id_tipo_plan` (`id_tipo_plan`),
  KEY `id_automovil` (`id_automovil`),
  KEY `id_medios_pago` (`id_medios_pago`),
  CONSTRAINT `FK_plan_pago_automovil` FOREIGN KEY (`id_automovil`) REFERENCES `automovil` (`id_automovil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_plan_pago_medios_de_pago` FOREIGN KEY (`id_medios_pago`) REFERENCES `medios_de_pago` (`id_medios_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_plan_pago_tipo_plan` FOREIGN KEY (`id_tipo_plan`) REFERENCES `tipo_plan` (`id_tipo_plan`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.plan_pago: ~6 rows (aproximadamente)
INSERT INTO `plan_pago` (`id_plan_pago`, `id_automovil`, `id_tipo_plan`, `id_medios_pago`, `abonó`, `fecha`) VALUES
	(6, 137, 2, 3, 1521, '2023-01-09'),
	(7, 115, 5, 1, 9999, '2023-01-09'),
	(8, 111, 6, 2, 2550, '2023-01-09'),
	(13, 109, 2, 3, 3000, '2023-01-23'),
	(14, 120, 3, 3, 1999, '2023-02-11'),
	(15, 137, 1, 1, 1523, '2023-01-30'),
	(16, 138, 1, 3, 1597, '2023-01-31'),
	(17, 110, 3, 2, 12312300, '2023-02-01');

-- Volcando estructura para tabla seguro.proveedor
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `razon_soc` varchar(50) NOT NULL DEFAULT '',
  `cuit` varchar(20) NOT NULL DEFAULT '',
  `calle` varchar(50) DEFAULT '',
  `numero_calle` varchar(50) DEFAULT '',
  `localidad` varchar(50) DEFAULT '',
  `cod_provincia` char(10) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT '',
  `email` varchar(150) DEFAULT NULL,
  `activo` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id_proveedor`) USING BTREE,
  KEY `fk_proveedor_provincia` (`cod_provincia`) USING BTREE,
  CONSTRAINT `fk_proveedor_provincia` FOREIGN KEY (`cod_provincia`) REFERENCES `provincia` (`cod_provincia`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.proveedor: ~20 rows (aproximadamente)
INSERT INTO `proveedor` (`id_proveedor`, `razon_soc`, `cuit`, `calle`, `numero_calle`, `localidad`, `cod_provincia`, `telefono`, `email`, `activo`) VALUES
	(1, 'Sagent Pharmaceuticals', '70-85029831-0', 'Warrior', '4203', 'Kihancha', NULL, '954-544-2647', 'acawthera0@people.com.cn', b'1'),
	(2, 'AvPAK', '24-19208247-8', 'Huxley', '5', 'Deán Funes', NULL, '458-939-4386', 'gwoosnam1@japanpost.jp', b'1'),
	(3, 'Uriel Pharmacy Inc.', '55-54826842-3', 'Washington', '29', 'Arāk', NULL, '440-669-2367', 'jmunnis2@usgs.gov', b'1'),
	(4, 'Remedy Makers', '49-27100939-9', 'Annamark', '4820', 'Chãos', NULL, '153-149-3020', 'bcrutcher3@comsenz.com', b'1'),
	(5, 'Allure Labs, Inc.', '94-36409069-8', 'Morrow', '1', 'Pasaje', NULL, '865-836-2378', 'mwailes4@uiuc.edu', b'1'),
	(6, 'Allergan, Inc.', '84-17326737-0', 'Hermina', '2', 'Shorko', NULL, '335-436-3474', 'mraynard5@csmonitor.com', b'1'),
	(7, 'B. Braun Medical Inc.', '95-65691783-0', 'Schlimgen', '848', 'Bayanan', NULL, '300-836-9359', 'hsimioli6@woothemes.com', b'1'),
	(8, 'Baxter Healthcare Corporation', '66-74039476-8', 'Coolidge', '1', 'Shënmëri', NULL, '848-274-3998', 'dsummerly7@guardian.co.uk', b'1'),
	(9, 'REMEDYREPACK INC.', '30-79355651-1', 'School', '12', 'Halmstad', NULL, '519-944-1141', 'kbes8@oracle.com', b'1'),
	(10, 'Brighton Pharmaceuticals, Inc.', '33-47452452-1', 'Namekagon', '58', 'Pokhvistnevo', NULL, '682-280-7103', 'gpilpovic9@purevolume.com', b'1'),
	(11, 'Dispensing Solutions, Inc.', '23-13473897-9', 'Fair Oaks', '326', 'Chase', NULL, '340-264-7330', 'sdalzella@nbcnews.com', b'1'),
	(12, 'Fresenius Kabi USA, LLC', '73-73920886-5', 'Hermina', '40', 'Petawawa', NULL, '490-485-1545', 'sjulyb@is.gd', b'1'),
	(13, 'WellSpring Pharmaceutical Corporation', '65-46736758-6', 'Northview', '35', 'Širvintos', NULL, '701-773-5202', 'kphilc@printfriendly.com', b'1'),
	(14, 'Mission Hills S.A de C.V', '88-73526033-5', 'Claremont', '792', 'Half Way Tree', NULL, '763-598-4586', 'jkingsnodd@google.es', b'1'),
	(15, 'Qualitest Pharmaceuticals', '69-94731368-9', 'Stang', '06', 'Hanyin Chengguanzhen', NULL, '389-884-4907', 'mkardosstowee@tiny.cc', b'1'),
	(16, 'Preferred Pharmaceuticals, Inc.', '94-40967490-3', 'Independence', '2', 'Quezon', NULL, '934-265-2332', 'hgrinsteadf@ca.gov', b'1'),
	(17, 'Micro Labs Limited', '91-64972743-2', 'Schurz', '5037', 'General Enrique Godoy', NULL, '620-701-5862', 'jscrinageg@google.de', b'1'),
	(18, 'True Botanica, LLC', '57-14909731-8', 'Tony', '0', 'Criuleni', NULL, '968-151-7638', 'kmundwellh@weather.com', b'1'),
	(19, 'Major Pharmaceuticals', '22-73679637-8', 'Nelson', '36', 'Sutton', NULL, '493-374-3796', 'lberendsi@taobao.com', b'1'),
	(20, 'AvKARE, Inc.', '56-72217943-3', 'Westport', '718', 'Batuna Satu', NULL, '428-641-9731', 'mtungayj@squarespace.com', b'1');

-- Volcando estructura para tabla seguro.proveedor_contacto
CREATE TABLE IF NOT EXISTS `proveedor_contacto` (
  `id_proveedor_contacto` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` char(40) NOT NULL DEFAULT '0',
  `Nombre` char(40) NOT NULL DEFAULT '0',
  `Apellido` char(40) NOT NULL DEFAULT '0',
  `telefono` char(40) DEFAULT '0',
  `celular` char(40) DEFAULT '0',
  `email` char(40) DEFAULT '0',
  `observaciones` text DEFAULT NULL,
  PRIMARY KEY (`id_proveedor_contacto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.proveedor_contacto: ~0 rows (aproximadamente)

-- Volcando estructura para tabla seguro.provincia
CREATE TABLE IF NOT EXISTS `provincia` (
  `cod_provincia` char(10) NOT NULL,
  `provincia` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cod_provincia`),
  KEY `provincia` (`provincia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.provincia: ~23 rows (aproximadamente)
INSERT INTO `provincia` (`cod_provincia`, `provincia`) VALUES
	('BSAS', 'BUENOS AIRES'),
	('CAT', 'CATAMARCA'),
	('CHA', 'CHACO'),
	('CHB', 'CHUBUT'),
	('COR', 'CÓRDOBA'),
	('CRR', 'CORRIENTES'),
	('ENR', 'ENTRE RÍOS'),
	('FOR', 'FORMOSA'),
	('ISM', 'ISLAS MALVINAS'),
	('JUY', 'JUJUY'),
	('LPM', 'LA PAMPA'),
	('RIOJ', 'LA RIOJA'),
	('MZA', 'MENDOZA'),
	('MIS', 'MISIONES'),
	('NQN', 'NEUQUEN'),
	('RN', 'RÍO NEGRO'),
	('SAL', 'SALTA'),
	('SJU', 'SAN JUAN'),
	('SLU', 'SAN LUIS'),
	('SCR', 'SANTA CRUZ'),
	('STFE', 'SANTA FÉ'),
	('SEST', 'SANTIAGO DEL ESTERO'),
	('TF', 'TIERRA DEL FUEGO');

-- Volcando estructura para tabla seguro.ruta
CREATE TABLE IF NOT EXISTS `ruta` (
  `id_ruta` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` char(50) NOT NULL,
  `regular_exp` varchar(100) NOT NULL DEFAULT '',
  `descripcion` varchar(100) NOT NULL DEFAULT '',
  `forall` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id_ruta`),
  KEY `ruta` (`ruta`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.ruta: ~10 rows (aproximadamente)
INSERT INTO `ruta` (`id_ruta`, `ruta`, `regular_exp`, `descripcion`, `forall`) VALUES
	(1, '*', '/.*\\/.*/', 'Todo el sistema', b'0'),
	(2, '*/usuario/*', '/.*\\/usuario\\/.*/', 'Usuarios Manejo general', b'0'),
	(3, '*/empleado/*', '/.*\\/empleado\\/.*/', 'Empleados Manejo general', b'0'),
	(4, 'GET/usuario/all', '/GET\\/usuario\\/all/', 'Usuarios Listado de usuarios', b'0'),
	(5, 'GET/usuario/allfree', '/GET\\/usuario\\/allfree/', 'Usuarios Listado de usuarios sin empleado asignado', b'0'),
	(6, 'POST/usuario', '/POST\\/usuario/', 'Usuarios Crear', b'0'),
	(7, 'PUT/usuario/desactivar/{usuario}', '/PUT\\/usuario\\/desactivar\\/.*/', 'Usuarios Desactivar', b'0'),
	(8, 'PUT/usuario/activar/{usuario}', '/PUT\\/usuario\\/activar\\/.*/', 'Usuarios Activar', b'0'),
	(9, 'PUT/usuario/clave', '/PUT\\/usuario\\/clave/', 'Usuarios Cambio de clave', b'1'),
	(10, 'POST/empleado', '/POST\\/empleado/', 'Empleados Crear', b'0');

-- Volcando estructura para tabla seguro.tipo_automovil
CREATE TABLE IF NOT EXISTS `tipo_automovil` (
  `id_tipo_automovil` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(40) NOT NULL,
  `sigla_tipo` char(4) NOT NULL,
  `Descripción` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_tipo_automovil`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.tipo_automovil: ~3 rows (aproximadamente)
INSERT INTO `tipo_automovil` (`id_tipo_automovil`, `tipo`, `sigla_tipo`, `Descripción`) VALUES
	(1, 'Automovil', 'AM', 'Automovil de cuatro ruedas'),
	(2, 'Moto vehículo', 'MV', 'Motovehículo de dos ruedas'),
	(3, 'Camioneta', 'CN', 'Automovil de cuatro ruedas de gran tamaño');

-- Volcando estructura para tabla seguro.tipo_inmueble
CREATE TABLE IF NOT EXISTS `tipo_inmueble` (
  `id_inmueble_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` char(50) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_inmueble_tipo`),
  KEY `tipo` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.tipo_inmueble: ~3 rows (aproximadamente)
INSERT INTO `tipo_inmueble` (`id_inmueble_tipo`, `tipo`, `descripcion`) VALUES
	(1, 'Vivienda', NULL),
	(2, 'Local', NULL),
	(3, 'Edificio', NULL);

-- Volcando estructura para tabla seguro.tipo_plan
CREATE TABLE IF NOT EXISTS `tipo_plan` (
  `id_tipo_plan` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_plan` varchar(50) NOT NULL DEFAULT '',
  `descripcion` varchar(200) DEFAULT NULL,
  `activo` bit(1) DEFAULT b'1',
  PRIMARY KEY (`id_tipo_plan`),
  UNIQUE KEY `tipo_plan` (`tipo_plan`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.tipo_plan: ~6 rows (aproximadamente)
INSERT INTO `tipo_plan` (`id_tipo_plan`, `tipo_plan`, `descripcion`, `activo`) VALUES
	(1, 'F', 'Responsabilidad civil + grúa 100 km  + robo  + inc', b'1'),
	(2, 'B', 'Responsabilidad civil + grúa 100 km  + robo  + inc', b'1'),
	(3, 'G', 'Responsabilidad civil + grúa 100 km + robo + incendio total y parcial + vidrios laterales+ robo de ruedas Con desgaste + cerraduras ext', b'1'),
	(4, 'C', 'Responsabilidad civil + grua 100 km + robo + incendio total y parcial + vidrios laterales+ destrucción total por accidente + robo de ruedas con desgaste+ cerraduras ext.', b'1'),
	(5, 'M', 'Responsabilidad civil + grúa 300 km + robo + incendio total y parcial + vidrios laterales + destrucción total por accidente + parabrisas + luneta + robo de ruedas+ cerraduras ext ', b'1'),
	(6, 'P', 'Responsabilidad civil + grúa 300 km + robo + incendio total y parcial + vidrios laterales + destrucción total por accidente + parabrisas + luneta + granizo + robo de ruedas+ cerraduras ext', b'1');

-- Volcando estructura para tabla seguro.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL DEFAULT '0',
  `clave` char(150) NOT NULL DEFAULT '0',
  `email` varchar(150) NOT NULL DEFAULT '0',
  `activo` bit(1) NOT NULL DEFAULT b'1',
  `cambiar_pass` bit(1) NOT NULL DEFAULT b'1',
  `id_perfil` int(11) DEFAULT NULL,
  `imgPerfil` varchar(50) NOT NULL DEFAULT 'img/undraw_profile.svg',
  PRIMARY KEY (`id_usuario`) USING BTREE,
  UNIQUE KEY `usuario` (`usuario`) USING BTREE,
  KEY `fk_usuario_perfil` (`id_perfil`),
  CONSTRAINT `fk_usuario_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla seguro.usuario: ~10 rows (aproximadamente)
INSERT INTO `usuario` (`id_usuario`, `usuario`, `clave`, `email`, `activo`, `cambiar_pass`, `id_perfil`, `imgPerfil`) VALUES
	(1, 'sistema', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'sistema@pepe.com', b'1', b'0', 1, 'img/seba.PNG'),
	(2, 'usuario1', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'usuario@pepe.com', b'1', b'1', 1, 'img/undraw_profile.svg'),
	(3, 'usuario2', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'pepe@pepe.com', b'0', b'1', NULL, 'img/undraw_profile.svg'),
	(4, 'usuarioee', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'pbargone@gmail.com', b'0', b'1', 1, 'img/undraw_profile.svg'),
	(5, 'admin12', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'sebastian.lanzetti@hotmail.com', b'1', b'1', 2, 'img/undraw_profile.svg'),
	(6, 'admin123', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'sebastian.lanzetti@hotmail.com', b'1', b'1', 2, 'img/undraw_profile.svg'),
	(7, 'prueba01', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'sebastian.lanzetti@hotmail.com', b'1', b'1', 2, 'img/undraw_profile.svg'),
	(8, 'prueba02', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'sebastian.lanzetti@hotmail.com', b'1', b'1', 2, 'img/undraw_profile.svg'),
	(9, 'sistema45', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'sistema45@pepe.com', b'1', b'1', 2, 'img/undraw_profile.svg'),
	(10, 'uperfil', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'sebastian.lanzetti@hotmail.com', b'1', b'1', 3, 'img/undraw_profile.svg'),
	(11, 'usuarioPerfil', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'sebastian.lanzettip@hotmail.com', b'1', b'1', 2, 'img/undraw_profile.svg'),
	(12, 'usuarioPerfil2', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'usuarioPerfil2@asd.com', b'1', b'0', 3, 'img/undraw_profile.svg');

-- Volcando estructura para tabla seguro.usuario_perfil
CREATE TABLE IF NOT EXISTS `usuario_perfil` (
  `id_usuario_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT '',
  `apellido` varchar(50) DEFAULT '',
  `dni` varchar(50) DEFAULT NULL,
  `calle` varchar(50) DEFAULT '',
  `numero_calle` varchar(50) DEFAULT '',
  `localidad` varchar(50) DEFAULT '',
  `telefono` varchar(50) DEFAULT 'No informa',
  `cod_provincia` char(10) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_perfil`) USING BTREE,
  UNIQUE KEY `id_usuario` (`id_usuario`),
  KEY `fk_empleado_usuario` (`id_usuario`) USING BTREE,
  KEY `fk_empleado_provincia` (`cod_provincia`) USING BTREE,
  CONSTRAINT `usuario_perfil_ibfk_1` FOREIGN KEY (`cod_provincia`) REFERENCES `provincia` (`cod_provincia`),
  CONSTRAINT `usuario_perfil_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='Es la tabla CLIENTE, no le cambio los datos para no modificar todo el programa.';

-- Volcando datos para la tabla seguro.usuario_perfil: ~3 rows (aproximadamente)
INSERT INTO `usuario_perfil` (`id_usuario_perfil`, `nombre`, `apellido`, `dni`, `calle`, `numero_calle`, `localidad`, `telefono`, `cod_provincia`, `id_usuario`) VALUES
	(65, 'sebastian', 'lanzetti', '383712', 'Taborda', '3823', 'Lanús', '1131991060', 'BSAS', 1),
	(67, 'usuario1', 'U1Ape', '3736', 'Rosales', '11', 'RDE', '11131', 'CHA', 2),
	(78, 'perfil2', 'perfilape', 'perfildni', 'perfilcalle', 'perfilnum', 'perfilloc', '11131', 'MIS', 10),
	(79, '', '', NULL, '', '', '', 'No informa', NULL, 11),
	(80, 'dami', 'gat', 'gat', 'gat', 'gat', 'gat', '123123123', 'BSAS', 12);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
