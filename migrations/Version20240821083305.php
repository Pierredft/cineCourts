<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240821083305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films ADD video_film VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE films_acteurs ADD CONSTRAINT FK_A526A0F939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_acteurs ADD CONSTRAINT FK_A526A0F71A27AFC FOREIGN KEY (acteurs_id) REFERENCES acteurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_realisateur ADD CONSTRAINT FK_A02DDBB2939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_realisateur ADD CONSTRAINT FK_A02DDBB2F1D8422E FOREIGN KEY (realisateur_id) REFERENCES realisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre ADD films_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE genre ADD CONSTRAINT FK_835033F8939610EE FOREIGN KEY (films_id) REFERENCES films (id)');
        $this->addSql('CREATE INDEX IDX_835033F8939610EE ON genre (films_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films DROP video_film');
        $this->addSql('ALTER TABLE films_acteurs DROP FOREIGN KEY FK_A526A0F939610EE');
        $this->addSql('ALTER TABLE films_acteurs DROP FOREIGN KEY FK_A526A0F71A27AFC');
        $this->addSql('ALTER TABLE films_realisateur DROP FOREIGN KEY FK_A02DDBB2939610EE');
        $this->addSql('ALTER TABLE films_realisateur DROP FOREIGN KEY FK_A02DDBB2F1D8422E');
        $this->addSql('ALTER TABLE genre DROP FOREIGN KEY FK_835033F8939610EE');
        $this->addSql('DROP INDEX IDX_835033F8939610EE ON genre');
        $this->addSql('ALTER TABLE genre DROP films_id');
    }
}
