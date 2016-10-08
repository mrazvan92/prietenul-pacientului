-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08 Oct 2016 la 13:47
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
-- Structura de tabel pentru tabelul `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` set('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `answers`
--

CREATE TABLE `answers` (
  `answer_id` bigint(20) UNSIGNED NOT NULL,
  `answer_question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_description` text COLLATE utf8_unicode_ci NOT NULL,
  `answer_explanation` text COLLATE utf8_unicode_ci,
  `answer_isright` tinyint(1) NOT NULL DEFAULT '0',
  `answer_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `answer_position` bigint(20) UNSIGNED DEFAULT NULL,
  `answer_keyboard_key` smallint(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `questions`
--

CREATE TABLE `questions` (
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `question_subject_id` bigint(20) UNSIGNED NOT NULL,
  `question_description` text COLLATE utf8_unicode_ci NOT NULL,
  `question_explanation` text COLLATE utf8_unicode_ci,
  `question_type` smallint(3) UNSIGNED NOT NULL DEFAULT '1',
  `question_enabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
('7ihtnu0unmr1js7kjnunf18oj1', 1475927223, 43200, '');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `tests`
--

CREATE TABLE `tests` (
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `test_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `test_description` text COLLATE utf8_unicode_ci NOT NULL,
  `test_begin_time` datetime DEFAULT NULL,
  `test_end_time` datetime DEFAULT NULL,
  `test_duration_time` smallint(10) UNSIGNED NOT NULL DEFAULT '0',
  `test_results_to_users` tinyint(1) NOT NULL DEFAULT '0',
  `test_report_to_users` tinyint(1) NOT NULL DEFAULT '0',
  `test_random_questions_select` tinyint(1) NOT NULL DEFAULT '1',
  `test_random_questions_order` tinyint(1) NOT NULL DEFAULT '1',
  `test_questions_order_mode` smallint(3) UNSIGNED NOT NULL DEFAULT '0',
  `test_random_answers_select` tinyint(1) NOT NULL DEFAULT '1',
  `test_random_answers_order` tinyint(1) NOT NULL DEFAULT '1',
  `test_noanswer_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `test_repeatable` tinyint(1) NOT NULL DEFAULT '0',
  `test_logout_on_timeout` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `tests_feedback`
--

CREATE TABLE `tests_feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `current_page` int(11) NOT NULL DEFAULT '0',
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `tests_feedback_detail`
--

CREATE TABLE `tests_feedback_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tests_feedback_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `question` text,
  `value` bigint(20) UNSIGNED NOT NULL,
  `feedback_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obsolete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `tests_logs`
--

CREATE TABLE `tests_logs` (
  `testlog_id` bigint(20) UNSIGNED NOT NULL,
  `testlog_testuser_id` bigint(20) UNSIGNED NOT NULL,
  `testlog_user_ip` varchar(39) COLLATE utf8_unicode_ci DEFAULT NULL,
  `testlog_question_id` bigint(20) UNSIGNED NOT NULL,
  `testlog_answer_text` text COLLATE utf8_unicode_ci,
  `testlog_score` decimal(10,3) DEFAULT NULL,
  `testlog_creation_time` datetime DEFAULT NULL,
  `testlog_display_time` datetime DEFAULT NULL,
  `testlog_change_time` datetime DEFAULT NULL,
  `testlog_reaction_time` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `testlog_order` smallint(6) NOT NULL DEFAULT '1',
  `testlog_num_answers` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `testlog_comment` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `tests_logs_answers`
--

CREATE TABLE `tests_logs_answers` (
  `logansw_testlog_id` bigint(20) UNSIGNED NOT NULL,
  `logansw_answer_id` bigint(20) UNSIGNED NOT NULL,
  `logansw_selected` smallint(6) NOT NULL DEFAULT '-1',
  `logansw_order` smallint(6) NOT NULL DEFAULT '1',
  `logansw_position` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_surename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_regdate` datetime NOT NULL,
  `user_ip` varchar(39) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `p_answer_question_id` (`answer_question_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `p_question_subject_id` (`question_subject_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sessionId`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `tests_feedback`
--
ALTER TABLE `tests_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tests_feedback_detail`
--
ALTER TABLE `tests_feedback_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tests_feedback_id` (`tests_feedback_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `value` (`value`);

--
-- Indexes for table `tests_logs`
--
ALTER TABLE `tests_logs`
  ADD PRIMARY KEY (`testlog_id`),
  ADD UNIQUE KEY `ak_testuser_question` (`testlog_testuser_id`,`testlog_question_id`),
  ADD KEY `p_testlog_question_id` (`testlog_question_id`),
  ADD KEY `p_testlog_testuser_id` (`testlog_testuser_id`);

--
-- Indexes for table `tests_logs_answers`
--
ALTER TABLE `tests_logs_answers`
  ADD PRIMARY KEY (`logansw_testlog_id`,`logansw_answer_id`),
  ADD KEY `p_logansw_answer_id` (`logansw_answer_id`),
  ADD KEY `p_logansw_testlog_id` (`logansw_testlog_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20238;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4096;
--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tests_feedback`
--
ALTER TABLE `tests_feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `tests_feedback_detail`
--
ALTER TABLE `tests_feedback_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64348;
--
-- AUTO_INCREMENT for table `tests_logs`
--
ALTER TABLE `tests_logs`
  MODIFY `testlog_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `tests_feedback`
--
ALTER TABLE `tests_feedback`
  ADD CONSTRAINT `tests_feedback_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tests_feedback_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `tests_feedback_detail`
--
ALTER TABLE `tests_feedback_detail`
  ADD CONSTRAINT `tests_feedback_detail_ibfk_1` FOREIGN KEY (`tests_feedback_id`) REFERENCES `tests_feedback` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tests_feedback_detail_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tests_feedback_detail_ibfk_3` FOREIGN KEY (`value`) REFERENCES `answers` (`answer_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
