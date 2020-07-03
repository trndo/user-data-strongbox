<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200524124752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE personal_data ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personal_data ADD CONSTRAINT FK_9CF9F45EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9CF9F45EA76ED395 ON personal_data (user_id)');
        $this->addSql('ALTER TABLE credit_card ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE credit_card ADD CONSTRAINT FK_11D627EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_11D627EEA76ED395 ON credit_card (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE credit_card DROP FOREIGN KEY FK_11D627EEA76ED395');
        $this->addSql('DROP INDEX IDX_11D627EEA76ED395 ON credit_card');
        $this->addSql('ALTER TABLE credit_card DROP user_id');
        $this->addSql('ALTER TABLE personal_data DROP FOREIGN KEY FK_9CF9F45EA76ED395');
        $this->addSql('DROP INDEX IDX_9CF9F45EA76ED395 ON personal_data');
        $this->addSql('ALTER TABLE personal_data DROP user_id');
    }
}
