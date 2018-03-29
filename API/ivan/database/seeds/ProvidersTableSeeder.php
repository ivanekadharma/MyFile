<?php

use Illuminate\Database\Seeder;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;
		$name=['XL','AXIS','INDOSAT','TELKOMSEL', 'THREE', 'SMART', 'MOBILE8'];
		//$flag=['Y','Y','N','Y','Y','N','N','Y','N'];

		for($i=0; $i<count($name);$i++){

			$providers = array (
				'id' => $i+1,
	            'name' => $name[$i],
				
				'created_at' => DB::raw('NOW()'),
				'updated_at' => DB::raw('NOW()')
			);
			DB::table('providers')->insert($providers);	

		}

    }
}
