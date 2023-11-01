<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231101123112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD COLUMN beta BOOLEAN NOT NULL DEFAULT(false)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__validation_request AS SELECT id, manufacturer_id, processor_id, speaker_id, chassis_id, user_id, amplifier_id, message, status FROM validation_request');
        $this->addSql('DROP TABLE validation_request');
        $this->addSql('CREATE TABLE validation_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, manufacturer_id INTEGER DEFAULT NULL, processor_id INTEGER DEFAULT NULL, speaker_id INTEGER DEFAULT NULL, chassis_id INTEGER DEFAULT NULL, user_id INTEGER NOT NULL, amplifier_id INTEGER DEFAULT NULL, message CLOB DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_2A12D291A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2A12D29137BAC19A FOREIGN KEY (processor_id) REFERENCES processor (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2A12D291D04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2A12D29163EE729 FOREIGN KEY (chassis_id) REFERENCES chassis (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2A12D291A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2A12D2911EA1DACA FOREIGN KEY (amplifier_id) REFERENCES amplifier (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO validation_request (id, manufacturer_id, processor_id, speaker_id, chassis_id, user_id, amplifier_id, message, status) SELECT id, manufacturer_id, processor_id, speaker_id, chassis_id, user_id, amplifier_id, message, status FROM __temp__validation_request');
        $this->addSql('DROP TABLE __temp__validation_request');
        $this->addSql('CREATE INDEX IDX_2A12D2911EA1DACA ON validation_request (amplifier_id)');
        $this->addSql('CREATE INDEX IDX_2A12D29163EE729 ON validation_request (chassis_id)');
        $this->addSql('CREATE INDEX IDX_2A12D291D04A0F27 ON validation_request (speaker_id)');
        $this->addSql('CREATE INDEX IDX_2A12D29137BAC19A ON validation_request (processor_id)');
        $this->addSql('CREATE INDEX IDX_2A12D291A23B42D ON validation_request (manufacturer_id)');
        $this->addSql('CREATE INDEX IDX_2A12D291A76ED395 ON validation_request (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, username, is_verified, subscriber, beta_access_enabled, database_access_enabled, show_beta_features_enabled, locale FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, subscriber BOOLEAN NOT NULL, beta_access_enabled BOOLEAN NOT NULL, database_access_enabled BOOLEAN NOT NULL, show_beta_features_enabled BOOLEAN NOT NULL, locale VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, username, is_verified, subscriber, beta_access_enabled, database_access_enabled, show_beta_features_enabled, locale) SELECT id, email, roles, password, username, is_verified, subscriber, beta_access_enabled, database_access_enabled, show_beta_features_enabled, locale FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('ALTER TABLE validation_request ADD COLUMN type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE validation_request ADD COLUMN object VARCHAR(255) DEFAULT NULL');
    }
}
