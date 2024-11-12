-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2024 at 03:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baileys_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `pkId` int(11) NOT NULL,
  `sessionId` varchar(128) NOT NULL,
  `archived` tinyint(1) DEFAULT NULL,
  `contactPrimaryIdentityKey` longblob DEFAULT NULL,
  `conversationTimestamp` bigint(20) DEFAULT NULL,
  `createdAt` bigint(20) DEFAULT NULL,
  `createdBy` varchar(128) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `disappearingMode` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`disappearingMode`)),
  `displayName` varchar(128) DEFAULT NULL,
  `endOfHistoryTransfer` tinyint(1) DEFAULT NULL,
  `endOfHistoryTransferType` int(11) DEFAULT NULL,
  `ephemeralExpiration` int(11) DEFAULT NULL,
  `ephemeralSettingTimestamp` bigint(20) DEFAULT NULL,
  `id` varchar(128) NOT NULL,
  `isDefaultSubgroup` tinyint(1) DEFAULT NULL,
  `isParentGroup` tinyint(1) DEFAULT NULL,
  `lastMsgTimestamp` bigint(20) DEFAULT NULL,
  `lidJid` varchar(128) DEFAULT NULL,
  `markedAsUnread` tinyint(1) DEFAULT NULL,
  `mediaVisibility` int(11) DEFAULT NULL,
  `messages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`messages`)),
  `muteEndTime` bigint(20) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `newJid` varchar(128) DEFAULT NULL,
  `notSpam` tinyint(1) DEFAULT NULL,
  `oldJid` varchar(128) DEFAULT NULL,
  `pHash` varchar(128) DEFAULT NULL,
  `parentGroupId` varchar(128) DEFAULT NULL,
  `participant` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`participant`)),
  `pinned` int(11) DEFAULT NULL,
  `pnJid` varchar(128) DEFAULT NULL,
  `pnhDuplicateLidThread` tinyint(1) DEFAULT NULL,
  `readOnly` tinyint(1) DEFAULT NULL,
  `shareOwnPn` tinyint(1) DEFAULT NULL,
  `support` tinyint(1) DEFAULT NULL,
  `suspended` tinyint(1) DEFAULT NULL,
  `tcToken` longblob DEFAULT NULL,
  `tcTokenSenderTimestamp` bigint(20) DEFAULT NULL,
  `tcTokenTimestamp` bigint(20) DEFAULT NULL,
  `terminated` tinyint(1) DEFAULT NULL,
  `unreadCount` int(11) DEFAULT NULL,
  `unreadMentionCount` int(11) DEFAULT NULL,
  `wallpaper` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`wallpaper`)),
  `lastMessageRecvTimestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`pkId`, `sessionId`, `archived`, `contactPrimaryIdentityKey`, `conversationTimestamp`, `createdAt`, `createdBy`, `description`, `disappearingMode`, `displayName`, `endOfHistoryTransfer`, `endOfHistoryTransferType`, `ephemeralExpiration`, `ephemeralSettingTimestamp`, `id`, `isDefaultSubgroup`, `isParentGroup`, `lastMsgTimestamp`, `lidJid`, `markedAsUnread`, `mediaVisibility`, `messages`, `muteEndTime`, `name`, `newJid`, `notSpam`, `oldJid`, `pHash`, `parentGroupId`, `participant`, `pinned`, `pnJid`, `pnhDuplicateLidThread`, `readOnly`, `shareOwnPn`, `support`, `suspended`, `tcToken`, `tcTokenSenderTimestamp`, `tcTokenTimestamp`, `terminated`, `unreadCount`, `unreadMentionCount`, `wallpaper`, `lastMessageRecvTimestamp`) VALUES
