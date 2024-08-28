<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240827192602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_video_progress DROP FOREIGN KEY FK_E1061FA329C1004E');
        $this->addSql('ALTER TABLE user_video_progress DROP FOREIGN KEY FK_E1061FA3A76ED395');
        $this->addSql('DROP TABLE user_video_progress');
        $this->addSql('ALTER TABLE films ADD nouveauté TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_video_progress (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, video_id INT NOT NULL, last_watched_timestamp INT NOT NULL, duration INT NOT NULL, INDEX IDX_E1061FA3A76ED395 (user_id), INDEX IDX_E1061FA329C1004E (video_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_video_progress ADD CONSTRAINT FK_E1061FA329C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE user_video_progress ADD CONSTRAINT FK_E1061FA3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE films DROP nouveauté');
    }
}
