ALTER TABLE `care_user_roles` CHANGE `permission` `permission` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `care_users` ADD `theme_name` VARCHAR(40) NOT NULL AFTER `create_time`;
