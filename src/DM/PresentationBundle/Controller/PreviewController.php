<?php

namespace DM\PresentationBundle\Controller;

use DM\AnalyticsBundle\Service\TrendStrategy\TrendEnumerator;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineODMMongoDBAdapter;

use \Exception;

class PreviewController extends Controller
{
    /**
     * @Route("/admin/message/list", name="admin_message_list")
     * @Template()
     */
    public function messageListAction(Request $request)
    {
        $page = $request->query->get('page');

        if(empty($page))
            $page = 1;

        $documentManager = $this->get('doctrine_mongodb')->getManager();

        $queryBuilder = $documentManager->createQueryBuilder('DMConsumerBundle:Message')
                                        ->sort('timePlaced', 'desc');

        $adapter = new DoctrineODMMongoDBAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(50);
        $pagerfanta->setCurrentPage($page);

        return array(
            'messages' => $pagerfanta
            );
    }

    /**
     * @Route("/admin/report/list", name="admin_report_list")
     * @Template()
     */
    public function reportListAction(Request $request)
    {
        $page = $request->query->get('page');

        if(empty($page))
            $page = 1;

        $documentManager = $this->get('doctrine_mongodb')->getManager();

        $queryBuilder = $documentManager->createQueryBuilder('DMAnalyticsBundle:Report')
                                        ->sort('createdAt', 'desc');

        $adapter = new DoctrineODMMongoDBAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(50);
        $pagerfanta->setCurrentPage($page);

        return array(
            'reports' => $pagerfanta,
            'trendLabels' => TrendEnumerator::trends()
            );
    }

    /**
     * @Route("/admin/report/view", name="admin_report_view")
     * @Template()
     */
    public function viewReportAction(Request $request)
    {
        $reportRepository = $this->get('doctrine_mongodb')->getManager()->getRepository('DMAnalyticsBundle:Report');
        $reportService = $this->get('report_service');

        $report = $reportRepository->find($request->query->get('id'));

        if(!$report)
            throw new Exception(sprintf("No Report found having ID: %s",$request->query->get('id')));

        $reportView = $reportService->createView($report);
        

        return array('reportView' => $reportView);
    }


    /**
     * @Route("/")
     * @Template()
     */
    public function homeAction()
    {
        return $this->redirect($this->generateUrl('admin_message_list'));
    }
    
    /**
     * @Route("/admin/message/delete/{messageId}", name="admin_message_delete")
     * @Template()
     */
    public function deleteMessageAction(Request $request, $messageId)
    {
        $em = $this->get('doctrine_mongodb')->getManager();
        $messageRepository = $em->getRepository('DMConsumerBundle:Message');
        
        $message = $messageRepository->find($messageId);
        
        if(!$message)
            throw new Exception (sprintf("No Message found having specified ID: %s",$messageId));
        
        $em->remove($message);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_message_list'));
    }
    
}
