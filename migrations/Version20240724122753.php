<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724122753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films ADD movies_id INT NOT NULL');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA5153F590A4 FOREIGN KEY (movies_id) REFERENCES films_movie (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CEECCA5153F590A4 ON films (movies_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films DROP FOREIGN KEY FK_CEECCA5153F590A4');
        $this->addSql('DROP INDEX UNIQ_CEECCA5153F590A4 ON films');
        $this->addSql('ALTER TABLE films DROP movies_id');
    }
}
