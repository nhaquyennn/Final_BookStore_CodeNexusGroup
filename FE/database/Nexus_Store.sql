-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 04, 2024 lúc 10:33 PM
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

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateGiaThue` ()   BEGIN
    -- Cập nhật giá thuê cho các tình trạng khác
    UPDATE anpham
    SET giaThue = giaThue * 0.9
    WHERE tinhTrang = 'Tốt';

    UPDATE anpham
    SET giaThue = giaThue * 0.7
    WHERE tinhTrang = 'Hư hỏng nhẹ';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `anpham`
--

CREATE TABLE `anpham` (
  `maAnPham` int(10) NOT NULL,
  `TenAnPham` varchar(300) NOT NULL,
  `Giathue` float NOT NULL,
  `tinhTrang` varchar(255) DEFAULT NULL,
  `soLuongChoThue` int(255) NOT NULL,
  `soLuongTonKho` int(255) NOT NULL,
  `madauAP` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `anpham`
--

INSERT INTO `anpham` (`maAnPham`, `TenAnPham`, `Giathue`, `tinhTrang`, `soLuongChoThue`, `soLuongTonKho`, `madauAP`) VALUES
(1, '10 Vạn Câu Hỏi Vì Sao', 75000, 'Mới', 10, 20, 11),
(2, 'Chuyện Bên Rìa Thế Giới', 28350, 'Tốt', 5, 85, 1),
(3, 'Chuyện Con Mèo Dạy Hải Âu Bay', 135000, 'Tốt', 20, 60, 2),
(4, 'Chuyện Con Mèo Dạy Hải Âu Bay', 105000, 'Hư hỏng nhẹ', 0, 60, 2),
(5, 'Lược Sử Thời Gian', 500000, 'Mới', 30, 90, 3),
(6, 'Lược Sử Thời Gian', 450000, 'Tốt', 0, 90, 3),
(7, 'Sapiens: Lược Sử Loài Người', 250000, 'Mới', 20, 180, 4),
(8, 'Sapiens: Lược Sử Loài Người', 225000, 'Tốt', 0, 180, 4),
(9, 'Harry Potter và Hòn Đá Phù Thủy', 91125, 'Tốt', 0, 100, 5),
(10, 'Harry Potter và Hòn Đá Phù Thủy', 70875, 'Hư hỏng nhẹ', 10, 100, 5),
(11, 'Mắt Biếc', 17150, 'Hư hỏng nhẹ', 0, 100, 12),
(12, 'Mắt Biếc', 24500, 'Mới', 0, 100, 12),
(13, 'Thế Giới Không Có Người Xấu', 135000, 'Tốt', 0, 30, 7),
(14, 'Thế Giới Không Có Người Xấu', 105000, 'Hư hỏng nhẹ', 0, 30, 7),
(15, 'Căn Phòng Của Những Điều Kỳ Diệu', 120000, 'Mới', 0, 27, 8),
(16, 'Căn Phòng Của Những Điều Kỳ Diệu', 120000, 'Mới', 23, 27, 8),
(17, 'Thế Giới Nghệ Thuật - Nghệ Thuật Trừu Tượng', 135000, 'Mới', 0, 60, 9),
(18, 'Thế Giới Nghệ Thuật - Nghệ Thuật Trừu Tượng', 121500, 'Tốt', 20, 60, 9),
(19, 'Dẫn Luận Về Lịch Sử Nghệ Thuật', 200000, 'Mới', 0, 70, 10),
(20, 'Dẫn Luận Về Lịch Sử Nghệ Thuật', 140000, 'Hư hỏng nhẹ', 0, 70, 10),
(21, 'Chuyện Bên Rìa Thế Giới', 31500, 'Mới', 0, 85, 1),
(22, 'Đội Quân Doraemon - Đại Chiến Thuật Côn Trùng', 15000, 'Mới', 0, 140, 6),
(23, 'Tạp Chí Bóng đá Plus - Tháng 12/2024', 10000, 'Mới', 0, 30, 13),
(24, 'Tạp Chí Bóng Đá Plus - Tháng 11/2024', 10000, 'Mới', 0, 30, 15),
(25, 'Đẹp Magazine - Tháng 12/2024', 10000, 'Mới', 2, 28, 14);

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
  `MoTa` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmucap`
