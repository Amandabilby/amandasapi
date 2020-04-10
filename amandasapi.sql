-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 10 apr 2020 kl 22:17
-- Serverversion: 10.4.11-MariaDB
-- PHP-version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `amandasapi`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `cart`
--

INSERT INTO `cart` (`id`, `products_id`, `token`, `status`) VALUES
(15, 5, 'ec3c87057e3ed634a1460dff427965aa', NULL),
(16, 1, 'c2617cac5dbc124458a282811c1aac26', NULL),
(17, 2, 'c2617cac5dbc124458a282811c1aac26', NULL),
(18, 8, 'f92ff5499d8f2d71cbbc5855b5c9df02', NULL),
(19, 7, 'f92ff5499d8f2d71cbbc5855b5c9df02', NULL),
(20, 5, 'fa0de2f01bc76b07553658d652994f6f', NULL),
(21, 8, 'fa0de2f01bc76b07553658d652994f6f', NULL),
(22, 8, 'fa0de2f01bc76b07553658d652994f6f', NULL),
(23, 5, '6709dcfad4578053ee88c9b50f745e52', 'checked out'),
(24, 6, '6709dcfad4578053ee88c9b50f745e52', 'checked out'),
(25, 6, '9fcb6d00c79cf01df6d5d7b1e6ee1fb7', 'checked out'),
(26, 7, '9fcb6d00c79cf01df6d5d7b1e6ee1fb7', 'checked out'),
(27, 8, '9fcb6d00c79cf01df6d5d7b1e6ee1fb7', 'checked out'),
(28, 8, '9fcb6d00c79cf01df6d5d7b1e6ee1fb7', 'checked out'),
(29, 8, '9fcb6d00c79cf01df6d5d7b1e6ee1fb7', 'checked out'),
(30, 7, '9fcb6d00c79cf01df6d5d7b1e6ee1fb7', 'checked out'),
(31, 6, '6d3a8e233182005f5afd39501f345518', 'checked out'),
(32, 6, '6d3a8e233182005f5afd39501f345518', 'checked out'),
(33, 6, '6d3a8e233182005f5afd39501f345518', 'checked out'),
(34, 6, '6d3a8e233182005f5afd39501f345518', 'checked out'),
(35, 6, '6d3a8e233182005f5afd39501f345518', 'checked out'),
(36, 12, '6d3a8e233182005f5afd39501f345518', 'checked out'),
(37, 12, '6d3a8e233182005f5afd39501f345518', 'checked out'),
(38, 1, '6d3a8e233182005f5afd39501f345518', 'checked out'),
(39, 4, '82c272460327d29fd3ef2cdfa3c6fd01', 'checked out'),
(40, 4, '82c272460327d29fd3ef2cdfa3c6fd01', 'checked out'),
(41, 4, '82c272460327d29fd3ef2cdfa3c6fd01', NULL),
(42, 3, '82c272460327d29fd3ef2cdfa3c6fd01', NULL),
(43, 3, '82c272460327d29fd3ef2cdfa3c6fd01', NULL),
(44, 3, 'a649c3075d20e7de1fad43593a054e35', NULL),
(45, 4, 'a649c3075d20e7de1fad43593a054e35', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `price` text NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `date_posted`, `user_id`) VALUES
(1, 'halsband', '99', '2020-04-01 11:26:33', 1),
(2, 'Armband', '100', '2020-04-01 11:33:09', 1337),
(3, 'Armband', '200', '2020-04-01 11:34:13', 1337),
(4, 'Adidasskor', '299', '2020-04-01 11:37:17', 1),
(5, 'Hejsan', '500', '2020-04-01 11:40:04', 1),
(6, 'Rosa sko', '99', '2020-04-01 11:54:02', 1),
(7, 'Linne', '129', '2020-04-01 19:18:32', 1),
(8, 'Blå jeans', '800', '2020-04-01 19:25:38', 1),
(10, 'Vita jeans', '199', '2020-04-09 21:20:46', 1),
(11, 'Mobil', '2000', '2020-04-10 10:50:35', 1),
(12, 'Hej!', '100', '2020-04-10 16:32:34', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_updated` int(11) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `tokens`
--

INSERT INTO `tokens` (`id`, `user_id`, `date_updated`, `token`) VALUES
(2, 3, 1585739057, 'a8405707b6ad8bc5d4f6bdfbe03a9beb'),
(17, 1, 1585918360, 'ec3c87057e3ed634a1460dff427965aa'),
(19, 5, 1585920187, '54ac069b65669b9bad1c68cc910367a1'),
(27, 6, 1586516023, '9fcb6d00c79cf01df6d5d7b1e6ee1fb7'),
(30, 7, 1586539216, '82c272460327d29fd3ef2cdfa3c6fd01'),
(31, 4, 1586541476, 'a649c3075d20e7de1fad43593a054e35');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` text NOT NULL,
  `role` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(8, 'Admin', 'dbba06b11d94596b7169d83fed72e61b', 'helloadmin@php.com', 1),
(9, 'User', '62ae3923eefd39fb45f8d90c3cadfb99', 'hellouser@php.com', NULL);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT för tabell `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
