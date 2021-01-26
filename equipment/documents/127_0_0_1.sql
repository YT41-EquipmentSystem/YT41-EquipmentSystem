-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-01-26 06:01:48
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
CREATE DATABASE IF NOT EXISTS `equipmentsystem` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `equipmentsystem`;

-- --------------------------------------------------------

--
-- テーブルの構造 `administrator`
--

CREATE TABLE `administrator` (
  `id` varchar(100) NOT NULL COMMENT '管理者のメールアドレス',
  `password` varchar(255) NOT NULL COMMENT 'パスワードSHA-256',
  `login_failure_count` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'ログイン失敗回数',
  `login_failure_time` datetime DEFAULT NULL COMMENT 'ログイン失敗日時',
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='管理者(教員)のデータ';

--
-- テーブルのデータのダンプ `administrator`
--

INSERT INTO `administrator` (`id`, `password`, `login_failure_count`, `login_failure_time`, `delete_flag`) VALUES
('yt41@oic.jp', '$argon2i$v=19$m=65536,t=4,p=1$Y1JBLzFCVDFLYXBSOUw5Tw$N/y7t/6hOdJ00rM/qerWzuE05cSuv1zRFuvBlJGNPNU', 0, NULL, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `t_application`
--

CREATE TABLE `t_application` (
  `application_id` varchar(8) NOT NULL COMMENT '申請番号(A0000001)',
  `student_id` varchar(255) NOT NULL COMMENT '申請者の学生番号(データ形式不明)',
  `application_time` timestamp(4) NOT NULL DEFAULT current_timestamp(4) COMMENT '申請時間',
  `borrowing_time` date NOT NULL COMMENT '貸出日時',
  `return_time` date NOT NULL COMMENT '返却日時',
  `application_remarks` varchar(255) NOT NULL COMMENT '備考欄',
  `application_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '申請状態(0:申請済み1:貸出中2:返却済み3:キャンセル)',
  `application_deletion_flag` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `t_application`
--

INSERT INTO `t_application` (`application_id`, `student_id`, `application_time`, `borrowing_time`, `return_time`, `application_remarks`, `application_status`, `application_deletion_flag`) VALUES
('A0000001', 'b7143', '2020-12-01 07:04:57.0211', '2020-12-15', '2020-12-15', '特になし', 0, 0),
('A0000002', 'b7143@oic.jp', '2021-01-21 20:42:01.4450', '2021-01-22', '2021-01-22', '', 3, 0),
('A0000003', 'b7143@oic.jp', '2021-01-21 20:42:50.4678', '2021-01-22', '2021-01-22', '', 3, 0),
('A0000004', 'b7143@oic.jp', '2021-01-21 22:16:04.7693', '2021-01-22', '2021-01-23', '', 3, 0),
('A0000005', 'b7143@oic.jp', '2021-01-21 22:23:46.5903', '2021-01-22', '2021-01-22', '', 3, 0),
('A0000006', 'b7143@oic.jp', '2021-01-21 22:26:47.1319', '2021-01-22', '2021-01-22', '', 3, 0),
('A0000007', 'b7143@oic.jp', '2021-01-21 22:33:08.3751', '2021-01-22', '2021-01-22', '', 3, 0),
('A0000008', 'b7143@oic.jp', '2021-01-21 22:33:58.6534', '2021-01-25', '2021-01-25', '', 3, 0),
('A0000009', 'shibaike.svaa134@gmail.com', '2021-01-21 22:35:47.4228', '2021-01-22', '2021-01-22', '', 2, 0),
('A0000010', 'b7143@oic.jp', '2021-01-21 22:36:58.0347', '2021-01-22', '2021-01-22', '', 3, 0),
('A0000011', 'b7143@oic.jp', '2021-01-22 04:58:52.8442', '2021-01-25', '2021-01-25', '', 3, 0),
('A0000012', 'b7143@oic.jp', '2021-01-22 04:59:32.8023', '2021-01-25', '2021-01-25', '', 3, 0),
('A0000013', 'b7143@oic.jp', '2021-01-22 05:15:29.2624', '2021-01-25', '2021-01-25', '', 0, 0),
('A0000014', 'b7143@oic.jp', '2021-01-22 05:16:39.9818', '2021-01-23', '2021-01-23', '', 0, 0),
('A0000015', 'b7143@oic.jp', '2021-01-22 05:17:16.8965', '2021-01-28', '2021-01-28', '', 3, 0),
('A0000016', 'b7143@oic.jp', '2021-01-22 06:02:14.1398', '2021-01-22', '2021-01-22', '', 2, 0),
('A0000017', 'b7143@oic.jp', '2021-01-22 06:49:40.8083', '2021-01-22', '2021-01-22', 'あ', 2, 0),
('A0000018', 'b7143@oic.jp', '2021-01-22 06:51:02.8245', '2021-01-22', '2021-01-22', 'い', 3, 0),
('A0000019', 'b7143@oic.jp', '2021-01-22 06:55:25.2996', '2021-01-22', '2021-01-22', '', 2, 0),
('A0000020', 'b7143@oic.jp', '2021-01-22 06:57:13.8647', '2021-01-22', '2021-01-22', '', 1, 0),
('A0000021', 'b7143@oic.jp', '2021-01-22 06:58:09.2346', '2021-01-28', '2021-01-28', '', 3, 0),
('A0000022', 'b7143@oic.jp', '2021-01-22 08:38:08.7870', '2021-01-30', '2021-01-30', '', 3, 0),
('A0000023', 'b7143@oic.jp', '2021-01-26 04:45:27.5959', '2021-01-27', '2021-01-27', '', 0, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `t_application_detail`
--

CREATE TABLE `t_application_detail` (
  `application_id` varchar(8) NOT NULL COMMENT '申請番号',
  `application_detail_id` varchar(10) NOT NULL COMMENT '申請明細番号(AD00000001)',
  `equipment_id` varchar(6) NOT NULL COMMENT '備品番号',
  `application_detail_deletion_flag` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `t_application_detail`
--

INSERT INTO `t_application_detail` (`application_id`, `application_detail_id`, `equipment_id`, `application_detail_deletion_flag`) VALUES
('A0000001', 'AD00000001', 'Q00001', 0),
('A0000001', 'AD00000002', 'Q00002', 0),
('A0000002', 'AD00000003', 'Q00001', 0),
('A0000003', 'AD00000004', 'Q00001', 0),
('A0000004', 'AD00000005', 'Q00003', 0),
('A0000005', 'AD00000006', 'Q00002', 0),
('A0000006', 'AD00000007', 'Q00002', 0),
('A0000007', 'AD00000008', 'Q00002', 0),
('A0000008', 'AD00000009', 'Q00003', 0),
('A0000009', 'AD00000010', 'Q00002', 0),
('A0000010', 'AD00000011', 'Q00002', 0),
('A0000011', 'AD00000012', 'Q00001', 0),
('A0000012', 'AD00000013', 'Q00002', 0),
('A0000013', 'AD00000014', 'Q00001', 0),
('A0000014', 'AD00000015', 'Q00003', 0),
('A0000015', 'AD00000016', 'Q00002', 0),
('A0000016', 'AD00000017', 'Q00001', 0),
('A0000017', 'AD00000018', 'Q00001', 0),
('A0000018', 'AD00000019', 'Q00001', 0),
('A0000019', 'AD00000020', 'Q00003', 0),
('A0000020', 'AD00000021', 'Q00001', 0),
('A0000021', 'AD00000022', 'Q00001', 0),
('A0000022', 'AD00000023', 'Q00001', 0),
('A0000023', 'AD00000024', 'Q00002', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `t_equipment`
--

CREATE TABLE `t_equipment` (
  `equipment_id` varchar(6) NOT NULL COMMENT '備品番号(Q00001)',
  `equipment_name` varchar(255) NOT NULL COMMENT '備品名称',
  `holding_quantity` text NOT NULL COMMENT '保持数量',
  `equipment_notes` text NOT NULL,
  `equipment_img` text NOT NULL,
  `equipment_deletion_flag` tinyint(1) NOT NULL DEFAULT 0 COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `t_equipment`
--

INSERT INTO `t_equipment` (`equipment_id`, `equipment_name`, `holding_quantity`, `equipment_notes`, `equipment_img`, `equipment_deletion_flag`) VALUES
('Q00001', 'ノートパソコン', '100', 'rtx3090搭載のゲーミングPCです。', './img/note_pc.jpg', 0),
('Q00002', 'タブレット', '50', 'ipad', './img/tablet.jpg', 0),
('Q00003', 'プリンタ', '1', 'brother インクジェットプリンター', './img/printer.jpg', 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `t_application`
--
ALTER TABLE `t_application`
  ADD PRIMARY KEY (`application_id`);

--
-- テーブルのインデックス `t_application_detail`
--
ALTER TABLE `t_application_detail`
  ADD PRIMARY KEY (`application_id`,`application_detail_id`),
  ADD KEY `application_id` (`application_id`),
  ADD KEY `application_detail_equipment_id_key` (`equipment_id`);

--
-- テーブルのインデックス `t_equipment`
--
ALTER TABLE `t_equipment`
  ADD PRIMARY KEY (`equipment_id`);

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `t_application_detail`
--
ALTER TABLE `t_application_detail`
  ADD CONSTRAINT `application_detail_application_id_key` FOREIGN KEY (`application_id`) REFERENCES `t_application` (`application_id`),
  ADD CONSTRAINT `application_detail_equipment_id_key` FOREIGN KEY (`equipment_id`) REFERENCES `t_equipment` (`equipment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
