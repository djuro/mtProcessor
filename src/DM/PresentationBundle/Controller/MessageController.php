<?php

namespace DM\PresentationBundle\Controller;

use DM\AnalyticsBundle\Form\Repository\ReportRepository;
use DM\AnalyticsBundle\Service\TrendStrategy\TrendEnumerator;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use \DateTime;

class MessageController extends Controller
{
    /**
     * @Route("/admin/message/list", name="admin_message_list")
     * @Template()
     */
    public function listAction(Request $request)
    {
        $documentManager = $this->get('doctrine_mongodb')->getManager();

        $messages = $documentManager->getRepository('DMConsumerBundle:Message')->findAll();

        return array('messages'=>$messages);
    }

    
}
