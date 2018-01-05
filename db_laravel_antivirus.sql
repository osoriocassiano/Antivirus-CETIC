-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2018 at 12:49 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laravel_antivirus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_antivirus_pc`
--

CREATE TABLE `tbl_antivirus_pc` (
  `apc_codigo` int(11) NOT NULL,
  `apc_serial_antiv` varchar(36) NOT NULL,
  `apc_serial_pc` varchar(36) NOT NULL,
  `apc_data_registo` date NOT NULL,
  `apc_validade` int(11) NOT NULL,
  `apc_data_vencimento` date DEFAULT NULL,
  `apc_marca_antiv` int(11) NOT NULL,
  `apc_responsavel_registo` int(11) NOT NULL,
  `apc_data_registo_no_sistema` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `apc_ultima_actualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_antivirus_pc`
--

INSERT INTO `tbl_antivirus_pc` (`apc_codigo`, `apc_serial_antiv`, `apc_serial_pc`, `apc_data_registo`, `apc_validade`, `apc_data_vencimento`, `apc_marca_antiv`, `apc_responsavel_registo`, `apc_data_registo_no_sistema`, `apc_ultima_actualizacao`) VALUES
(29, 'AAAAA-BBBBB-CCCCC-DDDDD-EEEEE', 'DERT45DN8Y', '2016-01-21', 365, '2017-01-20', 6, 18, '2017-02-19 15:46:57', '2017-02-19 15:46:57'),
(30, 'VVVVV-TTTTT-AAAAA-GGGGG-XXXXX', 'EWQ65GTRO9', '2016-03-19', 365, '2017-03-19', 6, 18, '2017-02-19 15:48:36', '2017-02-19 15:48:36'),
(31, 'KKKK-LLLLLL-HHHHH-BBBBB-DDDDD', 'H35PG89JHQE', '2016-04-21', 365, '2017-04-21', 6, 18, '2017-02-19 15:49:37', '2017-02-19 15:49:37'),
(32, 'CCCCC-OOOO-PPPPP-RRRRR-DDDDD', 'VFT89KJ56F', '2017-02-19', 365, '2018-02-19', 6, 17, '2017-02-19 15:51:10', '2017-02-19 15:51:10'),
(33, 'XDFCV-OUYH6-97HNF-FDT6G-563HN', 'EWQ65GTRO9', '2017-02-19', 365, '2018-02-19', 6, 17, '2017-02-19 15:54:17', '2017-02-19 15:54:17'),
(34, 'XXD3L-OJG7B-95YT3-OKB43-JGYN5', 'VFT89KJ56F', '2016-10-19', 365, '2017-10-19', 8, 17, '2017-02-19 15:54:17', '2017-02-19 15:54:17'),
(35, 'qweeeee', 'DERT45DN8Y', '2017-08-13', 4, '2017-08-17', 6, 17, '2017-10-12 16:24:07', '2017-10-12 16:25:08'),
(36, 'ww', 'DERT45DN8Y', '2017-08-13', 34, '2017-09-16', 6, 17, '2017-10-12 20:41:54', '2017-10-12 20:41:54'),
(37, 'ssss', 'EWQ65GTRO9', '2017-08-13', 23, '2017-09-05', 6, 17, '2017-10-12 20:48:07', '2017-10-12 20:48:07'),
(38, 'ad', 'EWQ65GTRO9', '2017-03-22', 23, '2017-04-14', 6, 17, '2017-10-12 21:39:04', '2017-10-12 21:39:04'),
(39, '12', 'EWQ65GTRO9', '2015-10-12', 124, '2016-02-13', 8, 17, '2017-10-12 21:41:05', '2017-10-12 21:45:16'),
(40, 'Zoro', 'DERT45DN8Y', '2017-10-12', 365, '2018-10-12', 8, 17, '2017-10-12 22:08:20', '2017-10-12 22:09:48');

--
-- Triggers `tbl_antivirus_pc`
--
DELIMITER $$
CREATE TRIGGER `tr_actualiza_data_vencimento` BEFORE UPDATE ON `tbl_antivirus_pc` FOR EACH ROW BEGIN

	SET NEW.apc_data_vencimento = DATE_ADD(NEW.apc_data_registo, INTERVAL NEW.apc_validade DAY);



END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_insere_data_vencimento` BEFORE INSERT ON `tbl_antivirus_pc` FOR EACH ROW BEGIN
	SET NEW.apc_data_vencimento = DATE_ADD(NEW.apc_data_registo, INTERVAL NEW.apc_validade DAY);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cargo`
--

CREATE TABLE `tbl_cargo` (
  `carg_codigo` int(11) NOT NULL,
  `carg_nome` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cargo`
--

