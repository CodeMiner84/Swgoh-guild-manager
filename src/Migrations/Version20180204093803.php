<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180204093803 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_character (id INT AUTO_INCREMENT NOT NULL, character_id INT DEFAULT NULL, user_id INT DEFAULT NULL, active TINYINT(1) NOT NULL, stars INT NOT NULL, level INT NOT NULL, gear INT NOT NULL, INDEX IDX_939A3DD01136BE75 (character_id), INDEX IDX_939A3DD0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD01136BE75 FOREIGN KEY (character_id) REFERENCES characters (id)');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE characters ADD user_character_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410E91FAC277 FOREIGN KEY (user_character_id) REFERENCES user_character (id)');
        $this->addSql('CREATE INDEX IDX_3A29410E91FAC277 ON characters (user_character_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410E91FAC277');
        $this->addSql('DROP TABLE user_character');
        $this->addSql('DROP INDEX IDX_3A29410E91FAC277 ON characters');
        $this->addSql('ALTER TABLE characters DROP user_character_id');
    }
}
