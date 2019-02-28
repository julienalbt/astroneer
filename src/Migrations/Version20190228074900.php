<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190228074900 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE machines_ressources (machines_id INT NOT NULL, ressources_id INT NOT NULL, INDEX IDX_B5F985A0358A8F83 (machines_id), INDEX IDX_B5F985A03C361826 (ressources_id), PRIMARY KEY(machines_id, ressources_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE machines_ressources ADD CONSTRAINT FK_B5F985A0358A8F83 FOREIGN KEY (machines_id) REFERENCES machines (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE machines_ressources ADD CONSTRAINT FK_B5F985A03C361826 FOREIGN KEY (ressources_id) REFERENCES ressources (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE machines_ressources');
    }
}
