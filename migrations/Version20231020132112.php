<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231020132112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__limiter AS SELECT id, user_id, processor_id, amplifier_id, speaker_id, vrms, vpeak, vrms_value, vpeak_value, vrms_attack, vrms_release, vpeak_attack, vpeak_release, bridge_mode_enabled FROM limiter');
        $this->addSql('DROP TABLE limiter');
        $this->addSql('CREATE TABLE limiter (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, processor_id INTEGER NOT NULL, amplifier_id INTEGER NOT NULL, speaker_id INTEGER NOT NULL, vrms DOUBLE PRECISION NOT NULL, vpeak DOUBLE PRECISION NOT NULL, vrms_value DOUBLE PRECISION NOT NULL, vpeak_value DOUBLE PRECISION NOT NULL, vrms_attack VARCHAR(255) NOT NULL, vrms_release VARCHAR(255) NOT NULL, vpeak_attack VARCHAR(255) NOT NULL, vpeak_release VARCHAR(255) NOT NULL, bridge_mode_enabled BOOLEAN NOT NULL, input_sensitivity DOUBLE PRECISION NOT NULL DEFAULT(0.775), speakers_in_parallel INTEGER NOT NULL DEFAULT(1), scaling DOUBLE PRECISION NOT NULL DEFAULT(1.0), CONSTRAINT FK_2C74E376A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2C74E37637BAC19A FOREIGN KEY (processor_id) REFERENCES processor (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2C74E3761EA1DACA FOREIGN KEY (amplifier_id) REFERENCES amplifier (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2C74E376D04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO limiter (id, user_id, processor_id, amplifier_id, speaker_id, vrms, vpeak, vrms_value, vpeak_value, vrms_attack, vrms_release, vpeak_attack, vpeak_release, bridge_mode_enabled) SELECT id, user_id, processor_id, amplifier_id, speaker_id, vrms, vpeak, vrms_value, vpeak_value, vrms_attack, vrms_release, vpeak_attack, vpeak_release, bridge_mode_enabled FROM __temp__limiter');
        $this->addSql('DROP TABLE __temp__limiter');
        $this->addSql('CREATE INDEX IDX_2C74E376D04A0F27 ON limiter (speaker_id)');
        $this->addSql('CREATE INDEX IDX_2C74E3761EA1DACA ON limiter (amplifier_id)');
        $this->addSql('CREATE INDEX IDX_2C74E37637BAC19A ON limiter (processor_id)');
        $this->addSql('CREATE INDEX IDX_2C74E376A76ED395 ON limiter (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__limiter AS SELECT id, user_id, processor_id, amplifier_id, speaker_id, vrms, vpeak, vrms_value, vpeak_value, vrms_attack, vrms_release, vpeak_attack, vpeak_release, bridge_mode_enabled FROM limiter');
        $this->addSql('DROP TABLE limiter');
        $this->addSql('CREATE TABLE limiter (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, processor_id INTEGER NOT NULL, amplifier_id INTEGER NOT NULL, speaker_id INTEGER NOT NULL, vrms DOUBLE PRECISION NOT NULL, vpeak DOUBLE PRECISION NOT NULL, vrms_value DOUBLE PRECISION NOT NULL, vpeak_value DOUBLE PRECISION NOT NULL, vrms_attack VARCHAR(255) NOT NULL, vrms_release VARCHAR(255) NOT NULL, vpeak_attack VARCHAR(255) NOT NULL, vpeak_release VARCHAR(255) NOT NULL, bridge_mode_enabled BOOLEAN DEFAULT FALSE NOT NULL, CONSTRAINT FK_2C74E376A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2C74E37637BAC19A FOREIGN KEY (processor_id) REFERENCES processor (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2C74E3761EA1DACA FOREIGN KEY (amplifier_id) REFERENCES amplifier (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2C74E376D04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO limiter (id, user_id, processor_id, amplifier_id, speaker_id, vrms, vpeak, vrms_value, vpeak_value, vrms_attack, vrms_release, vpeak_attack, vpeak_release, bridge_mode_enabled) SELECT id, user_id, processor_id, amplifier_id, speaker_id, vrms, vpeak, vrms_value, vpeak_value, vrms_attack, vrms_release, vpeak_attack, vpeak_release, bridge_mode_enabled FROM __temp__limiter');
        $this->addSql('DROP TABLE __temp__limiter');
        $this->addSql('CREATE INDEX IDX_2C74E376A76ED395 ON limiter (user_id)');
        $this->addSql('CREATE INDEX IDX_2C74E37637BAC19A ON limiter (processor_id)');
        $this->addSql('CREATE INDEX IDX_2C74E3761EA1DACA ON limiter (amplifier_id)');
        $this->addSql('CREATE INDEX IDX_2C74E376D04A0F27 ON limiter (speaker_id)');
    }
}
