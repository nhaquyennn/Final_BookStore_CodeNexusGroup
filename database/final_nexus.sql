-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 13, 2024 lúc 01:29 AM
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
  `Giathue` float NOT NULL,
  `tinhTrang` varchar(255) DEFAULT NULL,
  `soLuongChoThue` int(255) NOT NULL,
  `soLuongTonKho` int(255) NOT NULL,
  `madauAP` int(10) NOT NULL,
  `PhiThue` int(11) NOT NULL,
  `ngayXB` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `anpham`
--

INSERT INTO `anpham` (`maAnPham`, `TenAnPham`, `Giathue`, `tinhTrang`, `soLuongChoThue`, `soLuongTonKho`, `madauAP`, `PhiThue`, `ngayXB`) VALUES
(1, '10 Vạn Câu Hỏi Vì Sao', 75000, 'Mới', 10, 20, 11, 1500, '2021-10-10'),
(2, 'Chuyện Bên Rìa Thế Giới', 28350, 'Tốt', 5, 95, 1, 567, '2024-11-08'),
(3, 'Chuyện Con Mèo Dạy Hải Âu Bay', 135000, 'Tốt', 20, 60, 2, 2700, '2020-07-20'),
(4, 'Chuyện Con Mèo Dạy Hải Âu Bay', 105000, 'Hư hỏng nhẹ', 0, 60, 2, 2100, '2020-07-20'),
(5, 'Lược Sử Thời Gian', 500000, 'Mới', 30, 90, 3, 10000, '2018-09-04'),
(6, 'Lược Sử Thời Gian', 450000, 'Tốt', 0, 90, 3, 9000, '2018-09-04'),
(7, 'Sapiens: Lược Sử Loài Người', 250000, 'Mới', 20, 180, 4, 5000, '2018-11-11'),
(8, 'Sapiens: Lược Sử Loài Người', 225000, 'Tốt', 0, 180, 4, 4500, '2018-11-11'),
(9, 'Harry Potter và Hòn Đá Phù Thủy', 91125, 'Tốt', 0, 100, 5, 1822, '2021-03-01'),
(10, 'Harry Potter và Hòn Đá Phù Thủy', 70875, 'Hư hỏng nhẹ', 10, 100, 5, 1418, '2021-03-01'),
(11, 'Mắt Biếc', 17150, 'Hư hỏng nhẹ', 0, 100, 12, 343, '2021-01-15'),
(12, 'Mắt Biếc', 24500, 'Mới', 0, 100, 12, 490, '2021-01-15'),
(13, 'Thế Giới Không Có Người Xấu', 135000, 'Tốt', 0, 30, 7, 2700, '2019-05-25'),
(14, 'Thế Giới Không Có Người Xấu', 105000, 'Hư hỏng nhẹ', 0, 30, 7, 2100, '2019-05-25'),
(15, 'Căn Phòng Của Những Điều Kỳ Diệu', 120000, 'Mới', 0, 89, 8, 2400, '2020-09-15'),
(16, 'Căn Phòng Của Những Điều Kỳ Diệu', 120000, 'Mới', 1, 89, 8, 2400, '2020-09-15'),
(17, 'Thế Giới Nghệ Thuật - Nghệ Thuật Trừu Tượng', 135000, 'Mới', 0, 60, 9, 2700, '2021-02-28'),
(18, 'Thế Giới Nghệ Thuật - Nghệ Thuật Trừu Tượng', 121500, 'Tốt', 20, 60, 9, 2430, '2021-02-28'),
(19, 'Dẫn Luận Về Lịch Sử Nghệ Thuật', 200000, 'Mới', 0, 70, 10, 4000, '2021-04-10'),
(20, 'Dẫn Luận Về Lịch Sử Nghệ Thuật', 140000, 'Hư hỏng nhẹ', 0, 70, 10, 2800, '2021-04-10'),
(21, 'Chuyện Bên Rìa Thế Giới', 31500, 'Mới', 0, 95, 1, 630, '2024-11-08'),
(22, 'Đội Quân Doraemon - Đại Chiến Thuật Côn Trùng', 15000, 'Mới', 0, 140, 6, 300, '2022-01-05'),
(23, 'Tạp Chí Bóng đá Plus - Tháng 12/2024', 10000, 'Mới', 0, 30, 13, 200, '2024-12-01'),
(24, 'Tạp Chí Bóng Đá Plus - Tháng 11/2024', 10000, 'Mới', 0, 30, 15, 200, '2024-11-01'),
(25, 'Đẹp Magazine - Tháng 12/2024', 10000, 'Mới', 2, 28, 14, 200, '2024-12-01'),
(100, 'Test', 1323330, 'Test', 0, 0, 15, 26467, '2024-12-29');

