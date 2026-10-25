-- Clinic Patient and Panel Management System: schema + DUMMY data only.
-- Import via phpMyAdmin (Import tab). Creates database `cmsdb`.
-- Fixes vs the original dump: added missing department row 1, added tblstaff.UserName,
-- repointed task-tracking rows to existing tasks, replaced placeholder values.

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2024 at 10:42 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmsdb`
--
CREATE DATABASE IF NOT EXISTS `cmsdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cmsdb`;

-- --------------------------------------------------------


--
-- Table structure for table `tbldepartment`
--

CREATE TABLE `tbldepartment` (
  `ID` int(5) NOT NULL,
  `DepartmentName` varchar(250) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbldepartment`
--

INSERT INTO `tbldepartment` (`ID`, `DepartmentName`, `CreationDate`) VALUES
(1, 'Administration', '2022-03-15 07:34:30'),
(2, 'Doctor', '2022-03-15 07:34:38'),
(3, 'Technical', '2022-03-15 07:34:48'),
(5, 'Nurse', '2022-03-15 07:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatient`
--

CREATE TABLE `tblpatient` (
  `ID` int(5) NOT NULL,
  `NricId` varchar(100) DEFAULT NULL,
  `PatientName` varchar(200) DEFAULT NULL,
  `PatientEmail` varchar(200) DEFAULT NULL,
  `PatientContactNumber` bigint(10) DEFAULT NULL,
  `Dateofbirth` date DEFAULT NULL,
  `PatientAddress` varchar(250) DEFAULT NULL,
  `FamilyMemberName1` varchar(250) DEFAULT NULL,
  `FamilyMemberName2` varchar(250) DEFAULT NULL,
  `Panel` varchar(255) NOT NULL,
  `DateofRegister` date DEFAULT NULL,
  `Gender` varchar(200) DEFAULT NULL,
  `PatientDescription` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpatient`
--

INSERT INTO `tblpatient` (`ID`, `NricId`, `PatientName`, `PatientEmail`, `PatientContactNumber`, `Dateofbirth`, `PatientAddress`, `FamilyMemberName1`, `FamilyMemberName2`, `Panel`, `DateofRegister`, `Gender`, `PatientDescription`, `CreationDate`, `UpdationDate`) VALUES
(1, '123456789012', 'Lee', 'lee@example.com', 1234567890, '1990-01-15', '123 Main Street, Cityville', 'Jane Doe', 'James Doe', '', '2023-01-15', 'Male', 'Regular check-up', '2023-01-14 18:00:00', '2024-02-18 19:31:21'),
(2, '234567890123', 'Smith', 'smith@example.com', 9876543210, '1985-05-20', '456 Elm Street, Townsville', 'John Smith', 'Jessica Smith', '', '2023-02-20', 'Female', 'cancer patient', '2023-02-19 17:30:00', '2024-02-18 20:21:00'),
(3, '345678901234', 'Johnson', 'johnson@example.com', 5555555555, '1978-09-10', '789 Oak Avenue, Villageton', 'Bob Johnson', 'Emily Johnson', '', '2023-03-10', 'Female', 'X-ray scan', '2023-03-09 19:45:00', '2024-02-18 18:50:10'),
(4, '456789012345', 'Michael Brown', 'michaelbrown@example.com', 1112223333, '1982-03-05', '101 Pine Road, Hamletville', 'Sarah Brown', 'Matthew Brown', '', '2023-04-05', 'Male', 'Medical History\r\nPatient has a history of hypertension and diabetes. No known allergies. Previous surgeries include appendectomy in 2010 and knee arthroscopy in 2015.', '2023-04-04 22:20:00', '2024-02-18 20:18:14'),
(5, '0012334211', 'Sample Patient', 'sample@example.com', 1231231234, '2024-02-20', '1 Sample Road, Sample Town', 'David', 'Ruby', '', '2024-02-22', 'Male', 'X-ray scan', '2024-02-18 09:38:48', '2024-02-18 19:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `tblstaff`
--

CREATE TABLE `tblstaff` (
  `ID` int(10) NOT NULL,
  `StaffName` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `StaffRegdate` timestamp NULL DEFAULT current_timestamp(),
  `StaffId` varchar(100) DEFAULT NULL,
  `Position` varchar(200) DEFAULT NULL,
  `StaffDateOfBirth` date DEFAULT NULL,
  `StaffAddress` varchar(250) DEFAULT NULL,
  `DateOfJoining` date DEFAULT NULL,
  `ProfilePic` varchar(250) DEFAULT NULL,
  `DepartmentID` int(5) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstaff`
--

INSERT INTO `tblstaff` (`ID`, `StaffName`, `UserName`, `MobileNumber`, `Email`, `Password`, `StaffRegdate`, `StaffId`, `Position`, `StaffDateOfBirth`, `StaffAddress`, `DateOfJoining`, `ProfilePic`, `DepartmentID`, `CreationDate`, `UpdationDate`) VALUES
(1, 'John Doe', 'STAFF001', 1234567890, 'john@example.com', 'f925916e2754e5e03f75dd58a5733251', '2024-02-18 06:56:53', 'STAFF001', 'Doctor', '1990-05-15', '123 Main Street, City, Country', '2023-01-01', '18774bd590aa11e3cea58208eb5b52031647347253.jpg', 1, '2024-02-18 06:56:53', '2024-02-18 15:58:22'),
(2, 'Jane Smith', 'STAFF002', 9876543210, 'jane@example.com', 'f925916e2754e5e03f75dd58a5733251', '2024-02-18 06:56:53', 'STAFF002', 'Nurse', '1988-08-20', '456 Elm Street, City, Country', '2023-02-01', '18774bd590aa11e3cea58208eb5b52031647347253.jpg', 3, '2024-02-18 06:56:53', '2024-02-18 07:55:53'),
(3, 'Demo Trainee', 'STAFF003', 132126999, 'test@example.com', '202cb962ac59075b964b07152d234b70', '2024-02-18 18:19:10', 'STAFF003', 'Trainee ', '2024-02-21', '789 Oak Street, City, Country', '2024-02-21', '18774bd590aa11e3cea58208eb5b52031647347253.jpg', 1, '2024-02-18 18:19:10', '2024-02-18 18:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbltask`
--

CREATE TABLE `tbltask` (
  `ID` int(5) NOT NULL,
  `DeptID` int(5) DEFAULT NULL,
  `AssignTaskto` int(5) DEFAULT NULL,
  `TaskPriority` varchar(100) DEFAULT NULL,
  `TaskTitle` varchar(250) DEFAULT NULL,
  `PatientName` varchar(255) NOT NULL,
  `TaskDescription` mediumtext DEFAULT NULL,
  `TaskEnddate` date DEFAULT NULL,
  `TaskAssigndate` timestamp NULL DEFAULT current_timestamp(),
  `Status` varchar(200) DEFAULT NULL,
  `WorkCompleted` varchar(250) DEFAULT NULL,
  `Remark` varchar(250) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbltask`
--

INSERT INTO `tbltask` (`ID`, `DeptID`, `AssignTaskto`, `TaskPriority`, `TaskTitle`, `PatientName`, `TaskDescription`, `TaskEnddate`, `TaskAssigndate`, `Status`, `WorkCompleted`, `Remark`, `UpdationDate`) VALUES
(1, 1, 1, 'Medium', 'Allergic', 'Lee', 'Treatments-Patient prescribed with amoxicillin/clavulanic acid for 7 days for acute sinusitis. Advised to use nasal saline spray and steam inhalation for symptomatic relief.', '2024-02-21', '2024-02-18 16:53:32', NULL, NULL, NULL, NULL),
(2, 3, 2, 'Medium', 'cancer patient', 'Smith', 'Diagnosis-Patient presents with symptoms of fever, cough, and shortness of breath. Chest X-ray shows bilateral infiltrates consistent with pneumonia. Tested positive for COVID-19.', '2024-03-09', '2024-02-18 17:38:41', 'Completed', '100', 'Patient done consult, have given prescription medicine to follow', NULL),
(3, 3, 3, 'Normal', 'cancer patient', 'Michael Brown', 'Medical History- Patient has a history of hypertension and diabetes. No known allergies. Previous surgeries include appendectomy in 2010 and knee arthroscopy in 2015.', '2024-02-28', '2024-02-18 18:55:59', 'Completed', '100', 'completed 6 Chemotherapy section', NULL),
(4, 1, 3, 'Urgent', 'kidney failure', 'Smith', 'X-Ray', '2024-02-22', '2024-02-18 20:02:27', 'Inprogress', '60', 'make appointment for x-ray on next tuesday , room xray 1', NULL),
(5, 1, 3, 'Urgent', 'cancer patient', 'michael brown', 'xxxxxx', '2024-02-23', '2024-02-18 20:30:21', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbltasktracking`
--

CREATE TABLE `tbltasktracking` (
  `ID` int(10) NOT NULL,
  `TaskID` int(10) DEFAULT NULL,
  `Remark` varchar(250) DEFAULT NULL,
  `Status` varchar(100) DEFAULT NULL,
  `WorkCompleted` varchar(200) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbltasktracking`
--

INSERT INTO `tbltasktracking` (`ID`, `TaskID`, `Remark`, `Status`, `WorkCompleted`, `UpdationDate`) VALUES
(1, 1, 'Work is in progress', 'Inprogress', '65', '2022-03-20 18:30:00'),
(2, 1, 'Task Completed', 'Completed', '100', '2022-03-20 18:30:00'),
(3, 3, 'Task is inprogress', 'Inprogress', '60', '2022-03-23 05:24:25'),
(4, 3, 'Task Completed', 'Completed', '100', '2022-03-23 05:28:14'),
(5, 2, 'Patient done consult, have given prescription medicine to follow', 'Completed', '100', '2024-02-18 18:44:21'),
(6, 3, 'completed 6 Chemotherapy section', 'Completed', '100', '2024-02-18 18:59:32'),
(7, 4, 'make appointment for x-ray on next tuesday , room xray 1', 'Inprogress', '60', '2024-02-18 20:03:58');

--
-- Indexes for dumped tables
--


--
-- Indexes for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblstaff`
--
ALTER TABLE `tblstaff`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_tblstaff_tbldepartment` (`DepartmentID`);

--
-- Indexes for table `tbltask`
--
ALTER TABLE `tbltask`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbltasktracking`
--
ALTER TABLE `tbltasktracking`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbltask`
--
ALTER TABLE `tbltask`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbltasktracking`
--
ALTER TABLE `tbltasktracking`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblstaff`
--
ALTER TABLE `tblstaff`
  ADD CONSTRAINT `FK_tblstaff_tbldepartment` FOREIGN KEY (`DepartmentID`) REFERENCES `tbldepartment` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
