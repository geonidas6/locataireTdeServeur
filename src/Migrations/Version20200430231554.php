<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200430231554 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, create_by_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, sexe VARCHAR(1) NOT NULL, prefeture VARCHAR(255) DEFAULT NULL, diplome VARCHAR(255) DEFAULT NULL, lieu_centre_concour VARCHAR(255) NOT NULL, etablissement_de_provenance VARCHAR(255) NOT NULL, jury VARCHAR(255) DEFAULT NULL, filier_serie VARCHAR(255) DEFAULT NULL, matier_eliminer VARCHAR(255) DEFAULT NULL, amphi VARCHAR(255) DEFAULT NULL, numero_salle VARCHAR(5) DEFAULT NULL, semestre VARCHAR(255) DEFAULT NULL, datecreation DATETIME NOT NULL, INDEX IDX_6AB5B4719E085865 (create_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, create_by_id INT DEFAULT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, datecreation DATETIME NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_B26681E9E085865 (create_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, evenement_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C53D045F5E237E06 (name), INDEX IDX_C53D045FFD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, api_token VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenoms VARCHAR(255) NOT NULL, username VARCHAR(50) NOT NULL, enabled TINYINT(1) NOT NULL, sexe VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, date_ajout DATETIME NOT NULL, dialcode VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, locked TINYINT(1) NOT NULL, profil VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6497BA2F5EB (api_token), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D6493DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B4719E085865 FOREIGN KEY (create_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E9E085865 FOREIGN KEY (create_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FFD02F13');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493DA5256D');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B4719E085865');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E9E085865');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE user');
    }
}
