<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211206140156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_intervention CHANGE id_demande_intervention id_demande_intervention INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id_demande_intervention)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_intervention MODIFY id_demande_intervention INT NOT NULL');
        $this->addSql('ALTER TABLE demande_intervention DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE demande_intervention CHANGE id_demande_intervention id_demande_intervention INT NOT NULL');
    }
}
