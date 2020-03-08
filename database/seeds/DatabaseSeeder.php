<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(JenisPenyakitSeeder::class);
        $this->call(JenjangPendidikanSeeder::class);
        $this->call(KasusPenyakitSeeder::class);
        $this->call(KecamatanSeeder::class);
        $this->call(SekolahSeeder::class);
        $this->call(KependudukanSeeder::class);
        $this->call(LingkunganHidupSeeder::class);
        $this->call(PekerjaanUmumSeeder::class);
        $this->call(PenanggulanganBencanaSeeder::class);
        $this->call(PariwisataSeeder::class);
        
    }
}
