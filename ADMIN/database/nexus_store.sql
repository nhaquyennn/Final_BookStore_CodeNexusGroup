-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 10:05 AM
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
-- Database: `nexus_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `anpham`
--

CREATE TABLE `anpham` (
  `maAnPham` int(10) NOT NULL,
  `TenAnPham` int(10) NOT NULL,
  `Gia` float NOT NULL,
  `MoTa` varchar(255) DEFAULT NULL,
  `maCTPM` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chitietpm`
--

CREATE TABLE `chitietpm` (
  `maCTPM` int(10) NOT NULL,
  `MaPhieuMuon` int(10) NOT NULL,
  `maAnPham` int(10) NOT NULL,
  `SoLuong` int(10) NOT NULL,
  `DonGia` float NOT NULL,
  `GiamGia` float NOT NULL,
  `maKM` int(10) NOT NULL,
  `tinhTrangMuon` text DEFAULT NULL,
  `hinhAnh` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `danhmucap`
--

CREATE TABLE `danhmucap` (
  `MaDanhMuc` int(10) NOT NULL,
  `TenDanhMuc` varchar(255) DEFAULT NULL,
  `MoTa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dauap`
--

CREATE TABLE `dauap` (
  `madauAP` int(10) NOT NULL,
  `TenAnPham` varchar(255) DEFAULT NULL,
  `Tacgia` varchar(255) DEFAULT NULL,
  `NXB` varchar(200) NOT NULL,
  `Tongsoluong` int(10) NOT NULL,
  `VitrixepGia` varchar(255) DEFAULT NULL,
  `MaDanhMuc` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoadonnhapap`
--

CREATE TABLE `hoadonnhapap` (
  `MaHoaDon` int(10) NOT NULL,
  `maNhanVien` int(10) NOT NULL,
  `NgayTaoHoaDon` date DEFAULT NULL,
  `TongTien` float NOT NULL,
  `NhaCungCap` varchar(255) DEFAULT NULL,
  `DanhSachAnPham` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `maKH` int(100) NOT NULL,
  `tenKH` text NOT NULL,
  `diaChi` varchar(200) NOT NULL,
  `maNguoiDung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `MaKhuyenMai` int(10) NOT NULL,
  `TenKhuyenMai` varchar(255) DEFAULT NULL,
  `PhanTramGiamgia` float NOT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `NgayBatDau` date DEFAULT NULL,
  `maCTPM` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loaiyc`
--

CREATE TABLE `loaiyc` (
  `maloaiYC` varchar(50) NOT NULL,
  `tenloaiYC` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `maNguoiDung` int(10) NOT NULL,
  `tenNguoiDung` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `SDT` int(10) NOT NULL,
  `diaChi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `maNhanVien` int(100) NOT NULL,
  `tenNhanVien` text NOT NULL,
  `diaChi` varchar(200) NOT NULL,
  `chucVu` text NOT NULL,
  `maNguoiDung` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phieumuon`
--

CREATE TABLE `phieumuon` (
  `MaPhieuMuon` int(10) NOT NULL,
  `NgayTao` date NOT NULL,
  `TongTien` float NOT NULL,
  `GiamGia` float NOT NULL,
  `PhuongThucThanhToan` varchar(255) DEFAULT NULL,
  `SoDienThoai` int(10) DEFAULT NULL,
  `maCTPM` int(10) NOT NULL,
  `tinhTrang` text DEFAULT NULL,
  `maKH` int(10) NOT NULL,
  `MaKhuyenMai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phieutra`
--

CREATE TABLE `phieutra` (
  `MaPhieuTra` int(10) NOT NULL,
  `NgayTao` date NOT NULL,
  `PhiPhat` float NOT NULL,
  `TongTien` float NOT NULL,
  `PhuongThucThanhToan` varchar(255) DEFAULT NULL,
  `SoDienThoai` int(10) DEFAULT NULL,
  `tinhTrang` text DEFAULT NULL,
  `maKH` int(10) NOT NULL,
  `MaPhieuMuon` int(10) NOT NULL,
  `hinhAnh` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `maTK` int(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `vaitro` text NOT NULL,
  `maNguoiDung` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yeucau`
--

CREATE TABLE `yeucau` (
  `maYC` int(50) NOT NULL,
  `tenYC` varchar(100) NOT NULL,
  `noiDung` varchar(500) NOT NULL,
  `ngayYC` date NOT NULL,
  `maNhanVien` int(11) NOT NULL,
  `maloaiYC` varchar(50) NOT NULL,
  `trangThai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anpham`
--
ALTER TABLE `anpham`
  ADD PRIMARY KEY (`maAnPham`),
  ADD KEY `TenAnPham` (`TenAnPham`),
  ADD KEY `maCTPM` (`maCTPM`);

--
-- Indexes for table `chitietpm`
--
ALTER TABLE `chitietpm`
  ADD PRIMARY KEY (`maCTPM`),
  ADD KEY `MaPhieuMuon` (`MaPhieuMuon`),
  ADD KEY `maAnPham` (`maAnPham`);

--
-- Indexes for table `danhmucap`
--
ALTER TABLE `danhmucap`
  ADD PRIMARY KEY (`MaDanhMuc`);

--
-- Indexes for table `dauap`
--
ALTER TABLE `dauap`
  ADD PRIMARY KEY (`madauAP`),
  ADD KEY `MaDanhMuc` (`MaDanhMuc`);

--
-- Indexes for table `hoadonnhapap`
--
ALTER TABLE `hoadonnhapap`
  ADD PRIMARY KEY (`MaHoaDon`),
  ADD KEY `maNhanVien` (`maNhanVien`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`maKH`),
  ADD KEY `maNguoiDung` (`maNguoiDung`);

--
-- Indexes for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`MaKhuyenMai`),
  ADD KEY `maCTPM` (`maCTPM`);

--
-- Indexes for table `loaiyc`
--
ALTER TABLE `loaiyc`
  ADD PRIMARY KEY (`maloaiYC`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`maNguoiDung`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`maNhanVien`),
  ADD KEY `maNguoiDung` (`maNguoiDung`);

--
-- Indexes for table `phieumuon`
--
ALTER TABLE `phieumuon`
  ADD PRIMARY KEY (`MaPhieuMuon`),
  ADD KEY `maCTPM` (`maCTPM`),
  ADD KEY `maKH` (`maKH`),
  ADD KEY `MaKhuyenMai` (`MaKhuyenMai`);

--
-- Indexes for table `phieutra`
--
ALTER TABLE `phieutra`
  ADD PRIMARY KEY (`MaPhieuTra`),
  ADD KEY `maKH` (`maKH`),
  ADD KEY `MaPhieuMuon` (`MaPhieuMuon`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`maTK`),
  ADD KEY `maNguoiDung` (`maNguoiDung`);

--
-- Indexes for table `yeucau`
--
ALTER TABLE `yeucau`
  ADD PRIMARY KEY (`maYC`),
  ADD KEY `tenloaiYC` (`maloaiYC`),
  ADD KEY `maNhan` (`maNhanVien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anpham`
--
ALTER TABLE `anpham`
  MODIFY `maAnPham` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chitietpm`
--
ALTER TABLE `chitietpm`
  MODIFY `maCTPM` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `danhmucap`
--
ALTER TABLE `danhmucap`
  MODIFY `MaDanhMuc` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dauap`
--
ALTER TABLE `dauap`
  MODIFY `madauAP` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoadonnhapap`
--
ALTER TABLE `hoadonnhapap`
  MODIFY `MaHoaDon` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `maKH` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `MaKhuyenMai` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `maNguoiDung` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `maNhanVien` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phieumuon`
--
ALTER TABLE `phieumuon`
  MODIFY `MaPhieuMuon` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phieutra`
--
ALTER TABLE `phieutra`
  MODIFY `MaPhieuTra` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `maTK` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yeucau`
--
ALTER TABLE `yeucau`
  MODIFY `maYC` int(50) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anpham`
--
ALTER TABLE `anpham`
  ADD CONSTRAINT `anpham_ibfk_1` FOREIGN KEY (`maCTPM`) REFERENCES `chitietpm` (`maCTPM`);

--
-- Constraints for table `chitietpm`
--
ALTER TABLE `chitietpm`
  ADD CONSTRAINT `chitietpm_ibfk_1` FOREIGN KEY (`maAnPham`) REFERENCES `anpham` (`maAnPham`);

--
-- Constraints for table `dauap`
--
ALTER TABLE `dauap`
  ADD CONSTRAINT `dauap_ibfk_1` FOREIGN KEY (`MaDanhMuc`) REFERENCES `danhmucap` (`MaDanhMuc`);

--
-- Constraints for table `hoadonnhapap`
--
ALTER TABLE `hoadonnhapap`
  ADD CONSTRAINT `hoadonnhapap_ibfk_1` FOREIGN KEY (`maNhanVien`) REFERENCES `nhanvien` (`maNhanVien`);

--
-- Constraints for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `fk_nguoidung` FOREIGN KEY (`maNguoiDung`) REFERENCES `nguoidung` (`maNguoiDung`);

--
-- Constraints for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD CONSTRAINT `khuyenmai_ibfk_1` FOREIGN KEY (`maCTPM`) REFERENCES `chitietpm` (`maCTPM`);

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `fk_nv` FOREIGN KEY (`maNguoiDung`) REFERENCES `nguoidung` (`maNguoiDung`);

--
-- Constraints for table `phieumuon`
--
ALTER TABLE `phieumuon`
  ADD CONSTRAINT `phieumuon_ibfk_1` FOREIGN KEY (`maCTPM`) REFERENCES `chitietpm` (`maCTPM`),
  ADD CONSTRAINT `phieumuon_ibfk_2` FOREIGN KEY (`maKH`) REFERENCES `khachhang` (`maKH`),
  ADD CONSTRAINT `phieumuon_ibfk_3` FOREIGN KEY (`MaKhuyenMai`) REFERENCES `khuyenmai` (`MaKhuyenMai`);

--
-- Constraints for table `phieutra`
--
ALTER TABLE `phieutra`
  ADD CONSTRAINT `phieutra_ibfk_1` FOREIGN KEY (`MaPhieuMuon`) REFERENCES `phieumuon` (`MaPhieuMuon`),
  ADD CONSTRAINT `phieutra_ibfk_2` FOREIGN KEY (`maKH`) REFERENCES `khachhang` (`maKH`);

--
-- Constraints for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`maNguoiDung`) REFERENCES `nguoidung` (`maNguoiDung`);

--
-- Constraints for table `yeucau`
--
ALTER TABLE `yeucau`
  ADD CONSTRAINT `fk_loaiyc` FOREIGN KEY (`maloaiYC`) REFERENCES `loaiyc` (`maloaiYC`),
  ADD CONSTRAINT `yeucau_ibfk_1` FOREIGN KEY (`maNhanVien`) REFERENCES `nhanvien` (`maNhanVien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
