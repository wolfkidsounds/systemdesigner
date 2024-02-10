<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204083122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__chassis AS SELECT id, user_id, manufacturer_id, name, validated, net_weight, nominal_impedance, power_rms, sensitivity, winding_material FROM chassis');
        $this->addSql('DROP TABLE chassis');
        $this->addSql('CREATE TABLE chassis (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, validated BOOLEAN NOT NULL, rms DOUBLE PRECISION DEFAULT NULL, nominal_impedance INTEGER NOT NULL, power_rms INTEGER NOT NULL, sensitivity DOUBLE PRECISION NOT NULL, winding_material VARCHAR(255) DEFAULT NULL, fs DOUBLE PRECISION NOT NULL, cms DOUBLE PRECISION NOT NULL, mms DOUBLE PRECISION NOT NULL, qms DOUBLE PRECISION NOT NULL, qes DOUBLE PRECISION NOT NULL, qts DOUBLE PRECISION NOT NULL, vas DOUBLE PRECISION NOT NULL, re DOUBLE PRECISION NOT NULL, bl DOUBLE PRECISION NOT NULL, le DOUBLE PRECISION NOT NULL, xmax DOUBLE PRECISION NOT NULL, sd DOUBLE PRECISION NOT NULL, mmd DOUBLE PRECISION DEFAULT NULL, vd DOUBLE PRECISION NOT NULL, voice_coil_diameter DOUBLE PRECISION NOT NULL, datasheet VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_35C973DFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_35C973DFA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO chassis (id, user_id, manufacturer_id, name, validated, rms, nominal_impedance, power_rms, sensitivity, winding_material) SELECT id, user_id, manufacturer_id, name, validated, net_weight, nominal_impedance, power_rms, sensitivity, winding_material FROM __temp__chassis');
        $this->addSql('DROP TABLE __temp__chassis');
        $this->addSql('CREATE INDEX IDX_35C973DFA23B42D ON chassis (manufacturer_id)');
        $this->addSql('CREATE INDEX IDX_35C973DFA76ED395 ON chassis (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__manufacturer AS SELECT id, user_id, name, validated, category FROM manufacturer');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('CREATE TABLE manufacturer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, validated BOOLEAN NOT NULL, category CLOB DEFAULT NULL --(DC2Type:json)
        , CONSTRAINT FK_3D0AE6DCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO manufacturer (id, user_id, name, validated, category) SELECT id, user_id, name, validated, category FROM __temp__manufacturer');
        $this->addSql('DROP TABLE __temp__manufacturer');
        $this->addSql('CREATE INDEX IDX_3D0AE6DCA76ED395 ON manufacturer (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__chassis AS SELECT id, user_id, manufacturer_id, name, validated, nominal_impedance, power_rms, sensitivity, winding_material FROM chassis');
        $this->addSql('DROP TABLE chassis');
        $this->addSql('CREATE TABLE chassis (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, validated BOOLEAN NOT NULL, nominal_impedance INTEGER NOT NULL, power_rms INTEGER NOT NULL, sensitivity DOUBLE PRECISION NOT NULL, winding_material VARCHAR(255) DEFAULT NULL, resonance_frequency DOUBLE PRECISION NOT NULL, compliance DOUBLE PRECISION NOT NULL, moving_mass DOUBLE PRECISION NOT NULL, mechanical_grade DOUBLE PRECISION NOT NULL, electrical_grade DOUBLE PRECISION NOT NULL, total_grade DOUBLE PRECISION NOT NULL, equivalent_volume DOUBLE PRECISION NOT NULL, resistance_dc DOUBLE PRECISION NOT NULL, force_factor DOUBLE PRECISION NOT NULL, voice_coil_inductance DOUBLE PRECISION NOT NULL, linear_displacement DOUBLE PRECISION NOT NULL, effective_piston_area DOUBLE PRECISION NOT NULL, net_weight DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_35C973DFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_35C973DFA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO chassis (id, user_id, manufacturer_id, name, validated, nominal_impedance, power_rms, sensitivity, winding_material) SELECT id, user_id, manufacturer_id, name, validated, nominal_impedance, power_rms, sensitivity, winding_material FROM __temp__chassis');
        $this->addSql('DROP TABLE __temp__chassis');
        $this->addSql('CREATE INDEX IDX_35C973DFA76ED395 ON chassis (user_id)');
        $this->addSql('CREATE INDEX IDX_35C973DFA23B42D ON chassis (manufacturer_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__manufacturer AS SELECT id, user_id, name, validated, category FROM manufacturer');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('CREATE TABLE manufacturer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, validated BOOLEAN NOT NULL, category CLOB DEFAULT NULL, CONSTRAINT FK_3D0AE6DCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO manufacturer (id, user_id, name, validated, category) SELECT id, user_id, name, validated, category FROM __temp__manufacturer');
        $this->addSql('DROP TABLE __temp__manufacturer');
        $this->addSql('CREATE INDEX IDX_3D0AE6DCA76ED395 ON manufacturer (user_id)');
    }
}
