<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240826193925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subtitle ADD films_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subtitle ADD CONSTRAINT FK_518597B1939610EE FOREIGN KEY (films_id) REFERENCES films (id)');
        $this->addSql('CREATE INDEX IDX_518597B1939610EE ON subtitle (films_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subtitle DROP FOREIGN KEY FK_518597B1939610EE');
        $this->addSql('DROP INDEX IDX_518597B1939610EE ON subtitle');
        $this->addSql('ALTER TABLE subtitle DROP films_id');
    }
}
