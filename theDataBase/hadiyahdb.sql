-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2019 at 03:10 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hadiyahdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `f_name`, `s_name`, `l_name`, `email`, `password`) VALUES
(11000, 'هند ', 'محمد ', 'الزهراني', 'hind@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi'),
(11001, 'بسمة ', 'علي ', 'باشراحيل ', 'bsma@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi'),
(11002, 'اماني  ', 'محمد', 'بنتن', 'amani@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi'),
(11003, 'منال ', 'مصلح ', 'اللحياني', 'manal@gmai.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi');

-- --------------------------------------------------------

--
-- Table structure for table `adoption__of__the__committees`
--

CREATE TABLE `adoption__of__the__committees` (
  `form_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `atonement__and__zakaat__forms`
--

CREATE TABLE `atonement__and__zakaat__forms` (
  `form_id` int(10) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observe_id` int(10) UNSIGNED DEFAULT NULL,
  `count` int(11) NOT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `atonement__and__zakaat__forms`
--

INSERT INTO `atonement__and__zakaat__forms` (`form_id`, `date`, `day`, `observe_id`, `count`, `service_id`) VALUES
(4, '2019-07-04', 'الخميس', 13004, 2, 13),
(5, '2019-08-01', 'الخميس', 13004, 5, 13),
(6, '2019-04-01', 'الإثنين', 13004, 10, 13);

-- --------------------------------------------------------

--
-- Table structure for table `blood__of__algebrat__forms`
--

CREATE TABLE `blood__of__algebrat__forms` (
  `form_id` int(10) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observe_id` int(10) UNSIGNED DEFAULT NULL,
  `count_of_agencies` int(11) NOT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood__of__algebrat__form__institutions`
--

CREATE TABLE `blood__of__algebrat__form__institutions` (
  `institution_id` int(10) UNSIGNED DEFAULT NULL,
  `form_id` int(10) UNSIGNED DEFAULT NULL,
  `number_of_carcasses` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_of_delegate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `body__food__forms`
--

CREATE TABLE `body__food__forms` (
  `date` date NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evaluation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nu_service_providers` int(10) UNSIGNED NOT NULL,
  `number_of_beneficiaries` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `observe_id` int(10) UNSIGNED DEFAULT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `location_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `body__food__forms`
--

INSERT INTO `body__food__forms` (`date`, `day`, `evaluation`, `observation`, `nu_service_providers`, `number_of_beneficiaries`, `form_id`, `observe_id`, `service_id`, `location_id`) VALUES
('2019-08-01', 'الخميس', 'ممتاز', 'عمل رائع', 10, 150, 3, 13006, 4, 74),
('2019-05-01', 'الأربعاء', 'ممتاز', 'عمل رائع', 12, 200, 4, 13006, 4, 93);

-- --------------------------------------------------------

--
-- Table structure for table `body__food__forms__materials`
--

CREATE TABLE `body__food__forms__materials` (
  `count` int(11) NOT NULL,
  `surplus` int(11) NOT NULL,
  `needs_of_tomorro` int(11) NOT NULL,
  `form_id` int(10) UNSIGNED DEFAULT NULL,
  `material_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `body__food__forms__materials`
--

INSERT INTO `body__food__forms__materials` (`count`, `surplus`, `needs_of_tomorro`, `form_id`, `material_id`) VALUES
(10, 5, 5, NULL, NULL),
(15, 2, 16, NULL, NULL),
(11, 0, 12, 3, 22),
(100, 10, 95, 3, 12),
(111, 10, 120, 4, 23),
(105, 0, 130, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `care__forms`
--

CREATE TABLE `care__forms` (
  `date` date NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evaluation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nu_service_providers` int(10) UNSIGNED NOT NULL,
  `number_of_beneficiaries` int(10) UNSIGNED NOT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `observe_id` int(10) UNSIGNED DEFAULT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `location_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `care__forms`
--

INSERT INTO `care__forms` (`date`, `day`, `evaluation`, `nu_service_providers`, `number_of_beneficiaries`, `observation`, `form_id`, `observe_id`, `service_id`, `location_id`) VALUES
('2019-07-01', 'الإثنين', 'ممتاز', 11, 110, 'عمل رائع', 1, 13001, 26, 74),
('2019-06-01', 'السبت', 'ممتاز', 5, 50, 'عمل رائع', 2, 13001, 26, 89);

-- --------------------------------------------------------

--
-- Table structure for table `care__form__materials`
--

CREATE TABLE `care__form__materials` (
  `count` int(11) NOT NULL,
  `form_id` int(10) UNSIGNED DEFAULT NULL,
  `material_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `care__form__materials`
--

INSERT INTO `care__form__materials` (`count`, `form_id`, `material_id`) VALUES
(100, 1, 59),
(101, 2, 59);

-- --------------------------------------------------------

--
-- Table structure for table `delegations`
--

CREATE TABLE `delegations` (
  `id` int(10) UNSIGNED NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_in_mecca` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_in_madinah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arrival_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_arrival` date NOT NULL,
  `date_of_Visit` date NOT NULL,
  `visit_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_departure` date NOT NULL,
  `departure_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coordinator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_women` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_children` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_men` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observe_id` int(10) UNSIGNED DEFAULT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delegations`
--

INSERT INTO `delegations` (`id`, `nationality`, `address_in_mecca`, `address_in_madinah`, `arrival_time`, `date_of_arrival`, `date_of_Visit`, `visit_time`, `date_of_departure`, `departure_time`, `coordinator`, `contact_number`, `number_of_women`, `number_of_children`, `number_of_men`, `date`, `day`, `observe_id`, `service_id`, `observation`) VALUES
(1, 'لبنانية', 'الجميزة', 'شارع خالد بن خالد', '11:11', '1111-11-11', '1111-11-11', '11:11', '1111-11-11', '11:11', 'خالد محمد سليم', '0501478895', '33', '5', '22', '2019-08-01', 'الخميس', 13007, 31, 'عمل رائع'),
(2, 'تركية', 'الحرم المكي', 'الحرم', '11:11', '1440-11-12', '1440-11-14', '11:11', '1440-05-14', '11:11', 'خالد محمد سليم', '0501478895', '150', '5', '100', '2019-07-01', 'الأحد', 13007, 31, 'عمل رائع'),
(3, 'اندنوسيه', 'جدة', 'الحرم', '11:11', '1440-08-12', '1440-09-14', '11:11', '1440-10-14', '11:11', 'خالد محمد سليم', '0501478895', '50', '5', '100', '2019-09-24', 'الثلاثاء', 13007, 31, 'عمل رائع');

-- --------------------------------------------------------

--
-- Table structure for table `hospitable__forms`
--

CREATE TABLE `hospitable__forms` (
  `date` date NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evaluation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nu_service_providers` int(10) UNSIGNED NOT NULL,
  `number_of_beneficiaries` int(10) UNSIGNED NOT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `observe_id` int(10) UNSIGNED DEFAULT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `location_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitable__forms`
--

INSERT INTO `hospitable__forms` (`date`, `day`, `evaluation`, `nu_service_providers`, `number_of_beneficiaries`, `observation`, `form_id`, `observe_id`, `service_id`, `location_id`) VALUES
('2019-08-01', 'الخميس', 'ممتاز', 10, 95, 'عمل رائع', 1, 13007, 20, 73),
('2019-06-20', 'الخميس', 'ممتاز', 9, 70, 'عمل رائع', 2, 13007, 20, 89);

-- --------------------------------------------------------

--
-- Table structure for table `hospitable__form__materials`
--

CREATE TABLE `hospitable__form__materials` (
  `count` int(11) NOT NULL,
  `form_id` int(10) UNSIGNED DEFAULT NULL,
  `material_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitable__form__materials`
--

INSERT INTO `hospitable__form__materials` (`count`, `form_id`, `material_id`) VALUES
(100, 1, 50),
(90, 2, 50);

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`id`, `name`) VALUES
(1, 'وقف الخيرات'),
(2, 'وقف مداد الحياة'),
(3, 'وقف مكة الخيري'),
(4, 'كافللا لرعايةالأيتام'),
(5, 'وقف خير الزاد'),
(6, 'مركز حي المعابدة');

-- --------------------------------------------------------

--
-- Table structure for table `i_t_s`
--

CREATE TABLE `i_t_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `i_t_s`
--

INSERT INTO `i_t_s` (`id`, `f_name`, `s_name`, `l_name`, `email`, `password`) VALUES
(10000, 'سلمى', 'مرسل ', 'شيخ', 'salma@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(10) UNSIGNED NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection_point` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location`, `connection_point`, `created_at`, `updated_at`) VALUES
(57, 'مكة المكرمة', 'المناطق المجاورة للمسجد الحرام', NULL, NULL),
(58, 'مكة المكرمة', 'الفنادق', NULL, NULL),
(59, 'مكة المكرمة', 'المشاعر المقدسة', NULL, NULL),
(60, 'مكة المكرمة', 'محطات قطار المشاعر', NULL, NULL),
(61, 'مكة المكرمة', 'طوارئ', NULL, NULL),
(62, 'مكة المكرمة', 'طوارئ - الطريق المؤدي لمواقف كدي', NULL, NULL),
(63, 'مكة المكرمة', 'طوارئ - الطريق المؤدي للمسخوطة', NULL, NULL),
(64, 'مكة المكرمة', 'طوارئ - أحياء السد', NULL, NULL),
(65, 'مكة المكرمة', 'شعب علي', NULL, NULL),
(66, 'مكة المكرمة', 'طوارئ - جبل الكعبة', NULL, NULL),
(67, 'مكة المكرمة', 'داخل المسجد الحرام وأروقته', NULL, NULL),
(68, 'مكة المكرمة', 'ساحات المسجد الحرام', NULL, NULL),
(69, 'مكة المكرمة', 'موقف الرصيفة', NULL, NULL),
(70, 'مكة المكرمة', 'موقف الزايدي', NULL, NULL),
(71, 'مكة المكرمة', 'موقف كدي', NULL, NULL),
(72, 'مكة المكرمة', 'موقف محبس الجن', NULL, NULL),
(73, 'مكة المكرمة', 'موقف الشرائع', NULL, NULL),
(74, 'مكة المكرمة', 'موقف النوارية', NULL, NULL),
(75, 'مكة المكرمة', 'موقف الليث', NULL, NULL),
(76, 'مكة المكرمة', 'موقف عرفات', NULL, NULL),
(77, 'مكة المكرمة', 'مجمع الدوائر الحكومية', NULL, NULL),
(78, 'مكة المكرمة', 'مصلى شركة مكة', NULL, NULL),
(79, 'مكة المكرمة', 'المساندة لأنشطة قائمة', NULL, NULL),
(80, 'مكة المكرمة', 'شارع المسيال', NULL, NULL),
(81, 'مكة المكرمة', 'مراكز الاستقبال التابعة لوزارة الحج - الزايدي', NULL, NULL),
(82, 'مكة المكرمة', 'مراكز الاستقبال التابعة لوزارة الحج - النوارية', NULL, NULL),
(83, 'مكة المكرمة', 'مراكز الاستقبال التابعة لوزارة الحج - كيلو 40', NULL, NULL),
(84, 'مكة المكرمة', 'مراكز التفويج التابعة لوزارة الحج - الزايدي', NULL, NULL),
(85, 'مكة المكرمة', 'مراكز التفويج التابعة لوزارة الحج - كيلو 40', NULL, NULL),
(86, 'مكة المكرمة', 'المطبخ الخيري بعرفة 1', NULL, NULL),
(87, 'مكة المكرمة', 'المطبخ الخيري بعرفة 2', NULL, NULL),
(88, 'مكة المكرمة', 'المطبخ الخيري يمزدلفة', NULL, NULL),
(89, 'المدينة المنورة', 'المناطق المجاورة للمسجد النبوي', NULL, NULL),
(90, 'المدينة المنورة', 'صالة الحجاج', NULL, NULL),
(91, 'المدينة المنورة', 'ساحات المسجد النبوي', NULL, NULL),
(92, 'المدينة المنورة', 'ميقات المدينة المنورة', NULL, NULL),
(93, 'جدة', 'صالة الحجاج', NULL, NULL),
(94, 'محافظة القنفذة', 'مخيم محافظة القنفذة', NULL, NULL),
(95, 'المنافذ الحدودية', 'منفذ حالة عمار', NULL, NULL),
(96, 'المنافذ الحدودية', 'منفذ الرقعي', NULL, NULL),
(97, 'المنافذ الحدودية', 'منفذ الحديثة', NULL, NULL),
(98, 'المنافذ الحدودية', 'منفذ البطحاء', NULL, NULL),
(99, 'المنافذ الحدودية', 'منفذ الوديعة', NULL, NULL),
(100, 'المنافذ الحدودية', 'منفذ جديدة عرعر', NULL, NULL),
(101, 'المنافذ الحدودية', 'منفذ جسر الملك فهد', NULL, NULL),
(102, 'المنافذ الحدودية', 'استراحة الحجاج بأبو عجرم', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `name`) VALUES
(8, 'عبوات ماء سعة 330 ملليتر'),
(9, 'عصير'),
(10, 'آيس كريم'),
(11, 'عبوات ماء سعة 200 ملليتر'),
(12, 'ماء'),
(13, 'حليب'),
(14, 'عدس'),
(15, 'حلاوة طحينية'),
(16, 'زيت زيتون'),
(17, 'عيش برجر'),
(18, 'صحن بلاستيك'),
(19, 'علبة وجبة'),
(20, 'تعبئة وتغليف'),
(21, 'نقل'),
(22, 'تمر منزوع النوى'),
(23, 'معمول'),
(24, 'فطيرة'),
(25, 'لبن'),
(26, 'ربع شواية مع رز'),
(27, 'منديل منعش'),
(28, 'سفر'),
(29, 'غطاء عيون'),
(30, 'معطف مطر أخضر'),
(31, 'جل معقم'),
(32, 'مروحة رذاذ بالماء'),
(33, 'كيس حار بارد'),
(34, 'مروحة يد تطوى'),
(35, 'مضرب ذباب بلاستيك أخضر'),
(36, 'مطلة رأس'),
(37, 'نطارة قراءة'),
(38, 'كيس جمرات'),
(39, 'شنطة ظهر'),
(40, 'مناديل جيب'),
(41, 'عربة اطفال'),
(42, 'حذاء بلاستيك رجالي'),
(43, 'حذاء بلاستيك نسائي'),
(44, 'سروال رجالي'),
(45, 'سروال نسائي'),
(46, 'سبحة طواف'),
(47, 'ظرف قهوة عربية'),
(48, 'أكواب ورقية'),
(49, 'فناجيل قهوة شوكولاتة'),
(50, 'كراسي مساج'),
(51, 'غنم سواكني'),
(52, 'كيس أرز مزة درجة أولى حبة طويل حجم 3 كيلو'),
(53, 'كتب'),
(54, 'ملصقات'),
(55, 'اذكار'),
(56, 'كتيبات'),
(57, 'كتيبات توضيحية'),
(58, 'اساور'),
(59, 'خرائط');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_07_03_051536_create_i_t_s_table', 1),
(2, '2019_07_03_052314_create_admins_table', 2),
(3, '2019_07_03_055748_create_programs_table', 3),
(4, '2019_07_03_052735_create_supervisers_table', 4),
(5, '2019_07_14_080214_create_location_table', 5),
(6, '2019_07_11_063716_create_table__codes_table', 6),
(7, '2019_07_03_061809_create_services_table', 7),
(8, '2019_07_03_054228_create_observers_table', 8),
(9, '2019_07_03_072219_create_materials_table', 9),
(10, '2019_07_03_073212_create_institutions_table', 10),
(11, '2019_07_14_073342_create_services_materials_table', 11),
(12, '2019_07_04_051231_create_body__food__forms_table', 12),
(13, '2019_07_04_051403_create_body__food__forms__materials_table', 13),
(14, '2019_07_04_051444_create_soul__food__forms_table', 14),
(15, '2019_07_04_051612_create_soul__food__forms__materials_table', 15),
(16, '2019_07_04_051652_create_care__forms_table', 16),
(17, '2019_07_04_051712_create_care__form__materials_table', 17),
(18, '2019_07_04_051740_create_hospitable__forms_table', 18),
(19, '2019_07_04_051800_create_hospitable__form__materials_table', 19),
(21, '2019_07_04_051956_create_atonement__and__zakaat__forms_table', 21),
(22, '2019_07_04_052036_create_blood__of__algebrat__forms_table', 22),
(23, '2019_07_04_052209_create_blood__of__algebrat__form__institutions_table', 23),
(24, '2019_07_04_052154_create_adoption__of__the__committees_table', 24),
(25, '2019_07_10_054133_create_zakaat__form__institutions_table', 25),
(26, '2019_07_04_051930_create_delegations_table', 26);

-- --------------------------------------------------------

--
-- Table structure for table `observers`
--

CREATE TABLE `observers` (
  `id` int(10) UNSIGNED NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `superviser_id` int(10) UNSIGNED DEFAULT NULL,
  `location_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `observers`
--

INSERT INTO `observers` (`id`, `f_name`, `s_name`, `l_name`, `email`, `password`, `service_id`, `superviser_id`, `location_id`) VALUES
(13000, 'سالم ', 'محمد', 'علي', 'example1@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 28, 12001, NULL),
(13001, 'محمد', 'احمد', 'خليفة', 'example2@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 26, 12002, NULL),
(13002, 'امنه', 'علي ', 'محمد', 'example3@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 31, 12003, NULL),
(13003, 'وفاء ', 'محمد', 'الزهراني ', 'example4@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 29, 12001, NULL),
(13004, 'امجاد', 'محمد', 'بامقا', 'example5@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 13, 12004, 74),
(13005, 'خالد', 'محمد', 'الهذلي', 'example6@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 21, 12003, NULL),
(13006, 'عبدالرحمن', 'محمد', 'الرفاعي', 'example7@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 4, 12000, NULL),
(13007, 'خالد', 'علي ', 'باشراحيل ', 'example8@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 20, 12003, NULL),
(13008, 'حامد', 'حمد', 'اللحياني', 'example9@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 20, 12003, NULL),
(13009, 'منال', 'محمد', 'المغربي', 'example0@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 31, 12003, NULL),
(13010, 'سهام', 'عبود', 'مقرم', 'sham@gmail.com', '$2y$10$8UY7s6lAV1AlqGhZFszAye2SPVL1ZlM5uIlvwhlvyWJicFdhhGjDa', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `Description`, `image`) VALUES
(1, 'غذاء الروح ', ' يرتكز نشاط البرنامج على تعليم اركان الاسلام وتحسين \r\n تلاوة الفاتحة وقصار السور', '/images/غذاء-الروح1.png'),
(2, 'غذاء البدن', ' يراعي البرنامج في جميع جوانبه احتياجات الفئة المستفيدة', '/images/غذاء-البدن1.png'),
(3, 'الوكالات', 'لم يستطيع تنفيذ النسك فهناك الوكالات المقرة شرعا بإخراج \r\n الكفارات أو بإناية من يستطيع تنفيذ النسك عنه', '/images/1الوكالات.png'),
(4, 'مضياف ', ' استقبال الحجاج والمعتمرين والزوار وتقديم الضيافة والوجبات \r\n والسقيا والهدايا لهم', '/images/1مضياف.png'),
(5, 'عناية ', ' تضم جانبًا يتعلق بتقديم هدايا أو خدمات تتيح للحجاج \r\n والمعتمرين والزوار سهولة وتيسيرًا أثناء اداء المناس', '/images/العناية1.png');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_no` int(10) UNSIGNED DEFAULT NULL,
  `program_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `table_no`, `program_id`) VALUES
(1, 'السقا', 'يعتني المشروع بتقديم خدمات السقيا المتنوعة لضيوف الرحمن', 1, 2),
(2, 'السقيا', 'يعتني المشروع بتقديم خدمات السقيا المتنوعة لضيوف الرحمن', 1, 2),
(3, 'وجبات جافة', '--', 1, 2),
(4, 'إفطار صائم', 'مشروع تفطير الصائمين في شهر رمضان المبارك من خلال وجبات صحية معدة مسبقا ومحفوظة بطريق بطريقة صحية وامنه', 1, 2),
(5, 'السحور', 'يعتني بتقديم وجبات السحور للمعتمرين والزوار في المناطق المجاورة للمسجد الحرام وساحات المسجد النبوي', 1, 2),
(6, 'وجبات مطهية', '--', 1, 2),
(7, 'يمين ونحود', 'مشروع يعتني بنتفيذ وكالات صدقات وكفارات الدم وذلك باستلامها من الموكل وتوزيعها على فقراء الحرم وفق الضوابط الشرعية وبالتعاون مع الجهات المتخصصة،', 2, 3),
(8, 'فدية', 'مشروع يعتني بنتفيذ وكالات صدقات وكفارات الدم وذلك باستلامها من الموكل وتوزيعها على فقراء الحرم وفق الضوابط الشرعية وبالتعاون مع الجهات المتخصصة،', 2, 3),
(9, 'ارتكاب محظور', 'مشروع يعتني بنتفيذ وكالات صدقات وكفارات الدم وذلك باستلامها من الموكل وتوزيعها على فقراء الحرم وفق الضوابط الشرعية وبالتعاون مع الجهات المتخصصة،', 2, 3),
(10, 'العجز عن الصوم', 'مشروع يعتني بنتفيذ وكالات صدقات وكفارات الدم وذلك باستلامها من الموكل وتوزيعها على فقراء الحرم وفق الضوابط الشرعية وبالتعاون مع الجهات المتخصصة،', 2, 3),
(11, 'الكفارة المغلظة', 'مشروع يعتني بنتفيذ وكالات صدقات وكفارات الدم وذلك باستلامها من الموكل وتوزيعها على فقراء الحرم وفق الضوابط الشرعية وبالتعاون مع الجهات المتخصصة،', 2, 3),
(12, 'كفارة كسوة', 'مشروع يعتني بنتفيذ وكالات صدقات وكفارات الدم وذلك باستلامها من الموكل وتوزيعها على فقراء الحرم وفق الضوابط الشرعية وبالتعاون مع الجهات المتخصصة،', 2, 3),
(13, 'زكاة الفطر', 'مشروع يعتني بنتفيذ وكالات صدقات وكفارات الدم وذلك باستلامها من الموكل وتوزيعها على فقراء الحرم وفق الضوابط الشرعية وبالتعاون مع الجهات المتخصصة،', 2, 3),
(14, 'أضحية', 'مشروع يعتني بنتفيذ وكالات صدقات وكفارات الدم وذلك باستلامها من الموكل وتوزيعها على فقراء الحرم وفق الضوابط الشرعية وبالتعاون مع الجهات المتخصصة،', 3, 3),
(15, 'دم جبران', 'مشروع يعتني بنتفيذ وكالات صدقات وكفارات الدم وذلك باستلامها من الموكل وتوزيعها على فقراء الحرم وفق الضوابط الشرعية وبالتعاون مع الجهات المتخصصة،', 3, 3),
(16, 'صدقة', 'مشروع يعتني بنتفيذ وكالات صدقات وكفارات الدم وذلك باستلامها من الموكل وتوزيعها على فقراء الحرم وفق الضوابط الشرعية وبالتعاون مع الجهات المتخصصة،', 3, 3),
(17, 'نذر', 'مشروع يعتني بنتفيذ وكالات صدقات وكفارات الدم وذلك باستلامها من الموكل وتوزيعها على فقراء الحرم وفق الضوابط الشرعية وبالتعاون مع الجهات المتخصصة،', 3, 3),
(18, 'فدية', 'مشروع يعتني بنتفيذ وكالات صدقات وكفارات الدم وذلك باستلامها من الموكل وتوزيعها على فقراء الحرم وفق الضوابط الشرعية وبالتعاون مع الجهات المتخصصة،', 3, 3),
(19, 'عقيقة', 'مشروع يعتني بنتفيذ وكالات صدقات وكفارات الدم وذلك باستلامها من الموكل وتوزيعها على فقراء الحرم وفق الضوابط الشرعية وبالتعاون مع الجهات المتخصصة،', 3, 3),
(20, 'خدمات الراحة على كراسي المساج', 'مشروع يعتني بتوفير سبل الراحة للحجاج والمعتمرين والزوار وخاصة لكبار السن منهم، وذلك بتوفير كراسي المساج لتساعدهم لإكمال نسكهم بكل يسر وسهولة\'', 4, 4),
(21, 'مليون سلام', '', 4, 4),
(22, 'توزيع هدايا العناية الشخصية', 'مشروع يعتني بتقديم منتجات العناية الشخصية لضيوف الرحمن بما يساهم في تيسير أداء مناسكهم وتحقيق سبل الراحة لهم', 5, 5),
(23, 'التحفيز', 'يعتني بتحفيز العاملين في خدمة ضيوف الرحمن من رجال الامن ومنسوبي وزارة الحج والعمرة ومنسوبي الرئاسة العامة لشؤون المسجد الحرام والمسجد النبوي وغيرهم وذلك بتقديم كافة الدعم الملموس والمعنوي تحت شعار نخدم من يخدم', 5, 5),
(24, 'أساور أطفال', 'مشروع يعتني بتقديم منتجات العناية الشخصية لضيوف الرحمن بما يساهم في تيسير أداء مناسكهم وتحقيق سبل الراحة لهم', 5, 5),
(25, 'رعاية أطفال', 'مشروع يعتني بتقديم منتجات العناية الشخصية لضيوف الرحمن بما يساهم في تيسير أداء مناسكهم وتحقيق سبل الراحة لهم', 5, 5),
(26, 'إرشاد التائهين', 'مشروع يعتني بتقديم منتجات العناية الشخصية لضيوف الرحمن بما يساهم في تيسير أداء مناسكهم وتحقيق سبل الراحة لهم', 5, 5),
(27, 'توزيع المواد التوجيهية', '', 6, 1),
(28, 'التذكير بالصلاة', '', 6, 1),
(29, 'الشاشات التوجيهية', '', 6, 1),
(30, 'إحياء السنن', '', 6, 1),
(31, 'استقبال الوفود', 'يعتني باستقبال الوفود من الحجاج والمعتمرين والزوار في مكة المكرمة والمدينة المنورة وتضيفهم ضيافة تليق بمقامهم وتحتفي بهم احتفاء يدخل السرور في نفوسهم', 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `services_materials`
--

CREATE TABLE `services_materials` (
  `material_id` int(10) UNSIGNED DEFAULT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services_materials`
--

INSERT INTO `services_materials` (`material_id`, `service_id`) VALUES
(NULL, 4),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(12, 4),
(22, 4),
(23, 4),
(16, 5),
(17, 5),
(19, 5),
(23, 5),
(24, 5),
(25, 5),
(26, 5),
(27, 5),
(28, 5),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(53, 27),
(54, 27),
(55, 27),
(56, 28),
(57, 29),
(53, 30),
(54, 30),
(29, 22),
(30, 22),
(31, 22),
(32, 22),
(33, 22),
(34, 22),
(35, 22),
(36, 22),
(37, 22),
(38, 22),
(39, 22),
(40, 22),
(41, 22),
(42, 22),
(43, 22),
(44, 22),
(45, 22),
(46, 22),
(42, 23),
(43, 23),
(44, 23),
(45, 23),
(58, 24),
(58, 25),
(59, 26),
(47, 31),
(48, 31),
(49, 31),
(50, 31),
(50, 20),
(47, 21),
(48, 21),
(49, 21),
(53, 21),
(55, 21);

-- --------------------------------------------------------

--
-- Table structure for table `soul__food__forms`
--

CREATE TABLE `soul__food__forms` (
  `date` date NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `evaluation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nu_service_providers` int(10) UNSIGNED NOT NULL,
  `number_of_beneficiaries` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `observe_id` int(10) UNSIGNED DEFAULT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `location_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soul__food__forms`
--

INSERT INTO `soul__food__forms` (`date`, `day`, `evaluation`, `observation`, `nu_service_providers`, `number_of_beneficiaries`, `form_id`, `observe_id`, `service_id`, `location_id`) VALUES
('2019-06-01', 'السبت', 'جيد جدا', 'عمل رائع', 12, 102, 1, 13000, 28, 94),
('2019-04-01', 'الإثنين', 'ممتاز', 'عمل رائع', 10, 111, 2, 13000, 28, 74);

-- --------------------------------------------------------

--
-- Table structure for table `soul__food__forms__materials`
--

CREATE TABLE `soul__food__forms__materials` (
  `count` int(11) NOT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_id` int(10) UNSIGNED DEFAULT NULL,
  `material_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soul__food__forms__materials`
--

INSERT INTO `soul__food__forms__materials` (`count`, `language`, `form_id`, `material_id`) VALUES
(50, 'العربية', 1, 56),
(22, 'العربية', 2, 56);

-- --------------------------------------------------------

--
-- Table structure for table `supervisers`
--

CREATE TABLE `supervisers` (
  `id` int(10) UNSIGNED NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `s_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `program_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supervisers`
--

INSERT INTO `supervisers` (`id`, `f_name`, `s_name`, `l_name`, `email`, `password`, `admin_id`, `program_id`) VALUES
(12000, 'طيف ', 'محمد ', 'الوافي ', 'tief@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 11001, 2),
(12001, 'حنان', 'حامد ', 'الحربي ', 'hanan@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 11001, 1),
(12002, 'ذكرى', 'حمد', 'الهذلي', 'THEKRA@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 11001, 5),
(12003, 'زهرة ', 'عمر ', 'شيخ', 'zahra@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 11001, 4),
(12004, 'سعاد', 'عمر ', 'شيخ', 'suad@gmail.com', '$2y$10$NgrJ9zHw.wQmSalk9BHGnOHbMlN8rrImbsqOrb1mcP9CRZ3HDZkOi', 11001, 3),
(12005, 'ختام', 'علي', 'باشراحيل', 'katam@gmail.com', '$2y$10$sV3YMaMsfIhmaXTWL3VVMORI5CBDbG39qI.40KppuSN50zl7EkV3C', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table__codes`
--

CREATE TABLE `table__codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table__codes`
--

INSERT INTO `table__codes` (`id`, `table_name`, `program_id`) VALUES
(1, 'نموذج تنفيذ مشاريع غذاء البدن ', 2),
(2, 'نموذج تنفيذ الكفارات او زكاة الفطر ', 3),
(3, 'نموذج تنفيذ وكالات دم لجبران والعقائق ونحوه ', 3),
(4, 'نموذج تنفيذ مشاريع مضياف ', 4),
(5, 'نموذج تنفيذ مشاريع العناية ', 5),
(6, 'نموذج تنفيذ مشاريع غذاء الروح ', 1),
(7, 'نموذج استقبال الوفود ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `zakaat__form__institutions`
--

CREATE TABLE `zakaat__form__institutions` (
  `institution_id` int(10) UNSIGNED DEFAULT NULL,
  `form_id` int(10) UNSIGNED DEFAULT NULL,
  `count` int(11) NOT NULL,
  `recipient` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zakaat__form__institutions`
--

INSERT INTO `zakaat__form__institutions` (`institution_id`, `form_id`, `count`, `recipient`) VALUES
(1, 4, 1, 'محمد خالد'),
(2, 4, 1, 'محمد خالد'),
(2, 5, 12, 'محمد خالد'),
(2, 6, 20, 'محمد خالد'),
(3, 6, 20, 'خالد محمد'),
(5, 6, 30, 'علي باشراحيل'),
(1, 6, 11, 'مرسل شيخ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_id_unique` (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `adoption__of__the__committees`
--
ALTER TABLE `adoption__of__the__committees`
  ADD KEY `adoption__of__the__committees_form_id_foreign` (`form_id`);

--
-- Indexes for table `atonement__and__zakaat__forms`
--
ALTER TABLE `atonement__and__zakaat__forms`
  ADD PRIMARY KEY (`form_id`),
  ADD UNIQUE KEY `atonement__and__zakaat__forms_form_id_unique` (`form_id`),
  ADD KEY `atonement__and__zakaat__forms_observe_id_foreign` (`observe_id`),
  ADD KEY `atonement__and__zakaat__forms_service_id_foreign` (`service_id`);

--
-- Indexes for table `blood__of__algebrat__forms`
--
ALTER TABLE `blood__of__algebrat__forms`
  ADD PRIMARY KEY (`form_id`),
  ADD UNIQUE KEY `blood__of__algebrat__forms_form_id_unique` (`form_id`),
  ADD KEY `blood__of__algebrat__forms_observe_id_foreign` (`observe_id`),
  ADD KEY `blood__of__algebrat__forms_service_id_foreign` (`service_id`);

--
-- Indexes for table `blood__of__algebrat__form__institutions`
--
ALTER TABLE `blood__of__algebrat__form__institutions`
  ADD KEY `blood__of__algebrat__form__institutions_institution_id_foreign` (`institution_id`),
  ADD KEY `blood__of__algebrat__form__institutions_form_id_foreign` (`form_id`);

--
-- Indexes for table `body__food__forms`
--
ALTER TABLE `body__food__forms`
  ADD PRIMARY KEY (`form_id`),
  ADD UNIQUE KEY `body__food__forms_form_id_unique` (`form_id`),
  ADD KEY `body__food__forms_observe_id_foreign` (`observe_id`),
  ADD KEY `body__food__forms_service_id_foreign` (`service_id`),
  ADD KEY `body__food__forms_location_id_foreign` (`location_id`);

--
-- Indexes for table `body__food__forms__materials`
--
ALTER TABLE `body__food__forms__materials`
  ADD KEY `body__food__forms__materials_form_id_foreign` (`form_id`),
  ADD KEY `body__food__forms__materials_material_id_foreign` (`material_id`);

--
-- Indexes for table `care__forms`
--
ALTER TABLE `care__forms`
  ADD PRIMARY KEY (`form_id`),
  ADD UNIQUE KEY `care__forms_form_id_unique` (`form_id`),
  ADD KEY `care__forms_observe_id_foreign` (`observe_id`),
  ADD KEY `care__forms_service_id_foreign` (`service_id`),
  ADD KEY `care__forms_location_id_foreign` (`location_id`);

--
-- Indexes for table `care__form__materials`
--
ALTER TABLE `care__form__materials`
  ADD KEY `care__form__materials_form_id_foreign` (`form_id`),
  ADD KEY `care__form__materials_material_id_foreign` (`material_id`);

--
-- Indexes for table `delegations`
--
ALTER TABLE `delegations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `delegations_id_unique` (`id`),
  ADD KEY `delegations_observe_id_foreign` (`observe_id`),
  ADD KEY `delegations_service_id_foreign` (`service_id`);

--
-- Indexes for table `hospitable__forms`
--
ALTER TABLE `hospitable__forms`
  ADD PRIMARY KEY (`form_id`),
  ADD UNIQUE KEY `hospitable__forms_form_id_unique` (`form_id`),
  ADD KEY `hospitable__forms_observe_id_foreign` (`observe_id`),
  ADD KEY `hospitable__forms_service_id_foreign` (`service_id`),
  ADD KEY `hospitable__forms_location_id_foreign` (`location_id`);

--
-- Indexes for table `hospitable__form__materials`
--
ALTER TABLE `hospitable__form__materials`
  ADD KEY `hospitable__form__materials_form_id_foreign` (`form_id`),
  ADD KEY `hospitable__form__materials_material_id_foreign` (`material_id`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `institutions_id_unique` (`id`);

--
-- Indexes for table `i_t_s`
--
ALTER TABLE `i_t_s`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `i_t_s_id_unique` (`id`),
  ADD UNIQUE KEY `i_t_s_email_unique` (`email`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `location_id_unique` (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `materials_id_unique` (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observers`
--
ALTER TABLE `observers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `observers_id_unique` (`id`),
  ADD UNIQUE KEY `observers_email_unique` (`email`),
  ADD KEY `observers_service_id_foreign` (`service_id`),
  ADD KEY `observers_superviser_id_foreign` (`superviser_id`),
  ADD KEY `observers_location_id_foreign` (`location_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programs_id_unique` (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_id_unique` (`id`),
  ADD KEY `services_program_id_foreign` (`program_id`),
  ADD KEY `services_table_no_foreign` (`table_no`);

--
-- Indexes for table `services_materials`
--
ALTER TABLE `services_materials`
  ADD KEY `services_materials_material_id_foreign` (`material_id`),
  ADD KEY `services_materials_service_id_foreign` (`service_id`);

--
-- Indexes for table `soul__food__forms`
--
ALTER TABLE `soul__food__forms`
  ADD PRIMARY KEY (`form_id`),
  ADD UNIQUE KEY `soul__food__forms_form_id_unique` (`form_id`),
  ADD KEY `soul__food__forms_observe_id_foreign` (`observe_id`),
  ADD KEY `soul__food__forms_service_id_foreign` (`service_id`),
  ADD KEY `soul__food__forms_location_id_foreign` (`location_id`);

--
-- Indexes for table `soul__food__forms__materials`
--
ALTER TABLE `soul__food__forms__materials`
  ADD KEY `soul__food__forms__materials_form_id_foreign` (`form_id`),
  ADD KEY `soul__food__forms__materials_material_id_foreign` (`material_id`);

--
-- Indexes for table `supervisers`
--
ALTER TABLE `supervisers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supervisers_id_unique` (`id`),
  ADD UNIQUE KEY `supervisers_email_unique` (`email`),
  ADD KEY `supervisers_program_id_foreign` (`program_id`),
  ADD KEY `supervisers_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `table__codes`
--
ALTER TABLE `table__codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `table__codes_id_unique` (`id`),
  ADD KEY `table__codes_program_id_foreign` (`program_id`);

--
-- Indexes for table `zakaat__form__institutions`
--
ALTER TABLE `zakaat__form__institutions`
  ADD KEY `zakaat__form__institutions_institution_id_foreign` (`institution_id`),
  ADD KEY `zakaat__form__institutions_form_id_foreign` (`form_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11004;

--
-- AUTO_INCREMENT for table `atonement__and__zakaat__forms`
--
ALTER TABLE `atonement__and__zakaat__forms`
  MODIFY `form_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blood__of__algebrat__forms`
--
ALTER TABLE `blood__of__algebrat__forms`
  MODIFY `form_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `body__food__forms`
--
ALTER TABLE `body__food__forms`
  MODIFY `form_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `care__forms`
--
ALTER TABLE `care__forms`
  MODIFY `form_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delegations`
--
ALTER TABLE `delegations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hospitable__forms`
--
ALTER TABLE `hospitable__forms`
  MODIFY `form_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `i_t_s`
--
ALTER TABLE `i_t_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10001;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `observers`
--
ALTER TABLE `observers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13011;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `soul__food__forms`
--
ALTER TABLE `soul__food__forms`
  MODIFY `form_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supervisers`
--
ALTER TABLE `supervisers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12006;

--
-- AUTO_INCREMENT for table `table__codes`
--
ALTER TABLE `table__codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption__of__the__committees`
--
ALTER TABLE `adoption__of__the__committees`
  ADD CONSTRAINT `adoption__of__the__committees_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `blood__of__algebrat__forms` (`form_id`) ON DELETE SET NULL;

--
-- Constraints for table `atonement__and__zakaat__forms`
--
ALTER TABLE `atonement__and__zakaat__forms`
  ADD CONSTRAINT `atonement__and__zakaat__forms_observe_id_foreign` FOREIGN KEY (`observe_id`) REFERENCES `observers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `atonement__and__zakaat__forms_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `blood__of__algebrat__forms`
--
ALTER TABLE `blood__of__algebrat__forms`
  ADD CONSTRAINT `blood__of__algebrat__forms_observe_id_foreign` FOREIGN KEY (`observe_id`) REFERENCES `observers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `blood__of__algebrat__forms_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `blood__of__algebrat__form__institutions`
--
ALTER TABLE `blood__of__algebrat__form__institutions`
  ADD CONSTRAINT `blood__of__algebrat__form__institutions_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `blood__of__algebrat__forms` (`form_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `blood__of__algebrat__form__institutions_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `body__food__forms`
--
ALTER TABLE `body__food__forms`
  ADD CONSTRAINT `body__food__forms_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `body__food__forms_observe_id_foreign` FOREIGN KEY (`observe_id`) REFERENCES `observers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `body__food__forms_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `body__food__forms__materials`
--
ALTER TABLE `body__food__forms__materials`
  ADD CONSTRAINT `body__food__forms__materials_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `body__food__forms` (`form_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `body__food__forms__materials_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `care__forms`
--
ALTER TABLE `care__forms`
  ADD CONSTRAINT `care__forms_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `care__forms_observe_id_foreign` FOREIGN KEY (`observe_id`) REFERENCES `observers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `care__forms_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `care__form__materials`
--
ALTER TABLE `care__form__materials`
  ADD CONSTRAINT `care__form__materials_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `care__forms` (`form_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `care__form__materials_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `delegations`
--
ALTER TABLE `delegations`
  ADD CONSTRAINT `delegations_observe_id_foreign` FOREIGN KEY (`observe_id`) REFERENCES `observers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `delegations_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `hospitable__forms`
--
ALTER TABLE `hospitable__forms`
  ADD CONSTRAINT `hospitable__forms_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `hospitable__forms_observe_id_foreign` FOREIGN KEY (`observe_id`) REFERENCES `observers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `hospitable__forms_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `hospitable__form__materials`
--
ALTER TABLE `hospitable__form__materials`
  ADD CONSTRAINT `hospitable__form__materials_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `hospitable__forms` (`form_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `hospitable__form__materials_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `observers`
--
ALTER TABLE `observers`
  ADD CONSTRAINT `observers_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `observers_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `observers_superviser_id_foreign` FOREIGN KEY (`superviser_id`) REFERENCES `supervisers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `services_table_no_foreign` FOREIGN KEY (`table_no`) REFERENCES `table__codes` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `services_materials`
--
ALTER TABLE `services_materials`
  ADD CONSTRAINT `services_materials_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `services_materials_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `soul__food__forms`
--
ALTER TABLE `soul__food__forms`
  ADD CONSTRAINT `soul__food__forms_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `soul__food__forms_observe_id_foreign` FOREIGN KEY (`observe_id`) REFERENCES `observers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `soul__food__forms_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `soul__food__forms__materials`
--
ALTER TABLE `soul__food__forms__materials`
  ADD CONSTRAINT `soul__food__forms__materials_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `soul__food__forms` (`form_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `soul__food__forms__materials_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `supervisers`
--
ALTER TABLE `supervisers`
  ADD CONSTRAINT `supervisers_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `supervisers_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `table__codes`
--
ALTER TABLE `table__codes`
  ADD CONSTRAINT `table__codes_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `zakaat__form__institutions`
--
ALTER TABLE `zakaat__form__institutions`
  ADD CONSTRAINT `zakaat__form__institutions_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `atonement__and__zakaat__forms` (`form_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `zakaat__form__institutions_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
