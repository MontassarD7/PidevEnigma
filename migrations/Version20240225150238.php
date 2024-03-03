<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240225150238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, panier_id INT DEFAULT NULL, user_id INT DEFAULT NULL, sent TINYINT(1) DEFAULT NULL, totale INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_6EEAA67DF77D927C (panier_id), INDEX IDX_6EEAA67DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, telephone INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, totale INT NOT NULL, ref_commande INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_EDBFD5ECA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, idmoyentransport_id INT DEFAULT NULL, id_livreur_id INT DEFAULT NULL, id_article_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_A60C9F1F3BCD3240 (idmoyentransport_id), UNIQUE INDEX UNIQ_A60C9F1F5DEEE7D6 (id_livreur_id), UNIQUE INDEX UNIQ_A60C9F1FD71E064B (id_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_24CC0DF27E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorys_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, quantite INT NOT NULL, prix DOUBLE PRECISION NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_29A5EC27A96778EC (categorys_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_panier (produit_id INT NOT NULL, panier_id INT NOT NULL, INDEX IDX_D39EC6C8F347EFB (produit_id), INDEX IDX_D39EC6C8F77D927C (panier_id), PRIMARY KEY(produit_id, panier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) DEFAULT NULL, date_r DATE DEFAULT NULL, description_r VARCHAR(255) DEFAULT NULL, status_r VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, idrec_id INT DEFAULT NULL, reponse VARCHAR(255) DEFAULT NULL, INDEX IDX_5FB6DEC772D41C37 (idrec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, nom_produit VARCHAR(255) DEFAULT NULL, quantite_entre INT DEFAULT NULL, quantite_sortie INT DEFAULT NULL, quantite_restante INT DEFAULT NULL, date DATE DEFAULT NULL, INDEX IDX_4B365660670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, panier_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, prename VARCHAR(255) NOT NULL, birthday DATE NOT NULL, adress VARCHAR(255) NOT NULL, phone INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F77D927C (panier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F3BCD3240 FOREIGN KEY (idmoyentransport_id) REFERENCES transport (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F5DEEE7D6 FOREIGN KEY (id_livreur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FD71E064B FOREIGN KEY (id_article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF27E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A96778EC FOREIGN KEY (categorys_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE produit_panier ADD CONSTRAINT FK_D39EC6C8F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_panier ADD CONSTRAINT FK_D39EC6C8F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC772D41C37 FOREIGN KEY (idrec_id) REFERENCES reclamation (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF77D927C');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECA76ED395');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F3BCD3240');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F5DEEE7D6');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FD71E064B');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF27E3C61F9');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A96778EC');
        $this->addSql('ALTER TABLE produit_panier DROP FOREIGN KEY FK_D39EC6C8F347EFB');
        $this->addSql('ALTER TABLE produit_panier DROP FOREIGN KEY FK_D39EC6C8F77D927C');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC772D41C37');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660670C757F');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F77D927C');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_panier');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE user');
    }
}
