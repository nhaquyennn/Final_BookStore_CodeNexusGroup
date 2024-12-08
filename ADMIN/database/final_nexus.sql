-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2024 at 12:22 PM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_nexus`
--

-- --------------------------------------------------------

--
-- Table structure for table `anpham`
--

CREATE TABLE `anpham` (
  `maAnPham` int(10) NOT NULL,
  `TenAnPham` varchar(300) NOT NULL,
  `Gia` float NOT NULL,
  `ngayXB` date NOT NULL,
  `tinhTrang` varchar(255) DEFAULT NULL,
  `madauAP` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anpham`
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
  `tinhTrangMuon` text,
  `hinhAnh` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chitietpm`
--

INSERT INTO `chitietpm` (`maCTPM`, `MaPhieuMuon`, `maAnPham`, `SoLuong`, `DonGia`, `GiamGia`, `maKM`, `tinhTrangMuon`, `hinhAnh`) VALUES
(101, 201, 1, 2, 75000, 0, 0, 'Đang mượn', 'image1.png'),
(102, 202, 2, 1, 85000, 0, 0, 'Đang mượn', 'image2.png'),
(103, 203, 3, 3, 62000, 10, 101, 'Đã trả', 'image3.png'),
(104, 204, 4, 1, 58000, 5, 102, 'Đã trả', 'image4.png'),
(105, 205, 5, 5, 160000, 20, 103, 'Đang mượn', 'image5.png'),
(106, 206, 6, 2, 170000, 15, 104, 'Đang mượn', 'image6.png'),
(107, 207, 7, 4, 210000, 25, 105, 'Đã trả', 'image7.png'),
(108, 208, 8, 3, 200000, 30, 106, 'Đã trả', 'image8.png'),
(109, 209, 9, 1, 125000, 0, 0, 'Đang mượn', 'image9.png'),
(110, 210, 10, 2, 115000, 10, 107, 'Đang mượn', 'image10.png'),
(111, 211, 11, 3, 80000, 0, 0, 'Đã trả', 'image11.png'),
(112, 212, 12, 1, 90000, 20, 108, 'Đã trả', 'image12.png'),
(113, 213, 13, 2, 85000, 15, 109, 'Đang mượn', 'image13.png'),
(114, 214, 14, 1, 120000, 25, 110, 'Đã trả', 'image14.png'),
(115, 215, 15, 3, 115000, 10, 111, 'Đang mượn', 'image15.png'),
(116, 216, 16, 4, 70000, 5, 112, 'Đã trả', 'image16.png'),
(117, 217, 1, 2, 75000, 0, 0, 'Đang mượn', 'image17.png'),
(118, 218, 2, 5, 85000, 20, 113, 'Đang mượn', 'image18.png'),
(119, 219, 3, 1, 62000, 10, 114, 'Đã trả', 'image19.png'),
(120, 220, 4, 2, 58000, 5, 115, 'Đang mượn', 'image20.png'),
(201, 301, 1, 2, 75000, 10, 1, 'Đang mượn', 'image1.png'),
(202, 302, 2, 1, 85000, 15, 2, 'Đã trả', 'image2.png'),
(203, 303, 3, 3, 62000, 5, 3, 'Đang mượn', 'image3.png'),
(204, 304, 4, 4, 58000, 20, 4, 'Đã trả', 'image4.png'),
(205, 305, 5, 2, 160000, 25, 5, 'Đang mượn', 'image5.png'),
(206, 306, 6, 3, 170000, 10, 6, 'Đã trả', 'image6.png'),
(207, 307, 7, 1, 210000, 5, 7, 'Đang mượn', 'image7.png'),
(208, 308, 8, 2, 90000, 15, 8, 'Đã trả', 'image8.png');

-- --------------------------------------------------------

--
-- Table structure for table `danhmucap`
--

CREATE TABLE `danhmucap` (
  `MaDanhMuc` int(10) NOT NULL,
  `TenDanhMuc` varchar(255) DEFAULT NULL,
  `MoTa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `danhmucap`
--

INSERT INTO `danhmucap` (`MaDanhMuc`, `TenDanhMuc`, `MoTa`) VALUES
(1, 'Tiểu Thuyết', 'Mang đến những câu chuyện hấp dẫn và sâu sắc về cuộc sống, tình yêu, và nhân văn.'),
(2, 'Khoa Học', 'Cung cấp kiến thức đa dạng từ tự nhiên, xã hội đến công nghệ,'),
(3, 'Thiếu Nhi', 'Với các câu chuyện thú vị và giáo dục, giúp phát triển trí tưởng tượng và kỹ năng đọc cho trẻ nhỏ.'),
(4, 'Lịch Sử', 'Khám phá các sự kiện quan trọng, nhân vật lịch sử và bối cảnh văn hóa từ các thời kỳ khác nhau trên thế giới'),
(5, 'Nghệ Thuật', 'Giới thiệu về các hình thức nghệ thuật khác nhau như hội họa, điêu khắc, âm nhạc, và văn học, cùng các nghệ sĩ vĩ đại qua các thời kỳ.');

