<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211216074541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, phone INT NOT NULL, email VARCHAR(255) DEFAULT NULL, address VARCHAR(255) NOT NULL, address_complement VARCHAR(255) DEFAULT NULL, zip_code INT DEFAULT NULL, country VARCHAR(255) NOT NULL, gender VARCHAR(3) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, mission_status_id INT NOT NULL, title VARCHAR(255) NOT NULL, details VARCHAR(255) NOT NULL, insert_date DATETIME NOT NULL, INDEX IDX_9067F23CD942F794 (mission_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission_status (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, insert_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE owner (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, subscription VARCHAR(255) NOT NULL, inscription_date DATETIME NOT NULL, renewal_date DATETIME DEFAULT NULL, expirate_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CD942F794 FOREIGN KEY (mission_status_id) REFERENCES mission_status (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CD942F794');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE mission_status');
        $this->addSql('DROP TABLE owner');
        $this->addSql('DROP TABLE user');
    }
}
