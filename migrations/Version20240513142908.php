<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513142908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE price_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE price (id INT NOT NULL, wash_station_id INT NOT NULL, model_user_id INT NOT NULL, value INT NOT NULL, rate INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CAC822D95B4D4113 ON price (wash_station_id)');
        $this->addSql('CREATE INDEX IDX_CAC822D9C7FDBA64 ON price (model_user_id)');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D95B4D4113 FOREIGN KEY (wash_station_id) REFERENCES wash_station (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D9C7FDBA64 FOREIGN KEY (model_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE price_id_seq CASCADE');
        $this->addSql('ALTER TABLE price DROP CONSTRAINT FK_CAC822D95B4D4113');
        $this->addSql('ALTER TABLE price DROP CONSTRAINT FK_CAC822D9C7FDBA64');
        $this->addSql('DROP TABLE price');
    }
}
