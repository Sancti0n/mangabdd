<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190405212132 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_book (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_book_book (user_book_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_D29865DD4EAFAD8B (user_book_id), INDEX IDX_D29865DD16A2B381 (book_id), PRIMARY KEY(user_book_id, book_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_book_user (user_book_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_94EE10A54EAFAD8B (user_book_id), INDEX IDX_94EE10A5A76ED395 (user_id), PRIMARY KEY(user_book_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_book_book ADD CONSTRAINT FK_D29865DD4EAFAD8B FOREIGN KEY (user_book_id) REFERENCES user_book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_book_book ADD CONSTRAINT FK_D29865DD16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_book_user ADD CONSTRAINT FK_94EE10A54EAFAD8B FOREIGN KEY (user_book_id) REFERENCES user_book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_book_user ADD CONSTRAINT FK_94EE10A5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_book_book DROP FOREIGN KEY FK_D29865DD4EAFAD8B');
        $this->addSql('ALTER TABLE user_book_user DROP FOREIGN KEY FK_94EE10A54EAFAD8B');
        $this->addSql('DROP TABLE user_book');
        $this->addSql('DROP TABLE user_book_book');
        $this->addSql('DROP TABLE user_book_user');
    }
}