INSERT INTO `tbl_cargo` (`carg_codigo`, `carg_nome`) VALUES
(5, 'Director'),
(6, 'Chefe do DES'),
(7, 'Guarda');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dias_remanescentes`
--

CREATE TABLE `tbl_dias_remanescentes` (
  `dr_codigo` int(11) NOT NULL,
  `dr_nome` int(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dias_remanescentes`
--

INSERT INTO `tbl_dias_remanescentes` (`dr_codigo`, `dr_nome`) VALUES
(57, 30),
(54, 60),
(56, 90);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_marca_antiv`
--

CREATE TABLE `tbl_marca_antiv` (
  `mar_ant_codigo` int(11) NOT NULL,
  `mar_ant_nome` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_marca_antiv`
--

INSERT INTO `tbl_marca_antiv` (`mar_ant_codigo`, `mar_ant_nome`) VALUES
(6, 'Kaspersky'),
(8, 'Norton'),
(9, 'Avira');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissao`
--

CREATE TABLE `tbl_permissao` (
  `per_codigo` int(11) NOT NULL,
  `per_nome` varchar(45) NOT NULL,
  `per_descricao` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_permissao`
--

INSERT INTO `tbl_permissao` (`per_codigo`, `per_nome`, `per_descricao`) VALUES
(1, 'gerir_usuario', 'Responsavel pela gestao de usuarios'),
(2, 'gerir_antivirus', 'Responsavel pela gestao dos antivirus'),
(4, 'gerir_licencas', 'Responsavel pela gestao das licencas'),
(5, 'gerir_permissoes', 'Responsavel pela gestao das permissoes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tipo_usuario`
--

CREATE TABLE `tbl_tipo_usuario` (
  `tpu_codigo` int(11) NOT NULL,
  `tpu_nome` varchar(50) NOT NULL,
  `tpu_sigla` varchar(5) DEFAULT NULL,
  `tpu_descricao` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tipo_usuario`
--

INSERT INTO `tbl_tipo_usuario` (`tpu_codigo`, `tpu_nome`, `tpu_sigla`, `tpu_descricao`) VALUES
(4, 'Usuario_Comum', 'UCM', 'Usuario Comum'),
(5, 'Administrador', 'ADM', 'Administrador'),
(7, 'ASC', 'ASS', 'cc');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tipo_usuario_permissao`
--

CREATE TABLE `tbl_tipo_usuario_permissao` (
  `tpu_codigo` int(11) NOT NULL,
  `per_codigo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tipo_usuario_permissao`
--

INSERT INTO `tbl_tipo_usuario_permissao` (`tpu_codigo`, `per_codigo`) VALUES
(4, 2),
(4, 4),
(5, 1),
(5, 4),
(5, 5),
(6, 1),
(6, 2),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usuario_computador`
--

CREATE TABLE `tbl_usuario_computador` (
  `uc_codigo` int(11) NOT NULL,
  `uc_serial` varchar(36) NOT NULL,
  `uc_nome` varchar(50) DEFAULT NULL,
  `uc_apelido` varchar(50) DEFAULT NULL,
  `uc_data_registo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_usuario_computador`
--

INSERT INTO `tbl_usuario_computador` (`uc_codigo`, `uc_serial`, `uc_nome`, `uc_apelido`, `uc_data_registo`) VALUES
(35, 'H35PG89JHQE', 'Osorio Cassiano', 'Malache', '2017-02-13'),
(36, 'EWQ65GTRO9', 'Cazanca', 'Mapi', '2016-12-20'),
(37, 'DERT45DN8Y', 'Salme', 'Lucas', '2016-12-22'),
(38, 'VFT89KJ56F', 'Reley', 'Guta', '2016-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usuario_sistema`
--

CREATE TABLE `tbl_usuario_sistema` (
  `us_codigo` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `us_apelido` varchar(45) DEFAULT NULL,
  `us_cargo` int(11) DEFAULT NULL,
  `us_tipo` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_usuario_sistema`
--

INSERT INTO `tbl_usuario_sistema` (`us_codigo`, `name`, `us_apelido`, `us_cargo`, `us_tipo`, `email`, `username`, `password`, `remember_token`) VALUES
(17, 'Osorio Cassiano', 'Malache', 5, 5, 'osoriocassiano@gmail.com', 'admin', '$2y$10$DWiLhjKfFq.SKdElzYKKguDakOYvvk28HUm.QbQrzTE.QR77kkfGC', 'NngKRzqVs3EdV8xQkL6KT0gek2OjOQn5BtcquLQIUCg1b9EVskvJWgeJSCZP'),
(18, 'Carla da Izilda', 'Faduco', 6, 4, 'carlafaduco@gmail.com', 'carlafaduco', '$2y$10$f6RH3kqQU.u4ckiDj/Txxe/1c3eckRyWn37xrQ1.EhfpegD9Wdr0W', 'my0wmFzWXQUdvbA27UxThMoUIXZ5ZRgbGhD7Sbyym38pgb2WHAWnfJL07E8C'),
(20, 'Jane', 'Matanaia', 5, 4, 'jane@gmail.com', 'janematanaia', '$2y$10$uYuQrXS60dqKdH2LUH5CB.pAhOPySoCFEi4BRP0np69PYbSIUsgny', 'ZL9h15KUBhMWVQTBTfwtXXodJtugUBfH6cpldZwNc3Zq1vuSZ2c27iyf3gxm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_antivirus_pc`
--
ALTER TABLE `tbl_antivirus_pc`
  ADD PRIMARY KEY (`apc_codigo`),
  ADD KEY `FK_SERIAL_PC_idx` (`apc_serial_pc`),
  ADD KEY `FK_MARCA_ANTIV_idx` (`apc_marca_antiv`),
  ADD KEY `FK_RESPONSAVEL_REGISTO_idx` (`apc_responsavel_registo`);

--
-- Indexes for table `tbl_cargo`
--
ALTER TABLE `tbl_cargo`
  ADD PRIMARY KEY (`carg_codigo`);

--
-- Indexes for table `tbl_dias_remanescentes`
--
ALTER TABLE `tbl_dias_remanescentes`
  ADD PRIMARY KEY (`dr_codigo`),
  ADD UNIQUE KEY `dr_codigo_UNIQUE` (`dr_codigo`);

--
-- Indexes for table `tbl_marca_antiv`
--
ALTER TABLE `tbl_marca_antiv`
  ADD PRIMARY KEY (`mar_ant_codigo`);

--
-- Indexes for table `tbl_permissao`
--
ALTER TABLE `tbl_permissao`
  ADD PRIMARY KEY (`per_codigo`);

--
-- Indexes for table `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  ADD PRIMARY KEY (`tpu_codigo`),
  ADD UNIQUE KEY `tpu_sigla_UNIQUE` (`tpu_sigla`);

--
-- Indexes for table `tbl_tipo_usuario_permissao`
--
ALTER TABLE `tbl_tipo_usuario_permissao`
  ADD PRIMARY KEY (`tpu_codigo`,`per_codigo`),
  ADD KEY `fk_tpu_codigo_idx` (`tpu_codigo`),
  ADD KEY `fk_per_codigo_idx` (`per_codigo`);

--
-- Indexes for table `tbl_usuario_computador`
--
ALTER TABLE `tbl_usuario_computador`
  ADD PRIMARY KEY (`uc_codigo`),
  ADD KEY `uc_serial` (`uc_serial`);

--
-- Indexes for table `tbl_usuario_sistema`
--
ALTER TABLE `tbl_usuario_sistema`
  ADD PRIMARY KEY (`us_codigo`),
  ADD KEY `FK_CARGO_idx` (`us_cargo`),
  ADD KEY `FK_TIPO_USUARIO_idx` (`us_tipo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_antivirus_pc`
--
ALTER TABLE `tbl_antivirus_pc`
  MODIFY `apc_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `tbl_cargo`
--
ALTER TABLE `tbl_cargo`
  MODIFY `carg_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_dias_remanescentes`
--
ALTER TABLE `tbl_dias_remanescentes`
  MODIFY `dr_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `tbl_marca_antiv`
--
ALTER TABLE `tbl_marca_antiv`
  MODIFY `mar_ant_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_permissao`
--
ALTER TABLE `tbl_permissao`
  MODIFY `per_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  MODIFY `tpu_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_usuario_computador`
--
ALTER TABLE `tbl_usuario_computador`
  MODIFY `uc_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `tbl_usuario_sistema`
--
ALTER TABLE `tbl_usuario_sistema`
  MODIFY `us_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_antivirus_pc`
--
ALTER TABLE `tbl_antivirus_pc`
  ADD CONSTRAINT `FK-SERIAL_PC` FOREIGN KEY (`apc_serial_pc`) REFERENCES `tbl_usuario_computador` (`uc_serial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_MARCA_ANTIV` FOREIGN KEY (`apc_marca_antiv`) REFERENCES `tbl_marca_antiv` (`mar_ant_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_RESPONSAVEL_REGISTO` FOREIGN KEY (`apc_responsavel_registo`) REFERENCES `tbl_usuario_sistema` (`us_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_usuario_sistema`
--
ALTER TABLE `tbl_usuario_sistema`
  ADD CONSTRAINT `FK_CARGO` FOREIGN KEY (`us_cargo`) REFERENCES `tbl_cargo` (`carg_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_TIPO_USUARIO` FOREIGN KEY (`us_tipo`) REFERENCES `tbl_tipo_usuario` (`tpu_codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
