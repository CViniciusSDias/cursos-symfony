<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818180453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE episode (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, season_id INTEGER NOT NULL, number SMALLINT NOT NULL)');
        $this->addSql('CREATE INDEX IDX_DDAA1CDA4EC001D1 ON episode (season_id)');
        $this->addSql('CREATE TABLE season (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, series_id INTEGER NOT NULL, number SMALLINT NOT NULL)');
        $this->addSql('CREATE INDEX IDX_F0E45BA95278319C ON season (series_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE season');
    }
}