--

INSERT INTO `danhmucap` (`MaDanhMuc`, `TenDanhMuc`, `MoTa`, `image`) VALUES
(1, 'Tiểu Thuyết', 'Mang đến những câu chuyện hấp dẫn và sâu sắc về cuộc sống, tình yêu, và nhân văn.', 'mat-biec.jpg'),
(2, 'Khoa Học', 'Cung cấp kiến thức đa dạng từ tự nhiên, xã hội đến công nghệ,', 'luoc-su-thoi-gian.jpg'),
(3, 'Thiếu Nhi', 'Với các câu chuyện thú vị và giáo dục, giúp phát triển trí tưởng tượng và kỹ năng đọc cho trẻ nhỏ.', 'dai-chien-thuat-con-trung.webp'),
(4, 'Lịch Sử', 'Khám phá các sự kiện quan trọng, nhân vật lịch sử và bối cảnh văn hóa từ các thời kỳ khác nhau trên thế giới', 'dan-luan-ls.webp'),
(5, 'Nghệ Thuật', 'Giới thiệu về các hình thức nghệ thuật khác nhau như hội họa, điêu khắc, âm nhạc, và văn học, cùng các nghệ sĩ vĩ đại qua các thời kỳ.', 'the-gioi-nghe-thuat.jpg'),
(6, 'Tạp Chí Thể Thao', 'Chuyên cung cấp tin tức, phân tích, phỏng vấn và hình ảnh nổi bật về các sự kiện, vận động viên, và môn thể thao, truyền cảm hứng sống khỏe và năng động.', 'tap-chi-the-thao-2.jpg'),
(7, 'Tạp Chí Thời Trang', 'Chuyên về xu hướng thời trang, phong cách sống, và làm đẹp. ', 'tap-chi-thoi-trang.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dauap`
--

CREATE TABLE `dauap` (
  `madauAP` int(10) NOT NULL,
  `TenDauAnPham` varchar(255) NOT NULL,
  `Tacgia` varchar(255) NOT NULL,
  `NXB` varchar(200) NOT NULL,
  `Tongsoluong` int(10) NOT NULL,
  `VitrixepGia` varchar(255) DEFAULT NULL,
  `MaDanhMuc` int(10) NOT NULL,
  `hinhAnh` varchar(300) NOT NULL,
  `moTa` varchar(255) NOT NULL,
  `ngayXB` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dauap`
--

INSERT INTO `dauap` (`madauAP`, `TenDauAnPham`, `Tacgia`, `NXB`, `Tongsoluong`, `VitrixepGia`, `MaDanhMuc`, `hinhAnh`, `moTa`, `ngayXB`) VALUES
(1, 'Chuyện Bên Rìa Thế Giới', 'Nguyễn Nhật Ánh', 'NXB Kim Đồng', 90, '70000', 1, 'chuyen-ben-ria-the-gioi.jpg', 'Một tác phẩm khám phá những câu chuyện kỳ bí và lạ lùng ở những vùng đất xa xôi, biên giới của thế giới.', '2024-11-08'),
(2, 'Chuyện Con Mèo Dạy Hải Âu Bay', 'Luis Sepúlveda', 'NXB Trẻ', 80, '60000', 1, 'chuyen-con-meo-day-hai-au-bay.jpg', 'Câu chuyện về sự kết nối kỳ diệu giữa một con mèo và một con hải âu, khơi dậy ước mơ tự do bay lượn.', '2020-07-20'),
(3, 'Lược Sử Thời Gian', 'Stephen Hawking', 'NXB Tổng Hợp', 120, '150000', 2, 'luoc-su-thoi-gian.jpg', 'Một cuộc hành trình qua các bước ngoặt lịch sử của vũ trụ, từ những khám phá vật lý cơ bản đến những lý thuyết vũ trụ tiên tiến.', '2018-09-04'),
(4, 'Sapiens: Lược Sử Loài Người', 'Yuval Noah Harari', 'NXB Dân Trí', 200, '200000', 2, 'luoc-su-loai-nguoi.jpg', 'Một cái nhìn tổng quan về sự tiến hóa và lịch sử của loài người từ thời kỳ tiền sử đến ngày nay.', '2018-11-11'),
(5, 'Harry Potter và Hòn Đá Phù Thủy', 'J.K. Rowling', 'NXB Kim Đồng', 110, '120000', 3, 'harry-potter-hon-da-phu-thuy.jpg', 'Cuốn sách đầu tiên trong loạt truyện nổi tiếng về cậu bé phù thủy Harry Potter, bắt đầu hành trình kỳ diệu tại trường học phép thuật.', '2021-03-01'),
(6, 'Đội Quân Doraemon - Đại Chiến Thuật Côn Trùng', 'Fujiko F Fujio', 'NXB Kim Đồng', 140, '65000', 3, 'dai-chien-thuat-con-trung.webp', 'Một cuộc phiêu lưu thú vị với đội quân Doraemon đối đầu với những thử thách đầy cam go.', '2022-01-05'),
(7, 'Thế Giới Không Có Người Xấu', 'Whon Jaehun', 'NXB Dân Trí\n', 30, '85000', 1, 'the-gioi-khong-co-nguoi-xau.jpg', 'Tác phẩm phân tích và đi sâu vào sự hiểu biết về bản chất con người và những yếu tố tạo nên sự thiện và ác.', '2019-05-25'),
(8, 'Căn Phòng Của Những Điều Kỳ Diệu', 'Julien Sandrel', 'NXB Kim Đồng', 50, '110000', 4, 'can-phong-cua-nhung-dieu-ky-dieu.jpg', 'Câu chuyện hấp dẫn về những điều kỳ diệu xảy ra trong một căn phòng chứa đựng vô vàn bí ẩn.', '2020-09-15'),
(9, 'Thế Giới Nghệ Thuật - Nghệ Thuật Trừu Tượng', 'Anna Moszynska', 'NXB Thế Giới', 80, '13000', 5, 'the-gioi-nghe-thuat.jpg', 'Khám phá thế giới nghệ thuật trừu tượng, nơi cảm xúc và ý tưởng được thể hiện qua những hình ảnh và màu sắc không thực.', '2021-02-28'),
(10, 'Dẫn Luận Về Lịch Sử Nghệ Thuật', 'Dana Arnold', 'NXB Hồng Đức', 70, '14000', 5, 'dan-luan-ls.webp', 'Một tác phẩm khám phá sự phát triển của nghệ thuật qua các thời kỳ, với các cuộc tranh luận về những giá trị nghệ thuật.', '2021-04-10'),
(11, '10 vạn câu hỏi vì sao', 'Phan Anh Lệ', 'NXB Văn Học', 30, '10000', 2, '10-van-cau-hoi-vi-sao.webp', 'Một bộ sách giúp trẻ em tìm hiểu về thế giới xung quanh qua những câu hỏi và câu trả lời khoa học thú vị.', '2021-10-10'),
(12, 'Mắt Biếc', 'Nguyễn Nhật Ánh', 'NXB Trẻ', 100, '60000', 1, 'mat-biec.jpg', 'Một câu chuyện đầy cảm xúc về tình yêu và sự hy sinh, mang đậm chất lãng mạn và nhân văn.', '2021-01-15'),
(13, 'Bóng đá Plus - Tháng 12/2024', 'Nguyễn Minh Anh', 'NXB Thể Thao', 30, '1000', 6, 'tap-chi-the-thao-2.jpg', 'Tạp chí chuyên về bóng đá, cập nhật các sự kiện và phân tích trong thế giới bóng đá vào tháng 12 năm 2024.', '2024-12-01'),
(14, 'Đẹp Magazine - Tháng 12/2024', 'Le Media', 'Le Media', 30, '1000', 7, 'tap-chi-thoi-trang.jpg', 'Tạp chí thời trang nổi bật với các xu hướng mới nhất trong ngành làm đẹp, thời trang, và phong cách sống.', '2024-12-01'),
(15, 'Tạp Chí Bóng Đá Plus - Tháng 11/2024', ' Nguyễn Minh Anh', 'NXB Thể Thao', 30, '1000', 6, 'tap-chi-the-thao-1.jpg', 'Phiên bản đặc biệt của tạp chí Bóng Đá Plus, tập trung vào các sự kiện và phân tích trong tháng 11 năm 2024.', '2024-11-01');

--
-- Bẫy `dauap`
--
DELIMITER $$
CREATE TRIGGER `update_soLuongTonKho` AFTER UPDATE ON `dauap` FOR EACH ROW BEGIN
    -- Cập nhật số lượng tồn kho cho từng sản phẩm theo mã đầu ấn phẩm
    UPDATE anpham AS a
    JOIN dauap AS d ON a.madauAP = d.madauAP  -- Liên kết bảng anpham và dauap theo mã đầu ấn phẩm
    SET a.soLuongTonKho = d.tongSoLuong - (
        SELECT SUM(a.soLuongChoThue)  -- Tổng số lượng đã cho thuê
        FROM anpham AS a
        WHERE a.madauAP = d.madauAP
    )
    WHERE a.madauAP = NEW.madauAP;  -- Điều kiện cập nhật theo maAnPham của bản ghi vừa thay đổi
END
$$
DELIMITER ;

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
  `diaChi` varchar(200) DEFAULT 'Trống',
  `maNguoiDung` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`maKH`, `tenKH`, `diaChi`, `maNguoiDung`) VALUES
(1, 'Quách Đạt Phúc', '125 Phó Cơ Điều, Quận 5, TPHCM', 4),
(2, 'Phúc Mỹ', '555 WTF, Quận Gò Vấp', 5),
(4, 'Nguyễn Văn B', '', 11);

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
  `SDT` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`maNguoiDung`, `tenNguoiDung`, `gioiTinh`, `email`, `SDT`) VALUES
(1, 'Nguyễn Bình An', 'Nữ', 'annguyen@example.com', 786594356),
(2, 'Trần Ngọc Mai', 'Nữ', 'maitran@example.com', 987654321),
(3, 'Nguyễn Thị Tèo', 'Nữ', 'hungnguyen2u@gmail.com', 223699874),
(4, 'Quách Đạt Phúc', 'Nam', 'unidsalt@gmail.com', 89885759),
(5, 'Phúc Mỹ', 'Nam', 'phucmy@gmail.com', 11256698),
(11, 'Nguyễn Văn B', 'Không xác định', 'nguyenvanb@example.com', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `maNhanVien` int(100) NOT NULL,
  `tenNhanVien` text NOT NULL,
  `chucVu` text NOT NULL,
  `maNguoiDung` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`maNhanVien`, `tenNhanVien`, `chucVu`, `maNguoiDung`) VALUES
(1, 'Nguyễn Bình An', 'Nhân viên kho', 1),
(2, 'Trần Ngọc Mai', 'Nhân viên kho', 2),
(3, 'Nguyễn Thị Nở', 'Quản lý', 3);

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
(5, 'phucmy@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'khachhang', 5),
(11, 'nguyenvanb@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'khachhang', 11);

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
-- AUTO_INCREMENT cho bảng `chitietpm`
--
ALTER TABLE `chitietpm`
  MODIFY `maCTPM` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `danhmucap`
--
ALTER TABLE `danhmucap`
  MODIFY `MaDanhMuc` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `dauap`
--
ALTER TABLE `dauap`
  MODIFY `madauAP` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT cho bảng `hoadonnhapap`
--
ALTER TABLE `hoadonnhapap`
  MODIFY `MaHoaDon` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `maKH` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `MaKhuyenMai` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `maNguoiDung` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `maTK` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `anpham_ibfk_1` FOREIGN KEY (`madauAP`) REFERENCES `dauap` (`madauAP`);

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
