-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 08:36 PM
-- Server version: 8.0.39
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_csit314_final`
--
CREATE DATABASE IF NOT EXISTS `db_csit314_final` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_csit314_final`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cID` int NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cID`, `category`) VALUES
(1, 'Food Drive'),
(2, 'Christmas Event'),
(3, 'Motorsports'),
(4, 'Medical Assistance'),
(7, 'Mental Health Support'),
(8, 'Animal Care'),
(10, 'Plumbing'),
(11, 'Electrical'),
(12, 'Landscaping'),
(13, 'House Cleaning'),
(14, 'IT Support'),
(15, 'Pest Control'),
(16, 'Interior Painting'),
(17, 'Exterior Painting'),
(18, 'Carpentry'),
(19, 'HVAC Service'),
(20, 'Roof Repair'),
(21, 'Appliance Repair'),
(22, 'Auto Repair'),
(23, 'Dog Walking'),
(24, 'Pet Grooming'),
(25, 'Childcare'),
(26, 'Elder Care'),
(27, 'Private Tutoring'),
(28, 'Personal Training'),
(29, 'Event Photography'),
(30, 'Catering'),
(31, 'Home Security Install'),
(32, 'Laundry & Dry Cleaning'),
(33, 'Tailoring & Alterations'),
(34, 'Hair Styling'),
(35, 'Makeup Artist'),
(36, 'Gardening'),
(37, 'Computer Repair'),
(38, 'Web Design'),
(39, 'Mobile Phone Repair'),
(40, 'Bicycle Repair'),
(41, 'Home Inspection'),
(42, 'Interior Design'),
(43, 'Accounting Services'),
(44, 'Bookkeeping'),
(45, 'Legal Consultation'),
(46, 'Tax Preparation'),
(47, 'Document Translation'),
(48, 'Graphic Design'),
(49, '3D Printing Service'),
(50, 'Furniture Assembly'),
(51, 'Window Cleaning'),
(52, 'Pool Maintenance'),
(53, 'Massage Therapy'),
(54, 'Nutrition & Dietician'),
(55, 'Music Lessons'),
(56, 'Notary Public'),
(57, 'Handyman'),
(58, 'Flooring Installation'),
(59, 'Tile & Grout Cleaning'),
(60, 'Gutter Cleaning'),
(61, 'Solar Panel Cleaning'),
(62, 'Pressure Washing'),
(63, 'Car Detailing'),
(64, 'Upholstery Cleaning'),
(65, 'Mold Remediation'),
(66, 'Waterproofing'),
(67, 'Fence Installation'),
(68, 'Deck Building'),
(69, 'Tree Trimming'),
(70, 'Irrigation Repair'),
(71, 'Snow Removal'),
(72, 'Courier Service'),
(73, 'Data Recovery'),
(74, 'Network Setup'),
(75, 'CCTV Installation'),
(76, 'Home Theater Setup'),
(77, 'PC Building'),
(78, 'SEO Services'),
(79, 'Social Media Marketing'),
(80, 'Content Writing'),
(81, 'Video Editing'),
(82, 'Drone Photography'),
(83, 'Voice Coaching'),
(84, 'Yoga Instruction'),
(85, 'Pilates Instruction'),
(86, 'Dance Lessons'),
(87, 'Barber Services'),
(88, 'Nail Technician'),
(89, 'Spa & Facial'),
(90, 'Wedding Planning'),
(91, 'Dress Rental'),
(92, 'Party Equipment Rental'),
(93, 'Waste Bin Rental'),
(94, 'Wallpaper Installation'),
(95, 'Curtain & Blinds Install'),
(96, 'Window Tinting'),
(97, 'Chimney Sweep'),
(98, 'Fire Extinguisher Service'),
(99, 'First Aid Training'),
(100, 'Lawn Mowing'),
(101, 'Junk Removal'),
(102, 'Local Delivery'),
(103, 'Moving & Relocation'),
(106, 'Travel Companion'),
(107, 'Swimming Guide'),
(108, 'Grocery Errand');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
CREATE TABLE `request` (
  `rID` int NOT NULL,
  `pinID` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `category` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `priority` enum('Low','Medium','High','') COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Pending','InProgress','Completed','Incomplete') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  `viewCount` int NOT NULL DEFAULT '0',
  `savedCount` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`rID`, `pinID`, `description`, `category`, `date`, `location`, `priority`, `status`, `viewCount`, `savedCount`) VALUES
