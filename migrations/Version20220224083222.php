<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224083222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        /*
            CREATE TABLE `sessions` (
                `sess_id` VARBINARY(128) NOT NULL PRIMARY KEY,
                `sess_data` BLOB NOT NULL,
                `sess_lifetime` INTEGER UNSIGNED NOT NULL,
                `sess_time` INTEGER UNSIGNED NOT NULL,
                INDEX `sessions_sess_lifetime_idx` (`sess_lifetime`)
            ) COLLATE utf8mb4_bin, ENGINE = InnoDB;
        */
        $tbl = $schema->createTable('sessions');
        $tbl->addColumn('sess_id','binary',["length" => 128, "notnull" => true]);
        $tbl->addColumn('sess_data','blob',["notnull" => true]);
        $tbl->addColumn('sess_lifetime','integer',["unsigned" => true,"notnull" => true]);
        $tbl->addColumn('sess_time','integer',["unsigned" => true,"notnull" => true]);
        $tbl->setPrimaryKey(['sess_id']);
        $tbl->addUniqueIndex(['sess_lifetime'],'sessions_sess_lifetime_idx');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    
        if ($schema->hasTable('sessions'))
            $schema->dropTable('sessions');

    }
}
