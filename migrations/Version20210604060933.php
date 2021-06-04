<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604060933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ADD game_session_id INT NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C8FE32B32 FOREIGN KEY (game_session_id) REFERENCES game_session (id)');
        $this->addSql('CREATE INDEX IDX_232B318C8FE32B32 ON game (game_session_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C8FE32B32');
        $this->addSql('DROP INDEX IDX_232B318C8FE32B32 ON game');
        $this->addSql('ALTER TABLE game DROP game_session_id');
    }
}
