-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 04, 2022 at 01:17 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `giwm`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `AccessManagementGet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AccessManagementGet` (IN `departmentCode` VARCHAR(250), IN `roleCode` VARCHAR(250))  BEGIN   

 select
                  access.AccessId
                  ,department.DepartmentCode
                  ,department.DepartmentDesc
                  ,role.RoleCode
                  ,role.RoleDesc
                  ,accesslevel.AccessLevelCode
                  ,accesslevel.AccessLevelDesc
                  ,accesslevel.Seq accesslevelSeq
                  ,app.AppCode
                  ,app.AppDesc
              from access
              left join department
                on department.DepartmentId = access.DepartmentId
              left join role
                on role.RoleId = access.RoleId
                 
              inner join accesslevel
                on accesslevel.AccessLevelId = access.AccessLevelId
              inner join app
                on app.AppId = access.AppId
              where ifnull(department.DepartmentCode,'') = ifnull(departmentCode, ifnull(department.DepartmentCode,''))
              and ifnull(role.RoleCode,'') = ifnull(roleCode, ifnull(role.RoleCode,''));
	END$$

DROP PROCEDURE IF EXISTS `AccessManagementGetUsers`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AccessManagementGetUsers` ()  BEGIN   

SELECT 
user.UserId,
	concat(FirstName , ' ' , LastName) as Name
    ,department.DepartmentDesc as Department
    ,role.RoleDesc as Role
from user 
inner join department
	on department.DepartmentId = user.DepartmentId
inner join role
	on role.RoleId = user.RoleId;
	
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

DROP TABLE IF EXISTS `access`;
CREATE TABLE IF NOT EXISTS `access` (
  `AccessId` int NOT NULL AUTO_INCREMENT,
  `DepartmentId` int DEFAULT NULL,
  `RoleId` int DEFAULT NULL,
  `AccessLevelId` int DEFAULT NULL,
  `AppId` int DEFAULT NULL,
  PRIMARY KEY (`AccessId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`AccessId`, `DepartmentId`, `RoleId`, `AccessLevelId`, `AppId`) VALUES
