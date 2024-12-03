-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 01, 2024 lúc 05:55 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `final_nexus`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `anpham`
--

CREATE TABLE `anpham` (
  `maAnPham` int(10) NOT NULL,
  `TenAnPham` varchar(300) NOT NULL,
  `Gia` float NOT NULL,
  `ngayXB` date NOT NULL,
  `tinhTrang` varchar(255) DEFAULT NULL,
  `madauAP` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `anpham`
--

INSERT INTO `anpham` (`maAnPham`, `TenAnPham`, `Gia`, `ngayXB`, `tinhTrang`, `madauAP`) VALUES
(1, 'Bên Rìa Thế Giới', 75000, '2021-10-10', 'Mới', 1),
(2, 'Bên Rìa Thế Giới', 85000, '2021-06-15', 'Đang thuê', 1),
(3, 'Chuyện Con Mèo Dạy Hải Âu Bay', 62000, '2020-07-20', 'Còn', 2),
(4, 'Chuyện Con Mèo Dạy Hải Âu Bay', 58000, '2020-08-25', 'Đang thuê', 2),
(5, 'Lược Sử Thời Gian', 160000, '2019-09-30', 'Mới', 3),
(6, 'Lược Sử Thời Gian', 170000, '2019-10-05', 'Mới', 3),
(7, 'Sapiens: Lược Sử Loài Người', 210000, '2018-11-11', 'Còn', 4),
(8, 'Sapiens: Lược Sử Loài Người', 200000, '2018-12-12', 'Còn', 4),
(9, 'Harry Potter và Hòn Đá Phù Thủy', 125000, '2021-03-01', 'Còn', 5),
(10, 'Harry Potter và Hòn Đá Phù Thủy', 115000, '2021-04-01', 'Đang thuê', 5),
(11, 'Mắt Biếc', 70000, '2021-01-15', 'Mới', 6),
(12, 'Mắt Biếc', 80000, '2021-02-20', 'Mới', 6),
(13, 'Thế Giới Không Có Nước', 90000, '2019-05-25', 'Còn', 7),
(14, 'Thế Giới Không Có Nước', 85000, '2019-06-30', 'Đang thuê', 7),
(15, 'Những Điều Kỳ Diệu Của Địa Lý', 120000, '2020-09-15', 'Mới', 8),
(16, 'Những Điều Kỳ Diệu Của Địa Lý', 115000, '2020-10-20', 'Mới', 8),
(17, 'Người Xưa Và Nghệ Thuật', 135000, '2021-02-28', 'Mới', 9),
(18, 'Người Xưa Và Nghệ Thuật', 125000, '2021-03-15', 'Còn', 9),
(19, '1001 Đêm Nghệ Thuật', 145000, '2021-04-10', 'Còn', 10),
(20, '1001 Đêm Nghệ Thuật', 150000, '2021-05-05', 'Đang thuê', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietpm`
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
-- Cấu trúc bảng cho bảng `danhmucap`
--

CREATE TABLE `danhmucap` (
  `MaDanhMuc` int(10) NOT NULL,
  `TenDanhMuc` varchar(255) DEFAULT NULL,
  `MoTa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmucap`
--

INSERT INTO `danhmucap` (`MaDanhMuc`, `TenDanhMuc`, `MoTa`) VALUES
(1, 'Tiểu Thuyết', 'Mang đến những câu chuyện hấp dẫn và sâu sắc về cuộc sống, tình yêu, và nhân văn.'),
(2, 'Khoa Học', 'Cung cấp kiến thức đa dạng từ tự nhiên, xã hội đến công nghệ,'),
(3, 'Thiếu Nhi', 'Với các câu chuyện thú vị và giáo dục, giúp phát triển trí tưởng tượng và kỹ năng đọc cho trẻ nhỏ.'),
(4, 'Lịch Sử', 'Khám phá các sự kiện quan trọng, nhân vật lịch sử và bối cảnh văn hóa từ các thời kỳ khác nhau trên thế giới'),
(5, 'Nghệ Thuật', 'Giới thiệu về các hình thức nghệ thuật khác nhau như hội họa, điêu khắc, âm nhạc, và văn học, cùng các nghệ sĩ vĩ đại qua các thời kỳ.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dauap`
--

CREATE TABLE `dauap` (
  `madauAP` int(10) NOT NULL,
  `TenAnPham` varchar(255) NOT NULL,
  `Tacgia` varchar(255) NOT NULL,
  `NXB` varchar(200) NOT NULL,
  `Tongsoluong` int(10) NOT NULL,
  `VitrixepGia` varchar(255) DEFAULT NULL,
  `MaDanhMuc` int(10) NOT NULL,
  `hinhAnh` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dauap`
--

INSERT INTO `dauap` (`madauAP`, `TenAnPham`, `Tacgia`, `NXB`, `Tongsoluong`, `VitrixepGia`, `MaDanhMuc`, `hinhAnh`) VALUES
(1, 'Bên Rìa Thế Giới', 'Nguyễn Nhật Ánh', 'NXB Kim Đồng', 100, '70000', 1, ''),
(2, 'Chuyện Con Mèo Dạy Hải Âu Bay', 'Luis Sepúlveda', 'NXB Trẻ', 80, '60000', 1, ''),
(3, 'Lược Sử Thời Gian', 'Stephen Hawking', 'NXB Tổng Hợp', 120, '150000', 2, ''),
(4, 'Sapiens: Lược Sử Loài Người', 'Yuval Noah Harari', 'NXB Dân Trí', 200, '200000', 2, ''),
(5, 'Harry Potter và Hòn Đá Phù Thủy', 'J.K. Rowling', 'NXB Kim Đồng', 110, '120000', 3, ''),
(6, 'Mắt Biếc', 'Nguyễn Nhật Ánh', 'NXB Kim Đồng', 140, '65000', 3, ''),
(7, 'Thế Giới Không Có Nước', 'Trần Đình Nguyên', 'NXB Tổng Hợp', 110, '85000', 4, ''),
(8, 'Những Điều Kỳ Diệu Của Địa Lý', 'David Attenborough', 'NXB Kim Đồng', 90, '110000', 4, ''),
(9, 'Người Xưa Và Nghệ Thuật', 'Various Authors', 'NXB Mỹ Thuật', 80, '130000', 5, ''),
(10, '1001 Đêm Nghệ Thuật', 'Various Authors', 'NXB Văn Hóa Thông Tin', 70, '140000', 5, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadonnhapap`
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
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `maKH` int(100) NOT NULL,
  `tenKH` text NOT NULL,
  `diaChi` varchar(200) NOT NULL,
  `maNguoiDung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`maKH`, `tenKH`, `diaChi`, `maNguoiDung`) VALUES
(1, 'Quách Đạt Phúc', '125 Phó Cơ Điều, Quận 5, TPHCM', 4),
(2, 'Phúc Mỹ', '555 WTF, Quận Gò Vấp', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
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
-- Cấu trúc bảng cho bảng `loaiyc`
--

CREATE TABLE `loaiyc` (
  `maloaiYC` varchar(50) NOT NULL,
  `tenloaiYC` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `maNguoiDung` int(10) NOT NULL,
  `tenNguoiDung` text NOT NULL,
  `gioiTinh` enum('Nam','Nữ','Không xác định') NOT NULL DEFAULT 'Không xác định',
  `email` varchar(100) NOT NULL,
  `SDT` int(10) NOT NULL,
  `diaChi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`maNguoiDung`, `tenNguoiDung`, `gioiTinh`, `email`, `SDT`, `diaChi`) VALUES
(1, 'Nguyễn Bình An', 'Nữ', 'annguyen@example.com', 786594356, '789 Đường Nguyễn Huệ, Q.1, TP.HCM'),
(2, 'Trần Ngọc Mai', 'Nữ', 'maitran@example.com', 987654321, '321 Đường Lê Lợi, Q.5, TP.HCM'),
(3, 'Nguyễn Thị Nở', 'Nữ', 'hungnguyen2u@gmail.com', 223699874, '123 Phố Bùi Viện, Quận 1, TPHCM'),
(4, 'Quách Đạt Phúc', 'Nam', 'unidsalt@gmail.com', 89885759, '125 Phó Cơ Điều, Quận 5, TPHCM'),
(5, 'Phúc Mỹ', 'Nam', 'phucmy@gmail.com', 11256698, '555 WTF, Quận Gò Vấp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `maNhanVien` int(100) NOT NULL,
  `tenNhanVien` text NOT NULL,
  `diaChi` varchar(200) NOT NULL,
  `chucVu` text NOT NULL,
  `maNguoiDung` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`maNhanVien`, `tenNhanVien`, `diaChi`, `chucVu`, `maNguoiDung`) VALUES
(1, 'Nguyễn Bình An', '', 'Nhân viên kho', 1),
(2, 'Trần Ngọc Mai', '', 'Nhân viên kho', 2),
(3, 'Nguyễn Thị Nở', '123 Phố Bùi Viện, Quận 1, TPHCM', 'Quản lý', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieumuon`
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
-- Cấu trúc bảng cho bảng `phieutra`
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
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `maTK` int(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `vaitro` text NOT NULL,
  `maNguoiDung` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`maTK`, `email`, `matkhau`, `vaitro`, `maNguoiDung`) VALUES
(1, 'annguyen@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvienkho', 1),
(2, 'maitran@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvienkho', 2),
(3, 'hungnguyen2u@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 3),
(4, 'unidsalt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'khachhang', 4),
(5, 'phucmy@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'khachhang', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `yeucau`
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
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `anpham`
--
ALTER TABLE `anpham`
  ADD PRIMARY KEY (`maAnPham`),
  ADD KEY `madauAP` (`madauAP`);

--
-- Chỉ mục cho bảng `chitietpm`
--
ALTER TABLE `chitietpm`
  ADD PRIMARY KEY (`maCTPM`),
  ADD KEY `MaPhieuMuon` (`MaPhieuMuon`),
  ADD KEY `maAnPham` (`maAnPham`);

--
-- Chỉ mục cho bảng `danhmucap`
--
ALTER TABLE `danhmucap`
  ADD PRIMARY KEY (`MaDanhMuc`);

--
-- Chỉ mục cho bảng `dauap`
--
ALTER TABLE `dauap`
  ADD PRIMARY KEY (`madauAP`),
  ADD KEY `MaDanhMuc` (`MaDanhMuc`);

--
-- Chỉ mục cho bảng `hoadonnhapap`
--
ALTER TABLE `hoadonnhapap`
  ADD PRIMARY KEY (`MaHoaDon`),
  ADD KEY `maNhanVien` (`maNhanVien`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`maKH`),
  ADD KEY `maNguoiDung` (`maNguoiDung`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`MaKhuyenMai`),
  ADD KEY `maCTPM` (`maCTPM`);

--
-- Chỉ mục cho bảng `loaiyc`
--
ALTER TABLE `loaiyc`
  ADD PRIMARY KEY (`maloaiYC`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`maNguoiDung`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`maNhanVien`),
  ADD KEY `maNguoiDung` (`maNguoiDung`);

--
-- Chỉ mục cho bảng `phieumuon`
--
ALTER TABLE `phieumuon`
  ADD PRIMARY KEY (`MaPhieuMuon`),
  ADD KEY `maCTPM` (`maCTPM`),
  ADD KEY `maKH` (`maKH`),
  ADD KEY `MaKhuyenMai` (`MaKhuyenMai`);

--
-- Chỉ mục cho bảng `phieutra`
--
ALTER TABLE `phieutra`
  ADD PRIMARY KEY (`MaPhieuTra`),
  ADD KEY `maKH` (`maKH`),
  ADD KEY `MaPhieuMuon` (`MaPhieuMuon`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`maTK`),
  ADD KEY `maNguoiDung` (`maNguoiDung`);

--
-- Chỉ mục cho bảng `yeucau`
--
ALTER TABLE `yeucau`
  ADD PRIMARY KEY (`maYC`),
  ADD KEY `tenloaiYC` (`maloaiYC`),
  ADD KEY `maNhan` (`maNhanVien`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `anpham`
--
ALTER TABLE `anpham`
  MODIFY `maAnPham` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `chitietpm`
--
ALTER TABLE `chitietpm`
  MODIFY `maCTPM` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danhmucap`
--
ALTER TABLE `danhmucap`
  MODIFY `MaDanhMuc` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `dauap`
--
ALTER TABLE `dauap`
  MODIFY `madauAP` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `hoadonnhapap`
--
ALTER TABLE `hoadonnhapap`
  MODIFY `MaHoaDon` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `maKH` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `MaKhuyenMai` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `maNguoiDung` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `maNhanVien` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `phieumuon`
--
ALTER TABLE `phieumuon`
  MODIFY `MaPhieuMuon` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phieutra`
--
ALTER TABLE `phieutra`
  MODIFY `MaPhieuTra` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `maTK` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `yeucau`
--
ALTER TABLE `yeucau`
  MODIFY `maYC` int(50) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `anpham`
--
ALTER TABLE `anpham`
  ADD CONSTRAINT `anpham_ibfk_3` FOREIGN KEY (`madauAP`) REFERENCES `dauap` (`madauAP`);

--
-- Các ràng buộc cho bảng `chitietpm`
--
ALTER TABLE `chitietpm`
  ADD CONSTRAINT `chitietpm_ibfk_1` FOREIGN KEY (`maAnPham`) REFERENCES `anpham` (`maAnPham`);

--
-- Các ràng buộc cho bảng `dauap`
--
ALTER TABLE `dauap`
  ADD CONSTRAINT `dauap_ibfk_1` FOREIGN KEY (`MaDanhMuc`) REFERENCES `danhmucap` (`MaDanhMuc`);

--
-- Các ràng buộc cho bảng `hoadonnhapap`
--
ALTER TABLE `hoadonnhapap`
  ADD CONSTRAINT `hoadonnhapap_ibfk_1` FOREIGN KEY (`maNhanVien`) REFERENCES `nhanvien` (`maNhanVien`);

--
-- Các ràng buộc cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `fk_nguoidung` FOREIGN KEY (`maNguoiDung`) REFERENCES `nguoidung` (`maNguoiDung`);

--
-- Các ràng buộc cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD CONSTRAINT `khuyenmai_ibfk_1` FOREIGN KEY (`maCTPM`) REFERENCES `chitietpm` (`maCTPM`);

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `fk_nv` FOREIGN KEY (`maNguoiDung`) REFERENCES `nguoidung` (`maNguoiDung`);

--
-- Các ràng buộc cho bảng `phieumuon`
--
ALTER TABLE `phieumuon`
  ADD CONSTRAINT `phieumuon_ibfk_1` FOREIGN KEY (`maCTPM`) REFERENCES `chitietpm` (`maCTPM`),
  ADD CONSTRAINT `phieumuon_ibfk_2` FOREIGN KEY (`maKH`) REFERENCES `khachhang` (`maKH`),
  ADD CONSTRAINT `phieumuon_ibfk_3` FOREIGN KEY (`MaKhuyenMai`) REFERENCES `khuyenmai` (`MaKhuyenMai`);

--
-- Các ràng buộc cho bảng `phieutra`
--
ALTER TABLE `phieutra`
  ADD CONSTRAINT `phieutra_ibfk_1` FOREIGN KEY (`MaPhieuMuon`) REFERENCES `phieumuon` (`MaPhieuMuon`),
  ADD CONSTRAINT `phieutra_ibfk_2` FOREIGN KEY (`maKH`) REFERENCES `khachhang` (`maKH`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`maNguoiDung`) REFERENCES `nguoidung` (`maNguoiDung`);

--
-- Các ràng buộc cho bảng `yeucau`
--
ALTER TABLE `yeucau`
  ADD CONSTRAINT `fk_loaiyc` FOREIGN KEY (`maloaiYC`) REFERENCES `loaiyc` (`maloaiYC`),
  ADD CONSTRAINT `yeucau_ibfk_1` FOREIGN KEY (`maNhanVien`) REFERENCES `nhanvien` (`maNhanVien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
