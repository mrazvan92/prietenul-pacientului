-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Oct 2016 la 10:26
-- Versiune server: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppacient`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` text NOT NULL,
  `value` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `answers`
--

INSERT INTO `answers` (`answer_id`, `question_id`, `answer`, `value`) VALUES
(3, 1, 'foarte multumit', 100),
(4, 1, 'multumit', 75),
(5, 1, 'Nici multumit, Nici nemultumit', 50),
(6, 1, 'nemultumit', 25),
(7, 1, 'Foarte nemultumit', 0),
(9, 2, 'foarte multumit', 100),
(10, 2, 'multumit', 75),
(11, 2, 'Nici multumit, Nici nemultumit', 50),
(12, 2, 'nemultumit', 25),
(13, 2, 'Foarte nemultumit', 0),
(14, 3, 'foarte multumit', 100),
(15, 3, 'multumit', 75),
(16, 3, 'Nici multumit, Nici nemultumit', 50),
(17, 3, 'nemultumit', 25),
(18, 3, 'Foarte nemultumit', 0),
(19, 4, 'foarte multumit', 100),
(20, 4, 'multumit', 75),
(21, 4, 'Nici multumit, Nici nemultumit', 50),
(22, 4, 'nemultumit', 25),
(23, 4, 'Foarte nemultumit', 0),
(24, 5, 'foarte multumit', 100),
(25, 5, 'multumit', 75),
(26, 5, 'Nici multumit, Nici nemultumit', 50),
(27, 5, 'nemultumit', 25),
(28, 5, 'Foarte nemultumit', 0);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `county`
--

