<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604073430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_result DROP FOREIGN KEY FK_8C6A57CD3256915B');
        $this->addSql('DROP INDEX UNIQ_8C6A57CD3256915B ON player_result');
        $this->addSql('ALTER TABLE player_result CHANGE relation_id player_id INT NOT NULL');
        $this->addSql('ALTER TABLE player_result ADD CONSTRAINT FK_8C6A57CD99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8C6A57CD99E6F5DF ON player_result (player_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_result DROP FOREIGN KEY FK_8C6A57CD99E6F5DF');
        $this->addSql('DROP INDEX UNIQ_8C6A57CD99E6F5DF ON player_result');
        $this->addSql('ALTER TABLE player_result CHANGE player_id relation_id INT NOT NULL');
        $this->addSql('ALTER TABLE player_result ADD CONSTRAINT FK_8C6A57CD3256915B FOREIGN KEY (relation_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8C6A57CD3256915B ON player_result (relation_id)');
    }
}