(4968, 'Juve5191', NULL, NULL, 1719910061, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '628819810368@s.whatsapp.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(6297, 'Juve519165698133', NULL, NULL, 1719911995, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '628819810368@s.whatsapp.net', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `pkId` int(11) NOT NULL,
  `sessionId` varchar(128) NOT NULL,
  `id` varchar(128) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `notify` varchar(128) DEFAULT NULL,
  `verifiedName` varchar(128) DEFAULT NULL,
  `imgUrl` varchar(255) DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groupmetadata`
--

CREATE TABLE `groupmetadata` (
  `pkId` int(11) NOT NULL,
  `sessionId` varchar(128) NOT NULL,
  `id` varchar(128) NOT NULL,
  `owner` varchar(128) DEFAULT NULL,
  `subject` varchar(128) NOT NULL,
  `subjectOwner` varchar(128) DEFAULT NULL,
  `subjectTime` int(11) DEFAULT NULL,
  `creation` int(11) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `descOwner` varchar(128) DEFAULT NULL,
  `descId` varchar(128) DEFAULT NULL,
  `restrict` tinyint(1) DEFAULT NULL,
  `announce` tinyint(1) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `participants` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`participants`)),
  `ephemeralDuration` int(11) DEFAULT NULL,
  `inviteCode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `pkId` int(11) NOT NULL,
  `sessionId` varchar(128) NOT NULL,
  `remoteJid` varchar(128) NOT NULL,
  `id` varchar(128) NOT NULL,
  `agentId` varchar(128) DEFAULT NULL,
  `bizPrivacyStatus` int(11) DEFAULT NULL,
  `broadcast` tinyint(1) DEFAULT NULL,
  `clearMedia` tinyint(1) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `ephemeralDuration` int(11) DEFAULT NULL,
  `ephemeralOffToOn` tinyint(1) DEFAULT NULL,
  `ephemeralOutOfSync` tinyint(1) DEFAULT NULL,
  `ephemeralStartTimestamp` bigint(20) DEFAULT NULL,
  `finalLiveLocation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`finalLiveLocation`)),
  `futureproofData` longblob DEFAULT NULL,
  `ignore` tinyint(1) DEFAULT NULL,
  `keepInChat` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`keepInChat`)),
  `key` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`key`)),
  `labels` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`labels`)),
  `mediaCiphertextSha256` longblob DEFAULT NULL,
  `mediaData` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`mediaData`)),
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`message`)),
  `messageC2STimestamp` bigint(20) DEFAULT NULL,
  `messageSecret` longblob DEFAULT NULL,
  `messageStubParameters` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`messageStubParameters`)),
  `messageStubType` int(11) DEFAULT NULL,
  `messageTimestamp` bigint(20) DEFAULT NULL,
  `multicast` tinyint(1) DEFAULT NULL,
  `originalSelfAuthorUserJidString` varchar(128) DEFAULT NULL,
  `participant` varchar(128) DEFAULT NULL,
  `paymentInfo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`paymentInfo`)),
  `photoChange` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photoChange`)),
  `pollAdditionalMetadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pollAdditionalMetadata`)),
  `pollUpdates` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pollUpdates`)),
  `pushName` varchar(128) DEFAULT NULL,
  `quotedPaymentInfo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`quotedPaymentInfo`)),
  `quotedStickerData` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`quotedStickerData`)),
  `reactions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`reactions`)),
  `revokeMessageTimestamp` bigint(20) DEFAULT NULL,
  `starred` tinyint(1) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `statusAlreadyViewed` tinyint(1) DEFAULT NULL,
  `statusPsa` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`statusPsa`)),
  `urlNumber` tinyint(1) DEFAULT NULL,
  `urlText` tinyint(1) DEFAULT NULL,
  `userReceipt` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`userReceipt`)),
  `verifiedBizName` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`pkId`, `sessionId`, `remoteJid`, `id`, `agentId`, `bizPrivacyStatus`, `broadcast`, `clearMedia`, `duration`, `ephemeralDuration`, `ephemeralOffToOn`, `ephemeralOutOfSync`, `ephemeralStartTimestamp`, `finalLiveLocation`, `futureproofData`, `ignore`, `keepInChat`, `key`, `labels`, `mediaCiphertextSha256`, `mediaData`, `message`, `messageC2STimestamp`, `messageSecret`, `messageStubParameters`, `messageStubType`, `messageTimestamp`, `multicast`, `originalSelfAuthorUserJidString`, `participant`, `paymentInfo`, `photoChange`, `pollAdditionalMetadata`, `pollUpdates`, `pushName`, `quotedPaymentInfo`, `quotedStickerData`, `reactions`, `revokeMessageTimestamp`, `starred`, `status`, `statusAlreadyViewed`, `statusPsa`, `urlNumber`, `urlText`, `userReceipt`, `verifiedBizName`) VALUES
