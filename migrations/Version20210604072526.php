<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604072526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_result DROP FOREIGN KEY FK_8C6A57CDD60322AC');
        $this->addSql('DROP INDEX IDX_8C6A57CDD60322AC ON player_result');
        $this->addSql('ALTER TABLE player_result DROP role_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_result ADD role_id INT NOT NULL');
        $this->addSql('ALTER TABLE player_result ADD CONSTRAINT FK_8C6A57CDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8C6A57CDD60322AC ON player_result (role_id)');
    }
}
