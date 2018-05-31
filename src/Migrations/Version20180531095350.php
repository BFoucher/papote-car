<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180531095350 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE passenger_inscription (id INT AUTO_INCREMENT NOT NULL, passenger_id INT DEFAULT NULL, step_start_id INT DEFAULT NULL, step_end_id INT DEFAULT NULL, confirmed TINYINT(1) NOT NULL, INDEX IDX_35453A3B4502E565 (passenger_id), INDEX IDX_35453A3B5238FBF4 (step_start_id), INDEX IDX_35453A3BCFA3476A (step_end_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE passenger_inscription ADD CONSTRAINT FK_35453A3B4502E565 FOREIGN KEY (passenger_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE passenger_inscription ADD CONSTRAINT FK_35453A3B5238FBF4 FOREIGN KEY (step_start_id) REFERENCES journey_step (id)');
        $this->addSql('ALTER TABLE passenger_inscription ADD CONSTRAINT FK_35453A3BCFA3476A FOREIGN KEY (step_end_id) REFERENCES journey_step (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE passenger_inscription');
    }
}
