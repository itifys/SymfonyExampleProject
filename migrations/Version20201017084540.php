<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201017084540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, questionaire_part_id INT DEFAULT NULL, tag VARCHAR(255) NOT NULL, INDEX IDX_389B783E7C3C770 (questionaire_part_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B783E7C3C770 FOREIGN KEY (questionaire_part_id) REFERENCES questionaire_part (id)');
        $this->addSql('ALTER TABLE questionaire_part ADD text LONGTEXT DEFAULT NULL, ADD display_type INT NOT NULL, CHANGE keyword title VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tag');
        $this->addSql('ALTER TABLE questionaire_part DROP text, DROP display_type, CHANGE title keyword VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
