<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231020132129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cocktail ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE cocktail ADD CONSTRAINT FK_7B4914D4F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7B4914D4F675F31B ON cocktail (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE cocktail DROP CONSTRAINT FK_7B4914D4F675F31B');
        $this->addSql('DROP INDEX IDX_7B4914D4F675F31B');
        $this->addSql('ALTER TABLE cocktail DROP author_id');
    }
}
