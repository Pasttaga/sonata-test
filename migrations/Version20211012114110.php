<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211012114110 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE a (id INT AUTO_INCREMENT NOT NULL, tesxt VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE b (id INT AUTO_INCREMENT NOT NULL, a_id INT DEFAULT NULL, tesxt VARCHAR(255) DEFAULT NULL, INDEX IDX_71BEEFF93BDE5358 (a_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE c (id INT AUTO_INCREMENT NOT NULL, b_id INT DEFAULT NULL, tesxt VARCHAR(255) DEFAULT NULL, INDEX IDX_6B9DF6F296BFCB6 (b_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE b ADD CONSTRAINT FK_71BEEFF93BDE5358 FOREIGN KEY (a_id) REFERENCES a (id)');
        $this->addSql('ALTER TABLE c ADD CONSTRAINT FK_6B9DF6F296BFCB6 FOREIGN KEY (b_id) REFERENCES b (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE b DROP FOREIGN KEY FK_71BEEFF93BDE5358');
        $this->addSql('ALTER TABLE c DROP FOREIGN KEY FK_6B9DF6F296BFCB6');
        $this->addSql('DROP TABLE a');
        $this->addSql('DROP TABLE b');
        $this->addSql('DROP TABLE c');
    }
}
