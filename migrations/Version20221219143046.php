<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221219143046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tenues (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom_tn VARCHAR(255) NOT NULL, numero_tn VARCHAR(24) NOT NULL, abreviation_tn VARCHAR(255) DEFAULT NULL, tn_created DATETIME NOT NULL, tn_updated DATETIME DEFAULT NULL, INDEX IDX_28E683A6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tenues ADD CONSTRAINT FK_28E683A6A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tenues DROP FOREIGN KEY FK_28E683A6A76ED395');
        $this->addSql('DROP TABLE tenues');
    }
}
