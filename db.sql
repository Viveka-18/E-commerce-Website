-- Create the database
CREATE DATABASE mydatabase;
USE mydatabase;

-- Create the users table
CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
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
(1, 'admin', '$2y$12$i4LMfeFPQpGSNPTaccIkKuwxAkJ4PhBr3JND7FpXwWFjRvchQn17C', 'viveka@gmail.com', 1, '2020-03-27 17:51:00', '2020-04-24 18:21:07');

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
(1, 'Electronics', 'Electronics items', '2025-02-22 10:28:09', '2025-02-22 18:41:07', 1),
(2, 'Mens Fashion', 'for mens fashion', '2025-02-22 10:35:09', '2025-02-22 11:11:55', 1),
(3, 'Women Fashion', 'for women fashion', '2025-02-22 05:32:58', '2025-02-22 05:33:41', 1),
(4, 'Home and Kitchen', 'home applicances', '2025-02-22 15:46:09', '0000-00-00 00:00:00', 1),
(5, 'Beauty Items', 'beauty items', '2025-02-22 15:46:22', '0000-00-00 00:00:00', 1),
(6, 'Sports and Fitness', 'sports items', '2025-02-22 10:28:09', '2025-02-22 18:41:07', 1),
(7, 'Books and Stationery', 'books', '2025-02-22 10:28:09', '2025-02-22 18:41:07', 1),
(8, 'Baby and Kids', 'toys', '2025-02-22 10:28:09', '2025-02-22 18:41:07', 1),
(9, 'Automotives', 'automotives', '2025-02-22 10:28:09', '2025-02-22 18:41:07', 1),
(10, 'Pets supplies', 'pets necessaries', '2025-02-22 10:28:09', '2025-02-22 18:41:07', 1);
-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `orders` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` varchar(20),
    `address` TEXT NOT NULL,
    `pincode` VARCHAR(6) NOT NULL,
    `phone` VARCHAR(10) NOT NULL,
    `alt_phone` VARCHAR(10),
    `status` ENUM('Order Confirmed', 'Shipped', 'Delivered') DEFAULT 'Order Confirmed',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE `order_items` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL DEFAULT 1,
    `price` DECIMAL(10,2) NOT NULL,
    `total_price` DECIMAL(10,2) GENERATED ALWAYS AS (quantity * price) STORED,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES tblposts(id) ON DELETE CASCADE
);

--
-- Table structure for table `tblposts`
--

CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` varchar(255) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `PostDetails` text NOT NULL,
  `PostDetails1`text NOT NULL,
  `PostUrl` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
   `Is_Active` int(1) DEFAULT NULL,
    `PostImage` varchar(255) NOT NULL,
    `PostImage1` varchar(255) NOT NULL,
    `PostImage2` varchar(255) NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()

) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO tblposts (PostTitle, PostDetails, PostDetails1, CategoryId, PostUrl, PostImage,PostImage1,PostImage2, Price)
VALUES
('ASUS Vivobook', 'ASUS Vivobook 15 Thin and Light Laptop, Intel Core i5-12500H 12Th Gen, 15.6', 
 'ASUS Vivobook 15 Thin and Light Laptop, Intel Core i5-12500H 12Th Gen, 15.6" (39.62 Cm) FHD, 60Hz (16GB RAM/512GB/Windows 11/Office 2021/Blue/1.7 Kg), X1502ZA-EJ541WS', 
 1, 'asus-vivobook', 'asus.jpg','asus2.jpg','asus3.jpg', 53990),

('ZEBRONICS Juke BAR 9900', 'ZEBRONICS Juke BAR 9900, 725 Watts, Karaoke UHF Mic, Dolby Atmos, DTS X, 7.2.2 (5.2.4)', 
 'Brand: ZEBRONICS, Speaker Maximum Output Power: 725 Watts, Connectivity: Auxiliary, Audio Output Mode: Surround, Mounting Type: Wall Mount', 
 1, 'zebronics-juke-bar-9900', 'zebronics1.jpg','zebronics2.jpg','zebronics3.jpg', 26999),

('Lymio Men Cargo', 'Lymio Men Cargo, Men Cargo Pants, Men Cargo Pants Cotton, Cargos for Men (Cargo-09-12)', 
 'Material: Cotton, Length: Long, Style: Cargo, Closure: Drawstring, Occasion: Casual, Care: Machine Wash, Origin: India', 
 2, 'lymio-men-cargo', 'lymio1.jpg','lymio2.jpg','lymio3.jpg', 699),

