<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200928095535 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE doctor_specialist_title (id INT AUTO_INCREMENT NOT NULL, speciality_id_id INT NOT NULL, specialist_title VARCHAR(255) NOT NULL, INDEX IDX_64814E19ADE0D45C (speciality_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE doctor_specialist_title ADD CONSTRAINT FK_64814E19ADE0D45C FOREIGN KEY (speciality_id_id) REFERENCES doctor_speciality (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE doctor_specialist_title');
    }
}
