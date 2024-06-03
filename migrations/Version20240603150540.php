<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603150540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__classe AS SELECT id, name FROM classe');
        $this->addSql('DROP TABLE classe');
        $this->addSql('CREATE TABLE classe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO classe (id, name) SELECT id, name FROM __temp__classe');
        $this->addSql('DROP TABLE __temp__classe');
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, classe_id, name, nickname, birth, adress, fathername, mothername, avatar FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classe_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, nickname VARCHAR(255) DEFAULT NULL, birth DATE NOT NULL, adress VARCHAR(255) NOT NULL, fathername VARCHAR(255) NOT NULL, mothername VARCHAR(255) NOT NULL, avatar VARCHAR(255) NOT NULL, CONSTRAINT FK_B723AF338F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO student (id, classe_id, name, nickname, birth, adress, fathername, mothername, avatar) SELECT id, classe_id, name, nickname, birth, adress, fathername, mothername, avatar FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
        $this->addSql('CREATE INDEX IDX_B723AF338F5EA509 ON student (classe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__classe AS SELECT id, name FROM classe');
        $this->addSql('DROP TABLE classe');
        $this->addSql('CREATE TABLE classe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, student_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_8F87BF96CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO classe (id, name) SELECT id, name FROM __temp__classe');
        $this->addSql('DROP TABLE __temp__classe');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F87BF96CB944F1A ON classe (student_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, classe_id, name, nickname, birth, adress, fathername, mothername, avatar FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classe_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, nickname VARCHAR(255) DEFAULT NULL, birth DATE NOT NULL, adress VARCHAR(255) NOT NULL, fathername VARCHAR(255) NOT NULL, mothername VARCHAR(255) NOT NULL, avatar VARCHAR(255) NOT NULL, CONSTRAINT FK_B723AF338F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO student (id, classe_id, name, nickname, birth, adress, fathername, mothername, avatar) SELECT id, classe_id, name, nickname, birth, adress, fathername, mothername, avatar FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF338F5EA509 ON student (classe_id)');
    }
}
