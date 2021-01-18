-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 05, 2021 lúc 06:50 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mrquoc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `catalog`
--

CREATE TABLE `catalog` (
  `ID_Catalog` int(11) NOT NULL,
  `Name_Catalog` varchar(145) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `catalog`
--

INSERT INTO `catalog` (`ID_Catalog`, `Name_Catalog`) VALUES
(1, 'Giày Nam Cao Cấp'),
(2, 'Giày Nữ'),
(3, 'Áo Cao Cổ'),
(4, 'Áo Dạ Hội'),
(5, 'Giày Thể Thao'),
(6, 'Áo Dài'),
(14, 'Giày Sneaker');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `ID_Comment` int(11) NOT NULL,
  `ID_Product` int(11) NOT NULL,
  `ID_User` varchar(70) NOT NULL,
  `Comment` text NOT NULL,
  `Date_Comment` date NOT NULL DEFAULT current_timestamp(),
  `Admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `ID_Order` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `Address_User` varchar(255) NOT NULL,
  `Phone_User` varchar(255) NOT NULL,
  `Status_Order` varchar(255) NOT NULL,
  `Date_Order` varchar(255) NOT NULL,
  `Date_De` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`ID_Order`, `ID_User`, `Address_User`, `Phone_User`, `Status_Order`, `Date_Order`, `Date_De`) VALUES
(78, 1, 'Nam Kỳ Khởi Nghĩa', '0332148505', 'Giao Thành Công', '14:39:42 16/12/2020', '11:17:25 2020/12/16'),
(79, 1, 'Nam Kỳ Khởi Nghĩa2', '0332148505', 'Chưa Giải Quyết', '14:40:44 16/12/2020', ''),
(80, 1, '869  Vesta Drive', '5595297976', 'Chưa Giải Quyết', '14:42:19 16/12/2020', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE `orderdetail` (
  `ID_OrderDetail` int(11) NOT NULL,
  `ID_Order` int(11) NOT NULL,
  `ID_Product` int(11) NOT NULL,
  `Quanlity_Order` int(11) NOT NULL,
  `Price_Order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail` (`ID_OrderDetail`, `ID_Order`, `ID_Product`, `Quanlity_Order`, `Price_Order`) VALUES
(1, 75, 1, 2, 30000),
(2, 76, 1, 1, 15000),
(3, 77, 1, 10, 150000),
(4, 78, 1, 1, 15000),
(5, 79, 1, 100, 1500000),
(6, 80, 1, 1, 15000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `ID_Product` int(11) NOT NULL,
  `Name_Product` varchar(145) NOT NULL,
  `ID_Catalog` int(11) NOT NULL,
  `Brand_Product` varchar(45) DEFAULT NULL,
  `Price_Product` int(11) DEFAULT NULL,
  `Des_Product` varchar(2000) DEFAULT NULL,
  `Image_Product` varchar(100) DEFAULT NULL,
  `Title_Product` varchar(45) DEFAULT NULL,
  `Keywords_Product` varchar(500) DEFAULT NULL,
  `Des_Page` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`ID_Product`, `Name_Product`, `ID_Catalog`, `Brand_Product`, `Price_Product`, `Des_Product`, `Image_Product`, `Title_Product`, `Keywords_Product`, `Des_Page`) VALUES
(1, 'Giày Hata', 1, 'Hata', 15, ' Giày Thể Thao Nữ D97 màu đen giày chạy bộ nữ giày ulzzang nữ giày thời trang nữ giày đế bằng nữ giày tập gym', 's-product-1.png', 'Giày Hata', NULL, NULL),
(92, 'Giày Cao Cổ', 2, 'Lào Cai', 33, '<p><em>Đ&acirc;y l&agrave; m&ocirc; tả</em></p>', '', 'Sản phẩm a', '342', '324');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `recomment`
--

CREATE TABLE `recomment` (
  `ID_ReComment` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `ID_Comment` int(11) NOT NULL,
  `ReComment` text NOT NULL,
  `Date_ReComment` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `ID_User` int(11) NOT NULL,
  `Email_User` varchar(100) NOT NULL,
  `Password_User` varchar(45) NOT NULL,
  `Image_User` varchar(77) NOT NULL,
  `Date_Join_User` datetime NOT NULL DEFAULT current_timestamp(),
  `Name_User` varchar(45) DEFAULT NULL,
  `Phone_User` varchar(12) NOT NULL,
  `Address_User` varchar(5000) NOT NULL,
  `Position` varchar(45) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID_User`, `Email_User`, `Password_User`, `Image_User`, `Date_Join_User`, `Name_User`, `Phone_User`, `Address_User`, `Position`) VALUES
(1, 'Admin@gmail.com', 'Admin@gmail.com', '', '2020-12-16 08:12:07', 'Đăng Quốc', '20000212', 'Việt Nam', '2');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`ID_Catalog`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID_Comment`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`ID_Order`);

--
-- Chỉ mục cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`ID_OrderDetail`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID_Product`);

--
-- Chỉ mục cho bảng `recomment`
--
ALTER TABLE `recomment`
  ADD PRIMARY KEY (`ID_ReComment`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_User`,`Email_User`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `catalog`
--
ALTER TABLE `catalog`
  MODIFY `ID_Catalog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `ID_Comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `ID_Order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `ID_OrderDetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `ID_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT cho bảng `recomment`
--
ALTER TABLE `recomment`
  MODIFY `ID_ReComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `ID_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
