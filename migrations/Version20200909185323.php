<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200909185323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6EA724598 FOREIGN KEY (patient_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_964685A6EA724598 ON consultation (patient_id_id)');
        $this->addSql('ALTER TABLE user ADD last_activity_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6EA724598');
        $this->addSql('DROP INDEX IDX_964685A6EA724598 ON consultation');
        $this->addSql('ALTER TABLE user DROP last_activity_at');
    }
}
