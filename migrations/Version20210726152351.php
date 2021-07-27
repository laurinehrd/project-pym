<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726152351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intermediaire (id INT AUTO_INCREMENT NOT NULL, meal_id INT NOT NULL, unity_id INT NOT NULL, quantity DOUBLE PRECISION NOT NULL, INDEX IDX_917B4C06639666D6 (meal_id), INDEX IDX_917B4C06F6859C8C (unity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intermediaire_ingredients (intermediaire_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_F5F5A56BF9D711AE (intermediaire_id), INDEX IDX_F5F5A56B3EC4DCE (ingredients_id), PRIMARY KEY(intermediaire_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE intermediaire ADD CONSTRAINT FK_917B4C06639666D6 FOREIGN KEY (meal_id) REFERENCES meals (id)');
        $this->addSql('ALTER TABLE intermediaire ADD CONSTRAINT FK_917B4C06F6859C8C FOREIGN KEY (unity_id) REFERENCES unity (id)');
        $this->addSql('ALTER TABLE intermediaire_ingredients ADD CONSTRAINT FK_F5F5A56BF9D711AE FOREIGN KEY (intermediaire_id) REFERENCES intermediaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intermediaire_ingredients ADD CONSTRAINT FK_F5F5A56B3EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intermediaire_ingredients DROP FOREIGN KEY FK_F5F5A56BF9D711AE');
        $this->addSql('DROP TABLE intermediaire');
        $this->addSql('DROP TABLE intermediaire_ingredients');
    }
}
