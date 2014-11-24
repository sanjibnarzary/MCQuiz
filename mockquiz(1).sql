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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `leaderboard`
--

INSERT INTO `leaderboard` (`id`, `uid`, `total`) VALUES
(10, 2, 100),
(11, 3, 628);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `description`, `keywords`, `explain`, `created_on`, `created_by_uid`, `type_category_id`, `is_verified`) VALUES
(1, 'Who is the author of ASS?', 'ass', 'Hi M', '2013-08-06 14:58:38', 2, 1, 0),
(2, 'Who am I?', '', 'From Poem', '2013-08-06 15:13:22', 2, 1, 0),
(3, 'Who is Father of Internet?', 'father,internet,quiz,trivia,sample,computer,network', 'Creator of ARPANET', '2013-08-06 15:39:40', 2, 2, 0),
(4, 'Which is not an Input Device?', 'name-input-device,sample,quiz,trivia,computer', 'CD Player is output device', '2013-08-06 16:09:55', 2, 2, 0),
(5, 'What is micron?', '', '10 power of -6', '2013-08-06 16:12:31', 2, 3, 0),
(6, 'Who is the chief of BTC?', 'btc,chief,tet', 'Hagrama Mahilary is the current chief of BTC', '2013-08-09 14:49:25', 2, 1, 0),
(7, 'What is the name of Brahmaputra river in Bodo?', 'bodo,brahmaputra', 'Burlungbutur is the name of Brahmaputra river in bodo', '2013-08-09 14:50:56', 2, 1, 0),
(8, 'What is CPU?', 'cpu,computer', NULL, '2013-08-09 14:52:18', 2, 2, 0),
(9, 'What is BSS?', '', NULL, '2013-08-09 14:53:44', 2, 3, 0),
(10, 'C++<br>\n<code>\n#include<stdio.h>\nint main(){\n   cout<<"Hi";\n   return 0;\n}\n</code>', '', NULL, '2013-08-10 01:44:51', 2, 2, 0),
(11, '<p>What is the perfect Position of Iron.</p><ol><li>One is Piper</li><li>Defends</li><li>Fe</li></ol>', 'sample', NULL, '2013-08-17 18:21:10', 2, 1, 0),
(12, '<p>The Heart and eart of the sense and animal</p><p>This sample shows how to automatically replace &lt;textarea&gt; elements with a CKEditor instance with an option to change the language of its user interface.</p><p>It pulls the language list from CKEditor _languages.js file that contains the list of supported languages and creates a drop-down list that lets the user change the UI language.</p><p>By default, CKEditor automatically localizes the editor to the language of the user. The UI language can be controlled with two configuration options: <a href="http://docs.ckeditor.com/#%21/api/CKEDITOR.config-cfg-language">language</a> and <a href="http://docs.ckeditor.com/#%21/api/CKEDITOR.config-cfg-defaultLanguage"> defaultLanguage</a>. The defaultLanguage setting specifies the default CKEditor language to be used when a localization suitable for user&#39;s settings is not available.</p><p>To specify the user interface language that will be used no matter what language is specified in user&#39;s browser or operating system, set the language property:</p>', '', NULL, '2013-08-17 19:20:49', 2, 1, 0),
(13, '<p>This sample shows how to automatically replace &lt;textarea&gt; elements with a CKEditor instance with an option to change the language of its user interface.</p><p>It pulls the language list from CKEditor _languages.js file that contains the list of supported languages and creates a drop-down list that lets the user change the UI language.</p><p>By default, CKEditor automatically localizes the editor to the language of the user. The UI language can be controlled with two configuration options: <a href="http://docs.ckeditor.com/#%21/api/CKEDITOR.config-cfg-language">language</a> and <a href="http://docs.ckeditor.com/#%21/api/CKEDITOR.config-cfg-defaultLanguage"> defaultLanguage</a>. The defaultLanguage setting specifies the default CKEditor language to be used when a localization suitable for user&#39;s settings is not available.</p><p>To specify the user interface language that will be used no matter what language is specified in user&#39;s browser or operating system, set the language property:</p>', '', NULL, '2013-08-17 19:24:55', 2, 1, 0),
(14, 'Who is Bill Gates?', '', NULL, '2013-08-17 20:03:36', 2, 1, 0),
(15, '<p>How many articles are there in Indian Constitution?</p>', '', NULL, '2013-08-18 14:57:05', 2, 4, 0),
(16, '<p>How many times Babar lose war?</p>', '', NULL, '2013-08-21 21:31:29', 2, 5, 0),
(17, '<p>The IQ of knowledge?</p>', '', 'The explaination....make me better', '2013-08-22 19:05:55', 3, 1, 0),
(18, '<p>What is the output of the following program?</p><p>&lt;code&gt;</p><p>#include&lt;iostream&gt;</p><p>using namespace std;</p><p>int main(){</p><p>&nbsp;&nbsp;&nbsp; cout&lt;&lt;&quot;Man Hi&quot;;</p><p>}</p><p>&lt;/code&gt;</p>', 'c,question', NULL, '2013-08-22 19:14:10', 3, 2, 0),
(19, '<p>$$ abc $$</p>', '', NULL, '2013-08-22 22:55:34', 3, 1, 0),
(20, '<p>This is History</p>', '', NULL, '2013-08-24 18:44:35', 2, 5, 0),
(21, '<p>ABC is Test</p>', '', NULL, '2013-08-24 21:05:53', 2, 5, 0),
(22, '<p>ASC</p>', '', NULL, '2013-08-24 21:06:24', 2, 5, 0),
(23, '', '', NULL, '2013-08-25 22:41:56', 2, 4, 0),
(24, 'What is GCC?', 'gcc,gnu-compiler-collection,question', NULL, '2013-08-25 23:03:16', 2, 6, 0),
(25, 'What will be the output of the following program?\r\n<pre>\r\n#include<stdio.h><br>\r\nint main(){<br>\r\nprintf("Hello World");<br>\r\nreturn 0;<br>\r\n}<br>\r\n</pre>', '', NULL, '2013-08-25 23:05:43', 2, 6, 0),
(27, '<p>Hot Mail is a</p>', '', NULL, '2013-08-26 19:06:57', 4, 4, 0),
(28, '<p>This Question is Meant for me</p>', '', NULL, '2013-08-26 19:24:20', 4, 4, 0),
(33, 'ABC what is ABC?', '', NULL, '2013-08-26 20:55:33', 2, 1, 0),
(36, 'Gmail is a web based?', '', NULL, '2013-08-26 21:24:07', 4, 1, 0),
(37, 'Who is man?', '', NULL, '2013-08-26 21:25:51', 4, 4, 0),
(38, 'Can you tell', '', NULL, '2013-08-26 21:26:34', 4, 5, 0),
(39, 'Secret weapon?', '', NULL, '2013-08-26 21:27:04', 4, 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=113 ;

--
-- Dumping data for table `question_choice`
--

INSERT INTO `question_choice` (`id`, `qid`, `is_right`, `choice`, `question_id`) VALUES
(1, NULL, 0, 'Animal is not mortal', 1),
(2, NULL, 1, 'M', 1),
(3, NULL, 0, 'Lamha Lamha', 1),
(4, NULL, 0, 'Hero', 1),
(5, NULL, 0, 'I am a Man', 2),
(6, NULL, 0, 'Man is Mortal.', 2),
(7, NULL, 1, 'Hupty Dumpty', 2),
(8, NULL, 0, 'Name After Me', 2),
(9, NULL, 1, 'Vin Cerf', 3),
(10, NULL, 0, 'Man with one Leg.', 3),
(11, NULL, 0, '1', 3),
(12, NULL, 0, '2', 3),
(13, NULL, 0, 'Keyboard', 4),
(14, NULL, 0, 'Mouse', 4),
(15, NULL, 1, 'CD Player', 4),
(16, NULL, 0, 'Joystick', 4),
(17, NULL, 1, '1 Micron = 10^-6', 5),
(18, NULL, 0, '20', 5),
(19, NULL, 0, 'Its a Main Memory', 5),
(20, NULL, 0, 'Mic Meter', 5),
(21, NULL, 1, 'Hagrama Mahilary', 6),
(22, NULL, 0, 'Sanjib Narzary', 6),
(23, NULL, 0, 'Piyas Narzary', 6),
(24, NULL, 0, 'Sona Brahma', 6),
(25, NULL, 1, 'Burlungbutur', 7),
(26, NULL, 0, 'Darrang River', 7),
(27, NULL, 0, 'Jiyajiri', 7),
(28, NULL, 0, 'Nainital', 7),
(29, NULL, 1, 'Central Processing Unit', 8),
(30, NULL, 0, 'Central Plastic Unit', 8),
(31, NULL, 0, 'Coal Pit Union', 8),
(32, NULL, 0, 'Cen Prin Uni', 8),
(33, NULL, 0, 'Bass System Support', 9),
(34, NULL, 1, 'Bodo Shaitya Sabha', 9),
(35, NULL, 0, 'Biscuit Salt Super', 9),
(36, NULL, 0, 'Bimaer Son Soon', 9),
(37, NULL, 0, 'print hi', 10),
(38, NULL, 1, 'print Hi', 10),
(39, NULL, 0, 'print none', 10),
(40, NULL, 0, '0', 10),
(41, NULL, 1, '3 is Iron', 11),
(42, NULL, 0, 'Name', 11),
(43, NULL, 0, 'P', 11),
(44, NULL, 0, '3', 11),
(45, NULL, 0, 'Q', 12),
(46, NULL, 0, 'V', 12),
(47, NULL, 0, 'C', 12),
(48, NULL, 1, 'g', 12),
(49, NULL, 0, 'X', 13),
(50, NULL, 1, '<math>X_2</math>', 13),
(51, NULL, 0, 'H', 13),
(52, NULL, 0, 'I', 13),
(53, NULL, 0, 'Millionaire', 14),
(54, NULL, 0, 'Billionaire', 14),
(55, NULL, 1, 'Richest Person', 14),
(56, NULL, 0, 'Man', 14),
(57, NULL, 0, '2258', 15),
(58, NULL, 0, '1172', 15),
(59, NULL, 0, '1670', 15),
(60, NULL, 1, '2260', 15),
(61, NULL, 0, '3', 16),
(62, NULL, 0, '12', 16),
(63, NULL, 0, '2', 16),
(64, NULL, 1, '34', 16),
(65, NULL, 0, 'is it good?', 17),
(66, NULL, 1, 'No', 17),
(67, NULL, 0, 'Boom?', 17),
(68, NULL, 0, 'Flex', 17),
(69, NULL, 0, 'Man Hi', 18),
(70, NULL, 0, 'asdjasldalsd', 18),
(71, NULL, 0, 'iasdjaskdjksa', 18),
(72, NULL, 1, 'Hello', 18),
(73, NULL, 1, '$', 19),
(74, NULL, 0, 'a', 19),
(75, NULL, 0, 'c', 19),
(76, NULL, 0, 'b', 19),
(77, NULL, 0, 'Hi', 20),
(78, NULL, 0, 'c', 20),
(79, NULL, 1, 'H', 20),
(80, NULL, 0, 'J', 20),
(81, NULL, 0, 'Gnu C Compiler', 24),
(82, NULL, 1, 'Gnu Compiler Collection', 24),
(83, NULL, 0, 'Computer', 24),
(84, NULL, 0, 'OS', 24),
(85, NULL, 0, 'printf "Hello World"', 25),
(86, NULL, 1, 'Hello World', 25),
(87, NULL, 0, '0', 25),
(88, NULL, 0, 'Hi', 25),
(97, NULL, 0, 'Client', 36),
(98, NULL, 1, 'Email Client', 36),
(99, NULL, 0, 'Mandate', 36),
(100, NULL, 0, 'Yahoo''s rebel', 36),
(101, NULL, 0, 'Life', 37),
(102, NULL, 1, 'Who lives', 37),
(103, NULL, 0, 'ABC', 37),
(104, NULL, 0, 'Norman', 37),
(105, NULL, 0, 'A', 38),
(106, NULL, 1, 'Yes', 38),
(107, NULL, 0, 'Oh', 38),
(108, NULL, 0, 'T', 38),
(109, NULL, 0, 'Zero', 39),
(110, NULL, 1, 'Cold War', 39),
(111, NULL, 0, 'Vipe', 39),
(112, NULL, 0, 'Lamb', 39);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `name`, `description`, `keywords`, `created_on`, `created_by_uid`, `quiz_sub_category_id`, `is_published`, `is_verified`) VALUES
(1, 'CSAT 2014 Quiz Sample #1', 'CSAT 2014 quiz sample paper', 'csat,2014,upsc,ias,sample', '2013-08-06 14:28:18', 2, 1, 1, 0),
(2, 'TET Assam Sample #1', 'Tet Assam Sample', 'tet', '2013-08-09 14:48:21', 2, 2, 1, 0),
(3, 'Assam TET Sample #2', 'This shows you the Assam TET Sample 2014', '', '2013-08-17 20:02:48', 2, 2, 0, 0),
(4, 'C Programming Test Sample #1', 'This will test you basic programming knowledge. Here many basic has been to put to questions.', 'c,programming,test,sample', '2013-08-25 23:01:47', 2, 3, 1, 0),
(5, 'Java Programming Quiz Sample #1', 'This will test you basic of java programming', 'java,basic,sample', '2013-08-26 18:06:31', 4, 4, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `quiz_category`
--

INSERT INTO `quiz_category` (`id`, `name`, `description`, `keywords`, `created_on`, `created_by_uid`, `is_verified`) VALUES
(1, 'Union_Public_Service_Commission_UPSC', 'UPSC is a Indian HR team for recruiting young indian in Govt Organizations.', 'upsc,quiz, sample, previuos year questions,solved-papers', '2013-08-06 14:24:36', 2, 0),
(2, 'TET_Assam', 'TET Assam Quiz', 'tet-assam', '2013-08-09 14:47:03', 2, 0),
(3, 'Programming', 'Programming language, is a computer language for writing Programs.', 'program,programming language', '2013-08-25 22:59:39', 2, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_id`, `reward_mark`, `penalty_mark`) VALUES
(1, 1, 1, 2, 0),
(2, 1, 2, 2, 0),
(3, 1, 4, 4, 1),
(4, 1, 5, 5, 2),
(5, 2, 6, 4, 1),
(6, 2, 7, 4, 1),
(7, 2, 8, 4, 1),
(8, 2, 9, 4, 1),
(9, 3, 14, 1, 0),
(10, 4, 24, 4, 1),
(11, 4, 25, 4, 1),
(20, 5, 36, 4, 1),
(21, 5, 37, 4, 1),
(22, 5, 38, 4, 1),
(23, 5, 39, 4, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `quiz_score`
--

INSERT INTO `quiz_score` (`id`, `quiz_id`, `uid`, `score`, `quiz_time`) VALUES
(8, 1, 2, 13, '2013-08-25 12:21:49'),
(9, 2, 2, 100, '2013-08-01 00:00:00'),
(10, 4, 2, 8, '2013-08-25 23:08:37');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `quiz_sub_category`
--

INSERT INTO `quiz_sub_category` (`id`, `name`, `description`, `keywords`, `created_on`, `created_by_uid`, `is_verified`, `quiz_category_id`) VALUES
(1, 'CSAT_2014', 'CSAT is IAS entrance screening test', 'csat', '2013-08-06 14:25:16', 2, 0, 1),
(2, 'TET_Primary', 'TET Primary', '', '2013-08-09 14:47:33', 2, 0, 2),
(3, 'C_Programming', 'C Programming is a computer language for writing programs of a computer.', 'c,program,computer,language', '2013-08-25 23:00:29', 2, 0, 3),
(4, 'Java', 'Java is a platform independent programming langauge', 'java', '2013-08-26 18:05:36', 4, 0, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `type_category`
--

INSERT INTO `type_category` (`id`, `name`, `description`, `keywords`, `created_on`, `created_by_uid`, `is_verified`) VALUES
(1, 'General_Knowledge', 'General Knowledge about India, World, States , History etc', 'quiz,general-knowledge', '2013-08-06 14:57:48', 2, 0),
(2, 'Computer', 'Computer is a device that takes input and gives output after processing that input.', 'computer,quiz,sample,quiz', '2013-08-06 15:38:50', 2, 0),
(3, 'Electronics', 'Electronics is a study of engineering branch.', 'electronics,sample,quiz,trivia,upsc', '2013-08-06 16:11:56', 2, 0),
(4, 'Current_Affairs', 'Current Affairs of India, World, States etc', 'current,affairs', '2013-08-11 20:47:34', 2, 0),
(5, 'Indian_History', 'This is all about Indian History and ancient cultures', 'history,cultures', '2013-08-12 07:15:27', 2, 0),
(6, 'C_Programming', 'C programming is a computer language.', '', '2013-08-25 23:02:30', 2, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `name`, `email`, `hash`, `photo`, `date`) VALUES
(2, NULL, 'sanjib', 'abc@gmail.com', '900150983cd24fb0d6963f7d28e17f72', NULL, '2013-08-06 14:22:20'),
(3, NULL, 'Mingw', 'abcd@gmail.com', '900150983cd24fb0d6963f7d28e17f72', NULL, '2013-08-22 19:01:37'),
(4, NULL, 'fida', 'fida@a.com', '900150983cd24fb0d6963f7d28e17f72', NULL, '2013-08-25 23:09:57');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=258 ;

--
-- Dumping data for table `user_leaderboard_score`
--

INSERT INTO `user_leaderboard_score` (`id`, `rank`, `score`, `uid`) VALUES
(255, 1, 614, 3),
(256, 2, 122, 2),
(257, 3, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_leaderboard_score_temp`
--

CREATE TABLE IF NOT EXISTS `user_leaderboard_score_temp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) NOT NULL,
  `score` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=276 ;

--
-- Dumping data for table `user_leaderboard_score_temp`
--

INSERT INTO `user_leaderboard_score_temp` (`id`, `uid`, `score`) VALUES
(273, 2, 122),
(274, 3, 614),
(275, 4, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `user_quiz_answers`
--

INSERT INTO `user_quiz_answers` (`id`, `question_id`, `user_choice_id`, `answer_time`, `class`, `uid`, `quiz_id`) VALUES
(1, 6, 21, '2013-08-19 18:34:55', 'review', 2, 2),
(2, 7, 27, '2013-08-19 18:58:52', 'attempted', 2, 2),
(5, 9, 34, '2013-08-19 19:39:22', 'review', 2, 2),
(11, 8, 29, '2013-08-21 21:39:13', 'review', 2, 2),
(12, 5, 19, '2013-08-22 21:28:34', 'attempted', 3, 1),
(13, 4, 16, '2013-08-22 21:28:43', 'review', 3, 1),
(14, 2, 5, '2013-08-22 21:28:49', 'review', 3, 1),
(15, 1, 1, '2013-08-22 21:28:55', 'attempted', 3, 1),
(16, 6, 21, '2013-08-22 22:26:25', 'attempted', 3, 2),
(17, 7, 25, '2013-08-22 22:26:36', 'attempted', 3, 2),
(18, 8, 29, '2013-08-22 22:26:44', 'attempted', 3, 2),
(19, 9, 34, '2013-08-22 22:26:52', 'attempted', 3, 2),
(20, 1, 2, '2013-08-25 12:21:24', 'review', 2, 1),
(21, 2, 7, '2013-08-25 12:21:32', 'attempted', 2, 1),
(22, 4, 15, '2013-08-25 12:21:39', 'attempted', 2, 1),
(23, 5, 17, '2013-08-25 12:21:45', 'attempted', 2, 1),
(24, 24, 82, '2013-08-25 23:08:24', 'attempted', 2, 4),
(25, 25, 86, '2013-08-25 23:08:33', 'attempted', 2, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user_quiz_answer_time`
--

INSERT INTO `user_quiz_answer_time` (`id`, `start_time`, `end_time`, `total_time`, `is_finished`, `attempts`, `quiz_id`, `uid`) VALUES
(5, '2013-08-22 21:54:29', '2013-08-22 21:56:01', NULL, 1, 1, 1, 3),
(6, '2013-08-22 22:26:11', '2013-08-22 22:27:01', NULL, 1, 1, 2, 3),
(11, '2013-08-25 12:21:14', '2013-08-25 12:21:49', NULL, 1, 6, 1, 2),
(12, '2013-08-25 23:08:17', '2013-08-25 23:08:37', NULL, 1, 1, 4, 2),
(13, '2013-08-25 23:27:50', NULL, NULL, 0, 2, 4, 4),
(14, '2013-08-26 22:01:20', NULL, NULL, 0, 2, 5, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `user_travia_answer`
--

INSERT INTO `user_travia_answer` (`id`, `question_id`, `user_choice_id`, `answer_time`, `attempts`, `uid`) VALUES
(21, 1, 2, '2013-08-11 16:45:19', 0, 2),
(22, 7, 25, '2013-08-11 16:45:25', 0, 2),
(23, 6, 21, '2013-08-11 16:45:29', 0, 2),
(24, 2, 7, '2013-08-11 16:45:33', 0, 2),
(25, 8, 30, '2013-08-11 16:45:51', 0, 2),
(26, 9, 34, '2013-08-11 16:45:58', 0, 2),
(27, 5, 17, '2013-08-22 17:05:27', 0, 3),
(29, 25, 86, '2013-08-25 17:48:57', 0, 4),
(30, 14, 55, '2013-08-25 17:50:16', 0, 4),
(31, 3, 9, '2013-08-25 17:52:43', 0, 4),
(32, 3, 9, '2013-08-25 17:54:39', 0, 4),
(33, 4, 15, '2013-08-25 17:57:03', 0, 4),
(34, 18, 69, '2013-08-26 12:33:01', 0, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_travia_score`
--

INSERT INTO `user_travia_score` (`id`, `uid`, `score`, `travia_last_attempt`) VALUES
(2, 3, 614, '2013-08-11 22:15:58'),
(3, 2, 1, '2013-08-22 22:35:27'),
(4, 4, 2, '2013-08-26 18:03:01');

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
