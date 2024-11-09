-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2024 at 09:35 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ugso_zg`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('Zaposlenik','Administrator') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'petra', '$2y$10$ev3/rObB59YOiQoyMajIZuQWTFVzELEwjjZRTdSx6ObNhI46ug7qy', 'rundek.petra@gmail.com', 'Zaposlenik'),
(2, 'marko5', '$2y$10$/bCE5yfHMlivaoODU6MCyOol6.quSGpid32DSvebEDlWh6gHqV3cO', 'marko.rundek@gmail.com', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `obrisani_clanovi`
--

DROP TABLE IF EXISTS `obrisani_clanovi`;
CREATE TABLE IF NOT EXISTS `obrisani_clanovi` (
  `id` int NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `razlog` varchar(50) NOT NULL,
  `datum_brisanja` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `up_clanovi`
--

DROP TABLE IF EXISTS `up_clanovi`;
CREATE TABLE IF NOT EXISTS `up_clanovi` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `vrsta` varchar(20) NOT NULL,
  `ime` varchar(20) NOT NULL,
  `prezime` varchar(20) NOT NULL,
  `datum_rodjenja` varchar(20) NOT NULL,
  `oib` varchar(11) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `status` varchar(50) NOT NULL,
  `komunikacija` varchar(255) NOT NULL,
  `ulica` varchar(50) NOT NULL,
  `postanski_broj` varchar(6) NOT NULL,
  `mjesto` varchar(50) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `clanstvo` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `up_clanovi`
--

INSERT INTO `up_clanovi` (`ID`, `vrsta`, `ime`, `prezime`, `datum_rodjenja`, `oib`, `gender`, `status`, `komunikacija`, `ulica`, `postanski_broj`, `mjesto`, `telefon`, `email`, `clanstvo`) VALUES
(2, 'nominalni', 'Marko', 'Marić', '1990-02-02', '2147483647', 'Ž', 'praktična gluhosljepoća', 'taktilni HZJ', 'Ivančići 87', '10453', 'Gorica Svetojanska', '0919884322', 'marko.r@gmail.com', '2000-02-02'),
(6, 'redovni', 'Marko', 'Mirić', '1956-05-11', '80304622820', 'M', 'slabovidnost i gluhoća', 'verbalna, HJZ', 'Samoborska 52', '10000', 'Zagreb', '091-555-3456', 'marko.miric@gmail.com', '2000-04-05'),
(7, 'nominalni', 'Marija', 'Rundek', '2008-02-05', '80304622821', 'Ž', 'slabovidnost i nagluhost', 'Verbalna', 'Ivančići 87', '10000', 'Zagreb', '098-909-2305', 'anica.rundek@gmail.com', '2020-10-24'),
(8, 'redovni', 'Klara', 'Palenkaš', '2006-05-13', '80304622022', 'Ž', 'slabovidnost i gluhoća', 'Pisana, HZJ', 'Fraterščica 91', '10000', 'Zagreb', '091-555-2332', 'klara.palenkas@skole.hr', '2023-05-05'),
(9, 'nominalni', 'Faruk', 'Jusufagić', '1999-05-25', '80304622823', 'M', 'sljepoća i nagluhost', 'verbalna, pisana', 'Nazorova 53', '10000', 'Zagreb', '098-443-9889', 'faruk.jusufagic@gmail.com', '2005-02-25'),
(10, 'redovni', 'Jasmina', 'Matošević', '1989-12-27', '80304622826', 'Ž', 'slabovidnost i nagluhost', 'verbalna, pisana, HZJ', 'Mlinarska 54', '10000', 'Zagreb', '098-233-9045', 'jasmina.matos@gmail.com', '2024-03-25'),
(11, 'redovni', 'Lucija', 'Rudar', '2003-12-22', '80304622825', 'Ž', 'slabovidnost i nagluhost', 'verbalna, pisana', 'Ivančići 87', '10453', 'Jastrebarsko', '095-363-3223', 'lucija.r@gmail.com', '2015-10-31'),
(12, 'redovni', 'Martina', 'Ivanović', '2005-01-14', '80304622826', 'Ž', 'sljepoća i nagluhost', 'verbalna, pisana', 'Ivančići 55', '10453', 'Jastrebarsko', '095-232-9985', 'martinarundek5@gmail.com', '2023-06-27'),
(13, 'redovni', 'Andreja', 'Bukić', '1991-09-06', '80304622827', 'Ž', 'slabovidnost i nagluhost', 'verbalna, pisana', 'Barutanski ogranak V/3', '10000', 'Zagreb', '095-999-0900', 'andreja.bukic@gmail.com', '2007-07-23'),
(14, 'redovni', 'Darko', 'Stojčić', '1949-05-03', '80304622829', 'M', 'praktična gluhosljepoća', 'pisana na dlan, pisana na računalo', 'Ostrogovićeva 5/V.', '10000', 'Zagreb', '099-990-4433', 'darko.stojcic@zg.t-com.hr', '1997-09-22'),
(15, 'redovni', 'Petra', 'Rundek', '1988-01-27', '42428558910', 'Ž', 'praktična gluhosljepoća', 'verbalna, pisana', 'Medveščak 93', '10000', 'Zagreb', '091-972-0320', 'rundek.petra@gmail.com', '2003-04-04'),
(16, 'redovni', 'Marija', 'Livajušić', '1985-09-25', '23345088333', 'Ž', 'sljepoća i nagluhost', 'verbalna, pisana', 'Gjure Szabe 5', '10000', 'Zagreb', '098-555-4343', 'livajusic.marija@gmail.com', '2024-04-05');

CREATE TABLE user_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    username VARCHAR(255) NOT NULL,
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    logout_time TIMESTAMP NULL,
    session_duration INT NULL,
    FOREIGN KEY (user_id) REFERENCES admin_users(id)
);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
