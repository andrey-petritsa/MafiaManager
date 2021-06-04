<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604065000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_result ADD role_id INT DEFAULT NULL, DROP role');
        $this->addSql('ALTER TABLE player_result ADD CONSTRAINT FK_8C6A57CDD60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8C6A57CDD60322AC ON player_result (role_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_result DROP FOREIGN KEY FK_8C6A57CDD60322AC');
        $this->addSql('DROP INDEX UNIQ_8C6A57CDD60322AC ON player_result');
        $this->addSql('ALTER TABLE player_result ADD role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP role_id');
    }
}
