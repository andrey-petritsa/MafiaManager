<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604081719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_result DROP INDEX UNIQ_8C6A57CD99E6F5DF, ADD INDEX IDX_8C6A57CD99E6F5DF (player_id)');
        $this->addSql('ALTER TABLE player_result DROP INDEX UNIQ_8C6A57CDE48FD905, ADD INDEX IDX_8C6A57CDE48FD905 (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_result DROP INDEX IDX_8C6A57CD99E6F5DF, ADD UNIQUE INDEX UNIQ_8C6A57CD99E6F5DF (player_id)');
        $this->addSql('ALTER TABLE player_result DROP INDEX IDX_8C6A57CDE48FD905, ADD UNIQUE INDEX UNIQ_8C6A57CDE48FD905 (game_id)');
    }
}
