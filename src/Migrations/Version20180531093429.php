<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180531093429 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE journey_step (id INT AUTO_INCREMENT NOT NULL, journey_id INT DEFAULT NULL, next_step_id INT DEFAULT NULL, city VARCHAR(250) NOT NULL, step_at DATETIME NOT NULL, INDEX IDX_5CD5718FD5C9896F (journey_id), UNIQUE INDEX UNIQ_5CD5718FB13C343E (next_step_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journey (id INT AUTO_INCREMENT NOT NULL, car_id INT DEFAULT NULL, conductor_id INT DEFAULT NULL, INDEX IDX_C816C6A2C3C6F69F (car_id), INDEX IDX_C816C6A2A49DECF0 (conductor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journey_user (journey_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92FF59FAD5C9896F (journey_id), INDEX IDX_92FF59FAA76ED395 (user_id), PRIMARY KEY(journey_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, driver_id INT DEFAULT NULL, number_of_seat INT NOT NULL, INDEX IDX_773DE69DC3423909 (driver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, journey_id INT DEFAULT NULL, sender_id INT DEFAULT NULL, sended_at DATETIME NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_B6BD307FD5C9896F (journey_id), INDEX IDX_B6BD307FF624B39D (sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE journey_step ADD CONSTRAINT FK_5CD5718FD5C9896F FOREIGN KEY (journey_id) REFERENCES journey (id)');
        $this->addSql('ALTER TABLE journey_step ADD CONSTRAINT FK_5CD5718FB13C343E FOREIGN KEY (next_step_id) REFERENCES journey_step (id)');
        $this->addSql('ALTER TABLE journey ADD CONSTRAINT FK_C816C6A2C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE journey ADD CONSTRAINT FK_C816C6A2A49DECF0 FOREIGN KEY (conductor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE journey_user ADD CONSTRAINT FK_92FF59FAD5C9896F FOREIGN KEY (journey_id) REFERENCES journey (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE journey_user ADD CONSTRAINT FK_92FF59FAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DC3423909 FOREIGN KEY (driver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FD5C9896F FOREIGN KEY (journey_id) REFERENCES journey (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE journey_step DROP FOREIGN KEY FK_5CD5718FB13C343E');
        $this->addSql('ALTER TABLE journey_step DROP FOREIGN KEY FK_5CD5718FD5C9896F');
        $this->addSql('ALTER TABLE journey_user DROP FOREIGN KEY FK_92FF59FAD5C9896F');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FD5C9896F');
        $this->addSql('ALTER TABLE journey DROP FOREIGN KEY FK_C816C6A2C3C6F69F');
        $this->addSql('DROP TABLE journey_step');
        $this->addSql('DROP TABLE journey');
        $this->addSql('DROP TABLE journey_user');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE message');
    }
}
