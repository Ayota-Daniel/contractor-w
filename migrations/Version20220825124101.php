<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220825124101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, ref VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, state VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_E98F28599D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sign (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, contract_id_id INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9F7E91FE9D86650F (user_id_id), INDEX IDX_9F7E91FE3C450273 (contract_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `signal` (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, contract_id_id INT NOT NULL, ref VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_740C95F59D86650F (user_id_id), INDEX IDX_740C95F53C450273 (contract_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplication (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, term_id_id INT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_F9F24E0F9D86650F (user_id_id), INDEX IDX_F9F24E0F4A76E1DF (term_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE term (id INT AUTO_INCREMENT NOT NULL, contract_id_id INT NOT NULL, ref VARCHAR(30) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A50FE78D3C450273 (contract_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, compte_id VARCHAR(20) NOT NULL, username VARCHAR(25) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F28599D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sign ADD CONSTRAINT FK_9F7E91FE9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sign ADD CONSTRAINT FK_9F7E91FE3C450273 FOREIGN KEY (contract_id_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE `signal` ADD CONSTRAINT FK_740C95F59D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `signal` ADD CONSTRAINT FK_740C95F53C450273 FOREIGN KEY (contract_id_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE supplication ADD CONSTRAINT FK_F9F24E0F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE supplication ADD CONSTRAINT FK_F9F24E0F4A76E1DF FOREIGN KEY (term_id_id) REFERENCES term (id)');
        $this->addSql('ALTER TABLE term ADD CONSTRAINT FK_A50FE78D3C450273 FOREIGN KEY (contract_id_id) REFERENCES contract (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F28599D86650F');
        $this->addSql('ALTER TABLE sign DROP FOREIGN KEY FK_9F7E91FE9D86650F');
        $this->addSql('ALTER TABLE sign DROP FOREIGN KEY FK_9F7E91FE3C450273');
        $this->addSql('ALTER TABLE `signal` DROP FOREIGN KEY FK_740C95F59D86650F');
        $this->addSql('ALTER TABLE `signal` DROP FOREIGN KEY FK_740C95F53C450273');
        $this->addSql('ALTER TABLE supplication DROP FOREIGN KEY FK_F9F24E0F9D86650F');
        $this->addSql('ALTER TABLE supplication DROP FOREIGN KEY FK_F9F24E0F4A76E1DF');
        $this->addSql('ALTER TABLE term DROP FOREIGN KEY FK_A50FE78D3C450273');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE sign');
        $this->addSql('DROP TABLE `signal`');
        $this->addSql('DROP TABLE supplication');
        $this->addSql('DROP TABLE term');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
