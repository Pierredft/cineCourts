<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240821131846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE genres ADD film_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE genres ADD CONSTRAINT FK_A8EBE516567F5183 FOREIGN KEY (film_id) REFERENCES films (id)');
        $this->addSql('CREATE INDEX IDX_A8EBE516567F5183 ON genres (film_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE genres DROP FOREIGN KEY FK_A8EBE516567F5183');
        $this->addSql('DROP INDEX IDX_A8EBE516567F5183 ON genres');
        $this->addSql('ALTER TABLE genres DROP film_id');
    }
}
