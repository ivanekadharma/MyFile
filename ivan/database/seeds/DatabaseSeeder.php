<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);
        $this->call(PulsaOperatorsTableSeeder::class);
        $this->call(PulsaProviderTableSeeder::class);
        $this->call(WalletsTableSeeder::class);
    }
}
