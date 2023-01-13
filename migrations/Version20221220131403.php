<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220131403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absences ADD personnels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE absences ADD CONSTRAINT FK_F9C0EFFFC7022806 FOREIGN KEY (personnels_id) REFERENCES personnels (id)');
        $this->addSql('CREATE INDEX IDX_F9C0EFFFC7022806 ON absences (personnels_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absences DROP FOREIGN KEY FK_F9C0EFFFC7022806');
        $this->addSql('DROP INDEX IDX_F9C0EFFFC7022806 ON absences');
        $this->addSql('ALTER TABLE absences DROP personnels_id');
    }
}
