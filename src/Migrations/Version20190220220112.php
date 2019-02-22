<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190220220112 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE machines (id INT AUTO_INCREMENT NOT NULL, machine_who_create_machines_id INT NOT NULL, name VARCHAR(35) NOT NULL, INDEX IDX_F1CE8DEDCEFE71C2 (machine_who_create_machines_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objects (id INT AUTO_INCREMENT NOT NULL, machine_who_create_objects_id INT NOT NULL, name VARCHAR(35) NOT NULL, INDEX IDX_B21ACCF3EB5C4D6C (machine_who_create_objects_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planets (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(35) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressources (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(35) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressources_planets (ressources_id INT NOT NULL, planets_id INT NOT NULL, INDEX IDX_E3E6A2163C361826 (ressources_id), INDEX IDX_E3E6A216DCBDC375 (planets_id), PRIMARY KEY(ressources_id, planets_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressources_vehicles (ressources_id INT NOT NULL, vehicles_id INT NOT NULL, INDEX IDX_22745B73C361826 (ressources_id), INDEX IDX_22745B716F10C70 (vehicles_id), PRIMARY KEY(ressources_id, vehicles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressources_objects (ressources_id INT NOT NULL, objects_id INT NOT NULL, INDEX IDX_EC26E5E33C361826 (ressources_id), INDEX IDX_EC26E5E34BEE6933 (objects_id), PRIMARY KEY(ressources_id, objects_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressources_machines (ressources_id INT NOT NULL, machines_id INT NOT NULL, INDEX IDX_EC27A1A03C361826 (ressources_id), INDEX IDX_EC27A1A0358A8F83 (machines_id), PRIMARY KEY(ressources_id, machines_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicles (id INT AUTO_INCREMENT NOT NULL, machine_who_create_vehicles_id INT NOT NULL, name VARCHAR(35) NOT NULL, INDEX IDX_1FCE69FAED85F231 (machine_who_create_vehicles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE machines ADD CONSTRAINT FK_F1CE8DEDCEFE71C2 FOREIGN KEY (machine_who_create_machines_id) REFERENCES machines (id)');
        $this->addSql('ALTER TABLE objects ADD CONSTRAINT FK_B21ACCF3EB5C4D6C FOREIGN KEY (machine_who_create_objects_id) REFERENCES machines (id)');
        $this->addSql('ALTER TABLE ressources_planets ADD CONSTRAINT FK_E3E6A2163C361826 FOREIGN KEY (ressources_id) REFERENCES ressources (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressources_planets ADD CONSTRAINT FK_E3E6A216DCBDC375 FOREIGN KEY (planets_id) REFERENCES planets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressources_vehicles ADD CONSTRAINT FK_22745B73C361826 FOREIGN KEY (ressources_id) REFERENCES ressources (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressources_vehicles ADD CONSTRAINT FK_22745B716F10C70 FOREIGN KEY (vehicles_id) REFERENCES vehicles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressources_objects ADD CONSTRAINT FK_EC26E5E33C361826 FOREIGN KEY (ressources_id) REFERENCES ressources (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressources_objects ADD CONSTRAINT FK_EC26E5E34BEE6933 FOREIGN KEY (objects_id) REFERENCES objects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressources_machines ADD CONSTRAINT FK_EC27A1A03C361826 FOREIGN KEY (ressources_id) REFERENCES ressources (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressources_machines ADD CONSTRAINT FK_EC27A1A0358A8F83 FOREIGN KEY (machines_id) REFERENCES machines (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicles ADD CONSTRAINT FK_1FCE69FAED85F231 FOREIGN KEY (machine_who_create_vehicles_id) REFERENCES machines (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE machines DROP FOREIGN KEY FK_F1CE8DEDCEFE71C2');
        $this->addSql('ALTER TABLE objects DROP FOREIGN KEY FK_B21ACCF3EB5C4D6C');
        $this->addSql('ALTER TABLE ressources_machines DROP FOREIGN KEY FK_EC27A1A0358A8F83');
        $this->addSql('ALTER TABLE vehicles DROP FOREIGN KEY FK_1FCE69FAED85F231');
        $this->addSql('ALTER TABLE ressources_objects DROP FOREIGN KEY FK_EC26E5E34BEE6933');
        $this->addSql('ALTER TABLE ressources_planets DROP FOREIGN KEY FK_E3E6A216DCBDC375');
        $this->addSql('ALTER TABLE ressources_planets DROP FOREIGN KEY FK_E3E6A2163C361826');
        $this->addSql('ALTER TABLE ressources_vehicles DROP FOREIGN KEY FK_22745B73C361826');
        $this->addSql('ALTER TABLE ressources_objects DROP FOREIGN KEY FK_EC26E5E33C361826');
        $this->addSql('ALTER TABLE ressources_machines DROP FOREIGN KEY FK_EC27A1A03C361826');
        $this->addSql('ALTER TABLE ressources_vehicles DROP FOREIGN KEY FK_22745B716F10C70');
        $this->addSql('DROP TABLE machines');
        $this->addSql('DROP TABLE objects');
        $this->addSql('DROP TABLE planets');
        $this->addSql('DROP TABLE ressources');
        $this->addSql('DROP TABLE ressources_planets');
        $this->addSql('DROP TABLE ressources_vehicles');
        $this->addSql('DROP TABLE ressources_objects');
        $this->addSql('DROP TABLE ressources_machines');
        $this->addSql('DROP TABLE vehicles');
    }
}
