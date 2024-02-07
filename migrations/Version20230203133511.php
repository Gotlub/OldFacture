<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230203133511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE piece DROP description, DROP identifiant_PES, DROP nom, DROP code_entite, DROP libelle_entite, DROP element_rattache, DROP exercice, DROP sens, DROP annulation_rejet, DROP bordereau_piece, DROP objet, DROP dossierpj');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE piece ADD description VARCHAR(500) NOT NULL, ADD identifiant_PES VARCHAR(100) NOT NULL, ADD nom VARCHAR(100) NOT NULL, ADD code_entite TEXT NOT NULL, ADD libelle_entite TEXT NOT NULL, ADD element_rattache TEXT NOT NULL, ADD exercice INT NOT NULL, ADD sens TEXT NOT NULL, ADD annulation_rejet TEXT NOT NULL, ADD bordereau_piece TEXT NOT NULL, ADD objet VARCHAR(500) NOT NULL, ADD dossierpj TINYINT(1) DEFAULT NULL');
    }
}
