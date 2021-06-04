<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210531134459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE38726F65CED5');
        $this->addSql('DROP INDEX UNIQ_B8EE38726F65CED5 ON club');
        $this->addSql('ALTER TABLE club CHANGE organisator_id_id organisator_id INT NOT NULL');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE3872FFDD4EC8 FOREIGN KEY (organisator_id) REFERENCES player (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8EE3872FFDD4EC8 ON club (organisator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE3872FFDD4EC8');
        $this->addSql('DROP INDEX UNIQ_B8EE3872FFDD4EC8 ON club');
        $this->addSql('ALTER TABLE club CHANGE organisator_id organisator_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE38726F65CED5 FOREIGN KEY (organisator_id_id) REFERENCES player (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8EE38726F65CED5 ON club (organisator_id_id)');
    }
}
