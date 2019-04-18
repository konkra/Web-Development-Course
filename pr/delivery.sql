-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 21 Φεβ 2018 στις 09:23:38
-- Έκδοση διακομιστή: 10.1.28-MariaDB
-- Έκδοση PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `delivery`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `apostasi`
--

CREATE TABLE `apostasi` (
  `ID` int(11) NOT NULL,
  `km` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `del_geolocation`
--

CREATE TABLE `del_geolocation` (
  `id` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `geolocation`
--

CREATE TABLE `geolocation` (
  `id` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `katastima`
--

CREATE TABLE `katastima` (
  `ID` int(200) NOT NULL,
  `Name` varchar(255) COLLATE utf8_bin NOT NULL,
  `Address` varchar(255) COLLATE utf8_bin NOT NULL,
  `Phone` varchar(10) COLLATE utf8_bin NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `Manager` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `order_lastname` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone` varchar(10) COLLATE utf8_bin NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `item_price` varchar(11) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `proionta`
--

CREATE TABLE `proionta` (
  `id` int(11) NOT NULL,
  `pname` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Άδειασμα δεδομένων του πίνακα `proionta`
--

INSERT INTO `proionta` (`id`, `pname`, `image`, `price`, `qty`) VALUES
(1, 'Ελληνικός', '1.png', 1.5, 100000),
(2, 'Φραπέ', 'frape.png', 1.5, 100000),
(3, 'Εσπρέσο', '2.png', 1.5, 100000),
(4, 'Kαπουτσίνο', '3.png', 1.7, 100000),
(5, 'Φίλτρου', 'filtrou.png', 1.2, 100000),
(6, 'Τυρόπιτα', '6.png', 1.3, 5),
(7, 'Χορτόπιτα', '7.png', 1.5, 6),
(8, 'Κουλούρι', 'koulouri.png', 0.5, 10),
(9, 'Τοστ', 'tost.png', 1.5, 4),
(10, 'Κέικ', 'keik.png', 1.2, 5);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `ID` int(200) NOT NULL,
  `Username` varchar(255) COLLATE utf8_bin NOT NULL,
  `Password` varchar(255) COLLATE utf8_bin NOT NULL,
  `Name` varchar(255) COLLATE utf8_bin NOT NULL,
  `Surname` varchar(255) COLLATE utf8_bin NOT NULL,
  `Phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `user_permissions` enum('a','b','c') COLLATE utf8_bin NOT NULL DEFAULT 'a',
  `AFM` varchar(10) COLLATE utf8_bin NOT NULL,
  `AMKA` varchar(11) COLLATE utf8_bin NOT NULL,
  `IBAN` varchar(27) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `Name`, `Surname`, `Phone`, `user_permissions`, `AFM`, `AMKA`, `IBAN`) VALUES
(1, 'megaskons@hotmail.com', '$2a$04$RxPjOM4Y8WySlg091pXpNeW7NOCpPQvzq2XiGiAPef/15DPNCpHc.', 'Νικόλας', 'Παπαδόπουλος', '692345473', 'b', '2345234524', '12341241231', '223452452345234523452345768'),
(2, 'megaliot@yahoo.gr', '$2a$04$IK3NfWmF.626x96B5F7.9OLh/JM2zLdYrR68/OGZ6x7S.Iv0xIike', 'Θανάσης', 'Χατζής', '6943295934', 'c', '9384749283', '47294838485', '123948395736492739472983942');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `apostasi`
--
ALTER TABLE `apostasi`
  ADD PRIMARY KEY (`ID`);

--
-- Ευρετήρια για πίνακα `del_geolocation`
--
ALTER TABLE `del_geolocation`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `geolocation`
--
ALTER TABLE `geolocation`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `katastima`
--
ALTER TABLE `katastima`
  ADD PRIMARY KEY (`ID`);

--
-- Ευρετήρια για πίνακα `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `proionta`
--
ALTER TABLE `proionta`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `apostasi`
--
ALTER TABLE `apostasi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `del_geolocation`
--
ALTER TABLE `del_geolocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `geolocation`
--
ALTER TABLE `geolocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `katastima`
--
ALTER TABLE `katastima`
  MODIFY `ID` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `proionta`
--
ALTER TABLE `proionta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
