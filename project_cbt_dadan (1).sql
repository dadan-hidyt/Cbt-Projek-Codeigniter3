-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Apr 2023 pada 12.14
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_cbt_dadan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_det_ujian`
--

CREATE TABLE `tb_det_ujian` (
  `id` int(11) NOT NULL,
  `id_ujian` int(10) NOT NULL,
  `id_kelas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_det_ujian`
--

INSERT INTO `tb_det_ujian` (`id`, `id_ujian`, `id_kelas`) VALUES
(3, 1, 1),
(4, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dump_jawaban`
--

CREATE TABLE `tb_dump_jawaban` (
  `id_soal` int(11) NOT NULL,
  `nisn` char(11) NOT NULL,
  `jawaban_sekarang` char(1) NOT NULL,
  `jam_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `type` enum('PG','ESSAY') NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_dump_jawaban`
--

INSERT INTO `tb_dump_jawaban` (`id_soal`, `nisn`, `jawaban_sekarang`, `jam_submit`, `type`, `id_ujian`, `id_mapel`) VALUES
(1, '20211324', 'A', '2023-04-06 06:54:42', 'PG', 1, 1),
(2, '20211324', 'B', '2023-04-06 06:54:43', 'PG', 1, 1),
(3, '20211324', 'C', '2023-04-06 06:54:46', 'PG', 1, 1),
(4, '20211324', 'A', '2023-04-06 06:54:48', 'PG', 1, 1),
(5, '20211324', 'A', '2023-04-06 06:56:30', 'PG', 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hasil_ujian`
--

CREATE TABLE `tb_hasil_ujian` (
  `id` int(11) NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `kosong` int(11) NOT NULL,
  `benar` int(11) NOT NULL,
  `salah` int(11) NOT NULL,
  `poin` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `detail_benar` text NOT NULL,
  `detail_salah` text NOT NULL,
  `detail_kosong` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_hasil_ujian`
--

INSERT INTO `tb_hasil_ujian` (`id`, `waktu`, `kosong`, `benar`, `salah`, `poin`, `id_ujian`, `nisn`, `detail_benar`, `detail_salah`, `detail_kosong`) VALUES
(4, '1680764090', 0, 2, 2, 50, 1, '20211324', '1|4', '2|3', ''),
(5, '1680764197', 3, 1, 0, 25, 2, '20211324', '1', '', '2|3|4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id`, `nama_kelas`) VALUES
(1, 'XII-RPL 10'),
(2, 'XII-RPL 11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mapel`
--

CREATE TABLE `tb_mapel` (
  `id_mapel` int(11) NOT NULL,
  `kurikulum` varchar(50) NOT NULL,
  `guru_mapel` varchar(30) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_mapel`
--

INSERT INTO `tb_mapel` (`id_mapel`, `kurikulum`, `guru_mapel`, `nama_mapel`) VALUES
(1, 'kurtilas', 'Dadan Hidayat, PhD', 'SIMKOMDIG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sessions`
--

CREATE TABLE `tb_sessions` (
  `id` int(11) NOT NULL,
  `token` varchar(140) NOT NULL,
  `expire` varchar(120) NOT NULL,
  `nisn` varchar(120) NOT NULL,
  `create_at` varchar(120) NOT NULL,
  `ip` varchar(120) NOT NULL,
  `browser` varchar(120) NOT NULL,
  `os` varchar(121) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sessions`
--

INSERT INTO `tb_sessions` (`id`, `token`, `expire`, `nisn`, `create_at`, `ip`, `browser`, `os`) VALUES
(1, '25055a0172f5e49fb00d6d1d427476815c6c91ba78e986c46deea584f9590db4', '1680830719', '20211324', '1680744319', '127.0.0.1', 'Firefox 111.0', 'Windows 10'),
(2, '322f078ce45ff46e8f14e180bc32fdb6070f70e7cbc2313fdc9aca52ccea364a', '1680830999', '20211324', '1680744599', '::1', 'Chrome 111.0.0.0', 'Windows 10'),
(3, '5b7de08ba42bc6c53fd5219d7fefe457d661d9f65f63602a24b06fd2f6a24a4b', '1680847915', '20211324', '1680761515', '::1', 'Chrome 111.0.0.0', 'Android'),
(4, 'afeb7ada86ec6221aea38d7d0d541f41888f410ae2c7673121bbd633a472c84c', '1680856915', '20211324', '1680770515', '::1', 'Chrome 111.0.0.0', 'Windows 10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nisn` varchar(10) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `id_kelas` int(10) DEFAULT NULL,
  `id_kelompok` int(10) DEFAULT NULL,
  `password` varchar(121) NOT NULL,
  `email` varchar(121) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `id_kelompok`, `password`, `email`, `no_hp`, `alamat`) VALUES
('20211324', '202113242', 'Dadan Hidayat', 1, 0, '121', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa_ujian`
--

CREATE TABLE `tb_siswa_ujian` (
  `id` int(11) NOT NULL,
  `nisn` char(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `waktu_submit` varchar(121) NOT NULL DEFAULT current_timestamp(),
  `sisa_menit` varchar(120) NOT NULL,
  `sisa_waktu` varchar(121) NOT NULL,
  `waktu_akhir` varchar(121) DEFAULT NULL,
  `ip` varchar(120) NOT NULL,
  `selesai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_siswa_ujian`
--

INSERT INTO `tb_siswa_ujian` (`id`, `nisn`, `id_ujian`, `waktu_submit`, `sisa_menit`, `sisa_waktu`, `waktu_akhir`, `ip`, `selesai`) VALUES
(4, '20211324', 1, '1680764080', '-27', '1 Jam : 19 Menit : 52 Detik', '1680768880', '::1', 1),
(5, '20211324', 2, '1680764187', '-35', '0 Jam : 39 Menit : 52 Detik', '1680766587', '::1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_soal`
--

CREATE TABLE `tb_soal` (
  `id_soal` int(11) NOT NULL,
  `no_soal` int(11) DEFAULT NULL,
  `id_ujian` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `audio_source` varchar(121) DEFAULT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `e` text NOT NULL,
  `kunci` char(1) NOT NULL,
  `aktif` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_soal`
--

INSERT INTO `tb_soal` (`id_soal`, `no_soal`, `id_ujian`, `pertanyaan`, `audio_source`, `a`, `b`, `c`, `d`, `e`, `kunci`, `aktif`, `type`) VALUES
(1, 1, 1, 'Sebuatkan nama nama ikan dalam bahasa indonesia??', '', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'A', 1, 1),
(2, 2, 1, 'Siapakah Pemimpin indonesia', '', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'A', 1, 1),
(3, 3, 1, 'Writes a “SELECT AVG(field)” portion for your query. As with select_max(), You can optionally include a second parameter to rename the resulting field.\r\n\r\nPerintah di atas untuk?Writes a “SELECT AVG(field)” portion for your query. As with select_max(), You can optionally include a second parameter to rename the resulting field.\r\n\r\nPerintah di atas untuk?\r\n\r\n<img src=\'http://localhost/_project/upload/soal/img/a.jpeg\'/>', 'upload\\soal\\audio\\a.m4a', 'Lorem', 'A', 'A', 'A', 'A', 'A', 1, 1),
(4, 4, 1, '    <b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt modi laudantium nostrum nam nemo vel eveniet quisquam alias distinctio, voluptates repellat quis a. Quis assumenda possimus obcaecati consequatur. Nobis, deleniti?</b>\n    <b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt modi laudantium nostrum nam nemo vel eveniet quisquam alias distinctio, voluptates repellat quis a. Quis assumenda possimus obcaecati consequatur. Nobis, deleniti?</b>\n    <b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt modi laudantium nostrum nam nemo vel eveniet quisquam alias distinctio, voluptates repellat quis a. Quis assumenda possimus obcaecati consequatur. Nobis, deleniti?</b>\n    <b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt modi laudantium nostrum nam nemo vel eveniet quisquam alias distinctio, voluptates repellat quis a. Quis assumenda possimus obcaecati consequatur. Nobis, deleniti?</b>\n', '', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'A', 1, 1),
(5, 1, 2, 'Sebuatkan nama nama ikan dalam bahasa indonesia??', '', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'A', 1, 1),
(6, 2, 2, 'Siapakah Pemimpin indonesia', '', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'A', 1, 1),
(7, 3, 2, 'Writes a “SELECT AVG(field)” portion for your query. As with select_max(), You can optionally include a second parameter to rename the resulting field.\n\nPerintah di atas untuk?\n\n<img src=\'upload\\soal\\img\\1608288587830.jfif\'>', 'upload\\soal\\audio\\a.m4a', 'Lorem', 'A', 'A', 'A', 'A', 'A', 1, 1),
(8, 4, 2, '    <b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt modi laudantium nostrum nam nemo vel eveniet quisquam alias distinctio, voluptates repellat quis a. Quis assumenda possimus obcaecati consequatur. Nobis, deleniti?</b>\r\n    <b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt modi laudantium nostrum nam nemo vel eveniet quisquam alias distinctio, voluptates repellat quis a. Quis assumenda possimus obcaecati consequatur. Nobis, deleniti?</b>\r\n    <b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt modi laudantium nostrum nam nemo vel eveniet quisquam alias distinctio, voluptates repellat quis a. Quis assumenda possimus obcaecati consequatur. Nobis, deleniti?</b>\r\n    <b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt modi laudantium nostrum nam nemo vel eveniet quisquam alias distinctio, voluptates repellat quis a. Quis assumenda possimus obcaecati consequatur. Nobis, deleniti?</b>\r\n', '', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'Anak,Konda,Konda,Sume', 'A', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ujian`
--

CREATE TABLE `tb_ujian` (
  `id_ujian` int(11) NOT NULL,
  `nama_ujian` varchar(120) NOT NULL,
  `id_mapel` int(10) DEFAULT NULL,
  `total_waktu` int(11) NOT NULL,
  `jmlh_pg` int(11) NOT NULL,
  `jmlh_essay` int(11) NOT NULL,
  `pilihan_sampai` char(1) NOT NULL,
  `lihat_nilai` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_ujian`
--

INSERT INTO `tb_ujian` (`id_ujian`, `nama_ujian`, `id_mapel`, `total_waktu`, `jmlh_pg`, `jmlh_essay`, `pilihan_sampai`, `lihat_nilai`) VALUES
(1, 'MTK', 1, 80, 40, 0, 'D', 1),
(2, 'INGRIS', 1, 40, 40, 0, 'D', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_det_ujian`
--
ALTER TABLE `tb_det_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `tb_dump_jawaban`
--
ALTER TABLE `tb_dump_jawaban`
  ADD KEY `tb_dump_jawaban_ibfk_1` (`nisn`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `id_soal` (`id_soal`);

--
-- Indeks untuk tabel `tb_hasil_ujian`
--
ALTER TABLE `tb_hasil_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ujian` (`id_ujian`),
  ADD KEY `nisn` (`nisn`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_mapel`
--
ALTER TABLE `tb_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indeks untuk tabel `tb_sessions`
--
ALTER TABLE `tb_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD UNIQUE KEY `nis` (`nis`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_kelompok` (`id_kelompok`),
  ADD KEY `id_kelas_2` (`id_kelas`);

--
-- Indeks untuk tabel `tb_siswa_ujian`
--
ALTER TABLE `tb_siswa_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `id_ujian` (`id_ujian`);

--
-- Indeks untuk tabel `tb_soal`
--
ALTER TABLE `tb_soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indeks untuk tabel `tb_ujian`
--
ALTER TABLE `tb_ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_det_ujian`
--
ALTER TABLE `tb_det_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_hasil_ujian`
--
ALTER TABLE `tb_hasil_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_mapel`
--
ALTER TABLE `tb_mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_sessions`
--
ALTER TABLE `tb_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa_ujian`
--
ALTER TABLE `tb_siswa_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_soal`
--
ALTER TABLE `tb_soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_ujian`
--
ALTER TABLE `tb_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_det_ujian`
--
ALTER TABLE `tb_det_ujian`
  ADD CONSTRAINT `tb_det_ujian_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `tb_ujian` (`id_ujian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_det_ujian_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_dump_jawaban`
--
ALTER TABLE `tb_dump_jawaban`
  ADD CONSTRAINT `tb_dump_jawaban_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `tb_siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_dump_jawaban_ibfk_2` FOREIGN KEY (`id_ujian`) REFERENCES `tb_ujian` (`id_ujian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_dump_jawaban_ibfk_3` FOREIGN KEY (`id_soal`) REFERENCES `tb_soal` (`id_soal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_hasil_ujian`
--
ALTER TABLE `tb_hasil_ujian`
  ADD CONSTRAINT `tb_hasil_ujian_ibfk_1` FOREIGN KEY (`id_ujian`) REFERENCES `tb_ujian` (`id_ujian`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_hasil_ujian_ibfk_2` FOREIGN KEY (`nisn`) REFERENCES `tb_siswa` (`nisn`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_siswa_ujian`
--
ALTER TABLE `tb_siswa_ujian`
  ADD CONSTRAINT `tb_siswa_ujian_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `tb_siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_siswa_ujian_ibfk_2` FOREIGN KEY (`id_ujian`) REFERENCES `tb_ujian` (`id_ujian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_ujian`
--
ALTER TABLE `tb_ujian`
  ADD CONSTRAINT `tb_ujian_ibfk_1` FOREIGN KEY (`id_mapel`) REFERENCES `tb_mapel` (`id_mapel`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