-- --------------------------------------------------------

--
-- Table structure for table `dauap`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dauap`
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
-- Table structure for table `hoadonnhapap`
--

CREATE TABLE `hoadonnhapap` (
  `MaHoaDon` int(10) NOT NULL,
  `maNhanVien` int(10) NOT NULL,
  `NgayTaoHoaDon` date DEFAULT NULL,
  `TongTien` float NOT NULL,
  `NhaCungCap` varchar(255) DEFAULT NULL,
  `DanhSachAnPham` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `maKH` int(100) NOT NULL,
  `tenKH` text NOT NULL,
  `diaChi` varchar(200) NOT NULL,
  `maNguoiDung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`maKH`, `tenKH`, `diaChi`, `maNguoiDung`) VALUES
(1, 'Quách Đạt Phúc', '125 Phó Cơ Điều, Quận 5, TPHCM', 4),
(2, 'Phúc Mỹ', '555 WTF, Quận Gò Vấp', 5),
(3, 'Nguyễn Văn A', '12A Nguyễn Huệ, Q.1, TP.HCM', 6),
(4, 'Trần Thị B', '56 Lê Lợi, Q.3, TP.HCM', 7),
(5, 'Lê Minh C', '90 Trần Hưng Đạo, Q.5, TP.HCM', 8),
(6, 'Võ Văn D', '45 Võ Văn Kiệt, Q.6, TP.HCM', 9),
(7, 'Ngô Thị E', '67 Lý Tự Trọng, Q.10, TP.HCM', 10),
(8, 'Phạm Minh F', '34 Nguyễn Văn Trỗi, Q.Tân Bình, TP.HCM', 11),
(9, 'Bùi Thị G', '78 Phan Đăng Lưu, Q.Phú Nhuận, TP.HCM', 12),
(10, 'Hoàng Văn H', '89 Nguyễn Thái Học, Q.3, TP.HCM', 13),
(11, 'Lý Thị I', '12 Trường Chinh, Q.Tân Phú, TP.HCM', 14),
(12, 'Nguyễn Văn J', '34 Nguyễn Trãi, Q.5, TP.HCM', 15);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `khuyenmai`
--

INSERT INTO `khuyenmai` (`MaKhuyenMai`, `TenKhuyenMai`, `PhanTramGiamgia`, `NgayKetThuc`, `NgayBatDau`, `maCTPM`) VALUES
(1, 'Khuyến mãi Tết', 20, '2024-02-10', '2024-01-01', 101),
(2, 'Khuyến mãi Hè', 15, '2024-08-31', '2024-06-01', 102),
(3, 'Black Friday Sale', 30, '2024-11-29', '2024-11-01', 103),
(4, 'Ưu đãi thành viên', 10, '2024-12-31', '2024-01-01', 104),
(5, 'Flash Sale 1', 25, '2024-05-15', '2024-05-01', 105),
(6, 'Flash Sale 2', 25, '2024-06-15', '2024-06-01', 106),
(7, 'Giảm giá cuối tuần', 20, '2024-03-03', '2024-03-01', 107),
(8, 'Mua 1 tặng 1', 50, '2024-07-07', '2024-07-01', 108),
(9, 'Giảm giá Noel', 25, '2024-12-25', '2024-12-01', 109),
(10, 'Sale Sốc Hè', 35, '2024-08-10', '2024-07-01', 110),
(11, 'Tri ân khách hàng', 20, '2024-10-10', '2024-09-01', 111),
(12, 'Sale cuối năm', 40, '2024-12-31', '2024-12-15', 112),
(13, 'Sale chào thu', 15, '2024-09-30', '2024-09-01', 113),
(14, 'Siêu khuyến mãi', 50, '2024-11-11', '2024-11-01', 114),
(15, 'Giảm giá cho trẻ em', 10, '2024-06-30', '2024-06-01', 115),
(16, 'Ưu đãi sinh nhật', 20, '2024-07-20', '2024-07-01', 116),
(17, 'Tặng quà đầu năm', 5, '2024-02-28', '2024-01-01', 117),
(18, 'Giảm giá Valentine', 15, '2024-02-14', '2024-02-01', 118),
(19, 'Khuyến mãi lễ hội', 25, '2024-10-30', '2024-10-01', 119),
(20, 'Flash Sale cuối ngày', 30, '2024-05-31', '2024-05-01', 120);

