-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2020 at 11:40 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `cardio`
--

CREATE TABLE `cardio` (
  `exercise_id` int(11) NOT NULL,
  `isAerobic` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cardio`
--

INSERT INTO `cardio` (`exercise_id`, `isAerobic`) VALUES
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `difficulty` char(20) DEFAULT NULL,
  `location` char(20) DEFAULT NULL,
  `name` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `difficulty`, `location`, `name`) VALUES
(1, 'easy', 'room 1', 'Beginner fitness'),
(2, 'easy', 'room 2', 'beginner fitness'),
(3, 'medium', 'room 3', 'intermediate fitness'),
(4, 'medium', 'room 4', 'intermediate fitness'),
(5, 'hard', 'room 5', 'advanced fitness');

-- --------------------------------------------------------

--
-- Table structure for table `classes_assigned_to_timeslot`
--

CREATE TABLE `classes_assigned_to_timeslot` (
  `class_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes_assigned_to_timeslot`
--

INSERT INTO `classes_assigned_to_timeslot` (`class_id`, `time`, `date`) VALUES
(1, '10:00:00', '2020-05-20'),
(1, '11:00:00', '2020-05-20'),
(2, '10:00:00', '2020-05-20'),
(3, '10:00:00', '2020-05-20'),
(4, '12:00:00', '2020-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `classes_consists_of_exercises`
--

CREATE TABLE `classes_consists_of_exercises` (
  `class_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes_consists_of_exercises`
--

INSERT INTO `classes_consists_of_exercises` (`class_id`, `exercise_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 4),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `develops`
--

CREATE TABLE `develops` (
  `plan_id` int(11) NOT NULL,
  `instr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `develops`
--

INSERT INTO `develops` (`plan_id`, `instr_id`) VALUES
(1, 1),
(2, 3),
(2, 4),
(2, 5),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL,
  `description` char(60) DEFAULT NULL,
  `name` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipment_id`, `description`, `name`) VALUES
(1, 'bench press', 'bench press'),
(2, 'multiple exercises', 'bowflex'),
(3, 'multiple exercises', 'squat rack'),
(4, 'regular treadmill', 'treadmill'),
(5, 'high incline treadmill', 'treadmill');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `exercise_id` int(11) NOT NULL,
  `name` char(40) DEFAULT NULL,
  `type` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`exercise_id`, `name`, `type`) VALUES
(1, 'bb shoulder press', 'strength'),
(2, 'bb bench press', 'strength'),
(3, 'leg press', 'strength'),
(4, 'treadmill', 'endurance'),
(5, 'stair master', 'endurance'),
(6, 'rowing', 'endurance'),
(7, 'swimming', 'endurance'),
(8, 'sprints', 'strength'),
(9, 'bicep curls', 'strength'),
(10, 'weighted pull ups', 'strength');

-- --------------------------------------------------------

--
-- Table structure for table `fitness_plan`
--

