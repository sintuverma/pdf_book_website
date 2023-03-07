-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2023 at 06:55 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `books`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookuser`
--

CREATE TABLE `bookuser` (
  `uid` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_cover` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `book_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookuser`
--

INSERT INTO `bookuser` (`uid`, `fullname`, `mobile`, `password`, `email`, `book_title`, `book_cover`, `pdf_file`, `book_desc`) VALUES
(1, 'javap', '8090587674', '25d55ad283aa400af464c76d713c07ad', 'email not available', 'java book for learning', 'cover_java.jpg', 'JAVA_ Easy Java Programming for Beginners, Your Step-By-Step Guide to Learning Java Programming ( PDFDrive ).pdf', 'this is simple and easy book for learning'),
(2, 'php book', '8081718214', '25d55ad283aa400af464c76d713c07ad', 'email not available', 'title is not available', 'php_cover.jpg', 'PHP Programming_ PHP Crush Course! Learn PHP Programming in 4 hours! PHP for Beginners ( PDFDrive ).pdf', 'no decsription available');

-- --------------------------------------------------------

--
-- Table structure for table `book_table`
--

CREATE TABLE `book_table` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_cover` varchar(255) NOT NULL,
  `book_file` varchar(255) NOT NULL,
  `book_size` varchar(10) NOT NULL,
  `book_pages` varchar(10) NOT NULL,
  `book_desc` text NOT NULL,
  `upload_date` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_table`
--

INSERT INTO `book_table` (`book_id`, `book_title`, `book_cover`, `book_file`, `book_size`, `book_pages`, `book_desc`, `upload_date`, `user_id`) VALUES
(1, 'PHP Book', 'php_cover.jpg', 'PHP Programming_ PHP Crush Course! Learn PHP Programming in 4 hours! PHP for Beginners ( PDFDrive ).pdf', '784', '147', 'All time best books for learn PHP', '04-Mar-2023', 1),
(2, 'Java Book', 'cover_java.jpg', 'JAVA_ Easy Java Programming for Beginners, Your Step-By-Step Guide to Learning Java Programming ( PDFDrive ).pdf', '2404', '104', 'simplest easy to understand this book', '04-Mar-2023', 2);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_date` datetime NOT NULL,
  `book_comment` text NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_date`, `book_comment`, `book_id`, `user_id`, `username`) VALUES
(1, '2023-03-07 11:09:02', '  sintu verma 8090587674 id =1 php updatoooooo', 1, 1, 'vinod kumar verma'),
(2, '2023-03-06 17:37:36', '8090587674 id =1 java book', 2, 1, 'vinod kumar verma'),
(3, '2023-03-06 18:02:50', '8081718214 id = 2  sintu verma java book ', 2, 2, 'sintu verma'),
(4, '2023-03-06 18:03:38', '8081718214 id = 2 sintu verma  php book.', 1, 2, 'sintu verma'),
(5, '2023-03-06 20:56:38', 'i have..', 1, 1, 'vinod kumar verma'),
(6, '2023-03-06 21:11:25', '1222', 1, 1, 'vinod kumar verma');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `mobile`, `email`, `password`, `created_at`) VALUES
(1, 'vinod kumar verma', '8090587674', 'admin@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2023-03-04 09:22:59'),
(2, 'sintu verma', '8081718214', 'amit@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2023-03-04 22:46:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookuser`
--
ALTER TABLE `bookuser`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `book_table`
--
ALTER TABLE `book_table`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`book_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookuser`
--
ALTER TABLE `bookuser`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `book_table`
--
ALTER TABLE `book_table`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `bookuser` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
