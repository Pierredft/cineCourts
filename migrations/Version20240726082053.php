<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240726082053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films_movies DROP FOREIGN KEY FK_714A66892D0B81E1');
        $this->addSql('DROP INDEX IDX_714A66892D0B81E1 ON films_movies');
        $this->addSql('ALTER TABLE films_movies DROP films_movies_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films_movies ADD films_movies_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE films_movies ADD CONSTRAINT FK_714A66892D0B81E1 FOREIGN KEY (films_movies_id) REFERENCES films (id)');
        $this->addSql('CREATE INDEX IDX_714A66892D0B81E1 ON films_movies (films_movies_id)');
    }
}