(11403, 'Juve5191', '628819810368@s.whatsapp.net', '3AD26FDDC18D9470544D', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"remoteJid\":\"628819810368@s.whatsapp.net\",\"fromMe\":true,\"id\":\"3AD26FDDC18D9470544D\"}', NULL, NULL, NULL, '{\"protocolMessage\":{\"type\":\"HISTORY_SYNC_NOTIFICATION\",\"historySyncNotification\":{\"fileSha256\":\"q6UIf8n77ZX/F3DxBodtR/V6NshK4P9pFBzGWhnz0uQ=\",\"fileLength\":\"627493\",\"mediaKey\":\"MUM3eaVdCSBOgLn8Vi2Cf9JBOHFcOdOMPdjkzxYR2u8=\",\"fileEncSha256\":\"LYJBKXTMhxb+ZlLSIfDoLcbABieIBWg1VJpfDQq0Ohg=\",\"directPath\":\"/v/t62.31111-24/20126726_1203395797763011_7923831985971916179_n.enc?ccb=11-4&oh=01_Q5AaICLxuyvXjwvaO91pGSx3Hjf3zwC1mtIAOFN9rTg4yqL8&oe=66AB349B&_nc_sid=5e03e0\",\"syncType\":\"RECENT\",\"chunkOrder\":3}},\"messageContextInfo\":{\"deviceListMetadata\":{\"senderKeyHash\":\"OdT/eS9hjLZucA==\",\"senderTimestamp\":\"1719910040\"},\"deviceListMetadataVersion\":2}}', NULL, NULL, NULL, NULL, 1719910061, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(14399, 'Juve519165698133', '628819810368@s.whatsapp.net', '3A7DF3E471CF054ACCC3', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"remoteJid\":\"628819810368@s.whatsapp.net\",\"fromMe\":true,\"id\":\"3A7DF3E471CF054ACCC3\"}', NULL, NULL, NULL, '{\"protocolMessage\":{\"type\":\"HISTORY_SYNC_NOTIFICATION\",\"historySyncNotification\":{\"fileSha256\":\"XdHdfbjWQnsl/7YjHtTuDcWjZZh/3NqlCz+P51mx1LI=\",\"fileLength\":\"934950\",\"mediaKey\":\"E4wyf9Dvv+MHKcF1vPd+Tq8SSmipGX74kpAMHC2qx9U=\",\"fileEncSha256\":\"kQ28Jq1e8O6AED1ODfqmxQHxfv7F1YZTGxVStngQxro=\",\"directPath\":\"/v/t62.31111-24/35710859_2396625120534572_2338566327323100850_n.enc?ccb=11-4&oh=01_Q5AaIIe_aIobFyvFWnFr_vvukUDIbwAzCpe0l_RyUd09bYNC&oe=66AB511A&_nc_sid=5e03e0\",\"syncType\":\"RECENT\",\"chunkOrder\":1}},\"messageContextInfo\":{\"deviceListMetadata\":{\"senderKeyHash\":\"CAC4wTTE30czxw==\",\"senderTimestamp\":\"1719911982\"},\"deviceListMetadataVersion\":2}}', NULL, NULL, NULL, NULL, 1719911995, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(15150, 'Juve47893040743228925560344421953377325194702240939266737963407017585867649877695548135889507570184927', '628819810368@s.whatsapp.net', '3A45C0507F9884D3AE95', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"remoteJid\":\"628819810368@s.whatsapp.net\",\"fromMe\":true,\"id\":\"3A45C0507F9884D3AE95\"}', NULL, NULL, NULL, '{\"protocolMessage\":{\"type\":\"HISTORY_SYNC_NOTIFICATION\",\"historySyncNotification\":{\"fileSha256\":\"ld9keWNWQzXrneebrD86UQATaJgfyAKWzDVMKLfZ/do=\",\"fileLength\":\"523315\",\"mediaKey\":\"kHDPWJqdvREVDKViPlo8ftudBKyphOkg9BkjRIjiD1A=\",\"fileEncSha256\":\"Rkr7/i+7ePYkWTKoR6z+vX59GoCa7YcDrW1C/S7/rwQ=\",\"directPath\":\"/v/t62.31111-24/30277657_847139947268216_6605292580289878247_n.enc?ccb=11-4&oh=01_Q5AaIAjWa8AJQsjYvXGVjXQv5XMnZB9gfkOXs-Cm1j5w7MBP&oe=66AB2B49&_nc_sid=5e03e0\",\"syncType\":\"RECENT\",\"chunkOrder\":5}},\"messageContextInfo\":{\"deviceListMetadata\":{\"senderKeyHash\":\"Svb9B7XE3NjBYA==\",\"senderTimestamp\":\"1719912277\"},\"deviceListMetadataVersion\":2}}', NULL, NULL, NULL, NULL, 1719912305, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `pkId` int(11) NOT NULL,
  `sessionId` varchar(128) NOT NULL,
  `id` varchar(255) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`pkId`, `sessionId`, `id`, `data`) VALUES
