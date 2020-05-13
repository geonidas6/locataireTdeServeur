<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200510215133 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE evenement_audit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, object_id VARCHAR(255) NOT NULL, discriminator VARCHAR(255) DEFAULT NULL, transaction_hash VARCHAR(40) DEFAULT NULL, diffs JSON DEFAULT NULL, blame_id VARCHAR(255) DEFAULT NULL, blame_user VARCHAR(255) DEFAULT NULL, blame_user_fqdn VARCHAR(255) DEFAULT NULL, blame_user_firewall VARCHAR(100) DEFAULT NULL, ip VARCHAR(45) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX type_dbaa30077996693853517c2ad5c54ac3_idx (type), INDEX object_id_dbaa30077996693853517c2ad5c54ac3_idx (object_id), INDEX discriminator_dbaa30077996693853517c2ad5c54ac3_idx (discriminator), INDEX transaction_hash_dbaa30077996693853517c2ad5c54ac3_idx (transaction_hash), INDEX blame_id_dbaa30077996693853517c2ad5c54ac3_idx (blame_id), INDEX created_at_dbaa30077996693853517c2ad5c54ac3_idx (created_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_audit (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type VARCHAR(10) NOT NULL, object_id VARCHAR(255) NOT NULL, discriminator VARCHAR(255) DEFAULT NULL, transaction_hash VARCHAR(40) DEFAULT NULL, diffs JSON DEFAULT NULL, blame_id VARCHAR(255) DEFAULT NULL, blame_user VARCHAR(255) DEFAULT NULL, blame_user_fqdn VARCHAR(255) DEFAULT NULL, blame_user_firewall VARCHAR(100) DEFAULT NULL, ip VARCHAR(45) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX type_e06395edc291d0719bee26fd39a32e8a_idx (type), INDEX object_id_e06395edc291d0719bee26fd39a32e8a_idx (object_id), INDEX discriminator_e06395edc291d0719bee26fd39a32e8a_idx (discriminator), INDEX transaction_hash_e06395edc291d0719bee26fd39a32e8a_idx (transaction_hash), INDEX blame_id_e06395edc291d0719bee26fd39a32e8a_idx (blame_id), INDEX created_at_e06395edc291d0719bee26fd39a32e8a_idx (created_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidat CHANGE evenement_id evenement_id INT DEFAULT NULL, CHANGE prefeture prefeture VARCHAR(255) DEFAULT NULL, CHANGE diplome diplome VARCHAR(255) DEFAULT NULL, CHANGE jury jury VARCHAR(255) DEFAULT NULL, CHANGE filier_serie filier_serie VARCHAR(255) DEFAULT NULL, CHANGE matier_eliminer matier_eliminer VARCHAR(255) DEFAULT NULL, CHANGE amphi amphi VARCHAR(255) DEFAULT NULL, CHANGE numero_salle numero_salle VARCHAR(5) DEFAULT NULL, CHANGE semestre semestre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE media_object CHANGE user_id user_id INT DEFAULT NULL, CHANGE evenement_id evenement_id INT DEFAULT NULL, CHANGE file_path file_path VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE api_token api_token VARCHAR(255) DEFAULT NULL, CHANGE dialcode dialcode VARCHAR(255) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE profil profil VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE evenement_audit');
        $this->addSql('DROP TABLE user_audit');
        $this->addSql('ALTER TABLE candidat CHANGE evenement_id evenement_id INT DEFAULT NULL, CHANGE prefeture prefeture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE diplome diplome VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE jury jury VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE filier_serie filier_serie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE matier_eliminer matier_eliminer VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE amphi amphi VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE numero_salle numero_salle VARCHAR(5) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE semestre semestre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE evenement CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE media_object CHANGE user_id user_id INT DEFAULT NULL, CHANGE evenement_id evenement_id INT DEFAULT NULL, CHANGE file_path file_path VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE api_token api_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE dialcode dialcode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE profil profil VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
