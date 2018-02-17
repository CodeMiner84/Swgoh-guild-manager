<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180204100803 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_character DROP FOREIGN KEY FK_939A3DD01136BE75');
        $this->addSql('ALTER TABLE user_character DROP FOREIGN KEY FK_939A3DD0A76ED395');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD01136BE75 FOREIGN KEY (character_id) REFERENCES characters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_character DROP FOREIGN KEY FK_939A3DD01136BE75');
        $this->addSql('ALTER TABLE user_character DROP FOREIGN KEY FK_939A3DD0A76ED395');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD01136BE75 FOREIGN KEY (character_id) REFERENCES characters (id)');
        $this->addSql('ALTER TABLE user_character ADD CONSTRAINT FK_939A3DD0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
