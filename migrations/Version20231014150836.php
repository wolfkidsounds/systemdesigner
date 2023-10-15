<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231014150836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE processor ADD COLUMN manual VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__processor AS SELECT id, user_id, manufacturer_id, name, channels_input, channels_output, output_offset, validated FROM processor');
        $this->addSql('DROP TABLE processor');
        $this->addSql('CREATE TABLE processor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, channels_input INTEGER NOT NULL, channels_output INTEGER NOT NULL, output_offset INTEGER NOT NULL, validated BOOLEAN NOT NULL, CONSTRAINT FK_29C04650A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_29C04650A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO processor (id, user_id, manufacturer_id, name, channels_input, channels_output, output_offset, validated) SELECT id, user_id, manufacturer_id, name, channels_input, channels_output, output_offset, validated FROM __temp__processor');
        $this->addSql('DROP TABLE __temp__processor');
        $this->addSql('CREATE INDEX IDX_29C04650A76ED395 ON processor (user_id)');
        $this->addSql('CREATE INDEX IDX_29C04650A23B42D ON processor (manufacturer_id)');
    }
}
