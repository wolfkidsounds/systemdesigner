<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204000311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE manufacturer ADD COLUMN category CLOB DEFAULT NULL');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, username, is_verified, subscriber, database_access_enabled, locale, beta FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, subscriber BOOLEAN NOT NULL, database_access_enabled BOOLEAN NOT NULL, locale VARCHAR(255) DEFAULT NULL, beta BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, username, is_verified, subscriber, database_access_enabled, locale, beta) SELECT id, email, roles, password, username, is_verified, subscriber, database_access_enabled, locale, beta FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__manufacturer AS SELECT id, user_id, name, validated FROM manufacturer');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('CREATE TABLE manufacturer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, validated BOOLEAN NOT NULL, CONSTRAINT FK_3D0AE6DCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO manufacturer (id, user_id, name, validated) SELECT id, user_id, name, validated FROM __temp__manufacturer');
        $this->addSql('DROP TABLE __temp__manufacturer');
        $this->addSql('CREATE INDEX IDX_3D0AE6DCA76ED395 ON manufacturer (user_id)');
        $this->addSql('ALTER TABLE user ADD COLUMN show_beta_features_enabled BOOLEAN NOT NULL');
    }
}
