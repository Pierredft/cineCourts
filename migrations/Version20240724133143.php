<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724133143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films DROP FOREIGN KEY FK_CEECCA5153F590A4');
        $this->addSql('ALTER TABLE films DROP FOREIGN KEY FK_CEECCA51B6C04CFD');
        $this->addSql('DROP TABLE films');
        $this->addSql('DROP TABLE films_movie');
        $this->addSql('DROP TABLE films_trailer');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE films (id INT AUTO_INCREMENT NOT NULL, movies_id INT NOT NULL, trailer_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, duree TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\', synopsis LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_CEECCA51B6C04CFD (trailer_id), UNIQUE INDEX UNIQ_CEECCA5153F590A4 (movies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE films_movie (id INT AUTO_INCREMENT NOT NULL, movie_file_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE films_trailer (id INT AUTO_INCREMENT NOT NULL, trailer_file_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA5153F590A4 FOREIGN KEY (movies_id) REFERENCES films_movie (id)');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA51B6C04CFD FOREIGN KEY (trailer_id) REFERENCES films_trailer (id)');
    }
}
