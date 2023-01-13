<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220165241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE designations (id INT AUTO_INCREMENT NOT NULL, personnels_id INT DEFAULT NULL, transports_id INT DEFAULT NULL, munitions_id INT DEFAULT NULL, type_armements_id INT DEFAULT NULL, tenues_id INT DEFAULT NULL, date_depart_design DATETIME NOT NULL, date_retour_design DATETIME NOT NULL, distance DOUBLE PRECISION DEFAULT NULL, itineraire VARCHAR(255) DEFAULT NULL, suite_donner VARCHAR(255) DEFAULT NULL, observations VARCHAR(255) DEFAULT NULL, desgn_created DATETIME NOT NULL, design_updated DATETIME DEFAULT NULL, INDEX IDX_6536F4D7C7022806 (personnels_id), INDEX IDX_6536F4D7518E99D9 (transports_id), INDEX IDX_6536F4D774ADA7AB (munitions_id), INDEX IDX_6536F4D797841149 (type_armements_id), INDEX IDX_6536F4D7E273680F (tenues_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE designations ADD CONSTRAINT FK_6536F4D7C7022806 FOREIGN KEY (personnels_id) REFERENCES personnels (id)');
        $this->addSql('ALTER TABLE designations ADD CONSTRAINT FK_6536F4D7518E99D9 FOREIGN KEY (transports_id) REFERENCES transports (id)');
        $this->addSql('ALTER TABLE designations ADD CONSTRAINT FK_6536F4D774ADA7AB FOREIGN KEY (munitions_id) REFERENCES munitions (id)');
        $this->addSql('ALTER TABLE designations ADD CONSTRAINT FK_6536F4D797841149 FOREIGN KEY (type_armements_id) REFERENCES type_armements (id)');
        $this->addSql('ALTER TABLE designations ADD CONSTRAINT FK_6536F4D7E273680F FOREIGN KEY (tenues_id) REFERENCES tenues (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE designations DROP FOREIGN KEY FK_6536F4D7C7022806');
        $this->addSql('ALTER TABLE designations DROP FOREIGN KEY FK_6536F4D7518E99D9');
        $this->addSql('ALTER TABLE designations DROP FOREIGN KEY FK_6536F4D774ADA7AB');
        $this->addSql('ALTER TABLE designations DROP FOREIGN KEY FK_6536F4D797841149');
        $this->addSql('ALTER TABLE designations DROP FOREIGN KEY FK_6536F4D7E273680F');
        $this->addSql('DROP TABLE designations');
    }
}
