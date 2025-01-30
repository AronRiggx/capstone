-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 11:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedeat`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` int(11) NOT NULL,
  `postID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `postID`, `userID`, `content`, `timestamp`) VALUES
(8, 33, 11, 'Hii!', '2025-01-28 08:48:23');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likesID` int(11) NOT NULL,
  `postID` int(11) DEFAULT NULL,
  `commentID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `mediaType` varchar(20) DEFAULT NULL,
  `mediaURL` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postID`, `userID`, `content`, `mediaType`, `mediaURL`, `timestamp`) VALUES
(1, 1, 'Beautiful day today!', NULL, NULL, '2025-01-26 22:38:15'),
(14, 1, 'hello world', NULL, NULL, '2025-01-27 00:01:42'),
(27, 1, 'work 😤😤😤', NULL, NULL, '2025-01-27 19:37:44'),
(33, 11, 'Hello world!!!', NULL, NULL, '2025-01-28 08:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipeID` int(11) NOT NULL,
  `recipeName` varchar(255) NOT NULL,
  `category` enum('Vegetarian','Vegan','Non-Vegan') NOT NULL,
  `description` text NOT NULL,
  `instructions` text NOT NULL,
  `imagePath` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipeID`, `recipeName`, `category`, `description`, `instructions`, `imagePath`, `timestamp`, `userID`) VALUES
(5, 'Pork Imbutido with Melted Cheese', '', 'Pork Imbutido with tasty melted cheese sprinkled on top, perfect for birthdays!', 'TBA', NULL, '2025-01-28 06:49:52', 1),
(6, 'Beef Bistek', '', 'Beef bistek asdasd', 'asdasdasdasd', NULL, '2025-01-28 08:50:34', 11),
(8, 'Coleslaw with Cheese and Egg', '', 'fseefsafssfa', 'asdfasdfasdf', NULL, '2025-01-30 08:05:46', 1),
(9, 'Arrozcaldo with Spicy Peppers', '', 'asdasdasd', 'asdasdasdasd', NULL, '2025-01-30 08:06:32', 11);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT NULL,
  `age` int(10) UNSIGNED NOT NULL DEFAULT 18,
  `gender` enum('Male','Female','Other','Prefer not to say') NOT NULL DEFAULT 'Prefer not to say',
  `condition` varchar(255) DEFAULT NULL,
  `has_condition` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `email`, `password`, `firstName`, `lastName`, `bio`, `profilePicture`, `age`, `gender`, `condition`, `has_condition`) VALUES
(1, 'aronriggx', 'testmail123@test.com', '12345', 'Aron Riggx', 'Ancheta', 'backend', '474001408_1000241352147863_849569943580970266_n.jpg', 0, 'Prefer not to say', NULL, 0),
(2, 'b.almazar', 'testmail2@test.com', '12345', 'Ben', 'Almazar', 'frontend', NULL, 0, 'Prefer not to say', NULL, 0),
(3, 'jm.austria', 'testtesttest@test.com', '12345', 'John Michael', 'Austria', 'Documentation', NULL, 0, 'Prefer not to say', NULL, 0),
(4, 'd.panares', 'test123123@test.com', '12345', 'Deneb', 'Panares', 'Documentation', NULL, 0, 'Prefer not to say', NULL, 0),
(5, 'k.tangpus', 'test1test@test.com', '12345', 'Kim', 'Tangpus', 'Front end', NULL, 0, 'Prefer not to say', NULL, 0),
(6, 'sisig', 'cheesecheese@mail.com', '12345', 'cheese', 'cheeser', NULL, '341264204_615105070475946_2798124951581051518_n.jpg', 0, 'Prefer not to say', NULL, 0),
(10, 'benasaur', 'benasaur@mail.com', '12345', 'ben', 'almazar', NULL, '457629559_524420586760428_8582772303624462233_n.jpg', 0, 'Prefer not to say', NULL, 0),
(11, 'beny', 'bennyalmazar@gmail.com', '123', 'BEN', 'ALMAZAR', NULL, '341264204_615105070475946_2798124951581051518_n.jpg', 0, 'Prefer not to say', NULL, 0),
(15, 'kaine', 'kainewhite@mail.com', '$2y$10$CQh8OHeEY6CY7DEvMYe.OOo0QBBc/LUYqDpxwqzPigRspAvz7U4QO', 'white', 'woman', NULL, NULL, 78, 'Female', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `PostID` (`postID`),
  ADD KEY `UserID` (`userID`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likesID`),
  ADD KEY `PostID` (`postID`),
  ADD KEY `CommentID` (`commentID`),
  ADD KEY `UserID` (`userID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `UserID` (`userID`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipeID`),
  ADD KEY `fk_user` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`PostID`) REFERENCES `post` (`PostID`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`CommentID`) REFERENCES `comment` (`CommentID`),
  ADD CONSTRAINT `likes_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
