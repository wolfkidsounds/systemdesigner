<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231022133823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chassis (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, validated BOOLEAN NOT NULL, CONSTRAINT FK_35C973DFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_35C973DFA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_35C973DFA76ED395 ON chassis (user_id)');
        $this->addSql('CREATE INDEX IDX_35C973DFA23B42D ON chassis (manufacturer_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, username, is_verified, subscriber, locale, database_access_enabled, beta_access_enabled, show_beta_features_enabled FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, subscriber BOOLEAN NOT NULL, locale VARCHAR(255) DEFAULT NULL, database_access_enabled BOOLEAN NOT NULL, beta_access_enabled BOOLEAN NOT NULL, show_beta_features_enabled BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, username, is_verified, subscriber, locale, database_access_enabled, beta_access_enabled, show_beta_features_enabled) SELECT id, email, roles, password, username, is_verified, subscriber, locale, database_access_enabled, beta_access_enabled, show_beta_features_enabled FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE chassis');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, username, is_verified, subscriber, beta_access_enabled, database_access_enabled, show_beta_features_enabled, locale FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, subscriber BOOLEAN NOT NULL, beta_access_enabled BOOLEAN DEFAULT false NOT NULL, database_access_enabled BOOLEAN DEFAULT false NOT NULL, show_beta_features_enabled BOOLEAN DEFAULT false NOT NULL, locale VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, username, is_verified, subscriber, beta_access_enabled, database_access_enabled, show_beta_features_enabled, locale) SELECT id, email, roles, password, username, is_verified, subscriber, beta_access_enabled, database_access_enabled, show_beta_features_enabled, locale FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
