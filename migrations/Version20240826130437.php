<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240826130437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films ADD arcom_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA51C7DA10DA FOREIGN KEY (arcom_id) REFERENCES arcom (id)');
        $this->addSql('CREATE INDEX IDX_CEECCA51C7DA10DA ON films (arcom_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films DROP FOREIGN KEY FK_CEECCA51C7DA10DA');
        $this->addSql('DROP INDEX IDX_CEECCA51C7DA10DA ON films');
        $this->addSql('ALTER TABLE films DROP arcom_id');
    }
}
