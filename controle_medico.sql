-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Nov-2018 às 00:19
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.11

--
-- Database: `controle_medico`
--

CREATE DATABASE controle_medico;
USE controle_medico;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamentos`
--

CREATE TABLE `medicamentos` (
  `idmedicamentos` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nomeMedicamento` varchar(50) NOT NULL,
  `unidade` varchar(4) NOT NULL,
  `quantidade` float NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `medicamentos`
--

INSERT INTO `medicamentos` (`idmedicamentos`, `nomeMedicamento`, `unidade`, `quantidade`, descricao) VALUES
("", 'Amoxilina', 'cap', 20, 'Antibiotico indicado para o tratamento de infecções bactecianas'),
("", 'Sonrisal', 'cap', 2, "Antiácido e analgésico"),
("", 'Viagra', 'cap', 20, "Tratamento da disfunção erétil"),
("", 'AAS', 'cap', 14, "Antitérmico, analgésico e anti-inflamatório"),
("", 'Aceticil', 'cap', 10, "Medicamento expectorante"),
("", 'Acnase Gel', 'g', 1, "Tratamento de Acne"),
("", 'Bactrim Comprimido', 'cap', 20, "Indicado para o tratamento de infecções"),
("", 'Bactrim F Suspensão Oral', 'ml', 100, "Indicado para o tratamento de infecções"),
("", 'Benalet', 'cap', 12, "Tratamento de sintomas, tais como tosse, irritação da garganta e faringite"),
("", 'Benegrip', 'cap', 20, "Analgésico, antitérmico e descongestionante nasal"),
("", 'Buscofem', 'cap', 10, 'Tratamento de febre e dores associadas a gripe'),
("", 'Calcigenol', 'ml', 300, "Reposição de cálcio e de flúor"),
("", 'Camomilina C', 'cap', 20, "Suplemento de vitaminas C e D3 que auxilia no alívio de sinais e sintomas associados com a primeira dentição"),
("", 'Captopril', 'cap', 30, "Tratamento de hipertensão arterial"),
("", 'Femynazol', 'g', 1, "Tratamento local de infecções"),
("",'Ibuprofeno', 'ml', 30, 'Alivio temporário da febre e dores de leve a moderada'),
("", 'Pamergan', 'cap', 10, "Indicado nas rinites alérgicas"),
("", 'Paracetamol Solução Oral', 'ml', 15, "Redução da febre e para o alívio temporário de dores leves a moderadas"),
("", 'Venalot', 'cap', 30, "Tratamento de problemas das veias e dos vasos linfáticos"),
("",'Lacmax', 'ml', 120, 'Tratamento sintomatico da constipação intestinal'),
("",'Gabapentina', 'cap', 30,'Tratamento da dor neuropatica'),
("",'Magnazia', 'com', 30, 'Destinado para o tratamento da azia associada ao refluxo gástrico'),
("",'Cefaliv', 'com', 12, 'Para o tratamento das crises de dor de cabeça'),
("",'Ultrafer', 'ml', 10, 'Indicado no tratamento e preveção das anemias ferroprivas'),
("",'Xefo', 'com', 30, 'Tratamento da dor lombar aguda e crônica'),
("", 'Aceclofenaco', 'com', 16, 'Indicado para o tratamento de processos inflamatórios, dores de dente, dores agudas'),
("", 'Advil', 'cap', 8, 'Analgesico, antinfamatório'),
("", 'Acetazona', 'ml', 120, 'Eficiente no tratamento de infecções'),
("", 'Dermalive', 'ml', 120, 'Proteção da pele danificada pelas intepéries diárias');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicos`
--

CREATE TABLE `medicos` (
  `idmedicos` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nomeMedico` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `medicos`
--

INSERT INTO `medicos` (`idmedicos`, `nomeMedico`, `usuario`, `senha`) VALUES
("", 'Francisco Lucas', 'fcolucas', 'lucas1234'),
("", 'Juliana Cardoso', 'jucardoso', 'ju1234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `idpacientes` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `medicos_idmedicos` int(11) NOT NULL,
  `nomePaciente` varchar(50) NOT NULL,
  `dataNascimento` date NOT NULL,
  `sexo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `receituarios`
--

CREATE TABLE `receituarios` (
  `idreceituarios` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `pacientes_idpacientes` int(11) NOT NULL,
  `medicos_idmedicos` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `observacoes` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Estrutura da tabela `prescricao`
--

CREATE TABLE `prescricao` (
  `sequence` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `receituarios_idreceituarios` int(11) NOT NULL,
  `medicamentos_idmedicamentos` int(11) NOT NULL,
  `dosagem` float NOT NULL,
  `intervalo` int(11) NOT NULL,
  `tipoIntervalo` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
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
  ADD KEY `pacientes_idpacientes` (`pacientes_idpacientes`),
  ADD KEY `medicos_idmedicos` (`medicos_idmedicos`);

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


