<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201109175052 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE home_page_content (id INT AUTO_INCREMENT NOT NULL, content_type VARCHAR(50) NOT NULL, content_class VARCHAR(50) NOT NULL, content_first_title VARCHAR(30) DEFAULT NULL, content_second_title VARCHAR(30) DEFAULT NULL, content_photo LONGBLOB DEFAULT NULL, content_text TINYTEXT NOT NULL, content_first_link VARCHAR(255) DEFAULT NULL, content_second_link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation ADD description LONGTEXT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE home_page_content');
        $this->addSql('ALTER TABLE consultation DROP description');
    }
}
