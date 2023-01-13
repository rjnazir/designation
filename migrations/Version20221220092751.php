<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220092751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_armements (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom_arm VARCHAR(124) NOT NULL, abreviation_arm VARCHAR(64) DEFAULT NULL, arm_created DATETIME NOT NULL, arm_updated DATETIME DEFAULT NULL, INDEX IDX_E8B62BEBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_armements ADD CONSTRAINT FK_E8B62BEBA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_armements DROP FOREIGN KEY FK_E8B62BEBA76ED395');
        $this->addSql('DROP TABLE type_armements');
    }
}
