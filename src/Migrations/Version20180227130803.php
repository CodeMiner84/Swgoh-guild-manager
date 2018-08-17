<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180227130803 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_mod (id INT AUTO_INCREMENT NOT NULL, account_id INT DEFAULT NULL, user_id INT DEFAULT NULL, character_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_FCE232C39B6B5FBA (account_id), INDEX IDX_FCE232C3A76ED395 (user_id), INDEX IDX_FCE232C31136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_mod_type (id INT AUTO_INCREMENT NOT NULL, mod_id INT DEFAULT NULL, type TINYINT(1) NOT NULL, kind TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_37032F6C338E21CD (mod_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_mod ADD CONSTRAINT FK_FCE232C39B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_mod ADD CONSTRAINT FK_FCE232C3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_mod ADD CONSTRAINT FK_FCE232C31136BE75 FOREIGN KEY (character_id) REFERENCES characters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_mod_type ADD CONSTRAINT FK_37032F6C338E21CD FOREIGN KEY (mod_id) REFERENCES user_mod (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_mod_type DROP FOREIGN KEY FK_37032F6C338E21CD');
        $this->addSql('DROP TABLE user_mod');
        $this->addSql('DROP TABLE user_mod_type');
    }
}
