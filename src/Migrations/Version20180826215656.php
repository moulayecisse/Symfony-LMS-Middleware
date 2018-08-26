<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180826215656 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_type_id INTEGER DEFAULT NULL, library_id INTEGER DEFAULT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(254) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL --(DC2Type:simple_array)
        , user_type VARCHAR(255) NOT NULL, phone VARCHAR(50) DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE INDEX IDX_8D93D6497AB83B07 ON user (member_type_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649FE2541D7 ON user (library_id)');
        $this->addSql('CREATE TABLE author (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, biography CLOB DEFAULT NULL, birthday DATE DEFAULT NULL)');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, image_id INTEGER DEFAULT NULL, author_id INTEGER DEFAULT NULL, sub_category_id INTEGER NOT NULL, isbn VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, resume VARCHAR(500) DEFAULT NULL, page_number INTEGER DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CBE5A3313DA5256D ON book (image_id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331F675F31B ON book (author_id)');
        $this->addSql('CREATE INDEX IDX_CBE5A331F7BFE87C ON book (sub_category_id)');
        $this->addSql('CREATE TABLE booking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, p_book_id INTEGER NOT NULL, member_id INTEGER NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, return_date DATE DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE11625AEE ON booking (p_book_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE7597D3FE ON booking (member_id)');
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE ebook (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, book_id INTEGER DEFAULT NULL, file_id INTEGER DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D51730D16A2B381 ON ebook (book_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D51730D93CB796C ON ebook (file_id)');
        $this->addSql('CREATE TABLE editor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address CLOB DEFAULT NULL)');
        $this->addSql('CREATE TABLE file (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, extension VARCHAR(255) DEFAULT NULL, is_local BOOLEAN DEFAULT NULL, path VARCHAR(255) DEFAULT NULL, file_type VARCHAR(255) NOT NULL, book VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE format (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE library (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, opening_date TIME NOT NULL, closing_time TIME NOT NULL)');
        $this->addSql('CREATE TABLE location (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, floor INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE member_ebook (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_id INTEGER NOT NULL, ebook_id INTEGER NOT NULL, date DATETIME NOT NULL, price INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_1F70E6FE7597D3FE ON member_ebook (member_id)');
        $this->addSql('CREATE INDEX IDX_1F70E6FE76E71D49 ON member_ebook (ebook_id)');
        $this->addSql('CREATE TABLE member_subscription (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_id INTEGER NOT NULL, start DATETIME NOT NULL, "end" DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_D675FA5B7597D3FE ON member_subscription (member_id)');
        $this->addSql('CREATE TABLE member_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, rate DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE TABLE pbook (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, book_id INTEGER DEFAULT NULL, library_id INTEGER DEFAULT NULL, status CLOB DEFAULT NULL --(DC2Type:array)
        )');
        $this->addSql('CREATE INDEX IDX_D5516BFF16A2B381 ON pbook (book_id)');
        $this->addSql('CREATE INDEX IDX_D5516BFFFE2541D7 ON pbook (library_id)');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, p_book_id INTEGER NOT NULL, member_id INTEGER NOT NULL, date DATE NOT NULL)');
        $this->addSql('CREATE INDEX IDX_42C8495511625AEE ON reservation (p_book_id)');
        $this->addSql('CREATE INDEX IDX_42C849557597D3FE ON reservation (member_id)');
        $this->addSql('CREATE TABLE sub_category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER DEFAULT NULL, location_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_BCE3F79812469DE2 ON sub_category (category_id)');
        $this->addSql('CREATE INDEX IDX_BCE3F79864D218E ON sub_category (location_id)');
        $this->addSql('CREATE TABLE subscription (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, duration INTEGER NOT NULL, price DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE TABLE testimonial (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_id INTEGER DEFAULT NULL, message CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_E6BDCDF77597D3FE ON testimonial (member_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE ebook');
        $this->addSql('DROP TABLE editor');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE format');
        $this->addSql('DROP TABLE library');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE member_ebook');
        $this->addSql('DROP TABLE member_subscription');
        $this->addSql('DROP TABLE member_type');
        $this->addSql('DROP TABLE pbook');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE testimonial');
    }
}
