<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\KategoriKomplainSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\JenisPekerjaanSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(KategoriKomplainSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(JenisPekerjaanSeeder::class);
        $this->call(UserSeeder::class);

    }
}
