<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240828063918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subtitle (id INT AUTO_INCREMENT NOT NULL, films_id INT DEFAULT NULL, langue VARCHAR(255) NOT NULL, abrev VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, titre_film VARCHAR(255) NOT NULL, INDEX IDX_518597B1939610EE (films_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subtitle ADD CONSTRAINT FK_518597B1939610EE FOREIGN KEY (films_id) REFERENCES films (id)');
        $this->addSql('ALTER TABLE films ADD nouveauté TINYINT(1) NOT NULL, ADD vo VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subtitle DROP FOREIGN KEY FK_518597B1939610EE');
        $this->addSql('DROP TABLE subtitle');
        $this->addSql('ALTER TABLE films DROP nouveauté, DROP vo');
    }
}
