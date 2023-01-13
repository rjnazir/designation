<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221219182757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE transports (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom_transp VARCHAR(124) NOT NULL, abreviation_transp VARCHAR(64) DEFAULT NULL, transp_created DATETIME NOT NULL, transp_updated DATETIME DEFAULT NULL, INDEX IDX_C7BE69E5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transports ADD CONSTRAINT FK_C7BE69E5A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7AC38C2B4B1DAB3F ON personnels (matricule_pers)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transports DROP FOREIGN KEY FK_C7BE69E5A76ED395');
        $this->addSql('DROP TABLE transports');
        $this->addSql('DROP INDEX UNIQ_7AC38C2B4B1DAB3F ON personnels');
    }
}
