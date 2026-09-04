<?php

declare(strict_types=1);

namespace DoctrineMigrations\Ead;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260714190000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return "Baseline schema for ead module from s.controleonline.com";
    }

    public function up(Schema $schema): void
    {
        $this->addSql('SET FOREIGN_KEY_CHECKS=0');
        $this->addSql('CREATE TABLE IF NOT EXISTS `ead_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classes` varchar(255) CHARACTER SET utf8 NOT NULL,
  `courses_id` int(11) NOT NULL,
  `subjects_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_id` (`courses_id`),
  KEY `subjects_id` (`subjects_id`),
  CONSTRAINT `ead_classes_ibfk_1` FOREIGN KEY (`courses_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ead_classes_ibfk_2` FOREIGN KEY (`subjects_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('CREATE TABLE IF NOT EXISTS `ead_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) CHARACTER SET utf8 NOT NULL,
  `subjects_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subjects_id` (`subjects_id`),
  KEY `file_id` (`file_id`),
  CONSTRAINT `ead_content_ibfk_1` FOREIGN KEY (`subjects_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ead_content_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('CREATE TABLE IF NOT EXISTS `ead_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exercise_type` enum(\'exercise\',\'exam\') CHARACTER SET utf8 NOT NULL,
  `content_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`),
  KEY `file_id` (`file_id`),
  CONSTRAINT `ead_exercises_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `ead_content` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ead_exercises_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('CREATE TABLE IF NOT EXISTS `ead_exercises_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exercise_id` int(11) NOT NULL,
  `option` varchar(255) CHARACTER SET utf8 NOT NULL,
  `correct` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `exercise_id` (`exercise_id`),
  CONSTRAINT `ead_exercises_options_ibfk_1` FOREIGN KEY (`exercise_id`) REFERENCES `ead_exercises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('CREATE TABLE IF NOT EXISTS `ead_people_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `people_id` int(11) NOT NULL,
  `people_type` enum(\'student\',\'teacher\') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `people_id` (`people_id`),
  CONSTRAINT `ead_people_classes_ibfk_1` FOREIGN KEY (`people_id`) REFERENCES `people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('CREATE TABLE IF NOT EXISTS `ead_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_type` enum(\'class\',\'exam\') CHARACTER SET utf8 NOT NULL,
  `session` varchar(255) CHARACTER SET utf8 NOT NULL,
  `start_data` datetime DEFAULT NULL,
  `end_data` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('CREATE TABLE IF NOT EXISTS `ead_sessions_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `ead_sessions_content_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `ead_content` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ead_sessions_content_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `ead_sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('CREATE TABLE IF NOT EXISTS `ead_student_session_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_session_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `response_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `exercise_id` (`exercise_id`),
  KEY `response_id` (`response_id`),
  KEY `student_session_id` (`student_session_id`),
  CONSTRAINT `ead_student_session_responses_ibfk_1` FOREIGN KEY (`exercise_id`) REFERENCES `ead_exercises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ead_student_session_responses_ibfk_2` FOREIGN KEY (`response_id`) REFERENCES `ead_exercises_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ead_student_session_responses_ibfk_3` FOREIGN KEY (`student_session_id`) REFERENCES `ead_student_sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('CREATE TABLE IF NOT EXISTS `ead_student_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status_id` (`status_id`),
  KEY `session_id` (`session_id`),
  CONSTRAINT `ead_student_sessions_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ead_student_sessions_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `ead_sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down(Schema $schema): void
    {
        return;
    }
}
