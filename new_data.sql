-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2015 at 07:50 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `new_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp_data`
--

CREATE TABLE IF NOT EXISTS `emp_data` (
  `id` int(11) NOT NULL,
  `info_mother` varchar(200) NOT NULL,
  `date_father` date NOT NULL,
  `date_mother` date NOT NULL,
  `info_f_occupation` varchar(200) NOT NULL,
  `info_m_occupation` varchar(200) NOT NULL,
  `info_n_children` varchar(200) NOT NULL,
  `date_children` date NOT NULL,
  `info_n_children1` varchar(200) NOT NULL,
  `date_children1` date NOT NULL,
  `info_l_name` varchar(200) NOT NULL,
  `info_f_name` varchar(200) NOT NULL,
  `info_m_name` varchar(200) NOT NULL,
  `info_gender` varchar(200) NOT NULL,
  `info_bday` date NOT NULL,
  `info_status` varchar(200) NOT NULL,
  `info_pre_home_add` varchar(200) NOT NULL,
  `info_per_add` varchar(200) NOT NULL,
  `info_city` varchar(200) NOT NULL,
  `info_zip` int(200) NOT NULL,
  `info_email` varchar(200) NOT NULL,
  `info_mob_num` int(200) NOT NULL,
  `info_tel_num` int(200) NOT NULL,
  `info_nat` varchar(200) NOT NULL,
  `info_placeofbirth` varchar(200) NOT NULL,
  `info_pagibigno` int(200) NOT NULL,
  `info_philhealth` varchar(200) NOT NULL,
  `info_blodtyp` varchar(200) NOT NULL,
  `sss` int(200) NOT NULL,
  `info_religion` varchar(200) NOT NULL,
  `info_tin` int(200) NOT NULL,
  `info_father` varchar(200) NOT NULL,
  `info_n_children2` varchar(200) NOT NULL,
  `date_children2` date NOT NULL,
  `info_n_siblings` varchar(200) NOT NULL,
  `date_siblings` date NOT NULL,
  `info_n_sibling1` varchar(200) NOT NULL,
  `date_siblings1` date NOT NULL,
  `info_n_siblings2` varchar(200) NOT NULL,
  `date_siblings2` date NOT NULL,
  `info_cont_person` varchar(200) NOT NULL,
  `info_cont_num` int(200) NOT NULL,
  `info_cont_add` varchar(200) NOT NULL,
  `info_post` varchar(200) NOT NULL,
  `info_educ_school` varchar(200) NOT NULL,
  `info_educ_course` varchar(200) NOT NULL,
  `info_educ_major` varchar(200) NOT NULL,
  `date_post_last` date NOT NULL,
  `info_bachelor` varchar(200) NOT NULL,
  `info_bac_school` varchar(200) NOT NULL,
  `info_bac_course` varchar(200) NOT NULL,
  `info_bac_major` varchar(200) NOT NULL,
  `date_bac_last` varchar(200) NOT NULL,
  `info_tech` varchar(200) NOT NULL,
  `info_tech_school` varchar(200) NOT NULL,
  `info_tech_course` varchar(200) NOT NULL,
  `info_tech_major` varchar(200) NOT NULL,
  `date_tech_last` date NOT NULL,
  `info_high_school` varchar(200) NOT NULL,
  `date_high_last` date NOT NULL,
  `info_elem_school` varchar(200) NOT NULL,
  `date_elem_attend` date NOT NULL,
  `info_comp_name1` varchar(200) NOT NULL,
  `date_compjoin1` date NOT NULL,
  `info_comp_add1` varchar(200) NOT NULL,
  `date_compleft1` varchar(200) NOT NULL,
  `info_comp_prev_salry1` varchar(200) NOT NULL,
  `info_comp_r_leavng1` varchar(200) NOT NULL,
  `info_comp_name2` varchar(200) NOT NULL,
  `date_compjoin2` date NOT NULL,
  `info_comp_add2` varchar(200) NOT NULL,
  `date_compleft2` date NOT NULL,
  `info_comp_prev_salry2` varchar(200) NOT NULL,
  `info_comp_r_leavng2` varchar(200) NOT NULL,
  `info_comp_name3` varchar(200) NOT NULL,
  `date_compjoin3` date NOT NULL,
  `info_comp_add3` varchar(200) NOT NULL,
  `date_compleft3` date NOT NULL,
  `info_comp_prev_salry3` varchar(200) NOT NULL,
  `info_comp_r_leavng3` varchar(200) NOT NULL,
  `info_language` varchar(200) NOT NULL,
  `info_comp_skill` varchar(200) NOT NULL,
  `info_other_tech` varchar(200) NOT NULL,
  `info_inter_hobbies` varchar(200) NOT NULL,
  `shifting` varchar(200) NOT NULL,
  `info_train_title` varchar(200) NOT NULL,
  `info_train_org` varchar(200) NOT NULL,
  `info_train_from` varchar(200) NOT NULL,
  `info_train_to` varchar(200) NOT NULL,
  `info_train_title2` varchar(200) NOT NULL,
  `info_train_org2` varchar(200) NOT NULL,
  `info_train_from2` int(11) NOT NULL,
  `info_train_to2` int(11) NOT NULL,
  `info_train_title3` int(11) NOT NULL,
  `info_train_org3` int(11) NOT NULL,
  `info_train_from3` int(11) NOT NULL,
  `info_train_to3` int(11) NOT NULL,
  `info_char_name1` int(11) NOT NULL,
  `info_char_comp_add1` int(11) NOT NULL,
  `info_char_position1` varchar(200) NOT NULL,
  `info_char_cont_num1` varchar(200) NOT NULL,
  `info_char_name2` varchar(200) NOT NULL,
  `info_char_comp_add2` varchar(200) NOT NULL,
  `info_char_position2` varchar(200) NOT NULL,
  `info_char_cont_num2` varchar(200) NOT NULL,
  `info_char_name3` varchar(200) NOT NULL,
  `info_char_comp_add3` varchar(200) NOT NULL,
  `info_char_position3` varchar(200) NOT NULL,
  `info_char_cont_num3` varchar(200) NOT NULL,
  `info_crime` varchar(200) NOT NULL,
  `info_specify1` varchar(200) NOT NULL,
  `info_specify2` varchar(200) NOT NULL,
  `info_specify3` varchar(200) NOT NULL,
  `info_specify4` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_data`
--

INSERT INTO `emp_data` (`id`, `info_mother`, `date_father`, `date_mother`, `info_f_occupation`, `info_m_occupation`, `info_n_children`, `date_children`, `info_n_children1`, `date_children1`, `info_l_name`, `info_f_name`, `info_m_name`, `info_gender`, `info_bday`, `info_status`, `info_pre_home_add`, `info_per_add`, `info_city`, `info_zip`, `info_email`, `info_mob_num`, `info_tel_num`, `info_nat`, `info_placeofbirth`, `info_pagibigno`, `info_philhealth`, `info_blodtyp`, `sss`, `info_religion`, `info_tin`, `info_father`, `info_n_children2`, `date_children2`, `info_n_siblings`, `date_siblings`, `info_n_sibling1`, `date_siblings1`, `info_n_siblings2`, `date_siblings2`, `info_cont_person`, `info_cont_num`, `info_cont_add`, `info_post`, `info_educ_school`, `info_educ_course`, `info_educ_major`, `date_post_last`, `info_bachelor`, `info_bac_school`, `info_bac_course`, `info_bac_major`, `date_bac_last`, `info_tech`, `info_tech_school`, `info_tech_course`, `info_tech_major`, `date_tech_last`, `info_high_school`, `date_high_last`, `info_elem_school`, `date_elem_attend`, `info_comp_name1`, `date_compjoin1`, `info_comp_add1`, `date_compleft1`, `info_comp_prev_salry1`, `info_comp_r_leavng1`, `info_comp_name2`, `date_compjoin2`, `info_comp_add2`, `date_compleft2`, `info_comp_prev_salry2`, `info_comp_r_leavng2`, `info_comp_name3`, `date_compjoin3`, `info_comp_add3`, `date_compleft3`, `info_comp_prev_salry3`, `info_comp_r_leavng3`, `info_language`, `info_comp_skill`, `info_other_tech`, `info_inter_hobbies`, `shifting`, `info_train_title`, `info_train_org`, `info_train_from`, `info_train_to`, `info_train_title2`, `info_train_org2`, `info_train_from2`, `info_train_to2`, `info_train_title3`, `info_train_org3`, `info_train_from3`, `info_train_to3`, `info_char_name1`, `info_char_comp_add1`, `info_char_position1`, `info_char_cont_num1`, `info_char_name2`, `info_char_comp_add2`, `info_char_position2`, `info_char_cont_num2`, `info_char_name3`, `info_char_comp_add3`, `info_char_position3`, `info_char_cont_num3`, `info_crime`, `info_specify1`, `info_specify2`, `info_specify3`, `info_specify4`) VALUES
(15, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'DSAFDFDAS', '', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'FDASFDFD', '', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(17, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'FDASFDFD', '', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(19, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'fdafdsfs', '', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(20, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'richard', '', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(21, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'alejo', '', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(22, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'new', '', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(23, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(24, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'alejoalejo', '', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(25, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'dafsdfdfdsfdsafdasfdsfs', '', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(26, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'fdsafdfdasfdsafadsfdsfdsafsdfsdfsdfsdafsadfsdfsdfsdafasdfsafsdf', '', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(27, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'programming', '', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(28, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'finish', '', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', 'Graduate', '', '', '', '0000-00-00', 'Graduate', '', '', '', '01/01/2015', 'Graduate', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '01/01/2015', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', 'Male', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', 'Male', '', '', '', ''),
(29, 'fdsaf', '0000-00-00', '0000-00-00', 'fdsafd', 'fdsaf', 'dfsafd', '0000-00-00', 'dsafdf', '0000-00-00', 'dfsafd', 'fdasfd', 'fdsafds', 'Female', '0000-00-00', 'Widowed', 'fdasfdfd', 'dsafdffdsa', 'dsafd', 0, 'fdsafs@yahoo.com', 0, 32265533, 'fdsafd', 'fdafds', 0, 'dasfd', 'dfsafd', 0, 'dsffdf', 0, 'fdsaf', 'dsaf', '0000-00-00', 'fdsafsd', '0000-00-00', 'dfsaff', '0000-00-00', 'dsafds', '0000-00-00', 'fdsaf', 0, 'dsafd', 'Undergraduate', 'dasdfdfda', 'dsafdfds', 'dsafdsfds', '0000-00-00', 'Undergraduate', 'dsaf', 'dsafdffdas', 'fdsaf', '01/01/2015', 'Undergraduate', 'fdasffd', 'dsaffdfdsfdsafds', 'dsafdfdsfdas', '0000-00-00', 'dsafsd', '0000-00-00', 'fdsafdfsa', '0000-00-00', 'dafsfdsfds', '0000-00-00', 'dsafd', '01/01/2015', 'fdsaffdsf', '', 'fdsaf', '0000-00-00', 'fdsaf', '0000-00-00', '', 'dsafsd', 'dsafsdf', '0000-00-00', 'dsaf', '0000-00-00', 'fdsaf', 'dsafds', 'fdsafd', 'dsaf', 'fdsa', 'dsafd', 'Male', 'dsaf', 'fdsafs', 'fdsa', 'fdsa', 'fdsa', 'dsa', 0, 0, 0, 0, 0, 0, 0, 0, 'dsa', 'fdsa', 'fdsa', '', '', '', '', '', '', '', 'Female', '', 'dsafdfd', '', ''),
(30, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'dafdsfdsfd', 'dsafdfdfdas', '', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', 'Graduate', '', '', '', '0000-00-00', 'Graduate', '', '', '', '01/01/2015', 'Graduate', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '01/01/2015', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', 'Male', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', 'Male', '', '', '', ''),
(31, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'fdafd', '', '', 'Male', '0000-00-00', 'Single', 'fdsafsd', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', 'Graduate', '', '', '', '0000-00-00', 'Graduate', '', '', '', '01/01/2015', 'Graduate', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '01/01/2015', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', 'Male', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', 'Male', '', '', '', ''),
(32, '', '0000-00-00', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', 'erwin', 'de leon', 'refumanta', 'Male', '0000-00-00', 'Single', '', '', '', 0, '', 0, 0, '', '', 0, '', '', 0, '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', 0, '', 'Graduate', '', '', '', '0000-00-00', 'Graduate', '', '', '', '01/01/2015', 'Graduate', '', '', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '', '01/01/2015', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '', '', 'Male', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', 'Male', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_data`
--
ALTER TABLE `emp_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp_data`
--
ALTER TABLE `emp_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