(1, 1, 'Community food distribution event..', 1, '2025-10-27', '11 Orchard rd, 124', 'High', 'Completed', 1, 1),
(5, 1, 'F1 volunteering at Marina Bay circuit!', 3, '2025-11-05', 'marina bay', 'Medium', 'Completed', 10, 5),
(9, 5, 'Provide companionship to elderly at home', 7, '2025-12-01', '67 Bukit Timah rd', 'Low', 'Pending', 4, 1),
(10, 1, 'Assistance to visit the doctor. pick up from: blah blah', 4, '2025-10-25', '11 Orchard street, 124', 'Medium', 'Completed', 2, 1),
(12, 5, 'Christmas deco help', 2, '2025-11-25', 'SIM, clementi', 'Medium', 'InProgress', 24, 17),
(15, 5, 'Buy Medicines', 4, '2025-10-27', 'City Centre Hospital', 'High', 'Completed', 11, 4),
(16, 1, 'Shelter cleaning drive', 8, '2025-11-07', 'Sector  45', 'Medium', 'Completed', 1, 1),
(18, 1, 'Clean Animal shelter.', 8, '2025-11-10', 'Llama land', 'Medium', 'Incomplete', 0, 0),
(19, 11, 'Food giveaways', 1, '2046-01-06', 'East District', 'Low', 'Pending', 132, 1),
(20, 15, 'Food giveaways at west district.', 1, '2025-12-25', 'West District', 'Low', 'Pending', 13, 1),
(21, 19, 'Motorsport Event. Be a Marshall.', 4, '2025-09-28', 'East District', 'High', 'Completed', 209, 34),
(22, 23, 'Gardening service requested in maple heights', 36, '2025-11-08', 'Maple Heights', 'High', 'InProgress', 157, 16),
(23, 27, 'Go Kart racing. Help organise.', 3, '2025-11-07', 'University Quarter', 'Low', 'Incomplete', 12, 0),
(24, 31, 'Irrigation Repair service requested in Old town', 70, '2025-12-03', 'Old Town', 'High', 'Pending', 128, 0),
(25, 35, 'Document Translation service requested', 47, '2025-11-08', 'Cedar Grove', 'Low', 'InProgress', 189, 3),
(26, 39, 'Deck Building services requested in Greenfield', 68, '2025-12-30', 'Greenfield', 'Medium', 'Pending', 394, 0),
(27, 43, 'Wedding Planning service requested in Harbor bay', 90, '2025-11-03', 'Harbor Bay', 'High', 'Incomplete', 110, 33),
(28, 47, 'landscaping service requested in old house', 12, '2025-11-08', 'Cedar Grove', 'Medium', 'InProgress', 100, 12),
(29, 51, 'Nail technician service requested in Cedar Grove', 88, '2025-11-05', 'Cedar Grove', 'Low', 'Completed', 370, 45),
(30, 55, 'Nascar Flag marshall', 3, '2025-12-29', 'West End', 'High', 'Pending', 492, 0),
(31, 59, 'Bulb repair service requested in Harbor Bay', 11, '2025-11-08', 'Harbor Bay', 'Low', 'InProgress', 254, 7),
(32, 63, 'landscaping service requested in rental house', 12, '2025-12-02', 'Hillcrest', 'High', 'Pending', 348, 0),
(33, 67, 'Drone Photography service requested in Pine Ridge', 82, '2025-08-26', 'Industrial Park', 'High', 'Completed', 366, 200),
(34, 71, 'Help Monitor Library for a day', 44, '2025-11-08', 'University Quarter', 'High', 'InProgress', 86, 3),
(35, 75, 'Laundry & Dry Cleaning service requested in maple Heights', 32, '2025-10-07', 'Maple Heights', 'Low', 'Incomplete', 372, 0),
(36, 67, 'Home Theater Setup service requested in Bunglow', 76, '2025-12-01', 'Maple Heights', 'Medium', 'Pending', 203, 1),
(37, 71, 'Waterproofing services required for elderly', 66, '2025-11-08', 'Old Town', 'High', 'InProgress', 357, 15),
(38, 75, 'Help in Computers for someone who doesnt knwo much about them', 14, '2025-12-02', 'Industrial Park', 'Low', 'Pending', 181, 0),
(39, 79, 'Spa & Facial service requested in Sunset Park', 89, '2025-09-07', 'Sunset Park', 'Medium', 'Incomplete', 105, 0),
(40, 83, 'Laundry & Dry Cleaning service requested in UNI dorms', 32, '2025-11-08', 'University Quarter', 'High', 'InProgress', 426, 1),
(41, 19, 'Help in Childrens babysitting group', 25, '2025-10-29', 'Cedar Grove', 'Medium', 'Completed', 460, 67),
(42, 99, 'Help organise book event', 44, '2025-11-19', 'University Quarter', 'High', 'Pending', 73, 0),
(43, 71, 'Provide Food for the needy', 30, '2025-11-08', 'Greenfield', 'Medium', 'InProgress', 318, 2),
(44, 95, 'Exterior Painting service requested', 17, '2025-12-01', 'Financial District', 'Low', 'Pending', 107, 0),
(45, 87, 'BookTok Event at industrial park', 44, '2025-09-04', 'Industrial Park', 'Medium', 'Completed', 149, 4),
(46, 23, 'Provide Food for the party', 30, '2025-11-08', 'Hillcrest', 'Medium', 'InProgress', 250, 14),
(47, 91, 'CCTV installation service requested in Sunset Park', 75, '2025-07-30', 'Sunset Park', 'Low', 'Incomplete', 437, 45),
(48, 63, 'Home Inspection service requested in Lakeview', 41, '2026-01-04', 'Lakeview', 'Medium', 'Pending', 28, 0),
(49, 95, 'Dress rental service required for a stage show', 91, '2025-11-08', 'University Quarter', 'Medium', 'InProgress', 420, 13),
(50, 99, 'Window Cleaning service requested at an office', 51, '2025-11-11', 'Financial District', 'Medium', 'Pending', 124, 0),
(51, 15, 'Window Cleaning service requested at an Industrial Park for big event', 51, '2025-10-09', 'Industrial Park', 'Medium', 'Completed', 245, 11),
(52, 15, 'Content Writing service requested in Pine Ridge', 80, '2025-11-08', 'Pine Ridge', 'Low', 'Completed', 28, 14),
(53, 47, 'Dress rental service required', 91, '2025-08-29', 'Industrial Park', 'Medium', 'Completed', 3, 1),
(54, 63, '', 74, '2025-12-27', 'Pine Ridge', 'Low', 'Pending', 205, 0),
(55, 35, 'Food giveaways at Financial Ditrict', 1, '2025-11-08', 'Financial District', 'Medium', 'InProgress', 413, 6),
(56, 87, 'Help a Nutritionist organise a workshop', 54, '2026-01-03', 'Harbor Bay', 'High', 'Pending', 448, 0),
(57, 5, 'BookTok Event at maple Heights', 44, '2025-07-17', 'Maple Heights', 'Medium', 'Completed', 355, 100),
(58, 67, 'Book reading event at Harbor bay', 44, '2025-11-08', 'Harbor Bay', 'Medium', 'InProgress', 30, 6),
(59, 19, 'Chimney Sweep service requested in Maple Heights', 97, '2025-09-21', 'Maple Heights', 'High', 'Incomplete', 41, 0),
(60, 31, 'Food giveaways', 1, '2025-11-23', 'Old Town', 'High', 'Pending', 234, 0),
(61, 71, 'Courier service help requested', 72, '2025-11-08', 'Old Town', 'Medium', 'InProgress', 451, 12),
(62, 83, 'Food giveaways', 1, '2025-12-21', 'Industrial Park', 'Low', 'Pending', 318, 0),
(63, 43, 'Dance Lessons service requested in Old Town', 84, '2025-07-29', 'Old Town', 'Medium', 'Incomplete', 318, 21),
(64, 87, 'Food giveaways at Uptown', 1, '2025-11-08', 'Uptown', 'Medium', 'InProgress', 17, 15),
(65, 35, 'Cater Food at graduation ceremony', 30, '2025-10-14', 'University Quarter', 'High', 'Completed', 24, 12),
(66, 47, 'Gardening help needed at East district', 36, '2025-11-22', 'East District', 'Medium', 'Pending', 406, 0),
(67, 39, 'Gardening Help needed at Sunset Park', 36, '2025-11-08', 'Sunset Park', 'Low', 'InProgress', 255, 10),
(68, 79, 'Personal training help requested in Brookfield', 28, '2025-12-22', 'Brookfield', 'Low', 'Pending', 424, 0),
(69, 75, 'CCTV installation service requested in West End', 75, '2025-08-24', 'West End', 'High', 'Completed', 396, 234),
(70, 59, 'Document Translation service requested in Financial District', 47, '2025-11-08', 'Financial District', 'Low', 'InProgress', 348, 10),
(71, 47, 'Solar Panel Cleaning service requested in Old Town', 61, '2025-07-22', 'Old Town', 'Medium', 'Incomplete', 451, 0),
(72, 7, 'Private Tutoring in Math for 13 year old in Industrial Park', 27, '2026-01-07', 'Industrial Park', 'High', 'Pending', 141, 0),
(73, 5, 'Drone Photography service requested in Brookfiled', 82, '2025-11-08', 'Brookfield', 'Medium', 'InProgress', 347, 1),
(74, 1, 'Food giveaways at Brookfield', 1, '2026-01-06', 'Brookfield', 'Low', 'Pending', 444, 0),
(75, 87, 'Tree trimming service requested in Riverside', 69, '2025-11-05', 'Riverside', 'Medium', 'Incomplete', 18, 0),
(76, 1, 'Flooring installation service requested in Riverside', 58, '2025-11-08', 'Riverside', 'High', 'Completed', 156, 7),
(77, 95, 'Food giveaways', 1, '2025-11-01', 'East District', 'High', 'Completed', 284, 34),
(78, 5, 'Window tinting service requested in Greenfield', 96, '2025-11-19', 'Greenfield', 'Medium', 'Pending', 304, 0),
(79, 71, '', 84, '2025-11-08', 'Greenfield', 'Low', 'InProgress', 427, 2),
(80, 78, 'Snow removal service requested in Brookfield', 71, '2026-01-06', 'Brookfield', 'Medium', 'Pending', 403, 0),
(81, 31, 'F1 race track cleaning', 3, '2025-10-26', 'Maple Heights', 'High', 'Completed', 125, 55),
(82, 27, 'Deck Building services requested in Greenfield', 68, '2025-11-08', 'Greenfield', 'High', 'InProgress', 448, 1),
(83, 5, 'Fence installation service requested in Old Town', 67, '2025-08-25', 'Old Town', 'Low', 'Incomplete', 427, 65),
(84, 23, 'Food giveaways at uptown', 1, '2025-12-31', 'Uptown', 'High', 'Pending', 329, 0),
(85, 71, 'Waterproofing services required in bathrooms', 66, '2025-11-08', 'Brookfield', 'Medium', 'InProgress', 426, 1),
(86, 7, 'hair styling service requested in Pine Ridge', 34, '2025-12-26', 'Pine Ridge', 'Medium', 'Pending', 22, 0),
(87, 1, 'Deck Building services requested in Greenfield', 68, '2025-10-06', 'Southside', 'Medium', 'Completed', 331, 34),
(88, 99, 'Pest control service requested in Financial District', 15, '2025-11-08', 'Financial District', 'Medium', 'InProgress', 99, 1),
(89, 103, 'BookTok Event at North Point', 44, '2025-09-04', 'North Point', 'Low', 'Completed', 25, 23),
(90, 47, 'Elder care for 5 hours requested in West End', 26, '2025-11-29', 'West End', 'High', 'Pending', 223, 0),
(91, 15, 'Wallpaper Installation service requested in Southside', 94, '2025-11-08', 'Southside', 'Medium', 'Completed', 472, 4),
(92, 43, 'Network Setup service requested in East District', 74, '2025-12-02', 'East District', 'Medium', 'Pending', 186, 0),
(93, 95, 'Music lessons requested in Old Town', 55, '2025-08-13', 'Old Town', 'Low', 'Completed', 269, 100),
(94, 31, 'Private tutoring for 15 year old requested in Harbor Bay', 27, '2025-11-08', 'Harbor Bay', 'Low', 'InProgress', 216, 9),
(95, 75, 'Animal shelter cleaning service requested in Brookfield', 8, '2025-07-17', 'Brookfield', 'Medium', 'Incomplete', 459, 2),
(96, 63, 'Wedding dress Planning service requested in Cedar Grove', 91, '2025-12-29', 'Hillcrest', 'Medium', 'Pending', 177, 0),
(97, 11, 'Kids racing event', 3, '2025-11-08', 'Greenfield', 'Medium', 'InProgress', 258, 7),
(98, 53, 'Wallpaper Installation service requested in Brookfield', 94, '2025-11-30', 'Brookfield', 'High', 'Pending', 384, 0),
(99, 27, 'Exterior Painting service requested at an Air BNB', 17, '2025-09-23', 'North Point', 'High', 'Incomplete', 305, 11),
(100, 63, 'Upholstery cleaning service requested in Riverside', 64, '2025-11-08', 'Riverside', 'Medium', 'InProgress', 275, 3),
(101, 47, 'Birthday photography service requested in Sunset Park', 29, '2025-07-19', 'Sunset Park', 'Medium', 'Completed', 388, 234),
(102, 91, 'Tile cleaning service requested in Industrial Park', 59, '2025-11-17', 'Industrial Park', 'Medium', 'Pending', 5, 0),
(103, 91, 'Home setup service requested in Uptown', 76, '2025-11-08', 'Uptown', 'Low', 'InProgress', 425, 2),
(104, 23, 'Video Editing service requested in Hillcrest', 79, '2025-12-12', 'Hillcrest', 'Low', 'Pending', 51, 0),
(105, 7, 'Fire Extinguisher Service service requested in Harbor Bay', 98, '2025-10-09', 'Harbor Bay', 'Medium', 'Completed', 125, 69),
(106, 23, 'hair styling service requested in Cedar Grove', 34, '2025-11-08', 'Cedar Grove', 'High', 'InProgress', 114, 7),
(107, 67, 'Content Writing service requested in Downtown', 80, '2025-09-01', 'Downtown', 'Medium', 'Incomplete', 346, 0),
(108, 59, 'Dog walking requested in Lakeview', 8, '2025-12-13', 'Lakeview', 'High', 'Pending', 196, 0),
(109, 43, 'Pet grooming service requested in Maple Heights', 28, '2025-11-08', 'Maple Heights', 'High', 'InProgress', 249, 12),
(110, 15, 'Wedding Planning service requested in Cedar Grove', 90, '2025-12-12', 'Financial District', 'High', 'Pending', 214, 0),
(111, 48, 'Christmas Event Planning service requested in Greenfield', 2, '2025-07-26', 'Greenfield', 'Medium', 'Incomplete', 174, 32),
(112, 91, 'Window Cleaning service requested in Hillcrest', 51, '2025-11-08', 'Hillcrest', 'Medium', 'InProgress', 456, 5),
(113, 92, 'Food giveaways', 1, '2025-10-07', 'Uptown', 'High', 'Completed', 132, 76),
(114, 65, 'Makeup Artist service requested in West End', 35, '2025-12-08', 'West End', 'Medium', 'Pending', 345, 0),
(115, 54, 'Clean Childrens school', 25, '2025-11-08', 'Financial District', 'Medium', 'InProgress', 227, 12),
(116, 58, 'Wedding Planning service requested in Cedar Grove', 90, '2025-11-24', 'Financial District', 'Low', 'Pending', 141, 0),
(117, 36, 'Party equipment rentals requested in Greenfield', 92, '2025-08-17', 'Greenfield', 'High', 'Completed', 284, 99),
(118, 72, 'Home Inspection service requested in Sunset Park', 41, '2025-11-08', 'Sunset Park', 'High', 'InProgress', 22, 12),
(119, 86, 'Pet grooming service requested in Southside', 24, '2025-09-04', 'Southside', 'Low', 'Incomplete', 444, 0),
(120, 1, 'Clean area around house, bring shovel and wheelbarrow.', 12, '2025-11-10', 'Upper West Side 246 Avenue', 'Low', 'Incomplete', 0, 0),
(122, 1, 'This is a test request today for it to show on the reports.', 12, '2025-11-11', 'Test Report', 'Low', 'InProgress', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shortlistedrequest`
--

DROP TABLE IF EXISTS `shortlistedrequest`;
CREATE TABLE `shortlistedrequest` (
  `rID` int NOT NULL,
  `csrID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shortlistedrequest`
--

INSERT INTO `shortlistedrequest` (`rID`, `csrID`) VALUES
(12, 6),
(25, 6),
(36, 6),
(12, 2),
(19, 2),
(20, 2),
(9, 2),
(22, 2);

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

DROP TABLE IF EXISTS `useraccount`;
CREATE TABLE `useraccount` (
  `aID` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phoneNumber` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date NOT NULL,
  `userProfile` int NOT NULL,
  `status` enum('Active','Suspended') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`aID`, `name`, `password`, `phoneNumber`, `address`, `dob`, `userProfile`, `status`) VALUES
