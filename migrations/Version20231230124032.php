<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231230124032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(100) NOT NULL, domaine VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE traduction DROP FOREIGN KEY FK_CF8C03A813B25D2E');
        $this->addSql('ALTER TABLE traduction DROP FOREIGN KEY FK_CF8C03A83FFE702D');
        $this->addSql('DROP INDEX IDX_CF8C03A813B25D2E ON traduction');
        $this->addSql('DROP INDEX IDX_CF8C03A83FFE702D ON traduction');
        $this->addSql('ALTER TABLE traduction ADD lang VARCHAR(50) NOT NULL, CHANGE labelorig_id composant_id INT DEFAULT NULL, CHANGE composant_id_id illustration_id INT NOT NULL');
        $this->addSql('ALTER TABLE traduction ADD CONSTRAINT FK_CF8C03A87F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id)');
        $this->addSql('ALTER TABLE traduction ADD CONSTRAINT FK_CF8C03A85926566C FOREIGN KEY (illustration_id) REFERENCES illustration (id)');
        $this->addSql('CREATE INDEX IDX_CF8C03A87F3310E7 ON traduction (composant_id)');
        $this->addSql('CREATE INDEX IDX_CF8C03A85926566C ON traduction (illustration_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE theme');
        $this->addSql('ALTER TABLE traduction DROP FOREIGN KEY FK_CF8C03A87F3310E7');
        $this->addSql('ALTER TABLE traduction DROP FOREIGN KEY FK_CF8C03A85926566C');
        $this->addSql('DROP INDEX IDX_CF8C03A87F3310E7 ON traduction');
        $this->addSql('DROP INDEX IDX_CF8C03A85926566C ON traduction');
        $this->addSql('ALTER TABLE traduction DROP lang, CHANGE composant_id labelorig_id INT DEFAULT NULL, CHANGE illustration_id composant_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE traduction ADD CONSTRAINT FK_CF8C03A813B25D2E FOREIGN KEY (labelorig_id) REFERENCES composant (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE traduction ADD CONSTRAINT FK_CF8C03A83FFE702D FOREIGN KEY (composant_id_id) REFERENCES composant (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_CF8C03A813B25D2E ON traduction (labelorig_id)');
        $this->addSql('CREATE INDEX IDX_CF8C03A83FFE702D ON traduction (composant_id_id)');
    }
}
