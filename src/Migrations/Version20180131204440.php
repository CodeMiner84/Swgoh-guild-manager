<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180131204440 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE characters (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, side INT NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, tags LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setting (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, api VARCHAR(255) NOT NULL, user_suffix VARCHAR(255) NOT NULL, guild_suffix VARCHAR(255) NOT NULL, unit_suffix VARCHAR(255) NOT NULL, mods_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, guild_id INT DEFAULT NULL, uuid VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_8D93D6495F2131EF (guild_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guild (id INT AUTO_INCREMENT NOT NULL, uuid VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495F2131EF FOREIGN KEY (guild_id) REFERENCES guild (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495F2131EF');
        $this->addSql('DROP TABLE characters');
        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE guild');
    }
}
