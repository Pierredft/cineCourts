<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240726084435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE films (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, synopsis LONGTEXT NOT NULL, duree TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE films_movies (id INT AUTO_INCREMENT NOT NULL, films_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_714A6689939610EE (films_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE films_trailer (id INT AUTO_INCREMENT NOT NULL, films_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_749B83ED939610EE (films_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE films_movies ADD CONSTRAINT FK_714A6689939610EE FOREIGN KEY (films_id) REFERENCES films (id)');
        $this->addSql('ALTER TABLE films_trailer ADD CONSTRAINT FK_749B83ED939610EE FOREIGN KEY (films_id) REFERENCES films (id)');
        $this->addSql('ALTER TABLE user ADD profil_picture VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films_movies DROP FOREIGN KEY FK_714A6689939610EE');
        $this->addSql('ALTER TABLE films_trailer DROP FOREIGN KEY FK_749B83ED939610EE');
        $this->addSql('DROP TABLE films');
        $this->addSql('DROP TABLE films_movies');
        $this->addSql('DROP TABLE films_trailer');
        $this->addSql('ALTER TABLE user DROP profil_picture');
    }
}
