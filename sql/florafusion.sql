-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 11:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `florafusion`
--

-- --------------------------------------------------------

--
-- Table structure for table `best_store`
--

CREATE TABLE `best_store` (
  `store_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `best_store`
--

INSERT INTO `best_store` (`store_id`, `seller_id`, `customer_id`, `rating`, `date`) VALUES
(1, 39, 36, 5, '2024-01-15'),
(2, 39, 36, 5, '2024-01-15'),
(3, 39, 36, 2, '2024-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `typeOfComplaints` int(11) NOT NULL,
  `selectType` int(11) NOT NULL,
  `shopName` varchar(225) NOT NULL,
  `sellerName` varchar(225) NOT NULL,
  `orderNo` int(11) NOT NULL,
  `yourName` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phoneNo` int(11) NOT NULL,
  `comments` text NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `typeOfComplaints`, `selectType`, `shopName`, `sellerName`, `orderNo`, `yourName`, `email`, `phoneNo`, `comments`, `image`, `date`) VALUES
(9, 1, 4, 'Purplebox Garden', 'JD Seller', 5, 'Janah Darielyn Germo', 'jd@gmail.com', 2147483647, 'Di mao ang product naabot.', 'Philodendron.jpg', '2023-12-22 11:26:58'),
(10, 1, 4, 'Purplebox Garden', 'JD Seller', 5, 'Janah Darielyn Germo', 'jd@gmail.com', 2147483647, 'My order is not what a ordered', 'Philodendron2.jpg', '2023-12-22 18:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id`, `sender_id`, `receiver_id`, `created_at`) VALUES
(13, 42, 37, '2023-12-22 18:35:59'),
(16, 42, 39, '2023-12-23 10:38:16');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `inbox_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `inbox_id`, `sender_id`, `receiver_id`, `message`, `created_at`) VALUES
(16, 12, 42, 37, 'Hi, is this available?', '2023-12-22 18:34:59'),
(17, 13, 42, 37, 'Hi, is this available?', '2023-12-22 18:36:04'),
(18, 13, 37, 42, 'Hi Janah Germo, Thank you for reaching out! We appreciate your interest in our plants. I\'m happy to inform you that we have a variety of plants in stock. Could you please specify the type or species of plants you\'re looking for, so I can provide you with more detailed information?', '2023-12-22 18:38:28'),
(19, 13, 42, 37, 'Thanks for your quick response! I\'m actually looking for some indoor plants that are low-maintenance and suitable for beginners. What options do you have available?', '2023-12-22 18:41:06'),
(20, 13, 37, 42, 'Great to hear that you\'re interested in adding some indoor greenery to your space! We have a fantastic selection of low-maintenance indoor plants that are perfect for beginners. Here are a few options:  Snake Plant (Sansevieria): Known for its air-purifying qualities, the snake plant is easy to care for and can thrive in various lighting conditions.  ZZ Plant (Zamioculcas Zamiifolia): This plant is highly resilient and can tolerate low light. It\'s an excellent choice for those who are just starting their indoor plant journey.  Pothos (Epipremnum Aureum): Pothos is a trailing plant that does well in indirect light. It\'s known for its durability and ability to thrive in different environments.  Spider Plant (Chlorophytum comosum): With its arching leaves and air-purifying qualities, the spider plant is another great option for beginners.  Feel free to let me know if any of these catch your eye or if you have specific requirements in mind. I\'m here to assist you in finding the perfect indoor plants for your space. ', '2023-12-22 18:43:31'),
(21, 13, 42, 37, 'hiii', '2023-12-23 05:42:59'),
(22, 16, 42, 39, 'Hi, is this available?', '2023-12-23 10:38:23'),
(23, 16, 39, 42, 'yes', '2023-12-23 10:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `my_cart`
--

CREATE TABLE `my_cart` (
  `cart_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_price` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `is_checkout` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `my_cart`
--

INSERT INTO `my_cart` (`cart_id`, `seller_id`, `customer_id`, `product_id`, `product_price`, `quantity`, `is_checkout`) VALUES
(23, 37, 42, 71, 400, 7, 1),
(24, 37, 37, 70, 200, 1, 0),
(25, 37, 37, 71, 400, 1, 0),
(26, 39, 42, 62, 300, 1, 1),
(27, 39, 42, 64, 360, 10, 1),
(28, 37, 42, 66, 360, 1, 1),
(32, 39, 39, 64, 360, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `orders_image` text NOT NULL,
  `order_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `seller_id`, `product_id`, `quantity`, `total_amount`, `orders_image`, `order_date`) VALUES
