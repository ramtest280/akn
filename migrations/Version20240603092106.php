<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603092106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__absence AS SELECT id, start_date, end_date, motif FROM absence');
        $this->addSql('DROP TABLE absence');
        $this->addSql('CREATE TABLE absence (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, student_id INTEGER NOT NULL, classe_id INTEGER NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, motif VARCHAR(255) NOT NULL, CONSTRAINT FK_765AE0C9CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_765AE0C98F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO absence (id, start_date, end_date, motif) SELECT id, start_date, end_date, motif FROM __temp__absence');
        $this->addSql('DROP TABLE __temp__absence');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_765AE0C9CB944F1A ON absence (student_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_765AE0C98F5EA509 ON absence (classe_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cours AS SELECT id, name, hourly, end_hourly FROM cours');
        $this->addSql('DROP TABLE cours');
        $this->addSql('CREATE TABLE cours (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, matiere_id INTEGER NOT NULL, salle_id INTEGER NOT NULL, teacher_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, hourly TIME NOT NULL, end_hourly TIME NOT NULL, CONSTRAINT FK_FDCA8C9CF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FDCA8C9CDC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FDCA8C9C41807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cours (id, name, hourly, end_hourly) SELECT id, name, hourly, end_hourly FROM __temp__cours');
        $this->addSql('DROP TABLE __temp__cours');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FDCA8C9CF46CD258 ON cours (matiere_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FDCA8C9CDC304035 ON cours (salle_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FDCA8C9C41807E1D ON cours (teacher_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__retard AS SELECT id, student_id, date, motif, hourly FROM retard');
        $this->addSql('DROP TABLE retard');
        $this->addSql('CREATE TABLE retard (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, student_id INTEGER NOT NULL, classe_id INTEGER NOT NULL, date DATE NOT NULL, motif VARCHAR(255) NOT NULL, hourly INTEGER NOT NULL, CONSTRAINT FK_5C64DDBDCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5C64DDBD8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO retard (id, student_id, date, motif, hourly) SELECT id, student_id, date, motif, hourly FROM __temp__retard');
        $this->addSql('DROP TABLE __temp__retard');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5C64DDBDCB944F1A ON retard (student_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5C64DDBD8F5EA509 ON retard (classe_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__teacher AS SELECT id, name, nickname, birth, adress, telnumber, number_cin FROM teacher');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('CREATE TABLE teacher (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, matiere_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, nickname VARCHAR(255) DEFAULT NULL, birth VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, telnumber INTEGER NOT NULL, number_cin INTEGER NOT NULL, CONSTRAINT FK_B0F6A6D5F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO teacher (id, name, nickname, birth, adress, telnumber, number_cin) SELECT id, name, nickname, birth, adress, telnumber, number_cin FROM __temp__teacher');
        $this->addSql('DROP TABLE __temp__teacher');
        $this->addSql('CREATE INDEX IDX_B0F6A6D5F46CD258 ON teacher (matiere_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__absence AS SELECT id, start_date, end_date, motif FROM absence');
        $this->addSql('DROP TABLE absence');
        $this->addSql('CREATE TABLE absence (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, motif VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO absence (id, start_date, end_date, motif) SELECT id, start_date, end_date, motif FROM __temp__absence');
        $this->addSql('DROP TABLE __temp__absence');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cours AS SELECT id, name, hourly, end_hourly FROM cours');
        $this->addSql('DROP TABLE cours');
        $this->addSql('CREATE TABLE cours (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, hourly TIME NOT NULL, end_hourly TIME NOT NULL)');
        $this->addSql('INSERT INTO cours (id, name, hourly, end_hourly) SELECT id, name, hourly, end_hourly FROM __temp__cours');
        $this->addSql('DROP TABLE __temp__cours');
        $this->addSql('CREATE TEMPORARY TABLE __temp__retard AS SELECT id, student_id, date, motif, hourly FROM retard');
        $this->addSql('DROP TABLE retard');
        $this->addSql('CREATE TABLE retard (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, student_id INTEGER NOT NULL, date DATE NOT NULL, motif VARCHAR(255) NOT NULL, hourly INTEGER NOT NULL, CONSTRAINT FK_5C64DDBDCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO retard (id, student_id, date, motif, hourly) SELECT id, student_id, date, motif, hourly FROM __temp__retard');
        $this->addSql('DROP TABLE __temp__retard');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5C64DDBDCB944F1A ON retard (student_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__teacher AS SELECT id, name, nickname, birth, adress, telnumber, number_cin FROM teacher');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('CREATE TABLE teacher (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, nickname VARCHAR(255) DEFAULT NULL, birth VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, telnumber INTEGER NOT NULL, number_cin INTEGER NOT NULL)');
        $this->addSql('INSERT INTO teacher (id, name, nickname, birth, adress, telnumber, number_cin) SELECT id, name, nickname, birth, adress, telnumber, number_cin FROM __temp__teacher');
        $this->addSql('DROP TABLE __temp__teacher');
    }
}