('FINIVO FASHION Textured Shirts', 'FINIVO FASHION Textured Shirts for Men || Casual Shirt for Men || Shirt for Men', 
 'Material: Popcorn, Pattern: Solid, Fit: Regular Fit, Sleeve: Long Sleeve, Collar: Spread Collar, Length: Standard, Origin: India', 
 2, 'finivo-fashion-textured-shirts', 'finivo1.jpg','finivo2.jpg','finivo3.jpg', 499),

('Sun Fashion And Women Lifestyle', 'Sun Fashion Lifestyle Women Chanderi Stitched Printed Kurti for Girls Kurta', 
 'Material: Chanderi Blend, Sleeve: Puff Sleeve, Length: Calf Length, Pattern: Floral, Style: Regular, Care: Machine Wash, Origin: India', 
 3, 'sun-fashion-and-women-lifestyle', 'sunfashion1.jpg','sunfashion2.jpg','sunfashion3.jpg', 499),

('Leriya Fashion Women Dress', 'Leriya Fashion Women Dress | One Piece Dress for Women | Dresses for Women | Dress for Women Stylish', 
 'Material: Rayon, Length: Below the Knee, Occasion: New Year, Anniversary, Honeymoon, Birthday, Valentine Day, Sleeve: Long, Style: Fit And Flare, Neck: Round Neck', 
 3, 'leriya-fashion-women-dress', 'leriya1.jpg','leriay2.jpg','leriya3.jpg', 418),

('Pigeon by Stovekraft Mio Nonstick Items', 'Pigeon by Stovekraft Mio Nonstick Aluminium Cookware Gift Set, Includes...', 
 'Nonstick Flat Tawa, Nonstick Fry Pan, Kitchen Tool Set, Kadai with Glass Lid, 8 Pieces Non-Induction Base Kitchen Set - Red', 
 4, 'pigeon-by-stovekraft-mio-nanstick-items', 'kitchen1.jpg','kitchen2.jpg','kitchen3.jpg', 949),

('MILTON Casserole Set', 'MILTON Ernesto Inner Stainless Steel Casserole Set of 3 (420 ml, 850 ml, 1.43 litres), Red', 
 'Color: Red, Material: Inner Stainless Steel; Package Contents: 3 - Pieces Ernesto Jr. Casserole Set(420 ml, 850 ml, 1.43 Litres)', 
 4, 'milto-casserole-set', 'milton1.jpg','milton2.jpg','milton3.jpg', 949),

('LAKME 9 to 5 CC Cream Mini', '01-Beige|| Light Face Makeup With Natural Coverage For All Skin', 
 'Spf 30-Tinted Moisturizer To Brighten Skin, Conceal Dark Spots, 9 G,1 Count, Provides UV Protection, Gives Smooth Coverage, Lightens Skin', 
 5, 'lakme-9-to-5-cc-cream-mini', 'lakme1.jpg','lakme2.jpg','lakme3.jpg', 99),

('Blue Heaven Festive MakeUp Kit', 'For Women, Medium Tone Combo, Pack of 8, 32.1g+45.5ml', 
 'Specially curated all-in-one make-up kit, Suitable for medium and dark complexion, All premium products at affordable price, Complete festive kit of 8 exciting products, Skin type: Sensitive', 
 5, 'blue-heaven-festive-makeup-kit', 'heaven1.jpg','heaven2.jpg','heaven3.jpg', 640),

('Multifunctional Weight Training Kit','Burnlab 6 in 1 multifunctional weight training kit - Dumbbells, Kettlebells, Barbells .....','Push up brackets in 1 | Adjustable Weights | Perfect for Full Body Workout for Men & Women',
6,'multifunctional-weight-training-kit','burnlab1.jpg','burnlab2.jpg','burnlab3.jpg',4355),

('WMX Unisex Leather Gym Gloves ','For Professional Weightlifting, Fitness Training And Workout | With Half-Finger','All-purpose gloves: Half-finger gloves design is equally good for a host of outdoor activities and suitable for men, women, adults, youth, and teenagers',
6,'wmx-unisex-leather-gym-gloves','wmx1.jpg','wmx2.jpg','wmx3.jpg',282),

