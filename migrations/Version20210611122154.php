<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210611122154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredients DROP FOREIGN KEY FK_4B60114F639666D6');
        $this->addSql('DROP INDEX IDX_4B60114F639666D6 ON ingredients');
        $this->addSql('ALTER TABLE ingredients DROP meal_id');
        $this->addSql('ALTER TABLE meals ADD ingredients_id INT NOT NULL');
        $this->addSql('ALTER TABLE meals ADD CONSTRAINT FK_E229E6EA3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id)');
        $this->addSql('CREATE INDEX IDX_E229E6EA3EC4DCE ON meals (ingredients_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredients ADD meal_id INT NOT NULL');
        $this->addSql('ALTER TABLE ingredients ADD CONSTRAINT FK_4B60114F639666D6 FOREIGN KEY (meal_id) REFERENCES meals (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4B60114F639666D6 ON ingredients (meal_id)');
        $this->addSql('ALTER TABLE meals DROP FOREIGN KEY FK_E229E6EA3EC4DCE');
        $this->addSql('DROP INDEX IDX_E229E6EA3EC4DCE ON meals');
        $this->addSql('ALTER TABLE meals DROP ingredients_id');
    }
}
