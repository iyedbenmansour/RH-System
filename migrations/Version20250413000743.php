<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250413000743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Mise à jour des entités Reclamation et ReponseReclamation';
    }

    public function up(Schema $schema): void
    {
        // Modifications pour la table reclamations
        $this->addSql('ALTER TABLE reclamations CHANGE description description LONGTEXT NOT NULL, CHANGE date date DATETIME NOT NULL, CHANGE statue_of_reclamation statue_of_reclamation VARCHAR(50) DEFAULT "Not Treated" NOT NULL, CHANGE company_id company_id INT NOT NULL');
        
        // Modifications pour la table reponse_reclamations
        $this->addSql('ALTER TABLE reponse_reclamations CHANGE reponse reponse LONGTEXT NOT NULL, CHANGE date date DATETIME NOT NULL, CHANGE statue_of_reponse_reclamation statue_of_reponse_reclamation VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // Restauration des modifications pour la table reclamations
        $this->addSql('ALTER TABLE reclamations CHANGE company_id company_id INT DEFAULT NULL, CHANGE description description TEXT NOT NULL, CHANGE date date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE statue_of_reclamation statue_of_reclamation VARCHAR(50) DEFAULT "Not Treated"');
        
        // Restauration des modifications pour la table reponse_reclamations
        $this->addSql('ALTER TABLE reponse_reclamations CHANGE reponse reponse TEXT NOT NULL, CHANGE date date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE statue_of_reponse_reclamation statue_of_reponse_reclamation VARCHAR(50) DEFAULT "Not Treated"');
    }
}
