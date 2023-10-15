<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231015193024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__amplifier AS SELECT id, user_id, manufacturer_id, name, power16, power8, power4, power2, power_bridge8, power_bridge4, validated, manual FROM amplifier');
        $this->addSql('DROP TABLE amplifier');
        $this->addSql('CREATE TABLE amplifier (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, power16 INTEGER DEFAULT NULL, power8 INTEGER DEFAULT NULL, power4 INTEGER DEFAULT NULL, power2 INTEGER DEFAULT NULL, power_bridge8 INTEGER DEFAULT NULL, power_bridge4 INTEGER DEFAULT NULL, validated BOOLEAN NOT NULL, manual VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_1E49E997A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1E49E997A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO amplifier (id, user_id, manufacturer_id, name, power16, power8, power4, power2, power_bridge8, power_bridge4, validated, manual) SELECT id, user_id, manufacturer_id, name, power16, power8, power4, power2, power_bridge8, power_bridge4, validated, manual FROM __temp__amplifier');
        $this->addSql('DROP TABLE __temp__amplifier');
        $this->addSql('CREATE INDEX IDX_1E49E997A76ED395 ON amplifier (user_id)');
        $this->addSql('CREATE INDEX IDX_1E49E997A23B42D ON amplifier (manufacturer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__amplifier AS SELECT id, user_id, manufacturer_id, name, power16, power8, power4, power2, power_bridge8, power_bridge4, validated, manual FROM amplifier');
        $this->addSql('DROP TABLE amplifier');
        $this->addSql('CREATE TABLE amplifier (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, power16 INTEGER DEFAULT NULL, power8 INTEGER DEFAULT NULL, power4 INTEGER DEFAULT NULL, power2 INTEGER DEFAULT NULL, power_bridge8 INTEGER DEFAULT NULL, power_bridge4 INTEGER DEFAULT NULL, validated BOOLEAN DEFAULT NULL, manual VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_1E49E997A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1E49E997A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO amplifier (id, user_id, manufacturer_id, name, power16, power8, power4, power2, power_bridge8, power_bridge4, validated, manual) SELECT id, user_id, manufacturer_id, name, power16, power8, power4, power2, power_bridge8, power_bridge4, validated, manual FROM __temp__amplifier');
        $this->addSql('DROP TABLE __temp__amplifier');
        $this->addSql('CREATE INDEX IDX_1E49E997A76ED395 ON amplifier (user_id)');
        $this->addSql('CREATE INDEX IDX_1E49E997A23B42D ON amplifier (manufacturer_id)');
    }
}
