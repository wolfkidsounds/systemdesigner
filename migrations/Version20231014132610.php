<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231014132610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE amplifier (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, power16 INTEGER DEFAULT NULL, power8 INTEGER DEFAULT NULL, power4 INTEGER DEFAULT NULL, power2 INTEGER DEFAULT NULL, power_bridge8 INTEGER DEFAULT NULL, power_bridge4 INTEGER DEFAULT NULL, CONSTRAINT FK_1E49E997A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1E49E997A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_1E49E997A76ED395 ON amplifier (user_id)');
        $this->addSql('CREATE INDEX IDX_1E49E997A23B42D ON amplifier (manufacturer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE amplifier');
    }
}
