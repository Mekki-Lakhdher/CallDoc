<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201229100601 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `consultation` Change `asked` `asked_by_patient` int(11)');
        $this->addSql('ALTER TABLE `consultation` ADD `asked_by_patient_at` DATETIME DEFAULT CURRENT_TIMESTAMP AFTER `asked_by_patient`');
        $this->addSql('ALTER TABLE `consultation` Change `confirmed` `confirmed_by_doctor` int(11)');
        $this->addSql('ALTER TABLE `consultation` ADD `confirmed_by_doctor_at` DATETIME DEFAULT NULL AFTER `confirmed_by_doctor`');
        $this->addSql('ALTER TABLE `consultation` Change `canceled` `canceled_by_doctor` int(11)');
        $this->addSql('ALTER TABLE `consultation` ADD `canceled_by_doctor_at` DATETIME DEFAULT NULL AFTER `canceled_by_doctor`');
        $this->addSql('ALTER TABLE `consultation` ADD `canceled_by_patient` int(11) AFTER `canceled_by_doctor_at`');
        $this->addSql('ALTER TABLE `consultation` ADD `canceled_by_patient_at` DATETIME DEFAULT NULL AFTER `canceled_by_patient`');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `consultation` Change `asked_by_patient` `asked` int(11)');
        $this->addSql('ALTER TABLE `consultation` DROP `asked_by_patient_at`');
        $this->addSql('ALTER TABLE `consultation` Change `confirmed_by_doctor` `confirmed` int(11)');
        $this->addSql('ALTER TABLE `consultation` DROP `confirmed_by_doctor_at`');
        $this->addSql('ALTER TABLE `consultation` Change `canceled_by_doctor` `canceled` int(11)');
        $this->addSql('ALTER TABLE `consultation` DROP `canceled_by_doctor_at`');
        $this->addSql('ALTER TABLE `consultation` DROP `canceled_by_patient`');
        $this->addSql('ALTER TABLE `consultation` DROP `canceled_by_patient_at`');
    }
}
