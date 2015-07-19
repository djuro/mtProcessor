<?php

namespace DM\ConsumerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RestController extends Controller
{
    /**
     * @Route("/new-message", name="new_message")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
    	$messageData = json_decode($request->getContent(), true);
    	
		$messageService = $this->get('message_service');

    	$messageService->handleMessage($messageData);

        return new JsonResponse(['status'=>200,'message'=>'Message stored successfuly.']);
    }


}
