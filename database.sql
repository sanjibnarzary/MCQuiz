-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2013 at 04:11 AM
-- Server version: 5.5.27-log
-- PHP Version: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mockquiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE IF NOT EXISTS `leaderboard` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `leaderboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` varchar(2000) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `explain` varchar(1000) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by_uid` bigint(20) NOT NULL,
  `type_category_id` bigint(20) NOT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_question_User1_idx` (`created_by_uid`),
  KEY `fk_question_type_category1_idx` (`type_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `question`
--


-- --------------------------------------------------------

--
-- Table structure for table `question_choice`
--

CREATE TABLE IF NOT EXISTS `question_choice` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `qid` bigint(20) DEFAULT NULL,
  `is_right` tinyint(1) DEFAULT '0',
  `choice` varchar(500) DEFAULT NULL,
  `question_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_question_choice_question1_idx` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `question_choice`
--


-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by_uid` bigint(20) NOT NULL,
  `quiz_sub_category_id` bigint(20) NOT NULL,
  `is_published` tinyint(1) DEFAULT '0',
  `is_verified` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_quiz_User1_idx` (`created_by_uid`),
  KEY `fk_quiz_quiz_sub_category1_idx` (`quiz_sub_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz_category`
--

CREATE TABLE IF NOT EXISTS `quiz_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by_uid` bigint(20) NOT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_quiz_category_User1_idx` (`created_by_uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `quiz_category`
--
-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE IF NOT EXISTS `quiz_questions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `quiz_id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `reward_mark` int(11) DEFAULT NULL,
  `penalty_mark` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_quiz_questions_quiz1_idx` (`quiz_id`),
  KEY `fk_quiz_questions_question1_idx` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `quiz_questions`
--


-- --------------------------------------------------------

--
-- Table structure for table `quiz_score`
--

CREATE TABLE IF NOT EXISTS `quiz_score` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `quiz_id` bigint(20) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `score` bigint(20) DEFAULT NULL,
  `quiz_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_quiz_score_quiz1_idx` (`quiz_id`),
  KEY `fk_quiz_score_User1_idx` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `quiz_score`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz_sub_category`
--

CREATE TABLE IF NOT EXISTS `quiz_sub_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by_uid` bigint(20) NOT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  `quiz_category_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_quiz_category_User1_idx` (`created_by_uid`),
  KEY `fk_quiz_sub_category_quiz_category1_idx` (`quiz_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `quiz_sub_category`
--

-- --------------------------------------------------------

--
-- Table structure for table `travia_attempted`
--

CREATE TABLE IF NOT EXISTS `travia_attempted` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `attempted_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `type_category`
--

CREATE TABLE IF NOT EXISTS `type_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by_uid` bigint(20) NOT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_type_category_User1_idx` (`created_by_uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `type_category`
--
-- --------------------------------------------------------

--
-- Table structure for table `type_sub_category`
--

CREATE TABLE IF NOT EXISTS `type_sub_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by_uid` bigint(20) NOT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  `type_category_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_type_category_User1_idx` (`created_by_uid`),
  KEY `fk_type_sub_category_type_category1_idx` (`type_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `hash` varchar(250) DEFAULT NULL,
  `photo` varchar(500) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_leaderboard_score`
--

CREATE TABLE IF NOT EXISTS `user_leaderboard_score` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rank` bigint(20) NOT NULL,
  `score` bigint(20) DEFAULT '0',
  `uid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_leaderboard_score`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_leaderboard_score_temp`
--

CREATE TABLE IF NOT EXISTS `user_leaderboard_score_temp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) NOT NULL,
  `score` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_leaderboard_score_temp`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_quiz_answers`
--

CREATE TABLE IF NOT EXISTS `user_quiz_answers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) NOT NULL,
  `user_choice_id` bigint(20) DEFAULT NULL,
  `answer_time` datetime DEFAULT NULL,
  `class` varchar(100) DEFAULT 'unattempted',
  `uid` bigint(20) NOT NULL,
  `quiz_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_quiz_answers_User1_idx` (`uid`),
  KEY `fk_user_quiz_answers_quiz1_idx` (`quiz_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_quiz_answers`
--
-- --------------------------------------------------------

--
-- Table structure for table `user_quiz_answer_time`
--

CREATE TABLE IF NOT EXISTS `user_quiz_answer_time` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `total_time` time DEFAULT NULL COMMENT 'this is for checking how much time the user wants to test theirself',
  `is_finished` tinyint(1) DEFAULT '0',
  `attempts` int(11) DEFAULT '0',
  `quiz_id` bigint(20) NOT NULL,
  `uid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_quiz_answer_time_quiz1_idx` (`quiz_id`),
  KEY `fk_user_quiz_answer_time_User1_idx` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_quiz_answer_time`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_travia_answer`
--

CREATE TABLE IF NOT EXISTS `user_travia_answer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) NOT NULL,
  `user_choice_id` bigint(20) DEFAULT NULL,
  `answer_time` timestamp NULL DEFAULT NULL,
  `attempts` int(11) DEFAULT '0',
  `uid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_tutorial_answer_User1_idx` (`uid`),
  KEY `fk_user_tutorial_answer_question1_idx` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_travia_answer`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_travia_score`
--

CREATE TABLE IF NOT EXISTS `user_travia_score` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) NOT NULL,
  `score` bigint(20) DEFAULT NULL,
  `travia_last_attempt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_quiz_score_User1_idx` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_travia_score`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_tutorial_answer`
