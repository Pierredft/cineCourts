<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240821132510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE films_genres (films_id INT NOT NULL, genres_id INT NOT NULL, INDEX IDX_1FBF6EAF939610EE (films_id), INDEX IDX_1FBF6EAF6A3B2603 (genres_id), PRIMARY KEY(films_id, genres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE films_genres ADD CONSTRAINT FK_1FBF6EAF939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_genres ADD CONSTRAINT FK_1FBF6EAF6A3B2603 FOREIGN KEY (genres_id) REFERENCES genres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genres DROP FOREIGN KEY FK_A8EBE516567F5183');
        $this->addSql('DROP INDEX IDX_A8EBE516567F5183 ON genres');
        $this->addSql('ALTER TABLE genres DROP film_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films_genres DROP FOREIGN KEY FK_1FBF6EAF939610EE');
        $this->addSql('ALTER TABLE films_genres DROP FOREIGN KEY FK_1FBF6EAF6A3B2603');
        $this->addSql('DROP TABLE films_genres');
        $this->addSql('ALTER TABLE genres ADD film_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE genres ADD CONSTRAINT FK_A8EBE516567F5183 FOREIGN KEY (film_id) REFERENCES films (id)');
        $this->addSql('CREATE INDEX IDX_A8EBE516567F5183 ON genres (film_id)');
    }
}
