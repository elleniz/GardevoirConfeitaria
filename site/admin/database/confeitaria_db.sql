-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para confeitaria
CREATE DATABASE IF NOT EXISTS `confeitaria` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `confeitaria`;

-- Copiando estrutura para tabela confeitaria.avaliacao
CREATE TABLE IF NOT EXISTS `avaliacao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(200) NOT NULL,
  `item_avaliado` varchar(200) NOT NULL,
  `tipo_avaliacao` varchar(500) DEFAULT NULL,
  `descricao_avaliacao` varchar(500) DEFAULT NULL,
  `nota_pedido` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela confeitaria.avaliacao: ~5 rows (aproximadamente)
INSERT INTO `avaliacao` (`id`, `nome_cliente`, `item_avaliado`, `tipo_avaliacao`, `descricao_avaliacao`, `nota_pedido`) VALUES
	(1, 'Ellen', 'não', 'Produto pedido WhatsApp', 'Muito bom esse produto que eu pedi pelo whatsapp eu ameiii muito divaram dmsss', '5'),
	(3, 'Arthur', 'todos', 'Pacote casamento', 'Foi legal eu casei e comi muitos deliciosos  doces amei muito doces e lindos e ficou tudo amei', '5'),
	(4, 'Leticia', 'Bolo de cenoura', 'Produto pedido WhatsApp', 'Chegou fofinho. Entregador gentil, porém tentou roubar minha moto', '5'),
	(5, 'Jasper', '', 'Estrutura do estabelecimento', 'Chão monhado', '1'),
	(7, 'Mestre de Degustação de Macarron ', 'Macarron todos', 'Produto loja presencial', 'Comi Todos os macarron, afinal, sou um Mestre de Degustação de Macarron, comi todos, pois preciso realizar meu trabalho de Comer macarron, achei muito bom alguns macarron, outros foi mais bom, outros foi menos bom que os mais bom, mas todos foram bons, nenhum foi ruim, parabéns para quem fez o Macarron, e o lugar é legal também', '4');

-- Copiando estrutura para tabela confeitaria.curso
CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `titulo_curso` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descricao_curso` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `link_curso` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `valor_curso` float NOT NULL DEFAULT '0',
  `duracao_curso` time NOT NULL,
  `professor_curso` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela confeitaria.curso: ~3 rows (aproximadamente)
INSERT INTO `curso` (`id`, `titulo_curso`, `descricao_curso`, `link_curso`, `valor_curso`, `duracao_curso`, `professor_curso`) VALUES
	(0000000003, 'O best', 'ensinando fazer coisas legais ok', '', 500.25, '02:30:00', 'felps'),
	(0000000004, 'Curso teste', 'vai ter testes', '', 500, '00:00:00', 'Professor teste'),
	(0000000005, 'Curso para confecção de Balas FInis', 'Curso para aprender a fazer Balas Finis', '', 299.99, '04:00:00', 'Balla e Finelps');

-- Copiando estrutura para tabela confeitaria.pedido
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(200) NOT NULL DEFAULT '0',
  `telefone_cliente` varchar(20) NOT NULL DEFAULT '0',
  `descricao_pedido` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `quantidade_produto` int NOT NULL DEFAULT '0',
  `data_hora_retirada` datetime NOT NULL,
  `valor_total` float NOT NULL,
  `forma_pagamento` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `status` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela confeitaria.pedido: ~4 rows (aproximadamente)
INSERT INTO `pedido` (`id`, `nome_cliente`, `telefone_cliente`, `descricao_pedido`, `quantidade_produto`, `data_hora_retirada`, `valor_total`, `forma_pagamento`, `status`) VALUES
	(0000000005, 'Ellen', '49984294089', 'Bem-casado', 300, '2026-06-09 15:30:00', 690, 'Pix', 'Em produção'),
	(0000000007, 'Jacskon Master Five', '2132131', 'Bolo', 2, '2026-06-24 02:03:00', 145, 'Pix', 'Entregue'),
	(0000000008, 'Ellen', '312', 'todos os itens da loja', 2, '2026-06-24 05:05:00', 22, 'todas', 'Pronto para retirada'),
	(0000000009, 'Amarelo', '99886654', 'Pudim de pipoca ', 42, '2022-02-23 00:00:00', 55, 'Dinheiro vivo', 'Cancelado');

