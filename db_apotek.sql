-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2023 at 09:42 AM
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
-- Database: `db_apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_name` varchar(255) NOT NULL,
  `phone_num` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `penyakit` varchar(255) NOT NULL,
  `tgltransaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_name`, `phone_num`, `alamat`, `penyakit`, `tgltransaksi`) VALUES
('Zara', '081766543329', 'Jl.Cibaduyut No.10', 'Demam', '2023-07-01'),
('David', '082245531889', 'Jl.Pear No.2', 'Masuk Angin', '2023-07-01'),
('Salshabilla', '089644410973', 'Jl. Nangka No,11', 'Asma', '2023-07-03'),
('Rayhan Kusuma', '081255690812', 'Jl. Anggur No.53', 'Asam Urat', '2023-07-04'),
('', '', '', '', '0000-00-00'),
('', '', '', '', '0000-00-00'),
('mNJI', '081255690812', 'Depok', 'Asam Urat', '2023-07-05'),
('aurel', '081255690812', 'Depok', 'Asam Urat', '2023-07-05'),
('aurel', '081255690812', 'Depok', 'Asam Urat', '2023-07-05'),
('aurel', '081255690812', 'Depok', 'Asam Urat', '2023-07-05'),
('Rama', '0', 'gkada', 'sakithati', '2023-07-05'),
('Arya', '081245523118', 'Jl. Anggrek No.12', 'Asam Urat', '2023-07-05'),
('Udin', '08129501293', 'Cikarang Barat', 'Aids', '2023-07-05');

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

--
-- Dumping data for table `dt_obat`
--

