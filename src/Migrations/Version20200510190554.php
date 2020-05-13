<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200510190554 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B4719E085865');
        $this->addSql('DROP INDEX IDX_6AB5B4719E085865 ON candidat');
        $this->addSql('ALTER TABLE candidat DROP create_by_id, DROP datecreation, CHANGE evenement_id evenement_id INT DEFAULT NULL, CHANGE prefeture prefeture VARCHAR(255) DEFAULT NULL, CHANGE diplome diplome VARCHAR(255) DEFAULT NULL, CHANGE jury jury VARCHAR(255) DEFAULT NULL, CHANGE filier_serie filier_serie VARCHAR(255) DEFAULT NULL, CHANGE matier_eliminer matier_eliminer VARCHAR(255) DEFAULT NULL, CHANGE amphi amphi VARCHAR(255) DEFAULT NULL, CHANGE numero_salle numero_salle VARCHAR(5) DEFAULT NULL, CHANGE semestre semestre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E9E085865');
        $this->addSql('DROP INDEX IDX_B26681E9E085865 ON evenement');
        $this->addSql('ALTER TABLE evenement DROP create_by_id, DROP datecreation, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE media_object CHANGE user_id user_id INT DEFAULT NULL, CHANGE evenement_id evenement_id INT DEFAULT NULL, CHANGE file_path file_path VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE api_token api_token VARCHAR(255) DEFAULT NULL, CHANGE dialcode dialcode VARCHAR(255) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE profil profil VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE audit_associations CHANGE tbl tbl VARCHAR(128) DEFAULT NULL, CHANGE label label VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE audit_logs CHANGE target_id target_id INT DEFAULT NULL, CHANGE blame_id blame_id INT DEFAULT NULL, CHANGE diff diff JSON DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE audit_associations CHANGE tbl tbl VARCHAR(128) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE label label VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE audit_logs CHANGE target_id target_id INT DEFAULT NULL, CHANGE blame_id blame_id INT DEFAULT NULL, CHANGE diff diff LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE candidat ADD create_by_id INT DEFAULT NULL, ADD datecreation DATETIME NOT NULL, CHANGE evenement_id evenement_id INT DEFAULT NULL, CHANGE prefeture prefeture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE diplome diplome VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE jury jury VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE filier_serie filier_serie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE matier_eliminer matier_eliminer VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE amphi amphi VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE numero_salle numero_salle VARCHAR(5) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE semestre semestre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B4719E085865 FOREIGN KEY (create_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6AB5B4719E085865 ON candidat (create_by_id)');
        $this->addSql('ALTER TABLE evenement ADD create_by_id INT DEFAULT NULL, ADD datecreation DATETIME NOT NULL, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E9E085865 FOREIGN KEY (create_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B26681E9E085865 ON evenement (create_by_id)');
        $this->addSql('ALTER TABLE media_object CHANGE user_id user_id INT DEFAULT NULL, CHANGE evenement_id evenement_id INT DEFAULT NULL, CHANGE file_path file_path VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE api_token api_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE dialcode dialcode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE profil profil VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
