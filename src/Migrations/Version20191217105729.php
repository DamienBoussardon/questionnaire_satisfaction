<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191217105729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFB4A210C1D FOREIGN KEY (user_front_id) REFERENCES user_front (id)');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFBB3FE509D FOREIGN KEY (survey_id) REFERENCES survey (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3E7B0BFB4A210C1D ON response (user_front_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3E7B0BFBB3FE509D ON response (survey_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFB4A210C1D');
        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFBB3FE509D');
        $this->addSql('DROP INDEX UNIQ_3E7B0BFB4A210C1D ON response');
        $this->addSql('DROP INDEX UNIQ_3E7B0BFBB3FE509D ON response');
    }
}
