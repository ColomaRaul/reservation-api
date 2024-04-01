<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240330162812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Configure hotels tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE hotel (id UUID NOT NULL, name VARCHAR(255), PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE hotel_provider_relation (hotel_id UUID NOT NULL, provider_id UUID NOT NULL, provider_hotel_code VARCHAR(10), PRIMARY KEY (hotel_id, provider_id, provider_hotel_code))');
        $this->addSql("CREATE TABLE reservation (id UUID NOT NULL, hotel_id UUID, locator VARCHAR(20), room_number VARCHAR(20), check_in TIMESTAMP WITH TIME ZONE, check_out TIMESTAMP WITH TIME ZONE, number_of_nights int, total_pax int, guests jsonb not null default '[]'::jsonb, PRIMARY KEY (id))");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE hotel_provider_relation');
        $this->addSql('DROP TABLE reservation');
    }
}
