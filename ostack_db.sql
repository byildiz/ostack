-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Anamakine: localhost
-- Üretim Zamanı: 14 Mart 2012 saat 16:38:18
-- Sunucu sürümü: 5.0.51
-- PHP Sürümü: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Veritabanı: `qas`
-- 

-- --------------------------------------------------------

-- 
-- Tablo yapısı: `answers`
-- 

CREATE TABLE `answers` (
  `aid` int(11) NOT NULL auto_increment,
  `text` text,
  `created` datetime default NULL,
  `user_id` int(11) default NULL,
  `question_id` int(11) default NULL,
  `best` tinyint(4) default NULL,
  PRIMARY KEY  (`aid`),
  KEY `a_user_id` (`user_id`),
  KEY `a_question_id` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Tablo döküm verisi `answers`
-- 

INSERT INTO `answers` VALUES (1, 'Örnek soru 1''e cevap1', '2012-03-14 16:35:01', 1, 1, 1);
INSERT INTO `answers` VALUES (2, 'Örnek soru 1''e cevap 2', '2012-03-14 16:35:25', 2, 1, 0);

-- --------------------------------------------------------

-- 
-- Tablo yapısı: `answer_vote`
-- 

CREATE TABLE `answer_vote` (
  `answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `value` tinyint(4) default NULL,
  PRIMARY KEY  (`answer_id`,`user_id`),
  KEY `av_user_id` (`user_id`),
  KEY `av_answer_id` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Tablo döküm verisi `answer_vote`
-- 

INSERT INTO `answer_vote` VALUES (1, 1, 1);
INSERT INTO `answer_vote` VALUES (1, 2, 1);

-- --------------------------------------------------------

-- 
-- Tablo yapısı: `comments`
-- 

CREATE TABLE `comments` (
  `cid` int(11) NOT NULL auto_increment,
  `text` text,
  `created` datetime default NULL,
  `user_id` int(11) default NULL,
  PRIMARY KEY  (`cid`),
  KEY `c_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Tablo döküm verisi `comments`
-- 

INSERT INTO `comments` VALUES (1, 'Örnek yorum 1', '2012-03-14 16:37:02', 1);
INSERT INTO `comments` VALUES (2, 'Örnek yorum 2', '2012-03-14 16:37:13', 2);

-- --------------------------------------------------------

-- 
-- Tablo yapısı: `comment_answer`
-- 

CREATE TABLE `comment_answer` (
  `caid` int(11) NOT NULL,
  `answer_id` int(11) default NULL,
  PRIMARY KEY  (`caid`),
  KEY `ca_comment_id` (`caid`),
  KEY `ca_answer_id` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Tablo döküm verisi `comment_answer`
-- 

INSERT INTO `comment_answer` VALUES (1, 1);
INSERT INTO `comment_answer` VALUES (2, 1);

-- --------------------------------------------------------

-- 
-- Tablo yapısı: `comment_comment`
-- 

CREATE TABLE `comment_comment` (
  `ccid` int(11) NOT NULL,
  `commented_id` int(11) default NULL,
  PRIMARY KEY  (`ccid`),
  KEY `cc_comment_id` (`ccid`),
  KEY `cc_commented_id` (`commented_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Tablo döküm verisi `comment_comment`
-- 


-- --------------------------------------------------------

-- 
-- Tablo yapısı: `comment_question`
-- 

CREATE TABLE `comment_question` (
  `cqid` int(11) NOT NULL,
  `question_id` int(11) default NULL,
  PRIMARY KEY  (`cqid`),
  KEY `cq_comment_id` (`cqid`),
  KEY `cq_question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Tablo döküm verisi `comment_question`
-- 


-- --------------------------------------------------------

-- 
-- Tablo yapısı: `questions`
-- 

CREATE TABLE `questions` (
  `qid` int(11) NOT NULL auto_increment,
  `text` text,
  `created` datetime default NULL,
  `user_id` int(11) default NULL,
  PRIMARY KEY  (`qid`),
  KEY `q_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Tablo döküm verisi `questions`
-- 

INSERT INTO `questions` VALUES (1, 'Örnek soru 1?', '2012-03-14 16:34:19', 1);
INSERT INTO `questions` VALUES (2, 'Örnek soru 2?', '2012-03-14 16:34:32', 2);

-- --------------------------------------------------------

-- 
-- Tablo yapısı: `question_tag`
-- 

CREATE TABLE `question_tag` (
  `question_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY  (`question_id`,`tag_id`),
  KEY `qt_question_id` (`question_id`),
  KEY `qt_tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Tablo döküm verisi `question_tag`
-- 

INSERT INTO `question_tag` VALUES (1, 1);
INSERT INTO `question_tag` VALUES (2, 1);

-- --------------------------------------------------------

-- 
-- Tablo yapısı: `question_vote`
-- 

CREATE TABLE `question_vote` (
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `value` tinyint(4) default NULL,
  PRIMARY KEY  (`question_id`,`user_id`),
  KEY `qv_user_id` (`user_id`),
  KEY `qv_question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Tablo döküm verisi `question_vote`
-- 

INSERT INTO `question_vote` VALUES (1, 1, 1);
INSERT INTO `question_vote` VALUES (1, 2, 0);

-- --------------------------------------------------------

-- 
-- Tablo yapısı: `tags`
-- 

CREATE TABLE `tags` (
  `tid` int(11) NOT NULL auto_increment,
  `text` varchar(45) default NULL,
  `user_id` int(11) default NULL,
  PRIMARY KEY  (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Tablo döküm verisi `tags`
-- 

INSERT INTO `tags` VALUES (1, 'örnek', 1);

-- --------------------------------------------------------

-- 
-- Tablo yapısı: `users`
-- 

CREATE TABLE `users` (
  `uid` int(11) NOT NULL auto_increment,
  `email` varchar(45) default NULL,
  `password` varchar(100) default NULL,
  `name` varchar(45) default NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Tablo döküm verisi `users`
-- 

INSERT INTO `users` VALUES (1, 'st06150323@etu.edu.tr', '12345', 'Burak YILDIZ', '2012-03-14 16:33:31');
INSERT INTO `users` VALUES (2, 'st06150324', '12345', 'Ali VELİ', '2012-03-14 16:33:55');

-- 
-- Dökümü yapılmış tablolar için kısıtlamalar
-- 

-- 
-- Tablo kısıtlamaları `answers`
-- 
ALTER TABLE `answers`
  ADD CONSTRAINT `a_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `a_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Tablo kısıtlamaları `answer_vote`
-- 
ALTER TABLE `answer_vote`
  ADD CONSTRAINT `av_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `av_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Tablo kısıtlamaları `comments`
-- 
ALTER TABLE `comments`
  ADD CONSTRAINT `c_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Tablo kısıtlamaları `comment_answer`
-- 
ALTER TABLE `comment_answer`
  ADD CONSTRAINT `ca_comment_id` FOREIGN KEY (`caid`) REFERENCES `comments` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ca_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Tablo kısıtlamaları `comment_comment`
-- 
ALTER TABLE `comment_comment`
  ADD CONSTRAINT `cc_comment_id` FOREIGN KEY (`ccid`) REFERENCES `comments` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cc_commented_id` FOREIGN KEY (`commented_id`) REFERENCES `comments` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Tablo kısıtlamaları `comment_question`
-- 
ALTER TABLE `comment_question`
  ADD CONSTRAINT `cq_comment_id` FOREIGN KEY (`cqid`) REFERENCES `comments` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cq_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Tablo kısıtlamaları `questions`
-- 
ALTER TABLE `questions`
  ADD CONSTRAINT `q_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Tablo kısıtlamaları `question_tag`
-- 
ALTER TABLE `question_tag`
  ADD CONSTRAINT `qt_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`qid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `qt_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Tablo kısıtlamaları `question_vote`
-- 
ALTER TABLE `question_vote`
  ADD CONSTRAINT `qv_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `qv_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE;
