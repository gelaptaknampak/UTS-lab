-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Okt 2023 pada 07.57
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tasks`
--

CREATE TABLE `tasks` (
  `taskid` int(11) NOT NULL,
  `ID_user` int(5) NOT NULL,
  `tasklabel` varchar(50) NOT NULL,
  `taskstatus` enum('Not yet started','In progress','Waiting on','Completed') DEFAULT NULL,
  `createdat` timestamp NOT NULL DEFAULT current_timestamp(),
  `taskdone` tinyint(1) NOT NULL DEFAULT 0,
  `is_done` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tasks`
--

INSERT INTO `tasks` (`taskid`, `ID_user`, `tasklabel`, `taskstatus`, `createdat`, `taskdone`, `is_done`) VALUES
(92, 3, 'tugas deadline 20 mei 2024', 'In progress', '2023-10-24 06:38:43', 0, 0),
(94, 4, 'ada acara nikahan kawan', 'Waiting on', '2023-10-24 07:02:08', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `userregister`
--

CREATE TABLE `userregister` (
  `ID_user` int(5) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `userregister`
--

INSERT INTO `userregister` (`ID_user`, `Nama`, `Username`, `Email`, `Password`) VALUES
(3, '', '_kuro_kitsune', 'ari.maulana@student.umn.ac.id', 'rahasia'),
(4, '', 'Admin123', 'admin@gmail.com', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`taskid`),
  ADD KEY `fk_user_id` (`ID_user`);

--
-- Indeks untuk tabel `userregister`
--
ALTER TABLE `userregister`
  ADD PRIMARY KEY (`ID_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tasks`
--
ALTER TABLE `tasks`
  MODIFY `taskid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT untuk tabel `userregister`
--
ALTER TABLE `userregister`
  MODIFY `ID_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`ID_user`) REFERENCES `userregister` (`ID_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
