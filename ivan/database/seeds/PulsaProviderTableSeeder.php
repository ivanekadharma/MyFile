<?php

use Illuminate\Database\Seeder;

class PulsaProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {//pilihan pulsa
    	$id=1;

        $telkomsel_nominal=['3000','5000','10000','20000','250000','500000','70000','100000'];
		$indosat_nominal=['1000','2000','6000','9000','15000','25000','55000', '100000'];
		$XL_nominal=['10000','40000','70000','100000','150000','200000'];
		$axis_nominal=['6000', '10000', '13000'];
		$smart_nominal=['50000','100000'];
		$mobile8_nominal=['3000','8000'];
		$three_nominal=['3000','5000','10000','20000','250000','500000','70000','100000'];


		$three_price=['3200','5500','11000','22000','260000','505000','72100','102500'];
        $telkomsel_price=['3500','6000','12000','23000','250000','500000','70000','100000'];
		$indosat_price=['1500','2700','8000','10000','17000','25000','55000', '100000'];
		$axis_price=['7000', '12000', '15000'];
		$smart_price=['51000','120000'];
		$mobile8_price=['3500','9000'];
		$XL_price=['11000','44000','76000','100000','150000','200000'];



		$provider_name=[$XL_nominal, $axis_nominal, $indosat_nominal, $telkomsel_nominal, $three_nominal, $smart_nominal, $mobile8_nominal]; // 7 pieces

		//$id_provider=['XL','INDOSAT','SMART', 'AXIS' ,'THREE', 'TELKOMSEL', 'MOBILE8'];//6   


		//$flag=['Y','Y','N','Y','Y','N','N','Y','N'];

		
		$temp="";
		$temp2="";

		for($i=0; $i<count($provider_name);$i++){
			for($j=0; $j<count($provider_name[$i]); $j++){	
				if($i==0){
		           	$temp = $XL_nominal[$j];
		          	$temp2 = $XL_price[$j];
				}else if($i==1){
		           	$temp = $axis_nominal[$j];
		        	$temp2 =  $axis_price[$j];
				}else if($i==2){
					$temp = $indosat_nominal[$j];
					$temp2 = $indosat_price[$j];
				}else if($i==3){
					$temp = $telkomsel_nominal[$j];
					$temp2 =  $telkomsel_price[$j];
				}else if($i==4){
		          	$temp = $three_nominal[$j];
		         	$temp2 =  $three_price[$j];
				}else if($i==5){
					$temp = $smart_nominal[$j];
					$temp2 =  $smart_price[$j];
				}else if($i==6){
					$temp = $mobile8_nominal[$j];
					$temp2 =  $mobile8_price[$j];
				}

				$send=array(

					'pulsa_id' => $i+1,//provider name id
					'flag' => 'Y',
					'nominal'=>$temp,
					'harga'=>$temp2,
							'created_at' => DB::raw('NOW()'),
							'updated_at' => DB::raw('NOW()'),
				);

				DB::table('pulsa_providers')->insert($send);
				//end second loop
				}
				//end first loop
			}


    }
}
