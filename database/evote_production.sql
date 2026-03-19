-- eVote Production Database
-- Clean installation with admin user
-- Generated: 2026-03-19

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- Create database
CREATE DATABASE IF NOT EXISTS `evote` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `evote`;

-- Admin User (mikebergafu@gmail.com / password)
-- Password hash for 'password': $2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'mikebergafu@gmail.com', NOW(), '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, NULL, NULL, NULL, NOW(), NOW());

SET FOREIGN_KEY_CHECKS = 1;

-- Instructions:
-- 1. Import this file: mysql -u root -p < evote_production.sql
-- 2. Run migrations: php artisan migrate
-- 3. Login with: mikebergafu@gmail.com / password
-- 4. Change password after first login
