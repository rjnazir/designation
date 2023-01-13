<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220112213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE munitions (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom_mun VARCHAR(124) NOT NULL, lot_mun VARCHAR(64) DEFAULT NULL, calibre_mun DOUBLE PRECISION DEFAULT NULL, mun_created DATETIME NOT NULL, mun_updated DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_606290B7F5C660DE (nom_mun), INDEX IDX_606290B7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE munitions ADD CONSTRAINT FK_606290B7A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7BE69E5B768EFC9 ON transports (nom_transp)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E8B62BEB2A945EC7 ON type_armements (nom_arm)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BC5506474DA381C0 ON types_services (nom_type_sce)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE munitions DROP FOREIGN KEY FK_606290B7A76ED395');
        $this->addSql('DROP TABLE munitions');
        $this->addSql('DROP INDEX UNIQ_C7BE69E5B768EFC9 ON transports');
        $this->addSql('DROP INDEX UNIQ_E8B62BEB2A945EC7 ON type_armements');
        $this->addSql('DROP INDEX UNIQ_BC5506474DA381C0 ON types_services');
    }
}
