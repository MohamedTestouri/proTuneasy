<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518192216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `ReservationCompetition` (id INT AUTO_INCREMENT NOT NULL, competition_id INT DEFAULT NULL, nbrparticipants INT NOT NULL, INDEX IDX_B8E808697B39D312 (competition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, id_competition INT NOT NULL, id_user INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `ReservationCompetition` ADD CONSTRAINT FK_B8E808697B39D312 FOREIGN KEY (competition_id) REFERENCES `competition` (id)');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commandedetails');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_competition');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP code, DROP role, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, idUser INT NOT NULL, description VARCHAR(255) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, total DOUBLE PRECISION NOT NULL, status VARCHAR(255) CHARACTER SET utf8 DEFAULT \'pending\' NOT NULL COLLATE `utf8_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commandedetails (id INT AUTO_INCREMENT NOT NULL, idProduct INT NOT NULL, idOrder INT NOT NULL, quantity INT NOT NULL, total DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, competition_id INT NOT NULL, nbrparticipants INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation_competition (id INT AUTO_INCREMENT NOT NULL, competition_id INT DEFAULT NULL, nbrparticipants INT NOT NULL, INDEX IDX_7966F1ED7B39D312 (competition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reservation_competition ADD CONSTRAINT FK_7966F1ED7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id)');
        $this->addSql('DROP TABLE `ReservationCompetition`');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('ALTER TABLE product CHANGE category_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD code VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`');
    }
}
