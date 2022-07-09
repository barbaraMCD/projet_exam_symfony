<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220529124622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvre ADD genre_id INT NOT NULL');
        $this->addSql('ALTER TABLE oeuvre ADD CONSTRAINT FK_35FE2EFE4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('CREATE INDEX IDX_35FE2EFE4296D31F ON oeuvre (genre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oeuvre DROP FOREIGN KEY FK_35FE2EFE4296D31F');
        $this->addSql('DROP INDEX IDX_35FE2EFE4296D31F ON oeuvre');
        $this->addSql('ALTER TABLE oeuvre DROP genre_id');
    }
}
