-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2020-11-20 08:51:24
-- サーバのバージョン： 10.4.14-MariaDB
-- PHP のバージョン: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `equipmentsystem`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `administrator`
--

CREATE TABLE `administrator` (
  `id` varchar(100) NOT NULL COMMENT '管理者のメールアドレス',
  `password` varchar(255) NOT NULL COMMENT 'パスワードSHA-256',
  `flag` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='管理者(教員)のデータ';

--
-- テーブルのデータのダンプ `administrator`
--

INSERT INTO `administrator` (`id`, `password`, `flag`) VALUES
('111@aa.jp', '0ffe1abd1a08215353c233d6e009613e95eec4253832a761af28ff37ac5a150c', 0),
('aa@aa.jp', '$argon2i$v=19$m=65536,t=4,p=1$Y1JBLzFCVDFLYXBSOUw5Tw$N/y7t/6hOdJ00rM/qerWzuE05cSuv1zRFuvBlJGNPNU', 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