INSERT INTO `dt_obat` (`drug_id`, `drug_name`, `buy_price`, `sell_price`, `type`, `stock`) VALUES
('DRG001', 'Albendazol', '16000', '18000', 'Strip', 0),
('DRG002', 'Alopurinol', '10000', '14000', 'Strip', 90),
('DRG003', 'Alprazolam', '80000', '88000', 'Strip', 60),
('DRG004', 'Amilorida', '14000', '15000', 'Strip', 20),
('DRG005', 'Aminofilin', '50000', '52000', 'Botol', 20),
('DRG006', 'Amoxicillin', '6000', '6000', 'Strip', 15),
('DRG007', 'Anastan Forte', '15000', '20000', 'Strip', 34),
('DRG008', 'Antangin JRG', '3000', '5000', 'Strip', 10),
('DRG009', 'Arthemeter', '65000', '68000', 'Botol', 37),
('DRG010', 'Asam Folat', '7000', '8000', 'Strip', 49),
('DRG011', 'Asam Mefenat', '16000', '19000', 'Strip', 90),
('DRG012', 'Asiklovir krim 5%', '3000', '4000', 'Tube', 0),
('DRG013', 'Asiklovir tablet 200 mg', '20000', '26000', 'Strip', 0),
('DRG014', 'Asiklovir tablet 400 mg', '30000', '35000', 'Strip', 98),
('DRG015', 'Atropin Sulfat Tablet', '8000', '10000', 'Strip', 0),
('DRG016', 'Atropin Sulfat Tetes Mata', '60000', '70000', 'Botol', 99),
('DRG017', 'Azatioprin Tablet 50 mg', '26000', '35000', 'Strip', 0),
('DRG018', 'Balsem Lang', '10000', '15000', 'Botol', 0),
('DRG019', 'Benazepril', '16000', '25000', 'Strip', 0),
('DRG020', 'Benzolac', '20000', '25000', 'Tube', 0),
('DRG021', 'Betadine', '6000', '8000', 'Botol', 0),
('DRG022', 'Betametason krim 0,1%', '4.000', '6.000', 'Tube', 0),
('DRG023', 'Betametason tablet 0,5 mg', '10000', '14000', 'Strip', 0),
('DRG024', 'Bisoprolol', '18000', '21000', 'Strip', 0),
('DRG025', 'Bisfosfonat', '35000', '40000', 'Strip', 0),
('DRG026', 'Bromheksin', '6000', '9000', 'Strip', 0),
('DRG027', 'Bodrex', '3000', '4000', 'Strip', 0),
('DRG028', 'Cetirizine', '12000', '16000', 'Strip', 0),
('DRG029', 'Clobetasol', '13000', '16000', 'Tube', 0),
('DRG030', 'Dapson', '42000', '48000', 'Strip', 0),
('DRG031', 'Deksametason', '24000', '29000', 'Strip', 0),
('DRG032', 'Diazepam', '16000', '20000', 'Botol', 0),
('DRG033', 'Digoksin', '19000', '23000', 'Strip', 0),
('DRG034', 'Domperidon', '35000', '40000', 'Strip', 0),
('DRG035', 'Famotidine', '12000', '15000', 'Strip', 0),
('DRG036', 'Fenitoin', '27000', '30000', 'Botol', 0),
('DRG037', 'Gemfibrozil', '53000', '55000', 'Strip', 0),
('DRG038', 'Gentamisin', '25000', '30000', 'Tube', 0),
('DRG039', 'Glipzid', '12000', '15000', 'Tube', 0),
('DRG040', 'Gliserin', '7000', '10000', 'Botol', 0),
('DRG041', 'Glukosa larutan infus', '8000', '10000', 'Botol', 0),
('DRG042', 'Haloperidol', '17000', '20000', 'Strip', 0),
('DRG043', 'Ibuprofen', '8000', '10000', 'Strip', 0),
('DRG044', 'Ketoprofin', '81000', '85000', 'Box', 0),
('DRG045', 'Ketorolac', '59000', '65000', 'Botol', 0),
('DRG046', 'Klomifen', '22000', '25000', 'Strip', 0),
('DRG047', 'Klonidin', '27000', '30000', 'Strip', 0),
('DRG048', 'Konidin', '5000', '8000', 'Strip', 0),
('DRG049', 'Levamisol', '100000', '105000', 'Strip', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dt_transaksi`
--

CREATE TABLE `dt_transaksi` (
  `cus_name` varchar(255) NOT NULL,
  `phone_num` varchar(255) NOT NULL,
  `tgltransaksi` date NOT NULL,
  `drug_amount` varchar(255) NOT NULL,
  `drug_name` varchar(255) NOT NULL,
  `drug_type` varchar(255) NOT NULL,
  `unit_price` varchar(255) NOT NULL,
  `ttl_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dt_transaksi`
--

INSERT INTO `dt_transaksi` (`cus_name`, `phone_num`, `tgltransaksi`, `drug_amount`, `drug_name`, `drug_type`, `unit_price`, `ttl_price`) VALUES
('Zara', '081766543329', '2023-07-01', '2', 'Amoxicillin', 'Strip', '6.000', '12.000'),
('David', '082245531889', '2023-07-01', '1', 'Antangin JRG', 'Strip', '5.000', '5.000'),
('Salshabilla', '089644410973', '2023-07-03', '1', 'Aminofilin', 'Botol', '52.000', '52.000'),
('Rama', '0', '2023-07-05', '1', 'Atropin Sulfat Tetes Mata', 'Strip', '70000', '70000'),
('Arya', '081245523118', '2023-07-05', '2', 'Alopurinol', 'Strip', '14000', '28000'),
('Udin', '08129501293', '2023-07-05', '2', 'Albendazol', 'Strip', '18000', '36000');

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

--
-- Dumping data for table `ob_masuk`
--

INSERT INTO `ob_masuk` (`trans_id`, `entry_date`, `drug_id`, `restock_amount`) VALUES
('TOM001', '2023-06-30', 'DRG001', '12'),
('TOM003', '2023-06-30', 'DRG006', '15'),
('TOM004', '2023-06-30', 'DRG008', '10'),
('TOM005', '2023-07-05', 'DRG001', '60'),
('TOM006', '2023-07-05', 'DRG001', '20'),
('TOM007', '2023-07-05', 'DRG001', '34'),
('TOM008', '2023-07-05', 'DRG001', '37'),
('TOM009', '2023-07-05', 'DRG001', '49'),
('TOM010', '2023-07-05', 'DRG001', '100'),
('TOM011', '2023-07-05', 'DRG001', '90'),
('TOM012', '2023-07-05', 'DRG014', '98');

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
