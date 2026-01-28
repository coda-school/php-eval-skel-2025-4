<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260128201356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_following (user_source INT NOT NULL, user_target INT NOT NULL, PRIMARY KEY (user_source, user_target))');
        $this->addSql('CREATE INDEX IDX_715F00073AD8644E ON user_following (user_source)');
        $this->addSql('CREATE INDEX IDX_715F0007233D34C1 ON user_following (user_target)');
        $this->addSql('ALTER TABLE user_following ADD CONSTRAINT FK_715F00073AD8644E FOREIGN KEY (user_source) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_following ADD CONSTRAINT FK_715F0007233D34C1 FOREIGN KEY (user_target) REFERENCES users (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_following DROP CONSTRAINT FK_715F00073AD8644E');
        $this->addSql('ALTER TABLE user_following DROP CONSTRAINT FK_715F0007233D34C1');
        $this->addSql('DROP TABLE user_following');
    }
}
