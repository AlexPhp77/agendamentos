-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16-Out-2020 às 13:23
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `agenda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `cep` varchar(50) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id`, `id_usuario`, `estado`, `cidade`, `cep`, `rua`, `numero`) VALUES
(50, 24, 'Paraná', 'Guarapuava', '85015-240', 'qualquer', 33),
(49, 23, 'Paraná', 'Guarapuava', '89898-989', 'qualquerrua', 44),
(46, 20, 'PR - Paraná', 'Guarapuava', '85015-240', 'qualquer', 33),
(45, 19, 'Paraná', 'Guarapuava', '85015-240', 'qualquer', 33),
(44, 18, 'PR - Paraná', 'Guarapuava', '85015-240', 'qualquer', 8),
(43, 17, 'PR - Paraná', 'Guarapuava', '85015-240', 'R:Comendador Norberto', 3),
(42, 16, 'PR - Paraná', 'Guarapuava', '85015-240', 'Jesuinomarcondes', 5),
(41, 43, 'PR - Paraná', 'Guarapuava', '85015-240', 'Jesuíno Marcondes', 31),
(40, 14, 'PR - Paraná', 'Guarapuava', '85015-240', 'qualquer', 8),
(37, 5, 'PR - Paraná', 'Guarapuava', '85015-240', 'R:Comendador Norberto', 31),
(39, 13, 'PR - Paraná', 'Guarapuava', '85015-240', 'qualquerrua', 5),
(35, 3, 'Paraná', 'Guarapuava', '12121-212', 'Geronimo', 55),
(34, 2, 'Paraná', 'Guarapuava', '99999-999', 'Jesuíno Marcondes', 7),
(33, 1, 'Santa Catarina', 'Jaragua do Sul 2', '67676-767', 'Comendador Norberto', 33);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `idade` int(3) DEFAULT NULL,
  `sexo` varchar(20) NOT NULL,
  `cpf` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `permissoes` varchar(100) NOT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `cep` varchar(50) DEFAULT NULL,
  `rua` varchar(50) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nome`, `idade`, `sexo`, `cpf`, `email`, `telefone`, `senha`, `permissoes`, `estado`, `cidade`, `cep`, `rua`, `numero`) VALUES
(1, 'Barbeiro 1', NULL, 'Feminino', '43432423423423', 'rathivi@hotmail.com', '343434343434', '25d55ad283aa400af464c76d713c07ad', 'SECRETARIO', NULL, NULL, NULL, NULL, NULL),
(3, 'Barbeiro 2', NULL, 'Masculino', '564646456456', 'alex.rai@hotmail.com', '3423423423', '25d55ad283aa400af464c76d713c07ad', 'SECRETARIO', 'Santa Catarina', 'Qualquer', '3543534534534545', 'qualquer', NULL),
(5, 'Barbeiro 3', 27, 'Feminino', '234.252.345-24', 'r234234234athivi@hotmail.com', '(42)98403-5625', '6096cb8f5d8ba99918f67b07d871c9fe', 'SECRETARIO', 'PR - Paraná', 'Guarapuava', '85015-240', 'Jesuinomarcondes', 33),
(6, 'ValTeste', 27, 'Masculino', '234.554.535-45', 'val@gmail.com', '(23)42354-3242', '61364717ddc292f5d7347a155dcdf086', 'SECRETARIO', 'Paraná', 'Guarapuava', '85015-240', 'sfdsfsdfsd', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperar_senha`
--

DROP TABLE IF EXISTS `recuperar_senha`;
CREATE TABLE IF NOT EXISTS `recuperar_senha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `cod` varchar(32) NOT NULL,
  `tempo_cod` datetime NOT NULL,
  `used` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `recuperar_senha`
--

INSERT INTO `recuperar_senha` (`id`, `id_usuario`, `cod`, `tempo_cod`, `used`) VALUES
(1, 19, '0632f0bf76f84115a51e607880e16c44', '2020-09-12 18:49:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_dentista` int(11) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT 'Reserva',
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime NOT NULL,
  `all_day` tinyint(1) DEFAULT NULL,
  `cor` varchar(50) DEFAULT NULL,
  `confirmado` tinyint(1) NOT NULL DEFAULT '0',
  `display` varchar(50) NOT NULL DEFAULT 'auto',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=357 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `idade` int(3) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `cpf` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(50) NOT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `permissoes` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `idade`, `sexo`, `cpf`, `email`, `telefone`, `senha`, `permissoes`) VALUES
(1, 'Pedro Santos Fonseca', 33, 'Masculino', '789.787.989-78', 'pedrinho@gmail.com', '(67)67757-5675', '25d55ad283aa400af464c76d713c07ad', 'ADMINISTRADOR'),
(2, 'Joao Machado', 55, 'Masculino', '889.898.989-98', NULL, '(78)78787-8787', '25d55ad283aa400af464c76d713c07ad', NULL),
(3, 'Sara Luz', 33, 'Feminino', '121.212.121-21', 'sara@gmail.com', '', NULL, NULL),
(13, 'Vitória ', 27, 'Feminino', '342.423.424-23', 'rar23423thivi@hotmail.com', '(42)98403-5625', 'b49db5657881122ba2d827520e19f790', NULL),
(5, 'Paulo Gomes', 34, 'Masculino', '777.777.777-77', NULL, '(34)34343-434', NULL, NULL),
(10, 'veri', 34, 'Feminino', '423423423423', NULL, '34343433', NULL, NULL),
(11, 'Solange', 21, 'Feminino', '34234234324', NULL, '3423432434', NULL, NULL),
(14, 'Veri ', 27, 'Feminino', '423.425.253-52', 'ra234234234234thivi@hotmail.com', '(42)98403-5625', '6ae09efefe0c02bc002f4707e28fc460', NULL),
(20, 'Thiago Machado', 24, 'Masculino', '423.425.345-34', 'thiago@gmail.com', '(24)23422-3423', '25d55ad283aa400af464c76d713c07ad', NULL),
(16, 'Pereira  Teste', 44, 'Masculino', '342.342.342-34', 'rathivi@hotmail.com', '(34)34343-434', NULL, NULL),
(17, 'Vitória', 27, 'Masculino', '076.128.379-00', NULL, '(42)98403-5625', NULL, NULL),
(18, 'Fred  Teste', 27, 'Masculino', '242.342.434-23', NULL, '(42)98403-5625', 'bfd9013778c03164881caa7a537633c1', NULL),
(19, 'Bernardo  Teste', 27, 'Masculino', '234.834.989-93', 'bernardo@hotmail.com', '(42)98403-5625', '25d55ad283aa400af464c76d713c07ad', NULL),
(23, 'Fernando Teste 3', 55, 'Masculino', '666.666.666-66', 'fernando@gmail.com', '(77)77777-7777', '25d55ad283aa400af464c76d713c07ad', NULL),
(24, 'Edi Amigo', 34, 'Masculino', '534.563.465-64', 'edi@gmail.com', '(25)42352-4354', '25d55ad283aa400af464c76d713c07ad', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
