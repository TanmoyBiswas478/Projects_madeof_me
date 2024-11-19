-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2024 at 01:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@sw.tb', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `qid` text NOT NULL,
  `ansid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`qid`, `ansid`) VALUES
('67358e2fe853f', '67358e2fe8c65'),
('67358e2fea64f', '67358e2feaa1e'),
('67358e2fec08c', '67358e2fecbd8'),
('67358e2fee2be', '67358e2fee774'),
('67358e2fefbd3', '67358e2ff0028'),
('67358e2ff1768', '67358e2ff1d96'),
('67358e2ff3f16', '67358e30002b4'),
('67358e3001e1f', '67358e30023bc'),
('67358e3003f4f', '67358e30045a0'),
('67358e3006407', '67358e3006990'),
('67358e30080d0', '67358e30084fa'),
('67358e3009b71', '67358e300a032'),
('67358e300bd3a', '67358e300c1f8'),
('67358e300dabd', '67358e300de7a'),
('67358e300f3b9', '67358e300f7d0'),
('67358e301128c', '67358e301180d'),
('67358e301318b', '67358e301361e'),
('67358e3014c16', '67358e30150dc'),
('67358e301683f', '67358e3016d17'),
('67358e3018447', '67358e30188c7'),
('67358e301a0d0', '67358e301a53f'),
('67358e301bb18', '67358e301c189'),
('67358e301d5ba', '67358e301d957'),
('67358e301f19d', '67358e301f700'),
('67358e3021043', '67358e302144c'),
('67358e3022aa8', '67358e3022f1c'),
('67358e30244c2', '67358e30248c3'),
('67358e30258ff', '67358e3025c01'),
('67358e3026834', '67358e3026a84'),
('67358e3027674', '67358e3027918');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `feedback` varchar(500) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `email` varchar(50) NOT NULL,
  `eid` text NOT NULL,
  `score` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `sahi` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `qid` varchar(50) NOT NULL,
  `option` varchar(5000) NOT NULL,
  `optionid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`qid`, `option`, `optionid`) VALUES
