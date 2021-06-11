<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210611095831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE meals_ingredients');
        $this->addSql('ALTER TABLE ingredients ADD meal_id INT NOT NULL');
        $this->addSql('ALTER TABLE ingredients ADD CONSTRAINT FK_4B60114F639666D6 FOREIGN KEY (meal_id) REFERENCES meals (id)');
        $this->addSql('CREATE INDEX IDX_4B60114F639666D6 ON ingredients (meal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meals_ingredients (meals_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_DF77A0AB3EC4DCE (ingredients_id), INDEX IDX_DF77A0AB88A25CA2 (meals_id), PRIMARY KEY(meals_id, ingredients_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE meals_ingredients ADD CONSTRAINT FK_DF77A0AB3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meals_ingredients ADD CONSTRAINT FK_DF77A0AB88A25CA2 FOREIGN KEY (meals_id) REFERENCES meals (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients DROP FOREIGN KEY FK_4B60114F639666D6');
        $this->addSql('DROP INDEX IDX_4B60114F639666D6 ON ingredients');
        $this->addSql('ALTER TABLE ingredients DROP meal_id');
    }
}
