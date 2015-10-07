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
(2,	'Technical',	99999999,	'#135EB9',	25);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `homepage` varchar(50) COLLATE utf8_czech_ci DEFAULT '/rooms',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `roles` (`id`, `alias`, `homepage`) VALUES
(1,	'Anonymous',	'/'),
(2,	'User',	'/'),
(7,	'Administrator',	'/');

DROP TABLE IF EXISTS `roles_users`;
CREATE TABLE `roles_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `roles_users` (`role_id`, `user_id`) VALUES
(7,	191);

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
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `employee_type_id` (`employee_type_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`employee_type_id`) REFERENCES `employee_types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `users` (`id`, `username`, `password`, `mail`, `givenname`, `sn`, `employee_type_id`, `created`, `modified`, `disabled`) VALUES
(97,	'fucik',	NULL,	'fucik@ufal.mff.cuni.cz',	'Milan',	'Fucik',	2,	'2015-07-17 17:55:07',	'2015-07-21 14:32:16',	0),
(98,	'vk',	NULL,	'vk@ufal.mff.cuni.cz',	'Vladislav',	'Kubon',	2,	'2015-07-17 17:55:07',	'2015-07-21 13:46:36',	0),
(99,	'vodrazka',	NULL,	'vodrazka@ufal.mff.cuni.cz',	'Jindrich',	'Vodrazka',	2,	'2015-07-17 17:55:07',	'2015-07-21 13:02:10',	0),
(100,	'pecina',	NULL,	'pecina@ufal.mff.cuni.cz',	'Pavel',	'Pecina',	1,	'2015-07-17 17:55:07',	'2015-07-21 13:48:10',	0),
(101,	'fucikova',	NULL,	'fucikova@ufal.mff.cuni.cz',	'Eva',	'Fucikova',	1,	'2015-07-17 17:55:07',	'2015-08-28 11:50:20',	0),
(102,	'zeman',	NULL,	'zeman@ufal.mff.cuni.cz',	'Daniel',	'Zeman',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(103,	'brdickov',	NULL,	'brdickov@ufal.mff.cuni.cz',	'Libuse',	'Brdickova',	NULL,	'2015-07-17 17:55:07',	'2015-09-18 13:59:51',	0),
(104,	'hlavacova',	NULL,	'hlavacova@ufal.mff.cuni.cz',	'Jaroslava',	'Hlavacova',	1,	'2015-07-17 17:55:07',	'2015-07-21 13:02:18',	0),
(105,	'hajic',	NULL,	'hajic@ufal.mff.cuni.cz',	'Jan',	'Hajic',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(106,	'lopatkova',	NULL,	'lopatkova@ufal.mff.cuni.cz',	'Marketa',	'Lopatkova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(107,	'zilka',	NULL,	'zilka@ufal.mff.cuni.cz',	'Lukas',	'Zilka',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(108,	'korvas',	NULL,	'korvas@ufal.mff.cuni.cz',	'Matej',	'Korvas',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(109,	'pralinka',	NULL,	'pralinka@ufal.mff.cuni.cz',	'Project',	'Pralinka',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(110,	'rosa',	NULL,	'rosa@ufal.mff.cuni.cz',	'Rudolf',	'Rosa',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(111,	'jurcicek',	NULL,	'jurcicek@ufal.mff.cuni.cz',	'Filip',	'Jurcicek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(112,	'tamchyna',	NULL,	'tamchyna@ufal.mff.cuni.cz',	'Ales',	'Tamchyna',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(113,	'bojar',	NULL,	'bojar@ufal.mff.cuni.cz',	'Ondrej',	'Bojar',	1,	'2015-07-17 17:55:07',	'2015-07-21 14:00:43',	0),
(114,	'barancikova',	NULL,	'barancikova@ufal.mff.cuni.cz',	'Petra',	'Barancikova',	2,	'2015-07-17 17:55:07',	'2015-09-18 13:59:46',	0),
(115,	'mirovsky',	NULL,	'mirovsky@ufal.mff.cuni.cz',	'Jiri',	'Mirovsky',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(116,	'kettnerova',	NULL,	'kettnerova@ufal.mff.cuni.cz',	'Vaclava',	'Kettnerova',	1,	'2015-07-17 17:55:07',	'2015-07-21 13:03:55',	0),
(117,	'kotesovcova',	NULL,	'kotesovcova@ufal.mff.cuni.cz',	'Anna',	'Kotesovcova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(118,	'galuscakova',	NULL,	'galuscakova@ufal.mff.cuni.cz',	'Petra',	'Galuscakova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(119,	'stranak',	NULL,	'stranak@ufal.mff.cuni.cz',	'Pavel',	'Stranak',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(120,	'sevcikova',	NULL,	'sevcikova@ufal.mff.cuni.cz',	'Magda',	'Sevcikova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(121,	'odusek',	NULL,	'odusek@ufal.mff.cuni.cz',	'Ondrej',	'Dusek',	1,	'2015-07-17 17:55:07',	'2015-08-28 11:50:21',	0),
(122,	'vernerova',	NULL,	'vernerova@ufal.mff.cuni.cz',	'Anna',	'Vernerova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(123,	'smejkalova',	NULL,	'smejkalova@ufal.mff.cuni.cz',	'Lenka',	'Smejkalova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(124,	'rysova',	NULL,	'rysova@ufal.mff.cuni.cz',	'Katerina',	'Rysova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(125,	'magdalena.rysova',	NULL,	'magdalena.rysova@ufal.mff.cuni.cz',	'Magdalena',	'Rysova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(126,	'cinkova',	NULL,	'cinkova@ufal.mff.cuni.cz',	'Silvie',	'Cinkova',	1,	'2015-07-17 17:55:07',	'2015-08-28 11:50:22',	0),
(127,	'hladka',	NULL,	'hladka@ufal.mff.cuni.cz',	'Barbora',	'Hladka Vidova',	1,	'2015-07-17 17:55:07',	'2015-09-18 14:00:12',	0),
(128,	'krizkova',	NULL,	'krizkova@ufal.mff.cuni.cz',	'Marie',	'Krizkova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(129,	'bryanova',	NULL,	'bryanova@ufal.mff.cuni.cz',	'Katerina',	'Bryanova',	1,	'2015-07-17 17:55:07',	'2015-07-28 12:44:37',	0),
(130,	'popel',	NULL,	'popel@ufal.mff.cuni.cz',	'Martin',	'Popel',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(131,	'zabokrtsky',	NULL,	'zabokrtsky@ufal.mff.cuni.cz',	'Zdenek',	'Zabokrtsky',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(132,	'linh',	NULL,	'linh@ufal.mff.cuni.cz',	'Linh',	'Nguy',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(133,	'cmejrek',	NULL,	'cmejrek@ufal.mff.cuni.cz',	'Martin',	'Cmejrek',	1,	'2015-07-17 17:55:07',	'2015-07-21 14:00:41',	0),
(134,	'ramasamy',	NULL,	'ramasamy@ufal.mff.cuni.cz',	'Loganathan',	'Ramasamy',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(135,	'havelka',	NULL,	'havelka@ufal.mff.cuni.cz',	'Jiri',	'Havelka',	2,	'2015-07-17 17:55:07',	'2015-09-18 14:00:05',	0),
(136,	'kriz',	NULL,	'kriz@ufal.mff.cuni.cz',	'Vincent',	'Kriz',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(137,	'hana',	NULL,	'hana@ufal.mff.cuni.cz',	'Jiri',	'Hana',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(138,	'bejcek',	NULL,	'bejcek@ufal.mff.cuni.cz',	'Eduard',	'Bejcek',	1,	'2015-07-17 17:55:07',	'2015-09-18 14:00:02',	0),
(139,	'stepanek',	NULL,	'stepanek@ufal.mff.cuni.cz',	'Jan',	'Stepanek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(140,	'marecek',	NULL,	'marecek@ufal.mff.cuni.cz',	'David',	'Marecek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(141,	'peterek',	NULL,	'peterek@ufal.mff.cuni.cz',	'Nino',	'Peterek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(142,	'holub',	NULL,	'holub@ufal.mff.cuni.cz',	'Martin',	'Holub',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(143,	'polakova',	NULL,	'polakova@ufal.mff.cuni.cz',	'Lucie',	'Polakova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(144,	'kolarova',	NULL,	'kolarova@ufal.mff.cuni.cz',	'Veronika',	'Kolářová',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(145,	'nedoluzko',	NULL,	'nedoluzko@ufal.mff.cuni.cz',	'Anna',	'Nedoluzhko',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(146,	'hajicj',	NULL,	'hajicj@ufal.mff.cuni.cz',	'Jan',	'Hajic Jr.',	1,	'2015-07-17 17:55:07',	'2015-09-11 12:18:20',	0),
(147,	'curin',	NULL,	'curin@ufal.mff.cuni.cz',	'Jan',	'Curin',	1,	'2015-07-17 17:55:07',	'2015-07-21 14:00:42',	0),
(148,	'uresova',	NULL,	'uresova@ufal.mff.cuni.cz',	'Zdenka',	'Uresova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(149,	'sgall',	NULL,	'sgall@ufal.mff.cuni.cz',	'Petr',	'Sgall',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(150,	'veselovska',	NULL,	'veselovska@ufal.mff.cuni.cz',	'Katerina',	'Veselovska',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(151,	'jawaid',	NULL,	'jawaid@ufal.mff.cuni.cz',	'Bushra',	'Jawaid',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(152,	'kamran',	NULL,	'kamran@ufal.mff.cuni.cz',	'Amir',	'Kamran',	2,	'2015-07-17 17:55:07',	'2015-09-18 14:00:16',	0),
(153,	'sindlerova',	NULL,	'sindlerova@ufal.mff.cuni.cz',	'Jana',	'Sindlerova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(154,	'mlynar',	NULL,	'mlynar@ufal.mff.cuni.cz',	'Jakub',	'Mlynar',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(155,	'helcl',	NULL,	'helcl@ufal.mff.cuni.cz',	'Jindrich',	'Helcl',	1,	'2015-07-17 17:55:07',	'2015-09-18 14:00:13',	0),
(156,	'jinova',	NULL,	'jinova@ufal.mff.cuni.cz',	'Pavlina',	'Jinova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(157,	'kralik',	NULL,	'kralik@ufal.mff.cuni.cz',	'Kvetoslava',	'Kralikova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(158,	'kraut',	NULL,	'kraut@ufal.mff.cuni.cz',	'Tomas',	'Kraut',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(159,	'klusacek',	NULL,	'klusacek@ufal.mff.cuni.cz',	'David',	'Klusacek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(160,	'sedlak',	NULL,	'sedlak@ufal.mff.cuni.cz',	'Michal',	'Sedlak',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(161,	'mnovak',	NULL,	'mnovak@ufal.mff.cuni.cz',	'Michal',	'Novak',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(162,	'krejcova',	NULL,	'krejcova@ufal.mff.cuni.cz',	'Ema',	'Krejcova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(163,	'kljueva',	NULL,	'kljueva@ufal.mff.cuni.cz',	'Natalia',	'Kljueva',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(164,	'larasati',	NULL,	'larasati@ufal.mff.cuni.cz',	'Septina',	'Larasati',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(165,	'green',	NULL,	'green@ufal.mff.cuni.cz',	'Nathan',	'Green',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(166,	'zikanova',	NULL,	'zikanova@ufal.mff.cuni.cz',	'Sarka',	'Zikanova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(167,	'panevova',	NULL,	'panevova@ufal.mff.cuni.cz',	'Jarmila',	'Panevova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(168,	'mikulova',	NULL,	'mikulova@ufal.mff.cuni.cz',	'Marie',	'Mikulova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(169,	'hajicova',	NULL,	'hajicova@ufal.mff.cuni.cz',	'Eva',	'Hajicova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(170,	'ptacek',	NULL,	'ptacek@ufal.mff.cuni.cz',	'Jan',	'Ptacek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(171,	'kosarko',	NULL,	'kosarko@ufal.mff.cuni.cz',	'Ondrej',	'Kosarko',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(172,	'pognan',	NULL,	'pognan@ufal.mff.cuni.cz',	'Patrice',	'Pognan',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(173,	'kruza',	NULL,	'kruza@ufal.mff.cuni.cz',	'Oldrich',	'Kruza',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(174,	'strakova',	NULL,	'strakova@ufal.mff.cuni.cz',	'Jana',	'Strakova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(175,	'drupal_connector',	NULL,	'drupal_connector@ufal.mff.cuni.cz',	'Drupal',	'Connector',	1,	'2015-07-17 17:55:07',	'2015-07-28 12:44:35',	0),
(176,	'oplatek',	NULL,	'oplatek@ufal.mff.cuni.cz',	'Ondrej',	'Platek',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(177,	'misutka',	NULL,	'misutka@ufal.mff.cuni.cz',	'Jozef',	'Misutka',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(178,	'bedrichova',	NULL,	'bedrichova@ufal.mff.cuni.cz',	'Zuzana',	'Bedrichova',	NULL,	'2015-07-17 17:55:07',	'2015-09-22 08:03:08',	0),
(179,	'saleh',	NULL,	'saleh@ufal.mff.cuni.cz',	'Shadi',	'Saleh',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(180,	'smrz',	NULL,	'smrz@ufal.mff.cuni.cz',	'Ota',	'Smrz',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(181,	'straka',	NULL,	'straka@ufal.mff.cuni.cz',	'Milan',	'Straka',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(182,	'jankovsky',	NULL,	'jankovsky@ufal.mff.cuni.cz',	'Petr',	'Jankovsky',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(183,	'vesela',	NULL,	'vesela@ufal.mff.cuni.cz',	'Katerina',	'Vesela',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(184,	'libovicky',	NULL,	'libovicky@ufal.mff.cuni.cz',	'Jindrich',	'Libovicky',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(185,	'tomsu',	NULL,	'tomsu@ufal.mff.cuni.cz',	'Kristyna',	'Tomsu',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(186,	'luksova',	NULL,	'luksova@ufal.mff.cuni.cz',	'Ivana',	'Luksova',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(187,	'josifko',	NULL,	'josifko@ufal.mff.cuni.cz',	'Michal',	'Josifko',	2,	'2015-07-17 17:55:07',	'2015-09-18 14:00:16',	0),
(188,	'sudarikov',	NULL,	'sudarikov@ufal.mff.cuni.cz',	'Roman',	'Sudarikov',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	0),
(189,	'ebrahimian',	NULL,	'ebrahimian@ufal.mff.cuni.cz',	'Ahmad',	'Ebrahimian',	1,	'2015-07-17 17:55:07',	'2015-08-28 11:50:21',	0),
(190,	'archives',	NULL,	'archives@ufal.mff.cuni.cz',	'DL',	'Archives',	NULL,	'2015-07-17 17:55:07',	'2015-07-17 17:55:07',	1),
(192,	'test',	'$2a$10$SHNHA7oS6goKsnTIJ3p9WewFg5VouQbuPL5N6WXDJbhN3qDwizvVu',	'',	NULL,	NULL,	NULL,	'2015-09-18 15:38:13',	'2015-09-18 15:38:13',	0);

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

INSERT INTO `vacations` (`id`, `title`, `start`, `end`, `vacation_type_id`, `user_id`) VALUES
(7,	'Služební cesta',	'2015-09-01 00:00:00',	'2015-09-04 00:00:00',	2,	114),
(8,	'Služební cesta',	'2015-08-28 00:00:00',	'2015-08-31 00:00:00',	2,	114),
(9,	'none',	'2015-08-01 00:00:00',	'2015-08-06 00:00:00',	2,	114),
(10,	'none',	'2015-08-03 00:00:00',	'2015-08-08 00:00:00',	2,	138),
(11,	'none',	'2015-08-03 00:00:00',	'2015-08-10 00:00:00',	2,	129),
(12,	'none',	'2015-08-17 00:00:00',	'2015-08-25 00:00:00',	2,	147),
(13,	'none',	'2015-09-05 00:00:00',	'2015-09-09 00:00:00',	2,	114),
(14,	'none',	'2015-07-31 00:00:00',	'2015-08-01 00:00:00',	2,	97),
(15,	'none',	'2015-08-30 00:00:00',	'2015-09-06 00:00:00',	2,	113),
(16,	'none',	'2015-07-31 00:00:00',	'2015-08-04 00:00:00',	2,	106),
(17,	'none',	'2015-08-05 00:00:00',	'2015-08-07 00:00:00',	2,	106),
(18,	'none',	'2015-08-09 00:00:00',	'2015-08-12 00:00:00',	2,	106),
(19,	'none',	'2015-08-14 00:00:00',	'2015-08-16 00:00:00',	2,	106),
(20,	'none',	'2015-08-15 00:00:00',	'2015-08-16 00:00:00',	2,	106),
(21,	'none',	'2015-08-14 00:00:00',	'2015-08-15 00:00:00',	2,	154),
(22,	'none',	'2015-07-30 00:00:00',	'2015-07-31 00:00:00',	2,	106),
(23,	'none',	'2015-09-13 00:00:00',	'2015-09-14 00:00:00',	2,	114),
(24,	'none',	'2015-09-13 00:00:00',	'2015-09-14 00:00:00',	2,	114),
(25,	'none',	'2015-09-13 00:00:00',	'2015-09-14 00:00:00',	2,	114);

DROP TABLE IF EXISTS `vacation_types`;
CREATE TABLE `vacation_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `ord` int(11) NOT NULL DEFAULT '99999999',
  `color` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `vacation_types` (`id`, `title`, `ord`, `color`) VALUES
(2,	'Služební cesta',	0,	'#043965'),
(3,	'Dovolená',	2,	'#519600'),
(4,	'Konference',	1,	'#F0C100'),
(5,	'Stáž',	3,	'#F74F04'),
(6,	'Mateřská',	4,	'#96002D');

-- 2015-10-07 07:49:14
