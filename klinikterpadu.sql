-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2021 at 06:52 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinikterpadu`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('t8li71i4jie30fp60m5dg99eneoru7pd', '::1', 1626171310, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137313331303b),
('24tn5pngqda1ltflsmonf7unmcbeporl', '::1', 1626171895, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137313839353b),
('uorner7tl5frl0k419or04d7qchcb7io', '::1', 1626172212, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137323231323b),
('va8r9thd7knvrntqmq6is8o8naqvaqt9', '::1', 1626172700, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137323730303b),
('46a6l8lg7h43om5qknpb42ijkm87d578', '::1', 1626173070, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137333037303b),
('1am9h6dhg52agn7kkcu3ppe0ske1co1v', '::1', 1626173450, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137333435303b),
('37s0qldui4brft5hltkram8lguj1b9b9', '::1', 1626173935, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137333933353b),
('i0mreburff3k19trki282l9tcmboe3aj', '::1', 1626174273, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137343237333b),
('lucs4p04p8ckv6bngd0o6lj4sdjaodm0', '::1', 1626174583, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137343538333b),
('1jlh62kjq4t29dgdaa35e53628advilb', '::1', 1626174916, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137343931363b),
('r737v5n3a85ao7l1eg0746rc7fromv47', '::1', 1626175247, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137353234373b),
('g62rmsioim3bhq3h6feqpl3v1gf0a36k', '::1', 1626175590, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137353539303b),
('4rem8cdrlknj28g7gvufsdlhhq6d4hgf', '::1', 1626179064, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137393036343b),
('6u37rdlmjlamg6srj6fbuvm4r7fe3np3', '::1', 1626179369, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137393336393b),
('ectjpr08j0ob422ahr78gruippi407qo', '::1', 1626179419, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363137393336393b),
('l6pteolf38evuiq97es6ngsgekkhjah7', '::1', 1626272050, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237323035303b),
('tjnli2q0iu4vmbkcn27e1nf40jjaaeog', '::1', 1626272188, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237323035303b),
('gqlar4gkbkmihrdvmo8vqmfprt179lne', '::1', 1626272527, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237323532373b),
('1t3tr9dkfgc5m85nk9fikdva6q0vmr0p', '::1', 1626272857, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237323835373b),
('rl14otaidb0lfc5cumci6ibnif25phtn', '::1', 1626273251, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237333235313b),
('9ua4nq1mc1ol6vbtk2lfhmq9cq7j5dn6', '::1', 1626273688, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237333638383b),
('2topssmam6od87redm3dn1gnnahcpiog', '::1', 1626273991, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237333939313b),
('1mg3mmvli4haumurv1jg9g1skqm88g3v', '::1', 1626274299, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237343239393b),
('i6sjs6sr156vk25svmg3oqqphrp6sd2f', '::1', 1626274602, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237343630323b),
('2qbu0blkabcluh954qsa7fhtafto4nae', '::1', 1626274984, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237343938343b),
('o9v08ug6mlv7pugrp6tj3kv99t2l9os6', '::1', 1626275293, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237353239333b),
('gmn5p70a697lh2aq4tqfsarc2hhjetkn', '::1', 1626275949, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237353934393b),
('8bf7u1749ai79hn159ue2su0nipbkc7o', '::1', 1626276261, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237363236313b),
('kp9981pbdbgqhi1d2ou6o21r7c63g6h4', '::1', 1626276616, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237363631363b),
('hpj50e700hlbb0n8q0fmi14qeaqbb0n6', '::1', 1626276937, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237363933373b),
('9k9kikenq1q4enurh6ddm4qkbpuge8of', '::1', 1626277358, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237373335383b),
('6urfjgjop3clnc8h8u34qk2o0vn7rjmp', '::1', 1626278016, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237383031363b),
('15ugkcn7qopi0a60o2i0tdjihcdf6034', '::1', 1626278410, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237383431303b),
('0r2s0mcqom38u0mav7cvhvokvnmmeoor', '::1', 1626278803, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237383830333b),
('93g70p9c68174qveso4itq29te9u5n61', '::1', 1626279105, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237393130353b),
('pm10abvi98e0if0o3pth50uheu9q5jno', '::1', 1626279970, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363237393937303b),
('43i20rmsmugtb6ajq6mlriml8lji72n4', '::1', 1626280658, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363238303635383b),
('uc4n06i1dkdqrtbqmeo8uirc2nii5euu', '::1', 1626280961, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363238303936313b),
('1moci5dfg0la3i5vg52oe9hvl3rhtgm6', '::1', 1626280996, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632363238303936313b);

-- --------------------------------------------------------

--
-- Table structure for table `tb_aset`
--

CREATE TABLE `tb_aset` (
  `kd_aset` varchar(10) NOT NULL,
  `nama_aset` varchar(50) NOT NULL,
  `tanggal_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_aset`
--

INSERT INTO `tb_aset` (`kd_aset`, `nama_aset`, `tanggal_beli`) VALUES
('AS001', 'Stetoskop', '2021-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bpjs`
--

CREATE TABLE `tb_bpjs` (
  `no_kartu` varchar(13) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nik` varchar(16) NOT NULL,
  `faskes` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE `tb_obat` (
  `kd_obat` varchar(5) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `expired` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`kd_obat`, `nama_obat`, `expired`) VALUES
('OB001', 'Amoxilin', '2021-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `id_pasien` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL DEFAULT '1000-01-01',
  `nohp` varchar(15) NOT NULL,
  `jenis_rawat` varchar(20) NOT NULL,
  `status_bpjs` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`id_pasien`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `nohp`, `jenis_rawat`, `status_bpjs`) VALUES
('PS001', 'Nanda Hady Mulya', 'Padang', 'Kayu Tanam', '1997-05-28', '082111433440', 'Rawat Inap', 'BPJS');

-- --------------------------------------------------------

--
-- Table structure for table `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` varchar(5) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_petugas` text NOT NULL,
  `nohp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `tb_aset`
--
ALTER TABLE `tb_aset`
  ADD PRIMARY KEY (`kd_aset`);

--
-- Indexes for table `tb_bpjs`
--
ALTER TABLE `tb_bpjs`
  ADD PRIMARY KEY (`no_kartu`);

--
-- Indexes for table `tb_obat`
--
ALTER TABLE `tb_obat`
  ADD PRIMARY KEY (`kd_obat`);

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
