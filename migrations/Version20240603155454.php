<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603155454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE birthplace (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('ALTER TABLE student ADD COLUMN birthplace VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE birthplace');
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, classe_id, name, nickname, birth, adress, fathername, mothername, avatar FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classe_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, nickname VARCHAR(255) DEFAULT NULL, birth DATE NOT NULL, adress VARCHAR(255) NOT NULL, fathername VARCHAR(255) NOT NULL, mothername VARCHAR(255) NOT NULL, avatar VARCHAR(255) NOT NULL, CONSTRAINT FK_B723AF338F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO student (id, classe_id, name, nickname, birth, adress, fathername, mothername, avatar) SELECT id, classe_id, name, nickname, birth, adress, fathername, mothername, avatar FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
        $this->addSql('CREATE INDEX IDX_B723AF338F5EA509 ON student (classe_id)');
    }
}
