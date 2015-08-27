<?php
namespace DMConsumerBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;


/**
 * Basic, smoke testing. Detect if some page/route is unavailable.
 * 
 */
class ApplicationAvailabilityTest extends WebTestCase
{
    /**
     *
     * @var Client
     */
    private $client;
    
    public function testPageIsSuccessful()
    {
        $this->client = self::createClient();
     
        $this->client->request('POST', '/new-message');
        $this->assertTrue($this->client->getResponse()->isSuccessful(),"New message endpoint is not available.");
        
        $this->client->request('GET', '/register/');
        $this->assertTrue($this->client->getResponse()->isSuccessful(),"Register page is not available.");
        
        $crawler = $this->client->request('GET', '/login');
        $this->assertTrue($this->client->getResponse()->isSuccessful(),"Login page is not available.");
        
        $buttonCrawlerNode = $crawler->selectButton('Submit');
        $form = $buttonCrawlerNode->form();
        
        $loginData = array('_username' => 'djuro','_password' => 'lfp04i');
        $this->client->submit($form,$loginData);
        
        $this->client->followRedirect();
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
        
        $this->checkRestrictedRoutes();
        
    }
   
    
    private function checkRestrictedRoutes()
    {
        $this->client->request('GET', '/admin/message/list');
        $this->assertTrue($this->client->getResponse()->isSuccessful(),"Messages list page is not available.");
        
        $this->client->request('GET', '/admin/report/list');
        $this->assertTrue($this->client->getResponse()->isSuccessful(),"Messages list page is not available.");
        
        $this->client->request('GET', '/admin/report/new');
        $this->assertTrue($this->client->getResponse()->isSuccessful(),"Messages list page is not available.");
        
        $this->client->request('GET', '/profile/');
        $this->assertTrue($this->client->getResponse()->isSuccessful(),"Profile page is not available.");
        
        $this->client->request('GET', '/profile/edit');
        $this->assertTrue($this->client->getResponse()->isSuccessful(),"Profile edit page is not available.");
    }
    
}
