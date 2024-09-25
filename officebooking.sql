-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 25/09/2024 às 15:20
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
(1, 'UNIALFA Bueno', 1, 1, 'Av. Mutirão', '2024-09-17 21:59:13', '2024-09-18 23:40:38'),
(3, 'UNIALFA Perimetral', 1, 1, 'Av. Juiz de Fora | N° 811 | Qd. 254 | Lt. 04 Jardim Novo Mundo | Goiânia GO', '2024-09-18 23:40:24', '2024-09-18 23:40:24');

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
(11, 'HDMI', NULL, 'SAMSUNG', NULL, 'a:2:{i:1;a:12:{i:0;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"06:00\";s:11:\"horario_fim\";s:5:\"07:00\";}i:1;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"07:20\";s:11:\"horario_fim\";s:5:\"08:20\";}i:2;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"08:40\";s:11:\"horario_fim\";s:5:\"09:40\";}i:3;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"10:00\";s:11:\"horario_fim\";s:5:\"11:00\";}i:4;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"11:20\";s:11:\"horario_fim\";s:5:\"12:20\";}i:5;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"12:40\";s:11:\"horario_fim\";s:5:\"13:40\";}i:6;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"14:00\";s:11:\"horario_fim\";s:5:\"15:00\";}i:7;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"15:20\";s:11:\"horario_fim\";s:5:\"16:20\";}i:8;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"16:40\";s:11:\"horario_fim\";s:5:\"17:40\";}i:9;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"18:00\";s:11:\"horario_fim\";s:5:\"19:00\";}i:10;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"19:20\";s:11:\"horario_fim\";s:5:\"20:20\";}i:11;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"20:40\";s:11:\"horario_fim\";s:5:\"21:40\";}}i:2;a:8:{i:0;a:4:{s:10:\"dia_semana\";s:12:\"Terça-feira\";s:14:\"dia_semana_key\";s:1:\"2\";s:14:\"horario_inicio\";s:5:\"06:00\";s:11:\"horario_fim\";s:5:\"07:00\";}i:1;a:4:{s:10:\"dia_semana\";s:12:\"Terça-feira\";s:14:\"dia_semana_key\";s:1:\"2\";s:14:\"horario_inicio\";s:5:\"07:20\";s:11:\"horario_fim\";s:5:\"08:20\";}i:2;a:4:{s:10:\"dia_semana\";s:12:\"Terça-feira\";s:14:\"dia_semana_key\";s:1:\"2\";s:14:\"horario_inicio\";s:5:\"08:40\";s:11:\"horario_fim\";s:5:\"09:40\";}i:3;a:4:{s:10:\"dia_semana\";s:12:\"Terça-feira\";s:14:\"dia_semana_key\";s:1:\"2\";s:14:\"horario_inicio\";s:5:\"10:00\";s:11:\"horario_fim\";s:5:\"11:00\";}i:4;a:4:{s:10:\"dia_semana\";s:12:\"Terça-feira\";s:14:\"dia_semana_key\";s:1:\"2\";s:14:\"horario_inicio\";s:5:\"11:20\";s:11:\"horario_fim\";s:5:\"12:20\";}i:5;a:4:{s:10:\"dia_semana\";s:12:\"Terça-feira\";s:14:\"dia_semana_key\";s:1:\"2\";s:14:\"horario_inicio\";s:5:\"13:00\";s:11:\"horario_fim\";s:5:\"14:00\";}i:6;a:4:{s:10:\"dia_semana\";s:12:\"Terça-feira\";s:14:\"dia_semana_key\";s:1:\"2\";s:14:\"horario_inicio\";s:5:\"14:20\";s:11:\"horario_fim\";s:5:\"15:20\";}i:7;a:4:{s:10:\"dia_semana\";s:12:\"Terça-feira\";s:14:\"dia_semana_key\";s:1:\"2\";s:14:\"horario_inicio\";s:5:\"15:40\";s:11:\"horario_fim\";s:5:\"16:40\";}}}', 1, 1, 1, '2024-09-19 22:05:32', '2024-09-25 00:30:35'),
(12, 'Sala de Informática 1104', '40', NULL, NULL, 'a:5:{i:1;a:3:{i:0;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"08:00\";s:11:\"horario_fim\";s:5:\"09:00\";}i:1;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"09:20\";s:11:\"horario_fim\";s:5:\"10:20\";}i:2;a:4:{s:10:\"dia_semana\";s:13:\"Segunda-feira\";s:14:\"dia_semana_key\";s:1:\"1\";s:14:\"horario_inicio\";s:5:\"10:40\";s:11:\"horario_fim\";s:5:\"11:40\";}}i:2;a:3:{i:0;a:4:{s:10:\"dia_semana\";s:12:\"Terça-feira\";s:14:\"dia_semana_key\";s:1:\"2\";s:14:\"horario_inicio\";s:5:\"08:00\";s:11:\"horario_fim\";s:5:\"09:00\";}i:1;a:4:{s:10:\"dia_semana\";s:12:\"Terça-feira\";s:14:\"dia_semana_key\";s:1:\"2\";s:14:\"horario_inicio\";s:5:\"09:20\";s:11:\"horario_fim\";s:5:\"10:20\";}i:2;a:4:{s:10:\"dia_semana\";s:12:\"Terça-feira\";s:14:\"dia_semana_key\";s:1:\"2\";s:14:\"horario_inicio\";s:5:\"10:40\";s:11:\"horario_fim\";s:5:\"11:40\";}}i:3;a:3:{i:0;a:4:{s:10:\"dia_semana\";s:12:\"Quarta-feira\";s:14:\"dia_semana_key\";s:1:\"3\";s:14:\"horario_inicio\";s:5:\"08:00\";s:11:\"horario_fim\";s:5:\"09:00\";}i:1;a:4:{s:10:\"dia_semana\";s:12:\"Quarta-feira\";s:14:\"dia_semana_key\";s:1:\"3\";s:14:\"horario_inicio\";s:5:\"09:20\";s:11:\"horario_fim\";s:5:\"10:20\";}i:2;a:4:{s:10:\"dia_semana\";s:12:\"Quarta-feira\";s:14:\"dia_semana_key\";s:1:\"3\";s:14:\"horario_inicio\";s:5:\"10:40\";s:11:\"horario_fim\";s:5:\"11:40\";}}i:4;a:3:{i:0;a:4:{s:10:\"dia_semana\";s:12:\"Quinta-feira\";s:14:\"dia_semana_key\";s:1:\"4\";s:14:\"horario_inicio\";s:5:\"13:00\";s:11:\"horario_fim\";s:5:\"14:00\";}i:1;a:4:{s:10:\"dia_semana\";s:12:\"Quinta-feira\";s:14:\"dia_semana_key\";s:1:\"4\";s:14:\"horario_inicio\";s:5:\"14:20\";s:11:\"horario_fim\";s:5:\"15:20\";}i:2;a:4:{s:10:\"dia_semana\";s:12:\"Quinta-feira\";s:14:\"dia_semana_key\";s:1:\"4\";s:14:\"horario_inicio\";s:5:\"15:40\";s:11:\"horario_fim\";s:5:\"16:40\";}}i:5;a:3:{i:0;a:4:{s:10:\"dia_semana\";s:11:\"Sexta-feira\";s:14:\"dia_semana_key\";s:1:\"5\";s:14:\"horario_inicio\";s:5:\"13:00\";s:11:\"horario_fim\";s:5:\"14:00\";}i:1;a:4:{s:10:\"dia_semana\";s:11:\"Sexta-feira\";s:14:\"dia_semana_key\";s:1:\"5\";s:14:\"horario_inicio\";s:5:\"14:20\";s:11:\"horario_fim\";s:5:\"15:20\";}i:2;a:4:{s:10:\"dia_semana\";s:11:\"Sexta-feira\";s:14:\"dia_semana_key\";s:1:\"5\";s:14:\"horario_inicio\";s:5:\"15:40\";s:11:\"horario_fim\";s:5:\"16:40\";}}}', 1, 1, 1, '2024-09-19 22:52:51', '2024-09-19 22:52:51');

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
(3, 2, 12, 1, 'cancelada', 'Quinta-feira, das 15:40 às 16:40', 'Quinta-feira, das 15:40 às 16:40', 'teste', 2, 1, '2024-09-25 00:07:38', '2024-09-25 13:20:11'),
(4, 2, 11, 1, 'pendente', 'Segunda-feira, das 06:00 às 07:00', 'Segunda-feira, das 06:00 às 07:00', 'teste', 2, 1, '2024-09-25 00:25:50', '2024-09-25 13:20:08'),
(5, 2, 11, 1, 'aprovada', 'Segunda-feira, das 08:40 às 09:40', 'Segunda-feira, das 08:40 às 09:40', NULL, 2, 1, '2024-09-25 13:15:33', '2024-09-25 13:20:10');

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
('4Kb6BKN2doBl4Z35FZWWis4XJWu6dNl2DDJf2YsE', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:130.0) Gecko/20100101 Firefox/130.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiN0IyaE9ScmtxT2s0YUxjMllrNGNVWmtJWW5HNlFKd0Naak9GaUpRTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbnZlbnRhcmlvcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNDoiaW5zdGl0dWljYW9faWQiO3M6MToiMSI7czoxNjoiaW5zdGl0dWljYW9fbm9tZSI7czoxMzoiVU5JQUxGQSBCdWVubyI7fQ==', 1727270418);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `instituicao_id` int(11) DEFAULT NULL,
  `funcao` varchar(255) NOT NULL DEFAULT 'professor',
  `create_user_id` int(11) NOT NULL,
  `update_user_id` int(11) NOT NULL,
  `primeiro_acesso` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `telefone`, `instituicao_id`, `funcao`, `create_user_id`, `update_user_id`, `primeiro_acesso`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ale', 'email@email.com', '(62) 99459-0787', NULL, 'admin', 0, 0, 0, NULL, '$2y$12$sR5Cq9CuScok.3yPoWr33eFhvioSNQQmp9c1RT1yThmSzeBUoQ0MC', NULL, NULL, '2024-09-25 00:51:22'),
(2, 'Marcos', 'djmarcosban@hotmail.com', '(62) 99459-0787', 1, 'professor', 1, 1, 0, NULL, '$2y$12$VJ1yNmseLPznCMu3NMtzwOj7h8hk/7zOs625CeA6x8a/DEP5lIcTC', NULL, '2024-09-17 22:34:59', '2024-09-25 00:49:00');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
