<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240413171454 extends AbstractMigration
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
        $this->addSql('CREATE SEQUENCE reward_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE challenge (id INT NOT NULL, id_reward_id INT NOT NULL, id_difficulty_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D709895164531086 ON challenge (id_reward_id)');
        $this->addSql('CREATE INDEX IDX_D709895142D24CCB ON challenge (id_difficulty_id)');
        $this->addSql('CREATE TABLE difficulty (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE leaderboard (id INT NOT NULL, id_user_id INT NOT NULL, points INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_182E525379F37AE5 ON leaderboard (id_user_id)');
        $this->addSql('CREATE TABLE reward (id INT NOT NULL, points INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, is_admin BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D709895164531086 FOREIGN KEY (id_reward_id) REFERENCES reward (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D709895142D24CCB FOREIGN KEY (id_difficulty_id) REFERENCES difficulty (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE leaderboard ADD CONSTRAINT FK_182E525379F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE challenge_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE difficulty_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE leaderboard_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reward_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE challenge DROP CONSTRAINT FK_D709895164531086');
        $this->addSql('ALTER TABLE challenge DROP CONSTRAINT FK_D709895142D24CCB');
        $this->addSql('ALTER TABLE leaderboard DROP CONSTRAINT FK_182E525379F37AE5');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE difficulty');
        $this->addSql('DROP TABLE leaderboard');
        $this->addSql('DROP TABLE reward');
        $this->addSql('DROP TABLE "user"');
    }
}
