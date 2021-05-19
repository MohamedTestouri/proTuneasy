<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518154535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, INDEX IDX_C35F0816A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carrier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competition (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, nombre_de_place INT DEFAULT NULL, image LONGTEXT DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id_evenement INT AUTO_INCREMENT NOT NULL, id_organisateur INT NOT NULL, titre VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, heure VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, approuver TINYINT(1) NOT NULL, nombre_vus INT NOT NULL, nombre_participants INT NOT NULL, nombre_max INT NOT NULL, PRIMARY KEY(id_evenement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location_materiel (id INT AUTO_INCREMENT NOT NULL, total_location DOUBLE PRECISION NOT NULL, duree_location INT NOT NULL, date_debut_location DATE NOT NULL, date_fin_location DATE NOT NULL, adresse_locataire_location VARCHAR(255) NOT NULL, nom_locataire_location VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, nom_materiel VARCHAR(255) NOT NULL, description_materiel VARCHAR(255) NOT NULL, prix_materiel DOUBLE PRECISION NOT NULL, photo_materiel VARCHAR(255) NOT NULL, INDEX IDX_18D2B09164D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, carrier_name VARCHAR(255) NOT NULL, carrier_price DOUBLE PRECISION NOT NULL, delivery LONGTEXT NOT NULL, reference VARCHAR(255) NOT NULL, stripe_session_id VARCHAR(255) DEFAULT NULL, state INT NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_details (id INT AUTO_INCREMENT NOT NULL, my_order_id INT NOT NULL, product VARCHAR(255) NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, total DOUBLE PRECISION NOT NULL, INDEX IDX_845CA2C1BFCDF877 (my_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation_eve (id_participation INT AUTO_INCREMENT NOT NULL, id_evenement INT NOT NULL, id_participant INT NOT NULL, PRIMARY KEY(id_participation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plats (id_plat INT AUTO_INCREMENT NOT NULL, id_resto INT NOT NULL, nom VARCHAR(255) NOT NULL, composition VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, type VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_854A620A67A41481 (id_resto), PRIMARY KEY(id_plat)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, subtitle VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_competition (id INT AUTO_INCREMENT NOT NULL, competition_id INT DEFAULT NULL, nbrparticipants INT NOT NULL, INDEX IDX_7966F1ED7B39D312 (competition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_plats (id_res_plat INT AUTO_INCREMENT NOT NULL, id_client INT NOT NULL, id_plat INT NOT NULL, quantity INT NOT NULL, date_reservation DATETIME NOT NULL, etat TINYINT(1) NOT NULL, INDEX IDX_C635B2ADE173B1B8 (id_client), INDEX IDX_C635B2ADAB18BE05 (id_plat), PRIMARY KEY(id_res_plat)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B9983CE5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurants (id_resto INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, description VARCHAR(10000) NOT NULL, type VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, num_tel INT NOT NULL, email VARCHAR(255) NOT NULL, note INT NOT NULL, PRIMARY KEY(id_resto)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B09164D218E FOREIGN KEY (location_id) REFERENCES location_materiel (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE order_details ADD CONSTRAINT FK_845CA2C1BFCDF877 FOREIGN KEY (my_order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE plats ADD CONSTRAINT FK_854A620A67A41481 FOREIGN KEY (id_resto) REFERENCES restaurants (id_resto)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE reservation_competition ADD CONSTRAINT FK_7966F1ED7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id)');
        $this->addSql('ALTER TABLE reservation_plats ADD CONSTRAINT FK_C635B2ADE173B1B8 FOREIGN KEY (id_client) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE reservation_plats ADD CONSTRAINT FK_C635B2ADAB18BE05 FOREIGN KEY (id_plat) REFERENCES plats (id_plat)');
        $this->addSql('ALTER TABLE reset_password ADD CONSTRAINT FK_B9983CE5A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE reservation_competition DROP FOREIGN KEY FK_7966F1ED7B39D312');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B09164D218E');
        $this->addSql('ALTER TABLE order_details DROP FOREIGN KEY FK_845CA2C1BFCDF877');
        $this->addSql('ALTER TABLE reservation_plats DROP FOREIGN KEY FK_C635B2ADAB18BE05');
        $this->addSql('ALTER TABLE plats DROP FOREIGN KEY FK_854A620A67A41481');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE reservation_plats DROP FOREIGN KEY FK_C635B2ADE173B1B8');
        $this->addSql('ALTER TABLE reset_password DROP FOREIGN KEY FK_B9983CE5A76ED395');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE carrier');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE location_materiel');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_details');
        $this->addSql('DROP TABLE participation_eve');
        $this->addSql('DROP TABLE plats');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE reservation_competition');
        $this->addSql('DROP TABLE reservation_plats');
        $this->addSql('DROP TABLE reset_password');
        $this->addSql('DROP TABLE restaurants');
        $this->addSql('DROP TABLE `user`');
    }
}
