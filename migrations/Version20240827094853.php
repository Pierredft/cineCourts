<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240827094853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subtitle (id INT AUTO_INCREMENT NOT NULL, films_id INT DEFAULT NULL, langue VARCHAR(255) NOT NULL, abrev VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, titre_film VARCHAR(255) NOT NULL, INDEX IDX_518597B1939610EE (films_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_court_metrage (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description MEDIUMTEXT NOT NULL, email VARCHAR(255) NOT NULL, nom_fichier_video VARCHAR(500) NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_75C822E8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subtitle ADD CONSTRAINT FK_518597B1939610EE FOREIGN KEY (films_id) REFERENCES films (id)');
        $this->addSql('ALTER TABLE user_court_metrage ADD CONSTRAINT FK_75C822E8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE films ADD arcom_id INT DEFAULT NULL, ADD ban VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA51C7DA10DA FOREIGN KEY (arcom_id) REFERENCES arcom (id)');
        $this->addSql('CREATE INDEX IDX_CEECCA51C7DA10DA ON films (arcom_id)');
        $this->addSql('ALTER TABLE genres DROP image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subtitle DROP FOREIGN KEY FK_518597B1939610EE');
        $this->addSql('ALTER TABLE user_court_metrage DROP FOREIGN KEY FK_75C822E8A76ED395');
        $this->addSql('DROP TABLE subtitle');
        $this->addSql('DROP TABLE user_court_metrage');
        $this->addSql('ALTER TABLE genres ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE films DROP FOREIGN KEY FK_CEECCA51C7DA10DA');
        $this->addSql('DROP INDEX IDX_CEECCA51C7DA10DA ON films');
        $this->addSql('ALTER TABLE films DROP arcom_id, DROP ban');
    }
}
