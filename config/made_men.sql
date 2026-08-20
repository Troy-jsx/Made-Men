-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2026 at 09:36 AM
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
-- Database: `made_men`
--

-- --------------------------------------------------------

--
-- Table structure for table `mob`
--

CREATE TABLE `mob` (
  `mob_id` int(11) NOT NULL,
  `mob_name` varchar(50) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `member_cap` int(11) NOT NULL DEFAULT 30,
  `balance` int(11) NOT NULL DEFAULT 1000,
  `last_income_collection` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_toll_payment` timestamp NOT NULL DEFAULT current_timestamp(),
  `daily_toll` int(11) NOT NULL DEFAULT 200,
  `eliminated` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mob`
--

INSERT INTO `mob` (`mob_id`, `mob_name`, `image`, `member_cap`, `balance`, `last_income_collection`, `last_toll_payment`, `daily_toll`, `eliminated`) VALUES
(1, 'The Salerno Family', 'Salerno.png', 30, 1800, '2026-08-20 07:18:48', '2026-08-19 23:22:08', 2000, 0),
(2, 'The Brennan Family', 'Brennan.png', 30, 1320, '2026-08-20 07:18:48', '2026-08-19 23:22:08', 2000, 0),
(3, 'The Ishikawa-kai', 'Ishikawa.png', 30, 6400, '2026-08-20 07:18:48', '2026-08-19 23:22:08', 2000, 0),
(4, 'The Salazar Cartel', 'Salazar.png', 30, 1210, '2026-08-20 07:22:09', '2026-08-19 23:22:08', 2000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mob_unlocked_task_type`
--

CREATE TABLE `mob_unlocked_task_type` (
  `mob_id` int(11) NOT NULL,
  `task_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mob_unlocked_task_type`
--

INSERT INTO `mob_unlocked_task_type` (`mob_id`, `task_type_id`) VALUES
(1, 1),
(1, 2),
(1, 5),
(2, 1),
(2, 2),
(2, 5),
(3, 1),
(3, 2),
(3, 4),
(3, 5),
(4, 1),
(4, 2),
(4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `player_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `xp` int(11) NOT NULL DEFAULT 0,
  `cash` int(11) NOT NULL DEFAULT 0,
  `mob_id` int(11) DEFAULT NULL,
  `rank_id` int(11) NOT NULL DEFAULT 1,
  `avatar` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`player_id`, `username`, `email`, `password_hash`, `xp`, `cash`, `mob_id`, `rank_id`, `avatar`, `created_at`) VALUES
(1, 'Name', 'testeemail@gmail.com', '$2y$10$Te8DzCtTaM/UBDgAgiL5L.3ZmnCuO/RrI8sUjN.GEDLjU9hTESfle', 0, 0, NULL, 1, 'yakuzaDude.png', '2026-08-19 14:07:03'),
(2, 'Troy', 'troy@troy.troy', '$2y$10$xotZRmQs/DD/wa8ufbRG4.Sgs2dFeHhwByrJxDptt7tGmW1Y1VIC2', 20, 80, 3, 2, 'beardDude.png', '2026-08-19 16:03:56'),
(3, 'noAvatar1', 'sdafj@ltgkj.c', '$2y$10$qn6lyACEH9nZ36ne0V24uup6UuNS6PEXkN5cCbKb0gJdSR/BFPDRG', 0, 0, 3, 2, 'oldDude.png', '2026-08-19 16:12:45'),
(4, 'testPwd1', 'test1@d.z', '$2y$10$xvLiO6muHXVTOtFdmWm6p.hyqZGxyKimanozZ5hXhMMmqWm80Gw9e', 0, 0, 2, 1, 'irishWoman.png', '2026-08-19 16:16:33'),
(5, 'Hannah', 'snuggimashiljkagdfsr@l.x', '$2y$10$11JiZcucZGEMj29XxE0KNOmKVjw5LH7/UGaM6wwLsTJuihIL3Gu4C', 60, 150, 3, 3, 'fancyWoman.png', '2026-08-19 17:23:43'),
(6, 'IshikawaDude', 'bana@g.c', '$2y$10$TC5G2QppSBl81q2k6grJq.Y3xHjLUakAdbL6ngAAMEE4lq8tKkBHq', 140, 360, 3, 2, 'yakuzaDude.png', '2026-08-19 19:49:44'),
(7, 'ishikawaBoss', 'ishi@boxx.dsa', '$2y$10$OQ8.X44lWC.FFfS8QAYmAOYTvXDYIZ6oEqBM98segpVIoRyZNth3W', 0, 0, 3, 4, 'yakuzaDude.png', '2026-08-19 20:27:43'),
(8, 'ishikawaSoldier1', '1@1.1', '$2y$10$HA3/GIo73gAGpr6t7I1Y2eDStelGfaA5BsKoZEEQHeynvXd8083cO', 20, 80, 3, 2, 'beardDude.png', '2026-08-19 20:29:55'),
(9, 'ishikawaAssociate', 'ishikawaAssociate@1.2', '$2y$10$CqJ0sKaL.TWSUCZD4.0y.e3Q3mZ/xcERlQ22hHmMvo1cZbcetso0C', 20, 60, 3, 1, 'fedoraDude.png', '2026-08-19 22:59:13'),
(10, 'SalazarSacrifice', 'salazr@salazr.com', '$2y$10$bQqXuQTrL6VD.A/mJ/PCKuYD3tgZkCIsLPuHxc52/wMEiAs6kR0sO', 0, 0, 4, 3, 'irishWoman.png', '2026-08-19 23:30:18'),
(11, 'salazarAssociate', 'salazarAssociate@1.a', '$2y$10$Yo3rt/WrfjRGwKO4gorW8eslnJTo6xm1vKDJrGwh.NoZfc6akbYQu', 0, 0, 4, 1, 'oldDude.png', '2026-08-20 07:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `rank_id` int(11) NOT NULL,
  `rank_name` varchar(50) NOT NULL,
  `rank_level` int(11) NOT NULL,
  `can_vote` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`rank_id`, `rank_name`, `rank_level`, `can_vote`) VALUES
(1, 'Associate', 1, 0),
(2, 'Soldier', 2, 1),
(3, 'Capo', 3, 1),
(4, 'Underboss', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task_type_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `assigned_rank_id` int(11) NOT NULL,
  `mob_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_type_id`, `created_by`, `assigned_rank_id`, `mob_id`, `created_at`) VALUES
(9, 3, 5, 1, 3, '2026-08-19 20:05:05'),
(10, 1, 7, 3, 3, '2026-08-19 21:21:30'),
(11, 3, 5, 2, 3, '2026-08-19 21:46:54'),
(12, 4, 7, 1, 3, '2026-08-19 22:58:45'),
(13, 4, 2, 1, 3, '2026-08-19 23:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `task_assignment`
--

CREATE TABLE `task_assignment` (
  `assignment_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_assignment`
--

INSERT INTO `task_assignment` (`assignment_id`, `task_id`, `player_id`, `completed`) VALUES
(8, 9, 6, 1),
(9, 10, 5, 1),
(10, 11, 2, 1),
(11, 11, 3, 0),
(12, 11, 6, 1),
(13, 11, 8, 1),
(17, 13, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_type`
--

CREATE TABLE `task_type` (
  `task_type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `base_reward` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `unlock_cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_type`
--

INSERT INTO `task_type` (`task_type_id`, `type_name`, `base_reward`, `description`, `unlock_cost`) VALUES
(1, 'Transport Goods', 50, 'Move goods discreetly across the city.', NULL),
(2, 'Watch Street Corner', 30, 'Keep watch and report anything suspicious.', NULL),
(3, 'Mugging', 80, 'Rough someone up for quick cash.', 500),
(4, 'Pickpocketing', 60, 'Lift valuables off people without them noticing.', 300),
(5, 'Intel', 40, 'Gather information on a local business.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `territory`
--

CREATE TABLE `territory` (
  `territory_id` int(11) NOT NULL,
  `territory_name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `top_pct` decimal(5,2) NOT NULL,
  `left_pct` decimal(5,2) NOT NULL,
  `mob_id` int(11) DEFAULT NULL,
  `income_per_hour` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `territory`
--

INSERT INTO `territory` (`territory_id`, `territory_name`, `description`, `top_pct`, `left_pct`, `mob_id`, `income_per_hour`) VALUES
(1, 'Industrial Quarter', 'Rows of shuttered mills and factories, thick with smoke and secrets.', 38.00, 20.00, 1, 50),
(2, 'Factories', 'The old manufacturing district, still churning out goods under the family\'s watch.', 15.00, 15.00, 1, 50),
(3, 'The Park', 'A sprawling green space in the heart of the city, popular by day, dangerous by night.', 35.00, 85.00, 2, 40),
(4, 'Dock Alley', 'Tight backstreets near the harbour, ideal for moving goods unseen.', 75.00, 63.00, 2, 60),
(5, 'Delmonico\'s', 'A high-end restaurant that doubles as neutral ground for family meetings.', 20.00, 50.00, 3, 70),
(6, 'Downtown', 'The bustling commercial core of the city, valuable and heavily contested.', 60.00, 80.00, 3, 90),
(7, 'The Residence', 'A quiet residential block, easy to overlook but useful for laying low.', 65.00, 47.00, 4, 30),
(8, 'Shipping Depot', 'A depot at the edge of town, ripe for the taking.', 88.00, 25.00, NULL, 40);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `vote_id` int(11) NOT NULL,
  `mob_id` int(11) NOT NULL,
  `vote_type` varchar(50) NOT NULL,
  `called_by` int(11) NOT NULL,
  `target_player_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `resolved` tinyint(1) NOT NULL DEFAULT 0,
  `passed` tinyint(1) DEFAULT NULL,
  `target_territory_id` int(11) DEFAULT NULL,
  `target_task_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`vote_id`, `mob_id`, `vote_type`, `called_by`, `target_player_id`, `description`, `cost`, `resolved`, `passed`, `target_territory_id`, `target_task_type_id`) VALUES
(1, 3, 'Promotion', 7, 6, 'Promote to Soldier?', NULL, 1, 1, NULL, NULL),
(2, 3, 'Perk Unlock', 5, NULL, 'Unlock Pickpocketing training?', 300, 1, 1, NULL, 4),
(3, 3, 'Territory Takeover', 8, NULL, 'Take over Downtown?', 1800, 1, 1, 6, NULL),
(4, 3, 'Territory Takeover', 7, NULL, 'Take over The Residence?', 600, 1, 1, 7, NULL),
(5, 3, 'Territory Takeover', 7, NULL, 'Take over The Residence?', 600, 1, 0, 7, NULL),
(6, 3, 'Territory Takeover', 7, NULL, 'Take over Shipping Depot?', 800, 0, NULL, 8, NULL),
(7, 3, 'Perk Unlock', 7, NULL, 'Unlock Mugging training?', 500, 0, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `vote_cast`
--

CREATE TABLE `vote_cast` (
  `cast_id` int(11) NOT NULL,
  `vote_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `vote_value` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote_cast`
--

INSERT INTO `vote_cast` (`cast_id`, `vote_id`, `player_id`, `vote_value`) VALUES
(1, 1, 7, 1),
(2, 1, 5, 1),
(3, 1, 6, 1),
(4, 2, 5, 1),
(5, 2, 7, 1),
(6, 2, 8, 1),
(7, 2, 2, 1),
(8, 3, 8, 1),
(9, 3, 5, 1),
(10, 3, 6, 1),
(11, 3, 2, 1),
(12, 3, 9, 1),
(13, 4, 7, 1),
(14, 5, 7, 0),
(15, 5, 5, 0),
(16, 4, 5, 1),
(17, 4, 6, 1),
(18, 5, 6, 0),
(19, 5, 8, 0),
(20, 4, 8, 1),
(21, 7, 7, 1),
(22, 6, 7, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mob`
--
ALTER TABLE `mob`
  ADD PRIMARY KEY (`mob_id`);

--
-- Indexes for table `mob_unlocked_task_type`
--
ALTER TABLE `mob_unlocked_task_type`
  ADD PRIMARY KEY (`mob_id`,`task_type_id`),
  ADD KEY `task_type_id` (`task_type_id`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`player_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `rank_id` (`rank_id`),
  ADD KEY `fk_player_mob` (`mob_id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `task_type_id` (`task_type_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `assigned_rank_id` (`assigned_rank_id`),
  ADD KEY `mob_id` (`mob_id`);

--
-- Indexes for table `task_assignment`
--
ALTER TABLE `task_assignment`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `task_type`
--
ALTER TABLE `task_type`
  ADD PRIMARY KEY (`task_type_id`);

--
-- Indexes for table `territory`
--
ALTER TABLE `territory`
  ADD PRIMARY KEY (`territory_id`),
  ADD KEY `mob_id` (`mob_id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `mob_id` (`mob_id`),
  ADD KEY `called_by` (`called_by`),
  ADD KEY `target_player_id` (`target_player_id`),
  ADD KEY `fk_vote_territory` (`target_territory_id`),
  ADD KEY `fk_vote_task_type` (`target_task_type_id`);

--
-- Indexes for table `vote_cast`
--
ALTER TABLE `vote_cast`
  ADD PRIMARY KEY (`cast_id`),
  ADD KEY `vote_id` (`vote_id`),
  ADD KEY `player_id` (`player_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mob`
--
ALTER TABLE `mob`
  MODIFY `mob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `task_assignment`
--
ALTER TABLE `task_assignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `task_type`
--
ALTER TABLE `task_type`
  MODIFY `task_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `territory`
--
ALTER TABLE `territory`
  MODIFY `territory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vote_cast`
--
ALTER TABLE `vote_cast`
  MODIFY `cast_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mob_unlocked_task_type`
--
ALTER TABLE `mob_unlocked_task_type`
  ADD CONSTRAINT `mob_unlocked_task_type_ibfk_1` FOREIGN KEY (`mob_id`) REFERENCES `mob` (`mob_id`),
  ADD CONSTRAINT `mob_unlocked_task_type_ibfk_2` FOREIGN KEY (`task_type_id`) REFERENCES `task_type` (`task_type_id`);

--
-- Constraints for table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `fk_player_mob` FOREIGN KEY (`mob_id`) REFERENCES `mob` (`mob_id`),
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`rank_id`) REFERENCES `rank` (`rank_id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`task_type_id`) REFERENCES `task_type` (`task_type_id`),
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `player` (`player_id`),
  ADD CONSTRAINT `task_ibfk_3` FOREIGN KEY (`assigned_rank_id`) REFERENCES `rank` (`rank_id`),
  ADD CONSTRAINT `task_ibfk_4` FOREIGN KEY (`mob_id`) REFERENCES `mob` (`mob_id`);

--
-- Constraints for table `task_assignment`
--
ALTER TABLE `task_assignment`
  ADD CONSTRAINT `task_assignment_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`),
  ADD CONSTRAINT `task_assignment_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `player` (`player_id`);

--
-- Constraints for table `territory`
--
ALTER TABLE `territory`
  ADD CONSTRAINT `territory_ibfk_1` FOREIGN KEY (`mob_id`) REFERENCES `mob` (`mob_id`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `fk_vote_task_type` FOREIGN KEY (`target_task_type_id`) REFERENCES `task_type` (`task_type_id`),
  ADD CONSTRAINT `fk_vote_territory` FOREIGN KEY (`target_territory_id`) REFERENCES `territory` (`territory_id`),
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`mob_id`) REFERENCES `mob` (`mob_id`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`called_by`) REFERENCES `player` (`player_id`),
  ADD CONSTRAINT `vote_ibfk_3` FOREIGN KEY (`target_player_id`) REFERENCES `player` (`player_id`);

--
-- Constraints for table `vote_cast`
--
ALTER TABLE `vote_cast`
  ADD CONSTRAINT `vote_cast_ibfk_1` FOREIGN KEY (`vote_id`) REFERENCES `vote` (`vote_id`),
  ADD CONSTRAINT `vote_cast_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `player` (`player_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
