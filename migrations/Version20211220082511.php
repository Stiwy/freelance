<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211220082511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_9067F23C9395C3F3 ON mission (customer_id)');
        $this->addSql('ALTER TABLE mission_status ADD owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mission_status ADD CONSTRAINT FK_23F8BF527E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)');
        $this->addSql('CREATE INDEX IDX_23F8BF527E3C61F9 ON mission_status (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C9395C3F3');
        $this->addSql('DROP INDEX IDX_9067F23C9395C3F3 ON mission');
        $this->addSql('ALTER TABLE mission DROP customer_id');
        $this->addSql('ALTER TABLE mission_status DROP FOREIGN KEY FK_23F8BF527E3C61F9');
        $this->addSql('DROP INDEX IDX_23F8BF527E3C61F9 ON mission_status');
        $this->addSql('ALTER TABLE mission_status DROP owner_id');
    }
}
