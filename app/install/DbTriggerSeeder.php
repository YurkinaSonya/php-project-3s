<?php

namespace app\install;

class DbTriggerSeeder
{
    public static function getQueries() : array
    {
        return [
            'comment_after_insert' =>
                "CREATE DEFINER=`root`@`%` TRIGGER `comment_after_insert` AFTER
               INSERT ON `comment` FOR EACH ROW BEGIN
   INSERT INTO comment_childs(comment_id, sub_comments) VALUES(NEW.id, 0);
   UPDATE comment_childs
   SET sub_comments = sub_comments + 1
   WHERE comment_id = NEW.parent_id;
   UPDATE post
   SET comments_count = comments_count + 1
   WHERE id = NEW.post_id;
END",
            'comment_after_update' =>
                "CREATE DEFINER=`root`@`%` TRIGGER `comment_after_update` BEFORE UPDATE ON `comment` FOR EACH ROW BEGIN
	DECLARE u_name VARCHAR(1000);
	if NEW.author_id != OLD.author_id then
		SELECT `full_name` INTO u_name
		FROM `user`
		WHERE id = NEW.author_id;
		
		set NEW.author = u_name;
	END if;
	
	If NEW.delete_time IS NOT NULL and old.delete_time is NULL then
		UPDATE comment_childs
		SET sub_comments = sub_comments - 1
		WHERE comment_id = NEW.parent_id;
		UPDATE post
	   SET comments_count = comments_count - 1
	   WHERE id = NEW.post_id;
	END if;
END",
            'comment_before_insert' =>
                "CREATE DEFINER=`root`@`%` TRIGGER `comment_before_insert` BEFORE INSERT ON `comment` FOR EACH ROW BEGIN
	DECLARE u_name VARCHAR(1000);
	SELECT full_name INTO u_name
	FROM `user`
	WHERE id = NEW.author_id;
	
	set NEW.author = u_name;
END",
            'community_after_update' =>
                "CREATE DEFINER=`root`@`%` TRIGGER `community_after_update` AFTER UPDATE ON `community` FOR EACH ROW BEGIN
	if NEW.`name` != OLD.`name` then
		UPDATE post
		SET community_name = NEW.`name`
		WHERE community_id = NEW.id;
	END if;
END",
            'like_after_insert' =>
                "CREATE DEFINER=`root`@`%` TRIGGER `like_after_insert` AFTER INSERT ON `like` FOR EACH ROW BEGIN
	DECLARE author_of_post CHAR(36);

	UPDATE post
	SET likes = likes + 1
	WHERE id = NEW.post_id;
	
	SELECT author_id INTO author_of_post
	FROM post
	WHERE id = NEW.post_id;
	
	
	UPDATE author
	SET likes = likes + 1
	WHERE user_id = author_of_post;
END",
            'like_after_update' =>
                "CREATE DEFINER=`root`@`%` TRIGGER `like_after_update` AFTER UPDATE ON `like` FOR EACH ROW BEGIN
	DECLARE author_of_post CHAR(36);
	IF NEW.delete_time IS NOT NULL and old.delete_time is NULL Then
		UPDATE post
		SET likes = likes - 1
   	WHERE id = NEW.post_id;
   	
   	SELECT author_id INTO author_of_post
		FROM post
		WHERE id = NEW.post_id;
		
		UPDATE author
		SET likes = likes - 1
		WHERE user_id = author_of_post;
    END IF;
END",
            'post_before_insert' =>
                "CREATE DEFINER=`root`@`%` TRIGGER `post_before_insert` BEFORE INSERT ON `post` FOR EACH ROW BEGIN
	DECLARE cmt_name, u_name VARCHAR(1000);
	
	SELECT full_name INTO u_name
	FROM `user`
	WHERE id = NEW.author_id;
	
	set NEW.author_name = u_name;
	
	UPDATE author
	SET posts = posts + 1
	WHERE user_id = NEW.author_id;
	
	if NEW.community_id IS NOT NULL then
		SELECT `name` INTO cmt_name
		FROM community
		WHERE id = NEW.community_id;
		
		set NEW.community_name = cmt_name;
	END if;
END",
            'post_before_update' =>
                "CREATE DEFINER=`root`@`%` TRIGGER `post_before_update` BEFORE UPDATE ON `post` FOR EACH ROW BEGIN
	DECLARE cmt_name, u_name VARCHAR(1000);
	if NEW.author_id != OLD.author_id then
		SELECT `full_name` INTO u_name
		FROM `user`
		WHERE id = NEW.author_id;
		
		set NEW.author_name = u_name;
		
		UPDATE author
		SET posts = posts - 1
		WHERE user_id = OLD.author_id;
		
		UPDATE author
		SET posts = posts + 1
		WHERE user_id = NEW.author_id;
	END if;
	
	if NEW.community_id IS NOT NULL AND NEW.community_id != OLD.community_id then
		SELECT `name` INTO cmt_name
		FROM community
		WHERE id = NEW.community_id;
		
		set NEW.community_name = cmt_name;
	END if;
END",
            'subscriber_after_insert' =>
                "CREATE DEFINER=`root`@`%` TRIGGER `subscriber_after_insert` AFTER INSERT ON `subscriber` FOR EACH ROW BEGIN
	UPDATE community
    SET subscribers_count = subscribers_count + 1
    WHERE id = NEW.community_id;
END",
            'subscriber_after_update' =>
                "CREATE DEFINER=`root`@`%` TRIGGER `subscriber_after_update` AFTER UPDATE ON `subscriber` FOR EACH ROW BEGIN
	IF NEW.unsubscribe_time IS NOT NULL and old.unsubscribe_time is NULL THEN
        UPDATE community
        SET subscribers_count = subscribers_count - 1
        WHERE id = NEW.community_id;
    END IF;
END",
            'user_after_insert' =>
                "CREATE DEFINER=`root`@`%` TRIGGER `user_after_insert` AFTER INSERT ON `user` FOR EACH ROW BEGIN
	INSERT INTO author(user_id, posts, likes) VALUES(NEW.id, 0, 0);
END",
            'user_after_update' =>
                "CREATE DEFINER=`root`@`%` TRIGGER `user_after_update` AFTER UPDATE ON `user` FOR EACH ROW BEGIN
	if NEW.`full_name` != OLD.`full_name` then
		UPDATE post
		SET author_name = NEW.`full_name`
		WHERE author_id = NEW.id;
	END if;
END"
        ];
    }

}