-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 07:42 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `AdminUserName` varchar(255) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL,
  `AdminEmailId` varchar(255) NOT NULL,
  `Is_Active` int(11) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `AdminUserName`, `AdminPassword`, `AdminEmailId`, `Is_Active`, `CreationDate`, `UpdationDate`) VALUES
(1, 'admin', 'viveka2004', 'viveka@gmail.com', 1, '2020-03-27 17:51:00', '2020-04-24 18:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(2, 'Bollywood', 'Bollywood News', '2018-06-06 10:28:09', '2018-06-30 18:41:07', 1),
(3, 'Sports', 'Related to sports news', '2018-06-06 10:35:09', '2018-06-14 11:11:55', 1),
(5, 'Entertainment', 'Entertainment related  News', '2018-06-14 05:32:58', '2018-06-14 05:33:41', 1),
(6, 'Politics', 'Politics', '2018-06-22 15:46:09', '0000-00-00 00:00:00', 1),
(7, 'Business', 'Business', '2018-06-22 15:46:22', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `id` int(11) NOT NULL,
  `postId` char(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcomments`
--

INSERT INTO `tblcomments` (`id`, `postId`, `name`, `email`, `comment`, `postingDate`, `status`) VALUES
(1, '12', 'Anuj', 'anuj@gmail.com', 'Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.', '2018-11-21 11:06:22', 0),
(2, '12', 'Test user', 'test@gmail.com', 'This is sample text for testing.', '2018-11-21 11:25:56', 1),
(3, '7', 'ABC', 'abc@test.com', 'This is sample text for testing.', '2018-11-21 11:27:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `PageTitle`, `Description`, `PostingDate`, `UpdationDate`) VALUES
(1, 'aboutus', 'About News Portal', '<font color=\"#7b8898\" face=\"Mercury SSm A, Mercury SSm B, Georgia, Times, Times New Roman, Microsoft YaHei New, Microsoft Yahei, å¾®è½¯é›…é»‘, å®‹ä½“, SimSun, STXihei, åŽæ–‡ç»†é»‘, serif\"><span style=\"font-size: 26px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></font><br>', '2018-06-30 18:01:03', '2018-06-30 19:19:51'),
(2, 'contactus', 'Contact Details', '<p><br></p><p><b>Address :&nbsp; </b>New Delhi India</p><p><b>Phone Number : </b>+91 -01234567890</p><p><b>Email -id : </b>phpgurukulofficial@gmail.com</p>', '2018-06-30 18:01:36', '2018-06-30 19:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 DEFAULT NULL,
  `Price` int(10) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`PostTitle`, `CategoryId`, `SubCategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`) VALUES
('Bike Cover', 9, 1, 'Details about bike accessories', NOW(), NOW(), 1, 'Bike-Accessories', 'bike_accessories.jpg'),
--('Charger_1_2', 1, 2, 'Details about Charger 1 2', NOW(), NOW(), 1, 'Charger-1-2', 'charger_1_2.jpg'),
--('Charger_1', 1, 2, 'Details about Charger 1', NOW(), NOW(), 1, 'Charger-1', 'charger_1.jpg'),
('Computer and Accessories', 1, 3, 'Details about computer and accessories', NOW(), NOW(), 1, 'Computer-and-Accessories', 'computer_and_accessories.jpg'),
('Dresses', 3, 4, 'Details about dresses', NOW(), NOW(), 1, 'Dresses', 'dresses.jpg'),
('Exercise Equipments', 6, 5, 'Details about exercise equipments', NOW(), NOW(), 1, 'Exercise-Equipments', 'exercise_equipments.jpg'),
('Fiction Books', 7, 6, 'Details about fiction books', NOW(), NOW(), 1, 'Fiction-Books', 'fiction_books.jpg'),
('Formal_Wear', 2, 7, 'Details about formal wear', NOW(), NOW(), 1, 'Formal-Wear', 'formal_wear.jpg'),
--('Furnitures', 7, 8, 'Details about furnitures', NOW(), NOW(), 1, 'Furnitures', 'furnitures.jpg'),
('Grooming', 5, 9, 'Details about grooming', NOW(), NOW(), 1, 'Grooming', 'grooming.jpg'),
('Headset_1', 1, 10, 'Details about headset 1', NOW(), NOW(), 1, 'Headset-1', 'headset1.jpg'),
('Home_Decor', 4, 11, 'Details about home decor', NOW(), NOW(), 1, 'Home-Decor', 'home_decor.jpg'),
('Home_Development', 4, 12, 'Details about home development', NOW(), NOW(), 1, 'Home-Development', 'home_development.jpg'),
('Home_Theater 1', 1, 13, 'Details about home theater 1', NOW(), NOW(), 1, 'Home-Theater-1', 'home_theater_1.jpg'),
('Home_Theater 2', 1, 13, 'Details about home theater 2', NOW(), NOW(), 1, 'Home-Theater-2', 'home_theater_2.jpg'),
('Indoor_Games', 6, 14, 'Details about indoor games', NOW(), NOW(), 1, 'Indoor-Games', 'indoor_games.jpg'),
('Jeans', 2, 15, 'Details about jeans', NOW(), NOW(), 1, 'Jeans', 'jeans.jpg'),
('Keyboard_1', 1, 16, 'Details about keyboard 1', NOW(), NOW(), 1, 'Keyboard-1', 'keyboard_1.jpg'),
('Kitchen_Appliances', 4, 17, 'Details about kitchen appliances', NOW(), NOW(), 1, 'Kitchen-Appliances', 'kitchen_appliances.jpg'),
('Kurtis', 3, 18, 'Details about kurtis', NOW(), NOW(), 1, 'Kurtis', 'kurtis.jpg'),
('Makeup', 5, 19, 'Details about makeup', NOW(), NOW(), 1, 'Makeup', 'makeup.jpg'),
('Mirrorless_1', 1, 20, 'Details about mirrorless 1', NOW(), NOW(), 1, 'Mirrorless-1', 'mirrorless_1.jpg'),
('Mobile_1_2', 1, 21, 'Details about mobile 1 2', NOW(), NOW(), 1, 'Mobile-1-2', 'mobile_1_2.jpg'),
('Mobile_and_Accessories', 1, 22, 'Details about mobile and accessories', NOW(), NOW(), 1, 'Mobile-and-Accessories', 'mobile_and_accessories.jpg'),
('Mobile_1', 1, 23, 'Details about mobile 1', NOW(), NOW(), 1, 'Mobile-1', 'mobile_1.jpg'),
('Mouse_1', 1, 24, 'Details about mouse 1', NOW(), NOW(), 1, 'Mouse-1', 'mouse_1.jpg'),
('Outdoor_Sports', 6, 25, 'Details about outdoor sports', NOW(), NOW(), 1, 'Outdoor-Sports', 'outdoor_sports.jpg'),
('Pet_Grooming', 10, 26, 'Details about pet grooming', NOW(), NOW(), 1, 'Pet-Grooming', 'pet_grooming.jpg'),
('Sarees', 3, 27, 'Details about sarees', NOW(), NOW(), 1, 'Sarees', 'sarees.jpg'),
('Shirts', 2, 28, 'Details about shirts', NOW(), NOW(), 1, 'Shirts', 'shirts.jpg'),
('Skin_and_Hair_Care', 5, 29, 'Details about skin and hair care', NOW(), NOW(), 1, 'Skin-and-Hair-Care', 'skin_and_hair_care.jpg'),
('Speaker_1_2', 1, 30, 'Details about speaker 1 2', NOW(), NOW(), 1, 'Speaker-1-2', 'speaker_1_2.jpg'),
('Speaker_1', 1, 31, 'Details about speaker 1', NOW(), NOW(), 1, 'Speaker-1', 'speaker_1.jpg'),
('T-Shirt_Men', 2, 32, 'Details about T-Shirt Men', NOW(), NOW(), 1, 'T-Shirt-Men', 't_shirt_men.jpg'),
('TV', 1, 33, 'Details about TV', NOW(), NOW(), 1, 'TV', 'tv.jpg'),
('Western_Dresses', 3, 34, 'Details about western dresses', NOW(), NOW(), 1, 'Western-Dresses', 'western_dresses.jpg'),
('No_Fiction', 7, 35, 'Details about non-fiction books', NOW(), NOW(), 1, 'No-Fiction', 'no_fiction.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubcategory`
--

CREATE TABLE `tblsubcategory` (
  `SubCategoryId` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) DEFAULT NULL,
  `SubCatDescription` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`SubCategoryId`, `CategoryId`, `Subcategory`, `SubCatDescription`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(3, 5, 'Bollywood ', 'Bollywood masala', '2018-06-22 15:45:38', '0000-00-00 00:00:00', 1),
(4, 3, 'Cricket', 'Cricket\r\n\r\n', '2018-06-30 09:00:43', '0000-00-00 00:00:00', 1),
(5, 3, 'Football', 'Football', '2018-06-30 09:00:58', '0000-00-00 00:00:00', 1),
(6, 5, 'Television', 'TeleVision', '2018-06-30 18:59:22', '0000-00-00 00:00:00', 1),
(7, 6, 'National', 'National', '2018-06-30 19:04:29', '0000-00-00 00:00:00', 1),
(8, 6, 'International', 'International', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(9, 7, 'India', 'India', '2018-06-30 19:08:42', '0000-00-00 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD PRIMARY KEY (`SubCategoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `SubCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `tblsubcategory` (
 `SubCategoryId` int(11) NOT NULL,
 `CategoryId` int(11) DEFAULT NULL,
 `Subcategory` varchar(255) DEFAULT NULL,
 `SubCatDescription` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`SubCategoryId`, `CategoryId`, `Subcategory`, `SubCatDescription`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(1, 2, 'T-shirts ', 'T-shirts', '2018-06-22 15:45:38', '0000-00-00 00:00:00', 1),
(2, 2, 'Shirts', 'Shirts', '2018-06-30 09:00:43', '0000-00-00 00:00:00', 1),
(3, 2, 'Jeans', 'Jeans', '2018-06-30 09:00:58', '0000-00-00 00:00:00', 1),
(4, 2, 'Formal Wear', 'Formal Wear', '2018-06-30 18:59:22', '0000-00-00 00:00:00', 1),
(5, 3, 'Dresses', 'Dresses', '2018-06-30 19:04:29', '0000-00-00 00:00:00', 1),
(6, 3, 'Kurtis', 'Kurtis', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(7, 3, 'Sarees', 'Sarees', '2018-06-30 19:08:42', '0000-00-00 00:00:00', 1),
(8, 3, 'Western Dresses', 'Western Dresses', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(9, 4, 'Furnitures', 'Furnitures', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(10, 4, 'Kitchen Appliances', 'Kitchen Appliances', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(11, 4, 'Home Decor', 'Home Decor', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(12, 4, 'Home Improvement', 'LED bulbs and TVs', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(13, 5, 'Makeup', 'Makeup', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(14, 5, 'Skin and Hair Care', 'Skin and Hair Care', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(15, 5, 'Grooming', 'Grooming', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(16, 1, 'Mobiles and Accessories', 'Mobiles and Accessories', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(17, 1, 'Computers and Laptops', 'Computers and Laptops', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(18, 1, 'Audio and Accessories', 'Audio and Accessories', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(19, 1, 'Camera and Accessories', 'Camera and Accessories', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(20, 10, 'Pet Grooming', 'Pet Grooming', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(21, 6, 'Exercise Equipments', 'Exercise Equipments', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(22, 6, 'Outdoor Sports', 'Outdoor Sports', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(23, 6, 'Indoor Games', 'Indoor Games', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(24, 9, 'Bike Accessories', 'Bike Accessories', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(25, 7, 'Fiction and Non-Fiction', 'Fiction and Non-Fiction', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(26, 7, 'Academic Books', 'Academic Books', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(27, 7, 'Office Supplies', 'Office Supplies', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(28, 10, 'Pet Foods', 'Pet Foods', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(29, 8, 'Baby Care', 'Baby Care', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(30, 8, 'Toys and Games', 'Toys and Games', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(31, 8, 'School Supplies', 'School Supplies', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(32, 9, 'Car Accessories', 'Car Accessories', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1);

--