<?php

use Illuminate\Database\Seeder;

class WalletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;
        

        for ($i=0; $i<10; $i++) { 
        	$data = array(
        			'id' => $i+1,
                    'id_user' => $i+1,
        			'saldo' => $i*50000,
        			'created_at' => DB::raw('NOW()'),
        			'updated_at' => DB::raw('NOW()'),
                );
        	DB::table('wallets')->insert($data);
        }
    }
}
