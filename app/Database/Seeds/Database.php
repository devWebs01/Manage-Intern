<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Database extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('AssenddmentSeeder');
        $this->call('ParticipantSeeder');
        $this->call('CompanyProfileSeeder');
        $this->call('LogbookSeeder');
        $this->call('PresenceSeeder');
    }
}
