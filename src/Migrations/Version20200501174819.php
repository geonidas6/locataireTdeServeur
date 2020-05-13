<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501174819 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE media_object (id INT AUTO_INCREMENT NOT NULL, file_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidat CHANGE create_by_id create_by_id INT DEFAULT NULL, CHANGE prefeture prefeture VARCHAR(255) DEFAULT NULL, CHANGE diplome diplome VARCHAR(255) DEFAULT NULL, CHANGE jury jury VARCHAR(255) DEFAULT NULL, CHANGE filier_serie filier_serie VARCHAR(255) DEFAULT NULL, CHANGE matier_eliminer matier_eliminer VARCHAR(255) DEFAULT NULL, CHANGE amphi amphi VARCHAR(255) DEFAULT NULL, CHANGE numero_salle numero_salle VARCHAR(5) DEFAULT NULL, CHANGE semestre semestre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement CHANGE create_by_id create_by_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FFD02F13');
        $this->addSql('DROP INDEX IDX_C53D045FFD02F13 ON image');
        $this->addSql('ALTER TABLE image DROP evenement_id');
        $this->addSql('ALTER TABLE user DROP INDEX UNIQ_8D93D6493DA5256D, ADD INDEX IDX_8D93D6493DA5256D (image_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493DA5256D');
        $this->addSql('ALTER TABLE user CHANGE image_id image_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL, CHANGE api_token api_token VARCHAR(255) DEFAULT NULL, CHANGE dialcode dialcode VARCHAR(255) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE profil profil VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493DA5256D FOREIGN KEY (image_id) REFERENCES media_object (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493DA5256D');
        $this->addSql('DROP TABLE media_object');
        $this->addSql('ALTER TABLE candidat CHANGE create_by_id create_by_id INT DEFAULT NULL, CHANGE prefeture prefeture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE diplome diplome VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE jury jury VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE filier_serie filier_serie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE matier_eliminer matier_eliminer VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE amphi amphi VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE numero_salle numero_salle VARCHAR(5) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE semestre semestre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE evenement CHANGE create_by_id create_by_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE image ADD evenement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FFD02F13 ON image (evenement_id)');
        $this->addSql('ALTER TABLE user DROP INDEX IDX_8D93D6493DA5256D, ADD UNIQUE INDEX UNIQ_8D93D6493DA5256D (image_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493DA5256D');
        $this->addSql('ALTER TABLE user CHANGE image_id image_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE api_token api_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE dialcode dialcode VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE profil profil VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
    }
}
