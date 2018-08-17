<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180225112206 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_squad ADD group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_squad ADD CONSTRAINT FK_2D1204BFFE54D947 FOREIGN KEY (group_id) REFERENCES user_squad_group (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_2D1204BFFE54D947 ON user_squad (group_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_squad DROP FOREIGN KEY FK_2D1204BFFE54D947');
        $this->addSql('DROP INDEX IDX_2D1204BFFE54D947 ON user_squad');
        $this->addSql('ALTER TABLE user_squad DROP group_id');
    }
}
