-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 16 Eyl 2020, 13:18:28
-- Sunucu sürümü: 10.3.16-MariaDB
-- PHP Sürümü: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `yoresel_urunler_vt`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `baskets`
--

CREATE TABLE `baskets` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productId` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productNumber` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `categoryId` smallint(6) NOT NULL,
  `categoryName` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `categoryTop` smallint(6) DEFAULT NULL,
  `categoryUrl` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `icon` varchar(75) COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `status` varchar(2) COLLATE utf8_turkish_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`, `categoryTop`, `categoryUrl`, `icon`, `description`, `status`, `updated_at`, `created_at`) VALUES
(25, 'Kuru Bakliyat', 0, NULL, '', '', '1', '2020-09-16 07:10:30', '2019-12-29 17:40:48'),
(26, 'Tarhana', 25, NULL, '', '', '1', '2020-09-16 07:10:44', '2019-12-29 17:40:57'),
(27, 'Mercimek', 25, NULL, '', '', '1', '2020-09-16 07:10:56', '2020-09-16 07:10:56'),
(28, 'Fasulye', 25, NULL, '', '', '1', '2020-09-16 07:11:10', '2020-09-16 07:11:10'),
(29, 'Konserve', 0, NULL, '', '', '1', '2020-09-16 07:11:47', '2020-09-16 07:11:47'),
(30, 'Domates', 29, NULL, '', '', '1', '2020-09-16 07:11:59', '2020-09-16 07:11:59'),
(31, 'Taze Fasulye', 29, NULL, '', '', '1', '2020-09-16 07:12:39', '2020-09-16 07:12:39');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `city`
--

CREATE TABLE `city` (
  `cityId` smallint(6) NOT NULL,
  `name` varchar(100) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `city`
--

INSERT INTO `city` (`cityId`, `name`) VALUES
(1, 'Adana'),
(2, 'Adıyaman'),
(3, 'Afyonkarahisar'),
(4, 'Ağrı'),
(5, 'Amasya'),
(6, 'Ankara'),
(7, 'Antalya'),
(8, 'Artvin'),
(9, 'Aydın'),
(10, 'Balıkesir'),
(11, 'Bilecik'),
(12, 'Bingöl'),
(13, 'Bitlis'),
(14, 'Bolu'),
(15, 'Burdur'),
(16, 'Bursa'),
(17, 'Çanakkale'),
(18, 'Çankırı'),
(19, 'Çorum'),
(20, 'Denizli'),
(21, 'Diyarbakır'),
(22, 'Edirne'),
(23, 'Elazığ'),
(24, 'Erzincan'),
(25, 'Erzurum'),
(26, 'Eskişehir'),
(27, 'Gaziantep'),
(28, 'Giresun'),
(29, 'Gümüşhane'),
(30, 'Hakkari'),
(31, 'Hatay'),
(32, 'Isparta'),
(33, 'Mersin'),
(34, 'İstanbul'),
(35, 'İzmir'),
(36, 'Kars'),
(37, 'Kastamonu'),
(38, 'Kayseri'),
(39, 'Kırklareli'),
(40, 'Kırşehir'),
(41, 'Kocaeli'),
(42, 'Konya'),
(43, 'Kütahya'),
(44, 'Malatya'),
(45, 'Manisa'),
(46, 'Kahramanmaraş'),
(47, 'Mardin'),
(48, 'Muğla'),
(49, 'Muş'),
(50, 'Nevşehir'),
(51, 'Niğde'),
(52, 'Ordu'),
(53, 'Rize'),
(54, 'Sakarya'),
(55, 'Samsun'),
(56, 'Siirt'),
(57, 'Sinop'),
(58, 'Sivas'),
(59, 'Tekirdağ'),
(60, 'Tokat'),
(61, 'Trabzon'),
(62, 'Tunceli'),
(63, 'Şanlıurfa'),
(64, 'Uşak'),
(65, 'Van'),
(66, 'Yozgat'),
(67, 'Zonguldak'),
(68, 'Aksaray'),
(69, 'Bayburt'),
(70, 'Karaman'),
(71, 'Kırıkkale'),
(72, 'Batman'),
(73, 'Şırnak'),
(74, 'Bartın'),
(75, 'Ardahan'),
(76, 'Iğdır'),
(77, 'Yalova'),
(78, 'Karabük'),
(79, 'Kilis'),
(80, 'Osmaniye'),
(81, 'Düzce');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productSeller` varchar(155) COLLATE utf8_turkish_ci DEFAULT NULL,
  `point` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `commentDetail` text COLLATE utf8_turkish_ci NOT NULL,
  `checked` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`commentId`, `userId`, `productId`, `productSeller`, `point`, `commentDetail`, `checked`, `updated_at`, `created_at`) VALUES
(6, 1, 16, '1', '3', 'Tarhana Yorumu', '2', '2020-09-16 07:59:10', '2020-09-16 07:58:39');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `district`
--

