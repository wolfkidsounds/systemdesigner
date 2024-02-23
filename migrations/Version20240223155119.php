<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240223155119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chassis ADD fs DOUBLE PRECISION NOT NULL, ADD cms DOUBLE PRECISION NOT NULL, ADD mms DOUBLE PRECISION NOT NULL, ADD qms DOUBLE PRECISION NOT NULL, ADD qes DOUBLE PRECISION NOT NULL, ADD qts DOUBLE PRECISION NOT NULL, ADD vas DOUBLE PRECISION NOT NULL, ADD re DOUBLE PRECISION NOT NULL, ADD bl DOUBLE PRECISION NOT NULL, ADD le DOUBLE PRECISION NOT NULL, ADD xmax DOUBLE PRECISION NOT NULL, ADD sd DOUBLE PRECISION NOT NULL, ADD mmd DOUBLE PRECISION DEFAULT NULL, ADD vd DOUBLE PRECISION NOT NULL, ADD voice_coil_diameter DOUBLE PRECISION NOT NULL, ADD datasheet VARCHAR(255) DEFAULT NULL, ADD bandwidth VARCHAR(255) NOT NULL, DROP resonance_frequency, DROP compliance, DROP moving_mass, DROP mechanical_grade, DROP electrical_grade, DROP total_grade, DROP equivalent_volume, DROP resistance_dc, DROP force_factor, DROP voice_coil_inductance, DROP linear_displacement, DROP effective_piston_area, CHANGE net_weight rms DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE manufacturer ADD category JSON DEFAULT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chassis ADD resonance_frequency DOUBLE PRECISION NOT NULL, ADD compliance DOUBLE PRECISION NOT NULL, ADD moving_mass DOUBLE PRECISION NOT NULL, ADD mechanical_grade DOUBLE PRECISION NOT NULL, ADD electrical_grade DOUBLE PRECISION NOT NULL, ADD total_grade DOUBLE PRECISION NOT NULL, ADD equivalent_volume DOUBLE PRECISION NOT NULL, ADD resistance_dc DOUBLE PRECISION NOT NULL, ADD force_factor DOUBLE PRECISION NOT NULL, ADD voice_coil_inductance DOUBLE PRECISION NOT NULL, ADD linear_displacement DOUBLE PRECISION NOT NULL, ADD effective_piston_area DOUBLE PRECISION NOT NULL, ADD net_weight DOUBLE PRECISION DEFAULT NULL, DROP fs, DROP cms, DROP mms, DROP qms, DROP qes, DROP qts, DROP vas, DROP re, DROP bl, DROP le, DROP xmax, DROP sd, DROP rms, DROP mmd, DROP vd, DROP voice_coil_diameter, DROP datasheet, DROP bandwidth');
        $this->addSql('ALTER TABLE manufacturer DROP category');
    }
}
