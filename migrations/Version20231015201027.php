<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231015201027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE speaker ADD COLUMN bandwidth VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__speaker AS SELECT id, user_id, manufacturer_id, name, power_rms, power_peak, impedance, spl, manual, validated FROM speaker');
        $this->addSql('DROP TABLE speaker');
        $this->addSql('CREATE TABLE speaker (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, power_rms INTEGER NOT NULL, power_peak INTEGER DEFAULT NULL, impedance INTEGER NOT NULL, spl DOUBLE PRECISION DEFAULT NULL, manual VARCHAR(255) DEFAULT NULL, validated BOOLEAN NOT NULL, CONSTRAINT FK_7B85DB61A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7B85DB61A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO speaker (id, user_id, manufacturer_id, name, power_rms, power_peak, impedance, spl, manual, validated) SELECT id, user_id, manufacturer_id, name, power_rms, power_peak, impedance, spl, manual, validated FROM __temp__speaker');
        $this->addSql('DROP TABLE __temp__speaker');
        $this->addSql('CREATE INDEX IDX_7B85DB61A76ED395 ON speaker (user_id)');
        $this->addSql('CREATE INDEX IDX_7B85DB61A23B42D ON speaker (manufacturer_id)');
    }
}