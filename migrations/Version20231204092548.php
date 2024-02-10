<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204092548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chassis ADD COLUMN bandwidth VARCHAR(255) NOT NULL DEFAULT "FR"');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__chassis AS SELECT id, user_id, manufacturer_id, name, validated, fs, cms, mms, qms, qes, qts, vas, re, bl, le, xmax, sd, rms, nominal_impedance, power_rms, sensitivity, winding_material, mmd, vd, voice_coil_diameter, datasheet FROM chassis');
        $this->addSql('DROP TABLE chassis');
        $this->addSql('CREATE TABLE chassis (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, validated BOOLEAN NOT NULL, fs DOUBLE PRECISION NOT NULL, cms DOUBLE PRECISION NOT NULL, mms DOUBLE PRECISION NOT NULL, qms DOUBLE PRECISION NOT NULL, qes DOUBLE PRECISION NOT NULL, qts DOUBLE PRECISION NOT NULL, vas DOUBLE PRECISION NOT NULL, re DOUBLE PRECISION NOT NULL, bl DOUBLE PRECISION NOT NULL, le DOUBLE PRECISION NOT NULL, xmax DOUBLE PRECISION NOT NULL, sd DOUBLE PRECISION NOT NULL, rms DOUBLE PRECISION DEFAULT NULL, nominal_impedance INTEGER NOT NULL, power_rms INTEGER NOT NULL, sensitivity DOUBLE PRECISION NOT NULL, winding_material VARCHAR(255) DEFAULT NULL, mmd DOUBLE PRECISION DEFAULT NULL, vd DOUBLE PRECISION NOT NULL, voice_coil_diameter DOUBLE PRECISION NOT NULL, datasheet VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_35C973DFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_35C973DFA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO chassis (id, user_id, manufacturer_id, name, validated, fs, cms, mms, qms, qes, qts, vas, re, bl, le, xmax, sd, rms, nominal_impedance, power_rms, sensitivity, winding_material, mmd, vd, voice_coil_diameter, datasheet) SELECT id, user_id, manufacturer_id, name, validated, fs, cms, mms, qms, qes, qts, vas, re, bl, le, xmax, sd, rms, nominal_impedance, power_rms, sensitivity, winding_material, mmd, vd, voice_coil_diameter, datasheet FROM __temp__chassis');
        $this->addSql('DROP TABLE __temp__chassis');
        $this->addSql('CREATE INDEX IDX_35C973DFA76ED395 ON chassis (user_id)');
        $this->addSql('CREATE INDEX IDX_35C973DFA23B42D ON chassis (manufacturer_id)');
    }
}
