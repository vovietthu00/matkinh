-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 12, 2022 lúc 03:32 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `matkinh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_ID`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2021-01-22 20:14:10', '2021-02-03 19:24:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

CREATE TABLE `bills` (
  `bill_ID` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `discount_price` float DEFAULT NULL,
  `price_to_pay` float DEFAULT NULL,
  `payments` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_ID` int(11) NOT NULL,
  `promotion_ID` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bills`
--

INSERT INTO `bills` (`bill_ID`, `total_price`, `discount_price`, `price_to_pay`, `payments`, `phone_number`, `address`, `status`, `payment_status`, `customer_ID`, `promotion_ID`, `created_at`, `updated_at`) VALUES
(20, 5800000, 0, 5800000, 'cod', '0123456789', 'Cần Thơ', 'delivered', 'paid', 4, NULL, '2022-03-12 09:29:36', '2022-03-12 09:29:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_product`
--

CREATE TABLE `bill_product` (
  `bill_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bill_product`
--

INSERT INTO `bill_product` (`bill_ID`, `product_ID`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(16, 5, 1, 40000, '2021-02-22 13:54:02', '2021-02-22 13:54:02'),
(16, 4, 1, 40000, '2021-02-22 13:54:02', '2021-02-22 13:54:02'),
(17, 5, 1, 40000, '2021-02-22 14:04:46', '2021-02-22 14:04:46'),
(17, 2, 1, 35000, '2021-02-22 14:04:46', '2021-02-22 14:04:46'),
(17, 1, 1, 35000, '2021-02-22 14:04:46', '2021-02-22 14:04:46'),
(17, 6, 5, 40000, '2021-02-22 14:04:46', '2021-02-22 14:04:46'),
(18, 2, 2, 35000, '2021-02-22 14:09:53', '2021-02-22 14:09:53'),
(18, 1, 1, 35000, '2021-02-22 14:09:53', '2021-02-22 14:09:53'),
(19, 6, 1, 40000, '2021-02-22 15:36:32', '2021-02-22 15:36:32'),
(19, 4, 4, 40000, '2021-02-22 15:36:32', '2021-02-22 15:36:32'),
(19, 5, 1, 40000, '2021-02-22 15:36:32', '2021-02-22 15:36:32'),
(19, 1, 1, 35000, '2021-02-22 15:36:32', '2021-02-22 15:36:32'),
(20, 9, 1, 5800000, '2022-03-12 09:29:36', '2022-03-12 09:29:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_ID` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_ID`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mắt kính cận', 1, '2021-02-21 14:21:56', '2022-03-12 08:50:50'),
(2, 'Mắt kính mát', 1, '2021-02-21 14:22:04', '2022-03-12 08:51:07'),
(3, 'Mắt kính thời trang', 1, '2021-02-21 14:23:31', '2022-03-12 08:51:17'),
(4, 'Mắt kính trendy', 1, '2021-02-21 14:23:40', '2022-03-12 08:51:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `customer_ID` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`customer_ID`, `username`, `password`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Anh', '827ccb0eea8a706c4c34a16891f84e7b', 'Anh', 'Nguyen', 'anh@gmail.com', '0123456789', 'Cần Thơ', 1, '2022-03-12 09:26:23', '2022-03-12 09:29:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_ID` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `short_des` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_content_title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float NOT NULL,
  `status` int(11) NOT NULL,
  `category_ID` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_ID`, `name`, `image`, `short_des`, `des_content_title`, `des_content`, `price`, `status`, `category_ID`, `created_at`, `updated_at`) VALUES
(7, 'Kính Mát Gentle Monster Crella Y1 Màu Vàng', 'Kinh-Mat-Gentle-Monster-Crella-Y1-Mau-Vang.jpg', 'Kính Mát Gentle Monster Crella Y1 Màu Vàng là chiếc kính mắt thời trang cao cấp, sản phẩm đến từ thương hiệu Gentle Monster nổi tiếng của Hàn Quốc. Gentle Monster Crella Y1 bảo vệ mắt cực kỳ ưu việt với hình dạng chữ nhật hiện đại, thời trang.', 'Đặc điểm Kính Mát Gentle Monster Crella Y1 Màu Vàng', 'Kính Mát Gentle Monster Crella Y1 Màu Vàng được thiết kế với kiểu dáng hiện đại, trẻ trung. Form dáng kính thời trang, hợp xu hướng. Kính được làm từ chất liệu cao cấp, có khả năng hỗ trợ bảo vệ mắt ưu việt.\r\n\r\nThiết kế cổ điển có kích thước hoàn hảo này được làm nổi bật bởi các cạnh bo tròn của mặt trước khung và đường viền đền có biểu tượng Gentle Monster.', 5900000, 1, 2, '2022-03-12 09:16:52', '2022-03-12 09:16:52'),
(8, 'Kính Mát Gentle Monster Linda 01 Màu Đen', 'Kinh-Mat-Gentle-Monster-Linda-01-Mau-Den.jpg', 'Kính Mát Gentle Monster Linda 01 Màu Đen sản phẩm kính mắt cao cấp dành cho cả nam và nữ đến từ thương hiệu Gentle Monster nổi tiếng của Hàn Quốc. Gentle Monster Linda 01 sở hữu gam màu đen nổi bật hỗ trợ bảo vệ mắt ưu việt.', 'Đặc điểm nổi bật của Kính Mát Gentle Monster Linda 01', 'Kính Mát Gentle Monster Linda 01 được thiết kế hiện đại, trẻ trung có kích thước hoàn hảo. Form dáng kính thời trang, hợp xu hướng. Kính được làm từ chất liệu cao cấp, có khả năng hỗ trợ làm giảm tia UV chiếu vào mắt, bảo vệ mắt rất ưu việt. Gọng kính làm bằng chất liệu nhựa acetate cao cấp bền đẹp trong suốt quá trình sử dụng.', 6900000, 1, 4, '2022-03-12 09:18:46', '2022-03-12 09:18:46'),
(9, 'Kính Mắt Cận Gentle Monster Alio C1', 'Kinh-Mat-Can-Gentle-Monster-Alio-C1.jpg', 'Kính Mắt Cận Gentle Monster Alio C1 sản phẩm kính mắt cao cấp, bảo vệ ưu việt đến từ thương hiệu Gentle Monster nổi tiếng của Hàn Quốc. Qua mỗi bộ sưu tập, hãng kính Hàn Quốc đã từng bước tạo nên sự đẳng cấp thương hiệu của mình với những thiết kế hiện đại được yêu thích và ưa chuộng đông đảo từ nhiều lứa tuổi khác nhau.', 'Điểm nổi bật kính mắt cận Gentle Monster Alio C1', 'Kính được thiết kế hiện đại, trẻ trung phù hợp với nhiều khách hàng. Form dáng thời trang, hợp xu hướng, gọng kính làm bằng chất liệu cao cấp bền đẹp trong suốt quá trình sử dụng. \r\nĐa phần các sản phẩm của Gentle Monster đều nổi tiếng nhờ vẻ ngoài tinh tế và hiện đại. Luôn cập nhật mẫu mới, phong phú, phù hợp với nhiều đối tượng khác nhau.', 5800000, 1, 1, '2022-03-12 09:20:37', '2022-03-12 09:20:37'),
(10, 'Kính Mát Unisex Gentle Monster MA MARS 01 Màu Đen', 'Kinh-Mat-Unisex-Gentle-Monster-MA-MARS-01-Mau-Den.jpg', 'Kính Mát Unisex Gentle Monster MA MARS 01 sản phẩm đến từ thương hiệu Gentle Monster nổi tiếng của Hàn Quốc. Với thiết kế trẻ trung KínhGentle Monster MA MARS 01 đang là item HOT trên thị trường hiện nay.', 'Đặc điểm nổi bật của Kính Gentle Monster MA MARS 01', 'Thiết kế kính hiện đại, trẻ trung. Form dáng thời trang, hợp xu hướng. Kính hỗ trợ giảm bụi, hỗ trợ làm giảm chói do ánh nắng chiếu vào mắt, đồng thời hỗ trợ làm giảm tác hại tia UV (cực tím). Gọng kính làm bằng chất liệu nhựa cao cấp.', 5600000, 1, 2, '2022-03-12 09:21:47', '2022-03-12 09:21:47'),
(11, 'Kính Thời Trang Gentle Monster Heron Preston - Level 0 C1', 'Kính-Thòi-Trang-Gentle-Monster-Heron-Preston---Level-0-C1.jpg', 'Kính Thời Trang Gentle Monster Heron Preston - Level 0 C1 là chiếc kính mắt thời trang cao cấp, sản phẩm đến từ thương hiệu Gentle Monster nổi tiếng của Hàn Quốc. Gentle Monster Heron Preston - Level 0 C1 bảo vệ mắt cực kỳ ưu việt vừa mang tính thời trang.', 'Đặc điểm Kính Gentle Monster Heron Preston - Level 0 C1', 'Gentle Monster Heron Preston - Level 0 C1 được thiết kế với kiểu dáng hiện đại, trẻ trung. Form dáng kính thời trang, hợp xu hướng. Kính được làm từ chất liệu cao cấp, có khả năng hỗ trợ bảo vệ mắt ưu việt.\r\n\r\nGọng kính kim loại và nhựa với tròng kính có màu trắng sang trọng, tinh tế. Thiết kế cổ điển có kích thước hoàn hảo này được làm nổi bật bởi các cạnh bo tròn của mặt trước khung và đường viền đền có biểu tượng Gentle Monster.', 8800000, 1, 3, '2022-03-12 09:23:10', '2022-03-12 09:23:10'),
(12, 'Kính Mát Gentle Monster Ambush - Carabiner 2 BLC2 Màu Xanh Blue', 'Kinh-Mat-Gentle-Monster-Ambush---Carabiner-2-BLC2-Mau-Xanh-Blue.jpg', 'Kính Mát Gentle Monster Ambush - Carabiner 2 BLC2 Màu Xanh Blue là chiếc kính mắt thời trang cao cấp, sản phẩm đến từ thương hiệu Gentle Monster nổi tiếng của Hàn Quốc. Gentle Monster Ambush - Carabiner 2 bảo vệ mắt cực kỳ ưu việt vừa mang tính thời trang.', 'Đặc điểm Kính Mát Gentle Monster Ambush - Carabiner 2 BLC2', 'Kính Mát Gentle Monster Ambush - Carabiner 2 BLC2 được thiết kế với kiểu dáng hiện đại, trẻ trung. Form dáng kính thời trang, hợp xu hướng. Kính được làm từ chất liệu cao cấp, có khả năng hỗ trợ bảo vệ mắt ưu việt.\r\n\r\nCarabiner 2 BLC2 là một khung acetate vuông màu xanh lam được tạo ra với sự hợp tác của Ambush. Những chiếc kính râm này có mặt trước táo bạo với tròng kính màu xanh lam được chống tia cực tím 99,9% cùng với các ngôi đền lớn có chi tiết hình chữ D trên mỗi ngôi đền để làm nổi bật sự độc đáo và đặc trưng của cả hai thương hiệu.\r\n\r\nGọng kính kim loại và nhựa với tròng kính chuyển màu xanh blue được bảo vệ 100% khỏi tia cực tím. Thiết kế cổ điển có kích thước hoàn hảo này được làm nổi bật bởi các cạnh bo tròn của mặt trước khung và đường viền đền có biểu tượng Gentle Monster.', 8000000, 1, 3, '2022-03-12 09:24:18', '2022-03-12 09:24:18'),
(13, 'Kính Mắt Gentle Monster South Side N 01 Màu Đen', 'Kinh-Mat-Gentle-Monster-South-Side-N-01-Mau-Den.jpg', 'Kính Mắt Gentle Monster South Side N 01 Màu Đen là chiếc kính mắt thời trang cao cấp, đến từ thương hiệu Gentle Monster nổi tiếng của Hàn Quốc. Gentle Monster South Side N 01 bảo vệ mắt cực kỳ ưu việt rất được yêu thích trên thị trường hiện nay.', 'Mô tả Kính Mắt Gentle Monster South Side N 01 Màu Đen', 'Kính Mắt Gentle Monster South Side N 01 Màu Đen được thiết kế với kiểu dáng hiện đại, trẻ trung. Form dáng kính thời trang, hợp xu hướng. Kính được làm từ chất liệu cao cấp, có khả năng hỗ trợ bảo vệ mắt ưu việt.\r\n\r\nChiếc kính có kích thước hoàn hảo này được làm nổi bật bởi các cạnh bo tròn của mặt trước khung và phần chiều dài gọng có biểu tượng Gentle Monster rất tinh tế.', 5800000, 1, 1, '2022-03-12 09:25:40', '2022-03-12 09:25:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotions`
--

CREATE TABLE `promotions` (
  `promotion_ID` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `promotion_type` varchar(255) NOT NULL,
  `discount` int(11) NOT NULL,
  `condition_discount` float NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `promotions`
--

INSERT INTO `promotions` (`promotion_ID`, `name`, `start_date`, `end_date`, `detail`, `promotion_type`, `discount`, `condition_discount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Covid19', '2021-02-22', '2021-03-22', 'Giảm 20% cho hóa đơn từ 200,000đ', 'percent', 20, 200000, 1, '2021-02-22 11:27:17', '2021-02-22 11:28:34'),
(2, 'Spring21', '2021-02-01', '2021-04-01', 'Giảm 40,000đ cho hóa đơn từ 400,000đ', 'price', 40000, 400000, 1, '2021-02-22 11:30:02', '2021-02-22 11:30:02'),
(3, 'Summer21', '2021-02-01', '2021-08-01', 'Giảm 10% cho hóa đơn từ 100,000đ', 'percent', 10, 100000, 1, '2021-02-22 11:31:04', '2021-02-22 13:10:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staff`
--

CREATE TABLE `staff` (
  `staff_ID` int(11) NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ID_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_ID`),
  ADD KEY `customer_ID` (`customer_ID`),
  ADD KEY `promotion_ID` (`promotion_ID`);

--
-- Chỉ mục cho bảng `bill_product`
--
ALTER TABLE `bill_product`
  ADD KEY `bill_ID` (`bill_ID`),
  ADD KEY `product_ID` (`product_ID`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_ID`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_ID`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_ID`),
  ADD KEY `category_ID` (`category_ID`);

--
-- Chỉ mục cho bảng `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promotion_ID`);

--
-- Chỉ mục cho bảng `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `promotions`
--
ALTER TABLE `promotions`
  MODIFY `promotion_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`customer_ID`) REFERENCES `customers` (`customer_ID`),
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`promotion_ID`) REFERENCES `promotions` (`promotion_ID`);

--
-- Các ràng buộc cho bảng `bill_product`
--
ALTER TABLE `bill_product`
  ADD CONSTRAINT `bill_product_ibfk_1` FOREIGN KEY (`bill_ID`) REFERENCES `bills` (`bill_ID`),
  ADD CONSTRAINT `bill_product_ibfk_2` FOREIGN KEY (`product_ID`) REFERENCES `products` (`product_ID`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_ID`) REFERENCES `categories` (`category_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
