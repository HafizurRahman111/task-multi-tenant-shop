-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2025 at 02:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multi_tenant_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `tenant_id`, `store_id`, `name`, `slug`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Electronics', 'electronics', 1, NULL, '2025-02-18 13:34:40', '2025-02-18 13:34:40', NULL),
(2, 1, 1, 'Clothing', 'clothing', 1, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(3, 1, 1, 'Books', 'books', 1, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(4, 2, 2, 'Toys', 'toys', 2, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(5, 2, 2, 'Sports', 'sports', 2, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(6, 2, 4, 'Groceries', 'groceries', 2, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(7, 2, 4, 'Health & Beauty', 'health-beauty', 2, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(8, 2, 4, 'Food & Beverages', 'food-beverages', 2, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(9, 2, 5, 'Furniture', 'furniture', 2, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(10, 2, 5, 'Automotive', 'automotive', 2, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(11, 3, 3, 'Office Supplies', 'office-supplies', 3, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(12, 3, 3, 'Pet Supplies', 'pet-supplies', 3, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(13, 3, 3, 'Jewelry', 'jewelry', 3, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(14, 3, 3, 'Beverages', 'beverages', 3, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(15, 3, 6, 'Computers', 'computers', 3, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(16, 3, 6, 'Mobile Phones', 'mobile-phones', 3, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL),
(17, 3, 6, 'Laptops', 'laptops', 3, NULL, '2025-02-18 13:34:41', '2025-02-18 13:34:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(113, '0001_01_01_000001_create_cache_table', 1),
(114, '0001_01_01_000002_create_jobs_table', 1),
(210, '2025_02_16_100000_create_tenants_table', 2),
(211, '2025_02_16_100100_create_users_table', 2),
(212, '2025_02_16_101000_create_stores_table', 2),
(213, '2025_02_16_102000_create_categories_table', 2),
(214, '2025_02_16_103000_create_products_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `tenant_id`, `category_id`, `sku`, `name`, `description`, `price`, `stock`, `image`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'ELEC-VEL-792', 'Smartphone', 'Fugit ut sunt iste aut laborum nihil rem. Vitae optio natus natus error placeat. Aut veniam aperiam qui porro quis maxime.', 1812.44, 59, NULL, 1, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(2, 1, 1, 'ELEC-QUA-620', 'Laptop', 'Provident voluptate repudiandae id quis eaque totam a. Asperiores molestias possimus accusantium voluptatem aut. Deserunt voluptatem accusamus quo ad non ratione et ducimus. Ipsam optio non est ullam.', 9205.59, 40, NULL, 1, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(3, 1, 1, 'ELEC-SIT-709', 'Tablet', 'Nobis quod quia quia dolores hic. Impedit aliquam ex nihil qui doloremque molestiae. Delectus itaque distinctio et quidem dolor sed.', 5214.42, 50, NULL, 1, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(4, 1, 1, 'ELEC-PLA-362', 'Headphones', 'Assumenda reprehenderit vero laborum dicta rerum velit quis. Aut asperiores corporis molestiae magni omnis. Quia ratione vel neque quos molestiae.', 7134.89, 91, NULL, 1, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(5, 1, 2, 'CLOT-UT-601', 'T-shirt', 'Sed aliquid praesentium aliquid accusamus sint omnis suscipit. Quis enim nulla delectus veritatis. Eum pariatur quam nulla sit.', 1776.35, 25, NULL, 1, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(6, 1, 2, 'CLOT-DIS-962', 'Sweater', 'Saepe itaque sed dignissimos sint ut nihil et. Adipisci et odit ducimus. Minus ratione adipisci et voluptas sapiente est. Suscipit voluptatem quidem quis provident corrupti.', 1795.41, 32, NULL, 1, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(7, 1, 3, 'BOOK-UT-975', 'Fiction Novel', 'Sint non quo numquam ipsum doloremque. Aut sequi voluptatibus sequi adipisci itaque. Reprehenderit laudantium eveniet enim velit. Esse voluptas nesciunt quam vitae. Eius optio ab alias totam cumque.', 7395.74, 60, NULL, 1, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(8, 1, 3, 'BOOK-OFF-794', 'Science Book', 'Velit voluptate doloremque qui eaque suscipit veritatis occaecati. Iusto voluptate voluptas numquam repudiandae fugiat qui autem. Necessitatibus temporibus reprehenderit nobis omnis amet asperiores rerum. Excepturi nemo sequi quia ipsam alias reprehenderit. Inventore aliquam consequuntur et perferendis qui quam.', 3181.76, 16, NULL, 1, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(9, 1, 3, 'BOOK-FAC-124', 'Biography', 'Sunt quos saepe quis eius tenetur non et. Mollitia in iure laborum sit commodi. Odit sed odit porro minus cumque velit quibusdam.', 1875.78, 65, NULL, 1, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(10, 1, 3, 'BOOK-ANI-288', 'Philosophy', 'Et totam corrupti omnis ab molestias. Delectus et optio quos cum. Occaecati a quibusdam quos.', 1253.84, 32, NULL, 1, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(11, 1, 3, 'BOOK-ITA-680', 'History Book', 'Nam dicta autem incidunt ut eveniet. Laboriosam fugiat ipsa reprehenderit expedita ut nostrum quaerat. Tempora officiis quaerat voluptas magni. Repellendus exercitationem inventore sequi dolores.', 4358.37, 41, NULL, 1, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(12, 1, 3, 'BOOK-DES-364', 'Travel Guide', 'Dolor necessitatibus ratione ab et quis. Perferendis accusamus ad et est sunt repellat et. Aliquam molestiae sed harum soluta. Ducimus et quam ut quisquam.', 7590.55, 65, NULL, 1, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(13, 2, 4, 'TOYS-ET-261', 'Action Figure', 'Sint id eius ut voluptatibus quam. Consequatur aut magni quia impedit. Odit error nemo sint nemo. Error magnam quo excepturi in quae et rerum. Et necessitatibus magnam voluptatem provident.', 2343.56, 89, NULL, 2, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(14, 2, 4, 'TOYS-RER-209', 'Doll', 'Officia quia dolorem ut ullam eveniet optio omnis. Incidunt aut ut aut. Quisquam doloribus quam totam maxime est facere.', 8537.40, 4, NULL, 2, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(15, 2, 4, 'TOYS-CON-455', 'Toy Car', 'Culpa reiciendis sed beatae est quam doloremque ex. Qui deserunt recusandae et molestias illum ratione voluptas.', 5085.54, 37, NULL, 2, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(16, 2, 4, 'TOYS-EST-522', 'Lego Set', 'Optio optio ea praesentium est ut fugiat aspernatur. Aut nam accusantium et fugit facilis.', 6396.31, 42, NULL, 2, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(17, 2, 5, 'SPOR-MIN-135', 'Football', 'Nesciunt error labore rerum explicabo quo at. Voluptas iste ad sequi quam quia explicabo. Ducimus ipsam occaecati voluptatibus ullam est rerum.', 7088.07, 77, NULL, 2, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(18, 2, 5, 'SPOR-AUT-086', 'Basketball', 'Explicabo repudiandae asperiores tempora dolorem recusandae. Et quidem delectus dolorem tenetur sit vero saepe. Sed ab ut dolorum qui qui exercitationem eaque. Nam et saepe qui sit et dolorem modi rerum.', 3628.05, 1, NULL, 2, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(19, 2, 5, 'SPOR-NAM-801', 'Tennis Racket', 'Asperiores error est voluptatibus quod eaque molestiae velit commodi. Et esse reiciendis pariatur tenetur. Necessitatibus ut delectus dignissimos est. Repellat doloribus ut adipisci id nesciunt quod quaerat at.', 5559.00, 7, NULL, 2, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(20, 2, 5, 'SPOR-FUG-182', 'Baseball Bat', 'Et debitis autem necessitatibus suscipit repellendus non ducimus. Doloribus est voluptate perspiciatis. At repudiandae tempora quo ut voluptas nostrum molestias. Doloremque velit vitae quia aut voluptatem.', 4743.93, 52, NULL, 2, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(21, 2, 6, 'GROC-REP-320', 'Rice', 'Itaque autem dolores iste quibusdam impedit dicta quo. Assumenda est iste et ut mollitia. Culpa et ut natus voluptatibus.', 585.52, 67, NULL, 2, NULL, '2025-02-18 13:34:42', '2025-02-18 13:34:42', NULL),
(22, 2, 6, 'GROC-VER-137', 'Milk', 'Modi ratione consequatur debitis velit dolores. Ea et quod eius et. Ea libero voluptatem enim tenetur est eum iure sequi.', 4375.93, 57, NULL, 2, NULL, '2025-02-18 13:34:43', '2025-02-18 13:34:43', NULL),
(23, 2, 6, 'GROC-QUI-393', 'Flour', 'Molestiae itaque esse ex sapiente dolore dolor nostrum. Sed dicta omnis dolorem nisi nulla aut mollitia praesentium.', 9078.54, 70, NULL, 2, NULL, '2025-02-18 13:34:43', '2025-02-18 13:34:43', NULL),
(24, 2, 6, 'GROC-EIU-213', 'Eggs', 'Fugiat est libero ea in cum est. Dolorem officia exercitationem est adipisci. Velit dolorem occaecati consequatur sapiente explicabo voluptatem architecto dignissimos. Voluptas ipsum eos qui id vitae veritatis at.', 8380.23, 21, NULL, 2, NULL, '2025-02-18 13:34:43', '2025-02-18 13:34:43', NULL),
(25, 2, 9, 'FURN-MIN-253', 'Sofa', 'Dolorem in ut commodi qui qui sunt quia eveniet. Eos et veritatis et consequatur. Eum eum fuga minima placeat sint.', 2411.95, 54, NULL, 2, NULL, '2025-02-18 13:34:43', '2025-02-18 13:34:43', NULL),
(26, 2, 9, 'FURN-NAM-271', 'Dining Table', 'Deleniti repudiandae asperiores rerum eaque. Quisquam sed eius non quia quaerat. Officiis et voluptate dignissimos est blanditiis impedit omnis.', 1204.89, 80, NULL, 2, NULL, '2025-02-18 13:34:43', '2025-02-18 13:34:43', NULL),
(27, 2, 9, 'FURN-PLA-173', 'Bookshelf', 'Aut accusamus at qui recusandae nihil et. Iusto laudantium et consequatur mollitia iusto. Voluptatibus sed et dolorem labore sunt necessitatibus libero. Aut iusto quia sed quas unde magni sint. Quis et magni error quia aut.', 3706.34, 66, NULL, 2, NULL, '2025-02-18 13:34:43', '2025-02-18 13:34:43', NULL),
(28, 3, 13, 'JEWE-EST-404', 'Necklace', 'Perferendis deserunt ut non molestiae est. Quis sunt odio consectetur reiciendis quisquam magnam. Consequatur iure est temporibus.', 1905.44, 54, NULL, 3, NULL, '2025-02-18 13:34:43', '2025-02-18 13:34:43', NULL),
(29, 3, 13, 'JEWE-DOL-336', 'Earrings', 'Eligendi non voluptatem voluptatibus ullam illo. Voluptas voluptas vel ab voluptas. Sed earum et quibusdam vel. Vel fugit consequuntur nihil aliquam non autem.', 1262.46, 21, NULL, 3, NULL, '2025-02-18 13:34:43', '2025-02-18 13:34:43', NULL),
(30, 3, 13, 'JEWE-QUI-337', 'Bracelet', 'Aliquam consequatur reiciendis corrupti ut est architecto. Non reiciendis unde non in. Vel soluta nihil nihil cum esse ex similique inventore. Quas rem neque eos numquam deleniti eos ipsum nisi.', 9488.70, 28, NULL, 3, NULL, '2025-02-18 13:34:43', '2025-02-18 13:34:43', NULL),
(31, 3, 13, 'JEWE-UT-185', 'Ring', 'Perspiciatis quia molestiae magni aut reiciendis sequi. Omnis dolor iste exercitationem cumque enim officiis. Ut atque voluptatem id magni odio. Praesentium ut itaque modi aliquid dicta.', 2706.23, 83, NULL, 3, NULL, '2025-02-18 13:34:43', '2025-02-18 13:34:43', NULL),
(32, 3, 13, 'JEWE-QUI-156', 'Watch', 'Quas architecto aspernatur eveniet occaecati. Voluptatem dicta sed expedita quo. Ea iste sint asperiores alias voluptas consequatur. Itaque aut praesentium tenetur sed aliquid nisi facere.', 5267.88, 37, NULL, 3, NULL, '2025-02-18 13:34:43', '2025-02-18 13:34:43', NULL),
(33, 3, 14, 'BEVE-UT-480', 'Juice', 'Qui sapiente eos deserunt incidunt aliquid omnis. Consequatur sit placeat ut quibusdam tempore in. Facere asperiores quos reprehenderit labore tempore. Modi dolor eaque maxime eum consequatur dolor.', 9903.90, 70, NULL, 3, NULL, '2025-02-18 13:34:43', '2025-02-18 13:34:43', NULL),
(34, 3, 14, 'BEVE-QUI-633', 'Soda', 'Quibusdam cumque adipisci odio sed et consectetur et. Debitis reiciendis quos voluptatem vel accusamus. Id architecto rem voluptas tempore.', 3976.21, 49, NULL, 3, NULL, '2025-02-18 13:34:43', '2025-02-18 13:34:43', NULL),
(35, 3, 14, 'BEVE-ALI-358', 'Tea', 'Rem eius eos enim qui cumque et harum dolor. Blanditiis doloremque vero est non. Aut reprehenderit in voluptas ut.', 3433.42, 39, NULL, 3, NULL, '2025-02-18 13:34:44', '2025-02-18 13:34:44', NULL),
(36, 3, 14, 'BEVE-ET-606', 'Coffee', 'Voluptatum blanditiis officia recusandae adipisci dolor dolore unde ad. Nostrum perspiciatis sed ab vitae voluptas quia. Voluptatem porro saepe odio fugiat quis soluta. Dolorem id aut blanditiis dolore voluptates consequatur delectus.', 6209.54, 40, NULL, 3, NULL, '2025-02-18 13:34:44', '2025-02-18 13:34:44', NULL),
(37, 3, 15, 'COMP-A-285', 'Desktop PC', 'Laborum nobis magnam ullam aliquam molestiae quis sed. Asperiores odit est officia cupiditate non est officia laboriosam. Libero rem suscipit illo dolores sunt laudantium eligendi.', 6802.68, 26, NULL, 3, NULL, '2025-02-18 13:34:44', '2025-02-18 13:34:44', NULL),
(38, 3, 15, 'COMP-EST-421', 'Monitor', 'Dolor explicabo id sit quaerat qui placeat. Laudantium voluptatum ut recusandae excepturi similique. Et qui unde quis autem consequatur sunt qui. Quasi quia odit cupiditate voluptatem suscipit rerum.', 4992.07, 96, NULL, 3, NULL, '2025-02-18 13:34:44', '2025-02-18 13:34:44', NULL),
(39, 3, 15, 'COMP-INC-758', 'Keyboard', 'Odit totam eum omnis et dolore voluptatem. Totam ut totam ut consequatur. Quas at id consequatur explicabo sapiente. Fuga excepturi quam amet sed voluptatem sunt.', 9804.53, 89, NULL, 3, NULL, '2025-02-18 13:34:44', '2025-02-18 13:34:44', NULL),
(40, 3, 15, 'COMP-EA-688', 'Mouse', 'Omnis natus ipsa nulla sint ratione ad autem. Quas accusantium rerum cum asperiores. Dicta quae sit voluptatum ut officiis facilis dolorum aut. Impedit qui sit quasi et eligendi.', 2159.03, 79, NULL, 3, NULL, '2025-02-18 13:34:44', '2025-02-18 13:34:44', NULL),
(41, 3, 16, 'MOBI-EX-338', 'Smartphone', 'Laborum sunt minima ab vero qui molestiae fugit explicabo. Vel est ad hic non. Quis aut aliquid minima molestiae sit.', 3137.83, 93, NULL, 3, NULL, '2025-02-18 13:34:44', '2025-02-18 13:34:44', NULL),
(42, 3, 16, 'MOBI-DOL-632', 'Feature Phone', 'Eos officia reiciendis reiciendis consequatur et. Nostrum fugiat commodi recusandae magni ut et. Mollitia quaerat nesciunt tempore beatae voluptas ea voluptas vero. Pariatur beatae consequatur reiciendis assumenda incidunt.', 5811.45, 41, NULL, 3, NULL, '2025-02-18 13:34:44', '2025-02-18 13:34:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `tenant_id`, `name`, `slug`, `website`, `phone`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Store One', 'store_one', 'http://store_one.localhost:8000/home', '123-456-7890', 1, NULL, '2025-02-18 13:34:40', '2025-02-18 13:34:40', NULL),
(2, 2, 'Store Two', 'store_two', 'http://store_two.localhost:8000/home', '987-654-3210', 2, NULL, '2025-02-18 13:34:40', '2025-02-18 13:34:40', NULL),
(3, 3, 'Store Three', 'store_three', 'http://store_three.localhost:8000/home', '555-123-4567', 3, NULL, '2025-02-18 13:34:40', '2025-02-18 13:34:40', NULL),
(4, 2, 'Store Four', 'store_four', 'http://store_four.localhost:8000/home', '321-654-9870', 2, NULL, '2025-02-18 13:34:40', '2025-02-18 13:34:40', NULL),
(5, 2, 'Store Five', 'store_five', 'http://store_five.localhost:8000/home', '654-321-7890', 2, NULL, '2025-02-18 13:34:40', '2025-02-18 13:34:40', NULL),
(6, 3, 'Store Six', 'store_six', 'http://store_six.localhost:8000/home', '', 3, NULL, '2025-02-18 13:34:40', '2025-02-18 13:34:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `name`, `email`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin Tenant', 'admin@example.com', '2025-02-18 13:34:37', '2025-02-18 13:34:37', NULL),
(2, 'Merchant Tenant-1', 'merchant11@example.com', '2025-02-18 13:34:39', '2025-02-18 13:34:39', NULL),
(3, 'Merchant Tenant-2', 'merchant22@example.com', '2025-02-18 13:34:39', '2025-02-18 13:34:39', NULL),
(4, 'Test Tenant Merchant', 'test@example.com', '2025-02-18 13:34:40', '2025-02-18 13:34:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'merchant',
  `shop_name` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `tenant_id`, `name`, `email`, `role`, `shop_name`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Admin User', 'admin@example.com', 'admin', 'Admin Shop', '2025-02-18 13:34:38', '$2y$12$rIE35.Ba1wlNGqvX55HPtuLkrB5eeXx1aYcOt1tomMfuIhX8OgnU.', 'LcA18oRUGN', '2025-02-18 13:34:39', '2025-02-18 13:34:39', NULL),
(2, 2, 'Merchant User-1', 'merchant11@example.com', 'merchant', 'Merchant-1 Shop', '2025-02-18 13:34:39', '$2y$12$S.Og81.EyMImAI9lS9M7.emE.J5vEy7KmkofHmlMDMmyETa1Asvn.', '0wZ4wmrIHR', '2025-02-18 13:34:39', '2025-02-18 13:34:39', NULL),
(3, 3, 'Merchant User-2', 'merchant22@example.com', 'merchant', 'Merchant-2 Shop', '2025-02-18 13:34:40', '$2y$12$6RlJnkWCK9vw474K5xMxMudZ7PgAzm3mMlmemzdX08/tuTl5lUHuW', 'D8LhS4vfOD', '2025-02-18 13:34:40', '2025-02-18 13:34:40', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_tenant_id_foreign` (`tenant_id`),
  ADD KEY `categories_store_id_foreign` (`store_id`),
  ADD KEY `categories_created_by_foreign` (`created_by`),
  ADD KEY `categories_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_tenant_id_foreign` (`tenant_id`),
  ADD KEY `1` (`category_id`),
  ADD KEY `products_created_by_foreign` (`created_by`),
  ADD KEY `products_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stores_slug_unique` (`slug`),
  ADD UNIQUE KEY `stores_website_unique` (`website`),
  ADD KEY `stores_tenant_id_foreign` (`tenant_id`),
  ADD KEY `stores_created_by_foreign` (`created_by`),
  ADD KEY `stores_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tenants_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_tenant_id_unique` (`tenant_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `categories_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `stores_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stores_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
