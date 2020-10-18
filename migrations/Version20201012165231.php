<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201012165231 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE play_external (id INT AUTO_INCREMENT NOT NULL, poster VARCHAR(255) NOT NULL, premiere_date DATETIME NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE play_photo (id INT AUTO_INCREMENT NOT NULL, play_external_id INT NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_E56863A4A2B8AF59 (play_external_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE play_video_link (id INT AUTO_INCREMENT NOT NULL, play_external_id INT NOT NULL, video_link VARCHAR(255) NOT NULL, INDEX IDX_24D6FA48A2B8AF59 (play_external_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE play_photo ADD CONSTRAINT FK_E56863A4A2B8AF59 FOREIGN KEY (play_external_id) REFERENCES play_external (id)');
        $this->addSql('ALTER TABLE play_video_link ADD CONSTRAINT FK_24D6FA48A2B8AF59 FOREIGN KEY (play_external_id) REFERENCES play_external (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE play_photo DROP FOREIGN KEY FK_E56863A4A2B8AF59');
        $this->addSql('ALTER TABLE play_video_link DROP FOREIGN KEY FK_24D6FA48A2B8AF59');
        $this->addSql('DROP TABLE play_external');
        $this->addSql('DROP TABLE play_photo');
        $this->addSql('DROP TABLE play_video_link');
    }
}
