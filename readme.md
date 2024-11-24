#liên quan

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 23, 2024 at 03:28 PM
-- Server version: 8.0.35
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/_!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT _/;
/_!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS _/;
/_!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION _/;
/_!40101 SET NAMES utf8mb4 _/;

--
-- Database: `nexus_store`
--

---

--
-- Table structure for table `phieunhapkho`
--

CREATE TABLE `phieunhapkho` (
`maPNK` int NOT NULL,
`maNhanVien` int NOT NULL,
`tenNhanVien` varchar(255) NOT NULL,
`ngaylap` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phieunhapkho`
--
ALTER TABLE `phieunhapkho`
ADD PRIMARY KEY (`maPNK`),
ADD KEY `fk_maNhanVien` (`maNhanVien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phieunhapkho`
--
ALTER TABLE `phieunhapkho`
MODIFY `maPNK` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `phieunhapkho`
--
ALTER TABLE `phieunhapkho`
ADD CONSTRAINT `fk_maNhanVien` FOREIGN KEY (`maNhanVien`) REFERENCES `nhanvien` (`maNhanVien`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/_!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT _/;
/_!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS _/;
/_!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION _/;
