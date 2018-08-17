<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180225192345 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_squad_collection (id INT AUTO_INCREMENT NOT NULL, user_squad_id INT DEFAULT NULL, character_id INT DEFAULT NULL, INDEX IDX_BADBA2053F96C87C (user_squad_id), INDEX IDX_BADBA2051136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_squad_collection ADD CONSTRAINT FK_BADBA2053F96C87C FOREIGN KEY (user_squad_id) REFERENCES user_squad (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_squad_collection ADD CONSTRAINT FK_BADBA2051136BE75 FOREIGN KEY (character_id) REFERENCES characters (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_squad_collection');
    }
}
