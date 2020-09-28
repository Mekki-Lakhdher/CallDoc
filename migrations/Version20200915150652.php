<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200915150652 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation DROP chat_room_id');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A632B07E31 FOREIGN KEY (doctor_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_964685A632B07E31 ON consultation (doctor_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A632B07E31');
        $this->addSql('DROP INDEX IDX_964685A632B07E31 ON consultation');
        $this->addSql('ALTER TABLE consultation ADD chat_room_id VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
