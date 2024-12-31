-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2024 at 09:44 AM
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
-- Database: `payroll_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `absences` int(11) DEFAULT 0,
  `overtime_hours` decimal(4,2) DEFAULT 0.00,
  `work_hours` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

CREATE TABLE `emergency_contacts` (
  `contact_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_profile`
--

CREATE TABLE `employee_profile` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `pin_code` varchar(10) DEFAULT NULL,
  `pan_number` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_profile`
--

INSERT INTO `employee_profile` (`emp_id`, `emp_name`, `father_name`, `mother_name`, `permanent_address`, `pin_code`, `pan_number`, `aadhaar_no`, `dob`, `hire_date`, `blood_group`, `email_address`, `marital_status`, `created_at`) VALUES
(1, 'Kongkon Boraa', 'Manabjyoti Bora', 'Bororsa Bora', '', NULL, '123456', '123456', '2001-12-12', '2001-12-12', NULL, 'kbora3525@gmail.com', NULL, '2024-12-29 11:26:49'),
(2, 'John Doe', 'Michael Doe', 'Sarah Doe', '123 Main St, Springfield', '123456', 'ABCDE1234F', '123456789012', '1990-01-01', '2020-01-01', 'O+', 'johndoe@example.com', 'Single', '2024-12-29 15:43:49'),
(4, 'Jane Smith', 'Richard Smith', 'Emily Smith', '456 Elm St, Shelbyville', '654321', 'ZYXWV5432P', '987654321098', '1992-05-15', '2021-06-01', 'A-', 'janesmith@example.com', 'Married', '2024-12-29 16:00:47'),
(5, 'Alice Johnson', 'William Johnson', 'Emma Johnson', '789 Pine St, Capitol City', '789123', 'LMNOP6789Q', '456123789654', '1985-03-22', '2018-11-15', 'B+', 'alicej@example.com', 'Single', '2024-12-29 16:00:47'),
(6, 'Bob Brown', 'George Brown', 'Hannah Brown', '101 Maple Ave, Shelbyville', '321789', 'QWERT1234T', '321654987012', '1988-07-10', '2017-04-25', 'AB-', 'bobb@example.com', 'Married', '2024-12-29 16:00:47'),
(7, 'Charlie Green', 'David Green', 'Sophia Green', '202 Birch Blvd, Springfield', '654987', 'ASDFG5432E', '987321654098', '1995-12-05', '2022-03-10', 'O-', 'charlieg@example.com', 'Single', '2024-12-29 16:00:47'),
(12, 'testing', 'tesst', 'test', '', NULL, '3212321', '', '2000-12-12', '2000-12-12', NULL, 'Test123@email.com', NULL, '2024-12-29 17:07:13'),
(14, 'testing', 'tesst', 'test', NULL, NULL, '3212321', '3123123', '2000-12-12', '2000-12-12', NULL, 'Test123@email.com', NULL, '2024-12-29 17:09:27'),
(15, 'Rabi', 'Ranji', 'Anamika', NULL, NULL, '123456', '45553', '2000-12-12', '2000-12-12', NULL, 'rabi3525@gmail.com', NULL, '2024-12-30 18:07:12'),
(16, '', '', '', NULL, NULL, '', '', '0000-00-00', '0000-00-00', NULL, '', NULL, '2024-12-31 05:24:37'),
(17, 'Jane Patel', 'Neha Smith', 'Mary Gupta', NULL, NULL, 'PDFYN8031R', '954506193288', '1990-12-31', '2018-12-31', NULL, 'jane.patel410@example.com', NULL, '2024-12-31 05:40:50'),
(18, 'Michael Gupta', 'David Brown', 'Sneha Sharma', NULL, NULL, 'DIQBI8213K', '315788245043', '1988-12-31', '2015-12-31', NULL, 'michael.gupta453@example.com', NULL, '2024-12-31 05:40:50'),
(19, 'Emma Gupta', 'Robert Smith', 'Lisa Patel', NULL, NULL, 'ZJCVQ8465V', '392699064515', '1999-12-31', '2014-12-31', NULL, 'emma.gupta558@example.com', NULL, '2024-12-31 05:40:50'),
(20, 'David Davis', 'Amit Singh', 'Sarah Sharma', NULL, NULL, 'RTOFP3209P', '409466527917', '1987-12-31', '2019-12-31', NULL, 'david.davis504@example.com', NULL, '2024-12-31 05:40:50'),
(21, 'Lisa Williams', 'Michael Davis', 'Neha Johnson', NULL, NULL, 'THGST9417K', '574784848880', '1987-12-31', '2016-12-31', NULL, 'lisa.williams842@example.com', NULL, '2024-12-31 05:40:50'),
(22, 'Lisa Sharma', 'David Jones', 'Amit Davis', NULL, NULL, 'XWYJD3006O', '562636851273', '1981-12-31', '2017-12-31', NULL, 'lisa.sharma504@example.com', NULL, '2024-12-31 05:40:50'),
(23, 'Raj Miller', 'Robert Verma', 'Michael Brown', NULL, NULL, 'NFTBX3042W', '879413063260', '1999-12-31', '2020-12-31', NULL, 'raj.miller410@example.com', NULL, '2024-12-31 05:40:50'),
(24, 'Sarah Sharma', 'Priya Gupta', 'John Singh', NULL, NULL, 'NZUKY2131K', '857128806843', '1984-12-31', '2017-12-31', NULL, 'sarah.sharma426@example.com', NULL, '2024-12-31 05:40:50'),
(25, 'Priya Verma', 'Michael Jones', 'Mary Williams', NULL, NULL, 'UHANQ7909R', '962445182539', '1982-12-31', '2019-12-31', NULL, 'priya.verma924@example.com', NULL, '2024-12-31 05:40:50'),
(26, 'Sarah Miller', 'Sarah Singh', 'Raj Sharma', NULL, NULL, 'JBJEL4983C', '314241218342', '1989-12-31', '2023-12-31', NULL, 'sarah.miller269@example.com', NULL, '2024-12-31 05:40:50'),
(27, 'Anjali Williams', 'Jane Gupta', 'William Verma', NULL, NULL, 'LCYQF5460L', '544809640630', '1984-12-31', '2015-12-31', NULL, 'anjali.williams319@example.com', NULL, '2024-12-31 05:40:50'),
(28, 'Rahul Verma', 'Neha Garcia', 'Neha Jones', NULL, NULL, 'BRDYS5846C', '941021172611', '1980-12-31', '2022-12-31', NULL, 'rahul.verma368@example.com', NULL, '2024-12-31 05:40:50'),
(29, 'Lisa Garcia', 'Emma Williams', 'Suresh Smith', NULL, NULL, 'IVMSR6475W', '690348801435', '1981-12-31', '2021-12-31', NULL, 'lisa.garcia805@example.com', NULL, '2024-12-31 05:40:50'),
(30, 'Lisa Smith', 'Emma Jones', 'John Verma', NULL, NULL, 'LKFQK4987W', '992722700128', '1990-12-31', '2015-12-31', NULL, 'lisa.smith200@example.com', NULL, '2024-12-31 05:40:50'),
(31, 'Michael Sharma', 'Sarah Garcia', 'Emma Johnson', NULL, NULL, 'ATFMU2034U', '119518382852', '1992-12-31', '2015-12-31', NULL, 'michael.sharma647@example.com', NULL, '2024-12-31 05:40:50'),
(32, 'Anjali Garcia', 'Rahul Garcia', 'Mary Johnson', NULL, NULL, 'THAHE1214H', '485384488251', '1998-12-31', '2020-12-31', NULL, 'anjali.garcia746@example.com', NULL, '2024-12-31 05:40:50'),
(33, 'Amit Miller', 'Anjali Verma', 'Emma Singh', NULL, NULL, 'KIETS6668Y', '165907270666', '1990-12-31', '2016-12-31', NULL, 'amit.miller678@example.com', NULL, '2024-12-31 05:40:50'),
(34, 'Neha Johnson', 'Amit Singh', 'Neha Verma', NULL, NULL, 'FWBMP3620B', '485683664187', '1980-12-31', '2021-12-31', NULL, 'neha.johnson647@example.com', NULL, '2024-12-31 05:40:50'),
(35, 'John Gupta', 'Mary Sharma', 'John Brown', NULL, NULL, 'ONIMF5296E', '226325608720', '1997-12-31', '2018-12-31', NULL, 'john.gupta766@example.com', NULL, '2024-12-31 05:40:50'),
(36, 'Sarah Singh', 'Lisa Williams', 'Lisa Gupta', NULL, NULL, 'TUGHD1206X', '413112800197', '1986-12-31', '2016-12-31', NULL, 'sarah.singh795@example.com', NULL, '2024-12-31 05:40:50'),
(37, 'Lisa Brown', 'David Brown', 'Rahul Miller', NULL, NULL, 'BRXSY1244B', '744973023309', '1995-12-31', '2017-12-31', NULL, 'lisa.brown454@example.com', NULL, '2024-12-31 05:44:47'),
(38, 'Priya Smith', 'Sneha Davis', 'Sarah Patel', NULL, NULL, 'KVXKA4105I', '262150366331', '1994-12-31', '2021-12-31', NULL, 'priya.smith971@example.com', NULL, '2024-12-31 05:44:47'),
(39, 'Anjali Kumar', 'Jane Verma', 'Jane Davis', NULL, NULL, 'WHYRW3555R', '629204878062', '1984-12-31', '2022-12-31', NULL, 'anjali.kumar514@example.com', NULL, '2024-12-31 05:44:47'),
(40, 'John Brown', 'David Brown', 'Sarah Miller', NULL, NULL, 'NHPFE5722M', '689862510611', '1986-12-31', '2017-12-31', NULL, 'john.brown702@example.com', NULL, '2024-12-31 05:44:47'),
(41, 'Anjali Sharma', 'Jane Davis', 'Neha Miller', NULL, NULL, 'GEIJR5820B', '530014394309', '1986-12-31', '2023-12-31', NULL, 'anjali.sharma588@example.com', NULL, '2024-12-31 05:44:47'),
(42, 'Robert Patel', 'Amit Williams', 'Suresh Garcia', NULL, NULL, 'GCHEF8673Z', '833411066399', '1993-12-31', '2015-12-31', NULL, 'robert.patel864@example.com', NULL, '2024-12-31 05:44:47'),
(43, 'Sarah Patel', 'John Garcia', 'David Williams', NULL, NULL, 'RQPUX5316W', '325668528400', '1982-12-31', '2021-12-31', NULL, 'sarah.patel585@example.com', NULL, '2024-12-31 05:44:47'),
(44, 'Robert Miller', 'Raj Garcia', 'Sarah Smith', NULL, NULL, 'JNNMW8056A', '317613914173', '1979-12-31', '2018-12-31', NULL, 'robert.miller298@example.com', NULL, '2024-12-31 05:44:47'),
(45, 'John Davis', 'Michael Garcia', 'Michael Miller', NULL, NULL, 'ELLPK1941E', '492073082416', '1988-12-31', '2023-12-31', NULL, 'john.davis544@example.com', NULL, '2024-12-31 05:44:47'),
(46, 'Jane Kumar', 'David Jones', 'Neha Jones', NULL, NULL, 'ADEFV8714P', '681884631304', '1984-12-31', '2020-12-31', NULL, 'jane.kumar688@example.com', NULL, '2024-12-31 05:44:47'),
(47, 'Suresh Garcia', 'David Sharma', 'Lisa Sharma', NULL, NULL, 'VBUHB6280X', '682593608725', '1991-12-31', '2021-12-31', NULL, 'suresh.garcia886@example.com', NULL, '2024-12-31 05:44:47'),
(48, 'Suresh Smith', 'Lisa Singh', 'Rahul Williams', NULL, NULL, 'WIPXO3428W', '598007615127', '1998-12-31', '2020-12-31', NULL, 'suresh.smith223@example.com', NULL, '2024-12-31 05:44:47'),
(49, 'Sarah Garcia', 'William Sharma', 'John Johnson', NULL, NULL, 'HOARP4527M', '287608922163', '1993-12-31', '2014-12-31', NULL, 'sarah.garcia160@example.com', NULL, '2024-12-31 05:44:47'),
(50, 'Priya Davis', 'Priya Davis', 'Anjali Smith', NULL, NULL, 'NEBIX4980T', '835361717892', '1992-12-31', '2023-12-31', NULL, 'priya.davis523@example.com', NULL, '2024-12-31 05:44:47'),
(51, 'Suresh Kumar', 'Emma Johnson', 'William Garcia', NULL, NULL, 'GXAWS6073U', '449216311979', '1983-12-31', '2020-12-31', NULL, 'suresh.kumar644@example.com', NULL, '2024-12-31 05:44:47'),
(52, 'Rahul Brown', 'Rahul Johnson', 'William Verma', NULL, NULL, 'VTNVF1566K', '635472437616', '1994-12-31', '2023-12-31', NULL, 'rahul.brown992@example.com', NULL, '2024-12-31 05:44:47'),
(53, 'Raj Garcia', 'Robert Williams', 'Robert Singh', NULL, NULL, 'KRTUQ4747G', '919204216629', '1996-12-31', '2018-12-31', NULL, 'raj.garcia844@example.com', NULL, '2024-12-31 05:44:47'),
(54, 'Emma Garcia', 'Sarah Kumar', 'Sneha Kumar', NULL, NULL, 'CGNJF2381X', '875417405149', '1979-12-31', '2022-12-31', NULL, 'emma.garcia184@example.com', NULL, '2024-12-31 05:44:47'),
(55, 'Raj Davis', 'Rahul Gupta', 'Sneha Kumar', NULL, NULL, 'BCITL3061X', '937881945369', '1983-12-31', '2020-12-31', NULL, 'raj.davis429@example.com', NULL, '2024-12-31 05:44:47'),
(56, 'Jane Gupta', 'Anjali Verma', 'Michael Singh', NULL, NULL, 'DZITQ6639H', '721064882521', '1997-12-31', '2022-12-31', NULL, 'jane.gupta132@example.com', NULL, '2024-12-31 05:44:47'),
(57, 'Mary Garcia', 'Neha Davis', 'Priya Davis', NULL, NULL, 'YWVKZ4854E', '500568036466', '1993-12-31', '2018-12-31', NULL, 'mary.garcia425@example.com', NULL, '2024-12-31 05:44:51'),
(58, 'Priya Sharma', 'Emma Singh', 'David Davis', NULL, NULL, 'QDUUT7265Y', '180122599752', '1981-12-31', '2022-12-31', NULL, 'priya.sharma627@example.com', NULL, '2024-12-31 05:44:51'),
(59, 'Anjali Johnson', 'Sarah Johnson', 'Priya Verma', NULL, NULL, 'KYMSX3271N', '344973480084', '1986-12-31', '2018-12-31', NULL, 'anjali.johnson321@example.com', NULL, '2024-12-31 05:44:51'),
(60, 'David Singh', 'Suresh Gupta', 'Priya Kumar', NULL, NULL, 'SHAGM3863O', '379463385249', '1979-12-31', '2015-12-31', NULL, 'david.singh558@example.com', NULL, '2024-12-31 05:44:51'),
(61, 'Sneha Sharma', 'Emma Gupta', 'Emma Jones', NULL, NULL, 'SWZSU9968Q', '856023683268', '1991-12-31', '2023-12-31', NULL, 'sneha.sharma841@example.com', NULL, '2024-12-31 05:44:51'),
(62, 'Lisa Brown', 'Jane Gupta', 'Rahul Sharma', NULL, NULL, 'ICVGA1820B', '352446035640', '1996-12-31', '2021-12-31', NULL, 'lisa.brown415@example.com', NULL, '2024-12-31 05:44:51'),
(63, 'Neha Davis', 'Emma Garcia', 'Emma Singh', NULL, NULL, 'ERBIW4493S', '710176500429', '1985-12-31', '2022-12-31', NULL, 'neha.davis826@example.com', NULL, '2024-12-31 05:44:51'),
(64, 'Rahul Davis', 'Priya Garcia', 'David Davis', NULL, NULL, 'YDQUT7250P', '837148582118', '1991-12-31', '2021-12-31', NULL, 'rahul.davis395@example.com', NULL, '2024-12-31 05:44:51'),
(65, 'David Verma', 'Jane Sharma', 'Robert Smith', NULL, NULL, 'OLLWN8851U', '437255696016', '1984-12-31', '2019-12-31', NULL, 'david.verma367@example.com', NULL, '2024-12-31 05:44:51'),
(66, 'Sneha Patel', 'Sarah Brown', 'Sarah Garcia', NULL, NULL, 'RCFTA1896L', '339030023509', '1989-12-31', '2016-12-31', NULL, 'sneha.patel748@example.com', NULL, '2024-12-31 05:44:51'),
(67, 'William Patel', 'David Garcia', 'Amit Jones', NULL, NULL, 'YAUDC3091A', '357846503533', '1990-12-31', '2018-12-31', NULL, 'william.patel177@example.com', NULL, '2024-12-31 05:44:51'),
(68, 'Suresh Miller', 'Mary Verma', 'Jane Jones', NULL, NULL, 'BPXIS3942D', '880077878513', '1984-12-31', '2018-12-31', NULL, 'suresh.miller324@example.com', NULL, '2024-12-31 05:44:51'),
(69, 'Mary Kumar', 'Sarah Miller', 'Suresh Kumar', NULL, NULL, 'TNYBN3399K', '129606712298', '1997-12-31', '2020-12-31', NULL, 'mary.kumar351@example.com', NULL, '2024-12-31 05:44:51'),
(70, 'David Garcia', 'Anjali Johnson', 'Lisa Smith', NULL, NULL, 'JEOTH8892G', '880259534065', '1988-12-31', '2023-12-31', NULL, 'david.garcia946@example.com', NULL, '2024-12-31 05:44:51'),
(71, 'Sneha Davis', 'Mary Sharma', 'Rahul Garcia', NULL, NULL, 'MCNMM5960R', '223095167423', '1997-12-31', '2023-12-31', NULL, 'sneha.davis333@example.com', NULL, '2024-12-31 05:44:51'),
(72, 'Michael Sharma', 'Lisa Verma', 'Suresh Garcia', NULL, NULL, 'NFJGQ3827X', '779465387771', '1981-12-31', '2022-12-31', NULL, 'michael.sharma647@example.com', NULL, '2024-12-31 05:44:51'),
(73, 'Michael Gupta', 'Raj Sharma', 'Neha Jones', NULL, NULL, 'NDXQY5816D', '184921024967', '1991-12-31', '2016-12-31', NULL, 'michael.gupta816@example.com', NULL, '2024-12-31 05:44:51'),
(74, 'William Davis', 'Emma Singh', 'Mary Kumar', NULL, NULL, 'WLDOI5262H', '957087217228', '1995-12-31', '2018-12-31', NULL, 'william.davis288@example.com', NULL, '2024-12-31 05:44:51'),
(75, 'Emma Patel', 'Rahul Patel', 'Suresh Singh', NULL, NULL, 'EWLER9689V', '332469714741', '1984-12-31', '2021-12-31', NULL, 'emma.patel698@example.com', NULL, '2024-12-31 05:44:51'),
(76, 'Rahul Williams', 'Rahul Smith', 'William Sharma', NULL, NULL, 'OGLRB9291F', '964745061038', '1979-12-31', '2014-12-31', NULL, 'rahul.williams446@example.com', NULL, '2024-12-31 05:44:51'),
(77, 'William Miller', 'Amit Brown', 'Jane Kumar', NULL, NULL, 'BDRXO7534T', '866515111271', '1993-12-31', '2020-12-31', NULL, 'william.miller372@example.com', NULL, '2024-12-31 05:47:32'),
(78, 'John Verma', 'Emma Verma', 'Michael Johnson', NULL, NULL, 'GKQDZ4872S', '747221204353', '1999-12-31', '2022-12-31', NULL, 'john.verma979@example.com', NULL, '2024-12-31 05:47:32'),
(79, 'Rahul Brown', 'Michael Verma', 'Mary Davis', NULL, NULL, 'RHMBR6165M', '963006847791', '1993-12-31', '2022-12-31', NULL, 'rahul.brown721@example.com', NULL, '2024-12-31 05:47:32'),
(80, 'Mary Garcia', 'David Miller', 'Priya Gupta', NULL, NULL, 'UXPWN4924R', '612511997063', '1993-12-31', '2019-12-31', NULL, 'mary.garcia752@example.com', NULL, '2024-12-31 05:47:32'),
(81, 'Sarah Smith', 'David Garcia', 'Sneha Smith', NULL, NULL, 'NISSN9714M', '482679177863', '1991-12-31', '2015-12-31', NULL, 'sarah.smith885@example.com', NULL, '2024-12-31 05:47:32'),
(82, 'Amit Johnson', 'Neha Sharma', 'Sarah Gupta', NULL, NULL, 'KRONX1561I', '655440678820', '1992-12-31', '2020-12-31', NULL, 'amit.johnson322@example.com', NULL, '2024-12-31 05:47:32'),
(83, 'Emma Johnson', 'Mary Singh', 'William Davis', NULL, NULL, 'ACNTO9706A', '441577407689', '1998-12-31', '2018-12-31', NULL, 'emma.johnson978@example.com', NULL, '2024-12-31 05:47:32'),
(84, 'Lisa Patel', 'Sneha Smith', 'Suresh Garcia', NULL, NULL, 'UNGJL9196T', '419027108174', '1996-12-31', '2019-12-31', NULL, 'lisa.patel972@example.com', NULL, '2024-12-31 05:47:32'),
(85, 'Robert Kumar', 'Suresh Jones', 'Mary Smith', NULL, NULL, 'HSXZC9404S', '815991899048', '1983-12-31', '2015-12-31', NULL, 'robert.kumar902@example.com', NULL, '2024-12-31 05:47:32'),
(86, 'John Singh', 'David Kumar', 'Jane Johnson', NULL, NULL, 'UEZIA4829Q', '543992741343', '1992-12-31', '2021-12-31', NULL, 'john.singh743@example.com', NULL, '2024-12-31 05:47:32'),
(87, 'Robert Brown', 'David Gupta', 'Priya Garcia', NULL, NULL, 'JQPCL9103D', '551450609184', '1994-12-31', '2020-12-31', NULL, 'robert.brown725@example.com', NULL, '2024-12-31 05:47:48'),
(88, 'David Singh', 'Emma Gupta', 'Raj Williams', NULL, NULL, 'WEXIR2088H', '371436160301', '1987-12-31', '2014-12-31', NULL, 'david.singh200@example.com', NULL, '2024-12-31 05:47:48'),
(89, 'Jane Brown', 'Anjali Gupta', 'Michael Brown', NULL, NULL, 'FTDCD3442A', '703432531290', '1981-12-31', '2022-12-31', NULL, 'jane.brown808@example.com', NULL, '2024-12-31 05:47:48'),
(90, 'Anjali Sharma', 'William Brown', 'Suresh Garcia', NULL, NULL, 'LEBBD2236C', '380948922926', '1996-12-31', '2018-12-31', NULL, 'anjali.sharma321@example.com', NULL, '2024-12-31 05:47:48'),
(91, 'Neha Garcia', 'Sarah Verma', 'Lisa Brown', NULL, NULL, 'LUZBC7607V', '814041458331', '1981-12-31', '2016-12-31', NULL, 'neha.garcia787@example.com', NULL, '2024-12-31 05:47:48'),
(92, 'Priya Kumar', 'Sarah Jones', 'Priya Kumar', NULL, NULL, 'GOZLW4787K', '870450055216', '1993-12-31', '2015-12-31', NULL, 'priya.kumar422@example.com', NULL, '2024-12-31 05:47:48'),
(93, 'Suresh Singh', 'Lisa Davis', 'Robert Kumar', NULL, NULL, 'DCMYD9523C', '110952919333', '1994-12-31', '2015-12-31', NULL, 'suresh.singh315@example.com', NULL, '2024-12-31 05:47:48'),
(94, 'William Gupta', 'John Brown', 'William Singh', NULL, NULL, 'RNWXT9454B', '793052904538', '1996-12-31', '2023-12-31', NULL, 'william.gupta383@example.com', NULL, '2024-12-31 05:47:48'),
(95, 'Emma Williams', 'Raj Johnson', 'Jane Verma', NULL, NULL, 'XEGZT6639R', '740377922862', '1992-12-31', '2017-12-31', NULL, 'emma.williams836@example.com', NULL, '2024-12-31 05:47:48'),
(96, 'Lisa Davis', 'Sarah Johnson', 'Priya Davis', NULL, NULL, 'WJCKB7265T', '466952198593', '1992-12-31', '2016-12-31', NULL, 'lisa.davis743@example.com', NULL, '2024-12-31 05:47:48'),
(97, 'Anjali Patel', 'Jane Garcia', 'Anjali Kumar', NULL, NULL, 'YUUFW2996F', '511628904048', '1999-12-31', '2016-12-31', NULL, 'anjali.patel277@example.com', NULL, '2024-12-31 05:47:48'),
(98, 'Sneha Jones', 'Priya Miller', 'Lisa Verma', NULL, NULL, 'NEZYM5486I', '214938568926', '1987-12-31', '2023-12-31', NULL, 'sneha.jones559@example.com', NULL, '2024-12-31 05:47:48'),
(99, 'John Smith', 'Robert Smith', 'Emma Gupta', NULL, NULL, 'RAYQA1537Y', '957504231277', '1979-12-31', '2019-12-31', NULL, 'john.smith505@example.com', NULL, '2024-12-31 05:47:48'),
(100, 'Michael Johnson', 'Michael Gupta', 'Suresh Kumar', NULL, NULL, 'IYYQN7395P', '629971502118', '1988-12-31', '2016-12-31', NULL, 'michael.johnson690@example.com', NULL, '2024-12-31 05:47:48'),
(101, 'Robert Sharma', 'John Jones', 'Sneha Smith', NULL, NULL, 'DLCRK1070X', '766288076928', '1979-12-31', '2020-12-31', NULL, 'robert.sharma565@example.com', NULL, '2024-12-31 05:47:48'),
(102, 'Lisa Smith', 'William Garcia', 'Sneha Johnson', NULL, NULL, 'CGIJW3221E', '642833008396', '1982-12-31', '2022-12-31', NULL, 'lisa.smith945@example.com', NULL, '2024-12-31 05:47:48'),
(103, 'Rahul Sharma', 'Robert Williams', 'William Gupta', NULL, NULL, 'EQCMK7269D', '590920156887', '1984-12-31', '2015-12-31', NULL, 'rahul.sharma406@example.com', NULL, '2024-12-31 05:47:48'),
(104, 'Emma Kumar', 'Robert Patel', 'Suresh Kumar', NULL, NULL, 'LHNUY4259X', '215483063152', '1999-12-31', '2016-12-31', NULL, 'emma.kumar643@example.com', NULL, '2024-12-31 05:47:48'),
(105, 'Sneha Miller', 'Rahul Garcia', 'Rahul Johnson', NULL, NULL, 'BWYCQ2741V', '837460494593', '1990-12-31', '2023-12-31', NULL, 'sneha.miller628@example.com', NULL, '2024-12-31 05:47:48'),
(106, 'Michael Smith', 'Sarah Gupta', 'Lisa Williams', NULL, NULL, 'JBQDK4444Z', '527772662234', '1992-12-31', '2016-12-31', NULL, 'michael.smith155@example.com', NULL, '2024-12-31 05:47:48'),
(107, 'Neha Garcia', 'John Jones', 'Rahul Patel', NULL, NULL, 'UQLCW9399W', '623881805797', '1995-12-31', '2015-12-31', NULL, 'neha.garcia117@example.com', NULL, '2024-12-31 05:47:51'),
(108, 'Jane Williams', 'Neha Davis', 'Amit Verma', NULL, NULL, 'DTRSA3544Q', '651392429915', '1979-12-31', '2017-12-31', NULL, 'jane.williams446@example.com', NULL, '2024-12-31 05:47:51'),
(109, 'Emma Smith', 'Amit Davis', 'William Jones', NULL, NULL, 'HOMLO4473D', '308304614767', '1992-12-31', '2018-12-31', NULL, 'emma.smith177@example.com', NULL, '2024-12-31 05:47:51'),
(110, 'Lisa Johnson', 'Lisa Sharma', 'Amit Kumar', NULL, NULL, 'UQCFM4131X', '517872318743', '1986-12-31', '2020-12-31', NULL, 'lisa.johnson450@example.com', NULL, '2024-12-31 05:47:51'),
(111, 'Emma Brown', 'Sarah Verma', 'Neha Miller', NULL, NULL, 'LRAWN5450T', '436530232769', '1984-12-31', '2016-12-31', NULL, 'emma.brown123@example.com', NULL, '2024-12-31 05:47:51'),
(112, 'Michael Smith', 'Anjali Sharma', 'David Williams', NULL, NULL, 'OPGJT1180G', '653369525441', '1990-12-31', '2017-12-31', NULL, 'michael.smith630@example.com', NULL, '2024-12-31 05:47:51'),
(113, 'Priya Davis', 'Emma Johnson', 'William Kumar', NULL, NULL, 'CFTTC5469Q', '211989549759', '1987-12-31', '2014-12-31', NULL, 'priya.davis257@example.com', NULL, '2024-12-31 05:47:51'),
(114, 'David Jones', 'John Miller', 'John Kumar', NULL, NULL, 'TONJC1481Y', '342032317877', '1992-12-31', '2016-12-31', NULL, 'david.jones926@example.com', NULL, '2024-12-31 05:47:51'),
(115, 'Sarah Williams', 'Neha Garcia', 'Michael Singh', NULL, NULL, 'WNMPL3526R', '228145311571', '1981-12-31', '2019-12-31', NULL, 'sarah.williams398@example.com', NULL, '2024-12-31 05:47:51'),
(116, 'Suresh Brown', 'Amit Garcia', 'Emma Brown', NULL, NULL, 'HLIBF7214Q', '564649131823', '1994-12-31', '2021-12-31', NULL, 'suresh.brown487@example.com', NULL, '2024-12-31 05:47:51'),
(117, 'Lisa Miller', 'Raj Johnson', 'Emma Williams', NULL, NULL, 'JHPQO3547E', '107266075798', '1997-12-31', '2021-12-31', NULL, 'lisa.miller626@example.com', NULL, '2024-12-31 05:47:51'),
(118, 'Robert Sharma', 'Amit Sharma', 'Emma Singh', NULL, NULL, 'SZJKB3981P', '870243746528', '1981-12-31', '2015-12-31', NULL, 'robert.sharma641@example.com', NULL, '2024-12-31 05:47:51'),
(119, 'John Verma', 'Anjali Jones', 'William Patel', NULL, NULL, 'LTXMZ6529U', '184135795863', '1995-12-31', '2022-12-31', NULL, 'john.verma422@example.com', NULL, '2024-12-31 05:47:51'),
(120, 'Rahul Verma', 'Priya Davis', 'Priya Singh', NULL, NULL, 'RHKIJ7865X', '939241451286', '1988-12-31', '2015-12-31', NULL, 'rahul.verma591@example.com', NULL, '2024-12-31 05:47:51'),
(121, 'Priya Gupta', 'Emma Gupta', 'Lisa Verma', NULL, NULL, 'SRGGN9096M', '968494899443', '1984-12-31', '2021-12-31', NULL, 'priya.gupta587@example.com', NULL, '2024-12-31 05:47:51'),
(122, 'Lisa Smith', 'Lisa Singh', 'John Gupta', NULL, NULL, 'NDQFJ5802G', '669276167875', '1999-12-31', '2022-12-31', NULL, 'lisa.smith597@example.com', NULL, '2024-12-31 05:47:51'),
(123, 'Neha Miller', 'Priya Smith', 'Raj Singh', NULL, NULL, 'QVWCV6420J', '948957791478', '1982-12-31', '2021-12-31', NULL, 'neha.miller480@example.com', NULL, '2024-12-31 05:47:51'),
(124, 'Amit Garcia', 'John Sharma', 'John Garcia', NULL, NULL, 'ISLEP6688X', '364416448250', '1983-12-31', '2015-12-31', NULL, 'amit.garcia484@example.com', NULL, '2024-12-31 05:47:51'),
(125, 'Amit Davis', 'Lisa Kumar', 'Priya Miller', NULL, NULL, 'HLFDG4291B', '669407741608', '1988-12-31', '2018-12-31', NULL, 'amit.davis891@example.com', NULL, '2024-12-31 05:47:51'),
(126, 'David Brown', 'Mary Smith', 'David Jones', NULL, NULL, 'SQUZF8642Q', '330724785584', '1998-12-31', '2020-12-31', NULL, 'david.brown270@example.com', NULL, '2024-12-31 05:47:51'),
(127, 'Sarah Davis', 'Robert Gupta', 'Sneha Davis', NULL, NULL, '', '206241803002', '1997-12-31', '2018-12-31', NULL, 'sarah.davis686@example.com', NULL, '2024-12-31 08:39:56'),
(128, 'Jane Gupta', 'Sarah Kumar', 'Michael Johnson', NULL, NULL, '', '106178284812', '1990-12-31', '2015-12-31', NULL, 'jane.gupta392@example.com', NULL, '2024-12-31 08:39:56'),
(129, 'Suresh Brown', 'Neha Williams', 'Anjali Garcia', NULL, NULL, '', '619122406734', '1985-12-31', '2020-12-31', NULL, 'suresh.brown686@example.com', NULL, '2024-12-31 08:39:56'),
(130, 'Lisa Brown', 'Sarah Singh', 'Sarah Verma', NULL, NULL, '', '684465892357', '1992-12-31', '2019-12-31', NULL, 'lisa.brown867@example.com', NULL, '2024-12-31 08:39:56'),
(131, 'Amit Davis', 'Neha Johnson', 'William Davis', NULL, NULL, '', '559520641911', '1987-12-31', '2022-12-31', NULL, 'amit.davis264@example.com', NULL, '2024-12-31 08:39:56'),
(132, 'Sarah Miller', 'Neha Jones', 'Sarah Johnson', NULL, NULL, '', '871031472831', '1979-12-31', '2022-12-31', NULL, 'sarah.miller692@example.com', NULL, '2024-12-31 08:39:56'),
(133, 'Mary Davis', 'Robert Patel', 'Anjali Gupta', NULL, NULL, '', '296682913680', '1981-12-31', '2023-12-31', NULL, 'mary.davis117@example.com', NULL, '2024-12-31 08:39:56'),
(134, 'Mary Garcia', 'Anjali Singh', 'Neha Sharma', NULL, NULL, '', '256657363115', '1999-12-31', '2019-12-31', NULL, 'mary.garcia519@example.com', NULL, '2024-12-31 08:39:56'),
(135, 'Amit Garcia', 'Emma Patel', 'Neha Williams', NULL, NULL, '', '867636712453', '1991-12-31', '2022-12-31', NULL, 'amit.garcia907@example.com', NULL, '2024-12-31 08:39:56'),
(136, 'Sneha Gupta', 'Priya Gupta', 'Anjali Patel', NULL, NULL, '', '536197651012', '1985-12-31', '2020-12-31', NULL, 'sneha.gupta400@example.com', NULL, '2024-12-31 08:39:56'),
(137, 'Jane Singh', 'Suresh Gupta', 'Jane Gupta', NULL, NULL, '', '334296238130', '1981-12-31', '2017-12-31', NULL, 'jane.singh400@example.com', NULL, '2024-12-31 08:39:56'),
(138, 'Sarah Kumar', 'William Garcia', 'Neha Verma', NULL, NULL, '', '781735352255', '1989-12-31', '2018-12-31', NULL, 'sarah.kumar879@example.com', NULL, '2024-12-31 08:39:56'),
(139, 'Amit Johnson', 'Sarah Patel', 'Anjali Garcia', NULL, NULL, '', '133253917892', '1991-12-31', '2014-12-31', NULL, 'amit.johnson160@example.com', NULL, '2024-12-31 08:39:56'),
(140, 'William Johnson', 'Jane Sharma', 'Anjali Brown', NULL, NULL, '', '316720865074', '1991-12-31', '2017-12-31', NULL, 'william.johnson242@example.com', NULL, '2024-12-31 08:39:56'),
(141, 'Raj Johnson', 'Neha Gupta', 'Emma Garcia', NULL, NULL, '', '865068292930', '1990-12-31', '2020-12-31', NULL, 'raj.johnson237@example.com', NULL, '2024-12-31 08:39:56'),
(142, 'Anjali Patel', 'Robert Davis', 'Neha Smith', NULL, NULL, '', '578103629496', '1995-12-31', '2021-12-31', NULL, 'anjali.patel812@example.com', NULL, '2024-12-31 08:39:56'),
(143, 'Neha Patel', 'David Sharma', 'Sneha Singh', NULL, NULL, '', '132430259147', '1998-12-31', '2019-12-31', NULL, 'neha.patel939@example.com', NULL, '2024-12-31 08:39:56'),
(144, 'Emma Williams', 'Raj Sharma', 'William Miller', NULL, NULL, '', '829440352508', '1989-12-31', '2015-12-31', NULL, 'emma.williams335@example.com', NULL, '2024-12-31 08:39:56'),
(145, 'Suresh Davis', 'Mary Singh', 'Sneha Kumar', NULL, NULL, '', '389495072676', '1996-12-31', '2023-12-31', NULL, 'suresh.davis556@example.com', NULL, '2024-12-31 08:39:56'),
(146, 'Priya Miller', 'Michael Kumar', 'Mary Johnson', NULL, NULL, '', '291184259670', '1982-12-31', '2017-12-31', NULL, 'priya.miller983@example.com', NULL, '2024-12-31 08:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `employee_skills`
--

CREATE TABLE `employee_skills` (
  `skill_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `skill` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `legislative_data`
--

CREATE TABLE `legislative_data` (
  `legis_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `block` varchar(100) DEFAULT NULL,
  `constituency` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `previous_company`
--

CREATE TABLE `previous_company` (
  `prev_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `previous_designation` varchar(100) DEFAULT NULL,
  `years_of_service` decimal(4,2) DEFAULT NULL,
  `reason_for_leaving` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_profile`
--

CREATE TABLE `salary_profile` (
  `salary_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `provident_fund` decimal(10,2) DEFAULT NULL,
  `gratuity` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `dearness_allowance` decimal(10,2) DEFAULT NULL,
  `travel_allowance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary_profile`
--

INSERT INTO `salary_profile` (`salary_id`, `emp_id`, `provident_fund`, `gratuity`, `tax`, `dearness_allowance`, `travel_allowance`) VALUES
(1, 1, 1500.00, 3000.00, 200.00, 500.00, 100.00),
(2, 2, 2000.00, 4000.00, 300.00, 600.00, 200.00),
(7, 4, 1500.00, 3000.00, 200.00, 500.00, 100.00),
(8, 5, 2000.00, 4000.00, 300.00, 600.00, 200.00),
(9, 6, 2500.00, 3500.00, 250.00, 550.00, 150.00),
(10, 7, 1800.00, 2900.00, 220.00, 450.00, 120.00),
(11, 17, 165483.72, 66331.39, 317177.13, 137903.10, 37535.00),
(12, 18, 177940.44, 71324.46, 385537.62, 148283.70, 31830.00),
(13, 19, 51099.48, 20482.37, 68132.64, 42582.90, 36769.00),
(14, 20, 94701.60, 37959.56, 78918.00, 78918.00, 58088.00),
(15, 21, 71053.92, 28480.78, 159871.32, 59211.60, 28275.00),
(16, 22, 134946.24, 54090.95, 326120.08, 112455.20, 46108.00),
(17, 23, 155320.20, 62257.51, 310640.40, 129433.50, 59022.00),
(18, 24, 144334.80, 57854.20, 288669.60, 120279.00, 47374.00),
(19, 25, 92653.68, 37138.68, 77211.40, 77211.40, 54613.00),
(20, 26, 47690.04, 19115.76, 95380.08, 39741.70, 49018.00),
(21, 27, 70999.08, 28458.80, 118331.80, 59165.90, 52567.00),
(22, 28, 142566.96, 57145.59, 285133.92, 118805.80, 57071.00),
(23, 29, 67087.20, 26890.79, 100630.80, 55906.00, 44313.00),
(24, 30, 89460.72, 35858.84, 126736.02, 74550.60, 34789.00),
(25, 31, 105926.16, 42458.74, 114753.34, 88271.80, 36842.00),
(26, 32, 88089.96, 35309.39, 161498.26, 73408.30, 33374.00),
(27, 33, 58021.92, 23257.12, 87032.88, 48351.60, 31074.00),
(28, 34, 161584.80, 64768.57, 175050.20, 134654.00, 58172.00),
(29, 35, 63115.20, 25298.68, 110451.60, 52596.00, 33899.00),
(30, 36, 143558.16, 57542.90, 311042.68, 119631.80, 45039.00),
(31, 37, 177089.04, 70983.19, 368935.50, 147574.20, 51842.00),
(32, 38, 67813.92, 27182.08, 113023.20, 56511.60, 50015.00),
(33, 39, 101378.76, 40635.99, 236550.44, 84482.30, 55931.00),
(34, 40, 89892.84, 36032.05, 172294.61, 74910.70, 55688.00),
(35, 41, 173574.60, 69574.49, 231432.80, 144645.50, 52005.00),
(36, 42, 72065.04, 28886.07, 96086.72, 60054.20, 41324.00),
(37, 43, 76426.56, 30634.31, 82795.44, 63688.80, 46633.00),
(38, 44, 157702.32, 63212.35, 328546.50, 131418.60, 39918.00),
(39, 45, 70687.44, 28333.88, 94249.92, 58906.20, 49721.00),
(40, 46, 159619.20, 63980.70, 292635.20, 133016.00, 51083.00),
(41, 47, 153122.64, 61376.66, 280724.84, 127602.20, 53243.00),
(42, 48, 80534.76, 32281.02, 147647.06, 67112.30, 25633.00),
(43, 49, 91647.96, 36735.56, 76373.30, 76373.30, 25532.00),
(44, 50, 49920.60, 20009.84, 108161.30, 41600.50, 26006.00),
(45, 51, 95391.36, 38236.04, 111289.92, 79492.80, 51087.00),
(46, 52, 179512.44, 71954.57, 418862.36, 149593.70, 32651.00),
(47, 53, 118897.68, 47658.15, 99081.40, 99081.40, 43097.00),
(48, 54, 68654.04, 27518.83, 91538.72, 57211.70, 36514.00),
(49, 55, 127838.16, 51241.80, 181104.06, 106531.80, 46410.00),
(50, 56, 53668.20, 21512.00, 53668.20, 44723.50, 58821.00),
(51, 57, 48709.56, 19524.42, 81182.60, 40591.30, 48667.00),
(52, 58, 57349.32, 22987.52, 105140.42, 47791.10, 26793.00),
(53, 59, 77301.24, 30984.91, 109510.09, 64417.70, 51533.00),
(54, 60, 53715.84, 21531.10, 89526.40, 44763.20, 47955.00),
(55, 61, 60812.76, 24375.78, 152031.90, 50677.30, 44187.00),
(56, 62, 152672.64, 61196.28, 241731.68, 127227.20, 42749.00),
(57, 63, 146184.48, 58595.61, 280186.92, 121820.40, 40145.00),
(58, 64, 163555.68, 65558.57, 313481.72, 136296.40, 41560.00),
(59, 65, 64827.96, 25985.21, 151265.24, 54023.30, 24523.00),
(60, 66, 158450.76, 63512.35, 343309.98, 132042.30, 36715.00),
(61, 67, 145193.88, 58198.55, 266188.78, 120994.90, 34430.00),
(62, 68, 120277.80, 48211.35, 220509.30, 100231.50, 58668.00),
(63, 69, 163366.08, 65482.57, 326732.16, 136138.40, 39759.00),
(64, 70, 152879.88, 61279.35, 254799.80, 127399.90, 31801.00),
(65, 71, 67797.12, 27175.35, 146893.76, 56497.60, 26622.00),
(66, 72, 36204.24, 14511.87, 51289.34, 30170.20, 26570.00),
(67, 73, 71401.32, 28620.03, 113052.09, 59501.10, 25771.00),
(68, 74, 154018.08, 61735.58, 154018.08, 128348.40, 45511.00),
(69, 75, 55012.80, 22050.96, 77934.80, 45844.00, 51204.00),
(70, 76, 111783.24, 44806.45, 195620.67, 93152.70, 50420.00),
(71, 77, 0.00, 0.00, 0.00, 0.00, 0.00),
(72, 78, 0.00, 0.00, 0.00, 0.00, 0.00),
(73, 79, 0.00, 0.00, 0.00, 0.00, 0.00),
(74, 80, 0.00, 0.00, 0.00, 0.00, 0.00),
(75, 81, 0.00, 0.00, 0.00, 0.00, 0.00),
(76, 82, 0.00, 0.00, 0.00, 0.00, 0.00),
(77, 83, 0.00, 0.00, 0.00, 0.00, 0.00),
(78, 84, 0.00, 0.00, 0.00, 0.00, 0.00),
(79, 85, 0.00, 0.00, 0.00, 0.00, 0.00),
(80, 86, 0.00, 0.00, 0.00, 0.00, 0.00),
(81, 87, 84422.04, 33839.17, 204019.93, 70351.70, 49138.00),
(82, 88, 60007.80, 24053.13, 65008.45, 50006.50, 30429.00),
(83, 89, 117959.40, 47282.06, 196599.00, 98299.50, 32963.00),
(84, 90, 135428.64, 54284.31, 225714.40, 112857.20, 30689.00),
(85, 91, 155695.80, 62408.07, 311391.60, 129746.50, 46958.00),
(86, 92, 154039.20, 61744.05, 154039.20, 128366.00, 57677.00),
(87, 93, 45453.12, 18219.13, 64391.92, 37877.60, 58390.00),
(88, 94, 162393.24, 65092.62, 324786.48, 135327.70, 44602.00),
(89, 95, 136490.88, 54710.09, 204736.32, 113742.40, 41690.00),
(90, 96, 141322.56, 56646.79, 294422.00, 117768.80, 27587.00),
(91, 97, 147873.60, 59272.67, 221810.40, 123228.00, 35335.00),
(92, 98, 43666.44, 17502.96, 98249.49, 36388.70, 50589.00),
(93, 99, 40303.20, 16154.87, 83965.00, 33586.00, 43252.00),
(94, 100, 164147.64, 65795.85, 259900.43, 136789.70, 56016.00),
(95, 101, 91593.72, 36713.82, 137390.58, 76328.10, 42950.00),
(96, 102, 53158.68, 21307.77, 44298.90, 44298.90, 51302.00),
(97, 103, 168453.12, 67521.63, 322868.48, 140377.60, 37717.00),
(98, 104, 156330.84, 62662.61, 325689.25, 130275.70, 49166.00),
(99, 105, 60025.44, 24060.20, 140059.36, 50021.20, 39576.00),
(100, 106, 51139.92, 20498.58, 106541.50, 42616.60, 33139.00),
(101, 107, 145095.84, 58159.25, 193461.12, 120913.20, 27947.00),
(102, 108, 106596.36, 42727.37, 142128.48, 88830.30, 41367.00),
(103, 109, 37275.00, 14941.06, 62125.00, 31062.50, 47355.00),
(104, 110, 42484.56, 17029.23, 56646.08, 35403.80, 44572.00),
(105, 111, 114834.48, 46029.49, 95695.40, 95695.40, 46437.00),
(106, 112, 73547.64, 29480.35, 147095.28, 61289.70, 27029.00),
(107, 113, 129440.16, 51883.93, 183373.56, 107866.80, 37483.00),
(108, 114, 143856.36, 57662.42, 239760.60, 119880.30, 32539.00),
(109, 115, 140513.88, 56322.65, 292737.25, 117094.90, 33601.00),
(110, 116, 162966.96, 65322.59, 176547.54, 135805.80, 31297.00),
(111, 117, 121033.32, 48514.19, 131119.43, 100861.10, 47992.00),
(112, 118, 114388.92, 45850.89, 123921.33, 95324.10, 57433.00),
(113, 119, 147765.48, 59229.33, 270903.38, 123137.90, 35115.00),
(114, 120, 59301.60, 23770.06, 59301.60, 49418.00, 45926.00),
(115, 121, 81320.28, 32595.88, 74543.59, 67766.90, 52802.00),
(116, 122, 159612.60, 63978.05, 146311.55, 133010.50, 58179.00),
(117, 123, 104083.80, 41720.26, 156125.70, 86736.50, 28352.00),
(118, 124, 40406.16, 16196.14, 101015.40, 33671.80, 58157.00),
(119, 125, 65620.80, 26303.00, 114836.40, 54684.00, 56907.00),
(120, 126, 47387.16, 18994.35, 118467.90, 39489.30, 29807.00),
(121, 127, 101798.28, 40804.14, 195113.37, 84831.90, 40323.00),
(122, 128, 58556.64, 23471.45, 87834.96, 48797.20, 39187.00),
(123, 129, 158270.52, 63440.10, 158270.52, 131892.10, 54762.00),
(124, 130, 72639.00, 29116.13, 127118.25, 60532.50, 42816.00),
(125, 131, 120322.92, 48229.44, 200538.20, 100269.10, 37572.00),
(126, 132, 85862.28, 34416.46, 157414.18, 71551.90, 29917.00),
(127, 133, 145679.16, 58393.06, 145679.16, 121399.30, 39427.00),
(128, 134, 52575.24, 21073.91, 100769.21, 43812.70, 55396.00),
(129, 135, 60016.20, 24056.49, 105028.35, 50013.50, 53035.00),
(130, 136, 111035.64, 44506.79, 175806.43, 92529.70, 44605.00),
(131, 137, 98144.28, 39339.50, 204467.25, 81786.90, 33053.00),
(132, 138, 107683.92, 43163.30, 224341.50, 89736.60, 33818.00),
(133, 139, 168543.84, 67557.99, 407314.28, 140453.20, 28469.00),
(134, 140, 117175.44, 46967.82, 292938.60, 97646.20, 39357.00),
(135, 141, 76352.88, 30604.78, 95441.10, 63627.40, 26416.00),
(136, 142, 96580.80, 38712.80, 241452.00, 80484.00, 48525.00),
(137, 143, 115624.56, 46346.18, 231249.12, 96353.80, 39625.00),
(138, 144, 127668.00, 51173.59, 223419.00, 106390.00, 43570.00),
(139, 145, 131256.60, 52612.02, 109380.50, 109380.50, 32241.00),
(140, 146, 67851.84, 27197.28, 158320.96, 56543.20, 25837.00);

-- --------------------------------------------------------

--
-- Table structure for table `work_profile`
--

CREATE TABLE `work_profile` (
  `work_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `current_designation` varchar(100) DEFAULT NULL,
  `joining_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_profile`
--

INSERT INTO `work_profile` (`work_id`, `emp_id`, `current_designation`, `joining_date`) VALUES
(1, 1, 'CEO', '2020-01-01'),
(2, 2, 'Project Manager', '2021-06-01'),
(7, 4, 'CEO', '2020-01-01'),
(8, 5, 'Project Manager', '2021-06-01'),
(9, 6, 'HR Manager', '2018-11-15'),
(10, 7, 'Marketing Manager', '2017-04-25'),
(11, 17, 'Sales Executive', '2018-12-31'),
(12, 18, 'Sales Executive', '2015-12-31'),
(13, 19, 'Technical Writer', '2014-12-31'),
(14, 20, 'HR Manager', '2019-12-31'),
(15, 21, 'Marketing Manager', '2016-12-31'),
(16, 22, 'HR Manager', '2017-12-31'),
(17, 23, 'Marketing Manager', '2020-12-31'),
(18, 24, 'Quality Analyst', '2017-12-31'),
(19, 25, 'Sales Executive', '2019-12-31'),
(20, 26, 'HR Manager', '2023-12-31'),
(21, 27, 'Software Engineer', '2015-12-31'),
(22, 28, 'System Administrator', '2022-12-31'),
(23, 29, 'Business Analyst', '2021-12-31'),
(24, 30, 'Software Engineer', '2015-12-31'),
(25, 31, 'Sales Executive', '2015-12-31'),
(26, 32, 'Marketing Manager', '2020-12-31'),
(27, 33, 'Sales Executive', '2016-12-31'),
(28, 34, 'Team Lead', '2021-12-31'),
(30, 36, 'Team Lead', '2016-12-31'),
(31, 37, 'Sales Executive', '2017-12-31'),
(32, 38, 'Quality Analyst', '2021-12-31'),
(33, 39, 'Software Engineer', '2022-12-31'),
(34, 40, 'Quality Analyst', '2017-12-31'),
(35, 41, 'Sales Executive', '2023-12-31'),
(36, 42, 'Marketing Manager', '2015-12-31'),
(37, 43, 'Software Engineer', '2021-12-31'),
(38, 44, 'System Administrator', '2018-12-31'),
(39, 45, 'Technical Writer', '2023-12-31'),
(40, 46, 'Technical Writer', '2020-12-31'),
(41, 47, 'Quality Analyst', '2021-12-31'),
(42, 48, 'Sales Executive', '2020-12-31'),
(43, 49, 'Team Lead', '2014-12-31'),
(44, 50, 'Software Engineer', '2023-12-31'),
(45, 51, 'Quality Analyst', '2020-12-31'),
(46, 52, 'Quality Analyst', '2023-12-31'),
(47, 53, 'HR Manager', '2018-12-31'),
(48, 54, 'Marketing Manager', '2022-12-31'),
(49, 55, 'Sales Executive', '2020-12-31'),
(50, 56, 'Marketing Manager', '2022-12-31'),
(51, 57, 'Sales Executive', '2018-12-31'),
(52, 58, 'Sales Executive', '2022-12-31'),
(53, 59, 'Team Lead', '2018-12-31'),
(54, 60, 'Quality Analyst', '2015-12-31'),
(55, 61, 'Technical Writer', '2023-12-31'),
(56, 62, 'Software Engineer', '2021-12-31'),
(57, 63, 'HR Manager', '2022-12-31'),
(58, 64, 'Marketing Manager', '2021-12-31'),
(59, 65, 'Project Manager', '2019-12-31'),
(60, 66, 'Marketing Manager', '2016-12-31'),
(61, 67, 'Marketing Manager', '2018-12-31'),
(62, 68, 'HR Manager', '2018-12-31'),
(63, 69, 'Marketing Manager', '2020-12-31'),
(64, 70, 'Sales Executive', '2023-12-31'),
(65, 71, 'Quality Analyst', '2023-12-31'),
(66, 72, 'Software Engineer', '2022-12-31'),
(67, 73, 'Team Lead', '2016-12-31'),
(68, 74, 'Software Engineer', '2018-12-31'),
(69, 75, 'Marketing Manager', '2021-12-31'),
(70, 76, 'Project Manager', '2014-12-31'),
(71, 77, '', '0000-00-00'),
(72, 78, '', '0000-00-00'),
(73, 79, '', '0000-00-00'),
(74, 80, '', '0000-00-00'),
(75, 81, '', '0000-00-00'),
(76, 82, '', '0000-00-00'),
(77, 83, '', '0000-00-00'),
(78, 84, '', '0000-00-00'),
(79, 85, '', '0000-00-00'),
(80, 86, '', '0000-00-00'),
(81, 87, 'Marketing Manager', '2020-12-31'),
(82, 88, 'Marketing Manager', '2014-12-31'),
(83, 89, 'Team Lead', '2022-12-31'),
(84, 90, 'Software Engineer', '2018-12-31'),
(85, 91, 'Software Engineer', '2016-12-31'),
(86, 92, 'HR Manager', '2015-12-31'),
(87, 93, 'System Administrator', '2015-12-31'),
(88, 94, 'HR Manager', '2023-12-31'),
(89, 95, 'Technical Writer', '2017-12-31'),
(90, 96, 'HR Manager', '2016-12-31'),
(91, 97, 'Software Engineer', '2016-12-31'),
(92, 98, 'HR Manager', '2023-12-31'),
(93, 99, 'HR Manager', '2019-12-31'),
(94, 100, 'Business Analyst', '2016-12-31'),
(95, 101, 'Team Lead', '2020-12-31'),
(96, 102, 'Technical Writer', '2022-12-31'),
(97, 103, 'Software Engineer', '2015-12-31'),
(98, 104, 'Software Engineer', '2016-12-31'),
(99, 105, 'Software Engineer', '2023-12-31'),
(100, 106, 'System Administrator', '2016-12-31'),
(101, 107, 'Technical Writer', '2015-12-31'),
(102, 108, 'Sales Executive', '2017-12-31'),
(103, 109, 'Business Analyst', '2018-12-31'),
(104, 110, 'System Administrator', '2020-12-31'),
(105, 111, 'Software Engineer', '2016-12-31'),
(106, 112, 'Marketing Manager', '2017-12-31'),
(107, 113, 'System Administrator', '2014-12-31'),
(108, 114, 'Software Engineer', '2016-12-31'),
(109, 115, 'Marketing Manager', '2019-12-31'),
(110, 116, 'Technical Writer', '2021-12-31'),
(111, 117, 'System Administrator', '2021-12-31'),
(112, 118, 'Sales Executive', '2015-12-31'),
(113, 119, 'System Administrator', '2022-12-31'),
(114, 120, 'System Administrator', '2015-12-31'),
(115, 121, 'Software Engineer', '2021-12-31'),
(116, 122, 'Quality Analyst', '2022-12-31'),
(117, 123, 'Team Lead', '2021-12-31'),
(118, 124, 'System Administrator', '2015-12-31'),
(119, 125, 'HR Manager', '2018-12-31'),
(120, 126, 'Team Lead', '2020-12-31'),
(121, 127, 'Team Lead', '2018-12-31'),
(122, 128, 'System Administrator', '2015-12-31'),
(123, 129, 'Sales Executive', '2020-12-31'),
(124, 130, 'Sales Executive', '2019-12-31'),
(125, 131, 'Project Manager', '2022-12-31'),
(126, 132, 'Project Manager', '2022-12-31'),
(127, 133, 'HR Manager', '2023-12-31'),
(128, 134, 'Team Lead', '2019-12-31'),
(129, 135, 'Team Lead', '2022-12-31'),
(130, 136, 'Business Analyst', '2020-12-31'),
(131, 137, 'System Administrator', '2017-12-31'),
(132, 138, 'System Administrator', '2018-12-31'),
(133, 139, 'HR Manager', '2014-12-31'),
(134, 140, 'HR Manager', '2017-12-31'),
(135, 141, 'Sales Executive', '2020-12-31'),
(136, 142, 'Marketing Manager', '2021-12-31'),
(137, 143, 'Project Manager', '2019-12-31'),
(138, 144, 'Marketing Manager', '2015-12-31'),
(139, 145, 'Software Engineer', '2023-12-31'),
(140, 146, 'Team Lead', '2017-12-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `employee_profile`
--
ALTER TABLE `employee_profile`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `employee_skills`
--
ALTER TABLE `employee_skills`
  ADD PRIMARY KEY (`skill_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `legislative_data`
--
ALTER TABLE `legislative_data`
  ADD PRIMARY KEY (`legis_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `previous_company`
--
ALTER TABLE `previous_company`
  ADD PRIMARY KEY (`prev_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `salary_profile`
--
ALTER TABLE `salary_profile`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `work_profile`
--
ALTER TABLE `work_profile`
  ADD PRIMARY KEY (`work_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_profile`
--
ALTER TABLE `employee_profile`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `employee_skills`
--
ALTER TABLE `employee_skills`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `legislative_data`
--
ALTER TABLE `legislative_data`
  MODIFY `legis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `previous_company`
--
ALTER TABLE `previous_company`
  MODIFY `prev_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_profile`
--
ALTER TABLE `salary_profile`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `work_profile`
--
ALTER TABLE `work_profile`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_profile` (`emp_id`);

--
-- Constraints for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD CONSTRAINT `emergency_contacts_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_profile` (`emp_id`);

--
-- Constraints for table `employee_skills`
--
ALTER TABLE `employee_skills`
  ADD CONSTRAINT `employee_skills_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_profile` (`emp_id`);

--
-- Constraints for table `legislative_data`
--
ALTER TABLE `legislative_data`
  ADD CONSTRAINT `legislative_data_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_profile` (`emp_id`);

--
-- Constraints for table `previous_company`
--
ALTER TABLE `previous_company`
  ADD CONSTRAINT `previous_company_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_profile` (`emp_id`);

--
-- Constraints for table `salary_profile`
--
ALTER TABLE `salary_profile`
  ADD CONSTRAINT `salary_profile_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_profile` (`emp_id`);

--
-- Constraints for table `work_profile`
--
ALTER TABLE `work_profile`
  ADD CONSTRAINT `work_profile_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee_profile` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
