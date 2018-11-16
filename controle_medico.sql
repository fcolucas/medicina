-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Nov-2018 às 04:47
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `controle_medico`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamentos`
--

CREATE TABLE `medicamentos` (
  `idmedicamentos` int(11) NOT NULL,
  `nomeMedicamento` varchar(50) NOT NULL,
  `unidade` varchar(3) NOT NULL,
  `quantidade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicos`
--

CREATE TABLE `medicos` (
  `idmedicos` int(11) NOT NULL,
  `nomeMedico` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `medicos`
--

INSERT INTO `medicos` (`idmedicos`, `nomeMedico`, `usuario`, `senha`) VALUES
(1, 'Francisco Lucas', 'fcolucas', 'lucas1234'),
(2, 'Juliana Cardoso', 'jucardoso', 'ju1234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `idpacientes` int(11) NOT NULL,
  `medicos_idmedicos` int(11) NOT NULL,
  `nomePaciente` varchar(50) NOT NULL,
  `dataNascimento` date NOT NULL,
  `sexo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prescricao`
--

CREATE TABLE `prescricao` (
  `receituarios_idreceituarios` int(11) NOT NULL,
  `medicamentos_idmedicamentos` int(11) NOT NULL,
  `dosagem` float NOT NULL,
  `intervalo` int(11) NOT NULL,
  `tipoIntervalo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `receituarios`
--

CREATE TABLE `receituarios` (
  `idreceituarios` int(11) NOT NULL,
  `pacientes_idpacientes` int(11) NOT NULL,
  `medicos_idmedicos` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `observacoes` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`idmedicamentos`);

--
-- Indexes for table `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`idmedicos`);

--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`idpacientes`),
  ADD KEY `medicos_idmedicos` (`medicos_idmedicos`);

--
-- Indexes for table `prescricao`
--
ALTER TABLE `prescricao`
  ADD KEY `receituarios_idreceituarios` (`receituarios_idreceituarios`),
  ADD KEY `medicamentos_idmedicamentos` (`medicamentos_idmedicamentos`);

--
-- Indexes for table `receituarios`
--
ALTER TABLE `receituarios`
  ADD PRIMARY KEY (`idreceituarios`),
  ADD KEY `pacientes_idpacientes` (`pacientes_idpacientes`),
  ADD KEY `medicos_idmedicos` (`medicos_idmedicos`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `idmedicamentos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicos`
--
ALTER TABLE `medicos`
  MODIFY `idmedicos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `idpacientes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `receituarios`
--
ALTER TABLE `receituarios`
  MODIFY `idreceituarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `medicos_idmedicos` FOREIGN KEY (`medicos_idmedicos`) REFERENCES `medicos` (`idmedicos`);

--
-- Limitadores para a tabela `prescricao`
--
ALTER TABLE `prescricao`
  ADD CONSTRAINT `prescricao_ibfk_1` FOREIGN KEY (`receituarios_idreceituarios`) REFERENCES `receituarios` (`idreceituarios`),
  ADD CONSTRAINT `prescricao_ibfk_2` FOREIGN KEY (`medicamentos_idmedicamentos`) REFERENCES `medicamentos` (`idmedicamentos`);

--
-- Limitadores para a tabela `receituarios`
--
ALTER TABLE `receituarios`
  ADD CONSTRAINT `receituarios_ibfk_1` FOREIGN KEY (`pacientes_idpacientes`) REFERENCES `pacientes` (`idpacientes`),
  ADD CONSTRAINT `receituarios_ibfk_2` FOREIGN KEY (`medicos_idmedicos`) REFERENCES `medicos` (`idmedicos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
