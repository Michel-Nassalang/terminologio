<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221135227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE composant (id INT AUTO_INCREMENT NOT NULL, illus_id_id INT NOT NULL, label VARCHAR(100) NOT NULL, adressex DOUBLE PRECISION NOT NULL, adressey DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_EC8486C94C1C0935 (illus_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE illustration (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, defaultlang VARCHAR(100) NOT NULL, imgsrc VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, pseudo VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_F6B4FB29E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traduction (id INT AUTO_INCREMENT NOT NULL, labelorig_id INT DEFAULT NULL, composant_id_id INT NOT NULL, labeltrad VARCHAR(100) NOT NULL, descriptiontrad LONGTEXT DEFAULT NULL, INDEX IDX_CF8C03A813B25D2E (labelorig_id), INDEX IDX_CF8C03A83FFE702D (composant_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C94C1C0935 FOREIGN KEY (illus_id_id) REFERENCES illustration (id)');
        $this->addSql('ALTER TABLE traduction ADD CONSTRAINT FK_CF8C03A813B25D2E FOREIGN KEY (labelorig_id) REFERENCES composant (id)');
        $this->addSql('ALTER TABLE traduction ADD CONSTRAINT FK_CF8C03A83FFE702D FOREIGN KEY (composant_id_id) REFERENCES composant (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C94C1C0935');
        $this->addSql('ALTER TABLE traduction DROP FOREIGN KEY FK_CF8C03A813B25D2E');
        $this->addSql('ALTER TABLE traduction DROP FOREIGN KEY FK_CF8C03A83FFE702D');
        $this->addSql('DROP TABLE composant');
        $this->addSql('DROP TABLE illustration');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE traduction');
    }
}
