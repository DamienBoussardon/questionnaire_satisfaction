<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200107153644 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE reply (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, survey_id INT NOT NULL, is_completed TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, mapping_question_response JSON NOT NULL, INDEX IDX_FDA8C6E0A76ED395 (user_id), UNIQUE INDEX UNIQ_FDA8C6E0B3FE509D (survey_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reply ADD CONSTRAINT FK_FDA8C6E0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reply ADD CONSTRAINT FK_FDA8C6E0B3FE509D FOREIGN KEY (survey_id) REFERENCES survey (id)');
        $this->addSql('DROP TABLE response');
        $this->addSql('ALTER TABLE field_survey CHANGE type_response type_reply VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE response (id INT AUTO_INCREMENT NOT NULL, survey_id INT NOT NULL, user_id INT DEFAULT NULL, is_completed TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, mapping_question_response JSON NOT NULL, INDEX IDX_3E7B0BFBA76ED395 (user_id), UNIQUE INDEX UNIQ_3E7B0BFBB3FE509D (survey_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFBB3FE509D FOREIGN KEY (survey_id) REFERENCES survey (id)');
        $this->addSql('DROP TABLE reply');
        $this->addSql('ALTER TABLE field_survey CHANGE type_reply type_response VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
