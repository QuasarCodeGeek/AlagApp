/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50718
Source Host           : localhost:3306
Source Database       : alagapp_db

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2023-07-13 07:40:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_admin
-- ----------------------------
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `admincode` varchar(12) NOT NULL,
  `adminpass` varchar(12) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `municipality` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `gender` char(1) NOT NULL,
  `bdate` date NOT NULL,
  `pict` varchar(50) NOT NULL,
  `session` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `gmeet` varchar(50) NOT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_admin
-- ----------------------------
INSERT INTO `tbl_admin` VALUES ('1', 'admin', 'admin', 'Juan', 'Sanchez', 'Dela Cruz', 'Purok 3', 'Sta. Cruz', 'Alicia', 'Isabela', 'M', '2022-12-05', 'greg-rakozy-oMpAz-DN-9I-unsplash.jpg', '1', 'admin101@outlook.com', '09151969668', '123-3456-345', 'https://meet.google.com/amz-ockk-jcb');

-- ----------------------------
-- Table structure for tbl_call
-- ----------------------------
DROP TABLE IF EXISTS `tbl_call`;
CREATE TABLE `tbl_call` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `vchannel` int(11) DEFAULT NULL,
  `vdatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_call
-- ----------------------------
INSERT INTO `tbl_call` VALUES ('1', '1', '1', '2023-07-13 01:36:19');

-- ----------------------------
-- Table structure for tbl_carddetail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_carddetail`;
CREATE TABLE `tbl_carddetail` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `petid` int(11) DEFAULT NULL,
  `vaxid` int(11) DEFAULT NULL,
  `cvet` varchar(50) DEFAULT NULL,
  `cweight` varchar(10) DEFAULT NULL,
  `cdate` date DEFAULT NULL,
  `cnext` date DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_carddetail
-- ----------------------------
INSERT INTO `tbl_carddetail` VALUES ('1', '1', '1', '1', 'Dr. Palmer', '12.45', '2023-07-13', '2023-08-14');

-- ----------------------------
-- Table structure for tbl_chat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_chat`;
CREATE TABLE `tbl_chat` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `mchannel` int(11) DEFAULT NULL,
  `msender` int(11) DEFAULT NULL,
  `mcontent` longtext,
  `mdatetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mtype` enum('Text','Img') DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_chat
-- ----------------------------
INSERT INTO `tbl_chat` VALUES ('1', '1', '1', '1', 'Good morning! Eric seemed to be doing fine, thank you!', '2023-07-13 07:36:02', null);
INSERT INTO `tbl_chat` VALUES ('2', '1', '1', '0', 'You\'re welcome, please visit anytime!', '2023-07-13 07:36:12', null);

-- ----------------------------
-- Table structure for tbl_notedetail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_notedetail`;
CREATE TABLE `tbl_notedetail` (
  `nid` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) DEFAULT NULL,
  `petid` int(10) DEFAULT NULL,
  `ndescription` longtext,
  `ndate` date DEFAULT NULL,
  `nvet` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_notedetail
-- ----------------------------
INSERT INTO `tbl_notedetail` VALUES ('1', '1', '1', 'Medication: Deworming Tablets\r\nDosage: 1 tablet per 10 kilograms of body weight\r\nFrequency: Once every 3 months\r\nAdditional Instructions: Administer with food in the morning.', '2023-07-14', 'Dr. Oak');

