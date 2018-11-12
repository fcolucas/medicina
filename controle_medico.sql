-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 12-Nov-2018 às 01:31
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

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

DROP TABLE IF EXISTS `medicamentos`;
CREATE TABLE IF NOT EXISTS `medicamentos` (
  `idmedicamentos` int(11) NOT NULL AUTO_INCREMENT,
  `nomeMedicamento` varchar(50) NOT NULL,
  `unidade` varchar(3) NOT NULL,
  `quantidade` float NOT NULL,
  PRIMARY KEY (`idmedicamentos`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicos`
--

DROP TABLE IF EXISTS `medicos`;
CREATE TABLE IF NOT EXISTS `medicos` (
  `idmedicos` int(11) NOT NULL AUTO_INCREMENT,
  `nomeMedico` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`idmedicos`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `medicos`
--

INSERT INTO `medicos` (`idmedicos`, `nomeMedico`, `usuario`, `senha`) VALUES
(1, 'Francisco Lucas', 'fcolucas', 'lucas1234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `idpacientes` int(11) NOT NULL AUTO_INCREMENT,
  `nomePaciente` varchar(50) NOT NULL,
  `dataNascimento` date NOT NULL,
  `sexo` char(1) NOT NULL,
  PRIMARY KEY (`idpacientes`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prescricao`
--

DROP TABLE IF EXISTS `prescricao`;
CREATE TABLE IF NOT EXISTS `prescricao` (
  `receituarios_idreceituarios` int(11) NOT NULL,
  `medicamentos_idmedicamentos` int(11) NOT NULL,
  `dosagem` float NOT NULL,
  `intervalo` int(11) NOT NULL,
  `tipoIntervalo` varchar(10) NOT NULL,
  KEY `receituarios_idreceituarios` (`receituarios_idreceituarios`),
  KEY `medicamentos_idmedicamentos` (`medicamentos_idmedicamentos`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `receituarios`
--

DROP TABLE IF EXISTS `receituarios`;
CREATE TABLE IF NOT EXISTS `receituarios` (
  `idreceituarios` int(11) NOT NULL AUTO_INCREMENT,
  `pacientes_idpacientes` int(11) NOT NULL,
  `medicos_idmedicos` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `observacoes` text,
  PRIMARY KEY (`idreceituarios`),
  KEY `pacientes_idpacientes` (`pacientes_idpacientes`),
  KEY `medicos_idmedicos` (`medicos_idmedicos`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
