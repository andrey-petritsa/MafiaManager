<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604065642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_result DROP FOREIGN KEY FK_8C6A57CDD60322AC');
        $this->addSql('ALTER TABLE player_result CHANGE role_id role_id INT NOT NULL');
        $this->addSql('ALTER TABLE player_result ADD CONSTRAINT FK_8C6A57CDD60322AC FOREIGN KEY (role_id) REFERENCES player (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_result DROP FOREIGN KEY FK_8C6A57CDD60322AC');
        $this->addSql('ALTER TABLE player_result CHANGE role_id role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player_result ADD CONSTRAINT FK_8C6A57CDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
