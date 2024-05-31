<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240531084510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE challenge_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE difficulty_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE leaderboard_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE learning_path_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE learning_path_lesson_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE lesson_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE notification_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE progress_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rank_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reward_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE setting_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_rank_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE challenge (id SERIAL, reward_id INT NOT NULL, difficulty_id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D7098951E466ACA1 ON challenge (reward_id)');
        $this->addSql('CREATE INDEX IDX_D7098951FCFA9DAE ON challenge (difficulty_id)');
        $this->addSql('CREATE TABLE difficulty (id SERIAL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE leaderboard (id SERIAL, user_id INT NOT NULL, points INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_182E5253A76ED395 ON leaderboard (user_id)');
        $this->addSql('CREATE TABLE learning_path (id SERIAL, description TEXT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE learning_path_lesson (id SERIAL, learning_path_id INT NOT NULL, lesson_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BB3BD3EE1DCBEE98 ON learning_path_lesson (learning_path_id)');
        $this->addSql('CREATE INDEX IDX_BB3BD3EECDF80196 ON learning_path_lesson (lesson_id)');
        $this->addSql('CREATE TABLE lesson (id SERIAL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE notification (id SERIAL, user_id INT NOT NULL, notification_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, notification_text TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BF5476CAA76ED395 ON notification (user_id)');
        $this->addSql('CREATE TABLE progress (id SERIAL, user_id INT NOT NULL, challenge_id INT NOT NULL, is_completed BOOLEAN NOT NULL, completed_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2201F246A76ED395 ON progress (user_id)');
        $this->addSql('CREATE INDEX IDX_2201F24698A21AC6 ON progress (challenge_id)');
        $this->addSql('CREATE TABLE rank (id SERIAL, name VARCHAR(50) NOT NULL, min_points INT NOT NULL, max_points INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE reward (id SERIAL, points INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE setting (id SERIAL, user_id INT NOT NULL, referral_code VARCHAR(50) NOT NULL, referral_count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F74B898A76ED395 ON setting (user_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(50) NOT NULL, is_verified BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('CREATE TABLE user_rank (id SERIAL, user_id INT NOT NULL, rank_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F2F8A42CA76ED395 ON user_rank (user_id)');
        $this->addSql('CREATE INDEX IDX_F2F8A42C7616678F ON user_rank (rank_id)');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D7098951E466ACA1 FOREIGN KEY (reward_id) REFERENCES reward (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D7098951FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulty (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE leaderboard ADD CONSTRAINT FK_182E5253A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE learning_path_lesson ADD CONSTRAINT FK_BB3BD3EE1DCBEE98 FOREIGN KEY (learning_path_id) REFERENCES learning_path (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE learning_path_lesson ADD CONSTRAINT FK_BB3BD3EECDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F246A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F24698A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenge (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE setting ADD CONSTRAINT FK_9F74B898A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_rank ADD CONSTRAINT FK_F2F8A42CA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_rank ADD CONSTRAINT FK_F2F8A42C7616678F FOREIGN KEY (rank_id) REFERENCES rank (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE challenge_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE difficulty_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE leaderboard_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE learning_path_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE learning_path_lesson_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE lesson_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE notification_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE progress_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rank_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reward_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE setting_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE user_rank_id_seq CASCADE');
        $this->addSql('ALTER TABLE challenge DROP CONSTRAINT FK_D7098951E466ACA1');
        $this->addSql('ALTER TABLE challenge DROP CONSTRAINT FK_D7098951FCFA9DAE');
        $this->addSql('ALTER TABLE leaderboard DROP CONSTRAINT FK_182E5253A76ED395');
        $this->addSql('ALTER TABLE learning_path_lesson DROP CONSTRAINT FK_BB3BD3EE1DCBEE98');
        $this->addSql('ALTER TABLE learning_path_lesson DROP CONSTRAINT FK_BB3BD3EECDF80196');
        $this->addSql('ALTER TABLE notification DROP CONSTRAINT FK_BF5476CAA76ED395');
        $this->addSql('ALTER TABLE progress DROP CONSTRAINT FK_2201F246A76ED395');
        $this->addSql('ALTER TABLE progress DROP CONSTRAINT FK_2201F24698A21AC6');
        $this->addSql('ALTER TABLE setting DROP CONSTRAINT FK_9F74B898A76ED395');
        $this->addSql('ALTER TABLE user_rank DROP CONSTRAINT FK_F2F8A42CA76ED395');
        $this->addSql('ALTER TABLE user_rank DROP CONSTRAINT FK_F2F8A42C7616678F');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE difficulty');
        $this->addSql('DROP TABLE leaderboard');
        $this->addSql('DROP TABLE learning_path');
        $this->addSql('DROP TABLE learning_path_lesson');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE progress');
        $this->addSql('DROP TABLE rank');
        $this->addSql('DROP TABLE reward');
        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_rank');
    }
}
