<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240510173113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER INDEX idx_d709895164531086 RENAME TO IDX_D7098951E466ACA1');
        $this->addSql('ALTER INDEX idx_d709895142d24ccb RENAME TO IDX_D7098951FCFA9DAE');
        $this->addSql('ALTER INDEX idx_182e525379f37ae5 RENAME TO IDX_182E5253A76ED395');
        $this->addSql('ALTER INDEX idx_bb3bd3eefe41bb49 RENAME TO IDX_BB3BD3EE1DCBEE98');
        $this->addSql('ALTER INDEX idx_bb3bd3ee4dcdbdb1 RENAME TO IDX_BB3BD3EECDF80196');
        $this->addSql('ALTER INDEX idx_bf5476ca79f37ae5 RENAME TO IDX_BF5476CAA76ED395');
        $this->addSql('ALTER INDEX idx_2201f24679f37ae5 RENAME TO IDX_2201F246A76ED395');
        $this->addSql('ALTER INDEX idx_2201f246bb636fb4 RENAME TO IDX_2201F24698A21AC6');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9F74B898A76ED395 ON setting (user_id)');
        $this->addSql('ALTER TABLE "user" ADD roles JSON NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP is_admin');
        $this->addSql('ALTER TABLE "user" ALTER email TYPE VARCHAR(180)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('ALTER INDEX idx_f2f8a42c79f37ae5 RENAME TO IDX_F2F8A42CA76ED395');
        $this->addSql('ALTER INDEX idx_f2f8a42ca88bceff RENAME TO IDX_F2F8A42C7616678F');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER INDEX idx_182e5253a76ed395 RENAME TO idx_182e525379f37ae5');
        $this->addSql('ALTER INDEX idx_2201f24698a21ac6 RENAME TO idx_2201f246bb636fb4');
        $this->addSql('ALTER INDEX idx_2201f246a76ed395 RENAME TO idx_2201f24679f37ae5');
        $this->addSql('ALTER INDEX idx_f2f8a42c7616678f RENAME TO idx_f2f8a42ca88bceff');
        $this->addSql('ALTER INDEX idx_f2f8a42ca76ed395 RENAME TO idx_f2f8a42c79f37ae5');
        $this->addSql('ALTER INDEX idx_d7098951fcfa9dae RENAME TO idx_d709895142d24ccb');
        $this->addSql('ALTER INDEX idx_d7098951e466aca1 RENAME TO idx_d709895164531086');
        $this->addSql('ALTER INDEX idx_bb3bd3eecdf80196 RENAME TO idx_bb3bd3ee4dcdbdb1');
        $this->addSql('ALTER INDEX idx_bb3bd3ee1dcbee98 RENAME TO idx_bb3bd3eefe41bb49');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_EMAIL');
        $this->addSql('ALTER TABLE "user" ADD is_admin BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP roles');
        $this->addSql('ALTER TABLE "user" ALTER email TYPE VARCHAR(255)');
        $this->addSql('CREATE INDEX IDX_9F74B898A76ED395 ON setting (user_id)');
        $this->addSql('ALTER INDEX idx_bf5476caa76ed395 RENAME TO idx_bf5476ca79f37ae5');
    }
}
