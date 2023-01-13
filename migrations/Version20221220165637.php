<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220165637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE designations ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE designations ADD CONSTRAINT FK_6536F4D7A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_6536F4D7A76ED395 ON designations (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE designations DROP FOREIGN KEY FK_6536F4D7A76ED395');
        $this->addSql('DROP INDEX IDX_6536F4D7A76ED395 ON designations');
        $this->addSql('ALTER TABLE designations DROP user_id');
    }
}
