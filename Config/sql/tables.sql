-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `employee_types`;
CREATE TABLE `employee_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `ord` int(11) NOT NULL DEFAULT '99999999',
  `color` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `days` float NOT NULL DEFAULT '25',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `employee_types` (`id`, `title`, `ord`, `color`, `days`) VALUES
(1,	'Academical',	99999999,	'#478B00',	40),
(2,	'Technical',	99999999,	'#135EB9',	25),
(3,	'Třetí',	99999999,	'#E3AD03',	1000);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `givenname` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `sn` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `employee_type_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_type_id` (`employee_type_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`employee_type_id`) REFERENCES `employee_types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `users` (`id`, `username`, `password`, `mail`, `givenname`, `sn`, `employee_type_id`, `created`, `modified`) VALUES
(97,	'fucik',	NULL,	'fucik@ufal.mff.cuni.cz',	'Milan',	'Fucik',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(98,	'vk',	NULL,	'vk@ufal.mff.cuni.cz',	'Vladislav',	'Kubon',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(99,	'vodrazka',	NULL,	'vodrazka@ufal.mff.cuni.cz',	'Jindrich',	'Vodrazka',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(100,	'pecina',	NULL,	'pecina@ufal.mff.cuni.cz',	'Pavel',	'Pecina',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(101,	'fucikova',	NULL,	'fucikova@ufal.mff.cuni.cz',	'Eva',	'Fucikova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(102,	'zeman',	NULL,	'zeman@ufal.mff.cuni.cz',	'Daniel',	'Zeman',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(103,	'brdickov',	NULL,	'brdickov@ufal.mff.cuni.cz',	'Libuse',	'Brdickova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(104,	'hlavacova',	NULL,	'hlavacova@ufal.mff.cuni.cz',	'Jaroslava',	'Hlavacova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(105,	'hajic',	NULL,	'hajic@ufal.mff.cuni.cz',	'Jan',	'Hajic',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(106,	'lopatkova',	NULL,	'lopatkova@ufal.mff.cuni.cz',	'Marketa',	'Lopatkova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(107,	'zilka',	NULL,	'zilka@ufal.mff.cuni.cz',	'Lukas',	'Zilka',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(108,	'korvas',	NULL,	'korvas@ufal.mff.cuni.cz',	'Matej',	'Korvas',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(109,	'pralinka',	NULL,	'pralinka@ufal.mff.cuni.cz',	'Project',	'Pralinka',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(110,	'rosa',	NULL,	'rosa@ufal.mff.cuni.cz',	'Rudolf',	'Rosa',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(111,	'jurcicek',	NULL,	'jurcicek@ufal.mff.cuni.cz',	'Filip',	'Jurcicek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(112,	'tamchyna',	NULL,	'tamchyna@ufal.mff.cuni.cz',	'Ales',	'Tamchyna',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(113,	'bojar',	NULL,	'bojar@ufal.mff.cuni.cz',	'Ondrej',	'Bojar',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(114,	'barancikova',	NULL,	'barancikova@ufal.mff.cuni.cz',	'Petra',	'Barancikova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(115,	'mirovsky',	NULL,	'mirovsky@ufal.mff.cuni.cz',	'Jiri',	'Mirovsky',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(116,	'kettnerova',	NULL,	'kettnerova@ufal.mff.cuni.cz',	'Vaclava',	'Kettnerova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(117,	'kotesovcova',	NULL,	'kotesovcova@ufal.mff.cuni.cz',	'Anna',	'Kotesovcova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(118,	'galuscakova',	NULL,	'galuscakova@ufal.mff.cuni.cz',	'Petra',	'Galuscakova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(119,	'stranak',	NULL,	'stranak@ufal.mff.cuni.cz',	'Pavel',	'Stranak',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(120,	'sevcikova',	NULL,	'sevcikova@ufal.mff.cuni.cz',	'Magda',	'Sevcikova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(121,	'odusek',	NULL,	'odusek@ufal.mff.cuni.cz',	'Ondrej',	'Dusek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(122,	'vernerova',	NULL,	'vernerova@ufal.mff.cuni.cz',	'Anna',	'Vernerova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(123,	'smejkalova',	NULL,	'smejkalova@ufal.mff.cuni.cz',	'Lenka',	'Smejkalova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(124,	'rysova',	NULL,	'rysova@ufal.mff.cuni.cz',	'Katerina',	'Rysova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(125,	'magdalena.rysova',	NULL,	'magdalena.rysova@ufal.mff.cuni.cz',	'Magdalena',	'Rysova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(126,	'cinkova',	NULL,	'cinkova@ufal.mff.cuni.cz',	'Silvie',	'Cinkova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(127,	'hladka',	NULL,	'hladka@ufal.mff.cuni.cz',	'Barbora',	'Hladka Vidova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(128,	'krizkova',	NULL,	'krizkova@ufal.mff.cuni.cz',	'Marie',	'Krizkova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(129,	'bryanova',	NULL,	'bryanova@ufal.mff.cuni.cz',	'Katerina',	'Bryanova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(130,	'popel',	NULL,	'popel@ufal.mff.cuni.cz',	'Martin',	'Popel',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(131,	'zabokrtsky',	NULL,	'zabokrtsky@ufal.mff.cuni.cz',	'Zdenek',	'Zabokrtsky',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(132,	'linh',	NULL,	'linh@ufal.mff.cuni.cz',	'Linh',	'Nguy',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(133,	'cmejrek',	NULL,	'cmejrek@ufal.mff.cuni.cz',	'Martin',	'Cmejrek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(134,	'ramasamy',	NULL,	'ramasamy@ufal.mff.cuni.cz',	'Loganathan',	'Ramasamy',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(135,	'havelka',	NULL,	'havelka@ufal.mff.cuni.cz',	'Jiri',	'Havelka',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(136,	'kriz',	NULL,	'kriz@ufal.mff.cuni.cz',	'Vincent',	'Kriz',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(137,	'hana',	NULL,	'hana@ufal.mff.cuni.cz',	'Jiri',	'Hana',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(138,	'bejcek',	NULL,	'bejcek@ufal.mff.cuni.cz',	'Eduard',	'Bejcek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(139,	'stepanek',	NULL,	'stepanek@ufal.mff.cuni.cz',	'Jan',	'Stepanek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(140,	'marecek',	NULL,	'marecek@ufal.mff.cuni.cz',	'David',	'Marecek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(141,	'peterek',	NULL,	'peterek@ufal.mff.cuni.cz',	'Nino',	'Peterek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(142,	'holub',	NULL,	'holub@ufal.mff.cuni.cz',	'Martin',	'Holub',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(143,	'polakova',	NULL,	'polakova@ufal.mff.cuni.cz',	'Lucie',	'Polakova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(144,	'kolarova',	NULL,	'kolarova@ufal.mff.cuni.cz',	'Veronika',	'Kolářová',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(145,	'nedoluzko',	NULL,	'nedoluzko@ufal.mff.cuni.cz',	'Anna',	'Nedoluzhko',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(146,	'hajicj',	NULL,	'hajicj@ufal.mff.cuni.cz',	'Jan',	'Hajic Jr.',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(147,	'curin',	NULL,	'curin@ufal.mff.cuni.cz',	'Jan',	'Curin',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(148,	'uresova',	NULL,	'uresova@ufal.mff.cuni.cz',	'Zdenka',	'Uresova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(149,	'sgall',	NULL,	'sgall@ufal.mff.cuni.cz',	'Petr',	'Sgall',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(150,	'veselovska',	NULL,	'veselovska@ufal.mff.cuni.cz',	'Katerina',	'Veselovska',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(151,	'jawaid',	NULL,	'jawaid@ufal.mff.cuni.cz',	'Bushra',	'Jawaid',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(152,	'kamran',	NULL,	'kamran@ufal.mff.cuni.cz',	'Amir',	'Kamran',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(153,	'sindlerova',	NULL,	'sindlerova@ufal.mff.cuni.cz',	'Jana',	'Sindlerova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(154,	'mlynar',	NULL,	'mlynar@ufal.mff.cuni.cz',	'Jakub',	'Mlynar',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(155,	'helcl',	NULL,	'helcl@ufal.mff.cuni.cz',	'Jindrich',	'Helcl',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(156,	'jinova',	NULL,	'jinova@ufal.mff.cuni.cz',	'Pavlina',	'Jinova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(157,	'kralik',	NULL,	'kralik@ufal.mff.cuni.cz',	'Kvetoslava',	'Kralikova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(158,	'kraut',	NULL,	'kraut@ufal.mff.cuni.cz',	'Tomas',	'Kraut',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(159,	'klusacek',	NULL,	'klusacek@ufal.mff.cuni.cz',	'David',	'Klusacek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(160,	'sedlak',	NULL,	'sedlak@ufal.mff.cuni.cz',	'Michal',	'Sedlak',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(161,	'mnovak',	NULL,	'mnovak@ufal.mff.cuni.cz',	'Michal',	'Novak',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(162,	'krejcova',	NULL,	'krejcova@ufal.mff.cuni.cz',	'Ema',	'Krejcova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(163,	'kljueva',	NULL,	'kljueva@ufal.mff.cuni.cz',	'Natalia',	'Kljueva',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(164,	'larasati',	NULL,	'larasati@ufal.mff.cuni.cz',	'Septina',	'Larasati',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(165,	'green',	NULL,	'green@ufal.mff.cuni.cz',	'Nathan',	'Green',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(166,	'zikanova',	NULL,	'zikanova@ufal.mff.cuni.cz',	'Sarka',	'Zikanova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(167,	'panevova',	NULL,	'panevova@ufal.mff.cuni.cz',	'Jarmila',	'Panevova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(168,	'mikulova',	NULL,	'mikulova@ufal.mff.cuni.cz',	'Marie',	'Mikulova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(169,	'hajicova',	NULL,	'hajicova@ufal.mff.cuni.cz',	'Eva',	'Hajicova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(170,	'ptacek',	NULL,	'ptacek@ufal.mff.cuni.cz',	'Jan',	'Ptacek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(171,	'kosarko',	NULL,	'kosarko@ufal.mff.cuni.cz',	'Ondrej',	'Kosarko',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(172,	'pognan',	NULL,	'pognan@ufal.mff.cuni.cz',	'Patrice',	'Pognan',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(173,	'kruza',	NULL,	'kruza@ufal.mff.cuni.cz',	'Oldrich',	'Kruza',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(174,	'strakova',	NULL,	'strakova@ufal.mff.cuni.cz',	'Jana',	'Strakova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(175,	'drupal_connector',	NULL,	'drupal_connector@ufal.mff.cuni.cz',	'Drupal',	'Connector',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(176,	'oplatek',	NULL,	'oplatek@ufal.mff.cuni.cz',	'Ondrej',	'Platek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(177,	'misutka',	NULL,	'misutka@ufal.mff.cuni.cz',	'Jozef',	'Misutka',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(178,	'bedrichova',	NULL,	'bedrichova@ufal.mff.cuni.cz',	'Zuzana',	'Bedrichova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(179,	'saleh',	NULL,	'saleh@ufal.mff.cuni.cz',	'Shadi',	'Saleh',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(180,	'smrz',	NULL,	'smrz@ufal.mff.cuni.cz',	'Ota',	'Smrz',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(181,	'straka',	NULL,	'straka@ufal.mff.cuni.cz',	'Milan',	'Straka',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(182,	'jankovsky',	NULL,	'jankovsky@ufal.mff.cuni.cz',	'Petr',	'Jankovsky',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(183,	'vesela',	NULL,	'vesela@ufal.mff.cuni.cz',	'Katerina',	'Vesela',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(184,	'libovicky',	NULL,	'libovicky@ufal.mff.cuni.cz',	'Jindrich',	'Libovicky',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(185,	'tomsu',	NULL,	'tomsu@ufal.mff.cuni.cz',	'Kristyna',	'Tomsu',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(186,	'luksova',	NULL,	'luksova@ufal.mff.cuni.cz',	'Ivana',	'Luksova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(187,	'josifko',	NULL,	'josifko@ufal.mff.cuni.cz',	'Michal',	'Josifko',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(188,	'sudarikov',	NULL,	'sudarikov@ufal.mff.cuni.cz',	'Roman',	'Sudarikov',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(189,	'ebrahimian',	NULL,	'ebrahimian@ufal.mff.cuni.cz',	'Ahmad',	'Ebrahimian',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07'),
(190,	'archives',	NULL,	'archives@ufal.mff.cuni.cz',	'DL',	'Archives',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07');

DROP TABLE IF EXISTS `vacations`;
CREATE TABLE `vacations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `vacation_type_id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `vacation_type_id` (`vacation_type_id`),
  CONSTRAINT `vacations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `vacations_ibfk_2` FOREIGN KEY (`vacation_type_id`) REFERENCES `vacation_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


DROP TABLE IF EXISTS `vacation_types`;
CREATE TABLE `vacation_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `ord` int(11) NOT NULL DEFAULT '99999999',
  `color` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `vacation_types` (`id`, `title`, `ord`, `color`) VALUES
(2,	'Služební cesta',	99999999,	'#043965'),
(3,	'Dovolená',	99999999,	'#519600'),
(4,	'Konference',	99999999,	'#F0C100'),
(5,	'Stáž',	99999999,	'#F74F04'),
(6,	'Mateřská',	99999999,	'#96002D');

-- 2015-07-17 09:22:53
