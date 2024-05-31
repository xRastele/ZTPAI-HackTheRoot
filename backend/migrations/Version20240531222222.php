<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240531222222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add triggers for user verification and challenge progress';
    }

    public function up(Schema $schema): void
    {
        // Function to handle user verification
        $this->addSql("
            CREATE OR REPLACE FUNCTION handle_user_verification() RETURNS TRIGGER AS $$
            BEGIN
                IF NEW.is_verified = TRUE THEN
                    INSERT INTO leaderboard (user_id, points) VALUES (NEW.id, 0);
                    INSERT INTO setting (user_id, referral_code, referral_count) VALUES (NEW.id, NEW.username, 0);
                END IF;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");

        // Trigger for user verification
        $this->addSql("
            CREATE TRIGGER after_user_verified
            AFTER UPDATE OF is_verified ON \"user\"
            FOR EACH ROW
            WHEN (OLD.is_verified IS DISTINCT FROM NEW.is_verified)
            EXECUTE FUNCTION handle_user_verification();
        ");

        // Function to handle challenge progress
        $this->addSql("
            CREATE OR REPLACE FUNCTION handle_challenge_progress() RETURNS TRIGGER AS $$
            BEGIN
                IF NEW.is_completed = TRUE THEN
                    UPDATE leaderboard
                    SET points = points + (SELECT r.points FROM reward r
                                           JOIN challenge c ON c.reward_id = r.id
                                           WHERE c.id = NEW.challenge_id)
                    WHERE user_id = NEW.user_id;
                END IF;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");

        // Trigger for challenge progress
        $this->addSql("
            CREATE TRIGGER after_challenge_progress
            AFTER INSERT ON progress
            FOR EACH ROW
            EXECUTE FUNCTION handle_challenge_progress();
        ");
    }

    public function down(Schema $schema): void
    {
        // Dropping the triggers and functions
        $this->addSql('DROP TRIGGER IF EXISTS after_user_verified ON "user"');
        $this->addSql('DROP FUNCTION IF EXISTS handle_user_verification()');
        $this->addSql('DROP TRIGGER IF EXISTS after_challenge_progress ON progress');
        $this->addSql('DROP FUNCTION IF EXISTS handle_challenge_progress()');
    }
}