CREATE TABLE `county` (
  `county_id` int(20) UNSIGNED NOT NULL,
  `county` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `county`
--

INSERT INTO `county` (`county_id`, `county`) VALUES
(1, 'cluj');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(20) UNSIGNED NOT NULL,
  `station_id` int(20) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `doctor_surname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `hospital`
--

CREATE TABLE `hospital` (
  `hospital_id` int(20) UNSIGNED NOT NULL,
  `county_id` int(20) DEFAULT NULL,
  `hospital` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `hospital`
--

INSERT INTO `hospital` (`hospital_id`, `county_id`, `hospital`, `address`) VALUES
(1, 1, 'spitalul judetean de urgenta cluj napoca', '');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `questionnaire`
--

CREATE TABLE `questionnaire` (
  `questionnaire_id` int(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `questionnaire`
--

INSERT INTO `questionnaire` (`questionnaire_id`, `name`, `description`) VALUES
(1, 'Formular feedback pacienti spital', '');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `questionnaire_feedback`
--

CREATE TABLE `questionnaire_feedback` (
  `questionnaire_feedback_id` int(20) UNSIGNED NOT NULL,
  `questionnaire_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `station_id` int(20) DEFAULT NULL,
  `section_id` int(20) DEFAULT NULL,
  `starttime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `questionnaire_feedback`
--

INSERT INTO `questionnaire_feedback` (`questionnaire_feedback_id`, `questionnaire_id`, `user_id`, `station_id`, `section_id`, `starttime`) VALUES
(1, 1, 1, NULL, NULL, '2016-10-09 10:42:53'),
(2, 1, 2, NULL, 1, '2016-10-09 10:43:59'),
(3, 1, 3, NULL, 1, '2016-10-09 10:44:11'),
(4, 1, 4, NULL, NULL, '2016-10-09 10:45:58'),
(5, 1, 5, NULL, 1, '2016-10-09 10:46:26'),
(6, 1, 6, NULL, 1, '2016-10-09 10:51:05'),
(7, 1, 7, NULL, 1, '2016-10-09 10:51:30'),
(8, 1, 8, NULL, 1, '2016-10-09 10:52:16'),
(9, 1, 9, NULL, 1, '2016-10-09 10:53:42'),
(10, 1, 10, NULL, 1, '2016-10-09 10:54:50'),
(11, 1, 11, NULL, 1, '2016-10-09 10:54:53'),
(12, 1, 12, NULL, 1, '2016-10-09 10:56:22'),
(13, 1, 13, NULL, NULL, '2016-10-09 10:57:01'),
(14, 1, 14, NULL, NULL, '2016-10-09 10:57:58'),
(15, 1, 15, NULL, NULL, '2016-10-09 10:58:46'),
(16, 1, 16, NULL, NULL, '2016-10-09 11:00:01'),
(17, 1, 17, NULL, NULL, '2016-10-09 11:00:21'),
(18, 1, 18, NULL, NULL, '2016-10-09 11:00:56'),
(19, 1, 19, NULL, NULL, '2016-10-09 11:01:16'),
(20, 1, 20, NULL, NULL, '2016-10-09 11:01:20'),
(21, 1, 21, 1, 1, '2016-10-09 11:01:48'),
(22, 1, 22, 1, 1, '2016-10-09 11:04:01'),
(23, 1, 23, 1, 1, '2016-10-09 11:04:35'),
(24, 1, 24, 1, 1, '2016-10-09 11:05:44'),
(25, 1, 25, 1, 1, '2016-10-09 11:06:36'),
(26, 1, 26, 1, 1, '2016-10-09 11:07:06'),
(27, 1, 27, 1, 1, '2016-10-09 11:07:28'),
(28, 1, 28, 1, 1, '2016-10-09 11:08:13'),
(29, 1, 29, 1, 1, '2016-10-09 11:08:41'),
(30, 1, 30, 1, 1, '2016-10-09 11:09:33'),
(31, 1, 31, 1, 1, '2016-10-09 11:11:59'),
(32, 1, 32, 1, 1, '2016-10-09 11:13:00'),
(33, 1, 33, 1, 1, '2016-10-09 11:13:24'),
(34, 1, 34, 1, 1, '2016-10-09 11:14:39'),
(35, 1, 35, 1, 1, '2016-10-09 11:23:56'),
(36, 1, 36, 1, 1, '2016-10-09 11:24:34');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `questionnaire_feedback_details`
--

CREATE TABLE `questionnaire_feedback_details` (
  `questionnaire_feedback_details_id` int(20) UNSIGNED NOT NULL,
  `questionnaire_feedback_id` int(20) NOT NULL,
  `question_id` int(20) NOT NULL,
  `answer_id` int(20) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `questions`
--

CREATE TABLE `questions` (
  `question_id` int(20) UNSIGNED NOT NULL,
  `section_id` int(20) DEFAULT NULL,
  `question` text NOT NULL,
  `description` text NOT NULL,
  `question_type` enum('radio','text') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `questions`
--

INSERT INTO `questions` (`question_id`, `section_id`, `question`, `description`, `question_type`) VALUES
(1, 1, '… calitatea serviciilor medicale primite in acest spital', '', 'radio'),
(2, 1, '… modul in care v-au fost respectate drepturile de pacient?', '', 'radio'),
(3, 2, '… timpul de asteptare pana la prima examinare de catre medic in cadrul sectiei in care ati fost internat?', '', 'radio'),
(4, 2, '… modul in care ati fost consultat de medicul curant (care v-a ingrijit in sectie)?', '', 'radio'),
(5, 2, '… tratamentul primit in perioada de spitalizare?', '', 'radio');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `sections`
--

CREATE TABLE `sections` (
  `section_id` int(20) NOT NULL,
  `questionnaire_id` int(20) DEFAULT NULL,
  `section` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `sections`
--

INSERT INTO `sections` (`section_id`, `questionnaire_id`, `section`, `description`) VALUES
(1, 1, 'Cat de multumit sunteti, in general de …?', 'werwer'),
(2, 1, 'Cat de multumit ati fost de …?', 'werwer');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `sessions`
--

CREATE TABLE `sessions` (
  `sessionId` varchar(255) NOT NULL,
  `modified` int(11) DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `sessions`
--

INSERT INTO `sessions` (`sessionId`, `modified`, `lifetime`, `data`) VALUES
('9tra1vo7saiehkf9pdvfudi7a1', 1475989631, 43200, ''),
('eqdutl22n9kbskve72vuk4e342', 1476001489, 43200, ''),
('htknsunr2qj7esht10ns2kiqc4', 1475998209, 43200, '');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `stations`
--

CREATE TABLE `stations` (
  `station_id` int(20) UNSIGNED NOT NULL,
  `hospital_id` int(20) NOT NULL,
  `station` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `stations`
--

INSERT INTO `stations` (`station_id`, `hospital_id`, `station`) VALUES
(1, 1, 'obstetrica');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE `users` (
  `user_id` int(20) UNSIGNED NOT NULL,
  `auth_code` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`user_id`, `auth_code`, `ip`, `timestamp`) VALUES
(1, 'asdasd', '', '2016-10-09 10:42:53'),
(2, 'asdasd', '', '2016-10-09 10:43:59'),
(3, 'asdasd', '', '2016-10-09 10:44:11'),
(4, 'asdasd', '', '2016-10-09 10:45:58'),
(5, 'asdasd', '', '2016-10-09 10:46:26'),
(6, 'asdasd', '', '2016-10-09 10:51:05'),
(7, 'asdasd', '', '2016-10-09 10:51:30'),
(8, 'asdasd', '', '2016-10-09 10:52:16'),
(9, 'asdasd', '', '2016-10-09 10:53:42'),
(10, 'asdasd', '', '2016-10-09 10:54:50'),
(11, 'asdasd', '', '2016-10-09 10:54:53'),
(12, 'asdasd', '', '2016-10-09 10:56:22'),
(13, 'asdasd', '', '2016-10-09 10:57:01'),
(14, 'asdasd', '', '2016-10-09 10:57:58'),
(15, 'asdasd', '', '2016-10-09 10:58:46'),
(16, 'asdasd', '', '2016-10-09 11:00:01'),
(17, 'asdasd', '', '2016-10-09 11:00:21'),
(18, 'asdasd', '', '2016-10-09 11:00:56'),
(19, 'asdasd', '', '2016-10-09 11:01:16'),
(20, 'asdasd', '', '2016-10-09 11:01:20'),
(21, 'asdasd', '', '2016-10-09 11:01:48'),
(22, 'asdasd', '', '2016-10-09 11:04:01'),
(23, 'asdasd', '', '2016-10-09 11:04:35'),
(24, 'asdasd', '', '2016-10-09 11:05:44'),
(25, 'asdasd', '', '2016-10-09 11:06:36'),
(26, 'asdasd', '', '2016-10-09 11:07:06'),
(27, 'asdasd', '', '2016-10-09 11:07:28'),
(28, 'asdasd', '', '2016-10-09 11:08:13'),
(29, 'asdasd', '', '2016-10-09 11:08:41'),
(30, 'asdasd', '', '2016-10-09 11:09:33'),
(31, 'asdasd', '', '2016-10-09 11:11:59'),
(32, 'asdasd', '', '2016-10-09 11:13:00'),
(33, 'asdasd', '', '2016-10-09 11:13:24'),
(34, 'asdasd', '', '2016-10-09 11:14:39'),
(35, 'asdasd', '', '2016-10-09 11:23:56'),
(36, 'asdasd', '', '2016-10-09 11:24:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `county`
--
ALTER TABLE `county`
  ADD PRIMARY KEY (`county_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `hospital_id` (`station_id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`hospital_id`),
  ADD KEY `county_id` (`county_id`);

--
-- Indexes for table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD PRIMARY KEY (`questionnaire_id`);

--
-- Indexes for table `questionnaire_feedback`
--
ALTER TABLE `questionnaire_feedback`
  ADD PRIMARY KEY (`questionnaire_feedback_id`),
  ADD KEY `questionnaire_id` (`questionnaire_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `doctor_id` (`station_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `questionnaire_feedback_details`
--
ALTER TABLE `questionnaire_feedback_details`
  ADD PRIMARY KEY (`questionnaire_feedback_details_id`),
  ADD KEY `questionnaire_feedback_id` (`questionnaire_feedback_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `answer_id` (`answer_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `questionnaire_id` (`section_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `questionnaire_id` (`questionnaire_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sessionId`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`station_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `county`
--
ALTER TABLE `county`
  MODIFY `county_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `hospital_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questionnaire`
--
ALTER TABLE `questionnaire`
  MODIFY `questionnaire_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questionnaire_feedback`
--
ALTER TABLE `questionnaire_feedback`
  MODIFY `questionnaire_feedback_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `station_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
