<?php

namespace app\install;

class DbTablesSeeder
{
    public static function getQueries() : array
    {
        return [
            'as_objs_tbl' =>
                "CREATE TABLE `as_objs_tbl` (
                    `obj_id` BIGINT(20) NOT NULL DEFAULT '0',
                    `guid` CHAR(36) NOT NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
                    `text` VARCHAR(500) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `text_search` VARCHAR(500) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `level` TINYINT(4) NULL DEFAULT NULL,
                    `parent_obj_id` BIGINT(20) NULL DEFAULT NULL,
                    `path` VARCHAR(500) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    PRIMARY KEY (`obj_id`) USING BTREE,
                    UNIQUE INDEX `objectguid` (`guid`) USING BTREE,
                    INDEX `parentobjid` (`parent_obj_id`) USING BTREE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB;",
            'user' =>
                "CREATE TABLE `user` (
                    `id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `email` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `password` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `create_time` DATETIME NOT NULL,
                    `full_name` VARCHAR(1000) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `gender` ENUM('Male','Female') NOT NULL COLLATE 'utf8mb4_general_ci',
                    `birth_date` DATETIME NULL DEFAULT NULL,
                    `phone_number` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    PRIMARY KEY (`id`) USING BTREE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB;",
            'user_token' =>
                "CREATE TABLE `user_token` (
                    `id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `user_id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `value` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `create_time` DATETIME NOT NULL,
                    `expire_time` DATETIME NOT NULL,
                    `logout_time` DATETIME NULL DEFAULT NULL,
                    PRIMARY KEY (`id`) USING BTREE,
                    UNIQUE INDEX `value` (`value`) USING BTREE,
                    INDEX `FK_user_tokens_user` (`user_id`) USING BTREE,
                    CONSTRAINT `FK_user_tokens_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB;",
            'community' =>
                "CREATE TABLE `community` (
                    `id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `create_time` DATETIME NOT NULL,
                    `name` VARCHAR(1000) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `description` VARCHAR(1000) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `is_closed` TINYINT(1) NOT NULL DEFAULT '0',
                    `subscribers_count` BIGINT(20) NOT NULL DEFAULT '0',
                    PRIMARY KEY (`id`) USING BTREE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB;",
            'tag' =>
                "CREATE TABLE `tag` (
                    `id` CHAR(36) NOT NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
                    `name` VARCHAR(200) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `create_time` DATETIME NOT NULL,
                    PRIMARY KEY (`id`) USING BTREE,
                    UNIQUE INDEX `name` (`name`) USING BTREE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB;",
            'post' =>
                "CREATE TABLE `post` (
                    `id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `create_time` DATETIME NOT NULL,
                    `title` VARCHAR(500) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `description` TEXT NOT NULL COLLATE 'utf8mb4_general_ci',
                    `reading_time` INT(11) NOT NULL,
                    `author_id` CHAR(36) NOT NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
                    `author_name` VARCHAR(1000) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `likes` INT(11) NOT NULL DEFAULT '0',
                    `comments_count` INT(11) NOT NULL DEFAULT '0',
                    `image` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `community_id` CHAR(36) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `community_name` VARCHAR(1000) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `address_id` CHAR(36) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    PRIMARY KEY (`id`) USING BTREE,
                    INDEX `FK_post_as_objs_tbl` (`address_id`) USING BTREE,
                    INDEX `FK_post_community` (`community_id`) USING BTREE,
                    INDEX `FK_post_user` (`author_id`) USING BTREE,
                    CONSTRAINT `FK_post_as_objs_tbl` FOREIGN KEY (`address_id`) REFERENCES `as_objs_tbl` (`guid`) ON UPDATE CASCADE ON DELETE SET NULL,
                    CONSTRAINT `FK_post_community` FOREIGN KEY (`community_id`) REFERENCES `community` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
                    CONSTRAINT `FK_post_user` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB;",
            'post_tags' =>
                "CREATE TABLE `post_tags` (
                    `post_id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `tag_id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    UNIQUE INDEX `post_id_tag_id` (`post_id`, `tag_id`) USING BTREE,
                    INDEX `FK_post_tags_tag` (`tag_id`) USING BTREE,
                    CONSTRAINT `FK_post_tags_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
                    CONSTRAINT `FK_post_tags_tag` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB;",
            'like' =>
                "CREATE TABLE `like` (
                    `id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `create_time` DATETIME NOT NULL,
                    `delete_time` DATETIME NULL DEFAULT NULL,
                    `user_id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `post_id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    PRIMARY KEY (`id`) USING BTREE,
                    INDEX `FK_like_user` (`user_id`) USING BTREE,
                    INDEX `FK_like_post` (`post_id`) USING BTREE,
                    CONSTRAINT `FK_like_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
                    CONSTRAINT `FK_like_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB;",
            'comment' =>
                "CREATE TABLE `comment` (
                    `id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `author_id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `author` VARCHAR(1000) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `post_id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `parent_id` CHAR(36) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
                    `content` TEXT NOT NULL COLLATE 'utf8mb4_general_ci',
                    `create_time` DATETIME NOT NULL,
                    `modification_time` DATETIME NULL DEFAULT NULL,
                    `delete_time` DATETIME NULL DEFAULT NULL,
                    PRIMARY KEY (`id`) USING BTREE,
                    INDEX `FK_comment_user` (`author_id`) USING BTREE,
                    INDEX `FK_comment_post` (`post_id`) USING BTREE,
                    INDEX `FK_comment_comment` (`parent_id`) USING BTREE,
                    CONSTRAINT `FK_comment_comment` FOREIGN KEY (`parent_id`) REFERENCES `comment` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
                    CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
                    CONSTRAINT `FK_comment_user` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB;",
            'comment_childs' =>
                "CREATE TABLE `comment_childs` (
                    `comment_id` CHAR(36) NOT NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
                    `sub_comments` INT(11) NOT NULL DEFAULT '0',
                    PRIMARY KEY (`comment_id`) USING BTREE,
                    CONSTRAINT `FK_comment_childs_comment` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB;",
            'subscriber' =>
                "CREATE TABLE `subscriber` (
                    `id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `user_id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `community_id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `subscribe_time` DATETIME NOT NULL,
                    `unsubscribe_time` DATETIME NULL DEFAULT NULL,
                    PRIMARY KEY (`id`) USING BTREE,
                    INDEX `FK_subscriber_user` (`user_id`) USING BTREE,
                    INDEX `FK_subscriber_community` (`community_id`) USING BTREE,
                    CONSTRAINT `FK_subscriber_community` FOREIGN KEY (`community_id`) REFERENCES `community` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
                    CONSTRAINT `FK_subscriber_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB;",
            'administrator' =>
                "CREATE TABLE `administrator` (
                `user_id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                `community_id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                UNIQUE INDEX `user_id_community_id` (`user_id`, `community_id`) USING BTREE,
                INDEX `FK_administrator_community` (`community_id`) USING BTREE,
                CONSTRAINT `FK_administrator_community` FOREIGN KEY (`community_id`) REFERENCES `community` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
                CONSTRAINT `FK_administrator_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB;",
            'author' =>
                "CREATE TABLE `author` (
                    `id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `user_id` CHAR(36) NOT NULL COLLATE 'utf8mb4_general_ci',
                    `posts` INT(11) NOT NULL DEFAULT '0',
                    `likes` INT(11) NOT NULL DEFAULT '0',
                    PRIMARY KEY (`id`) USING BTREE,
                    INDEX `FK_author_user` (`user_id`) USING BTREE,
                    CONSTRAINT `FK_author_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
                )
                COLLATE='utf8mb4_general_ci'
                ENGINE=InnoDB;"
            ];
    }

}