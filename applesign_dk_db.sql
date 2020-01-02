-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Vært: mysql35.unoeuro.com
-- Genereringstid: 02. 01 2020 kl. 18:53:19
-- Serverversion: 5.7.28-31-log
-- PHP-version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `applesign_dk_db`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `App_Projects`
--

CREATE TABLE `App_Projects` (
  `Project_ID` int(8) UNSIGNED NOT NULL,
  `Workspace_ID` int(8) NOT NULL,
  `Project_Title` varchar(255) NOT NULL,
  `Project_Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `App_Projects`
--

INSERT INTO `App_Projects` (`Project_ID`, `Workspace_ID`, `Project_Title`, `Project_Description`) VALUES
(1, 4, 'Sæt varer op', 'Paller paller paller'),
(2, 4, 'Sæt varer ned', 'Med gule skyer'),
(3, 9, 'asd', 'asd'),
(4, 9, '\' asd', 'da'),
(6, 9, ' ', 'as'),
(7, 5, 'Hjem og byg', 'hehe'),
(8, 10, 'Code', 'PHP, HTML, SCSS, JavaScript'),
(9, 10, 'Rapport', 'Writing'),
(10, 10, 'UML Models', 'Make models');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `App_Tasks`
--

CREATE TABLE `App_Tasks` (
  `Task_ID` int(8) UNSIGNED NOT NULL,
  `Todolist_ID` int(8) NOT NULL,
  `Project_ID` int(8) NOT NULL,
  `Task_Title` varchar(255) NOT NULL,
  `Task_Status` int(1) NOT NULL,
  `Task_Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `App_Tasks`
--

INSERT INTO `App_Tasks` (`Task_ID`, `Todolist_ID`, `Project_ID`, `Task_Title`, `Task_Status`, `Task_Description`) VALUES
(1, 1, 1, 'Tralala', 1, 'Lorem ipsum dolor sit amet.'),
(2, 1, 1, 'Lålålå', 1, 'Røvfirkant'),
(3, 4, 7, '', 1, ''),
(4, 4, 7, 'lele', 1, 'lala'),
(5, 4, 7, 'test', 1, ''),
(6, 4, 7, 'hest', 1, ''),
(7, 4, 7, 'pest', 1, 'fest'),
(8, 4, 7, 'tæsk', 1, 'kæft'),
(9, 5, 3, 'Fix them task', 1, 'Dette er bare dejligt'),
(10, 6, 2, 'nånånån', 1, ''),
(12, 2, 1, 'la', 1, 'le'),
(13, 2, 1, 'Entotre', 1, 'firefemseks'),
(14, 2, 1, 'al', 1, 'el'),
(15, 2, 1, 'te', 1, ''),
(16, 2, 1, 'tre', 1, ''),
(17, 2, 1, 'fire', 1, ''),
(18, 7, 8, 'On workspace level', 1, 'ok'),
(19, 7, 8, 'On project level', 1, ''),
(20, 8, 10, 'Class Diagram', 1, ''),
(21, 9, 9, 'Class Diagram Writing', 1, '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `App_TodoLists`
--

CREATE TABLE `App_TodoLists` (
  `Todolist_ID` int(8) UNSIGNED NOT NULL,
  `Todolist_Title` varchar(255) NOT NULL,
  `Project_ID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `App_TodoLists`
--

INSERT INTO `App_TodoLists` (`Todolist_ID`, `Todolist_Title`, `Project_ID`) VALUES
(2, 'Spotter', 1),
(3, 'Hjem', 7),
(4, 'Og byg', 7),
(5, 'dfgdhjhklækøæ', 3),
(6, 'ehehehehehheheheehehehe', 2),
(7, 'Time spent', 8),
(8, 'Diagrams', 10),
(9, 'SWD', 9);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `App_Track`
--

CREATE TABLE `App_Track` (
  `Track_ID` int(8) UNSIGNED NOT NULL,
  `User_ID` int(8) NOT NULL,
  `Task_ID` int(8) NOT NULL,
  `Track_StartTime` int(20) NOT NULL,
  `Track_EndTime` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `App_Track`
--

INSERT INTO `App_Track` (`Track_ID`, `User_ID`, `Task_ID`, `Track_StartTime`, `Track_EndTime`) VALUES
(1, 1, 1, 1576071203, 1576071529),
(2, 1, 1, 1576071530, 1576071535),
(3, 1, 1, 1576071536, 1576071710),
(4, 1, 2, 1576071711, 1576073208),
(5, 1, 1, 1576073209, 1576088405),
(6, 1, 1, 1577026927, 1577026937),
(7, 1, 2, 1577026938, 1577026986),
(8, 1, 1, 1577026987, 1577031406),
(9, 1, 8, 1577031407, 1577032449),
(10, 2, 9, 1577031716, 1577731340),
(11, 1, 7, 1577032450, 1577033242),
(12, 1, 6, 1577033243, 1577033249),
(13, 1, 8, 1577033250, 1577033255),
(14, 1, 7, 1577033256, 1577033259),
(15, 1, 8, 1577033260, 1577045775),
(16, 1, 6, 1577045776, 1577056711),
(17, 1, 5, 1577056712, 1577056716),
(18, 1, 10, 1577056743, 1577617856),
(19, 1, 13, 1577624398, 1577624427),
(20, 1, 15, 1577624428, 1577624444),
(21, 1, 17, 1577624445, 1577624452),
(22, 1, 13, 1577624453, 1577624599),
(23, 1, 13, 1577628990, 1577629048),
(24, 1, 13, 1577705336, 1577705341),
(25, 1, 18, 1577706061, 1577708054),
(26, 1, 19, 1577708055, 1577710279),
(27, 1, 20, 1577715612, 1577720526),
(28, 1, 21, 1577720527, 1577721139);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `App_Users`
--

CREATE TABLE `App_Users` (
  `User_ID` int(8) UNSIGNED NOT NULL,
  `User_Fullname` varchar(255) NOT NULL,
  `User_Email` varchar(255) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `User_Level` int(1) NOT NULL,
  `User_Theme` varchar(10) NOT NULL,
  `User_CurTask` int(8) NOT NULL,
  `User_StartTime` int(20) NOT NULL,
  `User_PausedTask` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `App_Users`
--

INSERT INTO `App_Users` (`User_ID`, `User_Fullname`, `User_Email`, `User_Password`, `User_Level`, `User_Theme`, `User_CurTask`, `User_StartTime`, `User_PausedTask`) VALUES
(1, 'Jonas Sørensen', 'jonas@applesign.dk', 'ec3b33c87a776384a9b884a5a3a9596fdf124d1dc66162f91f8b7d89e8c906d17d75ac340660b6044dc61e9ed21e23f0ba5a57bfac244510239773a74ba74807', 3, '', 0, 0, 0),
(2, 'Marco Romeri', 'eigilmus@applesign.dk', 'ec3b33c87a776384a9b884a5a3a9596fdf124d1dc66162f91f8b7d89e8c906d17d75ac340660b6044dc61e9ed21e23f0ba5a57bfac244510239773a74ba74807', 1, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `App_Work`
--

CREATE TABLE `App_Work` (
  `Work_ID` int(8) UNSIGNED NOT NULL,
  `User_ID` int(8) NOT NULL,
  `Task_ID` int(8) NOT NULL,
  `Work_Counter` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `App_Work`
--

INSERT INTO `App_Work` (`Work_ID`, `User_ID`, `Task_ID`, `Work_Counter`) VALUES
(1, 1, 1, 9),
(2, 1, 2, 6),
(3, 1, 6, 2),
(4, 1, 8, 2),
(5, 1, 7, 1),
(6, 1, 5, 1),
(7, 1, 10, 1),
(8, 1, 13, 4),
(9, 1, 15, 1),
(10, 1, 17, 1),
(11, 1, 18, 1),
(12, 1, 19, 1),
(13, 1, 20, 1),
(14, 1, 21, 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `App_Workspaces`
--

CREATE TABLE `App_Workspaces` (
  `Workspace_ID` int(8) UNSIGNED NOT NULL,
  `Workspace_Name` varchar(255) NOT NULL,
  `Workspace_Description` varchar(255) NOT NULL,
  `Workspace_Ext_Link` varchar(255) NOT NULL,
  `Workspace_Superadmin` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `App_Workspaces`
--

INSERT INTO `App_Workspaces` (`Workspace_ID`, `Workspace_Name`, `Workspace_Description`, `Workspace_Ext_Link`, `Workspace_Superadmin`) VALUES
(1, 'Applesign', 'Time Tracking Tool', '', 1),
(2, 'HTML 24', 'Making Awesome Code', '', 1),
(3, 'SEOlater', 'SEO automation and Website Analytics', '', 1),
(4, 'Ghetto', 'Derfor!', '', 1),
(5, 'jemogfix', 'Vi har sparet h\'et væk, så du kan spare endnu mer\'', 'http://jemogfix.dk', 1),
(6, 'Tralala', 'Lorem ipsum', 'https://', 23),
(9, 'Eksamen', 'asd', 'http://google.dk', 2),
(10, 'HOP Project', 'Last exam project', 'http://applesign.dk/', 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `App_Workspace_Access`
--

CREATE TABLE `App_Workspace_Access` (
  `Wspc_Access_ID` int(8) UNSIGNED NOT NULL,
  `Wspc_User_ID` int(8) NOT NULL,
  `Wspc_Workspace_ID` int(8) NOT NULL,
  `Wspc_Level` int(8) NOT NULL,
  `Wspc_Assigned_Projects` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `App_Workspace_Access`
--

INSERT INTO `App_Workspace_Access` (`Wspc_Access_ID`, `Wspc_User_ID`, `Wspc_Workspace_ID`, `Wspc_Level`, `Wspc_Assigned_Projects`) VALUES
(1, 1, 4, 3, ''),
(2, 1, 5, 0, ''),
(3, 1, 7, 3, ''),
(4, 1, 8, 3, ''),
(5, 2, 9, 3, ''),
(6, 1, 10, 3, '');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `App_Projects`
--
ALTER TABLE `App_Projects`
  ADD PRIMARY KEY (`Project_ID`);

--
-- Indeks for tabel `App_Tasks`
--
ALTER TABLE `App_Tasks`
  ADD PRIMARY KEY (`Task_ID`);

--
-- Indeks for tabel `App_TodoLists`
--
ALTER TABLE `App_TodoLists`
  ADD PRIMARY KEY (`Todolist_ID`);

--
-- Indeks for tabel `App_Track`
--
ALTER TABLE `App_Track`
  ADD PRIMARY KEY (`Track_ID`);

--
-- Indeks for tabel `App_Users`
--
ALTER TABLE `App_Users`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indeks for tabel `App_Work`
--
ALTER TABLE `App_Work`
  ADD PRIMARY KEY (`Work_ID`) USING BTREE;

--
-- Indeks for tabel `App_Workspaces`
--
ALTER TABLE `App_Workspaces`
  ADD PRIMARY KEY (`Workspace_ID`);

--
-- Indeks for tabel `App_Workspace_Access`
--
ALTER TABLE `App_Workspace_Access`
  ADD PRIMARY KEY (`Wspc_Access_ID`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `App_Projects`
--
ALTER TABLE `App_Projects`
  MODIFY `Project_ID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tilføj AUTO_INCREMENT i tabel `App_Tasks`
--
ALTER TABLE `App_Tasks`
  MODIFY `Task_ID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tilføj AUTO_INCREMENT i tabel `App_TodoLists`
--
ALTER TABLE `App_TodoLists`
  MODIFY `Todolist_ID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tilføj AUTO_INCREMENT i tabel `App_Track`
--
ALTER TABLE `App_Track`
  MODIFY `Track_ID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Tilføj AUTO_INCREMENT i tabel `App_Users`
--
ALTER TABLE `App_Users`
  MODIFY `User_ID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `App_Work`
--
ALTER TABLE `App_Work`
  MODIFY `Work_ID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tilføj AUTO_INCREMENT i tabel `App_Workspaces`
--
ALTER TABLE `App_Workspaces`
  MODIFY `Workspace_ID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tilføj AUTO_INCREMENT i tabel `App_Workspace_Access`
--
ALTER TABLE `App_Workspace_Access`
  MODIFY `Wspc_Access_ID` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