(1, 'Thea', 'pin123', '09171234567', '123 Elm Street', '1995-03-15', 1, 'Active'),
(2, 'Rumi', 'csr123', '09281234567', '45 Maple Avenue', '1990-07-20', 2, 'Active'),
(3, 'Jinu', 'admin123', '09391234567', '789 Oak Road', '1988-11-05', 3, 'Active'),
(4, 'Tanishqa', 'manager123', '09451234567', '56 Pine Lane', '1985-09-30', 4, 'Active'),
(5, 'Violet', 'pin111', '23456123', '454 Basgiath', '1989-12-13', 1, 'Suspended'),
(6, 'Sgaeyl', 'csr111', '12345678', '451 Aretia street', '1988-04-13', 2, 'Active'),
(7, 'Alice Perez', 'pin123', '09171234567', '123 Elm Street', '1995-03-15', 1, 'Active'),
(8, 'Brian Cruz', 'csr123', '09281234567', '45 Maple Avenue', '1990-07-20', 2, 'Active'),
(9, 'Clara Reyes', 'admin123', '09391234567', '789 Oak Road', '1988-11-05', 3, 'Active'),
(10, 'David Lee', 'manager123', '09451234567', '56 Pine Lane', '1985-09-30', 4, 'Active'),
(11, 'Sebastian Vasquez', 'pin123', '09282948471', '12 Walnut Street', '1985-07-04', 1, 'Active'),
(12, 'Stella Gomez', 'csr123', '09779173375', '919 Hawthorn Drive', '1977-08-17', 2, 'Active'),
(13, 'Quinn Aguilar', 'admin123', '09392195321', '120 Magnolia Drive', '1976-04-03', 3, 'Active'),
(14, 'Leo Silva', 'manager123', '09510872045', '224 Pine Lane', '1990-08-28', 4, 'Active'),
(15, 'Layla Chavez', 'pin123', '09999506403', '774 Aspen Court', '2002-07-23', 1, 'Active'),
(16, 'Lily Bautista', 'csr123', '09779094637', '987 Hawthorn Drive', '1981-08-28', 2, 'Active'),
(17, 'Aaliyah Lopez', 'admin123', '09815574243', '554 Aspen Court', '1989-04-11', 3, 'Active'),
(18, 'Alexa Velasquez', 'manager123', '09171446874', '713 Beech Court', '1992-05-13', 4, 'Active'),
(19, 'Willow Silva', 'pin123', '09818779575', '124 Maple Avenue', '1981-08-28', 1, 'Active'),
(20, 'Zoe Delgado', 'csr123', '09996701311', '449 Poplar Avenue', '2001-05-30', 2, 'Active'),
(21, 'Stella Gomez', 'admin123', '09511403179', '60 Magnolia Drive', '1983-11-29', 3, 'Active'),
(22, 'Jared Santos', 'manager123', '09815068783', '214 Poplar Avenue', '1975-04-13', 4, 'Active'),
(23, 'Natalie Gonzalez', 'pin123', '09814448674', '346 Poplar Avenue', '1980-06-18', 1, 'Active'),
(24, 'Stella Santiago', 'csr123', '09453858122', '799 Birch Street', '1990-07-14', 2, 'Active'),
(25, 'Caroline Alvarez', 'admin123', '09634984180', '135 Cedar Street', '1999-09-09', 3, 'Active'),
(26, 'Aria Ramos', 'manager123', '09390289712', '878 Juniper Way', '1994-03-03', 4, 'Active'),
(27, 'Eleanor Reyes', 'pin123', '09630231999', '96 Magnolia Drive', '1990-10-01', 1, 'Active'),
(28, 'Darren Rivera', 'csr123', '09458222903', '614 Oak Road', '1986-04-03', 2, 'Active'),
(29, 'Naomi Santos', 'admin123', '09638147048', '355 Magnolia Drive', '1993-07-03', 3, 'Active'),
(30, 'Daniel Chavez', 'manager123', '09993422626', '865 Elm Street', '1976-01-23', 4, 'Suspended'),
(31, 'Michael Martinez', 'pin123', '09458007709', '578 Sycamore Road', '2002-12-05', 1, 'Active'),
(32, 'Parker de la Cruz', 'csr123', '09453044799', '895 Willow Way', '1977-10-01', 2, 'Active'),
(33, 'Ruby Silva', 'admin123', '09995797920', '411 Laurel Road', '2005-12-09', 3, 'Active'),
(34, 'Amelia Ramos', 'manager123', '09639118084', '362 Cedar Street', '1996-11-28', 4, 'Active'),
(35, 'Yara Vasquez', 'pin123', '09458527456', '755 Laurel Road', '1986-02-05', 1, 'Suspended'),
(36, 'Aurora Reyes', 'csr123', '09779458029', '338 Birch Street', '1996-03-14', 2, 'Active'),
(37, 'Rafael Cortez', 'admin123', '09996244005', '762 Chestnut Lane', '1999-07-11', 3, 'Active'),
(38, 'Sofia Vargas', 'manager123', '09635124847', '213 Birch Street', '1993-02-14', 4, 'Active'),
(39, 'Ivy Jimenez', 'pin123', '09391768603', '912 Spruce Avenue', '1991-04-22', 1, 'Active'),
(40, 'Wyatt Vargas', 'csr123', '09397701019', '372 Sycamore Road', '1979-01-05', 2, 'Active'),
(41, 'Julian Ramos', 'admin123', '09453607941', '775 Cedar Street', '1976-07-20', 3, 'Active'),
(42, 'Sienna Moreno', 'manager123', '09994579204', '441 Aspen Court', '1996-12-13', 4, 'Active'),
(43, 'Samantha Rodriguez', 'pin123', '09999332185', '87 Birch Street', '2005-12-31', 1, 'Active'),
(44, 'Chloe Ramirez', 'csr123', '09772761252', '727 Cedar Street', '1987-02-14', 2, 'Active'),
(45, 'Yara Torres', 'admin123', '09451223179', '966 Chestnut Lane', '2005-12-03', 3, 'Active'),
(46, 'Viola Vasquez', 'manager123', '09810513975', '316 Elm Street', '1998-04-11', 4, 'Active'),
(47, 'Mila Delgado', 'pin123', '09177055452', '733 Beech Court', '1977-10-27', 1, 'Active'),
(48, 'Oscar Hernandez', 'csr123', '09172542408', '806 Magnolia Drive', '2003-02-04', 2, 'Active'),
(49, 'Ivy Gomez', 'admin123', '09284627131', '281 Pine Lane', '1998-04-07', 3, 'Active'),
(50, 'Lucy Guerrero', 'manager123', '09397476630', '412 Cedar Street', '1994-07-24', 4, 'Suspended'),
(51, 'Avery Rivera', 'pin123', '09395601619', '426 Hawthorn Drive', '1977-05-20', 1, 'Active'),
(52, 'Aaliyah Garcia', 'csr123', '09453444820', '833 Elm Street', '1998-02-22', 2, 'Active'),
(53, 'Sienna Romero', 'admin123', '09174499353', '812 Spruce Avenue', '1987-07-21', 3, 'Active'),
(54, 'Priya Rodriguez', 'manager123', '09287864592', '80 Elm Street', '1992-05-28', 4, 'Active'),
(55, 'Eleanor Torres', 'pin123', '09639950693', '111 Alder Close', '1976-03-25', 1, 'Active'),
(56, 'Thea Ortiz', 'csr123', '09394109706', '983 Cherry Lane', '1982-08-02', 2, 'Active'),
(57, 'Ethan Flores', 'admin123', '09390590887', '405 Alder Close', '2002-09-18', 3, 'Active'),
(58, 'Monica Ramos', 'manager123', '09459787483', '572 Walnut Street', '1978-02-28', 4, 'Active'),
(59, 'Talia Calderon', 'pin123', '09281087506', '931 Willow Way', '2003-07-31', 1, 'Active'),
(60, 'Aurora Diaz', 'csr123', '09179329401', '354 Birch Street', '1977-10-05', 2, 'Suspended'),
(61, 'Hazel Suarez', 'admin123', '09515416520', '117 Oak Road', '2005-12-07', 3, 'Active'),
(62, 'Emma Hernandez', 'manager123', '09516265129', '110 Elm Street', '1982-08-05', 4, 'Active'),
(63, 'Logan Suarez', 'pin123', '09456298728', '890 Laurel Road', '1985-11-16', 1, 'Active'),
(64, 'Harper Mendoza', 'csr123', '09280435490', '343 Juniper Way', '1991-04-01', 2, 'Active'),
(65, 'Aiden Hernandez', 'admin123', '09396787380', '708 Birch Street', '2005-10-19', 3, 'Active'),
(66, 'Thea Santiago', 'manager123', '09992443334', '487 Juniper Way', '1976-08-20', 4, 'Active'),
(67, 'Addison Gomez', 'pin123', '09631086749', '30 Alder Close', '1997-10-24', 1, 'Active'),
(68, 'Henry Vasquez', 'csr123', '09990202228', '900 Poplar Avenue', '1984-11-28', 2, 'Active'),
(69, 'Samantha Rodriguez', 'admin123', '09514935377', '69 Pine Lane', '1988-07-19', 3, 'Active'),
(70, 'Aiden Perez', 'manager123', '09287739748', '863 Sycamore Road', '2000-09-03', 4, 'Suspended'),
(71, 'Addison Delgado', 'pin123', '09819592308', '150 Walnut Street', '2005-09-06', 1, 'Active'),
(72, 'Parker Diaz', 'csr123', '09457049304', '932 Magnolia Drive', '2004-08-13', 2, 'Active'),
(73, 'Alexander Santos', 'admin123', '09392772125', '870 Juniper Way', '1994-06-09', 3, 'Active'),
(74, 'Nora Valdez', 'manager123', '09819912172', '31 Walnut Street', '2005-12-17', 4, 'Active'),
(75, 'Aurora Suarez', 'pin123', '09454365584', '850 Elm Street', '1987-03-12', 1, 'Active'),
(76, 'Jared Ramirez', 'csr123', '09518448835', '996 Willow Way', '1995-04-29', 2, 'Active'),
(77, 'James Delgado', 'admin123', '09774711160', '800 Cherry Lane', '1987-03-22', 3, 'Active'),
(78, 'Liam Cortez', 'manager123', '09399994086', '868 Juniper Way', '1987-12-10', 4, 'Active'),
(79, 'Aiden Valdez', 'pin123', '09398824316', '399 Magnolia Drive', '2000-01-10', 1, 'Active'),
(80, 'Naomi Salazar', 'csr123', '09170174697', '367 Poplar Avenue', '1985-04-15', 2, 'Active'),
(81, 'Aurora Jimenez', 'admin123', '09282786883', '576 Poplar Avenue', '1981-11-11', 3, 'Active'),
(82, 'Victoria Cabrera', 'manager123', '09996430465', '661 Oak Road', '1993-09-17', 4, 'Active'),
(83, 'Julian Ramos', 'pin123', '09812344010', '521 Birch Street', '1988-05-24', 1, 'Active'),
(84, 'Sophia Ortiz', 'csr123', '09280703190', '910 Beech Court', '1976-12-25', 2, 'Active'),
(85, 'Isabella Gomez', 'admin123', '09450840198', '906 Magnolia Drive', '1987-09-22', 3, 'Suspended'),
(86, 'Logan Rivera', 'manager123', '09175470829', '938 Magnolia Drive', '1975-06-16', 4, 'Active'),
(87, 'Evan Lopez', 'pin123', '09992357324', '49 Oak Road', '1987-04-10', 1, 'Active'),
(88, 'Daniel Gomez', 'csr123', '09774457625', '201 Laurel Road', '1976-04-27', 2, 'Active'),
(89, 'Sofia Morales', 'admin123', '09633994822', '843 Elm Street', '1976-04-13', 3, 'Active'),
(90, 'Mateo Martinez', 'manager123', '09997036545', '493 Cedar Street', '1975-11-17', 4, 'Suspended'),
(91, 'Lucas Torres', 'pin123', '09280778609', '879 Cedar Street', '1994-12-15', 1, 'Active'),
(92, 'Ava Gutierrez', 'csr123', '09779610243', '302 Cherry Lane', '2003-01-20', 2, 'Active'),
(93, 'Aurora Castillo', 'admin123', '09771837380', '166 Oak Road', '1978-06-16', 3, 'Active'),
(94, 'Brooklyn Calderon', 'manager123', '09773611289', '953 Oak Road', '1990-08-02', 4, 'Active'),
(95, 'Aaliyah Delgado', 'pin123', '09453870761', '809 Hawthorn Drive', '1977-08-01', 1, 'Active'),
(96, 'Lily Aguilar', 'csr123', '09819361122', '369 Magnolia Drive', '1975-06-22', 2, 'Active'),
(97, 'Ava Torres', 'admin123', '09391143662', '37 Juniper Way', '2005-11-03', 3, 'Active'),
(98, 'Sienna Bautista', 'manager123', '09173993985', '741 Alder Close', '1985-07-20', 4, 'Active'),
(99, 'Quinn Perez', 'pin123', '09393629040', '398 Alder Close', '1996-02-17', 1, 'Active'),
(100, 'Darren Martinez', 'csr123', '09451714162', '370 Chestnut Lane', '1980-05-15', 2, 'Active'),
(101, 'Kylie Romero', 'admin123', '09992426232', '763 Cherry Lane', '1998-10-16', 3, 'Active'),
(102, 'Addison Perez', 'manager123', '09993368558', '884 Beech Court', '1996-07-17', 4, 'Active'),
(103, 'Phoebe Romero', 'pin123', '09996353855', '237 Beech Court', '1999-05-16', 1, 'Active'),
(104, 'Matthew Dominguez', 'csr123', '09390887820', '506 Magnolia Drive', '1998-04-05', 2, 'Active'),
(105, 'Nadia Cabrera', 'admin123', '09392390970', '97 Elm Street', '2004-07-22', 3, 'Active'),
(106, 'Grayson Garcia', 'manager123', '09516842434', '677 Aspen Court', '2005-02-16', 4, 'Active'),
(107, 'Martin Test Updated', '123', '123', 'address 123', '2025-11-11', 1, 'Suspended'),
(108, 'Bob Test Update', '123', '123', 'address 123', '2025-11-11', 2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

DROP TABLE IF EXISTS `userprofile`;
CREATE TABLE `userprofile` (
  `pID` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Active','Suspended') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`pID`, `name`, `description`, `status`) VALUES
(1, 'PIN', 'Manages requests, track potential interests on their requests, and view their history of completed matches', 'Active'),
(2, 'CSR Rep', 'Can search, view, and save into shortlist a PIN\'s request. Additionally, search and view their completed matches history.', 'Active'),
(3, 'User Admin', 'Manages user accounts and user profiles.', 'Active'),
(4, 'Platform Manager', 'Manages categories and can generate reports on a daily, weekly and monthly basis.', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `volunteermatch`
--

DROP TABLE IF EXISTS `volunteermatch`;
CREATE TABLE `volunteermatch` (
  `mID` int NOT NULL,
  `csrID` int NOT NULL,
  `rID` int NOT NULL,
  `dateBooked` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteermatch`
--

INSERT INTO `volunteermatch` (`mID`, `csrID`, `rID`, `dateBooked`) VALUES
(1, 2, 10, '2025-10-01'),
(2, 6, 1, '2025-09-30'),
(3, 2, 15, '2025-09-30'),
(4, 2, 20, '2025-03-14'),
(5, 6, 21, '2025-03-18'),
(6, 8, 22, '2025-04-06'),
(7, 12, 23, '2025-04-15'),
(8, 16, 24, '2025-05-03'),
(9, 20, 25, '2025-05-21'),
(10, 24, 26, '2025-06-12'),
(11, 28, 27, '2025-06-30'),
(12, 32, 28, '2025-07-08'),
(13, 36, 29, '2025-07-26'),
(14, 40, 30, '2025-08-14'),
(15, 44, 31, '2025-08-22'),
(16, 48, 32, '2025-09-10'),
(17, 52, 33, '2025-07-18'),
(18, 56, 34, '2025-10-06'),
(19, 60, 35, '2025-10-24'),
(20, 64, 36, '2025-11-11'),
(21, 68, 37, '2025-11-29'),
(22, 72, 38, '2025-12-07'),
(23, 76, 39, '2025-08-15'),
(24, 80, 40, '2025-01-04'),
(25, 84, 41, '2025-01-22'),
(26, 88, 42, '2025-02-10'),
(27, 92, 43, '2025-02-28'),
(28, 96, 44, '2025-03-16'),
(29, 2, 45, '2025-03-24'),
(30, 6, 46, '2025-04-11'),
(31, 8, 47, '2025-04-29'),
(32, 12, 48, '2025-05-17'),
(33, 16, 49, '2025-06-04'),
(34, 20, 50, '2025-06-22'),
(35, 24, 51, '2025-07-10'),
(36, 28, 52, '2025-07-28'),
(37, 32, 53, '2025-08-15'),
(38, 36, 54, '2025-09-02'),
(39, 40, 55, '2025-09-20'),
(40, 44, 56, '2025-10-08'),
(41, 48, 57, '2025-06-26'),
(42, 52, 58, '2025-11-01'),
(43, 56, 59, '2025-09-01'),
(44, 60, 60, '2025-11-19'),
(45, 64, 61, '2025-01-06'),
(46, 68, 62, '2025-01-24'),
(47, 72, 63, '2025-02-11'),
(48, 76, 64, '2025-10-12'),
(49, 80, 65, '2025-03-17'),
(50, 84, 66, '2025-03-30'),
(51, 88, 67, '2025-04-12'),
(52, 92, 68, '2025-04-30'),
(53, 96, 69, '2025-05-18'),
(54, 2, 70, '2025-06-05'),
(55, 6, 71, '2025-06-23'),
(56, 8, 72, '2025-07-11'),
(57, 12, 73, '2025-07-29'),
(58, 16, 74, '2025-08-16'),
(59, 20, 75, '2025-09-03'),
(60, 24, 76, '2025-09-21'),
(61, 28, 77, '2025-10-09'),
(62, 32, 78, '2025-10-27'),
(63, 36, 79, '2025-11-14'),
(64, 40, 80, '2025-12-02'),
(65, 44, 81, '2025-12-20'),
(66, 48, 82, '2025-01-07'),
(67, 52, 83, '2025-01-25'),
(68, 56, 84, '2025-02-12'),
(69, 60, 85, '2025-03-02'),
(70, 64, 86, '2025-03-20'),
(71, 68, 87, '2025-04-07'),
(72, 72, 88, '2025-04-25'),
(73, 76, 89, '2025-05-13'),
(74, 80, 90, '2025-05-31'),
(75, 84, 91, '2025-06-18'),
(76, 88, 92, '2025-07-06'),
(77, 92, 93, '2025-07-24'),
(78, 96, 94, '2025-08-11'),
(79, 2, 95, '2025-08-29'),
(80, 6, 96, '2025-09-16'),
(81, 8, 97, '2025-10-04'),
(82, 12, 98, '2025-10-22'),
(83, 16, 99, '2025-09-09'),
(84, 20, 100, '2025-10-27'),
(85, 24, 20, '2025-12-15'),
(86, 28, 21, '2025-01-02'),
(87, 32, 22, '2025-01-20'),
(88, 36, 23, '2025-02-07'),
(89, 40, 24, '2025-02-25'),
(90, 44, 25, '2025-03-15'),
(91, 48, 26, '2025-04-01'),
(92, 52, 27, '2025-04-19'),
(93, 56, 28, '2025-05-07'),
(94, 60, 29, '2025-05-25'),
(95, 64, 30, '2025-06-12'),
(96, 68, 31, '2025-06-30'),
(97, 72, 32, '2025-07-18'),
(98, 76, 33, '2025-08-05'),
(99, 80, 34, '2025-08-23'),
(100, 84, 35, '2025-09-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`rID`),
  ADD KEY `fk_pinID` (`pinID`),
  ADD KEY `fk_serviceType` (`category`);

--
-- Indexes for table `shortlistedrequest`
--
ALTER TABLE `shortlistedrequest`
  ADD KEY `shortlistedrequest_ibfk_1` (`rID`),
  ADD KEY `shortlistedrequest_ibfk_3` (`csrID`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`aID`),
  ADD KEY `userProfile` (`userProfile`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`pID`);

--
-- Indexes for table `volunteermatch`
--
ALTER TABLE `volunteermatch`
  ADD PRIMARY KEY (`mID`),
  ADD KEY `volunteermatch_ibfk_2` (`csrID`),
  ADD KEY `volunteermatch_ibfk_one` (`rID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `rID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `aID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `pID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `volunteermatch`
--
ALTER TABLE `volunteermatch`
  MODIFY `mID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `fk_pinID` FOREIGN KEY (`pinID`) REFERENCES `useraccount` (`aID`),
  ADD CONSTRAINT `request_ibfk_category` FOREIGN KEY (`category`) REFERENCES `category` (`cID`) ON DELETE SET NULL;

--
-- Constraints for table `shortlistedrequest`
--
ALTER TABLE `shortlistedrequest`
  ADD CONSTRAINT `shortlistedrequest_ibfk_1` FOREIGN KEY (`rID`) REFERENCES `request` (`rID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shortlistedrequest_ibfk_3` FOREIGN KEY (`csrID`) REFERENCES `useraccount` (`aID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD CONSTRAINT `useraccount_ibfk_1` FOREIGN KEY (`userProfile`) REFERENCES `userprofile` (`pID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteermatch`
--
ALTER TABLE `volunteermatch`
  ADD CONSTRAINT `volunteermatch_ibfk_2` FOREIGN KEY (`csrID`) REFERENCES `useraccount` (`aID`),
  ADD CONSTRAINT `volunteermatch_ibfk_one` FOREIGN KEY (`rID`) REFERENCES `request` (`rID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
