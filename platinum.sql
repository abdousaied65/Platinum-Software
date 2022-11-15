-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 10:23 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `platinum`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name_ar`, `name_en`, `email`, `phone_number`, `email_verified_at`, `password`, `role_name`, `Status`, `api_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'منصة حلول التحول', 'Digital Transformation Solutions', 'admin@admin.com', NULL, '2021-07-10 22:33:30', '$2y$10$aRTdEPgFbTObdpSKgOaaGurYIyp0ExMMtGIpb5w4v6LBadNfZmQpi', '[\"\\u0639\\u0645\\u064a\\u0644\"]', 'active', NULL, 'foasHWXHcMPY0sr9vzvcRDpUAmwLvnTtbmr1ljfIXP5LyB0wz1uOY8AwoWVa', '2021-07-10 22:33:30', '2022-10-22 12:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_password_resets`
--

INSERT INTO `admin_password_resets` (`email`, `token`, `created_at`) VALUES
('abdoushawer93@gmail.com', '$2y$10$t2mcKYQS7ObdI4NEW/vvd.7h7R57Ky1IL8cpMd4VSgtFSsG4Uw622', '2022-10-23 14:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `admin_profiles`
--

CREATE TABLE `admin_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_profiles`
--

INSERT INTO `admin_profiles` (`id`, `city_name`, `age`, `gender`, `profile_pic`, `admin_id`, `created_at`, `updated_at`) VALUES
(2, 'جدة', '30', 'male', 'uploads/profiles/admins/1/logo.png', 1, '2021-07-10 23:21:41', '2021-11-30 10:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `bank_balance` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `company_id`, `bank_balance`, `created_at`, `updated_at`) VALUES
(8, 'بنك مصر', 1, '52300', '2022-03-16 12:01:35', '2022-06-04 20:40:53'),
(11, 'البنك الاهلى', 1, '30000', '2022-06-09 22:22:44', '2022-06-09 22:22:44'),
(12, 'بنك قطر الدولى', 1, '50000', '2022-06-09 22:23:18', '2022-06-09 22:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `banks_modifications`
--

CREATE TABLE `banks_modifications` (
  `id` int(100) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` int(11) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `balance_before` varchar(255) NOT NULL,
  `balance_after` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banks_process`
--

CREATE TABLE `banks_process` (
  `id` int(100) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` int(11) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `process_type` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `balance_before` varchar(255) NOT NULL,
  `balance_after` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banks_transfer`
--

CREATE TABLE `banks_transfer` (
  `id` int(100) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `withdrawal_bank` int(11) NOT NULL,
  `deposit_bank` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bank_buy_cash`
--

CREATE TABLE `bank_buy_cash` (
  `id` int(11) NOT NULL,
  `cash_number` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `bank_check_number` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `supplier_id` int(100) NOT NULL,
  `balance_before` varchar(255) DEFAULT NULL,
  `balance_after` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `bill_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bank_cash`
--

CREATE TABLE `bank_cash` (
  `id` int(11) NOT NULL,
  `cash_number` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `bank_check_number` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `outer_client_id` int(100) DEFAULT NULL,
  `balance_before` varchar(255) DEFAULT NULL,
  `balance_after` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `bill_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bank_safe_transfer`
--

CREATE TABLE `bank_safe_transfer` (
  `id` int(100) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` int(11) NOT NULL,
  `safe_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `basic_settings`
--

CREATE TABLE `basic_settings` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `header` text DEFAULT NULL,
  `footer` text DEFAULT NULL,
  `electronic_stamp` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `basic_settings`
--

INSERT INTO `basic_settings` (`id`, `company_id`, `header`, `footer`, `electronic_stamp`, `created_at`, `updated_at`) VALUES
(6, 1, '', '', '', '2022-02-15 15:34:09', '2022-02-15 15:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_phone` varchar(255) NOT NULL,
  `branch_address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `company_id`, `branch_name`, `branch_phone`, `branch_address`, `created_at`, `updated_at`) VALUES
(8, 1, 'الفرع الرئيسى', '', '', '2022-02-15 15:34:11', '2022-02-15 15:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `buy_bills`
--

CREATE TABLE `buy_bills` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `buy_bill_number` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `final_total` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `rest` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy_bills`
--

INSERT INTO `buy_bills` (`id`, `company_id`, `client_id`, `supplier_id`, `buy_bill_number`, `date`, `time`, `notes`, `status`, `final_total`, `paid`, `rest`, `created_at`, `updated_at`) VALUES
(5, 1, 11, 6, '4', '2022-06-05', '15:29:32', NULL, 'done', '18400', '18400', '0', '2022-06-05 13:31:31', '2022-06-05 13:31:56'),
(6, 1, 11, 6, '5', '2022-10-23', '10:26:33', NULL, 'open', '920', NULL, NULL, '2022-10-23 10:26:47', '2022-10-23 10:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `buy_bill_elements`
--

CREATE TABLE `buy_bill_elements` (
  `id` int(11) NOT NULL,
  `buy_bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `product_unit_id` int(11) NOT NULL,
  `quantity_price` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy_bill_elements`
--

INSERT INTO `buy_bill_elements` (`id`, `buy_bill_id`, `product_id`, `company_id`, `product_price`, `quantity`, `product_unit_id`, `quantity_price`, `created_at`, `updated_at`) VALUES
(3, 5, 713, 1, '800', '20', 719, '16000', '2022-06-05 13:31:31', '2022-06-05 13:31:31'),
(4, 6, 713, 1, '800', '1', 719, '800', '2022-10-23 10:26:47', '2022-10-23 10:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `buy_bill_extra`
--

CREATE TABLE `buy_bill_extra` (
  `id` int(11) NOT NULL,
  `buy_bill_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `action_type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy_bill_extra`
--

INSERT INTO `buy_bill_extra` (`id`, `buy_bill_id`, `company_id`, `action`, `action_type`, `value`, `created_at`, `updated_at`) VALUES
(5, 5, 1, 'discount', 'pound', '0', '2022-06-05 13:31:32', '2022-06-05 13:31:32'),
(6, 5, 1, 'extra', 'pound', '0', '2022-06-05 13:31:32', '2022-06-05 13:31:32'),
(7, 6, 1, 'discount', 'pound', '0', '2022-10-23 10:26:47', '2022-10-23 10:26:47'),
(8, 6, 1, 'extra', 'pound', '0', '2022-10-23 10:26:47', '2022-10-23 10:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `buy_bill_return`
--

CREATE TABLE `buy_bill_return` (
  `id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(100) NOT NULL,
  `balance_before` varchar(255) NOT NULL,
  `balance_after` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `quantity_price` varchar(255) NOT NULL,
  `return_quantity` varchar(255) NOT NULL,
  `before_return` varchar(255) NOT NULL,
  `after_return` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `buy_cash`
--

CREATE TABLE `buy_cash` (
  `id` int(11) NOT NULL,
  `cash_number` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `safe_id` int(11) NOT NULL,
  `supplier_id` int(100) NOT NULL,
  `balance_before` varchar(255) DEFAULT NULL,
  `balance_after` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `bill_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy_cash`
--

INSERT INTO `buy_cash` (`id`, `cash_number`, `company_id`, `client_id`, `safe_id`, `supplier_id`, `balance_before`, `balance_after`, `amount`, `bill_id`, `date`, `time`, `notes`, `created_at`, `updated_at`) VALUES
(2, '2', 1, 11, 11, 6, '0', '-18400', '18400', '4', '2022-06-05', '15:29:32', NULL, '2022-06-05 13:31:49', '2022-06-05 13:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `buy_serials`
--

CREATE TABLE `buy_serials` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `buy_bill_id` int(11) NOT NULL,
  `buy_element_id` int(11) NOT NULL,
  `product_unit_id` int(11) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `capitals`
--

CREATE TABLE `capitals` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) NOT NULL,
  `balance_before` varchar(255) NOT NULL,
  `balance_after` varchar(255) NOT NULL,
  `safe_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `capitals`
--

INSERT INTO `capitals` (`id`, `company_id`, `client_id`, `amount`, `balance_before`, `balance_after`, `safe_id`, `notes`, `created_at`, `updated_at`) VALUES
(2, 1, 11, '1000', '4700', '5700', 11, NULL, '2022-06-05 01:24:28', '2022-06-05 01:24:28');

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `id` int(11) NOT NULL,
  `cash_number` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `safe_id` int(11) NOT NULL,
  `outer_client_id` int(100) DEFAULT NULL,
  `balance_before` varchar(255) DEFAULT NULL,
  `balance_after` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `bill_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`id`, `cash_number`, `company_id`, `client_id`, `safe_id`, `outer_client_id`, `balance_before`, `balance_after`, `amount`, `bill_id`, `date`, `time`, `notes`, `created_at`, `updated_at`) VALUES
(657, '1', 1, 11, 11, 7, '4000', '3000', '1000', NULL, '2022-10-24', '08:21:52', NULL, '2022-10-24 08:22:00', '2022-10-24 08:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `company_id`, `category_name`, `category_type`, `created_at`, `updated_at`) VALUES
(17, 1, 'الفئة الاولى', 'مخزونية', '2022-02-15 15:34:11', '2022-02-15 15:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone_number`, `email_verified_at`, `password`, `role_name`, `Status`, `api_token`, `company_id`, `branch_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(11, 'مهندس عبده', 'abdoushawer93@gmail.com', '01092716796', '2022-02-15 15:34:14', '$2y$10$GJqPe.7934A7sxIvWd/qBe5ffdFvP1OW5kwjLlszCVMoCxSkgbTm6', '[\"\\u0645\\u062f\\u064a\\u0631 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645\"]', 'active', NULL, 1, 8, '1HLYcOMWlwt7eNcXSD9zixodr45qflmT4Sz8wuxsz5Sv5vlHo30Xpi8OYDdA', '2022-02-15 15:34:14', '2022-03-25 05:18:29'),
(21, 'محمد', 'mo@gmail.com', NULL, '2022-04-02 19:41:49', '$2y$10$Llr2BjRzi/.lSLUtnUBQtOaSE/.t2jlCF4lQ4olAJER.PXXCk0YM.', '[\"\\u0645\\u062f\\u064a\\u0631 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645\"]', 'active', NULL, 1, 8, NULL, '2022-04-02 19:41:49', '2022-04-02 19:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `client_profiles`
--

CREATE TABLE `client_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_profiles`
--

INSERT INTO `client_profiles` (`id`, `city_name`, `age`, `gender`, `profile_pic`, `client_id`, `company_id`, `created_at`, `updated_at`) VALUES
(11, '', '', '', 'images/guest.png', 11, 1, '2022-02-15 15:34:15', '2022-02-15 15:34:15'),
(21, '', '', '', 'app-assets/images/logo.png', 21, 1, '2022-04-02 19:41:49', '2022-04-02 19:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_field` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commercial_registration_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_value_added` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `all_users_access_main_branch` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `business_field`, `phone_number`, `company_owner`, `company_address`, `country`, `currency`, `tax_number`, `commercial_registration_number`, `tax_value_added`, `company_logo`, `status`, `notes`, `all_users_access_main_branch`, `created_at`, `updated_at`) VALUES
(1, 'شركة شاور', 'تجارة', '01092716796', 'محمد', 'الرياض', 'Asia/Riyadh', 'ريال سعودى', '123123123123123', '123123123123', '15', 'uploads/companies/logos/1/0-hPIjSc_400x400.jpg', 'active', NULL, 'no', '2022-02-15 15:34:09', '2022-10-24 08:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `phone`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'عبده سعيد شاور', '966590909090', 'تحية', 'تحية', 0, '2022-10-23 14:52:12', '2022-10-23 14:52:12'),
(2, 'عبده سعيد شاور', '0507654372', 'تحية', 'يبلاتن', 0, '2022-10-23 14:52:35', '2022-10-23 14:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_cash`
--

CREATE TABLE `coupon_cash` (
  `id` int(11) NOT NULL,
  `cash_number` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `outer_client_id` int(100) DEFAULT NULL,
  `coupon_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `bill_id` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_codes`
--

CREATE TABLE `coupon_codes` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `dept` varchar(255) NOT NULL,
  `outer_client_id` int(100) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `coupon_code` text NOT NULL,
  `coupon_value` varchar(255) NOT NULL,
  `coupon_expired` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `currency`) VALUES
(1, 'أوقية موريتانية'),
(2, 'دينار ليبى'),
(3, 'دينار تونسى'),
(4, 'دينار جزائري'),
(5, 'جنيه سودانى'),
(6, 'درهم مغربى'),
(7, 'دينار عراقى'),
(8, 'ريال سعودى'),
(9, 'دينار بحرينى'),
(10, 'ليرة لبنانى'),
(11, 'شيكل فلسطينى'),
(12, 'ريال قطرى'),
(13, 'درهم اماراتى'),
(14, 'دينار اردنى'),
(15, 'ليرة سوري'),
(16, 'دينار كويتى'),
(17, 'ريال عمانى'),
(18, 'دولار امريكى'),
(19, 'يورو اوروبى'),
(20, 'جنية استرلينى'),
(21, 'جنية مصرى');

-- --------------------------------------------------------

--
-- Table structure for table `delegates`
--

CREATE TABLE `delegates` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `delegate_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delegates`
--

INSERT INTO `delegates` (`id`, `company_id`, `client_id`, `delegate_name`, `created_at`, `updated_at`) VALUES
(4, 1, 11, 'المعرض', '2022-10-24 08:12:22', '2022-10-24 08:12:22');

-- --------------------------------------------------------

--
-- Table structure for table `devices_issues`
--

CREATE TABLE `devices_issues` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `issue` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devices_issues`
--

INSERT INTO `devices_issues` (`id`, `company_id`, `client_id`, `issue`, `created_at`, `updated_at`) VALUES
(5, 1, 11, 'اي سي', '2022-10-24 08:12:09', '2022-10-24 08:12:09');

-- --------------------------------------------------------

--
-- Table structure for table `devices_types`
--

CREATE TABLE `devices_types` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `device_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devices_types`
--

INSERT INTO `devices_types` (`id`, `company_id`, `client_id`, `device_type`, `created_at`, `updated_at`) VALUES
(7, 1, 11, 'بات', '2022-10-24 08:12:02', '2022-10-24 08:12:02');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `civil_registry` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `salary` varchar(255) NOT NULL,
  `work_status` varchar(255) NOT NULL DEFAULT 'working',
  `work_start_date` varchar(255) DEFAULT NULL,
  `work_end_date` varchar(255) DEFAULT NULL,
  `works_by_the_hour` int(1) NOT NULL DEFAULT 0,
  `number_of_hours_per_day` varchar(255) DEFAULT NULL,
  `hourly_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employees_cash`
--

CREATE TABLE `employees_cash` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `safe_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `engineers`
--

CREATE TABLE `engineers` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `commission_rate` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expense_number` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `fixed_expense` int(11) NOT NULL,
  `expense_details` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `expense_pic` text NOT NULL,
  `safe_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `extra_settings`
--

CREATE TABLE `extra_settings` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `font_size` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `extra_settings`
--

INSERT INTO `extra_settings` (`id`, `company_id`, `timezone`, `currency`, `font_size`, `created_at`, `updated_at`) VALUES
(6, 1, 'Asia/Riyadh', 'ريال سعودى', '12', '2022-02-15 15:34:09', '2022-10-24 06:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `fixed_expenses`
--

CREATE TABLE `fixed_expenses` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `fixed_expense` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE `gifts` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `outer_client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `balance_before` varchar(255) NOT NULL,
  `balance_after` varchar(255) NOT NULL,
  `store_id` int(11) NOT NULL,
  `details` text DEFAULT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `email_link` varchar(255) NOT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `whatsapp_message` varchar(255) NOT NULL,
  `whatsapp_number` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `email_link`, `facebook_link`, `whatsapp_message`, `whatsapp_number`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 'relaxationtime91@gmail.com', 'https://www.facebook.com', 'السلام عليكم', '+962799079938', 1, '2021-08-16 22:44:16', '2022-07-22 17:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `intro_movie`
--

CREATE TABLE `intro_movie` (
  `id` int(11) NOT NULL,
  `intro_movie` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `intro_movie`
--

INSERT INTO `intro_movie` (`id`, `intro_movie`, `created_at`, `updated_at`) VALUES
(1, 'uploads/intro/intro.mp4', '2021-08-15 12:17:11', '2021-11-02 15:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_bills`
--

CREATE TABLE `maintenance_bills` (
  `id` int(11) NOT NULL,
  `bill_id` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'تم الاستلام من العميل',
  `maintenance_device_id` int(11) NOT NULL,
  `engineer_id` int(11) DEFAULT NULL,
  `engineer_evaluation` varchar(255) NOT NULL,
  `maintenance_type` varchar(255) NOT NULL DEFAULT 'داخلية',
  `spare_parts_cost` varchar(255) NOT NULL DEFAULT '0',
  `maintenance_cost` varchar(255) NOT NULL DEFAULT '0',
  `total_cost` varchar(255) NOT NULL DEFAULT '0',
  `delegate_name` int(11) DEFAULT NULL,
  `maintenance_place` int(11) DEFAULT NULL,
  `repair_cost` varchar(255) NOT NULL DEFAULT '0',
  `delegate_cost` varchar(255) NOT NULL DEFAULT '0',
  `owner_approval` varchar(255) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_bills_elements`
--

CREATE TABLE `maintenance_bills_elements` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `maintenance_bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `quantity_price` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_devices`
--

CREATE TABLE `maintenance_devices` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL,
  `device_owner_name` varchar(255) NOT NULL,
  `device_owner_phone` varchar(255) NOT NULL,
  `device_owner_address` varchar(255) DEFAULT NULL,
  `receipt_number` varchar(255) NOT NULL,
  `received_date` date NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `device_type` int(11) NOT NULL,
  `device_serial` varchar(255) NOT NULL,
  `device_issue` int(11) NOT NULL,
  `device_pic` text DEFAULT NULL,
  `owner_complain` text DEFAULT NULL,
  `warranty` varchar(1) NOT NULL DEFAULT '1',
  `warranty_period` varchar(255) NOT NULL,
  `expected_delivery_date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `approximate_cost` varchar(255) NOT NULL,
  `status` text NOT NULL DEFAULT 'تم الاستلام من العميل',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenance_devices`
--

INSERT INTO `maintenance_devices` (`id`, `company_id`, `client_id`, `store_id`, `device_owner_name`, `device_owner_phone`, `device_owner_address`, `receipt_number`, `received_date`, `device_name`, `device_type`, `device_serial`, `device_issue`, `device_pic`, `owner_complain`, `warranty`, `warranty_period`, `expected_delivery_date`, `notes`, `approximate_cost`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 11, 7, 'اخمد', '12012', NULL, '1', '2022-10-24', '54525', 7, '2112', 5, NULL, NULL, '1', '3', '2022-10-28', NULL, '100', 'تم الاستلام من العميل', '2022-10-24 08:13:07', '2022-10-24 08:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_places`
--

CREATE TABLE `maintenance_places` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `place_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenance_places`
--

INSERT INTO `maintenance_places` (`id`, `company_id`, `client_id`, `place_name`, `created_at`, `updated_at`) VALUES
(4, 1, 11, 'المعرض', '2022-10-24 08:12:15', '2022-10-24 08:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Client', 11),
(1, 'App\\Models\\Client', 21);

-- --------------------------------------------------------

--
-- Table structure for table `outer_clients`
--

CREATE TABLE `outer_clients` (
  `id` int(100) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_category` varchar(255) NOT NULL,
  `prev_balance` varchar(255) NOT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `client_national` varchar(255) DEFAULT NULL,
  `tax_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `outer_clients`
--

INSERT INTO `outer_clients` (`id`, `company_id`, `client_name`, `client_category`, `prev_balance`, `shop_name`, `client_email`, `client_national`, `tax_number`, `created_at`, `updated_at`) VALUES
(7, 1, 'Cash', 'جملة', '4426', NULL, NULL, NULL, NULL, '2022-02-15 15:34:14', '2022-10-26 06:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `outer_client_address`
--

CREATE TABLE `outer_client_address` (
  `id` int(100) NOT NULL,
  `outer_client_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `outer_client_address`
--

INSERT INTO `outer_client_address` (`id`, `outer_client_id`, `company_id`, `client_address`, `created_at`, `updated_at`) VALUES
(6, 7, 1, NULL, '2022-10-26 06:35:39', '2022-10-26 06:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `outer_client_note`
--

CREATE TABLE `outer_client_note` (
  `id` int(100) NOT NULL,
  `outer_client_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `outer_client_note`
--

INSERT INTO `outer_client_note` (`id`, `outer_client_id`, `company_id`, `client_note`, `created_at`, `updated_at`) VALUES
(6, 7, 1, NULL, '2022-10-26 06:35:39', '2022-10-26 06:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `outer_client_phone`
--

CREATE TABLE `outer_client_phone` (
  `id` int(11) NOT NULL,
  `outer_client_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `outer_client_phone`
--

INSERT INTO `outer_client_phone` (`id`, `outer_client_id`, `company_id`, `client_phone`, `created_at`, `updated_at`) VALUES
(6, 7, 1, NULL, '2022-10-26 06:35:39', '2022-10-26 06:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `users_count` varchar(255) NOT NULL,
  `employees_count` varchar(255) NOT NULL,
  `outer_clients_count` varchar(255) NOT NULL,
  `suppliers_count` varchar(255) NOT NULL,
  `bills_count` varchar(255) NOT NULL,
  `products` varchar(1) NOT NULL DEFAULT '1',
  `debt` varchar(1) NOT NULL DEFAULT '1',
  `banks_safes` varchar(1) NOT NULL DEFAULT '1',
  `sales` varchar(1) NOT NULL DEFAULT '1',
  `purchases` varchar(1) NOT NULL DEFAULT '1',
  `finance` varchar(1) NOT NULL DEFAULT '1',
  `marketing` varchar(1) NOT NULL DEFAULT '1',
  `accounting` varchar(1) NOT NULL DEFAULT '1',
  `reports` varchar(1) NOT NULL DEFAULT '1',
  `settings` varchar(1) NOT NULL DEFAULT '1',
  `maintenance` varchar(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_name`, `users_count`, `employees_count`, `outer_clients_count`, `suppliers_count`, `bills_count`, `products`, `debt`, `banks_safes`, `sales`, `purchases`, `finance`, `marketing`, `accounting`, `reports`, `settings`, `maintenance`, `created_at`, `updated_at`) VALUES
(2, 'باقة الانطلاقة', '20', '10', '100', '100', '1000', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2021-10-05 14:37:36', '2021-10-05 14:50:23'),
(3, 'باقة النمو', '100', '50', '500', '500', '5000', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2021-10-05 19:35:18', '2021-10-05 19:35:35'),
(4, 'باقة الشاملة', 'غير محدود', 'غير محدود', 'غير محدود', 'غير محدود', 'غير محدود', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2021-10-05 19:35:18', '2021-10-05 19:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `name_en`, `key`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'صلاحيات المستخدمين', 'users roles', 'privilege', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(2, 'الاعدادات العامة للنظام', 'settings', 'settings', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(3, 'اضافة فرع جديد', 'add new branch', 'branch', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(4, 'قائمة فروع الشركة', 'view all branches', 'branch', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(5, 'اضافة مخزن جديد', 'add new store', 'store', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(6, 'قائمة مخازن الشركة', 'view all stores', 'store', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(7, 'اضافة خزينة جديد', 'add new safe', 'safe', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(8, 'قائمة خزائن الشركة', 'view all safes', 'safe', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(9, 'اضافة فئة جديد', 'add new category', 'category', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(10, 'قائمة فئات الشركة', 'view all categories', 'category', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(11, 'اضافة منتج جديد', 'add new product', 'product', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(12, 'قائمة المنتجات', 'view all products', 'product', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(14, 'اضافة عميل جديد', 'add new client', 'outer_client', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(15, 'قائمة العملاء الحاليين', 'view all clients', 'outer_client', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(16, 'فلترة العملاء ( بحث متقدم )', 'clients filter', 'outer_client', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(17, 'اضافة مورد جديد', 'add new supplier', 'supplier', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(18, 'قائمة الموردين الحاليين', 'view all suppliers', 'supplier', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(19, 'فلترة الموردين ( بحث متقدم )', 'suppliers filter', 'supplier', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(20, 'اضافة بنك جديد', 'add new bank', 'bank', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(21, 'قائمة البنوك الحاليين', 'view all banks', 'bank', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(22, 'سحب وايداع نقدى', 'withdraw - deposit', 'bank', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(23, 'تحويل بين البنوك', 'transfer between banks', 'bank', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(24, 'المصاريف الثابتة', 'fixed expenses', 'expense', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(25, 'تسجيل مصاريف جديدة', 'add new expense', 'expense', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(26, 'عرض المصاريف', 'view all expenses', 'expense', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(27, 'استلام نقدية من عميل', 'take cash from client', 'cash', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(28, 'دفع نقدى الى مورد', 'give cash to suplier', 'cash', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(29, 'اضافة مبلغ راس مال', 'add new capital', 'capital', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(30, 'مبالغ راس المال المضافة', 'view all capitals', 'capital', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(31, 'دفعات نقدية من العملاء', 'view all cash paymants from clients', 'payments', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(32, 'دفعات نقدية الى الموردين', 'view all cash paymants to suppliers', 'payments', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(33, 'اضافة هدية جديد', 'add new gift', 'gifts', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(34, 'عرض هدايا العملاء', 'view all gifts', 'gifts', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(35, 'ارسال ايميل الى عميل', 'send email to client', 'email', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(36, 'ارسال ايميل الى مورد', 'send email to supplier', 'email', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(37, 'اضافة عرض سعر جديد', 'add new quoatation', 'quotation', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(38, 'عروض الاسعار السابقة', 'view all quotations', 'quotation', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(39, 'اضافة فاتورة بيع جديدة', 'add new sale bill', 'sale_bill', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(40, 'فواتير البيع السابقة', 'view all sale bills', 'sale_bill', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(41, 'مرتجعات فواتير البيع عملاء', 'sale return bills', 'sale_bill', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(42, 'اضافة فاتورة مشتريات جديدة', 'add new buy bill', 'buy_bill', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(43, 'فواتير المشتريات السابقة', 'view all buy bills', 'buy_bill', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(44, 'مرتجعات فواتير المشتريات', 'buy return bills', 'buy_bill', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(45, 'كشف حساب العميل', 'client summary report', 'summary', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(46, 'كشف حساب المورد', 'supplier summary report', 'summary', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(47, 'دفتر اليومية', 'daily journal report', 'daily', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(48, 'تقارير عامة', 'general reports', 'reports', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(49, 'تعديل السعر في فاتورة البيع', 'edit price inside sale bill', 'sale_bill', 'client-web', '2021-07-09 19:14:58', '2021-07-09 19:14:58'),
(50, 'قسم الصيانة', 'maintenance department', 'maintenance', 'client-web', '2022-01-04 23:47:32', '2022-01-04 23:47:35'),
(51, 'تقرير مبيعات نقطة البيع', 'pos sales report', 'sale_bill', 'client-web', '2022-01-04 23:47:32', '2022-01-04 23:47:35'),
(52, 'نقطة البيع', 'POS Bills', 'sale_bill', 'client-web', '2022-01-04 23:47:32', '2022-01-04 23:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `pos_open`
--

CREATE TABLE `pos_open` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `outer_client_id` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  `shift_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_open`
--

INSERT INTO `pos_open` (`id`, `company_id`, `client_id`, `outer_client_id`, `notes`, `status`, `shift_id`, `created_at`, `updated_at`) VALUES
(593, 1, 21, 7, NULL, 'done', 165, '2022-04-02 19:42:33', '2022-04-02 19:42:38'),
(594, 1, 21, 7, NULL, 'done', 165, '2022-04-02 19:43:09', '2022-04-02 19:43:16'),
(1456, 1, 11, NULL, NULL, 'open', 385, '2022-10-24 01:11:29', '2022-10-24 01:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `pos_open_discount`
--

CREATE TABLE `pos_open_discount` (
  `id` int(11) NOT NULL,
  `pos_open_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `discount_type` varchar(255) NOT NULL,
  `discount_value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pos_open_elements`
--

CREATE TABLE `pos_open_elements` (
  `id` int(11) NOT NULL,
  `pos_open_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_unit_id` int(11) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `quantity_price` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_open_elements`
--

INSERT INTO `pos_open_elements` (`id`, `pos_open_id`, `company_id`, `product_id`, `product_unit_id`, `product_price`, `quantity`, `quantity_price`, `created_at`, `updated_at`) VALUES
(843, 593, 1, 713, 719, '1000', '2', '2000', '2022-04-02 19:42:33', '2022-04-02 19:42:35'),
(844, 594, 1, 713, 719, '1000', '4', '4000', '2022-04-02 19:43:09', '2022-04-02 19:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `pos_open_tax`
--

CREATE TABLE `pos_open_tax` (
  `id` int(11) NOT NULL,
  `pos_open_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `tax_id` int(11) NOT NULL,
  `tax_value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pos_serials`
--

CREATE TABLE `pos_serials` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `pos_open_id` int(11) NOT NULL,
  `pos_element_id` int(11) NOT NULL,
  `product_unit_id` int(11) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pos_settings`
--

CREATE TABLE `pos_settings` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `safe_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `discount` varchar(1) NOT NULL DEFAULT '1',
  `tax` varchar(1) NOT NULL DEFAULT '1',
  `suspension` varchar(1) NOT NULL DEFAULT '1',
  `payment` varchar(1) NOT NULL DEFAULT '1',
  `print_save` varchar(1) NOT NULL DEFAULT '1',
  `cancel` varchar(1) NOT NULL DEFAULT '1',
  `suspension_tab` varchar(1) NOT NULL DEFAULT '1',
  `edit_delete_tab` varchar(1) NOT NULL DEFAULT '1',
  `add_outer_client` varchar(1) NOT NULL DEFAULT '1',
  `add_product` varchar(1) NOT NULL DEFAULT '1',
  `fast_finish` varchar(1) NOT NULL DEFAULT '1',
  `product_image` varchar(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_settings`
--

INSERT INTO `pos_settings` (`id`, `company_id`, `branch_id`, `safe_id`, `bank_id`, `discount`, `tax`, `suspension`, `payment`, `print_save`, `cancel`, `suspension_tab`, `edit_delete_tab`, `add_outer_client`, `add_product`, `fast_finish`, `product_image`, `created_at`, `updated_at`) VALUES
(8, 1, 8, 12, 8, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2022-02-15 15:34:11', '2022-03-16 12:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `pos_shifts`
--

CREATE TABLE `pos_shifts` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `cashier_drawer_balance` varchar(255) NOT NULL,
  `previous_shift_balance` varchar(255) NOT NULL,
  `next_shift_balance` varchar(255) DEFAULT NULL,
  `difference_balance` varchar(255) NOT NULL,
  `actual_cash` varchar(255) DEFAULT NULL,
  `actual_bank` varchar(255) DEFAULT NULL,
  `safe_id` int(11) DEFAULT NULL,
  `transfer_safe_amount` varchar(255) DEFAULT NULL,
  `start_date_time` datetime NOT NULL,
  `end_date_time` datetime DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'open',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos_shifts`
--

INSERT INTO `pos_shifts` (`id`, `company_id`, `branch_id`, `client_id`, `cashier_drawer_balance`, `previous_shift_balance`, `next_shift_balance`, `difference_balance`, `actual_cash`, `actual_bank`, `safe_id`, `transfer_safe_amount`, `start_date_time`, `end_date_time`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(14, 1, 8, 11, '0', '0', '0', '0', '0', '0', 11, '0', '2022-02-21 21:14:44', '2022-03-04 16:25:42', 'closed', NULL, '2022-02-21 21:14:47', '2022-03-04 16:25:42'),
(32, 1, 8, 11, '0', '0', '0', '0', '0', '0', 11, '0', '2022-03-04 16:25:46', '2022-03-04 16:25:58', 'closed', NULL, '2022-03-04 16:25:48', '2022-03-04 16:25:58'),
(58, 1, 8, 11, '0', '0', '0', '0', '4600', '0', 11, '4600', '2022-03-09 16:53:03', '2022-03-30 03:37:52', 'closed', NULL, '2022-03-09 16:53:06', '2022-03-30 03:37:52'),
(149, 1, 8, 11, '0', '0', '0', '0', '0', '0', 11, '0', '2022-03-30 03:37:58', '2022-03-30 22:25:02', 'closed', NULL, '2022-03-30 03:38:22', '2022-03-30 22:25:02'),
(153, 1, 8, 11, '0', '0', '0', '0', '0', '0', 11, '0', '2022-03-30 22:25:30', '2022-10-22 11:26:45', 'closed', NULL, '2022-03-30 22:25:38', '2022-10-22 11:26:45'),
(165, 1, 8, 21, '0', '0', NULL, '0', NULL, NULL, NULL, NULL, '2022-04-02 19:42:25', NULL, 'open', NULL, '2022-04-02 19:42:28', '2022-04-02 19:42:28'),
(381, 1, 8, 11, '10', '0', '220', '-10', '1220', '0', 11, '1000', '2022-10-22 11:47:28', '2022-10-22 11:49:57', 'closed', NULL, '2022-10-22 11:47:40', '2022-10-22 11:49:57'),
(382, 1, 8, 11, '1', '220', '0', '219', '0', '0', 11, '0', '2022-10-22 11:57:22', '2022-10-23 14:11:44', 'closed', NULL, '2022-10-22 11:57:29', '2022-10-23 14:11:44'),
(383, 1, 8, 11, '0', '0', '0', '0', '0', '0', 11, '0', '2022-10-23 14:21:04', '2022-10-23 14:21:20', 'closed', NULL, '2022-10-23 14:21:09', '2022-10-23 14:21:20'),
(384, 1, 8, 11, '10', '0', '22', '-10', '22', '0', 11, '0', '2022-10-23 14:28:01', '2022-10-23 14:29:54', 'closed', NULL, '2022-10-23 14:28:06', '2022-10-23 14:29:54'),
(385, 1, 8, 11, '2', '22', NULL, '20', NULL, NULL, NULL, NULL, '2022-10-23 20:23:25', NULL, 'open', NULL, '2022-10-23 20:23:32', '2022-10-23 20:23:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `code_universal` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `product_pic` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `company_id`, `store_id`, `product_name`, `code_universal`, `category_id`, `sub_category_id`, `product_pic`, `description`, `color`, `expire_date`, `created_at`, `updated_at`) VALUES
(713, 1, 7, 'منتج 1', '100000001', 17, NULL, NULL, NULL, '#000000', NULL, '2022-03-01 22:19:36', '2022-03-01 22:19:36'),
(749, 1, 7, 'منتج 2', '100000002', 17, NULL, NULL, NULL, '#000000', NULL, '2022-06-05 11:21:32', '2022-06-05 11:21:32'),
(750, 1, 7, '123123', '10', 17, NULL, '/tmp/phpyYIEgL', NULL, '#000000', NULL, '2022-10-22 09:58:33', '2022-10-25 11:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `product_serials`
--

CREATE TABLE `product_serials` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_unit_id` int(11) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_unit`
--

CREATE TABLE `product_unit` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `first_balance` varchar(255) NOT NULL,
  `min_balance` varchar(255) NOT NULL,
  `purchasing_price` varchar(255) NOT NULL,
  `wholesale_price` varchar(255) NOT NULL,
  `sector_price` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_unit`
--

INSERT INTO `product_unit` (`id`, `company_id`, `product_id`, `unit_id`, `type`, `first_balance`, `min_balance`, `purchasing_price`, `wholesale_price`, `sector_price`, `created_at`, `updated_at`) VALUES
(719, 1, 713, 18, 'نعم', '1015', '10', '800', '1000', '1200', '2022-03-01 22:19:36', '2022-10-24 08:23:08'),
(761, 1, 749, 18, 'نعم', '98', '10', '100', '120', '140', '2022-06-05 11:21:32', '2022-10-25 16:51:37'),
(764, 1, 750, 18, 'نعم', '4', '0', '9', '10', '12', '2022-10-23 10:22:05', '2022-10-24 08:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `purchase_order_number` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders_elements`
--

CREATE TABLE `purchase_orders_elements` (
  `id` int(11) NOT NULL,
  `purchase_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `product_unit_id` int(11) NOT NULL,
  `quantity_price` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders_extra`
--

CREATE TABLE `purchase_orders_extra` (
  `id` int(11) NOT NULL,
  `purchase_order_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `action_type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `outer_client_id` int(11) NOT NULL,
  `quotation_number` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `company_id`, `client_id`, `outer_client_id`, `quotation_number`, `start_date`, `expiration_date`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 7, '1', '2022-10-23', '2022-10-23', NULL, '2022-10-23 14:06:52', '2022-10-23 14:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `quotations_elements`
--

CREATE TABLE `quotations_elements` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `product_unit_id` int(11) NOT NULL,
  `quantity_price` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quotations_elements`
--

INSERT INTO `quotations_elements` (`id`, `quotation_id`, `product_id`, `company_id`, `product_price`, `quantity`, `product_unit_id`, `quantity_price`, `created_at`, `updated_at`) VALUES
(1, 1, 713, 1, '1000', '1', 719, '1000', '2022-10-23 14:06:52', '2022-10-23 14:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `quotations_extra`
--

CREATE TABLE `quotations_extra` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `action_type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quotations_extra`
--

INSERT INTO `quotations_extra` (`id`, `quotation_id`, `company_id`, `action`, `action_type`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'discount', 'pound', '0', '2022-10-23 14:06:52', '2022-10-23 14:06:52'),
(2, 1, 1, 'extra', 'pound', '0', '2022-10-23 14:06:52', '2022-10-23 14:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 'مدير النظام', 'client-web', 1, '2022-02-15 15:34:14', '2022-02-15 15:34:14'),
(2, 'مستخدم', 'client-web', 1, '2022-02-15 15:34:15', '2022-02-15 15:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(6, 2),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(30, 1),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(36, 1),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2);

-- --------------------------------------------------------

--
-- Table structure for table `safes`
--

CREATE TABLE `safes` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `safe_name` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT 'main',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `safes`
--

INSERT INTO `safes` (`id`, `company_id`, `branch_id`, `safe_name`, `balance`, `type`, `created_at`, `updated_at`) VALUES
(11, 1, 8, 'الخزنة الرئيسية', '-11100', 'main', '2022-02-15 15:34:11', '2022-10-24 08:22:00'),
(12, 1, 8, 'درج كاشير الفرع الرئيسى', '-5200', 'cashier', '2022-02-15 15:34:11', '2022-10-24 08:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `safes_transfer`
--

CREATE TABLE `safes_transfer` (
  `id` int(100) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `from_safe` int(100) NOT NULL,
  `to_safe` int(100) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `safes_transfer`
--

INSERT INTO `safes_transfer` (`id`, `company_id`, `client_id`, `from_safe`, `to_safe`, `amount`, `reason`, `created_at`, `updated_at`) VALUES
(8, 1, 11, 11, 12, '400', 'no reason', '2022-06-06 04:19:25', '2022-06-06 04:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `safe_bank_transfer`
--

CREATE TABLE `safe_bank_transfer` (
  `id` int(100) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `safe_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales_serials`
--

CREATE TABLE `sales_serials` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `sale_bill_id` int(11) NOT NULL,
  `sale_element_id` int(11) NOT NULL,
  `product_unit_id` int(11) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sale_bills`
--

CREATE TABLE `sale_bills` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `outer_client_id` int(100) DEFAULT NULL,
  `sale_bill_number` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `final_total` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `rest` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_bills`
--

INSERT INTO `sale_bills` (`id`, `company_id`, `client_id`, `outer_client_id`, `sale_bill_number`, `date`, `time`, `notes`, `status`, `final_total`, `paid`, `rest`, `created_at`, `updated_at`) VALUES
(7, 1, 11, 7, 1, '2022-10-24', '08:22:57', NULL, 'done', '1150', '0', '1150', '2022-10-24 08:23:04', '2022-10-24 08:23:08'),
(8, 1, 11, 7, 2, '2022-10-25', '16:45:08', NULL, 'done', '138', '0', '138', '2022-10-25 16:45:20', '2022-10-25 16:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `sale_bill_elements`
--

CREATE TABLE `sale_bill_elements` (
  `id` int(11) NOT NULL,
  `sale_bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_unit_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `quantity_price` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_bill_elements`
--

INSERT INTO `sale_bill_elements` (`id`, `sale_bill_id`, `product_id`, `product_unit_id`, `company_id`, `product_price`, `quantity`, `quantity_price`, `created_at`, `updated_at`) VALUES
(8, 7, 713, 719, 1, '1000', '1', '1000', '2022-10-24 08:23:04', '2022-10-24 08:23:04'),
(9, 8, 749, 761, 1, '120', '1', '120', '2022-10-25 16:45:20', '2022-10-25 16:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `sale_bill_extra`
--

CREATE TABLE `sale_bill_extra` (
  `id` int(11) NOT NULL,
  `sale_bill_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `action_type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_bill_extra`
--

INSERT INTO `sale_bill_extra` (`id`, `sale_bill_id`, `company_id`, `action`, `action_type`, `value`, `created_at`, `updated_at`) VALUES
(13, 7, 1, 'extra', 'pound', '0', '2022-10-24 08:23:04', '2022-10-24 08:23:04'),
(14, 7, 1, 'discount', 'pound', '0', '2022-10-24 08:23:04', '2022-10-24 08:23:04'),
(15, 8, 1, 'discount', 'pound', '0', '2022-10-25 16:45:20', '2022-10-25 16:45:20'),
(16, 8, 1, 'extra', 'pound', '0', '2022-10-25 16:45:20', '2022-10-25 16:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `sale_bill_return`
--

CREATE TABLE `sale_bill_return` (
  `id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `outer_client_id` int(100) DEFAULT NULL,
  `balance_before` varchar(255) NOT NULL,
  `balance_after` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `quantity_price` varchar(255) NOT NULL,
  `return_quantity` varchar(255) NOT NULL,
  `before_return` varchar(255) NOT NULL,
  `after_return` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `products` varchar(1) NOT NULL DEFAULT '1',
  `debt` varchar(1) NOT NULL DEFAULT '1',
  `banks_safes` varchar(1) NOT NULL DEFAULT '1',
  `sales` varchar(1) NOT NULL DEFAULT '1',
  `purchases` varchar(1) NOT NULL DEFAULT '1',
  `finance` varchar(1) NOT NULL DEFAULT '1',
  `marketing` varchar(1) NOT NULL DEFAULT '1',
  `accounting` varchar(1) NOT NULL DEFAULT '1',
  `reports` varchar(1) NOT NULL DEFAULT '1',
  `settings` varchar(1) NOT NULL DEFAULT '1',
  `maintenance` varchar(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`id`, `company_id`, `branch_id`, `products`, `debt`, `banks_safes`, `sales`, `purchases`, `finance`, `marketing`, `accounting`, `reports`, `settings`, `maintenance`, `created_at`, `updated_at`) VALUES
(8, 1, 8, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2022-02-15 15:34:11', '2022-10-22 11:46:01');

-- --------------------------------------------------------

--
-- Table structure for table `shift_report`
--

CREATE TABLE `shift_report` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `shift_id` int(11) NOT NULL,
  `system_total` varchar(255) NOT NULL,
  `actual_total` varchar(255) NOT NULL,
  `difference_amount` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shift_report`
--

INSERT INTO `shift_report` (`id`, `company_id`, `branch_id`, `client_id`, `shift_id`, `system_total`, `actual_total`, `difference_amount`, `created_at`, `updated_at`) VALUES
(41, 1, 8, 11, 14, '0', '0', '0', '2022-03-04 16:21:04', '2022-03-04 16:21:04'),
(42, 1, 8, 11, 14, '0', '0', '0', '2022-03-04 16:25:42', '2022-03-04 16:25:42'),
(43, 1, 8, 11, 32, '0', '0', '0', '2022-03-04 16:25:58', '2022-03-04 16:25:58'),
(167, 1, 8, 11, 58, '4600', '4600', '0', '2022-03-30 03:37:52', '2022-03-30 03:37:52'),
(168, 1, 8, 11, 149, '0', '0', '0', '2022-03-30 22:25:02', '2022-03-30 22:25:02'),
(414, 1, 8, 11, 153, '0', '0', '0', '2022-10-22 11:26:45', '2022-10-22 11:26:45'),
(415, 1, 8, 11, 381, '1210', '1220', '10', '2022-10-22 11:49:57', '2022-10-22 11:49:57'),
(416, 1, 8, 11, 382, '1', '0', '-1', '2022-10-23 14:11:44', '2022-10-23 14:11:44'),
(417, 1, 8, 11, 383, '0', '0', '0', '2022-10-23 14:21:20', '2022-10-23 14:21:20'),
(418, 1, 8, 11, 384, '22', '22', '0', '2022-10-23 14:29:54', '2022-10-23 14:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `company_id`, `branch_id`, `store_name`, `created_at`, `updated_at`) VALUES
(7, 1, 8, 'المخزن الرئيسى', '2022-02-15 15:34:11', '2022-02-15 15:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `stores_transfer`
--

CREATE TABLE `stores_transfer` (
  `id` int(100) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `from_store` int(11) NOT NULL,
  `to_store` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `type_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `company_id`, `type_id`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 1, '2022-02-15', '2222-03-01', 'active', '2022-02-15 15:34:09', '2022-03-01 05:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `company_id`, `category_id`, `sub_category_name`, `created_at`, `updated_at`) VALUES
(18, 1, 17, 'مخزون بتاريخ انتهاء', '2022-02-15 15:34:11', '2022-02-15 15:34:11'),
(19, 1, 17, 'مخزون بسيريال نمبر', '2022-02-15 15:34:11', '2022-02-15 15:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(100) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_category` varchar(255) NOT NULL,
  `prev_balance` varchar(255) NOT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `supplier_email` varchar(255) DEFAULT NULL,
  `supplier_national` varchar(255) DEFAULT NULL,
  `tax_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `company_id`, `supplier_name`, `supplier_category`, `prev_balance`, `shop_name`, `supplier_email`, `supplier_national`, `tax_number`, `created_at`, `updated_at`) VALUES
(6, 1, 'Cash', 'جملة', '0', NULL, NULL, NULL, NULL, '2022-02-15 15:34:14', '2022-02-15 15:34:14');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_address`
--

CREATE TABLE `supplier_address` (
  `id` int(100) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_note`
--

CREATE TABLE `supplier_note` (
  `id` int(100) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_phone`
--

CREATE TABLE `supplier_phone` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `table_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `table_name`) VALUES
(1, 'subscriptions'),
(2, 'basic_settings'),
(3, 'extra_settings'),
(4, 'branches'),
(5, 'stores'),
(6, 'safes'),
(7, 'categories'),
(8, 'clients'),
(9, 'client_profiles'),
(10, 'suppliers'),
(11, 'supplier_address'),
(12, 'supplier_note'),
(13, 'supplier_phone'),
(14, 'outer_clients'),
(15, 'outer_client_address'),
(16, 'outer_client_note'),
(17, 'outer_client_phone'),
(18, 'banks'),
(19, 'products'),
(20, 'capitals'),
(21, 'employees'),
(22, 'employees_cash'),
(23, 'gifts'),
(24, 'payments'),
(25, 'fixed_expenses'),
(26, 'expenses'),
(27, 'bank_safe_transfer'),
(28, 'safe_bank_transfer'),
(29, 'banks_modifications'),
(30, 'banks_process'),
(31, 'banks_transfer'),
(32, 'buy_bills'),
(33, 'buy_bill_elements'),
(34, 'buy_bill_extra'),
(35, 'buy_bill_return'),
(36, 'buy_cash'),
(37, 'bank_buy_cash'),
(38, 'sale_bills'),
(39, 'sale_bill_elements'),
(40, 'sale_bill_extra'),
(41, 'sale_bill_return'),
(42, 'cash'),
(43, 'bank_cash'),
(44, 'quotations'),
(45, 'quotations_elements'),
(46, 'quotations_extra'),
(47, 'screens'),
(48, 'purchase_orders'),
(49, 'purchase_orders_elements'),
(50, 'purchase_orders_extra'),
(51, 'units'),
(52, 'pos_open'),
(53, 'pos_open_discount'),
(54, 'pos_open_elements'),
(55, 'pos_open_tax');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `tax_name` varchar(255) NOT NULL,
  `tax_value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `company_id`, `client_id`, `tax_name`, `tax_value`, `created_at`, `updated_at`) VALUES
(3, 1, 11, 'ضريبة القيمة المضافة', '15', '2022-03-13 02:32:32', '2022-03-13 02:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` int(11) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `timezone`, `name_ar`, `name_en`) VALUES
(1, 'Africa/Nouakchott', 'موريتانيا', 'Mauritania'),
(2, 'Africa/Tripoli', 'ليبيا', 'libya'),
(3, 'Africa/Tunis', 'تونس', 'tunisia'),
(4, 'Africa/Algiers', 'الجزائر', 'algeria'),
(5, 'Africa/Khartoum', 'السودان', 'sudan'),
(6, 'Africa/Casablanca', 'المغرب', 'Morocco'),
(7, 'Asia/Baghdad', 'العراق', 'Iraq'),
(8, 'Asia/Riyadh', 'السعودية', 'Saudi Arabia'),
(9, 'Asia/Bahrain', 'البحرين', 'bahrain'),
(10, 'Asia/Beirut', 'لبنان', 'lebanon'),
(11, 'Asia/Gaza', 'فلسطين', 'palastine'),
(12, 'Asia/Qatar', 'قطر', 'qatar'),
(13, 'Asia/Dubai', 'الامارات', 'UAE'),
(14, 'Asia/Amman', 'الاردن', 'Jordan'),
(15, 'Asia/Damascus', 'سوريا', 'Syria'),
(16, 'Asia/Kuwait', 'الكويت', 'Kuwait'),
(17, 'Asia/Muscat', 'سلطنة عمان', 'oman'),
(18, 'Africa/Cairo', 'مصر', 'Egypt');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_price` varchar(255) NOT NULL,
  `period` varchar(255) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `type_name`, `type_price`, `period`, `package_id`, `created_at`, `updated_at`) VALUES
(1, 'تجربة', '0', '14', NULL, '2021-08-18 14:52:16', '2021-08-18 14:52:16'),
(2, 'شهرى', '100', '30', 2, '2021-10-05 15:07:41', '2021-12-04 21:26:21'),
(3, 'سنوي', '0', '365', 4, '2021-10-30 15:07:46', '2022-02-14 14:08:28'),
(4, 'شهري', '120', '30', 4, '2021-11-06 02:34:00', '2021-12-04 21:27:18');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `company_id`, `unit_name`, `created_at`, `updated_at`) VALUES
(16, 1, 'كيلو', '2022-02-15 15:34:09', '2022-02-15 15:34:09'),
(17, 1, 'طن', '2022-02-15 15:34:09', '2022-02-15 15:34:09'),
(18, 1, 'وحدة', '2022-02-15 15:34:09', '2022-02-15 15:34:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_api_token_unique` (`api_token`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`);

--
-- Indexes for table `admin_profiles`
--
ALTER TABLE `admin_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_profiles_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_id_80` (`company_id`);

--
-- Indexes for table `banks_modifications`
--
ALTER TABLE `banks_modifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bank_id` (`bank_id`),
  ADD KEY `fk_client_id` (`client_id`),
  ADD KEY `fk_company_id_21` (`company_id`);

--
-- Indexes for table `banks_process`
--
ALTER TABLE `banks_process`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bank_id_2` (`bank_id`),
  ADD KEY `fk_client_id_2` (`client_id`),
  ADD KEY `fk_company_id_19` (`company_id`);

--
-- Indexes for table `banks_transfer`
--
ALTER TABLE `banks_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_client_id_4` (`client_id`),
  ADD KEY `fk_company_id_22` (`company_id`),
  ADD KEY `fk_deposit_bank` (`deposit_bank`),
  ADD KEY `fk_withdrawal_bank` (`withdrawal_bank`);

--
-- Indexes for table `bank_buy_cash`
--
ALTER TABLE `bank_buy_cash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_client_id_8` (`client_id`),
  ADD KEY `fk_company_id_27` (`company_id`),
  ADD KEY `fk_safe_id_3` (`bank_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `bank_cash`
--
ALTER TABLE `bank_cash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_10` (`company_id`),
  ADD KEY `client_id_10` (`client_id`),
  ADD KEY `bank_id_10` (`bank_id`),
  ADD KEY `outer_client_id_10` (`outer_client_id`);

--
-- Indexes for table `bank_safe_transfer`
--
ALTER TABLE `bank_safe_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_72` (`company_id`),
  ADD KEY `client_id_72` (`client_id`),
  ADD KEY `bank_id_72` (`bank_id`),
  ADD KEY `safe_id_72` (`safe_id`);

--
-- Indexes for table `basic_settings`
--
ALTER TABLE `basic_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_id_4` (`company_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_id` (`company_id`);

--
-- Indexes for table `buy_bills`
--
ALTER TABLE `buy_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_client_id_102` (`client_id`),
  ADD KEY `fk_company_id_322` (`company_id`),
  ADD KEY `fk_supplier_id_322` (`supplier_id`);

--
-- Indexes for table `buy_bill_elements`
--
ALTER TABLE `buy_bill_elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buy_bill_id` (`buy_bill_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `company_id_234` (`company_id`),
  ADD KEY `product_unit_id_4` (`product_unit_id`);

--
-- Indexes for table `buy_bill_extra`
--
ALTER TABLE `buy_bill_extra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buy_bill_id_2` (`buy_bill_id`),
  ADD KEY `company_id_235` (`company_id`);

--
-- Indexes for table `buy_bill_return`
--
ALTER TABLE `buy_bill_return`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id_80` (`client_id`),
  ADD KEY `company_id_80` (`company_id`),
  ADD KEY `buy_bill_id_80` (`bill_id`),
  ADD KEY `product_id_80` (`product_id`),
  ADD KEY `supplier_id_90` (`supplier_id`);

--
-- Indexes for table `buy_cash`
--
ALTER TABLE `buy_cash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_client_id_8` (`client_id`),
  ADD KEY `fk_company_id_27` (`company_id`),
  ADD KEY `fk_safe_id_3` (`safe_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `buy_serials`
--
ALTER TABLE `buy_serials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_serial_buy` (`company_id`),
  ADD KEY `client_id_serial_buy` (`client_id`),
  ADD KEY `buy_bill_id_serial_buy` (`buy_bill_id`),
  ADD KEY `buy_element_id_serial_buy` (`buy_element_id`),
  ADD KEY `product_unit_id_serial_buy` (`product_unit_id`);

--
-- Indexes for table `capitals`
--
ALTER TABLE `capitals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_id_30` (`company_id`),
  ADD KEY `fk_safe_id_6` (`safe_id`),
  ADD KEY `client_id_23` (`client_id`);

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_client_id_7` (`client_id`),
  ADD KEY `fk_company_id_26` (`company_id`),
  ADD KEY `fk_safe_id_2` (`safe_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_id_8` (`company_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`),
  ADD UNIQUE KEY `clients_api_token_unique` (`api_token`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD KEY `clients_company_id_foreign` (`company_id`),
  ADD KEY `branch_id_fk_12` (`branch_id`);

--
-- Indexes for table `client_profiles`
--
ALTER TABLE `client_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_profiles_client_id_foreign` (`client_id`),
  ADD KEY `company_id_221` (`company_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_cash`
--
ALTER TABLE `coupon_cash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_91` (`company_id`),
  ADD KEY `client_id_91` (`client_id`),
  ADD KEY `outer_client_id_91` (`outer_client_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_90` (`company_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `outer_client_id_90` (`outer_client_id`),
  ADD KEY `category_id_90` (`category_id`),
  ADD KEY `product_id_90` (`product_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `delegates`
--
ALTER TABLE `delegates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_del` (`company_id`),
  ADD KEY `client_id_del` (`client_id`);

--
-- Indexes for table `devices_issues`
--
ALTER TABLE `devices_issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_dev_iss` (`company_id`),
  ADD KEY `client_id_dev_iss` (`client_id`);

--
-- Indexes for table `devices_types`
--
ALTER TABLE `devices_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_dev` (`company_id`),
  ADD KEY `client_id_dev` (`client_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_70` (`company_id`),
  ADD KEY `client_id_70` (`client_id`);

--
-- Indexes for table `employees_cash`
--
ALTER TABLE `employees_cash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_71` (`company_id`),
  ADD KEY `client_id_71` (`client_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `safe_id_71` (`safe_id`);

--
-- Indexes for table `engineers`
--
ALTER TABLE `engineers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_eng` (`company_id`),
  ADD KEY `client_id_eng` (`client_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_client_id_6` (`client_id`),
  ADD KEY `fk_company_id_25` (`company_id`),
  ADD KEY `fk_safe_id` (`safe_id`),
  ADD KEY `fixed_expense` (`fixed_expense`),
  ADD KEY `employee_id_11` (`employee_id`),
  ADD KEY `fk_bank_id_121` (`bank_id`);

--
-- Indexes for table `extra_settings`
--
ALTER TABLE `extra_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_id_7` (`company_id`);

--
-- Indexes for table `fixed_expenses`
--
ALTER TABLE `fixed_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_client_id_5` (`client_id`),
  ADD KEY `fk_company_id_24` (`company_id`);

--
-- Indexes for table `gifts`
--
ALTER TABLE `gifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_id_31` (`company_id`),
  ADD KEY `fk_outer_client_5` (`outer_client_id`),
  ADD KEY `fk_product_id_4` (`product_id`),
  ADD KEY `fk_store_id_2` (`store_id`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id_4` (`admin_id`);

--
-- Indexes for table `intro_movie`
--
ALTER TABLE `intro_movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance_bills`
--
ALTER TABLE `maintenance_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_main_bill` (`company_id`),
  ADD KEY `client_id_main_bill` (`client_id`),
  ADD KEY `maintenance_device_id_main_bill` (`maintenance_device_id`),
  ADD KEY `engineer_id_main_bill` (`engineer_id`),
  ADD KEY `delegate_name` (`delegate_name`),
  ADD KEY `maintenance_place` (`maintenance_place`);

--
-- Indexes for table `maintenance_bills_elements`
--
ALTER TABLE `maintenance_bills_elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_bill_id` (`maintenance_bill_id`),
  ADD KEY `company_id_main_bill_elem` (`company_id`),
  ADD KEY `product_id_main_bill_elem` (`product_id`);

--
-- Indexes for table `maintenance_devices`
--
ALTER TABLE `maintenance_devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_main` (`company_id`),
  ADD KEY `client_id_main` (`client_id`),
  ADD KEY `store_id_main` (`store_id`),
  ADD KEY `device_type` (`device_type`),
  ADD KEY `device_issue` (`device_issue`);

--
-- Indexes for table `maintenance_places`
--
ALTER TABLE `maintenance_places`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_place` (`company_id`),
  ADD KEY `client_id_place` (`client_id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `outer_clients`
--
ALTER TABLE `outer_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_id_16` (`company_id`);

--
-- Indexes for table `outer_client_address`
--
ALTER TABLE `outer_client_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `outer_client_id_80` (`outer_client_id`),
  ADD KEY `company_id_240` (`company_id`);

--
-- Indexes for table `outer_client_note`
--
ALTER TABLE `outer_client_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_outer_client_id_2` (`outer_client_id`),
  ADD KEY `company_id_242` (`company_id`);

--
-- Indexes for table `outer_client_phone`
--
ALTER TABLE `outer_client_phone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_outer_client_id` (`outer_client_id`),
  ADD KEY `company_id_241` (`company_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_787` (`company_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_open`
--
ALTER TABLE `pos_open`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_84` (`company_id`),
  ADD KEY `client_id_84` (`client_id`),
  ADD KEY `outer_client_id` (`outer_client_id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Indexes for table `pos_open_discount`
--
ALTER TABLE `pos_open_discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_bill_id_2` (`pos_open_id`),
  ADD KEY `company_id_233` (`company_id`);

--
-- Indexes for table `pos_open_elements`
--
ALTER TABLE `pos_open_elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id_7` (`product_id`),
  ADD KEY `sale_bill_id` (`pos_open_id`),
  ADD KEY `company_id_234` (`company_id`),
  ADD KEY `product_unit_id` (`product_unit_id`);

--
-- Indexes for table `pos_open_tax`
--
ALTER TABLE `pos_open_tax`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_bill_id_2` (`pos_open_id`),
  ADD KEY `tax_id` (`tax_id`),
  ADD KEY `company_id_235` (`company_id`);

--
-- Indexes for table `pos_serials`
--
ALTER TABLE `pos_serials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pos_open_id_serial_pos` (`pos_open_id`),
  ADD KEY `pos_element_id_serial_pos` (`pos_element_id`),
  ADD KEY `product_unit_id_serial_pos` (`product_unit_id`),
  ADD KEY `company_id_serial_pos` (`company_id`),
  ADD KEY `client_id_serial_pos` (`client_id`);

--
-- Indexes for table `pos_settings`
--
ALTER TABLE `pos_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_133` (`company_id`),
  ADD KEY `branch_id_fk_259` (`branch_id`),
  ADD KEY `bank_id_fk_89` (`bank_id`),
  ADD KEY `safe_id_fk_89` (`safe_id`);

--
-- Indexes for table `pos_shifts`
--
ALTER TABLE `pos_shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_pos` (`company_id`),
  ADD KEY `client_id_pos` (`client_id`),
  ADD KEY `branch_id_pos` (`branch_id`),
  ADD KEY `safe_id_sh` (`safe_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_id` (`category_id`),
  ADD KEY `fk_company_id_9` (`company_id`),
  ADD KEY `fk_store_id` (`store_id`),
  ADD KEY `fk_sub_category_id` (`sub_category_id`);

--
-- Indexes for table `product_serials`
--
ALTER TABLE `product_serials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_serial` (`company_id`),
  ADD KEY `client_id_serial` (`client_id`),
  ADD KEY `product_serial` (`product_id`),
  ADD KEY `product_unit_id_serial` (`product_unit_id`);

--
-- Indexes for table `product_unit`
--
ALTER TABLE `product_unit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id_fk_20` (`product_id`),
  ADD KEY `unit_id_fk_20` (`unit_id`),
  ADD KEY `company_id_fk_900` (`company_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_id_121` (`company_id`),
  ADD KEY `fk_client_id_121` (`client_id`),
  ADD KEY `fk_supplier_id_121` (`supplier_id`);

--
-- Indexes for table `purchase_orders_elements`
--
ALTER TABLE `purchase_orders_elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comany_id_432` (`company_id`),
  ADD KEY `product_id_432` (`product_id`),
  ADD KEY `purchase_order_id` (`purchase_order_id`),
  ADD KEY `product_unit_id_5` (`product_unit_id`);

--
-- Indexes for table `purchase_orders_extra`
--
ALTER TABLE `purchase_orders_extra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_435` (`company_id`),
  ADD KEY `purchase_order_id_2` (`purchase_order_id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_client_id_10` (`client_id`),
  ADD KEY `fk_company_id_32` (`company_id`),
  ADD KEY `fk_outer_client_id_4` (`outer_client_id`);

--
-- Indexes for table `quotations_elements`
--
ALTER TABLE `quotations_elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_id_3` (`product_id`),
  ADD KEY `fk_quotation_id` (`quotation_id`),
  ADD KEY `company_id_238` (`company_id`),
  ADD KEY `product_unit_id_3` (`product_unit_id`);

--
-- Indexes for table `quotations_extra`
--
ALTER TABLE `quotations_extra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_quotation_id_2` (`quotation_id`),
  ADD KEY `company_id_239` (`company_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_id_40` (`company_id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `safes`
--
ALTER TABLE `safes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_branch_id_2` (`branch_id`),
  ADD KEY `fk_company_id_3` (`company_id`);

--
-- Indexes for table `safes_transfer`
--
ALTER TABLE `safes_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_73` (`company_id`),
  ADD KEY `client_id_73` (`client_id`),
  ADD KEY `from_safe` (`from_safe`),
  ADD KEY `to_safe` (`to_safe`);

--
-- Indexes for table `safe_bank_transfer`
--
ALTER TABLE `safe_bank_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_73` (`company_id`),
  ADD KEY `client_id_73` (`client_id`),
  ADD KEY `safe_id_73` (`safe_id`),
  ADD KEY `bank_id_73` (`bank_id`);

--
-- Indexes for table `sales_serials`
--
ALTER TABLE `sales_serials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_serial_sales` (`company_id`),
  ADD KEY `client_id_serial_sales` (`client_id`),
  ADD KEY `sale_bill_id_serial_sales` (`sale_bill_id`),
  ADD KEY `sale_element_id_serial_sales` (`sale_element_id`),
  ADD KEY `product_unit_id_serial_sales` (`product_unit_id`);

--
-- Indexes for table `sale_bills`
--
ALTER TABLE `sale_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_30` (`company_id`),
  ADD KEY `client_id_30` (`client_id`);

--
-- Indexes for table `sale_bill_elements`
--
ALTER TABLE `sale_bill_elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_bill_id_30` (`sale_bill_id`),
  ADD KEY `product_id_30` (`product_id`),
  ADD KEY `company_id_236` (`company_id`),
  ADD KEY `product_unit_id_2` (`product_unit_id`);

--
-- Indexes for table `sale_bill_extra`
--
ALTER TABLE `sale_bill_extra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_bill_id_31` (`sale_bill_id`),
  ADD KEY `company_id_237` (`company_id`);

--
-- Indexes for table `sale_bill_return`
--
ALTER TABLE `sale_bill_return`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id_31` (`bill_id`),
  ADD KEY `company_id_31` (`company_id`),
  ADD KEY `client_id_31` (`client_id`),
  ADD KEY `outer_client_id_31` (`outer_client_id`),
  ADD KEY `product_id_31` (`product_id`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_133` (`company_id`),
  ADD KEY `branch_id_fk_16` (`branch_id`);

--
-- Indexes for table `shift_report`
--
ALTER TABLE `shift_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_sh` (`company_id`),
  ADD KEY `client_id_sh` (`client_id`),
  ADD KEY `branch_id_sh` (`branch_id`),
  ADD KEY `shift_id_sh` (`shift_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_branch_id` (`branch_id`),
  ADD KEY `fk_company_id_2` (`company_id`);

--
-- Indexes for table `stores_transfer`
--
ALTER TABLE `stores_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_fk_13` (`company_id`),
  ADD KEY `from_store_fk_13` (`from_store`),
  ADD KEY `to_store_fk_13` (`to_store`),
  ADD KEY `product_id_fk_13` (`product_id`),
  ADD KEY `client_id_fk_13` (`client_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_sjarb_id` (`company_id`),
  ADD KEY `type_sjarb_id` (`type_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_id_8` (`company_id`),
  ADD KEY `category_id_11` (`category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_company_id_18` (`company_id`);

--
-- Indexes for table `supplier_address`
--
ALTER TABLE `supplier_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id_80` (`supplier_id`),
  ADD KEY `company_id_222` (`company_id`);

--
-- Indexes for table `supplier_note`
--
ALTER TABLE `supplier_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_supplier_id` (`supplier_id`),
  ADD KEY `company_id_224` (`company_id`);

--
-- Indexes for table `supplier_phone`
--
ALTER TABLE `supplier_phone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_supplier_id_2` (`supplier_id`),
  ADD KEY `company_id_223` (`company_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_83` (`company_id`),
  ADD KEY `client_id_83` (`client_id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id_500` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_profiles`
--
ALTER TABLE `admin_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `banks_modifications`
--
ALTER TABLE `banks_modifications`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banks_process`
--
ALTER TABLE `banks_process`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks_transfer`
--
ALTER TABLE `banks_transfer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank_buy_cash`
--
ALTER TABLE `bank_buy_cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_cash`
--
ALTER TABLE `bank_cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_safe_transfer`
--
ALTER TABLE `bank_safe_transfer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `basic_settings`
--
ALTER TABLE `basic_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `buy_bills`
--
ALTER TABLE `buy_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `buy_bill_elements`
--
ALTER TABLE `buy_bill_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `buy_bill_extra`
--
ALTER TABLE `buy_bill_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `buy_bill_return`
--
ALTER TABLE `buy_bill_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy_cash`
--
ALTER TABLE `buy_cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buy_serials`
--
ALTER TABLE `buy_serials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `capitals`
--
ALTER TABLE `capitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=658;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `client_profiles`
--
ALTER TABLE `client_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupon_cash`
--
ALTER TABLE `coupon_cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `delegates`
--
ALTER TABLE `delegates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `devices_issues`
--
ALTER TABLE `devices_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `devices_types`
--
ALTER TABLE `devices_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees_cash`
--
ALTER TABLE `employees_cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `engineers`
--
ALTER TABLE `engineers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `extra_settings`
--
ALTER TABLE `extra_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fixed_expenses`
--
ALTER TABLE `fixed_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `gifts`
--
ALTER TABLE `gifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `intro_movie`
--
ALTER TABLE `intro_movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maintenance_bills`
--
ALTER TABLE `maintenance_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `maintenance_bills_elements`
--
ALTER TABLE `maintenance_bills_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `maintenance_devices`
--
ALTER TABLE `maintenance_devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `maintenance_places`
--
ALTER TABLE `maintenance_places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `outer_clients`
--
ALTER TABLE `outer_clients`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `outer_client_address`
--
ALTER TABLE `outer_client_address`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `outer_client_note`
--
ALTER TABLE `outer_client_note`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `outer_client_phone`
--
ALTER TABLE `outer_client_phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `pos_open`
--
ALTER TABLE `pos_open`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1457;

--
-- AUTO_INCREMENT for table `pos_open_discount`
--
ALTER TABLE `pos_open_discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pos_open_elements`
--
ALTER TABLE `pos_open_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1827;

--
-- AUTO_INCREMENT for table `pos_open_tax`
--
ALTER TABLE `pos_open_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pos_serials`
--
ALTER TABLE `pos_serials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pos_settings`
--
ALTER TABLE `pos_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pos_shifts`
--
ALTER TABLE `pos_shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=752;

--
-- AUTO_INCREMENT for table `product_serials`
--
ALTER TABLE `product_serials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_unit`
--
ALTER TABLE `product_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=766;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_orders_elements`
--
ALTER TABLE `purchase_orders_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_orders_extra`
--
ALTER TABLE `purchase_orders_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotations_elements`
--
ALTER TABLE `quotations_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotations_extra`
--
ALTER TABLE `quotations_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `safes`
--
ALTER TABLE `safes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `safes_transfer`
--
ALTER TABLE `safes_transfer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `safe_bank_transfer`
--
ALTER TABLE `safe_bank_transfer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales_serials`
--
ALTER TABLE `sales_serials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_bills`
--
ALTER TABLE `sale_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sale_bill_elements`
--
ALTER TABLE `sale_bill_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sale_bill_extra`
--
ALTER TABLE `sale_bill_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sale_bill_return`
--
ALTER TABLE `sale_bill_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `shift_report`
--
ALTER TABLE `shift_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `stores_transfer`
--
ALTER TABLE `stores_transfer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `supplier_address`
--
ALTER TABLE `supplier_address`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_note`
--
ALTER TABLE `supplier_note`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier_phone`
--
ALTER TABLE `supplier_phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_profiles`
--
ALTER TABLE `admin_profiles`
  ADD CONSTRAINT `admin_profiles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banks`
--
ALTER TABLE `banks`
  ADD CONSTRAINT `fk_company_id_80` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banks_modifications`
--
ALTER TABLE `banks_modifications`
  ADD CONSTRAINT `fk_bank_id` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_id_21` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banks_process`
--
ALTER TABLE `banks_process`
  ADD CONSTRAINT `fk_bank_id_2` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_client_id_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_id_19` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banks_transfer`
--
ALTER TABLE `banks_transfer`
  ADD CONSTRAINT `fk_client_id_4` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_id_22` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_deposit_bank` FOREIGN KEY (`deposit_bank`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_withdrawal_bank` FOREIGN KEY (`withdrawal_bank`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank_buy_cash`
--
ALTER TABLE `bank_buy_cash`
  ADD CONSTRAINT `fk_bank_id_33` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_client_id_88` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_id_277` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_id_88` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank_cash`
--
ALTER TABLE `bank_cash`
  ADD CONSTRAINT `bank_id_10` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_id_10` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_10` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `outer_client_id_10` FOREIGN KEY (`outer_client_id`) REFERENCES `outer_clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank_safe_transfer`
--
ALTER TABLE `bank_safe_transfer`
  ADD CONSTRAINT `bank_id_72` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_id_72` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_72` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `safe_id_72` FOREIGN KEY (`safe_id`) REFERENCES `safes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `basic_settings`
--
ALTER TABLE `basic_settings`
  ADD CONSTRAINT `fk_company_id_4` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `fk_company_id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buy_bills`
--
ALTER TABLE `buy_bills`
  ADD CONSTRAINT `fk_client_id_102` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_id_322` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_supplier_id_322` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_supplier_id_42` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buy_bill_elements`
--
ALTER TABLE `buy_bill_elements`
  ADD CONSTRAINT `buy_bill_id` FOREIGN KEY (`buy_bill_id`) REFERENCES `buy_bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_234` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_unit_id_4` FOREIGN KEY (`product_unit_id`) REFERENCES `product_unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buy_bill_extra`
--
ALTER TABLE `buy_bill_extra`
  ADD CONSTRAINT `buy_bill_id_2` FOREIGN KEY (`buy_bill_id`) REFERENCES `buy_bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_235` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buy_bill_return`
--
ALTER TABLE `buy_bill_return`
  ADD CONSTRAINT `buy_bill_id_80` FOREIGN KEY (`bill_id`) REFERENCES `buy_bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_id_80` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_80` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id_80` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_id_90` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buy_cash`
--
ALTER TABLE `buy_cash`
  ADD CONSTRAINT `fk_client_id_8` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_id_27` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_safe_id_3` FOREIGN KEY (`safe_id`) REFERENCES `safes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buy_serials`
--
ALTER TABLE `buy_serials`
  ADD CONSTRAINT `buy_bill_id_serial_buy` FOREIGN KEY (`buy_bill_id`) REFERENCES `buy_bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buy_element_id_serial_buy` FOREIGN KEY (`buy_element_id`) REFERENCES `buy_bill_elements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_id_serial_buy` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_serial_buy` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_unit_id_serial_buy` FOREIGN KEY (`product_unit_id`) REFERENCES `product_unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `capitals`
--
ALTER TABLE `capitals`
  ADD CONSTRAINT `client_id_23` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_id_30` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_safe_id_6` FOREIGN KEY (`safe_id`) REFERENCES `safes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cash`
--
ALTER TABLE `cash`
  ADD CONSTRAINT `fk_client_id_7` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_id_26` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_safe_id_2` FOREIGN KEY (`safe_id`) REFERENCES `safes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_company_id_8` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `branch_id_fk_12` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clients_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_profiles`
--
ALTER TABLE `client_profiles`
  ADD CONSTRAINT `client_profiles_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_221` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coupon_cash`
--
ALTER TABLE `coupon_cash`
  ADD CONSTRAINT `client_id_91` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_91` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coupon_id` FOREIGN KEY (`coupon_id`) REFERENCES `coupon_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `outer_client_id_91` FOREIGN KEY (`outer_client_id`) REFERENCES `outer_clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  ADD CONSTRAINT `category_id_90` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_90` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `outer_client_id_90` FOREIGN KEY (`outer_client_id`) REFERENCES `outer_clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id_90` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `delegates`
--
ALTER TABLE `delegates`
  ADD CONSTRAINT `client_id_del` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_del` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `devices_issues`
--
ALTER TABLE `devices_issues`
  ADD CONSTRAINT `client_id_dev_iss` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_dev_iss` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `devices_types`
--
ALTER TABLE `devices_types`
  ADD CONSTRAINT `client_id_dev` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_dev` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `client_id_70` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_70` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees_cash`
--
ALTER TABLE `employees_cash`
  ADD CONSTRAINT `client_id_71` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_71` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `safe_id_71` FOREIGN KEY (`safe_id`) REFERENCES `safes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `engineers`
--
ALTER TABLE `engineers`
  ADD CONSTRAINT `client_id_eng` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_eng` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `employee_id_11` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fixed_expense` FOREIGN KEY (`fixed_expense`) REFERENCES `fixed_expenses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bank_id_121` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_client_id_6` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_id_25` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_safe_id` FOREIGN KEY (`safe_id`) REFERENCES `safes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `extra_settings`
--
ALTER TABLE `extra_settings`
  ADD CONSTRAINT `fk_company_id_7` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fixed_expenses`
--
ALTER TABLE `fixed_expenses`
  ADD CONSTRAINT `fk_client_id_5` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_company_id_24` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gifts`
--
ALTER TABLE `gifts`
  ADD CONSTRAINT `fk_company_id_31` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_outer_client_5` FOREIGN KEY (`outer_client_id`) REFERENCES `outer_clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_id_4` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_store_id_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance_bills`
--
ALTER TABLE `maintenance_bills`
  ADD CONSTRAINT `client_id_main_bill` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_main_bill` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `delegate_name` FOREIGN KEY (`delegate_name`) REFERENCES `delegates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `engineer_id_main_bill` FOREIGN KEY (`engineer_id`) REFERENCES `engineers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintenance_device_id_main_bill` FOREIGN KEY (`maintenance_device_id`) REFERENCES `maintenance_devices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintenance_place` FOREIGN KEY (`maintenance_place`) REFERENCES `maintenance_places` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance_bills_elements`
--
ALTER TABLE `maintenance_bills_elements`
  ADD CONSTRAINT `company_id_main_bill_elem` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintenance_bill_id` FOREIGN KEY (`maintenance_bill_id`) REFERENCES `maintenance_bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id_main_bill_elem` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance_devices`
--
ALTER TABLE `maintenance_devices`
  ADD CONSTRAINT `client_id_main` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_main` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `device_issue` FOREIGN KEY (`device_issue`) REFERENCES `devices_issues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `device_type` FOREIGN KEY (`device_type`) REFERENCES `devices_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `store_id_main` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance_places`
--
ALTER TABLE `maintenance_places`
  ADD CONSTRAINT `client_id_place` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_place` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outer_clients`
--
ALTER TABLE `outer_clients`
  ADD CONSTRAINT `fk_company_id_16` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outer_client_address`
--
ALTER TABLE `outer_client_address`
  ADD CONSTRAINT `company_id_240` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `outer_client_id_80` FOREIGN KEY (`outer_client_id`) REFERENCES `outer_clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outer_client_note`
--
ALTER TABLE `outer_client_note`
  ADD CONSTRAINT `company_id_242` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_outer_client_id_2` FOREIGN KEY (`outer_client_id`) REFERENCES `outer_clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outer_client_phone`
--
ALTER TABLE `outer_client_phone`
  ADD CONSTRAINT `company_id_241` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_outer_client_id` FOREIGN KEY (`outer_client_id`) REFERENCES `outer_clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `company_id_787` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pos_open`
--
ALTER TABLE `pos_open`
  ADD CONSTRAINT `client_id_84` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_84` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `outer_client_id` FOREIGN KEY (`outer_client_id`) REFERENCES `outer_clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shift_id` FOREIGN KEY (`shift_id`) REFERENCES `pos_shifts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pos_open_discount`
--
ALTER TABLE `pos_open_discount`
  ADD CONSTRAINT `company_id_233` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_bill_id_2` FOREIGN KEY (`pos_open_id`) REFERENCES `pos_open` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pos_open_elements`
--
ALTER TABLE `pos_open_elements`
  ADD CONSTRAINT `company_id_534` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id_7` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_unit_id` FOREIGN KEY (`product_unit_id`) REFERENCES `product_unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_bill_id` FOREIGN KEY (`pos_open_id`) REFERENCES `pos_open` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pos_open_tax`
--
ALTER TABLE `pos_open_tax`
  ADD CONSTRAINT `company_id_535` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_bill_id_3` FOREIGN KEY (`pos_open_id`) REFERENCES `pos_open` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tax_id` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pos_serials`
--
ALTER TABLE `pos_serials`
  ADD CONSTRAINT `client_id_serial_pos` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_serial_pos` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pos_element_id_serial_pos` FOREIGN KEY (`pos_element_id`) REFERENCES `pos_open_elements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pos_open_id_serial_pos` FOREIGN KEY (`pos_open_id`) REFERENCES `pos_open` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_unit_id_serial_pos` FOREIGN KEY (`product_unit_id`) REFERENCES `product_unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pos_settings`
--
ALTER TABLE `pos_settings`
  ADD CONSTRAINT `bank_id_fk_89` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `branch_id_fk_259` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_fk` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `safe_id_fk_89` FOREIGN KEY (`safe_id`) REFERENCES `safes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pos_shifts`
--
ALTER TABLE `pos_shifts`
  ADD CONSTRAINT `branch_id_pos` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_id_pos` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_pos` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `safe_id_sh` FOREIGN KEY (`safe_id`) REFERENCES `safes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_serials`
--
ALTER TABLE `product_serials`
  ADD CONSTRAINT `client_id_serial` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_serial` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_serial` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_unit_id_serial` FOREIGN KEY (`product_unit_id`) REFERENCES `product_unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `company_sjarb_id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `type_sjarb_id` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taxes`
--
ALTER TABLE `taxes`
  ADD CONSTRAINT `client_id_83` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `company_id_83` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
