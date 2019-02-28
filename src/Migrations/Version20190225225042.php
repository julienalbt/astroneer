<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190225225042 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE machines ADD image_show_name VARCHAR(255) DEFAULT NULL, ADD image_index_name VARCHAR(255) DEFAULT NULL, DROP image_name, DROP image_size, DROP updated_at');
        $this->addSql('ALTER TABLE objects ADD image_index_name VARCHAR(255) DEFAULT NULL, ADD image_show_name VARCHAR(255) DEFAULT NULL, DROP image_name, DROP image_size, DROP updated_at');
        $this->addSql('ALTER TABLE planets ADD image_show_name VARCHAR(255) DEFAULT NULL, ADD image_index_name VARCHAR(255) DEFAULT NULL, DROP image_name, DROP image_size, DROP updated_at');
        $this->addSql('ALTER TABLE vehicles ADD image_show_name VARCHAR(255) DEFAULT NULL, ADD image_index_name VARCHAR(255) DEFAULT NULL, DROP image_name, DROP image_size, DROP updated_at');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE machines ADD image_name VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD image_size INT DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP image_show_name, DROP image_index_name');
        $this->addSql('ALTER TABLE objects ADD image_name VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD image_size INT DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP image_index_name, DROP image_show_name');
        $this->addSql('ALTER TABLE planets ADD image_name VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD image_size INT DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP image_show_name, DROP image_index_name');
        $this->addSql('ALTER TABLE vehicles ADD image_name VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD image_size INT DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, DROP image_show_name, DROP image_index_name');
    }
}
