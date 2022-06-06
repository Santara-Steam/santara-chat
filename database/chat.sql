-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 07, 2022 at 04:31 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `chat-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `archived_users`
--

CREATE TABLE `archived_users`
(
    `id`          bigint(20) UNSIGNED NOT NULL,
    `owner_id`    varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `owner_type`  varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `archived_by` int(10) UNSIGNED NOT NULL,
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocked_users`
--

CREATE TABLE `blocked_users`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `blocked_by` int(10) UNSIGNED NOT NULL,
    `blocked_to` int(10) UNSIGNED NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_request`
--

CREATE TABLE `chat_request`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `from_id`    int(10) UNSIGNED DEFAULT NULL,
    `owner_id`   varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `owner_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `status`     int(11) NOT NULL DEFAULT '0',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations`
(
    `id`           int(10) UNSIGNED NOT NULL,
    `from_id`      int(10) UNSIGNED DEFAULT NULL,
    `to_id`        varchar(191) COLLATE utf8mb4_unicode_ci          DEFAULT NULL,
    `to_type`      varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AppModelsConversation' COMMENT '1 => Message, 2 => Group Message',
    `message`      text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `status`       tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 for unread,1 for seen',
    `message_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0- text message, 1- image, 2- pdf, 3- doc, 4- voice',
    `file_name`    text COLLATE utf8mb4_unicode_ci,
    `created_at`   timestamp NULL DEFAULT NULL,
    `updated_at`   timestamp NULL DEFAULT NULL,
    `reply_to`     int(10) UNSIGNED DEFAULT NULL,
    `url_details`  text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `uuid`       varchar(191) COLLATE utf8mb4_unicode_ci      DEFAULT NULL,
    `connection` text COLLATE utf8mb4_unicode_ci     NOT NULL,
    `queue`      text COLLATE utf8mb4_unicode_ci     NOT NULL,
    `payload`    longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `exception`  longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `failed_at`  timestamp                           NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups`
(
    `id`          char(36) COLLATE utf8mb4_unicode_ci     NOT NULL,
    `name`        varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `photo_url`   varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `privacy`     int(11) NOT NULL,
    `group_type`  int(11) NOT NULL COMMENT '1 => Open (Anyone can send message), 2 => Close (Only Admin can send message) ',
    `created_by`  int(10) UNSIGNED NOT NULL,
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_message_recipients`
--

