<?php
namespace DMConsumerBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RestControllerTest extends WebTestCase
{
    private $testJson = '{  "userId": "134256",
                            "currencyFrom": "EUR",
                            "currencyTo":"GBP",
                            "amountSell": 1000,
                            "amountBuy": 747.1,
                            "rate":0.7471,
                            "timePlaced":"24-JAN-15 10:27:44",
                            "originatingCountry":"FR"}';
    
    private $responseMessage = '{"status":200,"message":"Message stored successfuly."}';
    
    
    /**
     * Posts JSON message to Controller method and checks for response message. 
     * Tests the whole process of message storing.
     */
    public function testNew()
    {
        $client = static::createClient();

        $client->request('POST',
                         '/new-message',
                         array(),
                         array(),
                         array('CONTENT_TYPE' => 'application/json'),
                         $this->testJson
                         ); 
        
       $this->assertContains($client->getResponse()->getContent(),$this->responseMessage);
        
    }
}
