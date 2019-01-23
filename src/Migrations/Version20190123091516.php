<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190123091516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE visitor (id INT AUTO_INCREMENT NOT NULL, circus_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, price INT NOT NULL, period VARCHAR(255) NOT NULL, INDEX IDX_CAE5E19F686CD246 (circus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performances (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE circus (id INT AUTO_INCREMENT NOT NULL, history VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performers (id INT AUTO_INCREMENT NOT NULL, performances_id INT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, biography VARCHAR(255) NOT NULL, INDEX IDX_2CC1D5F0A07A6884 (performances_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visitor ADD CONSTRAINT FK_CAE5E19F686CD246 FOREIGN KEY (circus_id) REFERENCES circus (id)');
        $this->addSql('ALTER TABLE performers ADD CONSTRAINT FK_2CC1D5F0A07A6884 FOREIGN KEY (performances_id) REFERENCES performances (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE performers DROP FOREIGN KEY FK_2CC1D5F0A07A6884');
        $this->addSql('ALTER TABLE visitor DROP FOREIGN KEY FK_CAE5E19F686CD246');
        $this->addSql('DROP TABLE visitor');
        $this->addSql('DROP TABLE performances');
        $this->addSql('DROP TABLE circus');
        $this->addSql('DROP TABLE performers');
    }
}
