<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231010145936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__setting AS SELECT id, user_id, database_enabled FROM setting');
        $this->addSql('DROP TABLE setting');
        $this->addSql('CREATE TABLE setting (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, setting_value BOOLEAN NOT NULL, setting_key VARCHAR(255) NOT NULL, CONSTRAINT FK_9F74B898A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO setting (id, user_id, setting_value) SELECT id, user_id, database_enabled FROM __temp__setting');
        $this->addSql('DROP TABLE __temp__setting');
        $this->addSql('CREATE INDEX IDX_9F74B898A76ED395 ON setting (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__setting AS SELECT id, user_id, setting_value FROM setting');
        $this->addSql('DROP TABLE setting');
        $this->addSql('CREATE TABLE setting (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, database_enabled BOOLEAN NOT NULL, CONSTRAINT FK_9F74B898A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO setting (id, user_id, database_enabled) SELECT id, user_id, setting_value FROM __temp__setting');
        $this->addSql('DROP TABLE __temp__setting');
        $this->addSql('CREATE INDEX IDX_9F74B898A76ED395 ON setting (user_id)');
    }
}