('Luxor 5 Subject Notebook','70 gsm Paper | Single Ruled | Pages - 300 | Count - 1 | 14 x 21.6 CM | Spiral Binding | Versatile for School, Home & Office','Perfect for capturing minutes of business meetings and professional notes with a clean, single-ruled format.',
7,'luxor-5-subject-notebook','luxor1.jpg','luxor2.jpg','luxor3.jpg',162),

('Party Propz Frozen Gifts for Girls','Pack of 7 Pcs, Stationery Items for Girls | Elsa Accessories for Girls | Stationary Set Return Gift ','FROZEN STATIONARY KIT SET FOR GIRLS: Girls love the Frozen stationary kit because its like having magic in their school supplies! Everything in this kit is designed with beautiful Frozen characters and pretty pink colors. Its a popular birthday gift! Inside, you will find pink pencil box, all the stationary a girl needs, cute erasers, and a sharpener, all with Frozen designs. Its a must-have for any girl who loves Frozen and wants to make her schoolwork or drawing time more fun!',
7,'party-propz-frozen-gifts-for-girls','party1.jpg','party2.jpg','party3.jpg',278),

('Star and Daisy Bath Tub for Babies 0-3 years','Foldable Bathtub for Kids with Space Saving, Newborn Baby Folding Bathing Tub Girls & Boys ','Our tubs NON-SLIP surface ensures your little ones bath time is secure, and the integrated support cradles them safely.',
8,'star-and-daisy-bath-tub-for-babies-0-3-years','bathtub1.jpg','bathtub2.jpg','bathtub3.jpg',1099),

('Shining Diva Fashion','26 Pcs Colorful Hair Accessories Hair Clips for Girls Kids Baby Girl Toddlers Women Hairband Hair Band Ties','These hair clips are perfect for children. It is so light to wear that your baby will not even realize that she has something in her hair. No hair damage and suitable for all hair types',
8,'shining-diva-fashion','shining1.jpg','shining2.jpg','shining3.jpg',299),

('Aliens World 96W Car Power','with Dual Output,96 Watts Total (66W USB + 30W Type C PD), Fast Charging, Adapter for iPhone & Android Smartphones and Tablets','[SAFETY ENSURED] : The charger type C for cars comes with a smart chip to protect devices against overvoltage, current and overcharge.',
9,'aliens-world-96w-car-power','aliens1.jpg','aliens2.jpg','aliens3.jpg',1599),

('Automotive Car Plug Circuit','AASONS 11 Pieces Automotive Car Plug Circuit Board Pin Extractor Kit Supplies Terminals Removal Key Connector Puller Release Pin Tools','Well Compatibility: Works Well With Most Terminal Harness Connectors And Can Be Widely Used In Almost All Brands Of Cars, Motorcycles, And Other Electronic Devices On The Market.',
9,'automotive-car-plug-circuit','car1.jpg','car2.jpg','car3.jpg',289),

('Pedigree Biscrok Biscuits','Valentines Gift Dog Treat (Above 4 Months) Chicken Flavour, 900g Pack & Pedigree Biscrok Biscuits Dog Treats (Above 4 Months), Milk and Chicken Flavor, 900g Pack','Bone shaped biscuits ideal to reward your during training or as festive treat for dogs
Fortified vitamins, minerals and omega fatty acids for overall health of pet',
10,'pedigree-biscrok-biscuits','pedigree1.jpg','pedigree2.jpg','pedigree3.jpg',507),

('Pil Neem Plus Herbal Pet Shampoo 1000 ml ','Puppy Safe Anti Ticks and Fleas Dog Shampoo | Anti-Fungal, Antibacterial, Antiseptic & pH Balanced Dog Shampoo | Regular use Coat Cleansing Shampoo for Pets','A perfect blend of natural extract and oils.
A mild preparation with a residual effect.
It can be used for regular coat cleaning and conditioning.
It can be used as a hair detangler.
It helps heal minor scratches and abrasions naturally',
10,'pil-neem-plus-herbal-pet-shampoo-1000-ml','shampoo1.jpg','shampoo2.jpg','shampoo3.jpg',600);


-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);


-- Indexes for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`id`);


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


-- AUTO_INCREMENT for table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
