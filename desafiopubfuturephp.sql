-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 17-Jan-2022 às 02:49
-- Versão do servidor: 10.2.14-MariaDB
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desafiopubfuturephp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas`
--

DROP TABLE IF EXISTS `contas`;
CREATE TABLE IF NOT EXISTS `contas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instituicao_financeira` varchar(155) NOT NULL,
  `tipo_conta` varchar(155) NOT NULL,
  `saldo` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `contas`
--

INSERT INTO `contas` (`id`, `instituicao_financeira`, `tipo_conta`, `saldo`, `created_at`, `updated_at`) VALUES
(17, 'Besc', '1', 1, '2022-01-15 11:32:42', '2022-01-15 11:32:42'),
(16, 'BB', '2', 3, '2022-01-15 11:32:30', '2022-01-15 20:18:56'),
(15, 'Itaú', '3', 2, '2022-01-15 11:31:50', '2022-01-15 11:31:50'),
(14, 'Bradesco', '1', 3.5, '2022-01-15 11:31:34', '2022-01-15 11:31:34'),
(11, 'Nuhbank', '2', 25, '2022-01-15 11:30:48', '2022-01-15 20:50:01'),
(12, 'Ailos', '2', 5, '2022-01-15 11:30:57', '2022-01-15 19:53:09'),
(13, 'Santander', '1', 22, '2022-01-15 11:31:17', '2022-01-15 21:03:07'),
(18, 'C6 Bank', '3', 1, '2022-01-15 11:32:57', '2022-01-15 11:32:57'),
(19, 'Banrisul', '1', 2.01, '2022-01-15 11:33:33', '2022-01-16 18:28:49'),
(20, 'Banesp', '2', 2, '2022-01-15 11:33:49', '2022-01-15 11:33:49'),
(43, '*', '1', 101.04, '2022-01-15 19:59:39', '2022-01-16 11:23:16'),
(44, 'Nuhbank', '1', 12.05, '2022-01-15 22:53:10', '2022-01-15 22:53:10'),
(45, '*Teste', '3', 0.03, '2022-01-16 16:04:27', '2022-01-16 16:04:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

DROP TABLE IF EXISTS `despesas`;
CREATE TABLE IF NOT EXISTS `despesas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(180) NOT NULL,
  `valor` float NOT NULL,
  `data_pagamento` date NOT NULL,
  `data_pagamento_esperado` date NOT NULL,
  `conta` int(255) NOT NULL,
  `tipo_despesa` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `despesas`
--

INSERT INTO `despesas` (`id`, `nome`, `valor`, `data_pagamento`, `data_pagamento_esperado`, `conta`, `tipo_despesa`, `created_at`, `updated_at`) VALUES
(1, 'Faculdade', 482, '2022-01-07', '2022-01-10', 15, 'Ensino', '2022-01-08 11:41:19', '2022-01-15 20:01:24'),
(3, 'Semasa', 31.04, '2020-10-15', '2020-10-10', 12, 'Água', '2022-01-15 16:53:26', '2022-01-15 22:57:05'),
(4, 'Celesc', 421, '2021-01-10', '2020-10-10', 12, 'Luz', '2022-01-15 16:53:55', '2022-01-15 22:47:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

DROP TABLE IF EXISTS `receitas`;
CREATE TABLE IF NOT EXISTS `receitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(130) NOT NULL,
  `valor` float NOT NULL,
  `data_recebimento` date NOT NULL,
  `data_recebimento_esperado` date NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `conta` int(255) NOT NULL,
  `tipo_receita` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `receitas`
--

INSERT INTO `receitas` (`id`, `nome`, `valor`, `data_recebimento`, `data_recebimento_esperado`, `descricao`, `conta`, `tipo_receita`, `created_at`, `updated_at`) VALUES
(1, 'Salário Pup', 3000, '2022-01-05', '2022-01-10', 'Recebimento efetuado antecipado', 13, 'Salário', '2022-01-08 10:00:25', '2022-01-15 20:11:30'),
(2, 'Pensão', 482, '2020-01-10', '2020-01-10', 'Pensão', 20, 'Pensão Alimentícia', '2022-01-10 11:41:38', '2022-01-15 17:53:44'),
(3, 'Pensão', 130.01, '2020-01-10', '2022-02-01', '**', 19, 'Pensão Militar', '2022-01-10 11:45:46', '2022-01-15 22:56:41'),
(4, 'Pis', 1450, '2022-01-10', '2022-02-15', 'Recebimento Anual', 18, 'Abono Governo', '2022-01-10 11:52:21', '2022-01-15 17:53:57'),
(5, '13º Salário', 320, '2021-12-15', '2021-12-20', '**', 12, '13º Salário', '2022-01-10 12:35:58', '2022-01-15 20:00:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_conta`
--

DROP TABLE IF EXISTS `tipo_conta`;
CREATE TABLE IF NOT EXISTS `tipo_conta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(110) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_conta`
--

INSERT INTO `tipo_conta` (`id`, `nome`, `created_at`, `updated_at`) VALUES
(1, 'CARTEIRA', '2022-01-15 22:24:32', '2022-01-15 22:24:37'),
(2, 'CONTA CORRENTE', '2022-01-15 22:24:38', '2022-01-15 22:24:39'),
(3, 'CONTA POUPANÇA', '2022-01-15 22:24:40', '2022-01-15 22:24:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
