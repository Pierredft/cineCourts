<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240826120242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_court_metrage ADD user_id INT NOT NULL, CHANGE description description MEDIUMTEXT NOT NULL');
        $this->addSql('ALTER TABLE user_court_metrage ADD CONSTRAINT FK_75C822E8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_75C822E8A76ED395 ON user_court_metrage (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_court_metrage DROP FOREIGN KEY FK_75C822E8A76ED395');
        $this->addSql('DROP INDEX IDX_75C822E8A76ED395 ON user_court_metrage');
        $this->addSql('ALTER TABLE user_court_metrage DROP user_id, CHANGE description description VARCHAR(500) NOT NULL');
    }
}
