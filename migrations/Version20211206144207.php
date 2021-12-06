<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211206144207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_sous_traitance DROP id, CHANGE code_facture code_facture INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (code_facture)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture_sous_traitance MODIFY code_facture INT NOT NULL');
        $this->addSql('ALTER TABLE facture_sous_traitance DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE facture_sous_traitance ADD id INT NOT NULL, CHANGE code_facture code_facture INT NOT NULL');
    }
}
