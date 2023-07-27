<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230726092833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt ADD utilisateur_id INT DEFAULT NULL, ADD annonce_id INT NOT NULL');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D7FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE emprunt ADD CONSTRAINT FK_364071D78805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('CREATE INDEX IDX_364071D7FB88E14F ON emprunt (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_364071D78805AB2F ON emprunt (annonce_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D7FB88E14F');
        $this->addSql('ALTER TABLE emprunt DROP FOREIGN KEY FK_364071D78805AB2F');
        $this->addSql('DROP INDEX IDX_364071D7FB88E14F ON emprunt');
        $this->addSql('DROP INDEX IDX_364071D78805AB2F ON emprunt');
        $this->addSql('ALTER TABLE emprunt DROP utilisateur_id, DROP annonce_id');
    }
}
