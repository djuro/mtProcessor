<?php
namespace DMConsumerBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Basic, smoke testing. Detect if some page/route is unavailable.
 * 
 */
class ApplicationAvailabilityTest extends WebTestCase
{
    public function testPageIsSuccessful()
    {
        $client = self::createClient();
        
        $client->request('POST', '/new-message');
        $this->assertTrue($client->getResponse()->isSuccessful(),"New message endpoint is not available.");
        
        $client->request('GET', '/login');
        $this->assertTrue($client->getResponse()->isSuccessful(),"Login page is not available.");
    }
    
}
