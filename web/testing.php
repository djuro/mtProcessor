<?php

require '../vendor/autoload.php';
/*
$client = new \GuzzleHttp\Client(array('base_uri'=>'http://localhost'));

//dd($client->getConfig());
$data = array('currencyFrom'=>'EUR','currencyTo'=>'USD','amount'=>'1435');

//$response = $client->post('/mtprocessor/web/app_dev.php/api/new',array('content-type' => 'application/json'),['body'=>json_encode($data)]);
//$response = $client->post('/mtprocessor/web/app_dev.php/api/new',array('Content-Type'=>'application/json'),['body'=>json_encode($data)]);

$response = $client->post('/mtprocessor/web/app_dev.php/api/new',[
              'json' => json_encode($data)
           ]);


//$data = array('currencyFrom'=>'EUR','currencyTo'=>'GBP','amount'=>'345');

foreach ($response->getHeaders() as $name => $values) {
    echo $name . ': ' . implode(', ', $values) . "\r\n";
}
//dd($response)
echo "\n\n";

*/

$currency = ['EUR','GBP','USD'];
$currency2 = ['GBP','EUR','USD'];

$amount = [123,435,455,872,879,23.56,984.34,555.34,23.34,67,23,85,90];

$all = [];

$i=1;
foreach($currency as $c)
{
	foreach($amount as $a)
	{
		foreach($currency2 as $c2)
		{
			$data = ['userId'=>77564,'currencyFrom'=>$c,
						'currencyTo'=>$c2,'amountSell'=>$a,'amountBuy'=>rand(100,300),
						'rate'=>0.7471,'timePlaced'=>'15-JUL-15 20:57:45','originatingCountry'=>'FR']; 
			$all[$i] = $data;
			$i++;
		} 
	}
}




$ch = curl_init('http://localhost/mtprocessor/web/app_dev.php/new-message');    

foreach($all as $data)
{
	/*
	$data = ['userId'=>77564,'currencyFrom'=>'EUR',
	'currencyTo'=>'GBP','amountSell'=>1200,'amountBuy'=>758.10,
	'rate'=>0.7471,'timePlaced'=>'14-JUL-15 18:04:44','originatingCountry'=>'FR'];  
*/
	$data_string = json_encode($data);  

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string)) );                    

	$result = curl_exec($ch);
	echo $result;
}
echo $result;


                                                               
                                                                                  
                                                                                                                     
                                                                  
                                                                                               
                                                                                                                     


?>