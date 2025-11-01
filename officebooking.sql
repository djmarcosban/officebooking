-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 01/11/2025 às 01:02
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `officebooking`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_criar_reserva` (IN `p_professor_id` INT, IN `p_inventario_id` INT, IN `p_instituicao_id` INT, IN `p_data` VARCHAR(255), IN `p_horario` VARCHAR(255), IN `p_descricao` VARCHAR(255), IN `p_user_id` INT, OUT `p_reserva_id` BIGINT)   BEGIN
      -- Quem esta criando precisa ser professor
      IF fn_is_professor(p_user_id) = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Só professor pode criar reserva.';
      END IF;

      -- E o professor_id referenciado também precisa ser professor
      IF fn_is_professor(p_professor_id) = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'professor_id deve ser de um usuário com função \"professor\".';
      END IF;

      INSERT INTO reservas (
        professor_id, inventario_id, instituicao_id, status, data, horario, descricao,
        create_user_id, update_user_id, created_at, updated_at
      ) VALUES (
        p_professor_id, p_inventario_id, p_instituicao_id, 'pendente', p_data, p_horario, p_descricao,
        p_user_id, p_user_id, NOW(), NOW()
      );

      SET p_reserva_id = LAST_INSERT_ID();
    END$$

--
-- Funções
--
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_is_professor` (`p_user_id` INT) RETURNS TINYINT(4) DETERMINISTIC BEGIN
      DECLARE v_cnt INT DEFAULT 0;
      IF p_user_id IS NULL THEN
        RETURN 0;
      END IF;
      SELECT COUNT(*) INTO v_cnt
        FROM users
      WHERE id = p_user_id
        AND funcao = 'professor';
      RETURN IF(v_cnt > 0, 1, 0);
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `instituicaos`
--

CREATE TABLE `instituicaos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `endereco` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `instituicaos`
--

INSERT INTO `instituicaos` (`id`, `nome`, `create_user_id`, `update_user_id`, `endereco`, `created_at`, `updated_at`) VALUES
(1, 'Test', 1, 1, 'Test', '2025-09-22 23:11:13', '2025-09-22 23:11:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `inventarios`
--

CREATE TABLE `inventarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cap_max` varchar(255) DEFAULT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `horarios` text DEFAULT NULL,
  `instituicao_id` int(11) NOT NULL,
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `inventarios`
--

INSERT INTO `inventarios` (`id`, `nome`, `cap_max`, `marca`, `descricao`, `horarios`, `instituicao_id`, `create_user_id`, `update_user_id`, `created_at`, `updated_at`) VALUES
(1, 'Cabo HMDI', NULL, NULL, NULL, 'a:1:{i:1;a:1:{i:0;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"06:00\";s:11:\"horario_fim\";s:5:\"07:00\";}}}', 1, 1, 1, '2025-10-31 23:34:58', '2025-10-31 23:34:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"d9881a7b-837b-4142-92ee-dec9a6fe3224\",\"displayName\":\"App\\\\Mail\\\\Email\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":15:{s:8:\\\"mailable\\\";O:14:\\\"App\\\\Mail\\\\Email\\\":4:{s:4:\\\"data\\\";a:3:{s:2:\\\"to\\\";s:23:\\\"djmarcosban@hotmail.com\\\";s:7:\\\"subject\\\";s:18:\\\"Nova solicitação\\\";s:4:\\\"time\\\";s:23:\\\"31\\/10\\/2025 às 20:35:04\\\";}s:4:\\\"view\\\";s:11:\\\"new-request\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"djmarcosban@hotmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"}}', 0, NULL, 1761953704, 1761953704);

-- --------------------------------------------------------

--
-- Estrutura para tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_16_184239_create_inventarios_table', 1),
(5, '2024_09_16_184503_create_instituicaos_table', 1),
(6, '2024_09_16_184550_create_reservas_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `professor_id` int(11) NOT NULL,
  `inventario_id` int(11) NOT NULL,
  `instituicao_id` int(11) NOT NULL,
  `status` enum('pendente','aprovada','cancelada','historico') NOT NULL DEFAULT 'pendente',
  `data` varchar(255) DEFAULT NULL,
  `horario` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `reservas`
--

INSERT INTO `reservas` (`id`, `professor_id`, `inventario_id`, `instituicao_id`, `status`, `data`, `horario`, `descricao`, `create_user_id`, `update_user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'pendente', 'Segunda-feira, das 06:00 às 07:00', 'Segunda-feira, das 06:00 às 07:00', NULL, 2, 2, '2025-10-31 23:35:04', '2025-10-31 23:35:04');