--

CREATE TABLE IF NOT EXISTS `user_tutorial_answer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) NOT NULL,
  `user_choice_id` bigint(20) DEFAULT NULL,
  `answer_time` timestamp NULL DEFAULT NULL,
  `attempts` int(11) DEFAULT '0',
  `uid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_tutorial_answer_User1_idx` (`uid`),
  KEY `fk_user_tutorial_answer_question1_idx` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) DEFAULT 'user' COMMENT 'role can be admin',
  `User_uid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`,`User_uid`),
  KEY `fk_user_type_User1_idx` (`User_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_question_type_category1` FOREIGN KEY (`type_category_id`) REFERENCES `type_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_question_User1` FOREIGN KEY (`created_by_uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `question_choice`
--
ALTER TABLE `question_choice`
  ADD CONSTRAINT `fk_question_choice_question1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `fk_quiz_quiz_sub_category1` FOREIGN KEY (`quiz_sub_category_id`) REFERENCES `quiz_sub_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_quiz_User1` FOREIGN KEY (`created_by_uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quiz_category`
--
ALTER TABLE `quiz_category`
  ADD CONSTRAINT `fk_quiz_category_User1` FOREIGN KEY (`created_by_uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `fk_quiz_questions_question1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_quiz_questions_quiz1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quiz_score`
--
ALTER TABLE `quiz_score`
  ADD CONSTRAINT `fk_quiz_score_quiz1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_quiz_score_User1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quiz_sub_category`
--
ALTER TABLE `quiz_sub_category`
  ADD CONSTRAINT `fk_quiz_category_User10` FOREIGN KEY (`created_by_uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_quiz_sub_category_quiz_category1` FOREIGN KEY (`quiz_category_id`) REFERENCES `quiz_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `type_category`
--
ALTER TABLE `type_category`
  ADD CONSTRAINT `fk_type_category_User1` FOREIGN KEY (`created_by_uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `type_sub_category`
--
ALTER TABLE `type_sub_category`
  ADD CONSTRAINT `fk_type_category_User10` FOREIGN KEY (`created_by_uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_type_sub_category_type_category1` FOREIGN KEY (`type_category_id`) REFERENCES `type_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_quiz_answers`
--
ALTER TABLE `user_quiz_answers`
  ADD CONSTRAINT `fk_user_quiz_answers_quiz1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_quiz_answers_User1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_quiz_answer_time`
--
ALTER TABLE `user_quiz_answer_time`
  ADD CONSTRAINT `fk_user_quiz_answer_time_quiz1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_quiz_answer_time_User1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_travia_answer`
--
ALTER TABLE `user_travia_answer`
  ADD CONSTRAINT `fk_user_tutorial_answer_question10` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_tutorial_answer_User10` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_travia_score`
--
ALTER TABLE `user_travia_score`
  ADD CONSTRAINT `fk_quiz_score_User10` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_tutorial_answer`
--
ALTER TABLE `user_tutorial_answer`
  ADD CONSTRAINT `fk_user_tutorial_answer_question1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_tutorial_answer_User1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_type`
--
ALTER TABLE `user_type`
  ADD CONSTRAINT `fk_user_type_User1` FOREIGN KEY (`User_uid`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