--
-- Bẫy `anpham`
--
DELIMITER $$
CREATE TRIGGER `trg_UpdatePhiThue` BEFORE INSERT ON `anpham` FOR EACH ROW BEGIN
    -- Cập nhật giá trị PhiThue trước khi thêm bản ghi mới
    SET NEW.PhiThue = NEW.Giathue * 0.05;
END
$$
DELIMITER ;

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
  `MaKhuyenMai` int(10) NOT NULL,
  `tinhTrangMuon` text DEFAULT NULL,
  `hinhAnh` varchar(300) NOT NULL,
  `Phithue` int(11) NOT NULL,
  `ngayMuon` date DEFAULT NULL,
  `ngayTra` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietpm`
--

INSERT INTO `chitietpm` (`maCTPM`, `MaPhieuMuon`, `maAnPham`, `SoLuong`, `DonGia`, `GiamGia`, `MaKhuyenMai`, `tinhTrangMuon`, `hinhAnh`, `Phithue`, `ngayMuon`, `ngayTra`) VALUES
(54, 94, 9, 5, 91125, 0, 0, NULL, '', 4556, '2024-12-12', '2024-12-27'),
(55, 94, 22, 5, 15000, 0, 0, NULL, '', 750, '2024-12-12', '2024-12-25'),
(56, 95, 11, 5, 17150, 0, 0, NULL, '', 858, '2024-12-12', '2024-12-15'),
(57, 96, 11, 5, 17150, 0, 2, NULL, '', 858, '2024-12-12', '2024-12-15'),
(58, 97, 15, 2, 120000, 0, 6, NULL, '', 6000, '2024-12-12', '2024-12-15'),
(59, 97, 19, 1, 200000, 0, 6, NULL, '', 10000, '2024-12-12', '2024-12-24'),
(60, 98, 15, 2, 120000, 0, 2, NULL, '', 6000, '2024-12-12', '2024-12-15'),
(61, 98, 19, 1, 200000, 0, 2, NULL, '', 10000, '2024-12-12', '2024-12-24'),
(62, 100, 18, 10, 121500, 0, 3, NULL, '', 6075, '2024-12-12', '2024-12-25'),
(63, 101, 2, 1, 567, 0, 0, NULL, '', 0, '0000-00-00', '2024-12-22'),
(64, 101, 21, 1, 630, 0, 0, NULL, '', 0, '0000-00-00', '2024-12-22'),
(65, 104, 5, 2, 500000, 0, 1, NULL, '', 10000, '2024-12-13', '2024-12-22'),
(66, 105, 5, 2, 500000, 0, 1, NULL, '', 0, '2024-12-13', '2024-12-22'),
(67, 106, 5, 2, 500000, 0, 2, NULL, '', 0, '2024-12-13', '2024-12-22'),
(68, 107, 7, 1, 250000, 0, 2, NULL, '', 10000, '2024-12-13', '2024-12-16'),
(69, 108, 11, 3, 17150, 0, 2, NULL, '', 11319, '2024-12-13', '2024-12-25'),
(70, 111, 11, 3, 17150, 0, 1, 'Hư hỏng nhẹ', 'mat-biec.jpg', 43719, '2024-12-13', '2024-12-25'),
(71, 111, 13, 1, 135000, 0, 1, 'Tốt', 'the-gioi-khong-co-nguoi-xau.jpg', 43719, '2024-12-13', '2024-12-26'),
(72, 112, 11, 3, 17150, 0, 2, 'Hư hỏng nhẹ', 'mat-biec.jpg', 43719, '2024-12-13', '2024-12-25'),
(73, 112, 13, 1, 135000, 0, 2, 'Tốt', 'the-gioi-khong-co-nguoi-xau.jpg', 43719, '2024-12-13', '2024-12-26'),
(74, 129, 11, 3, 17150, 0, 2, 'Hư hỏng nhẹ', 'mat-biec.jpg', 48255, '2024-12-13', '2024-12-25'),
(75, 129, 13, 1, 135000, 0, 2, 'Tốt', 'the-gioi-khong-co-nguoi-xau.jpg', 48255, '2024-12-13', '2024-12-26'),
(76, 129, 2, 1, 28350, 0, 2, 'Tốt', 'chuyen-ben-ria-the-gioi.jpg', 48255, '2024-12-13', '2024-12-22'),
(77, 132, 11, 3, 17150, 0, 1, 'Hư hỏng nhẹ', 'mat-biec.jpg', 48255, '2024-12-13', '2024-12-25'),
(78, 132, 13, 1, 135000, 0, 1, 'Tốt', 'the-gioi-khong-co-nguoi-xau.jpg', 48255, '2024-12-13', '2024-12-26'),
(79, 132, 2, 1, 28350, 0, 1, 'Tốt', 'chuyen-ben-ria-the-gioi.jpg', 48255, '2024-12-13', '2024-12-22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cthoadonnhap`
--