(16, 36, 37, 66, 1, 360.00, '', '2024-01-16 06:58:20'),
(17, 36, 37, 70, 1, 200.00, '', '2024-01-17 01:47:49'),
(18, 36, 37, 67, 1, 250.00, '', '2024-01-17 01:48:12'),
(19, 36, 37, 70, 1, 200.00, '', '2024-01-17 01:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `product_image` text NOT NULL,
  `product_image2` text NOT NULL,
  `product_image3` text NOT NULL,
  `product_name` varchar(225) NOT NULL,
  `product_qty` int(11) NOT NULL COMMENT 'comment quantity',
  `product_price` int(11) NOT NULL,
  `product_des` varchar(225) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 if standard 2 if best seller',
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_ID`, `userID`, `product_image`, `product_image2`, `product_image3`, `product_name`, `product_qty`, `product_price`, `product_des`, `status`, `created_date`) VALUES
(62, 39, 'cactus.jpg', 'cactus1.jpg', 'cactus2.jpg', 'Cactus', 100, 300, 'Cactuses, or cacti, are desert plants.', 1, '2023-12-20 03:08:27'),
(64, 39, 'Spider Plant.jpg', 'Spider Plant1.jpg', 'Spider Plant2.jpg', 'Spider Plant', 90, 360, 'This herbaceous plant, has narrow, strap-shaped leaves. ', 1, '2023-12-20 03:14:12'),
(66, 37, 'Lavender.jpg', 'Lavender1.jpg', 'Lavender2.jpg', 'Lavender', 399, 360, 'A medium purple or a light pinkish-purple. ', 1, '2024-01-16 06:58:20'),
(67, 37, 'Orchids.jpg', 'Orchids1.jpg', 'Orchids2.jpg', 'Orchids', 499, 250, 'Plants prized for their beautiful and unique flowers.', 1, '2024-01-17 01:48:12'),
(70, 37, 'Sun Flower.jpg', 'Sun FLower1.jpg', 'Sun Flower2.jpg', 'Sun Flower', 338, 200, 'Pretty, bright yellow flowering plants known for their striking appearance.', 1, '2024-01-17 01:48:42'),
(71, 37, 'Venus Flytrap.jpg', 'Venus Flytrap1.jpg', 'Venus Flytrap2.jpg', 'Venus Flytrap', 0, 400, 'Each leaf has a flat stalk and ends in a trap.', 1, '2024-01-15 10:34:52'),
(72, 42, 'Philodendron1.jpg', 'Chrysanthemum1.jpg', 'Chrysanthemum2.jpg', 'Lavender', 123, 123, '123', 1, '2024-01-17 01:34:55');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review_text` longtext DEFAULT NULL,
  `review_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `customer_id`, `seller_id`, `product_id`, `rating`, `review_text`, `review_date`) VALUES
(117, 36, 37, 66, 5, 'best seller ever', '2023-12-21 20:57:12'),
(118, 36, 37, 66, 4, 'thank you.....', '2023-12-23 13:46:38'),
(119, 42, 37, 71, 4, 'thank you.....', '2023-12-23 13:46:38'),
(121, 36, 37, 66, 5, 'thank you', '2023-12-23 18:27:18'),
(122, 42, 37, 71, 5, 'thank you', '2023-12-23 18:27:18'),
(123, 42, 39, 62, 5, 'thank you', '2023-12-23 18:27:18'),
(124, 36, 37, 66, 5, 'thank you', '2023-12-23 18:27:43'),
(125, 42, 37, 71, 5, 'thank you', '2023-12-23 18:27:43'),
(126, 42, 39, 62, 5, 'thank you', '2023-12-23 18:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `paymethod` int(11) NOT NULL,
  `image` text NOT NULL,
  `plant_image` text NOT NULL,
  `status` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `customer_id`, `seller_id`, `product_id`, `amount`, `paymethod`, `image`, `plant_image`, `status`, `date`) VALUES
(14, 42, 39, 62, 300, 1, 'Chrysanthemum2.jpg', 'cactus.jpg', 1, '2024-01-17 05:09:32'),
(15, 42, 39, 64, 360, 1, 'gcash.jpg', 'Spider Plant.jpg', 0, '2024-01-17 05:09:34'),
(17, 36, 37, 70, 200, 2, 'Chrysanthemum1.jpg', 'Sun Flower.jpg', 2, '2024-01-17 10:08:21'),
(18, 36, 37, 67, 250, 2, 'gcash.jpg', 'Orchids.jpg', 4, '2024-01-17 09:53:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `disabled` int(11) NOT NULL,
  `image` text NOT NULL,
  `qr_image` text NOT NULL,
  `current_add` varchar(225) NOT NULL,
  `permanent_add` varchar(225) NOT NULL,
  `shop_name` varchar(225) NOT NULL,
  `contact_no` text NOT NULL,
  `gender` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `email`, `password`, `role`, `status`, `disabled`, `image`, `qr_image`, `current_add`, `permanent_add`, `shop_name`, `contact_no`, `gender`, `birthday`, `created_date`) VALUES
(36, 'Janah Darielyn Germo', 'jd@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, 0, 'jd.jpg', 'cod_qr.png', 'Dapitan Cordova', 'Cebu ', 'Unique Plants', '09999728571', 2, '2023-12-19', '2023-12-19 02:23:56'),
(37, 'JD Seller', 'seller@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 1, 0, 'jd.jpg', 'cod_qr.png', 'Cebu City', 'Inyuha Cebu CIty', 'Purplebox Garden', '0987654321', 2, '2023-12-19', '2023-12-19 02:25:58'),
(38, 'JD Admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 0, 1, 0, 'janah.jpg', '', 'Cebu City', 'Cebu City', '', '09876521234', 2, '2023-12-19', '2023-12-19 02:27:15'),
(39, 'Seller 2', 'seller1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 1, 0, 'jd.jpg', 'cod_qr.png', 'Cebu City', 'cebu', 'nice garden', '09876521234', 2, '2023-12-19', '2023-12-19 13:08:54'),
(41, 'Dana', 'dana@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 1, 0, 'dc61a59b904ef19e3bbb3f167669bdae.png', '', 'Dapitan Cordova Cebu', 'dapitan', '', '09876521234', 2, '2023-12-22', '2023-12-22 11:16:09'),
(42, 'Janah Germo', 'janah@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 1, 0, 'janah.jpg', 'gcash.jpg', 'Cebu City', 'DAPITAN CORDOVA', 'HEAVEN GARDEN', '09999728571', 2, '2000-01-15', '2023-12-22 17:11:50'),
(43, 'Danah Smith', 'danah@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 1, 0, 'jd.jpg', 'cod_qr.png', 'Cebu City', 'Cebu City', 'Green Gardens', '09876521234', 2, '2023-12-23', '2023-12-22 17:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `customer_id`, `product_id`) VALUES
(120, 37, 66),
(121, 36, 67),
(124, 42, 67),
(125, 42, 66),
(126, 36, 70),
(128, 36, 66),
(131, 42, 62),
(132, 36, 64),
(134, 36, 62),
(135, 36, 71);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `best_store`
--
ALTER TABLE `best_store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_cart`
--
ALTER TABLE `my_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_ID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `best_store`
--
ALTER TABLE `best_store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `my_cart`
--
ALTER TABLE `my_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