('67358e2fe853f', 'object-oriented programming ', '67358e2fe8c5d'),
('67358e2fe853f', 'structured programming ', '67358e2fe8c63'),
('67358e2fe853f', 'functional programming ', '67358e2fe8c64'),
('67358e2fe853f', 'all of the mentioned ', '67358e2fe8c65'),
('67358e2fea64f', 'Static Functions ', '67358e2feaa1a'),
('67358e2fea64f', 'Constant Functions ', '67358e2feaa1c'),
('67358e2fea64f', 'Operator Functions ', '67358e2feaa1d'),
('67358e2fea64f', 'Virtual Functions ', '67358e2feaa1e'),
('67358e2fec08c', '#include [userdefined] ', '67358e2fecbd2'),
('67358e2fec08c', '#include “userdefined” ', '67358e2fecbd8'),
('67358e2fec08c', '#include <userdefined.h> ', '67358e2fecbd9'),
('67358e2fec08c', '#include <userdefined> ', '67358e2fecbda'),
('67358e2fee2be', 'Error', '67358e2fee76e'),
('67358e2fee2be', '6', '67358e2fee773'),
('67358e2fee2be', '4', '67358e2fee774'),
('67358e2fee2be', '3', '67358e2fee775'),
('67358e2fefbd3', 'Tuples', '67358e2ff0023'),
('67358e2fefbd3', 'Lists', '67358e2ff0027'),
('67358e2fefbd3', 'Class', '67358e2ff0028'),
('67358e2fefbd3', 'Dictionary', '67358e2ff0029'),
('67358e2ff1768', 'Default constructor ', '67358e2ff1d90'),
('67358e2ff1768', 'Parameterized constructor ', '67358e2ff1d94'),
('67358e2ff1768', 'Copy constructor ', '67358e2ff1d95'),
('67358e2ff1768', 'Friend constructor ', '67358e2ff1d96'),
('67358e2ff3f16', 'void', '67358e30002b4'),
('67358e2ff3f16', 'null', '67358e30002bb'),
('67358e2ff3f16', 'free', '67358e30002bc'),
('67358e2ff3f16', 'empty', '67358e30002bd'),
('67358e3001e1f', 'Left-right ', '67358e30023b6'),
('67358e3001e1f', 'Right-left ', '67358e30023bb'),
('67358e3001e1f', 'Bottom-up ', '67358e30023bc'),
('67358e3001e1f', 'Top-down ', '67358e30023bd'),
('67358e3003f4f', 'It would return any value', '67358e3004599'),
('67358e3003f4f', 'It may not or may depend on a declared return type of any function. The return type of  the function is different from the passed arguments ', '67358e300459e'),
('67358e3003f4f', 'It would return some value to the caller ', '67358e300459f'),
('67358e3003f4f', 'It will not return any value to the caller ', '67358e30045a0'),
('67358e3006407', '?', '67358e3006988'),
('67358e3006407', '$', '67358e300698f'),
('67358e3006407', '::', '67358e3006990'),
('67358e3006407', 'None', '67358e3006991'),
('67358e30080d0', '129', '67358e30084fa'),
('67358e30080d0', '8', '67358e30084ff'),
('67358e30080d0', '121', '67358e3008500'),
('67358e30080d0', 'None of these', '67358e3008501'),
('67358e3009b71', 'array {10}; ', '67358e300a02a'),
('67358e3009b71', 'array array[10]; ', '67358e300a030'),
('67358e3009b71', 'int array; ', '67358e300a031'),
('67358e3009b71', 'int array [10]; ', '67358e300a032'),
('67358e300bd3a', 'Function ', '67358e300c1f2'),
('67358e300bd3a', 'Def', '67358e300c1f8'),
('67358e300bd3a', 'Fun', '67358e300c1f9'),
('67358e300bd3a', 'Define', '67358e300c1fa'),
('67358e300dabd', 'static; ', '67358e300de74'),
('67358e300dabd', 'auto; ', '67358e300de79'),
('67358e300dabd', 'extern; ', '67358e300de7a'),
('67358e300dabd', 'register; ', '67358e300de88'),
('67358e300f3b9', 'Functions do not provide better modularity for applications ', '67358e300f7cb'),
('67358e300f3b9', 'One can’t create our own functions ', '67358e300f7cf'),
('67358e300f3b9', 'Functions are reusable pieces of programs ', '67358e300f7d0'),
('67358e300f3b9', 'All of the above', '67358e300f7d1'),
('67358e301128c', '*', '67358e3011805'),
('67358e301128c', '&&', '67358e301180b'),
('67358e301128c', '&', '67358e301180c'),
('67358e301128c', '=', '67358e301180d'),
('67358e301318b', '32', '67358e3013618'),
('67358e301318b', '16', '67358e301361c'),
('67358e301318b', '128', '67358e301361d'),
('67358e301318b', 'No fixed length is specified ', '67358e301361e'),
('67358e3014c16', 'Pip Installs Python ', '67358e30150d6'),
('67358e3014c16', 'Pip Installs Packages ', '67358e30150db'),
('67358e3014c16', 'Preferred Installer Program ', '67358e30150dc'),
('67358e3014c16', 'All of the mentioned ', '67358e30150dd'),
('67358e301683f', 'list1.addEnd(5) ', '67358e3016d11'),
('67358e301683f', 'list1.addLast(5) ', '67358e3016d16'),
('67358e301683f', 'list1.append(5)', '67358e3016d17'),
('67358e301683f', 'list1.add(5)', '67358e3016d18'),
('67358e3018447', 'double', '67358e30188bf'),
('67358e3018447', 'float', '67358e30188c5'),
('67358e3018447', 'int', '67358e30188c6'),
('67358e3018447', 'bool', '67358e30188c7'),
('67358e301a0d0', '12', '67358e301a539'),
('67358e301a0d0', '14', '67358e301a53d'),
('67358e301a0d0', '6', '67358e301a53e'),
('67358e301a0d0', '7', '67358e301a53f'),
('67358e301bb18', 'It will cause a compile-time error ', '67358e301c183'),
('67358e301bb18', 'It will cause a run-time error ', '67358e301c188'),
('67358e301bb18', 'It will run without any error and prints 3 ', '67358e301c189'),
('67358e301bb18', 'It will experience infinite looping ', '67358e301c18a'),
('67358e301d5ba', '[1 ,2]', '67358e301d952'),
('67358e301d5ba', '[1, 2, 1, 2] ', '67358e301d956'),
('67358e301d5ba', '[1, 2, 1, 2, 1, 2] ', '67358e301d957'),
('67358e301d5ba', 'Error ', '67358e301d958'),
('67358e301f19d', 'Error in C and successful execution in C++ ', '67358e301f6f9'),
('67358e301f19d', 'Error in both C and C++ ', '67358e301f6ff'),
('67358e301f19d', 'Error in C++ and successful execution in C', '67358e301f700'),
('67358e301f19d', 'A successful run in both C and C++ ', '67358e301f701'),
('67358e3021043', '13', '67358e302144c'),
('67358e3021043', '0', '67358e3021451'),
('67358e3021043', '20', '67358e3021452'),
('67358e3021043', 'None of the Above ', '67358e3021453'),
('67358e3022aa8', 'Compile time error', '67358e3022f1c'),
('67358e3022aa8', 'Hello World! 34', '67358e3022f20'),
('67358e3022aa8', 'Hello World! 1000 ', '67358e3022f21'),
('67358e3022aa8', 'Hello World! followed by a junk value ', '67358e3022f22'),
('67358e30244c2', 'GEEKSFORGEEKS  ', '67358e30248c3'),
('67358e30244c2', 'geeksforgeeks', '67358e30248c8'),
('67358e30244c2', 'Error', '67358e30248c9'),
('67358e30244c2', 'None of the Above ', '67358e30248ca'),
('67358e30258ff', 'Hello', '67358e3025bfb'),
('67358e30258ff', 'World', '67358e3025c00'),
('67358e30258ff', 'Error', '67358e3025c01'),
('67358e30258ff', 'Hello World ', '67358e3025c02'),
('67358e3026834', '[1,2,3] ', '67358e3026a80'),
('67358e3026834', '(1,2,3) ', '67358e3026a83'),
('67358e3026834', 'Error ', '67358e3026a84'),
('67358e3026834', '(2,2,3) ', '67358e3026a85'),
('67358e3027674', '31 13', '67358e3027918'),
('67358e3027674', '31 31', '67358e302791b'),
('67358e3027674', '13 13', '67358e302791c'),
('67358e3027674', '13 31', '67358e302791d');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `eid` text NOT NULL,
  `qid` text NOT NULL,
  `qns` text NOT NULL,
  `choice` int(10) NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`eid`, `qid`, `qns`, `choice`, `sn`) VALUES
