<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240729115937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE nom name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE films_movies DROP FOREIGN KEY FK_714A6689939610EE');
        $this->addSql('DROP INDEX IDX_714A6689939610EE ON films_movies');
        $this->addSql('ALTER TABLE films_movies DROP films_id, DROP updated_at, CHANGE nom filename VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE films_trailer DROP FOREIGN KEY FK_749B83ED939610EE');
        $this->addSql('DROP INDEX IDX_749B83ED939610EE ON films_trailer');
        $this->addSql('ALTER TABLE films_trailer DROP films_id, CHANGE nom filname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD reset_token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films_trailer ADD films_id INT DEFAULT NULL, CHANGE filname nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE films_trailer ADD CONSTRAINT FK_749B83ED939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_749B83ED939610EE ON films_trailer (films_id)');
        $this->addSql('ALTER TABLE films DROP updated_at, CHANGE name nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE films_movies ADD films_id INT DEFAULT NULL, ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE filename nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE films_movies ADD CONSTRAINT FK_714A6689939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_714A6689939610EE ON films_movies (films_id)');
        $this->addSql('ALTER TABLE user DROP reset_token');
    }
}