-- ----------------------------
-- Table structure for tbl_petprofile
-- ----------------------------
DROP TABLE IF EXISTS `tbl_petprofile`;
CREATE TABLE `tbl_petprofile` (
  `petid` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) DEFAULT NULL,
  `petname` varchar(50) DEFAULT NULL,
  `pettype` varchar(50) DEFAULT NULL,
  `petbreed` varchar(50) DEFAULT NULL,
  `petweight` decimal(10,2) DEFAULT NULL,
  `petmark` varchar(25) DEFAULT NULL,
  `petbdate` date DEFAULT NULL,
  `petage` varchar(25) DEFAULT NULL,
  `petgender` char(1) DEFAULT NULL,
  `petpict` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`petid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_petprofile
-- ----------------------------
INSERT INTO `tbl_petprofile` VALUES ('1', '1', 'Eric', 'Canine', 'SIberian Husky', '12.50', 'Black/White', '2023-06-07', '1 mo.', 'M', null);

-- ----------------------------
-- Table structure for tbl_record
-- ----------------------------
DROP TABLE IF EXISTS `tbl_record`;
CREATE TABLE `tbl_record` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `petid` int(11) DEFAULT NULL,
  `rdate` date DEFAULT NULL,
  `rweight` varchar(10) DEFAULT NULL,
  `rtemp` varchar(10) DEFAULT NULL,
  `rhistory` longtext,
  `rtreatment` longtext,
  `rvet` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_record
-- ----------------------------
INSERT INTO `tbl_record` VALUES ('1', '1', '1', '2023-07-13', '12.45', '34.2', 'Vomiting', 'Deworming', 'Dr. Sycamore');

-- ----------------------------
-- Table structure for tbl_scheduler
-- ----------------------------
DROP TABLE IF EXISTS `tbl_scheduler`;
CREATE TABLE `tbl_scheduler` (
  `qid` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) DEFAULT NULL,
  `petid` int(10) DEFAULT NULL,
  `qdescription` longtext,
  `qdate` date DEFAULT NULL,
  `qstatus` varchar(10) DEFAULT NULL,
  `qtime` time DEFAULT NULL,
  `qset` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_scheduler
-- ----------------------------
INSERT INTO `tbl_scheduler` VALUES ('1', '1', '1', 'Eric\'s Bronchicine next due date.  ', '2023-08-14', 'Pending', '09:30:00', '1');

-- ----------------------------
-- Table structure for tbl_sms
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sms`;
CREATE TABLE `tbl_sms` (
  `xid` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(11) DEFAULT NULL,
  `xtime` time DEFAULT NULL,
  `xdate` date DEFAULT NULL,
  PRIMARY KEY (`xid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_sms
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_symptom
-- ----------------------------
DROP TABLE IF EXISTS `tbl_symptom`;
CREATE TABLE `tbl_symptom` (
  `sid` int(10) NOT NULL AUTO_INCREMENT,
  `petbreed` varchar(50) DEFAULT NULL,
  `bodypart` varchar(50) DEFAULT NULL,
  `symptom` varchar(50) DEFAULT NULL,
  `diagnosis` varchar(100) DEFAULT NULL,
  `description` longtext,
  `pettype` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_symptom
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_userlist
-- ----------------------------
DROP TABLE IF EXISTS `tbl_userlist`;
CREATE TABLE `tbl_userlist` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `useremail` varchar(50) DEFAULT NULL,
  `userpassword` varchar(50) DEFAULT NULL,
  `userfname` varchar(50) DEFAULT NULL,
  `usermname` varchar(50) DEFAULT NULL,
  `userlname` varchar(50) DEFAULT NULL,
  `userbdate` date DEFAULT NULL,
  `usergender` char(1) DEFAULT NULL,
  `userstreet` varchar(50) DEFAULT NULL,
  `userdistrict` varchar(50) DEFAULT NULL,
  `usermunicipality` varchar(50) DEFAULT NULL,
  `userprovince` varchar(50) DEFAULT NULL,
  `userpict` varchar(50) DEFAULT NULL,
  `userstatus` enum('0','1') DEFAULT NULL,
  `usermobile` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_userlist
-- ----------------------------
INSERT INTO `tbl_userlist` VALUES ('1', 'client', 'client', 'Jayce', '', 'Seyer', '2000-11-11', 'M', null, 'Sta. Cruz', 'Alicia', 'Isabela', null, '0', '09151969668');

-- ----------------------------
-- Table structure for tbl_vaxxinfo
-- ----------------------------
DROP TABLE IF EXISTS `tbl_vaxxinfo`;
CREATE TABLE `tbl_vaxxinfo` (
  `vaxid` int(10) NOT NULL AUTO_INCREMENT,
  `vaxname` varchar(50) DEFAULT NULL,
  `vaxtype` varchar(50) DEFAULT NULL,
  `vaxbrand` varchar(50) DEFAULT NULL,
  `vaxdes` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`vaxid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_vaxxinfo
-- ----------------------------
INSERT INTO `tbl_vaxxinfo` VALUES ('1', 'Bronchicine', 'Antigenic Extract', 'Zoens', 'For Control of canine infectious Tracheobronchitis');
INSERT INTO `tbl_vaxxinfo` VALUES ('2', 'Recombitek C6', 'MLV', 'Zoens', '5ml (DA2PP)');
INSERT INTO `tbl_vaxxinfo` VALUES ('3', 'Recombitek C8', 'MLV, LV', 'Zoens', '8ml');
INSERT INTO `tbl_vaxxinfo` VALUES ('4', 'Pneumodog', 'Inactivated', 'Merial', 'KCV - Kennel Cough Vaccine');
INSERT INTO `tbl_vaxxinfo` VALUES ('5', 'Biocan R', 'Inactivated', 'Biovera', 'ARV - Anti Rabies Vaccine');
INSERT INTO `tbl_vaxxinfo` VALUES ('6', 'Rabisin', 'Inactivated', 'Boehringer Ingelheim', 'ARV - Anti Rabies Vaccine');
INSERT INTO `tbl_vaxxinfo` VALUES ('7', 'Felocel', 'MLV', 'Zoens', 'Feline Vaccine');