CREATE TABLE `fitness_plan` (
  `plan_id` int(11) NOT NULL,
  `category` char(20) DEFAULT NULL,
  `weeks_to_complete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fitness_plan`
--

INSERT INTO `fitness_plan` (`plan_id`, `category`, `weeks_to_complete`) VALUES
(1, 'weightloss', 12),
(2, 'upper body strength', 23),
(3, 'weightloss', 8),
(4, 'lower body strength', 4),
(5, 'distance running', 12);

-- --------------------------------------------------------

--
-- Table structure for table `fitness_plan_consists_of_classes`
--

CREATE TABLE `fitness_plan_consists_of_classes` (
  `plan_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fitness_plan_consists_of_classes`
--

INSERT INTO `fitness_plan_consists_of_classes` (`plan_id`, `class_id`) VALUES
(2, 1),
(2, 3),
(2, 5),
(4, 1),
(4, 3),
(4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `plan_id` int(11) NOT NULL,
  `gym_id` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`plan_id`, `gym_id`, `date`) VALUES
(1, 1, '2019-10-10'),
(2, 1, '2019-10-10'),
(3, 1, '2019-10-10'),
(4, 2, '2020-01-05'),
(5, 3, '2020-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `guest_member`
--

CREATE TABLE `guest_member` (
  `gym_id` int(11) NOT NULL,
  `name` char(20) NOT NULL,
  `relation` char(20) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guest_member`
--

INSERT INTO `guest_member` (`gym_id`, `name`, `relation`, `dob`) VALUES
(1, 'Emily Wong', 'wife', '1985-01-01'),
(1, 'Ken Wong', 'son', '2010-01-01'),
(1, 'Sara Wong', 'daughter', '2012-01-01'),
(2, 'Ted Williams', 'friend', '1990-04-01'),
(3, 'Sam Moore', 'son', '2014-03-22');

-- --------------------------------------------------------

--
-- Table structure for table `gymmember`
--

CREATE TABLE `gymmember` (
  `gym_id` int(11) NOT NULL,
  `name` char(20) DEFAULT NULL,
  `phone` char(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` char(40) DEFAULT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gymmember`
--

INSERT INTO `gymmember` (`gym_id`, `name`, `phone`, `dob`, `address`, `password`) VALUES
(1, 'Jeff Wong', '6041112222', '1982-07-02', '123 Fake Street', 'password'),
(2, 'Tony Jones', '6048675309', '1972-07-02', '123 Fake Street', 'password'),
(3, 'Dana Moore', '7781234567', '1981-04-22', '233 Main Street', 'password'),
(4, 'Zach Brown', '778-123-4567', '1970-07-09', '742 evergeen terrace', 'password'),
(5, 'Timmy Johnson', '778-222-3267', '1975-11-03', '8290 main street', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `instr_id` int(11) NOT NULL,
  `name` char(20) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `specialty` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instr_id`, `name`, `start_date`, `specialty`) VALUES
(1, 'Brad Smith', '2010-01-01', 'swimming'),
(2, 'Sally May', '2010-01-01', 'kettlebells'),
(3, 'Scooby Doo', '2012-01-07', 'barbells'),
(4, 'Bobby Hill', '2012-01-07', 'barbells'),
(5, 'Scruff Mcruff', '2008-05-10', 'olympic lifts');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `instr_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`instr_id`, `class_id`) VALUES
(3, 1),
(3, 2),
(3, 4),
(4, 4),
(4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `lift`
--

CREATE TABLE `lift` (
  `gym_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `reps` int(11) DEFAULT NULL,
  `sets` int(11) DEFAULT NULL,
  `weight_in_kg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lift`
--

INSERT INTO `lift` (`gym_id`, `exercise_id`, `time`, `date`, `reps`, `sets`, `weight_in_kg`) VALUES
(1, 1, '10:00:00', '2020-05-20', 8, 3, 20),
(1, 1, '11:00:00', '2020-05-20', 8, 3, 20),
(1, 2, '13:00:00', '2020-05-20', 8, 3, 20),
(1, 3, '15:00:00', '2020-05-20', 6, 2, 20),
(1, 9, '14:00:00', '2020-05-20', 2, 3, 40);

-- --------------------------------------------------------

--
-- Table structure for table `location_capacity`
--

CREATE TABLE `location_capacity` (
  `location` char(20) NOT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location_capacity`
--

INSERT INTO `location_capacity` (`location`, `capacity`) VALUES
('room 1', 20),
('room 2', 30),
('room 3', 20),
('room 4', 50),
('room 5', 10);

-- --------------------------------------------------------

--
-- Table structure for table `muscle`
--

CREATE TABLE `muscle` (
  `name` char(40) NOT NULL,
  `muscle_group` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `muscle`
--

INSERT INTO `muscle` (`name`, `muscle_group`) VALUES
('biceps brachii', 'bicep'),
('Deltoid, Anterior', 'shoulder'),
('latissimus dorsi', 'back'),
('Pectoralis Major, Sternal', 'chest'),
('triceps brachii', 'tricep');

-- --------------------------------------------------------

--
-- Table structure for table `perform`
--

CREATE TABLE `perform` (
  `gym_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `distance_in_km` int(11) DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `avg_HR` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perform`
--

INSERT INTO `perform` (`gym_id`, `exercise_id`, `time`, `date`, `distance_in_km`, `duration`, `avg_HR`) VALUES
(1, 4, '11:00:00', '2020-05-20', 5, '00:20:00', 85),
(3, 4, '10:00:00', '2020-05-20', 5, '00:10:00', 80),
(3, 5, '11:00:00', '2020-05-20', 3, '00:12:00', 70),
(3, 6, '12:00:00', '2020-05-20', 2, '00:25:00', 90),
(4, 5, '10:00:00', '2020-05-20', 10, '00:45:20', 140),
(5, 4, '10:00:00', '2020-05-20', 2, '00:08:00', 60);

-- --------------------------------------------------------

--
-- Table structure for table `specialty_type`
--

CREATE TABLE `specialty_type` (
  `specialty` char(20) NOT NULL,
  `type` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specialty_type`
--

INSERT INTO `specialty_type` (`specialty`, `type`) VALUES
('barbells', 'strength'),
('kettlebells', 'strength'),
('olympic lifts', 'strength'),
('sprinting', 'endurance'),
('swimming', 'endurance');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `time` time NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`time`, `date`) VALUES
('10:00:00', '2020-05-20'),
('11:00:00', '2020-05-20'),
('12:00:00', '2020-05-20'),
('13:00:00', '2020-05-20'),
('14:00:00', '2020-05-20'),
('15:00:00', '2020-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `uses`
--

CREATE TABLE `uses` (
  `exercise_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uses`
--

INSERT INTO `uses` (`exercise_id`, `equipment_id`) VALUES
(2, 1),
(2, 2),
(3, 2),
(10, 2),
(10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `weights`
--

CREATE TABLE `weights` (
  `exercise_id` int(11) NOT NULL,
  `spotter_recommended` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weights`
--

INSERT INTO `weights` (`exercise_id`, `spotter_recommended`) VALUES
(1, 1),
(2, 1),
(3, 1),
(9, 0),
(10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `exercise_id` int(11) NOT NULL,
  `name` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`exercise_id`, `name`) VALUES
(1, 'Deltoid, Anterior'),
(1, 'triceps brachii'),
(2, 'Deltoid, Anterior'),
(2, 'Pectoralis Major, Sternal'),
(2, 'triceps brachii');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cardio`
--
ALTER TABLE `cardio`
  ADD PRIMARY KEY (`exercise_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `location` (`location`);

--
-- Indexes for table `classes_assigned_to_timeslot`
--
ALTER TABLE `classes_assigned_to_timeslot`
  ADD PRIMARY KEY (`class_id`,`time`,`date`),
  ADD KEY `time` (`time`,`date`);

--
-- Indexes for table `classes_consists_of_exercises`
--
ALTER TABLE `classes_consists_of_exercises`
  ADD PRIMARY KEY (`class_id`,`exercise_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Indexes for table `develops`
--
ALTER TABLE `develops`
  ADD PRIMARY KEY (`plan_id`,`instr_id`),
  ADD KEY `instr_id` (`instr_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`exercise_id`);

--
-- Indexes for table `fitness_plan`
--
ALTER TABLE `fitness_plan`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `fitness_plan_consists_of_classes`
--
ALTER TABLE `fitness_plan_consists_of_classes`
  ADD PRIMARY KEY (`plan_id`,`class_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`plan_id`,`gym_id`),
  ADD KEY `gym_id` (`gym_id`);

--
-- Indexes for table `guest_member`
--
ALTER TABLE `guest_member`
  ADD PRIMARY KEY (`gym_id`,`name`);

--
-- Indexes for table `gymmember`
--
ALTER TABLE `gymmember`
  ADD PRIMARY KEY (`gym_id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`instr_id`),
  ADD KEY `specialty` (`specialty`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`class_id`,`instr_id`),
  ADD KEY `instr_id` (`instr_id`);

--
-- Indexes for table `lift`
--
ALTER TABLE `lift`
  ADD PRIMARY KEY (`gym_id`,`exercise_id`,`time`,`date`),
  ADD KEY `exercise_id` (`exercise_id`),
  ADD KEY `time` (`time`,`date`);

--
-- Indexes for table `location_capacity`
--
ALTER TABLE `location_capacity`
  ADD PRIMARY KEY (`location`);

--
-- Indexes for table `muscle`
--
ALTER TABLE `muscle`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `perform`
--
ALTER TABLE `perform`
  ADD PRIMARY KEY (`gym_id`,`exercise_id`,`time`,`date`),
  ADD KEY `exercise_id` (`exercise_id`),
  ADD KEY `time` (`time`,`date`);

--
-- Indexes for table `specialty_type`
--
ALTER TABLE `specialty_type`
  ADD PRIMARY KEY (`specialty`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`time`,`date`);

--
-- Indexes for table `uses`
--
ALTER TABLE `uses`
  ADD PRIMARY KEY (`exercise_id`,`equipment_id`),
  ADD KEY `equipment_id` (`equipment_id`);

--
-- Indexes for table `weights`
--
ALTER TABLE `weights`
  ADD PRIMARY KEY (`exercise_id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`exercise_id`,`name`),
  ADD KEY `name` (`name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cardio`
--
ALTER TABLE `cardio`
  ADD CONSTRAINT `cardio_ibfk_1` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`exercise_id`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`location`) REFERENCES `location_capacity` (`location`) ON DELETE SET NULL;

--
-- Constraints for table `classes_assigned_to_timeslot`
--
ALTER TABLE `classes_assigned_to_timeslot`
  ADD CONSTRAINT `classes_assigned_to_timeslot_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `classes_assigned_to_timeslot_ibfk_2` FOREIGN KEY (`time`,`date`) REFERENCES `timeslot` (`time`, `date`);

--
-- Constraints for table `classes_consists_of_exercises`
--
ALTER TABLE `classes_consists_of_exercises`
  ADD CONSTRAINT `classes_consists_of_exercises_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `classes_consists_of_exercises_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`exercise_id`);

--
-- Constraints for table `develops`
--
ALTER TABLE `develops`
  ADD CONSTRAINT `develops_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `fitness_plan` (`plan_id`),
  ADD CONSTRAINT `develops_ibfk_2` FOREIGN KEY (`instr_id`) REFERENCES `instructor` (`instr_id`);

--
-- Constraints for table `fitness_plan_consists_of_classes`
--
ALTER TABLE `fitness_plan_consists_of_classes`
  ADD CONSTRAINT `fitness_plan_consists_of_classes_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `fitness_plan` (`plan_id`),
  ADD CONSTRAINT `fitness_plan_consists_of_classes_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `fitness_plan` (`plan_id`),
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`gym_id`) REFERENCES `gymmember` (`gym_id`);

--
-- Constraints for table `guest_member`
--
ALTER TABLE `guest_member`
  ADD CONSTRAINT `guest_member_ibfk_1` FOREIGN KEY (`gym_id`) REFERENCES `gymmember` (`gym_id`) ON DELETE CASCADE;

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`specialty`) REFERENCES `specialty_type` (`specialty`) ON DELETE SET NULL;

--
-- Constraints for table `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_ibfk_1` FOREIGN KEY (`instr_id`) REFERENCES `instructor` (`instr_id`),
  ADD CONSTRAINT `leads_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `lift`
--
ALTER TABLE `lift`
  ADD CONSTRAINT `lift_ibfk_1` FOREIGN KEY (`gym_id`) REFERENCES `gymmember` (`gym_id`),
  ADD CONSTRAINT `lift_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `weights` (`exercise_id`),
  ADD CONSTRAINT `lift_ibfk_3` FOREIGN KEY (`time`,`date`) REFERENCES `timeslot` (`time`, `date`);

--
-- Constraints for table `perform`
--
ALTER TABLE `perform`
  ADD CONSTRAINT `perform_ibfk_1` FOREIGN KEY (`gym_id`) REFERENCES `gymmember` (`gym_id`),
  ADD CONSTRAINT `perform_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `cardio` (`exercise_id`),
  ADD CONSTRAINT `perform_ibfk_3` FOREIGN KEY (`time`,`date`) REFERENCES `timeslot` (`time`, `date`);

--
-- Constraints for table `uses`
--
ALTER TABLE `uses`
  ADD CONSTRAINT `uses_ibfk_1` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`),
  ADD CONSTRAINT `uses_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`exercise_id`);

--
-- Constraints for table `weights`
--
ALTER TABLE `weights`
  ADD CONSTRAINT `weights_ibfk_1` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`exercise_id`);

--
-- Constraints for table `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `works_ibfk_1` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`exercise_id`),
  ADD CONSTRAINT `works_ibfk_2` FOREIGN KEY (`name`) REFERENCES `muscle` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
