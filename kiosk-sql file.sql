-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2024 at 08:13 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kiosk`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int UNSIGNED NOT NULL,
  `company_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `add_info` text COLLATE utf8mb4_unicode_ci,
  `created_by` int UNSIGNED DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `company_id`, `name`, `mobile_no`, `phone_no`, `logo`, `address`, `add_info`, `created_by`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Main', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int UNSIGNED DEFAULT NULL,
  `company_id` int UNSIGNED DEFAULT NULL,
  `branch_id` int UNSIGNED DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `company_id`, `branch_id`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Electronic Devices', NULL, 1, 1, 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(2, 'Home Appliances', NULL, 1, 1, 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int UNSIGNED DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_id`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Mirpurkhas', 1, 1, NULL, '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(2, 'Hyderabad', 1, 1, NULL, '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(3, 'Karachi', 1, 1, NULL, '2024-01-13 07:13:51', '2024-01-13 07:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `add_info` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `created_by` int UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `code`, `name`, `email`, `owner_name`, `mobile_no`, `phone_no`, `logo`, `address`, `add_info`, `active`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Kiosk', NULL, 'Kiosk', '00011100011', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `id` int UNSIGNED NOT NULL,
  `company_id` int UNSIGNED DEFAULT NULL,
  `custom_date` date NOT NULL DEFAULT '2023-07-01',
  `year_start_date` date NOT NULL DEFAULT '2023-07-01',
  `year_end_date` date NOT NULL DEFAULT '2024-06-30',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_has_transactions`
--

CREATE TABLE `company_has_transactions` (
  `id` int UNSIGNED NOT NULL,
  `company_id` int UNSIGNED DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `purchase_id` int UNSIGNED DEFAULT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_has_transactions`
--

INSERT INTO `company_has_transactions` (`id`, `company_id`, `credit`, `debit`, `purchase_id`, `created_by`, `updated_by`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 1000, 1000, 1, NULL, NULL, 1, '2024-01-13 07:26:09', '2024-01-13 07:26:09'),
(2, 1, 220, 22000, 2, NULL, NULL, 1, '2024-01-13 07:28:06', '2024-01-13 07:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Pakistan', 1, NULL, '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(2, 'Bangladesh', 1, NULL, '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(3, 'India', 1, NULL, '2024-01-13 07:13:51', '2024-01-13 07:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_type_id` int UNSIGNED DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` int UNSIGNED DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `merchant_id` int UNSIGNED DEFAULT NULL,
  `station_id` int UNSIGNED DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_has_transactions`
--

CREATE TABLE `customer_has_transactions` (
  `id` int UNSIGNED NOT NULL,
  `customer_id` int UNSIGNED DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `sell_id` int UNSIGNED DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_has_transactions`
--

INSERT INTO `customer_has_transactions` (`id`, `customer_id`, `credit`, `debit`, `sell_id`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2000, 2000, 1, 1, NULL, '2024-01-13 07:33:15', '2024-01-13 07:33:15'),
(2, 1, 600, 600, 2, 1, NULL, '2024-01-13 07:33:57', '2024-01-13 07:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `customer_types`
--

CREATE TABLE `customer_types` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merchant_id` int UNSIGNED DEFAULT NULL,
  `station_id` int UNSIGNED DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_types`
--

INSERT INTO `customer_types` (`id`, `name`, `merchant_id`, `station_id`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Retailers', NULL, NULL, 1, NULL, '2024-01-13 07:13:53', '2024-01-13 07:13:53'),
(2, 'Commercials', NULL, NULL, 1, NULL, '2024-01-13 07:13:53', '2024-01-13 07:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manufacturer_id` int UNSIGNED DEFAULT NULL,
  `category_id` int UNSIGNED DEFAULT NULL,
  `purchase_price` int UNSIGNED DEFAULT NULL,
  `sell_price` int UNSIGNED DEFAULT NULL,
  `company_id` int UNSIGNED DEFAULT NULL,
  `branch_id` int UNSIGNED DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `manufacturer_id`, `category_id`, `purchase_price`, `sell_price`, `company_id`, `branch_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Item-one', 1, 1, 100, 200, 1, 1, 1, '2024-01-13 07:13:53', '2024-01-13 07:13:53'),
(2, 'Item-two', 1, 1, 200, 300, 1, 1, 1, '2024-01-13 07:13:53', '2024-01-13 07:13:53'),
(3, 'Item-three', 1, 1, 300, 400, 1, 1, 1, '2024-01-13 07:13:53', '2024-01-13 07:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int UNSIGNED DEFAULT NULL,
  `branch_id` int UNSIGNED DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`, `company_id`, `branch_id`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'HP', 1, 1, 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(2, 'Samsung', 1, 1, 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(3, 'Dell', 1, 1, 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(116, '2014_10_12_000000_create_users_table', 1),
(117, '2014_10_12_100000_create_password_resets_table', 1),
(118, '2019_08_19_000000_create_failed_jobs_table', 1),
(119, '2020_10_14_071934_create_permission_tables', 1),
(120, '2023_04_28_214907_create_items_table', 1),
(121, '2023_04_28_215011_create_cities_table', 1),
(122, '2023_04_28_215027_create_countries_table', 1),
(123, '2023_04_28_215050_create_companies_table', 1),
(124, '2023_04_28_215150_create_company_has_transactions_table', 1),
(125, '2023_04_28_215211_create_customers_table', 1),
(126, '2023_04_28_215233_create_customer_has_transactions_table', 1),
(127, '2023_04_28_215250_create_customer_types_table', 1),
(128, '2023_04_28_215350_create_purchases_table', 1),
(129, '2023_04_28_215408_create_purchase_has_items_table', 1),
(130, '2023_04_28_215430_create_sells_table', 1),
(131, '2023_04_28_215449_create_sell_has_items_table', 1),
(132, '2023_04_28_223436_create_statuses_table', 1),
(133, '2023_05_25_161500_create_branches_table', 1),
(134, '2023_05_30_180503_create_settings_table', 1),
(135, '2023_05_31_152033_create_manufacturers_table', 1),
(136, '2023_05_31_152231_create_categories_table', 1),
(137, '2023_08_07_224150_create_company_details_table', 1),
(138, '2023_09_30_155036_create_types_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(2, 'role-create', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(3, 'role-edit', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(4, 'role-delete', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(5, 'user-list', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(6, 'user-create', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(7, 'user-edit', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(8, 'user-delete', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(9, 'item-list', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(10, 'item-create', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(11, 'item-edit', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(12, 'item-delete', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(13, 'manufacturer-list', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(14, 'manufacturer-create', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(15, 'manufacturer-edit', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(16, 'manufacturer-delete', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(17, 'category-list', 'web', '2024-01-13 07:13:51', '2024-01-13 07:13:51'),
(18, 'category-create', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(19, 'category-edit', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(20, 'category-delete', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(21, 'purchase-list', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(22, 'purchase-create', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(23, 'purchase-edit', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(24, 'purchase-delete', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(25, 'sell-list', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(26, 'sell-create', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(27, 'sell-edit', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(28, 'sell-delete', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(29, 'report-list', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(30, 'report-create', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(31, 'report-edit', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(32, 'report-delete', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(33, 'profile-list', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(34, 'profile-create', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(35, 'profile-edit', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(36, 'profile-delete', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(37, 'stock-list', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(38, 'stock-create', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(39, 'stock-edit', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(40, 'stock-delete', 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int UNSIGNED NOT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int UNSIGNED DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `net_amount` double DEFAULT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `order_no`, `company_id`, `invoice_date`, `purchase_date`, `total_amount`, `net_amount`, `created_by`, `updated_by`, `active`, `created_at`, `updated_at`) VALUES
(1, '12', 1, '2024-01-13', '2024-01-13', 1000, 0, 1, NULL, 1, '2024-01-13 07:26:09', '2024-01-13 07:26:09'),
(2, '123123', 1, '2024-01-13', '2024-01-13', 22000, 21780, 1, NULL, 1, '2024-01-13 07:28:06', '2024-01-13 07:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_has_items`
--

CREATE TABLE `purchase_has_items` (
  `id` int UNSIGNED NOT NULL,
  `purchase_id` int UNSIGNED DEFAULT NULL,
  `item_id` int UNSIGNED DEFAULT NULL,
  `purchase_qty` int UNSIGNED DEFAULT NULL,
  `purchase_price` int UNSIGNED DEFAULT NULL,
  `sell_price` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_has_items`
--

INSERT INTO `purchase_has_items` (`id`, `purchase_id`, `item_id`, `purchase_qty`, `purchase_price`, `sell_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, 100, 200, '2024-01-13 07:26:09', '2024-01-13 07:26:09'),
(2, 2, 1, 20, 100, 200, '2024-01-13 07:28:06', '2024-01-13 07:28:06'),
(3, 2, 2, 100, 200, 300, '2024-01-13 07:28:06', '2024-01-13 07:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int UNSIGNED NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `company_id`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super-Admin', 1, 'web', '2024-01-13 07:13:52', '2024-01-13 07:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
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
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `id` int UNSIGNED NOT NULL,
  `order_no` int UNSIGNED DEFAULT NULL,
  `customer_id` int UNSIGNED DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `net_amount` double DEFAULT NULL,
  `pay_amount` double DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`id`, `order_no`, `customer_id`, `total_amount`, `net_amount`, `pay_amount`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 2000, NULL, 2000, 1, NULL, '2024-01-13 07:33:15', '2024-01-13 07:33:15'),
(2, NULL, 1, 600, NULL, 600, 1, NULL, '2024-01-13 07:33:57', '2024-01-13 07:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `sell_has_items`
--

CREATE TABLE `sell_has_items` (
  `id` int UNSIGNED NOT NULL,
  `sell_id` int UNSIGNED DEFAULT NULL,
  `item_id` int UNSIGNED DEFAULT NULL,
  `sell_qty` int UNSIGNED DEFAULT NULL,
  `sell_price` int UNSIGNED DEFAULT NULL,
  `tot_price` int UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sell_has_items`
--

INSERT INTO `sell_has_items` (`id`, `sell_id`, `item_id`, `sell_qty`, `sell_price`, `tot_price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, 200, 2000, NULL, '2024-01-13 07:33:15', '2024-01-13 07:33:15'),
(2, 2, 2, 2, 300, 600, NULL, '2024-01-13 07:33:57', '2024-01-13 07:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` int DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Pending', 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(2, 'Awaiting Payment', 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(3, 'Awaiting Fulfillment', 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(4, 'Awaiting Shipment', 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(5, 'Awaiting Pickup', 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(6, 'Completed', 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(7, 'Shipped', 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(8, 'Cancelled', 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(9, 'Declined', 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(10, 'Refunded', 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52'),
(11, 'Disputed', 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int UNSIGNED DEFAULT NULL,
  `company_id` int UNSIGNED DEFAULT NULL,
  `branch_id` int UNSIGNED DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` int DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1' COMMENT 'null = inactive and 1 = active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `branch_id`, `name`, `email`, `email_verified_at`, `password`, `phone_no`, `mobile_no`, `description`, `profile_pic`, `remember_token`, `add_info`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'admin', 'admin@gmail.com', NULL, '$2y$10$sri6XOsChLofXADnH3HsFOpvD9t.q602l4ext8uiUw4I5bnvhojRe', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2024-01-13 07:13:52', '2024-01-13 07:13:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_email_unique` (`email`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_has_transactions`
--
ALTER TABLE `company_has_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_has_transactions`
--
ALTER TABLE `customer_has_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_types`
--
ALTER TABLE `customer_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_has_items`
--
ALTER TABLE `purchase_has_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_has_items`
--
ALTER TABLE `sell_has_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_has_transactions`
--
ALTER TABLE `company_has_transactions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_has_transactions`
--
ALTER TABLE `customer_has_transactions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_types`
--
ALTER TABLE `customer_types`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_has_items`
--
ALTER TABLE `purchase_has_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sell_has_items`
--
ALTER TABLE `sell_has_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
