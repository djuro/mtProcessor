<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Document\Message as MongoMessage;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MessageController extends Controller
{
   

    /**
    * @Route("/api/new", name="api_new_message")
    * 
    */
    public function newAction(Request $request)
    {
        $content = json_decode($request->getContent(),true);

        //return new Response($content);
        $message = new Message();

        $message->setCurrencyFrom($content['currencyFrom']);
        $message->setCurrencyTo($content['currencyTo']);
        $message->setAmount($content['amount']);

       $em=$this->getDoctrine()->getManager();
       $em->persist($message);
       $em->flush();

        $response = new JsonResponse(['status'=>200,'message'=>'New message persisted successfuly.']);
        //$response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
    * @Route("/api/mongo/new", name="api_new_mongo_message")
    * 
    */
    public function newMongoAction(Request $request)
    {
        $content = json_decode($request->getContent(),true);

        $message = new MongoMessage();
        $message->setCurrencyFrom($content['currencyFrom']);
        $message->setCurrencyTo($content['currencyTo']);
        $message->setAmount($content['amount']);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($message);
        $dm->flush();

        $response = new JsonResponse(['status'=>200,'message'=>'New message persisted successfuly.']);

        return $response;
    }
}