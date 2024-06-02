<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240531222223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE answer (id INT NOT NULL, flag VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE OR REPLACE FUNCTION insert_answer() RETURNS TRIGGER AS $$
                        BEGIN
                            INSERT INTO answer(id, flag) VALUES (NEW.id, md5(random()::text));
                            RETURN NEW;
                        END;
                        $$ LANGUAGE plpgsql;');
        $this->addSql('CREATE TRIGGER insert_answer_trigger AFTER INSERT ON challenge FOR EACH ROW EXECUTE FUNCTION insert_answer();');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TRIGGER insert_answer_trigger ON challenge;');
        $this->addSql('DROP FUNCTION insert_answer;');
        $this->addSql('DROP TABLE answer');
    }
}