CREATE TABLE `group_message_recipients`
(
    `id`              bigint(20) UNSIGNED NOT NULL,
    `user_id`         int(10) UNSIGNED NOT NULL,
    `conversation_id` int(10) UNSIGNED NOT NULL,
    `group_id`        varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `read_at`         datetime DEFAULT NULL,
    `created_at`      timestamp NULL DEFAULT NULL,
    `updated_at`      timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE `group_users`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `group_id`   varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id`    int(10) UNSIGNED NOT NULL,
    `role`       int(11) NOT NULL DEFAULT '1',
    `added_by`   int(10) UNSIGNED NOT NULL,
    `removed_by` int(10) UNSIGNED DEFAULT NULL,
    `deleted_at` datetime DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `last_conversations`
--

CREATE TABLE `last_conversations`
(
    `id`              bigint(20) UNSIGNED NOT NULL,
    `group_id`        varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `conversation_id` int(10) UNSIGNED NOT NULL,
    `user_id`         int(10) UNSIGNED NOT NULL,
    `group_details`   text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `created_at`      timestamp NULL DEFAULT NULL,
    `updated_at`      timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message_action`
--

CREATE TABLE `message_action`
(
    `id`              bigint(20) UNSIGNED NOT NULL,
    `conversation_id` int(11) NOT NULL,
    `deleted_by`      int(11) NOT NULL,
    `created_at`      timestamp NULL DEFAULT NULL,
    `updated_at`      timestamp NULL DEFAULT NULL,
    `is_hard_delete`  tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations`
(
    `id`        int(10) UNSIGNED NOT NULL,
    `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch`     int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (1, '2014_10_12_000000_create_users_table', 1),
       (2, '2014_10_12_100000_create_password_resets_table', 1),
       (3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
       (4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
       (5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
       (6, '2016_06_01_000004_create_oauth_clients_table', 1),
       (7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
       (8, '2019_08_19_000000_create_failed_jobs_table', 1),
       (9, '2019_09_16_051035_create_conversations_table', 1),
       (10, '2019_11_12_104216_create_permission_tables', 1),
       (11, '2019_11_14_083512_add_is_default_in_roles_table', 1),
       (12, '2019_11_19_054306_create_message_action_table', 1),
       (13, '2019_12_03_095046_add_notifications_related_fields_to_users_table', 1),
       (14, '2019_12_07_103316_create_social_accounts_table', 1),
       (15, '2019_12_13_035642_create_blocked_users_table', 1),
       (16, '2019_12_19_052201_add_hard_delete_field_into_message_action_table', 1),
       (17, '2019_12_23_062919_create_groups_table', 1),
       (18, '2019_12_23_063618_create_group_users_table', 1),
       (19, '2019_12_23_063933_refactor_conversations_table_fields', 1),
       (20, '2019_12_24_090549_create_group_message_recipients', 1),
       (21, '2019_12_28_091028_create_last_conversations_table', 1),
       (22, '2020_02_21_121653_add_reply_id_into_conversations_table', 1),
       (23, '2020_03_25_113611_create_notifications_table', 1),
       (24, '2020_04_01_102138_add_new_field_in_conversations_table', 1),
       (25, '2020_04_02_075922_create_archived_users_table', 1),
       (26, '2020_04_14_054618_add_privacy_in_users_table', 1),
       (27, '2020_04_17_084626_add_gender_in_users_table', 1),
       (28, '2020_04_21_080910_make_url_details_field_nullable_in_conversations_table', 1),
       (29, '2020_04_24_054555_create_chat_request_table', 1),
       (30, '2020_04_24_091607_create_user_status_table', 1),
       (31, '2020_06_03_065505_create_reported_users_table', 1),
       (32, '2020_06_04_103406_create_settings_table', 1),
       (33, '2020_06_22_060630_add_deleted_at_in_users_table', 1),
       (34, '2020_06_24_040459_delete_conversation_of_deleted_users', 1),
       (35, '2020_06_25_091239_add_index_on_order_by_columns_in_users_table', 1),
       (36, '2020_06_25_094224_add_index_on_order_by_columns_in_reported_users_table', 1),
       (37, '2020_06_25_095142_add_index_on_order_by_columns_in_roles_table', 1),
       (38, '2020_06_25_100538_add_index_on_order_by_columns_in_conversations_table', 1),
       (39, '2020_06_25_101143_add_index_on_order_by_columns_in_notifications_table', 1),
       (40, '2020_06_25_101342_add_index_on_order_by_columns_in_groups_table', 1),
       (41, '2020_06_25_101618_add_index_on_order_by_columns_in_group_users_table', 1),
       (42, '2020_10_19_125524_create_user_devices_table', 1),
       (43, '2020_10_19_133700_move_all_existing_devices_to_new_table', 1),
       (44, '2020_12_18_072323_create_zoom_meeting', 1),
       (45, '2020_12_18_072614_meeting_candidates', 1),
       (46, '2020_12_21_130245_add_status_and_uuid_into_zoom_meetings_table', 1),
       (47, '2020_12_26_065943_add_time_zone_field_into_zoom_meetings_table', 1),
       (48, '2021_04_06_120151_add_language_field_in_users_table', 1),
       (49, '2021_06_24_073211_add_display_name_field_in_permission_table', 1),
       (50, '2021_07_12_000000_add_uuid_to_failed_jobs_table', 1),
       (51, '2022_03_02_120506_change_duration_field_type_in_zoom_meetings_table', 1),
       (52, '2022_03_04_085620_add_is_super_admin_field_in_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions`
(
    `permission_id` bigint(20) UNSIGNED NOT NULL,
    `model_type`    varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `model_id`      bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles`
(
    `role_id`    bigint(20) UNSIGNED NOT NULL,
    `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `model_id`   bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`)
VALUES (1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications`
(
    `id`           bigint(20) UNSIGNED NOT NULL,
    `owner_id`     varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `owner_type`   varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `notification` text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `to_id`        bigint(20) UNSIGNED NOT NULL,
    `is_read`      tinyint(1) NOT NULL DEFAULT '0',
    `read_at`      datetime DEFAULT NULL,
    `message_type` tinyint(4) NOT NULL DEFAULT '0',
    `file_name`    text COLLATE utf8mb4_unicode_ci,
    `deleted_at`   timestamp NULL DEFAULT NULL,
    `created_at`   timestamp NULL DEFAULT NULL,
    `updated_at`   timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens`
(
    `id`         varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id`    bigint(20) UNSIGNED DEFAULT NULL,
    `client_id`  bigint(20) UNSIGNED NOT NULL,
    `name`       varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `scopes`     text COLLATE utf8mb4_unicode_ci,
    `revoked`    tinyint(1) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `expires_at` datetime                                DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes`
(
    `id`         varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id`    bigint(20) UNSIGNED NOT NULL,
    `client_id`  bigint(20) UNSIGNED NOT NULL,
    `scopes`     text COLLATE utf8mb4_unicode_ci,
    `revoked`    tinyint(1) NOT NULL,
    `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients`
(
    `id`                     bigint(20) UNSIGNED NOT NULL,
    `user_id`                bigint(20) UNSIGNED DEFAULT NULL,
    `name`                   varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `secret`                 varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `provider`               varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `redirect`               text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `personal_access_client` tinyint(1) NOT NULL,
    `password_client`        tinyint(1) NOT NULL,
    `revoked`                tinyint(1) NOT NULL,
    `created_at`             timestamp NULL DEFAULT NULL,
    `updated_at`             timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `client_id`  bigint(20) UNSIGNED NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens`
(
    `id`              varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `revoked`         tinyint(1) NOT NULL,
    `expires_at`      datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets`
(
    `id`         int(10) UNSIGNED NOT NULL,
    `email`      varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token`      text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions`
(
    `id`           bigint(20) UNSIGNED NOT NULL,
    `name`         varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `guard_name`   varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at`   timestamp NULL DEFAULT NULL,
    `updated_at`   timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `display_name`, `created_at`, `updated_at`)
VALUES (1, 'manage_users', 'web', 'Manage Users', '2022-03-06 22:59:33', '2022-03-06 22:59:33'),
       (2, 'manage_roles', 'web', 'Manage Roles', '2022-03-06 22:59:33', '2022-03-06 22:59:33'),
       (3, 'manage_reported_users', 'web', 'Manage Reported Users', '2022-03-06 22:59:33', '2022-03-06 22:59:33'),
       (4, 'manage_conversations', 'web', 'Manage Conversations', '2022-03-06 22:59:33', '2022-03-06 22:59:33'),
       (5, 'manage_settings', 'web', 'Manage Settings', '2022-03-06 22:59:33', '2022-03-06 22:59:33'),
       (6, 'manage_meetings', 'web', 'Manage Meetings', '2022-03-06 22:59:33', '2022-03-06 22:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `reported_users`
--

CREATE TABLE `reported_users`
(
    `id`          bigint(20) UNSIGNED NOT NULL,
    `reported_by` int(10) UNSIGNED NOT NULL,
    `reported_to` int(10) UNSIGNED NOT NULL,
    `notes`       longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `name`       varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `is_default` tinyint(4) NOT NULL DEFAULT '0',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `is_default`, `created_at`, `updated_at`)
VALUES (1, 'Admin', 'web', 1, '2022-03-06 22:59:33', '2022-03-06 22:59:33'),
       (2, 'Member', 'web', 1, '2022-03-06 22:59:33', '2022-03-06 22:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions`
(
    `permission_id` bigint(20) UNSIGNED NOT NULL,
    `role_id`       bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
VALUES (1, 1),
       (2, 1),
       (3, 1),
       (4, 1),
       (5, 1),
       (6, 1),
       (4, 2),
       (6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `key`        varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `value`      varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`)
VALUES (1, 'pwa_icon', 'assets/images/logo-30x30.png', '2022-03-06 22:59:34', '2022-03-06 22:59:34');

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE `social_accounts`
(
    `id`          int(10) UNSIGNED NOT NULL,
    `user_id`     int(10) UNSIGNED NOT NULL,
    `provider`    varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`
(
    `id`                int(10) UNSIGNED NOT NULL,
    `name`              varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email`             varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password`          varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `phone`             varchar(191) COLLATE utf8mb4_unicode_ci          DEFAULT NULL,
    `last_seen`         timestamp NULL DEFAULT NULL,
    `is_online`         tinyint(4) DEFAULT '0',
    `is_active`         tinyint(4) DEFAULT '0',
    `about`             text COLLATE utf8mb4_unicode_ci,
    `photo_url`         varchar(191) COLLATE utf8mb4_unicode_ci          DEFAULT NULL,
    `activation_code`   varchar(191) COLLATE utf8mb4_unicode_ci          DEFAULT NULL,
    `remember_token`    varchar(100) COLLATE utf8mb4_unicode_ci          DEFAULT NULL,
    `created_at`        timestamp NULL DEFAULT NULL,
    `updated_at`        timestamp NULL DEFAULT NULL,
    `is_system`         tinyint(4) DEFAULT '0',
    `player_id`         varchar(191) COLLATE utf8mb4_unicode_ci          DEFAULT NULL COMMENT 'One signal user id',
    `is_subscribed`     tinyint(1) DEFAULT NULL,
    `privacy`           int(11) NOT NULL DEFAULT '1',
    `gender`            int(11) DEFAULT NULL,
    `deleted_at`        timestamp NULL DEFAULT NULL,
    `language`          varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
    `is_super_admin`    tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `last_seen`, `is_online`,
                     `is_active`, `about`, `photo_url`, `activation_code`, `remember_token`, `created_at`, `updated_at`,
                     `is_system`, `player_id`, `is_subscribed`, `privacy`, `gender`, `deleted_at`, `language`,
                     `is_super_admin`)
VALUES (1, 'Super Admin', 'admin@gmail.com', '2022-03-06 22:59:33',
        '$2y$10$kL3.5OXo30MT0zuwrlcZcO5CR3vxOWBoaQ/Cd7mE2mVxqByS5pjPe', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL,
        '2022-03-06 22:59:33', '2022-03-06 22:59:34', 1, NULL, NULL, 1, NULL, NULL, 'en', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_devices`
--

CREATE TABLE `user_devices`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `user_id`    int(10) UNSIGNED NOT NULL,
    `player_id`  varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status`
(
    `id`               bigint(20) UNSIGNED NOT NULL,
    `user_id`          int(10) UNSIGNED NOT NULL,
    `emoji`            varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `emoji_short_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `status`           varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at`       timestamp NULL DEFAULT NULL,
    `updated_at`       timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zoom_meetings`
--

CREATE TABLE `zoom_meetings`
(
    `id`                bigint(20) UNSIGNED NOT NULL,
    `topic`             varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `start_time`        datetime                                NOT NULL,
    `duration`          int(11) NOT NULL,
    `host_video`        tinyint(1) NOT NULL,
    `participant_video` tinyint(1) NOT NULL,
    `agenda`            text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `created_by`        int(10) UNSIGNED NOT NULL,
    `meta`              text COLLATE utf8mb4_unicode_ci,
    `created_at`        timestamp NULL DEFAULT NULL,
    `updated_at`        timestamp NULL DEFAULT NULL,
    `status`            int(11) NOT NULL DEFAULT '1',
    `meeting_id`        varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `time_zone`         varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `password`          varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zoom_meeting_candidates`
--

CREATE TABLE `zoom_meeting_candidates`
(
    `id`         bigint(20) UNSIGNED NOT NULL,
    `user_id`    int(10) UNSIGNED NOT NULL,
    `meeting_id` bigint(20) UNSIGNED NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archived_users`
--
ALTER TABLE `archived_users`
    ADD PRIMARY KEY (`id`),
  ADD KEY `archived_users_archived_by_foreign` (`archived_by`);

--
-- Indexes for table `blocked_users`
--
ALTER TABLE `blocked_users`
    ADD PRIMARY KEY (`id`),
  ADD KEY `blocked_users_blocked_by_foreign` (`blocked_by`),
  ADD KEY `blocked_users_blocked_to_foreign` (`blocked_to`);

--
-- Indexes for table `chat_request`
--
ALTER TABLE `chat_request`
    ADD PRIMARY KEY (`id`),
  ADD KEY `chat_request_from_id_foreign` (`from_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
    ADD PRIMARY KEY (`id`),
  ADD KEY `conversations_from_id_foreign` (`from_id`),
  ADD KEY `conversations_reply_to_foreign` (`reply_to`),
  ADD KEY `conversations_created_at_index` (`created_at`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
    ADD PRIMARY KEY (`id`),
  ADD KEY `groups_created_by_foreign` (`created_by`),
  ADD KEY `groups_name_index` (`name`);

--
-- Indexes for table `group_message_recipients`
--
ALTER TABLE `group_message_recipients`
    ADD PRIMARY KEY (`id`),
  ADD KEY `group_message_recipients_user_id_foreign` (`user_id`),
  ADD KEY `group_message_recipients_conversation_id_foreign` (`conversation_id`);

--
-- Indexes for table `group_users`
--
ALTER TABLE `group_users`
    ADD PRIMARY KEY (`id`),
  ADD KEY `group_users_group_id_foreign` (`group_id`),
  ADD KEY `group_users_user_id_foreign` (`user_id`),
  ADD KEY `group_users_removed_by_foreign` (`removed_by`),
  ADD KEY `group_users_added_by_foreign` (`added_by`),
  ADD KEY `group_users_role_index` (`role`);

--
-- Indexes for table `last_conversations`
--
ALTER TABLE `last_conversations`
    ADD PRIMARY KEY (`id`),
  ADD KEY `last_conversations_group_id_index` (`group_id`),
  ADD KEY `last_conversations_user_id_foreign` (`user_id`),
  ADD KEY `last_conversations_conversation_id_foreign` (`conversation_id`);

--
-- Indexes for table `message_action`
--
ALTER TABLE `message_action`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
    ADD PRIMARY KEY (`permission_id`, `model_id`, `model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
    ADD PRIMARY KEY (`role_id`, `model_id`, `model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
    ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_created_at_index` (`created_at`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
    ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
    ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
    ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
    ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
    ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reported_users`
--
ALTER TABLE `reported_users`
    ADD PRIMARY KEY (`id`),
  ADD KEY `reported_users_reported_by_foreign` (`reported_by`),
  ADD KEY `reported_users_reported_to_foreign` (`reported_to`),
  ADD KEY `reported_users_created_at_index` (`created_at`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
    ADD PRIMARY KEY (`id`),
  ADD KEY `roles_name_index` (`name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
    ADD PRIMARY KEY (`permission_id`, `role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_accounts`
--
ALTER TABLE `social_accounts`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `social_accounts_user_id_provider_provider_id_unique` (`user_id`,`provider`,`provider_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_player_id_unique` (`player_id`),
  ADD KEY `users_name_index` (`name`),
  ADD KEY `users_email_index` (`email`),
  ADD KEY `users_phone_index` (`phone`);

--
-- Indexes for table `user_devices`
--
ALTER TABLE `user_devices`
    ADD PRIMARY KEY (`id`),
  ADD KEY `user_devices_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zoom_meetings`
--
ALTER TABLE `zoom_meetings`
    ADD PRIMARY KEY (`id`),
  ADD KEY `zoom_meetings_created_by_foreign` (`created_by`);

--
-- Indexes for table `zoom_meeting_candidates`
--
ALTER TABLE `zoom_meeting_candidates`
    ADD PRIMARY KEY (`id`),
  ADD KEY `zoom_meeting_candidates_user_id_foreign` (`user_id`),
  ADD KEY `zoom_meeting_candidates_meeting_id_foreign` (`meeting_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archived_users`
--
ALTER TABLE `archived_users`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blocked_users`
--
ALTER TABLE `blocked_users`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_request`
--
ALTER TABLE `chat_request`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
    MODIFY `id` int (10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_message_recipients`
--
ALTER TABLE `group_message_recipients`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_users`
--
ALTER TABLE `group_users`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `last_conversations`
--
ALTER TABLE `last_conversations`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message_action`
--
ALTER TABLE `message_action`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
    MODIFY `id` int (10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
    MODIFY `id` int (10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reported_users`
--
ALTER TABLE `reported_users`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_accounts`
--
ALTER TABLE `social_accounts`
    MODIFY `id` int (10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int (10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_devices`
--
ALTER TABLE `user_devices`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zoom_meetings`
--
ALTER TABLE `zoom_meetings`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zoom_meeting_candidates`
--
ALTER TABLE `zoom_meeting_candidates`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archived_users`
--
ALTER TABLE `archived_users`
    ADD CONSTRAINT `archived_users_archived_by_foreign` FOREIGN KEY (`archived_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blocked_users`
--
ALTER TABLE `blocked_users`
    ADD CONSTRAINT `blocked_users_blocked_by_foreign` FOREIGN KEY (`blocked_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blocked_users_blocked_to_foreign` FOREIGN KEY (`blocked_to`) REFERENCES `users` (`id`) ON
DELETE
CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_request`
--
ALTER TABLE `chat_request`
    ADD CONSTRAINT `chat_request_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
    ADD CONSTRAINT `conversations_from_id_foreign` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversations_reply_to_foreign` FOREIGN KEY (`reply_to`) REFERENCES `conversations` (`id`) ON
DELETE
CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
    ADD CONSTRAINT `groups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_message_recipients`
--
ALTER TABLE `group_message_recipients`
    ADD CONSTRAINT `group_message_recipients_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_message_recipients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON
DELETE
CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_users`
--
ALTER TABLE `group_users`
    ADD CONSTRAINT `group_users_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_users_removed_by_foreign` FOREIGN KEY (`removed_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `last_conversations`
--
ALTER TABLE `last_conversations`
    ADD CONSTRAINT `last_conversations_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `last_conversations_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON
DELETE
CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `last_conversations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE
CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
    ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
    ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reported_users`
--
ALTER TABLE `reported_users`
    ADD CONSTRAINT `reported_users_reported_by_foreign` FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reported_users_reported_to_foreign` FOREIGN KEY (`reported_to`) REFERENCES `users` (`id`) ON
DELETE
CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
    ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON
DELETE
CASCADE;

--
-- Constraints for table `social_accounts`
--
ALTER TABLE `social_accounts`
    ADD CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_devices`
--
ALTER TABLE `user_devices`
    ADD CONSTRAINT `user_devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zoom_meetings`
--
ALTER TABLE `zoom_meetings`
    ADD CONSTRAINT `zoom_meetings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zoom_meeting_candidates`
--
ALTER TABLE `zoom_meeting_candidates`
    ADD CONSTRAINT `zoom_meeting_candidates_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `zoom_meetings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zoom_meeting_candidates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
