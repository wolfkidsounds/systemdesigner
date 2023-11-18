<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231118152725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE amplifier (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, validated BOOLEAN NOT NULL, power16 INTEGER DEFAULT NULL, power8 INTEGER DEFAULT NULL, power4 INTEGER DEFAULT NULL, power2 INTEGER DEFAULT NULL, power_bridge8 INTEGER DEFAULT NULL, power_bridge4 INTEGER DEFAULT NULL, manual VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_1E49E997A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1E49E997A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_1E49E997A76ED395 ON amplifier (user_id)');
        $this->addSql('CREATE INDEX IDX_1E49E997A23B42D ON amplifier (manufacturer_id)');
        $this->addSql('CREATE TABLE chassis (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, validated BOOLEAN NOT NULL, resonance_frequency DOUBLE PRECISION NOT NULL, compliance DOUBLE PRECISION NOT NULL, moving_mass DOUBLE PRECISION NOT NULL, mechanical_grade DOUBLE PRECISION NOT NULL, electrical_grade DOUBLE PRECISION NOT NULL, total_grade DOUBLE PRECISION NOT NULL, equivalent_volume DOUBLE PRECISION NOT NULL, resistance_dc DOUBLE PRECISION NOT NULL, force_factor DOUBLE PRECISION NOT NULL, voice_coil_inductance DOUBLE PRECISION NOT NULL, linear_displacement DOUBLE PRECISION NOT NULL, effective_piston_area DOUBLE PRECISION NOT NULL, net_weight DOUBLE PRECISION DEFAULT NULL, nominal_impedance INTEGER NOT NULL, power_rms INTEGER NOT NULL, sensitivity DOUBLE PRECISION NOT NULL, winding_material VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_35C973DFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_35C973DFA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_35C973DFA76ED395 ON chassis (user_id)');
        $this->addSql('CREATE INDEX IDX_35C973DFA23B42D ON chassis (manufacturer_id)');
        $this->addSql('CREATE TABLE limiter (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, processor_id INTEGER NOT NULL, amplifier_id INTEGER NOT NULL, speaker_id INTEGER NOT NULL, vrms DOUBLE PRECISION NOT NULL, vpeak DOUBLE PRECISION NOT NULL, vrms_value DOUBLE PRECISION NOT NULL, vpeak_value DOUBLE PRECISION NOT NULL, vrms_attack VARCHAR(255) NOT NULL, vrms_release VARCHAR(255) NOT NULL, vpeak_attack VARCHAR(255) NOT NULL, vpeak_release VARCHAR(255) NOT NULL, bridge_mode_enabled BOOLEAN NOT NULL, input_sensitivity DOUBLE PRECISION NOT NULL, speakers_in_parallel INTEGER NOT NULL, scaling DOUBLE PRECISION NOT NULL, algorithm VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_2C74E376A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2C74E37637BAC19A FOREIGN KEY (processor_id) REFERENCES processor (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2C74E3761EA1DACA FOREIGN KEY (amplifier_id) REFERENCES amplifier (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2C74E376D04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2C74E376A76ED395 ON limiter (user_id)');
        $this->addSql('CREATE INDEX IDX_2C74E37637BAC19A ON limiter (processor_id)');
        $this->addSql('CREATE INDEX IDX_2C74E3761EA1DACA ON limiter (amplifier_id)');
        $this->addSql('CREATE INDEX IDX_2C74E376D04A0F27 ON limiter (speaker_id)');
        $this->addSql('CREATE TABLE manufacturer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, validated BOOLEAN NOT NULL, CONSTRAINT FK_3D0AE6DCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_3D0AE6DCA76ED395 ON manufacturer (user_id)');
        $this->addSql('CREATE TABLE notification (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, message CLOB NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE TABLE notification_user (notification_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(notification_id, user_id), CONSTRAINT FK_35AF9D73EF1A9D84 FOREIGN KEY (notification_id) REFERENCES notification (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_35AF9D73A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_35AF9D73EF1A9D84 ON notification_user (notification_id)');
        $this->addSql('CREATE INDEX IDX_35AF9D73A76ED395 ON notification_user (user_id)');
        $this->addSql('CREATE TABLE processor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, validated BOOLEAN NOT NULL, channels_input INTEGER NOT NULL, channels_output INTEGER NOT NULL, output_offset INTEGER NOT NULL, manual VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_29C04650A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_29C04650A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_29C04650A76ED395 ON processor (user_id)');
        $this->addSql('CREATE INDEX IDX_29C04650A23B42D ON processor (manufacturer_id)');
        $this->addSql('CREATE TABLE speaker (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, manufacturer_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, validated BOOLEAN NOT NULL, power_rms INTEGER NOT NULL, power_peak INTEGER DEFAULT NULL, impedance INTEGER NOT NULL, spl DOUBLE PRECISION DEFAULT NULL, manual VARCHAR(255) DEFAULT NULL, bandwidth VARCHAR(255) NOT NULL, CONSTRAINT FK_7B85DB61A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7B85DB61A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_7B85DB61A76ED395 ON speaker (user_id)');
        $this->addSql('CREATE INDEX IDX_7B85DB61A23B42D ON speaker (manufacturer_id)');
        $this->addSql('CREATE TABLE speaker_chassis (speaker_id INTEGER NOT NULL, chassis_id INTEGER NOT NULL, PRIMARY KEY(speaker_id, chassis_id), CONSTRAINT FK_347B318DD04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_347B318D63EE729 FOREIGN KEY (chassis_id) REFERENCES chassis (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_347B318DD04A0F27 ON speaker_chassis (speaker_id)');
        $this->addSql('CREATE INDEX IDX_347B318D63EE729 ON speaker_chassis (chassis_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, subscriber BOOLEAN NOT NULL, beta_access_enabled BOOLEAN NOT NULL, database_access_enabled BOOLEAN NOT NULL, show_beta_features_enabled BOOLEAN NOT NULL, locale VARCHAR(255) DEFAULT NULL, beta BOOLEAN NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE validation_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, manufacturer_id INTEGER DEFAULT NULL, processor_id INTEGER DEFAULT NULL, amplifier_id INTEGER DEFAULT NULL, speaker_id INTEGER DEFAULT NULL, chassis_id INTEGER DEFAULT NULL, user_id INTEGER NOT NULL, message CLOB DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_2A12D291A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2A12D29137BAC19A FOREIGN KEY (processor_id) REFERENCES processor (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2A12D2911EA1DACA FOREIGN KEY (amplifier_id) REFERENCES amplifier (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2A12D291D04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2A12D29163EE729 FOREIGN KEY (chassis_id) REFERENCES chassis (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2A12D291A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2A12D291A23B42D ON validation_request (manufacturer_id)');
        $this->addSql('CREATE INDEX IDX_2A12D29137BAC19A ON validation_request (processor_id)');
        $this->addSql('CREATE INDEX IDX_2A12D2911EA1DACA ON validation_request (amplifier_id)');
        $this->addSql('CREATE INDEX IDX_2A12D291D04A0F27 ON validation_request (speaker_id)');
        $this->addSql('CREATE INDEX IDX_2A12D29163EE729 ON validation_request (chassis_id)');
        $this->addSql('CREATE INDEX IDX_2A12D291A76ED395 ON validation_request (user_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE amplifier');
        $this->addSql('DROP TABLE chassis');
        $this->addSql('DROP TABLE limiter');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE notification_user');
        $this->addSql('DROP TABLE processor');
        $this->addSql('DROP TABLE speaker');
        $this->addSql('DROP TABLE speaker_chassis');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE validation_request');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
