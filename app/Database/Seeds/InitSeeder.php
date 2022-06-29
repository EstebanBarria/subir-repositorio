<?php

namespace App\Database\Seeds;
use Faker\Factory;

use CodeIgniter\Database\Seeder;

class InitSeeder extends Seeder
{
    public function run()
    {
        $this->call('CountriesSeeder');
        $this->call('GroupsSeeder');
    }
}
