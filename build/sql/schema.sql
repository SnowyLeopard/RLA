
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(30) NOT NULL,
	`password` VARCHAR(60) NOT NULL,
	`salt` VARCHAR(60) NOT NULL,
	`level` TINYINT NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- achievements
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `achievements`;

CREATE TABLE `achievements`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`description` VARCHAR(255) NOT NULL,
	`points` TINYINT NOT NULL,
	`category_id` INTEGER NOT NULL,
	PRIMARY KEY (`id`,`category_id`),
	INDEX `achievements_FI_1` (`category_id`),
	CONSTRAINT `achievements_FK_1`
		FOREIGN KEY (`category_id`)
		REFERENCES `categories` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- groups
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`description` VARCHAR(255) NOT NULL,
	`category_id` INTEGER NOT NULL,
	`group_type` TINYINT NOT NULL,
	PRIMARY KEY (`id`,`category_id`),
	INDEX `groups_FI_1` (`category_id`),
	CONSTRAINT `groups_FK_1`
		FOREIGN KEY (`category_id`)
		REFERENCES `categories` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- categories
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`description` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- achievement_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `achievement_user`;

CREATE TABLE `achievement_user`
(
	`user_id` INTEGER NOT NULL,
	`achievement_id` INTEGER NOT NULL,
	`confirmed` TINYINT(1) NOT NULL,
	`date` DATETIME,
	PRIMARY KEY (`user_id`,`achievement_id`),
	INDEX `achievement_user_FI_2` (`achievement_id`),
	CONSTRAINT `achievement_user_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`id`),
	CONSTRAINT `achievement_user_FK_2`
		FOREIGN KEY (`achievement_id`)
		REFERENCES `achievements` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- achievement_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `achievement_group`;

CREATE TABLE `achievement_group`
(
	`achievement_id` INTEGER NOT NULL,
	`group_id` INTEGER NOT NULL,
	`weight` INTEGER NOT NULL,
	PRIMARY KEY (`achievement_id`,`group_id`),
	INDEX `achievement_group_FI_2` (`group_id`),
	CONSTRAINT `achievement_group_FK_1`
		FOREIGN KEY (`achievement_id`)
		REFERENCES `achievements` (`id`),
	CONSTRAINT `achievement_group_FK_2`
		FOREIGN KEY (`group_id`)
		REFERENCES `groups` (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
