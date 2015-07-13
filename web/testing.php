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


$ch = curl_init('http://localhost/mtprocessor/web/app_dev.php/new-message');    

//foreach($amounts as $amount)
//{
	$data = ['userId'=>134256,'currencyFrom'=>'EUR',
	'currencyTo'=>'GBP','amountSell'=>1000,'amountBuy'=>747.10,
	'rate'=>0.7471,'timePlaced'=>'24-JAN-15 10:27:44','originatingCountry'=>'FR'];  

	$data_string = json_encode($data);  

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string)) );                    

$result = curl_exec($ch);

echo $result;


                                                               
                                                                                  
                                                                                                                     
                                                                  
                                                                                               
                                                                                                                     


?>