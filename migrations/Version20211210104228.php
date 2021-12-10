<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211210104228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE belong (category_id INT NOT NULL, program_id INT NOT NULL, INDEX IDX_BFFF81BB12469DE2 (category_id), INDEX IDX_BFFF81BB3EB8070A (program_id), PRIMARY KEY(category_id, program_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `show` (id INT AUTO_INCREMENT NOT NULL, program_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date_start DATETIME NOT NULL, date_end DATETIME NOT NULL, date_created DATETIME NOT NULL, hosted_by VARCHAR(255) DEFAULT NULL, guest VARCHAR(255) DEFAULT NULL, INDEX IDX_320ED901E12DEDA1 (program_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT FK_BFFF81BB12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT FK_BFFF81BB3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `show` ADD CONSTRAINT FK_320ED901E12DEDA1 FOREIGN KEY (program_id_id) REFERENCES program (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE belong DROP FOREIGN KEY FK_BFFF81BB12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE belong');
        $this->addSql('DROP TABLE `show`');
    }
}
