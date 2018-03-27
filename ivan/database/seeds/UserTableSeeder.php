<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;
        $name=['satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh'];


        $operator=['0811',
                    '0814',
                    '0817',
                    '0831',
                    '0881',
                    '0887',
                    '0896',
                    '0832',
                    '0877',
                    '0858'
          ];
        for ($i=0; $i < count($name); $i++) {
          $randomPhoneNumb= (string)rand(10000000,99999999);

        	$users=array(
        	'id'=> $i+1,
        	'name'=> $name[$i],
        	'email'=> $name[$i].'@gmail.com',
        	'password'=> bcrypt(strrev($name[$i])),
          'phoneNumb' => $operator[$i].$randomPhoneNumb,
        	'created_at' => DB::raw('NOW()'),
        	'updated_at' => DB::raw('NOW()'),
        	);
        DB::table('users')->insert($users);
        }

  //       $users = array (
		// 	'id' => $id,
  //           'name' => 'SYS',
		// 	'email' => 'sys@sys.com',
		// 	'password' => bcrypt('sys'),
		// 	'created_at' => DB::raw('NOW()'),
		// 	'updated_at' => DB::raw('NOW()'),
		// 	);
		// DB::table('users')->insert($users);
		// $id++;


		// $users = array (
		// 	'id' => $id,
  //           'name' => 'asd',
		// 	'email' => 'asd@asd.com',
		// 	'password' => bcrypt('sys'),
		// 	'created_at' => DB::raw('NOW()'),
		// 	'updated_at' => DB::raw('NOW()'),
		// 	);
		// DB::table('users')->insert($users);
		// $id++;
    }
}
