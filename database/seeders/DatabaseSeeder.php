<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Commande::factory(100)->create();
        $this->call(adminSeed::class);
        
    }
}