CREATE TABLE `district` (
  `districtId` smallint(6) NOT NULL,
  `cityId` smallint(6) NOT NULL,
  `name` varchar(100) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `district`
--

INSERT INTO `district` (`districtId`, `cityId`, `name`) VALUES
(1, 1, 'Aladağ'),
(2, 1, 'Ceyhan'),
(3, 1, 'Çukurova'),
(4, 1, 'Feke'),
(5, 1, 'İmamoğlu'),
(6, 1, 'Karaisalı'),
(7, 1, 'Karataş'),
(8, 1, 'Kozan'),
(9, 1, 'Pozantı'),
(10, 1, 'Saimbeyli'),
(11, 1, 'Sarıçam'),
(12, 1, 'Tufanbeyli'),
(13, 1, 'Yumurtalık'),
(14, 1, 'Yüreğir'),
(15, 2, 'Besni'),
(16, 2, 'Çelikhan'),
(17, 2, 'Gerger'),
(18, 2, 'Gölbaşı'),
(19, 2, 'Kahta'),
(20, 2, 'Merkez'),
(21, 2, 'Samsat'),
(22, 2, 'Sincik'),
(23, 2, 'Tut'),
(24, 3, 'Başmakçı'),
(25, 3, 'Bayat'),
(26, 3, 'Bolvadin'),
(27, 3, 'Çay'),
(28, 3, 'Çobanlar'),
(29, 3, 'Dazkırı'),
(30, 3, 'Dinar'),
(31, 3, 'Emirdağ'),
(32, 3, 'Evciler'),
(33, 3, 'Hocalar'),
(34, 3, 'İhsaniye'),
(35, 3, 'İscehisar'),
(36, 3, 'Kızılören'),
(37, 3, 'Merkez'),
(38, 3, 'Sandıklı'),
(39, 3, 'Sultandağı'),
(40, 3, 'Şuhut'),
(41, 4, 'Diyadin'),
(42, 4, 'Doğubayazıt'),
(43, 4, 'Eleşkirt'),
(44, 4, 'Hamur'),
(45, 4, 'Merkez'),
(46, 4, 'Patnos'),
(47, 4, 'Taşlıçay'),
(48, 4, 'Tutak'),
(49, 5, 'Göynücek'),
(50, 5, 'Gümüşhacıköy'),
(51, 5, 'Hamamözü'),
(52, 5, 'Merkez'),
(53, 5, 'Merzifon'),
(54, 5, 'Suluova'),
(55, 5, 'Taşova'),
(56, 6, 'Akyurt'),
(57, 6, 'Altındağ'),
(58, 6, 'Ayaş'),
(59, 6, 'Bala'),
(60, 6, 'Beypazarı'),
(61, 6, 'Çamlıdere'),
(62, 6, 'Çankaya'),
(63, 6, 'Çubuk'),
(64, 6, 'Elmadağ'),
(65, 6, 'Etimesgut'),
(66, 6, 'Evren'),
(67, 6, 'Gölbaşı'),
(68, 6, 'Güdül'),
(69, 6, 'Haymana'),
(70, 6, 'Kalecik'),
(71, 6, 'Kazan'),
(72, 6, 'Keçiören'),
(73, 6, 'Kızılcahamam'),
(74, 6, 'Mamak'),
(75, 6, 'Nallıhan'),
(76, 6, 'Polatlı'),
(77, 6, 'Pursaklar'),
(78, 6, 'Sincan'),
(79, 6, 'Şereflikoçhisar'),
(80, 6, 'Yenimahalle'),
(81, 7, 'Akseki'),
(82, 7, 'Aksu'),
(83, 7, 'Alanya'),
(84, 7, 'Demre'),
(85, 7, 'Döşemealtı'),
(86, 7, 'Elmalı'),
(87, 7, 'Finike'),
(88, 7, 'Gazipaşa'),
(89, 7, 'Gündoğmuş'),
(90, 7, 'İbradı'),
(91, 7, 'Kaş'),
(92, 7, 'Kemer'),
(93, 7, 'Kepez'),
(94, 7, 'Konyaaltı'),
(95, 7, 'Korkuteli'),
(96, 7, 'Kumluca'),
(97, 7, 'Manavgat'),
(98, 7, 'Muratpaşa'),
(99, 7, 'Serik'),
(100, 8, 'Ardanuç'),
(101, 8, 'Arhavi'),
(102, 8, 'Borçka'),
(103, 8, 'Hopa'),
(104, 8, 'Merkez'),
(105, 8, 'Murgul'),
(106, 8, 'Şavşat'),
(107, 8, 'Yusufeli'),
(108, 9, 'Bozdoğan'),
(109, 9, 'Buharkent'),
(110, 9, 'Çine'),
(111, 9, 'Didim'),
(112, 9, 'Efeler'),
(113, 9, 'Germencik'),
(114, 9, 'İncirliova'),
(115, 9, 'Karacasu'),
(116, 9, 'Karpuzlu'),
(117, 9, 'Koçarlı'),
(118, 9, 'Köşk'),
(119, 9, 'Kuşadası'),
(120, 9, 'Kuyucak'),
(121, 9, 'Nazilli'),
(122, 9, 'Söke'),
(123, 9, 'Sultanhisar'),
(124, 9, 'Yenipazar'),
(125, 10, 'Altıeylül'),
(126, 10, 'Ayvalık'),
(127, 10, 'Balya'),
(128, 10, 'Bandırma'),
(129, 10, 'Bigadiç'),
(130, 10, 'Burhaniye'),
(131, 10, 'Dursunbey'),
(132, 10, 'Edremit'),
(133, 10, 'Erdek'),
(134, 10, 'Gömeç'),
(135, 10, 'Gönen'),
(136, 10, 'Havran'),
(137, 10, 'İvrindi'),
(138, 10, 'Karesi'),
(139, 10, 'Kepsut'),
(140, 10, 'Manyas'),
(141, 10, 'Marmara'),
(142, 10, 'Savaştepe'),
(143, 10, 'Sındırgı'),
(144, 10, 'Susurluk'),
(145, 11, 'Bozüyük'),
(146, 11, 'Gölpazarı'),
(147, 11, 'İnhisar'),
(148, 11, 'Merkez'),
(149, 11, 'Osmaneli'),
(150, 11, 'Pazaryeri'),
(151, 11, 'Söğüt'),
(152, 11, 'Yenipazar'),
(153, 12, 'Adaklı'),
(154, 12, 'Genç'),
(155, 12, 'Karlıova'),
(156, 12, 'Kiğı'),
(157, 12, 'Merkez'),
(158, 12, 'Solhan'),
(159, 12, 'Yayladere'),
(160, 12, 'Yedisu'),
(161, 13, 'Adilcevaz'),
(162, 13, 'Ahlat'),
(163, 13, 'Güroymak'),
(164, 13, 'Hizan'),
(165, 13, 'Merkez'),
(166, 13, 'Mutki'),
(167, 13, 'Tatvan'),
(168, 14, 'Dörtdivan'),
(169, 14, 'Gerede'),
(170, 14, 'Göynük'),
(171, 14, 'Kıbrıscık'),
(172, 14, 'Mengen'),
(173, 14, 'Merkez'),
(174, 14, 'Mudurnu'),
(175, 14, 'Seben'),
(176, 14, 'Yeniçağa'),
(177, 15, 'Ağlasun'),
(178, 15, 'Altınyayla'),
(179, 15, 'Bucak'),
(180, 15, 'Çavdır'),
(181, 15, 'Çeltikçi'),
(182, 15, 'Gölhisar'),
(183, 15, 'Karamanlı'),
(184, 15, 'Kemer'),
(185, 15, 'Merkez'),
(186, 15, 'Tefenni'),
(187, 15, 'Yeşilova'),
(188, 16, 'Büyükorhan'),
(189, 16, 'Gemlik'),
(190, 16, 'Gürsu'),
(191, 16, 'Harmancık'),
(192, 16, 'İnegöl'),
(193, 16, 'İznik'),
(194, 16, 'Karacabey'),
(195, 16, 'Keles'),
(196, 16, 'Kestel'),
(197, 16, 'Mudanya'),
(198, 16, 'Mustafa Kemal Paşa'),
(199, 16, 'Nilüfer'),
(200, 16, 'Orhaneli'),
(201, 16, 'Orhangazi'),
(202, 16, 'Osmangazi'),
(203, 16, 'Yenişehir'),
(204, 16, 'Yıldırım'),
(205, 17, 'Ayvacık'),
(206, 17, 'Bayramiç'),
(207, 17, 'Biga'),
(208, 17, 'Çan'),
(209, 17, 'Eceabat'),
(210, 17, 'Ezine'),
(211, 17, 'Gelibolu'),
(212, 17, 'Gökçeada'),
(213, 17, 'Lapseki'),
(214, 17, 'Merkez'),
(215, 17, 'Yenice'),
(216, 18, 'Atkaracalar'),
(217, 18, 'Bayramören'),
(218, 18, 'Çerkeş'),
(219, 18, 'Eldivan'),
(220, 18, 'Ilgaz'),
(221, 18, 'Kızılırmak'),
(222, 18, 'Korgun'),
(223, 18, 'Kurşunlu'),
(224, 18, 'Merkez'),
(225, 18, 'Orta'),
(226, 18, 'Şabanözü'),
(227, 18, 'Yapraklı'),
(228, 19, 'Alaca'),
(229, 19, 'Bayat'),
(230, 19, 'Boğazkale'),
(231, 19, 'Dodurga'),
(232, 19, 'İskilip'),
(233, 19, 'Kargı'),
(234, 19, 'Laçin'),
(235, 19, 'Mecitözü'),
(236, 19, 'Merkez'),
(237, 19, 'Oğuzlar'),
(238, 19, 'Ortaköy'),
(239, 19, 'Osmancık'),
(240, 19, 'Sungurlu'),
(241, 19, 'Uğurludağ'),
(242, 20, 'Acıpayam'),
(243, 20, 'Babadağ'),
(244, 20, 'Baklan'),
(245, 20, 'Bekilli'),
(246, 20, 'Beyağaç'),
(247, 20, 'Bozkurt'),
(248, 20, 'Buldan'),
(249, 20, 'Çal'),
(250, 20, 'Çameli'),
(251, 20, 'Çardak'),
(252, 20, 'Çivril'),
(253, 20, 'Güney'),
(254, 20, 'Honaz'),
(255, 20, 'Kale'),
(256, 20, 'Merkezefendi'),
(257, 20, 'Pamukkale'),
(258, 20, 'Sarayköy'),
(259, 20, 'Serinhisar'),
(260, 20, 'Tavas'),
(261, 21, 'Bağlar'),
(262, 21, 'Bismil'),
(263, 21, 'Çermik'),
(264, 21, 'Çınar'),
(265, 21, 'Çüngüş'),
(266, 21, 'Dicle'),
(267, 21, 'Eğil'),
(268, 21, 'Ergani'),
(269, 21, 'Hani'),
(270, 21, 'Hazro'),
(271, 21, 'Kayapınar'),
(272, 21, 'Kocaköy'),
(273, 21, 'Kulp'),
(274, 21, 'Lice'),
(275, 21, 'Silvan'),
(276, 21, 'Sur'),
(277, 21, 'Yenişehir'),
(278, 22, 'Enez'),
(279, 22, 'Havsa'),
(280, 22, 'İpsala'),
(281, 22, 'Keşan'),
(282, 22, 'Lalapaşa'),
(283, 22, 'Meriç'),
(284, 22, 'Merkez'),
(285, 22, 'Süloğlu'),
(286, 22, 'Uzunköprü'),
(287, 23, 'Ağın'),
(288, 23, 'Alacakaya'),
(289, 23, 'Arıcak'),
(290, 23, 'Baskil'),
(291, 23, 'Karakoçan'),
(292, 23, 'Keban'),
(293, 23, 'Kovancılar'),
(294, 23, 'Maden'),
(295, 23, 'Merkez'),
(296, 23, 'Palu'),
(297, 23, 'Sivrice'),
(298, 24, 'Çayırlı'),
(299, 24, 'İliç'),
(300, 24, 'Kemah'),
(301, 24, 'Kemaliye'),
(302, 24, 'Merkez'),
(303, 24, 'Otlukbeli'),
(304, 24, 'Refahiye'),
(305, 24, 'Tercan'),
(306, 24, 'Üzümlü'),
(307, 25, 'Aşkale'),
(308, 25, 'Aziziye'),
(309, 25, 'Çat'),
(310, 25, 'Hınıs'),
(311, 25, 'Horasan'),
(312, 25, 'İspir'),
(313, 25, 'Karaçoban'),
(314, 25, 'Karayazı'),
(315, 25, 'Köprüköy'),
(316, 25, 'Narman'),
(317, 25, 'Oltu'),
(318, 25, 'Olur'),
(319, 25, 'Palandöken'),
(320, 25, 'Pasinler'),
(321, 25, 'Pazaryolu'),
(322, 25, 'Şenkaya'),
(323, 25, 'Tekman'),
(324, 25, 'Tortum'),
(325, 25, 'Uzundere'),
(326, 25, 'Yakutiye'),
(327, 26, 'Alpu'),
(328, 26, 'Beylikova'),
(329, 26, 'Çifteler'),
(330, 26, 'Günyüzü'),
(331, 26, 'Han'),
(332, 26, 'İnönü'),
(333, 26, 'Mahmudiye'),
(334, 26, 'Mihalgazi'),
(335, 26, 'Mihalıççık'),
(336, 26, 'Odunpazarı'),
(337, 26, 'Sarıcakaya'),
(338, 26, 'Seyitgazi'),
(339, 26, 'Sivrihisar'),
(340, 26, 'Tepebaşı'),
(341, 27, 'Araban'),
(342, 27, 'İslahiye'),
(343, 27, 'Karkamış'),
(344, 27, 'Nizip'),
(345, 27, 'Nurdağı'),
(346, 27, 'Oğuzeli'),
(347, 27, 'Şahinbey'),
(349, 27, 'Şehitkamil'),
(350, 27, 'Yavuzeli'),
(351, 28, 'Alucra'),
(352, 28, 'Bulancak'),
(353, 28, 'Çamoluk'),
(354, 28, 'Çanakçı'),
(355, 28, 'Dereli'),
(356, 28, 'Doğankent'),
(357, 28, 'Espiye'),
(358, 28, 'Eynesil'),
(359, 28, 'Görele'),
(360, 28, 'Güce'),
(361, 28, 'Keşap'),
(362, 28, 'Merkez'),
(363, 28, 'Piraziz'),
(364, 28, 'Şebinkarahisar'),
(365, 28, 'Tirebolu'),
(366, 28, 'Yağlıdere'),
(367, 29, 'Kelkit'),
(368, 29, 'Köse'),
(369, 29, 'Kürtün'),
(370, 29, 'Merkez'),
(371, 29, 'Şiran'),
(372, 29, 'Torul'),
(373, 30, 'Çukurca'),
(374, 30, 'Merkez'),
(375, 30, 'Şemdinli'),
(376, 30, 'Yüksekova'),
(377, 31, 'Altınözü'),
(378, 31, 'Antakya'),
(379, 31, 'Arsuz'),
(380, 31, 'Belen'),
(381, 31, 'Defne'),
(382, 31, 'Dörtyol'),
(383, 31, 'Erzin'),
(384, 31, 'Hassa'),
(385, 31, 'İskenderun'),
(386, 31, 'Kırıkhan'),
(387, 31, 'Kumlu'),
(388, 31, 'Payas'),
(389, 31, 'Reyhanlı'),
(390, 31, 'Samandağ'),
(391, 31, 'Yayladağı'),
(392, 32, 'Aksu'),
(393, 32, 'Atabey'),
(394, 32, 'Eğirdir'),
(395, 32, 'Gelendost'),
(396, 32, 'Gönen'),
(397, 32, 'Keçiborlu'),
(398, 32, 'Merkez'),
(399, 32, 'Senirkent'),
(400, 32, 'Sütçüler'),
(401, 32, 'Şarkikaraağaç'),
(402, 32, 'Uluborlu'),
(403, 32, 'Yalvaç'),
(404, 32, 'Yenişarbademli'),
(405, 33, 'Akdeniz'),
(406, 33, 'Anamur'),
(407, 33, 'Aydıncık'),
(408, 33, 'Bozyazı'),
(409, 33, 'Çamlıyayla'),
(410, 33, 'Erdemli'),
(411, 33, 'Gülnar'),
(412, 33, 'Mezitli'),
(413, 33, 'Mut'),
(414, 33, 'Silifke'),
(415, 33, 'Tarsus'),
(416, 33, 'Tarsus'),
(417, 33, 'Yenişehir'),
(418, 34, 'Adalar'),
(419, 34, 'Arnavutköy'),
(420, 34, 'Ataşehir'),
(421, 34, 'Avcılar'),
(422, 34, 'Bağcılar'),
(423, 34, 'Bahçelievler'),
(424, 34, 'Bakırköy'),
(425, 34, 'Başakşehir'),
(426, 34, 'Bayrampaşa'),
(427, 34, 'Beşiktaş'),
(428, 34, 'Beykoz'),
(429, 34, 'Beylikdüzü'),
(430, 34, 'Beyoğlu'),
(431, 34, 'Büyükçekmece'),
(432, 34, 'Çatalca'),
(433, 34, 'Çekmeköy'),
(434, 34, 'Esenler'),
(435, 34, 'Esenyurt'),
(436, 34, 'Eyüp'),
(437, 34, 'Fatih'),
(438, 34, 'Gaziosmanpaşa'),
(439, 34, 'Güngören'),
(440, 34, 'Kadıköy'),
(441, 34, 'Kağıthane'),
(442, 34, 'Kartal'),
(443, 34, 'Küçükçekmece'),
(444, 34, 'Maltepe'),
(445, 34, 'Pendik'),
(446, 34, 'Sancaktepe'),
(447, 34, 'Sarıyer'),
(448, 34, 'Silivri'),
(449, 34, 'Sultanbeyli'),
(450, 34, 'Sultangazi'),
(451, 34, 'Şile'),
(452, 34, 'Şişli'),
(453, 34, 'Tuzla'),
(454, 34, 'Ümraniye'),
(455, 34, 'Üsküdar'),
(456, 34, 'Zeytinburnu'),
(457, 35, 'Aliağa'),
(458, 35, 'Balçova'),
(459, 35, 'Bayındır'),
(460, 35, 'Bayraklı'),
(461, 35, 'Bergama'),
(462, 35, 'Beydağ'),
(463, 35, 'Bornova'),
(464, 35, 'Buca'),
(465, 35, 'Çeşme'),
(466, 35, 'Çiğli'),
(467, 35, 'Dikili'),
(468, 35, 'Foça'),
(469, 35, 'Gaziemir'),
(470, 35, 'Güzelbahçe'),
(471, 35, 'Karabağlar'),
(472, 35, 'Karaburun'),
(473, 35, 'Karşıyaka'),
(474, 35, 'Kemalpaşa'),
(475, 35, 'Kınık'),
(476, 35, 'Kiraz'),
(477, 35, 'Konak'),
(478, 35, 'Menderes'),
(479, 35, 'Menemen'),
(480, 35, 'Narlıdere'),
(481, 35, 'Ödemiş'),
(482, 35, 'Seferihisar'),
(483, 35, 'Selçuk'),
(484, 35, 'Tire'),
(485, 35, 'Torbalı'),
(486, 35, 'Urla'),
(487, 36, 'Akyaka'),
(488, 36, 'Arpaçay'),
(489, 36, 'Digor'),
(490, 36, 'Kağızman'),
(491, 36, 'Merkez'),
(492, 36, 'Sarıkamış'),
(493, 36, 'Selim'),
(494, 36, 'Susuz'),
(495, 37, 'Abana'),
(496, 37, 'Ağlı'),
(497, 37, 'Araç'),
(498, 37, 'Azdavay'),
(499, 37, 'Bozkurt'),
(500, 37, 'Cide'),
(501, 37, 'Çatalzeytin'),
(502, 37, 'Daday'),
(503, 37, 'Devrekani'),
(504, 37, 'Doğanyurt'),
(505, 37, 'Hanönü'),
(506, 37, 'İhsangazi'),
(507, 37, 'İnebolu'),
(508, 37, 'Küre'),
(509, 37, 'Merkez'),
(510, 37, 'Pınarbaşı'),
(511, 37, 'Seydiler'),
(512, 37, 'Şenpazar'),
(513, 37, 'Taşköprü'),
(514, 37, 'Tosya'),
(515, 38, 'Akkışla'),
(516, 38, 'Bünyan'),
(517, 38, 'Develi'),
(518, 38, 'Felahiye'),
(519, 38, 'Hacılar'),
(520, 38, 'İncesu'),
(521, 38, 'Kocasinan'),
(522, 38, 'Melikgazi'),
(523, 38, 'Özvatan'),
(524, 38, 'Pınarbaşı'),
(525, 38, 'Sarıoğlan'),
(526, 38, 'Sarız'),
(527, 38, 'Talas'),
(528, 38, 'Tomarza'),
(529, 38, 'Yahyalı'),
(530, 38, 'Yeşilhisar'),
(531, 39, 'Babaeski'),
(532, 39, 'Demirköy'),
(533, 39, 'Kofçaz'),
(534, 39, 'Lüleburgaz'),
(535, 39, 'Merkez'),
(536, 39, 'Pehlivanköy'),
(537, 39, 'Pınarhisar'),
(538, 39, 'Vize'),
(539, 40, 'Akçakent'),
(540, 40, 'Akpınar'),
(541, 40, 'Boztepe'),
(542, 40, 'Çiçekdağı'),
(543, 40, 'Kaman'),
(544, 40, 'Merkez'),
(545, 40, 'Mucur'),
(546, 41, 'Başiskele'),
(547, 41, 'Çayırova'),
(548, 41, 'Darıca'),
(549, 41, 'Derince'),
(550, 41, 'Dilovası'),
(551, 41, 'Gebze'),
(552, 41, 'Gölcük'),
(553, 41, 'İzmit'),
(554, 41, 'Kandıra'),
(555, 41, 'Karamürsel'),
(556, 41, 'Kartepe'),
(557, 41, 'Körfez'),
(558, 42, 'Ahırlı'),
(559, 42, 'Akören'),
(560, 42, 'Akşehir'),
(561, 42, 'Altınekin'),
(562, 42, 'Beyşehir'),
(563, 42, 'Bozkır'),
(564, 42, 'Cihanbeyli'),
(565, 42, 'Çeltik'),
(566, 42, 'Çumra'),
(567, 42, 'Derbent'),
(568, 42, 'Derebucak'),
(569, 42, 'Doğanhisar'),
(570, 42, 'Emirgazi'),
(571, 42, 'Ereğli'),
(572, 42, 'Güneysınır'),
(573, 42, 'Hadim'),
(574, 42, 'Halkapınar'),
(575, 42, 'Hüyük'),
(576, 42, 'Ilgın'),
(577, 42, 'Kadınhanı'),
(578, 42, 'Karapınar'),
(579, 42, 'Karatay'),
(580, 42, 'Kulu'),
(581, 42, 'Meram'),
(582, 42, 'Sarayönü'),
(583, 42, 'Selçuklu'),
(584, 42, 'Seydişehir'),
(585, 42, 'Taşkent'),
(586, 42, 'Tuzlukçu'),
(587, 42, 'Yalıhüyük'),
(588, 42, 'Yunak'),
(589, 43, 'Altıntaş'),
(590, 43, 'Aslanapa'),
(591, 43, 'Çavdarhisar'),
(592, 43, 'Domaniç'),
(593, 43, 'Dumlupınar'),
(594, 43, 'Emet'),
(595, 43, 'Gediz'),
(596, 43, 'Hisarcık'),
(597, 43, 'Merkez'),
(598, 43, 'Pazarlar'),
(599, 43, 'Simav'),
(600, 43, 'Şaphane'),
(601, 43, 'Tavşanlı'),
(602, 44, 'Akçadağ'),
(603, 44, 'Arapgir'),
(604, 44, 'Arguvan'),
(605, 44, 'Battalgazi'),
(606, 44, 'Darende'),
(607, 44, 'Doğanşehir'),
(608, 44, 'Doğanyol'),
(609, 44, 'Hekimhan'),
(610, 44, 'Kale'),
(611, 44, 'Kuluncak'),
(612, 44, 'Pütürge'),
(613, 44, 'Yazıhan'),
(614, 44, 'Yeşilyurt'),
(615, 45, 'Ahmetli'),
(616, 45, 'Akhisar'),
(617, 45, 'Alaşehir'),
(618, 45, 'Demirci'),
(619, 45, 'Gölmarmara'),
(620, 45, 'Gördes'),
(621, 45, 'Kırkağaç'),
(622, 45, 'Köprübaşı'),
(623, 45, 'Kula'),
(624, 45, 'Salihli'),
(625, 45, 'Sarıgöl'),
(626, 45, 'Saruhanlı'),
(627, 45, 'Selendi'),
(628, 45, 'Soma'),
(629, 45, 'Şehzadeler'),
(630, 45, 'Turgutlu'),
(631, 45, 'Yunusemre'),
(632, 46, 'Afşin'),
(633, 46, 'Andırın'),
(634, 46, 'Çağlayancerit'),
(635, 46, 'Dulkadiroğlu'),
(636, 46, 'Ekinözü'),
(637, 46, 'Elbistan'),
(638, 46, 'Göksun'),
(639, 46, 'Nurhak'),
(640, 46, 'Onikişubat'),
(641, 46, 'Pazarcık'),
(642, 46, 'Türkoğlu'),
(643, 47, 'Artuklu'),
(644, 47, 'Dargeçit'),
(645, 47, 'Derik'),
(646, 47, 'Kızıltepe'),
(647, 47, 'Mazıdağı'),
(648, 47, 'Midyat'),
(649, 47, 'Nusaybin'),
(650, 47, 'Ömerli'),
(651, 47, 'Savur'),
(652, 47, 'Yeşilli'),
(653, 48, 'Bodrum'),
(654, 48, 'Dalaman'),
(655, 48, 'Datça'),
(656, 48, 'Fethiye'),
(657, 48, 'Kavaklıdere'),
(658, 48, 'Köyceğiz'),
(659, 48, 'Marmaris'),
(660, 48, 'Menteşe'),
(661, 48, 'Milas'),
(662, 48, 'Ortaca'),
(663, 48, 'Seydikemer'),
(664, 48, 'Ula'),
(665, 48, 'Yatağan'),
(666, 49, 'Bulanık'),
(667, 49, 'Hasköy'),
(668, 49, 'Korkut'),
(669, 49, 'Malazgirt'),
(670, 49, 'Merkez'),
(671, 49, 'Varto'),
(672, 50, 'Acıgöl'),
(673, 50, 'Avanos'),
(674, 50, 'Derinkuyu'),
(675, 50, 'Gülşehir'),
(676, 50, 'Hacıbektaş'),
(677, 50, 'Kozaklı'),
(678, 50, 'Merkez'),
(679, 50, 'Ürgüp'),
(680, 51, 'Altunhisar'),
(681, 51, 'Bor'),
(682, 51, 'Çamardı'),
(683, 51, 'Çiftlik'),
(684, 51, 'Merkez'),
(685, 51, 'Ulukışla'),
(686, 52, 'Akkuş'),
(687, 52, 'Altınordu'),
(688, 52, 'Aybastı'),
(689, 52, 'Çamaş'),
(690, 52, 'Çatalpınar'),
(691, 52, 'Çaybaşı'),
(692, 52, 'Fatsa'),
(693, 52, 'Gölköy'),
(694, 52, 'Gülyalı'),
(695, 52, 'Gürgentepe'),
(696, 52, 'İkizce'),
(697, 52, 'Kabadüz'),
(698, 52, 'Kabataş'),
(699, 52, 'Korgan'),
(700, 52, 'Kumru'),
(701, 52, 'Mesudiye'),
(702, 52, 'Perşembe'),
(703, 52, 'Ulubey'),
(704, 52, 'Ünye'),
(705, 53, 'Ardeşen'),
(706, 53, 'Çamlıhemşin'),
(707, 53, 'Çayeli'),
(708, 53, 'Derepazarı'),
(709, 53, 'Fındıklı'),
(710, 53, 'Güneysu'),
(711, 53, 'Hemşin'),
(712, 53, 'İkizdere'),
(713, 53, 'İyidere'),
(714, 53, 'Kalkandere'),
(715, 53, 'Merkez'),
(716, 53, 'Pazar'),
(717, 54, 'Adapazarı'),
(718, 54, 'Akyazı'),
(719, 54, 'Arifiye'),
(720, 54, 'Erenler'),
(721, 54, 'Ferizli'),
(722, 54, 'Geyve'),
(723, 54, 'Hendek'),
(724, 54, 'Karapürçek'),
(725, 54, 'Karasu'),
(726, 54, 'Kaynarca'),
(727, 54, 'Kocaali'),
(728, 54, 'Pamukova'),
(729, 54, 'Sapanca'),
(730, 54, 'Serdivan'),
(731, 54, 'Söğütlü'),
(732, 54, 'Taraklı'),
(733, 55, '19 Mayıs'),
(734, 55, 'Alaçam'),
(735, 55, 'Asarcık'),
(736, 55, 'Atakum'),
(737, 55, 'Ayvacık'),
(738, 55, 'Bafra'),
(739, 55, 'Canik'),
(740, 55, 'Çarşamba'),
(741, 55, 'Havza'),
(742, 55, 'İlkadım'),
(743, 55, 'Kavak'),
(744, 55, 'Ladik'),
(745, 55, 'Salıpazarı'),
(746, 55, 'Tekkeköy'),
(747, 55, 'Terme'),
(748, 55, 'Vezirköprü'),
(749, 55, 'Yakakent'),
(750, 56, 'Baykan'),
(751, 56, 'Eruh'),
(752, 56, 'Kurtalan'),
(753, 56, 'Merkez'),
(754, 56, 'Pervari'),
(755, 56, 'Şirvan'),
(756, 56, 'Tillo'),
(757, 57, 'Ayancık'),
(758, 57, 'Boyabat'),
(759, 57, 'Dikmen'),
(760, 57, 'Durağan'),
(761, 57, 'Erfelek'),
(762, 57, 'Gerze'),
(763, 57, 'Merkez'),
(764, 57, 'Saraydüzü'),
(765, 57, 'Türkeli'),
(766, 58, 'Akıncılar'),
(767, 58, 'Altınyayla'),
(768, 58, 'Divriği'),
(769, 58, 'Doğanşar'),
(770, 58, 'Gemerek'),
(771, 58, 'Gölova'),
(772, 58, 'Gürün'),
(773, 58, 'Hafik'),
(774, 58, 'İmranlı'),
(775, 58, 'Kangal'),
(776, 58, 'Koyulhisar'),
(777, 58, 'Merkez'),
(778, 58, 'Suşehri'),
(779, 58, 'Şarkışla'),
(780, 58, 'Ulaş'),
(781, 58, 'Yıldızeli'),
(782, 58, 'Zara'),
(783, 59, 'Çerkezköy'),
(784, 59, 'Çorlu'),
(785, 59, 'Ergene'),
(786, 59, 'Hayrabolu'),
(787, 59, 'Malkara'),
(788, 59, 'Marmaraereğlisi'),
(789, 59, 'Muratlı'),
(790, 59, 'Saray'),
(791, 59, 'Süleymanpaşa'),
(792, 59, 'Şarköy'),
(793, 60, 'Almus'),
(794, 60, 'Artova'),
(795, 60, 'Başçiftlik'),
(796, 60, 'Erbaa'),
(797, 60, 'Merkez'),
(798, 60, 'Niksar'),
(799, 60, 'Pazar'),
(800, 60, 'Reşadiye'),
(801, 60, 'Sulusaray'),
(802, 60, 'Turhal'),
(803, 60, 'Yeşilyurt'),
(804, 60, 'Zile'),
(805, 61, 'Akçaabat'),
(806, 61, 'Araklı'),
(807, 61, 'Arsin'),
(808, 61, 'Beşikdüzü'),
(809, 61, 'Çarşıbaşı'),
(810, 61, 'Çaykara'),
(811, 61, 'Dernekpazarı'),
(812, 61, 'Düzköy'),
(813, 61, 'Hayrat'),
(814, 61, 'Köprübaşı'),
(815, 61, 'Maçka'),
(816, 61, 'Of'),
(817, 61, 'Ortahisar'),
(818, 61, 'Sürmene'),
(819, 61, 'Şalpazarı'),
(820, 61, 'Tonya'),
(821, 61, 'Vakfıkebir'),
(822, 61, 'Yomra'),
(823, 62, 'Çemişgezek'),
(824, 62, 'Hozat'),
(825, 62, 'Mazgirt'),
(826, 62, 'Merkez'),
(827, 62, 'Nazımiye'),
(828, 62, 'Ovacık'),
(829, 62, 'Pertek'),
(830, 62, 'Pülümür'),
(831, 63, 'Akçakale'),
(832, 63, 'Birecik'),
(833, 63, 'Bozova'),
(834, 63, 'Ceylanpınar'),
(835, 63, 'Eyyübiye'),
(836, 63, 'Halfeti'),
(837, 63, 'Haliliye'),
(838, 63, 'Harran'),
(839, 63, 'Hilvan'),
(840, 63, 'Karaköprü'),
(841, 63, 'Siverek'),
(842, 63, 'Suruç'),
(843, 63, 'Viranşehir'),
(844, 64, 'Banaz'),
(845, 64, 'Eşme'),
(846, 64, 'Karahallı'),
(847, 64, 'Merkez'),
(848, 64, 'Sivaslı'),
(849, 64, 'Ulubey'),
(850, 65, 'Bahçesaray'),
(851, 65, 'Başkale'),
(852, 65, 'Çaldıran'),
(853, 65, 'Çatak'),
(854, 65, 'Edremit'),
(855, 65, 'Erciş'),
(856, 65, 'Gevaş'),
(857, 65, 'Gürpınar'),
(858, 65, 'İpekyolu'),
(859, 65, 'Muradiye'),
(860, 65, 'Özalp'),
(861, 65, 'Saray'),
(862, 65, 'Tuşba'),
(863, 66, 'Akdağmadeni'),
(864, 66, 'Aydıncık'),
(865, 66, 'Boğazlıyan'),
(866, 66, 'Çandır'),
(867, 66, 'Çayıralan'),
(868, 66, 'Çekerek'),
(869, 66, 'Kadışehri'),
(870, 66, 'Merkez'),
(871, 66, 'Saraykent'),
(872, 66, 'Sarıkaya'),
(873, 66, 'Sorgun'),
(874, 66, 'Şefaatli'),
(875, 66, 'Yenifakılı'),
(876, 66, 'Yerköy'),
(877, 67, 'Alaplı'),
(878, 67, 'Çaycuma'),
(879, 67, 'Devrek'),
(880, 67, 'Ereğli'),
(881, 67, 'Gökçebey'),
(882, 67, 'Merkez'),
(883, 68, 'Ağaçören'),
(884, 68, 'Eskil'),
(885, 68, 'Gülağaç'),
(886, 68, 'Güzelyurt'),
(887, 68, 'Merkez'),
(888, 68, 'Ortaköy'),
(889, 68, 'Sarıyahşi'),
(890, 69, 'Aydıntepe'),
(891, 69, 'Demirözü'),
(892, 69, 'Merkez'),
(893, 70, 'Ayrancı'),
(894, 70, 'Başyayla'),
(895, 70, 'Ermenek'),
(896, 70, 'Kazımkarabekir'),
(897, 70, 'Merkez'),
(898, 70, 'Sarıveliler'),
(899, 71, 'Bahşili'),
(900, 71, 'Balışeyh'),
(901, 71, 'Çelebi'),
(902, 71, 'Delice'),
(903, 71, 'Karakeçili'),
(904, 71, 'Keskin'),
(905, 71, 'Merkez'),
(906, 71, 'Sulakyurt'),
(907, 71, 'Yahşihan'),
(908, 72, 'Beşiri'),
(909, 72, 'Gercüş'),
(910, 72, 'Hasankeyf'),
(911, 72, 'Kozluk'),
(912, 72, 'Merkez'),
(913, 72, 'Sason'),
(914, 73, 'Beytüşşebap'),
(915, 73, 'Cizre'),
(916, 73, 'Güçlükonak'),
(917, 73, 'İdil'),
(918, 73, 'Merkez'),
(919, 73, 'Silopi'),
(920, 73, 'Uludere'),
(921, 74, 'Amasra'),
(922, 74, 'Kurucaşile'),
(923, 74, 'Merkez'),
(924, 74, 'Ulus'),
(925, 75, 'Çıldır'),
(926, 75, 'Damal'),
(927, 75, 'Göle'),
(928, 75, 'Hanak'),
(929, 75, 'Merkez'),
(930, 75, 'Posof'),
(931, 76, 'Aralık'),
(932, 76, 'Karakoyunlu'),
(933, 76, 'Merkez'),
(934, 76, 'Tuzluca'),
(935, 77, 'Altınova'),
(936, 77, 'Armutlu'),
(937, 77, 'Çınarcık'),
(938, 77, 'Çiftlikköy'),
(939, 77, 'Merkez'),
(940, 77, 'Termal'),
(941, 78, 'Eflani'),
(942, 78, 'Eskipazar'),
(943, 78, 'Merkez'),
(944, 78, 'Ovacık'),
(945, 78, 'Safranbolu'),
(946, 78, 'Yenice'),
(947, 79, 'Elbeyli'),
(948, 79, 'Merkez'),
(949, 79, 'Musabeyli'),
(950, 79, 'Polateli'),
(951, 80, 'Bahçe'),
(952, 80, 'Düziçi'),
(953, 80, 'Hasanbeyli'),
(954, 80, 'Kadirli'),
(955, 80, 'Merkez'),
(956, 80, 'Sumbas'),
(957, 80, 'Toprakkale'),
(958, 81, 'Akçakoca'),
(959, 81, 'Cumayeri'),
(960, 81, 'Çilimli'),
(961, 81, 'Gölyaka'),
(962, 81, 'Gümüşova'),
(963, 81, 'Kaynaşlı'),
(964, 81, 'Merkez'),
(965, 81, 'Yığılca');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `fakebasket`
--

CREATE TABLE `fakebasket` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productId` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productNumber` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `favorites`
--

CREATE TABLE `favorites` (
  `favoriteId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `infopayments`
--

CREATE TABLE `infopayments` (
  `userId` int(11) NOT NULL,
  `cardNo` tinyint(4) NOT NULL,
  `cardYear` tinyint(4) NOT NULL,
  `cardMoon` tinyint(4) NOT NULL,
  `cardCvv` tinyint(4) NOT NULL,
  `threeDSecure` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `sender` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `receiver` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `text` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `view` varchar(5) COLLATE utf8_turkish_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `orderNo` int(11) DEFAULT NULL,
  `orderStatus` tinyint(4) DEFAULT NULL,
  `orderDesc` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `productSeller` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productNumber` tinyint(4) DEFAULT NULL,
  `orderPrice` float DEFAULT NULL,
  `kdv` varchar(155) COLLATE utf8_turkish_ci DEFAULT NULL,
  `comission` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `sheepingFee` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `cargoName` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `cargoTracking` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `cargoDate` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`id`, `userId`, `orderNo`, `orderStatus`, `orderDesc`, `productId`, `productSeller`, `productNumber`, `orderPrice`, `kdv`, `comission`, `sheepingFee`, `cargoName`, `cargoTracking`, `cargoDate`, `updated_at`, `created_at`) VALUES
(18, 1, 25, 4, 'Şiparişiniz onaylanmıştır. En kısa sürede kargoya teslim edilecektir. Bizi tercih ettiğiniz için teşekkür eder, iyi alışverişler dileriz.', 15, '1', 4, 2, '0', '0', '5', 'Aras Kargo', '15115421515', '2020-01-28 19:50:18', '2020-01-28 16:50:18', '2020-01-28 16:49:27'),
(19, 1, 26, 1, NULL, 20, '1', 1, 2, '0', NULL, '2', NULL, NULL, NULL, '2020-09-16 08:00:48', '2020-09-16 08:00:48');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ordersdetail`
--

CREATE TABLE `ordersdetail` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `adress` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `cartNo` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `cartName` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `moon` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `cvv` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ordersdetail`
--

INSERT INTO `ordersdetail` (`id`, `userId`, `name`, `surname`, `country`, `location`, `adress`, `tel`, `cartNo`, `cartName`, `moon`, `year`, `cvv`, `created_at`, `updated_at`) VALUES
(25, '1', 'Ulaş2', 'DİŞBUDAK', '223', 'Gaziantep/Karkamış', 'asddsa dsadsa', '21321231231', '2312-1231-2312-3123', 'dwadadw awddwa', '02', '2023', '231', '2020-01-28 16:49:27', '2020-01-28 16:49:27'),
(26, '1', 'Ulaş', 'DİŞBUDAK', '223', 'Gaziantep/Şahinbey', 'asddassadadsasd', '2141212421', '2132-1321-1223-2132', '21fwqfwqwqwqf ', '05', '2025', '2322', '2020-09-16 08:00:47', '2020-09-16 08:00:47');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pictures`
--

CREATE TABLE `pictures` (
  `pictureId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `pictureType` varchar(4) COLLATE utf8_turkish_ci DEFAULT NULL,
  `pictureUrl` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `pictures`
--

INSERT INTO `pictures` (`pictureId`, `productId`, `pictureType`, `pictureUrl`, `updated_at`, `created_at`) VALUES
(49, 16, '1', '20200916102518.jpg', '2020-09-16 07:25:18', '2020-09-16 07:25:18'),
(50, 16, '2', '20200916103013.jpg', '2020-09-16 07:30:13', '2020-09-16 07:30:13'),
(51, 17, '1', '20200916103129.jpg', '2020-09-16 07:31:29', '2020-09-16 07:31:29'),
(52, 18, '1', '20200916103339.jpg', '2020-09-16 07:33:39', '2020-09-16 07:33:39'),
(53, 19, '1', '20200916103520.jpg', '2020-09-16 07:35:20', '2020-09-16 07:35:20'),
(54, 20, '1', '20200916103628.jpg', '2020-09-16 07:36:28', '2020-09-16 07:36:28');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pricing`
--

CREATE TABLE `pricing` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `value` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `productpoints`
--

CREATE TABLE `productpoints` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `point` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `productSeller` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productName` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productCatalog` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productCategory` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productUnit` varchar(10) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productNumber` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productPrice` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productExplanation` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `discountType` varchar(10) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productDiscount` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `shippingFee` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `productStatus` varchar(10) COLLATE utf8_turkish_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`productId`, `productSeller`, `productName`, `productCatalog`, `productCategory`, `productUnit`, `productNumber`, `productPrice`, `productExplanation`, `discountType`, `productDiscount`, `shippingFee`, `productStatus`, `updated_at`, `created_at`) VALUES
(15, '1', 'Yeni Ürün', NULL, '26', '0', '228', '2.00', '', '0', '', '5', '1', '2020-09-16 07:23:36', '2019-12-29 17:41:37'),
(16, '1', 'Tarhana', NULL, '26', '0', '1000', '12.00', 'Kışlık Tarhana', '1', '5', '2', '0', '2020-09-16 07:29:53', '2020-09-16 07:25:16'),
(17, '1', 'Mercimek', NULL, '27', '0', '12412421', '24.00', 'asffsafsafasf asfasfsasa', '0', '', '22', '0', '2020-09-16 07:31:27', '2020-09-16 07:31:27'),
(18, '1', 'Kuru Fasulye', NULL, '28', '0', '21421', '22.00', 'ddd ddssdsddddddddddddddd assaddsadsaads asdsadsasadsadsdasasad', '0', '', '22', '0', '2020-09-16 07:33:37', '2020-09-16 07:33:37'),
(19, '1', 'Domates Konservesi', NULL, '30', '1', '1223', '11.00', 'dadsdsadsa asdsasadsad aadsdsaadsdsa\r\nasdasdasas', '0', '', '32', '0', '2020-09-16 07:35:18', '2020-09-16 07:35:18'),
(20, '1', 'Taze Fasulye Konservesi', NULL, '31', '1', '23', '2.00', 'saffsa safsa', '0', '', '2', '0', '2020-09-16 07:36:26', '2020-09-16 07:36:26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sellers`
--

CREATE TABLE `sellers` (
  `sellerId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `sellerName` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `accountNumber` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `accountName` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `taxOffice` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `taxNumber` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sellers`
--

INSERT INTO `sellers` (`sellerId`, `userId`, `sellerName`, `accountNumber`, `accountName`, `taxOffice`, `taxNumber`, `updated_at`, `created_at`) VALUES
(1, 1, 'Yöresel Gaziantep', NULL, NULL, '', '', '2019-11-12 14:23:39', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sellerswait`
--

CREATE TABLE `sellerswait` (
  `id` int(11) NOT NULL,
  `userId` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `sellerName` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `accountNumber` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `accountName` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `taxOffice` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `taxNumber` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `type` varchar(5) COLLATE utf8_turkish_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sellerswait`
--

INSERT INTO `sellerswait` (`id`, `userId`, `sellerName`, `accountNumber`, `accountName`, `taxOffice`, `taxNumber`, `status`, `type`, `updated_at`, `created_at`) VALUES
(1, '1', 'Yöresel Gaziantep', '1231-2312-2313-1312', 'Ulaş DİŞBUDAK', 'dw1212', '21d213123', '1', '1', '2019-11-12 15:43:05', '2019-11-12 14:58:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sitecontent`
--

CREATE TABLE `sitecontent` (
  `id` smallint(6) NOT NULL,
  `content` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sitesettings`
--

CREATE TABLE `sitesettings` (
  `settingId` tinyint(1) NOT NULL,
  `settingLogo` varchar(25) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingTitle` varchar(75) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingDescription` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingAuthor` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingTel` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingGsm` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingFaks` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingMail` varchar(75) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingCity` varchar(2) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingDistrict` varchar(3) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingAddress` varchar(200) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingMaps` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingAnalystic` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingZoopim` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingFacebook` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingTwitter` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingGoogle` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingYoutube` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingSmtphost` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingSmtppassword` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingSmtpport` varchar(150) COLLATE utf8_turkish_ci DEFAULT NULL,
  `settingRepair` tinyint(1) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sitesettings`
--

INSERT INTO `sitesettings` (`settingId`, `settingLogo`, `settingTitle`, `settingDescription`, `settingAuthor`, `settingTel`, `settingGsm`, `settingFaks`, `settingMail`, `settingCity`, `settingDistrict`, `settingAddress`, `settingMaps`, `settingAnalystic`, `settingZoopim`, `settingFacebook`, `settingTwitter`, `settingGoogle`, `settingYoutube`, `settingSmtphost`, `settingSmtppassword`, `settingSmtpport`, `settingRepair`, `updated_at`, `created_at`) VALUES
(1, 'logo.png', 'Gaziantep Yöresel Ürünler', 'Gazaiantep yöresel ürün satışı', 'GYÖ', '0 (555) 555-5555', '0 (555) 555-5555', '0 (555) 555-5555', 'info@gyo.gmail.com', '27', '347', '500 evler mahallesi Şahinbey/Gaziantepp', NULL, NULL, NULL, 'gyo/facebook', 'gyo/twitter', 'gyo/google', 'gyo/youtube', NULL, NULL, NULL, NULL, '2019-12-15 17:18:35', '2019-10-16 15:24:26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `slogan` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `description` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `url` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `slide`
--

INSERT INTO `slide` (`id`, `title`, `slogan`, `description`, `picture`, `url`, `created_at`, `updated_at`) VALUES
(36, 'E-Ticaret', 'Web Sitesi', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '20200916102125.png', '', '2020-09-16 07:16:05', '2020-09-16 07:21:25');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `authority` tinyint(4) NOT NULL,
  `token` varchar(40) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_turkish_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `surname` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `tcNo` varchar(11) COLLATE utf8_turkish_ci DEFAULT NULL,
  `tel` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `gsm` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `faks` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `city` varchar(3) COLLATE utf8_turkish_ci DEFAULT NULL,
  `district` varchar(3) COLLATE utf8_turkish_ci DEFAULT NULL,
  `residing` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `gender` varchar(2) COLLATE utf8_turkish_ci DEFAULT NULL,
  `birthDate` varchar(15) COLLATE utf8_turkish_ci DEFAULT NULL,
  `campaignInfo` varchar(3) COLLATE utf8_turkish_ci DEFAULT NULL,
  `purse` varchar(100) COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `blocked` varchar(4) COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `authority`, `token`, `email`, `password`, `name`, `surname`, `tcNo`, `tel`, `gsm`, `faks`, `picture`, `country`, `city`, `district`, `residing`, `gender`, `birthDate`, `campaignInfo`, `purse`, `blocked`, `updated_at`, `created_at`) VALUES
(1, 1, '0b82596f3244160ac8ad4cf0f31d3d4a', 'ulas.disbudak2@gmail.com', '$2y$10$8YXOJE0mT8OlYCvbFUb2EO8DH5LA6mZ3J8SVrLN8yzFmJIpdmzItO', 'Ulaş', 'DİŞBUDAK', '17258544118', '0 (223) 123-1313', '0 (232) 232-3324', '0 (232) 323-232_', NULL, NULL, '27', '350', NULL, '1', '', NULL, '1000.00', '0', '2019-12-21 13:00:54', '2019-10-09 16:41:22');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `baskets`
--
ALTER TABLE `baskets`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Tablo için indeksler `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`cityId`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`);

--
-- Tablo için indeksler `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`districtId`);

--
-- Tablo için indeksler `fakebasket`
--
ALTER TABLE `fakebasket`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ordersdetail`
--
ALTER TABLE `ordersdetail`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`pictureId`);

--
-- Tablo için indeksler `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `productpoints`
--
ALTER TABLE `productpoints`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Tablo için indeksler `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`sellerId`);

--
-- Tablo için indeksler `sellerswait`
--
ALTER TABLE `sellerswait`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sitecontent`
--
ALTER TABLE `sitecontent`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sitesettings`
--
ALTER TABLE `sitesettings`
  ADD PRIMARY KEY (`settingId`);

--
-- Tablo için indeksler `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `baskets`
--
ALTER TABLE `baskets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Tablo için AUTO_INCREMENT değeri `city`
--
ALTER TABLE `city`
  MODIFY `cityId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- Tablo için AUTO_INCREMENT değeri `district`
--
ALTER TABLE `district`
  MODIFY `districtId` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=966;

--
-- Tablo için AUTO_INCREMENT değeri `fakebasket`
--
ALTER TABLE `fakebasket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- Tablo için AUTO_INCREMENT değeri `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `ordersdetail`
--
ALTER TABLE `ordersdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `pictures`
--
ALTER TABLE `pictures`
  MODIFY `pictureId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Tablo için AUTO_INCREMENT değeri `pricing`
--
ALTER TABLE `pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `productpoints`
--
ALTER TABLE `productpoints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `sellers`
--
ALTER TABLE `sellers`
  MODIFY `sellerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `sellerswait`
--
ALTER TABLE `sellerswait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `sitecontent`
--
ALTER TABLE `sitecontent`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `sitesettings`
--
ALTER TABLE `sitesettings`
  MODIFY `settingId` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
