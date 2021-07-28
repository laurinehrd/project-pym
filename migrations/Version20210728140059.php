<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210728140059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE intermediaire_ingredients');
        $this->addSql('ALTER TABLE ingredients RENAME INDEX idx_4b60114fa545015 TO IDX_4B60114F12469DE2');
        $this->addSql('ALTER TABLE intermediaire ADD ingredients_id INT NOT NULL');
        $this->addSql('ALTER TABLE intermediaire ADD CONSTRAINT FK_917B4C063EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id)');
        $this->addSql('CREATE INDEX IDX_917B4C063EC4DCE ON intermediaire (ingredients_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intermediaire_ingredients (intermediaire_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_F5F5A56B3EC4DCE (ingredients_id), INDEX IDX_F5F5A56BF9D711AE (intermediaire_id), PRIMARY KEY(intermediaire_id, ingredients_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE intermediaire_ingredients ADD CONSTRAINT FK_F5F5A56B3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intermediaire_ingredients ADD CONSTRAINT FK_F5F5A56BF9D711AE FOREIGN KEY (intermediaire_id) REFERENCES intermediaire (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients RENAME INDEX idx_4b60114f12469de2 TO IDX_4B60114FA545015');
        $this->addSql('ALTER TABLE intermediaire DROP FOREIGN KEY FK_917B4C063EC4DCE');
        $this->addSql('DROP INDEX IDX_917B4C063EC4DCE ON intermediaire');
        $this->addSql('ALTER TABLE intermediaire DROP ingredients_id');
    }
}
