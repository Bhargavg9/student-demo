/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - student_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`student_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `student_db`;

/*Table structure for table `course` */

DROP TABLE IF EXISTS `course`;

CREATE TABLE `course` (
  `course_id` int(20) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(20) NOT NULL,
  `course_description` varchar(70) NOT NULL,
  `created_user` varchar(20) DEFAULT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_user` varchar(20) DEFAULT NULL,
  `updated_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `version_flag` int(5) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `course` */

insert  into `course`(`course_id`,`course_name`,`course_description`,`created_user`,`created_at`,`updated_user`,`updated_at`,`version_flag`,`is_active`) values 
(1,'JAVA','Java','Admin','2021-11-24 11:18:37.890134','Uadmin','2021-11-24 06:49:07.000000',2,1),
(2,'PHP','PHP','Admin','2021-11-24 11:18:49.597814',NULL,'2021-11-24 11:18:49.597814',1,0);

/*Table structure for table `student_course` */

DROP TABLE IF EXISTS `student_course`;

CREATE TABLE `student_course` (
  `student_course_id` int(20) NOT NULL AUTO_INCREMENT,
  `student_id` int(20) NOT NULL,
  `course_id` int(20) NOT NULL,
  `created_user` varchar(20) DEFAULT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_user` varchar(20) DEFAULT NULL,
  `updated_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `version_flag` int(5) NOT NULL DEFAULT 1,
  PRIMARY KEY (`student_course_id`),
  KEY `FK_course_id` (`course_id`),
  KEY `FK_student_id` (`student_id`),
  CONSTRAINT `FK_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_student_id` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `student_course` */

insert  into `student_course`(`student_course_id`,`student_id`,`course_id`,`created_user`,`created_at`,`updated_user`,`updated_at`,`version_flag`) values 
(1,1,1,'Admin','2021-11-24 11:18:59.551242',NULL,'2021-11-24 11:18:59.551242',1);

/*Table structure for table `student_info` */

DROP TABLE IF EXISTS `student_info`;

CREATE TABLE `student_info` (
  `student_id` int(20) NOT NULL AUTO_INCREMENT,
  `student_name` varchar(30) NOT NULL,
  `student_dob` date NOT NULL,
  `student_contact_no` varchar(30) NOT NULL,
  `student_last_name` varchar(30) NOT NULL,
  `created_user` varchar(20) DEFAULT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_user` varchar(20) DEFAULT NULL,
  `updated_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `version_flag` int(5) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `student_info` */

insert  into `student_info`(`student_id`,`student_name`,`student_dob`,`student_contact_no`,`student_last_name`,`created_user`,`created_at`,`updated_user`,`updated_at`,`version_flag`,`is_active`) values 
(1,'Bharagav','2021-11-03','9533148434','Gedala','Admin','2021-11-24 11:18:24.081307','Uadmin','2021-11-24 06:49:15.000000',2,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
