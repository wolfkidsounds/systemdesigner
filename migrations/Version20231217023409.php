<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231217023409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE amplifier (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, manufacturer_id INT NOT NULL, name VARCHAR(255) NOT NULL, validated TINYINT(1) NOT NULL, power16 INT DEFAULT NULL, power8 INT DEFAULT NULL, power4 INT DEFAULT NULL, power2 INT DEFAULT NULL, power_bridge8 INT DEFAULT NULL, power_bridge4 INT DEFAULT NULL, manual VARCHAR(255) DEFAULT NULL, INDEX IDX_1E49E997A76ED395 (user_id), INDEX IDX_1E49E997A23B42D (manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chassis (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, manufacturer_id INT NOT NULL, name VARCHAR(255) NOT NULL, validated TINYINT(1) NOT NULL, resonance_frequency DOUBLE PRECISION NOT NULL, compliance DOUBLE PRECISION NOT NULL, moving_mass DOUBLE PRECISION NOT NULL, mechanical_grade DOUBLE PRECISION NOT NULL, electrical_grade DOUBLE PRECISION NOT NULL, total_grade DOUBLE PRECISION NOT NULL, equivalent_volume DOUBLE PRECISION NOT NULL, resistance_dc DOUBLE PRECISION NOT NULL, force_factor DOUBLE PRECISION NOT NULL, voice_coil_inductance DOUBLE PRECISION NOT NULL, linear_displacement DOUBLE PRECISION NOT NULL, effective_piston_area DOUBLE PRECISION NOT NULL, net_weight DOUBLE PRECISION DEFAULT NULL, nominal_impedance INT NOT NULL, power_rms INT NOT NULL, sensitivity DOUBLE PRECISION NOT NULL, winding_material VARCHAR(255) DEFAULT NULL, INDEX IDX_35C973DFA76ED395 (user_id), INDEX IDX_35C973DFA23B42D (manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faq (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE limiter (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, processor_id INT NOT NULL, amplifier_id INT NOT NULL, speaker_id INT NOT NULL, vrms DOUBLE PRECISION NOT NULL, vpeak DOUBLE PRECISION NOT NULL, vrms_value DOUBLE PRECISION NOT NULL, vpeak_value DOUBLE PRECISION NOT NULL, vrms_attack VARCHAR(255) NOT NULL, vrms_release VARCHAR(255) NOT NULL, vpeak_attack VARCHAR(255) NOT NULL, vpeak_release VARCHAR(255) NOT NULL, bridge_mode_enabled TINYINT(1) NOT NULL, input_sensitivity DOUBLE PRECISION NOT NULL, speakers_in_parallel INT NOT NULL, scaling DOUBLE PRECISION NOT NULL, algorithm VARCHAR(255) DEFAULT NULL, INDEX IDX_2C74E376A76ED395 (user_id), INDEX IDX_2C74E37637BAC19A (processor_id), INDEX IDX_2C74E3761EA1DACA (amplifier_id), INDEX IDX_2C74E376D04A0F27 (speaker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manufacturer (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, validated TINYINT(1) NOT NULL, INDEX IDX_3D0AE6DCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification_user (notification_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_35AF9D73EF1A9D84 (notification_id), INDEX IDX_35AF9D73A76ED395 (user_id), PRIMARY KEY(notification_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE processor (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, manufacturer_id INT NOT NULL, name VARCHAR(255) NOT NULL, validated TINYINT(1) NOT NULL, channels_input INT NOT NULL, channels_output INT NOT NULL, output_offset INT NOT NULL, manual VARCHAR(255) DEFAULT NULL, INDEX IDX_29C04650A76ED395 (user_id), INDEX IDX_29C04650A23B42D (manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE speaker (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, manufacturer_id INT NOT NULL, name VARCHAR(255) NOT NULL, validated TINYINT(1) NOT NULL, power_rms INT NOT NULL, power_peak INT DEFAULT NULL, impedance INT NOT NULL, spl DOUBLE PRECISION DEFAULT NULL, manual VARCHAR(255) DEFAULT NULL, bandwidth VARCHAR(255) NOT NULL, INDEX IDX_7B85DB61A76ED395 (user_id), INDEX IDX_7B85DB61A23B42D (manufacturer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE speaker_chassis (speaker_id INT NOT NULL, chassis_id INT NOT NULL, INDEX IDX_347B318DD04A0F27 (speaker_id), INDEX IDX_347B318D63EE729 (chassis_id), PRIMARY KEY(speaker_id, chassis_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `update` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, subscriber TINYINT(1) NOT NULL, beta TINYINT(1) NOT NULL, database_access_enabled TINYINT(1) NOT NULL, locale VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE validation_request (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT DEFAULT NULL, processor_id INT DEFAULT NULL, amplifier_id INT DEFAULT NULL, speaker_id INT DEFAULT NULL, chassis_id INT DEFAULT NULL, user_id INT NOT NULL, message LONGTEXT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_2A12D291A23B42D (manufacturer_id), INDEX IDX_2A12D29137BAC19A (processor_id), INDEX IDX_2A12D2911EA1DACA (amplifier_id), INDEX IDX_2A12D291D04A0F27 (speaker_id), INDEX IDX_2A12D29163EE729 (chassis_id), INDEX IDX_2A12D291A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amplifier ADD CONSTRAINT FK_1E49E997A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE amplifier ADD CONSTRAINT FK_1E49E997A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id)');
        $this->addSql('ALTER TABLE chassis ADD CONSTRAINT FK_35C973DFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE chassis ADD CONSTRAINT FK_35C973DFA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id)');
        $this->addSql('ALTER TABLE limiter ADD CONSTRAINT FK_2C74E376A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE limiter ADD CONSTRAINT FK_2C74E37637BAC19A FOREIGN KEY (processor_id) REFERENCES processor (id)');
        $this->addSql('ALTER TABLE limiter ADD CONSTRAINT FK_2C74E3761EA1DACA FOREIGN KEY (amplifier_id) REFERENCES amplifier (id)');
        $this->addSql('ALTER TABLE limiter ADD CONSTRAINT FK_2C74E376D04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id)');
        $this->addSql('ALTER TABLE manufacturer ADD CONSTRAINT FK_3D0AE6DCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE notification_user ADD CONSTRAINT FK_35AF9D73EF1A9D84 FOREIGN KEY (notification_id) REFERENCES notification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notification_user ADD CONSTRAINT FK_35AF9D73A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE processor ADD CONSTRAINT FK_29C04650A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE processor ADD CONSTRAINT FK_29C04650A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id)');
        $this->addSql('ALTER TABLE speaker ADD CONSTRAINT FK_7B85DB61A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE speaker ADD CONSTRAINT FK_7B85DB61A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id)');
        $this->addSql('ALTER TABLE speaker_chassis ADD CONSTRAINT FK_347B318DD04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE speaker_chassis ADD CONSTRAINT FK_347B318D63EE729 FOREIGN KEY (chassis_id) REFERENCES chassis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE validation_request ADD CONSTRAINT FK_2A12D291A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id)');
        $this->addSql('ALTER TABLE validation_request ADD CONSTRAINT FK_2A12D29137BAC19A FOREIGN KEY (processor_id) REFERENCES processor (id)');
        $this->addSql('ALTER TABLE validation_request ADD CONSTRAINT FK_2A12D2911EA1DACA FOREIGN KEY (amplifier_id) REFERENCES amplifier (id)');
        $this->addSql('ALTER TABLE validation_request ADD CONSTRAINT FK_2A12D291D04A0F27 FOREIGN KEY (speaker_id) REFERENCES speaker (id)');
        $this->addSql('ALTER TABLE validation_request ADD CONSTRAINT FK_2A12D29163EE729 FOREIGN KEY (chassis_id) REFERENCES chassis (id)');
        $this->addSql('ALTER TABLE validation_request ADD CONSTRAINT FK_2A12D291A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE amplifier DROP FOREIGN KEY FK_1E49E997A76ED395');
        $this->addSql('ALTER TABLE amplifier DROP FOREIGN KEY FK_1E49E997A23B42D');
        $this->addSql('ALTER TABLE chassis DROP FOREIGN KEY FK_35C973DFA76ED395');
        $this->addSql('ALTER TABLE chassis DROP FOREIGN KEY FK_35C973DFA23B42D');
        $this->addSql('ALTER TABLE limiter DROP FOREIGN KEY FK_2C74E376A76ED395');
        $this->addSql('ALTER TABLE limiter DROP FOREIGN KEY FK_2C74E37637BAC19A');
        $this->addSql('ALTER TABLE limiter DROP FOREIGN KEY FK_2C74E3761EA1DACA');
        $this->addSql('ALTER TABLE limiter DROP FOREIGN KEY FK_2C74E376D04A0F27');
        $this->addSql('ALTER TABLE manufacturer DROP FOREIGN KEY FK_3D0AE6DCA76ED395');
        $this->addSql('ALTER TABLE notification_user DROP FOREIGN KEY FK_35AF9D73EF1A9D84');
        $this->addSql('ALTER TABLE notification_user DROP FOREIGN KEY FK_35AF9D73A76ED395');
        $this->addSql('ALTER TABLE processor DROP FOREIGN KEY FK_29C04650A76ED395');
        $this->addSql('ALTER TABLE processor DROP FOREIGN KEY FK_29C04650A23B42D');
        $this->addSql('ALTER TABLE speaker DROP FOREIGN KEY FK_7B85DB61A76ED395');
        $this->addSql('ALTER TABLE speaker DROP FOREIGN KEY FK_7B85DB61A23B42D');
        $this->addSql('ALTER TABLE speaker_chassis DROP FOREIGN KEY FK_347B318DD04A0F27');
        $this->addSql('ALTER TABLE speaker_chassis DROP FOREIGN KEY FK_347B318D63EE729');
        $this->addSql('ALTER TABLE validation_request DROP FOREIGN KEY FK_2A12D291A23B42D');
        $this->addSql('ALTER TABLE validation_request DROP FOREIGN KEY FK_2A12D29137BAC19A');
        $this->addSql('ALTER TABLE validation_request DROP FOREIGN KEY FK_2A12D2911EA1DACA');
        $this->addSql('ALTER TABLE validation_request DROP FOREIGN KEY FK_2A12D291D04A0F27');
        $this->addSql('ALTER TABLE validation_request DROP FOREIGN KEY FK_2A12D29163EE729');
        $this->addSql('ALTER TABLE validation_request DROP FOREIGN KEY FK_2A12D291A76ED395');
        $this->addSql('DROP TABLE amplifier');
        $this->addSql('DROP TABLE chassis');
        $this->addSql('DROP TABLE faq');
        $this->addSql('DROP TABLE limiter');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE notification_user');
        $this->addSql('DROP TABLE processor');
        $this->addSql('DROP TABLE speaker');
        $this->addSql('DROP TABLE speaker_chassis');
        $this->addSql('DROP TABLE `update`');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE validation_request');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
