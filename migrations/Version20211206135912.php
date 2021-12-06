<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211206135912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_intervention ADD id INT AUTO_INCREMENT NOT NULL, CHANGE id_demande_intervention id_demande_intervention INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_intervention MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE demande_intervention DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE demande_intervention DROP id, CHANGE id_demande_intervention id_demande_intervention INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE demande_intervention ADD PRIMARY KEY (id_demande_intervention)');
    }
}
