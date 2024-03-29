/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50718
Source Host           : localhost:3306
Source Database       : alagapp_db

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2023-07-04 21:49:43
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
INSERT INTO `tbl_admin` VALUES ('1', 'Admin101', 'Passcode101', 'Juan', 'Sanchez', 'Dela Cruz', 'Purok 3', 'Sta. Cruz', 'Alicia', 'Isabela', 'M', '2022-12-05', 'greg-rakozy-oMpAz-DN-9I-unsplash.jpg', '1', 'admin101@outlook.com', '09151969668', '123-3456-345', 'https://meet.google.com/amz-ockk-jcb');

-- ----------------------------
-- Table structure for tbl_call
-- ----------------------------
DROP TABLE IF EXISTS `tbl_call`;
CREATE TABLE `tbl_call` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `vchannel` int(11) NOT NULL,
  `vdatetime` datetime NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_call
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_carddetail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_carddetail`;
CREATE TABLE `tbl_carddetail` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `petid` int(11) NOT NULL,
  `vaxid` int(11) NOT NULL,
  `cvet` varchar(50) NOT NULL,
  `cweight` varchar(10) NOT NULL,
  `cdate` date NOT NULL,
  `cnext` date DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_carddetail
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_chat
-- ----------------------------
DROP TABLE IF EXISTS `tbl_chat`;
CREATE TABLE `tbl_chat` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `mchannel` int(11) NOT NULL,
  `msender` int(11) NOT NULL,
  `mcontent` longtext NOT NULL,
  `mdatetime` datetime NOT NULL,
  `mtype` enum('Text','Img') NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_chat
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_notedetail
-- ----------------------------
DROP TABLE IF EXISTS `tbl_notedetail`;
CREATE TABLE `tbl_notedetail` (
  `nid` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `petid` int(10) NOT NULL,
  `ndescription` longtext NOT NULL,
  `ndate` date NOT NULL,
  `nvet` varchar(50) NOT NULL,
  PRIMARY KEY (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_notedetail
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_petprofile
-- ----------------------------
DROP TABLE IF EXISTS `tbl_petprofile`;
CREATE TABLE `tbl_petprofile` (
  `petid` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_petprofile
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_record
-- ----------------------------
DROP TABLE IF EXISTS `tbl_record`;
CREATE TABLE `tbl_record` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `petid` int(11) NOT NULL,
  `rdate` date NOT NULL,
  `rweight` varchar(10) NOT NULL,
  `rtemp` varchar(10) NOT NULL,
  `rhistory` longtext NOT NULL,
  `rtreatment` longtext NOT NULL,
  `rvet` varchar(25) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_record
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_scheduler
-- ----------------------------
DROP TABLE IF EXISTS `tbl_scheduler`;
CREATE TABLE `tbl_scheduler` (
  `qid` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `petid` int(10) NOT NULL,
  `qdescription` longtext NOT NULL,
  `qdate` date NOT NULL,
  `qstatus` varchar(10) NOT NULL,
  `qtime` time NOT NULL,
  `qset` enum('0','1') NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_scheduler
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_sms
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sms`;
CREATE TABLE `tbl_sms` (
  `xid` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(11) NOT NULL,
  `xtime` time NOT NULL,
  `xdate` date NOT NULL,
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
  `bodypart` varchar(50) NOT NULL,
  `symptom` varchar(50) NOT NULL,
  `diagnosis` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `pettype` varchar(50) NOT NULL,
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
  `useremail` varchar(50) NOT NULL,
  `userpassword` varchar(50) NOT NULL,
  `userfname` varchar(50) NOT NULL,
  `usermname` varchar(50) DEFAULT NULL,
  `userlname` varchar(50) NOT NULL,
  `userbdate` date DEFAULT NULL,
  `usergender` char(1) DEFAULT NULL,
  `userstreet` varchar(50) DEFAULT NULL,
  `userdistrict` varchar(50) DEFAULT NULL,
  `usermunicipality` varchar(50) NOT NULL,
  `userprovince` varchar(50) NOT NULL,
  `userpict` varchar(50) NOT NULL,
  `userstatus` enum('0','1') NOT NULL,
  `usermobile` varchar(12) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tbl_userlist
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_vaxxinfo
-- ----------------------------
DROP TABLE IF EXISTS `tbl_vaxxinfo`;
CREATE TABLE `tbl_vaxxinfo` (
  `vaxid` int(10) NOT NULL AUTO_INCREMENT,
  `vaxname` varchar(50) NOT NULL,
  `vaxtype` varchar(50) NOT NULL,
  `vaxbrand` varchar(50) NOT NULL,
  `vaxdes` varchar(50) NOT NULL,
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
