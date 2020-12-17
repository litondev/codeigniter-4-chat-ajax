-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 07:24 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci-chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE `channels` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `accepter_id` int(11) UNSIGNED NOT NULL,
  `time` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) UNSIGNED NOT NULL,
  `channel_id` int(11) UNSIGNED NOT NULL,
  `sender` enum('sender','accepter') NOT NULL,
  `message` text NOT NULL,
  `type` enum('text','image','file') NOT NULL DEFAULT 'text',
  `status` enum('active','nonactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-11-28-184224', 'App\\Database\\Migrations\\Users', 'default', 'App', 1607106038, 1),
(2, '2020-11-28-184228', 'App\\Database\\Migrations\\Settings', 'default', 'App', 1607106038, 1),
(3, '2020-11-28-184234', 'App\\Database\\Migrations\\Channels', 'default', 'App', 1607106039, 1),
(4, '2020-11-28-184238', 'App\\Database\\Migrations\\Chats', 'default', 'App', 1607106039, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Testing', '2020-12-04 12:21:06', '2020-12-04 12:21:06'),
(2, 'interval_channel', '1', '2020-12-04 12:21:06', '2020-12-04 12:21:06'),
(3, 'interval_chat', '1', '2020-12-04 12:21:06', '2020-12-04 12:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `photo` text NOT NULL DEFAULT 'default.png',
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `photo`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', '$2a$12$zhmH520Q5UdpEBxhLMw4lON6TKeRnI1IhJrwB.NJwj9J6rLViqCZO', 'default.png', 'admin', '2020-12-04 12:21:07', '2020-12-04 12:21:07'),
(2, 'user', 'user@user.com', '$2a$12$TpK6OZxP0mXjfItdfzdU/eXsWrs2kQ8vB4CI8bRExK2OlFftGWHJ2', 'default.png', 'user', '2020-12-04 12:21:07', '2020-12-04 12:21:07'),
(3, 'user0', 'user0@user.com', '$2a$12$xs/pDFpqixNpf3uq9ZG.4OiaZSkeccKFO5O1ZyTOz3Hha4yAW8exy', 'default.png', 'user', '2020-12-04 12:21:08', '2020-12-04 12:21:08'),
(4, 'user1', 'user1@user.com', '$2a$12$PhQd6DnywTlPD.qmOf6B8OQYrvxqD44tEDLSg2AUSf.obVDYc7jSO', 'default.png', 'user', '2020-12-04 12:21:09', '2020-12-04 12:21:09'),
(5, 'user2', 'user2@user.com', '$2a$12$2ngE/mzQ69JNOB4S6lefTOJRXzaZZnC9cdHRFWlw4RAlTZn4k/VwW', 'default.png', 'user', '2020-12-04 12:21:09', '2020-12-04 12:21:09'),
(6, 'user3', 'user3@user.com', '$2a$12$HQMK6KQmRCeQ2ZH9Q49lHe69VqehOOCXAtoll2KlLnvQNEQ4DOF8O', 'default.png', 'user', '2020-12-04 12:21:10', '2020-12-04 12:21:10'),
(7, 'user4', 'user4@user.com', '$2a$12$mQ/i8bHuMC4XeK1auKIGuOqSolME7qlyMM9Xa4tDtIm2oqzl8olYW', 'default.png', 'user', '2020-12-04 12:21:11', '2020-12-04 12:21:11'),
(8, 'user5', 'user5@user.com', '$2a$12$Y5GiqlGvfyif5a/et9q76O9T3o0vdxr.w404lBO2M5dAfM2NRgnJy', 'default.png', 'user', '2020-12-04 12:21:11', '2020-12-04 12:21:11'),
(9, 'user6', 'user6@user.com', '$2a$12$LAYDzK4t26ySl27GpdLm9uD/4FG8rGVW4wW5xm2iDxk0HGjQ5unIS', 'default.png', 'user', '2020-12-04 12:21:12', '2020-12-04 12:21:12'),
(10, 'user7', 'user7@user.com', '$2a$12$IHH2gxpX5e1UqyG4xYr0dOrEgjxCjkH3DsmVjpRJGaLaPSTdYqOPe', 'default.png', 'user', '2020-12-04 12:21:12', '2020-12-04 12:21:12'),
(11, 'user8', 'user8@user.com', '$2a$12$G9qajU3180FudkYhOb2PYuZZaM6EVa62Iw9.Wo.LVImKNy10Xo0Pe', 'default.png', 'user', '2020-12-04 12:21:13', '2020-12-04 12:21:13'),
(12, 'user9', 'user9@user.com', '$2a$12$2zW2C9ldb9SY0JwgS7G6Z.Gip31MScek6Ks.5Mw/SPlTYsx3y4xUG', 'default.png', 'user', '2020-12-04 12:21:13', '2020-12-04 12:21:13'),
(13, 'user10', 'user10@user.com', '$2a$12$S8pex.FTRTWUteoVj6Er4uhCO.2Fw0JRW5YnrOrCQRLj9/5ith3ny', 'default.png', 'user', '2020-12-04 12:21:14', '2020-12-04 12:21:14'),
(14, 'user11', 'user11@user.com', '$2a$12$KHifDYc4DQcWfr/8Z/JXAOas7dLYM1DOm6.EXZR6qq9S5kp4m.c52', 'default.png', 'user', '2020-12-04 12:21:15', '2020-12-04 12:21:15'),
(15, 'user12', 'user12@user.com', '$2a$12$SkfB8YutwS.htSnEBq3CR.Yu9qJLSsZKYGWH8xILD4Cn2D1Vhk60C', 'default.png', 'user', '2020-12-04 12:21:16', '2020-12-04 12:21:16'),
(16, 'user13', 'user13@user.com', '$2a$12$/6C.E7PKXj6AzK34nnqoaeiaq.LSZWmlWY9m7XBqjXNzpkt2j5/wq', 'default.png', 'user', '2020-12-04 12:21:16', '2020-12-04 12:21:16'),
(17, 'user14', 'user14@user.com', '$2a$12$8F.xQLQoeh9X.rUvHpjSD./8u3EeiNTqSYclRS9TxxKZyhTnyMphC', 'default.png', 'user', '2020-12-04 12:21:17', '2020-12-04 12:21:17'),
(18, 'user15', 'user15@user.com', '$2a$12$FsQHVQnpVWp6e87KBuXmf.fWF9HZm2Lr41Uq2CrmPXXlURQKWJlIO', 'default.png', 'user', '2020-12-04 12:21:17', '2020-12-04 12:21:17'),
(19, 'user16', 'user16@user.com', '$2a$12$LhiLP/pjx/Dfe5pmCBbFkeGh6oJVNQLe1zyAcXwes6N.9d1K9VsGy', 'default.png', 'user', '2020-12-04 12:21:18', '2020-12-04 12:21:18'),
(20, 'user17', 'user17@user.com', '$2a$12$xhGVuqn55Jnp3CmcMyFPpe0nhIZuZOwUv69pA8GAa7.EVvPHoqql.', 'default.png', 'user', '2020-12-04 12:21:18', '2020-12-04 12:21:18'),
(21, 'user18', 'user18@user.com', '$2a$12$l4unkmnksDN/rKGfjnEDDe9FdOHkUh1MRrkgUGiwPWpEM4.1VRf4G', 'default.png', 'user', '2020-12-04 12:21:19', '2020-12-04 12:21:19'),
(22, 'user19', 'user19@user.com', '$2a$12$GdFCVuKKpxppKX4pA1hUeejf2qRV8GOd46UchSFAKv0DzyRu14nyS', 'default.png', 'user', '2020-12-04 12:21:19', '2020-12-04 12:21:19'),
(23, 'user20', 'user20@user.com', '$2a$12$D4AVvxYc.fCH7E1byoMiz.Q2EcYty5m/Rpfj5ht3SIHaRoyl0BF6i', 'default.png', 'user', '2020-12-04 12:21:20', '2020-12-04 12:21:20'),
(24, 'user21', 'user21@user.com', '$2a$12$vnlRuM3FS.NCYuc/a7pXo.DQvasC.xPVBllrUzNUiLXRTbejTgj8e', 'default.png', 'user', '2020-12-04 12:21:21', '2020-12-04 12:21:21'),
(25, 'user22', 'user22@user.com', '$2a$12$J57pYoBXQWAX2lRCSClB/.sOTKGLvVDUOXAlMEoJkY/tKksIYfVZq', 'default.png', 'user', '2020-12-04 12:21:21', '2020-12-04 12:21:21'),
(26, 'user23', 'user23@user.com', '$2a$12$FW5Wml/sRvolNYoa2dFw5uQnaRUiYHqfMjbM0c8KS0K.ZRxqxt8P2', 'default.png', 'user', '2020-12-04 12:21:22', '2020-12-04 12:21:22'),
(27, 'user24', 'user24@user.com', '$2a$12$r/1MRTEPmhKWcjeDTcTIyOwVKEl4pAmZKLla2xtrKE/dsftzVi4/q', 'default.png', 'user', '2020-12-04 12:21:22', '2020-12-04 12:21:22'),
(28, 'user25', 'user25@user.com', '$2a$12$MOcgmdK6FtmqopygsbHABOYAk8996nWTmliKwOPRaD5mmCUfG.ZVC', 'default.png', 'user', '2020-12-04 12:21:23', '2020-12-04 12:21:23'),
(29, 'user26', 'user26@user.com', '$2a$12$UoJ72eYizC1vvzInMJ38DOrr89zd2C5M9g80R4n7WPV1Cad0AApRu', 'default.png', 'user', '2020-12-04 12:21:23', '2020-12-04 12:21:23'),
(30, 'user27', 'user27@user.com', '$2a$12$k5dRdIlPRub/.V1evj/VFuHD5/b9/EfkSzORJa5vnrl4/CkNedUNO', 'default.png', 'user', '2020-12-04 12:21:24', '2020-12-04 12:21:24'),
(31, 'user28', 'user28@user.com', '$2a$12$Kd7iTtVvCcmiyZz70I2CAect8uO90zRT1zqOOgXURNt8WnjSUimxa', 'default.png', 'user', '2020-12-04 12:21:25', '2020-12-04 12:21:25'),
(32, 'user29', 'user29@user.com', '$2a$12$cx9Si37X2x/oW9F5O6j4s.9jilrXZJLXbAdxZknznEkpvoHXEusTm', 'default.png', 'user', '2020-12-04 12:21:25', '2020-12-04 12:21:25'),
(33, 'user30', 'user30@user.com', '$2a$12$uTDcuwX0tsfappo6MGTxkOHJhUtzAkQmVtwL7Ug6G3Fnvk1w.BGgi', 'default.png', 'user', '2020-12-04 12:21:26', '2020-12-04 12:21:26'),
(34, 'user31', 'user31@user.com', '$2a$12$KJpMQpu0nQBThzYg6ZcYuebhs1CQ5xrgQCYAfY6WhNKO8vFzNpa2C', 'default.png', 'user', '2020-12-04 12:21:27', '2020-12-04 12:21:27'),
(35, 'user32', 'user32@user.com', '$2a$12$rbzUMa1fpyOrV.HigPJrvuiX2N7nlH0gq4is6ViRxjrZADaDqFXsS', 'default.png', 'user', '2020-12-04 12:21:28', '2020-12-04 12:21:28'),
(36, 'user33', 'user33@user.com', '$2a$12$NcgZH6LKDLsJn8ZfPAI5tei5JkZxUy6EvKV99CF2W8LgFDIDWC5rS', 'default.png', 'user', '2020-12-04 12:21:28', '2020-12-04 12:21:28'),
(37, 'user34', 'user34@user.com', '$2a$12$eRHjVaO8zSQ7uIyi/RjtTe9Wp9wNFW8AY28EhalXm7D150yyZC9MG', 'default.png', 'user', '2020-12-04 12:21:29', '2020-12-04 12:21:29'),
(38, 'user35', 'user35@user.com', '$2a$12$Iqx4zkxgXIvDLTbH27lKg.DbsooCIWS95mI2WXpdLpX1fJ5tfvUs6', 'default.png', 'user', '2020-12-04 12:21:30', '2020-12-04 12:21:30'),
(39, 'user36', 'user36@user.com', '$2a$12$wOhYUKBglRC5JYR81C7XdOnFBDYrxe.ScEcRIx.CfEvAF12yO5TlO', 'default.png', 'user', '2020-12-04 12:21:30', '2020-12-04 12:21:30'),
(40, 'user37', 'user37@user.com', '$2a$12$4VwZ548sEd9f54qiKYTnEedLMUikSs4n8G5HULJwkOZRZrOoXNCJ2', 'default.png', 'user', '2020-12-04 12:21:31', '2020-12-04 12:21:31'),
(41, 'user38', 'user38@user.com', '$2a$12$Nig8WQYqUMbJKayToLHyWuDaErPpX12IP6uW9qZkJwv7w5AoyAVqW', 'default.png', 'user', '2020-12-04 12:21:31', '2020-12-04 12:21:31'),
(42, 'user39', 'user39@user.com', '$2a$12$FmktWo1QegEiiVOCXUli/OmtJlykSpwb6FW7qdRg3z1CMD8ojQw.y', 'default.png', 'user', '2020-12-04 12:21:32', '2020-12-04 12:21:32'),
(43, 'user40', 'user40@user.com', '$2a$12$h5p0VC5siq.256N6zlWtgOXLrzhnC7Gfp5..YkwsOi1WT8DNMfJeO', 'default.png', 'user', '2020-12-04 12:21:32', '2020-12-04 12:21:32'),
(44, 'user41', 'user41@user.com', '$2a$12$w.ycRo90wP29cJD31A1e2uWjUl22kikJyyknKpLwasclydTanXYQ2', 'default.png', 'user', '2020-12-04 12:21:33', '2020-12-04 12:21:33'),
(45, 'user42', 'user42@user.com', '$2a$12$NBTuGkrJVTE9BriocNlKduGtswd4TJ5DHRafrDeiXW5pD8DQiBS46', 'default.png', 'user', '2020-12-04 12:21:33', '2020-12-04 12:21:33'),
(46, 'user43', 'user43@user.com', '$2a$12$hQ6NDpWh5AWEow9LjTQTV.UXZsnzzSlYbLfDrhQqy8a0RaV4/CRju', 'default.png', 'user', '2020-12-04 12:21:34', '2020-12-04 12:21:34'),
(47, 'user44', 'user44@user.com', '$2a$12$RZKP..IoTKDwGMk/DYgFS.yBf13mSK5MgMb0o.sgJ2jGtTNB3gtCq', 'default.png', 'user', '2020-12-04 12:21:34', '2020-12-04 12:21:34'),
(48, 'user45', 'user45@user.com', '$2a$12$RkjM01l6cgo0Q0L2Cp1qq.iRDvvt9gtqXY421lon6dWhyvhghgN8W', 'default.png', 'user', '2020-12-04 12:21:35', '2020-12-04 12:21:35'),
(49, 'user46', 'user46@user.com', '$2a$12$BH.naG1ejEbiUeCV6YTyy.EHYkS2viHhbyUy7TUUZJ1pb7wzawrlm', 'default.png', 'user', '2020-12-04 12:21:35', '2020-12-04 12:21:35'),
(50, 'user47', 'user47@user.com', '$2a$12$moYSnTFAlyTte0AmoXVHj.dlDL3bMioGNEICjTO9IWoG1MyfeD236', 'default.png', 'user', '2020-12-04 12:21:36', '2020-12-04 12:21:36'),
(51, 'user48', 'user48@user.com', '$2a$12$mVU9XD6FdOs.5VhIvukjJOtbVG5czIGBFrn/SmdNxyTINrw.iRW9S', 'default.png', 'user', '2020-12-04 12:21:37', '2020-12-04 12:21:37'),
(52, 'user49', 'user49@user.com', '$2a$12$mc98X9p4LgALfJc4kWViBeb6xTV6bhaaOA1a6428yQ2BwNHTjN8ka', 'default.png', 'user', '2020-12-04 12:21:38', '2020-12-04 12:21:38'),
(53, 'user50', 'user50@user.com', '$2a$12$Owns7VdLiBWIoC9tFopxjOQZWtL.A.1r12PFqaXSJnLCibUbKUBie', 'default.png', 'user', '2020-12-04 12:21:38', '2020-12-04 12:21:38'),
(54, 'user51', 'user51@user.com', '$2a$12$/MqEB3oj7GlgUNbjdjm/LeOn14kwzxHwrLlaOcBWW31A0PtyH.P/6', 'default.png', 'user', '2020-12-04 12:21:39', '2020-12-04 12:21:39'),
(55, 'user52', 'user52@user.com', '$2a$12$pjkdaTZu.3I4BDhhwdPbfu5zDlmEuVYKSF0OCjR373PS9B7PLnCz.', 'default.png', 'user', '2020-12-04 12:21:39', '2020-12-04 12:21:39'),
(56, 'user53', 'user53@user.com', '$2a$12$wfArJPbwgrbIoVe.YIV.1.hgR1.zVJvTLmtCIqFjgKbWRhVWznDpq', 'default.png', 'user', '2020-12-04 12:21:40', '2020-12-04 12:21:40'),
(57, 'user54', 'user54@user.com', '$2a$12$S.WxT6lgwy9V2BAKjo0AwOFOUP6SGZGQspnLT71Thd1NQcspwSt22', 'default.png', 'user', '2020-12-04 12:21:40', '2020-12-04 12:21:40'),
(58, 'user55', 'user55@user.com', '$2a$12$aJ4NJ7UJLIvnuZussji4ju2MdXUDNn1fiF4N9WFLozBc4SLvD.kD.', 'default.png', 'user', '2020-12-04 12:21:41', '2020-12-04 12:21:41'),
(59, 'user56', 'user56@user.com', '$2a$12$Fsa559dkO5qmWE7a.XHyauGBb6s.XfJsHHwqeq3XgV3URZJ.EJ5s.', 'default.png', 'user', '2020-12-04 12:21:41', '2020-12-04 12:21:41'),
(60, 'user57', 'user57@user.com', '$2a$12$2MqnXFwymuUKfJh6HPP4M.A0UL3Qy8.2moyVSQxfSCMKS55jFyqre', 'default.png', 'user', '2020-12-04 12:21:42', '2020-12-04 12:21:42'),
(61, 'user58', 'user58@user.com', '$2a$12$SDmWVX3PywpyN.d.vhsbJ.Fq6NSU7PCnkkz1S9vcNDE00LnN8h5Ie', 'default.png', 'user', '2020-12-04 12:21:42', '2020-12-04 12:21:42'),
(62, 'user59', 'user59@user.com', '$2a$12$kfIn.2Mem3zeqQuA8L.TNOkfZCz.OfWjjrGu9kadtisp1QgRclS2O', 'default.png', 'user', '2020-12-04 12:21:43', '2020-12-04 12:21:43'),
(63, 'user60', 'user60@user.com', '$2a$12$jWemEjOLsIuXGlDF0H1jpepzpVPVFC5jg1F4ztrdEGIlwmw09AJsy', 'default.png', 'user', '2020-12-04 12:21:43', '2020-12-04 12:21:43'),
(64, 'user61', 'user61@user.com', '$2a$12$TXR.zNqPYZjvzaWa9EdRquKseXLLWP4hdtaxFzQ.Hx3gesl9W/Eou', 'default.png', 'user', '2020-12-04 12:21:44', '2020-12-04 12:21:44'),
(65, 'user62', 'user62@user.com', '$2a$12$ycsrMHzHRJRuAdaygfwkwehVeqvecEAAEor5xR0RREh0hMomfvDA2', 'default.png', 'user', '2020-12-04 12:21:44', '2020-12-04 12:21:44'),
(66, 'user63', 'user63@user.com', '$2a$12$x00GELcguLkeW.QM99IbveqD.dz11xfTKB9RTLPoMKqBkMqoLlBAW', 'default.png', 'user', '2020-12-04 12:21:45', '2020-12-04 12:21:45'),
(67, 'user64', 'user64@user.com', '$2a$12$aDSFomKgr6g/siitnTylW.NZPujHDYrB7eBmmM.3.7DoFhJQBn.X6', 'default.png', 'user', '2020-12-04 12:21:45', '2020-12-04 12:21:45'),
(68, 'user65', 'user65@user.com', '$2a$12$5CjGObEUT275x45i8sEjNOU9/uVa8Ar41KATzXEmkOymV9sFSkFZW', 'default.png', 'user', '2020-12-04 12:21:46', '2020-12-04 12:21:46'),
(69, 'user66', 'user66@user.com', '$2a$12$xQ0lv64x3wWeB2OP5E7B/eSGrWL3fod7mPy24dQk3Lhjn9FlS7gvG', 'default.png', 'user', '2020-12-04 12:21:46', '2020-12-04 12:21:46'),
(70, 'user67', 'user67@user.com', '$2a$12$IqxDCqhsaRuRGD.Xp9shbOeqrRLKaZOs7OcycS3jMPpr51rRxiAjq', 'default.png', 'user', '2020-12-04 12:21:47', '2020-12-04 12:21:47'),
(71, 'user68', 'user68@user.com', '$2a$12$jehC7Q4xx4snGbxXT8JWeuShZ.q3fjH9a971DykDBcets8PnqpSIG', 'default.png', 'user', '2020-12-04 12:21:47', '2020-12-04 12:21:47'),
(72, 'user69', 'user69@user.com', '$2a$12$5YnJD.PrC2TfYgn89qf1A.mZLMmNcMe/vnFr87ZTjmotOQ5avMkCK', 'default.png', 'user', '2020-12-04 12:21:48', '2020-12-04 12:21:48'),
(73, 'user70', 'user70@user.com', '$2a$12$.BiwdT9Vg171fq1//21Df.W2mcC8x4P2YpKtOFGw5CHWohCTlbyTe', 'default.png', 'user', '2020-12-04 12:21:49', '2020-12-04 12:21:49'),
(74, 'user71', 'user71@user.com', '$2a$12$9AoUST8ovA2r9HwScdj8ZO8gGOXdVcfr8rnUE2ZHfQWOSy0ec1qCm', 'default.png', 'user', '2020-12-04 12:21:50', '2020-12-04 12:21:50'),
(75, 'user72', 'user72@user.com', '$2a$12$ypdDyvyac4oET/RbZw561uk1AbYp3zyts/td1goXMVV/023qN2jfC', 'default.png', 'user', '2020-12-04 12:21:50', '2020-12-04 12:21:50'),
(76, 'user73', 'user73@user.com', '$2a$12$XtxIzOm6d0HMUHA8dVEJru9gNTxRHAVBdw.XbmHjYgxFS9jvrJ6oe', 'default.png', 'user', '2020-12-04 12:21:51', '2020-12-04 12:21:51'),
(77, 'user74', 'user74@user.com', '$2a$12$c1sMgTeYg6Un8EUNQcXJmuhrYA0gwizQxEgbeHlKuVq.pA3DgPnEC', 'default.png', 'user', '2020-12-04 12:21:52', '2020-12-04 12:21:52'),
(78, 'user75', 'user75@user.com', '$2a$12$b7lhsUV5/A9JuJ.RRl9YN.wnKBT6i5s1XnIeWO6bFrFmiD2ArHSX2', 'default.png', 'user', '2020-12-04 12:21:52', '2020-12-04 12:21:52'),
(79, 'user76', 'user76@user.com', '$2a$12$8B7eLr3q.4LU9SGux6MFQO0iwtAH7V9GevlgALbOIiSqJuTIMP81y', 'default.png', 'user', '2020-12-04 12:21:53', '2020-12-04 12:21:53'),
(80, 'user77', 'user77@user.com', '$2a$12$T8lgPt9sGn04u6W4uuDvWOsR5bEVlbqJm.p/i/y0aXGyStLBdiVFm', 'default.png', 'user', '2020-12-04 12:21:53', '2020-12-04 12:21:53'),
(81, 'user78', 'user78@user.com', '$2a$12$51NEhBEopBdhSIYpeNRHZOFODwRJlmhAeLs1cK.5ymk0I/D2NQD.C', 'default.png', 'user', '2020-12-04 12:21:54', '2020-12-04 12:21:54'),
(82, 'user79', 'user79@user.com', '$2a$12$pxaH7n5gQFw4wOMGaWOpcuKrFsAzu3ys7y/O1jaR6sMzeuZrg879e', 'default.png', 'user', '2020-12-04 12:21:54', '2020-12-04 12:21:54'),
(83, 'user80', 'user80@user.com', '$2a$12$NKdIG7OnzQ9CG4N2i9/jTOYAPdhX3KomtIvE.6IXiIYr..EXng8PG', 'default.png', 'user', '2020-12-04 12:21:55', '2020-12-04 12:21:55'),
(84, 'user81', 'user81@user.com', '$2a$12$hstvX7duXDrhND.QrwSVIOEbWcTBPH0HPRt1Qn7Vapv1JCFOYhRBG', 'default.png', 'user', '2020-12-04 12:21:56', '2020-12-04 12:21:56'),
(85, 'user82', 'user82@user.com', '$2a$12$hAYsabukH8SZ2kpHDMyD0OiTmIKGCfnmAMW2oeiTSx8r0UWDeDeq2', 'default.png', 'user', '2020-12-04 12:21:56', '2020-12-04 12:21:56'),
(86, 'user83', 'user83@user.com', '$2a$12$wfCoQCB0HmJsfU.uY0VCp.7Iaj3lS/oJwipxhhq0cNTkC0GVYrTJC', 'default.png', 'user', '2020-12-04 12:21:57', '2020-12-04 12:21:57'),
(87, 'user84', 'user84@user.com', '$2a$12$jlybJPv1PC4zod5wnR6q7.UcB.QAZZX16v2G/AS9sia8vsnDDfy0a', 'default.png', 'user', '2020-12-04 12:21:57', '2020-12-04 12:21:57'),
(88, 'user85', 'user85@user.com', '$2a$12$d70OZK7h7hsxwgc9v3UTsOiABMGUGoLK2ehRLe6cgab7ECEsRQO1a', 'default.png', 'user', '2020-12-04 12:21:58', '2020-12-04 12:21:58'),
(89, 'user86', 'user86@user.com', '$2a$12$GDqPe9xOG8SNBzO8N082M.W2741pk8GdYpwoX6lBFFD3XxFSg7NUS', 'default.png', 'user', '2020-12-04 12:21:58', '2020-12-04 12:21:58'),
(90, 'user87', 'user87@user.com', '$2a$12$UeR7IiZVosqW7NDw2DaOi.pDjZRbcfRJo4TAW658gs6pR7BpkAWdG', 'default.png', 'user', '2020-12-04 12:21:59', '2020-12-04 12:21:59'),
(91, 'user88', 'user88@user.com', '$2a$12$yvpeVWc.tP4.kXiZBNEHaevYLHqBsf.rdR3oq3ITI/WpBJi.9vqCi', 'default.png', 'user', '2020-12-04 12:22:00', '2020-12-04 12:22:00'),
(92, 'user89', 'user89@user.com', '$2a$12$dxYQ6UflisDGvRBwyduU8.jqGJBBasQeNWzNc7Z9/JvhroM9ObyeW', 'default.png', 'user', '2020-12-04 12:22:00', '2020-12-04 12:22:00'),
(93, 'user90', 'user90@user.com', '$2a$12$/cREZpyz5s2qUFgB3v83ze2w1ZXRGKuPJk.OhqZWQQZQTXICH0w1.', 'default.png', 'user', '2020-12-04 12:22:01', '2020-12-04 12:22:01'),
(94, 'user91', 'user91@user.com', '$2a$12$.uKC3mdEf8O6jKRxBMGTlO49OvCDF4K1CpA2U27npV6XSic2Gg9h2', 'default.png', 'user', '2020-12-04 12:22:02', '2020-12-04 12:22:02'),
(95, 'user92', 'user92@user.com', '$2a$12$2bgkaTlmj4/8D0yT8ngzBeYA3sq4vExvqpGyeWH2A2DIEXhcyZAJG', 'default.png', 'user', '2020-12-04 12:22:02', '2020-12-04 12:22:02'),
(96, 'user93', 'user93@user.com', '$2a$12$y0/VqcBde5rM.L8.AT2Jwe2WXuTKfvh1MFH4/NfYQg1lOCUJgBk8u', 'default.png', 'user', '2020-12-04 12:22:03', '2020-12-04 12:22:03'),
(97, 'user94', 'user94@user.com', '$2a$12$f8HUllqsP6w1HUjFqxhINOKtnFplyjp3iK1AozBrv9nR7utslhe1.', 'default.png', 'user', '2020-12-04 12:22:04', '2020-12-04 12:22:04'),
(98, 'user95', 'user95@user.com', '$2a$12$ONXoETTOy3ZA7kdWWySQbu3c2MH2v1mMJpOe5EJP7SEdWWGpK.tRu', 'default.png', 'user', '2020-12-04 12:22:04', '2020-12-04 12:22:04'),
(99, 'user96', 'user96@user.com', '$2a$12$UHF3b26bl3MULxCpJu/SGuuuZLdkOD3xa1tadqcpq7hHg8SqvKdCO', 'default.png', 'user', '2020-12-04 12:22:05', '2020-12-04 12:22:05'),
(100, 'user97', 'user97@user.com', '$2a$12$1mFqyVClM/PBYsePwhdo8.nt13D9.0Mehh8Ca2WeRTe.fq37cvcIi', 'default.png', 'user', '2020-12-04 12:22:06', '2020-12-04 12:22:06'),
(101, 'user98', 'user98@user.com', '$2a$12$BcQA3v4I/9o9K9zIFl06OeDvHHPhmyu/jRLutMOop9XENjHKVQS4.', 'default.png', 'user', '2020-12-04 12:22:06', '2020-12-04 12:22:06'),
(102, 'user99', 'user99@user.com', '$2a$12$KjhfJOBU4smLTuRER0C2Xeiq7rbsacmbxtD2hukzAvjMIJ4pJj7MW', 'default.png', 'user', '2020-12-04 12:22:07', '2020-12-04 12:22:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channels_sender_id_foreign` (`sender_id`),
  ADD KEY `channels_accepter_id_foreign` (`accepter_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_channel_id_foreign` (`channel_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `channels`
--
ALTER TABLE `channels`
  ADD CONSTRAINT `channels_accepter_id_foreign` FOREIGN KEY (`accepter_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `channels_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
