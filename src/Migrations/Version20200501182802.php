<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501182802 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE image');
        $this->addSql('ALTER TABLE candidat CHANGE create_by_id create_by_id INT DEFAULT NULL, CHANGE prefeture prefeture VARCHAR(255) DEFAULT NULL, CHANGE diplome diplome VARCHAR(255) DEFAULT NULL, CHANGE jury jury VARCHAR(255) DEFAULT NULL, CHANGE filier_serie filier_serie VARCHAR(255) DEFAULT NULL, CHANGE matier_eliminer matier_eliminer VARCHAR(255) DEFAULT NULL, CHANGE amphi amphi VARCHAR(255) DEFAULT NULL, CHANGE numero_salle numero_salle VARCHAR(5) DEFAULT NULL, CHANGE semestre semestre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE create_by_id create_by_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE media_object ADD user_id INT DEFAULT NULL, ADD evenement_id INT DEFAULT NULL, CHANGE file_path file_path VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE media_object ADD CONSTRAINT FK_14D43132A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE media_object ADD CONSTRAINT FK_14D43132FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_14D43132A76ED395 ON media_object (user_id)');
        $this->addSql('CREATE INDEX IDX_14D43132FD02F13 ON media_object (evenement_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493DA5256D');
        $this->addSql('DROP INDEX IDX_8D93D6493DA5256D ON user');
        $this->addSql('ALTER TABLE user DROP image_id, CHANGE roles roles JSON NOT NULL, CHANGE api_token api_token VARCHAR(255) DEFAULT NULL, CHANGE dialcode dialcode VARCHAR(255) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE profil profil VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_C53D045F5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE candidat CHANGE create_by_id create_by_id INT DEFAULT NULL, CHANGE prefeture prefeture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE diplome diplome VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE jury jury VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE filier_serie filier_serie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE matier_eliminer matier_eliminer VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE amphi amphi VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE numero_salle numero_salle VARCHAR(5) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE semestre semestre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE evenement CHANGE create_by_id create_by_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE media_object DROP FOREIGN KEY FK_14D43132A76ED395');
        $this->addSql('ALTER TABLE media_object DROP FOREIGN KEY FK_14D43132FD02F13');
        $this->addSql('DROP INDEX IDX_14D43132A76ED395 ON media_object');
        $this->addSql('DROP INDEX IDX_14D43132FD02F13 ON media_object');
        $this->addSql('ALTER TABLE media_object DROP user_id, DROP evenement_id, CHANGE file_path file_path VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user ADD image_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE api_token api_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE dialcode dialcode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE profil profil VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493DA5256D FOREIGN KEY (image_id) REFERENCES media_object (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6493DA5256D ON user (image_id)');
    }
}
