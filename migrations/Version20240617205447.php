<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240617205447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE paint (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, width NUMERIC(10, 2) DEFAULT NULL, height NUMERIC(10, 2) DEFAULT NULL, on_sale TINYINT(1) NOT NULL, price NUMERIC(10, 2) DEFAULT NULL, realisation_date DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, description LONGTEXT NOT NULL, portfolio TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE paint');
    }
}