--
-- Acionadores `reservas`
--
DELIMITER $$
CREATE TRIGGER `tr_reservas_prof_bi` BEFORE INSERT ON `reservas` FOR EACH ROW BEGIN
      IF fn_is_professor(NEW.create_user_id) = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Apenas usuário com função "professor" pode criar reserva.';
      END IF;

      IF fn_is_professor(NEW.professor_id) = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'O campo professor_id deve apontar para um usuário com função "professor".';
      END IF;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_reservas_prof_bu` BEFORE UPDATE ON `reservas` FOR EACH ROW BEGIN
      IF NEW.professor_id <> OLD.professor_id AND fn_is_professor(NEW.professor_id) = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'professor_id deve ser um usuário com função "professor".';
      END IF;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9lZoRIdbLJszdqnF6zEDcwaa2irb9WGZ1L51V5vQ', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:144.0) Gecko/20100101 Firefox/144.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoickhCZ09wYXJObmpiU0ZzS3lkMlEwMzR0czhCQzZNM1lCTzQ3b0ptbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1761955317),
('Qh3YF52PHwRxCzhgEssUA9c5BXQFru5CbEA8TCJj', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:144.0) Gecko/20100101 Firefox/144.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiVFFYSXBkc3VpcWhTQTZTWVR4R1hHcWFiTG9rYktzSlB1ZmUzdmY4MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYWluZWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE0OiJpbnN0aXR1aWNhb19pZCI7czoxOiIxIjtzOjE2OiJpbnN0aXR1aWNhb19ub21lIjtzOjQ6IlRlc3QiO30=', 1761953729);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `primeiro_acesso` int(11) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `instituicao_id` int(11) DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `funcao` varchar(255) NOT NULL DEFAULT 'professor',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `primeiro_acesso`, `telefone`, `instituicao_id`, `create_user_id`, `update_user_id`, `funcao`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Marcos', 'djmarcosban@hotmail.com', NULL, NULL, NULL, 1, 0, 'admin', NULL, '$2y$12$Mqp8dcDgUXyk95DZ5d9QnuB/dB53GbOzs.rPKQ8bVIIgOk9sMDWYa', 'yaNE1knzvY', '2025-09-22 23:11:13', '2025-11-01 00:01:54'),
(2, 'Professor1', 'professor1@email.com', NULL, NULL, 1, 1, 1, 'professor', NULL, '$2y$10$f/Oxi5r3PpiqzVHBDPdxGuhE0cnL8VnnDpC7Dnjlz.lR12f7jXvuu', '6Ys4Os86XxiqRViIXfkryciGTijHXZeSeTKLaNsnqMirxGQs5t5nxvg65ojt', '2025-09-22 23:11:13', '2025-09-22 23:11:13');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `vw_reservas_basico`
-- (Veja abaixo para a visão atual)
--
CREATE TABLE `vw_reservas_basico` (
`id` bigint(20) unsigned
,`status` enum('pendente','aprovada','cancelada','historico')
,`professor_id` int(11)
,`professor_nome` varchar(255)
,`inventario_id` int(11)
,`inventario_nome` varchar(255)
,`instituicao_id` int(11)
,`instituicao_nome` varchar(255)
,`data` varchar(255)
,`horario` varchar(255)
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Estrutura para view `vw_reservas_basico`
--
DROP TABLE IF EXISTS `vw_reservas_basico`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_reservas_basico`  AS SELECT `r`.`id` AS `id`, `r`.`status` AS `status`, `r`.`professor_id` AS `professor_id`, `u`.`nome` AS `professor_nome`, `r`.`inventario_id` AS `inventario_id`, `i`.`nome` AS `inventario_nome`, `r`.`instituicao_id` AS `instituicao_id`, `inst`.`nome` AS `instituicao_nome`, `r`.`data` AS `data`, `r`.`horario` AS `horario`, `r`.`created_at` AS `created_at`, `r`.`updated_at` AS `updated_at` FROM (((`reservas` `r` left join `users` `u` on(`u`.`id` = `r`.`professor_id`)) left join `inventarios` `i` on(`i`.`id` = `r`.`inventario_id`)) left join `instituicaos` `inst` on(`inst`.`id` = `r`.`instituicao_id`)) ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Índices de tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `instituicaos`
--
ALTER TABLE `instituicaos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices de tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `instituicaos`
--
ALTER TABLE `instituicaos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
