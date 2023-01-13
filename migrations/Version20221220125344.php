<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220125344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absences ADD motifs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE absences ADD CONSTRAINT FK_F9C0EFFF83CAFB5D FOREIGN KEY (motifs_id) REFERENCES motifs (id)');
        $this->addSql('CREATE INDEX IDX_F9C0EFFF83CAFB5D ON absences (motifs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absences DROP FOREIGN KEY FK_F9C0EFFF83CAFB5D');
        $this->addSql('DROP INDEX IDX_F9C0EFFF83CAFB5D ON absences');
        $this->addSql('ALTER TABLE absences DROP motifs_id');
    }
}
