-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2022 at 02:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecomerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `origin` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `origin`, `is_deleted`) VALUES
(1, 'Apple', 'USA', 0),
(2, 'Samsung', 'KOREA', 0),
(3, 'Asus', 'TAIWAN', 0),
(4, 'Dell', 'USA', 0),
(5, 'Dareu', 'CHINA', 0),
(6, 'LG', 'KOREA', 0),
(7, 'Cooler Master', 'TAIWAN', 0),
(8, 'AMD', 'USA', 0),
(9, 'Intel', 'USA', 0),
(10, 'Kingstion', 'USA', 0),
(11, 'JBL', 'USA', 0),
(12, 'Xigmatek', 'CHINA', 0),
(13, 'Logitech', 'SWISS', 0),
(14, 'Sony', 'JAPAN', 0),
(15, 'MSI', 'TAIWAN', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` varchar(12) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `product_id`, `quantity`) VALUES
('02', 13, 1),
('02', 51, 1),
('02', 12, 3),
('123', 53, 1),
('123', 90, 1),
('123', 88, 2),
('123', 93, 1),
('0973360301', 13, 1),
('0973360301', 11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `deliver`
--

CREATE TABLE `deliver` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `dob` date NOT NULL,
  `phone_number` varchar(12) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `is_ready` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `deliver`
--

INSERT INTO `deliver` (`id`, `name`, `dob`, `phone_number`, `is_ready`) VALUES
(1, 'Đinh Trung Hiền', '2003-06-13', '0975632175', 1),
(2, 'Hà Ngọc Thanh', '2002-10-28', '0963474568', 1),
(3, 'Nguyễn Duy Trung', '2004-02-15', '0963475544', 1),
(4, 'Trịnh Thảo Hoàng', '2001-11-16', '0985362456', 1);

-- --------------------------------------------------------

--
-- Table structure for table `guest_bill`
--

CREATE TABLE `guest_bill` (
  `id` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `status_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `phone_number` varchar(12) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `total` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_mode_id` int(11) NOT NULL,
  `note` varchar(250) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `deliver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `guest_bill`
--

INSERT INTO `guest_bill` (`id`, `status_id`, `name`, `phone_number`, `address`, `total`, `created_time`, `payment_mode_id`, `note`, `deliver_id`) VALUES
('G1', 3, '', '', '', 22480800, '2022-01-11 06:14:10', 1, '', 1),
('G2', 1, '', '', '', 22480800, '2022-01-11 06:15:31', 1, '', NULL),
('G3', 1, 'Bình An Trần', '0868197116', '12 Chùa Bộc, Quang Trung, Đống Đa, Hà Nội', 56970000, '2022-12-20 06:23:33', 1, '', NULL),
('G5', 1, 'Bình An Trần', '0868197116', '12 Chùa Bộc, Quang Trung, Đống Đa, Hà Nội', 84170000, '2022-12-20 06:39:49', 1, '', NULL);

--
-- Triggers `guest_bill`
--
DELIMITER $$
CREATE TRIGGER `tg_guestBill_insert` BEFORE INSERT ON `guest_bill` FOR EACH ROW BEGIN
  INSERT INTO guest_bill_seq VALUES (NULL);
  SET NEW.id = CONCAT('G', LAST_INSERT_ID());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `guest_bill_detail`
--

CREATE TABLE `guest_bill_detail` (
  `bill_id` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `guest_bill_detail`
--

INSERT INTO `guest_bill_detail` (`bill_id`, `product_id`, `quantity`) VALUES
('G2', 103, 2),
('G2', 100, 1),
('G2', 99, 1),
('G2', 96, 1),
('G2', 95, 1),
('G3', 53, 1),
('G3', 52, 1),
('G3', 51, 1),
('G5', 51, 1),
('G5', 11, 1),
('G5', 13, 1),
('G5', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `guest_bill_seq`
--

CREATE TABLE `guest_bill_seq` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `guest_bill_seq`
--

INSERT INTO `guest_bill_seq` (`id`) VALUES
(1),
(2),
(3),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE `payment_mode` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `payment_mode`
--

INSERT INTO `payment_mode` (`id`, `name`) VALUES
(1, 'Thanh toán khi nhận hàng'),
(2, 'Chuyển khoản');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL DEFAULT 0,
  `import_date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `warranty_day` int(11) NOT NULL,
  `detail` varchar(1000) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_type_id`, `brand_id`, `name`, `price`, `sale_price`, `import_date`, `quantity`, `warranty_day`, `detail`, `image`, `is_deleted`) VALUES
(1, 1, 2, 'Samsung Galaxy Z Flip3 5G 128GB', 20080000, 20080000, '2021-05-10', 56, 720, 'Màn hình: Full HD+ (1080 x 2640 Pixels) \nRAM: 8 GB\nCamera: 12 MP - 12 MP.\nPin: 3.300 mAh', '1.jpg', 0),
(2, 1, 2, 'Samsung Galaxy Z Fold3 5G 256GB', 33740000, 33740000, '2021-05-20', 51, 720, 'Màn hình: Full HD+ (1768 x 2208 Pixels) \nRAM: 12 GB\nCamera: 12 MP - 12 MP - 12 MP\nPin: 4.400 mAh', '2.jpg', 0),
(3, 1, 2, 'Samsung Galaxy S21 Ultra 5G 128GB', 24400000, 24400000, '2021-05-20', 150, 720, 'Màn hình:  2K+ (1440 x 3200 Pixels) \nRAM: 12 GB\nCamera: Chính 108 MP & Phụ 12 MP, 10 MP, 10 MP.\nPin: 5000 mAh', '3.jpg', 0),
(4, 1, 2, 'Samsung Galaxy S20 FE (8GB/256GB)', 12070000, 12070000, '2021-05-20', 187, 720, 'Màn hình: Full HD+ (1080 x 2400 Pixels)\nRAM: 8 GB\nCamera: Chính 12 MP & Phụ 12 MP, 8 MP, 4K\nPin: 4500 mAh', '4.jpg', 0),
(5, 1, 2, 'Samsung Galaxy A12 4GB', 3480000, 3480000, '2021-05-20', 124, 720, 'Màn hình: HD+ (720 x 1600 Pixels)\nRAM: 4 GB\nCamera: Chính 48 MP & Phụ 5 MP, 2 MP, 2 MP\nPin: 5000 mAh', '5.jpg', 0),
(6, 1, 2, 'Samsung Galaxy A32', 5270000, 5270000, '2021-05-20', 197, 720, 'Màn hình:  Full HD+ (1080 x 2400 Pixels) \nRAM: 6 GB\nCamera: 64MP\nPin: 5,000mAh', '6.jpg', 0),
(7, 1, 2, 'Samsung Galaxy A52s 5G 128GB', 8830000, 8830000, '2021-05-20', 145, 720, 'Màn hình: Độ phân giải: Full HD+ (1080 x 2400 Pixels) \nRAM: 8GB\nCamera:  32MP FF\nPin: 4500 mAh', '7.jpg', 0),
(8, 1, 2, 'Samsung Galaxy M51', 7470000, 7470000, '2021-03-01', 89, 720, 'Màn hình: Full HD+ (1080 x 2400 Pixels) \nRAM: 8 GB \nCamera: Chính 64 MP & Phụ 12 MP, 5 MP, 5 MP\nPin: 7000 mAh', '8.jpg', 0),
(9, 1, 2, 'Samsung Galaxy Note 20', 18510000, 18510000, '2021-03-01', 76, 720, 'Màn hình: Full HD+ (1080 x 2400 Pixels) \nRAM: 8 GB \nCamera: Chính 12 MP & Phụ 64 MP, 12 MP\nPin: 4300 mAh', '9.jpg', 0),
(10, 1, 1, 'iPhone 11', 25990000, 21780000, '2021-03-01', 179, 360, 'Màn hình: 6.1\"\nRAM: 4 GB\nCamera: 2 camera 12 MP\nPin: 3110 mAh', '10.jpg', 0),
(11, 1, 1, 'iPhone 13 Pro Max', 32900000, 30990000, '2021-03-01', 215, 360, 'Màn hình: 6.7\"\nRAM: 6 GB\nCamera: 3 camera 12 MP\nPin: 4352 mAh', '11.jpg', 0),
(12, 1, 1, 'iPhone 12 Pro Max', 18990000, 18690000, '2021-03-01', 246, 360, 'Màn hình: 6.7\"\nRAM: 6 GB\nCamera: 3 camera 12 MP\nPin: 3687 mAh', '12.jpg', 0),
(13, 1, 1, 'iPhone 13 mini', 18490000, 17500000, '2021-05-10', 65, 360, 'Màn hình: 6.1\"\nRAM: 4 GB\nCamera: 2 camera 12 MP\nPin: 3240 mAh', '13.jpg', 0),
(14, 2, 1, 'MacBook Pro 16 M1 Max 2021/32 core-GPU', 87900000, 87900000, '2021-05-10', 67, 360, 'Màn hình: 16.2 inch, 120Hz\nCPU: Apple M1 Max, 400GB/s memory bandwidth\nPin: Khoảng 10 tiếng\nRAM: 16GB', '14.jpg', 0),
(15, 2, 1, 'MacBook Pro 14 M1 Max 2021/32-core GPU', 90990000, 90990000, '2021-05-10', 186, 360, 'Màn hình: 14.2 inch, Retina, 120Hz\nCPU: Apple M1 Max, 400GB/s memory bandwidth\nPin: Khoảng 10 tiếng\nRAM: 16GB', '15.jpg', 0),
(16, 2, 1, 'MacBook Air M1 2020 7-core GPU', 25990000, 25990000, '2021-05-10', 174, 360, 'Màn hình: 13.3\", Retina\nCPU: Apple M1\nPin: Khoảng 10 tiếng\nRAM: 8GB', '16.jpg', 0),
(17, 2, 1, 'MacBook Air M1 2020 8-core GPU', 31240000, 31240000, '2021-05-10', 205, 360, 'Màn hình: 13.3\", Retina\nCPU: Apple M1\nPin: Khoảng 10 tiếng\nRAM: 8GB', '17.jpg', 0),
(18, 2, 1, 'MacBook Pro M1 2020', 35990000, 35990000, '2020-12-25', 135, 360, 'Màn hình: 16.2 inch, 120Hz\nCPU: Apple M1 Max, 400GB/s memory bandwidth\nPin: Khoảng 10 tiếng\nRAM: 8GB', '18.jpg', 0),
(19, 2, 3, 'Asus VivoBook X415EA', 17490000, 17490000, '2020-12-25', 82, 360, 'Màn hình: 14 inch\nCPU: Intel Core i5 Tiger Lake - 1135G7 Pin: 3Cell 42WHrs\nRAM: 8 GB', '19.jpg', 0),
(20, 2, 3, 'Asus ROG Zephyrus G14 Alan Walker R9 5900HS', 44990000, 44990000, '2020-12-25', 214, 360, 'Màn hình: 14\", 2K, 120Hz\nCPU: Ryzen 9, 5900HS, 3GH\nPin: 4-cell, 76Wh\nRAM: 16', '20.jpg', 0),
(21, 2, 3, 'Laptop Asus TUF Gaming FX506HCB', 24990000, 24990000, '2020-12-25', 174, 360, 'Màn hình: 15.6\", Full HD, 144Hz\nCPU: i5, 11400H, 2.7GHz\nPin: 3-cell, 48Wh\nRAM: 16', '21.jpg', 0),
(22, 2, 3, 'Laptop Asus TUF Gaming FX516PM', 30840000, 30840000, '2020-12-25', 135, 360, 'Màn hình: 15.6\", Full HD, 144Hz\nCPU: i7, 11370H, 3.3GHz\nPin: 4-cell, 76Wh\nRAM: 16', '22.jpg', 0),
(23, 2, 3, 'Asus ZenBook Duo UX482EA i7 1165G7 (KA268T)', 39490000, 39490000, '2020-12-25', 178, 360, 'Màn hình: 14\", Full HD\nCPU: i7, 1165G7, 2.8GHz\nPin: 4-cell, 70Wh\nRAM: 16', '23.jpg', 0),
(24, 2, 3, 'Asus ZenBook UX325EA i5 1135G7 (KG363T)', 23790000, 23790000, '2021-05-20', 215, 360, 'Màn hình: 13.3\", Full HD\nCPU:  i5, 1135G7, 2.4GHz\nPin: 4-cell, 67Wh\nRAM: 8GB', '24.jpg', 0),
(25, 2, 3, 'Asus ZenBook UX425EA i5 1135G7 (KI429T)', 23490000, 23490000, '2021-05-21', 86, 360, 'Màn hình: 14\", Full HD\nCPU: i5, 1135G7, 2.4GHz\nPin: 4-cell, 67Wh\nRAM:  8GB', '25.jpg', 0),
(26, 2, 3, 'Asus VivoBook Pro OLED M3401QA R7 5800H (KM040W)', 22490000, 22490000, '2021-05-22', 174, 360, 'Màn hình: 14\", 2K, 90Hz\nCPU: Ryzen 7, 5800H, 3.2GHz\nPin: 3-cell, 63Wh\nRAM: 8GB', '26.jpg', 0),
(27, 2, 3, 'Asus VivoBook Pro OLED M3401QA R7 5800H (KM025T)', 22490000, 22490000, '2021-05-23', 163, 360, 'Màn hình: 14\", 2K, 90Hz\nCPU: Ryzen 7, 5800H, 3.2GHz\nPin: 3-cell, 63Wh\nRAM:  8GB', '27.jpg', 0),
(28, 2, 3, 'Asus TUF Gaming FX506LH i5 10300H (HN002T)', 21490000, 21490000, '2020-02-19', 240, 360, 'Màn hình: 15.6\", Full HD, 144Hz\nCPU: i5, 10300H, 2.5GHz\nPin: 3-cell, 48Wh\nRAM: 8GB', '28.jpg', 0),
(29, 2, 3, 'Asus ZenBook UX363EA i7 1165G7 (HP740W)', 33490000, 33490000, '2020-02-19', 197, 360, 'Màn hình: 13.3\", Full HD\nCPU: i7, 1165G7, 2.8GHz\nPin: 4-cell, 67Wh\nRAM: 16', '29.jpg', 0),
(30, 2, 3, 'Asus ZenBook Duo UX482EA i5', 32490000, 32490000, '2020-02-19', 134, 360, 'Màn hình: 14\", Full HD\nCPU: i5, 1135G7, 2.4GHz\nPin: 4-cell, 70Wh\nRAM: 16', '30.jpg', 0),
(31, 2, 3, 'Asus TUF Gaming FX516PM i7', 30840000, 30840000, '2020-02-19', 175, 360, 'Màn hình: 15.6\", Full HD, 144Hz\nCPU: i7, 11370H, 3.3GHz\nPin: 4-cell, 76Wh\nRAM: 16', '31.jpg', 0),
(32, 2, 3, 'Asus ZenBook Flip UX363EA i5', 27490000, 27490000, '2020-02-19', 136, 360, 'Màn hình: 13.3\", Full HD\nCPU: i5, 1135G7, 2.4GHz\nPin:  4-cell, 67Wh\nRAM: 8GB', '32.jpg', 0),
(33, 2, 3, 'Asus TUF Gaming FX516PC i7', 27040000, 27040000, '2021-03-01', 143, 360, 'Màn hình: 15.6\", Full HD, 144Hz\nCPU: i7, 11370H, 3.3GHz\nPin: 4-cell, 76Wh\nRAM: 16', '33.jpg', 0),
(34, 2, 3, 'Asus VivoBook Pro 15 OLED M3500QC R5', 26590000, 26590000, '2021-03-01', 224, 360, 'Màn hình: 15.6\", Full HD\nCPU: Ryzen 5, 5600H, 3.3GHz\nPin:  3-cell, 63Wh\nRAM: 8GB', '34.jpg', 0),
(35, 2, 3, 'Asus VivoBook A515EA i3 1115G4 (BN1624T)', 16290000, 16290000, '2021-03-01', 142, 360, 'Màn hình:  15.6\", Full HD\nCPU:  i3, 1115G4, 3GHz\nPin:  3-cell, 42Wh\nRAM: 8GB', '35.jpg', 0),
(36, 2, 3, 'Asus VivoBook Flip TP470EA i3 1115G4 (EC027T)', 15990000, 15990000, '2021-03-01', 79, 360, 'Màn hình: 14\", Full HD\nCPU:  i3, 1115G4, 3GHz\nPin:  3-cell, 42Wh\nRAM: 8GB', '36.jpg', 0),
(37, 2, 3, 'Asus VivoBook X515EA i3 1115G4 (BQ1415W)', 14490000, 14490000, '2021-03-01', 81, 360, 'Màn hình:  15.6\", Full HD\nCPU:  i3, 1115G4, 3GHz\nPin: 2-cell, 37Wh\nRAM: 8GB', '37.jpg', 0),
(38, 2, 3, 'Asus VivoBook X515EA i3 1115G4 (BQ994T)', 13690000, 13690000, '2021-03-01', 117, 360, 'Màn hình:  15.6\", Full HD\nCPU: i3, 1115G4, 3GHz\nPin: 2-cell, 37Wh\nRAM: 8GB', '38.jpg', 0),
(39, 2, 3, 'Asus BR1100FKA N6000 (BP0660T)', 10490000, 10490000, '2021-08-26', 163, 360, 'Màn hình: 11.6 inch, HD\nCPU:  Pentium, N6000, 1.1GHz\nPin:  3-cell, 42Wh\nRAM: 8GB', '39.jpg', 0),
(40, 2, 3, 'Asus VivoBook X515MA N4020 (BR480W)', 8690000, 8690000, '2021-08-26', 127, 360, 'Màn hình:  15.6\", HD\nCPU: Celeron, N4020, 1.1GHz\nPin:  2-cell, 37Wh\nRAM: 8GB', '40.jpg', 0),
(41, 2, 4, 'LAPTOP DELL XPS 13 9310 2 IN 1', 41989000, 41989000, '2021-08-26', 67, 720, 'Màn hình:  13.4 inch FHD (16:10) cảm ứng \nCPU: Intel Core i5 1135G7 \nPin: 4-Cell Battery\nRAM: 8GB', '41.jpg', 0),
(42, 2, 4, 'LAPTOP DELL XPS 13 9310 (JGNH62)', 59589000, 59589000, '2021-08-26', 61, 720, 'Màn hình: 15.6 inch 4k cảm ứng\nCPU: Intel Core i7 10750H\nPin: 4 Cell, 51 Whr\nRAM: 16GB', '42.jpg', 0),
(43, 2, 4, 'LAPTOP DELL XPS 13 9310 (70234076)', 38369000, 38369000, '2021-05-10', 186, 720, 'Màn hình: 13.4 inch FHD cảm ứng\nCPU: Intel Core i5 1135G1 \nPin: 4-cell Li-ion\nRAM: 8GB', '43.jpg', 0),
(44, 2, 4, 'LAPTOP DELL XPS 13 9310 (JGNH61)', 58569000, 58569000, '2021-05-10', 245, 720, 'Màn hình: 13.4 inch 4k cảm ứng\nCPU: Intel Core i7 1165G7 \nPin: 4-cell Li-ion\nRAM: 16GB', '44.jpg', 0),
(45, 2, 4, 'LAPTOP HP 340S G7 (36A35PA)', 18499000, 18499000, '2021-08-26', 217, 720, 'Màn hình: 14 inch\nCPU: Intel Core i5 1035G1 \nPin: 4-cell Li-ion\nRAM: 8GB', '45.jpg', 0),
(46, 2, 4, 'LAPTOP DELL INSPIRON 3505 (Y1N1T5)', 20489000, 20489000, '2021-08-26', 239, 720, 'Màn hình: 15.6 inch FHD\nCPU: AMD R5 3500U \nPin: 4-cell Li-ion\nRAM:  8GB', '46.jpg', 0),
(47, 2, 4, 'LAPTOP DELL INSPIRON 5415(70262929)', 19999000, 19999000, '2021-11-06', 143, 720, 'Màn hình: 14 inch FHD\nCPU: AMD R5 5500U \nPin: 4-cell Li-ion\nRAM: 8GB', '47.jpg', 0),
(48, 2, 4, 'LAPTOP DELL INSPIRON 3505 (Y1N1T1)', 14689000, 14689000, '2021-11-06', 247, 720, 'Màn hình: 15.6 inch FHD\nCPU:AMD R3 3250U \nPin: 4-cell Li-ion\nRAM: 8GB', '48.jpg', 0),
(49, 2, 4, 'LAPTOP DELL INSPIRON 5410 2 IN 1 (N4I5147W)', 24999000, 24999000, '2021-11-06', 54, 720, 'Màn hình: 15.6 inch FHD\nCPU: Intel Core i5 1135G7 \nPin: 4-cell Li-ion\nRAM: 8GB', '49.jpg', 0),
(50, 2, 4, 'LAPTOP DELL INSPIRON 5406 (N4I5047W)', 24599000, 24599000, '2021-11-06', 124, 720, 'Màn hình:  14 inch FHD cảm ứng\nCPU:Intel Core i5 1135G7 \nPin: 4-cell Li-ion\nRAM: 8GB', '50.jpg', 0),
(51, 3, 3, 'Asus E5202WHAK-BA102T', 17090000, 16990000, '2021-11-06', 165, 720, 'Màn hình: 21.5\" , 1920 x 1080 pixel , 60 Hz \nCPU:Intel Core i3 4 - Core 3.6 GHz \nRAM: SSD 512 GB\nMô tả: Tích hợp , Intel UHD Graphics , Shared', '51.jpg', 0),
(52, 3, 3, 'ASUS E5202WHAK-BA045T', 19990000, 17990000, '2021-11-06', 182, 720, 'Màn hình: 21.5\" , 1920 x 1080 pixel , 60 Hz \nCPU: Intel Core i5 4 - Core 3.3 GHz \nRAM: 8 GB\nMô tả: SSD 512 GB PCIe/NVMe ', '52.jpg', 0),
(53, 3, 3, 'Asus E5402WHAT-BA042T', 22490000, 21990000, '2020-10-14', 148, 720, 'Màn hình: 21.5\" , 1920 x 1080 pixel , 60 Hz \nCPU: Intel Core i5 4 - Core 3.3 GHz \nRAM: 8 GB\nMô tả: Tích hợp , Intel UHD Graphics , Shared', '53.jpg', 0),
(54, 3, 3, 'Asus A5401WRAT-BA020T', 21790000, 19900000, '2020-10-14', 132, 720, 'Màn hình: 23.8\" , 1920 x 1080 pixel , 60 Hz \nCPU: Intel Core i5 4 - Core 3.1 GHz \nRAM: 8 GB\nMô tả: \n', '54.jpg', 0),
(55, 3, 4, 'PC DELL OPTIPLEX ALL IN ONE 5490', 18399000, 18399000, '2020-10-14', 85, 720, 'Màn hình: 23.8\" , 1920 x 1080 pixel , 60 Hz \nCPU: Core i5-10105T \nRAM:4GB \nMô tả: Tích hợp , Intel UHD Graphics 630 , Shared', '55.jpg', 0),
(56, 3, 4, 'PC DELL OPTIPLEX ALL IN ONE 3280 (I3-10105T/8GB RAM/256GB SSD/21.5 INCH', 16899000, 16899000, '2020-10-14', 225, 720, 'Màn hình: 23.8 inch\nCPU: Core i5-10105T \nRAM: 8GB \nMô tả: Ô cứng 256GB SSD', '56.jpg', 0),
(57, 3, 4, 'PC DELL OPTIPLEX ALL IN ONE 3280 (I5-10500T/8GB RAM/256GB SSD/21.5 INCH', 19449000, 19449000, '2020-10-14', 168, 720, 'Màn hình: 23.8 inch\nCPU: Core i5-10500 \nRAM: 8GB \nMô tả: Ô cứng 256GB SSD', '57.jpg', 0),
(58, 3, 4, 'PC DELL OPTIPLEX ALL IN ONE 5490 (I5-11500T/4GB RAM/256GB SSD/23.8 INCH', 21149000, 21149000, '2021-09-14', 171, 720, 'Màn hình: 23.8 inch\nCPU: Core i5-11500T \nRAM: 4GB \nMô tả: Ổ cứng 256GB SSD', '58.jpg', 0),
(59, 3, 4, 'PC Dell OptiPlex 7080 SFF', 17199000, 16499000, '2021-09-14', 123, 720, 'Màn hình: 23.8 inch\nCPU: Core i5-10500 \nRAM: 8GB \nMô tả: Hệ điều hành Ubuntu', '59.jpg', 0),
(60, 3, 4, 'PC Dell XPS 8940', 35799000, 35549000, '2021-09-14', 141, 720, 'Màn hình: 23.8 inch\nCPU:  Intel Core i7-10700 (2.90GHz upto 4.80GHz, 8 Cores 16 Threads, 16MB Cache) \nRAM: 16GB\nMô tả: Ổ cứng 512GB PCIe M.2 + 1TB SATA 7200 RPM HDD', '60.jpg', 0),
(61, 3, 1, 'iMac 24-inch 2021 4.5K M1/8-core GPU SSD512GB', 34500000, 34500000, '2021-09-14', 216, 720, 'Màn hình: 24 inch, 4.5K \nCPU: Apple M1 8-core \nRAM:8GB\nMô tả:  Hệ điều hành Mac OS\n', '61.jpg', 0),
(62, 3, 1, 'iMac 24-inch 2021 4.5K M1/8-core GPU', 50990000, 50990000, '2021-09-14', 134, 720, 'Màn hình: 24 inch, 4.5K \nCPU: Apple M1 8-core \nRAM:8GB\nMô tả:  Hệ điều hành Mac OS', '62.jpg', 0),
(63, 3, 1, 'iMac 24-inch 2021 4.5K M1/7-core GPU', 45990000, 45990000, '2021-09-14', 142, 720, 'Màn hình: 24 inch, 4.5K \nCPU: Apple M1 8-core \nRAM: 8GB\nMô tả:  Hệ điều hành Mac OS', '63.jpg', 0),
(64, 3, 1, 'Mac mini M1 2020 Silver (MGNR3SA/A)', 37440000, 37440000, '2021-10-28', 74, 720, 'Màn hình: Apple M1 8-core \nCPU: Apple M1 chip with 8-core CPU, 8-core GPU, and 16-core Neural Engine\nRAM: 8GB\nMô tả: Hệ điều hành Mac OS', '64.jpg', 0),
(65, 3, 1, 'iMac 4K 21nch (Model 2019, Realeased 2020)', 26500000, 26500000, '2021-10-28', 63, 720, 'Màn hình: 21-inch (diagonal) Retina 5K display\nCPU: 3.4GHz quad-core Intel Core i5, Turbo Boost up to 3.8GHz\nRAM: 16GB\nMô tả: Wi-Fi 802.11ac Khả năng tương thích chuẩn IEEE 802.11a/b/g/n, Bluetooth 4.2', '65.jpg', 0),
(66, 4, 8, 'CPU AMD Ryzen Threadripper 3970X', 52299000, 52299000, '2021-10-28', 250, 720, 'Thương hiệu : AMD\nChủng loại: Ryzen Threadripper thế hệ 3\nMô tả: 3.7GHz turbo up to 4.5GHz, 32 nhân 64 luồng, 144MB Cache, 280W', '66.jpg', 0),
(67, 4, 9, 'CPU Intel Core i9-10920X', 19999000, 19999000, '2021-10-28', 196, 720, 'Thương hiệu : Intel\nChủng loại: Core i9-10920X\nMô tả: 3.5GHz turbo up to 4.6GHz, 12 nhân 24 luồng, 19.25MB Cache, 165W', '67.jpg', 0),
(68, 4, 8, 'CPU AMD Ryzen 5 3500', 3999000, 3999000, '2021-10-29', 154, 720, 'Thương hiệu : AMD\nChủng loại: Ryzen 5 Thế hệ thứ 3\nMô tả: 3.6GHz turbo up to 4.1GHz, 6 nhân 6 luồng, 16MB Cache, 65W', '68.jpg', 0),
(69, 4, 3, 'Ổ Quang DVD Rewrite Asus SDRW-08D2S-U Ext USB', 899000, 759000, '2021-01-23', 177, 360, 'Thương hiệu : Asus\nChủng loại: SDRW-08D2S-U Ext USB\nMô tả: Kích thước 157 x 142 x 21 cm (DxRxC)', '69.jpg', 0),
(70, 4, 10, 'Ổ cứng SSD Kingston KC600 256GB 2.5 inch SATA3', 1419000, 1199000, '2021-01-23', 87, 720, 'Thương hiệu : ASUS\nChủng loại: SKC600\nMô tả: Kích thước 2.5 inch', '70.jpg', 0),
(71, 4, 7, 'Vỏ Case Cooler Master MasterCase H500P TG ARGB', 4649000, 2899000, '2021-01-23', 145, 360, 'Thương hiệu : ASUS\nChủng loại: Mid Tower\nMô tả: Kích cỡ  544 x 242 x 542mm / 21.4 x 9.5 x 21.3 inch', '71.jpg', 0),
(72, 4, 3, 'Vỏ Case Asus ROG Strix Helios GX601 Tempered Glass Gaming', 8079000, 7239000, '2021-01-23', 185, 720, 'Thương hiệu : ASUS\nChủng loại: Mid Tower\nMô tả: Kích cỡ 525 x 261 x 538mm', '72.jpg', 0),
(73, 4, 3, 'Card màn hình ASUS PH GTX 1660S Super-O6G\n', 14299000, 14299000, '2021-09-14', 174, 1080, 'Thương hiệu : ASUS\nChủng loại: NVIDIA GeForce GTX 1660\nMô tả: Kích cỡ 6.85 \" x 4.76 \" x 1.54 \" Inch; 17.4 x 12.1 x 3.9 centimét\n', '73.jpg', 0),
(74, 5, 1, 'Chuột Bluetooth Apple MK2E3', 2490000, 2490000, '2021-09-14', 84, 360, 'Độ phân giải: 1500 DPI\nCách kết nối: Bluetooth\nMô tả: Pin sạc', '74.jpg', 0),
(75, 5, 1, 'Chuột Bluetooth Apple MLA02\n', 2241000, 2241000, '2021-09-14', 95, 360, 'Độ phân giải: 1000 dpi\nCách kết nối: Có dây\nMô tả: Số nút bấm 3', '75.jpg', 0),
(76, 5, 4, 'CHUỘT DELL MS116\n', 199000, 199000, '2021-09-14', 215, 360, 'Độ phân giải: 1000 DPI\nCách kết nối: USB\nMô tả: Thiết kế phù hợp cho công việc văn phòng, giải trí cơ bản', '76.jpg', 0),
(77, 5, 4, 'CHUỘT KHÔNG DÂY DELL WM118', 229000, 229000, '2021-09-14', 164, 360, 'Độ phân giải: 1000 DPI\nCách kết nối: USB\nMô tả: Thiết kế phù hợp cho công việc văn phòng, giải trí cơ bản', '77.jpg', 0),
(78, 5, 4, 'CHUỘT DELL MS3220 USB\n', 459000, 459000, '2021-09-14', 129, 360, 'Độ phân giải: 1000 dpi\nCách kết nối: Có dây\nMô tả: Số nút bấm 3', '78.jpg', 0),
(79, 5, 4, 'CHUỘT DELL MS3220 USB XÁM TITAN\n', 459000, 459000, '2021-09-14', 184, 360, 'Độ phân giải: 3200 DPI\nCách kết nối: Có dây\nMô tả: Số nút bấm 5', '79.jpg', 0),
(80, 5, 4, 'CHUỘT KHÔNG DÂY DELL MS5120W ĐEN\n', 969000, 969000, '2021-09-14', 135, 360, 'Độ phân giải: 1600 dpi\nCách kết nối: Wireless receiver 2.4GHz và Bluetooth5.0\nMô tả: 1pin AA', '80.jpg', 0),
(81, 5, 4, 'CHUỘT KHÔNG DÂY DELL MS5120W XÁM TITAN\n', 969000, 969000, '2021-09-14', 235, 360, 'Độ phân giải: 3200 DPI\nCách kết nối: Có dây\nMô tả: Số nút bấm 5', '81.jpg', 0),
(82, 5, 4, 'CHUỘT KHÔNG DÂY DELL MS5320W MULTI-DEVICE ĐEN XÁM TITAN\n', 1059000, 1059000, '2021-09-14', 204, 360, 'Độ phân giải: 1600 DPI\nCách kết nối: Wireless 2.4Ghz / Bluetooth 5.0\nMô tả: Tương thích Windows 7 / 8 / 8.1 / 10', '82.jpg', 0),
(83, 5, 4, 'BÀN PHÍM LAPTOP DELL 6420 (KHÔNG ĐÈN, CÓ MẠCH, KHÔNG CHUỘT)\n', 609000, 609000, '2021-11-06', 103, 360, NULL, '83.jpg', 0),
(84, 5, 4, 'BÀN PHÍM LAPTOP DELL 7440 CÓ ĐÈN, KHÔNG CHUỘT\n', 609000, 609000, '2021-11-06', 239, 360, NULL, '84.jpg', 0),
(85, 5, 4, 'BÀN PHÍM LAPTOP DELL 7440 KHÔNG ĐÈN, CÓ CHUỘT', 509000, 509000, '2021-11-06', 101, 360, NULL, '85.jpg', 0),
(86, 5, 4, 'BÀN PHÍM LAPTOP DELL E5440 KHÔNG ĐÈN, KHÔNG CHUỘT\n', 539000, 539000, '2021-11-06', 62, 360, NULL, '86.jpg', 0),
(87, 5, 4, 'BỘ BÀN PHÍM CHUỘT KHÔNG DÂY DELL KM117 MÀU ĐEN', 559000, 559000, '2021-11-06', 180, 360, NULL, '87.jpg', 0),
(88, 5, 5, 'Bàn phím cơ gaming Dareu A98\n', 888000, 888000, '2021-11-06', 136, 360, 'Tên: Dareu A98\nMô tả: Keycap ABS Doubleshot', '88.jpg', 0),
(89, 5, 5, 'Bàn phím cơ không dây Dareu EK807G BLACK\n', 666000, 595000, '2021-11-06', 148, 360, 'Tên: Dareu EK807G BLACK\nMô tả: Kết nối 2.4G', '89.jpg', 0),
(90, 5, 5, 'Bàn phím cơ Gaming DAREU EK87 WHITE\n', 599000, 559000, '2021-11-06', 214, 720, 'Tên: ICE-BLUE LED \nMô tả: Mechanical Keyboard', '90.jpg', 0),
(91, 5, 5, 'Bàn phím cơ không dây DAREU EK861 61KEY\n', 1266000, 1266000, '2021-11-06', 235, 360, 'Tên: DAREU EK861 61KEY\nMô tả: Layout：61Key / Key Cap:PBT+Thermal sublimation ', '91.jpg', 0),
(92, 5, 5, 'Bàn phím cơ DAREU A87 SWALLOW\n', 1799000, 1550000, '2021-01-23', 164, 360, 'Tên: DAREU A87 SWALLOW\nMô tả: Sử dụng Cherry switch cao cấp / Dây kết nối USB Type-C có thể tháo rời', '92.jpg', 0),
(93, 5, 5, 'Bàn phím cơ Gaming DAREU EK884 84KEY\n', 990000, 899000, '2021-01-23', 109, 360, 'Tên: DAREU EK884 84KEY\nMô tả: Cổng USB TypeC tháo rời /Led RGB', '93.jpg', 0),
(94, 6, 6, 'LG TONE Free FP9', 3189200, 3189200, '2021-01-23', 134, 720, 'Công nghệ âm thanh: Meridian/Xuyên âm/Xử lý Tín hiệu Số (DSP)\nMicro: Mic đàm thoại\nPhương thức điều khiển: Cảm ứng chạm', '94.jpg', 0),
(95, 6, 6, 'LG TONE Free FP8', 2723500, 2623500, '2021-01-23', 95, 720, 'Công nghệ âm thanh: Active Noise CancellationMeridian\nMicro: Mic đàm thoại\nKết nối: TONE Free', '95.jpg', 0),
(96, 6, 6, 'LG TONE Free FP4', 2152800, 1952800, '2021-01-23', 54, 720, 'Công nghệ âm thanh: Meridian/Xuyên âm/Xử lý Tín hiệu Số (DSP)\nMicro: Mic đàm thoại\nPhương thức điều khiển: Cảm ứng chạm', '96.jpg', 0),
(97, 6, 6, 'LG TONE Free FP5', 2414500, 2414500, '2021-01-23', 206, 720, 'Công nghệ âm thanh: Meridian/Xuyên âm/Xử lý Tín hiệu Số (DSP)\nMicro: Mic đàm thoại\nPhương thức điều khiển: Cảm ứng chạm', '97.jpg', 0),
(98, 6, 6, 'LG TONE Free FN7', 1919500, 1919500, '2021-01-23', 235, 720, 'Công nghệ âm thanh: Meridian/Xuyên âm/Xử lý Tín hiệu Số (DSP)\nMicro: Mic đàm thoại\nPhương thức điều khiển: Cảm ứng chạm', '98.jpg', 0),
(99, 6, 6, 'LG TONE Free FN6', 1534500, 1334500, '2021-01-23', 163, 720, 'Công nghệ âm thanh: Headphone Spatial ProcessingMeridianTruyền phát nhạc MQA\nMicro: TONE Free\nKết nối: Cảm ứng chạm', '99.jpg', 0),
(100, 6, 6, 'HBS-SL5', 3490000, 3390000, '2021-01-23', 128, 720, 'Công nghệ âm thanh: In-ear\nMicro: Mic đàm thoại\nKết nối: Bluetooth 5.0', '100.jpg', 0),
(101, 6, 6, 'TONE Flex XL7', 1990000, 1990000, '2021-01-23', 110, 720, 'Công nghệ âm thanh: Meridian\nMicro: đàm thoại kép\nKết nối: Google Assistant', '101.jpg', 0),
(102, 6, 6, 'HBS-SL6S', 2490000, 2490000, '2021-05-20', 96, 720, 'Công nghệ âm thanh: Meridian\nMicro: đàm thoại kép\nKết nối: Bluetooth 5.0', '102.jpg', 0),
(103, 6, 1, 'Bluetooth AirPods Pro MagSafe Charge Apple MLWK3', 6790000, 6590000, '2021-05-20', 170, 360, 'Công nghệ âm thanh: Active Noise CancellationAdaptive EQTransparency Mode\nMicro: Đàm thoại \nKết nối: Bluetooth 5.0', '103.jpg', 0),
(104, 6, 1, 'Tai nghe Bluetooth AirPods 2 Apple MV7N2', 3590000, 3390000, '2021-05-20', 82, 360, 'Công nghệ âm thanh: Active Noise CancellationAdaptive EQTransparency Mode\nMicro: Đàm thoại \nKết nối: Bluetooth 5.0', '104.jpg', 0),
(105, 6, 1, 'Tai nghe Bluetooth AirPods 3 Apple MME73', 4990000, 4990000, '2021-05-20', 239, 360, 'Công nghệ âm thanh: Active Noise CancellationAdaptive EQTransparency Mode\nMicro: Đàm thoại \nKết nối: Bluetooth 5.0', '105.jpg', 0),
(106, 6, 1, 'Tai nghe Bluetooth AirPods Pro Wireless Charge A', 5490000, 49490000, '2021-05-20', 174, 360, 'Công nghệ âm thanh: Active Noise CancellationAdaptive EQTransparency Mode\nMicro: Đàm thoại \nKết nối: Bluetooth 5.0', '106.jpg', 0),
(107, 6, 3, 'Tai nghe EP Gaming Asus Rog Cetra II Core', 1161000, 1121000, '2021-05-20', 132, 360, 'Công nghệ âm thanh: không có\nMicro: Mic đàm thoại \nKết nối: Jack cắm', '107.jpg', 0),
(108, 6, 3, 'Tai nghe Có Dây Chụp Tai Gaming Asus TUF H3', 891000, 871000, '2021-05-20', 203, 360, 'Công nghệ âm thanh: Âm thanh vòm 7.1\nMicro: Mic đàm thoại \nKết nối: Jack cắm', '108.jpg', 0),
(109, 1, 2, 'Samsung Galaxy Z Flip3 5G 128GB', 24990000, 23990000, '2021-12-25', 215, 360, '\"Màn hình: Full HD+ (1080 x 2640 Pixels) \nRAM: 8 GB\nCamera: 12 MP - 12 MP.\nPin: 3.300 mAh\"\n', '109.jpg', 0),
(110, 1, 1, 'iPhone 13 Pro', 30990000, 29990000, '2021-12-18', 193, 360, 'Màn hình: 1170 x 2532 pixels\nRAM: 4 GB\nCamera: 12 MP.\nPin: 3,095mAh', '110.jpg', 0),
(111, 1, 1, 'iPhone 12 Mini 64GB', 18999000, 15499000, '2021-12-20', 76, 360, 'Màn hình: OLED\nRAM: 6 GB\nCamera: 12 MP.\nPin: Li-Ion, sạc nhanh 20W, sạc không dây 15W, USB Power Delivery 2.0', '111.jpg', 0),
(112, 6, 11, 'Loa Bluetooth JBL Go 3', 990000, 890000, '2021-12-21', 138, 360, 'Công suất: 4.2 W\nPin: 5 giờ\nKết nối: bluetooth 5.1', '112.jpg', 0),
(113, 6, 14, 'Loa Bluetooth Sony SRS-XB13', 1290000, 1190000, '2021-12-22', 176, 360, 'Công suất: 5W\nPin: Thời gian sử dụng pin lên đến 12 giờ6 (EXTRA BASS™: Lên đến 10 giờ7)\nKết nối: Bluetooth 4.2', '113.jpg', 0),
(114, 6, 13, 'Webcam Logitech HD C270', 1109000, 699000, '2021-12-23', 240, 360, 'Độ phân giải 720p\nHình chụp 3MP\nThiết kế tiêu chuẩn\nTích hợp mic với công nghệ RightSound', '114.jpg', 0),
(115, 4, 15, 'Mainboard MSI A320M-A PRO', 1420000, 1320000, '2021-12-03', 217, 720, 'Thương hiệu :MSI\nChủng loại: A320M-A PRO\nMô tả: Hỗ trợ AMD® Ryzen thế hệ 1 và 2 / Ryzen ™ với Radeon ™ Vega Graphics / Athlon ™ với Radeon ™ Vega Graphics và A-series / Athlon ™ X4\n', '115.jpg', 0),
(116, 4, 12, 'Vỏ case Xigmatek Fadil Arctic 1F', 799000, 679000, '2021-12-25', 86, 720, 'Thương hiệu : Xigmatek\nChủng loại: không có\nMô tả: Hỗ trợ Mainboard Mini-ITX, Micro-ATX', '116.jpg', 0),
(117, 4, 12, 'Vỏ Case Xigmatek Aquarius S Queen', 1799000, 1529000, '2021-12-03', 115, 720, 'Thương hiệu : XIGMATEK\nChủng loại: Mid Tower\nMô tả: Thép SECC phủ đen, Plastic ABS, Nhựa trong suốt', '117.jpg', 0),
(118, 4, 7, 'NGUỒN AERO COOL LUX RGB 550W', 1069000, 959000, '2021-12-03', 113, 720, 'Thương hiệu : AEROCOOL\nChủng loại: Nguồn máy tính\nMô tả: Kích thước 140 mm x  150 mm x 86mm', '118.jpg', 0),
(119, 3, 8, 'PC GAMING AMD 003', 109999000, 90999000, '2021-12-25', 86, 720, 'Màn hình: không có\nCPU: AMD Ryzen 9 5900X\nRAM: 32GB \nMô tả: SSD 1TB/Mainboard: X570', '119.jpg', 0),
(120, 2, 4, 'LAPTOP DELL INSPIRON 5505', 22719000, 22419000, '2021-12-25', 47, 360, 'Màn hình: 15.6 inch FHD\nCPU: AMD R7 4700U\nPin: \nRAM: 8GB', '120.jpg', 0),
(121, 2, 4, 'LAPTOP DELL VOSTRO 3510', 22489000, 21199000, '2021-12-18', 140, 360, 'Màn hình: 15.6-inch FHD (1920 x 1080)\nCPU: Intel Core i5 1135G7 (2.4Ghz/8MB cache)\nPin: \nRAM: 8GB', '121.jpg', 0),
(122, 2, 4, 'LAPTOP DELL ALIENWARE GAMING M15 R6', 58999000, 58999000, '2021-12-18', 165, 360, 'Màn hình: 15.6 inch FHD (1920x1080)\nCPU: Intel Core i7-10750H\nPin: 4 Cell 68Whr\nRAM: 16GB', '122.jpg', 0),
(123, 2, 1, 'MacBook Pro 13\" 2020 Touch Bar M1', 34999000, 34999000, '2021-12-18', 178, 360, 'Màn hình: 13.3 inches\nCPU:  Intel Core i7-10750H\nPin: 58.2-watt-hour lithium-polymer\nRAM: 8GB', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`, `is_deleted`) VALUES
(1, 'Smartphone', 0),
(2, 'Laptop', 0),
(3, 'PC', 0),
(4, 'Linh Kiện PC', 0),
(5, 'Chuột - Bàn phím', 0),
(6, 'Phụ kiện khác', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'super admin'),
(2, 'admin'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Chưa xác nhận'),
(2, 'Đã xác nhận'),
(3, 'Đang giao hàng'),
(4, 'Hoàn thanh'),
(5, 'Đã huỷ');

-- --------------------------------------------------------

--
-- Table structure for table `user_bill`
--

CREATE TABLE `user_bill` (
  `id` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `user_id` varchar(12) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_mode_id` int(11) NOT NULL,
  `note` varchar(250) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `deliver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `user_bill`
--

INSERT INTO `user_bill` (`id`, `user_id`, `status_id`, `total`, `address`, `created_time`, `payment_mode_id`, `note`, `deliver_id`) VALUES
('u10', '123', 1, 90677000, '', '2022-01-07 19:25:21', 2, '', NULL),
('u11', '123', 1, 90677000, '', '2022-01-07 19:27:02', 2, '', NULL),
('u12', '123', 1, 90677000, '', '2022-01-07 19:28:47', 2, '', NULL),
('u13', '123', 1, 90677000, '', '2022-01-07 19:30:17', 2, '', NULL),
('u14', '123', 1, 90677000, '', '2022-01-07 19:31:48', 2, '', NULL),
('u15', '123', 1, 90677000, '', '2022-01-07 19:33:01', 2, '', NULL),
('u16', '123', 1, 90677000, '', '2022-01-07 19:34:09', 2, '', NULL),
('u17', '123', 1, 90677000, '', '2022-01-07 19:35:34', 2, '', NULL),
('u18', '123', 1, 90677000, '', '2022-01-07 19:37:06', 2, '', NULL),
('u19', '123', 1, 90677000, '', '2022-01-07 19:38:19', 2, '', NULL),
('u20', '123', 1, 90677000, '', '2022-01-07 19:39:30', 2, '', NULL),
('u21', '123', 1, 90677000, '', '2022-01-07 19:43:39', 2, '', NULL),
('u22', '123', 1, 90677000, '', '2022-01-07 19:45:14', 2, '', NULL),
('u23', '123', 1, 90677000, '', '2022-01-07 19:46:47', 2, '', NULL),
('u24', '123', 1, 90677000, '', '2022-01-07 19:48:04', 2, '', NULL),
('u25', '123', 1, 90677000, '', '2022-01-07 19:49:27', 2, '', NULL),
('u26', '123', 1, 90677000, '', '2022-01-07 19:53:38', 2, '', NULL),
('u27', '02', 1, 34490000, '', '2022-01-07 21:12:35', 1, '', NULL),
('u28', '0973360301', 1, 93240000, '', '2022-01-07 22:51:47', 2, '', NULL),
('u29', '0973360301', 1, 49680000, '', '2022-01-07 22:51:54', 2, '', NULL),
('u3', '123', 1, 33278000, '', '2022-01-07 19:07:38', 2, '', NULL),
('u30', '0973360301', 1, 18690000, '', '2022-01-07 23:41:20', 2, '', NULL),
('u31', '123', 1, 12842000, 'string', '2022-01-08 04:32:58', 1, '', NULL),
('u32', '123', 1, 12842000, 'test', '2022-01-08 04:35:08', 1, '', NULL),
('u33', '123', 1, 12842000, 'string', '2022-01-08 04:42:13', 1, '', NULL),
('u34', '123', 1, 153099000, 'string', '2022-01-08 07:15:12', 1, '', NULL),
('u36', '123', 1, 153099000, 'string', '2022-01-08 07:17:11', 1, '', NULL),
('u37', '123', 1, 153099000, 'string', '2022-01-08 07:17:47', 1, '', NULL),
('u38', '123', 1, 153099000, 'string', '2022-01-08 07:18:29', 1, '', NULL),
('u39', '123', 1, 153099000, 'string', '2022-01-08 07:20:02', 1, '', NULL),
('u4', '123', 1, 95237000, '', '2022-01-07 19:07:30', 2, '', NULL),
('u40', '123', 1, 153099000, 'string', '2022-01-08 07:21:46', 1, '', NULL),
('u41', '123', 1, 153099000, 'string', '2022-01-08 07:22:38', 1, '', NULL),
('u42', '123', 2, 153099000, 'string', '2022-01-08 07:23:40', 1, '', NULL),
('u43', '123', 2, 153099000, 'string', '2022-01-08 07:24:48', 1, '', NULL),
('u45', '123', 2, 153099000, '', '2022-01-08 07:26:26', 1, '', NULL),
('u46', '123', 3, 92689000, 'test 11/1', '2022-01-11 05:44:27', 1, '', 1),
('u5', '123', 1, 64268000, '', '2022-01-07 19:07:07', 2, '', NULL),
('u6', '123', 1, 90677000, '', '2022-01-07 19:07:48', 2, '', NULL),
('u7', '123', 1, 90677000, '', '2022-01-07 19:15:27', 2, '', NULL),
('u8', '123', 1, 90677000, '', '2022-01-07 19:17:54', 2, '', NULL),
('u9', '123', 1, 90677000, '', '2022-01-07 19:21:04', 2, '', NULL);

--
-- Triggers `user_bill`
--
DELIMITER $$
CREATE TRIGGER `tg_userBill_insert` BEFORE INSERT ON `user_bill` FOR EACH ROW BEGIN
  INSERT INTO user_bill_seq VALUES (NULL);
  SET NEW.id = CONCAT('u',LAST_INSERT_ID());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_bill_detail`
--

CREATE TABLE `user_bill_detail` (
  `bill_id` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `user_bill_detail`
--

INSERT INTO `user_bill_detail` (`bill_id`, `product_id`, `quantity`) VALUES
('u3', 103, 1),
('u3', 11, 1),
('u3', 120, 1),
('u3', 113, 1),
('u3', 117, 1),
('u3', 92, 1),
('u4', 11, 2),
('u4', 103, 1),
('u4', 120, 1),
('u4', 113, 1),
('u4', 117, 2),
('u4', 92, 1),
('u5', 11, 1),
('u5', 103, 1),
('u5', 120, 1),
('u5', 113, 1),
('u5', 117, 1),
('u5', 92, 1),
('u6', 103, 1),
('u6', 11, 1),
('u6', 120, 1),
('u6', 113, 1),
('u6', 117, 1),
('u6', 92, 1),
('u6', 75, 1),
('u6', 68, 1),
('u7', 103, 1),
('u7', 11, 1),
('u7', 113, 1),
('u7', 117, 1),
('u7', 92, 1),
('u7', 75, 1),
('u7', 120, 1),
('u7', 68, 1),
('u8', 103, 1),
('u8', 11, 1),
('u8', 120, 1),
('u8', 113, 1),
('u8', 117, 1),
('u8', 92, 1),
('u8', 75, 1),
('u8', 68, 1),
('u9', 103, 1),
('u9', 11, 1),
('u9', 120, 1),
('u9', 113, 1),
('u9', 117, 1),
('u9', 92, 1),
('u9', 75, 1),
('u9', 68, 1),
('u10', 103, 1),
('u10', 11, 1),
('u10', 120, 1),
('u10', 113, 1),
('u10', 117, 1),
('u10', 92, 1),
('u10', 75, 1),
('u10', 68, 1),
('u11', 103, 1),
('u11', 11, 1),
('u11', 120, 1),
('u11', 113, 1),
('u11', 117, 1),
('u11', 92, 1),
('u11', 75, 1),
('u11', 68, 1),
('u12', 103, 1),
('u12', 11, 1),
('u12', 120, 1),
('u12', 113, 1),
('u12', 117, 1),
('u12', 92, 1),
('u12', 75, 1),
('u12', 68, 1),
('u13', 103, 1),
('u13', 11, 1),
('u13', 120, 1),
('u13', 113, 1),
('u13', 117, 1),
('u13', 92, 1),
('u13', 75, 1),
('u13', 68, 1),
('u14', 103, 1),
('u14', 11, 1),
('u14', 120, 1),
('u14', 113, 1),
('u14', 117, 1),
('u14', 92, 1),
('u14', 75, 1),
('u14', 68, 1),
('u15', 103, 1),
('u15', 11, 1),
('u15', 120, 1),
('u15', 113, 1),
('u15', 117, 1),
('u15', 92, 1),
('u15', 75, 1),
('u15', 68, 1),
('u16', 103, 1),
('u16', 11, 1),
('u16', 120, 1),
('u16', 113, 1),
('u16', 117, 1),
('u16', 92, 1),
('u16', 75, 1),
('u16', 68, 1),
('u17', 103, 1),
('u17', 11, 1),
('u17', 120, 1),
('u17', 113, 1),
('u17', 117, 1),
('u17', 92, 1),
('u17', 75, 1),
('u17', 68, 1),
('u18', 103, 1),
('u18', 11, 1),
('u18', 120, 1),
('u18', 113, 1),
('u18', 117, 1),
('u18', 92, 1),
('u18', 75, 1),
('u18', 68, 1),
('u19', 103, 1),
('u19', 11, 1),
('u19', 120, 1),
('u19', 113, 1),
('u19', 117, 1),
('u19', 92, 1),
('u19', 75, 1),
('u19', 68, 1),
('u20', 103, 1),
('u20', 11, 1),
('u20', 120, 1),
('u20', 113, 1),
('u20', 117, 1),
('u20', 92, 1),
('u20', 75, 1),
('u20', 68, 1),
('u21', 103, 1),
('u21', 11, 1),
('u21', 120, 1),
('u21', 113, 1),
('u21', 117, 1),
('u21', 92, 1),
('u21', 75, 1),
('u21', 68, 1),
('u22', 103, 1),
('u22', 11, 1),
('u22', 120, 1),
('u22', 113, 1),
('u22', 117, 1),
('u22', 92, 1),
('u22', 75, 1),
('u22', 68, 1),
('u23', 103, 1),
('u23', 11, 1),
('u23', 120, 1),
('u23', 113, 1),
('u23', 117, 1),
('u23', 92, 1),
('u23', 75, 1),
('u23', 68, 1),
('u24', 103, 1),
('u24', 11, 1),
('u24', 120, 1),
('u24', 113, 1),
('u24', 117, 1),
('u24', 92, 1),
('u24', 75, 1),
('u24', 68, 1),
('u25', 103, 1),
('u25', 11, 1),
('u25', 120, 1),
('u25', 113, 1),
('u25', 117, 1),
('u25', 92, 1),
('u25', 75, 1),
('u25', 68, 1),
('u26', 103, 1),
('u26', 11, 1),
('u26', 120, 1),
('u26', 113, 1),
('u26', 117, 1),
('u26', 92, 1),
('u26', 75, 1),
('u26', 68, 1),
('u27', 51, 1),
('u27', 13, 1),
('u41', 10, 4),
('u43', 10, 4),
('u43', 11, 2),
('u43', 68, 1),
('u45', 10, 4),
('u45', 11, 2),
('u45', 68, 1),
('u46', 13, 4),
('u46', 12, 1),
('u46', 68, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_bill_seq`
--

CREATE TABLE `user_bill_seq` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `user_bill_seq`
--

INSERT INTO `user_bill_seq` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(45),
(46);

-- --------------------------------------------------------

--
-- Table structure for table `usr`
--

CREATE TABLE `usr` (
  `id` varchar(12) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `PASSWORD` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `usr`
--

INSERT INTO `usr` (`id`, `role_id`, `PASSWORD`, `name`, `mail`, `address`, `is_deleted`) VALUES
('02', 3, '1', 'Test case 02', NULL, NULL, 0),
('0973360300', 3, '1', 'Nguyễn Văn A', NULL, NULL, 0),
('0973360301', 1, 'Hung2001@', 'Nguyen Ngoc Hung', NULL, NULL, 0),
('123', 3, '1', 'Test case 01', NULL, NULL, 0),
('1234567890', 3, '1', 'user second', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `deliver`
--
ALTER TABLE `deliver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest_bill`
--
ALTER TABLE `guest_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `payment_mode_id` (`payment_mode_id`),
  ADD KEY `deliver_id` (`deliver_id`);

--
-- Indexes for table `guest_bill_detail`
--
ALTER TABLE `guest_bill_detail`
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `guest_bill_seq`
--
ALTER TABLE `guest_bill_seq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_mode`
--
ALTER TABLE `payment_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_type_id` (`product_type_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_bill`
--
ALTER TABLE `user_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `payment_mode_id` (`payment_mode_id`),
  ADD KEY `deliver_id` (`deliver_id`);

--
-- Indexes for table `user_bill_detail`
--
ALTER TABLE `user_bill_detail`
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user_bill_seq`
--
ALTER TABLE `user_bill_seq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usr`
--
ALTER TABLE `usr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `deliver`
--
ALTER TABLE `deliver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guest_bill_seq`
--
ALTER TABLE `guest_bill_seq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_mode`
--
ALTER TABLE `payment_mode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_bill_seq`
--
ALTER TABLE `user_bill_seq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usr` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `guest_bill`
--
ALTER TABLE `guest_bill`
  ADD CONSTRAINT `guest_bill_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `guest_bill_ibfk_2` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`id`),
  ADD CONSTRAINT `guest_bill_ibfk_3` FOREIGN KEY (`deliver_id`) REFERENCES `deliver` (`id`);

--
-- Constraints for table `guest_bill_detail`
--
ALTER TABLE `guest_bill_detail`
  ADD CONSTRAINT `guest_bill_detail_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `guest_bill` (`id`),
  ADD CONSTRAINT `guest_bill_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

--
-- Constraints for table `user_bill`
--
ALTER TABLE `user_bill`
  ADD CONSTRAINT `user_bill_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usr` (`id`),
  ADD CONSTRAINT `user_bill_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `user_bill_ibfk_3` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`id`),
  ADD CONSTRAINT `user_bill_ibfk_4` FOREIGN KEY (`deliver_id`) REFERENCES `deliver` (`id`);

--
-- Constraints for table `user_bill_detail`
--
ALTER TABLE `user_bill_detail`
  ADD CONSTRAINT `user_bill_detail_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `user_bill` (`id`),
  ADD CONSTRAINT `user_bill_detail_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `usr`
--
ALTER TABLE `usr`
  ADD CONSTRAINT `usr_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
