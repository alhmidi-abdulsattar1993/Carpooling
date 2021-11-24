-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Nov 24, 2021 at 05:19 PM
-- Server version: 8.0.22
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carpooling`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id_booking` int NOT NULL,
  `start_day` datetime NOT NULL,
  `notice_id` int NOT NULL,
  `user_pax_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id_booking`, `start_day`, `notice_id`, `user_pax_id`) VALUES
(4, '2021-10-12 00:00:00', 3, 1),
(5, '2021-10-12 00:00:00', 3, 1),
(7, '2021-12-12 00:00:00', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id_car` int NOT NULL,
  `brand` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `nbrSlots` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id_car`, `brand`, `color`, `model`, `nbrSlots`, `user_id`) VALUES
(1, 'Skoda', 'Noire', 'Fabia', 5, 1),
(2, 'Huandai', 'Rouge', 'Getz', 5, 2),
(3, 'Mercedes', 'Noire', 'Classe C', 4, 3),
(4, 'Renault', 'Bleue', 'Zoé', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id_notice` int NOT NULL,
  `text` text NOT NULL,
  `start_city` varchar(255) NOT NULL,
  `end_city` varchar(255) NOT NULL,
  `user_creator_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id_notice`, `text`, `start_city`, `end_city`, `user_creator_id`) VALUES
(3, 'Départ à 15h00', 'Lyon', 'Limoges', 1),
(4, 'Bla', 'Marseille', 'Paris', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `firstname`, `lastname`, `email`, `birthday`) VALUES
(1, 'Jean', 'DUPONT', 'email.jean@email.fr', '1974-11-09 17:51:41'),
(2, 'Jean-Michel', 'DUPONT', 'email@email.fr', '1995-11-09 17:51:41'),
(3, 'Marc', 'ROBERT', 'marc@email.com', '2000-09-23 17:52:54'),
(4, 'Julien', 'AVRIL', 'monemail@fai.fr', '1980-06-16 17:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `users_bookings`
--

CREATE TABLE `users_bookings` (
  `booking_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users_bookings`
--

INSERT INTO `users_bookings` (`booking_id`, `user_id`) VALUES
(7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_cars`
--

CREATE TABLE `users_cars` (
  `user_id` int NOT NULL,
  `car_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_cars`
--

INSERT INTO `users_cars` (`user_id`, `car_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id_car`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id_notice`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `users_cars`
--
ALTER TABLE `users_cars`
  ADD PRIMARY KEY (`user_id`,`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id_booking` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id_car` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id_notice` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
