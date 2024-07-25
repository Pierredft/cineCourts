<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724122837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films ADD trailer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA51B6C04CFD FOREIGN KEY (trailer_id) REFERENCES films_trailer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CEECCA51B6C04CFD ON films (trailer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films DROP FOREIGN KEY FK_CEECCA51B6C04CFD');
        $this->addSql('DROP INDEX UNIQ_CEECCA51B6C04CFD ON films');
        $this->addSql('ALTER TABLE films DROP trailer_id');
    }
}
