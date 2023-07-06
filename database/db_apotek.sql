-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2023 at 03:32 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2023 at 03:32 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_025`
--
CREATE DATABASE IF NOT EXISTS `db_apotek` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_apotek`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `name` varchar(255) NOT NULL,
  `phone_num` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `penyakit` varchar(255) NOT NULL,
  `tgltransaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dt_obat`
--

CREATE TABLE `dt_obat` (
  `drug_id` varchar(255) NOT NULL,
  `drug_name` varchar(255) NOT NULL,
  `buy_price` varchar(255) NOT NULL,
  `sell_price` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dt_transaksi`
--

CREATE TABLE `dt_transaksi` (
  `drug_id` varchar(255) NOT NULL,
  `drug_name` varchar(255) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `drug_amount` varchar(255) NOT NULL,
  `ttl_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ob_masuk`
--

CREATE TABLE `ob_masuk` (
  `trans_id` varchar(255) NOT NULL,
  `entry_date` date NOT NULL,
  `drug_id` varchar(255) NOT NULL,
  `restock_amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `us_admin`
--

CREATE TABLE `us_admin` (
  `id_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `us_admin`
--

INSERT INTO `us_admin` (`id_user`, `username`, `password`) VALUES
('A001', 'maesha', 'maesha'),
('A002', 'aurel', 'aurel'),
('A003', 'ramadhan', 'ramadhan'),
('A004', 'diva', 'diva'),
('A005', 'hilman', 'hilman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dt_obat`
--
ALTER TABLE `dt_obat`
  ADD PRIMARY KEY (`drug_id`);

--
-- Indexes for table `ob_masuk`
--
ALTER TABLE `ob_masuk`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `us_admin`
--
ALTER TABLE `us_admin`
  ADD PRIMARY KEY (`id_user`);