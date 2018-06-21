-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Cze 2018, 20:54
-- Wersja serwera: 10.1.30-MariaDB
-- Wersja PHP: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `gshop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(155) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(2, 'Adidas'),
(3, 'Levis'),
(7, 'Nevenka'),
(8, 'Kawaihae'),
(10, 'Mayoral'),
(11, 'Herkless');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `expire_data` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id`, `name`, `parent`) VALUES
(1, 'Mężczyzna', 0),
(7, 'xx', 2),
(9, 'Kobieta', 0),
(10, 'Chłopiec', 0),
(11, 'Dziewczynka', 0),
(12, 'Podkoszulki', 1),
(14, 'Spodnie', 1),
(17, 'Torebki', 9),
(18, 'Bluzki', 9),
(19, 'Buty', 9),
(20, 'Sweterki', 10),
(21, 'Spodnie', 10),
(22, 'Sukienki', 11);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `feature` tinyint(4) NOT NULL DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `brand`, `category`, `image`, `size`, `feature`, `deleted`, `description`) VALUES
(7, 'Koszula Delux', '55.99', 2, 12, '/GShop/img/products/f60953c302e641b55ec4baa06b78df4d.png', 'mały:14,średni:88,duży:12', 1, 0, 'Koszula ta jest uosobieniem elegancji, kup to!'),
(8, 'Koszula Męska', '44.89', 3, 12, '/GShop/img/products/daf2a3aba341480392c736091dd522c9.png', 'Duży:11', 1, 0, 'Uosobienie atrakcyjności w przystępnej cenie'),
(9, 'Spodnie Niebywałe', '99.99', 3, 14, '/GShop/img/products/6a9f3d0184a7af993ceb1a6fa97f0e32.png', 'Średni:89', 1, 0, 'Niebywałe osiągnięcie ludzkiego rzemiosła, kt&oacute;re aż prosi się by je kupić'),
(10, 'Spodnie Al Pacino', '77.43', 11, 14, '/GShop/img/products/3aeec33c1b814142985f8911aaa75630.png', 'Duże:75', 1, 0, 'Spodnie, w kt&oacute;rych sam Al Pacino chciałby chodzić'),
(11, 'Torebka Sk&oacute;rzana', '125.88', 7, 17, '/GShop/img/products/f5f0a78839257068ab7d2bd4fe450578.png', 'Średni:77', 1, 0, 'Każda kobieta oszaleje na punkcie tej torebki, kt&oacute;ra jest (uwaga) ze sk&oacute;ry '),
(12, 'Bluza Piękna', '122.88', 3, 18, '/GShop/img/products/82e0358962fa7dfcd24bb4e51ffff295.png', 'Średni:11', 1, 0, 'Arcydzieło, warte każdej ceny w złocie'),
(13, 'Buty Tanie', '21.11', 8, 19, '/GShop/img/products/e79f04cf8a753c7d25116ebad9cfd2da.jpg', 'Mały:77,Średni:15', 1, 0, 'Kup je swojej dziewczynie, a zapłacisz 5 razy mniej niż ona by zapłaciła za buty'),
(14, 'Sweterek Wspaniały', '44.44', 11, 20, '/GShop/img/products/5266d14f2c64a5020c639c2e49a16f39.png', 'Bardzo mały:72,Mały:14', 1, 0, 'Świetny materiał, idealne na podpałkę'),
(15, 'Spodnie Modne', '52.11', 11, 21, '/GShop/img/products/bc0245356e256597ad22a7c80f92e3af.png', 'May:54', 1, 0, 'Twoje dziecko chętnie stałoby się tobą by kupić to swojemu dziecku'),
(16, 'Sukienka Przepiękna', '54.88', 10, 22, '/GShop/img/products/a4db1112eb8974b25696492dfa8af017.png', 'Mały:13', 1, 0, 'Nie wiem co to, ale kup pan!');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permissions` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `full_name`, `password`, `join_date`, `last_login_date`, `permissions`) VALUES
(1, 'user', 'Jack Sparrow', '$2y$10$OKMNyLhJAge8mRv3wXw3CeqTJ5SdzcoDI3WrEw787iDw8nIaeA9aW', '2018-04-13 15:24:18', '2018-04-19 21:04:08', ''),
(2, 'admin', 'Dave Lizewski', '$2y$10$V4DpXSC.KH8rIWcgTKqJ7ewV.YrW6MaA6Ld0B6Hb5IxsKN0ZyPSUm', '2018-04-13 15:24:18', '2018-05-15 16:01:58', 'admin,editor'),
(3, 'editor', 'Quentin Tarantino', '$2y$10$aY3QupFPDA4SJdMPXqkVLO0mRRSeYyjWcF4g4AoN6tvRT5vSSDfES', '2018-04-13 15:26:02', '2018-04-19 21:04:54', 'editor');

--
-- Indeksy dla zrzutów tabel
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