-- Copiando estrutura para tabela confeitaria.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `telefone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela confeitaria.usuario: ~20 rows (aproximadamente)
INSERT INTO `usuario` (`id`, `nome`, `telefone`, `email`, `login`, `senha`) VALUES
	(0000000006, 'pessoa', '49984294089', 'pessoa122@oi', 'pessoinha', '$2y$10$PyeN9Twh5zlMAeceNxRX8ekgtRFhbm7pmUNvL8lpUzS8yXBPxFNt.'),
	(0000000015, 'Jackson Five 2', '84 9888-55522', 'lordjackson@gmail.com', 'jackson', '$2y$10$MPjXXvujKQq00iZ3mwitS.op29yRtYW0h.Jpfyp6wklF.P6FYfzL.'),
	(0000000016, 'Jackson Five 2', '84 9888-55522', 'lordjackson@gmail.com', 'jackson', '$2y$10$QoBjoCxieCw0KofT6Kb3hOhgo89FOgB0NXTUcPQhI4wsYKsvE85vC'),
	(0000000017, 'ekek', '49388', 'ellen@io', 'lili', '$2y$10$koFyaX1aB6QmNqT3RxJx3.I/MH0sZfXmKoOovJllxQRcuau1L4.Vy'),
	(0000000018, 'porta', '', 'porta@porta', 'porta', '$2y$10$ZEdn5YSqGDxx9OGmsjuUluWWuGGnW.02YZztRHQ3zpbTJHz6jGFR.'),
	(0000000019, 'Jackson Five 2', '84 9888-55522', 'lordjackson@gmail.com', 'jackson', '$2y$10$NTCQXZqYqPX1hKqmxGIIUuKX9qEAe598u7p0EkQ0L./OENvhXufma'),
	(0000000020, 'Jackson Five 2', '84 9888-55522', 'lordjackson@gmail.com', 'jackson', '$2y$10$yvMzqGL9wlnbWW2TOi2c7uN2B5QIGmdmHPt.swCBzC3RtXZifoh6q'),
	(0000000021, 'porta', '', 'porta@porta', 'porta', '$2y$10$T5y5Sb1weNPOpAWtH7WIB.oeH90e5WGTXhoXGx78cRIJRCDQYtxKW'),
	(0000000022, 'porta', '', 'porta@porta', 'porta', '$2y$10$FkfG9Uw7uCc3/4j9VHn.le25NWC7fs/YJeuVB.4Up11ALvBLlXwfe'),
	(0000000023, 'Jackson Five 2', '84 9888-55522', 'lordjackson@gmail.com', 'jackson', '$2y$10$CqLab2s3R7LpRsMCo3nv.O8Hq60KS.QFRhc5I77yVstgKasbW3Kgq'),
	(0000000024, 'pipoca', '89949898', 'popoca@popoca', 'admin', '$2y$10$1wXjtwZcofSS0TEjhCHxLuhX.GjE6HHKB7yi/7winC4gW9EBq7pou'),
	(0000000025, 'adminzao', '49000000000', 'admin@admun', 'admin', '$2y$10$ie5mN2lOjDIo/B6Gnti26.dK0oKxr.OEyxYTSQCsv2JKbEXCxKeW6'),
	(0000000026, 'dajisdjia', '31213', 'daijdja@kkd', 'ejwje', '$2y$10$or4rb7R9RepA/J9.iRb7Duc0iNbJLs1MF4NYzzuC91RPK8OeEdY3u'),
	(0000000027, 'eric', '123123', 'eric@riodejaneiro', 'cariocavulgo', '$2y$10$WSYDYuI0wMaVeZrXQH1Y5OaTZK4ws6nivCXQ.vnMXm.YUffnR3FZC'),
	(0000000028, 'ericao', '2342343', 'ericnaoaguentomais@ao', 'aiiifonsidigua', '$2y$10$pOk1J/O03VF3dbwOPUqCZO27igeSgkK.d2SBn7E4UpGNBj/OcN4rS'),
	(0000000029, 'Jackson Conta', '3132131', 'jackson@conta', 'jackson', '$2y$10$gNh2QbIfZ6jWL5sWG4WoZ.2gOrrCQY5Csl/wTX4pqHPrsLPHuA2fS'),
	(0000000030, 'pop', '56', 'gygh@tfvg', 'llll', '$2y$10$9thT/eqgU/OocTE0zBWpceg.ka1UlkqwB6tbZvM0pEEddiW1uTG/y'),
	(0000000031, 'Porooro', '123233', 'pororo@gmail', 'ellen', '$2y$10$cCAO/lsW4.LxygS08SWtDuUKBL7enZjqHRENgxh8Jn.28ql9R1DQq'),
	(0000000032, 'berardo', '456544565', 'berardo@berardo', 'berardo', '$2y$10$/0q.lKLI5mR9GbERAl2n1.NNVY/SiWCRJXqUp5eVWgCMkGCsUTHyG'),
	(0000000033, 'maria', '454545', 'julia@ka', 'maria', '$2y$10$5NvUvUj27PGACbD/CCK/e.PfLH5tXzzNt7Dpsn/ocOc4kEz.vX2n.');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