CREATE TABLE `cthoadonnhap` (
  `maCTHD` int(10) NOT NULL,
  `TenAnPham` text NOT NULL,
  `NhaXB` text NOT NULL,
  `NamXB` int(11) NOT NULL,
  `SoLuong` int(200) NOT NULL,
  `DonGia` double NOT NULL,
  `madauAP` int(10) NOT NULL,
  `TongTien` double NOT NULL,
  `maHoaDon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cthoadonnhap`
--

INSERT INTO `cthoadonnhap` (`maCTHD`, `TenAnPham`, `NhaXB`, `NamXB`, `SoLuong`, `DonGia`, `madauAP`, `TongTien`, `maHoaDon`) VALUES
(1, 'Chuyện Con Mèo Dạy Hải Âu Bay', 'Nhà xuất bản Trẻ', 2020, 10, 10000, 2, 1000000, 1),
(2, 'Dẫn Luận Về Lịch Sử Nghệ Thuật', 'Nhà xuất bản Hồng Đức', 2021, 150, 5000, 10, 750000, 2),
(3, 'Thế Giới Nghệ Thuật - Nghệ Thuật Trừu Tượng', 'Nhà xuất bản Thế Giới', 2021, 5, 30000, 9, 1500000, 1),
(4, 'Đội Quân Doraemon - Đại Chiến Thuật Côn Trùng', 'Nhà xuất bản Kim Đồng', 2023, 5, 20000, 6, 1600000, 3),
(5, 'Harry Potter và Hòn Đá Phù Thủy', 'Nhà xuất bản Kim Đồng', 2022, 3, 40000, 5, 2400000, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgia`
--

CREATE TABLE `danhgia` (
  `id` int(11) NOT NULL,
  `maNguoiDung` int(11) NOT NULL,
  `maAnPham` int(11) NOT NULL,
  `diemSo` int(11) NOT NULL CHECK (`diemSo` between 1 and 5),
  `binhLuan` text DEFAULT NULL,
  `hinhAnh` varchar(255) DEFAULT NULL,
  `ngayDanhGia` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhgia`
--

INSERT INTO `danhgia` (`id`, `maNguoiDung`, `maAnPham`, `diemSo`, `binhLuan`, `hinhAnh`, `ngayDanhGia`) VALUES
(21, 5, 5, 4, 'gút', 'ratings/397084eff120702dca13006f3241cb14.png', '2024-12-11 13:35:34'),
(23, 5, 3, 4, 'qqqq', 'ratings/b0e1ee8432ec8b37c0930654d394d5d4.png', '2024-12-11 14:20:24');

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
  `moTa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dauap`
--

INSERT INTO `dauap` (`madauAP`, `TenDauAnPham`, `Tacgia`, `NXB`, `Tongsoluong`, `VitrixepGia`, `MaDanhMuc`, `hinhAnh`, `moTa`) VALUES
(1, 'Chuyện Bên Rìa Thế Giới', 'Nguyễn Nhật Ánh', 'NXB Kim Đồng', 100, '70000', 1, 'chuyen-ben-ria-the-gioi.jpg', 'Một tác phẩm khám phá những câu chuyện kỳ bí và lạ lùng ở những vùng đất xa xôi, biên giới của thế giới.'),
(2, 'Chuyện Con Mèo Dạy Hải Âu Bay', 'Luis Sepúlveda', 'NXB Trẻ', 80, '60000', 1, 'chuyen-con-meo-day-hai-au-bay.jpg', 'Câu chuyện về sự kết nối kỳ diệu giữa một con mèo và một con hải âu, khơi dậy ước mơ tự do bay lượn.'),
(3, 'Lược Sử Thời Gian', 'Stephen Hawking', 'NXB Tổng Hợp', 120, '150000', 2, 'luoc-su-thoi-gian.jpg', 'Một cuộc hành trình qua các bước ngoặt lịch sử của vũ trụ, từ những khám phá vật lý cơ bản đến những lý thuyết vũ trụ tiên tiến.'),
(4, 'Sapiens: Lược Sử Loài Người', 'Yuval Noah Harari', 'NXB Dân Trí', 200, '200000', 2, 'luoc-su-loai-nguoi.jpg', 'Một cái nhìn tổng quan về sự tiến hóa và lịch sử của loài người từ thời kỳ tiền sử đến ngày nay.'),
(5, 'Harry Potter và Hòn Đá Phù Thủy', 'J.K. Rowling', 'NXB Kim Đồng', 110, '120000', 3, 'harry-potter-hon-da-phu-thuy.jpg', 'Cuốn sách đầu tiên trong loạt truyện nổi tiếng về cậu bé phù thủy Harry Potter, bắt đầu hành trình kỳ diệu tại trường học phép thuật.'),
(6, 'Đội Quân Doraemon - Đại Chiến Thuật Côn Trùng', 'Fujiko F Fujio', 'NXB Kim Đồng', 140, '65000', 3, 'dai-chien-thuat-con-trung.webp', 'Một cuộc phiêu lưu thú vị với đội quân Doraemon đối đầu với những thử thách đầy cam go.'),
(7, 'Thế Giới Không Có Người Xấu', 'Whon Jaehun', 'NXB Dân Trí\n', 30, '85000', 1, 'the-gioi-khong-co-nguoi-xau.jpg', 'Tác phẩm phân tích và đi sâu vào sự hiểu biết về bản chất con người và những yếu tố tạo nên sự thiện và ác.'),
(8, 'Căn Phòng Của Những Điều Kỳ Diệu', 'Julien Sandrel', 'NXB Kim Đồng', 90, '110000', 4, 'can-phong-cua-nhung-dieu-ky-dieu.jpg', 'Câu chuyện hấp dẫn về những điều kỳ diệu xảy ra trong một căn phòng chứa đựng vô vàn bí ẩn.'),
(9, 'Thế Giới Nghệ Thuật - Nghệ Thuật Trừu Tượng', 'Anna Moszynska', 'NXB Thế Giới', 80, '13000', 5, 'the-gioi-nghe-thuat.jpg', 'Khám phá thế giới nghệ thuật trừu tượng, nơi cảm xúc và ý tưởng được thể hiện qua những hình ảnh và màu sắc không thực.'),
(10, 'Dẫn Luận Về Lịch Sử Nghệ Thuật', 'Dana Arnold', 'NXB Hồng Đức', 70, '14000', 5, 'dan-luan-ls.webp', 'Một tác phẩm khám phá sự phát triển của nghệ thuật qua các thời kỳ, với các cuộc tranh luận về những giá trị nghệ thuật.'),
(11, '10 vạn câu hỏi vì sao', 'Phan Anh Lệ', 'NXB Văn Học', 30, '10000', 2, '10-van-cau-hoi-vi-sao.webp', 'Một bộ sách giúp trẻ em tìm hiểu về thế giới xung quanh qua những câu hỏi và câu trả lời khoa học thú vị.'),
(12, 'Mắt Biếc', 'Nguyễn Nhật Ánh', 'NXB Trẻ', 100, '60000', 1, 'mat-biec.jpg', 'Một câu chuyện đầy cảm xúc về tình yêu và sự hy sinh, mang đậm chất lãng mạn và nhân văn.'),
(13, 'Bóng đá Plus - Tháng 12/2024', 'Nguyễn Minh Anh', 'NXB Thể Thao', 30, '1000', 6, 'tap-chi-the-thao-2.jpg', 'Tạp chí chuyên về bóng đá, cập nhật các sự kiện và phân tích trong thế giới bóng đá vào tháng 12 năm 2024.'),
(14, 'Đẹp Magazine - Tháng 12/2024', 'Le Media', 'Le Media', 30, '1000', 7, 'tap-chi-thoi-trang.jpg', 'Tạp chí thời trang nổi bật với các xu hướng mới nhất trong ngành làm đẹp, thời trang, và phong cách sống.'),
(15, 'Tạp Chí Bóng Đá Plus - Tháng 11/2024', ' Nguyễn Minh Anh', 'NXB Thể Thao', 30, '1000', 6, 'tap-chi-the-thao-1.jpg', 'Phiên bản đặc biệt của tạp chí Bóng Đá Plus, tập trung vào các sự kiện và phân tích trong tháng 11 năm 2024.');

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
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `id` int(11) NOT NULL,
  `maNguoiDung` int(10) NOT NULL,
  `maAnPham` int(10) NOT NULL,
  `SoLuong` int(10) NOT NULL DEFAULT 1,
  `NgayTra` date NOT NULL DEFAULT (curdate() + interval 15 day)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`id`, `maNguoiDung`, `maAnPham`, `SoLuong`, `NgayTra`) VALUES
(49, 6, 25, 2, '2024-12-22'),
(50, 6, 4, 1, '2024-12-22'),
(51, 4, 13, 1, '2024-12-15'),
(52, 4, 6, 1, '2024-12-15'),
(55, 5, 11, 3, '2024-12-25'),
(56, 5, 13, 1, '2024-12-26'),
(57, 5, 2, 1, '2024-12-22'),
(58, 5, 21, 1, '2024-12-14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadonnhapap`
--

CREATE TABLE `hoadonnhapap` (
  `MaHoaDon` int(10) NOT NULL,
  `TenHoaDon` varchar(500) NOT NULL,
  `maNhanVien` int(10) NOT NULL,
  `NgayTao` date DEFAULT NULL,
  `NoiDung` varchar(500) NOT NULL,
  `TongsoLuong` float NOT NULL,
  `TongTien` float NOT NULL,
  `NhaCungCap` varchar(255) DEFAULT NULL,
  `DanhSachAnPham` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadonnhapap`
--

INSERT INTO `hoadonnhapap` (`MaHoaDon`, `TenHoaDon`, `maNhanVien`, `NgayTao`, `NoiDung`, `TongsoLuong`, `TongTien`, `NhaCungCap`, `DanhSachAnPham`) VALUES
(1, 'Hóa đơn nhập sách tháng 11', 1, '2024-11-05', '10 cuốn sách tiêủ thuyết,\r\n5 cuốn sách nghệ thuật', 15, 1500000, 'Nhà xuất bản Kim Đồng', NULL),
(2, 'Hóa đơn nhập sách tháng 12', 2, '2024-12-10', '5 cuốn sách nghệ thuật', 5, 2500000, 'Công ty TNHH Sách Sài Gòn', NULL),
(3, 'Hóa đơn nhập sách bổ sung tháng 12', 1, '2024-12-30', '8 cuốn sách thiếu nhi', 8, 1800000, 'Nhà xuất bản Trẻ', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `maKH` int(100) NOT NULL,
  `tenKH` text NOT NULL,
  `diaChi` varchar(200) NOT NULL,
  `maNguoiDung` int(11) NOT NULL,
  `ThanhVien` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`maKH`, `tenKH`, `diaChi`, `maNguoiDung`, `ThanhVien`) VALUES
(1, 'Quách Đạt Phúc', '125 Phó Cơ Điều, Quận 5, TPHCM', 4, NULL),
(2, 'Phúc Mỹ', '555 WTF, Quận Gò Vấp', 5, 'Có'),
(3, 'Nguyễn Thị Bé Năm', '123 Nguyễn Huệ', 6, 'Có');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `MaKhuyenMai` int(10) NOT NULL,
  `TenKhuyenMai` varchar(255) DEFAULT NULL,
  `PhanTramGiamgia` float NOT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `NgayBatDau` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`MaKhuyenMai`, `TenKhuyenMai`, `PhanTramGiamgia`, `NgayKetThuc`, `NgayBatDau`) VALUES
(1, 'Khuyến mãi mùa đông - Giảm 5% phí mượn ấn phẩm\n', 5, '2025-02-28', '2025-01-01'),
(2, 'Giảm giá đầu năm - Giảm 15% phí mượn ấn phẩm\n', 15, '2025-01-31', '2025-01-01'),
(3, 'Sale Black Friday - Giảm 20%  phí mượn ấn phẩm', 20, '2024-11-29', '2024-11-25'),
(4, 'Bạn đọc thân thiết - Giảm 12%  phí mượn ấn phẩm', 12, '2024-12-01', '2024-12-31'),
(6, 'Khách hàng VIP - Giảm 10% giá thuê ', 10, '2024-12-01', '2024-12-31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaiyc`
--

CREATE TABLE `loaiyc` (
  `maloaiYC` varchar(50) NOT NULL,
  `tenloaiYC` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaiyc`
--

INSERT INTO `loaiyc` (`maloaiYC`, `tenloaiYC`) VALUES
('1', 'Yêu cầu đổi/trả sách'),
('2', 'Yêu cầu bổ sung sách'),
('3', 'Yêu cầu hỗ trợ tư vấn'),
('4', 'Yêu cầu bảo hành sách'),
('5', 'Yêu cầu thông tin khuyến mãi');

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
(3, 'Nguyễn Thị Tèo', 'Nữ', 'hungnguyen2u@gmail.com', 223699874, '123 Phố Bùi Viện, Quận 1, TPHCM'),
(4, 'Quách Đạt Phúc', 'Nam', 'unidsalt@gmail.com', 89885759, '125 Phó Cơ Điều, Quận 5, TPHCM'),
(5, 'Phúc Mỹ', 'Nam', 'phucmy@gmail.com', 11256698, '555 WTF, Quận Gò Vấp'),
(6, 'Nguyễn Thị Bé Năm', 'Nữ', 'be5@gmail.com', 998877665, '123 Nguyễn Huệ'),
(10, 'Võ Minh Thịnh', 'Nam', 'minhthinh@gmail.com', 112233445, '');

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
(3, 'Nguyễn Thị Nở', 'Quản lý', 3),
(4, 'Võ Minh Thịnh', 'Nhân viên nhận trả', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieumuon`
--

CREATE TABLE `phieumuon` (
  `MaPhieuMuon` int(10) NOT NULL,
  `hoTen` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `diaChi` varchar(255) NOT NULL,
  `ghiChu` text DEFAULT NULL,
  `NgayTao` date NOT NULL DEFAULT current_timestamp(),
  `TongTien` float NOT NULL,
  `GiamGia` float NOT NULL,
  `PhuongThucThanhToan` varchar(255) DEFAULT NULL,
  `SoDienThoai` int(10) DEFAULT NULL,
  `tinhTrang` enum('Đang xử lý','Đã xác nhận','Đang giao hàng','Đã hoàn tất','Đã hủy') NOT NULL DEFAULT 'Đang xử lý',
  `lyDoHuy` varchar(255) DEFAULT NULL,
  `soTaiKhoan` varchar(20) DEFAULT NULL,
  `maKH` int(100) DEFAULT NULL,
  `MaKhuyenMai` int(10) DEFAULT NULL,
  `PhiShip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phieumuon`
--

INSERT INTO `phieumuon` (`MaPhieuMuon`, `hoTen`, `email`, `diaChi`, `ghiChu`, `NgayTao`, `TongTien`, `GiamGia`, `PhuongThucThanhToan`, `SoDienThoai`, `tinhTrang`, `lyDoHuy`, `soTaiKhoan`, `maKH`, `MaKhuyenMai`, `PhiShip`) VALUES
(94, 'Tú Uyên', '', 'ABC', 'Ship 10 tô phở ', '2024-12-12', 554322, 0, 'Chuyển khoản', 998377477, 'Đã hủy', NULL, NULL, 2, NULL, 0),
(95, 'Võ Hoàng Nhã Quyên', '', 'ABC', 'Ship 10 tô phở ', '2024-12-12', 105845, 0, 'Chuyển khoản', 787886666, 'Đã hủy', NULL, NULL, 2, NULL, 0),
(96, 'Võ Hoàng Nhã Quyên', '', 'ABC', '', '2024-12-12', 105845, 0, 'Chuyển khoản', 787886666, 'Đang giao hàng', NULL, NULL, 2, 2, 0),
(97, 'Con Meo', '', '109/33/3 Pho ', 'Ước gì có tiền nhiều', '2024-12-12', 0, 0, 'Chuyển khoản', 787886666, 'Đã xác nhận', NULL, NULL, 2, 6, 0),
(98, 'Mì Nhéo', '', '109/33/09', '', '2024-12-12', 466262, 0, 'Chuyển khoản', 787886666, 'Đã xác nhận', NULL, NULL, 2, 2, 20000),
(100, 'Con Meo', '', 'ABC', 'Ước gì có tiền nhiều', '2024-12-12', 0, 0, 'Chuyển khoản', 0, '', NULL, NULL, 2, 3, 0),
(104, 'Tú Uyên', '', 'ABC', 'têttetetete', '2024-12-13', 1180000, 0, 'Chuyển khoản', 998377477, 'Đang xử lý', NULL, NULL, 2, 1, 20000),
(105, 'Võ Hoàng Nhã Quyên', '', 'ABC', '', '2024-12-13', 1180000, 0, 'Chuyển khoản', 787886666, 'Đang xử lý', NULL, NULL, 2, 1, 20000),
(106, 'Bé Liên', '', 'qưeqw', '', '2024-12-13', 1180000, 0, 'Chuyển khoản', 998377477, 'Đang xử lý', NULL, NULL, 2, 2, 20000),
(107, 'Tú Uyên', '', 'qưeqw', 'Ước gì có tiền nhiều', '2024-12-13', 280000, 0, 'Chuyển khoản', 236474777, 'Đang xử lý', NULL, NULL, 2, 2, 20000),
(108, 'Võ Hoàng Nhã Quyên', '', '2323323', '', '2024-12-13', 82769, 0, 'Chuyển khoản', 998377477, 'Đang xử lý', NULL, NULL, 2, 2, 20000),
(111, 'Võ Hoàng Nhã Quyên', '', 'ABC', 'Ship 10 tô phở ', '2024-12-13', 251198, 0, 'Chuyển khoản', 787886666, 'Đang xử lý', NULL, NULL, 2, 1, 20000),
(112, 'Võ Hoàng Nhã Quyên', '', 'qưeqw', '', '2024-12-13', 251198, 0, 'Chuyển khoản', 787886666, 'Đã hoàn tất', NULL, NULL, 2, 2, 20000),
(129, 'AAAAAA', '', 'AAAAAAA', 'AAAAAA', '2024-12-13', 0, 0, 'Chuyển khoản', 888888888, 'Đang xử lý', NULL, NULL, 2, 2, 20000),
(132, 'ÂS', '', 'ưerewrwer', 'ưerewr', '2024-12-13', 0, 0, 'Chuyển khoản', 723255555, 'Đang xử lý', NULL, NULL, 2, 1, 20000);

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
(6, 'be5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'khachhang', 6),
(10, 'minhthinh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nhanviennhantra', 10);

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
-- Đang đổ dữ liệu cho bảng `yeucau`
--

INSERT INTO `yeucau` (`maYC`, `tenYC`, `noiDung`, `ngayYC`, `maNhanVien`, `maloaiYC`, `trangThai`) VALUES
(1, 'Đổi sách', 'Yêu cầu đổi sách \"Công Nghệ Thông Tin\"', '2024-12-01', 26, '1', 'Duyệt'),
(2, 'Tư vấn sách', 'Tư vấn sách \"Học Tiếng Anh\"', '2024-12-02', 27, '3', 'Từ chối'),
(3, 'Kiểm tra tồn kho', 'Yêu cầu kiểm tra tồn kho sách \"Toán Học\"', '2024-12-03', 28, '2', 'Duyệt'),
(4, 'Báo cáo doanh thu', 'Tổng hợp doanh thu tháng 11', '2024-12-04', 29, '4', 'Từ chối'),
(5, 'Cập nhật thông tin', 'Cập nhật thông tin khách hàng', '2024-12-05', 30, '2', 'Duyệt'),
(6, 'Đổi sách lỗi', 'Sách \"Văn Học Việt Nam\" bị rách bìa', '2024-12-06', 31, '1', 'Từ chối'),
(7, 'Yêu cầu bổ sung sách mới', 'Bổ sung sách \"Khoa Học Tự Nhiên\"', '2024-12-07', 32, '2', 'Duyệt'),
(8, 'Báo cáo kho hàng', 'Tình trạng tồn kho của các sách bán chạy', '2024-12-08', 33, '4', 'Từ chối'),
(9, 'Hỗ trợ kỹ thuật', 'Hỗ trợ khách hàng về tài khoản mua sách', '2024-12-09', 34, '5', 'Duyệt'),
(10, 'Kiểm tra lịch sử giao dịch', 'Xem lại lịch sử giao dịch khách hàng', '2024-12-10', 35, '3', 'Từ chối');

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
  ADD KEY `maAnPham` (`maAnPham`),
  ADD KEY `fk_chitietPM_MaPhieuMuon` (`MaPhieuMuon`),
  ADD KEY `fk_chitietPM_maKM` (`MaKhuyenMai`);

--
-- Chỉ mục cho bảng `cthoadonnhap`
--
ALTER TABLE `cthoadonnhap`
  ADD PRIMARY KEY (`maCTHD`),
  ADD KEY `madauAP_2` (`madauAP`),
  ADD KEY `maHoaDon` (`maHoaDon`);

--
-- Chỉ mục cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_product` (`maNguoiDung`,`maAnPham`),
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
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_product` (`maNguoiDung`,`maAnPham`),
  ADD KEY `maAnPham` (`maAnPham`);

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
  ADD PRIMARY KEY (`MaKhuyenMai`);

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
  ADD KEY `fkmaKH` (`maKH`),
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
  MODIFY `maCTPM` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `hoadonnhapap`
--
ALTER TABLE `hoadonnhapap`
  MODIFY `MaHoaDon` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `maKH` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `MaKhuyenMai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `maNguoiDung` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `maNhanVien` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `phieumuon`
--
ALTER TABLE `phieumuon`
  MODIFY `MaPhieuMuon` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT cho bảng `phieutra`
--
ALTER TABLE `phieutra`
  MODIFY `MaPhieuTra` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `maTK` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `yeucau`
--
ALTER TABLE `yeucau`
  MODIFY `maYC` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- Các ràng buộc cho bảng `cthoadonnhap`
--
ALTER TABLE `cthoadonnhap`
  ADD CONSTRAINT `cthoadonnhap_ibfk_2` FOREIGN KEY (`madauAP`) REFERENCES `dauap` (`madauAP`),
  ADD CONSTRAINT `cthoadonnhap_ibfk_3` FOREIGN KEY (`maHoaDon`) REFERENCES `hoadonnhapap` (`MaHoaDon`);

--
-- Các ràng buộc cho bảng `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `danhgia_ibfk_1` FOREIGN KEY (`maNguoiDung`) REFERENCES `nguoidung` (`maNguoiDung`) ON DELETE CASCADE,
  ADD CONSTRAINT `danhgia_ibfk_2` FOREIGN KEY (`maAnPham`) REFERENCES `anpham` (`maAnPham`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `dauap`
--
ALTER TABLE `dauap`
  ADD CONSTRAINT `dauap_ibfk_1` FOREIGN KEY (`MaDanhMuc`) REFERENCES `danhmucap` (`MaDanhMuc`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`maNguoiDung`) REFERENCES `nguoidung` (`maNguoiDung`) ON DELETE CASCADE,
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`maAnPham`) REFERENCES `anpham` (`maAnPham`) ON DELETE CASCADE;

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
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `fk_nv` FOREIGN KEY (`maNguoiDung`) REFERENCES `nguoidung` (`maNguoiDung`);

--
-- Các ràng buộc cho bảng `phieumuon`
--
ALTER TABLE `phieumuon`
  ADD CONSTRAINT `MaKhuyenMai` FOREIGN KEY (`MaKhuyenMai`) REFERENCES `khuyenmai` (`MaKhuyenMai`) ON UPDATE CASCADE,
  ADD CONSTRAINT `maKH` FOREIGN KEY (`maKH`) REFERENCES `khachhang` (`maKH`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
