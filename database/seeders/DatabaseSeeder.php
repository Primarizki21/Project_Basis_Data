<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\KategoriKomplainSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\JenisPekerjaanSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProdiSeeder;
use Database\Seeders\PengaduanSeeder;
use Database\Seeders\TindakLanjutSeeder;
// use Database\Seeders\DimProfilSeeder;
// use Database\Seeders\DimWaktuSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(KategoriKomplainSeeder::class);
        $this->call(JenisPekerjaanSeeder::class);
        $this->call(ProdiSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PengaduanSeeder::class);
        $this->call(TindakLanjutSeeder::class);
        // $this->call(DimProfilSeeder::class);
        // $this->call(DimWaktuSeeder::class);
    }
}
