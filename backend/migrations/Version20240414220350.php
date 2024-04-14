<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240414220350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE learning_path_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE learning_path_lesson_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE lesson_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE notification_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE progress_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rank_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE setting_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_rank_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE learning_path (id INT NOT NULL, description TEXT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE learning_path_lesson (id INT NOT NULL, id_learning_path_id INT NOT NULL, id_lesson_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BB3BD3EEFE41BB49 ON learning_path_lesson (id_learning_path_id)');
        $this->addSql('CREATE INDEX IDX_BB3BD3EE4DCDBDB1 ON learning_path_lesson (id_lesson_id)');
        $this->addSql('CREATE TABLE lesson (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE notification (id INT NOT NULL, id_user_id INT NOT NULL, notification_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, notification_text TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BF5476CA79F37AE5 ON notification (id_user_id)');
        $this->addSql('CREATE TABLE progress (id INT NOT NULL, id_user_id INT NOT NULL, id_challenge_id INT NOT NULL, is_completed BOOLEAN NOT NULL, completed_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2201F24679F37AE5 ON progress (id_user_id)');
        $this->addSql('CREATE INDEX IDX_2201F246BB636FB4 ON progress (id_challenge_id)');
        $this->addSql('CREATE TABLE rank (id INT NOT NULL, name VARCHAR(50) NOT NULL, min_points INT NOT NULL, max_points INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE setting (id INT NOT NULL, referral_code VARCHAR(50) NOT NULL, referral_count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_rank (id INT NOT NULL, id_user_id INT NOT NULL, id_rank_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F2F8A42C79F37AE5 ON user_rank (id_user_id)');
        $this->addSql('CREATE INDEX IDX_F2F8A42CA88BCEFF ON user_rank (id_rank_id)');
        $this->addSql('ALTER TABLE learning_path_lesson ADD CONSTRAINT FK_BB3BD3EEFE41BB49 FOREIGN KEY (id_learning_path_id) REFERENCES learning_path (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE learning_path_lesson ADD CONSTRAINT FK_BB3BD3EE4DCDBDB1 FOREIGN KEY (id_lesson_id) REFERENCES lesson (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA79F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F24679F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F246BB636FB4 FOREIGN KEY (id_challenge_id) REFERENCES challenge (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_rank ADD CONSTRAINT FK_F2F8A42C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_rank ADD CONSTRAINT FK_F2F8A42CA88BCEFF FOREIGN KEY (id_rank_id) REFERENCES rank (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE learning_path_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE learning_path_lesson_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE lesson_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE notification_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE progress_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rank_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE setting_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_rank_id_seq CASCADE');
        $this->addSql('ALTER TABLE learning_path_lesson DROP CONSTRAINT FK_BB3BD3EEFE41BB49');
        $this->addSql('ALTER TABLE learning_path_lesson DROP CONSTRAINT FK_BB3BD3EE4DCDBDB1');
        $this->addSql('ALTER TABLE notification DROP CONSTRAINT FK_BF5476CA79F37AE5');
        $this->addSql('ALTER TABLE progress DROP CONSTRAINT FK_2201F24679F37AE5');
        $this->addSql('ALTER TABLE progress DROP CONSTRAINT FK_2201F246BB636FB4');
        $this->addSql('ALTER TABLE user_rank DROP CONSTRAINT FK_F2F8A42C79F37AE5');
        $this->addSql('ALTER TABLE user_rank DROP CONSTRAINT FK_F2F8A42CA88BCEFF');
        $this->addSql('DROP TABLE learning_path');
        $this->addSql('DROP TABLE learning_path_lesson');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE progress');
        $this->addSql('DROP TABLE rank');
        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP TABLE user_rank');
    }
}