(1, NULL, 2, 1, 1),
(2, NULL, 2, 1, 2),
(3, 1, 1, 2, 1),
(4, 1, 1, 3, 2),
(5, 2, 1, 3, 1),
(6, 3, 4, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `accesslevel`
--

DROP TABLE IF EXISTS `accesslevel`;
CREATE TABLE IF NOT EXISTS `accesslevel` (
  `AccessLevelId` int NOT NULL AUTO_INCREMENT,
  `AccessLevelCode` varchar(200) NOT NULL,
  `AccessLevelDesc` varchar(255) NOT NULL,
  `Seq` int DEFAULT NULL,
  PRIMARY KEY (`AccessLevelId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accesslevel`
--

INSERT INTO `accesslevel` (`AccessLevelId`, `AccessLevelCode`, `AccessLevelDesc`, `Seq`) VALUES
(1, 'USER', 'User', 1),
(2, 'DEPARTMENT', 'Department', 2),
(3, 'ADMIN', 'Admin', 3);

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

DROP TABLE IF EXISTS `app`;
CREATE TABLE IF NOT EXISTS `app` (
  `AppId` int NOT NULL AUTO_INCREMENT,
  `AppCode` varchar(200) NOT NULL,
  `AppDesc` varchar(255) NOT NULL,
  `Seq` int DEFAULT NULL,
  PRIMARY KEY (`AppId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app`
--

INSERT INTO `app` (`AppId`, `AppCode`, `AppDesc`, `Seq`) VALUES
(1, 'ASSET_MANAGEMENT', 'Asset', 1),
(2, 'TICKET', 'Ticket', 2),
(3, 'SYSTEM', 'UniFork', 3);

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

DROP TABLE IF EXISTS `asset`;
CREATE TABLE IF NOT EXISTS `asset` (
  `AssetId` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(500)  DEFAULT NULL,
  `Tag` varchar(255) NOT NULL,
  `Description` varchar(500)  NOT NULL,
  `Category` varchar(500)  NOT NULL,
  `AssignToUserId` int DEFAULT NULL,
  `OwnerDepartmentId` int NOT NULL,
  `Status` varchar(200) NOT NULL,
  PRIMARY KEY (`AssetId`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`AssetId`, `Name`, `Tag`, `Description`, `Category`, `AssignToUserId`, `OwnerDepartmentId`, `Status`) VALUES
(1, NULL, '153452858', 'Macbook Pro 13\"', 'Laptops', 1, 2, 'Ready'),
(3, NULL, '500710096', 'Ultrasharp U2415', 'Displays', 1, 2, 'Ready'),
(4, NULL, '1632369786', 'Ultrasharp U2415', 'Displays', 1, 2, 'Ready'),
(5, NULL, '670400149', 'iPhone 12', 'Mobile Phones', 0, 2, 'Ready'),
(6, NULL, '860709527', 'Ultrafine 4k', 'Displays', 0, 2, 'Ready'),
(7, NULL, '853492840', 'Macbook Pro 17\"', 'Laptops', 0, 1, 'NotReady'),
(8, NULL, '1560239159', 'Macbook Pro 13\"', 'Laptops', 0, 4, 'Ready'),
(9, NULL, '502188396', 'Ultrasharp U2415', 'Displays', 0, 1, 'Ready'),
(10, NULL, '952329280', 'Ultrasharp U2415', 'Displays', 0, 1, 'NotReady'),
(11, NULL, '523380997', 'iPhone 12', 'Mobile Phones', 3, 1, 'Ready'),
(12, NULL, '695210110', 'Ultrafine 4k', 'Displays', 3, 1, 'Ready'),
(13, NULL, '406332870', 'Macbook Pro 17\"', 'Laptops', 3, 1, 'Ready'),
(14, NULL, '1298601472', 'Macbook Pro 17\"', 'Laptops', 4, 3, 'Ready'),
(15, NULL, '212992175', 'iPhone 12', 'Mobile Phones', 4, 3, 'Ready'),
(16, NULL, '556821350', 'OptiPlex', 'Desktops', 4, 3, 'Ready'),
(17, NULL, '524152416', 'Ultrafine 4k', 'Displays', 5, 1, 'Ready'),
(18, NULL, '65245125', 'Macbook Pro 17\"', 'Laptops', 5, 1, 'Ready');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `DepartmentId` int NOT NULL AUTO_INCREMENT,
  `DepartmentCode` varchar(200) NOT NULL,
  `DepartmentDesc` varchar(255) NOT NULL,
  PRIMARY KEY (`DepartmentId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DepartmentId`, `DepartmentCode`, `DepartmentDesc`) VALUES
(1, 'SUPPORT', 'Support'),
(2, 'ACCOUNT', 'Accounting'),
(3, 'ADMIN', 'System Admin');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `RoleId` int NOT NULL AUTO_INCREMENT,
  `RoleCode` varchar(200) NOT NULL,
  `RoleDesc` varchar(255) NOT NULL,
  PRIMARY KEY (`RoleId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleId`, `RoleCode`, `RoleDesc`) VALUES
(1, 'MANAGER', 'Manager'),
(2, 'USER', 'User'),
(3, 'DEVELOPER', 'Developer'),
(4, 'ADMIN', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `TicketId` int NOT NULL AUTO_INCREMENT,
  `Number` int NOT NULL,
  `Description` varchar(8000) NOT NULL,
  `Status` varchar(250) NOT NULL,
  `Priority` varchar(250) NOT NULL,
  `UserId` int NOT NULL,
  PRIMARY KEY (`TicketId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`TicketId`, `Number`, `Description`, `Status`, `Priority`, `UserId`) VALUES
(1, 2541, 'Someone did not make coffee in the breakroom.', 'Open', 'High', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `UserId` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(200) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `DepartmentId` int NOT NULL,
  `RoleId` int NOT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserName` (`UserName`),
  UNIQUE KEY `Email` (`Email`),
  KEY `DepartmentIdFk` (`DepartmentId`),
  KEY `RoleIdFk` (`RoleId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `UserName`, `PasswordHash`, `FirstName`, `LastName`, `Email`, `DepartmentId`, `RoleId`) VALUES
(1, 'jsmith', '$2a$10$Cb2lsRBkF6jdM3egs9RUj.mGxsYVmDDLD7GydUhWO3x5u.zHuJmz6', 'John', 'Smith', 'john.smith@unifork.com', 2, 2),
(3, 'sdu', '$2a$10$2cUhjf5EaVnflOCxhv0/9e5yCBjN12LLARwmaBDf/keFzRFG7GWuC', 'Scott', 'Du', 'scott.du@unifork.com', 1, 1),
(4, 'ksun', '$2a$10$E.DaGyI2bU/W3tMbPNouWehGGlk.un/zD/Nxn1ZaKCvu6C7uSqwsu', 'Kate', 'Sun', 'kate.sun@unifork.com', 3, 4),
(5, 'esummer', '$2a$10$yA1Fyt95LXCn3TtkN11gtuBOixjrK8d0Mu29ajVHUgBGUuiJeMBHm', 'Ellen', 'Summer', 'ellen.summer@unifork.com', 1, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
