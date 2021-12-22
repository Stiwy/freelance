<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211222080109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tva (id INT AUTO_INCREMENT NOT NULL, taux DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tva_owner (tva_id INT NOT NULL, owner_id INT NOT NULL, INDEX IDX_F822F2724D79775F (tva_id), INDEX IDX_F822F2727E3C61F9 (owner_id), PRIMARY KEY(tva_id, owner_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tva_owner ADD CONSTRAINT FK_F822F2724D79775F FOREIGN KEY (tva_id) REFERENCES tva (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tva_owner ADD CONSTRAINT FK_F822F2727E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tva_owner DROP FOREIGN KEY FK_F822F2724D79775F');
        $this->addSql('DROP TABLE tva');
        $this->addSql('DROP TABLE tva_owner');
    }
}
