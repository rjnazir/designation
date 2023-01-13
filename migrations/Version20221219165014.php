<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221219165014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personnels (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, is_out_cr TINYINT(1) NOT NULL, pers_created DATETIME NOT NULL, pers_updated DATETIME DEFAULT NULL, INDEX IDX_7AC38C2BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnles (id INT AUTO_INCREMENT NOT NULL, matricule_pers INT NOT NULL, grade_pers VARCHAR(24) NOT NULL, nom_pers VARCHAR(128) NOT NULL, prenoms_pers VARCHAR(128) DEFAULT NULL, fonctions_pers VARCHAR(128) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnels ADD CONSTRAINT FK_7AC38C2BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnels DROP FOREIGN KEY FK_7AC38C2BA76ED395');
        $this->addSql('DROP TABLE personnels');
        $this->addSql('DROP TABLE personnles');
    }
}