('67358aa5106e9', '67358e2fe853f', 'Which type of Programming does Python support? ', 4, 1),
('67358aa5106e9', '67358e2fea64f', 'Which concept do we use for the implementation of late binding? ', 4, 2),
('67358aa5106e9', '67358e2fec08c', 'Which of the following is the correct syntax of including a user defined header file? ', 4, 3),
('67358aa5106e9', '67358e2fee2be', 'What will be the output of the following Python function?\r\nlen([\"hello\",2, 4, 6]) ', 4, 4),
('67358aa5106e9', '67358e2fefbd3', 'Which of the following is not a core data type in Python programming?', 4, 5),
('67358aa5106e9', '67358e2ff1768', 'Which of the following is not a type of Constructor in C++? ', 4, 6),
('67358aa5106e9', '67358e2ff3f16', 'Which of these won’t return any value?', 4, 7),
('67358aa5106e9', '67358e3001e1f', ' Which of the following approach is used by C++?', 4, 8),
('67358aa5106e9', '67358e3003f4f', 'What would happen in case one uses a void in the passing of an argument? ', 4, 9),
('67358aa5106e9', '67358e3006407', 'Identify the scope resolution operator. ', 4, 10),
('67358aa5106e9', '67358e30080d0', 'What will be the output of the following python code? \r\nprint (2**3 + (5 + 6)**(1 + 1))', 4, 11),
('67358aa5106e9', '67358e3009b71', 'Which of the following correctly declares an array in C++? ', 4, 12),
('67358aa5106e9', '67358e300bd3a', 'Which keyword is used for function in Python language?', 4, 13),
('67358aa5106e9', '67358e300dabd', 'Identify the storage classes that have global visibility.', 4, 14),
('67358aa5106e9', '67358e300f3b9', 'Which of the following is the use of function in python?', 4, 15),
('67358aa5106e9', '67358e301128c', 'Which of these operators is used in order to capture every external variable by reference?', 4, 16),
('67358aa5106e9', '67358e301318b', 'What is the maximum length of a Python identifier?', 4, 17),
('67358aa5106e9', '67358e3014c16', 'What does pip stand for python?', 4, 18),
('67358aa5106e9', '67358e301683f', 'To add a new element to a list we use which Python command?', 4, 19),
('67358aa5106e9', '67358e3018447', 'Which of the following type is provided by C++ but not C?', 4, 20),
('67358aa5106e9', '67358e301a0d0', 'What will be the output of the following C++ code? \r\n#include <iostream> \r\n    using namespace std; \r\n    int main () \r\n    { \r\n        int a, b, c; \r\n        a = 2; \r\n        b = 7; \r\n        c = (a > b) ? a : b; \r\n        cout << c; \r\n        return 0; \r\n    } ', 4, 21),
('67358aa5106e9', '67358e301bb18', 'What will happen if the following code is executed?\r\n#include <stdio.h> \r\n    int main() \r\n    { \r\n        int main = 3; \r\n        printf(\"%d\", main); \r\n        return 0; \r\n    }', 4, 22),
('67358aa5106e9', '67358e301d5ba', 'What will be the output of the following code?\r\na = [1, 2] \r\nprint(a * 3)', 4, 23),
('67358aa5106e9', '67358e301f19d', 'What happens if the following program is executed in C and C++? \r\n#include <stdio.h>  \r\nint main(void)  \r\n{  \r\n int new = 5; \r\n printf(\"%d\", new);  \r\n} ', 4, 24),
('67358aa5106e9', '67358e3021043', 'What will be the output of the following Python code? \r\na = [1, 2, 3, 4, 5] \r\nsum = 0 \r\nfor ele in a: \r\n   sum += ele  \r\nprint(sum) ', 4, 25),
('67358aa5106e9', '67358e3022aa8', 'What will be the output of the following C code? \r\n#include <stdio.h> \r\n    int main() \r\n    { \r\n        int y = 10000; \r\n        int y = 34; \r\n        printf(\"Hello World! %d\n\", y); \r\n        return 0; \r\n    }', 4, 26),
('67358aa5106e9', '67358e30244c2', '#include <stdio.h> \r\n    int main() \r\n    { \r\n        int y = 10000; \r\n        int y = 34; \r\n        printf(\"Hello World! %d\n\", y); \r\n        return 0; \r\n    }', 4, 27),
('67358aa5106e9', '67358e30258ff', 'What will be the output of the following code? \r\n#include <iostream>  \r\n#include <string> \r\nusing namespace std;  \r\nint main (int argc, char const *argv[ ] ) { \r\n char s1[6] = \"Hello\"; \r\n char s2[6] = \"World\"; \r\n char s3[12] = s1 + \" \" + s2; \r\n cout<<s3; \r\n return 0; \r\n} ', 4, 28),
('67358aa5106e9', '67358e3026834', 'What will be the output of the following code snippet? \r\na = [1, 2, 3] \r\na = tuple(a) \r\na[0] = 2 \r\nprint(a) ', 4, 29),
('67358aa5106e9', '67358e3027674', 'What will be the output of the following code?\r\na = 3 \r\nb = 1  \r\nprint(a, b) \r\na, b = b, a  \r\nprint(a, b)', 4, 30);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `eid` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `sahi` int(11) NOT NULL,
  `wrong` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `time` bigint(20) NOT NULL,
  `intro` text NOT NULL,
  `tag` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`eid`, `title`, `sahi`, `wrong`, `total`, `time`, `intro`, `tag`, `date`) VALUES
('67358aa5106e9', 'Diploma Quiz', 1, '0.25', '30', 1, 'All the questions are mandatory*', '', '2024-11-14 17:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `email` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`email`, `score`, `time`) VALUES
('test@test.com', 5, '2019-11-24 07:33:50'),
('testv@gmail.com', 8, '2019-11-24 12:54:06'),
('tb@gmail.com', 131, '2024-11-15 11:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `college` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mob` bigint(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `gender`, `college`, `email`, `mob`, `password`) VALUES
('Tanmoy Biswas', 'M', '2230402008', 'tb@gmail.com', 8258903821, '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`sahi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
