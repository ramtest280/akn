<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603081736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE absence (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, motif VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE classe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE cours (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, hourly TIME NOT NULL, end_hourly TIME NOT NULL)');
        $this->addSql('CREATE TABLE matiere (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE retard (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, student_id INTEGER NOT NULL, date DATE NOT NULL, motif VARCHAR(255) NOT NULL, hourly INTEGER NOT NULL, CONSTRAINT FK_5C64DDBDCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5C64DDBDCB944F1A ON retard (student_id)');
        $this->addSql('CREATE TABLE salle (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, classe_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, nickname VARCHAR(255) DEFAULT NULL, birth DATE NOT NULL, adress VARCHAR(255) NOT NULL, fathername VARCHAR(255) NOT NULL, mothername VARCHAR(255) NOT NULL, avatar VARCHAR(255) NOT NULL, CONSTRAINT FK_B723AF338F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF338F5EA509 ON student (classe_id)');
        $this->addSql('CREATE TABLE teacher (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, nickname VARCHAR(255) DEFAULT NULL, birth VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, telnumber INTEGER NOT NULL, number_cin INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE absence');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE retard');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