-- --------------------------------------------------------

--
-- Table structure for table `loaiyc`
--

CREATE TABLE `loaiyc` (
  `maloaiYC` varchar(50) NOT NULL,
  `tenloaiYC` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `maNguoiDung` int(10) NOT NULL,
  `tenNguoiDung` text NOT NULL,
  `gioiTinh` enum('Nam','Nữ','Không xác định') NOT NULL DEFAULT 'Không xác định',
  `email` varchar(100) NOT NULL,
  `SDT` bigint(20) DEFAULT NULL,
  `diaChi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`maNguoiDung`, `tenNguoiDung`, `gioiTinh`, `email`, `SDT`, `diaChi`) VALUES
(1, 'Nguyễn Bình An', 'Nữ', 'annguyen@example.com', 786594356, '789 Đường Nguyễn Huệ, Q.1, TP.HCM'),
(2, 'Trần Ngọc Mai', 'Nữ', 'maitran@example.com', 987654321, '321 Đường Lê Lợi, Q.5, TP.HCM'),
(3, 'Nguyễn Thị Nở', 'Nữ', 'hungnguyen2u@gmail.com', 223699874, '123 Phố Bùi Viện, Quận 1, TPHCM'),
(4, 'Quách Đạt Phúc', 'Nam', 'unidsalt@gmail.com', 89885759, '125 Phó Cơ Điều, Quận 5, TPHCM'),
(5, 'Phúc Mỹ', 'Nam', 'phucmy@gmail.com', 11256698, '555 WTF, Quận Gò Vấp'),
(6, 'Nguyễn Văn A', 'Nam', 'vananguyen@example.com', 9091234567, '12A Nguyễn Huệ, Q.1, TP.HCM'),
(7, 'Trần Thị B', 'Nữ', 'trantb@example.com', 9099876543, '56 Lê Lợi, Q.3, TP.HCM'),
(8, 'Lê Minh C', 'Nam', 'leminhc@example.com', 9098765432, '90 Trần Hưng Đạo, Q.5, TP.HCM'),
(9, 'Võ Văn D', 'Nam', 'vovand@example.com', 9097654321, '45 Võ Văn Kiệt, Q.6, TP.HCM'),
(10, 'Ngô Thị E', 'Nữ', 'ngothie@example.com', 9096543210, '67 Lý Tự Trọng, Q.10, TP.HCM'),
(11, 'Phạm Minh F', 'Nam', 'phamminhf@example.com', 9095432109, '34 Nguyễn Văn Trỗi, Q.Tân Bình, TP.HCM'),
(12, 'Bùi Thị G', 'Nữ', 'buithig@example.com', 9094321098, '78 Phan Đăng Lưu, Q.Phú Nhuận, TP.HCM'),
(13, 'Hoàng Văn H', 'Nam', 'hoangvanh@example.com', 9093210987, '89 Nguyễn Thái Học, Q.3, TP.HCM'),
(14, 'Lý Thị I', 'Nữ', 'lythi@example.com', 9092109876, '12 Trường Chinh, Q.Tân Phú, TP.HCM'),
(15, 'Nguyễn Văn J', 'Nam', 'nguyenj@example.com', 9091098765, '34 Nguyễn Trãi, Q.5, TP.HCM'),
(16, 'Trần Minh K', 'Nam', 'tranminhk@example.com', 9090123456, '56 Lê Văn Sỹ, Q.Phú Nhuận, TP.HCM'),
(17, 'Phan Thị L', 'Nữ', 'phanl@example.com', 9081234567, '78 Nguyễn Huệ, Q.1, TP.HCM'),
(18, 'Vũ Văn M', 'Nam', 'vuvan@example.com', 9082345678, '90 Trần Quang Khải, Q.7, TP.HCM'),
(19, 'Nguyễn Thị N', 'Nữ', 'nguyenn@example.com', 9083456789, '45 Nguyễn Văn Cừ, Q.4, TP.HCM'),
(20, 'Lê Văn O', 'Nam', 'levo@example.com', 9084567890, '67 Pasteur, Q.3, TP.HCM'),
(21, 'Bùi Thị P', 'Nữ', 'buip@example.com', 9085678901, '34 Võ Thị Sáu, Q.Bình Thạnh, TP.HCM'),
(22, 'Võ Minh Q', 'Nam', 'vominhq@example.com', 9086789012, '78 Nguyễn Hữu Cảnh, Q.1, TP.HCM'),
(23, 'Phạm Văn R', 'Nam', 'phamr@example.com', 9087890123, '12 Lý Chính Thắng, Q.3, TP.HCM'),
(24, 'Nguyễn Thị S', 'Nữ', 'nguyens@example.com', 9088901234, '56 Nguyễn Văn Linh, Q.7, TP.HCM'),
(25, 'Lý Minh T', 'Nam', 'lyt@example.com', 9089012345, '90 Lê Hồng Phong, Q.10, TP.HCM');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`maNhanVien`, `tenNhanVien`, `diaChi`, `chucVu`, `maNguoiDung`) VALUES
(1, 'Nguyễn Bình An', '', 'Nhân viên kho', 1),
(2, 'Trần Ngọc Mai', '', 'Nhân viên kho', 2),
(3, 'Nguyễn Thị Nở', '123 Phố Bùi Viện, Quận 1, TPHCM', 'Quản lý', 3);

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
  `SoDienThoai` bigint(20) DEFAULT NULL,
  `maCTPM` int(10) NOT NULL,
  `tinhTrang` text,
  `maKH` int(10) NOT NULL,
  `MaKhuyenMai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieumuon`
--

INSERT INTO `phieumuon` (`MaPhieuMuon`, `NgayTao`, `TongTien`, `GiamGia`, `PhuongThucThanhToan`, `SoDienThoai`, `maCTPM`, `tinhTrang`, `maKH`, `MaKhuyenMai`) VALUES
(201, '2024-01-01', 150000, 20, 'Tiền mặt', 786594356, 101, 'Đang mượn', 1, 1),
(202, '2024-02-15', 85000, 15, 'Chuyển khoản', 987654321, 102, 'Đã trả', 2, 2),
(203, '2024-03-10', 62000, 10, 'Tiền mặt', 223699874, 103, 'Đang mượn', 3, 3),
(204, '2024-04-05', 170000, 20, 'Chuyển khoản', 89885759, 104, 'Đã trả', 4, 4),
(205, '2024-05-25', 125000, 25, 'Tiền mặt', 11256698, 105, 'Đang mượn', 5, 5),
(206, '2024-06-30', 115000, 15, 'Chuyển khoản', 9091234567, 106, 'Đã trả', 6, 6),
(207, '2024-07-20', 80000, 5, 'Tiền mặt', 9099876543, 107, 'Đang mượn', 7, 7),
(208, '2024-08-18', 90000, 10, 'Chuyển khoản', 9098765432, 108, 'Đã trả', 8, 8),
(209, '2024-09-22', 85000, 15, 'Tiền mặt', 9097654321, 109, 'Đang mượn', 9, 9),
(210, '2024-10-01', 120000, 20, 'Chuyển khoản', 9096543210, 110, 'Đã trả', 10, 10),
(301, '2024-11-01', 150000, 10, 'Tiền mặt', 786594356, 101, 'Đang mượn', 1, 1),
(302, '2024-11-05', 85000, 15, 'Chuyển khoản', 987654321, 102, 'Đã trả', 2, 2),
(303, '2024-11-10', 62000, 5, 'Tiền mặt', 223699874, 103, 'Đang mượn', 3, 3),
(304, '2024-11-15', 170000, 20, 'Chuyển khoản', 89885759, 104, 'Đã trả', 4, 4),
(305, '2024-11-20', 125000, 25, 'Tiền mặt', 11256698, 105, 'Đang mượn', 5, 5),
(306, '2024-11-25', 115000, 10, 'Chuyển khoản', 9091234567, 106, 'Đã trả', 6, 6),
(307, '2024-11-28', 80000, 5, 'Tiền mặt', 9099876543, 107, 'Đang mượn', 7, 7),
(308, '2024-12-01', 90000, 15, 'Chuyển khoản', 9098765432, 108, 'Đã trả', 8, 8),
(309, '2024-12-02', 155000, 10, 'Tiền mặt', 9096543210, 111, 'Đang mượn', 11, 2),
(310, '2024-12-05', 165000, 15, 'Chuyển khoản', 9098765432, 112, 'Đã trả', 12, 3),
(311, '2024-12-08', 130000, 5, 'Tiền mặt', 9099876543, 113, 'Đang mượn', 10, 4),
(312, '2024-12-10', 140000, 20, 'Chuyển khoản', 9091234567, 114, 'Đã trả', 9, 5),
(313, '2024-12-12', 120000, 25, 'Tiền mặt', 11256698, 115, 'Đang mượn', 8, 6),
(314, '2024-12-15', 110000, 10, 'Chuyển khoản', 89885759, 116, 'Đã trả', 7, 7),
(315, '2024-12-18', 90000, 5, 'Tiền mặt', 223699874, 117, 'Đang mượn', 6, 8),
(316, '2024-12-20', 85000, 15, 'Chuyển khoản', 987654321, 118, 'Đã trả', 5, 9),
(317, '2024-12-25', 95000, 20, 'Tiền mặt', 786594356, 119, 'Đang mượn', 4, 10),
(318, '2024-12-28', 115000, 15, 'Chuyển khoản', 9097654321, 120, 'Đã trả', 3, 1),
(401, '2024-11-01', 150000, 10, 'Tiền mặt', 786594356, 101, 'Đang mượn', 1, 1),
(402, '2024-11-02', 85000, 15, 'Chuyển khoản', 987654321, 102, 'Đã trả', 2, 2),
(403, '2024-11-05', 90000, 5, 'Tiền mặt', 223699874, 103, 'Đang mượn', 3, 3),
(404, '2024-11-10', 120000, 20, 'Chuyển khoản', 89885759, 104, 'Đã trả', 4, 4),
(405, '2024-11-15', 130000, 25, 'Tiền mặt', 11256698, 105, 'Đang mượn', 5, 5),
(406, '2024-11-20', 170000, 10, 'Chuyển khoản', 9091234567, 106, 'Đã trả', 6, 6),
(407, '2024-11-25', 125000, 5, 'Tiền mặt', 9099876543, 107, 'Đang mượn', 7, 7),
(408, '2024-11-28', 80000, 15, 'Chuyển khoản', 9098765432, 108, 'Đã trả', 8, 8),
(409, '2024-12-01', 155000, 10, 'Tiền mặt', 9096543210, 111, 'Đang mượn', 9, 2),
(410, '2024-12-05', 165000, 15, 'Chuyển khoản', 9098765432, 112, 'Đã trả', 10, 3),
(411, '2024-12-08', 130000, 5, 'Tiền mặt', 9099876543, 113, 'Đang mượn', 11, 4),
(412, '2024-12-10', 140000, 20, 'Chuyển khoản', 9091234567, 114, 'Đã trả', 12, 5),
(413, '2024-12-12', 120000, 25, 'Tiền mặt', 11256698, 115, 'Đang mượn', 1, 6),
(414, '2024-12-15', 110000, 10, 'Chuyển khoản', 89885759, 116, 'Đã trả', 2, 7),
(415, '2024-12-18', 90000, 5, 'Tiền mặt', 223699874, 117, 'Đang mượn', 3, 8),
(416, '2024-12-20', 85000, 15, 'Chuyển khoản', 987654321, 118, 'Đã trả', 4, 9),
(417, '2024-12-25', 95000, 20, 'Tiền mặt', 786594356, 119, 'Đang mượn', 5, 10),
(418, '2024-12-28', 115000, 15, 'Chuyển khoản', 9097654321, 120, 'Đã trả', 6, 1);

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
  `tinhTrang` text,
  `maKH` int(10) NOT NULL,
  `MaPhieuMuon` int(10) NOT NULL,
  `hinhAnh` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`maTK`, `email`, `matkhau`, `vaitro`, `maNguoiDung`) VALUES
(1, 'annguyen@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvienkho', 1),
(2, 'maitran@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanvienkho', 2),
(3, 'hungnguyen2u@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 3),
(4, 'unidsalt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'khachhang', 4),
(5, 'phucmy@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'khachhang', 5);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anpham`
--
ALTER TABLE `anpham`
  ADD PRIMARY KEY (`maAnPham`),
  ADD KEY `madauAP` (`madauAP`);

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
  MODIFY `maAnPham` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `chitietpm`
--
ALTER TABLE `chitietpm`
  MODIFY `maCTPM` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `danhmucap`
--
ALTER TABLE `danhmucap`
  MODIFY `MaDanhMuc` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dauap`
--
ALTER TABLE `dauap`
  MODIFY `madauAP` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hoadonnhapap`
--
ALTER TABLE `hoadonnhapap`
  MODIFY `MaHoaDon` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `maKH` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `MaKhuyenMai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `maNguoiDung` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `maNhanVien` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `phieumuon`
--
ALTER TABLE `phieumuon`
  MODIFY `MaPhieuMuon` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- AUTO_INCREMENT for table `phieutra`
--
ALTER TABLE `phieutra`
  MODIFY `MaPhieuTra` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `maTK` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `anpham_ibfk_3` FOREIGN KEY (`madauAP`) REFERENCES `dauap` (`madauAP`);

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
