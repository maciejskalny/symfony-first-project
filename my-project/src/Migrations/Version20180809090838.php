<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180809090838 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE product_image');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE product DROP main_image');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_image (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_64617F034584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, password VARCHAR(64) NOT NULL COLLATE utf8mb4_unicode_ci, roles LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F034584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD main_image VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
