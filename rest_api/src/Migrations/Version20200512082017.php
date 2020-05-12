<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512082017 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE destination (id CHAR(36) NOT NULL --(DC2Type:uuid)
        , name VARCHAR(100) NOT NULL, phrase VARCHAR(255) DEFAULT NULL, presentation CLOB NOT NULL, activity_level INTEGER NOT NULL, max_group INTEGER NOT NULL, min_group INTEGER NOT NULL, country VARCHAR(50) NOT NULL, city VARCHAR(50) NOT NULL, region VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user (
          id CHAR(36) NOT NULL --(DC2Type:uuid)
        , name VARCHAR(100) NOT NULL
        , email VARCHAR(100) NOT NULL
        , password VARCHAR(100) NOT NULL
        , create_date DATETIME NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE user');
    }
}
