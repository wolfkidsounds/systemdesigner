<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231022140253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE speaker_chassis (speaker_id INTEGER NOT NULL, chassis_id INTEGER NOT NULL, PRIMARY KEY(speaker_id, chassis_id), CONSTRAINT FK_347B318DD04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_347B318D63EE729 FOREIGN KEY (chassis_id) REFERENCES chassis (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_347B318DD04A0F27 ON speaker_chassis (speaker_id)');
        $this->addSql('CREATE INDEX IDX_347B318D63EE729 ON speaker_chassis (chassis_id)');
        $this->addSql('ALTER TABLE chassis ADD COLUMN resonance_frequency DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN compliance DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN moving_mass DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN mechanical_grade DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN electrical_grade DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN total_grade DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN equivalent_volume DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN resistance_dc DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN force_factor DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN voice_coil_inductance DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN linear_displacement DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN effective_piston_area DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN net_weight DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN nominal_impedance INTEGER NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN power_rms INTEGER NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN sensitivity DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE chassis ADD COLUMN winding_material VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE speaker_chassis');
        $this->addSql('CREATE TEMPORARY TABLE __temp__chassis AS SELECT id, user_id, manufacturer_id, name, validated FROM chassis');
        $this->addSql('DROP TABLE chassis');
        $this->addSql('CREATE TABLE chassis (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, validated BOOLEAN NOT NULL, CONSTRAINT FK_35C973DFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_35C973DFA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO chassis (id, user_id, manufacturer_id, name, validated) SELECT id, user_id, manufacturer_id, name, validated FROM __temp__chassis');
        $this->addSql('DROP TABLE __temp__chassis');
        $this->addSql('CREATE INDEX IDX_35C973DFA76ED395 ON chassis (user_id)');
        $this->addSql('CREATE INDEX IDX_35C973DFA23B42D ON chassis (manufacturer_id)');
    }
}