(1729, 'Juve47893040743228925560344421953377325194702240939266737963407017585867649877695548135889507570184927', 'session-628819810368.0', '{\"_sessions\":{\"Bap1H1XM3ODROHH6wS90Yk1DWJcMg8eQSFkgqeVXDNQn\":{\"registrationId\":1031336126,\"currentRatchet\":{\"ephemeralKeyPair\":{\"pubKey\":\"BWyEt4AcYTl6a7k4pC6ISWpkW93zJfmHAMfuXbQ0SwYq\",\"privKey\":\"sIzZj1ZQOdtHAV9fISygphYB6MGgxCPsb+TSphdJeFU=\"},\"lastRemoteEphemeralKey\":\"Bbtb5dB4jencL8ivqsxj0klM8nJmurpd5Rtr/4+rmtUP\",\"previousCounter\":0,\"rootKey\":\"ZDLV3u5ffudz3nA7RJt3bSBIcY/QmOMjmzW8Ov+G6kQ=\"},\"indexInfo\":{\"baseKey\":\"Bap1H1XM3ODROHH6wS90Yk1DWJcMg8eQSFkgqeVXDNQn\",\"baseKeyType\":2,\"closed\":-1,\"used\":1719912281227,\"created\":1719912281227,\"remoteIdentityKey\":\"BRzwRmdh+TtW38atxD/CJhgLmcgZbfIJq0lZjmhR2kIE\"},\"_chains\":{\"Bbtb5dB4jencL8ivqsxj0klM8nJmurpd5Rtr/4+rmtUP\":{\"chainKey\":{\"counter\":15,\"key\":\"FTydfswihevMUFoGIhiuBujyQeBxFbpVfGcBLioeLBE=\"},\"chainType\":2,\"messageKeys\":{\"13\":\"qwMuqQ2+sgubjxWlaq+lqto3G0EVoP2UKFSMizBEJCg=\",\"14\":\"hYc39DUz9mll217PR7o1hpiubLdl/dmIWVD0t3RHxB8=\"}},\"BWyEt4AcYTl6a7k4pC6ISWpkW93zJfmHAMfuXbQ0SwYq\":{\"chainKey\":{\"counter\":-1,\"key\":\"9yYma6KjIhOtErBpqqMVUDmiMoNQtUk74/vAF8VhxmA=\"},\"chainType\":1,\"messageKeys\":{}}}}},\"version\":\"v1\"}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`pkId`),
  ADD UNIQUE KEY `unique_id_per_session_id` (`sessionId`,`id`),
  ADD KEY `Chat_sessionId_idx` (`sessionId`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`pkId`),
  ADD UNIQUE KEY `unique_id_per_session_id` (`sessionId`,`id`),
  ADD KEY `Contact_sessionId_idx` (`sessionId`);

--
-- Indexes for table `groupmetadata`
--
ALTER TABLE `groupmetadata`
  ADD PRIMARY KEY (`pkId`),
  ADD UNIQUE KEY `unique_id_per_session_id` (`sessionId`,`id`),
  ADD KEY `GroupMetadata_sessionId_idx` (`sessionId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`pkId`),
  ADD UNIQUE KEY `unique_message_key_per_session_id` (`sessionId`,`remoteJid`,`id`),
  ADD KEY `Message_sessionId_idx` (`sessionId`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`pkId`),
  ADD UNIQUE KEY `unique_id_per_session_id` (`sessionId`,`id`),
  ADD KEY `Session_sessionId_idx` (`sessionId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `pkId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8951;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `pkId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38478;

--
-- AUTO_INCREMENT for table `groupmetadata`
--
ALTER TABLE `groupmetadata`
  MODIFY `pkId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `pkId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20935;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `pkId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2958;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
