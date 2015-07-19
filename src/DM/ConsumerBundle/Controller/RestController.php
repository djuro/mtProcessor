<?php

namespace DM\ConsumerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use \Exception;

class RestController extends Controller
{
    /**
     * @Route("/new-message", name="new_message")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        try
        {
            $messageData = json_decode($request->getContent(), true);
        
            $messageService = $this->get('message_service');

            $messageService->handleMessage($messageData);

            return new JsonResponse(['status'=>200,'message'=>'Message stored successfuly.']);
        }
        catch(Exception $e)
        {
            $logger = $this->get('logger');
            $logger->error($e->getMessage());
            $logger->error("Received message: ".$request->getContent());

            return new JsonResponse(['message'=>'Invalid format.']);
        }
    	
    }


}
