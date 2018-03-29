<?php

use Illuminate\Database\Seeder;

class PulsaOperatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;	// 1     2       3        4       5
		// $id_provider=['XL','INDOSAT','SMART', 'AXIS' ,'THREE', 'TELKOMSEL', 'MOBILE8'];//6   7


		$telkomsel=['0811','0812','0813','0852','0853','0821','0822','0823'];


		$indosat=['0814','0815','0816','0855','0856','0857','0858'];



		$XL=['0817',
			 '0818',
			 '0819',
			 '0859',
			 '0877',
			 '0878'];

		$axis=['0831', '0832', '0838'];

		$smart=['0881','0882'];

		$mobile8=['0887','0888'];

		$three=['0896','0897','0898'];

		$provider_name=[$XL,$axis,$indosat,$telkomsel, $three, $smart, $mobile8]; // 7 pieces

		//$id_provider=['XL','INDOSAT','SMART', 'AXIS' ,'THREE', 'TELKOMSEL', 'MOBILE8'];//6   


		//$flag=['Y','Y','N','Y','Y','N','N','Y','N'];

		
		

		for($i=0; $i<count($provider_name);$i++){
			for($j=0; $j<count($provider_name[$i]); $j++){
				if($i==0){
		            $temp = $XL[$j];		
				}else if($i==1){
					$temp = $axis[$j];
				}else if($i==2){
					$temp = $indosat[$j];
				}else if($i==3){
					$temp = $telkomsel[$j];
				}else if($i==4){
					$temp = $three[$j];
				}else if($i==5){
					$temp = $smart[$j];
				}else if($i==6){
					$temp = $mobile8[$j];
				}

				$send = array(

					'id_provider' => $i+1,//provider name id
					'kode_provider' => $temp,
					
					'created_at' => DB::raw('NOW()'),
					'updated_at' => DB::raw('NOW()')
				);

				DB::table('pulsa_operators')->insert($send);

				}
				//end loop
			}
			

		// for($i=0; $i<count($provider_name);$i++){

		// 	$providers = array (
		// 		'id' => $i+1,
	 //            'name' => $id[$i],
				
		// 		'created_at' => DB::raw('NOW()'),
		// 		'updated_at' => DB::raw('NOW()'),
		// 	);
		// 	DB::table('providers')->insert($providers);	

		// }
    }
}

/*

*/
